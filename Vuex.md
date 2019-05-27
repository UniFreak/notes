# Ref
- official: <https://vuex.vuejs.org/>

# What

a state management pattern + library for Vue.js applications

inspired by `Flux`, `Redux` and `The Elm Architecture`

alternatives: <https://vuejs.org/v2/guide/state-management.html#Simple-State-Management-from-Scratch>

pros
- vuex is reactive
- every state change leaves a track-able record

# Concepts

state:
- single state tree: one source of truth
- exposed by `store.state`
- `mapState` helper: generates computed getter functions

getter:
- compute derived state based on store state
- exposed by `state.getters`
- `mapGetter` helper: maps store getters to local computed properties

mutation:
- only way to actually change state
- reactive: vue components observing the state will update automatically
- mutation handler functions must be synchronous
- invoke by `store.commit()`
- `mapMutations` helper: maps component methods to store.commit calls

action:
- similar to mutation, but:
- instead of mutating the state, actions commit mutations
- actions can contain arbitrary asynchronous operations
- invoke by `store.dispatch()`
- `mapActions` helper: maps component methods to store.dispatch calls

modules:
- can contain its own state, mutations, actions, getters and be nested
- accessed by `store.state.A`
- inside module, access root state by `context.rootState`

# Best Practice:
- Application-level state is centralized in the store.
- The only way to mutate the state is by committing mutations, which are synchronous transactions
- Asynchronous logic should be encapsulated in, and can be composed with actions.