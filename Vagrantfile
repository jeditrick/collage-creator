# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "hashicorp/precise32"
  config.vm.provision :shell, path: "bs.sh"
  config.vm.network "forwarded_port", guest: 80, host: 8888
  config.vm.synced_folder "../uwc8", "/var/www/html/uwc8"
end