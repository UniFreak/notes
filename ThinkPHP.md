=============== 入门 ===============
概念
    AOP(Aspect-Oriented Programming)
        将那些与业务无关, 却为业务模块所共同调用的逻辑或责任(如权限认证, 日志, 事务处理等)封装起来, 便于减少系统的重复代码, 降低模块间的耦合度, 并有利于未来的可操作性和可维护性. 可以说是 OOP(继承的, 从上到下的) 的补充和完善(横向的)
    MVC(Model View Controller)
    CBD(Core Behavior Driver)
    ORM(Object/Relation Mapping)
        主要实现程序对象到关系数据库数据的映射
    Active Record
        表映射到记录, 记录映射到对象, 字段映射到对象属性
        在 TP 中则是 : 表映射到类, 记录映射到对象

=============== 入口 ===============
入口文件配置
    //定义项目名称
    define('APP_NAME', 'App');
    //定义项目路径
    define('APP_PATH', './App/');       // 必须以 "/" 结尾
    //开启调试模式
    define('APP_DEBUG', true);
    //加载框架入文件
    require './App/ThinkPHP/ThinkPHP.php';

    //定义编译缓存目录
    define('RUNTIME_PATH','./App/temp/');
    //定义编译缓存文件名
    define('RUNTIME_FILE','./App/temp/runtime_cache.php');
目录常用部署
    ThinkPHP
    Public
        Js
        Img
        Css
    Uploads
    Home
    Admin

    index.php
    admin.php

=============== 配置 ===============
配置格式 : 数组
配置层次(按加载顺序和优先级由低到高)
    惯例配置->项目配置->调试配置->分组配置->扩展配置->动态配置
惯例配置
    /* 项目和分组设定 */
        APP_STATUS
        APP_FILE_CASE
        APP_AUTOLOAD_PATH
        APP_TAGS_ON
        APP_SUB_DOMAIN_DEPLO
        APP_SUB_DOMAIN_RULES
        APP_SUB_DOMAIN_DENY
        APP_GROUP_LIST
        APP_GROUP_MODE
        APP_GROUP_PATH
        ACTION_SUFFIX

        /* Cookie设置 */
        COOKIE_EXPIRE
        COOKIE_DOMAIN
        COOKIE_PATH
        COOKIE_PREFIX

        /* 默认设定 */
        DEFAULT_M_LAYER
        DEFAULT_C_LAYER
        DEFAULT_V_LAYER
        DEFAULT_APP
        DEFAULT_LANG
        DEFAULT_THEME
        DEFAULT_GROUP
        DEFAULT_MODULE
        DEFAULT_ACTION
        DEFAULT_CHARSET
        DEFAULT_TIMEZONE
        DEFAULT_AJAX_RETURN
        DEFAULT_JSONP_HANDLE
        DEFAULT_FILTER

        /* 数据库设置 */
        DB_TYPE
        DB_HOST
        DB_NAME
        DB_USER
        DB_PWD
        DB_PORT
        DB_PREFIX
        DB_FIELDTYPE_CHECK
        DB_FIELDS_CACHE
        DB_CHARSET
        DB_DEPLOY_TYPE
        DB_RW_SEPARATE
        DB_MASTER_NUM
        DB_SLAVE_NO
        DB_SQL_BUILD_CACHE
        DB_SQL_BUILD_QUEUE
        DB_SQL_BUILD_LENGTH
        DB_SQL_LOG

        /* 数据缓存设置 */
        DATA_CACHE_TIME
        DATA_CACHE_COMPRESS
        DATA_CACHE_CHECK
        DATA_CACHE_PREFIX
        DATA_CACHE_TYPE
        DATA_CACHE_PATH
        DATA_CACHE_SUBDIR
        DATA_PATH_LEVEL

        /* 错误设置 */
        ERROR_MESSAGE
        ERROR_PAGE
        SHOW_ERROR_MSG
        TRACE_EXCEPTION

        /* 日志设置 */
        LOG_RECORD
        LOG_TYPE
        LOG_DEST
        LOG_EXTRA
        LOG_LEVEL
        LOG_FILE_SIZE
        LOG_EXCEPTION_RECORD

        /* SESSION设置 */
        SESSION_AUTO_START
        SESSION_OPTIONS
        SESSION_TYPE
        SESSION_PREFIX
        /'VAR_SESSION_ID

        /* 模板引擎设置 */
        TMPL_CONTENT_TYPE
        TMPL_ACTION_ERROR
        TMPL_ACTION_SUCCESS
        TMPL_EXCEPTION_FILE
        TMPL_DETECT_THEME
        TMPL_TEMPLATE_SUFFIX
        TMPL_FILE_DEPR

        /* URL设置 */
        URL_CASE_INSENSITIVE
        URL_MODEL
        URL_PATHINFO_DEPR
        URL_PATHINFO_FETCH
        URL_HTML_SUFFIX
        URL_DENY_SUFFIX
        URL_PARAMS_BIND
        URL_404_REDIRECT
        URL_ROUTER_ON
        URL_ROUTE_RULES

        /* 系统变量名称设置 */
        VAR_GROUP
        VAR_MODULE
        VAR_ACTION
        VAR_AJAX_SUBMIT
        VAR_JSONP_HANDLER
        VAR_PATHINFO
        VAR_URL_PARAMS
        VAR_TEMPLATE
        VAR_FILTERS

        OUTPUT_ENCODE
        HTTP_CACHE_CONTROL
项目配置 (项目目录/Conf/config.php)
调试配置 (首先应用 系统目录/Conf/debug.php, 若 项目目录/Conf/ 下有debug.php, 则合并)
        LOG_RECORD
        LOG_EXCEPTION_RECORD
        LOG_LEVEL
        DB_FIELDS_CACHE
        DB_SQL_LOG
        APP_FILE_CASE
        TMPL_CACHE_ON
        TMPL_STRIP_SPACE
        SHOW_ERROR_MSG
分组配置 (项目目录/Conf/分组名称/config.php)
动态配置 (在具体的 Action 方法里面)
    一维 : C('参数名称','新参数值')
    二维 : C('一维名称.二维名称','新参数值')
扩展配置 (编译后再修改项目配置文件依然能立即生效)
    'LOAD_EXT_CONFIG' => 'user,db'      // 加载 项目目录/Conf/user.php 和 db.php 为扩展配置
读取配置
    一维 : C('参数名称')
    二维 : C('一维名称.二维名称')
保存配置
    C($array,'name')            // 保存存储在 $array 数组中的配置到标识为 name 的缓存数据中
获取已保存配置
    C(' ','name')               // 获取标识为 name 的缓存数据中的配置数组并合并到当前配置数据

