<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class FeaturedCards extends BaseElement
{
    private static $singular_name = 'Featured Cards';
    private static $plural_name = 'Featured Cards';
    private static $table_name = 'FeaturedCards';

    private static $inline_editable = false;
    
    private static $has_many = [
        'Cards' => FeaturedCard::class,
    ];

    private static $owns = [
        'Cards',
    ];

    public function getType()
    {
        return self::$singular_name;
    }
    

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', GridField::create(
            'Cards',
            'Cards',
            $this->Cards(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}