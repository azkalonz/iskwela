<?php
 
if (!function_exists('get_random_color_theme')) {
    /**
     * Returns a random hex color value listed in config
     *
     * @return string a string of hex color value e.g. #7539FF
     *
     * */
    function get_random_color_theme()
    {
        $colors = config("school_hub.colors");
        return $colors[ array_rand($colors) ];
    }
}