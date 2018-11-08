- Look Before You Leap (LBYL) - suffer from race condition

```python
if os.path.exists(filename):
    os.remove(filename)
```

- Easier to Ask Forgiveness than to get Permission, or EAFP

```python
try:
    os.remove(filename)
except OSError as e:
    if e.errno != errno.ENOENT:
        raise
```
