# Ref
- resources: <https://github.com/vuejs/awesome-vue>
- plugin dev: <https://cli.vuejs.org/dev-guide/plugin-dev.html>

# Learn steps
- ~~read before using cli <https://vuejs.org/v2/guide/single-file-components.html>~~
- ~~learn about npm~~
- ~~learn es6 <https://babeljs.io/docs/en/learn>~~
- learn node.js ?
- ~~learn webpack <https://webpack.js.org/>~~
- ~~learn vue cli: <https://cli.vuejs.org/>~~
- learn some real app tuts
    + blog: <https://vuejs.org/v2/cookbook/serverless-blog.html>
- learn how to integret with lumen
    + <https://github.com/albertcht/lumen-vue-starter>
    + laravel: <https://laravel.com/docs/master/frontend>
    + <https://vuejs-templates.github.io/webpack/backend.html>
    + search the web: lumen+vue
    + lumen+vue tuts found in <https://github.com/vuejs/awesome-vue>
    + axios:
        * official: <https://github.com/axios/axios>
        * cookbook: <https://vuejs.org/v2/cookbook/using-axios-to-consume-apis.html>
    + elementui: <https://element.eleme.cn/#/en-US>
- ~~learn deploy: <https://cli.vuejs.org/guide/deployment.html>~~
- ~~learn router: <https://router.vuejs.org/>~~
- interesting:
    + dockerize: <https://vuejs.org/v2/cookbook/dockerize-vuejs-app.html>

# Install
- vue: `npm install vue`
- vue-devtools: `npm install -g @vue/devtools`
- vue cli

do not recommend that beginners start with vue-cli, especially if you are not yet familiar with Node.js-based build tools

# Guide

declarative rendering
- text interpolation
- `v-` directive, reactive behavior
- bind data to element text / attributs / structure

conditional & loops
- `v-if`
- `v-for`

user input
- `v-on` to bind event listener
- `v-model` to two way bind between input and app state

component: a Vue instance with pre-defined options
- `vue.component()`
- data, prop, computed
- computed vs method: Computed properties get cached

watcher:

single-file components: `.vue` extension
- template: html
- logic: js
- style: css

# Style Guide
must:

- Component names should always be multi-word, except for root App components, and built-in components provided by Vue, such as <transition> or <component>
- Component data must be a function, except for root Vue instance
- Prop definitions should be as detailed as possible
- Always use key with `v-for`
- Never use `v-if` on the same element as `v-fo`r
- For applications, styles in a top-level App component and in layout components may be global, but all other components should always be scoped
- Use module scoping to keep private functions inaccessible from the outside. If that’s not possible, always use the $_ prefix for custom private properties in a plugin, mixin, etc that should not be considered public API. Then to avoid conflicts with code by other authors, also include a named scope (e.g. $_yourPluginName_)

better:

- Whenever a build system is available to concatenate files, each component should be in its own file
- Filenames of single-file components should either be always PascalCase or always kebab-case
- Base components (a.k.a. presentational, dumb, or pure components) that apply app-specific styling and conventions should all begin with a specific prefix, such as Base, App, or V
- Components that should only ever have a single active instance should begin with the The prefix, to denote that there can be only one
- Child components that are tightly coupled with their parent should include the parent component name as a prefix
- Component names should start with the highest-level (often most general) words and end with descriptive modifying words
- Components with no content should be self-closing in single-file components, string templates, and JSX - but never in DOM templates
- In most projects, component names should always be PascalCase in single-file components and string templates - but kebab-case in DOM templates
- Component names in JS/JSX should always be PascalCase, though they may be kebab-case inside strings for simpler applications that only use global component registration through Vue.component
- Component names should prefer full words over abbreviations
- Prop names should always use camelCase during declaration, but kebab-case in templates and JSX
- Elements with multiple attributes should span multiple lines, with one attribute per line
- Component templates should only include simple expressions, with more complex expressions refactored into computed properties or methods.
- Complex computed properties should be split into as many simpler properties as possible
- Non-empty HTML attribute values should always be inside quotes (single or double, whichever is not used in JS)
- Directive shorthands (: for v-bind: and @ for v-on:) should be used always or never

good:

- Component/instance options should be ordered consistently
- The attributes of elements (including components) should be ordered consistently
- You may want to add one empty line between multi-line properties, particularly if the options can no longer fit on your screen without scrolling
- Single-file components should always order <script>, <template>, and <style> tags consistently, with <style> last, because at least one of the other two is always necessary

# Best practice
- NEVER manipulate the DOM
- A property should NEVER be modified from inside a component

# `Vue` instance

Vue application consists of a root Vue instance created with new Vue, optionally organized into a tree of nested, reusable components

all Vue components are also Vue instances, and so accept the same options object (except for a few root-specific options), exception the use of `Object.freeze()`

properties in data are only reactive if they existed when the instance was created

properties
- data

lifecycle hooks
- beforeCreate, created
- beforeMount, mounted
- beforeUpdate, updated
- beforeDestroy, destroyed

**Don’t use arrow functions on an options property or callback**

# Template Syntax

Under the hood, Vue compiles the templates into Virtual DOM render functions. you can also directly write render functions instead of templates