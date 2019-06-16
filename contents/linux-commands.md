# LINUX COMMANDS
## Update, upgrade, clean and autoremove

```sh
$ sudo apt update -y && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y
```

## Delete
#### File/files:

```sh
$ sudo rm -rf <filename1> <filename2>
```

#### File set: (xml example)

```sh
$ sudo rm -rf *.xml
```

## Print working directory

```sh
$ pwd
```

## Shutdown

```sh
$ sudo shutdown -r 0
```

## Environment variables
#### Set it:

```sh
$ sudo vim /etc/environment
```

#### [environment]

```sh
<TEST1>="PATH1"
<TEST2>="PATH2"
```

#### Call a variable:

```sh
$ cd $<TEST1>
$ cd $<TEST2>
```

## Rename files

```sh
$ sudo mv <filename> <newfilename>
```

## Chmod
#### 777 to all folder/subfolders:

```sh
$ sudo chmod -R 777 <foldername>
```

## System information

```sh
$ sudo dmidecode | grep -A 9 "System Information"
```

## Display current time & data setting

```sh
$ sudo hwclock --show
```

## Monitoring

```sh
$ sudo apt install htop -y
$ htop
```