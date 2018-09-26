#General
- "Connecting to it" means performing a TCP protocol handshake
- The local port number is usually randomly assigned to your TCP connection
- Keepalive is a feature in the TCP that makes it send "ping frames"
- Use TCP keep alive can help avoid really slow connection being killed
- Most operations in curl have no time-out by default
- cURL can get credentials for machines for any protocol with `.netrc` file
- a `.netrc` file store credentials like this:
    ```
    machine example.com
    login username
    password secret
    ```
- curl does no MX lookups by itself. you can use tools to get MX records with  'dig' and 'nslookup'

#Allowed URLs
- sometimes the differences between what you see in a browser's address bar and what you can pass in to curl is significant

- `file:///path/to/file`: the three slashes is actaully a common mistake, but cURL allow that
- `file://C:/path/to/file`: refer to C: drive on Windows
- `ftp://user:password@example.com/`: with username&password
- `http://127.0.0.1/`: using IPv4
- `http://[::1]/`: using IPv6
- `http://example.com:8080/`: with port number
- `ftp://example.com/foo;type=A`: with file type(only ftp://)
    + A: ASCII
    + I: binary
    + D: directory

#URL globbing
- `/[1-100].png`: 1.png, 2.png, ... 100.png
- `/[001-100].png`: 001.png, 002.png, ... 100.png
- `/[0-100:2].png`: 0.png, 2.png, 4.png, ... 100.png
- `/seciont[a-z].html`
- `/{one,two,three,alpha,beta}.html`
- `/{Ben,Alice,Frank}-{100x100,1000x1000}.jpg`
- `/chess-[0-7]x[0-7].jpg`
- `/{web,mail}-log[0-6].txt`

#Config file
- curl always looking for `.curlrc` or `_curlrc`(Windows)
- write options as in command line
- urls must be provided after `--url`
- you can omit password when using `-u` in config file, cURL will prompt for it

#Common options & arguments
- curl supports over two hundred different options
- you can put the options anywhere you like, say after the URL
- curl only ever handles options and URLs. so if they're neither option nor arguments, curl treat them as url(so cURL can handle multiple urls at once)
- use the long form of the option with an initial "no-" to make it negative

- h,help            list options
- manual            show manual

- v,verbose         verbose
- s,slient          silent, hide progress meter
- S,show-error      show error, even when silenced
- #,progress-bar    show progress bar

- trace             save trace as hex to file
    + [filename]    as filename
    + -             to stdout
- trace-ascii       save trace as ascii to file
    + [filename]    as filename
    + -             to stdout
- trace-time        prefixes verbose/trace outputs with time

- no-keepalive      disable keepalive(the default)
- keepalive-time    set keepalive ping frame interval
    + [seconds]     default is usually 7200

- L,location        follow redirections
- H,header          with header
- d,data            with POST data(like `application/x-www-form-urlencoded`)
    + [data]
    + @[file]
- data-binary       read and use the given file in binary exactly as given
    + @[file]
- data-urlencode    urlencode data
- G,get             with GET data
- f                 with multipart formpost data
- T,upload-file     upload(HTTP/FTP/SMTP)
    + [localfile]   support globbing
- H                 with custom HOST header
    + Host:[customHost]
- connect-timeout   connect timeout after
    + [second].[millisecond]
- m,max-time        operation fail after
    + [seconds]
- speed-limit       stop if transfer speed goes below
    + [bytes]       per second
- speed-time        during
    + [seconds]     time
- path-as-it        don't squashing `/../` or `/./`
- ignore-content-length     
- c                 save cookie to
    + [cookieJar]
- b                 with cookie in 
    + [cookieJar]
    
- x,proxy           through specified proxy
    + [IP]:[port]   default port is 3128
- p,proxytunnel     @?
- proxy1.0          
- socks5-hostname   @?
- U,proxy-user      auth proxy via BASIC auth
    + [user]:[pass]
- proxy-anyauth     
- proxy-digest      auth proxy via digest @?
- proxy-negotiate   auth proxy via negotiate @?
- proxy-ntlm        auth proxy via ntlm @?

- resolve           resolve host to
    + [host]:[port]:[toIP]
- connect-to        specified destination(maybe one load banlancer)
    + [originHost]:[originPort]:[destHost]:[destPort]
- interface         @?
- local-port        bind connection to this port(range)
    + [portNo]
    + [from]-[to]

- dns-servers       using specified DNS servers
- dns-ipv4-addr     
- dns-ipv6-addr
- dns-interface

- A                 as user agent
    + [agent]
- proto-default     set default protocol to use
- fail-early        error out on the first failed URL
- I,head            request with HEAD method
- next              divide between a set of options and URLs
- g,globoff         disable url globbing

- O,remote-name     save target file using remote name
- remote-name-all   save all target file using remote name
- o,output          save as name
    + [name]        you can reference glob by `#[num]`
- J,--remote-header-name 
                    save as `Content-Disposition` header suggested name
- compressed        compress HTTP contents using `Content-Encoding`
- tr-encoding       compress HTTP contents using `Transfer-Encoding`
- raw               disable all internal HTTP decoding or encoding
- limit-rate        limit speed 
    + [speed]       can use K,M,G as unit
- max-filesize      limit max file download size
- retry             try times before fail
- retry-delay
- retry-max-time
- max-time
- C,continue-at     where to start transfer
    + [offset]      bytes
    + -             try figure out 
- r,range           download only specified range
    + [from-end]    bytes, can omit from or end, can specify multiple ranges(,)

- use-ascii         use ftp ascii mode 
- P,ftp-port        @?
- no-epsv           @?
- ftp-pasv          switch to passive(the default) connection
- ftp-skip-pasv-ip  ignore respond(to PASV) IP
- ftp-method        run ftp method
    + multicwd
    + nocwd
    + singlecwd
- l,list-only       run NLST ftp command

- n,netrc           look for .netrc file
- netrc-file        using specified .netrc file
    + [file]
- netrc-optional    make use of .netrc optional

- K,config          use config file
    + [file]
- u,user            specify username and password(of BASIC auth)
    + [user]:[pass]
- basic             use BASIC auth explicitly
- anyauth           try figure out and use the most safe auth method
- digest            auth via digest
- negotiate         auth via negotiate
- ntlm              auth via ntlm
- w,write-out       writes out information after a transfer
    + [formated string]
        accessed variables by writing `%{variable_name}`
        use `%%` to output a normal `%`
        see #avaiable write-out vars
    + @[filename]
    + @-

- mail-rcpt         send mail to this addr
- mail-from         mail is from this addr

- ssl               try SSL/TLS
- ssl-reqd          requires SSL/TLS
- cipher            prefer specified SSL/TLS cipher
- sslv2             use SSL version 2
- sslv3             use SSL version 3
- tlsv1             use TLS >= version 1.0
- tlsv1.0           use TLS version 1.0
- tlsv1.1           use TLS version 1.1
- tlsv1.2           use TLS version 1.2
- tlsv1.3           use TLS version 1.3
- k,insecure        skip checking of `known_hosts` file
- cert-status       send `Certificate Status Request`
- cacert            use specified CA certificates bundle
    + [file].crt    a .crt file in pem format
- pinnedpubkey      specify where to read sha256 pinned pubkey
    + sha256//[blah...]
- cert              specify client certificate
    + [mycert]:[password]
- cert-type         with client certificate type
    + PEM|...
- key               using client private key file
    + [file]
- key-type          with client private key type
    + PEM|...


#Available write-out vars
- `%{content_type}`
- `%{filename_effective}`
- `%{ftp_entry_path}`
- `%{response_code}`
- `%{http_connect}`
- `%{local_ip}`
- `%{local_port}`
- `%{num_connects}`
- `%{num_redirects}`
- `%{redirect_url}`
- `%{remote_ip}`
- `%{remote_port}`
- `%{size_download}`
- `%{size_header}`
- `%{size_request}`
- `%{size_upload}`
- `%{speed_download}`
- `%{speed_upload}`
- `%{ssl_verify_result}`
- `%{time_appconnect}`
- `%{time_connect}`
- `%{time_namelookup}`
- `%{time_pretransfer}`
- `%{time_redirect}`
- `%{time_starttransfer}`
- `%{time_total}`
- `%{url_effective}`