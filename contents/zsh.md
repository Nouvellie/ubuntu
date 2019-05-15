<div>

<h1>ZSH</h1>
<h2>Install as root</h2>

`$ sudo su`<br>
`$ sudo apt install zsh -y`

<h2>Get bash</h2>

`cd /root`<br>
`$ sudo sh -c "$(wget https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh -O -)"`

<h2>Settings</h2>
<h4>Conf:</h4>

`$ sudo mkdir /opt/oh-my-zsh`<br>
`sudo cp -r /home/user/.oh-my-zsh/ /opt/oh-my-zsh/`

<h4>Bash:</h4>

`$ sudo vim .zshrc`

<h4>[.zshrc]</h4>

```
export ZSH="/opt/oh-my-zsh/.oh-my-zsh"
ZSH_THEME="essembeh"
```

<h2>Copy zsh root to user</h2>

`$ sudo cp -r /root/.zshrc /home/user`

<h2>Activate Zsh</h2>

`
$ chsh -s `which zsh`
`

<h2>Upgrade</h2>

`$ upgrade_oh_my_zsh`

<h2>Add Zsh shell to all the users</h2>
<h4>Zshrc export:</h4>

`$ for i in user1 user2 user3 user4 userX; do cp .zshrc /home/${i}; chown ${i} /home/${i}/.zshrc; done`

<h4>Active Zsh shell</h4>

`$ for i in user1 user2 user3 user4 userX; do chsh --shell=`which zsh` ${i}; done`

</div>