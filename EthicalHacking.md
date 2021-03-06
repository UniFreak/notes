# System preparation

install vBox
install kali in vBox
    set up encrypted LVM
    all file in one partition
    use grub
    install guest addition
update system
    `apt-get update -y`
    `apt-get upgrade -y`
    `apt-get dist-upgrade -y`
    `reboot`
    >> optional: make a bash script to auto run those commands
        `vi kali_update.sh`
        write:
            apt-get update -y && apt-get upgrade -y && apt-get dist-upgrade -y
        save
        `chmod +x kali_update.sh`
package basic
    `apt-get install <packageName>`: install package
    `dpkg -l`: list all package
    `apt-cache show <packageName>`: show package detail
    `apt-get remove <packageName>`: remove package
install useful tools
    preload
    bleachbit
    bum
    gnome-do
    apt-file
    scrub
    shutter
    figlet
        usage:
            open `~/.bashrc`
            append `figlet <yourSlogan>`

    recon-ng
SSH config
    1. remove default key and generate new
    `cd /etc/ssh`
    `mkdir <backupFolder>`
    `mv ssh_host_* <backupFolder>`
    `dpkg-reconfigure openssh-server`
    2. start and verify service is runing
    `service ssh start`
    `netstat -antp`
    >> to stop:
    `service stop ssh`
Tor setup
    install: `apt-get install tor`
    config
        open /etc/proxychains.conf
        comment `strict_chain`
        uncomment `dynamic_chain`
        append `sock5 127.0.0.1 9050`
        save
    run: `service tor start`
    verify: `service tor status`
    see your ip before: `iceweasel www.whatsmyip.com`
    see your ip after: `proxychains iceweasel www.whatsmyip.com`
check whether system has rootkit
    `chkrootkit`

# workflow

Checklist
    gather information about the client organization
        - foundation
        - objectives of the company
        - products
        - employee information
        - business partners
        - clients
    visit the client organization premises
        - network equipment
        - server room
    list contact detail of key personnel of client organization
        - name
        - department
        - role
        - mobile/office number
        - email
    identify office space/location -> decide where to work at
    obtain temporary identification cards for the team
    ask the client to create domain accounts
    ask client for previous penetration testing reports
    identify clients security compliance requirements
        - physical safeguards
        - security mechanisms
        - company standards
    ask the client for a list of servers, OS and network devices
    hire a lawyer
    prepare a legal penetration testing document
    prepare a nondisclosure agreement
    obtain a liability insurance
    allocate a budget for the project
        - travel
        - lodging
        - food
    list the time scale
    daily/hourly fees negotiation
    timeline for the project
        - start time
        - milestones
        - completion date
    draft a cost for the project
    discuss the test workflow
    discuss the final report
penetration workflow
    -> gather information
    -> external test
        - external network test
        - website test
    -> internal test
        -> port scanning & vulnerability assessment
        -> exploitation
        -> brute-forcing test
        -> network sniffing
        -> social engineering
        -> wireless test

# information gathering

Workflow:
    WEB
        Website visite --> Google Dorks --> Web Tools
    Kali Tools
        Metagoofil -->
        TheHarvester -->
        Whois -->
        Fierce & DNSRecon
            - Dmitry
            - Discover Script
            - Recon-ng
Google hack
    cache:URL [string]
    filetype:[type]
    info:[string]
    intitle:[string]
    inurl:[string]
    site:[domain/website] [string]
    >>learn more: https://www.exploit-db.com/google-hacking-database/
Web tool
    dnsstuff.com/tools
metagoofil
    -d <domain>
    -t <filetype>
    -o <output>
    -f <filename>
theharvester
    -d <domain>
    -b <searchEngine>
    -l <limit>
whois <domain>
fierce -dns <domain>
dmitry -winsepfbo <domain>
discover script
    install: `git clone https://github.com/leebaird/discover.git
    `cd discover`
    `./discover.sh`
recon-ng(see video)