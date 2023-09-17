# Docker Compose for WordPress Demo

Welcome to the "[Docker for WordPress Demo](https://www.meetup.com/wordpress-cambridge/events/295387167/)" event hosted on Zoom and [WordPress Cambridge](https://www.meetup.com/wordpress-cambridge/)! In this online presentation, we will explore ten essential topics related to Docker environments for WordPress.

We will be focusing on deploying our local WordPress Docker environments using [Docker Compose](https://docs.docker.com/compose/).

Each demo directory topic, marked with a number, represents an independent local WordPress project environment. Within each demo directory, you will find a single `docker-compose.yml` configuration file. The initial demo directory, marked as the first topic, contains the essential components needed in a `docker-compose.yml` file to deploy a basic local WordPress environment in Docker. As we move through each numbered demo directory, we will incrementally introduce additional configurations to the `docker-compose.yml` file to enhance the capabilities of the local WordPress Docker environment.

## Topics Covered 📋

1. **Get started**: We'll kick things off with the basics of setting up Docker Compose for WordPress.

2. **Persistent volumes**: Learn how to manage data persistence efficiently within your local Docker containers.

3. **Older version tag**: Discover how to work with specific version tags for WordPress and its dependencies.

4. **Advanced settings**: Dive into advanced configurations to optimize your WordPress Docker environment.

5. **Mailhog**: Explore how to use Mailhog for local email testing and debugging.

6. **PhpMyAdmin**: Explore how to use PhpMyAdmin for seamless WordPress database management.

7. **Existing Themes**: Learn how to integrate existing themes into your local Dockerized WordPress site.

8. **Existing Database**: Explore methods for migrating and working with existing databases locally in Docker.

9. **Vite**: Discover the benefits of using Vite for modern frontend development alongside WordPress.

10. **SSL MKCert**: Secure your local Docker WordPress site with SSL certificates generated using MKCert.

I look forward to guiding you through these topics to enhance your understanding of Docker and WordPress integration. Prepare to be amazed by the power of Docker!

## Install Docker Desktop 🐳

Before diving into these WordPress Docker Compose demos, the initial step is to install the Docker Desktop app on your Mac or Windows system.

- [Download the Docker Desktop application](https://www.docker.com/products/docker-desktop/).

Ensure that you grant all necessary permissions to Docker Desktop during the installation process. 👍🏼

## Please be aware ⚠️

- The commands shown in this README are intended for use in the Mac Terminal. Please be aware that some of these commands may not be compatible with the Windows equivalent of Terminal.

- When pulling Docker `images` from the [Docker Hub](https://hub.docker.com/search?q=) by executing our `docker-compose.yml` configuration files; these `images` are then stored/cached locally. To review all the stored images on your system, you can navigate to the [images tab](https://imgur.com/a/TZEMClJ) within your Docker Desktop application.

- Images and containers are distinct entities; typically, each container configuration is associated with a single image. When deploying a container, it utilizes the specified `image:[version_tag]` to construct the container and stores it locally within the deployed Docker container group.

- It's crucial to remember that when you download Docker `images` using the `:latest` tag, image is then cached locally during the initial pull of the image. This means that in any future uses of the same `:latest` tag for your local Docker Compose configured environments, your container will continue to use the current cached `:latest` tag image. As a result, the version of the `:latest` tag image in your newly deployed local environments may not necessarily match the latest version displayed on the Docker Hub image page, but rather the version stored/cached during the initial or most recent image pull.

- Once container groups in Docker Desktop are completely destroyed, there's no way to recover them. That's why we employ **Persistent Volume** mapping to our `docker-compose.yml` configuration files, ensuring the preservation of essential, reusable data such as `db`, `mu-plugins`, `plugins`, `themes` and `uploads`.

## Executing Docker Compose commands 👨‍💻

When executing [Docker Compose commands](https://docs.docker.com/compose/reference/) on `docker-compose.yml` configuration files. You need to be running the command on the same directory which contains the `docker-compose.yml`.

See below list of commands used in demo, and a few extra handy commands.

- [`docker-compose up`](https://docs.docker.com/engine/reference/commandline/compose_up/) - This will build your containers from your `docker-compose.yml`.

- [`docker-compose up -d`](https://docs.docker.com/engine/reference/commandline/compose_up/#options) - By adding option `-d` to this command detaches the Docker log from being outputted in your terminal, and means you can execute more commands in the same terminal window.

- [`docker-compose down`](https://docs.docker.com/engine/reference/commandline/compose_down/) - This will stop all containers in your `docker-compose.yml` and then delete them immediately once they've stopped. All data will be lost unless you are using persistent volumes!

- [`docker-compose stop`](https://docs.docker.com/engine/reference/commandline/compose_stop/) - This will stop your `docker-compose.yml` containers, but it will not delete them. Data will not be lost as long as your containers still exist in you desktop app. You can deploy new `docker-compose.yml` environments while other environment containers are stopped.

- [`docker-compose rm`](https://docs.docker.com/engine/reference/commandline/rm/) - If you have stopped containers in your Docker Desktop app, you can remove them using this command, or you can manually delete them via the desktop app.

- [`docker-compose restart`](https://docs.docker.com/engine/reference/commandline/restart/) - This will stop your running environment containers and then restart them immediately.

## Updating `wordpress:latest` tag images using CLI ☝️

You can't WordPress via the dashboard like you would normally. Because when you `docker-compose down`, the update will be lost. So next time you `docker-compose up -d` your `wordpress:latest` image, it will just revert back to the current cached version of the image.

To update `wordpress:latest` image in Docker Desktop app, or any other image that uses a `:latest` tag. You simply run this Docker command line. Containers can be running or not running when using these commands. Running environments maybe need to be restarted to show updated image version.

- [`docker pull wordpress`](https://docs.docker.com/engine/reference/commandline/pull/) - This pulls the most recent default WordPress image tag which is `:latest`.
- [`docker pull wordpress:latest`](https://docs.docker.com/engine/reference/commandline/pull/) - This does the same as the above command, but you can adjust the `:[tag_version]` if you want to update or install a specific image tag version.

## Exploring files and directories in running containers 🔎

You can't manually explore container images by Mac Finder or Windows Explorer. But you can explore directories and files in running containers by using command lines interface.

On running container environment after running `docker-compose up -d` command, use these command lines below to explore directories in specific running containers.

1. [`docker ps`](https://docs.docker.com/engine/reference/commandline/ps/) - This will show running containers in your terminal. Each running container will have a unique generated container ID. See expected output example log below...

```lang-bash
CONTAINER ID   IMAGE              COMMAND                  CREATED      STATUS          PORTS                    NAMES
136130b7b6dc   wordpress:latest   "docker-entrypoint.s…"   3 days ago   Up 37 seconds   0.0.0.0:80->80/tcp       2-persistent-volumes-wordpress-1
ded8f29f14c8   mariadb:11.0.2     "docker-entrypoint.s…"   3 days ago   Up 37 seconds   0.0.0.0:3306->3306/tcp   2-persistent-volumes-db-1
```

2. [`docker exec -it [container_id] /bin/bash`](https://docs.docker.com/engine/reference/commandline/exec/) - When you run this command, it will open an interactive Bash session inside the specified Docker container. As per the outputted log for `docker ps` shown above, this example WordPress container ID is `136130b7b6dc`, so the command you would need to run to start a Bash session on this example container would be `docker exec -it 136130b7b6dc /bin/bash`. See expected terminal output below...

```lang-bash
root@136130b7b6dc:/var/www/html# 
```

3. [`ls`](https://ss64.com/bash/ls.html) - This is a Bash command which lists files and directories. Use this after starting your Bash session on container to show all files and directories in outputted directory path. See expected output log below...

```lang-bash
root@136130b7b6dc:/var/www/html# ls
index.php    wp-activate.php     wp-comments-post.php  wp-config.php  wp-includes        wp-login.php     wp-signup.php
license.txt  wp-admin            wp-config-docker.php  wp-content     wp-links-opml.php  wp-mail.php      wp-trackback.php
readme.html  wp-blog-header.php  wp-config-sample.php  wp-cron.php    wp-load.php        wp-settings.php  xmlrpc.php
```

4. [`cd`](https://ss64.com/bash/cd.html) - This is a Bash command which changes directory in your container bash session. For example if you wanted to go to the `themes` directory, you would run this command `cd wp-content/themes`. See expected terminal output below...

```lang-bash
root@136130b7b6dc:/var/www/html# cd wp-content/themes
root@136130b7b6dc:/var/www/html/wp-content/themes# 
```

5. [`cd ..`](https://ss64.com/bash/cd.html) - This change directory command will go up a directory level in your Bash session. For example if you run `cd ../../../../..` from our current example Bashed session location `root@136130b7b6dc:/var/www/html/wp-content/themes#`, this `cd ../../../../..` command would change directory 5 levels up to the root directory of the container. See expected terminal output below...

```lang-bash
root@136130b7b6dc:/# 
```

6. Then we re-use the `ls` command after every use of `cd` command to list files and directories in current Bash session location. For example if we run `ls` at our current example Bash session directory location `root@136130b7b6dc:/#`, see expected output log below...

```lang-bash
root@136130b7b6dc:/# ls
bin  boot  dev  etc  home  lib  lib64  media  mnt  opt  proc  root  run  sbin  srv  sys  tmp  usr  var
```

7. Then just use the `cd` command again to change directory to any of the listed directories (via the `ls` command) to get to the directories you want to go. Just repeat this process to explore directories in your container when running a Bash session in your container.<br/><br/>

8. To view the contents of a file in our container Bash session. You can use the [`cat`](https://ss64.com/bash/cat.html) command. For example if you changed directory from our current example root location `root@136130b7b6dc:/#` using this command `cd usr/local/etc/php/conf.d`, then after using `ls` to list files in the `conf.d` directory, we know the name of the file we want to open. For example, we want to view the file contents of the `error-logging.ini` file listed in the `conf.d` directory. Simply run `cat error-logging.ini` command to show the contents of the file in our terminal log. See output terminal log below... 

```lang-bash
root@136130b7b6dc:/usr/local/etc/php/conf.d# cat error-logging.ini
error_reporting = E_ERROR | E_WARNING | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING | E_RECOVERABLE_ERROR
display_errors = Off
display_startup_errors = Off
log_errors = On
error_log = /dev/stderr
log_errors_max_len = 1024
ignore_repeated_errors = On
ignore_repeated_source = Off
html_errors = Off
```







