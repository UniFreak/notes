- 依据 psr1, psr2, 参考 laravel 框架和 phpcs sniffs 及 phpmd ruleset
- 关于遗留代码: 与其风格保持一致, 适时迁移

# 好的规范
1. 描述简短精确, 非黑即白, 没有模棱两可的定义
2. 既要考虑格式方面的东西, 又要考虑如何"让错误的代码看起来就是错误的"以及设计方面的问题

# 规范

## 风格

### 文件
- PHP 代码文件必须以 `<?php` 标签开始
- 纯 PHP 代码文件必须省略最后的 `?>` 结束标签
- PHP 代码文件必须以不带 BOM 的 UTF-8 编码
- 所有 PHP 文件必须使用 Unix LF (linefeed) 作为行的结束符
- 每行的字符数最好保持在 80 个之内,  一定不可多于 120 个
    - small screen, terminal screen
    - human cognitive limitation
- 代码必须使用 4 个空格符的缩进, 不能用 tab 键
    - helps to avoid problems with diffs, patches, SVN history and annotations
    - display consistency

### 语句
- PHP 所有关键字必须全部小写(尤其注意 `true`, `false`, `null`)
- 不要使用关键字 `var` 声明一个属性
- 使用 `elseif`, 而非 `else if`
- 使用 `&&` 或 `||`, 而非 `and` 或 `or`
- 单行注释使用 `//` 而非 `#`
- 使用 `[]` 定义数组
- 有默认值的参数, 必须放到参数列表的末尾
- 一个函数不得超过 500 行，建议控制在 100 行以内


### 命名
- 不要对 `protected` 和 `private` 的属性或方法使用前缀下划线
- 类的命名必须遵循 `StudlyCaps` 大写开头的驼峰命名规范
- 类中的常量所有字母都必须大写, 单词间用下划线分隔
- 方法名称必须符合 `camelCase` 式的小写开头驼峰命名规范
- 使用统一的块注释以及 tag
- 不要使用令人困惑的缩写 (com_ins ?)

### 空白
- 不要省略控制结构的花括号
- 类和方法的开始花括号 `{` 自成一行, 控制结构的开始花括号 `{` 与声明同行
- 控制结构的关键字后必须要有一个空格符, 而调用方法或函数时则一定不能有
- 控制结构中的小括号两边使用空格, 函数参数之间使用空格分开, 操作符与操作数使用空格分开, 注释符号后面使用空格
- 函数定义及调用的小括号之前不要空格
- 正确缩进, 正确折行, 注释要与被注释代码的对齐 (参见示例代码)

### 注释

- @todo

### 示例

```php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements
    FooInterface,
    \ArrayAccess,
    \Countable,
    \Serializable
{
    const DATE_APPROVED = '2012-06-01';

    public $foo = null;
    protected static $bar;

    abstract protected function zim();

    /**
     * function description
     *
     * @author  authorName <email:example@xin.com, phone:1553****861>
     * @todo    refacotor: some refactor idea
     *
     * @param   ClassTypeHint parameter description
     * @param   string        arg2 parameter description
     * @return  mixed         return description
     */
    final public static function aVeryLongMethodName(
        ClassTypeHint $arg1,
        &$arg2,
        array $arg3 = [
            [1, 2, 3],
            // keep the tailing comma even at the last item
            [4, 5, 6],
        ]
    ) {
        // comments at the same level with code block
        if ($veryLongVariable1 === $veryLongVariable2
            // operator at beginnig
            // easier to comment (and exclude) the condition
            && $veryLongVariable3 > $veryLongVariable4
            || $veryLongVariable5
        ) {
            return $isThisVeryLongVariableTrue
                ? $yes
                : $no;
        } elseif ($a > $b) {
            $foo->bar(
                $longArgument,
                $longerArgument,
                $muchLongerArgument
            );
        } else {
            switch ($a) {
                case 0:
                    echo 'case 0';
                    // break inside case
                    break;
                case 1:
                    echo 'case 1';
                    // explicitly comment no break here
                    // no break
                default:
                    echo 'default';
                    break;
            }
        }
    }
}

// function call chaining
$someObject->someFunction("some", "parameter")
    ->someOtherFunc(23, 42)
    ->andAThirdFunction();
// long assignment
$GLOBALS['TSFE']->additionalHeaderData[$this->strApplicationName]
    = $this->xajax->getJavascript(t3lib_extMgm::siteRelPath('nr_xajax'));
```


