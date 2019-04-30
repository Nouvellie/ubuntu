<div>

<h1>GIT</h1>
<h2>Git clone</h2>
<h4>Install Git</h4>

`$ sudo apt install git -y`

<h4>Git clone:</h4>

`$ git clone https://github.com/Nouvellie/ubuntu`

<h4>Username: </h4>

`username@mail.com`

<h4>Password:</h4>

`password123456`

<h2>Credential store</h2>

`$ git config credential.helper store`

<h2>Reset fetch head</h2>
<h4>If the service doesn't update the branch correctly:</h4>

`$ git fetch origin branch`<br>
`$ git reset --hard FETCH_HEAD`<br>
`$ git clean -df`

<h2>Pull/push branch</h2>
<h4>Pull:</h4>

`$ git pull origin branch`

<h4>Push:</h4>

`$ git push origin branch`

<h4>Hard push:</h4>

`$ git push -f origin branch`

<h2>Git ignore (example for xml files)</h2>
<h4>Ignore only from root folder.</h4>

`/*.xml`

<h4>Ignore all the files. (rootfolder/subfolders)</h4>

`**/*.xml`

</div>