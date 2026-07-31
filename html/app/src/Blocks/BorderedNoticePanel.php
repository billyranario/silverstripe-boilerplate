<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * A single bordered box, full width — an eyebrow sitting inline with
 * a heading, and a paragraph below. Left-aligned throughout.
 *
 * Distinct from TextPairWithPanel: that block always pairs the panel
 * with a wider text column. This one stands alone.
 *
 * Source reference: "Privacy Act 2020 — A word on how we wrote to
 * you", page 3 of "MMP Landing Redesign-1.pdf".
 */
class BorderedNoticePanel extends BaseElement
{
    private static $singular_name = 'Bordered Notice Panel';
    private static $plural_name = 'Bordered Notice Panels';
    private static $table_name = 'BorderedNoticePanel';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Content' => 'Text',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'Content']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label')
                ->setDescription('e.g. "Privacy Act 2020" — shown inline before the heading.'),
            TextField::create('Heading', 'Heading'),
            TextareaField::create('Content', 'Content'),
        ]);

        return $fields;
    }
}
