# Ref
- doc: <https://webpack.js.org/concepts>
- how bundlers work: <https://github.com/ronami/minipack>
- module: <https://medium.com/webpack/the-state-of-javascript-modules-4636d1774358>

# Concept

bundlers: compile small pieces of code into something larger and more complex that can run in a web browser

webpack: static module bundler for modern JavaScript applications, run on node.js
webpack supports modules written in a variety of languages and preprocessors, via loaders

loaders: describe to webpack how to process non-JavaScript modules and include these dependencies into your bundles

plugins: perform a wider range of tasks, anything else that a loader cannot do

mode: enviroment

entry point: where to begin building out its internal dependency graph

dependency graph

In a typical application or site built with webpack, there are three main types of code:
- The source code
- Any third-party library or "vendor" code source is dependent on
- A webpack **runtime** and **manifest** that conducts the interaction of all modules

HMR: Hot Module Replacement
allows all kinds of modules to be updated at runtime without the need for a full refresh

# Why: to use js on the web

- load multiple .js -> network bottleneck(1)
- solve (1): load big one .js -> scope(2), size, readability, maintainablity
- solve (2): IIFEs & task runner (Make, Gulp, Grunt, Broccoli, Brunch) -> hard to rebuild, lazy load
- solve (2): Node.js & CommonJS `require` to do module -> can not run in browser(3)
- solve (3): Browserify | RequireJS | SystemJS
- solve (3): ESM (ECMAScript module) -> incomplete browser support
- solve all: Bundler: support any module format, handle resources and assets

# Module

applies the concept of modules to **any** file in your project, via loaders

to express dependency:
- ES: `import`
- CommonJS: `require()`
- AMD: `define` and `require`
- css/sass/less/: `@import` or `url(...)`
- html: `<img src=...>`

resolver: a library which helps in locating a module by its absolute path, can solve:
- absolute path: `import /home/me/file`
- relative path: `import ../src/file`
- module path: `resolve.modules`, `resolve.alias`, `resolve.extensions`, `resolve.mainFields`

# Guide

## Install

`npm install --save-dev webpack`
`npm install --save-dev webpack-cli`

## Basic

project structure:

```
project
|- package.json         // npm dependencies
|- webpack.config.js    // default webpack config
|- /dist                // bundled distribution files
  |- index.html         // browser index.html
  |- main.js            // generated main entry point for browser
|- /src                 // source files
  |- index.js           // default entry point
|- /node-modules        // npm modules
```

to do bundle:

run `npx webpack`

or if you specified

```js
"scripts": {
  "test": "echo \"Error: no test specified\" && exit 1",
  "build": "webpack"
}
```

in `pacakge.json`, you can also run `npm run build`

note:  If you are using other ES2015 features, make sure to use a transpiler such as Babel or Bublé via webpack's loader system

## Loading CSS

install loaders: `npm install --save-dev style-loader css-loader`

add module rules into webpack config file

use `import './style.css'` to import css

webpack will insert strigified css into `<head>` of html file for you

## Loading Image

install loaders: `npm install --save-dev file-loader html-loader`

add module rules into webpack config file

use `import MyImage from './my-image.png'` in `.js`,
or `url('./my-image.png')` in css
or `<img src="./my-image.png" />` in html
to import image

## Loading Fonts

add loader `file-loader` and module rules

use `@font-face` in css

## Loading Data (JSON/CSV/TSV/XML...)

add loader `csv-loader` & `xml-loader`

use `import Data from './data.json'` in .js

## Output Management

multiple entry point?

`HtmlWebpackPlugin` plugin?

it's good practice to clean the /dist folder before each build: use `clean-webpack-plugin` plugin

webpack use `manifest` to track how all the modules map to the output bundle, use `WebpackManifestPlugin` to extract manifest to json

## Development (**NOT FOR PRODUCTION!**)

track down error to origin file: `devtool: 'inline-source-map'` config

avoid `npm run build` every time (auto compile):

- webpack's Watch Mode

1. in `package.json` `script` block, add `"watch": "webpack --watch"`
2. then run `npm run watch`

- webpack-dev-server (preferred, can alos auto-reload browser)

1. run `npm install --save-dev webpack-dev-server`
2. add to webpack config file:

```js
const webpack = require('webpack');

module.exports = {
  devServer: {
    contentBase: './dist',
    hot: true // enable HMR
              // NOTE: HMR can be tricky, better use community loader like `vue loader` to do HMR
  },
  plugins: {
    new webpack.HotModuleReplacementPlugin()
  }
}
```

3. add to `package.json` `script` block: `"start": "webpack-dev-server --open",`
4. run `npm run start`, will serve `./dist` file in `localhost:8080`

- webpack-dev-middleware, see <https://webpack.js.org/guides/development/#using-webpack-dev-middleware>

## Code Splitting

help to split your code into various bundles which can then be loaded on demand or in parallel

three way to do code splitting:

1. Entry Points: Manually split code using entry configuration -> can lead to duplication

2. Prevent Duplication: Use the `SplitChunksPlugin` to dedupe and split chunks. other related plugins
    - `mini-css-extract-plugin`: splitting CSS out from the main application
    - `bundle-loader`: split code and lazy load the resulting bundles
    - `promise-loader`: Similar to the bundle-loader but uses promises

3. Dynamic Imports: Split code via inline function calls within modules

config: `chunkFileName`
code: `import(/* webpackChundName: "lodash" */).then()`

prefetching & preload

## Lazy Loading



## Tree Shaking

to eliminate dead-code

## Production

recommend writing separate webpack configurations for each environment
maintain a "common" configuration to keep things DRY
use `webpack-merge` to merge these configurations together

1. run `npm install --save-dev webpack-merge`
2. add `webpack.common.js`, `webpack.dev.js`, `webpack.prod.js`
3. add to `package.json` `script` block:

```js
  "start": "webpack-dev-server --open --config webpack.dev.js",
  "build": "webpack --config webpack.prod.js"
```

4. run `npm run start` for dev or `npm run build` for prod
