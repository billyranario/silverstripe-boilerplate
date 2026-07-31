<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * A vertical "moments" timeline — an eyebrow, heading, intro copy,
 * and an ordered list of TimelineMoment steps.
 *
 * Source reference: .timeline-sec in mmp-premium-C-first-response.html.
 * Order is chronological (6.47pm -> 7.10pm -> 8.55pm -> 9.02am), so
 * moments are sortable via GridFieldOrderableRows rather than relying
 * on creation order.
 */
class Timeline extends BaseElement
{
    private static $singular_name = 'Timeline';
    private static $plural_name = 'Timelines';
    private static $table_name = 'Timeline';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Intro' => 'Text',
        'Variant' => "Enum('Dark,Light','Dark')",
        'Ruled' => 'Boolean',      // hairline border-top divider; source .timeline-sec has none
    ];

    private static $defaults = [
        'Ruled' => false,
    ];

    private static $has_many = [
        'Moments' => TimelineMoment::class,
    ];

    private static $owns = [
        'Moments',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'Intro', 'Variant']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('Heading', 'Heading'),
            TextareaField::create('Intro', 'Intro copy'),
            DropdownField::create('Variant', 'Colour variant', [
                'Dark' => 'Dark (graphite / champagne)',
                'Light' => 'Light (porcelain / champagne)',
            ]),
            CheckboxField::create('Ruled', 'Show hairline divider above this section'),
        ]);

        $momentsGrid = GridField::create(
            'Moments',
            'Moments',
            $this->Moments(),
            GridFieldConfig_RecordEditor::create()
        );
        $momentsGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $momentsGrid);

        return $fields;
    }
}
