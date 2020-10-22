# COMMANDS
server
links
whowas
dns

ME
ACTION

AWAY
BACK
BUSY
DND
OFFLINE
QUIT

NICKSERV
	ACC				Displays parsable session information
	ACCESS			Changes and shows your nickname access list.
	CERT			Changes and shows your nickname CertFP authentication list.
	DROP			Drops an account registration.
	GHOST			Reclaims use of a nickname.
	GROUP			Adds a nickname to your account.
	HELP			Displays contextual help information.
	IDENTIFY		Identifies to services for a nickname.
	INFO			Displays information on registrations.
	LISTCHANS		Lists channels that you have access to.
	LISTOWNMAIL		Lists accounts registered to your e-mail address.
	LOGOUT			Logs your services session out.
	REGAIN			Regain usage of a nickname.
	REGISTER		Registers a nickname.
	RELEASE			Releases a services enforcer.
	SET				Sets various control flags.
	SETPASS			Changes a password using an authcode.
	STATUS			Displays session information.
	TAXONOMY		Displays a user's metadata.
	UNGROUP			Removes a nickname from your account.
	VACATION		Sets an account as being on vacation.
	VERIFY			Verifies an account registration.
CHANSERV
	ACCESS			Manipulates channel access lists.
	AKICK			Manipulates a channel's AKICK list.
	CLEAR			Channel removal toolkit.
	COUNT			Shows number of entries in access lists.
	DEOP			Removes channel ops from a user.
	DEVOICE			Removes channel voice from a user.
	DROP			Drops a channel registration.
	FLAGS			Manipulates specific permissions on a channel.
	GETKEY			Returns the key
	HELP			Displays contextual help information.
	INFO			Displays information on registrations.
	INVITE			Invites you to a channel.
	OP				Gives channel ops to a user.
	QUIET			Sets a quiet on a channel.
	RECOVER			Regain control of your channel.
	REGISTER		Registers a channel.
	SET				Sets various control flags.

	STATUS			Displays your status in services.
	SYNC			Forces channel statuses to flags.
	TAXONOMY		Displays a channel's metadata.
	TEMPLATE		Manipulates predefined sets of flags.
	TOPIC			Sets a topic on a channel.
	TOPICAPPEND		Appends a topic on a channel.
	TOPICPREPEND	Prepends a topic on a channel.
	UNBAN			Unbans you on a channel.
	UNQUIET			Removes a quiet on a channel.
	VOICE			Gives channel voice to a user.
	WHY				Explains channel access logic.
MEMOSERV
	DEL			 	Alias for DELETE
	DELETE		 	Deletes memos.
	FORWARD		 	Forwards a memo.
	HELP		 	Displays contextual help information.
	IGNORE		 	Ignores memos.
	LIST		 	Lists all of your memos.
	READ		 	Reads a memo.
	SEND		 	Sends a memo to a user.
	SENDOPS		 	Sends a memo to all ops on a channel.
OPERSERV

OP
DEOP
VOICE
DEVOICE
REMOVE
MODE
KICK
INVITE

HELP

LIST
JOIN
PART

CTCP
MSG
NOTICE
QUERY
SAY
PING
WHOIS
VERSION
UMODE

NICK

QUOTE
RAW

TIME
TOPIC

# FLAG
+v 		Enables use of the voice/devoice commands.
+V 		Enables automatic voice.
+o 		Enables use of the op/deop commands.
+O 		Enables automatic op.
+s 		Enables use of the set command.
+i 		Enables use of the invite and getkey commands.
+r 		Enables use of the unban command.
+R 		Enables use of the recover and clear commands.
+f 		Enables modification of channel access lists.
+t 		Enables use of the topic and topicappend commands.
+A 		Enables viewing of channel access lists.
+S 		Marks the user as a successor.
+F 		Grants full founder access.
+b 		Enables automatic kickban.


# MODE
CHANNEL
+n 		Disallows external messages.
+t 		Only op/hops can set the topic.
+p 		Sets the channel as invisible in /list.
+s 		Sets the channel as invisible in /list and /whois.
+i 		Sets the channel as closed unless the person was invited.
+k		Sets a password for the channel which users must enter to join.
+l 		Sets a limit on the number of users who are allowed in the channel at the same time.
+m 		Prevents users who are not opped/hopped/voiced from talking.
+R 		Sets the channel so only registered nicks are allowed in.
+M 		Sets the channel so only registered nicks are allowed to talk.
+S 		Strips formatting from messages, rendering them as plaintext.
+c 		Blocks messages containing color codes.
+i 		A user must be invited to join the channel.
+N 		No nick changes permitted in the channel.

USER
+q 		User is owner of the current channel
+a 		User is an admin
+o 		User is an operator
+h 		User is a half-op on the current channel
+v 		User has voice on the current channel

# OTHER
SMILEY
	:)	:( 	;) 	:P 	:s 	:D 	<3 :O xD :]
	O_O
	~_~
	$.$
	$_$
	>.<
	>_<
	o_o

STYLE
	_underline_
	*bold*
	`code`

ABBR
gtfo		get the fuck out
brb			be right back
bbl			be back later
np 			no problem
lol			laughing out loud
re 			hi again, as in 're hi'
meh			verbal shrug of the shoulder
wtf			what the f--k
rofl		rolling on the floor laughing
bbiaf		be back in a flash
ttfn		ta ta for now
imho		in my humble opinion
imfao		in my fucking arrogant opinion
afaik		as far as I know
afaict		as far as I can tell
j/k			just kidding
wb			welcome back
rtfm		read the fucking manual
OTOH		on the other hand
n.b.		nota bene
FWIW		for what it worth
mfw			mfw
lel			(always in lower case)laugh even louder, or show bored
<3          love
ime         In My Experience
mofo        mother fucker

# Server&Channel
irc.evilzone.org
	#evilzone
irc.freenode.net
	##php
	#httpd
	##mysql
	##linux
	##uml
	##webdev
	##javascript
	#vbox
	#iphonedev
	#reddit-dailyprogrammer
	#web
	#chrome
	#exim
	#cpanel
	#reddit
            #winehq

    #ruby
    #rubygems
    #bundler


	##fitness
	##nutrition
	##tea
	##coffee
	##runing
irc.mozilla.org
	##thunderbird


# Snippet
see advanced channel list help
	/msg alis help list