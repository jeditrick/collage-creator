#!/usr/bin/env bash
sudo apt-get update
sudo apt-get install -y python-software-properties
sudo add-apt-repository ppa:ondrej/php5
sudo apt-get update

sudo apt-get install -y apache2
sudo apt-get install php5
sudo apt-get install -y libapache2-mod-php5

sudo apt-get install -y curl libcurl3 libcurl3-dev php5-curl

sudo cp /var/www/html/uwc8/000-default.conf /etc/apache2/sites-available/000-default.conf
sudo a2enmod rewrite

sudo service apache2 restart
