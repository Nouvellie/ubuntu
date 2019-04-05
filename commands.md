# UBUNTU COMMANDS

## Update, upgrade, clean and autoremove ##
sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y

## Delete file/files ##
sudo rm -rf filename1 filename2

## Delete group of files ## 
sudo rm -rf asterisk.xml

## Path ##
pwd

## Shutdown ##
sudo shutdown -r 0

## Environment variables ##
sudo vim /etc/environment
* Envs vars:
TEST="PATH"
TEST2="PATH2"
* Calls vars:
cd $TEST
cd $TEST2

## Rename ##
sudo mv namefile newnamefile