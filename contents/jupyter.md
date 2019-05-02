<div>

<h1>JUPYTER HUB/LAB</h1>
<h2>Settings as root</h2>

`$ sudo su`<br>
`$ cd`

<h2>Download and install Anaconda</h2>

[Anaconda.](https://github.com/Nouvellie/ubuntu/blob/ubuntu/contents/anaconda.md)

<h2>Update conda</h2>

`$ conda update -n base -c defaults conda -y`

<h2>Create an envs to run jupyterhub and our libraries (python3.6)</h2>

`$ conda create --name jupyterbase python=3.6 -y`

<h2>Conda libs</h2>

`$ conda install -c conda-forge mysql-connector-python -y && conda install -c pandas pymysql -y && conda install -c conda-forge mysqlclient -y && conda install -c kalefranz mysql-server -y && conda install -c conda-forge django -y && conda install -c conda-forge djangorestframework -y && conda install -c conda-forge keras -y && conda install -c anaconda tensorflow -y && conda install -c conda-forge django-cors-headers -y && conda install -c conda-forge django-filter -y && conda install -c conda-forge pandas -y && conda install -c conda-forge bokeh -y && conda install -c conda-forge appdirs -y && conda install -c conda-forge lxml -y && conda install -c conda-forge wfdb -y && conda install -c conda-forge pywavelets -y && conda install -c conda-forge sqlparse -y && conda install -c conda-forge jupyterhub -y && conda install -c conda-forge notebook -y && conda install -c conda-forge configurable-http-proxy -y && conda install -c conda-forge jupyterlab -y`

<h2>Create a jupyterhub dir (/opt/user-jupyterhub) and settings</h2>
<h4>Install default files:</h4>

`$ mkdir /opt/user-jupyterhub`

<h4>Generate jupyterhub sqlite and cookie secret:</h4>

`$ cd /opt/user-jupyterhub`<br>
`$ conda activate jupyterbase`<br>
`$ jupyterhub`

<h4>Create a jupyterhub config: (opt/user-jupyterhub/)</h4>

`$ jupyterhub --generate-config`

<h2>Create jupyterhub cert and key: (/opt/user-jupyterhub/cert/jupyterhub.key and /opt/user-jupyterhub/cert/jupyterhub.crt)</h2>

`$ cd /opt/user-jupyterhub/cert`<br>
`$ openssl req -x509 -nodes -days 365 -newkey rsa:1024 -keyout jupyterhub.key -out jupyterhub.crt`

<h2>Create and add user to a group</h2>
<h4>Create a group:</h4>

`$ sudo groupadd groupname`

<h4>Add a user to a group:</h4>

`$ sudo adduser username groupname`

<h4>Check group members:</h4>

`$ sudo apt install members -y`<br>
`$ members groupname`

<h2>Set jupyterhub values</h2>
<h4>Install the jupyter lab/hub extension:</h4>

`$ jupyter labextension install @jupyterlab/hub-extension`

<h4>Change the default settings:</h4>

`$ sudo vim /opt/user-jupyterhub/jupyterhub_config.py`<br>

<h4>[jupyterhub_config.py]</h4>

```
c.JupyterHub.port = 443
c.JupyterHub.ssl_cert = '/opt/user-jupyterhub/cert/jupyterhub.crt'
c.JupyterHub.ssl_key = '/opt/user-jupyterhub/cert/jupyterhub.key'
c.Spawner.cmd = ['jupyter-labhub']
c.Spawner.default_url = '/lab'
c.Spawner.notebook_dir = '~'
c.Authenticator.admin_users = ['adminusername']
c.LocalAuthenticator.group_whitelist = ['groupname']
```

<h4>Save changes and exit:</h4>

`:wq!`

<h4>Show conda environments in jupyterhub kernell:</h4>

`$ conda install -c conda-forge nb_conda_kernels`<br>
`$ python -m ipykernel install --user --name jupyterbase --display-name "Python (jupyterbase)"`

<h2>Errors</h2>
<h4>[Keyerror] User adminuser does not exist:</h4>

`$ sudo rm -rf jupyterhub.sqlite`

<h2>As system service (systemd)</h2>
<h4>Create service and add settings:</h4>

`$ sudo vim /etc/systemd/system/user-jupyterhub.service`<br>

<h4>[user-jupyterhub.service]</h4>

```
[Unit]
Description=Jupyterhub Service

[Service]
Environment="PATH=/opt/anaconda3/envs/jupyterbase/bin:/opt/anaconda3/bin:/opt/anaconda3/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games"
ExecStart=/opt/anaconda3/envs/jupyterbase/bin/jupyterhub
WorkingDirectory=/opt/user-jupyterhub
Restart=on-failure
User=root

[Install]
WantedBy=multi-user.target
```

<h4>Save changes and exit:</h4>

`:wq!`

<h2>Enable server after connect</h2>
<h4>In suser-jupyterhub.service:</h4>

`[Unit]`<br>
`After=syslog.target network.target`

<h2>Auto restart</h2>
<h4>In user-jupyterhub.service:</h4>

`Restart=always`<br>
`RestartSec=10`

<h2>JupyterHub config to be respected by systemd:</h2>
<h4>In user-jupyterhub.service:</h4>

`[Service]`<br>
`KillMode=process`

<h4>[jupyterhub_config.py]</h4>

`c.JupyterHub.cleanup_servers = False `

<h4>Reload daemon:</h4>

`$ sudo systemctl daemon-reload`

<h4>Restart instance or service:</h4>

`$ sudo systemctl enable user-jupyterhub.service`

<h4>Start / Restart / Stop:</h4>

`$ sudo systemctl start user-jupyterhub.service`<br>
`$ sudo systemctl restart user-jupyterhub.service`<br>
`$ sudo systemctl stop user-jupyterhub.service`

</div>