#filter_var() vs htmlspecialchars/htmlentities/urlencode/...

> *UniFreak*: should I use the fancy new filter_var or the old way `htmlspecialchars()`, `strip_tags()`, `urlencode()` and so on?

> *cythrawll*: UniFreak, both

> *cythrawll*: they aren't replacements for each other

> *UniFreak*: cythrawll: not? http://stackoverflow.com/a/6962450/3776039 look at the last comment

> *UniFreak*: I thought it means that filter_var is a superset

> *UniFreak*: and gives more consistent function signature

> *cythrawll*: UniFreak, it also doesn't do half the things that those functions do

> *cythrawll*: it doesn't trip tags

> *cythrawll*: it's meant to be an input sanitization technique

> *cythrawll*: whereas the others are meant for output

> *cythrawll*: input_var doesn't really work for output because it doesn't take charset of the output into consideration

> *UniFreak*: cythrawll: ok, I guess what I'm really asking is, if I can  do same thing with the old way and the filter_var to sanitize a string, > is there a preference? and why?

> *UniFreak*: filter_var is for input, and those functions are for output

> *cythrawll*: escaping input for a certain output is nonsensical

> *cythrawll*: like still use input_var but don't use it to escape

> *cythrawll*: only escape during output

> *cythrawll*: the escape method you showed always assumes that html is the output

> *cythrawll*: that's not always true... there's more formats in the world to output than just html

> *cythrawll*: so seems kind of like a silly way to filter escape and store

> *cythrawll*: don't escape on input

> *cythrawll*: escape on output

> *cythrawll*: but you still want to validate etc..., therefore still use input_var

> *UniFreak*: cythrawll: I can understand what you said about  `being silly to escape when storing, cuz you never know how you may present it`

> *UniFreak*: but filter_var is not only for validating data, right? there are also sanitizing filters

> *cythrawll*: yeah which I don't like.

> *cythrawll*: liek some of them are OK, i can see using

> *cythrawll*: like stripping low and high bits.

> *cythrawll*: but for sanitizing for output

> *cythrawll*: for escaping...

> *UniFreak*: so, I'm basically asking about the sanitizing part

> *cythrawll*: where do you tell input_var the char encoding you plan on outputing?

> *cythrawll*: wait...

> *cythrawll*: you don't...

> *cythrawll*: because it sucks for that.

> *cythrawll*: :P

> *UniFreak*: okay... I guess I didn't see the full power of the old functions yes(like the telling encoding things), let me check upon it

> *UniFreak*: **yet**

> *UniFreak*: still, I think the consistent that filter_var gives is cool. I guess I'll use it if I can, unless I need those additional feature > the old way functions offer.

> *UniFreak*: thank you cythrawll.

> *UniFreak*: I don't why you refer to input_var, maybe typo? I didn't found it in the documentation

> *cythrawll*: UniFreak, I'm not a fan of it's interface. it's not very PHP like

> *cythrawll*: it's C like

> *cythrawll*: so consistency isn't what I'd call it

> *cythrawll*: UniFreak, yes typo

> *Mad_Advice_Cat*: I hate filter_var

> * Mad_Advice_Cat kicks PHP hard.

> * truckcrash picks up PHP and puts it back nicely

> *cythrawll*: UniFreak, if you want consistency, I'd much prefer userland solutions.

> *cythrawll*: UniFreak, and there are your choices.

> *CiPHPer*: Mad_Advice_Cat: https://github.com/paragonie/airship/blob/master/src/Cabin/Bridge/Filter/Blog/NewPostFilter.php

> *CiPHPer*: :)

> *cythrawll*: I see this is a bad attempt at trying to encourage NIH addicts into doing validation at all.

> *CiPHPer*: enforces strict types on multi-dimensional array contents

> *cythrawll*: CiPHPer, pretty similar interface to what I use. except what I have adds a level of abstraction where you can just define: > ['author' => 'string', 'category' => 'int'] etc...

> *cythrawll*: pretty much has a whole DSL thing going on: 'string|max:255'


#How reference change array in the second loop:

> *UniFreak*: look at this code:

    $array = range(1, 3);
    echo implode(',', $array); // Outputs '1,2,3'
    foreach ($array as &$value) {}
    echo implode(',', $array); // Outputs '1,2,3'
    foreach ($array as $value) {}
    echo implode(',', $array); // Outputs '1,2,2'

> *UniFreak*: how that the final loop changed the array to 1,2,2?

> *UniFreak*: I'm reading this: https://secure.phabricator.com/book/phabflavor/article/php_pitfalls/

> *frickenate*: @UniFreak add an unset($value) before 2nd last line.

> *UniFreak*: frickenate: I know the solution, I want to know why this happens

> *UniFreak*: that page explain something about reference, but I don't quite get it

> *frickenate*: UniFreak: once you assign a variable name to a reference as in the foreach that uses &$value, that variable remains a reference afterwards.

> *frickenate*: You have to unset($value) after the foreach is done to unbind that reference, basically.

> *frickenate*: It's a very common "gotcha" with references in php.

> *oorza*: UniFreak it's because when you foreach by reference, the array $value is filled with a *reference* to the value of the array, not the value itself... so when you iterate over it, $value is left referencing the last value of the array... so when you iterate back over it, because $value is a reference to $array[2], each time you iterate again the second time, you're changing the value of the last element of the array

> *Happy_the_Exceed*:UniFreak

![PHP reference to object][phpRefObj]

> *Happy_the_Exceed*: That's all there is to reference. Frankly, you should be avoiding them imo.

> *oorza*: UniFreak 

    $array = range(1, 3);
    echo implode(',', $array); // Outputs '1,2,3'
    foreach ($array as &$value) {}
    echo implode(',', $array); // Outputs '1,2,3'
    foreach ($array as $value) {
     echo implode(',', $array); //1,2,1 then 1,2,2, then 1,2,2   
    }

> does this make it clearer?

> * UniFreak is reading careful and slowly, wait...

> *UniFreak*: oorza: in the second loop `foreach ($array as $value)`, $value is still a reference to $array[2] (witch is 3)?

> *oorza*: UniFreak at one point it was 3, but it's a REFERENCE to the item in the array, so every time you put soimething new in $value, again because it's a reference variable that points at $array[2], you put it in $array[2]

> *UniFreak*: oorza: why the last iteration make it 2? why not 3?

> *UniFreak*: first iteration, put 1 into $value

> *UniFreak*: second, put 2

> *UniFreak*: oh...

> *oorza*: UniFreak okay so before we start the last loop, let's recap $value references $array[2], so you start to loop over array, get the value of its first item (1) and then copy it onto $value, but because $value references $array[2], you're actually copying to $array[2]... so when you finish the first loop, the array goes from 1-2-3 to 1-2-1

> *UniFreak*: oorza: yeah... I now totally get it :0

> *UniFreak*: thanks oorza

> *oorza*: UniFreak \o/ good because i was running out of things to explain

> *oorza*: UniFreak it's a rare day that you need references in php any more

> *oorza*: UniFreak if you do ever need a reference, just remember to unset() it as *soon* as you can

> *UniFreak*: oorza: I used it several weeks back ? guess I was doing it wrong

> *oorza*: UniFreak or just had a rare day :D













[phpRefObj]: img/PHP_reference_object.png
