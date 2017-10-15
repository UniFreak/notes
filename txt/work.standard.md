- 依据 psr1, psr2, 借鉴其他公司(百度-张阳阳), 参考 laravel 框架
- 不做解释, 如有疑问单独探讨
- 本次会议**确定**规范, 并后续跟进执行
- 关于遗留代码: 与其风格保持一致, 适时迁移

# 流程

# 代码

## 风格

### 文件
- PHP 代码文件必须以 `<?php` 标签开始
- 纯 PHP 代码文件必须省略最后的 `?>` 结束标签
- PHP 代码文件必须以不带 BOM 的 UTF-8 编码
- 所有 PHP 文件必须使用 Unix LF (linefeed) 作为行的结束符
- 每行的字符数最好保持在 80 个之内,  一定不可多于 120 个
- 代码必须使用 4 个空格符的缩进, 不能用 tab 键

### 语句
- PHP 所有关键字必须全部小写(尤其注意 `true`, `false`, `null`)
- 不要使用关键字 `var` 声明一个属性
- 使用 `elseif`, 而非 `else if`
- 使用 `&&` 或 `||`, 而非 `and` 或 `or`
- 单行注释使用 `//` 而非 `#`
- 使用 `[]` 定义数组
- 有默认值的参数, 必须放到参数列表的末尾

### 命名
- 不要对 `protected` 和 `private` 的属性或方法使用前缀下划线
- 类的命名必须遵循 `StudlyCaps` 大写开头的驼峰命名规范
- 类中的常量所有字母都必须大写, 单词间用下划线分隔
- 方法名称必须符合 `camelCase` 式的小写开头驼峰命名规范
- 使用统一的块注释以及 tag

### 空白
- 不要省略控制结构的花括号
- 类和方法的开始花括号 `{` 自成一行, 控制结构的开始花括号 `{` 与声明同行
- 控制结构的关键字后必须要有一个空格符, 而调用方法或函数时则一定不能有
- 控制结构中的小括号两边使用空格, 函数参数之间使用空格分开, 操作符与操作数使用空格分开, 注释符号后面使用空格
- 函数定义及调用的小括号之前不要空格
- 正确缩进, 正确折行, 注释要与被注释代码的对齐 (参见示例代码)

### 示例

```php
<?php
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
            [4, 5, 6]
        ]
    ) {
        // comments on this level
        if ($veryLongVariable1 === $veryLongVariable2
            && $veryLongVariable3 > $veryLongVariable4
            || $veryLongVariable5
        ) {
            // comments on this level
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
                    break;
                case 1:
                    echo 'case 1';
                    // no break
                default:
                    echo 'default';
                    break;
            }
        }
    }
}
```


## 惯例用法

- 直接返回判断语句, 不用使用三目运算符决定返回 `true` 或 `false`

```php
<?php
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
<?php
// 不必要:
// if (isset($var) && !empty($var)) {
//      
// }
if (!empty($var)) {
    
}
```

- 早点 return, 以减少不必要嵌套层次

```php
<?php
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

## 安全

# 框架使用

## 代码位置
- `Library`: 不受 composer 管理的第三方库或自定义库
- `Services`: 系统服务
- 分文件夹的话不要直接在 `app\` 目录下分(反例: credit 项目的 Models)

# 项目使用
api.fin 唯一对外提供金融服务

api.fin -> credit/trade/paysys

# 领域名词

- 制定流程: 产品提议 -> 开发决策 -> 文档化
- yooli ul yoli...
- super, cr...

# 数据库

