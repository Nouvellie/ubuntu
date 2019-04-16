# JUPYTER 

## Settings as root
```
$ sudo su
cd
```
## Download and install Anaconda<br>
[Anaconda.](https://github.com/Nouvellie/ubuntu/blob/ubuntu/anaconda.md)

## Create an envs to run jupyterhub and our libraries (python3.6)
```
$ conda create --name jupyterbase python=3.6 -y
```
## Update conda
```
$ conda update -n base -c defaults conda -y
```
## Conda libs
```
$ conda install -c conda-forge mysql-connector-python -y && conda install -c pandas pymysql -y && conda install -c conda-forge mysqlclient -y && conda install -c kalefranz mysql-server -y && conda install -c conda-forge django -y && conda install -c conda-forge djangorestframework -y && conda install -c conda-forge keras -y && conda install -c anaconda tensorflow -y && conda install -c conda-forge django-cors-headers -y && conda install -c conda-forge django-filter -y && conda install -c conda-forge pandas -y && conda install -c conda-forge bokeh -y && conda install -c conda-forge appdirs -y && conda install -c conda-forge lxml -y && conda install -c conda-forge wfdb -y && conda install -c conda-forge pywavelets -y && conda install -c conda-forge sqlparse -y && conda install -c conda-forge jupyterhub -y && conda install -c conda-forge notebook -y && conda install -c conda-forge configurable-http-proxy -y && conda install -c conda-forge jupyterlab
```
## Create a jupyterhub dir (/opt/user-jupyterhub) and settings
* Install default files:
```
$ mkdir /opt/user-jupyterhub
$ conda activate jupyterbase
```
* Generate jupyterhub sqlite and cookie_secret:
```
$ jupyterhub
```
* Create a jupyterhub config: (opt/user-jupyterhub/)
```
$ jupyterhub --generate-config 
```
## Create jupyterhub cert and key: (/opt/user-jupyterhub/jupyterhub.key and /opt/user-jupyterhub/jupyterhub.crt)
```
$ openssl req -x509 -nodes -days 365 -newkey rsa:1024 -keyout jupyterhub.key -out jupyterhub.crt
```
## Create and add user to a group
* Create a group:
```
$ sudo groupadd groupname
```
* Adding a user to a group:
```
$ sudo adduser username groupname
```
* Check group members:
```
$ sudo apt install members
$ members groupname
```
* Edit jupyterhub config:
```
$ sudo vim /opt/user-jupyterhub/jupyterhub_config.py
```
* Install jupyter lab/hub extension:
```
$ jupyter labextension install @jupyterlab/hub-extension
```
* Change the default options:
```
c.JupyterHub.port = 443
c.JupyterHub.ssl_cert = '/opt/cdn-jupyterhub/jupyterhub.crt'
c.JupyterHub.ssl_key = '/opt/cdn-jupyterhub/jupyterhub.key'
c.Spawner.cmd = ['jupyter-labhub']
c.Spawner.default_url = '/lab'
c.Spawner.notebook_dir = '~'
c.Spawner.port = 443
c.Authenticator.admin_users = ['adminuser']
c.LocalAuthenticator.group_whitelist = ['groupname']
```