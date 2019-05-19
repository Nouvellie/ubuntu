# SERVICE
## Create

```sh
$ sudo touch <servicename>.service
```

## Settings
#### Example of a django project:

```sh
[Unit]
Description=Django Server

[Service]
Type=simple
ExecStart=/usr/bin/authbind --deep <condaenvspath>/bin/python3 manage.py runserver 0.0.0.0:80
WorkingDirectory=<pathdjangoproject>
Restart=on-failure
User=<ubuntu>

[Install]
WantedBy=multi-user.target
```

#### Authbin:

Access to blocked ports, in this case port 80.	

## Reload to update changes

```sh
$ sudo systemctl daemon-reload
```

## Start / Restart / Stop

```sh
$ sudo systemctl start <servicename>.service
$ sudo systemctl restart <servicename>.service
$ sudo systemctl stop <servicename>.service
```

## Turns the service on, on the next reboot or on the next start event. (It persists after reboot)

```sh
$ sudo systemctl enable <servicename>.service
```

## Access (Byport 80)

```sh
$ sudo apt install authbind && sudo touch /etc/authbind/byport/80 && sudo chown ubuntu /etc/authbind/byport/80 && sudo chmod 500 /etc/authbind/byport/80
```