<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * A single column in a RuledColumnGrid block.
 *
 * Label is free text on purpose — it covers both stage labels
 * ("BEFORE" / "DURING" / "AFTER") and numbers ("01" / "02" / "03")
 * depending on which instance of RuledColumnGrid this belongs to.
 */
class RuledColumn extends DataObject
{
    private static $table_name = 'RuledColumn';

    private static $db = [
        'Label' => 'Varchar(255)',
        'Title' => 'Varchar(255)',
        'Content' => 'Text',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'RuledColumnGrid' => RuledColumnGrid::class,
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'Label' => 'Label',
        'Title' => 'Title',
    ];

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Label', 'Label')
                ->setDescription('e.g. "BEFORE" or "01" — free text, shown small and uppercase.'),
            TextField::create('Title', 'Title'),
            TextareaField::create('Content', 'Content')
        );

        return $fields;
    }
}
