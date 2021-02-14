# See
- <https://github.com/donnemartin/system-design-primer>
- <http://highscalability.com/>
- <https://www.hiredintech.com/system-design>
- <https://leetcode.com/discuss/career/229177/My-System-Design-Template>
- Book: Desgining Data-Intensive Application
- Book: 大型网站技术架构

# How to Ace 

If systems design isn’t your strength, that’s okay, but you should at least be able to talk and reason competently about a complex system.

What we actually care about is the **thought process** behind your design choices.

the point of the interview is to see how much volume you can cover in 45 minutes.

For the most part, you’ll be steering the conversation. It’s up to you to understand the problem. That might mean asking questions, sketching diagrams on the board, and bouncing ideas off your interviewer. Do you know the constraints? What kind of inputs does your system need to handle? You have to get a sense for the scope of the problem before you start exploring the space of possible solutions. And remember, there is no single right answer to a real-world problem. Everything is a tradeoff.

If you listen carefully, make sure you fully understand the problem, and then take a clear, straightforward approach to communicating your ideas, you should do fine.

## Topics

Concurrency. Do you understand threads, deadlock, and starvation? Do you know how to parallelize algorithms? Do you understand consistency and coherence?

Networking. Do you roughly understand IPC and TCP/IP? Do you know the difference between throughput and latency, and when each is the relevant factor?

Abstraction. You should understand the systems you’re building upon. Do you know roughly how an OS, file system, and database work? Do you know about the various levels of caching in a modern OS?

Real-World Performance. You should be familiar with the speed of everything your computer can do, including the relative performance of RAM, disk, SSD and your network.

Estimation. Estimation, especially in the form of a back-of-the-envelope calculation, is important because it helps you narrow down the list of possible solutions to only the ones that are feasible. Then you have only a few prototypes or micro-benchmarks to write.

Availability and Reliability. Are you thinking about how things can fail, especially in a distributed environment? Do know how to design a system to cope with network failures? Do you understand durability?

Remember, we’re not looking for mastery of all these topics. We’re looking for familiarity. so you know which questions to ask and when to consult an expert.

## Prepare

you’ll need practice to get better at design. Here are some activities that can help:

- Do mock design sessions
- Work on an actual system
- Do back-of-the-envelope calculations for something you’re building and then write micro-benchmarks to verify them
- Dig into the performance characteristics of an open source system
- Learn how databases and operating systems work

# Approching Interview Question

Step 1: Outline use cases, constraints, and assumptions

target: who? how? how many?
do: what? inputs/outputs? 
volumn: data? requset per sec? r/w ratio?

Step 2: Create a high level design

Sketch the main components and connections
Justify your ideas

Step 3: Design core components

Dive into details for each core component

## Template

1. FEATURE EXPECTATIONS [5 min]
    1. Use cases
    2. Scenarios that will not be covered
    3. Who will use
    4. How many will use
    5. Usage patterns
2. ESTIMATIONS [5 min]
    1. Throughput (QPS for read and write queries)
    2. Latency expected from the system (for read and write queries)
    3. Read/Write ratio
    4. Traffic estimates
        - Write (QPS, Volume of data)
        - Read  (QPS, Volume of data)
    5. Storage estimates
    6. Memory estimates
        - If we are using a cache, what is the kind of data we want to store in cache
        - How much RAM and how many machines do we need for us to achieve this ?
        - Amount of data you want to store in disk/ssd
3. DESIGN GOALS [5 min]
    1. Latency and Throughput requirements
    2. Consistency vs Availability  
        - Weak/strong/eventual => consistency
        - Failover/replication => availability
4. HIGH LEVEL DESIGN [5-10 min]
    1. APIs for Read/Write scenarios for crucial components
    2. Database schema
    3. Basic algorithm
    4. High level design for Read/Write scenario
