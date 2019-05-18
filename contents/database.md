# DATABASE
## (MySQL) for services
## Install

```sh
$ sudo apt install mysql-server -y
```

## Create database
#### Create:

```sql
mysql> CREATE DATABASE IF NOT EXISTS namedb;
```
#### Select:

```sql
mysql> USE namedb;
```

#### Dumped:

```sql
mysql> SOURCE dump.sql;
```

## Create user and grant all privileges
#### Create user:

```sql
mysql> CREATE USER 'ubuntu'@'%' IDENTIFIED BY 'db-password';
```

#### Grant all privileges:

```sql
mysql> GRANT ALL PRIVILEGES ON *.* TO 'ubuntu'@'%' WITH GRANT OPTION;
```