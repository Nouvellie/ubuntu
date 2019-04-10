# UBUNTU COMMANDS

## Update, upgrade, clean and autoremove
```
$ sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y
```
## Delete
* File/files:
```
$ sudo rm -rf filename1 filename2
```
* Set of files:
```
$ sudo rm -rf asterisk.xml
```
## Path
```
$ pwd
```
## Shutdown
```
$ sudo shutdown -r 0
```
## Environment variables
* Set it:
```
$ sudo vim /etc/environment
```
* Envs vars:
```
TEST="PATH"
TEST2="PATH2"
```
* Calls vars:
```
$ cd $TEST
$ cd $TEST2
```
## Rename
```
$ sudo mv namefile newnamefile
```
## Chmod 
* 777 to all folder/subfolders:
```
$ sudo chmod -R 777 foldername
```