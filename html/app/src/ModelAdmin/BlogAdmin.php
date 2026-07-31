<?php

use SilverStripe\Admin\ModelAdmin;

class BlogAdmin extends ModelAdmin {
    private static $managed_models = [
        BlogPost::class,
        Category::class,
        Author::class,
        Tag::class,
    ];
    private static $menu_title = 'Blogs';
    private static $url_segment = 'blogs';
    private static $menu_icon_class = 'font-icon-p-post';
    private static $menu_priority = 17;

}