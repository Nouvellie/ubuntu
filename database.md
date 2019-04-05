# DATABASE

# MYSQL
<br><br>
## Create database
* Create:
```
CREATE DATABASE IF NOT EXISTS namedb;
```
* Select:
```
USE namedb;
```
* Dumped:
```
SOURCE dump.sql;
```
<br><br>
## Create user and grant all privileges
* Create user:
```
CREATE USER 'ubuntu'@'%' IDENTIFIED BY 'cdn-devs';
```
* Grant all privileges:
```
GRANT ALL PRIVILEGES ON *.* TO 'ubuntu'@'%' WITH GRANT OPTION;
```
<br><br>
## Install
```
sudo apt install mysql-server -y
```