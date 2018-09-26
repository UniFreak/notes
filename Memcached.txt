bookmark:http://www.tutorialspoint.com/memcached/memcached_add_data.htm


=============== Setup ===============
install:
	yum install memcached
run:
	memcached -p <TCP_port> -U <UDP_port> -u <userName> -d
	// usually run at port 11211
connect to:
	telnet <host> <port>

