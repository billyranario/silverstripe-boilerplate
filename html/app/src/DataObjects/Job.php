<?php

use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\CurrencyField;

class Job extends DataObject {
    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'HTMLText',
        'Description' => 'Text',
        'Location' => 'Varchar',
        'EmploymentType' => 'Varchar',
        'Salary' => 'Varchar',
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $belongs_many_many = [
        'JobListing' => JobListing::class
    ];

    private static $owns = [
        'Image'
    ];

    private static $summary_fields = [
        'Title' => 'Title',
    ];

    public function getLink() {
        return '/careers/job/' . $this->ID;
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Title'));
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Content'));
        $fields->addFieldToTab('Root.Main', 
            TextareaField::create('Description', 'Description')
                ->setDescription('Optional. First paragraph of the content will be used if left empty.')
        );
        $fields->addFieldToTab('Root.Main', TextField::create('Location'));
        $fields->addFieldToTab('Root.Main', TextField::create('EmploymentType', 'Employment Type'));
        $fields->addFieldToTab('Root.Main', TextField::create('Salary'));

        $fields->addFieldToTab('Root.Main', UploadField::create('Image')
            ->setFolderName('Uploads/Jobs')
        );

        return $fields;
    }
}
