# Concept

## Union File System

Docker images are stored as series of read-only layers. When we start a container, Docker takes the read-only image and adds a read-write layer on top. If the running container modifies an existing file, the file is copied out of the underlying read-only layer and into the top-most read-write layer where the changes are applied. The version in the read-write layer hides the underlying file, but does not destroy it — it still exists in the underlying layer. When a Docker container is deleted, relaunching the image will start a fresh container without any of the changes made in the previously running container — those changes are lost. Docker calls this combination of read-only layers with a read-write layer on top a Union File System.

## volume

In order to be able to save (persist) data and also to share data between containers, Docker came up with the concept of volumes

volumes are directories (or files) that are outside of the default Union File System and exist as normal directories and files on the host filesystem

## image

a lightweight, stand-alone, executable package that includes everything needed to run a piece of software, including the code, a runtime, libraries, environment variables, and config files


## container

a runtime instance of an image

## service

defines how containers behave in production

## stack

defining the interactions of all the services

## repository

is a collection of images

## registry

is a collection of repositories. `docker` CLI uses Docker’s public registry by default

## service

In a distributed application, different pieces of the app are called “services.” Services are really just “containers in production.” A service only runs one image, but it codifies the way that image runs—what ports it should use, how many replicas of the container should run so the service has the capacity it needs, and so on.

## swarm

a group of machines that are running Docker and joined into a cluster

## node

The machines in a swarm can be physical or virtual. After joining a swarm, they are referred to as nodes

## stack

a group of interrelated services that share dependencies, and can be orchestrated and scaled together

## volume

## networking

- bridge: for small network on a single host
    1. The containers you launch into this network must reside on **the same Docker host**
    2. Each container in the network can immediately communicate with other containers in the network
    3. Though, the network itself **isolates the containers from external networks**

- overlay

# Config

- Dockerfile
- .dockerignore
- docker-compose.yml

# Directives

- FROM <image>|<image>:<tag>
- MAINTAINER <name>: 制定维护者
- WORKDIR: 设置工作目录, 会被 docker run -w 覆盖
- ENV <key> <value>: 设置环境变量, 能被后续 RUN 指令使用
- ENTRYPOINT: 配置容器启动后执行的命令. 可以通过 `run --entrypoint` 覆盖
    + `ENTRYPOINT ["executable", "param1", "param2"]`
    + `ENTRYPOING command param1 param2`: shell 中执行
- CMD: 配置容器启动后执行的命令(最后一条生效). 可以通过 `run` 后面的参数覆盖
    + `CMD ["executable", "param1", "param2"]`: 使用 exec 执行, 推荐
    + `CMD command param1 param2` 在 bin/bash 中执行, 适用于需交互的应用
    + `CMD ["param1", "param2"]` 为 ENTRYPOINT 提供默认参数
- USER: 使用哪个用户运行镜像, 默认 root
- VOLUME ["/data"]: 创建挂载点

    anything after the VOLUME instruction in a Dockerfile will not be able to make changes to that volume

- ADD <src> <dest>: 复制 Dockerfile 相对路径上的文件或目录到容器指定位置, 会自动解压
- COPY <src> <dest>: 同 ADD, 不会自动解压
- EXPOSE <port> [<port>...]: 暴露端口, 见 `docker run --expose`
- PUBLISH: publish port, see `docker run --publish`
- LABEL: 添加元数据
- STOPSIGNAL: 容器停止时发送的信号
- ARG: 指定构建运行时的变量, 与 `docker build --build-arg` 配合使用
- ONBUILD: 制定当次镜像作为其他镜像的基础镜像时, 所执行的操作指令

# Dockerfile best practice

see: https://docs.docker.com/engine/userguide/eng-image/dockerfile_best-practices

- Containers should be ephemeral
- Use a .dockerignore file
- Avoid installing unnecessary packages
- Each container should have only one concern
- Minimize the number of layers
- Sort multi-line arguments
- cache busting: Always combine RUN apt-get update with apt-get install in the same RUN statement

# Commands

## `docker`

- help
- info

