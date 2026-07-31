<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;

class OurValue extends DataObject {
    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'Text',
    ];

    private static $has_one = [
        'OurValues' => OurValuesBlock::class,
        'Icon' => File::class
    ];
    
    private static $owns = [
        'Icon',
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'Content.Summary' => 'Content',
    ];

    public function getCMSFields() {
        $fields = FieldList::create(
            TextField::create('Title', 'Title'),
            TextareaField::create('Content', 'Content')
                ->setDescription('Keep within 100 characters for best results.'),
            UploadField::create('Icon', 'Icon')
                ->setDescription('Using an SVG file will look the best for the frontend but an image file will work as well.')
                ->setFolderName('Uploads/Icons')
        );

        return $fields;
    }

    public function getIconMarkup()
    {
        $icon = $this->Icon();
        if ($icon && $icon->exists()) {
            $extension = strtolower($icon->getExtension());
            if ($extension === 'svg') {
                // For SVG files, return the raw file contents
                return $icon->getString();
            } else {
                // For other image types, return an <img> tag
                return '<img src="' . $icon->getURL() . '" alt="Icon">';
            }
        }
        return null;
    }
}