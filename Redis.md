# Basic
- Redis: REmote DIctionary Server
- Redis is what is called a key-value store, but is actually is a data structurs server
- Redis often referred to as a NoSQL database
- Redis is an in-memory but persistent on disk database
- In Redis the value is not limited to a simple string, but can also hold more complex data structures
- Data is persisted to disk in a single file, which can be backed up simply by copying
- Atomic Operation:
- keys and value's max-size is 512MB
- Redis's LIST is implemented with linked lists

# Setup
1. install:
    1. `wget http://download.redis.io/redis-stable.tar.gz`
    2. `tar xvzf redis-stable.tar.gz`
    3. `cd redis-stable`
    4. `make`
2. start redis: `src/redis-server`
3. interact with redis: `src/redis-cli`
4. conf file: `redis/redis.conf`

# Data Types
- String: a sequence of bytes

    A String value can be at max 512 Megabytes in length

- Hash: a collection of key value pairs

    Every hash can store up to more than 4 billion field-value pairs

- List: lists of strings, sorted by insertion order

    More than 4 billion of elements per list

- Set: unordered collection of unique Strings

    More than 4 billion of members per set

- Sorted Set: Set ordered by score

    While members are unique, scores may be repeated

- HyperLogLog:a algorithm that use randomization to provide an approximation of the number of unique elements in a set

- Pub/Sub: a messager system

    Publishers sends the messages while subscribers receive them
    The link by which messages are transferred is called channel
    An active channel is a Pub/Sub channel with one or more subscribers (not including clients subscribed to patterns)


# Redis Cli CMD
config get {<configName> | *}
config set <configName> <configValue>

# Command Reference

## KEYS MANIPULATION
    EXISTS <key>
        checks whether the key exists or not.
    KEYS <pattern>
        find all keys matching the specified pattern
    RENAME <key> <newkey>
        change the key name
    RENAMENX <key> <newkey>
        rename key, if new key doesn't exist
    DUMP <key>
        returns a serialized version of the value stored at the specified key
    SORT
    MOVE <key> <db>
        move a key to another database
    DEL <key>
        deletes the key, if exists
    EXPIRE <key> <seconds>
        expires the key after the specified seconds
    PEXPIRE <key> <milliseconds>
        expires the key after the specified milliseconds
    EXPIREAT <key> <timeStamp>
        expires the key after the specified time stamp
    PEXPIREAT
    TTL <key>
        get the remaining seconds in keys expiry
            -1:never expire; -2:not exists
        SET a key will reset its TTL
    PTTL <key>
        get the remaining time in keys expiry in milliseconds
    MIGRATE

    OBJECT
    PERSIST <key>
        remove the expiration from the key
    RANDOMKEY
        return a random key from redis
    RESTORE
    TYPE <key>
        return the data type of value stored in key
    SCAN
## STRING
    SET <key> <value>
        sets the value at the specified key
        will replace any existing value
    MSET <key> <value> [<key2> <value2>...]
        set multiple keys to multiple values
    SETNX <key> <value>
        set if not exists
    MSETNX <key> <value> [<key2> <value2>...]
        set multiple keys to multiple values, only if none of the keys exist
    SETBIT <key> <offset> <value>
        sets or clears the bit at offset in the string value stored at key
    SETRANGE <key> <offset> <value>
        overwrite part of a string at key starting at the specified offset
    GET <key>
        get the value of a key
    MGET <key1> [<key2>...]
        get the values of all the given keys
    GETSET <key> <value>
        set new value and return old value
    GETBIT <key> <offset>
        returns the bit value at offset in the string value stored at key
    GETRANGE <key> <start> <end>
        get substring
    INCR <key>
        increment the integer value of a key by one
    INCRBY <key> <increment>
        increment the integer value of a key by the given increment
    INCRBYFLOAT <key> <increment>
        increment the float value of a key by the given amount
    DECR <key>
        decrement the integer value of a key by one
    DECRBY <key> <decrement>
        decrement the integer value of a key by the given decrement
    EXPIRE
    APPEND <key> <value>
        append a value to a key
    BITCOUNT
    BITOP
    BITPOS
    SETEX <key> <second> <value>
        set the value with expiry of a key
    PSETEX <key> <milliseconds> <value>
        set value and expiration in millisecons
    STRLEN <key>
        get the length of the value stored in a key
