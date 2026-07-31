<?php

namespace MMP\Extensions;

use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldGroup;

class CustomSiteConfig extends Extension
{
    private static $db = [
        'Facebook' => 'Varchar(255)',
        'LinkedIn' => 'Varchar(255)',
        'ContactNumber' => 'Varchar(255)',
        'ContactEmail' => 'Varchar(255)',
        'Address' => 'Varchar(255)',
        'AddressLink' => 'Varchar(255)',
        'BusinessHours' => 'Text',
    ];
    
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Contact', TextField::create('ContactNumber', 'Contact Number'));
        $fields->addFieldToTab('Root.Contact', TextField::create('ContactEmail', 'Contact Email'));

        $fields->addFieldToTab('Root.Contact', FieldGroup::create(
            'Address Details',
            TextField::create('Address', 'Address'),
            TextField::create('AddressLink', 'Address Link')
        ));
        $fields->addFieldToTab('Root.Contact', 
            TextareaField::create('BusinessHours', 'Business Hours')
                ->setRows(3)
        );

        $fields->addFieldToTab('Root.Socials', TextField::create('Facebook', 'Facebook'));
        $fields->addFieldToTab('Root.Socials', TextField::create('LinkedIn', 'LinkedIn'));
    }
}