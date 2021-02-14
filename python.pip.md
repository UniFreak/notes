# Install

- install local source: `pip install -e .` or `pip install .`
- uninstall all: `pip freeze | grep -v "^-e" | xargs pip uninstall -y`
- uninstall package with its dependency:

```
pip install pip-autoremove
pip-autoremove somepackage -y
```

# Update

`pip install [pkg] --upgrade`

# 切换其他源

- 阿里: `pip config set global.index-url https://mirrors.aliyun.com/pypi/simple/`
- 清华: `https://pypi.tuna.tsinghua.edu.cn/simple`
- 官方: `https://pypi.python.org/simple`

临时用可用 `pip install -i <源地址>`