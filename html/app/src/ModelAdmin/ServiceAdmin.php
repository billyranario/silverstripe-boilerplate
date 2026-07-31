<?php

use SilverStripe\Admin\ModelAdmin;

class ServiceAdmin extends ModelAdmin
{
    private static $managed_models = [
        Service::class,
    ];

    private static $menu_title = 'Services';
    private static $url_segment = 'services';
    private static $menu_priority = 18;
    private static $menu_icon_class = 'font-icon-info-circled';
}