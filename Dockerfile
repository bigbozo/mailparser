############################################################
# Dockerfile to build Nginx Server For Jobo's WanderlustBlog
# Based on Ubuntu
############################################################

# Set the base image to Ubuntu
FROM centos

# File Author / Maintainer
MAINTAINER Bugi Goertz

# Update the repository
RUN yum -y update

# Install necessary packages
RUN yum install -y epel-release

RUN yum install -y php-mailparse 

RUN yum install -y curl

RUN mkdir /vendor && \
	cd /vendor && \
	curl -sS https://getcomposer.org/installer | php

ADD lib/composer.json /vendor/composer.json

RUN cd /vendor && ./composer.phar install

ADD app /app

CMD /app/parse.php
