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

### Visualizing collected data
With all the collected data it would be fun to make some visualizations and calculations that can be displayed in the browser. This has been realized by building a block-based dashboard (Yes, I love the word "dashboard"!).

The overall look and feel has been heavily inspired by the awesome [Dashing dashboard](http://shopify.github.io/dashing/), open sourced by [http://www.shopify.com](Shopify).

![Statistics dashboard](http://i.imgur.com/iKccwAs.jpg "Statistics dashboard")

In the top left corner you'll find a "Sophie" profile box, it indicates her current age and animates some "Z"'s if she's sleeping.

Yep, the "progress bars" are totally inspired by [The Sims](http://www.thesims.com) and is mostly for fun. The hygiene goes down in relation to the time of her last bath, the hunger level goes down in relation to the time of her last feeding (amount/duration should really have had been taking into relation as well). The bladder bar correlates to latest diaper change and the energy bar goes down when she hasn't been sleeping for a while.

![Sleeping animation](http://i.imgur.com/hADESnW.jpg)

The diaper graph should explain itself, this is a look into diapers changed the last week (including today). Next to it, we have diaper statistics. This is actually really usefull, by tracking when we buy new diapers and looking at the average amount of diapers changed per day it is possible to estimate when we will run out. Later it would be cool to supplement this with automatically purchasing diapers on Amazon when we're about to run out.

Projected time until next feeding is again totally unscientific, it is based on the average duration between feedings the last 48 hours. Amount/duration of feedings are currently not beeing taken into consideration -- but they should eventually be.

The "today" bar shows a timeline of all events today. This gives a very interesting look into how much she is sleeping and when she seems to need diaper changes many of the events are not tracked with a duration (e.g. diaper changes, baths, etc.) so for some of them a length has been estimated to provide a better visual representation.

The timeline is currently using a default [Bootstrap](http://getbootstrap.com) progress bar which doesn't really seem like the best solution in terms of colors and style, so it would be great to update this later at some point.

Overall, the statistics dashboard has been designed in such a way that we are able to share interesting statistics with the whole interwebs without getting to intimate and personal with our collected data, this is why some key things might have been left out.

**Disclaimer:** The statistics are only as accurate as our tracking, so if it says that our daughter hasn't been fed for two days, it's probably because of a tracking error and not because we haven't been taking care of our little girl ;)

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
