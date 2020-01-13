Jekyll is a simple, blog-aware, static site generator
It take either markdown, textile or html files, then convert them throught a converter(like markdown) and Liquid renderer, output a static webpage

# See

- official: <https://jekyllrb.com/>
- talk: IRC:#jekyll@freenode / gitter:jekyll/jekyll

# Concepts

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
```

**Permalinks** are the output path for your pages, posts, or collections

# Installation

install requirements: Ruby, RubyGems, Linux/Unix/Mac OS X, NodeJS

`apt-get install ruby`
`apt-get install ruby-dev`
`apt-get install gem`
`gem source --add https://ruby.taobao.org --remove https://rubygems.org/`
`apt-get install nodejs`

install jekyll

- with gem: `gem install jekyll bundler`
- from source:

`git clone git://github.com/jekyll/jekyll.git`
`cd jekyll`
`script/bootstrap`
`bundle exec rake build`
`ls pkg/*.gem | head -n 1 | xargs gem install -l`

if you are in Cygwin, remember to install
- make, automake
- gcc4-g++, git
- libffi-devel, libgmp-devel, libiconv, libiconv2, zlib
- curl
- python

## Fixation

- when run `bundle exec jekyll serve`, see `cannot load such file --bundler`

    try run `gem install bundler`

- when run `bundle exec jekyll serve`, show `some gem can not be found`

    try run `bundle install`

# Command Usage

## Basic

```
bundle exec jekyll build [--source <source>] [--destination <destination>] [--watch]
bundle exec jekyll serve [--detach] [--no-watch]
```

## Flags
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

## Configuration

can be done with command line flag, or a `_config.yml` file at the root dir of site

option available in `_config.yml`:
- global
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
- build
    future: BOOL
    lsi: BOOL
    limit_posts: NUM
- serve
    port: PORT
    host: HOSTNAME
    baseurl: URL
    detach: BOOL

# Front Matters

specify how Jekyll process a file
only file with front matter will be processed by Jekyll

you can set a default front matter in `_config.yml`, to prevent set the same thing repeatly...

```yaml
defaults: # front matter defaults
    -
        scope:
            path: # in which path, empty means all files. can use * glob pattern
            type: # what type, available value is "posts","pages","drafts"
                  # or any defined collectoin
        values: # here is the default value we want to set for scoped files, like
            layout:
            aurthor:

```

... or set front matter per-file...

```yaml
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
---
```

you can also define your own variables

```yaml
---
title: my title
author: me

# out-of-box variables for post
date: YYYY-MM-DD HH:MM:SS +/-TTTT
---
```

# Collection

**Collections** are similar to posts except the content doesn’t have to be grouped by date

To create collection
1. add collection config into `_config.yml` like

```yaml
collections:
  authors:
```

2. create a **document** for each collection item in like `_authors/jill.md`, `_authors/ted.md`
3. iterate collection in page

collection don't output page for documents, you can change this in `_config.yml` like

```yaml
collections:
  authors:
    output: true
```

then use variable `author.url` to link to author detail page

# Authoring / Blogging

create posts under `_post/`

create drafts under `_drafts/`, you can preview it with `build` or `serve`'s `--drafts` option

create pages under site root, or put them seperately under their own folder, like `about/index.html`

create collection by define it in `_config.yml` and create corresponding `_collection` folder

add your own data under `_data/` folder

asset file(say css/.sass) with front matters will alos be processed into corresponding folder

# Plugins

Github page jekyll don't support plugins, you'll need generate locally then push it

install plugins
1. create a .rb files in _plugins, they will be treated as plugins
2. in _config.yml: gems: [autoload_plugin1, autoload_plugin2, ...]
3. in Gemfile:

    group :jekyll_plugins do
        gem "my-jekyll-plugin"
    end

plugins type
- generators
- converters
- commands
- tags

# Liquid Addition

## Global Objects / Variables

`site`: +configuration settings from `_config.yml`
- `.time`
- `.pages`
- `.posts`
- `.related_posts`
- `.static_files`
- `.html_pages`
- `.html_files`
- `.collections`: `.label`, `.docs`, `.files`, `.relative_directory`, `.directory`, `.output`
- `.data`
- `.url`
- `.documents`: `.content`, `.output`, `.path`, `.relative_path`, `.url`, `.collection`
- `.categories.CATEGORY`
- `.tags.TAGS`

`page`: +custom variable from front matters
- `.content`
- `.title`
- `.excerpt`
- `.url`
- `.date`
- `.id`
- `.collection`
- `.categories`
- `.tags`
- `.dir`
- `.name`
- `.path`
- `.next`
- `.previous`

`layout`: +custom variable from front mater `layouts` block

`content`: available in layout files

`paginator`: available when `paginate` setting on
- `.page`
- `.per_page`
- `.posts`
- `.total_posts`
- `.total_pages`
- `.previous_page`
- `.previous_page_path`
- `.next_page`
- `.next_page_path`

## Filter

can also create your own filters using plugins

- `relative_url`
- `absolute_url`
- `date_to_xmlschema`
- `date_to_rfc822`
- `date_to_string`
- `date_to_long_string`
- `where: "key", "value"`
- `where_exp: "item", "item.key operator value"`:
- `group_by: 'property'`
- `group_by_exp: "item", "item.key"`
- `xml_escape`
- `cgi_escape`
- `uri_escape`
- `number_of_words`
- `array_to_sentence_string`
- `markdownify`
- `smartify`
- `scssify`
- `slugify: "none" | "raw" | "default" | "pretty" | "ascii" | "latin"`
- `jsonify`
- `normalize_whitespace`
- `sort: 'property', 'first' | 'last'`
- `sample: num`
- `to_integer`
- `push`
- `pop`
- `shift`
- `unshift`
- `inspect`

## Tags

can also create your own tags using plugins

- include

from `_includes` folder: `{% include footer.html %}`

from relative to current file, **cannot use ../**: `{% include_relative dir/footer.html %}`

can use varialbe for file: `{% include {{ page.to_include }} %}`

can pass value back to included file, act as templates, like this:

pass by value:
included file `_includes/note.html`: `<div> {{ include.content }} </div>`
include file: `{% include note.html content="Real Content" %}`

pass by variable (must use `capture`)
include file:

```html
{% capture download_note %}
This is the captured value with variable {{ my.var }}
{% endcapture %}

{% include note.html content=download_note %}
```


- code highlighting

`{% highlight <lang] [linenos] %} code... {% endhighlight %}`

need to include a highlighting stylesheet
see <https://jwarby.github.io/jekyll-pygments-themes/languages/ruby.html>
put the stylesheet into css folder then import it in `main.css` file

- links

to a file: `{% link path/to/file.md %}`
to a post: `{% post_url 2010-07-21-name-of-post %}`, no extension

major benefit of using the link or post_url tag is link validation.
If the link doesn’t exist, Jekyll won’t build your site

# Theme

With **gem-based themes**, some of the site’s directories (such as the assets, _layouts, _includes, and _sass directories) are stored in the theme’s gem, hidden from your immediate view
With **regular** theme, all files are present in your Jekyll site directory

make it easier for theme developers to make updates available to anyone who has the theme gem, using `bundle update`

Run jekyll with `jekyll new` or use `bundle install` with `Gemfile` to install gem-based themes

To create gem-based theme:
1. run `jekyll new-theme <theme-name>`
2. add template files in corresponding folder
3. complete the `.gemspec` and README file

To replace layouts or includes in your theme, make a copy in your _layouts or _includes directory of the specific file you wish to modify, or create the file from scratch giving it the same name as the file you wish to override. You can use `bundle show <themeName>` to show theme files

