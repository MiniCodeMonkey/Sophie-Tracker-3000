## Sophie Tracker 3000

Sophie Tracker 3000 is a completely unscientific approach to tracking events in the life of our newborn daughter.

It was quickly thrown together in the few hours of downtime we had in the first few weeks and is optimized to be used on our iPhones as well as small Android tablet wall-mounted in the nursery.

The web app allows us to track feedings, diaper changes, sleep, activities, medicine intakes, baths, supplies and more.

It has been designed specifically to require as few "taps" as possible while still recording a good amount of details for each event.

The app consists of two parts: A tracking dashboard optimized for touch devices and a statistics dashboard to visualize and show results of calculations based on the collected data.

### Tracking events

To ease the process of tracking diaper changes and other frequent events, I wall-mounted a Nexus 7 tablet above the changing table using industrial strength velcro tape (this stuff is amazing).

It can easily be moved to other rooms where the velcro tape has been mounted and with a couple of cheap micro usb chargers bought off of Amazon and plugged in near the wall mounts, the tablet is able to always have plenty of power.
![Mounting the tablet](http://i.imgur.com/UAOMHMV.jpg "Mounting the tablet")

The tablet has been configured barebones with two apps: [Screen Timeout Toggle](https://play.google.com/store/apps/details?id=com.chemdroid.screentimeouttoggle) to ensure that the scren always stays on and [Browser Kiosk Launcher](https://play.google.com/store/apps/details?id=com.droidhoster.launcher) that replaces the Android launcher with a simple app that displays a full screen browser pointing to the Sophie Tracker website. There's still a few quirks with the Browser Kiosk Launcher that needs to be worked out, but it works well for now.

![Tablet mounted on the wall](http://i.imgur.com/3ZrKWS4.jpg "Tablet mounted on the wall")

### Installing
The development environment requires [VirtualBox](https://www.virtualbox.org), [Vagrant 1.2.x](http://vagrantup.com), [Berkshelf](http://berkshelf.com), [vagrant-berkshelf](https://github.com/riotgames/vagrant-berkshelf) and [vagrant-hostmanager](https://github.com/smdahlen/vagrant-hostmanager).
The development environment can then be started with `vagrant up`, see [Vagrant LAMP Stack](https://github.com/MiniCodeMonkey/Vagrant-LAMP-Stack) for additional instructions.

To install third-party dependencies, [Composer](http://getcomposer.org/) is required.

**Clone repository**

	# git clone git@github.com:MiniCodeMonkey/Sophie-Tracker-3000.git

You can now edit `app/config/dev/database.php` and optionally copy it to `app/config/database.php` for a production environment.

**Install third party dependencies**

	# composer install --dev

**Run database migrations and seed default content**

	# php artisan migrate --seed
