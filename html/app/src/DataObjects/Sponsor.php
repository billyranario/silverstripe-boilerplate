<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;

class Sponsor extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Link' => 'Varchar',
    ];

    private static $has_one = [
        'Logo' => Image::class,
    ];
    
    private static $summary_fields = [
        'Name' => 'Name',
        'Link' => 'Link',
    ];

    private static $owns = [
        'Logo',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Name'));
        $fields->addFieldToTab('Root.Main', TextField::create('Link'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Logo')->setFolderName('Uploads/Sponsors'));

        return $fields;
    }
}