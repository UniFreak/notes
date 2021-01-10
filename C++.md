# See

Book: <C Primer>

# Sepcial Technique

链接指示用于支持调用其他语言编写的函数

```cpp
extern "Ada" ...;

extern "C" {

}
```

使用 `__cplusplus` 编译器变量, 支持在 C 和 C++ 中编译同一个源文件

```cpp
#ifdef __cplusplus
extern "C"
#endif
int strcmp(const char*, const char*);
```