=============== 函数和类库 ===============
函数库
    系统目录/Common/                系统函数库
        common.php                      基础函数库, 全局
            T($template='',$layer='')           获取模版文件 格式 项目://分组@主题/模块/操作
            I($name,$default='',$filter=null)   获取输入参数 支持过滤和默认值
            G($start,$end='',$dec=4)            记录和统计时间（微秒）和内存使用情况
            N($key, $step=0,$save=false)        设置和获取统计数据
            D($name='',$layer='')               D函数用于实例化Model 格式 项目://分组/模块
            M($name='', $tablePrefix='',$connection='')
                                                M函数用于实例化一个没有模型文件的Model
            A($name,$layer='',$common=false)    A函数用于实例化Action 格式：[项目://][分组/]模块
            R($url,$vars=array(),$layer='')     远程调用模块的操作方法 URL 参数格式 [项目://][分组/]
                                                模块/操作
            L($name=null, $value=null)          获取和设置语言定义(不区分大小写)
            C($name=null, $value=null)          获取和设置配置参数 支持批量定义
            B($name, &$params=NULL)             执行某个行为
            parse_name($name, $type=0)          字符串命名风格转换
            require_cache($filename)            优化的require_once
            require_array($array,$return=false) 批量导入文件 成功则返回
            ile_exists_case($filename)          区分大小写的文件存在判断
            import($class, $baseUrl = '', $ext='.class.php')
                                                导入所需的类库 同java的Import 本函数有缓存功能
            load($name, $baseUrl='', $ext='.php')
                                                基于命名空间方式导入函数库
            vendor($class, $baseUrl = '', $ext='.php')
                                                快速导入第三方框架类库
                                                所有第三方框架的类库文件统一放到
                                                系统的Vendor目录下面
            alias_import($alias, $classfile='') 快速定义和导入别名 支持批量定义
            tag($tag, &$params=NULL)            处理标签扩展
            add_tag_behavior($tag,$behavior,$path='')
                                                动态添加行为扩展到某个标签
            strip_whitespace($content)          去除代码中的空白和注释
            compile($filename)                  编译文件
            array_define($array,$check=true)    根据数组生成常量定义
            trace($value='[think]',$label='',$level='DEBUG',$record=false)
                                                添加和获取页面Trace记录
        function.php                    公共函数库
            U($url='',$vars='',$suffix=true,$redirect=false,$domain=false)
                                                URL组装 支持不同URL模式
            W($name, $data=array(), $return=false,$path='')
                                                渲染输出Widget
            S($name,$value='',$options=null)    缓存管理
            F($name, $value='', $path=DATA_PATH)
                                                快速文件数据读取和保存 针对简单类型数据
                                                字符串、数组
            halt($error)                        错误输出
            throw_exception($msg, $type='ThinkException', $code=0)
                                                自定义异常处理
            dump($var, $echo=true, $label=null, $strict=false)
                                                浏览器友好的变量输出
            _404($msg='',$url='')               404处理
            layout($layout)                     设置当前页面的布局
            filter($name, &$content)            过滤器方法 引用传值
            redirect($url, $time=0, $msg='')    URL重定向
            get_instance_of($name, $method='', $args=array())
                                                取得对象实例 支持调用类的静态方法
            to_guid_string($mix)                根据PHP各种类型变量生成唯一标识号
            xml_encode($data, $root='think', $item='item', $attr='', $id='id', $encoding='utf-8')
                                                XML编码
            data_to_xml($data, $item='item', $id='id')
                                                数据XML编码
            session($name,$value='')            session管理函数
            cookie($name, $value='', $option=null)
                                                Cookie 设置、获取、删除
            load_ext_file()                     加载动态扩展文件
            get_client_ip($type = 0)            获取客户端IP地址
            send_http_status($code)             发送HTTP状态
            filter_exp(&$value)                 过滤表单中的表达式
        runtime.php                     运行时函数库, 在调试或编译时加载, 编译后不再加载
            check_runtime()                 检查缓存目录(Runtime) 如果不存在则自动创建
            build_runtime_cache($append='') 创建编译缓存
            build_tags_cache()              编译系统行为扩展类库
            build_app_dir()                 创建项目目录结构
            build_first_action()                    创建测试Action
            build_dir_secure($dirs=array()) 生成目录安全文件
    项目目录/Common/
        common.php          项目函数库
        其他.php              扩展函数库, 不会自动加载, 除非你设置了动态载入(如何加载:见下)
函数库加载
    动态
        在项目配置文件:
        "LOAD_EXT_FILE"=>"user,db"
    手动
        load("@.user")          // @ 表示当前项目
类库
    系统目录/Lib/                   核心基类库
        Behavior/                       调用路径:Think.Behavior
            CheckRouteBehavior.class.php
            ContentReplaceBehavior.class.php
            ParseTemplateBehavior.class.php
            ReadHtmlCacheBehavior.class.php
            ShowPageTraceBehavior.class.php
            ShowRuntimeBehaviorBehavior.class.php
            TokenBuildBehavior.class.php
            WriteHtmlCacheBehavior.class.php
        Core/                       调用路径:Think.Core
            Action.class.php
                getActionName()                 获取当前Action名称
                isAjax()                        是否AJAX请求
                display($templateFile='',$charset='',$contentType='',$content='',$prefix='')
                                                模板显示 调用内置的模板引擎显示方法
                show($content,$charset='',$contentType='',$prefix='')
                                                输出内容文本可以包括Html 并支持内容解析
                fetch($templateFile='',$content='',$prefix='')
                                                获取输出页面内容
                buildHtml($htmlfile='',$htmlpath='',$templateFile='')
                                                创建静态页面
                theme($theme)                   模板主题设置
                assign($name,$value='')         模板变量赋值
                get($name='')                   取得模板显示变量的值
                error($message='',$jumpUrl='',$ajax=false)
                                                操作错误跳转的快捷方法
                success($message='',$jumpUrl='',$ajax=false)
                                                操作成功跳转的快捷方法
                ajaxReturn($data,$type='')      Ajax方式返回数据到客户端
                redirect($url,$params=array(),$delay=0,$msg='')
                                                Action跳转(URL重定向） 支持指定模块和延时跳转
                dispatchJump($message,$status=1,$jumpUrl='',$ajax=false)
                                                默认跳转操作 支持错误导向和正确跳转
            App.class.php                   执行应用过程管理
                init()                          应用程序初始化
                exec()                          执行应用程序
                run()                           运行应用实例 入口文件使用的快捷方法
                logo()
            Behavior.class.php
            Cache.class.php                 缓存管理类
                connect($type='',$options=array())
                                                连接缓存
                setOptions($name,$value)
                getOptions($name)
                getInstance()                   取得缓存类实例
                queue($key)                     队列缓存
            Db.class.php
                getInstance()                   取得数据库类实例
                factory($db_config='')          加载数据库 支持配置文件或者 DSN
                _getDsnType($dsn)               根据DSN获取数据库类型 返回大写
                parseConfig($db_config='')      分析数据库配置信息，支持数组和DSN
                initConnect($master=true)       初始化数据库连接
                multiConnect($master=false)     连接分布式服务器
                parseDSN($dsnStr)               DSN解析
                debug()                         数据库调试 记录当前SQL
                parseLock($lock=false)          设置锁机制
                parseSet($data)                 set分析
                bindParam($name,$value)         参数绑定
                parseBind($bind)                参数绑定分析
                parseKey(&$key)                 字段名分析
                parseValue($value)              value分析
                parseField($fields)             field分析
                parseTable($tables)             table分析
                parseWhere($where)              where分析
                parseWhereItem($key,$val)       where子单元分析
                parseThinkWhere($key,$val)      特殊条件分析
                parseLimit($limit)              limit分析
                parseJoin($join)                join分析
                parseOrder($order)              order分析
                parseGroup($group)              group分析
                parseHaving($having)            having分析
                parseComment($comment)          comment分析
                parseDistinct($distinct)        distinct分析
                parseUnion($union)              union分析
                insert($data,$options=array(),$replace=false)
                                                插入记录
                selectInsert($fields,$table,$options=array())
                                                通过Select方式插入记录
                update($data,$options)          更新记录
                delete($options=array())        删除记录
                select($options=array())        查找记录
                buildSelectSql($options=array())
                                                生成查询SQL
                parseSql($sql,$options=array())
                                                替换SQL语句中表达式
                getLastSql($model='')           获取最近一次查询的sql语句
                getLastInsID()                  获取最近插入的ID
                getError()                      获取最近的错误信息
                escapeString($str)              SQL指令安全过滤
                setModel($model)                设置当前操作模型
                close()                         关闭数据库 由驱动类定义
            Dispatcher.class.php            完成URL解析、路由和调度
                dispatch()                      URL映射到控制器
                routerCheck()                   路由检测
                getModule($var)                 获得实际的模块名称
                getAction($var)                 获得实际的操作名称
                getGroup($var)                  获得实际的分组名称
            Log.class.php                   日志处理类
                record($message,$level=self::ERR,$record=false)
                                                记录日志 并且会过滤未经设置的级别
                save($type='',$destination='',$extra='')
                                                日志保存
                write($message,$level=self::ERR,$type='',$destination='',$extra='')
                                                日志直接写入
            Model.class.php                 模型类
                _checkTableInfo()               自动检测数据表信息
                flush()                         获取字段信息并缓存
                switchModel($type,$vars=array())
                                                动态切换扩展模型
                _initialize()                   回调方法 初始化模型
                _facade($data)                  对保存到数据库的数据进行处理
                _before_write(&$data)           写入数据前的回调方法 包括新增和更新
                add($data='',$options=array(),$replace=false)
                                                新增数据
                _before_insert(&$data,$options)
                                                插入数据前的回调方法
                _after_insert($data,$options)   插入成功后的回调方法
                addAll($dataList,$options=array(),$replace=false)
                selectAdd($fields='',$table='',$options=array())
                                                通过Select方式添加记录
                save($data='',$options=array()) 保存数据
                _before_update(&$data,$options)
                                                更新数据前的回调方法
                _after_update($data,$options)   更新成功后的回调方法
                delete($options=array())        删除数据
                _after_delete($data,$options)   删除成功后的回调方法
                select($options=array())        查询数据集
                _after_select(&$resultSet,$options)
                                                查询成功后的回调方法
                buildSql($options=array())      生成查询SQL 可用于子查询
                _parseOptions($options=array())
                                                分析表达式
                _options_filter(&$options)      表达式过滤回调方法
                _parseType(&$data,$key)         数据类型检测
                find($options=array())          查询数据
                _after_find(&$result,$options)  查询成功的回调方法
                returnResult($data,$type='')
                parseFieldsMap($data,$type=1)   处理字段映射
                setField($field,$value='')      设置记录的某个字段值
                setInc($field,$step=1)          字段值增长
                setDec($field,$step=1)          字段值减少
                getField($field,$sepa=null)     获取一条记录的某个字段值
                create($data='',$type='')       创建数据对象 但不保存到数据库
                autoCheckToken($data)           自动表单令牌验证
                regex($value,$rule)             使用正则验证数据
                autoOperation(&$data,$type)     自动表单处理
                autoValidation($data,$type)     自动表单验证
                _validationField($data,$val)    验证表单字段 支持批量验证
                _validationFieldItem($data,$val)
                                                根据验证因子验证字段
                check($value,$rule,$type='regex')
                                                验证数据 支持 in between equal length regex expire ip_allow ip_deny
                query($sql,$parse=false)        SQL查询
                execute($sql,$parse=false)      执行SQL语句
                parseSql($sql,$parse)           解析SQL语句
                db($linkNum='',$config='',$params=array())
                                                切换当前的数据库连接
                _after_db()                     数据库切换后回调方法
                getModelName()                  得到当前的数据对象名称
                getTableName()                  得到完整的数据表名
                startTrans()                    启动事务
                commit()                        提交事务
                rollback()                      事务回滚
                getError()                      返回模型的错误信息
                getDbError()                    返回数据库的错误信息
                getLastInsID()                  返回最后插入的ID
                getLastSql()                    返回最后执行的sql语句
                _sql()                          getLastSql()别名
                getPk()                         获取主键名称
                getDbFields()                   获取数据表字段信息
                data($data='')                  设置数据对象值
                join($join)                     查询SQL组装 join
                union($union,$all=false)        查询SQL组装 union
                cache($key=true,$expire=null,$type='')
                                                查询缓存
                field($field,$except=false)     指定查询字段 支持字段排除
                scope($scope='',$args=NULL)     调用命名范围
                where($where,$parse=null)       指定查询条件 支持安全过滤
                limit($offset,$length=null)     指定查询数量
                page($page,$listRows=null)      指定分页
                comment($comment)               查询注释
                setProperty($name,$value)       设置模型的属性值
            Think.class.php                 ThinkPHP Portal类
                start()                         应用程序初始化
                buildApp()                      读取配置信息 编译项目
                autoload($class)                系统自动加载ThinkPHP类库
                instance($class,$method='')     取得对象实例 支持调用类的静态方法
                appException($e)                自定义异常处理
                appError($errno, $errstr, $errfile, $errline)
                                                自定义错误处理
                atalError()                     致命错误捕获
            ThinkException.class.php        异常基类
            View.class.php                  视图类
                assign($name,$value='')     模板变量赋值
                get($name='')                   取得模板变量的值
                display($templateFile='',$charset='',$contentType='',$content='',$prefix='')
                                                加载模板和页面输出 可以返回输出内容
                render($content,$charset='',$contentType='')
                                                输出内容文本可以包括Html
                fetch($templateFile='',$content='',$prefix='')
                                                解析和获取模板内容 用于输出
                parseTemplate($template='')     自动定位模板文件
                theme($theme)                   设置当前输出的模板主题
                getTemplateTheme()              获取当前的模板主题
            Widget.class.php
                render($data)                   渲染输出 render方法是Widget唯一的接口
                renderFile($templateFile='',$var='')
                                                渲染模板输出 供render方法内部调用
                checkCache($tmplTemplateFile)
                                                检查缓存文件是否有效, 如果无效则需要重新编译
        Driver/                      调用路径:Think.Driver
            Cache/                       文件类型缓存类
                CacheFile.class.php
                    init()                      初始化检查
                    filename($name)             取得变量的存储文件名
                    get($name)                  读取缓存
                    set($name,$value,$expire=null)
                                                写入缓存
                    rm($name)                   删除缓存
                    clear()                     清除缓存
            Db/
                DbMysql.class.php extends Db    Mysql数据库驱动类
                    connect($config='',$linkNum=0,$force=false)
                                                连接数据库方法
                    free()                      释放查询结果
                    query($str)                 执行查询 返回数据集
                    execute($str)               执行语句
                    startTrans()                启动事务
                    commit()                    用于非自动提交状态下面的查询提交
                    rollback()                  事务回滚
                    getAll()                    获得所有的查询数据
                    getFields($tableName)       取得数据表的字段信息
                    getTables($dbName='')       取得数据库的表信息
                    replace($data,$options=array())
                                                替换记录
                    insertAll($datas,$options=array(),$replace=false)
                                                插入记录
                    close()                     关闭数据库
                    error()                     数据库错误信息并显示当前的SQL语句
                    escapeString($str)          SQL指令安全过滤
                    parseKey(&$key)         字段和表名处理添加`
                DbMysqli.class.php extends Db   Mysqli数据库驱动类
                    connect($config='',$linkNum=0)
                                                连接数据库方法
                    free()                      释放查询结果
                    query($str)                 执行查询 返回数据集
                    execute($str)               执行语句
                    startTrans()                启动事务
                    commit()                    用于非自动提交状态下面的查询提交
                    rollback()                  事务回滚
                    getAll()                    获得所有的查询数据
                    getFields($tableName)       取得数据表的字段信息
                    getTables($dbName='')       取得数据表的字段信息
                    replace($data,$options=array())
                                                替换记录
                    insertAll($datas,$options=array(),$replace=false)
                                                插入记录
                    close()                     关闭数据库
                    error()                     数据库错误信息并显示当前的SQL语句
                    escapeString($str)          SQL指令安全过滤
                    parseKey(&$key)             字段和表名处理添加`
            TagLib/
                TagLibCx.class.php extends TagLib   CX标签库解析类
                    _php($attr,$content)        php标签解析
                    _volist($attr,$content)     volist标签解析 循环输出数据集
                    _foreach($attr,$content)    foreach标签解析 循环输出数据集
                    _if($attr,$content)         if标签解析
                    _elseif($attr,$content)     else标签解析
                    _else($attr)                else标签解析
                    _switch($attr,$content) switch标签解析
                    _case($attr,$content)       case标签解析 需要配合switch才有效
                    _default($attr)             default标签解析 需要配合switch才有效
                    _compare($attr,$content,$type='eq')
                                                compare标签解析
                    _eq($attr,$content)
                    _equal($attr,$content)
                    _neq($attr,$content)
                    _notequal($attr,$content)
                    _gt($attr,$content)
                    _lt($attr,$content)
                    _egt($attr,$content)
                    _elt($attr,$content)
                    _heq($attr,$content)
                    _nheq($attr,$content)
                    _range($attr,$content,$type='in')
                                                range标签解析
                    _in($attr,$content)         range标签的别名 用于in判断
                    _notin($attr,$content)      range标签的别名 用于notin判断
                    _between($attr,$content)
                    _notbetween($attr,$content)
                    _present($attr,$content)    present标签解析
                    _notpresent($attr,$content)
                                                notpresent标签解析
                    _empty($attr,$content)      empty标签解析, 如果某个变量为empty 则输出内容
                    _notempty($attr,$content)
                    _defined($attr,$content)    判断是否已经定义了该常量
                    _notdefined($attr,$content)
                    _import($attr,$content,$isFile=false,$type='')
                                                import 标签解析
                    _load($attr,$content)       import别名 采用文件方式加载(要使用命名空间必须用import)
                    _css($attr,$content)        import别名使用 导入css文件
                    _js($attr,$content)         import别名使用 导入js文件
                    _assign($attr,$content)     assign标签解析
                    _define($attr,$content)     define标签解析, 在模板中定义常量 支持变量赋值
                    _for($attr, $content)       for标签解析
        Template/                       调用路径:Think.Template
            TagLib.class.php                标签库TagLib解析基类
                parseXmlAttr($attr,$tag)        TagLib标签属性分析 返回标签属性数组
                parseCondition($condition)      解析条件表达式
                autoBuildVar($name)             自动识别构建变量
                parseThinkVar($varStr)          用于标签属性里面的特殊模板变量解析
                                                格式 以 Think. 打头的变量属于特殊模板变量
                getTags()                       获取标签定义
            ThinkTemplate.class.php         ThinkPHP内置模板引擎类
                                            支持XML标签和普通标签的模板解析
                                            编译型模板引擎 支持动态缓存
                stripPreg($str)
                get($name)                      模板变量获取
                set($name,$value)               模板变量设置
                fetch($templateFile,$templateVar,$prefix='')
                                                加载模板
                loadTemplate ($tmplTemplateFile,$prefix='')
                                                加载主模板并缓存
                compiler($tmplContent)          编译模板文件内容
                parse($content)                 模板解析入口, 支持普通标签和TagLib解析 支持自定义标签库
                parsePhp($content)              检查PHP语法
                parseLayout($content)           解析模板中的布局标签
                parseInclude($content)          解析模板中的include标签
                parseExtend($content)           解析模板中的extend标签
                parseXmlAttrs($attrs)           分析XML属性
                parseLiteral($content)          替换页面中的literal标签
                restoreLiteral($tag)            还原被替换的literal标签
                parseBlock($name,$content)
                                                记录当前页面中的block标签
                replaceBlock($name,$content)
                                                替换继承模板中的block标签
                getIncludeTagLib(& $content)
                                                搜索模板页面中包含的TagLib库并返回列表
                parseTagLib($tagLib,&$content,$hide=false)
                                                TagLib库解析
                parseXmlTag($tagLib,$tag,$attr,$content)
                                                解析标签库的标签, 需要调用对应的标签库文件解析类
                parseTag($tagStr)               模板标签解析
                parseVar($varStr)               模板变量解析,支持使用函数
                parseVarFunction($name,$varArray)
                                                对模板变量使用函数
                parseThinkVar($varStr)          特殊模板变量解析, 格式 以 $Think. 打头的变量属于特殊模板变量
                parseIncludeItem($tmplPublicName,$vars=array())
                                                加载公共模板并缓存 和当前模板在同一路径，否则使用相对路径
                parseTemplateName($templateName)
                                                分析加载的模板文件并读取内容 支持多个模板文件读取
    系统目录/Extend/Libraray/           扩展基类库
        Action/
            RestAction.class.php                ThinkPHP Restful 控制器扩展
                getActionName()                 获取当前Action名称
                function isAjax()               是否AJAX请求
                display($templateFile='',$charset='',$contentType='')
                                                模板显示
                assign($name,$value='')         模板变量赋值
                setContentType($type, $charset='')
                                                设置页面输出的CONTENT_TYPE和编码
                response($data,$type='',$code=200)
                                                输出返回数据
                encodeData($data,$type='')      编码数据
                sendHttpStatus($status)         发送Http状态信息
                getAcceptType()                 获取当前请求的Accept头信息
        Behavior/
            AgentCheckBehavior.class.php
            BrowserCheckBehavior.class.php
            CheckActionRouteBehavior.class.php
            CheckLangBehavior.class.php
            CronRunBehavior.class.php
            FireShowPageTraceBehavior.class.php
            RobotCheckBehavior.class.php
            UpgradeNoticeBehavior.class.php
        Driver/
            Cache/
                CacheApachenote.class.php
                CacheApc.class.php
                CacheDb.class.php
                CacheEaccelerator.class.php
                CacheMemcache.class.php
                CacheRedis.class.php
                CacheShmop.class.php
                CacheSqlite.class.php
                CacheWincache.class.php
                CacheXcache.class.php
            Db/
                DbIbase.class.php
                DbMongo.class.php
                DbMssql.class.php
                DbOracle.class.php
                DbPdo.class.php
                DbPgsql.class.php
                DbSqlite.class.php
                DbSqlsrv.class.php
            Session/
                SessionDb.class.php
            TagLib/
                TagLibHtml.class.php
            Template/
                TemplateEase.class.php
                TemplateLite.class.php
                TemplateMobile.class.php
                TemplateSmart.class.php
                TemplateSmarty.class.php
        Function/
            extend.php
        Library/
            ORG/
                Crypt/
                    Base64.class.php
                    Crypt.class.php
                    Des.class.php
                    Hmac.class.php
                    Rsa.class.php
                    Xxtea.class.php
                Net/
                    Http.class.php
                    Iplocation.class.php
                    qqwry.class.php
                    UploadFile.class.php
                Util/
                    Image/
                        Driver/
                            GIF.class.php
                            ImageGd.class.php
                            ImageImagick.class.php
                        ThinkImage.class.php
                    ArrayList.class.php
                    Auth.class.php
                    CodeSwitch.class.php
                    Cookie.class.php
                    Date.class.php
                    Debug.class.php
                    HtmlExtractor.class.php
                    Image.class.php
                    Input.class.php
                    Page.class.php
                    RBAC.class.php
                    Session.class.php
                    Socket.class.php
                    Stack.class.php
                    String.class.php
        Mode/
            Amf/
                Action.class.php
                App.class.php
                Db.class.php
                Model.class.php
            Cli/
                Action.class.php
                App.class.php
                Db.class.php
                functions.class.php
                Log.class.php
                Model.class.php
            Lite/
                Action.class.php
                App.class.php
                Db.class.php
                Dispathcher.class.php
                Model.class.php
                tags.php
            Phprpc/
                Action.class.php
                App.class.php
                Db.class.php
                Model.class.php
                alias.php
            Rest/
                Behavior/
                    CheckRestRouteBehavior.class.php
                    CheckUrlExtBehavior.class.php
                Action.class.php
                config.php
                tags.php
            Thin/
                Action.class.php
                App.class.php
                Db.class.php
                Model.class.php
            amf.php
            cli.php
            lite.php
            phprpc.php
            rest.php
            thin.php
        Model/
            AdvModel.class.php
            MongoModel.class.php
            RelationModel.class.php
            ViewModel.class.php
        Tool/
            Requirements-Checker/
            thinkeditor/
            TPM/
            phpunit.php
        Vendor/                     第三方
            EaseTemplate/
            phpRPC/
            SmartTemplate/
            Smarty/
            TemplateLite/
            Zend/
    项目目录/Lib/                       应用类库
        Action/                             自动加载
        Model/                              自动加载
        Behavior/                           用B()方法调用或自动加载
        Widget/                         用W()方法在模板中调用
类库导入
    import() 显式导入:
        import("@.Action.UserAction")       // @ 表示当前项目
    import() 别名导入:
        1. 在项目配置目录下面增加alias.php 用以定义项目中需要用到的类库别名, 如
            return array(
                'rbac' =>LIB_PATH.'Common/Rbac.class.php',
                'page' =>LIB_PATH.'Common/Page.class.php',
            )
        2. import("rbac");
    vendor() 直接导入位于系统目录/Extend/Libraray/Vendor下的第三方扩展类库:
        Vendor('Zend.Filter.Dir');
    自定义路径自动加载
        在项目配置文件:
        'APP_AUTOLOAD_PATH' =>'@.Common,@.Tool' // @ 表示当前项目目录

=============== 控制器 (Action 类) ===============
URL 模式
    普通 0        http://serverName/appName/?m=module&a=action&id=1
    Pathinfo 1  http://serverName/appName/module/action/id/1/
                    http://serverName/appName/module,action,id,1/
    Rewrite 2   除了可以不需要在URL里面写入口文件, 和可以定义.htaccess 文件外, 和 Pathinfo 一样
    兼容 3        http://serverName/appName/?s=/module/action/id/1/
URL 控制器调度
    每一个模块就是一个控制器类
    每一个操作就是一个控制器类下的*公共*方法(必须为 Public)

    URL 不带任何模块和操作参数 -> 执行默认控制器类下的默认方法
    URL 带模块和(或)操作参数     -> 执行对应控制器类下的对应方法
        找不到对应方法         -> 执行 _empty() 空操作方法
        找不到空操作方法    -> 直接输出对应模板
        找不到模板           -> 404 错误

        找不到对应控制器类-> 执行 EmptyAction 空模块类下的默认方法
URL 重写配置
    配置 httpd.conf , 加载mod_rewrite.so
    AllowOverride None -> AllowOverride All
    URL_MODEL 设置为2
    把下面的内容保存为.htaccess文件放到入口文件的同级目录下
        <IfModule mod_rewrite.c>
            RewriteEngine on
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
        </IfModule>
URL 生成
    U('[分组/模块/操作@域名]?参数' [,'参数','伪静态后缀','是否跳转','显示域名'])
前置后置操作
    _before_fun : 在 fun() 前执行
    _after_fun 　: 在 fun() 后执行
跨模块调用
    实例化某模块 :    A('[项目名://][分组名/]模块名')
    调用某操作     : R('[项目名://][分组名/]模块名/操作名',array('参数1','参数2'…))
页面跳转
    $this->success('msg','jumpURL')
    $this->error('msg','jumpURL')
页面重定向
    $this->redirect('New/category', array('cate_id' => 2), 5, '页面跳转中...') 或
    $this->redirect('New/category', array('cate_id' => 2), 5, '页面跳转中...')
获取系统变量
    $this->方法名(["变量名"],["过滤方法[,过滤方法...]"],["默认值"])
        支持 获取全部,多过滤,不过滤
    方法名包括
        _get        _post       _param
        _request    _put        _session
        _cookie _server     _globals
获取 URL 参数
    $_GET['_URL_'][] 或
    使用 $this -> _param()
判断请求类型
    $this->方法名
    方法名包括
        isGet       isPost      isPut
        isDelete    isHead      isAjax
Ajax 返回
    支持三种返回格式: json(默认), xml, eval
    $this->ajaxReturn(返回数据,提示信息,操作状态);
URL 和 Action 参数绑定
    URL 地址中的参数会自动和操作方法的同名参数绑定

=============== 模型 ===============
模型定义
    *只有在需要封装单独的业务逻辑的时候, 模型类才是必须被定义的*
    命名规则是除去表前缀的数据表名称, 采用驼峰法命名, 并且首字母大写, 然后加上后缀 Model
    如果不符合上述规则, 则可在模型类中定义下面几个属性, 以便找到对应的数据表
        $tableName          不含表前缀的表名
        $trueTableName      包含表前缀的表名
        $dbName             模型当前对应的数据库名称
        $tablePrefix            表前缀
实例化模型
    空模型类
        仅仅是使用原生SQL查询
            $Model = new Model() 或 M();
            $Model->query('SELECT * FROM think_user WHERE status = 1');
    基础模型类
        无法写入相关的业务逻辑, 只能完成基本的CURD操作:
            $User = M('[数据库名.]User'[,'前缀_']) 或 new Model('User')
    其他公共模型类
        CommonModel 必须继承 Model, 我们可以在 CommonModel 类里面定义一些通用的逻辑方法:
            $User = M('CommonModel:User'[,'表前缀_'][,'数据库连接配置']) 或
            $User = new CommonModel('User'[,'表前缀_'][,'数据库连接配置'])
    用户自定义模型类
        需要定义自身的业务逻辑实现, 就需要针对每个数据表定义一个模型类
            $User = new UserModel() 或
            $User = D('User')
        M方法实例化模型无需用户为每个数据表定义模型类
        D方法可以自动检测模型类, 如果存在自定义的模型类则实例化自定义模型类;
        如果不存在则会实例化Model基类, 同时对于已实例化过的模型不会重复去实例化
        如果D方法没有找到定义的模型类，则会自动调用M方法
        D方法还可以支持跨项目和分组调用如:
            D('Admin://User')
字段
    getDbFields()           // 获取当前数据对象的全部字段信息
    getPk()                 // 获取当前数据对象的主键名称

    $fields                 // 用于手动定义数据表字段名称, 以减少 IO 开销
属性访问
    1. 使用 find() 或 data() 或 create() 产生数据对象
    2. 使用 -> 或 [] 访问属性
数据库连接配置@项目配置文件
    形式
        数组
            return array(
                'DB_TYPE'   => 'mysql',
                'DB_HOST'   => 'localhost',
                'DB_NAME'   => 'thinkphp',
                'DB_USER'   => 'root',
                'DB_PWD'    => '',
                'DB_PORT'   => 3306,
                'DB_PREFIX' => 'think_',
                //其他项目配置参数
            );
        字符串
            'DB_DSN' => '数据库类型://用户名:密码@数据库地址:数据库端口/数据库名'
        调用: 先在配置文件里定义 DB_CONFIG, 用到时直接调用
    优先级
        数组形式 < DSN形式
        项目配置 < 模型类中 $connection 变量 < M() 函数指定的
切换
    数据库 : db("数据库编号","数据库配置")
    表 : table()

    当然也可以使用 M() 切换
创建数据对象
    手动创建 :
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
         ...
    create($source) : 支持从数组, 其他数据对象, 甚至对象创建, 默认是 $_POST 数组
        $User = M('User');
        $User->create();

        create方法创建的数据对象是保存在内存中, 直到使用add或者save方法才会真正写入数据库
        在这之前我们都可以改变create方法创建的数据对象
    data ():
        $data['name'] = 'ThinkPHP';
        $data['email'] = 'ThinkPHP@gmail.com';
        $User->data($data)->add();

        同 create(), 但不会自动验证和过滤
字段映射: 解决表单和数据库表字段不一致问题
    生成映射@自定义模型(表单到数据库)
        protected $_map = array(
            'name' => 'username',
            ...
            )
    解析映射@自定义模型(数据库到表单显示)
        $data = $User -> parseFieldsMap($data)
数据查询
    连贯操作
        where('condition')
        table([dbname.]tableName,parse=null)        // 支持跨库, 多表
        alias()
        data($data)                                     // 既可以创建, 也可以读取数据对象
        field('fieldName [as alias]',except=false)      // except 定义是否使用排除模式
        order('fieldName [desc]')                       // 支持多字段排序
        limit(offsel,length)
        page('page[,listRows]')                         // page: 当前页数, listRows:每页记录数
        group('fieldName')
        having('condition')
        join('joinStatement')                           // 支持多次 join, 或数组定义 join
        union('selectStatement')                        // 支持多次 union
        distinct(true/false)
        lock(true/false)                                // 查询或写入锁定
        cache($key=true,$expire='',$type='')
        relation()                                      // 关联查询
    使用数组参数
        $User->select(array('order'=>'create_time','where'=>'status=1','limit'=>'10'));
查询语言
    查询方式
        字符串
            where('type=1 AND status=1')
        数组(推荐)
            $condition['name'] = 'thinkphp';
            $condition['status'] = 1;
            $condition['_logic'] = 'OR';        // 注意 _logic 的作用
            $User->where($condition)->select();
        对象
            $condition = new stdClass();
            $condition->name = 'thinkphp';
            $condition->status= 1;
            $User->where($condition)->select();
    表达式
        $map['字段名'] = array('表达式','查询条件');
        表达式可为
            eq/neq
            gt/egt
            lt/elt
            [not ]like
            [not ]between
            [not ]in
            exp         // 实现更复杂的表达式
    快捷查询
        快捷查询方式中“|”和“&”不能同时使用
        1. $map['name|title'] = 'thinkphp'; 或
        2. $map['status&score&title']=array('1',array('gt','0'),'thinkphp','_multi'=>true); // 注意 _multi 的定义
    区间查询
        只要是针对一个字段的条件都可以写到一起
        1. $map['id']  = array(array('neq',6),array('gt',3),'and'); 或
        2. $map['name']  = array(array('like','%a%'), array('like','%b%'), array('like','%c%'), 'ThinkPHP','or');
    组合查询
        组合查询的主体还是采用数组方式查询, 只是加入了一些特殊的查询支持:
        1. $map['_string'] = 'status=1 AND score>10';           //字符串
        2. $map['_query'] = 'status=1&score=100&_logic=or'; //请求字符串
        3. $map['_complex'] = $where;                           //复合
    统计查询
        count() max() min() avg() sum()
    定位查询
        getN(2) getN(-2) first() last()
    原生SQL
        query($sql,$parse=false)        // 查询
        execute($sql,$parse=false)      // 更新或写入

        $parse = true 代表解析SQL中的特殊字符串 (需要配合连贯操作):
            $model->table("think_user")
                        ->where(array("name"=>"thinkphp"))
                        ->field("id,name,email")
                        ->query('select %FIELD% from %TABLE% %WHERE%',true);
             %FIELD%、%TABLE%和%WHERE%字符串会自动替换为同名的连贯操作方法的解析结果SQL
             支持的替换字符串包括
                %FIELD%
                %TABLE%
                %DISTINCT%
                %WHERE%
                %JOIN%
                %GROUP%
                %HAVING%
                %ORDER%
                %LIMIT%
                %UNION%
    动态查询
        getBy<FieldName>()
        getFieldBy<FieldName>()
        top<num>()
    子查询
        1. 使用 select(false) 或 buildSql() 生成
        2. 在连贯操作里直接调用
CURD 操作方法 (如果有连贯操作, CURD 操作方法要放到连贯操作最后面)
    C
        add($data='',$options=array(),$replace=false)
            回调接口
                _before_insert(&$data,$options)
                _after_insert($data,$options)
    U
        save($data='',$options=array())                                 // 更新记录
            如果没有任何更新条件, 数据对象本身也不包含主键字段的话, save方法不会更新任何数据库的记录
            也可以通过 create 或 data 方法创建要更新的数据对象, 则不用给 save 传参数了
            回调接口
                _before_update(&$data,$options)
                _after_update($data,$options)
        setField($field,$value='') 或 setField(array($field=>$value))    // 更新字段
        setInc($field,$step=1)                                          // 步增字段
        setDec($field,$step=1)                                          // 步减字段
    R
        select($options=array())        // 读取数据集
            回调接口
                _after_select(&$resultSet,$options)
        find($options=array())          // 读取单条数据, 因此 limit 连贯操作对其无效
            回调接口
                _after_find(&$result,$options)
        getField($field,$sepa=null) // $sepa: 分割字符串
            如果传入一个字段, 默认返回一个值
            如果传入多个字段, 默认返回二维数组, 与 select 的区别在于: 这里的二维数组的键名是传入的第一个字段名
            如果传入分隔字符串, 默认返回一个键名是第一个字段名, 键值是其他字段值用分割字符串拼接后的字符串的数组
            $sepa 还可以限制返回记录数量
            回调接口
                _after_find(&$result,$options)
    D
        delete($options=array())
            回调接口
                _after_delete($data,$options)
ActiveRecord
    表映射到类, 记录映射到对象
    C
        add();
    U
        save();
    R
        根据主键
            find(8);
        根据字段
            getByName("ThinkPHP");
        查询数据集
            select('1,3,8');
    D
        delete();
自动验证(当使用 create() 时):$_validate
    格式
        array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        验证字段 : 不局限于数据库字段
        验证规则 : require/email/url/currency/number 或 其他
        错误提示
        验证条件
            0   存在则验证
            1   必须验证
            2   值不为空则验证
        附加规则
            regex       验证规则为 正则表达式
            function    验证规则为 函数名                           // 支持多字段(','分割)
            callback    验证规则为 当前模型类的方法              // 支持多字段(','分割)
            confirm 验证规则为 字段名
            equal       验证规则为 值
            in          验证规则为 范围
            length      验证规则为 数字或数字范围
            between 验证规则为 范围
            expire      验证规则为 时间范围
            ip_allow    验证规则为 IP 地址列表(','分割)
            ip_deny 验证规则为 IP 地址列表(','分割)
            unique
        验证时间
            1   新增时
            2   编辑时
            3   全部
    1. 定义 $_validate
        protected $_validate = array(
            array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间]),
            array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间]),
            ...
        );
    2. 动态设置
        $validate = array(
            array('verify','require','验证码必须！'), // 仅仅需要进行验证码的验证
        );
        $User-> setProperty("_validate",$validate);
    3. 批量验证 : 设置 $patchValidate 属性为 true, getError() 方法返回的错误信息是一个数组
    4. 手动验证 : 使用 validate($validate) 或 check('验证数据','验证规则','验证类型')
