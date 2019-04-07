# POST INSTALL

## Canonical partners
```
In software & updates check the box of canonical partners.
```
## Language
```
In settings/regions&language select "manage installed languages and install it"
```
## Update all
```
$ sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y
```
## Synaptic gdebi
* Install:
```
$ sudo apt install synaptic gdebi -y
```
* Synaptic search box:
```
$ sudo apt install apt-xapian-index -y
$ sudo update-apt-xapian-index -vf
```
* FFmpeg:
```
Search, apply and install.
```
## Gnome tweak tool
* Install:
```
$ sudo apt install gnome-tweak-tool -y
```
* Arc theme:
```
$ sudo apt install arc-theme papirus-icon-theme -y
```
* Adapta gtk theme:

```
$ sudo add-apt-repository ppa:tista/adapta -y
$ sudo apt update -y
$ sudo apt install adapta-gtk-theme -y
```
## Gnome shell extensions
* First:
```
[Gnome](https://extensions.gnome.org/)
Click and allow "click here to install browser extension", and then add.
```
* Second:
```
$ sudo apt-get install chrome-gnome-shell -y
```
* Third:
```
[User themes](https://extensions.gnome.org/extension/19/user-themes/)
Switch to ON and click install.
alt + F2 then R then ENTER
```