<div>

<h1>CRON</h1>
<h2>Examples for monthly, weekly, daily (with django or git project)</h2>
<h4>Monthly:</h4>

`$ sudo vim /etc/cron.d/'maincron'`<br>

<p>
At 09:00 on day-of-month 1.
</p><br>

```
0 9 1 * * root sudo bash /opt/bash/script/log.sh
```

<h4>Code for Nginx access/error:</h4>

```
#!/bin/bash
HOME_DIRS="/opt/log/example"
DATE_DIR=$(date +%Y-%m-%d)
FILE_ERROR="/var/log/nginx/error.log"
FILE_ACCESS="/var/log/nginx/access.log"

for FOLDER in $HOME_DIRS; do
    sudo mkdir -p "${FOLDER}/${DATE_DIR}"
    sudo mv ${FILE_ERROR} ${FOLDER}/${DATE_DIR}/error.log
    sudo mv ${FILE_ACCESS} ${FOLDER}/${DATE_DIR}/access.log
    sudo touch ${FILE_ERROR}
    sudo touch ${FILE_ACCESS}
    sudo kill -USR1 `cat /var/run/nginx.pid`
done
```

<h4>Weekly:</h4>

`$ sudo vim /etc/cron.d/'maincron'`<br>

<p>
At 09:00 on Sunday.
</p><br>

```
0 9 * * 0 root sudo bash /opt/bash/script/update.sh
```

<h4>Code for ubuntu update-upgrade-clean:</h4>

```
#!/bin/bash
HOME_DIRS="/home/user/"

for FOLDER in $HOME_DIRS; do
    sudo apt update -y
    sudo apt upgrad -y
    sudo apt autoremove -y
    sudo apt install -y
    sudo apt auto-clean -y
done
```

<h4>Daily:</h4>

`$ sudo vim /etc/cron.d/'maincron'`<br>

<p>
At 09:00 on every day-of-week from Sunday through Saturday.
</p><br>

```
0 9 * * 0-6 root sudo bash /opt/bash/script/clean.sh
```

<h4>Code for git clean:</h4>

```
#!/bin/bash
HOME_DIRS="/home/user/django-project"

for FOLDER in $HOME_DIRS; do
	cd /home/user/django-project
    sudo git reset --hard
    sudo git clean -df 
done
```


</div>