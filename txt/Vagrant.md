107.23.224.212  atlas.hashicorp.com


# Concepts

config in `Vagrantfile`
    Vagrant.configure("2") do |config|
      config.vm.box = "hashicorp/precise32"
      config.vm.provision :shell, path: "bootstrap.sh"
      config.vm.network :forwarded_port, host: 4567, guest: 80
    end

config file:Vagrantfile
box
guest additions
    special software packages which are shipped with VirtualBox but designed to be installed inside a VM to improve performance of the guest OS and to add extra features
automated provisioning
    Using this feature, Vagrant will automatically install software when you vagrant up
port forwarding
    specify ports on the guest machine to share via a port on the host machine. This allows you to access a port on your own machine, but actually have all the network traffic forwarded to a specific port on the guest machine
Vagrant Share
    lets you share your Vagrant environment to anyone around the world. It will give you a URL that will route directly to your Vagrant environment


By default, Vagrant shares your project directory(the one with the Vagrantfile) to the /vagrant directory in your guest machine
We can have several projects sharing the same base boxes where the Puppet/Chef definitions are different
With synced folders, you can continue to use your own editor on your host machine and have the files sync into the guest machine

# Commands
vagrant init [boxName]
vagrant box
    add boxName [url|filePath]
    list
    outdated
    remove
    repackage
    update
vagrant up [--provider]
vagrant ssh
    (default password is `vagrant`)
vagrant suspend
vagrant resume
vagrant halt
vagrant reload [--provision]
vagrant login
vagrant share
vagrant destory

vagrant global-status
vagrant package [--base NAME] [--output NAME] [--include x,y,z] [--vagrantfile FILE]
vagrant plugin install
vagrant port
vagrant powershell
vagrant provision
vagrant rdp
vagrant snapshot
vagrant ssh-config
vagrant status
vagrant version
vagrant list-commands
vagrant cap
vagrant help

vagrant login
vagrant share
vagrant connect


#Unsovled
----
$ vagrant plugin install vagrant-vbguest
Installing the 'vagrant-vbguest' plugin. This can take a few minutes...
Bundler, the underlying system Vagrant uses to install plugins,
reported an error. The error is shown below. These errors are usually
caused by misconfigured plugin installations or transient network
issues. The error from Bundler is:

Could not fetch specs from https://rubygems.org/

Retrying source fetch due to error (2/3): Bundler::HTTPError Could not fetch specs from https://rubygems.org/Retrying source fetch due to error (3/3): Bundler::HTTPError Could not fetch specs from https://rubygems.org/

----
$ vagrant share
==> default: Detecting network information for machine...
    default: Local machine address: 127.0.0.1
    default:
    default: Note: With the local address (127.0.0.1), Vagrant Share can only
    default: share any ports you have forwarded. Assign an IP or address to your
    default: machine to expose all TCP ports. Consult the documentation
    default: for your provider ('virtualbox') for more information.
    default:
    default: Local HTTP port: 4567
    default: Local HTTPS port: disabled
    default: Port: 2222
    default: Port: 4567
==> default: Checking authentication and authorization...
==> default: Creating Vagrant Share session...
    default: Share will be at: hardworking-parakeet-2059
The sharing proxy exited with a non-zero exit status! This represents
an erroneous exit and likely a bug. Please report this issue.

==================== Box setup ====================
change cli prompt color:
    vi ~/.bashrc:
        export PS1="\e[0;36m[\u@\h \W]\$\e[m"
