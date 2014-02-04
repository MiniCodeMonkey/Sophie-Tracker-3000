## Sophie Tracker 3000

![Statistics dashboard](http://i.imgur.com/UocxRcI.jpg)

Sophie Tracker 3000 is a completely unscientific approach to tracking events in the life of our newborn daughter.

It was quickly thrown together in the few hours of downtime we had in the first few weeks and is optimized to be used on our smartphones as well as a small Android tablet wall-mounted in the nursery.

It allows us to track feedings, diaper changes, sleep, activities, medicine intakes, baths, supplies and more.

It has been designed specifically to require as few finger taps as possible while still allowing us to record a good amount of details for each event.

The app consists of two parts: A tracking dashboard optimized for touch devices and a statistics dashboard to visualize and show results of calculations based on the collected data.

### Event tracking

To ease the process of tracking diaper changes and other frequent events, I wall-mounted a Nexus 7 tablet above the changing table using industrial strength velcro tape (this stuff is amazing).

It can easily be moved to other rooms where the velcro tape has been mounted and with a couple of cheap micro usb chargers bought off of Amazon and plugged in near the wall mounts, the tablet is able to always have plenty of power.
![Mounting the tablet](http://i.imgur.com/UAOMHMV.jpg "Mounting the tablet")

![Tablet mounted on the wall](http://i.imgur.com/3ZrKWS4.jpg "Tablet mounted on the wall")

The tablet has been configured barebones with two apps: [Screen Timeout Toggle](https://play.google.com/store/apps/details?id=com.chemdroid.screentimeouttoggle) to ensure that the scren always stays on and [Browser Kiosk Launcher](https://play.google.com/store/apps/details?id=com.droidhoster.launcher) that replaces the Android launcher with a simple app that displays a full screen browser pointing to the Sophie Tracker website.

There's still a few quirks with the Browser Kiosk Launcher that needs to be worked out, but it works well for now.

Primary events are shown on the first line and secondary events are shown on the second line, here's an example of how we track diaper changes:

![Tracking diaper changes](http://i.imgur.com/WGNcdim.jpg "Tracking diaper changes")

Tapping the "list" button in the top right corner, flips the screen over to provide a simple overview of the recently collected data.

![List view](http://i.imgur.com/7h67b8P.jpg "List view")

### Visualizing collected data
With all the collected data it would be fun to make some visualizations and calculations that can be displayed in the browser. This has been realized by building a block-based dashboard (Yes, I love the word "dashboard"!).

The overall look and feel has been heavily inspired by the awesome [Dashing dashboard](http://shopify.github.io/dashing/), open sourced by [http://www.shopify.com](Shopify).

In the top left corner you'll find a "Sophie" profile box, it indicates her current age and animates some "Z"'s if she's sleeping.

![Sleeping animation](http://i.imgur.com/hADESnW.jpg)

Yep, the "progress bars" are totally inspired by [The Sims](http://www.thesims.com) and is mostly for fun. The hygiene bar goes down in relation to the time of her last bath, the hunger level goes down in relation to the time of her last feeding (amount/duration should really have had been taking into relation as well but it currently isn't). The bladder bar correlates to latest diaper change and the energy bar goes down when she hasn't been sleeping for a while.

The diaper graph should explain itself, this is a look into diapers changed the last week (including today). Next to it, we have diaper statistics. This is actually really usefull, by tracking when we buy new diapers and looking at the average amount of diapers changed per day it is possible to estimate when we will run out. Later it would be cool to supplement this with automatically purchasing diapers on Amazon when we're about to run out.

Projected time until next feeding is again totally unscientific, it is based on the average duration between feedings the last 48 hours. Amount/duration of feedings are currently not beeing taken into consideration -- but they should eventually be.

The "today" bar shows a timeline of all events today. This gives a very interesting look into how much she is sleeping and when she seems to need diaper changes many of the events are not tracked with a duration (e.g. diaper changes, baths, etc.) so for some of them a length has been estimated to provide a better visual representation.

The timeline is currently using a default [Bootstrap](http://getbootstrap.com) progress bar which doesn't really seem like the best solution in terms of colors and style, so it would be great to update this later at some point.

Overall, the statistics dashboard has been designed in such a way that we are able to share interesting statistics with the whole interwebs without getting to intimate and personal with our collected data, this is why some key things might have been left out.

The statistics are of course only as accurate as our tracking efforts.

### So, why is all this important?
Tracking all these events can be really practical (i.e. knowing when to buy diapers), but there is also a more serious reason behind tracking all these things.

Because we're collecting data on all of her activity by the minute, we can ask our pediatrician if the number of diapers she's using or amount she's eating is normal. (Can you tell we're anxious new parents?) And, hopefully in a few more weeks, we'll be able to extrapolate trends from her nap habits so we can start to have something resembling a regular routine.

Also we're obsessive compulsive and use [Harvest](http
://harvestapp.com) to optimize our work habits. Why not have Harvest for babies?

### Feedback
Do you have any cool ideas of how we can visualize the collected data? Can you build data models to improve some of the prediction? (some of my current approaches are very naive) Is there anything else you would like to see done?

Please [create an issue](https://github.com/MiniCodeMonkey/Sophie-Tracker-3000/issues/new) or [fork and make a pull request](https://help.github.com/articles/using-pull-requests)!

### Installing
So, know you want to install Sophie Tracker yourself? Sweet! That's probably the best compliment I could ever get.

Sophie Tracker 3000 is a PHP web app built on the amazing [Laravel 4](http://laravel.com) framework and uses Vagrant/Chef for the development environment.

Here's how to get started:

The development environment requires [VirtualBox](https://www.virtualbox.org), [Vagrant 1.2.x](http://vagrantup.com), [Berkshelf](http://berkshelf.com), [vagrant-berkshelf](https://github.com/riotgames/vagrant-berkshelf) and [vagrant-hostmanager](https://github.com/smdahlen/vagrant-hostmanager).
The development environment can then be started with `vagrant up`, see [Vagrant LAMP Stack](https://github.com/MiniCodeMonkey/Vagrant-LAMP-Stack) for additional instructions.

To install third-party dependencies, [Composer](http://getcomposer.org) is required.

**Clone repository**

	# git clone git@github.com:MiniCodeMonkey/Sophie-Tracker-3000.git

You can now edit `app/config/dev/database.php` and optionally copy it to `app/config/database.php` for a production environment.

**Install third party dependencies**

	# composer install --dev

**Run database migrations and seed default content**

	# php artisan migrate --seed

### Deploying to Digital Ocean

The Vagrantfile is configured to deploy to Digital Ocean using the `vagrant-digitalocean` plugin.

**Configure your credentials**

  # export DO_API_KEY="YOUR KEY"
  # export DO_CLIENT_ID="YOUR CLIENT ID"

**Set the hostname**
  
Edit Vagrantfile, and replace `arthur.ninjagiraffes.co.uk` with your own hostname.

**Build the Droplet**

  # vagrant up

**TEMPORARY: Change permissions, and install**

On the first run you'll need to log in to your droplet, install dependencies, and set some permissions.

This is probably hideously insecure as well, its been a long time since I did PHP.

  # ssh $HOSTNAME -lroot
  # cd /var/www/sophietracker
  # composer install # You may need to resize to do this without running out of memory.
  # cp app/config/dev/database.php app/config/database.php
  # php artisan migrate --seed
  # chown -R www-data /var/www/sophietracker