5. DEEP DIVE [15-20 min]
    1. Scaling the algorithm
    2. Scaling individual components: 
        -> Availability, Consistency and Scale story for each component
        -> Consistency and Availability patterns
    3. Think about the following components, how they would fit in and how it would help
        a) DNS
        b) CDN [Push vs Pull]
        c) Load Balancers [Active-Passive, Active-Active, Layer 4, Layer 7]
        d) Reverse Proxy
        e) Application layer scaling [Microservices, Service Discovery]
        f) DB [RDBMS, NoSQL]
            > RDBMS: Master-slave, Master-master, Federation, Sharding, Denormalization, SQL Tuning
            > NoSQL: Key-Value, Wide-Column, Graph, Document
                Fast-lookups:
                -------------
                >>> RAM  [Bounded size] => Redis, Memcached
                >>> AP [Unbounded size] => Cassandra, RIAK, Voldemort
                >>> CP [Unbounded size] => HBase, MongoDB, Couchbase, DynamoDB
        g) Caches
            > Client caching, CDN caching, Webserver caching, Database caching, Application caching, Cache @Query level, Cache @Object level
            > Eviction policies:
                >> Cache aside
                >> Write through
                >> Write behind
                >> Refresh ahead
        h) Asynchronism
            > Message queues
            > Task queues
            > Back pressure
        i) Communication
            > TCP
            > UDP
            > REST
            > RPC
6. JUSTIFY [5 min]
    1. Throughput of each layer
    2. Latency caused between each layer
    3. Overall latency justification


# Topics

## High level tradeoff

### Performance vs scalability

A service is scalable if it results in increased performance in a manner proportional to resources added.

If you have a performance problem, your system is slow for a single user.
If you have a scalability problem, your system is fast for a single user but slow under heavy load.

### Latency vs throughput

Latency is the time to perform some action or to produce some result.
Throughput is the number of such actions or results per unit of time.
Generally, you should aim for **maximal throughput** with **acceptable latency**.

### Availability vs consistency

CAP Theorem: In a distributed computer system:
- Consistency - Every read receives the most recent write or an error
- recent version of the information
- network failures

Networks aren't reliable, so **you'll need to support partition tolerance**. 
You'll need to make a software tradeoff between consistency and availability.
- CP - consistency and partition tolerance
- AP - availability and partition tolerance

## Consistency patterns

Weak consistency: best effort only, after write, reads may or may not see it
    such as memcached.
    works well in real time use cases such as VoIP, video chat, and realtime multiplayer games.
Eventual consistency: after write, reads will eventually see it
    such as DNS, email, Amazon S3, SimpleDB and search engine index.
    works well in highly available systems.
Strong consistency: after write, read will see it
    such as file systems and RDBMSes, Azure.
    works well in systems that need transactions.

## Availability patterns

Two complementary patterns to support high availability

- Failover

    + Active-passive/master-slave: heartbeats are sent between the active and the passive server on standby. If the heartbeat is interrupted, the passive server takes over the active's IP address and resumes service.

    The length of downtime is determined by whether the passive server is already running in 'hot' standby or whether it needs to start up from 'cold' standby. Only the active server handles traffic.

    + Active-active/master-master: both servers are managing traffic, spreading the load between them.

    If the servers are public-facing, the DNS would need to know about the public IPs of both servers. If the servers are internal-facing, application logic would need to know about both servers.

Fail-over adds more hardware and additional complexity.
There is a potential for loss of data if the active system fails before any newly written data can be replicated to the passive

- Replication @see Database

Master-slave replication
Master-master replication

### In Number

99.9% availability - three 9s
Duration    Acceptable downtime
Downtime per year   8h 45min 57s
Downtime per month  43m 49.7s
Downtime per week   10m 4.8s
Downtime per day    1m 26.4s

99.99% availability - four 9s
Duration    Acceptable downtime
Downtime per year   52min 35.7s
Downtime per month  4m 23s
Downtime per week   1m 5s
Downtime per day    8.6s

in sequence: Availability (Total) = Availability (Foo) * Availability (Bar)
in parallel: Availability (Total) = 1 - (1 - Availability (Foo)) * (1 - Availability (Bar))

