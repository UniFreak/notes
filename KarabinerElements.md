# My complext rule

```json
{
  "title": "Change Chinese punctuation to English punctuation ",
  "rules": [
    {
      "description": "「 to {",
      "manipulators": [
        {
          "type": "basic",
          "from": {
            "key_code": "open_bracket",
            "modifiers": {
              "mandatory": [
                "shift"
              ]
            }
          },
          "to": [
            {
              "key_code": "open_bracket",
              "modifiers": [
                "caps_lock",
                "shift"
              ]
            }
          ]
        }
      ]
    }
  ]
}

```
