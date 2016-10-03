#Risks

Malicious software:

- Email spam
- Sypware
- Sengind web requests
- Scanning for vulnerabilities
- Data crunching
- Backdoor for future access

Black hat hackers:

- Curious users
- Thrill seekers
- Trophy hunters
- Script kiddies
- Political activists
- Professionals

#Security

- 100% of security is not possible
- security level is determined by the weakest link
- should match your needs and goals
- re-evaluate periodically

#Principle

- Least privilege
    + User/account
    + Code access

- Simple is more secure
    + Legacy code is a security concern
    + Built-in functions are often better than your own versions
    + Disable or remove unused features when possbile

- Never trust users
    + Well-meaning users can cause problems
    + Be paranoid
    + Don't even trust admin users complete

        * can be unhappy employees or ex-employees
        * may not take security seriously
        * can have identity stolen

    + Use caution with contractors
    + Even offlines

- Expect the unexpected

  be creative and consider 'edge cases'

- Defend in depth/layers

- Security through obscurity
    + Limit exposed information
    + Limit feeback

- Prefer whitelisting

- Map exposure points and data passageways

#Filter inputs & Control output

- Regulating request
    + only accept expected request methods
    + request should tell you, what they are sending in(`Content-Type` header), and what they expect to get back(`Accept` header)

- Validation: reject if not acceptable
    + Only allow expected data in submission
    + Set default values
    + Common validation
        * Presence/Length
        * Type
        * Format
        * Within a set of values
        * Uniqueness
    + Be aware of language logic pitfalls

- Sanitizing: render harmless
    + Use type casting, not type juggling
    + Don't use custom sanitization methods
    + Encode or escape characters, Don't remove or correct invalid data
    + Consider where the data will go, or might go later, sanitize early, sanitize late, sanitize often
    + Use variables to track whether data is sanitized:
        * dirty, raw, tainted, unsafe
        * clean, filtered, sanitized, safe

- Keep code private
    + Public directory/Libraries directory
    + Web server configuration
        * Set document root
        * Allow/deny access
    + .htaccess file

- Keep credentials private
    + plain text password is dangerous, hash password whenever possible
    + keep them seperate from code
    + keep them out of version control
    + have as few copies as possible
    + don't reuse password

- Keep error messages vague
    + Turn off detailed error reporting for production server
    + Return generic 404 and 500 error pages
    + Developer can look up errors in log file or through email
    + Configure web server to use same error pages

- Smart logging
    + Types: 
        * Errors
        * Sensitive actions/Audit trail
        * Possible attacks
    + Fileds:
        * Date and times
        * Source(user/IP)
        * Action
        * Target
        * Cookie/Session; URL and all parameters(in raw format)
        * Backtrace
    + Don't log sensitive data: passwords, keys, tokens
    + Keep old content: versioning, Paranoid delete
    + Review log routinely

#Attacks

##Cross-site scripting(XSS)

Hackers can inject javascript into a web page, to trick users into running javascript code or steal cookies

To prevent XSS, you must sanitize dynamic text that get output to browser.

##Cross-site reqeust forgery(CSRF)

Hackers tricks users into making a request to your server

Can be used for fraudulent clicks:

    <img src="https://fun-poll.com/vote?hacker=5674" />

Can take advantage of user's logged in state:

    <img src="https://bank.com/transfer?amount=1000&to=987654321" />

To prevent CSRF:

- GET requests should be idempotent
- Only use POST requests for making changes
- Use better form: form token, token generation time

##SQL injection

Hacker is able to execute arbitary SQL request

- probe database schema
- steal database data: usename, password, credit cards, encrypted data
- add or change database data: place orders, assign elevated privileges
- destory database data: truncate or drop tables

Example:

    // pass usename as `jsmith' OR 1=1; --`:
    SELECT * FROM users WHERE username='${username}' AND password='${password}';

    // pass title as 
    // - `q' OR 1=(SELECT COUNT(*) FROM tblAdminLogins); --`
    // - `q' UNION SELECT username, password FROM users; --`
    // - `q'; DROP table customers; --`
    // and so on...
    SELECT * FROM articles WHERE title='${title}';

To prevent SQL injection

- limite privileges to application's database user
- sanitize input, escape for SQL, or
- use prepared statement

##URL manipulation

Hackers edit the URL to probe the site

Can be used for revealing private information

Can be used for performing restricted actions

Example:

    http://yousite.com?invoice=A-17391
    http://yousite.com?authorize?UserID=9876543210
    http://yousite.com?SESSIONID=AG8D3190C0F48231A55E
    http://yousite.com?products?preview=false
    http://yousite.com?products?preview=false
    http://yousite.com?images/small/rockymtns.jpg
    http://yousite.com?reports/exports/sales

To prevent

- be conscious that URL are exposed and editable
- don't use obscurity for access control
- keep error message vague
- GET should be idempotent, POST should be used for making changes 

##Faked reqeust/Faked forms

Hackers use plugins or tools to manipulate request headers or forms

To repevent

- don't rely on form structure for data validation
- don't rely on client side data validation
- use CSRF protection (form token, timestamp)

##Cookie theft

Hacker can sniff and steal cookies by XSS or observing network traffic(snooping)

To prevent

- only put non-sensitive data in cookie
- use HTTPOnly cookies(only available with HTTP request, not availabel for JS to retrieve), or secure cookies(HTTPS only)
- set cookie expiration date and domain and path, also don't forget to remove corresponding session file
- encrypt cookie data
- use session instead of cookie

##Session hijacking

Similar to cookie theft, Hacker use network eavesdropping to steal your session ID and fake your identity

To prevent

- save user agent in session and confirm it
    
    it's weak, because user agent can be faked

- check IP address

    it's buggy, because legimate user's IP can change, or there can be many people behind one same IP

