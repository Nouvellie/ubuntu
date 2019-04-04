###### ######
# NOUVELLIE
###### ######

# SETTINGS UBUNTU (18.04 LTS) [USER = UBUNTU]

## Update, upgrade, clean and autoremove ##
sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y

# DOWNLOAD AND INSTALL ANACONDA #

## Download ##
curl -O https://repo.anaconda.com/archive/Anaconda3-2018.12-Linux-x86_64.sh

## Install ##
sudo bash ./Anaconda3-2018.12-Linux-x86_64.sh
ENTER
yes
/home/ubuntu/anaconda3