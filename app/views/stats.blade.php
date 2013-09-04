@extends('layouts.stats')

@section('content')

<div class="gridster">
    <ul>
        <li data-row="1" data-col="1" data-sizex="2" data-sizey="1" class="box1">
        	<ol class="legend">
			    <li><i class="icon-sign-blank" style="color: rgb(15,87,205);"></i> Total diapers</li>
			    <li><i class="icon-sign-blank" style="color: rgb(151,187,205);"></i> Wet only diapers</li>
			    <li><i class="icon-sign-blank" style="color: rgb(151,100,205);"></i> Dirty only diapers</li>
			    <li><i class="icon-sign-blank" style="color: rgb(151,187,120);"></i> Both wet & dirty diapers</li>
			</ol>

        	<canvas id="diaperchart" width="500" height="180"></canvas>
	    </li>

	    <li data-row="1" data-col="3" data-sizex="1" data-sizey="1" class="box2">
	    </li>

	    <li data-row="1" data-col="4" data-sizex="1" data-sizey="2" class="box3">
	    </li>

	    <li data-row="2" data-col="1" data-sizex="1" data-sizey="1" class="box4">
	    </li>

	    <li data-row="2" data-col="2" data-sizex="2" data-sizey="1" class="box5">
	    </li>
    </ul>
</div>

@stop