## DNS

NS record (name server) - Specifies the DNS servers for your domain/subdomain.
MX record (mail exchange) - Specifies the mail servers for accepting messages.
A record (address) - Points a name to an IP address.
CNAME (canonical) - Points a name to another name or CNAME (example.com to www.example.com) or to an A record.

CloudFlare and Route 53 provide managed DNS services

## CDN

Serving content from CDNs can significantly improve performance in two ways:
- Users receive content from data centers close to them
- Your servers do not have to serve requests that the CDN fulfills

some CDNs such as `Amazon's CloudFront` support dynamic content

### Push CDNs

Push CDNs receive new content whenever changes occur on your server. You take full responsibility for providing content, uploading directly to the CDN and rewriting URLs to point to the CDN. You can configure when content expires and when it is updated. Content is uploaded only when it is new or changed, minimizing traffic, but maximizing storage.

Sites with a **small amount** of traffic or sites with content that **isn't often updated** work well with push CDNs. Content is placed on the CDNs once, instead of being re-pulled at regular intervals.

### Pull CDNs

Pull CDNs grab new content from your server when the first user requests the content. You leave the content on your server and rewrite URLs to point to the CDN. This results in a slower request until the content is cached on the CDN.

A time-to-live (TTL) determines how long content is cached. Pull CDNs minimize storage space on the CDN, but can create redundant traffic if files expire and are pulled before they have actually changed.

Sites with **heavy traffic** work well with pull CDNs, as traffic is spread out more evenly with only recently-requested content remaining on the CDN.

### Cons

CDN costs could be significant depending on traffic, although this should be weighed with additional costs you would incur not using a CDN.
Content might be stale if it is updated before the TTL expires it.
CDNs require changing URLs for static content to point to the CDN.

## Load Banlancer

can be implemented with hardware (expensive) or with software such as `HAProxy`.

Why:
- Preventing requests from going to unhealthy servers
- Preventing overloading resources
- Helping to eliminate a single point of failure
- SSL termination (Removes the need to install X.509 certificates on each server)
- Session persistence
- Help with horizontal scaling

it's common to set up multiple load balancers, either in active-passive or active-active mode.

### Route Traffic:

- Random
- Least loaded
- Session/cookies
- Round robin or weighted round robin
- Layer 4
    Layer 4 load balancers look at info at the transport layer to decide how to distribute requests. Generally, this involves the source, destination IP addresses, and ports in the header, but not the contents of the packet. Layer 4 load balancers forward network packets to and from the upstream server, performing Network Address Translation (NAT).
- Layer 7
    Layer 7 load balancers look at the application layer to decide how to distribute requests. This can involve contents of the header, message, and cookies. Layer 7 load balancers terminate network traffic, reads the message, makes a load-balancing decision, then opens a connection to the selected server. For example, a layer 7 load balancer can direct video traffic to servers that host videos while directing more sensitive user billing traffic to security-hardened servers.

At the cost of flexibility, layer 4 load balancing requires less time and computing resources than Layer 7, although the performance impact can be minimal on modern commodity hardware.

### Cons

- The load balancer can become a **performance bottleneck** if it does not have enough resources or if it is not configured properly.
- Introducing a load balancer to help eliminate a single point of failure results in **increased complexity.**
- A single load balancer is a single point of failure, configuring multiple load balancers further increases complexity.
  
## Reverse proxy (web server)

A reverse proxy is a web server that centralizes internal services and provides unified interfaces to the public. Requests from clients are forwarded to a server that can fulfill it before the reverse proxy returns the server's response to the client.

Why:
- Increased security - Hide information about backend servers, blacklist IPs, limit number of connections per client
- Increased scalability and flexibility - Clients only see the reverse proxy's IP, allowing you to scale servers or change their configuration
- SSL termination - Decrypt incoming requests and encrypt server responses so backend servers do not have to perform these potentially expensive operations. Removes the need to install X.509 certificates on each server
- Compression - Compress server responses
- Caching - Return the response for cached requests
- Static content - Serve static content directly: HTML/CSS/JS Photos Videos Etc

