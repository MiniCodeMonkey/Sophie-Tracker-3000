<?php
function formatDateDiff($start, $end = null) { 
    if (!($start instanceof DateTime)) { 
        $start = new DateTime($start); 
    } 
    
    if ($end === null) { 
        $end = new DateTime(); 
    } 
    
    if (!($end instanceof DateTime)) { 
        $end = new DateTime($start); 
    } 
    
    $interval = $end->diff($start); 
    $format = array(); 
    if ($interval->y !== 0) { 
        $format[] = "%y y"; 
    } 
    if ($interval->m !== 0) { 
        $format[] = "%m m"; 
    } 
    if ($interval->d !== 0) { 
        $format[] = "%d d"; 
    } 
    if ($interval->h !== 0) { 
        $format[] = "%h h"; 
    } 
    if ($interval->i !== 0) { 
        $format[] = "%i min."; 
    }
    if ($interval->s !== 0 && !count($format)) {
        return "less than a minute ago";
    } 
    
    // We use the two biggest parts 
    if (count($format) > 1) { 
        $format = array_shift($format)." and ".array_shift($format); 
    } else { 
        $format = array_pop($format); 
    } 
    
    // Prepend 'since ' or whatever you like 
    return $interval->format($format) . ' ago'; 
}

function isAssoc($arr)
{
    return array_keys($arr) !== range(0, count($arr) - 1);
}

function spinner($step = 5, $default = 5, $unitName = 'ounces') {
    $buttonLeft = '<button type="button" class="btn btn-success spinner-left">' . "\n" .
        "\t" . '<i class="icon-caret-left"></i>' . "\n" .
    '</button>';

    $buttonRight = '<button type="button" class="btn btn-success spinner-right">' . "\n" .
        "\t" . '<i class="icon-caret-right"></i>' . "\n" .
    '</button>';

    $amount = '<span class="amount">'. $default .'</span>';

    $unit = '<span class="unit">'. $unitName .'</span>';

    return '<div class="spinner" data-step="'. $step .'" data-value="'. $default .'">' . "\n" .
            $buttonLeft . "\n" .
            $amount . "\n" .
            $unit . "\n" .
            $buttonRight . "\n" .
        '</div>';
}