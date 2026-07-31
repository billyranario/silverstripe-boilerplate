<?php

use SilverStripe\Admin\ModelAdmin;

class SponsorAdmin extends ModelAdmin
{
    private static $managed_models = [
        Sponsor::class,
    ];

    private static $menu_title = 'Sponsors';
    private static $url_segment = 'sponsors';
    private static $menu_priority = 12;
    private static $menu_icon_class = 'font-icon-circle-star';
}