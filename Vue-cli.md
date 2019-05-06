# Why

provide:
- Interactive project scaffolding via `@vue/cli`
- Zero config rapid prototyping via `@vue/cli` + `@vue/cli-service-global`
- A runtime dependency (`@vue/cli-service`) that is:
    + Upgradeable
    + Built on top of webpack, with sensible defaults
    + Configurable via in-project config file
    + Extensible via plugins
- A rich collection of official plugins integrating the best tools in the frontend ecosystem
- A full graphical user interface to create and manage Vue.js projects

# Three component

- global cli (`@vue/cli`) to run `vue` command
- local installed cli-service (`@vue/cli-service`)
- cli plugins (`@vue/cli-plugin-*` for built-in or `vue-cli-plugin-*` for community)

# Install

1. install: run `sudo npm install -g @vue/cli` to
2. verify: run `vue --version`

# Basic

instanc prototype:
- `vue serve`: relies on global dependencies, only for fast prototype
- `vue build`: build a .js or .vue file in production mode

create project:
- `vue create`: create new project
- `vue ui`: open vue ui to manage vue projects

preset: saved to `~/.vuerc` during `vue create`

install plugin:
- `vue add`, install, (NOTE: better commit your project's before this)
- `vue invoke`: invoke plugin's generator

use cli service:
- `vue-cli-service serve` or `npm run serve`: start a dev server
- `vue-cli-service build` or `npm run build`: produce production-ready bundle
- `vue-cli-service inspect`: inspect webpack config
- `vue-cli-service help`: show all commands

NOTE:
- if running into compilation issues, always try deleting `node_modules/.cache`

# Development