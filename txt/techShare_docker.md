# problem
- 开发环境本地和线上不一致
- 搭建繁琐
- 切换困难
- ...

# solution
- vm
- vagrant
- docker

# vagrant vs docker
- no OS layer
- faster
- lighter

# concepts
- AUFS
- images (read only)
- container (with write-able layer)
- registry & repository --> Docker hub

# sample - work env
1. install docker, docker-compose
2. build ubuntu, nginx, php5.6, redis and apps
3. link them
4. run
