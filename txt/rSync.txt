============== Syntax ===============
Local:  rsync [OPTION...] SRC... [DEST]

Access via remote shell:
  	Pull: rsync [OPTION...] [USER@]HOST:SRC... [DEST]
  	Push: rsync [OPTION...] SRC... [USER@]HOST:DEST

Access via rsync daemon:
  	Pull: rsync [OPTION...] [USER@]HOST::SRC... [DEST]
	  	rsync [OPTION...] rsync://[USER@]HOST[:PORT]/SRC... [DEST]
  	Push: rsync [OPTION...] SRC... [USER@]HOST::DEST
	  	rsync [OPTION...] SRC... rsync://[USER@]HOST[:PORT]/DEST

Multiple directories at once
  	rsync -av host:file1 :file2 host:file{3,4} /dest/


============== Note ===============
rsync daemon typically using TCP port 873

refers to the local side as the "client" and the remote side as the "server". Don't confuse "server" with an rsync daemon -- a daemon is always a server

normally rsync will skip any files that are already the same size and have the same modification timestamp

using :: or rsync:// means contacting an rsync daemon, using : means using a remote shell(ssh, rsh...)

rsync daemon runs in stand-alone mode and inetd spawn mode

you can both use ssh and daemon by
   	1. connecting to a host using a remote shell and then spawning a single-use "daemon" server that expects to read its config file in the home dir of the remote user. you must explicitly set the remote shell program on the command-line with the --rsh=COMMAND option. in this approach, If you need to specify a different remote-shell user, keep in mind that the user@ prefix in front of the host is specifying the rsync-user value (for a module that requires user-based authentication). This means that you must give the '-l user' option to ssh when specifying the remote-shell. The "ssh-user" will be used at the ssh level; the "rsync-user" will be used to log-in to the "module".
	  rsync -av --rsh=ssh host::module /dest
	  rsync -av -e "ssh -l ssh-user" rsync-user@host::module /dest
   	2. using ssh to tunnel a local port to a remote machine and configure a normal rsync daemon on that remote host to only allow connections from "localhost"

you can specify any remote shell you like, either by using the -e command line option, or by setting the RSYNC_RSH environment variable

trailing slash on the source changes this behavior to avoid creating an additional directory level at the destination

Rsync always sorts the specified filenames into its internal transfer list. If you need a particular file to be transferred prior to another, either separate the files into different rsync calls, or consider using --delay-updates



============== Variables ===============
CVSIGNORE
	The CVSIGNORE environment variable supplements any ignore patterns in .cvsignore files. See the --cvs-exclude option for more details.
RSYNC_ICONV
	Specify a default --iconv setting using this environment variable. (First supported in 3.0.0.)
RSYNC_PROTECT_ARGS
	Specify a non-zero numeric value if you want the --protect-args option to be enabled by default, or a zero value to make sure that it is disabled by default. (First supported in 3.1.0.)
RSYNC_RSH
	The RSYNC_RSH environment variable allows you to override the default shell used as the transport for rsync. Command line options are permitted after the command name, just as in the -e option.
RSYNC_PROXY
	The RSYNC_PROXY environment variable allows you to redirect your rsync client to use a web proxy when connecting to a rsync daemon. You should set RSYNC_PROXY to a hostname:port pair.
RSYNC_PASSWORD
	Setting RSYNC_PASSWORD to the required password allows you to run authenticated rsync connections to an rsync daemon without user intervention. Note that this does not supply a password to a remote shell transport such as ssh; to learn how to do that, consult the remote shell's documentation.
USER or LOGNAME
	The USER or LOGNAME environment variables are used to determine the default username sent to an rsync daemon. If neither is set, the username defaults to "nobody".
HOME
	The HOME environment variable is used to find the user's default .cvsignore file.

============== Options ===============
-v, --verbose               increase verbosity
	--info=FLAGS            fine-grained informational verbosity
	--debug=FLAGS           fine-grained debug verbosity
	--msgs2stderr           special output handling for debugging
-q, --quiet                 suppress non-error messages
	--no-motd               suppress daemon-mode MOTD (see caveat)
-c, --checksum              skip based on checksum, not mod-time & size
-a, --archive               archive mode; equals -rlptgoD (no -H,-A,-X)
	--no-OPTION             turn off an implied OPTION (e.g. --no-D)
-r, --recursive             recurse into directories
-R, --relative              use relative path names
	--no-implied-dirs       don't send implied dirs with --relative
-b, --backup                make backups (see --suffix & --backup-dir)
	--backup-dir=DIR        make backups into hierarchy based in DIR
	--suffix=SUFFIX         backup suffix (default ~ w/o --backup-dir)
-u, --update                skip files that are newer on the receiver
	--inplace               update destination files in-place
	--append                append data onto shorter files
	--append-verify         --append w/old data in file checksum
