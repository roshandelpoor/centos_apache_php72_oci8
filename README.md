# centos_apache_php72_oci8

Dockerfile Docker-Compose CentOS7 Apache/2.4.6(httpd) PHP/7.2.27 oci8 swoole soap phantomJS mpm-event FPM/FastCGI wkhtmltopdf wkhtmltoimage


# Enable PHP Extentions

etc/php.d/15-xdebug.ini, /etc/php.d/20-bz2.ini, /etc/php.d/20-calendar.ini, /etc/php.d/20-ctype.ini, /etc/php.d/20-curl.ini, /etc/php.d/20-dom.ini, /etc/php.d/20-exif.ini, /etc/php.d/20-fileinfo.ini, /etc/php.d/20-ftp.ini, /etc/php.d/20-gd.ini, /etc/php.d/20-gettext.ini, /etc/php.d/20-iconv.ini, /etc/php.d/20-json.ini, /etc/php.d/20-mbstring.ini, /etc/php.d/20-mysqlnd.ini, /etc/php.d/20-oci8.ini, /etc/php.d/20-pdo.ini, /etc/php.d/20-phar.ini, /etc/php.d/20-posix.ini, /etc/php.d/20-shmop.ini, /etc/php.d/20-simplexml.ini, /etc/php.d/20-soap.ini, /etc/php.d/20-sockets.ini, /etc/php.d/20-sqlite3.ini, /etc/php.d/20-sysvmsg.ini, /etc/php.d/20-sysvsem.ini, /etc/php.d/20-sysvshm.ini, /etc/php.d/20-tokenizer.ini, /etc/php.d/20-xml.ini, /etc/php.d/20-xmlwriter.ini, /etc/php.d/20-xsl.ini, /etc/php.d/30-mcrypt.ini, /etc/php.d/30-mysqli.ini, /etc/php.d/30-pdo_mysql.ini, /etc/php.d/30-pdo_oci.ini, /etc/php.d/30-pdo_sqlite.ini, /etc/php.d/30-wddx.ini, /etc/php.d/30-xmlreader.ini, /etc/php.d/30-xmlrpc.ini, /etc/php.d/40-zip.ini, /etc/php.d/swoole.ini


# dynamic config php.ini

- disable_functions =
- max_execution_time = 600
- memory_limit = 2048M
- post_max_size = 80M
- file_uploads = On
- upload_max_filesize = 100M
- max_file_uploads = 50
- session.name = PHPSESSID
- session.gc_maxlifetime = 1440
- session.cache_expire = 180
- html_errors = On
- display_errors = On
- display_startup_errors = On
- error_reporting = E_ALL


# Oracle instantclient 19.5

- oracle-instantclient19.5-basic-19.5.0.0.0-1.x86_64.rpm
- oracle-instantclient19.5-devel-19.5.0.0.0-1.x86_64.rpm
- oracle-instantclient19.5-sqlplus-19.5.0.0.0-1.x86_64.rpm


# Apache Modules
core mod_so http_core mod_access_compat mod_actions mod_alias mod_allowmethods mod_auth_basic mod_auth_digest mod_authn_anon mod_authn_core mod_authn_dbd mod_authn_dbm mod_authn_file mod_authn_socache mod_authz_core mod_authz_dbd mod_authz_dbm mod_authz_groupfile mod_authz_host mod_authz_owner mod_authz_user mod_autoindex mod_cache mod_cache_disk mod_data mod_dbd mod_deflate mod_dir mod_dumpio mod_echo mod_env mod_expires mod_ext_filter mod_filter mod_headers mod_include mod_info mod_log_config mod_logio mod_mime_magic mod_mime mod_negotiation mod_remoteip mod_reqtimeout mod_rewrite mod_setenvif mod_slotmem_plain mod_slotmem_shm mod_socache_dbm mod_socache_memcache mod_socache_shmcb mod_status mod_substitute mod_suexec mod_unique_id mod_unixd mod_userdir mod_version mod_vhost_alias mod_dav mod_dav_fs mod_dav_lock mod_lua prefork mod_proxy mod_lbmethod_bybusyness mod_lbmethod_byrequests mod_lbmethod_bytraffic mod_lbmethod_heartbeat mod_proxy_ajp mod_proxy_balancer mod_proxy_connect mod_proxy_express mod_proxy_fcgi mod_proxy_fdpass mod_proxy_ftp mod_proxy_http mod_proxy_scgi mod_proxy_wstunnel mod_systemd mod_cgi mod_php7
