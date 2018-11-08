# See
- http://web.deu.edu.tr/doc/soket/
- https://www.tutorialspoint.com/unix_sockets/

# Concept
- `file descriptor`: is just an integer associated with an open file and it can be a network connection, a text file, a terminal, or something else. In Unix, every I/O action is done by writing or reading a file descriptor
- `sockets`: are just like "worm holes" in science fiction. When things go into one end, they (should) come out of the other. it's a way to talk to other computers using standard Unix file descriptors
- or `sockets`: The IP Address is the identification of a network device within a network, and the Port Number is the identification of a network application within a Host. These two things uniquely identify a network application on a computer and are called Socket
    + `connection-oriented(stream sockets)`: Delivery in a networked environment is guaranteed, use TCP, allow for data to flow back and forth as needed
    + `connectionless(datagram sockets)`: allow only one message at a time to be transmitted, without an open connection, use UDP
    + `raw sockets`: provide users access to the underlying communication protocols, which support socket abstractions
    + `Sequenced Packet Sockets`
- two common families:
    + `AF_INET`: for internet connections
    + `AF_UNIX`: for unix IPC (interprocess communication)