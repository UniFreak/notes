# Tags:
- (不包含不被推荐使用的标签)
- !--
- !DOCTYPE
- html head title meta style body
- div p span
- tt i b big small
- base
- bdo
- br
- abbr acronym blockquote b em strong dfn code samp kbd var cite big small
- sub sup ins del mark s u
- img map area
- ul ol li dl dt dd
- table caption colgroup col tr th/td 	thead tbody tfoot
- iframe frameset frame noframes
- form fieldset legend label input output textarea button option optgroup select
- datalist progress meter
- embed object param

# Sample:
```html
<table>
    <thead>
        <tr>
            <th>Month</th>
            <th>Saving</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td>Sum</td>
            <td>$180</td>
        </tr>
    </tfoot>
    <tbody>
        <tr>
            <td>Jan</td>
            <td>$100</td>
        </tr>
        <tr>
            <td>Feb</td>
            <td>$80</td>
        </tr>
    </tbody>
</table>
```

- h1 ~ h6,p,dt只能包含行元素
- <input type="image" /> 定义图像形式的提交按钮
- <input type="button" /> 通常用于用户点击时启动js
- <form enctype="multipart/form-data"> 文件上传时, 必须设置该属性值

# Form
- POST: 变量不会显示在URL中，不可以保存书签, 相对安全, 没有长度限制
- GET: 会显示在URL中，可以保存书签, 相对不安全, 100个字符限制
- 上传文件多选: 使用数组形式的 name 和 multiple 两个属性

```html
<form enctype="multipart/form-data" action="post_upload.php" method="POST">
    <input type="file" name="file[]" multiple />
    <input type="submit" value="upload" />
</form>
```

# Best practice

## Form

- Use Fieldsets&Legend, Use Label, Use Optgroup
- Name your Inputs
- Use for to bind Label and Input
- Use focusing style
- Use Get&Post rightly
- Validat on both Client and Server
- Give user smart warning

## Form validation
- Never omit server-side validation
- ways clearly mark required fields
- on’t forget to inform users when the form was completed successfully
- if you use Captcha, don’t forget to provide audio support and enable users to “reload” the Captcha