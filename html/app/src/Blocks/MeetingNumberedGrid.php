<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Paper-background section with a header row (eyebrow + optional
 * right-aligned reference label, H2) above N numbered cards, each with
 * a 1px navy top rule and a gold numeral.
 *
 * Covers TWO sections from the /meeting handoff that share this exact
 * card treatment: "The offer" (4 commitments, 2x2 grid, hairline top
 * AND bottom) and "How we begin" (3 steps, 3-col, hairline top only) —
 * SILVERSTRIPE-BUILD-SPEC.md §3.3 / §3.9 explicitly says the latter
 * uses "the same card treatment as the commitments".
 */
class MeetingNumberedGrid extends BaseElement
{
    private static $singular_name = 'Meeting Numbered Grid';
    private static $plural_name = 'Meeting Numbered Grids';
    private static $table_name = 'MeetingNumberedGrid';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'ReferenceLabel' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Columns' => "Enum('2,3','2')",
        'RuleBottom' => 'Boolean',
        'AnchorId' => 'Varchar(60)',
    ];

    private static $defaults = [
        'RuleBottom' => false,
    ];

    private static $has_many = [
        'Items' => MeetingNumberedItem::class,
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

        $fields->removeByName(['Eyebrow', 'ReferenceLabel', 'Heading', 'Columns', 'RuleBottom', 'AnchorId']);

        $fields->addFieldsToTab('Root.Main', [
            FieldGroup::create(
                TextField::create('Eyebrow', 'Eyebrow label'),
                TextField::create('ReferenceLabel', 'Reference label (right-aligned, optional)')
            )->setTitle('Eyebrow row'),
            TextField::create('Heading', 'Heading (H2)'),
            TextField::create('AnchorId', 'Anchor id (for header nav, no #)')
                ->setDescription('e.g. "offer" — omit the "#".'),
            DropdownField::create('Columns', 'Columns', [
                '2' => '2 (2x2 grid — "The offer")',
                '3' => '3 (single row — "How we begin")',
            ]),
            CheckboxField::create('RuleBottom', 'Hairline rule below the grid too')
                ->setDescription('"The offer" has hairlines top and bottom; "How we begin" has only the top one.'),
        ]);

        $itemsGrid = GridField::create(
            'Items',
            'Numbered items',
            $this->Items(),
            GridFieldConfig_RecordEditor::create()
        );
        $itemsGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $itemsGrid);

        return $fields;
    }
}
