# CRON
## Examples for monthly, weekly, daily (with django or git project)
#### Monthly:

```sh
$ sudo vim /etc/cron.d/<maincron>
```

```sh
At 09:00 on day-of-month 1.
```

```sh
0 9 1 * * root sudo bash /opt/bash/script/log.sh
```

#### Code for Nginx access/error:

```sh
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

#### Weekly:

```sh
$ sudo vim /etc/cron.d/<maincron>
```

```sh
At 09:00 on Sunday.
```

```sh
0 9 * * 0 root sudo bash /opt/bash/script/update.sh
```

#### Code for ubuntu update-upgrade-clean:

```sh
#!/bin/bash
HOME_DIRS="/home/<user>/"

for FOLDER in $HOME_DIRS; do
    sudo apt update -y
    sudo apt upgrade -y
    sudo apt autoremove -y
    sudo apt install -f -y
    sudo apt auto-clean -y
done
```

#### Daily:

```sh
$ sudo vim /etc/cron.d/<maincron>
```

```sh
At 09:00 on every day-of-week from Sunday through Saturday.
```

```sh
0 9 * * 0-6 root sudo bash /opt/bash/script/clean.sh
```

#### Code for git clean:

```sh
#!/bin/bash
HOME_DIRS="/home/<user>/<django-project>"

for FOLDER in $HOME_DIRS; do
	cd /home/<user>/<django-project>
    sudo git reset --hard
    sudo git clean -df 
done
```