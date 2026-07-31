<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class Accordion extends BaseElement {
    private static $singular_name = 'Accordion';
    private static $plural_name = 'Accordions';
    private static $table_name = 'Accordion';

    private static $inline_editable = false;

    private static $defaults = [
        'Title' => 'Accordion'
    ];

    public function getType() {
        return 'Accordion';
    }
    
    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $has_many = [
        'AccordionItems' => AccordionItem::class,
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $gridField = GridField::create(
            'AccordionItems',
            'Accordion Items',
            $this->AccordionItems(),
            GridFieldConfig_RecordEditor::create()
        );
        $fields->addFieldToTab('Root.Main', $gridField);

        return $fields;
    }
}