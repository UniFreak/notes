#using 163 repos:

http://mirrors.163.com/cygwin/

#use XShell to access Cygwin:

1. Install cygwin, and install sshd. (With openssh-related are selected ^^)
2. Open the cygwin console: Enter ssh-host-config, all the way yes (if vista or win7, need to right click -> Run as administrator cygwin).

    Part of the screen:

        $ Ssh-host-config
        Overwrite existing / etc / ssh_config file? (Yes / no) yes
        Generating / etc / ssh_config file
        Overwrite existing / etc / sshd_config file? (Yes / no) yes
        Privilege separation is set to yes by default since OpenSSH 3.3.
        However, this requires a non-privileged account called 'sshd'.
        For more info on privilege separation read /usr/share/doc/openssh/README.privsep.

        Should privilege separation be used? (Yes / no) yes
        Generating / etc / sshd_config file

        Host configuration finished. Have fun!

3. Till the installation was successful. Cygwin console input net start sshd, ssh service started.

        $ Net start sshd
        CYGWIN sshd service is starting.
        CYGWIN sshd service has started successfully.

4. Modify the default Administrator password

        $ Passwd Administrator

5. Use XShell connection localshot, user name and password for the Administrator password