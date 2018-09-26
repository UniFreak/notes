# naming your package
- <vendor>/<project>
- case-insensitive
- use a dash (-) as separator

# create project structure
1. `mkdir vendor/package`
2. `cd vendor/package`
3. `composer init` to create the `composer.json` file
4. set up path repository @? <https://getcomposer.org/doc/05-repositories.md#path>
5. require local packages @?
6. set up autoloading path @?

# manage version
- version numbers will be parsed from the tag and branch names, like:
    + 1.0.0
    + v1.0.0
    + 1.10.5-RC1
    + v4.4.4beta2
    + v2.0.0-alpha
    + v2.0.4-p1
- use Semantic Versioning 

# update schedule
-  highly recommended to set up the GitHub/BitBucket service hook for all your packages
