<div>

<h1>ZSH</h1>
<h2>Install</h2>

`$ sudo apt install zsh -y`

<h2>Get bash</h2>

`cd /home/user/`<br>
`$ sudo sh -c "$(wget https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh -O -)"`

<h2>Settings</h2>
<h4>Conf:</h4>

`$ sudo mkdir /opt/oh-my-zsh`<br>
`sudo cp -r /home/user/.oh-my-zsh/ /opt/oh-my-zsh/`

<h4>Bash:</h4>

`$ sudo vim .zshrc`

<h4>[.zshrc]</h4>

```
export ZSH="/opt/oh-my-zsh"
ZSH_THEME="essembeh"
```

<h2>Copy zsh bash to root</h2>

`$ sudo cp -r /home/cdn-devs/.zshrc /root`

<h2>Activate Zsh</h2>

`
$ chsh -s `which zsh`
`

<h2>Upgrade</h2>

`$ upgrade_oh_my_zsh`

</div>