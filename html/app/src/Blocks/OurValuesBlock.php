<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class OurValuesBlock extends BaseElement
{   
    private static $singular_name = 'Our Values';
    private static $plural_name = 'Our Values';
    private static $table_name = 'OurValues';

    private static $inline_editable = false;

    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $defaults = [
        'Title' => 'Our Values',
    ];

    private static $has_one = [
        'BackgroundImage' => Image::class,
    ];

    private static $has_many = [
        'OurValues' => OurValue::class,
    ];

    private static $owns = [
        'BackgroundImage',
    ];

    public function getType()
    {
        return 'Our Values';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            UploadField::create('BackgroundImage', 'Background Image')
                ->setDescription('If left blank, the default stock background image will be used.')
                ->setFolderName('Uploads/BackgroundImages')
        );

        $fields->addFieldToTab(
            'Root.Main',
            GridField::create(
                'OurValues',
                'Our Values',
                $this->OurValues(),
                GridFieldConfig_RecordEditor::create()
            )
        );

        return $fields;
    }
}