## LISTS
    LPUSH <key> <value1> [<value2>[...]]
        prepend one or multiple values to a list
    LPUSHX <key>
        prepend a value to a list, only if the list exists
    RPUSH <key> <value1> [<value2>[...]]
        append one or multiple values to a list
    RPUSHX <key> <value>
        append a value to a list, only if the list exists
    LPOP <key>
        remove and get the first element in a list
    BLPOP <key1> [<key2>[...]] <timeout>
        remove and get the first element in a list, or block until one is available or return nil after timeout
    RPOP <key>
        remove and get the last element in a list
    RPOPLPUSH <srcKey> <dstKey>
        remove the last element in a list, append it to another list and return it
    BRPOP <key1> [<key2>[...]] <timeout>
        remove and get the last element in a list, or block until one is available or return nil after timeout
    BRPOPLPUSH <srcKey> <dstKey> <timeout>
        pop a value from a list, push it to another list and return it; or block until one is available
    LREM <key> <count> <value>
        remove elements from a list
        count > 0: Remove elements equal to value moving from head to tail
        count < 0: Remove elements equal to value moving from tail to head
        count = 0: Remove all elements equal to value
    LLEN <key>
        get the length of a list
    LRANGE <key> <start> <stop>
        get a range of elements from a list
    LTRIM <key> <start> <stop>
        trim a list to the specified range
    LINDEX <key> <index>
        get an element from a list by its index
    LINSERT <key> {BEFORE|AFTER} <pivot> <value>
        insert an element before or after another element in a list
    LSET <key> <index> <value>
        set the value of an element in a list by its index
## SET
    SADD <key> <member1> [<member2>[...]]
        add one or more members to a set
    SPOP <key>
        remove and return a random member from a set
    SMOVE <srcKey> <dstKey> <member>
        move a member from one set to another
    SREM <key> <member1> [<member2>[...]]
        remove one or more members from a set
    SISMEMBER <key> <value>
        determine if a given value is a member of a set
    SMEMBERS <key>
        get all the members in a set
    SRANDMEMBER <key> [<count>]
        get one or multiple random members from a set
    SCARD <key>
        get the number of members in a set
    SDIFF <key> <key2> [<key3>[...]]
        subtract multiple sets
    SDIFFSTORE <dstKey> <key1> <key2> [<key3>[...]]
        subtract multiple sets and store the resulting set in a key
    SINTER <key1> <key2> [<key3>[...]]
        intersect multiple sets
    SINTERSTORE <dstKey> <key1> <key2> [<key3>[...]]
        intersect multiple sets and store the resulting set in a key
    SUNION <key1> [<key2>[...]]
        union multiple sets
    SUNIONSTORE <dstKey> <key1> [<key2>[...]]
        union multiple sets and store the resulting set in a key
    SSCAN <key> <cursor> [MATCH <pattern>] [COUNT <count>]
        incrementally iterate Set elements
## SORTED SET
    ZADD <key> <score1> <member1> [<score2> <member2> [...]]
        add one or more members to a sorted set, or update its score if it already exists
    ZREM <key> <member1> [<member2>[...]]
        remove one or more members from a sorted set
    ZCARD <key>
        get the number of members in a sorted set
    ZCOUNT <key> <min> <max>
        count the members in a sorted set with scores within the given values
    ZINCRBY <key> <increment> <member>
        increment the score of a member in a sorted set
    ZINTERSTORE <desKey> <numKey> <key1> <key2> [<key3>[...]] [WEIGHTS <weight1> [weight2 [...]]] [AGGREGATE {SUM|MIN|MAX}]
        Intersect multiple sorted sets and store the resulting sorted set in a new key
    ZREMRANGEBYLEX <key> <min> <max>
        remove all members in a sorted set between the given lexicographical range
    ZREMRANGEBYRANK <key> <start> <stop>
        remove all members in a sorted set within the given indexes
    ZREMRANGEBYSCORE <key> <min> <max>
        remove all members in a sorted set within the given scores
    ZRANGE <key> <start> <stop> [WITHSCORES]
        return a range of members in a sorted set, by index
    ZRANGEBYLEX
    ZRANGEBYSCORE <key> <start> <stop> [WITHSCORES]
        return a range of members in a sorted set, by score, with scores ordered from high to low
    ZREVRANGE <key> <start> <stop> [WITHSCORES]
        return a range of members in a sorted set, by index, with scores ordered from high to low
    ZREVRANGEBYLEX
    ZREVRANGEBYSCORE
    ZRANGEBYSCORE
    ZRANK <key> <member>
        determine the index of a member in a sorted set
    ZREVRANK <key> <member>
        determine the index of a member in a sorted set, with scores ordered from high to low
    ZRANGEBYLEX <key> <min> <max> [LIMIT <offset> <count>]
        return a range of members in a sorted set, by score
    ZLEXCOUNT <key> <min> <max>
        count the number of members in a sorted set between a given lexicographical range
    ZSCORE <key> <member>
        get the score associated with the given member in a sorted set
    ZUNIONSTORE <desKey> <numKey> <key1> <key2> [<key3>[...]] [WEIGHTS <weight1> [weight2 [...]]] [AGGREGATE {SUM|MIN|MAX}]
        add multiple sorted sets and store the resulting sorted set in a new key
    ZSCAN <key> <cursor> [MATCH <pattern>] [COUNT <count>]
        incrementally iterate sorted sets elements and associated scores
