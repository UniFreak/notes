Jekyll is a simple, blog-aware, static site generator
It take either markdown, textile or html files, then convert them throught a converter(like markdown) and Liquid renderer, output a static webpage

# Concepts

Gem: Ruby packages? jekyll is a gem, too
RubyGems: A package management framework for Ruby, run by `gem` command
Bundler: Dependency manager, like composer?
Gemfile: Used by Bundler to install gems

# Installation

install requirements: Ruby, RubyGems, Linux/Unix/Mac OS X, NodeJS

`apt-get install ruby`
`apt-get install ruby-dev`
`apt-get install gem`
`gem source --add https://ruby.taobao.org --remove https://rubygems.org/`
`apt-get install nodejs`

install jekyll

- with gem: `gem install jekyll`
- from source:

`git clone git://github.com/jekyll/jekyll.git`
`cd jekyll`
`script/bootstrap`
`bundle exec rake build`
`ls pkg/*.gem | head -n 1 | xargs gem install -l`

- if you are in Cygwin, remember to install
    + make, automake
    + gcc4-g++, git
    + libffi-devel, libgmp-devel, libiconv, libiconv2, zlib
    + curl
    + python

# Fixation

- when run `jekyll serve`, see `cannot load such file --bundler`

try run `gem install bundler`

- when run `jekyll serve`, show `some gem can not be found`

try run `bundle install`

# Basic Usage

```
jekyll build [--source <source>] [--destination <destination>] [--watch]
jekyll serve [--detach] [--no-watch]
```

A general jekyll project directory structure
    .
    ├── _config.yml
    ├── _drafts
    |   ├── begin-with-the-crazy-ideas.textile
    |   └── on-simplicity-in-technology.markdown
    ├── _includes
    |   ├── footer.html
    |   └── header.html
    ├── _layouts
    |   ├── default.html
    |   └── post.html
    ├── _posts
    |   ├── 2007-10-29-why-every-programmer-should-play-nethack.textile
    |   └── 2009-04-26-barcamp-boston-4-roundup.textile
    ├── _my_collection
    |   ├── meeting-note1.md
    |   └── meeting-note2.md
    ├── _data
    |   └── members.yml
    ├── _site
    ├── .jekyll-metadata
    └── index.html

Site config
    can be done with command line flag, or a _config.yml file at the root dir of site

    flag available with command line:
        global
            -s, --source DIR
            -d, --destination DIR
            --safe
        build
            -w, --[no-]watch
            --config FILE1[,FILE2,...]
            --drafts
            --future
            --lsi
            --limit_posts NUM
            --force_polling
            -V, --verbose
            -q, --quite
        serve
            --port PORT
            --host HOSTNAME
            --baseurl URL
            -B, --detach
            --skip-initial-build
    option available in _config.yml:
        global
            source: DIR
            destination: DIR
            safe: BOOL
            exclude: [DIR, FILE, ...]
            inclue: [DIR, FILE, ...]
            keep files: [DIR, FILE, ...]
            timezone: TIMEZONE
            encoding: ENCODING
            paginate: NUM_PER_PAGE # permalink in page front matter will cause pagination to break
                                   # pagination only works when called from index.html,
                                   # which optionally may reside in and produce pagination
                                   # from within a subdirectory, via the paginate_path configuration value
            paginate_path: PAGINATION_DESTINATION_PATH
        build
            future: BOOL
            lsi: BOOL
            limit_posts: NUM
        serve
            port: PORT
            host: HOSTNAME
            baseurl: URL
            detach: BOOL

Front Matters
    specify how Jekyll process a file
    only file with front matter will be processed by Jekyll

    you can set a default front matter in _config.yml, to prevent set the same thing repeatly...
        collections:
            - my_collection:
                output: true

        defaults:
            -
                scope:
                    path: PATH #in which path
                    type: TYPE #what type, available value is 'posts','pages','drafts' or any defined collectoin
                values:
                    #here is the default value we want to set for 'scoped' files, like:
                    layout: 'project'
                    aurthor: 'him'
    ... or set front matter per-file...
        ---
        # predefined global variables
        layout: LAYOUT
        permalink: PERMALINK_DEFINITION # like /:categories/:title.html
                                        # available variable: year, short_year, month, i_month,
                                        # day, i_day, title, categories
                                        # built-in permalink styles:
                                        # date, pretty, ordinal, none
        published: BOOL
        category: CATEGORY
        categories: [CATEGORY1, CATEGORY2, ...]
        tags: [TAG1, TAG2, ...]
        excerpt_separater: EXCERPT_SEPARATER

        # you can also define your own variables
        title: my title
        author: me

        # out-of-box variables for post
        date: YYYY-MM-DD HH:MM:SS +/-TTTT
        ---

Begin writting
    create posts under _post/
    create drafts under _drafts
    create pages under site root, or put them seperately under their own folder, like about/index.html
    create collection by define it in _config.yml and create corresponding _collection folder
    add your own data under _data/ folder
    asset file(say css/.sass) with front matters will alos be processed into corresponding folder

Build-in Variables
    site
        .time
        .pages
        .posts
        .related_posts
        .static_files
        .html_pages
        .html_files
        .collections
            .label
            .docs
            .files
            .relative_directory
            .directory
            .output
        .data
        .documents
            .content
            .output
            .path
            .relative_path
            .url
            .collection
        .categories.CATEGORY
        .tags.TAGS
        .[CONFIGURATION_DATA_OR_COLLECTION_IN_CONFIG_FILE_OR_SETTED_VIA_COMMAND_LINE]
    page
        .content
        .title
        .excerpt
        .url
        .date
        .id
        .categories
        .tags
        .path
        .next
        .previous
        .[CONFIGURATION_DATA_SETTED_IN_PAGES_FRONT_MATTER]
    content
    paginator
        .per_page
        .posts
        .total_posts
        .total_pages
        .page
        .previous_page
        .previous_page_path
        .next_page
        .next_page_path

Jekyll specified liquid
    Filter
        date_to_xmlschema
        date_to_rfc822
        date_to_string
        date_to_long_string
        where: 'key to search', 'equal to value'
        group_by: 'property'
        xml_escape
        cgi_escape
        number_of_words
        array_to_sentence_string
        markdownify
        scssify
        slugify: 'none' | 'raw' | 'default' | 'pretty'
        jsonify
        sort: 'property', 'first' | 'last'
    Tags
        {% include include.html param='value' %} in include.html, include.param is now 'value'
        {% include_relative dir/include.html %}
        {% highlight LANG linenos %} {% endhighlight %}
        {% post_url /path/to/post %}
        {% gist parkr/931c1c8d465a04042403 jekyll-private-gist.markdown %}

Plugins
    Github page jekyll don't support plugins, you'll need generate locally then push it

    install plugins
        a. create a .rb files in _plugins, they will be treated as plugins
        b. in _config.yml: gems: [autoload_plugin1, autoload_plugin2, ...]
        c. in Gemfile:
            group :jekyll_plugins do
                gem "my-jekyll-plugin"
            end
    plugins type
        generators
        converters
        commands
        tags