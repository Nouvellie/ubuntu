<div>

<h1>LINUX COMMANDS</h1>
<h2>Update, upgrade, clean and autoremove</h2>

`$ sudo apt update && sudo apt upgrade -y && sudo apt autoremove -y && sudo apt install -f -y && sudo apt auto-clean -y`

<h2>Delete</h2>
<h4>File/files:</h4>

`$ sudo rm -rf filename1 filename2`

<h4>File set: (xml example)</h4>

`$ sudo rm -rf *.xml`

<h2>Print working directory</h2>

`$ pwd`

<h2>Shutdown</h2>

`$ sudo shutdown -r 0`

<h2>Environment variables</h2>
<h4>Set it:</h4>

`$ sudo vim /etc/environment`

<h4>Envs vars:</h4>

`TEST="PATH"`
`TEST2="PATH2"`

<h4>How to call a variable:</h4>

`$ cd $TEST`
`$ cd $TEST2`

<h2>Rename</h2>

`$ sudo mv namefile newnamefile`

<h2>Chmod</h2>
<h4>777 to all folder/subfolders:</h4>

`$ sudo chmod -R 777 foldername`

<h2>System information</h2>

`$ sudo dmidecode | grep -A 9 "System Information"`

</div>