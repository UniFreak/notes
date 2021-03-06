SSH from host to guest
    1.
    `VBoxManage modifyvm [yourVMname] --natpf1 "ssh,tcp,,3022,,22"`
    2.
    add a port-forwarding rule to currenct nat adapter: host:3022, guest:22
    use ssh to connect 127.0.0.1:3022 in host, you are done
    3.
    add a host-only adapter:
        if adapter not work as expected, manually config it(centOS):
        a. at guest:
            `vi /etc/sysconfig/network-script/ifcfg-eth1`:
                DEVICE=eth1
                HRADDR=08:00:27:F0:6A:19
                BOOTPROTO=static
                IPADDR=192.168.56.101
                NETMASK=255.255.255.0
            `reboot`
        b. at host:
            configure net adapter 'VirtualBox host-only network' to use static ip 192.168.56.1 and
            netmask 225.225.225.0 and no gateway
    remember the ip for this host-only adapter, say 192.168.56.101
    use ssh to connect 192.168.56.101:22 in host, you are done

install guest addition
    - check if installed:
        `sudo modprobe vboxadd`, or
        `sudo modprobe vboxvfs`, or
        `lsmod | grep -i vbox`
    - install
        `yum update`
        `yum install kernel-devel gcc`
        `echo export KERN_DIR=/usr/src/kernels/`uname -r` >> ~/.bashrc`

        `wget https://dl.fedoraproject.org/pub/epel/7/x86_64/e/epel-release-7-8.noarch.rpm`
        `rpm --import http://dl.fedoraproject.org/pub/epel/RPM-GPG-KEY-EPEL-7`
                                                                // Install DAG's GPG key
        `rpm -K epel-release-7-8.noarch.rpm`                    // Verify the package you have downloaded
        `rpm -i epel-release-7-8.noarch.rpm`                    // Install the package

        `yum install dkms`                                      // install dkms

        load guest addition in cdrom
        `mount /dev/cdrom /media`
        `cd /media`
        `sudo sh ./VBoxLinuxAddition-x86.run`

start vbox headless
    `VBoxManage startvm "VM name" --type headless`

Use shared folder(only work when host is Windows)
    0. make sure guest addition is correctly installed
    1. configure which folder to share
        - with command line:
            `VBoxManage sharedfolder add "<virtual machine>" -name "<share name>" -hostpath "<host path>"`
        - using GUI
    2. mount in guest
        `mount -t vboxsf [-o MOUNT OPTIONS] ShareName MountPoint`
    3. reboot, and the folder should appear under /media directory

==================== Q&A ====================
only showing 32bit version:
    - make sure your OS is 64bit
    - enable `Intel Virtualization Technology` and VT-d in BIOS
    - disable `Hyper-V plateform` in windows' feature list
can't change host key:
    - make sure you clicked `enter` before saving
exit scale mode
    - press `hoseKey` + c
exit full-screen mode
    - press `hostKey` + f
what's my host's ip?
    - if in windows, run `ipconfig`
    - if in linux, run `netstat -rn`
    - the geteway ip is your host ip