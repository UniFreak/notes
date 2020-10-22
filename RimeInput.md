# Config

use YAML, Regex

# Directory

Shared: /Library/Input Methods/Squirrel.app/Contents/SharedSupport/  DON'T EDIT

User: ~/Library/Rime/ Click User Setting
- Global setting: default.yaml
- Release version setting: weasel.yaml
- Preset Schema: <Schema>.schema.yaml
- *Install Info: installation.yaml
- *User status: user.yaml

Binary files after
- <Schema>.prism.bin
- <Dict>.table.bin
- <Dict>.reverse.bin

*User input habits:
- <Dict>.userdb
- <Dict>.userdb.txt

*User Setting
- Global User Setting: default.custom.yaml
- Schema: <Schema>.custom.yaml

**Back Up the * files**

# Schema

Schema Definition include:
- <Schema>.schema.yaml: include description, feature setting(affect how engine work)
- Dict file

Engine workflow
1. keyboard click
2. backend service
3. distribute to corresponding _session_
4. handle by _schema menu_ or _engine_
    1. load input schema, prepare _feature components_
    2. enter click handle cycles...

```yaml
# Rime schema
# encoding: utf-8

schema:
  schema_id: luna_pinyin # can be lower case letter, nums, and underscore.
  name: 朙月拼音 # will be displayed in schema menu
  version: "0.24" # seperated by comma
  author:
    - 佛振 <chen.sst@gmail.com>
  description: |
    Rime 預設的拼音輸入方案。
    參考以下作品而創作：
      * CC-CEDICT
      * Android open source project
      * Chewing - 新酷音
      * opencc - 開放中文轉換
  dependencies:
    - stroke

switches:
  - name: ascii_mode
    reset: 0
    states: [ 中文, 西文 ]
  - name: full_shape
    states: [ 半角, 全角 ]
  - name: simplification
    states: [ 漢字, 汉字 ]
  - name: ascii_punct
    states: [ 。，, ．， ]

    engine:                    # 輸入引擎設定，即掛接組件的「處方」
      processors:              # 一、這批組件處理各類按鍵消息
        - ascii_composer       # ※ 處理西文模式及中西文切換
        - recognizer           # ※ 與 matcher 搭配，處理符合特定規則的輸入碼，如網址、反查等
        - key_binder           # ※ 在特定條件下將按鍵綁定到其他按鍵，如重定義逗號、句號爲候選翻頁鍵
        - speller              # ※ 拼寫處理器，接受字符按鍵，編輯輸入碼
        - punctuator           # ※ 句讀處理器，將單個字符按鍵直接映射爲文字符號
        - selector             # ※ 選字處理器，處理數字選字鍵、上、下候選定位、換頁鍵
        - navigator            # ※ 處理輸入欄內的光標移動鍵
        - express_editor       # ※ 編輯器，處理空格、回車上屏、回退鍵等
      segmentors:              # 二、這批組件識別不同內容類型，將輸入碼分段
        - ascii_segmentor      # ※ 標識西文段落
        - matcher              # ※ 標識符合特定規則的段落，如網址、反查等
        - abc_segmentor        # ※ 標識常規的文字段落
        - punct_segmentor      # ※ 標識句讀段落
        - fallback_segmentor   # ※ 標識其他未標識段落
      translators:             # 三、這批組件翻譯特定類型的編碼段爲一組候選文字
        - echo_translator      # ※ 沒有其他候選字時，回顯輸入碼
        - punct_translator     # ※ 轉換標點符號
        - script_translator    # ※ 腳本翻譯器，用於拼音等基於音節表的輸入方案
        - reverse_lookup_translator  # ※ 反查翻譯器，用另一種編碼方案查碼
      filters:                 # 四、這批組件過濾翻譯的結果
        - simplifier           # ※ 繁簡轉換
        - uniquifier           # ※ 過濾重複的候選字，有可能來自繁簡轉換

speller:
  alphabet: zyxwvutsrqponmlkjihgfedcba
  delimiter: " '"
  algebra:
    - erase/^xx$/
    - abbrev/^([a-z]).+$/$1/
    - abbrev/^([zcs]h).+$/$1/
    - derive/^([nl])ve$/$1ue/
    - derive/^([jqxy])u/$1v/
    - derive/un$/uen/
    - derive/ui$/uei/
    - derive/iu$/iou/
    - derive/([aeiou])ng$/$1gn/
    - derive/([dtngkhrzcs])o(u|ng)$/$1o/
    - derive/ong$/on/
    - derive/ao$/oa/
    - derive/([iu])a(o|ng?)$/a$1$2/

translator:
  dictionary: luna_pinyin
  preedit_format:
    - xform/([nl])v/$1ü/
    - xform/([nl])ue/$1üe/
    - xform/([jqxy])v/$1u/

custom_phrase:
  dictionary: ""
  user_dict: custom_phrase
  db_class: stabledb
  enable_completion: false
  enable_sentence: false
  initial_quality: 1

reverse_lookup:
  dictionary: stroke
  enable_completion: true
  prefix: "`"
  suffix: "'"
  tips: 〔筆畫〕
  preedit_format:
    - xlit/hspnz/一丨丿丶乙/
  comment_format:
    - xform/([nl])v/$1ü/

punctuator:
  import_preset: symbols

key_binder:
  import_preset: default

recognizer:
  import_preset: default
  patterns:
    punct: '^/([0-9]0?|[A-Za-z]+)$'
    reverse_lookup: "`[a-z]*'?$"
```



