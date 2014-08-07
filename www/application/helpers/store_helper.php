<?php

    /**
     * [prettyTime takes a time stamp and outputs a string that says the timestamp was "x minutes/days/years ago"
     *     input timestamp must be in the past]
     * @param  [type] $timestamp [description]
     * @return [type]            [description]
     */
    function prettyTime($timestamp)
    {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");
        $difference = time() - $timestamp;

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);
        if($difference != 1) $periods[$j].= "s";

        return $difference . " " . $periods[$j] . " ago";
    }

    /**
     * [random_password generates a random three letter password that does not contain 1, i/I, 0, or o/O to avoid confusion]
     * @param  [type] $size [default is six]
     * @return [type]       [description]
     */
    function random_password($size = null)
    {
        if (!$size) {
            $size = 6;
        }

        $chars = array("a", "b", "c", "d", "e", "f", "g", "h", "p", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                        "2", "3", "4", "5", "6", "7", "8", "9",
                        "A", "B", "C", "D", "E", "F", "G", "H", "P", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
                        "2", "3", "4", "5", "6", "7", "8", "9");

        $random_password = "";
        for($i = 0; $i < $size; $i++) {
            $random_password .= $chars[rand(0, count($chars) - 1)]; # -1 because count starts at 1
        }

        return $random_password;
    }
