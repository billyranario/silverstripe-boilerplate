<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;

class ServicesListing extends BaseElement {
    private static $singular_name = 'Services Listing';
    private static $plural_name = 'Services Listings';
    private static $table_name = 'ServicesListing';

    private static $inline_editable = false;

    private static $defaults = [
        'Title' => 'Services Listing',
    ];

    public function getType() {
        return 'Services Listing';
    }
    
    private static $db = [
        'HeadingContent' => 'HTMLText',
    ];

    private static $has_many = [
        'ServiceCards' => Service::class,
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('HeadingContent', 'Heading Content'));
    
        $gridFieldConfig = GridFieldConfig_RelationEditor::create();
        $gridField = GridField::create(
            'ServiceCards',
            'Service Cards',
            $this->ServiceCards(),
            $gridFieldConfig
        );
    
        $fields->addFieldToTab('Root.Main', $gridField);
    
        return $fields;
    }
}