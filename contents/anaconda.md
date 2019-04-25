<div>

<h1>ANACONDA</h1>

<h2>Download</h2>

`$ curl -O https://repo.anaconda.com/archive/Anaconda3-2018.12-Linux-x86_64.sh`

<h2>Install</h2>

`$ sudo bash ./Anaconda3-2018.12-Linux-x86_64.sh`

<kbd>ENTER</kbd><br>
`yes`


* Path:
```
$ /home/ubuntu/anaconda3
$ /opt/anaconda3
```
* Do you wish the installer to initialize Anaconda3:
```
$ yes (important)
```
## Envs list
```
$ conda info --envs
```
## Libs list on envs
```
$ conda list -e
```
## Create an envs
* Default:
```
$ conda create --name devscdn python=3.6 -y
```
* Giving a Path: (and the default python version)
```
$ conda create --prefix /opt/anaconda/envs/envsname python=3.6 -y
```
## Export/import a created envs
* Export:
```
$ conda env export | grep -v "^prefix: " > environment.yml
```
* Import:
```
$ conda env create -f environment.yml
```
## MySQL server out envs (to avoid errors if the project uses mysql db (important))
```
$ sudo apt install mysql-server -y
```
## More libs (conda install lib)
```
[Anaconda repo links](https://anaconda.org/anaconda/repo)
```
## Conda activate/deactivate
* Activate:
```
$ conda activate envsname
```
* Deactivate:
```
$ conda deactivate
```
## Conda update
```
$ conda update -n base -c defaults conda
```

</div>