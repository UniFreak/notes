# See

- <C 语言程序设计 现代方法 2e>

# Idiom

防止多次包含头文件 `p.253`

```c
#ifdef BOOLEAN_H
#define BOOLEAN_H

...

#endif
```

配合 C++: see `C++.md`
- C++ 的链接指示: `extern "C" {}`
- `__cplusplus` 预处理器变量

# Debug tool
- dbg

# `char c[]` vs `char *c` to handle string

```
<UniFreak> seems like using `char *ps` or `char s[]` to handle string "string" is basically the same thing, or is there a preference for which to be used under a certain situation?
<UniFreak> see <https://www.cs.bu.edu/teaching/cpp/string/array-vs-ptr/>
<othias> UniFreak: it's not the same, one is an array, the other points to a string literal (that you can't modify)
<othias> also, this appears to be a c++ page
<atk> UniFreak: so a few notes about what you linked
<atk> UniFreak: [] has nothing to do with arrays
<atk> well A[B]
<e> int B = 1, A[B];
<atk> e: yes yes
<atk> I know
<atk> I can't find words today
<UniFreak> othias, them being different things aside, when using them to handle string, seems the usage of them are the same
<othias> UniFreak: as long as you don't modify the string, I suppose so yes
<atk> UniFreak: no
<atk> UniFreak: one moment, let me locate the right words
<atk> UniFreak: so let me try again
<UniFreak> like both can be init by `= "string"`, access string char by `[2]` or `+2`
<atk> UniFreak: the array subscripting operator doesn't operate on arrays
<atk> UniFreak: yes, I will explain everything if you stop talking first
<atk> UniFreak: the array subscripting operator operates on literally anything which you can add together and dereference, so mainly a pointer and an offset
<atk> they don't have to be in the right order
<atk> E1[E2] is just syntax sugar (a syntactical transformation) for *((E1) + (E2))
<atk> and your article is for C++, that's also true, so I don't know if any of this applies for C++ since C++ is not C
<othias> I think he was essentially asking for the limitations of using string literals
<atk> othias: I wouldn't be so sure
<atk> or well
<atk> he may have been asking for that, but this ain't stackoverflow
<atk> UniFreak: the other thing to note
<atk> UniFreak: except when an array is the operand of the sizeof, _Alignof or unary & operators
<atk> or it's a string literal being used to initialise an array
<johnjay> why can't C macros compute Sname from Fname?
<UniFreak> atk, I'm just curious about what's the difference between `use char array to handle string` and `use char pointer to handle string`, on coding level, not so deep in how c is implemented
<atk> I'm not explaining how C is implemented
<atk> I'm explaining how it's used
<Storyteller> I'm just curious about what's the difference between `use char array to handle string` and `use char pointer to handle string`, on coding level,
<atk> UniFreak: except in the aforementioned circumstances
<Storyteller> as am I.
<atk> UniFreak: an expression with type "array of type" is converted to an expression with type "pointer to type" pointing to the first element of the array
<Storyteller> I think there are books written on this though, its seems pretty involved
<atk> and I'm answering your question
<atk> you seem to be under the impression that you understand these things but the resource you pointed to doesn't explain them correctly so I'm just telling you how they actually work so you don't end up confused in the future
<atk> the point being, in C, arrays are distinct from pointers
<atk> it's just that in a lot of circumstances they end up getting implicitly converted to a pointer to their first element
<Storyteller> so, can I ask a quick quantifier here for clarity: when using an Array, does 'C' basically just make a pointer to that section of memory, and do pointer stuff anyway?
<Storyteller> even though they are not the same, does C treat arrays like pointers, in certain cases?>
<UniFreak> atk, thanks for your detailed explanation, something I have to digest slowly.
<atk> UniFreak: there's one more thing
<atk> there's also a difference when it comes to initialisation
<UniFreak> amazed on your knowledge on this stuff, where did you learn it? some book?
<UniFreak> no book explain those things
<atk> char *a = "foo"; works in a different way to char a[] = "foo";
<atk> in the former case you have a pointer type which gets initialised to a pointer to the first element to the array which forms the string literal "foo"
<atk> so as I mentioned earlier
<atk> "foo" is a string literal
<atk> which is an array of 4 elements of char
<atk> in this case, the expression has type "array of char"
<atk> it does not fall into any of the categories listed before
<atk> so it gets converted to a pointer to its first element
<atk> it's the same as if you were to explicitly do: &"foo"[0] except in this case the mere act of using the array subscript operator already performs the conversion
<atk> but that's besides the point
<atk> the point being that in the case above, with char *a = "foo"; you're initialising a to the value of the pointer to the first element of the array of the string literal "foo"
<atk> if you were to word it in english
<atk> in the second case, you're actually initialising an array, and the string literal no longer acts the same
<atk> it acts as if you had written { 'f', 'o', 'o', '\0' }
<atk> so it acts as if you had written: char a[] = { 'f', 'o', 'o', '\0' };
<dorp> atk: The null character depends on the length of the array /nitpick :)
<UniFreak> oh...... wow.......
<UniFreak> so..... which book should I read?
<atk> dorp: in this case the length is unspecified so your nitpick wasn't relevant
<atk> UniFreak: the standard?
<Wayfarer> in the first case 'char *a = "foo"; is the rest of that 'array' unitialized?
<UniFreak> no......
<atk> I don't recommend it if you're learning C though
<Wayfarer> write tht out the way you did the other plx
<atk> Wayfarer: there's nothing to write out
<atk> Wayfarer: there's no array in that former case, or well, there is an array "foo" is the array, you're getting a pointer to its first element because of the circumstances and using that to initialise the pointer
<Wayfarer> well you wrote out the other.
<atk> Wayfarer: yes, because it's handled completely differently, that was kind of the point
```

