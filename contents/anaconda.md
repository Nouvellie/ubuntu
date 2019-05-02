<div>

<h1>ANACONDA</h1>
<h2>Download</h2>

`$ curl -O https://repo.anaconda.com/archive/Anaconda3-2019.03-Linux-x86_64.sh`

<h2>Install</h2>
<h4>Run bash:</h4>

`$ sudo bash ./Anaconda3-2019.03-Linux-x86_64.sh`

<p>

<kbd>ENTER</kbd><br>

<p>
yes
</p>

<h4>Path:</h4>

`/opt/anaconda3`

<h4>Do you wish the installer to initialize Anaconda3:</h4>

<p>
yes (important)
</p>

</p>
<h2>Envs list</h2>

`$ conda info --envs`

<h2>Libs list on envs</h2>

`$ conda list -e`

<h2>Conda update</h2>

`$ conda update -n base -c defaults conda`

<h2>To access conda commands with any user</h2>
<h4>Edit environment:</h4>

`$ sudo vim /etc/environment`

<h4>[environmnet]</h4>

```
PATH=/opt/anaconda3/bin:PATH
```

<h2>Create an envs</h2>
<h4>Default:</h4>

`$ conda create --name envsname python=3.6 -y`

<h4>Giving a Path: (and the default python version)</h4>

`$ conda create --prefix /opt/anaconda3/envs/envsname python=3.6 -y`

<h2>Export/import a created envs</h2>
<h4>Export:</h4>

`$ conda env export | grep -v "^prefix: " > envsname.yml`

<h4>Import:</h4>

`$ conda env create -f envsname.yml`

<h2>MySQL server out envs (to avoid errors if the project uses mysql db (important))</h2>

`$ sudo apt install mysql-server -y`

<h2>Conda activate/deactivate</h2>
<h4>Activate:</h4>

`$ conda activate envsname`

<h4>Deactivate:</h4>

`$ conda deactivate`

<h2>More libs (conda install lib)</h2>

[Anaconda packages.](https://anaconda.org/anaconda/repo)

</div>