set china apt source
    1. `mv /etc/apt/sources.list /etc/apt/sources.list.org`
    2. `vi /etc/apt/sources.list`,
        ### source for China
        deb http://mirrors.163.com/ubuntu/ precise-updates main restricted
        deb-src http://mirrors.163.com/ubuntu/ precise-updates main restricted
        deb http://mirrors.163.com/ubuntu/ precise universe
        deb-src http://mirrors.163.com/ubuntu/ precise universe
        deb http://mirrors.163.com/ubuntu/ precise-updates universe
        deb-src http://mirrors.163.com/ubuntu/ precise-updates universe
        deb http://mirrors.163.com/ubuntu/ precise multiverse
        deb-src http://mirrors.163.com/ubuntu/ precise multiverse
        deb http://mirrors.163.com/ubuntu/ precise-updates multiverse
        deb-src http://mirrors.163.com/ubuntu/ precise-updates multiverse
        deb http://mirrors.163.com/ubuntu/ precise-backports main restricted universe multiverse
        deb-src http://mirrors.163.com/ubuntu/ precise-backports main restricted universe multiverse

        deb http://mirrors.sohu.com/ubuntu/ precise-updates main restricted
        deb-src http://mirrors.sohu.com/ubuntu/ precise-updates main restricted
        deb http://mirrors.sohu.com/ubuntu/ precise universe
        deb-src http://mirrors.sohu.com/ubuntu/ precise universe
        deb http://mirrors.sohu.com/ubuntu/ precise-updates universe
        deb-src http://mirrors.sohu.com/ubuntu/ precise-updates universe
        deb http://mirrors.sohu.com/ubuntu/ precise multiverse
        deb-src http://mirrors.sohu.com/ubuntu/ precise multiverse
        deb http://mirrors.sohu.com/ubuntu/ precise-updates multiverse
        deb-src http://mirrors.sohu.com/ubuntu/ precise-updates multiverse
        deb http://mirrors.sohu.com/ubuntu/ precise-backports main restricted universe multiverse
        deb-src http://mirrors.sohu.com/ubuntu/ precise-backports main restricted universe multiverse

        deb http://mirrors.ustc.edu.cn/ubuntu/ precise-updates main restricted
        deb-src http://mirrors.ustc.edu.cn/ubuntu/ precise-updates main restricted
        deb http://mirrors.ustc.edu.cn/ubuntu/ precise universe
        deb-src http://mirrors.ustc.edu.cn/ubuntu/ precise universe
        deb http://mirrors.ustc.edu.cn/ubuntu/ precise-updates universe
        deb-src http://mirrors.ustc.edu.cn/ubuntu/ precise-updates universe
        deb http://mirrors.ustc.edu.cn/ubuntu/ precise multiverse
        deb-src http://mirrors.ustc.edu.cn/ubuntu/ precise multiverse
        deb http://mirrors.ustc.edu.cn/ubuntu/ precise-updates multiverse
        deb-src http://mirrors.ustc.edu.cn/ubuntu/ precise-updates multiverse
        deb http://mirrors.ustc.edu.cn/ubuntu/ precise-backports main restricted universe multiverse
        deb-src http://mirrors.ustc.edu.cn/ubuntu/ precise-backports main restricted universe multiverse

        ### Original(comment removed)
        deb http://us.archive.ubuntu.com/ubuntu/ precise main restricted
        deb-src http://us.archive.ubuntu.com/ubuntu/ precise main restricted

        deb http://us.archive.ubuntu.com/ubuntu/ precise-updates main restricted
        deb-src http://us.archive.ubuntu.com/ubuntu/ precise-updates main restricted

        deb http://us.archive.ubuntu.com/ubuntu/ precise universe
        deb-src http://us.archive.ubuntu.com/ubuntu/ precise universe
        deb http://us.archive.ubuntu.com/ubuntu/ precise-updates universe
        deb-src http://us.archive.ubuntu.com/ubuntu/ precise-updates universe

        deb http://us.archive.ubuntu.com/ubuntu/ precise multiverse
        deb-src http://us.archive.ubuntu.com/ubuntu/ precise multiverse
        deb http://us.archive.ubuntu.com/ubuntu/ precise-updates multiverse
        deb-src http://us.archive.ubuntu.com/ubuntu/ precise-updates multiverse

        deb http://us.archive.ubuntu.com/ubuntu/ precise-backports main restricted universe multiverse
        deb-src http://us.archive.ubuntu.com/ubuntu/ precise-backports main restricted universe multiverse

        deb http://security.ubuntu.com/ubuntu precise-security main restricted
        deb-src http://security.ubuntu.com/ubuntu precise-security main restricted
        deb http://security.ubuntu.com/ubuntu precise-security universe
        deb-src http://security.ubuntu.com/ubuntu precise-security universe
        deb http://security.ubuntu.com/ubuntu precise-security multiverse
        deb-src http://security.ubuntu.com/ubuntu precise-security multiverse
    3. `apt-get update`
    4. `apt-get upgrade`
install vim
    `apt-get install -y vim`
install vBox guest addition
    `wget http://download.virtualbox.org/virtualbox/4.2.16/VBoxGuestAdditions_4.2.16.iso`
    `sudo apt-get install dkms gcc`
    `sudo mount -o loop VBoxGuestAdditions_4.2.16.iso /mnt`
    `sudo ./VBoxLinuxAdditions.run`
install apache
    `apt-get install -y apache2`
install mysql
    `apt-get install -y mysql-server libapache2-mod-auth-mysql php5-mysql`
install php
    `apt-get install python-software-properties`
    `apt-get install -y language-pack-en-base`
    `LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php5-5.6`
    `apt-get update`
    `apt-get install -y php5 libapache2-mod-php5 php5-mcrypt`
    `vim /etc/apache2/mods-enabled/dir.conf`:
        <IfModule mod_dir.c>
                  DirectoryIndex index.php index.html index.cgi index.pl index.php index.xhtml index.htm
        </IfModule>
install pear
    `apt-get install php-pear`
install composer
    `apt-get install curl`
    `curl -sS http://install.phpcomposer.com/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer`
install xdebug
    `apt-get install php5-xdebug`
install phpunit
    `wget https://phar.phpunit.de/phpunit.phar`
    `chmod +x phpunit.phar`
    `sudo mv phpunit.phar /usr/local/bin/phpunit`

install java
    `apt-get install default-jre`
install selenium

install python
    `apt-get install python`
install pip
    `apt-get install python-pip`

install redis
    `apt-get install redis-server`
install nodejs
    `apt-get install nodejs`
install nginx

# Q&A

- copy file from vbox to host

`vagrant ssh -c "sudo cat /home/vagrant/devstack/local.conf" > local.conf`
