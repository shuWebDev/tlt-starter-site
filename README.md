# TLT Project Setup

## Pre-Installation
This project utilizes Vagrant and VirtualBox to ensure a consistent development environment across team member's systems. If you do not have either of these applications, please follow the links below to get them installed.

### Installing Vagrant

Installing Vagrant is extremely easy. Head over to the [Vagrant downloads page](https://www.vagrantup.com/downloads.html) and get the appropriate installer or package for your platform. Install the package using standard procedures for your operating system.

If you are unfamiliar with Vagrant or have not used it in a while, take a look at the [Getting Started](https://www.vagrantup.com/docs/getting-started/) documentation. It will help you with the basics and starting up the development environment.

There is also a recommendation to install [Vagrant Manager](http://vagrantmanager.com/). However this is entirely optional since you can use the command line/terminal to manage Vagrant boxes.

### Installing VirtualBox

[VirtualBox](https://www.virtualbox.org/) is a powerful x86 and AMD64/Intel64 [virtualization](https://www.virtualbox.org/wiki/Virtualization) product for enterprise as well as home use. Not only is VirtualBox an extremely feature rich, high performance product for enterprise customers, it is also the only professional solution that is freely available as Open Source Software under the terms of the GNU General Public License (GPL) version 2. See "[About VirtualBox](https://www.virtualbox.org/wiki/VirtualBox)" for an introduction.

## Project Setup

Please make sure that you have changed directory to your project folder. Once you've changed directories, clone the repository with the following:

```shell
$ git clone https://shu-web-development.git.beanstalkapp.com/tlt-projects.git _{project-name}_ # Clones the repository into a directory named "project name".
$ git branch _{project-name}_ # Creates a new branch named "project-name".
$ git checkout _{project-name}_ # Switches to the newly created branch.
```

If you do not already have the ```globals``` repository checked out, clone it also:

```shell
$ git clone https://shu-web-development.git.beanstalkapp.com/tlt-globals.git globals
```

Once you are done cloning both repositories you should have a directory structure similar to the following:

<!-- Create the tree by running `tree -L 3 -d -T 'Projects Directory' -I master` in the Terminal.-->
```
.
├── globals
│   ├── assets
│   │   ├── css
│   │   ├── fonts
│   │   ├── images
│   │   └── js
│   ├── libs
│   ├── vendor
│   │   ├── datatables
│   │   ├── fontawesome
│   │   ├── foundation
│   │   └── jquery
│   └── views
└── master
    ├── assets
    │   ├── css
    │   ├── fonts
    │   ├── img
    │   └── js
    ├── classes
    ├── includes
    └── views
```

## Getting Started

The Vagrant development environment has been configured to synchronize the above directories in the Apache ```www``` directory. Whatever process that is currently used to edit, compile, upload, etc. files should remain the same. Vagrant is only here to provide a consistent development environment across platforms.

> With synced folders, you can continue to use your own editor on your host machine and have the files sync into the guest machine.

The project will be served from ```http://http://192.168.33.10```. Browse to **http://http://192.168.33.10/projects/laptops** to see the changes that have been made.

### Global Includes

The ```globals``` project should have anything that is used throughout the entire server. Vendor related files, style sheets, javascripts, etc. should be found here. There is a helper configuration file, ```/globals/libs/config.php``` that defines global variables that can be used within any site. It should be included in all views that require the "_standard layout_". At the top of your view, simply add the following snippet.

```php
<?php
	require_once('../globals/libs/config.php');
?>
```

#### Included Views

Views that would be globally included are as follows:

```shell
./globals/views
├── footer.tpl # (Contents for the HTML <footer></footer> section)
├── head.tpl # (Contents for the HTML <head></head> section)
├── header.tpl # (Contents for the main HTML <header></header> section)
└── scripts.tpl # (Links to script  tags at the bottom of each view)
```

## Project Development

_TODO_
