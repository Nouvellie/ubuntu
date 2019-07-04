# NGINX
## First step
#### Install Nginx:

```sh
$ sudo apt install nginx -y
```

#### Install Gunicorn:

```sh
$ conda activate <envsname>
$ conda install -c conda-forge gunicorn -y
```

## Testing Gunicorn
#### Settings:

```sh
$ sudo ufw allow 8000
``` 

#### Allow IP: (Django)

```python
allowhost['<Your IP>']
```

#### Run Django server: (at port 8000)

```sh
$ python3 manage.py runserver 0.0.0.0:8000
```

#### Run Django with Gunicorn:

```sh
$ cd /home/<user>/<django-project>/<project-name>
$ gunicorn --bind 0.0.0.0:8000 <project-name>.wsgi
```

## Create Gunicorn service

```sh
$ sudo vim /etc/systemd/system/gunicorn.service
```

#### Deactivate Conda envs:

```sh
$ conda deactivate
```

#### [gunicorn.service]

```sh
[Unit]
Description=Gunicorn Daemon Service
After=network.target

[Service]
User=<user>
Group=www-data
WorkingDirectory=/home/<user>/<django-project>/<project-name>
ExecStart=/home/<user>/<django-project>/<project-name>/env/<envsname>/bin/gunicorn --access-logfile - --workers 3 --bind unix:/home/<user>/<django-project>/<project-name>.sock <project-name>.wsgi:application

[Install]
WantedBy=multi-user.target

```

## Enable Gunicorn, and show status
#### Start, Enable, Status:

```sh
$ sudo systemctl start gunicorn && sudo systemctl enable gunicorn && sudo systemctl status gunicorn
```

#### Journal and Daemon reload:

```sh
$ sudo journalctl -u gunicorn && sudo systemctl daemon-reload && sudo systemctl restart gunicorn
```

## Nginx sites available

```sh
$ sudo vim /etc/nginx/sites-available/<project-name>
```

#### [project-name]

```sh
server {
        listen 80;
        server_name hosting-IP; # (Example 192.168.0.1)
        location = /favicon.ico { access_log off; log_not_found off; }
        location /static/ {
                root /home/<user>/<django-project>/;
        }
        location / {
                include proxy_params;
                proxy_pass http://unix:/home/<user>/<django-project>/<project-name>.sock;
        }
}
```

#### From sites available to sites enabled: (Nginx conf)

```sh
$ sudo ln -s /etc/nginx/sites-available/<project-name> /etc/nginx/sites-enabled
```

#### Nginx last settings:

```sh
$ sudo nginx -t && sudo systemctl restart nginx && sudo ufw delete allow 8000 && sudo ufw allow 'Nginx Full'
```

## Restart Gunicorn and everything will be ready

```sh
$ sudo systemctl restart gunicorn
```

***P.S. Django must have a collectstatic to render correctly***