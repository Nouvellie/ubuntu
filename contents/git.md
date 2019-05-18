<div>

<h1>GIT</h1>
<h2>Install</h2>

`$ sudo apt install git -y`

<h2>Cloning a repository</h2>
<h4>Git clone:</h4>

`$ git clone https://github.com/Nouvellie/ubuntu`

<h4>Username: </h4>

<p>

*username/email*

</p>

<h4>Password:</h4>

</p>

*password123456*

</p>

<h2>Credential store</h2>

`$ sudo chown -Rc $UID .git/ && git config credential.helper store && git pull`

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
<h4>Ignore only from root folder:</h4>

```
/*.xml
```

<h4>Ignore all the files: (rootfolder/subfolders)</h4>

```
**/*.xml
```

</div>

Turn a GitHub repository containing Sphinx-Gallery scripts into a live notebook repository with [Binder](https://mybinder.org/) and Jupytext by adding only two files to the repo:
- `binder/requirements.txt`, a list of the required packages (including `jupytext`)
- `.jupyter/jupyter_notebook_config.py` with the following contents:
```python
c.NotebookApp.contents_manager_class = "jupytext.TextFileContentsManager"
c.ContentsManager.preferred_jupytext_formats_read = "py:sphinx"
c.ContentsManager.sphinx_convert_rst2md = True
```