-d, --dirs                  transfer directories without recursing
-l, --links                 copy symlinks as symlinks
-L, --copy-links            transform symlink into referent file/dir
	--copy-unsafe-links     only "unsafe" symlinks are transformed
	--safe-links            ignore symlinks that point outside the tree
	--munge-links           munge symlinks to make them safer
-k, --copy-dirlinks         transform symlink to dir into referent dir
-K, --keep-dirlinks         treat symlinked dir on receiver as dir
-H, --hard-links            preserve hard links
-p, --perms                 preserve permissions
-E, --executability         preserve executability
	--chmod=CHMOD           affect file and/or directory permissions
-A, --acls                  preserve ACLs (implies -p)
-X, --xattrs                preserve extended attributes
-o, --owner                 preserve owner (super-user only)
-g, --group                 preserve group
	--devices               preserve device files (super-user only)
	--specials              preserve special files
-D                          same as --devices --specials
-t, --times                 preserve modification times
-O, --omit-dir-times        omit directories from --times
-J, --omit-link-times       omit symlinks from --times
	--super                 receiver attempts super-user activities
	--fake-super            store/recover privileged attrs using xattrs
-S, --sparse                handle sparse files efficiently
	--preallocate           allocate dest files before writing
-n, --dry-run               perform a trial run with no changes made
-W, --whole-file            copy files whole (w/o delta-xfer algorithm)
-x, --one-file-system       don't cross filesystem boundaries
-B, --block-size=SIZE       force a fixed checksum block-size
-e, --rsh=COMMAND           specify the remote shell to use
	--rsync-path=PROGRAM    specify the rsync to run on remote machine
	--existing              skip creating new files on receiver
	--ignore-existing       skip updating files that exist on receiver
	--remove-source-files   sender removes synchronized files (non-dir)
	--del                   an alias for --delete-during
	--delete                delete extraneous files from dest dirs
	--delete-before         receiver deletes before xfer, not during
	--delete-during         receiver deletes during the transfer
	--delete-delay          find deletions during, delete after
	--delete-after          receiver deletes after transfer, not during
	--delete-excluded       also delete excluded files from dest dirs
	--ignore-missing-args   ignore missing source args without error
	--delete-missing-args   delete missing source args from destination
	--ignore-errors         delete even if there are I/O errors
	--force                 force deletion of dirs even if not empty
	--max-delete=NUM        don't delete more than NUM files
	--max-size=SIZE         don't transfer any file larger than SIZE
	--min-size=SIZE         don't transfer any file smaller than SIZE
	--partial               keep partially transferred files
	--partial-dir=DIR       put a partially transferred file into DIR
	--delay-updates         put all updated files into place at end
-m, --prune-empty-dirs      prune empty directory chains from file-list
	--numeric-ids           don't map uid/gid values by user/group name
	--usermap=STRING        custom username mapping
	--groupmap=STRING       custom groupname mapping
	--chown=USER:GROUP      simple username/groupname mapping
	--timeout=SECONDS       set I/O timeout in seconds
	--contimeout=SECONDS    set daemon connection timeout in seconds
-I, --ignore-times          don't skip files that match size and time
	--size-only             skip files that match in size
	--modify-window=NUM     compare mod-times with reduced accuracy
-T, --temp-dir=DIR          create temporary files in directory DIR
-y, --fuzzy                 find similar file for basis if no dest file
	--compare-dest=DIR      also compare received files relative to DIR
	--copy-dest=DIR         ... and include copies of unchanged files
	--link-dest=DIR         hardlink to files in DIR when unchanged
-z, --compress              compress file data during the transfer
	--compress-level=NUM    explicitly set compression level
	--skip-compress=LIST    skip compressing files with suffix in LIST
-C, --cvs-exclude           auto-ignore files in the same way CVS does
-f, --filter=RULE           add a file-filtering RULE
-F                          same as --filter='dir-merge /.rsync-filter'
					  		repeated: --filter='- .rsync-filter'
	--exclude=PATTERN       exclude files matching PATTERN
	--exclude-from=FILE     read exclude patterns from FILE
	--include=PATTERN       don't exclude files matching PATTERN
	--include-from=FILE     read include patterns from FILE
	--files-from=FILE       read list of source-file names from FILE
-0, --from0                 all *from/filter files are delimited by 0s
-s, --protect-args          no space-splitting; wildcard chars only
	--address=ADDRESS       bind address for outgoing socket to daemon
	--port=PORT             specify double-colon alternate port number
	--sockopts=OPTIONS      specify custom TCP options
	--blocking-io           use blocking I/O for the remote shell
	--outbuf=N|L|B          set out buffering to None, Line, or Block
	--stats                 give some file-transfer stats
-8, --8-bit-output          leave high-bit chars unescaped in output
-h, --human-readable        output numbers in a human-readable format
	--progress              show progress during transfer
