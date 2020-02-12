<?php

function since($timestamp, $level=1) {
    global $lang;
    $date = new DateTime();
    $date->setTimestamp($timestamp);
    $date = $date->diff(new DateTime());
    // build array
    $since = array_combine(array('year', 'month', 'day', 'hour', 'minute', 'second'), explode(',', $date->format('%y,%m,%d,%h,%i,%s')));
    // remove empty date values
    $since = array_filter($since);
    // output only the first x date values
    $since = array_slice($since, 0, $level);
    // build string
    $last_key = key(array_slice($since, -1, 1, true));
    $string = '';

    if (time() - $timestamp == 0) {
        $ending = "Just now";
    } else {
        $ending = " ago";
    }

    foreach ($since as $key => $val) {
        // separator
        if ($string) {
            $string .= $key != $last_key ? ', ' : ' ';
        }
        // set plural
        $key .= $val > 1 ? 's' : '';
        // add date value
        $string .= $val . ' ' . $lang[ $key ];
    }
    return $string . $ending;
}

$lang = [
    'second' => 'second',
    'seconds' => 'seconds',
    'minute' => 'minute',
    'minutes' => 'minutes',
    'hour' => 'hour',
    'hours' => 'hours',
    'day' => 'day',
    'days' => 'days',
    'month' => 'month',
    'months' => 'months',
    'year' => 'year',
    'years' => 'years',
    'and' => 'and',
];
