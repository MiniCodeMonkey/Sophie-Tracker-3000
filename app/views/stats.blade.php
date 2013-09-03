@extends('layouts.master')

@section('content')
<canvas id="diaperchart" width="800" height="400"></canvas>

<ul>
    <li><i class="icon-sign-blank" style="color: rgb(151,187,205);"></i> Wet</li>
    <li><i class="icon-sign-blank" style="color: rgb(151,100,205);"></i> Dirty</li>
    <li><i class="icon-sign-blank" style="color: rgb(151,187,120);"></i> Both</li>
</ul>
@stop