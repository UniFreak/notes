# EX Commands

## File
- `:e`              edit
- `:sp`             horizental splite(Ctrl+w s)
- `:vs`             vertical splite(Ctrl+w v)
- `:enew`           new file
- `:vi`             edit another file
- `:close`          close
- `:w`              write
- `:sav`            save as
- `:wqa`            write and quit all
- `:qa`             quit all
- `:q`!             quit without write
- `:args`           see which file opened
- `:ls`             list buffers
- `:b`              last visited file
- `:n`              next file
- `:N`              previous file
- `:rew`            rewind to first file
- `:r`              read file into current one

## Edit

- `:ab`                         define abbreviation
- `:s/search/replace/[ |g]`     search/replace [first|every] in current line
- `:%s/search/replace/[ |g]`    search/replace [first|every] in all line

**SOME NOTES**:

regex seperator are not limited to `/`.

in `replace` string, `&` mean 'what have found', `\<num>` mean 'matched group <num>'

you can use line range with commands (includes: s, d, y, c, !, > and others) as this:
- `1,5`                 operate on line 1 to 5
- `5,.`                 operate on line 5 to current line
- `.,/re/`              operate on line current to whom match the regex
- `'m,$`                operate on line with mark m to last line
- `%`                   operate on all line

## Settings

- `:set hls`        开/关模式高亮
- `:set ic`         开/关忽略大小写
- `:set sm`         开/关显示配对
- `:set im`         开/关插入模式
- `:set cp`         开/关 vi 兼容模式
- `:set nu`         开/关显示行号
- `:set rnu`        开/关相对行数
- `:set list`       开/关 list 模式
- `:set wrap`       开/关折行
- `:set lbr`        开/关整词折行
- `:set et`         开/关扩展 tab
- `:set ai`         enable autoindent
- `:set noai`       disable autoindent
- `:set wm`=40      enable wrap margin
- `:set wm`=0       disable wrap margin
- `:set cin`        开/关 C 缩进
- `:map`            设置快捷键

## Tool

- `:make`           Make
- `:cl`             列出错误
- `:cl`!            列出消息
- `:cn`             下一个错误
- `:cp`             上一个错误
- `:cold`           更旧的错误列表
- `:cnew`           更新的错误列表
- `:%!xxd`          转换成十六进制
- `:%!xxd` -r       转换返回
- `:spellrepall`    重复修正拼写检查错误
- `:sh`             运行 shell (exit 退出)
- `:!`              运行 shell 命令

## Tabs:
- `:tabnew {file}`
- `:tabnew#`        reopen last closed tab
- `:tabedit {file}`
- `:tabfind {file}`
- `:tabclose {i}`   close i
- `:tabonly`        close all other
- `:tabm {i}`       move tab
- `:tabn`           next tab
- `:tabp`           previous tab
- `:tabfirst`       first tab
- `:tablast`        last tab
- `:tabs`           list all tabs
- `<num>gt`         go to tab <num>

## View:
- `:color`          切换颜色主题

## Help:

- `:help`

# Normal/Command Mode

## Note
Most action can be repeated by add a number before

Many action can be doubled to operate on line(like dd, cc)

[A-Z] marks are global, [a-z] marks are per-buffer

- `&i`                  enter insert mode after action
- `SOFT-`               non-blank
- `BOL`                 begin of line
- `EOL`                 end of line
- `BOW`                 begin of word
- `EOW`                 end of word
- `BOS`                 begin of sentence
- `EOS`                 end of sentence
- `BOF`                 begin of file
- `EOF`                 end of file

## Mode: switching between modes
- `i`                   insert before
- `I`                   insert before BOL
- `a`                   append after current char
- `A`                   append after EOL
- `o`                   insert before new line below
- `O`                   insert before new line above
- `s`                   replace char under cursor(=`xi`)
- `S`                   replace from BOL(=`ddO`/`cc`)
- `R`                   overwrite
- `v`                   visual
- `V`                   visual-lines
- `Esc`                 normal
- `Ctrl+[`              normal
- `Ctrl+o`              insert-normal

