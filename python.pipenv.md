# See

Doc: <https://pipenv.pypa.io/en/latest/>

# Concept

Pipenv is a dependency manager for Python projects. If you’re familiar with Node.js’s npm or Ruby’s bundler, it is similar in spirit to those tools.

It automatically creates and manages a virtualenv for your projects, as well as adds/removes packages from your Pipfile as you install/uninstall packages. It also generates the ever-important Pipfile.lock, which is used to produce deterministic builds.

You no longer need to use pip and virtualenv separately. They work together.

Managing a requirements.txt file can be problematic, so Pipenv uses Pipfile and Pipfile.lock to separate abstract dependency declarations from the last tested combination.

Streamline development workflow by loading .env files.

The virtualenv is stored globally with the name of the project’s root directory plus the hash of the full path to the project’s root (e.g., my_project-a3de50).

If you change your project’s path, you break such a default mapping and pipenv will no longer be able to find and to use the project’s virtualenv.

You might want to set export PIPENV_VENV_IN_PROJECT=1 in your .bashrc/.zshrc (or any shell configuration file) for creating the virtualenv inside your project’s directory, avoiding problems with subsequent path changes.

# Install

`brew install pipenv` or `pip install --user pipenv`

`brew upgrade pipenv` or `pip install --user --upgrade pipenv`

# Usage

Set up new env: `pipenv --python 2.7.14`

Install Package: `cd myproject` and `pipenv install requests`

Run Script: `pipenv run python my.py`

Open a Shell: `pipenv shell`

Remove env: `pipenv --rm`

# Misc

- 更换源: 编辑 Pipfile
- 清华源: https://pypi.tuna.tsinghua.edu.cn/simple
- if `pipenv install koala2` error, try

```
pipenv lock --pre --clear
```
