# Ref
- dev: <https://cli.vuejs.org/dev-guide/plugin-dev.html>
- <https://github.com/vuejs/awesome-vue>

# Learn steps
- read before using cli <https://vuejs.org/v2/guide/single-file-components.html>
- ~~learn about npm~~
- ~~learn es6 <https://babeljs.io/docs/en/learn>~~
- learn node.js ?
- ~~learn webpack <https://webpack.js.org/>~~
- learn vue cli: <https://cli.vuejs.org/>

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

single-file components: `.vue` extension
- template: html
- logic: js
- style: css