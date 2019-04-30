<div>

<h1>DATABASE</h1>
<h2>(MySQL) for services</h2>
<h2>Create database</h2>

<h4>Create:</h4>
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
## Create user and grant all privileges
* Create user:
```
mysql> CREATE USER 'ubuntu'@'%' IDENTIFIED BY 'cdn-devs';
```
* Grant all privileges:
```
mysql> GRANT ALL PRIVILEGES ON *.* TO 'ubuntu'@'%' WITH GRANT OPTION;
```
## Install
```
$ sudo apt install mysql-server -y
```