# ANACONDA
## Download

```sh
$ curl -O https://repo.anaconda.com/archive/Anaconda3-2019.03-Linux-x86_64.sh
```

## Install
#### Run bash: (as root)

```sh
$ sudo su
$ cd
$ sudo bash ./Anaconda3-2019.03-Linux-x86_64.sh
```

<kbd>ENTER</kbd><br>

```sh
yes
```

#### Path:

```sh
/opt/anaconda3
```

#### Do you wish the installer to initialize Anaconda3:

```sh
yes # (Important)
```

## Envs list

```sh
$ conda info --envs
```

## Libs list on envs

```sh
$ conda list -e
```

## Conda update

```sh
$ conda update -n base -c defaults conda -y
```

## To access Conda commands with any user
#### Edit environment:

```sh
$ sudo vim /etc/environment
```

#### [environmnet]

```sh
PATH=/opt/anaconda3/bin:$PATH
```

## Create an envs
#### Default:

```sh
$ conda create --name <envsname> python=3.6 -y
```

#### Giving a Path: (and the default python version)

```sh
$ conda create --prefix /opt/anaconda3/envs/<envsname> python=3.6 -y
```

## Export/import a created envs
#### Export:

```sh
$ conda env export | grep -v "^prefix: " > <envsname>.yml
```

#### Import:

```sh
$ conda env create -f <envsname>.yml
```

## MySQL server out envs (to avoid errors if the project uses MySQL DB (important))

```sh
$ sudo apt install mysql-server -y
```

## Conda activate/deactivate
#### Activate:

```sh
$ conda activate <envsname>
```

#### Deactivate:

```sh
$ conda deactivate
```

## Install envs in a specific directory
#### Add directory to Conda:

```sh
$ conda config --append envs_dirs /home/<user>/project/env
```

#### Create Conda env in the specific directory:

```sh
$ conda create --prefix /home/<user>/<projectname>/env/<envsname> python=3.6 -y
```

## More libs (Conda install lib)

[Anaconda packages.](https://anaconda.org/anaconda/repo)