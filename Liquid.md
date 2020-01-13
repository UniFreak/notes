Liquid is an open-source, Ruby-based template language created by Shopify

# See
- <https://shopify.github.io/liquid/>
- <https://help.shopify.com/en/themes/liquid>

# Basic concept

Popular varation of Liquid
- Liquid
- Shopify Liquid
- Jekyll Liquid

Tag: programming logic that tells templates what to do, wrapped in {% %}

Objects/Liquid Variables: contain attributes that are used to display dynamic content on the page

Types: Liquid objects can have one of five types
- String "hello"
- Number 42
- Boolean `true` | `false`
- Nil `nil`
- Array access item by `[]`

Filter: modify the output, placed within an output tag {{ }}, separated with a pipe character |

Handle: every object in Liquid has a handle to access the attributes of it

Operators: `==` `!=` `>` `<` `>=` `<=` `or` `and` `contains`

You can use hyphen in tag to strip left/right/all white space: `{{-`, `-}}`, `{%-`, `-%}`

# Tag

- comment `{% comment %} wont ouput or excute {% endcomment %}`

- raw: temporarily disables tag processing

```
{% raw %}{{ 5 | plus: 6 }}{% endraw %} is equal to 11
```



## Control flow

- if/elsif/else/endif

```html
{% if customer.name == 'kevin' %}
    Hey Kevin!
{% elsif customer.name == 'anonymous' %}
    Hey Anonymous!
{% else %}
    Hi Stranger!
{% endif %}
```

- case/when/endcase

```html
{% case handle %}
    {% when 'cake' %}
        This is a cake
    {% when 'cookie' %}
        This is a cookie
    {% else %}
        This is not a cake nor a cookie
{% endcase %}
```

- unless/enduless

```html
{% unless product.title == 'Awesome Shoes' %}
    These shoes are not awesome.
{% endunless %}
```

## Iteration

- for/break/continue

output max 50 results, use paginate tag if more than 50 resultes
forloop object is available within for tag

```
{% for i in (1..5) reversed limit:2 offset:2  %}
    {% if i == 5 %}
        {% break %}
    {% elsif i == 3 %}
        {% continue %}
    {% else %}
        {{ i }}
    {% endif %}
{% endfor %}
```

cycle: must be used within a for loop block.

```
{% cycle "one", "two", "three" %}
{% cycle "one", "two", "three" %}
{% cycle "one", "two", "three" %}
{% cycle "one", "two", "three" %}
```

outputs:

```
one
two
three
one
```

- tablerow

generate an HTML table
tablerow object availabe whthin tablerow tag

```html
<table>
{% tablerow i in (1..10) cols:2 limit:3 offset:3%}
    {{ i }}
{% endtablerow %}
</table>
```

## Variable

- assign `{% assing my_var = 'string' %}`

- capture: captures the string inside of the opening and closing tags

```
{% capture my_var %}I am being captured.{% endcapture %}
```

- increment / decrement

creates a new number variable, and increases/decreases its value by one every time it is called
increment/decrement created variable are independent from variables created through assign or capture

```
{% increment variable %}
{% decrement variable %}
```

# Filters

`abs`, `append`, `at_least`, `at_most`, `capitalize`, `ceil`, `compact`, `concat`, `date`, `default`, `divided_by`, `downcase`, `escape`, `escape_once`, `first`, `floor`, `join`, `last`, `lstrip`, `map`, `minus`, `modulo`, `newline_to_br`, `plus`, `prepend`, `remove`, `remove_first`, `replace`, `replace_first`, `reverse`, `round`, `rstrip`, `size`, `slice`, `sort`, `sort_natural`, `split`, `strip`, `strip_html`, `strip_newlines`, `times`, `truncate`, `truncatewords`, `uniq`, `upcase`, `url_decode`, `url_encode`, `where`