<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * A single column ("BEFORE" / "DURING" / "AFTER") in a
 * MeetingEngagementColumns block — left-rule card treatment, distinct
 * from MeetingNumberedItem's top-rule cards, per
 * SILVERSTRIPE-BUILD-SPEC.md §3.5.
 */
class MeetingEngagementStage extends DataObject
{
    private static $table_name = 'MeetingEngagementStage';

    private static $db = [
        'Label' => 'Varchar(255)',
        'Title' => 'Varchar(255)',
        'Description' => 'Text',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'MeetingEngagementColumns' => MeetingEngagementColumns::class,
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'Label' => 'Label',
        'Title' => 'Title',
    ];

    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('Label', 'Label')
                ->setDescription('e.g. "BEFORE"'),
            TextField::create('Title', 'Title'),
            TextareaField::create('Description', 'Description')
        );
    }
}