自动处理(当使用 create() 时):$_auto
    格式
        array(填充字段,填充规则,[填充条件,附加规则])

        填充字段 : 不局限于数据库表字段
        填充规则
        填充条件 : 1/2/3 (参见验证)
        附加规则 : function/callback/field/string (参见验证)

    1. 定义 $_auto
        protected $_auto = array(
            array(填充字段,填充规则,[填充条件,附加规则]),
            array(填充字段,填充规则,[填充条件,附加规则]),
            ...
        )
    2. 动态设置
        $auto = array (
            array('password','md5',1,'function') // 对password字段在新增的时候使md5函数处理
        );
        $User-> setProperty("_auto",$auto);
    3. 手动
        $this->auto($auto)->create();
命名范围 (把一系列模型操作封装起来, 以便一次定义多次调用):$_scope
    定义命名范围 (使用 $_scope 属性)
        protected $_scope = array(
                // 命名范围normal
                'normal'=>array(
                    'where'=>array('status'=>1),
                ),
                // 命名范围latest
                'latest'=>array(
                    'order'=>'create_time DESC',
                    'limit'=>10,
                ),
            );
        支持的定义
            where/field/order/table/limit/page/having/group/lock/distinct/cache
    调用命名范围 (使用 scope() 方法)
        scope('范围名称1[,范围名称2[...]]',array(额外调整参数))
        scope() 可以和连贯操作混合使用, 如遇冲突后面会覆盖前面
