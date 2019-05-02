<div>

<h1>POST INSTALL</h1>
<h2>Update all</h2>

`$ sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y`

<h2>Canonical partners</h2>

<p>
In software & updates check the canonical partners box.
</p>

<h2>Language</h2>

<p>
settings/regions&languages
</p>

<p>
select "manage installed languages and install them completely".
</p>

<h2>Synaptic gdebi</h2>
<h4>Install:</h4>

`$ sudo apt install synaptic gdebi -y`

<h4>Synaptic search box:</h4>

`$ sudo apt install apt-xapian-index -y && sudo update-apt-xapian-index -vf`

<h4>FFmpeg:</h4>

<p>
Search, apply and install.
</p>

<h2>Gnome tweak tool</h2>
<h4>Install:</h4>

`$ sudo apt install gnome-tweak-tool -y`

<h4>Arc theme:</h4>

`$ sudo apt install arc-theme papirus-icon-theme -y`

<h4>Adapta gtk theme:</h4>

`$ sudo add-apt-repository ppa:tista/adapta -y && sudo apt update -y && sudo apt install adapta-gtk-theme -y`

<h2>Gnome shell extensions</h2>
<h4>First:</h4>

`$ sudo apt-get install chrome-gnome-shell -y`

<h4>Second:</h4>

[User themes](https://extensions.gnome.org/extension/19/user-themes/)

<p>
Switch to ON and click install.
</p>

<h4>Restarts GNOME Shell:</h4>
<kbd>Alt</kbd> + <kbd>F2</kbd><br>
<kbd>r</kbd> + <kbd>ENTER</kbd>

</div>