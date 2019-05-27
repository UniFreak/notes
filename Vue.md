# Ref
- resources: <https://github.com/vuejs/awesome-vue>
- plugin dev: <https://cli.vuejs.org/dev-guide/plugin-dev.html>

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
- Never use `v-if` on the same element as `v-for`
- For applications, styles in a top-level App component and in layout components may be global, but all other components should always be scoped
- Use module scoping to keep private functions inaccessible from the outside. If that’s not possible, always use the `$_` prefix for custom private properties in a plugin, mixin, etc that should not be considered public API. Then to avoid conflicts with code by other authors, also include a named scope (e.g. `$_yourPluginName_`)

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

basic, text, mustache: `{{ msg }}`, can contain one single js expression
disable reactive: `v-once`
for html: `v-html`
for attributes: `v-bind`

directive: reactively apply side effects to the DOM when the value of its expression changes
arguments:
    - denoted by a colon after the directive name, like `href` in `v-bind:href`
    - dynamic: wrapping it with square brackets, like `v-bind:[attrName]`, if evaluated to null, will remove binding
modifier: postfixes denoted by a dot, like `.prevent` in `v-on:submit.prevent`, can be chained, order matters
two shorthands: `v-bind` -> `:`, `v-on` -> `@`

# Computed: for any complex logic

`computed: {}`

vs method: computed properties are cached based on their reactive dependencies

default to getter-only, but can specify setter

it is often a better idea to use a computed property rather than an imperative watch callback

# Watcher

```js
watch: {
  prop: function (oldValue, newValue) {}
}
```

or `vm.$watch` API

most useful when you want to perform asynchronous or expensive operations in response to changing data

# Class Binding

**NOTE**: `class` here mean only html class

array: `v-bind:class="[activeClass, errorClass]"`

inline object: `v-bind:class="{ active: isActive }"`

seperate object: `v-bind:class="classObject"`, so we can use computed property

condition:
- ternary: `v-bind:class="[isActive ? activeClass : '', errorClass]"`
- `:`: `v-bind:class="[{ active: isActive }, errorClass]"`

When you use the class attribute on a custom component, those classes will be added to the component’s root element. Existing classes on this element will not be overwritten

# Style Binding

Vue will automatically detect and add appropriate prefixes to the applied styles

inline object: `v-bind:style="{ color: activeColor, fontSize: fontSize + 'px' }"`

seperate object: `v-bind:style="styleObject"`, so we can use computed property

# Conditional Rendering

if:

`v-if`, `v-elseif`, `v-else`

use `v-if` on a `<template>` to toggle more than one element

Vue always try to re-use elements, use `key` to avoid this

show:

`v-show`

vs if:
- `v-show` only toggle `display` CSS property
- prefer `v-show` if you need to toggle something very often
- prefer `v-if` if the condition is unlikely to change at runtime

# List Rendering

`v-for`

integer: `v-for="n in 10"`

array:

- `="item in items"` or `="item of items"`
- `="(item, index) in items"` or `="(item, index) of items"`

object:

- `="value in object"`
- `="(value, name) in object"`
- `="(value, name, index) in object"`


default use `in-place patch` strategy.
provide a unique `key` attribute for each item to do `reuse and reorder` (recommended)

mutation methods is reactive

- `push()`
- `pop()`
- `shift()`
- `unshift()`
- `splice()`
- `sort()`
- `reverse()`

to make non-mutating method reactive, do replacement

- `filter()`
- `concat()`
- `slice()`

this also non-reactive, use `Vue.set()` or `splice` instead

- `vm.items[indexOfItem] = newValue`
- `vm.items.length = newLength`

for object, use `Vue.set()` or replacement with `Object.assign()`

in order to pass the iterated data into component, we should also use props

# Listening to Events

`v-on`

event modifiers:
- `.stop`
- `.prevent`
- `.capture`
- `.self`
- `.once`
- `.passive`

key mofifiers:
- key names: `.enter`, `.page-down`, ...
- mouse names: `.left`, `.right`, `.middle`
- `.exact`

# Form Input Bindings

`v-model`

essentially syntax sugar for updating data on user input events, plus special care for some edge cases

modifiers:
- `.lazy`
- `.number`
- `.trim`

# Component

reusable Vue instances with a name, accept the same options, except for root-specific options

a component’s data option must be a function

every component must have a single root element

pass data to child components with `props`:

```js
Vue.component('blog-post', {
  props: ['title'],
  template: '<h3>{{ title }}</h3>'
});
```

```html
<blog-post title="My journey with Vue"></blog-post>
<blog-post title="Blogging with Vue"></blog-post>
```

define & register globally: `Vue.component('component-name', {})`

use: `<component-name></component-name>`

