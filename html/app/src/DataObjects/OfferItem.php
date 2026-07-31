<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * A single numbered item in a BorderedOfferGrid block.
 *
 * The two-digit number (01, 02, 03...) is DERIVED from sort position
 * at render time, not stored — see getNumber() — so reordering in the
 * CMS can never leave a stale number behind.
 */
class OfferItem extends DataObject
{
    private static $table_name = 'OfferItem';

    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'Text',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'BorderedOfferGrid' => BorderedOfferGrid::class,
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'Title' => 'Title',
    ];

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title', 'Title'),
            TextareaField::create('Content', 'Content')
        );

        return $fields;
    }

    /**
     * Two-digit number derived from this item's position among its
     * siblings (1-indexed), e.g. "01", "02".
     */
    public function getNumber()
    {
        $position = $this->getZeroIndexedPosition();

        return $position === false ? '' : sprintf('%02d', $position + 1);
    }

    /**
     * True once this item is past the first row of the (fixed) 2-column
     * grid — used in the template to draw a top divider between rows.
     * Computed in PHP rather than guessed at in the template language.
     */
    public function getNeedsTopDivider()
    {
        $position = $this->getZeroIndexedPosition();

        return $position !== false && $position >= 2;
    }

    /**
     * True for the left column of the (fixed) 2-column grid — used in
     * the template to draw a right-hand divider between columns.
     */
    public function getIsLeftColumn()
    {
        $position = $this->getZeroIndexedPosition();

        return $position !== false && $position % 2 === 0;
    }

    private function getZeroIndexedPosition()
    {
        $siblings = $this->BorderedOfferGrid()->Items()->columnUnique('ID');

        return array_search($this->ID, array_values($siblings));
    }
}
