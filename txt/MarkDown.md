Markdown syntax:
(You can always use HTML tag&attributs in Markdown file)

=============== Heading ===============
this is an H1
==========
this is an H2
-----------------
# this is H1
## this is H2
### this is H3
#### this is H4
##### this is H5
###### this is H6

=============== Quoting ===============
> this is a blockquote with two paragraphs
>
> the second paragraph
>> blcokquote also can be *nested*

=============== Listing ===============
* li1
* li2
* li3
+ li1
+ li2
+ li3
- li1
- li2
- li3
1. li1
2. li2
3. li3

=============== Horizontal Ruling ===============
hr1
* * *
hr2
***
hr3
*****
hr4
- - -

=============== Coding ===============
`code fragment`
``code fragment if you wanna encode a ` in fragment``

=============== Emphasising ===============
*emphasis*
_emphasis_
**strong**
__strong__


=============== Linking ===============
[link](http://sample.com/ "Title") with title
- - -
[link](http://sample.com/) without title
- - -
<http://autolink.com>
- - -
<fanghao90s@gmail.com>
- - -
[reference link1] [num1] and [reference link2] [num2] defined by the following(see bottom)
- - -
![Alt text](/path/to/img.jpg "Optional title")
- - -
![Alt text][id]reference img defined by the following(seebottom)

=============== Tabling ===============
| Year | Temperature (low) | Temperature (high) |  
| ---- | ----------------- | -------------------|  
| 1900 |               -10 |                 25 |  
| 1910 |               -15 |                 30 |  
| 1920 |               -10 |                 32 | 



[num1]: http://sample1.com/ 		"reference link1"
[num2]: http://sample2.com/ 		"reference link2"
[id]: url/to/img "Optional title attribute"
