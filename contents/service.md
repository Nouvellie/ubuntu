<div>

<h1>SERVICE</h1>
<h2>Create</h2>

`$ sudo touch servicename.service`

<h2>Settings</h2>
<h4>Example of a django project:</h4>

```
[Unit]
Description=Django Server

[Service]
Type=simple
ExecStart=/usr/bin/authbind --deep condaenvspath/bin/python3 manage.py runserver 0.0.0.0:80
WorkingDirectory=pathdjangoproject
Restart=on-failure
User=ubuntu

[Install]
WantedBy=multi-user.target
```

<h4>Authbin:</h4>

<p>
Access to blocked ports, in this case port 80.	
</p>


## Reload to update changes

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
## Turns the service on, on the next reboot or on the next start event. (It persists after reboot)
```
$ sudo systemctl enable servicename.service
```
## Access (Byport 80)
```
$ sudo apt install authbind
$ sudo touch /etc/authbind/byport/80
$ sudo chown ubuntu /etc/authbind/byport/80
$ sudo chmod 500 /etc/authbind/byport/80
```