# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # Enable Berkshelf support
  config.berkshelf.enabled = true

  # Define VM box to use
  config.vm.box = "precise32"
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"

  # Set share folder
  config.vm.synced_folder "./" , "/var/www/sophietracker/"

  config.vm.provider :digital_ocean do |provider, override|
    override.ssh.private_key_path = "~/.ssh/id_rsa"
    override.vm.box = "digital_ocean"
    override.vm.box_url = "https://github.com/smdahlen/vagrant-digitalocean/raw/master/box/digital_ocean.box"
    override.vm.hostname = "arthur.ninjagiraffes.co.uk"

    # Make sure Chef is installed.
    config.omnibus.chef_version = :latest

    provider.client_id = ENV["DO_CLIENT_ID"]
    provider.api_key = ENV["DO_API_KEY"]
    provider.image = "Ubuntu 12.04.3 x64"
  end

  # Enable and configure chef solo
  config.vm.provision :chef_solo do |chef|
    chef.add_recipe "app::packages"
    chef.add_recipe "app::web_server"
    chef.add_recipe "app::vhost"
    chef.add_recipe "memcached"
    chef.add_recipe "app::db"
    chef.add_recipe "postfix"
    chef.json = {
      :app => {
        # Project name
        :name           => "sophietracker",

        # Name of MySQL database that should be created
        :db_name        => "sophietracker",

        # Optional database dump to be imported when server is provisioned
        # If the file doesn't exist, it is just ignored
        :db_dump        => "/var/www/sophietracker/dump.sql",

        # Server name and alias(es) for Apache vhost
        :server_name    => "arthur.ninjagiraffes.co.uk",
        :server_aliases => [ "www.arthur.ninjagiraffes.co.uk" ],

        # Document root for Apache vhost
        :docroot        => "/var/www/sophietracker/public",

        # General packages
        :packages   => %w{ vim git screen curl },
        
        # PHP packages
        :php_packages   => %w{ php5-mysqlnd php5-curl php5-mcrypt php5-memcached php5-gd }
      },
      :mysql => {
        :server_root_password   => 'root',
        :server_repl_password   => 'root',
        :server_debian_password => 'root',
        :bind_address           => '127.0.0.1',
        :allow_remote_root      => false
      }
    }
  end
end
