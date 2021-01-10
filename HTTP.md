# Methods

- __GET__: Used to fetch information specified in the request URI

    Syntax:- GET Request-URI

    ```
    GET /admin HTTP/1.1
    Host: example.com
    /**
     * conditional GET request:
     * 1. a 304 response is received if not modified
     * 2. related response header: `Last-Modified`
     */
    If-Modified-Since: Sat, 29 Oct 2015 19:43:31 GMT
    /**
     * partial GET request:
     * 1. only work in http1.1
     * 2. a 206 response is received instead of 200
     * 3. find out what `Accept-Ranges` response header is before you send a partial GET request
     * 4. typical usage: premium user are allowed to resume download from breakpoint
     */
    Range: bytes=0-1024
    ```

- __POST__: Used to send some data to the server to be processed in some way

    ```
    POST /login.php HTTP/1.1
    Content-Type: application/x-www-form-urlencoded
    Content-Length: 32

    user=admin password=test123
    ```

- __HEAD__: Identical to GET except server should not return message-body in the response(`curl`'s I switch)

- __TRACE__: Server will return what it has received

    Used to debug what is actually sent to the server(may be modified by proxy)

    Usually been disabled becuase it may lead to security issues

- __OPTIONS__: Used to find out what methods a peticular request to a file is allowed

    Related response header: `Allow`

    Usually been disabled becuase it may lead to security issues


# Headers
multiple value seperate with `,`

## Content Negotiation
- Accept
- Accept-Encoding
- Accept-Language
- Accept-Charset

`q` value indicat how much the option is preferred, default is 1:
`Accept: text/html; q=0.9,image/webp`

## Auth

- Authorization

## Cache

- ETag / If-None-Match
- Last-Modified / If-Modified-Since

## Custom

- X-*

# Response statuc code

__1xx__: Informational

|code|meaning            |
|----|-------------------|
|100 |Continue           |
|101 |Switching Protocols|

__2xx__: Success

|code|meaning                      |
|----|-----------------------------|
|200 |OK                           |
|201 |Created                      |
|202 |Accepted                     |
|203 |Non-authoritative Information|
|204 |No Content                   |
|205 |Reset Content                |
|206 |Partial Content              |

__3xx__: Redirection, additional steps required

|code|meaning           |
|----|------------------|
|300 |Multiple Choices  |
|301 |Moved Permanently |
|302 |Found             |
|303 |See Other         |
|304 |Not Modified      |
|305 |Use Proxy         |
|306 |Unused            |
|307 |Temporary Redirect|

__4xx__: Client error

|code|meaning                         |
|----|--------------------------------|
|400 |Bad Request                     |
|401 |Unauthorized                    |
|402 |Payment Required                |
|403 |Forbidden                       |
|404 |Not Found                       |
|405 |Method Not Allowed              |
|406 |Not Acceptable                  |
|407 |Proxy Authentication Required   |
|408 |Request Timeout                 |
|409 |Conflict                        |
|410 |Gone                            |
|411 |Length Required "Content-Length"|
|412 |Precondition Failed             |
|413 |Request Entity Too Large        |
|414 |Request-url Too Long            |
|415 |Unsupported Media Type          |
|416 |Range Not Satisfiable           |
|417 |Expectation Failed              |

__5xx__: Server error

|code|meaning                   |
|----|--------------------------|
|500 |Internal Server Error     |
|501 |Not Implemented           |
|502 |Bad Gateway               |
|503 |Service Unavailable       |
|504 |Gateway Timeout           |
|505 |HTTP Version Not Supported|


# Cookies
- Cookies are set using the `Set-Cookie` HTTP header
- Cookies are send using the `Cookie` HTTP header

## types
- session cookie
    + does not have an Expires or Max-Age attribute
    + intended to be deleted by the browser when the browser closes
- persistent cookie
    + has `Expires` or `Max-Age` attribute
    + browser deletes the cookie at a specific date
- host-only cookie
    + has `Domain` or `Path` attribute
    + browser only send the cookie to the domain only, not sub-domain

## attributes
- `Domain` & `Path`
- `Expires` & `Max-Age`
- `Secure`
    + directing browsers to use cookies only via secure/encrypted connections
    + should only be set over a secure connection
- `HttpOnly`
    + cookie cannot be accessed via client-side scripting languages
    + therefore cannot be stolen easily via cross-site scripting

## alternative to cookies
- JSON Web Tokens(JWT)