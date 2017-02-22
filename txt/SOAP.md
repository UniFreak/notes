#SOAP

```xml
<?xml version="1.0"?>
    <soap:Envelope
        xmlns:soap="http://www.w3.org/2001/12/soap-envelope"
        soap:encodingStyle="http://www.w3.org/2001/12/soap-encoding">

        <soap:Header>
        </soap:Header>

        <soap:Body>
            <soap:Fault>
            </soap:Fault>
        </soap:Body>
    </soap:Envelope>
```

#WSDL(Web Service Description Language)

```xml
<definitions> // root element
    <types> 
        // type of data used, XML in this case
    </types>

    <message> // data elements for the service
        <part></part>
    </message>

    <portType>
        // operations that can be performed with your web service 
        // and the request response messages that are used
    </portType>

    <binding>
        // the protocol and data format specification for a particular portType
    </binding>

    <service>
        // a collection of service element contains the service's URI
    </service>
</definitions>
```