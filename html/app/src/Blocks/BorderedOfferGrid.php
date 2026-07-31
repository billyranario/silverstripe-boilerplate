<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * A bordered box containing a header row (eyebrow + reference label),
 * a 2-column grid of numbered offer items, and a shaded footer note.
 *
 * Source reference: "THE OFFER — PRIVATE VENDOR COUNSEL" box, page 1
 * of "MMP Landing Redesign-1.pdf".
 */
class BorderedOfferGrid extends BaseElement
{
    private static $singular_name = 'Bordered Offer Grid';
    private static $plural_name = 'Bordered Offer Grids';
    private static $table_name = 'BorderedOfferGrid';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'ReferenceLabel' => 'Varchar(255)',
        'FooterNote' => 'HTMLText',
    ];

    private static $has_many = [
        'Items' => OfferItem::class,
    ];

    private static $owns = [
        'Items',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'ReferenceLabel', 'FooterNote']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('ReferenceLabel', 'Reference label (right-aligned)')
                ->setDescription('e.g. "REFERENCE VC·26"'),
            HTMLEditorField::create('FooterNote', 'Footer note')
                ->setDescription('Use <strong> for emphasis, e.g. the "twelve new vendor engagements" line.')
                ->setRows(3),
        ]);

        $itemsGrid = GridField::create(
            'Items',
            'Offer items',
            $this->Items(),
            GridFieldConfig_RecordEditor::create()
        );
        $itemsGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $itemsGrid);

        return $fields;
    }
}