事务支持 (必须有数据库支持, 可以跨模型操作)
    //  在User模型中启动事务
    $User->startTrans();
    // 进行相关的业务逻辑操作
    $Info = M("Info"); // 实例化Info对象
    $Info->save($User); // 保存用户信息
    if (操作成功){
        // 提交事务
        $User->commit();
    }else{
       // 事务回滚
       $User->rollback();
    }
高级模型 (需要继承 AdvModel 类或者采用动态模型)
    字段过滤
        protected $_filter = array(
            '过滤的字段'=>array('写入过滤规则','读取过滤规则',是否传入整个数据对象),
        )
    序列化字段 (序列和反序列都是在存取的时候自动完成的)
        protected $serializeField = array(
            'info' => array('name', 'email', 'address'),
        );
    文本字段 (采用文本方式存储)
        Protected  $blobFields = array('content');
    只读字段 (就是说当执行 save 方法之前会自动过滤掉只读字段的值, 避免更新到数据库)
        protected $readonlyField = array('name', 'email');
    悲观锁
        $User->lock(true)->save($data);
    乐观锁
        定义 $optimLock 属性为数据表乐观锁字段, 默认值为 lock_version
    延迟步增
        setLazyInc('字段','步长','延迟秒数')
    延迟步减
        setLazyDec('字段','步长','延迟秒数')
    分表
        protected $partition = array(
         'field' => 'name', // 要分表的字段 通常数据会根据某个字段的值按照规则进行分表
         'type' => 'md5',       // 分表的规则 包括id year mod md5 函数 和首字母
         'expr' => 'name',  // 分表辅助表达式 可选 配合不同的分表规则
         'num' => 'name',   // 分表的数目 可选 实际分表的数量
        );
        定义好了分表属性后我们就可以来进行CURD操作了, 唯一不同的是, 获取当前的数据表不再使用
        getTableName 方法, 而是使用 getPartitionTableName 方法, 而且必须传入当前的数据
    返回类型
        // 返回结果是一个stdClass对象
        $data = $User->returnResult($data, "object");
        // 还可以返回自定义的类
        $data = $User->returnResult($data, "User");
