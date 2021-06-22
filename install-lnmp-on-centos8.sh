yum -y install nginx

# Install php 7.4 on Centos 8
dnf install -y dnf-utils http://rpms.remirepo.net/enterprise/remi-release-8.rpm
dnf module reset php
dnf module -y enable php:remi-7.4
dnf install -y php php-opcache php-gd php-curl php-mysqlnd
systemctl enable --now php-fpm


dnf install -y mysql-server
systemctl start mysqld.service
systemctl enable mysqld
mysql_secure_installation