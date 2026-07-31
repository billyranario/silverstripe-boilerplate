<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class CTA extends BaseElement {
    private static $singular_name = 'Call To Action';
    private static $plural_name = 'Call To Actions';
    private static $table_name = 'Call To Action';
    
    private static $inline_editable = false;

    private static $db = [
        'Content' => 'HTMLText',
        'ButtonText' => 'Varchar',
        'ButtonLink' => 'Varchar',
    ];

    private static $has_one = [
        'BackgroundImage' => Image::class,
    ];

    private static $owns = [
        'BackgroundImage',
    ];

    public function getType() {
        return 'Call To Action';
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();
    
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Content', 'Content'));

        // Remove the automatically generated fields
        $fields->removeByName('ButtonText');
        $fields->removeByName('ButtonLink');

        // Add a FieldGroup with the ButtonLabel and ButtonLink fields
        $buttonGroup = FieldGroup::create(
            TextField::create('ButtonText', 'Button Text'),
            TextField::create('ButtonLink', 'Button Link')
        )->setTitle('Button Details');

        $fields->addFieldToTab('Root.Main', $buttonGroup);
            
        $fields->addFieldToTab('Root.Main', UploadField::create('BackgroundImage', 'Background Image'));

        return $fields;
    }
}