# JUPYTER 

## Settings as root
```
$ sudo su
cd
```
## Download and install Anaconda<br>
[Anaconda.](https://github.com/Nouvellie/ubuntu/blob/ubuntu/anaconda.md)

## Create an envs to run jupyterhub and our libraries (python3.6)
```
$ conda create --name jupyterbase python=3.6 -y
```
## Update conda
```
$ conda update -n base -c defaults conda -y
```
## Conda libs
```
$ conda install -c conda-forge mysql-connector-python -y && conda install -c pandas pymysql -y && conda install -c conda-forge mysqlclient -y && conda install -c kalefranz mysql-server -y && conda install -c conda-forge django -y && conda install -c conda-forge djangorestframework -y && conda install -c conda-forge keras -y && conda install -c anaconda tensorflow -y && conda install -c conda-forge django-cors-headers -y && conda install -c conda-forge django-filter -y && conda install -c conda-forge pandas -y && conda install -c conda-forge bokeh -y && conda install -c conda-forge appdirs -y && conda install -c conda-forge lxml -y && conda install -c conda-forge wfdb -y && conda install -c conda-forge pywavelets -y && conda install -c conda-forge sqlparse -y && conda install -c conda-forge jupyterhub -y && conda install -c conda-forge notebook -y && conda install -c conda-forge configurable-http-proxy -y && conda install -c conda-forge jupyterlab
```
## Create a jupyterhub dir (/opt/user-jupyterhub) and settings
* Install default files:
```
$ mkdir /opt/user-jupyterhub
$ conda activate jupyterbase
```
* Generate jupyterhub sqlite and cookie_secret:
```
$ jupyterhub
```
* Create a jupyterhub config: (opt/user-jupyterhub/)
```
$ jupyterhub --generate-config 
```
