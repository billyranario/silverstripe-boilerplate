<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * A 2-column grid of numbered cards (I, II, III...).
 *
 * Source reference: .standard-grid in mmp-premium-C-first-response.html.
 * The roman numeral is derived from sort position at render time
 * (see NumberedCard::getNumeral()) rather than stored, so reordering
 * cards in the CMS can never leave a stale numeral behind.
 */
class NumberedCardGrid extends BaseElement
{
    private static $singular_name = 'Numbered Card Grid';
    private static $plural_name = 'Numbered Card Grids';
    private static $table_name = 'NumberedCardGrid';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Variant' => "Enum('Dark,Light','Dark')",
        'Ruled' => 'Boolean',      // hairline border-top divider; source .standard has one
    ];

    private static $defaults = [
        'Ruled' => true,
    ];

    private static $has_many = [
        'Cards' => NumberedCard::class,
    ];

    private static $owns = [
        'Cards',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'Variant']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('Heading', 'Heading'),
            DropdownField::create('Variant', 'Colour variant', [
                'Dark' => 'Dark (graphite / champagne)',
                'Light' => 'Light (porcelain / champagne)',
            ]),
            CheckboxField::create('Ruled', 'Show hairline divider above this section'),
        ]);

        $cardsGrid = GridField::create(
            'Cards',
            'Cards',
            $this->Cards(),
            GridFieldConfig_RecordEditor::create()
        );
        $cardsGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $cardsGrid);

        return $fields;
    }
}