VS Load Banlancer:
- Deploying a load balancer is useful when you have multiple servers. Often, load balancers route traffic to a set of servers serving the **same** function.
- Reverse proxies can be useful even with just one web server or application server, opening up the benefits described in the previous section.
- Solutions such as NGINX and HAProxy can support both layer 7 reverse proxying and load balancing.

Cons:
- increased complexity.
- A single reverse proxy is a single point of failure, configuring multiple reverse proxies (ie a failover) further increases complexity.

## Application Layer

### MicroService

a suite of independently deployable, small, modular services. Each service runs a unique process and communicates through a well-defined, lightweight mechanism to serve a business goal. 1

### Service Discovery

Systems such as `Consul`, `Etcd`, and `Zookeeper` can help services find each other by keeping track of registered names, addresses, and ports. 

Health checks help verify service integrity and are often done using an HTTP endpoint. 

Both Consul and Etcd have a built in key-value store that can be useful for storing config values and other shared data.

Cons:
- requires a different approach from an architectural, operations, and process viewpoint (vs a monolithic system).
- add complexity in terms of deployments and operations.


## Database

ACID is a set of properties of relational database transactions.
- Atomicity - Each transaction is all or nothing
- Consistency - Any transaction will bring the database from one valid state to another
Isolation - Executing transactions concurrently has the same results as if the transactions were - executed serially
- Durability - Once a transaction has been committed, it will remain so

### Scale:

- master-slave replication

    The master serves reads and writes, replicating writes to one or more slaves, which serve only reads. Slaves can also replicate to additional slaves in a tree-like fashion. If the master goes offline, the system can continue to operate in read-only mode until a slave is promoted to a master or a new master is provisioned.

    Cons:
    - Additional logic is needed to promote a slave to a master
    - @see Replication cons

- master-master replication

    Both masters serve reads and writes and coordinate with each other on writes. If either master goes down, the system can continue to operate with both reads and writes.

    Cons:
    - You'll need a load balancer or you'll need to make changes to your application logic to determine where to write.
    - Most master-master systems are either loosely consistent (violating ACID) or have increased write latency due to synchronization.
    - Conflict resolution comes more into play as more write nodes are added and as latency increases.
    - See Replication cons

- federation

    Federation (or functional partitioning) splits up databases by function. For example, instead of a single, monolithic database, you could have three databases: forums, users, and products, 

    Pros:
    - less read and write traffic to each database and therefore less replication lag. - Smaller databases result in more data that can fit in memory, which in turn results in more cache hits due to improved cache locality. 
    - With no single central master serializing writes you can write in parallel, increasing throughput.

    Cons:
    - Federation is not effective if your schema requires huge functions or tables.
    - You'll need to update your application logic to determine which database to read and write.
    - Joining data from two databases is more complex with a server link.
    - Federation adds more hardware and additional complexity.

- sharding

    Sharding distributes data across different databases such that each database can only manage a subset of the data. Taking a users database as an example, as the number of users increases, more shards are added to the cluster.

    Common ways to shard a table of users is either through the user's last name initial or the user's geographic location.

    Pros:
    - less read and write traffic, less replication, and more cache hits. 
    - Index size is also reduced, which generally improves performance with faster queries. 
    - If one shard goes down, the other shards are still operational, although you'll want to add some form of replication to avoid data loss. 
    - Like federation, there is no single central master serializing writes, allowing you to write in parallel with increased throughput.

    Cons:
    - need to update your application logic to work with shards, which could result in complex SQL queries.
    - Data distribution can become lopsided in a shard. For example, a set of power users on a shard could result in increased load to that shard compared to others.
    - Rebalancing adds additional complexity. A sharding function based on consistent hashing can reduce the amount of transferred data.
    - Joining data from multiple shards is more complex.
    - Sharding adds more hardware and additional complexity.