use `$emit()` to
- listeng to child component events
- Using `v-model` on Components

`<slot>`, `v-slot`, `<template>`: see <https://vuejs.org/v2/guide/components-slots.html>

slot most useful when you are designing a reusable component that encapsulates data logic while allowing the consuming parent component to customize part of its layout. to see the power of slot, view libiray like  `Vue Virtual Scroller`, `Vue Promised`, and `Portal Vue`

use `is` to

- do Dynamic & Async Components
- avoid DOM nested element restriction

**Async Component**:

see <https://alexjover.com/blog/lazy-load-in-vue-using-webpack-s-code-splitting/>

vue:

```js
Vue.component('async-example', function (resolve, reject) {
  setTimeout(function () {
    // Pass the component definition to the resolve callback
    resolve({
      template: '<div>I am async!</div>'
    })
  }, 1000)
});
```

with webpack:

```js
// webpack code splitting with `require()`
Vue.component('async-webpack-example', function (resolve) {
  // This special require syntax will instruct Webpack to
  // automatically split your built code into bundles which
  // are loaded over Ajax requests.
  require(['./my-async-component'], resolve)
})

// or do global registration with `import()`
Vue.component(
  'async-webpack-example',
  // The `import` function returns a Promise.
  () => import('./my-async-component')
);

// or do local registration with `import()`
new Vue({
  // ...
  components: {
    'my-component': () => import('./my-async-component')
  }
});
```

# Mixins

a flexible way to distribute reusable functionalities for Vue components

# Custom Directives

`Vue.directive()`

# Render Function & JSX

`render` function: a closer-to-the-compiler alternative to templates

```js
render: function (createElement) {
  return createElement()
}
```

concepts:
- Virtual Node: what `render` function return, descriptions of real DOM Node, aka VNode
- Virtual DOM: the entire tree of VNodes, built by a tree of Vue components

`createElement` function:

```js
// @returns {VNode}
createElement(
  // {String | Object | Function}
  // An HTML tag name, component options, or async
  // function resolving to one of these. Required.
  'div',

  // {Object}
  // A data object corresponding to the attributes
  // you would use in a template. Optional.
  {
    // Same API as `v-bind:class`, accepting either
    // a string, object, or array of strings and objects.
    class: {
      foo: true,
      bar: false
    },
    // Same API as `v-bind:style`, accepting either
    // a string, object, or array of objects.
    style: {
      color: 'red',
      fontSize: '14px'
    },
    // Normal HTML attributes
    attrs: {
      id: 'foo'
    },
    // Component props
    props: {
      myProp: 'bar'
    },
    // DOM properties
    domProps: {
      innerHTML: 'baz'
    },
    // Event handlers are nested under `on`, though
    // modifiers such as in `v-on:keyup.enter` are not
    // supported. You'll have to manually check the
    // keyCode in the handler instead.
    on: {
      click: this.clickHandler
    },
    // For components only. Allows you to listen to
    // native events, rather than events emitted from
    // the component using `vm.$emit`.
    nativeOn: {
      click: this.nativeClickHandler
    },
    // Custom directives. Note that the `binding`'s
    // `oldValue` cannot be set, as Vue keeps track
    // of it for you.
    directives: [
      {
        name: 'my-custom-directive',
        value: '2',
        expression: '1 + 1',
        arg: 'foo',
        modifiers: {
          bar: true
        }
      }
    ],
    // Scoped slots in the form of
    // { name: props => VNode | Array<VNode> }
    scopedSlots: {
      default: props => createElement('span', props.text)
    },
    // The name of the slot, if this component is the
    // child of another component
    slot: 'name-of-slot',
    // Other special top-level properties
    key: 'myKey',
    ref: 'myRef',
    // If you are applying the same ref name to multiple
    // elements in the render function. This will make `$refs.myRef` become an
    // array
    refInFor: true
  },

  // {String | Array}
  // Children VNodes, built using `createElement()`,
  // or using strings to get 'text VNodes'. Optional.
  [
    'Some text comes first.',
    createElement('h1', 'A headline'),
    createElement(MyComponent, {
      props: {
        someProp: 'foobar'
      }
    })
  ]
);
```

aliasing `createElement` to `h` is a common convention

`JSX`: a Babel plugin to use JSX with Vue, getting us back to a syntax that’s closer to templates

```js
import AnchoredHeading from './AnchoredHeading.vue'

new Vue({
  el: '#demo',
  render: function (h) {
    return (
      <AnchoredHeading level={1}>
        <span>Hello</span> world!
      </AnchoredHeading>
    )
  }
})
```

# Plugins

add global-level functionality to Vue

# Filters

apply common text formatting

# Single File Components

`.vue`

# State Management