视图模型 (继承 ViewModel 类: 这里的视图指数据库视图)
    1. 定义:
        class BlogViewModel extends ViewModel {
            public $viewFields = array(
                    'Blog'=>array('id','name','title'),
                    'Category'=>array('title'=>'category_name', '_on'=>'Blog.category_id=Category.id'),
                    'User'=>array('name'=>'username', '_on'=>'Blog.user_id=User.id'),
            );
        }
        其他可用配置键值:
            '_table'        // 指定数据表
            '_as'       // 指定别名
            '_type'     // 指定连接查询类型: LEFT, RIGHT
        也可以定义特殊字段, 如:
            'COUNT(Blog.id)' => 'count'
    2. 使用:
        和普通的模型操作并没有什么大的区别, 可以和使用普通模型一样进行查询.
        如果发现查询的结果存在重复数据, 还可以使用 group 方法来处理
        $Model = D("BlogView");
        $Model->field('id,name,title,category_name,username')->where('id>10')->order('id desc')->select();
关联模型 (继承RelationModel类)
    关联类型
        HAS_ONE BELONGS_TO  HAS_MANY        MANY_TO_MANY
    定义
        protected $_link = array(
            'Profile'=>array(
                'mapping_type'=>HAS_ONE,
                'class_name'=>'要关联的模型类名 ',
                'mapping_name' =>'关联的映射名称',
                'foreign_key'=>'关联的外键名称',
                'condition'=>'关联条件',
                'mapping_fields'=>'关联要查询的字段',
                'as_fields'=>'映射成数据对象中的某个字段'
                ),
            'Dept'=> array(
                'mapping_type'=>BELONGS_TO,
                'class_name'=>'',
                'mapping_name'=>'',
                'foreign_key'=>'',
                'mapping_fields'=>'',
                'condition'=>'',
                'parent_key'=>'自引用关联的关联字段',
                'as_fields'=>''
            ),
            'Article'=> array(
                'mapping_type'=>HAS_MANY,
                'class_name'=>'',
                'mapping_name'=>'',
                'foreign_key'=>'',
                'mapping_fields'=>'',
                'condition'=>'',
                'parent_key'=>'',
                'mapping_limit'=>'关联要返回的记录数目',
                'mapping_order'=>'关联查询的排序'
            )
            Goup'=> array(
                'mapping_type'=>MANY_TO_MANY,
                'class_name'=>'',
                'mapping_name'=>'',
                'foreign_key'=>'',
                'mapping_limit'=>'',
                'mapping_order'=>'',
                'relation_foreign_key'=>'关联表的外键名称',
                'relation_table'=>'多对多的中间关联表名称'
            )
        );

        关联属性
            mapping_type : HAS_ONE / BELONGS_TO / HAS_MANY / HAS_MANY
            class_name
            mapping_name
            foreign_key
            condition
            mapping_fields
            as_fields
            parent_key
    查询 / 操作
        relation()
