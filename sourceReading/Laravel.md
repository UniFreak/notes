# See
- Book: Laravel 核心技术

# Plan

## 关注点
- 实现
- 设计模式
- 编程惯例
- 应用
- ...

## 输出
- 博文
- 技术分享

# Implementatioin

## Autoloading

1. PSR4, PSR1,class_map, file -> composer (p.46)
2. Facade/Alias -> `AliasLoader.php::prependToLoaderStack()` (p.48)

Tech: Composer, PSR, `class_alias()`, `spl_autoload_register()`

## IoC


## Route
## Middleware
## MVC
## Request Handle
## Query Builder
## Eloquent ORM
## Migration
## Error & Exception
## Blade template engine
## Message Queue
## Event
## Command
## Cron
## Artisan
## Pipe
## Facade
## Env
## Multi Language
## Session


# 命名
- `callbacksPerType`: `per` 用于指示数组键名
- `nomalizeSomething`: 标准化数据
- `sanitiseSomething`: 净化数据
- `resolveSomething`: 解析数据

# 模式
- Factory
- Event

# Composer autoload
- 四种: psr0, psr4, classmap, file
- 什么时候生成的各种 vendor/composer/autoload_* 配置文件
    + composer install/update 或手动 composer dump-autoload 的时候
    + psr-0/4 方便, classmap 性能高. 会自动转换为 classmap
    + psr0 -> autoload_namespaces.php
    + psr4 -> autoload_psr4.php
    + classmap -> autoload_classmap.php
- 如何生成: Installer:290 -> AutoloadGenerator:388
- composer.json 为什么 psr4 只有 app 这个, 但是其他空间都能正常加载
    + 因为其他空间都在 app 下...
    + 如果要添加其他 app 外命名空间:
        1. 在 composer.json 里面加入映射关系
        2. 运行 composer dump-autoload
- 什么时候用到的: 找类文件的时候
- 如何用
    + index -> bootstrap/autoload -> vendor/autoload
    + composer/autoload_real::getLoader: 配置, 注册
    + 找文件: composer/ClassLoader::loadClass()
- 模式:
    + command?
    + autoload_real::getLoader() 工厂, 单例
- coodie:

```
$regexPattern = sprintf('/^
    %1$s          # match a quote at the start of the value
    (             # capturing sub-pattern used
     (?:          # we do not need to capture this
      [^%1$s\\\\] # any character other than a quote or backslash
      |\\\\\\\\   # or two backslashes together
      |\\\\%1$s   # or an escaped quote e.g \"
     )*           # as many characters that match the previous rules
    )             # end of the capturing sub-pattern
    %1$s          # and the closing quote
    .*$           # and discard any string after the closing quote
    /mx', $quote);
```

```
// init a variable while passing it as parameter, use it later in function block
if (file_exists($file = ...)) {
    return $file;
}
```

```
call_user_func(Class::getIniter());
// and getIniter() will return a Closure
```

```
// @?
return \Closure::bind(function () use ($loader) {
    ...
}, null, ClassLoader::class)
```

```
public function addOptions($options = array())
{
    foreach ($options as $option) {
        $this->addOption($option);
    }
}
```

```
// 1. read like prose, 2. 客制化是否抛异常 (GuzzleHttp)
// @throws \Exception When running fails. Bypass this when {@link setCatchExceptions()}.
```

```
if(true === $input->hasParameterOption(array('--ansi'))) {}
```

```
// @see: https://stovepipe.systems/post/using-bitwise-instead-of-booleans
$types = self::OUTPUT_NORMAL | self::OUTPUT_RAW | self::OUTPUT_PLAIN;
$type = $types & $options ?: self::OUTPUT_NORMAL;
```

```
composer: run() -> doRun() -> doRunCommand()
dventDispathcer: dispatch() -> doDispatch()
output: writeln() -> write() -> doWrite()
```

```
list($res, $devPackages) = $this->doInstall();
// and doInstall() will returan an array [$res, $devPackages]
```

```
const STABILITY_STABLE = 0;
const STABILITY_RC = 5;
const STABILITY_BETA = 10;
const STABILITY_ALPHA = 15;
const STABILITY_DEV = 20;

public static $stabilities = array(
    'stable' => self::STABILITY_STABLE,
    'RC' => self::STABILITY_RC,
    'beta' => self::STABILITY_BETA,
    'alpha' => self::STABILITY_ALPHA,
    'dev' => self::STABILITY_DEV,
);
```

```php
// the way to do cross-line ?:
return isset($fetchArgument) ?
    $statement->fetchAll($me->getFetchMode(), $fetchArgument, $me->getFetchConstructorArgument()) :
    $statement->fetchAll($me->getFetchMode());
```

# 路由
- 为什么用引用 event? 何时用到?
- 如何生路路由规则?
    + basic, match, any, group
    + closure, controller, middleware
    + parameter, constraint
- 怎么匹配?
- coodie:

    ```
    // comments about if
    if (is_callable($action)) {
        return ['uses' => $action];
    }

    // and about elseif
    elseif (! isset($action['uses'])) {
        $action['uses'] = static::findCallable($action);
    }
    ```

    ```
    $manager->addConnection(require '../config/database.php');
    ```