## 代码结构
- `Library`: 不受 composer 管理的第三方库或自定义库
- `Services`: 系统服务, 模块儿
- 分文件夹的话不要直接在 `app\` 目录下分(反例: credit 项目的 Models)
- `vendor`: 不应该受版本管理工具管理, 更不应改动里面的任何东西

## 错误处理
- when silencing the exception, logging or warning should occur
- no exception should reach the end-user, so there is no need for concern about technical complexity in the exception error messages
- Exceptions should never be used as normal program flow
- 1. Errors detected during precondition checks should contain a description of the failed check. If possible, the description should contain the violating value
- 2. Errors signaled via return codes by lower level libraries, if unrecoverable, should be turned into exceptions. The error description should try to convey all information contained in the original error
- 3. Lower library exceptions, if they can't be corrected, should either be rethrown or bubbled up
- Exceptions should be bubbled up, except in these two cases:
    + The original exception is from another package. Letting it bubble up would cause implementation details to be exposed, violating layer abstraction, conducing to poor design.
    + The current method can add useful debugging information to the received error before rethrowing



## 惯例用法

- 短路运算?
- 诡异缩写?
- 局部变量重新赋值?
- 无用注释?
- 符号对齐?
- 使用 `(string)` 而非 `strval()`
- 避免使用
    + 全局变量
    + `extract()`
    + `eval()`
- 尽量使用 `type hint`

- 直接返回判断语句, 不用使用三目运算符决定返回 `true` 或 `false`

```php
function isActive($person)
{
    // 不必要:
    // return ($person['isAlive'] && $person['talkCount'] > 3)
    //       ? true
    //       : false;
    return $person['talkCount'] > 3 && $person['isAlive'];
}
```

- `!empty($var)` 就够了

```php
// 不必要:
// if (isset($var) && !empty($var)) {
//
// }
if (!empty($var)) {

}
```

- 早点 return, 以减少不必要嵌套层次

```php
function isActive($person)
{
    // 嵌套太多:
    // if ($person['isAlive']) {
    //     // long code...
    //     // wondering what `else` will do...
    //     if ($person['talkCount'] > 3) {
    //          // another nesting
    //      }
    // } else {
    //     return false;
    // }

    if (! $person['isAlive']) {
        return false;
    }

    // long code...
    if ($person['talkCount'] > 3) {

    }
}
```

- 使用有意义的循环变量

```php
// 难读:
// foreach ($payments as $k => $v) {
//    foreach ($v as $data) {
        // ...
