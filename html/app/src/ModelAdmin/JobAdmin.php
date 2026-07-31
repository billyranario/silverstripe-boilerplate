<?php

use SilverStripe\Admin\ModelAdmin;

class JobAdmin extends ModelAdmin
{
    private static $managed_models = [
        Job::class,
    ];

    private static $menu_title = 'Jobs';
    private static $url_segment = 'jobs';
    private static $menu_priority = 16;
    private static $menu_icon_class = 'font-icon-menu-reports';
}