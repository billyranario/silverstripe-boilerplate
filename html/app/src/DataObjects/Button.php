<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;

class Button extends DataObject {
    private static $db = [
        'Text' => 'Varchar',
        'Link' => 'Varchar',
        'Theme' => 'Varchar',
    ];

    private static $has_one = [
        'Hero' => Hero::class,
    ];

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Text', 'Text'),
            TextField::create('Link', 'Link'),
            OptionsetField::create(
                'Theme',
                'Button Style',
                [
                    'Primary' => 'Primary',
                    'Secondary' => 'Secondary'
                ]
            )->setValue('Primary')
        );

        return $fields;
    }
}