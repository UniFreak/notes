# Ref
- official: <https://router.vuejs.org/>

# Why

make building Single Page Applications with Vue.js a breeze

# How

all we need to do is
1. map our components to the routes
2. let Vue Router know where to render them

```js
// 0. If using a module system (e.g. via vue-cli), import Vue and VueRouter
// and then call `Vue.use(VueRouter)`.

// 1. Define route components.
// These can be imported from other files
const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes // short for `routes: routes`
})

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
const app = new Vue({
  router
}).$mount('#app');

// Now the app has started!
```

By injecting the router, we get access to it as `this.$router` as well as the current route as `this.$route` inside of any component

# Dynamic Route Matching

dynamic segment: use `:` to denote, `{ path: '/user/:id', component: User }`, access by `$route.params.id`

match anything: use `*`, access by `$route.params.pathMatch`

match priority: the earlier defined the higher

# Nested Route

a rendered component can also contain its own, nested `<router-view>`, using `children`:

```js
routes: [
    { path: '/user/:id', component: User,
      children: [
        // UserHome will be rendered inside User's <router-view>
        // when /user/:id is matched
        { path: '', component: UserHome },
        {
          // UserProfile will be rendered inside User's <router-view>
          // when /user/:id/profile is matched
          path: 'profile',
          component: UserProfile
        },
        {
          // UserPosts will be rendered inside User's <router-view>
          // when /user/:id/posts is matched
          path: 'posts',
          component: UserPosts
        }
      ]
    }
  ]
```

# Programmatic Navigation

aside from `<router-link>` declarativelywe can use

- `router.push()`
- `router.replace()`
- `router.go()`

# Named Route

name: `routes:[ {name: 'user'} ]`
use:
- `<router-link :to={ name: 'user'}> </router-link>`
- `router.push({ name: 'user'})` | `router.replace()` | `router.go()`

# Named View

name: `<route-view name="b"></route-view>`, default name is `default`

It is possible to create complex layouts using named views with nested views

# Redirects and Alias

redirect: means when the user visits `/a`, the URL will be replaced by `/b`

define:
- nomal: `routes: [ { path: '/a', redirect: '/b'} ]`
- named: `routes: [ { path: '/a', redirect: { name: 'foo' }} ]`
- function: `routes: [ { path: '/a', redirect: to => {} } ]`

alias of /a as /b: means when the user visits /b, the URL remains /b, but it will be matched as if the user is visiting /a

define: `routes: [ { path: '/a', alias: '/b' } ]`

# Passing Props

Using `$route` in your component creates a tight coupling with the route, use `prop` to decouple

```js
const User = {
  props: ['id'],
  template: '<div>User {{ id }}</div>'
}
const router = new VueRouter({
  routes: [
    { path: '/user/:id', component: User, props: true },

    // for routes with named views, you have to define the `props` option for each named view:
    {
      path: '/user/:id',
      components: { default: User, sidebar: Sidebar },
      props: { default: true, sidebar: false }
    }
  ]
});
```

Try to keep the props function stateless

# History Mode

default is hash mode, notice the ugly `#` in the url

using history mode: `new VueRouter({mode: 'history'})`

# Navigation Guards

global (defined on `router`)

- `router.beforEach()`: when a navigation is triggered
- `router.beforeResolve()`: before a navigation is confirmed
- `router.afterEach()`

per-route (defined in `routes: []` config)

- `beforeEnter`

in-component (defined in component)

- `beforeRouteEnter()`
- `beforeRouteUpdate()`
- `beforeRouteLeave()`

# @? Meta Fields

# Transition

we can apply transition effects to routes

# Data Fetching

after navigation:

before navigation:

# Scroll Behavior

`scrollBehavior()`

# @? Lazy Loading Routes