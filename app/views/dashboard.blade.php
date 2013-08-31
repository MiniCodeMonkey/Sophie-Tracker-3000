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
<div id="success-notification" class="alert alert-info">
    <p class="pull-left lead">
        <strong class="event-type">EventName</strong> event was tracked!
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
<div id="error-notification" class="alert alert-danger">
    <p class="lead">
        <strong class="event-type">EventName</strong> event could not be tracked!
    </p>
</div>

@include('dialogs.feed', compact('timeLevels', 'bottleLevels'))
@include('dialogs.diaper')
@include('dialogs.pump', compact('pumpLevels'))

<div class="page-header">
    <h1><i class="icon-baby-baby"></i> <span>Sophie</span> Tracker 3000</h1>

    <button type="button" class="btn btn-primary btn-lg" id="list-button">
        <i class="icon-list"></i>
    </button>
</div>

<div class="flip"> 
    <div class="card"> 
        <div class="face front">
            @foreach ($eventTypeCategories as $eventTypeCategory => $eventTypes)
                <div class="{{ $eventTypeCategory }}-events">
                    @foreach ($eventTypes as $eventType)
                    <button type="button" data-toggle="modal" data-target="#{{ strtolower($eventType->name) }}Modal" class="btn btn-lg btn-{{ $eventType->color_name }} eventbutton-{{ strtolower($eventType->name) }}">
                        @if ($eventType->is_primary)
                            <span class="badge"></span>
                        @endif

                        <i class="{{ $eventType->icon }}"></i> {{ $eventType->name }}
                    </button>
                    @endforeach
                </div>
            @endforeach
        </div> 
        <div class="face back"> 
            <table class="table table-striped"></table>
        </div> 
    </div> 
</div>

<script src="//code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
{{ script() }}
</body>
</html>