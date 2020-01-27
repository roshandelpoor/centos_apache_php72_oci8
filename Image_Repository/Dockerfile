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
# apache(Httpd) Install
##############################################
RUN yum install -y httpd
RUN yum install -y firewalld
##RUN firewall-cmd --permanent --add-port=80/tcp
##RUN firewall-cmd --permanent --add-port=443/tcp
##RUN firewall-cmd --reload
## or
##RUN systemctl restart firewalld.service

##RUN httpd -v
## config virtual apache --> /etc/apache2/sites-enabled/000-default.conf
## config httpd  --> /etc/httpd/conf/httpd.conf
## config enable .htaccess  --> /etc/httpd/conf/httpd.conf
## config hide os_version and php_version
## config add custom header
## config virtualhost
## config mpm_event
## config FPM/FastCGI


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
## or
##RUN systemctl restart firewalld.service
##RUN tomcat --version


##############################################
# PHP Install
##############################################
RUN yum --enablerepo=remi-php72 install -y php

RUN yum --enablerepo=remi-php72 install -y php-xml php-soap php-pdo php-mysql php-pdo_oci php-xmlrpc php-mbstring php-json php-gd php-mcrypt php-oci php-fpm php-zip php-xdebug php-pear php-devel

##RUN php -v
## php.ini   --> /etc/php.ini
## extra ini --> /etc/php.d/{filename.ini}


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
# phantomJS install
##############################################
RUN yum install -y glibc fontconfig freetype freetype-devel fontconfig-devel wget bzip2

ADD phantomjs/phantomjs-2.1.1-linux-x86_64.tar.bz2 /tmp/
#RUN tar xvjf /tmp/phantomjs-2.1.1-linux-x86_64.tar.bz2
RUN mv /tmp/phantomjs-2.1.1-linux-x86_64 /usr/local/share/
RUN ln -sf /usr/local/share/phantomjs-2.1.1-linux-x86_64/bin/phantomjs /usr/local/bin
RUN phantomjs --version


##############################################
# wkhtmltopdf install
##############################################
RUN yum install -y libpng libjpeg openssl icu libX11 libXext libXrender xorg-x11-fonts-Type1 xorg-x11-fonts-75dpi

ADD wkhtmltoxpdf/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz /tmp/
#RUN tar -xvf /tmp/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
RUN mv /tmp/wkhtmltox/bin/wkhtmltopdf /usr/bin/wkhtmltopdf
RUN mv /tmp/wkhtmltox/bin/wkhtmltoimage /usr/bin/wkhtmltoimage
RUN wkhtmltopdf -V
RUN wkhtmltoimage -V
RUN wkhtmltopdf https://google.com /tmp/output_pdf_file_name.pdf
RUN wkhtmltoimage https://google.com /tmp/output_image_file_name.jpg


##############################################
# find(locate) file
##############################################
RUN yum install -y mlocate
RUN updatedb


##############################################
# apache enable mod rewrite
##############################################
# apache
#RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
# centos
#RUN echo "LoadModule rewrite_module modules/mod_rewrite.so" >> /etc/httpd/conf.modules.d/00-base.conf


##############################################
# apache enable FPM/FastCGI
##############################################
RUN yum install -y mod_ssl

#COPY etc/resolv.conf /etc/resolv.conf

#COPY conf/apache/mpm-mod/00-mpm.conf /etc/httpd/conf.modules.d/00-mpm.conf
#COPY conf/apache/FPM_FastCGI/fpm_config/php.conf /etc/httpd/conf.d/php.conf
#COPY conf/apache/FPM_FastCGI/www_conf/www.conf /etc/php-fpm.d/www.conf

COPY conf/apache/config_httpd/httpd.conf /etc/httpd/conf/httpd.conf

#COPY supervisord/supervisord.conf /etc/supervisord.conf
#COPY ["start.sh", "/root/start.sh"]


##############################################
# Directory
##############################################
WORKDIR /var/www/html


##############################################
# CMD
##############################################
CMD ["/usr/sbin/tomcat start","-D","FOREGROUND"]

#CMD ["/root/start.sh"]
CMD ["/usr/sbin/php-fpm start","-D","FOREGROUND"]

#CMD ["/usr/bin/supervisord", "-n"]

CMD ["httpd","-D","FOREGROUND"]

##############################################
# Expose
##############################################
EXPOSE 80


