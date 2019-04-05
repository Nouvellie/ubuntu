# DOWNLOAD, INSTALL ANACONDA, AND SOME COMMANDS 

## Download
curl -O https://repo.anaconda.com/archive/Anaconda3-2018.12-Linux-x86_64.sh
<br><br>
## Install
```
$ sudo bash ./Anaconda3-2018.12-Linux-x86_64.sh
```
```
ENTER
yes
```
* Path:
```
/home/ubuntu/anaconda3n
```
* Do you wish the installer to initialize Anaconda3:
```
yes (important)
```
<br><br>
## Envs list
```
$ conda info --envs
```
<br><br>
## Libs list on envs
```
$ conda list -e
```
<br><br>
## Create a envs
* Default:
```
$ conda create --name devscdn python=3.6 -y
```
* Giving a Path: (and version of python by default)
```
$ conda create --prefix /opt/anaconda/envs/envsname python=3.6 -y
```
<br><br>
## Export/import a created envs
* Export:
```
$ conda env export | grep -v "^prefix: " > environment.yml
```
* Import:
```
$ conda env create -f environment.yml
```
<br><br>
## MySQL server out envs (to avoid errors if the project use mysql db (important))
```
$ sudo apt install mysql-server -y
```
<br><br>
## More libs (conda install lib)
[Anaconda repo links](https://anaconda.org/anaconda/repo)
<br><br>
## Conda activate/deactivate
* Activate:
```
$ conda activate envsname
```
* Deactivate:
```
$ conda deactivate
```
<br><br>
## Conda update
```
$ conda update -n base -c defaults conda
```