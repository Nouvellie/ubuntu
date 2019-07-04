# PHYSIONET
## Pre-install 
#### Software development tools and HTTP client library, either libcurl (preferred):

- Install:

```sh
$ sudo apt update -y
$ sudo apt install build-essential -y
$ sudo apt install gcc libcurl4-openssl-dev libexpat1-dev -y
```

- Check installed versions:

```sh
$ gcc --version
$ make --version
```

#### Download WTDB tar and install: (Parse SCP)

```sh
$ curl -O https://physionet.org/physiotools/wfdb.tar.gz
$ tar xvf wfdb.tar.gz
$ sudo rm -rf wfdb.tar.gz
$ cd wfdb-10.m.n
$ sudo ./configure
$ sudo make install
$ make check
```

#### Check Parse SCP:

```sh
$ which parsescp
```