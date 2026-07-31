<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * A single numbered card in a MeetingNumberedGrid block — covers both
 * "The offer" (4 commitments, 2x2) and "How we begin" (3 steps, 3-col)
 * on the /meeting (Private Vendor Counsel, VC·26) page, since both
 * share the same top-rule + gold numeral card treatment per the
 * handoff spec (SILVERSTRIPE-BUILD-SPEC.md §3.3/§3.9).
 *
 * The two-digit number is derived from sort position, not stored, so
 * reordering in the CMS can never leave a stale number behind.
 */
class MeetingNumberedItem extends DataObject
{
    private static $table_name = 'MeetingNumberedItem';

    private static $db = [
        'Title' => 'Varchar(255)',
        'Description' => 'Text',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'MeetingNumberedGrid' => MeetingNumberedGrid::class,
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'Title' => 'Title',
    ];

    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('Title', 'Title'),
            TextareaField::create('Description', 'Description')
        );
    }

    public function getNumber()
    {
        $position = $this->getZeroIndexedPosition();

        return $position === false ? '' : sprintf('%02d', $position + 1);
    }

    private function getZeroIndexedPosition()
    {
        $siblings = $this->MeetingNumberedGrid()->Items()->columnUnique('ID');

        return array_search($this->ID, array_values($siblings));
    }
}
