# GIT

## Git clone
* Install Git:
```
$ sudo apt install git -y
```
* Git clone:
```
$ git clone https://github.com/Nouvellie/ubuntu
```
* Username: 
```
username@mail.com
```
* Password:
```
password123456
```
<br><br>
## Credential store
```
$ git config credential.helper store
```
<br><br>
## Reset fetch head
* If service dont update branch correctly:
```
$ git fetch origin branch
$ git reset --hard FETCH_HEAD
$ git clean -df
```
<br><br>
## Pull/push branch
* Pull:
```
$ git pull origin branch
```
* Push:
```
$ git push origin branch
```
* Hard push:
```
$ git push -f origin branch
```