goal:
- record all state mutations happening to the store
- implement advanced debugging helpers

ways:
1. source of truth: debug night mare
2. the store pattern
3. flux architecture
4. vuex

# Server-Side Rendering (SSR)

knowlege requirements:
- client-side Vue development
- server-side Node.js development
- webpack

see <https://ssr.vuejs.org/>

# Reactivity in Depth

# API

## Config

`Vue.config`:
- `.silent`
- `.optionMergeStrategies`
- `.devtools`
- `.errorHandler`, related: sentry, bugsnap
- `.warnHandler`
- `.ignoredElements`
- `.keyCodes`: define custom key alias(es) for `v-on`
- `.performance`
- `.productionTip`

## Global

- `Vue.extendd()`: Create a “subclass” of the base Vue constructor
- `Vue.nextTick()`
- `Vue.set()`: Adds a property to a reactive object
- `Vue.delete()`: Delete a property on an object
- `Vue.directive()`: Register or retrieve a global directive
- `Vue.filter()`: Register or retrieve a global filter
- `Vue.component()`: Register or retrieve a global componen
- `Vue.use()`: Install a Vue.js plugin
- `Vue.mixin()`: Apply a mixin globally
- `Vue.compile`: Compiles a template string into a render function
- `Vue.observable()`: Make an object reactive

- `Vue.version`

## Options-Data

- `data` -> `vm.$data` -> `vm.a`: `_` or `$` prefixed data will not be proxied to `vm`
- `props`: accept data from the parent component
    + type: String|Number|Boolean|Array|Object|Date|Function|Symbol
    + default: any
    + required: Boolean
    + validator: Function
- `propsData`: Pass props to an instance during its creation
- `computed`: Computed properties to be mixed into the Vue instance
- `methods`: Methods to be mixed into the Vue instance
- `watch`: An object where keys are expressions to watch and values are the corresponding callbacks

## Options-DOM

- `el` -> `vm.$el`: existing DOM element to mount on
- `template`: the markup for the Vue instance
- `render`: alternative to `templates` to leverage the full programmatic power of JS
- `renderError`: render output when the default render function encounters an error

## Options-Hooks

- `beforeCreate`
- `created`
- `beforeMount`
- `mounted`
- `beforeUpdate`
- `updated`
- `activated`
- `deactivated`
- `beforeDestroy`
- `destroyed`
- `errorCaptured`

## Options-Assets

- `directives`: directives to be made available to the Vue instance
- `filters`: filters to be made available to the Vue instance
- `components`: components to be made available to the Vue instance

## Options-composition

- `parent` -> `this.$parent`: Specify the parent instance for the instance to be created
- `mixins`: accepts an array of mixin objects
- `extends`: declaratively extending another component
- `provide`/`inject`:  allow an ancestor component to serve as a dependency injector for all its descendants

## Options-Misc

- `name`
- `delimeters`: Change the plain text interpolation delimiters
- `functional`: Causes a component to be stateless
- `model`: customize the prop and event used when it’s used with v-model
- `inheritAttrs`:
- `comments`: preserve and render HTML comments found in templates

## Instance Properties

- `vm.$data`
- `vm.$props`
- `vm.$el`
- `vm.$options`
- `vm.$parent`
- `vm.$root`
- `vm.$children`
- `vm.$slots`
- `vm.$scopedSlots`
- `vm.$refs`: An object of DOM elements and component instances, registered with ref attributes
- `vm.$isServer`
- `vm.$attrs`
- `vm.$listeners`

## Instance Methods

Data:

- `vm.$watch()`
- `vm.$set()` -> `Vue.set`
- `vm.$delete()` -> `Vue.delete`

Events:

- `vm.$on()`
- `vm.$once()`
- `vm.$off()`
- `vm.$emit()`

Lifecycle:

- `vm.$mount()`
- `vm.$forceUpdate()`
- `vm.$nextTick()`
- `vm.$destroy()`

## Directives

- `v-text`
- `v-html`
- `v-show`
- `v-if`, `v-else-if`, `v-else`
- `v-for`
- `v-on`
- `v-bind`
- `v-model`
- `v-slot`
- `v-pre`: Skip compilation for this element and all its children
- `v-cloak`: used to hide un-compiled mustache bindings until the Vue instance is ready
- `v-once`

## Special Attributes

- `key`
- `ref`: register a reference to an element or a child component under parent component’s `$refs`
- `is`

## Built-In Components

- `<component>`: A “meta component” for rendering dynamic components
- `<transition>`: serve as transition effects for single element/component.
- `<transition-group>`: serve as transition effects for multiple elements/components
- `<keep-alive>`: caches the inactive component instances without destroying them
- `<slot>`: serve as content distribution outlets in component templates
