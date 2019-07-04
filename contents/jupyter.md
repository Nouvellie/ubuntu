# JUPYTER HUB/LAB</h1>
## Settings as root

```sh
$ sudo su
$ cd
```

## Download and install Anaconda

[Anaconda.](https://github.com/Nouvellie/ubuntu/blob/ubuntu/contents/anaconda.md)

## Update Conda

```sh
$ conda update -n base -c defaults conda -y
```

## Create an envs to run JupyterHub and our libraries (python3.6)

```sh
$ conda create --name <jupyterbase> python=3.6 -y
```

## Conda libs

```sh
$ conda install -c conda-forge mysql-connector-python -y && conda install -c pandas pymysql -y && conda install -c conda-forge mysqlclient -y && conda install -c kalefranz mysql-server -y && conda install -c conda-forge django -y && conda install -c conda-forge djangorestframework -y && conda install -c conda-forge keras -y && conda install -c anaconda tensorflow -y && conda install -c conda-forge django-cors-headers -y && conda install -c conda-forge django-filter -y && conda install -c conda-forge pandas -y && conda install -c conda-forge bokeh -y && conda install -c conda-forge appdirs -y && conda install -c conda-forge lxml -y && conda install -c conda-forge wfdb -y && conda install -c conda-forge pywavelets -y && conda install -c conda-forge sqlparse -y && conda install -c conda-forge jupyterhub -y && conda install -c conda-forge notebook -y && conda install -c conda-forge configurable-http-proxy -y && conda install -c conda-forge jupyterlab -y && conda install -c conda-forge xlrd -y && pip install dtw -y && conda install -c conda-forge gunicorn -y
 ```

## Create a JupyterHub dir (/opt/user-jupyterhub) and settings
#### Install default files:

```sh
$ mkdir /opt/<user>-jupyterhub
```

#### Generate JupyterHub SQLite and cookie secret:

```sh
$ cd /opt/<user>-jupyterhub
$ conda activate <jupyterbase>
$ jupyterhub
```

#### Create a JupyterHub config: (opt/user-jupyterhub/)

```sh
$ jupyterhub --generate-config
```

## Create JupyterHub cert and key: (/opt/user-jupyterhub/cert/jupyterhub.key and /opt/user-jupyterhub/cert/jupyterhub.crt)

```sh
$ cd /opt/<user>-jupyterhub/cert
$ openssl req -x509 -nodes -days 365 -newkey rsa:1024 -keyout jupyterhub.key -out jupyterhub.crt
```

## Create and add user to a group
#### Create a group:

```sh
$ sudo groupadd <groupname>
```

#### Add a user to a group:

```sh
$ sudo adduser <username> <groupname>
```

#### Check group members:

```sh
$ sudo apt install members -y
$ members <groupname>
```

## Set JupyterHub values
#### Install the Jupyter Lab/Hub extension:

```sh
$ jupyter labextension install @jupyterlab/hub-extension
```

#### Change the default settings:

```sh
$ sudo vim /opt/<user>-jupyterhub/jupyterhub_config.py
```

#### [jupyterhub_config.py]

```python
c.JupyterHub.port = 443
c.JupyterHub.ssl_cert = '/opt/<user>-jupyterhub/cert/jupyterhub.crt'
c.JupyterHub.ssl_key = '/opt/<user>-jupyterhub/cert/jupyterhub.key'
c.Spawner.cmd = ['jupyter-labhub']
c.Spawner.default_url = '/lab'
c.Spawner.notebook_dir = '~'
c.Authenticator.admin_users = ['<adminusername>']
c.LocalAuthenticator.group_whitelist = ['<groupname>']
```

#### Save changes and exit:

```sh
:wq!
```

#### Show Conda environments in JupyterHub Kernell:

```sh
$ conda install -c conda-forge nb_conda_kernels
$ python -m ipykernel install --user --name <jupyterbase> --display-name "Python (<jupyterbase>)"
```

## Errors
#### [Keyerror] User adminuser does not exist:

```sh
$ sudo rm -rf jupyterhub.sqlite
```

## As system service (systemd)
#### Create service and add settings:

```sh
$ sudo vim /etc/systemd/system/<user>-jupyterhub.service
```

#### [<user>-jupyterhub.service]

```sh
[Unit]
Description=Jupyterhub Service

[Service]
Environment="PATH=/opt/anaconda3/envs/<jupyterbase>/bin:/opt/anaconda3/bin:/opt/anaconda3/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games"
ExecStart=/opt/anaconda3/envs/<jupyterbase>/bin/jupyterhub
WorkingDirectory=/opt/<user>-jupyterhub
Restart=on-failure
User=root

[Install]
WantedBy=multi-user.target
```

#### Save changes and exit:

```sh
:wq!
```

## Enable server after connect
#### [<user>-jupyterhub.service]

```sh
[Unit]
After=syslog.target network.target
```

## Auto restart
#### [<user>-jupyterhub.service]

```sh
Restart=always
RestartSec=10
```

## JupyterHub config to be respected by systemd:
#### [<user>-jupyterhub.service]

```sh
[Service]
KillMode=process
```

#### [jupyterhub_config.py]

```python
c.JupyterHub.cleanup_servers = False
```

#### Reload daemon:

```sh
$ sudo systemctl daemon-reload
```

#### Restart instance or service:

```sh
$ sudo systemctl enable <user>-jupyterhub.service
```

#### Start / Restart / Stop:

```sh
$ sudo systemctl start <user>-jupyterhub.service
$ sudo systemctl restart <user>-jupyterhub.service
$ sudo systemctl stop <user>-jupyterhub.service
```