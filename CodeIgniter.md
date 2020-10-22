# 流程图
                                                            <----> Models
                                                            <----> Libraries
                ---> Routing ---> Security --->             <----> Helpers
    index.php           |                       Controller  <----> Packages
                <--- Caching <---  View  <----              <----> Scripts
                                                            <----> Drivers
# 安装
application/config/config.php:
    1. 设置网站根目录
    2. 如果打算使用加密或 Session, 设置加密密钥

index.php: 设置 $system_path 和 $application_folder 变量

# URL:

默认: example.com/index.php/控制器类名/控制器函数或方法名/所需参数
可以通过配置 htaccess 隐藏 index.php
URL 查询字符串模式可在 config.php 中开启
路由规则可在 application/config/routes.php 里配置

# 模型 (application/models):

类名的首字母必须大写, 其他字母小写. 并且确保你的类继承了基本模型类. 文件名应该是模型类名的小写版

# 控制器 (application/controllers):

载入模型: $this->load->model('模型'[, '指定模型别名'[, 是否自动连接数据库|数据库配置数组变量]])
载入视图: $this->load->view('视图'[, 数据数组或对象[, 是否只是将结果返回给变量而不是输出到浏览器]])
载入辅助函数: $this->load->helper('辅助函数' | array('辅助函数1'[, '辅助函数2')]...)
载入类库: $this->load->library('类库' | array('类库1'[,'类库2']...)[,参数数组变量])
    //也可以传递存于配置文件中的参数. 只需简单的建立一个与类文件名相同的 config 文件并保存在 application/config 文件夹中. 此时 config 文件中的选项将不起作用
启用缓存: $this->output->cache(分钟数);
启用 | 禁用分析器:  $this->output->enable_profiler(TRUE | FALSE);
启用 | 禁用分析数据字段: this->output->set_profiler_sections(配置数组变量);

# 视图 (application/views)

# 辅助函数 (system/helpers) ---- 完成特定任务的函数

如果你想用就必须先载入它, 一旦被载入将全局(包括模型, 视图, 控制器)可用
并不返回值, 所以不要尝试将它赋给一个变量
扩展: 在 application/helpers/ 目录下创建一个以 MY_ 开头(可以配置)+原有Helper名字 的新 Helper

# 类库 (system/libraries) ---- 完成特定任务的类

除了数据库类无法被扩展或替换, 其他类均可
如果想在自定义类库中使用 CI 原始资源, 可以像这样得到一个 CI 超级对象
    $CI =& get_instance()
替换原始类库: 在 application/libraries 下建立一个与原始类同名的类文件
扩展原始类库: 在 application/libraries 下建立一个以 MY_开头(可以配置)+原始类名 为名的类文件并继承原始类

# 适配器 (system/libraries) ---- 用于完成特定功能的类库集

创建适配器要遵循以下目录结构

    /application/libraries/Driver_name
        |-  Driver_name.php
        |-  drivers/
            |-  Driver_name_subclass_1.php
            |-  Driver_name_subclass_2.php
            |-  Driver_name_subclass_3.php

# 系统核心类(system/core) ---- 每次 CI 启动时被自动调用

包括: Benchmark Config Controller Exceptions Hooks Input Language Loader Log Output Router URI Utf8
替换核心类: 在 application/core 下建立和要替换的类同名的类文件
扩展核心类: 在 application/core 下建立 MY_(可配置)+要扩展的类名 为名的类并扩展自原始核心类类

# 钩子 (application) ---- 在特定时刻被触发的脚本

挂钩点
- pre_system
- pre_controller
- post_controller_constructor
- post_controller
- display_override
- cache_override
- post_system

定义格式 (可以定义多维数组以在同一个挂钩点多次引用脚本)
    $hook['挂钩点'] = array(
        'class'    => 'MyClass',
        'function' => 'Myfunction',
        'filename' => 'Myclass.php',
        'filepath' => 'hooks',
        'params'   => array('beer', 'wine', 'snacks')
        );

# 自动装载 (application/config/autoload.php ) ---- 整个应用程序中全局使用

可以自动装载的资源: libraries helper config system/language models

# 公共函数 ( system/core/Common.php ) ---- 任何情况下你都能够使用这些函数, 不需要载入任何类库或辅助函数

is_php('version_number')
is_really_writable('path/to/file')
config_item('item_key')
show_error('message')
show_404('page')
log_message('level', 'message')
set_status_header(code, 'text')
remove_invisible_characters($str)
html_escape($mixed)

# 错误处理

show_error('消息' [, int $status_code = 500 ] [, string $heading = 'An Error Was Encountered'])
show_404('页面' [, 'log_error'])
log_message('{error|debug|info}', 'message')

# 缓存 (application/cache)

# 分析器

可用字段
- benchmarks                    在各个计时点花费的时间以及总时间
- config                            CodeIgniter 配置变量
- controller_info                   被调用的method及其所属的控制器类
- get                               在request中传递的所有GET参数
- http_headers                  本次请求的 HTTP 头
- memory_usage                  本次请求消耗的内存（byte为单位）
- post                          在request中传递的所有POST参数
- queries                           列出执行的数据库操作语句及其消耗的时间
- uri_string                        本次请求的URI
- query_toggle_count             指定显示多少个数据库查询语句，剩下的则默认折叠起来




