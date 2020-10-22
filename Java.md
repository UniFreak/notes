# See
- Book: Core Java E.11

# Intro

@todo

# Env
JRE: Runtime Enviroment
JDK: Development Kit
JShell: REPL

Edition:
- Server JRE, SE
- Standard Edition, SE
- Enterprise Edition, EE
- Micro Edition, ME

Command:
- javac
- java
JDK 11 中, 单文件支持 shebang, 可以直接 java 运行

# Basic

## Structure

区分大小写
逻辑代码必须放在类中
源代码文件名必须与公共类同名
源文件中必须包含一个静态的 main 方法
使用分号结束

## Comment

//

/* */

/**
 *
 */

## Data Type

强类型, 8 种: 4 整, 2 浮点, 1 字符

- 整形

|type|bytes|range|
|------|------|------|
|int|4|-2 147 483 648 ~ 2 147 483 647|
|short|2|-32767 ~ 32767|
|long|8|-9 223 372 036 854 775 808 ~ 9 223 372 036 854 775 807|
|byte|1|-128 ~ 127|

l / L
0x / 0X
0
0b / 0B

可以为数字字面量加下划线: `1_000_000`, 易读
八进制易混淆, 避免使用
没有任何无符号形式, 可使用 `.toUnsignedInt(b)` 之类的方法

- 浮点型

|type|bytes|range|
|------|------|------|
|float|4|+-3.402 823 47E+38F|
|double|8|+-1.797 693 134 862 315 70E+308|

F / f
D / d / 默认

十六进制表示法中, 使用 p 而非 e 表示指数

`Double.POSITIVE_INFINITY`
`Double.NEGATIVE_INFINITY`
`Double.NaN`

NaN 不等于 NaN
不允许有舍入误差的地方应该使用欧冠 BigDecimal 类

- char

单引号

转义序列: \u, \b, \t, \n, \r, \", \', `\\`
转义序列在解析代码之前处理: 当心注释中的 \u

不建议使用 char 类型, 除非确实需要处理 UTF-16 代码单元
最好将字符串作为抽象数据类型处理

- boolean

整型和布尔值不能转换: `if (x = 0)` 会报错

## 变量与常量


```java
// # 变量
// 声明尽可能靠近第一次使用的地方
int vacationDays; // 避免使用 $
double i, j; // 不提倡同时声明多个
var greeting = "Hello"; // 对于局部变量, 使用 var 可以无需指定类型, 由初始值自动推断
System.out.println(notDefined); // 使用未初始化的变量会报错

// # 常量
final double CM_PER_INCH = 2.54; // 使用 final, const 是保留字但 java 未使用
public static final CM_PER_INCH = 2.54; // 使用 static final 设置类常量

// # 枚举
enum Size { SMALL, MEDIUM, LARGE };
Size s = Size.MEDIUM;
```

## 运算符