- create: 创建容器, 新创建的容器处于停止状态, 需 start
- start
- restart
- import
- export
- run: 等价于 create && start
    + i: 保持标准输入始终打开
    + t: 分配一个伪终端(pseudo-tty)并绑定到容器的标准输入上
    + name
    + d: detached mode
    + log-driver "syslog"|"none"|"json-file"
    + restart=always|on-failure:<num>
    + expose
    + p: 手动绑定端口
    + P: 动态绑定所有可暴露端口
    + w: working dir
    + e: env
    + v: volume
    + volumes-from <container>: share volume from <container>
    + net: network type
        * none: adds a container on a container-specific network stack
        * host: adds a container on the host’s network stack
    + dns
    + dns-search
    + dns-option
    + network
    + network-alias
    + add-host <hostname>:<ip>
    + mac-address
    + ip
    + h: hostname
    + ip6
    + link-local-ip
    + driver <type> <name>: user defined network type
        * bridge
    + link <container>:<alias>
    + priviliged: grant root access to host machine
    + rm: once ran, auto remove volumes
- update:
    + restart
- exec
    + i: input
    + t: output
    + d: daemon
- attach(use ctrl+q/p to detach)
- stop
- kill
- rm
    + f: force
    + l: rm link only
    + v: rm volume
- logs
    + f: follow
    + t <num>: tail
- top
- stats
- ps
    + n <num>: recent <num> ones
    + l: last
    + q: id
    + a: all
- port

- images
    + f
        * dangling=true
- pull
- push
- inspect
    + f: format
- search
    + automated
    + no-trunc
    + stars
- commit <containerId> <image>: 提交对容器的更改到新的镜像
    + a: list author info
    + m: message
- tag
- diff <containerId>: 查看对镜像做的更改: A:added, C:changed, D:deleted
- build
    + f: from file(Dockerfile)
    + t: target
    + no-cache: don't use build cache
    + --force-remove: always remove intermediate containers
    + q: supress verbose output
    + rm: remove intermediate containers after
- history   
- save
- load
- rmi

- login
- logout
- swarm init
- swarm join
- swarm leave

- stack deploy
- stack ps
- stack rm

- node ls

- network ls
- network create <name>
    + attachable    false   Enable manual container attachment
    + aux-address   map[]   Auxiliary IPv4 or IPv6 addresses used by Network driver
    + config-from       The network from which copying the configuration
    + config-only   false   Create a configuration only network
    + driver, -d    bridge  Driver to manage the Network
    + gateway       IPv4 or IPv6 Gateway for the master subnet
    + ingress   false   Create swarm routing-mesh network
    + internal  false   Restrict external access to the network
    + ip-range      Allocate container ip from a sub-range
    + ipam-driver   default IP Address Management Driver
    + ipam-opt  map[]   Set IPAM driver specific options
    + ipv6  false   Enable IPv6 networking
    + label     Set metadata on a network
    + opt, -o   map[]   Set driver specific options
    + scope     Control the network’s scope
    + subnet        Subnet in CIDR format that represents a network segment
- network inspect <name>
- network connect <net> <container>
- network disconnect <net> <container>
- network rm <name>
- network prune

- volume create
- volume inspect
- volume ls
- volume prune
- volume rm

## `docker-machine`

`Docker Machine` is a tool for provisioning and managing your Dockerized hosts (hosts with Docker Engine on them)

- create
- ssh 
- ls
- scp

## `docker-compose`

- help <cmd>
- up
    + d: daemon mode
- ps
- logs
- stop
- kill
- rm

# Best Practice

- 使用 **数组** 语法设置要执行的命令
- 不要使用 ARG 传递证书或秘钥
- 使用 --priviliged 模式会有安全风险, 
- 可以使用 nsenter 进入容器的 shell 或者使用 `docker exec` 来管理容器

# Note
- 使用 Dockerfile 创建镜像时会继承端口, 但不继承启动命令
- 使用 ctrl+p ctrl+q 退出 attach 的容器
- I can start a container named myapp.dev, then add `127.0.0.1 myapp.dev` into my host machine's hosts file, then I can visit myapp.dev in my host machine's browser

# Coodie

- 删除所有容器: `docker rm `docker images -aq`
- 删除所有 volume: `docker volume rm $(docker volume ls -q)`
- 进入一个守护态的容器有三种方式:
    + `docker attach <container>`
    + `docker exec -it <containerId> /bin/bash`
    + nsenter:
        1. `PID=$(docker-pid <containerId>)` --> 10981
        2. `nsenter --target 10981 --mount --uts --ipc --net --pid`
- reload php-fpm inside container: `kill -USR2 1`

# bump
- access multiple site via domain in host: jwilder/nginx-proxy
- container be accessible for each other by domain name: net-alias