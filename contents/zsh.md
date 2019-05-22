# ZSH
## Install as root

```sh
$ sudo su
$ sudo apt install zsh -y
```

## Get bash

```sh
cd /root
$ sudo sh -c "$(wget https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh -O -)"
```

## Settings
#### Conf:

```sh
$ sudo mkdir /opt/oh-my-zsh
$ sudo cp -r /home/<user>/.oh-my-zsh/ /opt/oh-my-zsh/
```

#### Bash:

```sh
$ sudo vim .zshrc
```
#### [.zshrc]

```sh
export ZSH="/opt/oh-my-zsh/.oh-my-zsh"
ZSH_THEME="essembeh"
```

## Copy zsh root to user

```sh
$ sudo cp -r /root/.zshrc /home/<user>
```

## Activate Zsh

```sh
$ chsh -s `which zsh`
```

## Upgrade

```sh
$ upgrade_oh_my_zsh
```

## Add Zsh shell to all the users
#### Zshrc export:

```sh
$ for i in <user1> <user2> <user3> <user4> <userX>; do cp .zshrc /home/${i}; chown ${i} /home/${i}/.zshrc; done
```

#### Active Zsh shell

```sh
$ for i in <user1> <user2> <user3> <user4> <userX>; do chsh --shell=`which zsh` ${i}; done
```

## If [oh-my-zsh] Insecure completion-dependent directories detected

#### Open file in the root directory:

```sh
$ sudo vim /root/.zshrc
```

#### Disable compfix:

```sh
ZSH_COMPFIX_DISABLE=true
```

##### Zshrc export and active zsh shell again:

```sh
$ for i in <user1> <user2> <user3> <user4> <userX>; do cp .zshrc /home/${i}; chown ${i} /home/${i}/.zshrc; done
$ for i in <user1> <user2> <user3> <user4> <userX>; do chsh --shell=`which zsh` ${i}; done
```