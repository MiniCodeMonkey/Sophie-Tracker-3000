<!DOCTYPE html>
<html>
<head>
    <title>Sophie Tracker 3000</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    {{ stylesheet() }}
</head>
<body id="dashboard">
<div id="notification" class="alert alert-info hide">
    <p class="pull-left lead">
        <strong class="event-type">Feed</strong> event was tracked!
    </p>

    <p class="pull-right">
        <button type="button" data-toggle="modal" data-target="#somethingModal" class="btn btn-primary">
            <i class="icon-undo"></i> Undo
        </button>

        <button type="button" data-toggle="modal" data-target="#somethingModal" class="btn btn-primary">
            <i class="icon-plus"></i> Add details
        </button>
    </p>
</div>

@include('dialogs.feed', compact('timeLevels', 'bottleLevels'))

<div class="page-header">
    <h1><i class="icon-baby-baby"></i> <span>Sophie</span> Tracker 3000</h1>
</div>

@foreach ($eventTypeCategories as $eventTypeCategory => $eventTypes)
    <div class="{{ $eventTypeCategory }}-events">
        @foreach ($eventTypes as $eventType)
        <button type="button" data-toggle="modal" data-target="#{{ strtolower($eventType->name) }}Modal" class="btn btn-lg btn-{{ $eventType->color_name }}">
            <i class="{{ $eventType->icon }}"></i> {{ $eventType->name }}
        </button>
        @endforeach
    </div>
@endforeach

<!-- <div class="row">
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>
</div> -->

<script src="//code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
{{ script() }}
</body>
</html>