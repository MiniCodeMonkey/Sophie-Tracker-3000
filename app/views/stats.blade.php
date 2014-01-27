@extends('layouts.stats')

@section('content')

<div class="gridster">
    <ul>
    	<li data-row="1" data-col="1" data-sizex="2" data-sizey="1" class="box-profile">
	    	<h1>Baby {{ Config::get('sophietracker.name') }}</h1>
	    	<div class="pull-left info">
	    		<div class="sleep-items hide">    
	                <div class="sleep">Z</div>
	                <div class="sleep">Z</div>
	                <div class="sleep">z</div>
	                <div class="sleep">Z</div>
	            </div>

		    	<img src="/img/{{ Str::slug(Config::get('sophietracker.name')) }}.jpg" alt="{{ Config::get('sophietracker.name') }}" class="img-circle">
		    	<h1 class="profile-age"></h1>
		    </div>

		    <div class="pull-left status-bars">
		    	Hygiene
		    	<div class="progress progress-striped">
					<div class="progress-bar progress-bar-success profile-hygiene" role="progressbar" style="width: 0%;"></div>
				</div>

				Hunger
		    	<div class="progress progress-striped">
					<div class="progress-bar progress-bar-success profile-hunger" role="progressbar" style="width: 0%;"></div>
				</div>

				Bladder
		    	<div class="progress progress-striped">
					<div class="progress-bar progress-bar-success profile-bladder" role="progressbar" style="width: 0%;"></div>
				</div>

				Energy
		    	<div class="progress progress-striped">
					<div class="progress-bar progress-bar-success profile-energy" role="progressbar" style="width: 0%;"></div>
				</div>
			</div>
	    </li>

        <li data-row="2" data-col="1" data-sizex="2" data-sizey="1" class="box-diaper-chart">
        	<ol class="legend">
			    <li><i class="icon-sign-blank" style="color: rgb(255,255,255);"></i> Total diapers</li>
			    <li><i class="icon-sign-blank" style="color: rgb(200,200,200);"></i> Wet only</li>
			    <li><i class="icon-sign-blank" style="color: rgb(110,110,110);"></i> Dirty only</li>
			    <li><i class="icon-sign-blank" style="color: rgb(50,50,50);"></i> Both wet &amp; dirty</li>
			</ol>

        	<canvas id="diaperchart" width="520" height="210"></canvas>
	    </li>

	    <li data-row="1" data-col="3" data-sizex="1" data-sizey="2" class="box-diaper-stats">
	    	<h1>Diapers left</h1>
	    	<h2 class="diapers-available">&mdash;</h2>

	    	<h1>Will run out in</h1>
	    	<h2 class="diapers-run-out-days">&mdash;<span>days</span></h2>
	    	<h3 class="diapers-run-out-date">&mdash;</h3>

	    	<h1>Average</h1>
	    	<h2 class="diapers-average">&mdash;</h2>
	    	<h3>diapers per day</h3>
	    </li>

	    <li data-row="1" data-col="4" data-sizex="1" data-sizey="1" class="box-feed-time">
	    	<h1>Projected time until next feeding</h1>
	    	<h2 class="feed-time-next"></h2>
	    </li>

	    <li data-row="2" data-col="4" data-sizex="1" data-sizey="1" class="box-last-fed">
	    	<i class="last-fed-icon icon-tint"></i>
	    	<h1>Last fed</h1>
	    	<h1 class="last-fed-time"></h1>
	    	<h2 class="last-fed-amount"></h2>
	    	<h1 class="last-fed-type"></h1>
	    </li>

	    <li data-row="3" data-col="1" data-sizex="4" data-sizey="1" class="box-day-chart">
	    	<h1>Today</h1>

			<ol class="legend clearfix">
				<li><i class="icon-sign-blank text-info"></i> Feed or Bath</li>
				<li><i class="icon-sign-blank text-success"></i> Diaper</li>
				<li><i class="icon-sign-blank text-warning"></i> Sleep or Activity</li>
				<li><i class="icon-sign-blank text-danger"></i> Medicine</li>
			</ol>

			<ol class="legend time clearfix">
			    <li>Midnight</li>
			    <li>8am</li>
			    <li>Noon</li>
			    <li>8pm</li>
			</ol>

	    	<div class="progress"></div>
	    	<p class="chart-description">Click on a segment to get detailed information</p>
	    </li>

	    <li data-row="1" data-col="5" data-sizex="1" data-sizey="3" class="box-info">
	    	<p>This is live data tracked using our "Sophie Tracker 3000", we are tracking diaper changes, feedings, baths, sleep, activites, medicine, doctor visits, buying diapers and more using a touch-screen device mounted in Sophie's nursery as well as from our phones when we're out.</p>
	    	<p>You can read more below or checkout the source code for this dashboard as well as the Sophie Tracker on GitHub.</p>
	    	<p>
	    		<a href="https://github.com/MiniCodeMonkey/Sophie-Tracker-3000" target="_blank"><i class="icon-github icon-4x"></i></a>
	    		<a href="https://twitter.com/MathiasHansen" target="_blank"><i class="icon-twitter icon-4x"></i></a>
	    	</p>
	    </li>
    </ul>
</div>

@stop