#!/usr/bin/env php
<?php

$me = trim(shell_exec("whoami"));
if ($me !== "root") {
	printf("You need to run this script as root!\n");
	exit(1);
}

require __DIR__."/config/init.php";

/**
 * @see https://secure.php.net/manual/en/function.proc-open.php
 */

if (!file_exists(STORAGE_PATH."/tmp/composer.phar")) {
	printf("Downloading composer.phar...\n");
	if (copy("https://getcomposer.org/composer.phar", STORAGE_PATH."/tmp/composer.phar")) {
		printf("Download completed!\n");
	}
}

if (trim(shell_exec(PIP_BINARY." --version || echo fail")) === "fail") {
  printf("Downloading pip3...\n");
  if (copy("https://bootstrap.pypa.io/get-pip.py", STORAGE_PATH."/tmp/get-pip.py")) {
    installPip();
    if (trim(shell_exec(PIP_BINARY." --version || echo fail")) === "fail") {
      printf("Please install python-pip3 to continue!\n");
      exit(1);
    }
  } else {
    printf("Please install python-pip3 to continue!\n");
    exit(1);
  }
}


$descriptorspec = array(
   0 => array("pipe", "r"),  
   1 => array("file", "php://stdout", "w+"),
   2 => array("file", "php://stdout", "w+")
);

unset($_SERVER["argv"]);

$cwd = __DIR__;
$process = proc_open(PHP_BINARY." ".STORAGE_PATH."/tmp/composer.phar install -vvv", $descriptorspec, $pipes, $cwd, $_SERVER);
if (is_resource($process)) {
    fclose($pipes[0]);
    $return_value = proc_close($process);
}

$descriptorspec = array(
   0 => array("pipe", "r"),
   1 => array("file", "php://stdout", "w+"),
   2 => array("file", "php://stdout", "w+")
);

unset($_SERVER["argv"]);

$cwd = __DIR__;
$process = proc_open(PIP_BINARY." install -r ".BASEPATH."/requirements.txt", $descriptorspec, $pipes, $cwd, $_SERVER);
if (is_resource($process)) {
    fclose($pipes[0]);
    $return_value = proc_close($process);
}

installNginx();

function installPip()
{
  $descriptorspec = array(
     0 => array("pipe", "r"),
     1 => array("file", "php://stdout", "w+"),
     2 => array("file", "php://stdout", "w+")
  );

  unset($_SERVER["argv"]);

  $process = proc_open("python3 ".STORAGE_PATH."/tmp/get-pip.py --force-reinstall", $descriptorspec, $pipes, $cwd, $_SERVER);
  if (is_resource($process)) {
      fclose($pipes[0]);
      $return_value = proc_close($process);
  }
}

function installNginx()
{
  $descriptorspec = array(
     0 => array("pipe", "r"),
     1 => array("file", "php://stdout", "w+"),
     2 => array("file", "php://stdout", "w+")
  );

  unset($_SERVER["argv"]);

  $cwd = __DIR__;
  $process = proc_open("apt install nginx -y", $descriptorspec, $pipes, $cwd, $_SERVER);
  if (is_resource($process)) {
      fclose($pipes[0]);
      $return_value = proc_close($process);
  }
}



file_put_contents("/etc/nginx/sites-available/telegram_monitor", 'server {
  listen 4444;
  
  root /var/www/telegram_monitor/public;
  error_log /var/www/telegram_monitor/nginx_error.log;
  access_log /var/www/telegram_monitor/nginx_access.log;

  index index.php;

  location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/run/php/php7.2-fpm.sock;
  }
}');

print shell_exec("ln -svf /etc/nginx/sites-available/telegram_monitor /etc/nginx/sites-enabled/telegram_monitor");
print shell_exec("ln -svf ".__DIR__." /var/www/telegram_monitor");
print shell_exec("service nginx restart");
print shell_exec("systemctl restart nginx");
