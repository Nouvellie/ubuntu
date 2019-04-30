<div>

<h1>DATABASE</h1>
<h2>(MySQL) for services</h2>
<h2>Install</h2>

`$ sudo apt install mysql-server -y`

<h2>Create database</h2>

<h4>Create:</h4>

`mysql> CREATE DATABASE IF NOT EXISTS namedb;`

<h4>Select:</h4>

`mysql> USE namedb;`

<h4>Dumped:</h4>

`mysql> SOURCE dump.sql;`

<h2>Create user and grant all privileges</h2>
<h4>Create user:</h4>

`mysql> CREATE USER 'ubuntu'@'%' IDENTIFIED BY 'db-password';`

<h4>Grant all privileges:</h4>

`mysql> GRANT ALL PRIVILEGES ON *.* TO 'ubuntu'@'%' WITH GRANT OPTION;`

</div>