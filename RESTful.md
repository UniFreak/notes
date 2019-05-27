# Six constraints
1. Unifrom Interface
2. Stateless
3. Cacheable
4. Client-Server
5. Layered System
6. code on Demand(optional)


- REST is completely backend agnostic
- there is nothing in the request that informs the server how the data should be operated. just that it should

- There are two keys to processing requests the REST way.
- The first key is to initiate different processing, depending on the HTTP method, even when the URLs are the same
- The other key is to know which URL has been requested


# URL
- Resources are best thought of as nouns. For example, the following is not RESTful:

`/clients/add`

- This is because it uses a URL to describe an action.
- This is a fairly fundamental point in distinguishing RESTful from non-RESTful systems.
- URLs should be as precise as needed
- Everything needed to uniquely identify a  resource should be in the URL.
- You should not need to include data identifying the resource in the request

# HTTP methods
- safe methods: never modify resources, the only one is GET
- idempotent methods:
    + achieve the same result, no matter how many times the request is repeated
    + the only `non-idempotent` is POST

- GET

Data should never be modified on the server side as a result of a GET request
But of course, once the client receives the data,
it is free to do any operation with it on its own side - for instance, format it for display.

- PUT

PUT request is used when you wish to create or update the resource

- DELETE

Should be used when you want to delete the resource identified by the URL

- POST @?

Is used when the processing you wish to happen on the server should be repeated
POST requests should cause processing of the request body as a subordinate of the URL you are posting to