# See
- <https://www.moesif.com/blog/api-guide/getting-started-with-apis/#>
- Book <PHP Web Services>

# Concepts
REST: REpresentational State Transfer

Representation can be JSON or XML

Anything can be Resources, best thought of as nouns

A Collection contains multiple resources

More a philosophy or a set of principles than a protocol

# Six constraints
1. Unifrom Interface
2. Stateless
3. Cacheable
4. Client-Server
5. Layered System
6. Code on Demand(optional)

REST is completely backend agnostic, there is nothing in the request that informs the server how the data should be operated. just that it should

There are two keys to processing requests the REST way
- to initiate different processing, depending on the HTTP method, even when the URLs are the same
- to know which URL has been requested

# URL
For example, the following is not RESTful: `/clients/add`

This is because it uses a URL to describe an action. This is a fairly fundamental point in distinguishing RESTful from non-RESTful systems

- URLs should be as precise as needed
- Everything needed to uniquely identify a resource should be in the URL
- You should not need to include data identifying the resource in the request
- There are no verbs in these URLs

# HTTP methods
safe methods never modify resources, the only one is GET

idempotent methods achieve the same result, no matter how many times the request is repeated.
the only `non-idempotent` is POST

- GET

Data should never be modified on the server side as a result of a GET request
But of course, once the client receives the data, it is free to do any operation with it on its own side - for instance, format it for display

- PUT

PUT request is used when you wish to create or update the resource

- DELETE

Should be used when you want to delete the resource identified by the URL

- POST

Is used when the processing you wish to happen on the server should be repeated

POST requests should cause processing of the request body as a subordinate of the URL you are posting to

# Response

some common features:
- include some nested information
- include some links out to other resources or collections

# CURD

## Create

request method: POST

response status code:
- 201 (Created) when a new resource has been made
- 201 (Accepted) not completed
- 200 (OK)
- 400 (Bad Request) when request wasn't understood, or didn't pass validation
- 406 (Not Acceptable) content negotiation problem

response body:
- a representation of the new resource, or
- set a `Location` header, redirecting to the URI of the new record

## Fetch

request method: GET

response status code:
- 200 when successfully retrieved
- 302 (Found)
- 304 (Not Modified) cache still valid
- 404 record doesn't exist
- 401 (Not Authorized) user isn't authenticated
- 403 (Forbidden) user authenticated but doesn't have permission
- 420 (Enhance Your Calm) or 429 (Too Many Requests) if reach rate limitation

response body:
- resource return the same representation whether fetched by themselves or in a collection
- always provide info about how to reach a signle resource

## Update

request method: PUT

request body: even if a tiny part need to be updated, the **whole** record should be sent back. If this cumbersome, you can either use the PATCH verb, or create a subresource

response status code: @?

## Delete

request method: DELETE

response status code:
- 200 (OK) or 204 (No Content) when successfully deleted
- 404 (Not Found) if item didn't exist

# Best Practice
- Maximum nesting depth of two, three is also okay if IDs are short