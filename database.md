# DATABASE

## (MYSQL)
<br><br>
## Create database
* Create:
```
mysql> CREATE DATABASE IF NOT EXISTS namedb;
```
* Select:
```
mysql> USE namedb;
```
* Dumped:
```
mysql> SOURCE dump.sql;
```
<br><br>
## Create user and grant all privileges
* Create user:
```
mysql> CREATE USER 'ubuntu'@'%' IDENTIFIED BY 'cdn-devs';
```
* Grant all privileges:
```
mysql> GRANT ALL PRIVILEGES ON *.* TO 'ubuntu'@'%' WITH GRANT OPTION;
```
<br><br>
## Install
```
$ sudo apt install mysql-server -y
```