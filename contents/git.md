# GIT
## Install

```sh
$ sudo apt install git -y
```

## Cloning a repository
#### Git clone:

```sh
$ git clone https://github.com/Nouvellie/ubuntu
```

#### Username:

```sh
username/email
```

#### Password:

```sh
password123456
```

## Credential store and some sudo permissions

```sh
$ sudo chown -Rc $UID .git/ && git config credential.helper store && git pull
```

## Reset fetch head
#### If the service doesn't update the branch correctly:

```sh
$ git fetch origin branch`
$ git reset --hard FETCH_HEAD`
$ git clean -df
```

## Pull/push branch
#### Pull:

```sh
$ git pull origin branch
```

#### Push:

```sh
$ git push origin branch
```

#### Hard push: (force push)

```sh
$ git push -f origin branch
```

## Git ignore (example for xml files)
#### Ignore only from root folder:

```sh
/*.xml
```

#### Ignore all the files: (rootfolder/subfolders)

```sh
**/*.xml
```