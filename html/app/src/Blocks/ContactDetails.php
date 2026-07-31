<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\LiteralField;

class ContactDetails extends BaseElement {
    private static $singular_name = 'Contact Details';
    private static $plural_name = 'Contact Details';
    private static $table_name = 'ContactDetails';

    public function getType()
    {
        return 'Contact Details';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', LiteralField::create(
            'ContactDetails', 
            '<p>Contact Details will be taken from <a href="/admin/settings" target="_blank">Site Settings</a></p>'
        ));
        
        return $fields;
    }
}