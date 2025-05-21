<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\DataExtension;

/**
 * CustomMetaField extension: add SEO and social meta fields to any DataObject, Page, or SiteConfig.
 */
class CustomMetaField extends DataExtension
{
    private static $db = [
        'MetaTitle'       => 'Varchar(255)',
        'MetaKeywords'    => 'Varchar(255)',
        'MetaCustomTags'  => 'Text',
        'FBTitle'         => 'Varchar(255)',
        'FBDescription'   => 'Text',
        'TwitterTitle'    => 'Varchar(255)',
        'TwitterDescription' => 'Text',
    ];

    private static $has_one = [
        'FBImage'         => Image::class,
        'TwitterImage'    => Image::class,
    ];

    private static $owns = [
        'FBImage',
        'TwitterImage',
    ];

    /**
     * Add fields to the CMS under a toggle composite in the Main tab
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName([
            'MetaTitle',
            'MetaKeywords',
            'MetaCustomTags',
            'FBTitle',
            'FBDescription',
            'FBImage',
            'TwitterTitle',
            'TwitterDescription',
            'TwitterImage'
        ]);

        $fields->addFieldsToTab('Root.Metafields', [
            ToggleCompositeField::create(
                'GeneralMetaToggle',
                'General Meta',
                [
                    TextField::create('MetaTitle',    'Meta Title'),
                    TextField::create('MetaKeywords', 'Meta Keywords'),
                    TextareaField::create('MetaCustomTags', 'Meta Tags (comma-separated)')
                ]
            ),
            ToggleCompositeField::create(
                'FacebookMetaToggle',
                'Facebook Meta',
                [
                    TextField::create('FBTitle',        'Facebook Title'),
                    TextareaField::create('FBDescription', 'Facebook Description'),
                    UploadField::create('FBImage',      'Facebook Image')
                        ->setFolderName('MetaImages')
                        ->setAllowedFileCategories('image')
                ]
            ),
            ToggleCompositeField::create(
                'TwitterMetaToggle',
                'Twitter Meta',
                [
                    TextField::create('TwitterTitle',        'Twitter Title'),
                    TextareaField::create('TwitterDescription', 'Twitter Description'),
                    UploadField::create('TwitterImage',      'Twitter Image')
                        ->setFolderName('MetaImages')
                        ->setAllowedFileCategories('image')
                ]
            ),
        ]);
    }
}
