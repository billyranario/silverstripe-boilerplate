<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;

class Service extends DataObject {
    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'Text',
        'ButtonText' => 'Varchar',
        'ButtonLink' => 'Varchar',
    ];

    private static $has_one = [
        'ServicesListing' => ServicesListing::class,
        'Icon' => File::class,
        'CardImage' => Image::class
    ];
    
    private static $owns = [
        'Icon',
        'CardImage',
    ];

    public function getCMSFields() {
        $fields = FieldList::create(
            TextField::create('Title', 'Title'),
            TextareaField::create('Content', 'Content'),
            UploadField::create('Icon', 'Icon')
                ->setDescription('Using an SVG file will look the best for the frontend but an image file will work as well.')
                ->setFolderName('Uploads/Icons'),
            UploadField::create('CardImage', 'Card Image')
                ->setFolderName('Uploads/Services'),
            FieldGroup::create(
                'Button Details',
                TextField::create('ButtonText', 'Button Text'),
                TextField::create('ButtonLink', 'Button Link')
            )
        );

        return $fields;
    }

    public function getIconMarkup()
    {
        $icon = $this->Icon();
        $name = $this->Title;
        if ($icon && $icon->exists()) {
            $extension = strtolower($icon->getExtension());
            if ($extension === 'svg') {
                // For SVG files, return the raw file contents
                return $icon->getString();
            } else {
                // For other image types, return an <img> tag
                return '<img src="' . $icon->getURL() . '" alt="' . $name . '">';
            }
        }
        return null;
    }
}