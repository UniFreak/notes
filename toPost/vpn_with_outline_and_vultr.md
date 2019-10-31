# New Server
1. server location: Amsterdam
2. server type: Application -> Docker (Ubuntu)
3. server size: $5/mo
4. feature: ipv6, private networking
5. add ssh key (in mac: ssh-keygen)
6. deploy

try ping, if can not ping through, destroy and try another location. good luck


# Ssh
1. run `ssh root@<server ip>`
2. type in passphrase

# outline manager
1. manager: run `sudo bash -c "$(wget -qO- https://raw.githubusercontent.com/Jigsaw-Code/outline-server/master/src/server_manager/install_scripts/install_server.sh)"` to install outline server
2. copy apiUrl and paste into outline manager
4. run `ufw disable` to disable firewall

@?
- outline manager cannot connect: try use iphone network

# outline