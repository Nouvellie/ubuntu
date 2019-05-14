<div>
  
<h1>NGINX</h1>
<h2>First step</h2>
<h4>Install Nginx:</h4>

`$ sudo apt install nginx -y`

<h4>Install Gunicorn:</h4>

`$ conda activate envsname`<br>
`$ conda install -c conda-forge gunicorn -y`

<h2>Testing Gunicorn</h2>
<h4>Settings:</h4>

`$ sudo ufw allow 8000`

<h4>Allow IP: (Django)</h4>

```
allowhost['hosting IP']
```

<h4>Run Django Server: (at port 8000)</h4>

`$ python3 manage.py runserver 0.0.0.0:8000`

<h4>Run Django with Gunicorn:</h4>

`$ cd /home/user/django-project/project-name`<br>
`$ gunicorn --bind 0.0.0.0:8000 project-name.wsgi`

<h2>Create Gunicorn Service</h2>

`$ sudo vim /etc/systemd/system/gunicorn.service`

<h4>Deactivate conda envs:</h4>

`$ conda deactivate`

<h4>[gunicorn.service]</h4>

```
[Unit]
Description=gunicorn daemon
After=network.target

[Service]
User=cdn-devs
Group=www-data
WorkingDirectory=/home/user/django-project/project-name
ExecStart=/home/user/django-project/project-name/env/library/bin/gunicorn --access-logfile - --workers 3 --bind unix:/home/user/django-project/project-name.sock project-name.wsgi:application

[Install]
WantedBy=multi-user.target

```

<h2>Enable gunicorn, and show status</h2>
<h4>Start, Enable, Status:</h4>

`$ sudo systemctl start gunicorn`<br>
`$ sudo systemctl enable gunicorn`<br>
`$ sudo systemctl status gunicorn`

<h4>Journal and daemon reload:</h4>

`$ sudo journalctl -u gunicorn`<br>
`$ sudo systemctl daemon-reload`<br>
`$ sudo systemctl restart gunicon`

<h2>Nginx sites available</h2>

`$ sudo vim /etc/nginx/sites-available/project-name`

<h4>[project-name]</h4>

```
server {
        listen 80;
        server_name hosting-IP; # (example 2.222.222.222)
        location = /favicon.ico { access_log off; log_not_found off; }
        location /static/ {
                root /home/user/django-project/project-name;
        }
        location / {
                include proxy_params;
                proxy_pass http://unix:/home/user/django-project/project-name.sock;
        }
}
```

<h4>From sites available to sites enabled: (nginx conf)</h4>

`$ sudo ln -s /etc/nginx/sites-available/project-name /etc/nginx/sites-enabled`

<h4>Nginx last settings:</h4>

`$ sudo nginx -t`<br>
`$ sudo systemctl restart nginx`<br>
`$ sudo ufw delete allow 8000`<br>
`$ sudo ufw allow 'Nginx Full'`

</div>