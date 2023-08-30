<?php
    function dd($value)
    {
        // $args = func_get_args();
        // foreach ($args as $k => $arg) {
        //     echo '<fieldset class="debug">
        //     <legend>' . ($k + 1) . '</legend>';
        //     CVarDumper::dump($arg, 10, true);
        //     echo '</fieldset>';
        // }
        var_dump($value);
        die;
    }
?>