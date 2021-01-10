see <https://perldoc.perl.org/perlpacktut>

formatter:
a   NUL-padded string
A   SPACE-padded string

h   Hex string, low nibble first
H   Hex string, high nibble first

c   signed char
C   unsigned char

s   signed short (always 16 bit, machine byte order)
S   unsigned short (always 16 bit, machine byte order)
i   signed integer (machine dependent size and byte order)
I   unsigned integer (machine dependent size and byte order)
l   signed long (always 32 bit, machine byte order)
L   unsigned long (always 32 bit, machine byte order)
q   signed long long (always 64 bit, machine byte order)
Q   unsigned long long (always 64 bit, machine byte order)

n   unsigned short (always 16 bit, big endian byte order, **network order**)
v   unsigned short (always 16 bit, little endian byte order)
N   unsigned long (always 32 bit, big endian byte order, **network order**)
V   unsigned long (always 32 bit, little endian byte order)
J   unsigned long long (always 64 bit, big endian byte order)
P   unsigned long long (always 64 bit, little endian byte order)

f   float (machine dependent size and representation)
g   float (machine dependent size, little endian byte order)
G   float (machine dependent size, big endian byte order)
d   double (machine dependent size and representation)
e   double (machine dependent size, little endian byte order)
E   double (machine dependent size, big endian byte order)

x   NUL byte
X   Back up one byte
Z   NUL-padded string (new in PHP 5.5)
@   NUL-fill to absolute position

Repeater: int, *, @

vs: count and substr & regex

pack and unpack are designed to help you out when dealing with fixed-width data

# Blog

## String

Use pack to go from several pieces of data to one fixed-width version; use unpack to turn a fixed-width-format string into several pieces of data.

The pack format A means "any character"; if you're packing and you've run out of things to pack, pack will fill the rest up with spaces.

x means "skip a byte" when unpacking; when packing, it means "introduce a null byte" - that's probably not what you mean if you're dealing with plain text.

You can follow the formats with numbers to say how many characters should be affected by that format: A12 means "take 12 characters"; x6 means "skip 6 bytes" or "character 0, 6 times".

Instead of a number, you can use * to mean "consume everything else left".

Warning: when packing multiple pieces of data, * only means "consume all of the current piece of data". That's to say

pack("A*A*", $one, $two)
packs all of $one into the first A* and then all of $two into the second. This is a general principle: each format character corresponds to one piece of data to be packed.

# PHP.net
unpack:

The unpacked data is stored in an associative array. To accomplish this you have to name the different format codes and separate them by a slash /. If a repeater argument is present, then each of the array keys will have a sequence number behind the given name.

> Caution
Note that PHP internally stores int values as signed values of a machine-dependent size (C type long). Integer literals and operations that yield numbers outside the bounds of the int type will be stored as float. When packing these floats as integers, they are first cast into the integer type. This may or may not result in the desired byte pattern.

> The most relevant case is when packing unsigned numbers that would be representable with the int type if it were unsigned. In systems where the int type has a 32-bit size, the cast usually results in the same byte pattern as if the int were unsigned (although this relies on implementation-defined unsigned to signed conversions, as per the C standard). In systems where the int type has 64-bit size, the float most likely does not have a mantissa large enough to hold the value without loss of precision. If those systems also have a native 64-bit C int type (most UNIX-like systems don't), the only way to use the I pack format in the upper range is to create int negative values with the same byte representation as the desired unsigned value.

> Caution
Note that PHP internally stores integral values as signed. If you unpack a large unsigned long and it is of the same size as PHP internally stored values the result will be a negative number even though unsigned unpacking was specified.

> Caution
If you do not name an element, numeric indices starting from 1 are used. Be aware that if you have more than one unnamed element, some data is overwritten because the numbering restarts from 1 for each element.