<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Centred hero with eyebrow label, heading, lede, up to two buttons
 * and an optional reference line.
 *
 * Source reference: .hero in mmp-premium-C-first-response.html.
 */
class CentredHero extends BaseElement
{
    private static $singular_name = 'Centred Hero';
    private static $plural_name = 'Centred Heroes';
    private static $table_name = 'CentredHero';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'HTMLText',     // supports <em> accent, matches source markup
        'Lede' => 'HTMLText',        // supports <strong> emphasis mid-paragraph
        'PrimaryButtonText' => 'Varchar(255)',
        'PrimaryButtonLink' => 'Varchar(255)',
        'SecondaryButtonText' => 'Varchar(255)',
        'SecondaryButtonLink' => 'Varchar(255)',
        'ReferenceLine' => 'HTMLVarchar(255)', // supports <b>FR·26</b>-style inline emphasis
        'Variant' => "Enum('Dark,Light','Dark')",
        'Ruled' => 'Boolean',      // hairline border-top divider; source .hero has none
    ];

    private static $defaults = [
        'Ruled' => false,
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Eyebrow', 'Heading', 'Lede',
            'PrimaryButtonText', 'PrimaryButtonLink',
            'SecondaryButtonText', 'SecondaryButtonLink',
            'ReferenceLine', 'Variant',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            HTMLEditorField::create('Heading', 'Heading')
                ->setDescription('Use italics for the accent phrase.')
                ->setRows(3),
            HTMLEditorField::create('Lede', 'Lede paragraph')
                ->setDescription('Use <strong>/bold</strong> for emphasis.')
                ->setRows(4),
            FieldGroup::create(
                TextField::create('PrimaryButtonText', 'Button Text'),
                TextField::create('PrimaryButtonLink', 'Button Link')
            )->setTitle('Primary Button'),
            FieldGroup::create(
                TextField::create('SecondaryButtonText', 'Button Text'),
                TextField::create('SecondaryButtonLink', 'Button Link')
            )->setTitle('Secondary Button'),
            HTMLEditorField::create('ReferenceLine', 'Reference line')
                ->setDescription('e.g. "A complimentary, no-obligation consultation opens every engagement · reference <b>FR·26</b>"')
                ->setRows(2),
            DropdownField::create('Variant', 'Colour variant', [
                'Dark' => 'Dark (graphite / champagne)',
                'Light' => 'Light (porcelain / champagne)',
            ]),
            CheckboxField::create('Ruled', 'Show hairline divider above this section'),
        ]);

        return $fields;
    }
}
