# See

official site: <https://derickrethans.nl/projects.html#>

output: <https://gywbd.github.io/posts/2016/2/vld-opcode.html>

# Concetp

VLD: Vulcan Logic Dumper

# Option 

use `php -dvld.opt=val`

- active: 是否激活 vld
- execute: 是否执行
- verbosity=1: 详细输出
- dump_paths=1: 输出分支和路径信息
- save_paths=1: 保存分支和路径信息到 /tmp (可使用 dot 绘制图形)
- save_dir: 指定保存路径
- format: 自定义格式输出
- col_sep: 间隔字符, 默认 \t
- skip_append: 跳过 auto_append_file 文件
- skip_prepend: 跳过 auto_prepend_file 文件

# Output

line: 行号
`#*`: opcode 执行序号. 如果形如 8*, 代表不可达代码
op: opcode
return: opcode 执行后的返回结果
operands: opcode 执行时的参数

Zend 引擎一共支持 5 种操作数类型:
- IS_CV 编译变量, 表示一个PHP变量, 以!0、!1形式出现
- IS_VAR: 引擎内部使用的变量, 以 $0、$1、$2 形式出现
- IS_TMP_VAR: 引擎内部使用的变量, 不能被其他的 OPCode 重用, 以~0、~1、~2 形式出现
- IS_CONST: 字面量, 以常量值的形式出现
- IS_UNUSED: 操作数没有被使用


