<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Centred statement — eyebrow, heading, optional figure line, prose,
 * optional button, optional footnote.
 *
 * Covers TWO sections from the source design that share the same
 * skeleton: .fee (figure + prose, no button) and .closing (heading +
 * prose + button + contact line). Reusable-blocks direction means one
 * flexible block beats two near-duplicates — every field below is
 * optional so either shape (or something between) can be built from it.
 *
 * Source reference: .fee and .closing in
 * mmp-premium-C-first-response.html.
 */
class CentredStatement extends BaseElement
{
    private static $singular_name = 'Centred Statement';
    private static $plural_name = 'Centred Statements';
    private static $table_name = 'CentredStatement';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'HTMLText',      // supports <em> accent, matches .closing h2 em
        'FigureLine' => 'Varchar(255)', // e.g. "A fraction of one per cent of your sale —"
        'Prose' => 'HTMLText',
        'ButtonText' => 'Varchar(255)',
        'ButtonLink' => 'Varchar(255)',
        'FootnoteLine' => 'HTMLVarchar(255)', // e.g. contact line with tel:/mailto: links
        'SecondaryText' => 'Varchar(255)', // e.g. "or telephone 03 548 2154", shown beside/under the button
        'SecondaryLink' => 'Varchar(255)',
        // 'Navy' added for the "MMP Landing Redesign" family — the site's
        // own navy/gold/cream tokens, plain Tailwind utilities, no fr-*
        // classes. 'Meeting' added for the /meeting (Private Vendor
        // Counsel, VC·26 handoff) family — its own navy/gold tokens and
        // EB Garamond, distinct hex values from both Navy and Dark/Light.
        // Each variant is its own template branch; earlier branches are
        // untouched by later additions.
        'Variant' => "Enum('Dark,Light,Navy,Meeting','Dark')",
        'Ruled' => 'Boolean',      // hairline border-top divider; source .fee and .closing both have one
    ];

    private static $defaults = [
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
            'Eyebrow', 'Heading', 'FigureLine', 'Prose',
            'ButtonText', 'ButtonLink', 'SecondaryText', 'SecondaryLink',
            'FootnoteLine', 'Variant',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            HTMLEditorField::create('Heading', 'Heading')
                ->setDescription('Use italics for the accent phrase.')
                ->setRows(3),
            TextField::create('FigureLine', 'Figure line')
                ->setDescription('Optional. Large italic statement below the heading — leave blank to omit.'),
            HTMLEditorField::create('Prose', 'Prose')
                ->setDescription('Use <strong> for emphasis, matching the source copy.'),
            FieldGroup::create(
                TextField::create('ButtonText', 'Button Text'),
                TextField::create('ButtonLink', 'Button Link')
            )->setTitle('Button (optional)'),
            FieldGroup::create(
                TextField::create('SecondaryText', 'Text'),
                TextField::create('SecondaryLink', 'Link')
            )->setTitle('Secondary link beside button (optional)')
                ->setDescription('e.g. "or telephone 03 548 2154" — leave blank to omit.'),
            HTMLEditorField::create('FootnoteLine', 'Footnote line')
                ->setDescription('Optional. e.g. a contact line with tel:/mailto: links under the button — leave blank to omit.')
                ->setRows(2),
            DropdownField::create('Variant', 'Colour variant', [
                'Dark' => 'Dark (graphite / champagne)',
                'Light' => 'Light (porcelain / champagne)',
                'Navy' => 'Navy (site navy / gold)',
                'Meeting' => 'Meeting (VC·26 navy / gold, EB Garamond)',
            ]),
            CheckboxField::create('Ruled', 'Show hairline divider above this section'),
        ]);

        return $fields;
    }
}
