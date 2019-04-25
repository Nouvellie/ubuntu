# NGINX

* Install nginx:
$ sudo apt install nginx -y

* Install supervisor:
sudo apt install supervisor -y

* Install MySQL server:
sudo apt install mysql-server -y

* MySQL secure installation:
sudo mysql_secure_installation

* Django rest knox
pip install django-rest-knox

* Django webpack loader
pip install django-webpack-loader

# If mysql config error
sudo apt install libmysqlclient-dev

# sudo ufw app list

# sudo apt install net-tools

netstat -tupln


conda install -c conda-forge gunicorn -y




# VERSION 2
* Upgrade pip:
pip install --upgrade pip

* Install gunicorn.
pip install gunicorn
****
conda install -c conda-forge gunicorn -y

* /home/ubuntu/conf/gunicorn.conf.py

```
import multiprocessing

bind = '127.0.0.1:8000'
workers = multiprocessing.cpu_count() * 2
(it can be * 4 max)
```

* Add two lines: 18.04 ubuntu
sudo vim /etc/apt/sources.list
deb http://nginx.org/packages/ubuntu/ bionic nginx
deb-src http://nginx.org/packages/ubuntu/ bionic nginx

* avoid authentication errors:
wget -qO - https://nginx.org/keys/nginx_signing.key | sudo apt-key add -

sudo apt update
sudo apt install nginx


touch /home/ubuntu/conf/nginx.conf
```
worker_processes 1;

user nobody nogroup;
# 'user nobody nobody;' for systems with 'nobody' as a group instead
pid /tmp/nginx.pid;
error_log /home/ubuntu/log/nginx.error.log;

events {
  worker_connections 1024; # increase if you have lots of clients
  accept_mutex off; # set to 'on' if nginx worker_processes > 1
  # 'use epoll;' to enable for Linux 2.6+
  # 'use kqueue;' to enable for FreeBSD, OSX
}

http {
  include /etc/nginx/mime.types;
  # fallback in case we can't determine a type
  default_type application/octet-stream;
  access_log /home/ubuntu/log/nginx.access.log combined;
  sendfile on;

  upstream app_server {
    # fail_timeout=0 means we always retry an upstream even if it failed
    # to return a good HTTP response

    # for UNIX domain socket setups
    # server unix:/tmp/gunicorn.sock fail_timeout=0;

    # for a TCP configuration
    server 127.0.0.1:8000 fail_timeout=0;
  }

  server {
    # if no Host match, close the connection to prevent host spoofing
    listen 80 default_server;
    return 444;
  }

  server {
    # use 'listen 80 deferred;' for Linux
    # use 'listen 80 accept_filter=httpready;' for FreeBSD
    listen 80;
    client_max_body_size 4G;

    # set the correct host(s) for your site
    server_name cardionomous.ai;

    keepalive_timeout 5;

    # path for static files
    root /home/ubuntu/static;

    location / {
      # checks for static file, if not found proxy to app
      try_files $uri @proxy_to_app;
    }

    location /static {
      # path for Django static files
      alias /home/ubuntu/static;
    }

    location @proxy_to_app {
      proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
      # enable this if and only if you use HTTPS
      # proxy_set_header X-Forwarded-Proto https;
      proxy_set_header Host $http_host;
      # we don't want nginx trying to do something clever with
      # redirects, we set the Host: header above already.
      proxy_redirect off;
      proxy_pass http://app_server;
    }

    error_page 500 502 503 504 /500.html;
    location = /500.html {
      root /home/ubuntu/static;
    }
  }
}

```
* add to hosts:
sudo vim /etc/hosts
127.0.0.1 localhost
127.0.0.1 localhost cardionomous.ai


* conda deactivate and pip install 
conda deactivate cdnenvs
conda deactivate base
conda apt install python-pip

* install supervisor:
sudo apt install supervisor
pip install supervisor

sudo touch /home/ubuntu/conf/supervisord.conf

sudo vim /home/ubuntu/conf/supervisord.conf

```
[supervisord]
logfile=/home/ubuntu/log/supervisord.log

[inet_http_server]
port=127.0.0.1:9001

[rpcinterface:supervisor]
supervisor.rpcinterface_factory=supervisor.rpcinterface:make_main_rpcinterface

[program:todo-django]
command=/home/ubuntu/.conda/envs/cdnenvs/bin/gunicorn Cardionomous-ws.wsgi -c /home/ubuntu/conf/gunicorn.conf.py
directory=/home/ubuntu/Cardionomous-ws
user=nobody
autostart=true
autorestart=true
stdout_logfile=/home/ubuntu/log/Cardionomous-ws.log
stderr_logfile=/home/ubuntu/log/Cardionomous-ws.err.log

```

* run django
sudo nginx -c /home/ubuntu/conf/nginx.conf


Para detener Nginx, podemos ejecutar el siguiente comando:

$ sudo pkill -QUIT nginx

Y para reiniciarlo:

$ sudo pkill -HUP nginx



Para detener el demonio de Supervisor, podemos ejecutar el siguiente comando:

$ sudo pkill -QUIT supervisord

Y para reiniciarlo:

$ sudo pkill -HUP supervisord










* Run nginx:
https://www.youtube.com/watch?v=08yYjLGWzaM