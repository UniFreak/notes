# Auth

- Basic Auth
- HTTP Digest
- OAuth

Use auth only on trusted networks or over SSL

# Content Negotiate

Do take care of setting `Content-Type` header correctly

# Webhooks

use case
- event-driven, publish-subscribe, observer...
- avoid polling, performance

better approach is to use a job queue

# Design

## Best Practice

Always respond in the format that the client was expecting. Don't forget error and exception

Standards are always good

Consistency is key: naming, validation, structures, error message

## Types

Things to consider:
- Who will be using this API?
- What are they trying to achevie?
- Which technologies do they use?

Guide line:
- User first, rather than a developer's preferred toolchain
- Build API that is used both internally and externally
- Start small, keept it simple

### RPC: remote procedures call
- JSON over RPC
- JSON-RPC
- XML over RPC
- XML-RPC

typically have a single endpoint

do **action** rather than work with **things**

### SOAP: Simple Object Access Protocal

WSDL: Web Service Descrption Language

WSDL files are commonly used with SOAP, but can be used with other types of web services
SOAP can also be used without WSDL file

### REST: REpresentational State Transfer

see `RESTful.md`

deals with manipulating **things** or groups of **things**

### HAL: Hypertext Application Language

`_links` colletion used to bring hypermedia into a known location and a known format
supports embedding related resources within a result set
has `curies` describing where the documentation can be found

## JSON-API

Much like HAL, sests out standard ways of organizing info. like `errors`, `meta`, `data`, `jsonapi`, `links`, `included`.

## Presentation

### Format

XML, JSON, HTML, or multiple

Things to consider:
- bandwidth
- device power

### Nested Data Many Round Trips

choice:
- subset of info returned by default, more info functionality offerred
- extra info made available as a separate resource
- provisions for controlling how much detail is returned

## Versioning

- using URL
- using media types, which is invented content types, like `application/vnd.github.v3`

## Defaults

Things to consider
- Accpet header
- paginatioin settings
- rate limits

# Tools

see <Tools.md #api>
