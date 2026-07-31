<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\Forms\FieldList;

/**
 * Two-column text pair — a wider "why" column and a narrower column
 * that can optionally render as a bordered panel (e.g. a privacy
 * notice sitting visually apart from prose).
 *
 * Source reference: .pair in mmp-premium-C-first-response.html
 * (.why at 1.1fr, .privacy panel at .9fr).
 */
class TextPairWithPanel extends BaseElement
{
    private static $singular_name = 'Text Pair With Panel';
    private static $plural_name = 'Text Pairs With Panel';
    private static $table_name = 'TextPairWithPanel';

    private static $inline_editable = false;

    private static $db = [
        'LeftEyebrow' => 'Varchar(255)',
        'LeftHeading' => 'Varchar(255)',
        'LeftContent' => 'HTMLText',
        'RightEyebrow' => 'Varchar(255)',
        'RightHeading' => 'Varchar(255)',
        'RightContent' => 'HTMLText',
        'RightIsPanel' => 'Boolean',
        'Variant' => "Enum('Dark,Light','Dark')",
        'Ruled' => 'Boolean',      // hairline border-top divider; source .pair has one
    ];

    private static $defaults = [
        'RightIsPanel' => true,
        'Ruled' => true,
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'LeftEyebrow', 'LeftHeading', 'LeftContent',
            'RightEyebrow', 'RightHeading', 'RightContent',
            'RightIsPanel', 'Variant',
        ]);

        $fields->addFieldToTab('Root.Main', ToggleCompositeField::create(
            'LeftColumn',
            'Left column (wider)',
            [
                TextField::create('LeftEyebrow', 'Eyebrow label'),
                TextField::create('LeftHeading', 'Heading'),
                HTMLEditorField::create('LeftContent', 'Content'),
            ]
        )->setStartClosed(false));

        $fields->addFieldToTab('Root.Main', ToggleCompositeField::create(
            'RightColumn',
            'Right column (narrower)',
            [
                TextField::create('RightEyebrow', 'Eyebrow label'),
                TextField::create('RightHeading', 'Heading'),
                HTMLEditorField::create('RightContent', 'Content'),
                CheckboxField::create('RightIsPanel', 'Render as bordered panel'),
            ]
        )->setStartClosed(false));

        $fields->addFieldToTab('Root.Main', DropdownField::create('Variant', 'Colour variant', [
            'Dark' => 'Dark (graphite / champagne)',
            'Light' => 'Light (porcelain / champagne)',
        ]));

        $fields->addFieldToTab('Root.Main', CheckboxField::create('Ruled', 'Show hairline divider above this section'));

        return $fields;
    }
}
