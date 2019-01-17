- install local source: `pip install -e .` or `pip install .`
- uninstall all: `pip freeze | grep -v "^-e" | xargs pip uninstall -y`
- 清华源: https://pypi.tuna.tsinghua.edu.cn/simple
- uninstall package with its dependency:

```
pip install pip-autoremove
pip-autoremove somepackage -y
```
