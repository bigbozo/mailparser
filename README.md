#Mailparser
Docker image based on centos, php-mailparse php-mail-parser/php-mail-parser to parse email-streams.

##Usage

###build

	docker build <Containername> .

###Invocation

	docker run -ti -v <Dir containing mail-folder>:/data <Containername> 
