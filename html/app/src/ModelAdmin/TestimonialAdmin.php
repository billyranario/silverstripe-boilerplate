<?php

use SilverStripe\Admin\ModelAdmin;

class TestimonialAdmin extends ModelAdmin
{
    private static $managed_models = [
        Testimonial::class,
    ];

    private static $url_segment = 'testimonials';
    private static $menu_title = 'Testimonials';
    private static $menu_icon_class = 'font-icon-comment';
    private static $menu_priority = 15;
}