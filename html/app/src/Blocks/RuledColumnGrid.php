<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * A header row (heading + eyebrow) above N columns, each topped with
 * a thin rule and a small label. Reused for both the "BEFORE / DURING
 * / AFTER" engagement steps and the "01 / 02 / 03" how-we-begin steps
 * in "MMP Landing Redesign-1.pdf" — same structure, different label
 * style, hence one flexible block rather than two near-duplicates.
 */
class RuledColumnGrid extends BaseElement
{
    private static $singular_name = 'Ruled Column Grid';
    private static $plural_name = 'Ruled Column Grids';
    private static $table_name = 'RuledColumnGrid';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Shaded' => 'Boolean',
    ];

    private static $defaults = [
        'Shaded' => true,
    ];

    private static $has_many = [
        'Columns' => RuledColumn::class,
    ];

    private static $owns = [
        'Columns',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'Shaded']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Heading', 'Heading'),
            TextField::create('Eyebrow', 'Eyebrow label (right-aligned)'),
            CheckboxField::create('Shaded', 'Shaded background (cream)'),
        ]);

        $columnsGrid = GridField::create(
            'Columns',
            'Columns',
            $this->Columns(),
            GridFieldConfig_RecordEditor::create()
        );
        $columnsGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $columnsGrid);

        return $fields;
    }
}
