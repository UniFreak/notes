Any fool can write code that computer can understand, but it takes a good programmer to write code that human can understand

# Name
- choose your name thoughfully
- always choose name that communicate you intent
if you must go into the code to understand the name, it's a bad name
- name should says what it means and means what it says, otherwise it's disinformation
- use pronounceable name
- avoid encoding(prefix name to indicate type, or so), just use names
- class and variable name should be noun, function/method should be verb, boolean often prefix with `is`
- name has scope
    - variable in long scope should have long name
    - variable in short scope can be brivieted even down to one letter
    - function/class in long scope should have short convinient name
    - function/class in shor scope should have long descriptive name

# Function/Method
- the smaller the better. 10 line? that's too large!
- if you choose name wisely, you won't lost in function calls
- large functions is where classes go to hide
- one function should only do one thing. so extract until you drop

- three arguments max
- no boolean/null argument, as it says "I'm doing two things, one for true,
  one for false". plus, it's ambiguous, what true? what false?
- no output arguments
- no defensive programming(except for public api)

- public/major function at top, private/minor function at bottom. so there is
  no back reference needed when reading code

- CQS: command query seperation:
  functions that return values should not have side effect
  functions that have side effect can throw exception but should not return values