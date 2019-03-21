# Refs
- https://docs.python-guide.org/writing/structure/
- https://gehrcke.de/2014/02/distributing-a-python-command-line-application/
- https://packaging.python.org/tutorials/packaging-projects/
- https://packaging.python.org/guides/distributing-packages-using-setuptools/
- https://pypi.org/project/pypiserver/
- https://packaging.python.org/discussions/install-requires-vs-requirements/#install-requires-vs-requirements-files

# Memo
- `pypi-server -p 8080 -P htpasswd.txt ~/Pypi/ &`
- `python setup.py sdist bdist_wheel`
- `twine upload --repository-url http://localhost:8080 dist/*`

# Goal
- see dev change instantly
- module usage
    + standard module
    + cli command

# Availabel tools
- local pypi: devpi / pypiserver / warehouse

# Pacakge Structure

# Distrubution

## Use Local

## Use Git

## Use Pypi

### Types

### Make wheel

### Upload

### Install and test