Mongo模型 (必须继承 MongoModel )
    主键设置
        Protected $pk = 'id';
        Protected $_idType = self::TYPE_INT / self::TYPE_OBJECT / self::TYPE_STRING;
        protected $_autoInc =  true;
    字段检测设置
        $autoCheckFields = true / false
    不支持的连贯操作: group, union, join, having, lock, distinct
    查询
        _string 采用MongoCode查询
        _query 和其他数据库的请求字符串查询相同
        _complex MongoDb暂不支持
    其他方法
        mongoCode()
        getMongoNextId()
动态模型
    切换
        switchModel("类型",参数)    //类型可为: Adv / View / Relation
    赋值
        setProperty();
虚拟模型
        Class UserModel extends Model {
            Protected $autoCheckFields = false; // 不会自动连接数据库
        }
        或
        Class UserModel { } // 不能进行 CURD 操作, 但可以实例化其他模型后进行

=============== 视图 (View 类) ===============
模板定义
    默认定义规则
        模板目录/[分组名/][模板主题/]模块名/操作名+模板后缀
    相关配置
        DEFAULT_THEME           默认模板主题名
        TMPL_TEMPLATE_SUFFIX    模板文件的默认后缀
        TMPL_FILE_DEPR          简化模板的目录层次
模板变量
    赋值
        $this -> assign('name', $value) 或
        $this -> name = $value
    获取
        $this->get('name');     // 获取name模板变量的值
        $this->get();           // 获取所有模板赋值变量的值
模板输出
    $this -> display([[主题名:][模块名:][操作名]] | [路径名] , [编码,][格式]) 或
    $this -> show(内容[,编码][,格式])         // 直接解析内容输出
模板替换 (可通过配置 TMPL_PARSE_STRING 修改)
    __PUBLIC__      成当前网站的公共目录 通常是 /Public/
    __ROOT__        当前网站的地址
    __APP__         当前项目的URL地址
    __GROUP__       当前分组的URL地址
    __URL__     当前模块的URL地址
    __ACTION__  当前操作的URL地址
    __SELF__        当前的页面URL
内容获取 (以便对模板内容进行一些处理后输出)
    $this -> fetch([[主题名:][模块名:][操作名]])
模板引擎
    设置: TMPL_ENGINE_TYPE

=============== 模板引擎 ===============
修改定界符
    TMPL_L_DELIM: 普通标签开始标记
    TMPL_R_DELIM: 普通标签结束标记
    TAGLIB_BEGIN: 标签库标签开始标签
    TAGLIB_END: 标签库标签结束标记
