<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyField;

/**
 * A stored copy of every /meeting enquiry-form submission, so the
 * "confirmed within one working day" promise (CONTENT.md, "How we
 * begin" §01) never depends solely on an inbox — per
 * SILVERSTRIPE-BUILD-SPEC.md §5.4.
 */
class ConsultationEnquiry extends DataObject
{
    private static $table_name = 'ConsultationEnquiry';

    private static $db = [
        'Name' => 'Varchar(255)',
        'PropertyAddress' => 'Varchar(255)',
        'Phone' => 'Varchar(60)',
        'Email' => 'Varchar(255)',
        'PreferredTime' => 'Varchar(255)',
        'Reference' => 'Varchar(40)',
        'Source' => 'Varchar(255)',
        'EmailSent' => 'Boolean',
    ];

    private static $summary_fields = [
        'Created' => 'Received',
        'Name' => 'Name',
        'PropertyAddress' => 'Property address',
        'Phone' => 'Phone',
        'Email' => 'Email',
        'EmailSent.Nice' => 'Reception emailed',
    ];

    private static $default_sort = '"Created" DESC';

    public function getCMSFields()
    {
        $fields = FieldList::create(
            ReadonlyField::create('Created', 'Received'),
            ReadonlyField::create('Name', 'Name'),
            ReadonlyField::create('PropertyAddress', 'Property address'),
            ReadonlyField::create('Phone', 'Phone'),
            ReadonlyField::create('Email', 'Email'),
            ReadonlyField::create('PreferredTime', 'Preferred time'),
            ReadonlyField::create('Reference', 'Reference'),
            ReadonlyField::create('Source', 'Source'),
            ReadonlyField::create('EmailSent', 'Reception emailed')
        );

        return $fields;
    }

    public function canCreate($member = null, $context = [])
    {
        return false;
    }
}
