FROM centos:7.7.1908

MAINTAINER Roshandelpoor Mohammad

##############################################
# installing required stuff
##############################################
RUN yum -y update

RUN yum install -y unzip libaio-dev libmcrypt-dev

RUN yum install -y epel-release \
    && rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

RUN yum install -y curl nano nodejs wget htop git yum-utils


##############################################
# Httpd Install
##############################################
RUN yum install -y httpd
RUN yum install -y firewalld
###RUN firewall-cmd --permanent --add-port=80/tcp
###RUN firewall-cmd --permanent --add-port=443/tcp


##############################################
# tomcat install
##############################################
RUN yum install -y java-1.8.0-openjdk.x86_64

RUN groupadd tomcat

RUN yum install -y tomcat
RUN echo 'JAVA_OPTS="-Djava.security.egd=file:/dev/./urandom -Djava.awt.headless=true -Xmx512m -XX:MaxPermSize=256m -XX:+UseConcMarkSweepGC"' >> /usr/share/tomcat/conf/tomcat.conf

RUN yum install -y haveged
##RUN systemctl start tomcat.service
##RUN firewall-cmd --zone=public --permanent --add-port=8080/tcp
##RUN firewall-cmd --reload


##############################################
# PHP Install
##############################################
RUN yum --enablerepo=remi-php72 install -y php

RUN yum --enablerepo=remi-php72 install -y php-xml php-soap php-pdo php-mysql php-pdo_oci php-xmlrpc php-mbstring php-json php-gd php-mcrypt php-oci php-fpm php-zip php-xdebug php-pear php-devel


##############################################
# PHP extensions enable by docker
##############################################
#RUN \
#    docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
#    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
#    && docker-php-ext-install pdo_mysql \
#    && docker-php-ext-install mbstring \
#    && docker-php-ext-install mcrypt


##############################################
# install pecl
##############################################
#RUN curl -O http://pear.php.net/go-pear.phar \
#    ; php -d detect_unicode=0 go-pear.phar


##############################################
# PHP composer
##############################################
RUN curl -sS https://getcomposer.org/installer | php --  --install-dir=/usr/bin --filename=composer


##############################################
# cron job
##############################################
RUN yum install supervisor -y


##############################################
# install swoole extention
##############################################
RUN yum groupinstall "Development Tools" -y
RUN yum install man-pages -y

RUN yum install centos-release-scl -y
RUN yum install devtoolset-7 -y


###RUN echo "scl enable devtoolset-7 bash" >> /root/.bashrc
###SHELL [ "scl", "enable", "devtoolset-7", "bash" ]
###RUN scl enable devtoolset-7 bash
# OR
RUN yum install -y rh-python36
SHELL [ "/usr/bin/scl", "enable", "devtoolset-7", "rh-python36" ]


RUN printf "yes\n" | pecl install swoole
RUN echo "extension=swoole" >> /etc/php.d/swoole.ini


##############################################
# Oracle instantclient install oci8 extention
##############################################

# copy oracle files zip
#ADD oracle/12.1.0.2.0/instantclient-basic-linux.x64-12.1.0.2.0.zip /tmp/
#ADD oracle/12.1.0.2.0/instantclient-sdk-linux.x64-12.1.0.2.0.zip /tmp/
#ADD oracle/12.1.0.2.0/instantclient-sqlplus-linux.x64-12.1.0.2.0.zip /tmp/

# unzip them
#RUN unzip /tmp/instantclient-basic-linux.x64-12.1.0.2.0.zip -d /usr/local/ \
#    && unzip /tmp/instantclient-sdk-linux.x64-12.1.0.2.0.zip -d /usr/local/ \
#    && unzip /tmp/instantclient-sqlplus-linux.x64-12.1.0.2.0.zip -d /usr/local/

# install oci8 by zip file
#RUN ln -s /usr/local/instantclient_12_1 /usr/local/instantclient \
#    && ln -s /usr/local/instantclient/libclntsh.so.12.1 /usr/local/instantclient/#libclntsh.so \
#    && ln -s /usr/local/instantclient/sqlplus /usr/bin/sqlplus \
#    && echo "instantclient,/usr/local/instantclient_12_1" | pecl install oci8

# OR

# copy oracle files rpm
ADD oracle/19.5.0.0.0-1/oracle-instantclient19.5-basic-19.5.0.0.0-1.x86_64.rpm /tmp/
ADD oracle/19.5.0.0.0-1/oracle-instantclient19.5-devel-19.5.0.0.0-1.x86_64.rpm /tmp/
ADD oracle/19.5.0.0.0-1/oracle-instantclient19.5-sqlplus-19.5.0.0.0-1.x86_64.rpm /tmp/

# install oci8 by rpm file
RUN yum install -y /tmp/oracle-instantclient19.5-basic-19.5.0.0.0-1.x86_64.rpm
RUN yum install -y /tmp/oracle-instantclient19.5-devel-19.5.0.0.0-1.x86_64.rpm
RUN yum install -y /tmp/oracle-instantclient19.5-sqlplus-19.5.0.0.0-1.x86_64.rpm

RUN ldconfig

RUN echo "export PHP_DTRACE=yes" >> /root/.bash_profile
RUN export PHP_DTRACE=yes

###SHELL [ "/usr/bin/scl", "enable", "devtoolset-7", "rh-python36" ]
###RUN echo "instantclient,/usr/lib/oracle/19.5/client64/lib/" | pecl install oci8

###RUN touch /usr/lib/oracle/19.5/client64/network/admin/tnsnames.ora

RUN echo "ORACLE_HOME=/usr/lib/oracle/19.5/client64" >> /root/.bash_profile
RUN echo "export ORACLE_HOME" >> /root/.bash_profile
RUN echo "PATH=$PATH:$ORACLE_HOME/bin" >> /root/.bash_profile
RUN echo "export PATH" >> /root/.bash_profile
RUN echo "LD_LIBRARY_PATH=$ORACLE_HOME/lib" >> /root/.bash_profile
RUN echo "export LD_LIBRARY_PATH" >> /root/.bash_profile
RUN echo "TNS_ADMIN=$ORACLE_HOME/lib/network/admin" >> /root/.bash_profile
RUN echo "export TNS_ADMIN" >> /root/.bash_profile


##############################################
# apache configurations, mod rewrite
##############################################
#RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load


##############################################
# Directory
##############################################
WORKDIR /var/www/html


##############################################
# COPY
##############################################
#COPY etc/resolv.conf /etc/resolv.conf


##############################################
# CMD
##############################################
CMD ["/usr/bin/tomcat start","-D","FOREGROUND"]
CMD ["httpd","-D","FOREGROUND"]


##############################################
# Expose
##############################################
EXPOSE 80


