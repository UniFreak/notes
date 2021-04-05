# PHP

```php
$a = '1';
$b = &$a;
$b = "2$b";
echo $a.",".$b; // 21,21
```

```php
function handle() {
    try {
        echo 1;
        throw new \Exception();
        echo 2;
    } catch (\Exception $e) {
        echo 3;
        return;
    } finally {
        echo 4;
    }
}
handle(); // 134        注意, 即使 return 了, 4 也会输出
```

```php
$a = new \StdClass();
$a->foo = "bar";
$b = clone $a;
echo $a === $b ? 1 : 2; // 2    === identity comparison
```

```php
// Prior to PHP8
echo (int) "12abc"; // 12
var_dump(0 == "a"); // 0 == 0 -> true
var_dump("1" == "01"); // 1 == 1 -> true
var_dump("10" == "1e1"); // 10 == 10 -> true
var_dump(100 == "1e2"); // 100 == 100 -> true

switch ("a") {
case 0:
    echo "0";
    break;
case "a": // never reached because "a" is already matched with 0
    echo "a";
    break;
}
```

```php
echo ('password123' == 0) ? 'true' : 'false'; // true
```

```php
class Car {
    public static function run() {
        return static::getName();
    }
    private static function getName() {
        return 'Car';
    }
}
class Hongqi extends Car {
    public static function getName() {
        return 'Hongqi';
    }
}
echo Car::run(); // Car
echo Hongqi::run(); // Hongqi
```

# 数据库

1. 复合索引 index('a', 'b', 'c'). 以下查询能用到什么索引?

where a = 1 and b = 2;  // a, b
where b = 2 and a = 1;  //
where a = 2 and c = 1;
where b = 2 and c = 1;

2. 统计表 log(id, uid, ip, date, url)

- 统计 2019-08-09 这天, 访问次数最多的 ip 地址及其访问次数

`select *, count(*) from log where date='2019-08-09' group by ip order by count(*) desc limit 1;`


- 统计每天访问次数最多的 ip 地址及访问次数

```sql
SELECT date, ip, count(*) AS c
FROM log AS t1
GROUP BY date, ip
HAVING count(*) = (
    SELECT count(*) FROM log
    WHERE date=t1.date -- 这里条件不要加 ip
    GROUP BY date, ip
    ORDER BY count(*) DESC LIMIT 1
);
```