# MISC

Q:
    character vs character constant vs string vs string constant
    single quote vs double quote
IRC:
    <UniFreak> when K&R say `constant`, can I understand it as `literal` ?
    <kamog> UniFreak: yeah, it looks like they mean literals.
Q:
    symbolic constant vs const
IRC:
    <UniFreak> hi, in `#define PI 3.14`, we call PI a symbolic constant, then, in `const double e = 2.17`, what do we call e?
    <twkm> a variable.
    <UniFreak> twkm: doesn't const make it unvariable?
    <twkm> no.
    <LeoNerd> I'd call PI a macro
    <e> UniFreak: const doesn't make constants in C
    <twkm> but if you like to think that way, at the least it is an object.
    <gr33n3r2> yeah PI is a pre-processor macro
    <cousteau> it's a const variable
    <UniFreak> LeoNerd: so K&R is somehow confusing?
    <twkm> they call it a macro too, but refine it for when the expansion is a constant.
    <twkm> i tend to call them manifest constants.
    <UniFreak> so, what's the difference between them regarding to use scenario?
    <cousteau> I like how UniFreak probably highlighted e and that's why e answered
    <cousteau> PI is textually replaced with `3.14`, i.e. writing `PI` is the same as writing `3.14`
    <pthreat> Is there a way to print the memory address a program has
    <twkm> not portably.
    <gr33n3r2> UniFreak: to clarify about 'const' - it does declare a variable as unmodifiable, but you can create a non-const pointer to that variable and cast it, and that would allow you to modify it.
    <cousteau> whereas e is actually an object; when you use `e` you're referring to an object called "e", which is a const object.  Since it's const, it'll probably be optimized so that whenever you use `e` the compiler will replace that with the actual value rather than looking up its value in memory
    <gr33n3r2> UniFreak: const is more of a compile-time directive that tells you what you *should* do with a variable, rather than what you *can* do
    <cousteau> it also tells the compiler what optimization tricks it can do
    <pthreat> gr33n3r2: It's a good hint, hints are good
    <gr33n3r2> pthreat: it's bloody essential! Don't modify my damn consts!

Every program must have a main function

A sequence of characters in double quotes, like  "hello, world\n" , is called a character
string or string constant

All variables must be declared before they are used

char int short long float double

By definition,  char s are just small integers

'\n' is a single character

A character written between single quotes represents an integer value equal to the numerical value of the character in the machine's character set. This is called a character constant, although it is just another way to write a small integer. So, for example,  'A' is a character constant; in the ASCII character set its value is 65, the internal representation of the character A. Of course,  'A' is to be preferred over  65 : its meaning is obvious, and it is independent of a particular character set.

%d %f %o %x %c %s %%

Integer division truncates: any fractional part is discarded

Writing floating-point constants with explicit decimal points even when they have integral values
emphasizes their floating-point nature for human readers