#Caching
##Web Caching

- HTML meta tag
- HTTP header
    + Expires header
        
        it tells all caches how long the associated representation is fresh for. After that time, caches will always check back with the origin server to see if a document is changed. 

        three way to set its time:
        - absolute time to expire
        - a time based on the last time that the client retrieved the representation (last access time)
        - a time based on the last time the document changed on your server (last modification time)

        espicially good for 
        - making static image cachable(they don't change much, so set a long expiry)
        - regularly changed page(expire at that regular time, say 6:00am)
    
    + Cache-Control header
        * max-age: expire time relative to request time
        * s-maxage: same to max-age, but only apply to shared caches
        * public: marks authenticated responses as cachable
        * private: allow user specific cache to store responses, but not shared caches
        * no-cache: forces caches to submit the request to the origin server for validation
        * no-store: don't keep a copy of representation under any condition
        * must-revalidate: strictly follow your rules
        * proxy-revalidate: same to `must-revalidate`, but only apply to proxy caches
        
        

- HTML5 Manifest
- gzip/deflate content
- YSlow/Google page speed
- SVG image sprite
- Spliting components across domain
- CDN
- Minimize HTTP request
- Use template engine and render/pre-compile it using gulp/grunt
- favicon.ico in root dir
