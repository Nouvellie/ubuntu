<div>

<h1>ANACONDA</h1>
<h2>Download</h2>

`$ curl -O https://repo.anaconda.com/archive/Anaconda3-2018.12-Linux-x86_64.sh`
<h2>Install</h2>

`$ sudo bash ./Anaconda3-2018.12-Linux-x86_64.sh`

<kbd>ENTER</kbd><br><br>
`yes`

<h3>Path:</h3>

`/home/ubuntu/anaconda3`
`/opt/anaconda3`

<h3>Do you wish the installer to initialize Anaconda3:</h3>

`yes (important)`

<h2>Envs list</h2>

`$ conda info --envs`

<h2>Libs list on envs</h2>

`$ conda list -e`

<h2>Create an envs</h2>

<h3>Default:</h3>

`$ conda create --name devscdn python=3.6 -y`

<h3>Giving a Path: (and the default python version)</h3>

`$ conda create --prefix /opt/anaconda/envs/envsname python=3.6 -y`

<h2>Export/import a created envs</h2>

<h3>Export:</h3>

`$ conda env export | grep -v "^prefix: " > environment.yml`

<h3>Import:</h3>

`$ conda env create -f environment.yml`

<h2>MySQL server out envs (to avoid errors if the project uses mysql db (important))</h2>

`$ sudo apt install mysql-server -y`

<h2>More libs (conda install lib)</h2><br>

[Anaconda repo links](https://anaconda.org/anaconda/repo)<br>

<h2>Conda activate/deactivate</h2>
<h3>Activate:</h3>

`$ conda activate envsname`

<h3>Deactivate:</h3>

`$ conda deactivate`

<h2>Conda update</h2>

`$ conda update -n base -c defaults conda`

</div>