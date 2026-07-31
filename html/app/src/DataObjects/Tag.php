<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Controller;

class Tag extends DataObject
{
    private static $db = [
        'Name' => 'Varchar'
    ];

    private static $belongs_many_many = [
        'BlogPosts' => BlogPost::class,
    ];

    public function getLink() {
        return Controller::join_links(
            '/blog',
            'tag',
            $this->ID
        );
    }
}