- Denormalization

    Denormalization attempts to improve read performance at the expense of some write performance. Redundant copies of the data are written in multiple tables to avoid expensive joins. Some RDBMS such as PostgreSQL and Oracle support materialized views which handle the work of storing redundant information and keeping redundant copies consistent.

    Once data becomes distributed with techniques such as federation and sharding, managing joins across data centers further increases complexity. Denormalization might circumvent the need for such complex joins.

    In most systems, reads can heavily outnumber writes 100:1 or even 1000:1. A read resulting in a complex database join can be very expensive, spending a significant amount of time on disk operations.

    Cons:
    Data is duplicated.
    Constraints can help redundant copies of information stay in sync, which increases complexity of the database design.
    A denormalized database under heavy write load might perform worse than its normalized counterpart.

- SQL tuning

    See <High Performance MySQL> <SQL Antipattern>

    It's important to benchmark and profile to simulate and uncover bottlenecks.

    Benchmark - Simulate high-load situations with tools such as ab.
    Profile - Enable tools such as the slow query log to help track performance issues.

    Benchmarking and profiling might point you to the following optimizations.

    - Tighten up the schema
        MySQL dumps to disk in contiguous blocks for fast access.
        Use CHAR instead of VARCHAR for fixed-length fields.
        CHAR effectively allows for fast, random access, whereas with VARCHAR, you must find the end of a string before moving onto the next one.
        Use TEXT for large blocks of text such as blog posts. TEXT also allows for boolean searches. Using a TEXT field results in storing a pointer on disk that is used to locate the text block.
        Use INT for larger numbers up to 2^32 or 4 billion.
        Use DECIMAL for currency to avoid floating point representation errors.
        Avoid storing large BLOBS, store the location of where to get the object instead.
        VARCHAR(255) is the largest number of characters that can be counted in an 8 bit number, often maximizing the use of a byte in some RDBMS.
        Set the NOT NULL constraint where applicable to improve search performance.
    - Use good indices
        Columns that you are querying (SELECT, GROUP BY, ORDER BY, JOIN) could be faster with indices.
        Indices are usually represented as self-balancing B-tree that keeps data sorted and allows searches, sequential access, insertions, and deletions in logarithmic time.
        Placing an index can keep the data in memory, requiring more space.
        Writes could also be slower since the index also needs to be updated.
        When loading large amounts of data, it might be faster to disable indices, load the data, then rebuild the indices.
    - Avoid expensive joins
        Denormalize where performance demands it.
    - Partition tables
        Break up a table by putting hot spots in a separate table to help keep it in memory.
    - Tune the query cache
        In some cases, the query cache could lead to performance issues.

## NoSQL

Most NoSQL stores lack true ACID transactions and favor eventual consistency.

BASE chooses availability over consistency:
- Basically available - the system guarantees availability.
- Soft state - the state of the system may change over time, even without input.
- Eventual consistency - the system will become consistent over a period of time, given that the system doesn't receive input during that period.


### Key-value store (Abstraction: hash table)

generally allows for O(1) reads and writes 
often backed by memory or SSD
can maintain keys in lexicographic order, allowing efficient retrieval of key ranges
Key-value stores can allow for storing of metadata with a value.

provide high performance 
often used for simple data models or for rapidly-changing data, such as an in-memory cache layer. 
offer only a limited set of operations, complexity is shifted to the application layer

the basis for more complex systems such as a document store, and in some cases, a graph database.

### Document store (Abstraction: key-value store with documents stored as values)

centered around documents (XML, JSON, binary, etc), where a document stores all information for a given object. 
provide APIs or a query language to query based on the internal structure of the document itself. 
Many include features for working with a value's metadata, blurring the lines between these two storage types. (?)

documents are organized by collections, tags, metadata, or directories. 
documents can be organized or grouped together
documents may have fields that are completely different from each other.

MongoDB and CouchDB also provide a SQL-like language to perform complex queries
DynamoDB supports both key-values and documents.

provide high flexibility and are often used for working with occasionally changing data.

