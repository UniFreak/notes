# coodie

- 以问号结束的注释, 注释 if 分支

```php
// Worksheet reference?
if (strpos($pCoordinate, '!') !== false) {
    $worksheetReference = self::extractSheetTitle($pCoordinate, true);

    return $this->parent->getSheetByName($worksheetReference[0])->getCell(strtoupper($worksheetReference[1]), $createIfNotExists);
}
```