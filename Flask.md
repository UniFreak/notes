# install: `pip install flask`

# ran
1. make a `demo.py`
2. `export FLASK_APP=demo`
3. `export FLASK_ENV=development` or `export FLASK_DEBUG=1` (not in production!)
4. `flask run [--host]`

# concepts
- instance folder

# @?
- buleprint to do what instead of views?
- context local?

# configuration: `app.config`
common built-in config values:
- `FLASK_ENV`: default to `production`, `development` enable debugger and reloader
- `FLASK_DEBUG`
- `TESTING`
- `PROPAGATE_EXCEPTIONS`
- `SECRET_KEY`

use dict:
- `.['item']`
- `.update()`

use file:
- `.from_object()`
- `.from_envvar()`

# route

# request

- `from flask import request`
- `.method`
- `.form[]`: get post/put form -> can throw `KeyError` -> generate 403 bad response
- `.args.get('key', '')`: get url parameter

```python
from flask import request


```

# blueprint

# special objects
- g
- current_app
    + .open_resource()

