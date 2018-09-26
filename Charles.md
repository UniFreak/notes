# Cautions!
- Remember to disable the HTTP Proxy in your Settings when you stop using Charles, otherwise you'll get confusing network failures in your applications!

# Configuration
- Dynamic proxy ports is useful if you’re running Charles in a multiuser environment.

- The access control list determines who can use this Charles instance

- You need to configure Charles to use your existing proxy when it attempts to access the Internet. You can enter a list of locations to bypass the external proxy for

# Using Charles
- You can check if you’re using HTTP 1.1 by looking at the request headers displayed in Charles. If the first line has an HTTP/1.1 in it then you are. Otherwise you’ll probably see HTTP/1.0

- Session contains all of your recorded information. Sessions can be saved and re-opened (see the File Menu), which can be useful for exchanging with colleagues

- If you need to do a lot of socket level debugging you may want to consider using Ethereal

- The chart is useful for visualising parallel downloads, blocking and dependencies between resources

- Charles has basic load testing capability, by `repeat advanced`

- go http://control.charles/ to use web interface to control charels

- Charles currently supports version 2.4.1 of Protocol Buffers

# Proxying
- Using proxy throttling to adjust the bandwidth and latency of your Internet connection enables you to simulate modem conditions using your high-speed connection

- The Breakpoints tool lets you intercept requests and responses before they are passed through Charles. You can examine and edit the request or response and then decide whether to allow it to proceed or to block it

- How Charles SSL proxy works

    Charles does this by becoming a man-in-the-middle. Instead of your browser seeing the server’s certificate, Charles dynamically generates a certificate for the server and signs it with its own root certificate (the Charles CA Certificate). Charles receives the server’s certificate, while your browser receives Charles’s certificate. Therefore you will see a security warning, indicating that the root authority is not trusted. If you add the Charles CA Certificate to your trusted certificates you will no longer see any warnings – see below for how to do this

- Enable SSL proxy
    1. You must specifically identify the host names you want to enable SSL Proxying on. The list is in the Proxy Settings, SSL tab. You can also right-click on a host name in the structure view and turn on or off SSL Proxying.
    2. After adding a host name to the SSL Proxying list you may need to restart Charles for existing browser sessions to change.
    3. If you want to SSL Proxy all host names then enter * into the host names list in the SSL Proxying Settings.

- Trust charles certificate(mute untrusted certificate warning)
    + windows/IE
        1. help -> ssl proxing -> install charels root certification
        2. click `install certificate` and choose **Trusted Root Certification Authorities**
        3. restart IE
    + iOS device
        1. configure device to use charles as proxy
        2. open `http://www.charlesproxy.com/getssl` in safari
        3. install
    + Android device: you can only use SSL Proxying with apps that you control
    + windows/chrome
        1. in charles: help -> ssl proxying -> save charles root certificate as **.cer** file
        2. in chrome: settings -> show advanced options -> http/ssl -> manage certificates
        3. trusted root certificates -> import -> default all the way

- Charles can create a reverse proxy to an HTTP or HTTPS destination

- Any TCP/IP or UDP port can be configure to be forwarded from Charles to a remote host using the Port Forwarding tool. This enables debugging of any protocol in Charles. This is especially useful when debugging XMLSocket connections in Macromedia Flash. You can also use Charles as a SOCKS proxy so you don’t need to set up the port forwarding.

# Tools
- By manipulating the HTTP headers that control the caching of responses, The No Caching tool prevents client applications, such as web browsers, from caching any resources

- By manipulating the HTTP headers, the Block Cookies tool blocks the sending and receiving of cookies

- The Map Remote tool enables you to serve all or part of one site from another, this is useful if you have a development version of a site and would like to be able to browse the live site with some of the requests being served from development. You can map directory to directory, file to file, or directory with file pattern to directory. You can also map an HTTP request to an HTTPS destination and vice-versa

-  Map Local tool can serve requests from local files so you can use the latest development files from your computer as if they were part of a remote website(@? map local vs map remote)

- The Rewrite tool enables you to create rules that modify requests and responses as they pass through Charles. Rules such as adding or changing a header or search and replace some text in the response body

- Blacklisting is useful when you’re testing a site that loads resources, such as images, from another server. Blocking those requests enables you to determine the size and speed of the site without them. Particularly useful if you’re developing a site with banner ads and don’t want to brainwash yourself while you work

- If you have set up a virtual host but the IP address change hasn’t propagated through DNS yet, you can spoof it using DNS spoof tool and test your virtual hosting immediately


- The Mirror tool saves responses to disk as they are received, creating a mirror copy of websites as you browse them

- The Auto Save tool automatically saves and clears the recording session at set intervals

- The Client Process tool shows the name of the local client process that is responsible for making each request. The client process name is displayed in the Notes area on each request.

- Use repeat/repeat advanced tool to easily repeat a request. The Compose tool builds on the Repeat tool by allowing you to change the contents of the request before repeating it

- Charles can validate the recorded responses by sending them to the W3C HTML validator, W3C CSS validator and W3C Feed validator.
