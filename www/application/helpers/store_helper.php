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

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);
        if ($difference != 1) {
            $periods[$j] .= "s";
        }

        return $difference . " " . $periods[$j] . " ago";
    }

    /**
     * [generateRandPassword generates a random three letter password that does not contain 1, i/I, 0, or o/O to avoid confusion]
     * @param  [type] $size [default is six]
     * @return [type]       [description]
     */
    function generateRandPassword($size = null)
    {
        if (!$size) {
            $size = 6;
        }

        $chars = array("a", "b", "c", "d", "e", "f", "g", "h", "p", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                        "2", "3", "4", "5", "6", "7", "8", "9",
                        "A", "B", "C", "D", "E", "F", "G", "H", "P", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
                        "2", "3", "4", "5", "6", "7", "8", "9");

        $rand_pw = "";
        for ($i = 0; $i < $size; $i++) {
            $rand_pw .= $chars[rand(0, count($chars) - 1)]; # -1 because count starts at 1
        }

        return $rand_pw;
    }

    /**
     * [verifyEmail description]
     * @param  [string] $email [the email being verified]
     * @return [bool]        [true if the email is valid, false if it is not]
     */
    function verifyEmail($email)
    {
        $CI = get_instance();
        $CI->load->helper('email');
        return valid_email($email);
    }


    /**
     * [ex pre print dies the input array or object]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    function ex($array)
    {
        die("<pre>" . print_r($array, true) . "</pre>");
    }


    /**
     * [money_format money_format doesn't work on windows systems]
     * @param  [type] $format
     * @param  [type] $number
     * @return [type]
     */
    function myMoneyFormat($number)
    {
        return number_format($number, 2);
    }
