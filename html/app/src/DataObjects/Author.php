<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Controller;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;

class Author extends DataObject {
    private static $db = [
        'Name' => 'Varchar',
    ];

    private static $has_one = [
        'Photo' => Image::class
    ];

    private static $has_many = [
        'BlogPosts' => BlogPost::class,
    ];

    private static $owns = [
        'Photo',
    ];

    private static $summary_fields = [
        'Name' => 'Name',
    ];

    private static $searchable_fields = [
        'Name',
    ];

    public function getLink() {
        return Controller::join_links(
            '/blog',
            'author',
            $this->ID
        );
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Name'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Photo')
            ->setFolderName('/Uploads/Blogs/Authors')
        );

        return $fields;
    }
}