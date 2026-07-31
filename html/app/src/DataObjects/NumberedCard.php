<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * A single card in a NumberedCardGrid block (First Response blocks).
 *
 * Source reference: .card in mmp-premium-C-first-response.html — each
 * card shows a roman numeral, a title and a paragraph. The numeral
 * (I, II, III...) is DERIVED from sort position at render time, not
 * stored — see NumberedCardGrid::getCards(), so reordering in the CMS
 * can never leave a stale numeral behind.
 */
class NumberedCard extends DataObject
{
    private static $table_name = 'NumberedCard';

    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'Text',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'NumberedCardGrid' => NumberedCardGrid::class,
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
     * Roman numeral derived from this card's position among its
     * siblings (1-indexed), not from stored data.
     */
    public function getNumeral()
    {
        $siblings = $this->NumberedCardGrid()->Cards()->columnUnique('ID');
        $position = array_search($this->ID, array_values($siblings));

        return $position === false ? '' : $this->toRoman($position + 1);
    }

    protected function toRoman(int $number): string
    {
        $map = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1,
        ];

        $result = '';
        foreach ($map as $roman => $value) {
            while ($number >= $value) {
                $result .= $roman;
                $number -= $value;
            }
        }

        return $result;
    }
}