变量输出 ({ 和 $ 之间不能有空格)
    普通      {$var | default = 默认值}
    数组      {$arr[ 'key' ] | default = 默认值}
    对象      {$obj : attr | default = 默认值} 或 {$obj->attr}
    自动判断    {$name.name}

    支持使用运算符 : + - * / %
    支持三元运算 : {$info['status'] ? $info['msg'] : $info['error']}
系统变量 (无需 assign 即可使用, 以 $Think. 开头)
    $Think.server           获取$_SERVER
    $Think.get              获取$_GET
    $Think.post         获取$_POST
    $Think.request          获取$_REQUEST
    $Think.cookie           获取$_COOKIE
    $Think.session      获取$_SESSION
    $Think.config           获取系统配置参数 (等同 C() 函数)
    $Think.lang         获取系统语言变量 (等同 L() 函数)
    $Think.const            获取系统常量
    $Think.env              获取环境变量
    $Think.version          获取框架版本号
    $Think.now          获取当前时间
    $Think.template     获取当前模板
    $Think.ldelim           获取模板左界定符
    $Think.rdelim           获取模板右界定符
使用函数
    格式化变量: {$varname | function1 | function2=arg1,arg2,### }
                                            // ###代表模板变量本身的参数位置执行并输出返回值
    执行函数并输出返回值: {:function(…)}
    执行函数但不输出: {~function(…)}

    配置
    TMPL_DENY_FUNC_LIST             定义模板禁用函数列表
使用运算符
    +   -    *   /   %   ++     --  ?:(三元)
    使用运算符的时候, 不再支持点语法和常规的函数用法
内置标签 ( 默认配置下, 可以嵌套三层, 配置: TAG_NESTED_LEVEL )
    导入
        <include  file="[$变量名] | [[[主题名:]模块名:]操作名] | [文件名]"  [参数1=值1[...]] />

        <import  [type="js | css"]  file=[文件1[,文件2,...] | $变量]  [basepath=相对路径名]>

        <load  href=[文件名 | $变量]>

        <js  href=[文件名 | $变量]>

        <css href=[文件名 | $变量]>
    循环
        <volist name="模板变量名 | :函数()"  id=循环变量名  [offset=偏移[,length=长度[,key=循环的key变量[,mod=对key取模数[,empty=空值默认值]]]]] > < /volist >
            没有指定key属性的话, 默认使用循环变量 i
            如果要输出数组的索引, 可以直接使用key变量
            允许在模板中直接使用函数设定数据集

        <foreach name=模板变量名 item=循环变量名 [key=循环变量的键名] > < /foreach >
            优势是可以对对象进行遍历输出, 而 volist 标签通常是用于输出数组

        <for start=开始值 end=结束值 [name=循环变量名[,step=步进值[,comparison=判断条件]]] > < /for >
    判断/条件 (大多数支持 < else /> 和 < elseif />)
        <switch name=模板变量名>
            < case value=值 break="0 | 1"> </case>           // 支持多个条件判断( 用 | 分隔)
            ...
            < default />
        </switch>
            name属性可以使用函数以及系统变量
            可以对case的value属性使用变量, 使用变量方式的情况下, 不再支持多个条件的同时判断

        <if condition=条件>
            <elseif condition=条件 />
            <else />
        </if>
            在 condition 属性中可以支持 eq 等判断表达式
            不支持带有 >, <等符号的用法, 因为会混淆模板解析
            condition 属性里面使用php代码, 支持点语法和对象语法
            能够用switch和比较标签解决的尽量不用if标签完成
            IF标签仍然无法满足要求的话, 可以使用原生php代码或者PHP标签来直接书写代码

        <compare name=模板变量名 value=值 type="[ eq | equal | neq | notequal | gt | egt | lt | elt | heq | hneq ]"> </compare>
        <eq name=模板变量名 value=值> </eq>
        <neq name=模板变量名 value=值> </neq>
        <gt name=模板变量名 value=值> </gt>
        <egt name=模板变量名 value=值> </egt>
        <lt name=模板变量名 value=值> </lt>
        <elt name=模板变量名 value=值> </elt>
        <heq name=模板变量名 value=值> </heq>
        <hneq name=模板变量名 value=值> </hneq>
            变量可以支持对象的属性或者数组, 甚至可以是系统变量, 还可以支持对变量使用函数
            通常比较标签的值是一个字符串或者数字, 如果需要使用变量, 只需要在前面添加 $ 标志

        <range name=模板变量名 value=值 type="[ in | notin | between | notbetween ]"> </range>
        <in name=模板变量名 value=值> </in>
        <notin name=模板变量名 value=值> </notin>
        <between name=模板变量名 value=值> </between>
        <notbetween name=模板变量名 value=值> </notbetween>
            所有的范围判断标签的value属性都可以使用变量
            变量的值可以是字符串或者数组, 都可以完成范围判断

        <present name=模板变量名> </present>
        <notpresent name=模板变量名> </notpresent>
        <empty name=模板变量名> </empty>
        <notempty name=模板变量名> </notempty>
        <defined name=模板常量名> </defined>
        <notdefined name=模板变量名> </notdefined>
    定义
        <define name=常量名 value=常量值> </define>
        <assign name=模板变量名 value=值> </assign>
    其他
        <literal> </literal>
        <php> </php>
模板布局
    通过设置 LAYOUT_ON 和 LAYOUT_NAME 开启
        布局模板入口模式
            首先渲染 Tpl/layout.html 模板 -> 解析当前操作模板到 {__CONTENT__}
            通过动态设置 LAYOUT_NAME 应用不同的布局模板
            通过在模板开头加上 {__NOLAYOUT__} 取消模板解析
        当前模板入口模式
            通过在当前模板开头增加 <layout name="layout" /> 标签, 则首先渲染当前模板, 解析到 {__CONTENT__}, 然后输出到布局模板
    通过和 < include /> 配合, 可实现复杂的模板布局
模板继承
    基础模板:
    <block name=区块名> </block>
    继承模板:
    <extend name=基础模板名/>
        <block name=已有区块名> </block>
        ...
模板注释
    {/* 多行 */}
    {// 单行}
扩展标签库
    引入
        <tagLib name=[标签库1[,标签库2[,...]]]/>
    使用
        <标签库名:标签名 [属性1=值1[,属性2=值2[,...]]]/>
    配置
        TAGLIB_BUILD_IN
=============== 日志 ===============
开启日志
    'LOG_RECORD' => true,                               是否开启日志
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR',              日志级别
    'LOG_TYPE' =>1,                                     记录方式
    'LOG_DEST' =>'admin@domain.com',                    收件人地址
    'LOG_EXTRA' =>'From: webmaster@example.com',        发件人信息
日志级别
    EMERG           严重错误
    ALERT           警戒性错误
    CRIT            临界值错误
    ERR             一般性错误
    WARN            警告性错误
    NOTICE          通知
    INFO            信息
    DEBUG           调试
    SQL             SQL语句, 该级别只在调试模式开启时有效
记录方式
    SYSTEM      发送到 PHP 的系统日志记录         0
    MAIL            通过邮件方式发送                    1
    FILE            通过文件方式记录 (默认)           3
    SAPI            通过SAPI方式记录                  4
手动记录
    Log::write($message,$level=self::ERR,$type='',$destination='',$extra='')

    Log::record($message,$level=self::ERR,$record=false)
    Log::save($type='',$destination='',$extra='')
    Log::record方法必须结合Log::save方法才能完成日志记录, 因为record方法只是把日志信息保存到内存, 并没有真正写入日志, 直到调用Log::save方法
=============== 错误 ===============
抛出异常: throw_exception($msg, $type='ThinkException', $code=0)
默认模板: Tpl/think_exception.tpl
模板配置: TMPL_EXCEPTION_FILE => ' '
显示配置: SHOW_ERROR_MSG, ERROR_MESSAGE
=============== 调试 ===============
运行状态
    'SHOW_RUN_TIME'    => true,         // 运行时间显示
    'SHOW_ADV_TIME'    => true,         // 显示详细的运行时间
    'SHOW_DB_TIMES'    => true,         // 显示数据库查询和写入次数
    'SHOW_CACHE_TIMES' => true,         // 显示缓存操作次数
    'SHOW_USE_MEM'     => true,         // 显示内存开销
    'SHOW_LOAD_FILE'   => true,         // 显示加载文件数
    'SHOW_FUN_TIMES'   => true,         // 显示函数调用次数

    运行时间的显示是在Html页面的最后, 如果需要在制定位置显示, 只需要在Html模板文件中相关位置加上 { __RUNTIME__} 即可
页面 Trace
    'SHOW_PAGE_TRACE' =>true,       // 显示页面Trace信息
    'TMPL_TRACE_FILE' => APP_PATH.'Public/trace.php'        // Trace 页面定制
    'TRACE_PAGE_TABS'=>             // Trace 选项卡定制
    'PAGE_TRACE_SAVE'=>true         // 保存 Trace 信息
调试方法
    dump($var, $echo=true, $label=null, $strict=true)

    debug_start($label='')
    debug_end($label='')

    G($start,$end='',$dec=4)

    Debug::mark($name)
    Debug::useTime($start,$end,$decimals = 6)
    Debug::useMemory($start,$end)
    Debug::getMemPeak ($start,$end)

    trace('调试变量','显示标签')
    halt($msg)

    getLastSql() // 可以用空模型的getLastSql方法获取全局的最后SQL记录
=============== 缓存 ===============
动态缓存
    有的缓存方式都被统一使用公共的调用接口 Cache 缓存类
    实例化: $Cache = Cache::getInstance('缓存方式','缓存参数') 或 cache(array('type'=>'xcache','expire'=>60))
        通用缓存参数
            expire      缓存有效期（默认由DATA_CACHE_TIME参数配置）
            length      缓存队列长度（默认为0）
            queue       缓存队列方式（默认为file 还支持xcache和apc）
        File
            temp        缓存目录（默认由DATA_CACHE_PATH参数配置）
        Apachenote
            host        缓存服务器地址（ 默认为127.0.0.1）
        Apc
            暂无其他参数
        Eaccelerator
            暂无其他参数
        Xcache
            暂无其他参数
        Memcache
            host        缓存服务器地址（ 默认为127.0.0.1）
            port        端口（默认为MEMCACHE_PORT参数或者11211）
            timeout     缓存超时（默认由DATA_CACHE_TIME参数设置）
            persistent  长连接（默认为false）
        Shmop
            size        （默认由SHARE_MEM_SIZE参数设置）
            tmp     （默认为TEMP_PATH）
            project     （默认为s）
            length      缓存队列长度（默认为0）
        Sqlite
            db          数据库名称（默认:memory:）
            table       表名（默认为sharedmemory）
            persistent  长连接（默认为false）
        Db
            db          数据库名称（默认由DB_NAME参数配置）
            table       数据表名称（默认由DATA_CACHE_TABLE参数配置）
        Redis
            host        服务器地址（默认由REDIS_HOST参数配置或者127.0.0.1）
            port端口  （默认由REDIS_PORT参数配置或者6379）
            timeout 超时时间（默认由DATA_CACHE_TIME配置或者false）
            persistent  长连接（默认为false）
    设置缓存参数: $Cache->setOptions('temp','ThinkPHP')
    获取缓存参数: $Cache->getOptions('temp');
    设置缓存数据: $Cache->set('name','ThinkPHP', 3600) 或
                     S('name', 'ThinkPHP', 3600, 缓存方式, 缓存参数) 或
                     cache('name', 'ThinkPHP') 或
                     F('name', 'ThinkPHP')
    获取缓存数据: $Cache->get('name') 或
                     S('name') 或
                     cache('name') 或
                     F('name')
    删除缓存数据: $Cache->rm('name') 或
                     S('name', null) 或
                     cache('name',null)
                     F('name', null);
缓存队列
    使用缓存队列很简单, 只需要给当前缓存实例设置 length 参数即可
查询缓存
    $Model->cache(缓存名, 缓存时间, 缓存方式)->select()
    然后便可在外部通过S方法直接获取查询缓存的内容
SQL 解析缓存
    支持方式: File, Xcache, Apc
    开启
        'DB_SQL_BUILD_CACHE' => true,
        'DB_SQL_BUILD_QUEUE' => 'xcache ',
        'DB_SQL_BUILD_LENGTH' => 20
静态缓存
    开启
        'HTML_FILE_SUFFIX' => '',
        'HTML_CACHE_TIME' => '',
        'HTML_CACHE_ON'=>true,
        'HTML_CACHE_RULES'=> array(
            'ActionName'            => array('静态规则', '静态缓存有效期', '附加规则'),
            'ModuleName(小写)'            => array('静态规则', '静态缓存有效期', '附加规则'),
            'ModuleName(小写):ActionName' => array('静态规则', '静态缓存有效期', '附加规则'),
            '*'                     => array('静态规则', '静态缓存有效期', '附加规则'),
            //…更多操作的静态规则
        )
=============== 扩展 ===============
扩展目录 (系统/Extend目录 或 项目类库目录)
    Action          控制器扩展                                   支持自动加载
    Behavior        行为扩展                                    支持自动加载
    Driver          驱动扩展                                    支持自动加载
        Driver/Cache        缓存驱动
        Driver/Db           数据库驱动
        Driver/Session  SESSION驱动
        Driver/TagLib       标签库驱动
        Driver/Template 模板引擎驱动
    Engine          引擎扩展                                    入口定义后自动加载
    Function        函数扩展                                    需要使用load手动加载
    Library             类库扩展（包括ORG类库包和Com类库包） 可以配置自动加载
    Mode            模式扩展                                    入口定义后自动加载
    Model           模型扩展                                    支持自动加载
    Tool            其他扩展或工具                             不支持自动加载
    Vendor      第三方类库扩展目录                       可配置自动加载
行为扩展
    内置标签位
        app_init            应用初始化标签位
        path_info           PATH_INFO检测标签位
        route_check     路由检测标签位
        app_begin           应用开始标签位
        action_name     操作方法名标签位
        action_begin        控制器开始标签位
        view_begin          视图输出开始标签位
        view_template       视图模板解析标签位
        view_parse          视图解析标签位
        view_filter         视图输出过滤标签位
        view_end            视图输出结束标签位
        action_end          控制器结束标签位
        app_end         应用结束标签位

        每个标签位置可以配置多个行为定义, 行为的执行顺序按照定义的顺序依次执行
        还可以在应用中使用 tag() 函数添加自己的应用标签
    内置行为
        checkRoute      路由检测行为, 完成内置的路由功能
        LocationTemplate    模板定位行为, 完成模板文件自动定位和输出规则
        ParseTemplate       模板文件解析, 并支持第三方模板引擎驱动
        ShowPageTrace   页面Trace功能行为, 完成页面Trace功能
        ShowRuntime     运行时间显示行为, 完成运行时间显示
        TokenBuild          令牌生成行为, 完成表单令牌的自动生成
        ReadHtmlCache   读取静态缓存行为
        WriteHtmlCache  生成静态缓存行为
    行为定义
        1. 在 Lib/Behavior 目录下定义行为类, 继承内置的行为基础类 Behavior: 行为名称_Behavior
        2. 定义入口方法 run()
        3. 可以定义 options 属性, 该属性中的参数会自动转换成单独配置参数
    行为调用
        使用配置文件添加行为到标签位: 项目配置目录/tags.php
            return array(
                标签位=>array(行为名, 是否覆盖内置行为)
            );
        使用函数添加行为到标签位
            add_tag_behavior(标签位, 行为名)
        直接执行
            B(行为名)
类库扩展
    基类库
        目录
            Extend/Libary/ORG       第三方公共类库包
            Extend/Libary/Com   企业类库包
        导入
            import(''Com.Sina.Util.UnitTest')
    应用类库
        目录
            项目类库目录
        导入
            import()
    第三方类库
        目录
            Extend/Vendor
        导入
            Vendor()
            import('类库空间名', VENDOR_PATH)
控制器扩展
    继承: Action
    初始化方法: _initialize()
    标签位: action_begin, action_end
    Hack 方法: __hack_module(), __hack_action()
模型扩展
    支持模型
        AdvModel ViewModel RelationModel MongoModel
    模型接口
        初始化接口               全局          _initialize()
        表达式过滤接口         全局          _options_filter(&$options)
        写入前置接口          add方法       _before_insert(&$data,$options)
        写入后置接口          add方法       _after_insert($data,$options)
        更新前置接口          save方法      _before_update(&$data,$options)
        更新后置接口          save方法      _after_update($data,$options)
        数据写入接口          add、save方法  _facade($data)
        数据库切换接口         db方法            _after_db()
        删除后置接口          delete方法        _after_delete($data,$options)
        查询后置接口          select方法        _after_select(&$result,$options)
        查询后置接口          find方法      _after_find(&$result,$options)
    调用模型
        通过继承
        通过 switchModel() 方法动态切换模型
        通过 M() 实例化
驱动扩展: Extend/Driver
    数据库驱动: Db/
        继承: Db 类
        命名: Db+驱动类名称
        驱动方法
            架构方法                 __construct($config='')
            数据库连接方法         connect($config='',$linkNum=0,$force=false)
            释放查询方法          free()
            查询操作方法          query($str)
            执行操作方法          execute($str)
            开启事务方法          startTrans()
            事务提交方法          commit()
            事务回滚方法          rollback()
            获取查询数据方法        getAll()
            获取字段信息方法        getFields($tableName)
            获取数据库的表         getTables($dbName='')
            关闭数据库方法         close()
            获取错误信息方法        error()
            SQL安全过滤方法       escapeString($str)
        CURD 接口方法
            写入                  insert($data,$options=array(),$replace=false)
            更新                  update($data,$options)
            删除                  delete($options=array())
            查询                  select($options=array())
        selectSql 属性定义了当前数据库驱动的查询表达式
        可以更改或者删除个别查询定义, 或者更改某个替换字符串的解析方法
            parseTable              表名解析 %TABLE%
            parseWhere          查询条件解析 %WHERE%
            parseLimit              查询Limit解析 %LIMIT%
            parseJoin               JOIN查询解析 %JOIN%
            parseOrder              查询排序解析 %ORDER%
            parseGroup          group查询解析 %GROUP%
            parseHaving         having解析 %HAVING%
            parseDistinct           distinct解析 %DISTINCT%
            parseUnion          union解析 %UNION%
            parseField              字段解析 %FIELD%
    缓存驱动: Cache/
        继承: Cache 类
        命名: Cache+驱动类名称
        驱动接口
            架构方法            __construct($options='')
            读取缓存            get($name)
            写入缓存            set($name,$value,$expire=null)
            删除缓存            rm($name)
            清空缓存            clear()
    要让缓存驱动支持缓存队列功能, 需要在缓存接口的 set 操作方法设置成功后添加如下代码
        if($this->options['length']>0) {
               // 记录缓存队列
               $this->queue($name);
        }
    Session 驱动: Session/
        命名: Session+驱动类名称
        驱动接口
            执行入口        execute()并且在方法中调用session_set_save_handler函数指定hander操作机制
            打开Session   open($savePath,$sessionName)
            关闭Session   close()
            读取Session   read($id)
            写入Session   write($id,$data)
            删除Session   destory($id)
            Session回收   gc($maxlifetime)
    标签库驱动: TagLib/
        继承: TagLib 类
        命名: TagLib+标签库名称
        标签定义
            protected $tags   =  array(
                '标签名'=>array('attr'=>'属性1, 属性2 ...','close'=>是否闭合, 'level'=>嵌套层次, 'alias'=>别名)
            );
        解析方法定义
            public function _标签名($属性字符串,$内容字符串)   {
                    $tag    = $this->parseXmlAttr($attr,'input'); // 必须
                    < 解析并生成解析后的字符串 $str >
                    return $str;
                }
    模板引擎驱动: Template/
        命名: Template+模板引擎名
        接口方法: fetch($模板文件名, $要传入的模板变量数组)
Widget 扩展: Lib/Widget
    继承: Widget 类
    接口: render()
    调用: W()
模式扩展: Extend/Mode
    模式扩展属于系统核心级别的扩展, 可以改变底层的架构体系
    通常来说不同的模式之间是无法进行切换
    不同的分组也只能采用相同的模式扩展
    配置预定义模式: define('MODE_NAME','[ Thin | Lite | cli | amf | phprpc | rest]');
    定制模式: 定义模式扩展的定义文件
        return array(
            'core' =>   array(
                MODE_PATH.'Cli/functions.php',   // 命令行系统函数库
                MODE_PATH.'Cli/Log.class.php',
                MODE_PATH.'Cli/App.class.php',
                MODE_PATH.'Cli/Action.class.php',
            ),
            // 项目别名定义文件 [支持数组直接定义或者文件名定义]
            'alias'         =>    array(
                'Model'    =>   MODE_PATH.'Cli/Model.class.php',
                'Db'        =>    MODE_PATH.'Cli/Db.class.php',
                'Cache'         => CORE_PATH.'Core/Cache.class.php',
                'Debug'         => CORE_PATH.'Util/Debug.class.php',
            ),
            // 系统行为定义文件
            'extends'    =>    array(),
        );
=============== 安全 ===============











=============== 参考 ===============
常量
    预定义
        URL_COMMON=0
        URL_PATHINFO=1
        URL_REWRITE=2
        URL_COMPAT=3
        HAS_ONE=1
        BELONGS_TO=2
        HAS_MANY=3
        MANY_TO_MANY=4
        THINK_VERSION
        THINK_RELEASE
    路径
        CORE_PATH
        EXTEND_PATH
        MODE_PATH
        ENGINE_PATH
        VENDOR_PATH
        LIBRARY_PATH
        COMMON_PATH
        LIB_PATH
        RUNTIME_PATH
        CONF_PATH
        LOG_PATH
        CACHE_PATH
        LANG_PATH
        TEMP_PATH
        DATA_PATH
        TMPL_PATH
        HTML_PATH
    系统
        IS_CGI
        IS_WIN
        IS_CLI
        __ROOT__
        __APP__
        __GROUP__
        __URL__
        __ACTION__
        __SELF__
        __INFO__
        __EXT__
        APP_NAME
        GROUP_NAME
        MODULE_NAME
        ACTION_NAME
        APP_DEBUG
        MODE_NAME
        APP_PATH
        THINK_PATH
        MEMORY_LIMIT_ON
        RUNTIME_FILE
        THEME_NAME
        THEME_PATH
        APP_TMPL_PATH
        LANG_SET
        MAGIC_QUOTES_GPC
        NOW_TIME
        IS_GET
        IS_POST
        IS_PUT
        IS_DELETE
        IS_AJAX
配置
    应用
        APP_STATUS
        APP_FILE_CASE
        APP_AUTOLOAD_PATH
        APP_TAGS_ON
        APP_SUB_DOMAIN_DEPLOY
        APP_SUB_DOMAIN_RULES
        APP_SUB_DOMAIN_DENY
        APP_GROUP_LIST
        ACTION_SUFFIX
    默认值
        DEFAULT_APP
        DEFAULT_LANG
        DEFAULT_THEME
        DEFAULT_GROUP
        DEFAULT_MODULE
        DEFAULT_ACTION
        DEFAULT_CHARSET
        DEFAULT_TIMEZONE
        DEFAULT_AJAX_RETURN
        DEFAULT_FILTER
    Cookie
        COOKIE_EXPIRE
        COOKIE_DOMAIN
        COOKIE_PATH
        COOKIE_PREFIX
    数据库
        DB_TYPE
        DB_DSN
        DB_HOST
        DB_NAME
        DB_USER
        DB_PWD
        DB_PORT
        DB_FIELDS_CACHE
        DB_FIELDTYPE_CHECK
        DB_CHARSET
        DB_DEPLOY_TYPE
        DB_RW_SEPARATE
        DB_MASTER_NUM
        DB_SLAVE_NO
        DB_SQL_BUILD_CACHE
        DB_SQL_BUILD_QUEUE
        DB_SQL_BUILD_LENGTH
        DB_SQL_LOG
    数据缓存
        DATA_CACHE_TIME
        DATA_CACHE_COMPRESS
        DATA_CACHE_CHECK
        DATA_CACHE_TYPE
        DATA_CACHE_PATH
        DATA_CACHE_SUBDIR
        DATA_PATH_LEVEL
    错误设
        ERROR_MESSAGE
        ERROR_PAGE
        SHOW_ERROR_MSG
    日志
        LOG_RECORD
        LOG_TYPE
        LOG_DEST
        LOG_EXTRA
        LOG_LEVEL
        LOG_FILE_SIZE
        LOG_EXCEPTION_RECORD
    SESSION
        SESSION_AUTO_START
        SESSION_OPTIONS
        SESSION_TYPE
        SESSION_PREFIX
        VAR_SESSION_ID
    模板引擎
        TMPL_CONTENT_TYPE
        TMPL_ACTION_ERROR
        TMPL_ACTION_SUCCESS
        TMPL_EXCEPTION_FILE
        TMPL_DETECT_THEME
        TMPL_TEMPLATE_SUFFIX
        TMPL_FILE_DEPR
    URL
        URL_CASE_INSENSITIVE
        URL_MODEL
        URL_PATHINFO_DEPR
        URL_PATHINFO_FETCH
        REDIRECT_PATH_INFO
        REDIRECT_URL
        URL_HTML_SUFFIX
        URL_404_REDIRECT
        URL_PARAMS_BIND
    系统变量名称
        VAR_GROUP
        VAR_MODULE
        VAR_ACTION
        VAR_AJAX_SUBMIT
        VAR_TEMPLATE
        VAR_PATHINFO
        VAR_URL_PARAMS
        VAR_FILTERS
        OUTPUT_ENCODE
行为配置
    CheckRoute行为
        URL_ROUTER_ON
        URL_ROUTE_RULES
    ContentReplace行为
        TMPL_PARSE_STRING
    ParseTemplate行为
        TMPL_ENGINE_TYPE
        TMPL_CACHFILE_SUFFIX
        TMPL_DENY_FUNC_LIST
        TMPL_DENY_PHP
        TMPL_L_DELIM
        TMPL_R_DELIM
        TAGLIB_BEGIN
        TAGLIB_END
        TAGLIB_LOAD
        TAGLIB_BUILD_IN
        TAGLIB_PRE_LOAD
        TMPL_VAR_IDENTIFY
        TMPL_STRIP_SPACE
        TMPL_CACHE_ON
        TMPL_CACHE_TIME
        LAYOUT_ON
        LAYOUT_NAME
        TMPL_LAYOUT_ITEM
    ReadHtmlCache行为
        HTML_CACHE_ON
        HTML_CACHE_RULES
        HTML_CACHE_TIME
        HTML_FILE_SUFFIX
    ShowPageTrace行为
        SHOW_PAGE_TRACE
    ShowRuntime行为
        SHOW_RUN_TIME
        SHOW_ADV_TIME
        SHOW_DB_TIMES
        SHOW_CACHE_TIMES
        SHOW_USE_MEM
        SHOW_LOAD_FILE
        SHOW_FUN_TIMES
    TokenBuild行为
        TOKEN_ON
        TOKEN_NAME
        TOKEN_TYPE
        TOKEN_RESET