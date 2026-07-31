<?php

use SilverStripe\Forms\OptionsetField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\RequiredFields;

class ImageTextHalf extends BaseElement {
    private static $singular_name = 'Image Text Half';
    private static $plural_name = 'Image Text Halfs';
    private static $table_name = 'ImageTextHalf';

    private static $db = [
        'Content' => 'HTMLText',
        'Layout' => 'Varchar(255)'
    ];

    private static $defaults = [
        'Layout' => 'Half',
    ];
    
    private static $has_one = [
        'Image' => Image::class,
    ];

    private static $owns = [
        'Image',
    ];

    public function getType()
    {
        return 'Image And Text Half';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Image'));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Content', 'Content'));
        $fields->addFieldToTab(
            'Root.Main',
            OptionsetField::create(
                'Layout',
                'Choose style of the block',
                [
                    'Half' => 'Half',
                    'OneThird' => 'One Thrid',
                ],
            )
        );

        return $fields;
    }

    public function getCMSValidator()
    {
        return RequiredFields::create('Image');
    }
}