### Wide column store (Abstraction: nested map ColumnFamily<RowKey, Columns<ColKey, Value, Timestamp>>)

basic unit of data is a column (name/value pair). 
column can be grouped in column families (analogous to a SQL table). 
Super column families further group column families. 
You can access each column independently with a row key, and columns with the same row key form a row. 
Each value contains a timestamp for versioning and for conflict resolution.

Google introduced `Bigtable` as the first wide column store, which influenced the open-source `HBase` often-used in the Hadoop ecosystem, and `Cassandra` from Facebook. 
Stores such as BigTable, HBase, and Cassandra maintain keys in lexicographic order, allowing efficient retrieval of selective key ranges.

Wide column stores offer high availability and high scalability
They are often used for very large data sets.

### Graph database (Abstraction: graph)

each node is a record and each arc is a relationship between two nodes. 
optimized to represent complex relationships with many foreign keys or many-to-many relationships.

offer high performance for data models with complex relationships, such as a social network. 
relatively new and are not yet widely-used. more difficult to find development tools and resources. 
Many graphs can only be accessed with REST APIs.

## SQL or NoSQL

Reasons for SQL:
- Structured data
- Strict schema
- Relational data
- Need for complex joins
- Transactions
- Clear patterns for scaling
- More established: developers, community, code, tools, etc
- Lookups by index are very fast

Reasons for NoSQL:
- Semi-structured data
- Dynamic or flexible schema
- Non-relational data
- No need for complex joins
- Store many TB (or PB) of data
- Very data intensive workload
- Very high throughput for IOPS

Sample data well-suited for NoSQL:
- Rapid ingest of clickstream and log data
- Leaderboard or scoring data
- Temporary data, such as a shopping cart
- Frequently accessed ('hot') tables
- Metadata/lookup tables

## Cache

### Where

- Client caching: OS or browser
- CDN 
- Web server caching

    Reverse proxies and caches such as `Varnish` can serve static and dynamic content directly. Web servers can also cache requests, returning responses without having to contact application servers.

- Database caching

    database usually includes some level of caching in a default configuration, optimized for a generic use case. Tweaking these settings for specific usage patterns can further boost performance.

- Application caching

    Memcached and Redis

    Generally, you should try to avoid file-based caching, as it makes cloning and auto-scaling more difficult.

    Caching at the database query level
        Whenever you query the database, hash the query as a key and store the result to the cache. This approach suffers from expiration issues:
        Hard to delete a cached result with complex queries
        If one piece of data changes such as a table cell, you need to delete all cached queries that might include the changed cell
    Caching at the object level
        Suggestions of what to cache:
        User sessions
        Fully rendered web pages
        Activity streams
        User graph data

### When to Update Cache

- Cache-aside / lazy loading

    The application is responsible for reading and writing from storage. The cache does not interact with storage directly. The application does the following:
    - Look for entry in cache, resulting in a cache miss
    - Load entry from the database
    - Add entry to cache
    - Return entry

    Cons:
    - Each cache miss results in three trips, which can cause a noticeable delay.
    - Data can become stale if it is updated in the database. -> TTL or write-through
    - When a node fails, it is replaced by a new, empty node, increasing latency.

- Write-through

    application uses the cache as the main data store, reading and writing data to it, while thecache is responsible for reading and writing to the database:
    - Application adds/updates entry in cache
    - Cache synchronously writes entry to data store
    - Return

    Write-through is a slow overall operation due to the write operation, but subsequent reads of just written data are fast. 
    Users are generally more tolerant of latency when updating data than reading data. Data in the cache is not stale.

    Cons:
    - When a new node is created due to failure or scaling, the new node will not cache entries until the entry is updated in the database  -> Cache-aside in conjunction
    - Most data written might never be read -> minimized with a TTL.

- Write-behind (write-back)
    
    application does the following:
    - Add/update entry in cache
    - Asynchronously write entry to the data store, improving write performance

    Cons:
    - data loss if the cache goes down prior to its contents hitting the data store
    - more complex to implement than the others

