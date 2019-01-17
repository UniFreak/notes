- find out specific version python executable path:

```
pyenv local 3.4.4
pyenv which python
```

- macOS: if `pyenv install 3.4.4` error about `zlib not availabel`, run:

```
xcode-select --install
sudo installer -pkg /Library/Developer/CommandLineTools/Packages/macOS_SDK_headers_for_macOS_10.14.pkg -target /
```
