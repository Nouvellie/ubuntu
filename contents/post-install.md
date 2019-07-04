# POST INSTALL
## Update all

```sh
$ sudo apt update -y && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y
```

## Canonical partners

In software & updates check the canonical partners box.

## Language

In *settings/regions&languages* select *"manage installed languages and install them completely"*.

## Synaptic Gdebi
#### Install:

```sh
$ sudo apt install synaptic gdebi -y
```

#### Synaptic search box:

```sh
$ sudo apt install apt-xapian-index -y && sudo update-apt-xapian-index -vf
```

#### FFmpeg:

Search, apply and install.

## Gnome Tweak Tool
#### Install:

```sh
$ sudo apt install gnome-tweak-tool -y
```

#### Arc theme:

```sh
$ sudo apt install arc-theme papirus-icon-theme -y
```

#### Adapta Gtk theme:

```sh
$ sudo add-apt-repository ppa:tista/adapta -y && sudo apt update -y && sudo apt install adapta-gtk-theme -y
```

## Gnome Shell extensions
#### First:

```sh
$ sudo apt install chrome-gnome-shell -y
```

#### Second:

[User themes](https://extensions.gnome.org/extension/19/user-themes/)

Switch to **ON** and click *install*.

#### Restarts GNOME Shell:

<kbd>Alt</kbd> + <kbd>F2</kbd><br>
<kbd>r</kbd> + <kbd>ENTER</kbd>