- Refresh-ahead

    Configure the cache to automatically refresh any recently accessed cache entry prior to its expiration.

    can result in reduced latency vs read-through if the cache can accurately predict which items are likely to be needed in the future.

    Cons:
    - Not accurately predicting which items are likely to be needed in the future can result in reduced performance than without refresh-ahead.

### Cons

- Need to maintain consistency between caches and the source of truth
- Cache invalidation is a difficult problem, there is additional complexity associated with when to update the cache.
- Need to make application changes

## Asynchronism

Why
- reduce request times for expensive operations that would otherwise be performed in-line. 
- by doing time-consuming work in advance, such as periodic aggregation of data

### Message Queue

An application publishes a job to the queue, then notifies the user of job status
A worker picks up the job from the queue, processes it, then signals the job is complete

- `Redis` is useful as a simple message broker but messages can be lost.
- `RabbitMQ` is popular but requires you to adapt to the 'AMQP' protocol and manage your own nodes.
- `Amazon SQS` is hosted but can have high latency and has the possibility of messages being delivered twice.

### Task queues

Tasks queues receive tasks and their related data, runs them, then delivers their results. They can support scheduling and can be used to run computationally-intensive jobs in the background.

`Celery` has support for scheduling and primarily has python support

VS Message Queue

### Back pressure

If queues start to grow significantly, the queue size can become larger than memory, resulting in cache misses, disk reads, and even slower performance. Back pressure can help by limiting the queue size, thereby maintaining a high throughput rate and good response times for jobs already in the queue. Once the queue fills up, clients get a server busy or HTTP 503 status code to try again later. Clients can retry the request at a later time, perhaps with exponential backoff.

### Cons

Use cases such as inexpensive calculations and realtime workflows might be better suited for synchronous operations, as introducing queues can add delays and complexity.

## Communication

### HTTP

### TCP

Use TCP over UDP when:
- You need all of the data to arrive intact
- You want to automatically make a best estimate use of the network throughput

### UDP

Use UDP over TCP when:
- You need the lowest latency
- Late data is worse than loss of data
- You want to implement your own error correction

### RPC

Popular RPC frameworks include `Protobuf`, `Thrift`, and `Avro`

often used for performance reasons with internal communications, as you can hand-craft native calls to better fit your use cases.

Cons:
- RPC clients become tightly coupled to the service implementation.
- A new API must be defined for every new operation or use case.
- It can be difficult to debug RPC.
- You might not be able to leverage existing technologies out of the box. For example, it might require additional effort to ensure RPC calls are properly cached on caching servers such as `Squid`.

### REST

Being stateless, REST is great for horizontal scaling and partitioning.

There are four qualities of a RESTful:
- Identify resources (URI in HTTP) - use the same URI regardless of any operation.
- Change with representations (Verbs in HTTP) - use verbs, headers, and body.
- Self-descriptive error message (status response in HTTP) - Use status codes, don't reinvent the wheel.
- HATEOAS (HTML interface for HTTP) - your web service should be fully accessible in a browser.

Cons:
- With REST being focused on exposing data, it might not be a good fit if resources are not naturally organized or accessed in a simple hierarchy. For example, returning all updated records from the past hour matching a particular set of events is not easily expressed as a path. With REST, it is likely to be implemented with a combination of URI path, query parameters, and possibly the request body.
- REST typically relies on a few verbs (GET, POST, PUT, DELETE, and PATCH) which sometimes doesn't fit your use case. For example, moving expired documents to the archive folder might not cleanly fit within these verbs.
- Fetching complicated resources with nested hierarchies requires multiple round trips between the client and server to render single views, e.g. fetching content of a blog entry and the comments on that entry. For mobile applications operating in variable network conditions, these multiple roundtrips are highly undesirable.
- Over time, more fields might be added to an API response and older clients will receive all new data fields, even those that they do not need, as a result, it bloats the payload size and leads to larger latencies.

## Security

