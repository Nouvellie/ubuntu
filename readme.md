###### ######
# NOUVELLIE
###### ######

# SETTINGS UBUNTU (18.04 LTS) [USER = UBUNTU]

# UBUNTU COMMANDS

## Update, upgrade, clean and autoremove ##
sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y

## Delete file/files ##
sudo rm -rf filename1 filename2

## Delete group of files ## 
sudo rm -rf asterisk.xml

## Path ##
pwd

## Shutdown ##
sudo shutdown -r 0

## Environment variables ##
sudo vim /etc/environment
* Envs vars:
TEST="PATH"
TEST2="PATH2"
* Calls vars:
cd $TEST
cd $TEST2

## Rename ##
sudo mv namefile newnamefile

# VIM 

## Install ##
sudo apt install vim -y

## Commands ##
* Write:
:w or :w!
* Exit:
:q or :q!
Both:
:wq or :wq!   (in that order)


# SERVICES

## Create ##
sudo touch servicename.service 

## Settings ##
* Example for a django project:
[Unit]
Description=Django Server

[Service]
Type=simple
ExecStart=/usr/bin/authbind --deep CONDAENVSPATH/bin/python3 manage.py runserver 0.0.0.0:80
WorkingDirectory=PATHDJANGOPROJECT
Restart=on-failure
User=ubuntu

[Install]
WantedBy=multi-user.target

* Authbin:
Access to blocked ports.

## Reload to update changes ## 
sudo systemctl daemon-reload

## Start / Restart / Stop ##
sudo systemctl restart servicename.service
sudo systemctl start servicename.service
sudo systemctl stop servicename.service

## Access (Byport 80) ##
sudo apt install authbind
sudo touch /etc/authbind/byport/80
sudo chown ubuntu /etc/authbind/byport/80
sudo chmod 500 /etc/authbind/byport/80

# DOWNLOAD, INSTALL ANACONDA, AND SOME COMMANDS 

## Download ##
curl -O https://repo.anaconda.com/archive/Anaconda3-2018.12-Linux-x86_64.sh

## Install ##
sudo bash ./Anaconda3-2018.12-Linux-x86_64.sh
ENTER
yes
* Path:
/home/ubuntu/anaconda3n
* Do you wish the installer to initialize Anaconda3:
yes (important)

## Envs list ##
conda info --envs

## Libs list on envs ##
conda list -e

## Create a envs ##
* Default:
conda create --name devscdn python=3.6 -y
* Giving a Path: (and version of python by default)
conda create --prefix /opt/anaconda/envs/envsname python=3.6 -y

## Export/import a created envs ##
* Export:
conda env export | grep -v "^prefix: " > environment.yml
* Import:
conda env create -f environment.yml

## MySQL server out envs, to avoid errors (important) ##
sudo apt install mysql-server -y

## More libs ## 
https://anaconda.org/anaconda/repo

## Conda activate/deactivate ##
* Activate:
conda activate envsname
* Deactivate:
conda deactivate


# GIT

## Git clone ## 
git clone https://github.com/Nouvellie/ubuntu
* Username: 
username@mail.com
* Password:
password123456

## Credential store ##
git config credential.helper store

# MYSQL SERVER

## Create database ##
* Create:
CREATE DATABASE IF NOT EXISTS namedb;
* Select:
USE namedb;
* Dumped:
SOURCE dump.sql;

## Create user and grant all privileges ##
* Create user:
CREATE USER 'ubuntu'@'%' IDENTIFIED BY 'cdn-devs';
* Grant all privileges:
GRANT ALL PRIVILEGES ON *.* TO 'ubuntu'@'%' WITH GRANT OPTION;