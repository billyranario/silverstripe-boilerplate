<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * "The three regions" — white, 3 photo tiles (280px tall) with a
 * title + caption beneath each, per SILVERSTRIPE-BUILD-SPEC.md §3.8.
 */
class MeetingRegionGrid extends BaseElement
{
    private static $singular_name = 'Meeting Region Grid';
    private static $plural_name = 'Meeting Region Grids';
    private static $table_name = 'MeetingRegionGrid';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'AnchorId' => 'Varchar(60)',
    ];

    private static $has_many = [
        'Tiles' => MeetingRegionTile::class,
    ];

    private static $owns = [
        'Tiles',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'AnchorId']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('AnchorId', 'Anchor id (for header nav, no #)'),
        ]);

        $tilesGrid = GridField::create(
            'Tiles',
            'Region tiles',
            $this->Tiles(),
            GridFieldConfig_RecordEditor::create()
        );
        $tilesGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $tilesGrid);

        return $fields;
    }
}