-P                          same as --partial --progress
-i, --itemize-changes       output a change-summary for all updates
-M, --remote-option=OPTION  send OPTION to the remote side only
	--out-format=FORMAT     output updates using the specified FORMAT
	--log-file=FILE         log what we're doing to the specified FILE
	--log-file-format=FMT   log updates using the specified FMT
	--password-file=FILE    read daemon-access password from FILE
	--list-only             list the files instead of copying them
	--bwlimit=RATE          limit socket I/O bandwidth
	--write-batch=FILE      write a batched update to FILE
	--only-write-batch=FILE like --write-batch but w/o updating dest
	--read-batch=FILE       read a batched update from FILE
	--protocol=NUM          force an older protocol version to be used
	--iconv=CONVERT_SPEC    request charset conversion of filenames
	--checksum-seed=NUM     set block/file checksum seed (advanced)
-4, --ipv4                  prefer IPv4
-6, --ipv6                  prefer IPv6
	--version               print version number
(-h) --help                  show this help (see below for -h comment)


Rsync can also be run as a daemon, in which case the following options are accepted:
	--daemon                run as an rsync daemon
	--address=ADDRESS       bind to the specified address
	--bwlimit=RATE          limit socket I/O bandwidth
	--config=FILE           specify alternate rsyncd.conf file
-M, --dparam=OVERRIDE       override global daemon config parameter
	--no-detach             do not detach from the parent
	--port=PORT             listen on alternate port number
	--log-file=FILE         override the "log file" setting
	--log-file-format=FMT   override the "log format" setting
	--sockopts=OPTIONS      specify custom TCP options
-v, --verbose               increase verbosity
-4, --ipv4                  prefer IPv4
-6, --ipv6                  prefer IPv6
-h, --help                  show this help (if used after --daemon)

============== Filter Rules ===============
Syntax
	RULE [PATTERN_OR_FILENAME]
	RULE,MODIFIERS [PATTERN_OR_FILENAME]

	comment with #

Rule
	exclude, -          specifies an exclude pattern. 
	include, +          specifies an include pattern. 
	merge, .            specifies a merge-file to read for more rules. 
	dir-merge, :        specifies a per-directory merge-file. 
	hide, H             specifies a pattern for hiding files from the transfer. 
	show, S             files that match the pattern are not hidden. 
	protect, P          specifies a pattern for protecting files from deletion. 
	risk, R             files that match the pattern are not protected. 
	clear, !            clears the current include/exclude list (takes no arg) 

Modifier
	after -/+ rules:
		/ specifies that the include/exclude rule should be matched against the absolute pathname of the current item
		! specifies that the include/exclude should take effect if the pattern fails to match
		C is used to indicate that all the global CVS-exclude rules should be inserted as excludes in place of the "-C"
		s is used to indicate that the rule applies to the sending side, see H and S rules also
		r is used to indicate that the rule applies to the receiving side, see P and R rules also
		p indicates that a rule is perishable, meaning that it is ignored in directories that are being deleted
	after ./: rules:
		- specifies that the file should consist of only exclude patterns
		+ specifies that the file should consist of only include patterns
		C is a way to specify that the file should be read in a CVS-compatible manner. This turns on 'n', 'w', and '-', but also allows the list-clearing token (!) to be specified. If no filename is provided, ".cvsignore" is assumed
		e will exclude the merge-file name from the transfer
		n specifies that the rules are not inherited by subdirectories
		w specifies that the rules are word-split on whitespace instead of the normal line-splitting. This also turns off comments
		You may also specify any of the modifiers for the "+" or "-" rules (above) in order to have the rules that are read in from the file default to having that modifier set (except for the ! modifier, which would not be useful)
		

Note
	- any file with a filename pattern that does not match any of the include or exclude patterns are considered to be included. In other words, think of the include pattern as a way of overriding exclude pattern
	- if the pattern starts with a / then it is anchored to a particular spot in the hierarchy of files, otherwise it is matched against the end of the pathname
	- if the pattern ends with a / then it will only match a directory, not a regular file, symlink, or device
	- * matches any path component, but it stops at slashes
	- ** to match anything, including slashes
	- ? matches any character except a slash
	- [] introduces a character class, such as [a-z] or [[:alpha:]]
	- a trailing "dir_name/***" will match both the directory (as if "dir_name/" had been specified) and everything in the directory (as if "dir_name/**" had been specified). This behavior was added in version 2.6.7


============== Getting Real ===============
site exclude
	images/customer  55G
	images/imagebackup  7.5G
	images/nowatermark  11G

	*dae*
	*.swp
	*.m.php
	*.l.php
	*.o.php
	*.t.php
	*.bk.php
	*.\d+.*
	*.php_
	(all uppercase without extension)
	*.bk
	*(\d)+.php
	/*.jpg
	/*.gif
	/*.png
	/tags
	*test*
