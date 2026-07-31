<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * A single step in a Timeline block (First Response blocks).
 *
 * Source reference: .moment in mmp-premium-C-first-response.html —
 * each step is a <time> label, a heading and a paragraph. Order is
 * semantic (chronological), so this DataObject is sortable via
 * GridFieldOrderableRows on the parent Timeline block.
 */
class TimelineMoment extends DataObject
{
    private static $table_name = 'TimelineMoment';

    private static $db = [
        'Time' => 'Varchar(255)',   // e.g. "Sunday, 6.47 pm" — free text, matches source
        'Title' => 'Varchar(255)',
        'Content' => 'Text',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'Timeline' => Timeline::class,
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'Time' => 'Time',
        'Title' => 'Title',
    ];

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Time', 'Time label')
                ->setDescription('Free text, e.g. "Sunday, 6.47 pm" or "Monday, 9.02 am".'),
            TextField::create('Title', 'Title'),
            TextareaField::create('Content', 'Content')
        );

        return $fields;
    }
}