## HASHES
    HSET <key> <field> <value>
        set the string value of a hash field
    HSETNX <key> <field> <value>
        set the value of a hash field, only if the field does not exist
    HMSET <key> <field1> <value1> [<field2> <value2>[...]]
        set multiple hash fields to multiple values
    HEXISTS <key> <field>
        determine whether a hash field exists or not
    HGET <key> <field>
        get the value of a hash field stored at specified key
    HMGET <key> <field1> [<field2>[ <field3>[...]]]
        get the values of all the given hash fields
    HGETALL <key>
        get all the fields and values stored in a hash at specified key
    HLEN <key>
        get the number of fields in a hash
    HKEYS <key>
        get all the fields in a hash
    HVALS <key>
        get all the values in a hash
    HSCAN <key> <cursor> [MATCH <pattern>] [COUNT <count>]
        incrementally iterate hash fields and associated values
    HDEL <key> <field1> [<field2>[ <field3>[...]]]
        delete one or more hash fields
    HINCRBY <key> <field> <increment>
        increment the integer value of a hash field by the given number
    HINCREBYFLOAT <key> <field> <increment>
        increment the float value of a hash field by the given amount
## BITMAPS
## HYPERLOGLOG
    PFADD <key> <element1> [<element2>[...]]
        adds the specified elements to the specified HyperLogLog
    PFMERGE <dstKey> <srcKey1> [<srcKey2>[...]]
        merge N different HyperLogLogs into a single one
    PFCOUNT <key1> [<key2>[...]]
        return the approximated cardinality of the set(s) observed by the HyperLogLog at key(s)
## PUB/SUB:
    PSUBSCRIBE <pattern1> [<pattern2>[...]]
        subscribe to channels matching the given patterns
    PUBSUB <subComamnd> [<argument1> [<argument2> [...]]]
        tells the state of pubsub system eg which clients are active on the server
        CHANNEL [<pattern>]
            lists the currently active channels
        NUMSUB [<channel1> [<channel2> [...]]]
            returns the number of subscribers (not counting clients subscribed to patterns) for the specified channels
        NUMPAT
            returns the number of subscriptions to patterns (that are performed using the PSUBSCRIBE command)
    PUBLISH <channel> <msg>
        post a message to a channel
    PUNSUBSCRIBE [<pattern1> [<pattern2> [...]]]
        stop listening for messages posted to channels matching the given patterns
    SUBSCRIBE <channel1> [<channel2> [...]]
        listen for messages published to the given channels
    UNSUBSCRIBE <channel1> [<channel2> [...]]
        stop listening for messages posted to the given channels
## TRANSACTIONS
    DISCARD
    EXEC
    MULTI
    UNWATCH
    WATCH
## SCRIPTING
    EVAL
    EVALSHA
    SCRIPT EXISTS
    SCRIPT FLUSH
    SCRIPT KILL
    SCRIPT LOAD
## CONNECTION
    AUTH
    ECHO
    PING
    QUIT
    SELECT
## SERVER
    BGREWRITEAOF
    BGSAVE
    CLIENT KILL
    CLIENT LIST
    CLIENT GETNAME
    CLIENT PAUSE
    CLIENT SETNAME
    CLUSTER SLOTS
    COMMAND
    COMMAND COUNT
    COMMAND GETKEYS
    COMMAND INFO
    CONFIG GET
    CONFIG REWRITE
    CONFIG SET
    CONFIG RESETSTAT
    DBSIZE
    DEBUG OBJECT
    DEBUG SEGFAULT
    FLUSHALL
    FLUSHDB
    INFO
    LASTSAVE
    MONITOR
    ROLE
    SAVE
    SHUTDOWN
    SLAVEOF
    SLOWLOG
    SYNC
    TIME

# GUI Client?
- redis commander
    1. check requirement node.js
    2. run `npm install redis-commander`
    3. run `redis-commander --open`

# PHPSpec Reference
open/connect(host,port,timeout)
popen/pconncet(host,prot,timeouet)/(persistent_id)
close()
setOption(paramName,paramValue)
getOption(paramName)
ping()
echo(string)
randomKey()
select(dbindex)
move(key,integer)
rename/renameKey(orgName,newName,)
renameNx()
setTimeout/expire/pexpire(keyName,ttl)
expireAt/pexpireAt(keyName,timestamp)
keys/getKeys(pattern)
dbSize()
auth(password)
bgrewriteaof()
slaveof(host,port)/slaveof()
object("encoding"/"refcount"/"idletime",value)
save()
bgsave()
lastsave()
type(keyName)
flushDB()
fushAll()
sort(keyName[,sortArr])
    sortArr(
        'by' => 'somePattern*',
        'limit' => array(0,1),
        'get' => 'someOtherPattern*' or an array of patterns
        'sort' => 'asc' or 'desc',
        'alpha' => true,
        'store' => 'externalKey'
info()
resetStat()
ttl/pttl(keyName)
persist(keyName)
config('GET'/'SET',keyName/pattern[,value])
eval(script[,args[,numKeys]])
evalSha(shaStr,argsArr,numKeys)
script(cmd[,otherArgs...])
getLastError()
_prefix(prefixStr)
_unserialize(Str)
dump(keyName)
restore(keyName,ttl,value)
migrate(host,port,keyName,desDbIndex,timeout)
time()