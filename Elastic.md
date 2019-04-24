# Concepts:
- Elasticsearch:  open-source full-text search and analytics engine
- Cluster: a collection of one or more nodes, identified by name(default: `elasticsearch`)
- Node: a single server that is part of your cluster, identified by name(default: random UUID)
- Index: a collection of documents that have somewhat similar characteristics
- Type: a logical category/partition of your index(**deprecated**)
- Document: a basic unit of information that can be indexed
- Shard: a fully-functional and independent "index" that can be hosted on any node in the cluster
- Replica: one or more copies of your index’s shards
- Primary Shard: one or more copies of your index’s shards
- Replica Shard: copies of the primary shards
- X-Pack: an Elastic Stack extension that bundles security, alerting, monitoring, reporting, machine learning, and graph capabilities into one
- Mapping: the process of defining how a document, and the fields it contains, are stored and indexed
- Analysis: the process of converting text, like the body of any email, into tokens or terms which are added to the inverted index for searching

# Notes:
- Unlike replicas, shard number can't be changed dynamically after index is created

# Use Cases:
- complex search
- data analyze and mining(Logstash)
- reverse search
- data visulization(Kibana)

# Rest APIs: `<REST Verb> /<Index>/<Type>/<ID>`
- health check: `GET /_cat/health?v`

- list nodes: `GET /_cat/nodes?v`
- list indices: `GET /_cat/indices?v`
- create index: `PUT /customer?pretty`
- delete index: `DELETE /customer?pretty`
- create/replace(with same id) document:

```
    PUT /customer/_doc/1?pretty
    {
      "name": "John Doe"
    }
```
- update document:
    + by `_update`:
    ```
    POST /customer/_doc/1/_update?pretty
    {
      "doc": { "name": "Jane Doe" }
    }
    ```
    + by script:
    ```
    POST /customer/_doc/1/_update?pretty
    {
      "script" : "ctx._source.age += 5"
    }
    ```
- get document: `GET /customer/_doc/1?pretty`
- delete document: `DELETE /customer/_doc/2?pretty`
- `_bulk` api:
    ```
    POST /customer/_doc/_bulk?pretty
    {"index":{"_id":"1"}}
    {"name": "John Doe" }
    {"index":{"_id":"2"}}
    {"name": "Jane Doe" }
    {"update":{"_id":"1"}}
    {"doc": { "name": "John Doe becomes Jane Doe" } }
    {"delete":{"_id":"2"}}
    ```
- search:
    + By URI: `GET /bank/_search?q=*&sort=account_number:asc&pretty`
    + By body:
    ```
    GET /bank/_search
    {
      "query": { "match_all": {} },
      "sort": [
        { "account_number": "asc" }
      ]
    }
    ```

# Query DSL
- query
    + match_all
    + match
    + match_phrase
    + bool
        * must
        * should
        * must_not
        * filter
            - range
            - gte
            - lte
- aggs
    + group_by_*
    + average_*
    + terms
    + avg
    + field
- sort
    + order: desc|asc
- size
- from
- _source