//    }
// }
foreach ($payments as $payId => $payment) {
    foreach($payment as $fee) {
        // ...
    }
}
```

## 安全

- 参考
    + OWASP: https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet
    + security-general.md
    + security-PHP.md

### Language
- turn up error reporting as high as possible
- never attempt to suppress error messages
- Try to use functions and operators that do not do implicit type conversions

### Untrusted data
- All data that is a product, or subproduct, of user input is to NOT be trusted. They have to either be validated, using the correct methodology, or filtered, before considering them untainted
- when saving uploaded files, the content and filename are appropriately sanitised
- use finfo class to validate file types
- Using $_REQUEST is strongly discouraged

### Injection
- Never build up a string of SQL that includes user data, use prepared statements and bound parameters
- Don't rely on `mysql_real_escape_string` for your SQL injection prevention
- Use UTF-8 as your database and application charset
- Never pass tainted input to these `eval`, `shell_exec`, `exec`, `passthru`, `system` functions
- `preg_replace()` should not be used with unsanitised user input, because the payload will be eval()'ed

### XSS
- `htmlspecialchars` is not recommended
- use a template engine that applies HTML escaping **by default**
- When you need to allow users to supply HTML tags that are used in your outpu, use a Secure Encoding library (HTMLPurifier)

### CSFR

### Session & Auth

## 性能

- 参考: https://www.jianshu.com/p/d29f7222e7e6

## 日志

# 工具

## 参考
- https://en.wikipedia.org/wiki/List_of_tools_for_static_code_analysis

## IDE/编辑器内置自动化工具
- phpStorm: live template/macro
- sublimeText: 插件: Sublime Tmpl/DocBlockr/snippet/macro

## ~~EditorConfig(https://editorconfig.org/)~~
- 根据文件名匹配应用规则
- 跨编辑器, 且某些编辑器内置支持 editorConfig 配置
- 否则需要安装插件
- 各编辑器对配置的属性支持不一致(@seeDoc)

## ~~PHPcheckStyle~~

## PHPCS(https://github.com/squizlabs/PHP_CodeSniffer)
- 包含 phpcs(检测) 和 phpcbf(code beautifier and fixer, 修复)
- 使用配置的规范定义文件集合(sniff file)检测不符合规范的代码, 并自动修复
- 默认使用 pear 代码规范
- 可自定义规范规则
- 基本用法: `phpcs|phpcbf file`

## PHP-CS-Fixer(https://github.com/FriendsOfPHP/PHP-CS-Fixer)
- 类似 phpcbf
- 自定义规则属性
- 基本用法: `php-cs-fixer.phar fix path/file --rules(@seeDoc)`
- vs PHPCS: https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/3459

## PHPDepend(https://pdepend.org)
- 分析并给出软件度量(@seeDoc), 并给出图表
- 基本用法: `pdepend options source`

## PHPMD(https://phpmd.org)
- 类似 java PMD
- 相当于 PHP Depend 配置前端
- 支持的预定义规则(@seeDoc)有限, 但是可以扩展
- 基本用法: `phpmd sourceCode resultFormat ruleSet`
- @SuppressWarning(PHPMD)

## PMD's CPD(https://pmd.github.io/pmd-5.6.1/usage/cpd-usage.html)
- 根据字符匹配查找重复代码
- 基本用法: `./run.sh cpd --minimum-tokens 100 --files /path/to/c/source --language cpp`

## progpilot(https://github.com/designsecurity/progpilot)
- 根据定义的解析规则和安全配置找出存在安全隐患的代码
- 可自定义解析规则(@seeDoc)
- 占用内存高
- 基本用法:

        ```php
        require_once './vendor/autoload.php';

        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        $context->inputs->set_file("source_code1.php");

        $analyzer->run($context);
        $results = $context->outputs->get_results();

        var_dump($results);
        ```

## RIPS(https://www.ripstech.com/)
- 分为开源版/商业版
- 快速
- 支持 15/40 项安全漏洞检测 (https://en.wikipedia.org/wiki/RIPS)
- web 输出结果, 自动生成修复建议
- 误判率高/低
- 不支持/支持集成到开发周期

## Pixy(https://github.com/oliverklee/pixy)

# 自动化

## 一般来说
1. 为每个项目增加 `composer require phpcs/phpmd` 依赖
2. 使用 composer 的 `post-install-cmd` 配合 `setup.sh` 和 `composer install` 添加 `pre-commit` 挂钩
3. 提交时自动运行 md/cs 检测
4. 服务端配置 CI/自动构建任务, 强制检测

## 由于 `vendors/` 被 git 管理, 且没有自动构建流程:
1. 扩展 phpcs/phpmd 并封装成 composer 包
2. 配置 `pre-commit` 挂钩
4. 使用服务端 `update` 挂钩强制检测


# 项目使用
- `api.fin` 唯一对外提供金融服务

# 领域名词

- yooli ul yoli? super, cr?
- 制定流程: 产品提议 -> 开发决策 -> 文档化
- 缩写

# 数据