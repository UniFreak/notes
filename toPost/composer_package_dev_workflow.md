# refs
- https://getcomposer.org/doc/01-basic-usage.md#autoloading
- composer.dev.md
- https://dev-notes.eu/2017/03/initial-workflow-for-composer-package-development/
- https://stackoverflow.com/questions/14295558/how-to-develop-and-include-a-composer-package
-

# Steps
- naming convention
- composer init, git init
- project structure
    + composer.json config: namespacing, require, autoload
    + .gitignore
    + src/
    + tests/ & phpunit.xml
    + readme
    + license?
- implementation: writing src/ & tests/
- test in project (path repository)
    + new test branch
    + main project: set up path repository, require dev-master
    + run `composer update <yourpkg>:dev-master`

```javascript
"repositories": [
    {
        "type": "path",
        "url": "~/Project/uxin/qlog",
        "options": {
            "symlink": true
        }
    }
]
```

- first release: tag, version
- push to repository

# See
- uxin composer package scaffold script
