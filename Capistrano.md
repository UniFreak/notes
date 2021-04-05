自动部署. 维护 5 个或更多应用, 通过 current/ 符号链接指向当前版本以及快速回滚

# Install

gem install capistrano

# Config

初始化: cap install
    会创建 Capfile, config/ 和 lib/

    Capfile         核心配置文件, 聚合 config/ 目录中的配置文件
    config/
        deploy/     各个远程服务器环境 (测试, 过渡, 生产...) 的配置文件
            production.rb
            staging.rb
        deploy.rb   所有环境通用设置
    lib/
        capistrano/
            tasks/

Capistrano 会区分服务器角色, 如生产环境有前置 web 服务器 (web 角色), 应用服务器 (app 角色)
和数据库服务器 (db 角色). 角色的作用是把相关任务组织在一起.

# Auth

SSH

# 准备远程服务器

