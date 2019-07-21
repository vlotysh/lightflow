<?php

if (! function_exists('dd')) {
    function dd(...$vars)
    {
        $output = [];
        $debugTrace = debug_backtrace();
        $executedFile = $debugTrace[0]['file'] . ':' . $debugTrace[0]['line'];

        $output[] = "<b>Executed file {$executedFile}</b>";
        $output[] = "<hr>";

        foreach ($vars as $var) {
            $output[] = "<pre>".var_export($var, true) . "</pre>";
        }
        $output[] = "<hr>";
        foreach ($debugTrace as $trace) {
            $output[] = "File  <b>{$trace['file']}</b>: Line 
                        <b>{$trace['line']} </b>, 
                        function <b>{$trace['function']}()</b>,";
        }

        echo implode('<br>', $output);
        die(0);
    }
};
