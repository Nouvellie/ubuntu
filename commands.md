# UBUNTU COMMANDS

## Update, upgrade, clean and autoremove
```
$ sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y
```
<br><br>
## Delete
* File/files:
```
$ sudo rm -rf filename1 filename2
```
* Set of files:
```
$ sudo rm -rf asterisk.xml
```
<br><br>
## Path
```
$ pwd
```
<br><br>
## Shutdown
```
$ sudo shutdown -r 0
```
<br><br>
## Environment variables ##
```
$ sudo vim /etc/environment
```
* Envs vars:<br>
TEST="PATH"
TEST2="PATH2"<br>
* Calls vars:
```
$ cd $TEST
```
```
$ cd $TEST2
```
<br><br>
## Rename
```
$ sudo mv namefile newnamefile
```