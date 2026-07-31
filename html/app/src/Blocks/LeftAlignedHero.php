<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Left-aligned dark hero — eyebrow, heading, lede and a reference
 * line. No buttons: this design's hero is a plain invitation-letter
 * opener, not a call-to-action block.
 *
 * Source reference: page 1 hero in "MMP Landing Redesign-1.pdf".
 */
class LeftAlignedHero extends BaseElement
{
    private static $singular_name = 'Left Aligned Hero';
    private static $plural_name = 'Left Aligned Heroes';
    private static $table_name = 'LeftAlignedHero';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'HTMLText',
        'Lede' => 'HTMLText',
        'ReferenceLine' => 'HTMLVarchar(255)',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'Lede', 'ReferenceLine']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            HTMLEditorField::create('Heading', 'Heading')->setRows(3),
            HTMLEditorField::create('Lede', 'Lede paragraph')->setRows(4),
            HTMLEditorField::create('ReferenceLine', 'Reference line')
                ->setDescription('e.g. "Kindly mention reference VC·26 from your letter when you reply. · reception@mmp.co.nz · 03 548 2154"')
                ->setRows(2),
        ]);

        return $fields;
    }
}
