<div>

<h1>VIM</h1>
<h2>Install</h2>

`$ sudo apt install vim -y`

<h2>Commands</h2>
<h4>Write:</h4>

`:w`<br>
`:w!`

<h4>Exit:</h4>

`:q`<br>
`:q!`

<h4>Both:</h4>

`:wq`<br>
`:wq!`


`:q` to quit (short for :quit)
`:q!` to quit without saving (short for :quit!)<br>
`:wq` to write and quit<br>
`:wq!` to write and quit even if file has only read permission (if file does not have write permission: force write)<br>
`:x` to write and quit (similar to :wq, but only write if there are changes)<br>
`:exit` to write and exit (same as :x)<br>
`:qa` to quit all (short for :quitall)<br>
`:cq` to quit without saving and make Vim return non-zero error (i.e. exit with error)



</div>	