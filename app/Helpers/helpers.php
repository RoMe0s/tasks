<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 07.05.17
 * Time: 22:48
 */

if(! function_exists('check_current_url')) {

    function check_current_url($url) {

        return request()->url() == $url ? "" : "href=\"$url\"";

    }

}