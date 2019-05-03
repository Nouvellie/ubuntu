<div>
  
<h1>NGINX</h1>
<h2>First step</h2>

<link rel="stylesheet" type="text/css" href="https://www.youtube.com/watch?v=VDVNgivbvYk">

<h1>First method</h1>


https://www.youtube.com/watch?v=Xlp9G137-MI

sudo apt install nginx -y

conda activate cdn-envs

conda install -c conda-forge gunicorn -y

sudo vim cdnweb/settings.py
[settings.py]
STATIC_ROOT = os.path.join(PROJECT_DIR, 'static')

sudo ufw allow 8000

allowhost[amazon ip]

python3 manage.py runserver 0.0.0.0:8000

gunicorn --bind 0.0.0.0:8000 cdnweb.wsgi

source deactivate

sudo vim /etc/systemd/system/gunicorn.service
[gunicorn.service]
[Unit]
Description=gunicorn daemon
After=network.target

[Service]
User=ubuntu
Group=www-data
WorkingDirectory=/home/ubuntu/Cardionomous-ws
ExecStart=/opt/anaconda3/envs/cdn-envs/bin/gunicorn --access-logfile -  --workers 3 --bind unix:/home/ubuntu/Cardionomous-ws/cdnweb.sock cdnweb.wsgi:application

[Install]
WantedBy=multi-user.target

sudo systemctl start gunicorn
sudo systemctl enable gunicorn
sudo systemctl status gunicorn

sudo journalctl -u gunicorn
sudo systemctl daemon-reload

sudo systemctl restart gunicorn


sudo vim /etc/nginx/sites-available/Cardionomous-ws
[Cardionomous-ws]
server {
        listen 80;
        server_name 3.210.147.79;

        location = /favicon.ico { access_log off; log_not_found off; }
        location /static/ {
                root /home/ubuntu/Cardionomous-ws
        }

        location / {
                include proxy_params;
                proxy_pass http://unix:/home/unbutu/Cardionomous-ws/cdnweb.sock;
        }
}


sudo ln -s /etc/nginx/sites-available/Cardionomous-ws /etc/nginx/sites-enabled
sudo nginx -t

sudo systemctl restart nginx
sudo ufw delete allow 8000

sudo ufw allow 'Nginx Full'


</div>