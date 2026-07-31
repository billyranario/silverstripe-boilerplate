<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class ContactForm extends BaseElement {
    private static $singular_name = 'Contact Form';
    private static $plural_name = 'Contact Forms';
    private static $table_name = 'ContactForm';

    private static $db = [
        'Title' => 'Varchar(255)',
        'HeadingContent' => 'HTMLText',
        'ShowMailIcon' => 'Boolean',
    ];

    private static $defaults = [
        'Title' => 'Contact Form',
    ];

    public function getType()
    {
        return 'Contact Form';
    }

    public function getCMSFields()
{
    $fields = parent::getCMSFields();

    $fields->dataFieldByName('HeadingContent')->setRows(8);
    $fields->dataFieldByName('ShowMailIcon')->setTitle('Show mail icon above heading content');

    return $fields;
}
}