## Motion: move the cursor, or defines the range for an operator
- `h`/`j`/`k`/`l`       left/down/up/right

- `w`                   BOW forward
- `W`                   SOFT-BOW forward
- `b`                   BOW backward
- `B`                   SOFT-BOW backward
- `e`                   EOW forward
- `E`                   SOFT-EOW forward

- `-/+`                 prev/next line BOL
- `{/}`                 prev/next empty line
- `0/$`                 BOL/EOL
- `^`                   SOFT-BOL
- `[#]G`                EOF or line #
- `GG`                  BOF
- `(/)`                 BOS/EOS

- `[[/]]`               prev/next "{"
- `#`                   prev indentifier under cursor
- `*`                   next indentifier under cursor
- `%`                   matching pair

- `H`/`M`/`L`               top/middle/bottom screen

- `f+<c>`               find and move to <c> forward
- `F+<c>`               find and move to <c> backward
- `t+<c>`               find and move until <c> forward
- `T+<c>`               find and move until <c> backward
- `,/;`                 prev/next find

- `/`                   search forward and move to
- `?`                   search backward and move to
- `n`                   move to next search result
- `N`                   move to next search result reversely

## Command: direct action command
- `c`                   change
- `d`                   delete
- `y`                   copy to register
- `g~`                  toggle case
- `gu`                  lowercase
- `gU`                  uppercase
- `!`                   filter with external tool
- `K`                   open help about what's under the cursor
- `["a-Z]x`             delete char [and reg a-Z]
- `["a-Z]X`             delete prev char [and reg a-Z]
- `J`                   join line
- `C`                   =`c$`
- `D`                   =`d$`
- `Y`                   =`yy`
- `r+<c>`               replace char under cursor with <c>
- `~`                   toggle character case
- `u`                   undo
- `U`                   undo all changes to current line
- `Ctrl+R`              redo
- `["a-Z]p`             paste [reg a-Z] after
- `["a-Z]P`             paste [reg a-Z] before
- `m[a-Z]`              set mark a-Z
- ``[a-Z | .]`          goto mark [a-Z | last modified]
- `'[a-Z]`              goto mark [a-Z] SOFT-BOL
- `q[a-Z]`              start | stop record macro [a-Z]
- `@[a-Z | @]`          replays macro [a-Z]  | last u played
- `.`                   repeat last action
- `zz`                  center current line

## Edit
- `Ctrl+h`              delete last character
- `Ctrl+w`              delete last word
- `Ctrl+u`              delete line
- `Ctrl+r{register}`    paste content in {register}

## Operator: require Motion afterward, operates between cusor & destination
- `["a-Z]d`             delete [and reg a-Z]
- `["a-Z]dd`            delete line [and reg a-Z]
- `["a-Z]c`             $i and change from <motion> [and reg a-Z]
- `["a-Z]cd`            $i and change line [and reg a-Z]
- `["a-Z]y`             yank [and reg a-Z]
- `["a-Z]yy`            yank line [and reg a-Z]
- `>>`                  indent
- `<<`                  outdent
- `=`                   auto indent


# Shortcut
- `ctrl+a`                      increase forward closest number
- `ctrl+x`                      decrease forward closest number

- `Ctrl+w [+[hjkl]]`            nagative between windows
- `Ctrl+c`                      close current window
- `Ctrl+o`                      close others windows

- `Ctrl+]`                      jump to definition
- `Ctrl+t`                      return from definition

- `Ctrl+e`                      scroll down one line
- `Ctrl+y`                      scroll up one line
- `Ctrl+d`                      scroll down half screen
- `Ctrl+u`                      scroll up half screen
- `Ctrl+f`                      scroll down one screen
- `Ctrl+b`                      scroll up one screen
- `Ctrl+g`                      display line number and file status

- `Shift+z+z`                   :wq

# Tricks
- 使用 | 分割多条命令
- `ddkP`: move one line up
- `ddp`: move one line down
- `:echo expand('%:p')`         显示文件路径
- just use `:e` to reload file
- use `:%d` to delete all line

# .vimrc

```
set tabstop=4
set shiftwidth=4
set expandtab
set autoindent
set nu
```
