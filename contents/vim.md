# VIM
## Install

```sh
$ sudo apt install vim -y
```

## Commands

`:q` To quit. (short for *:quit*)<br>
`:q!` To quit without saving. (short for *:quit!*)<br>
`:wq` To write and quit.<br>
`:wq!` To write and quit even if file has only read permission. (if file does not have write permission: force write)<br>
`:x` To write and quit. (similar to *:wq*, but only write if there are changes)<br>
`:exit` To write and exit. (same as *:x*)<br>
`:qa` To quit all. (short for *:quitall*)<br>
`:cq` To quit without saving and make Vim return non-zero error. (i.e. exit with error)

## Extra

You can also exit Vim directly from **normal mode** by typing *ZZ* to save and quit (same as *:x*) or *ZQ* to just quit (same as *:q!*). (Note that case is important here. *ZZ* and *zz* do not mean the same thing.)

Vim has extensive **help**, that you can access with the *:help* command, where you can find answers to all your questions and a tutorial for beginners.