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


#How to force a child to define a constant
> *UniFreak*: hi. in PHP, is there a way to force a child class to define a constant?
> 
> *__adrian*: no
> 
> *__adrian*: you can define the constant on the parent as a default.
> 
> *__adrian*: you can define the constant on the parent as a default, and have {whatever method} throw an exception if the child's constant has the default value

> *__adrian*: but just defining it should be enough

> *UniFreak*: I guess that will do. thanks __adrian

> *__adrian*: better, make a method that returns the constant's value.


#404 VS 204

> *UniFreak* if one client requested my `myapi.com/user?login_mobile=133....`

> *UniFreak* if the user dones't exist, should I return 404(I'm tring to do it restful)

> *wowaname* the resource doesnt exist so yes i would return 404

> *wowaname* i dont see a more appropriate response for it

> *pthreat* UniFreak: 204 would be more appropriate since you would specify that the end point does in fact exists but no content was found

> *pthreat* imagine if I'm using your API and it just responds with 404, "This dude is an idiot, pointed me to something that it doesn't exists"

> *wowaname* 204:The server successfully processed the request, but is not returning any content. Usually used as a response to a successful delete request.

> *wowaname* as opposed to 404:The requested resource could not be found but may be available again in the future. Subsequent requests by the client are permissible.

> *pthreat* Right, the end point does exists ...

> *wowaname* i mean if a user doesnt exist but it may in the future, i would see 404 as appropriate

> *pthreat* but it returns no content

> *pthreat* yeah well some people like to be a little more specific, like me for instance

> *wowaname* so do i

> *pthreat* so if you use 404, how can I tell that the end point does not exists, versus no content was found

> *wowaname* http://blog.ploeh.dk/2013/04/30/rest-lesson-learned-avoid-204-responses/

> *wowaname*  From the service's perspective, a 204 (No Content) response may be a perfectly valid response to a POST, PUT or DELETE request. Particularly, for a DELETE request it seems very appropriate, because what else can you say?

> *wowaname* pthreat i'm going to have to disagree with you

> *wowaname* 204 implies there was a valid request that returns no content because there is no content to return, so that could mean to the client that the user exists but there's nothing to say about the user? you don't really know

> *pthreat* there's always something to "say" about a user because a use has at least one attribute, i.e the username

> *pthreat* I'm just waiting for you to tell me how can I distinguish what I said above instead of pointing me to blog articles

> *wowaname* https://stackoverflow.com/questions/2195639/restful-resource-not-found-404-or-204-jersey-returns-204-on-null-being-returne

> *wowaname* i just think you fail to understand http status responses and valid contexts for using each

> *pthreat* No, not really

> *pthreat* Do you have reading problems? Answer my question

> *wowaname* are you insulting me now

> *pthreat* Answer my question

> *wowaname* i came here to ask a question about php7 not get talked down by some infant

> *pthreat* wowaname: Answer the question and quit the accusations

> *wowaname* i dont have to answer to you, mom

> *wowaname* shut the hell up

> *UniFreak* um.... interesting discussion.

> *pthreat* How is the infant now?

> *pthreat* or rather who ... but we know already

> *wowaname* ya, i guess we do

> *wowaname* could you leave pthreat

> *wowaname* instead of derailing conversations with your shit

> *pthreat* Answer the question or quit the discussion

> *wowaname* you do not tell me what to do

> *pthreat* Ok so I'll take it you left the discussion and you have no valid argument whatsoever to your pathetic point of view

> *wowaname* i gave you a valid *ucking argument you *ucking reta5rd

> *pthreat* No you didn't

> *pthreat* you just cited blog articles

> *pthreat* ohhh are you insulting me noooow

> *wowaname* yes and they supported my argument

> *pthreat* I'm about to break in tears

> *wowaname* go back to reddit

> *wowaname* argue down those idiots

> *wowaname* quit wasting my time

> *pthreat* ok www.reddit.com done

> *pthreat* what next

> *pthreat* wowaname: Name calling doesn't answers my question

> *pthreat* could you please answer the question or quit the discussion

> *wowaname* 404

> *wowaname* file

> *wowaname* not

> *wowaname* found

> *pthreat* wowaname: yeah you cant

> *wowaname* i think that

> *pthreat* FILE not found

> *wowaname* is plain

> *pthreat* not RESOURCE

> *wowaname* english

> *pthreat* not found

> *wowaname* when did 204 ever mean

> *wowaname* resource not found

> *pthreat* no not really, you fail to see the subtle distinction

> *pthreat* content

> *wowaname* when is  a file not a resource in the context of http

> *pthreat* you want to name it content, let's name it content

> *wowaname* you are returning a resource in the format of a *ucking file

> *pthreat* Mmm no, I'm returning a string, content not a "file"

> *AppError* Wow, things are heated in here

> *wowaname* ok go back to school idiot

> *wowaname* ignored

> *wowaname* you know zero about the workings of the http protocol and its no use *ucking arguing with you

> *pthreat* TML: you know, you are kind of abscent when things like these happen and I'd really appreciate your input in this wonderful discussion

> *pthreat* wowaname: :'( You hurt my feelings

> *pthreat* So name calling is a valid way of proving you are right, this was the most constructive discussion I had in *years*

> *pthreat* round of applause everyone

> *pthreat* Ahh he is one of those i2p people, now I get it


[phpRefObj]: img/PHP_reference_object.png
