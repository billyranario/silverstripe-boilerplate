<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;

class PageBanner extends BaseElement {
    private static $singular_name = 'Page Banner';
    private static $plural_name = 'Page Banners';
    private static $table_name = 'PageBanner';
    
    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $has_one = [
        'BackgroundImage' => Image::class,
    ];

    private static $owns = [
        'BackgroundImage',
    ];
    
    public function getType()
    {
        return 'Page Banner';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', UploadField::create('BackgroundImage', 'Background Image'));
        
        return $fields;
    }
}