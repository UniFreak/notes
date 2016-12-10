<?php

/**
 * @?:
 * - check login and check power
 */
namespace App\Http\Controllers\Stat;

use App\Http\Controllers\XinController;
use App\Repositories\CreditStatRepository;
use App\Repositories\DealStatRepository;
use App\Repositories\StatRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Library\Ycurl;

class WapShowController extends XinController
{
    const AREA_ALL = 0;
    const API_SUCCESS_CODE = 1;
    const TYPE_HALF = 0;
    const TYPE_ANYLOAN = 1;

    private $statRepository;
    protected $api;

    private $defaultArea = self::AREA_ALL;

    public function __construct(StatRepository $statRepository, CreditStatRepository $creditStatRepository, DealStatRepository $dealStatRepository, Ycurl $api)
    {
        parent::__construct();
        $this->statRepository = $statRepository;
        $this->creditStatRepository = $creditStatRepository;
        $this->dealStatRepository = $dealStatRepository;

        $this->api = $api;
    }

    /**
     * 统计信审量/验四量/复审通过量等 api入口
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function apply(Request $request)
    {
        $loggedIn = $this->checkLogin($request);
        if (!$loggedIn) {
            return redirect('api/wapLogin');
        }

        $hasPower = $this->checkPower();
        if (!$hasPower) {
            return view('errors.error_power');
        }

        $type = (int) $request->input('type', self::TYPE_HALF);
        if ($type == self::TYPE_HALF) {
            $scope = $request->input('scope', '0');
            return view('stat.wap_show', [
                'scope' => $scope,
                'type' => $type
            ]);
        } else if ($type == self::TYPE_ANYLOAN) {
            $area = $request->input('area', $this->defaultArea);
            return view('stat.anyloan', [
                'area' => $area,
                'type' => $type
                ]);
        }
    }

    private function checkLogin(Request $request)
    {
        $userInfo = UserRepository::getLoginInfo();
        if ($userInfo) {
            return true;
        }

        // username & password are passed in by app's url params
        $username = $request->input('user');
        $password = base64_decode($request->input('key'));
        $res = ['code' => -1];
        if ($username && $password) {
            $res = UserRepository::checkLogin($username, $password);
        }
        if ($res['code'] == 1) {
            return true;
        }

        return false;
    }

    private function checkPower()
    {
        $hasPower = UserRepository::checkPower('wapshowcontroller', 'apply');
        if (!$hasPower) {
            return false;
        }
        return true;
    }

    protected function ajaxData(Request $request)
    {
        $params = [
            'applyStartTime' => date('Y-m-d', time() - (86400 * 6)),
            'applyEndTime' => date('Y-m-d', time()),
            'scope' => $request->input('scope', 0),
            'source_type' => $request->input('source_type', ''),
        ];
        $distSubmit = ['total'=>null,'part'=>null];
        $applyData = $this->creditStatRepository->applyStatByScope($params);
        $tradeData = $this->dealStatRepository->tradeStat($params);
        $info = $this->dealStatRepository->getRealTimeTrade($params);
        if($params['scope'] == 1){
            $distSubmit = $this->creditStatRepository->getTotalSubmit();
        }
        $data = [
            'applyData' => $applyData,
            'tradeData' => $tradeData,
            'realData' => $info['realData'],
            'trade' => $info['trade'],
            'day' => date('Y-m-d'),
            'days' => array_keys($applyData),
            'total' => $distSubmit['total'],
            'part' => $distSubmit['part'],
            'type' => 0,
        ];
        $result = [
            'code' => 0,
            'data' => $data,
        ];
        if ($data) {
            $result['code'] = 1;
            return json_encode($result);
        } else {
            return json_encode($result);
        }
    }

    public function fetch(Request $request)
    {
        $area = $request->input('area', $this->defaultArea);
        $apiRequest = [
            'big_areaid' => $area,
        ];

        try {
            $url = Config('apiUrl.anyLoanStatistic') . '?' . http_build_query($apiRequest);
            $apiResult = $this->api->get($url);
            $apiResult = json_decode($apiResult, true);
            if ($apiResult['code'] == self::API_SUCCESS_CODE) {
                return json_encode($apiResult['data'], true);
            }
        } catch (Exception $e) {
            // do nothing...
        }
        return '';
    }

    public function wapLogin()
    {
        $userInfo = UserRepository::getLoginInfo();
        if ($userInfo) {
            return redirect('/api/applyStat');
        }
        return view('yxr_login');
    }

}
