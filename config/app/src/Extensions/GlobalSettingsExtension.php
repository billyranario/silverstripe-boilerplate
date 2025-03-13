<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;

class GlobalSettingsExtension extends Extension
{
    private static $db = [
        'Phone' => 'Varchar(50)',
        'Mobile' => 'Varchar(50)',
        'Email' => 'Varchar(100)',
        'Address' => 'Text',
    ];

    private static $many_many = [
        'FooterMenu' => SiteTree::class,
    ];

    private static $has_one = [
        'Logo' => Image::class,
        'Favicon' => Image::class
    ];

    private static $owns = [
        'Logo',
        'Favicon'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('Tagline');
        $fields->addFieldToTab('Root.Main', TextField::create('Phone', 'Phone'));
        $fields->addFieldToTab('Root.Main', TextField::create('Mobile', 'Mobile'));
        $fields->addFieldToTab('Root.Main', TextField::create('Email', 'Email'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Address', 'Address'));

        $fields->addFieldToTab('Root.Main', UploadField::create('Logo', 'Logo')
            ->setFolderName('Logos')
            ->setAllowedFileCategories('image'));

        $fields->addFieldToTab('Root.Main', UploadField::create('Favicon', 'Favicon')
            ->setFolderName('Favicons')
            ->setAllowedFileCategories('image'));
    }

    public function onAfterWrite(): void
    {
        foreach (['Logo', 'Favicon'] as $imageField) {
            $image = $this->owner->{$imageField}();
            if ($image && $image->isInDB() && $image->isOnDraft()) {
                $image->publishSingle();
            }
        }
    }
}
