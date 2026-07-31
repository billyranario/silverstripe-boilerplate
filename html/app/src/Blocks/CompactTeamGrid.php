<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * A small curated photo grid — name, role, and a caption underneath.
 *
 * Deliberately separate from the site-wide TeamMemberGrid (which lists
 * every record from the global team directory with full bios) — this
 * is a page-scoped, ordered subset for a single landing page.
 *
 * Source reference: "Senior hands, known by name", page 2 of
 * "MMP Landing Redesign-1.pdf".
 */
class CompactTeamGrid extends BaseElement
{
    private static $singular_name = 'Compact Team Grid';
    private static $plural_name = 'Compact Team Grids';
    private static $table_name = 'CompactTeamGrid';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Caption' => 'Text',
    ];

    private static $has_many = [
        'Members' => TeamGridMember::class,
    ];

    private static $owns = [
        'Members',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'Caption']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Heading', 'Heading'),
            TextField::create('Eyebrow', 'Eyebrow label (right-aligned)'),
            TextareaField::create('Caption', 'Caption')
                ->setDescription('Optional line shown under the photo grid.'),
        ]);

        $membersGrid = GridField::create(
            'Members',
            'Team members',
            $this->Members(),
            GridFieldConfig_RecordEditor::create()
        );
        $membersGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $membersGrid);

        return $fields;
    }
}
