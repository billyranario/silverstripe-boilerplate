<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;

class Hero extends DataObject {
    private static $inline_editable = false;

    private static $db = [
        'Content' => 'HTMLText',
    ];
    
    private static $has_one = [
        'BackgroundImage' => Image::class,
        'HeroCarousel' => HeroCarousel::class,
    ];

    private static $has_many = [
        'Buttons' => Button::class,
    ];

    private static $owns = [
        'BackgroundImage',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', UploadField::create('BackgroundImage', 'Background Image'));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Content', 'Content'));

        // Limit the number of buttons to 2
        $config = GridFieldConfig_RecordEditor::create();
        if ($this->Buttons()->count() > 1) {
            $config->removeComponentsByType(GridFieldAddNewButton::class);
            $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        }

        // Set the display fields
        $dataColumns = $config->getComponentByType(GridFieldDataColumns::class);
        $dataColumns->setDisplayFields([
            'Text' => 'Title',
            'Theme' => 'Button Style'
        ]);
        
        $fields->addFieldToTab(
            'Root.Main',
            GridField::create(
                'Buttons',
                'Buttons',
                $this->Buttons(),
                $config
            ),
        );

        return $fields;
    }
}