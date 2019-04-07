# SERVICE

## Create
```
$ sudo touch servicename.service 
```
## Settings
* Example for a django project:
```
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
```
* Authbin:
```
Access to blocked ports.
```
## Reload to update changes
```
$ sudo systemctl daemon-reload
```
## Start / Restart / Stop
```
$ sudo systemctl restart servicename.service
```
```
$ sudo systemctl start servicename.service
```
```
$ sudo systemctl stop servicename.service
```
## Access (Byport 80)
```
$ sudo apt install authbind
$ sudo touch /etc/authbind/byport/80
$ sudo chown ubuntu /etc/authbind/byport/80
$ sudo chmod 500 /etc/authbind/byport/80
```