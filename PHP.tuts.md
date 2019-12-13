# Using cURL

```php
# step 1: init
$url = 'http://your.url';
$ch = curl_init($url);

# step 2: set options
# - sending POST
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

# - sending with other methods
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

# - set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Header-Name: header/value']);

# - set cookie
curl_setopt($ch, CURLOPT_COOKIE, "name=value");

# - do basic auth
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, 'user:pass');

# - return instead of directly output
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

# step 3: excecute
$result = curl_exec($ch);

# step 4: close
curl_colse($ch);
```

# Using Stream

sending

```php
# Step 1: build stream context options
$url = 'http://url.com';
$data = ['param' => 'value'];
$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Header-Name: header/value',
        'content' => http_build_query($data)
    ]
];

# Step 2: send with context
$result = file_get_contents($url, NULL, stream_context_create($options));
```

receiving

```php
$incoming = file_get_contents('php://input');
parse_str($incoming, $data);
```

# Handle XML

- SimpleXML: simple
- DOM: powerful, complicated
- XMLReader, XMLWriter, XMLParse: low-level, stream-based, for large data set