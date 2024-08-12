<?php
// app/Helpers/helpers.php
if (!function_exists('userHasPermission')) {
    function userHasPermission($permission) {
        return auth()->check() && auth()->user()->hasPermission($permission);
    }
}
