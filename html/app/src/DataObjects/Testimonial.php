<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\LiteralField;

class Testimonial extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Company' => 'Varchar',
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Photo' => Image::class,
    ];

    private static $owns = [
        'Photo',
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'Company' => 'Company',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Name'));
        $fields->addFieldToTab('Root.Main', TextField::create('Company'));
        $fields->addFieldToTab('Root.Main', LiteralField::create(
            'Carousel Note',
            '<p>Please in mindful of the character count for each testimonial. Keeping the content to around 300 characters will look better for carousel.</p>'
        ));
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Content')
            ->setRows(5)
        );
        $fields->addFieldToTab('Root.Main', UploadField::create('Photo')->setFolderName('Uploads/Testimonials/Photos'));

        return $fields;
    }
}