- use HTTPOnly cookies
- regenerate session identifier periodically, at key point(such as after login)
- expire/remove old session files regularly
- use SSL and secure cookies

##Session fixation

Hacker trick a user into using a hecker-provided session identifier and wait user to authenticate himself, then they can share the same logged in state. say they can trick you to click:

    http://yourbank.com/login?SESSION_ID=a1b2c3d4e5f6

To prevent

- don't accept session identifier from GET or POST(only from cookie)
- regenerate session identifier periodically, at key point(such as after login)
- expire/remove old session files regularly

##Remote system execution

The most powerful attack, and hardest to achieve. Hacker can run operating system command on a webserver

To prevent

- avoid system execution keywords
- perform system execution with extreme caution
- sanitize any dynamic data carfully
- understand the commands and their syntax completely

##File upload abuse

Hacker abuse the file upload feature to upload too much, or upload malicious files

To prevent

- require user authentication, no anonymous uploads
- limit max upload size, limit formats, file extensions
- be cautious when opening uploaded files
- don't host uploaded files which have not been verified

##Denial of servie(DoS)

Hacker use varies ways to make a website not function anymore, such as overloading with request, DNS and routing disuption or using up server resource(disk space, processor power or bandwidth), usually performed by distributed network(DDoS)

To prevent

- firewall, switches and routers
- load management hardware/software
- collection of reverse proxies
- map your infrastructure and keep them up to date
- purchase high-quality hosting and equipment
- make net traffic visible
- develop a response plan
- change IP
- "black hole" or "null route" traffic
- be nice

#Encryption and authentication

##Availabel hashing algorithms

- --MD5--
- SHA-1
- SHA-2(SHA-256, SHA-512)
- Whirlpool
- Tiger
- AES
- Blowfish(preferred: secure, free, easy, slow)

##Salting(make rainbow table almost useless)

salt mean additional data added to password before encryption, it need to be stored

- regular salt: `salt{$password}`
- unique salt: `salt{$password}for{$user}`
- random salt: `salt{$password}at{$time}`

##Password requirement

- require length, but do not limit length(the encrypted length is always the same)
- require non-alphanumeric characters
- confirm password
- report password strength to user
- do not record a password hint

##Brute force attack

Hacker systematically trying all possbile input combinations until the corrent solution is found

>keySpace ^^ keyLength * timePerAttemp = timeRequired

To prevent

- key space: allow all characters
- key length: allow long strings
- encourage user to provie strong passwords
- use slow password hashing algorithms
- timing and throttling
- logging
- blacklisting

##SSL login

SSL stands for Secure Socket Layer, it provide communication security by 1) verifies authenticity of remote server and 2) encrypts all data exchanged with server. It can prevent snooping and session hijacking with some performance penalty due to encryption/decryption time, and it's only secure when all assets in a page is secure.

- At a minimum, you must encrypt all credit card transactions and username/password sent to the server
- Best to use SSL for all password-protected areas 


##Protect cookies

see section `cookie theft`, `session hijacking` and `session fixation`

##Regulate access privileges

- lease privileges principle
- be orgnized
- make privileges easy to revoke
- restrict access to access privilege administration tools
- you can regulate access by level or category
    + level 1,2,3,4,5
    + senior admin, admin, junior admin, staff, basic
    + publisher, writer, editor, designer, graphics
    + level of paying customers

##Forgotten passwords

the main question is: how to prove someone's identity:

- privileged information(e.g. ATM card number plus PIN)
- security challenge questions
- customer service staff
- send email with reset token
    + request the username to reset
    + always repond positively(never say account don't exists)
    + generate a unique token store it plus the generation time(to expire)
    + email a URL that includes token 
    + URL grant access, allow setting password

##Multi-factor authentication(MFA)

Authentication requires two (or more) factors:

- something only the user __knows__(account password)
- something only the user __has__(mobile phone)
- something only the user __is__(boimetric)

Example:

- user creates an account
- site logs computer being used(IP, set cookies, other characteristic)
- future login from same advice approved(know password, has computer)
- future login from new device require additional factor
    + send email(passcode, URL) to account(know password, has email account)
    + send SMS message(passcode, require SMS response) to mobile phone on file(similar as above)
    + call phone on file with recorded message(passcode, voice response)

#MISC

##Credit card security

- PCI(Payment Card industry) Compliance: http://pcisecuritystandards.org
- transmit all payment information over SSL
- never store full credit card number
- never store security code(CVV)
- store card branch and last four digits of card number
- use credit card vaults

##Regular expression flaws

>Some people, when confronted with a problem, think "I know, I'll use regular expression." Now they have two problems  
>-- _Jamie Zawinski_

Every regular expression is suspect, treat them as weak points, and the more complicated it is, the weaker it is. But, it doesn't have to be complicated to be flawd

##Data conversion and transformation

- be careful when converting data between formats
- be careful when transforming data
- can be subtleties in the transition
- reserved, meta, and escape characters are differenct
- re-sanitize after transition

##Buffer overflow

Happens when more data is written to a block of memory(buffer) than it can hold. Can be used to crash systems, to change a program's behavoir or execute system-level commands(remote system execution). This is problem for low-level languages(C, C++, Objective-C), but any language could have flaws

To prevent:

- allocate memory accurately
- use safe string functions
- validate data

##Database 

###Access security

- set a strong root password
- connect using a user bosides root
- least privilege
- allow access only from localhost or specific IP address

###Backup security

- back up regularly
- protect backup physically
- regulate access to database backups
- security policy for handling backups
- some ISPs automatically back up entire server

##Server security

- secure or disable root login
- access privileges; superusers
- SSH keys
- customize connection port numbers
- firewall
- know your server
- keep software up to date
- disable/remove anything not needed
