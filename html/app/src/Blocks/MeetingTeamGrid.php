<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * "Your counsel" — eyebrow/H2 left with a supporting paragraph right,
 * then 6 portraits in a 6-column grid with a navy duotone overlay
 * (mix-blend-mode: color), per SILVERSTRIPE-BUILD-SPEC.md §3.4.
 *
 * Reuses existing TeamMember CMS records via MeetingTeamPick rather
 * than duplicating photos, per the handoff's own instruction.
 */
class MeetingTeamGrid extends BaseElement
{
    private static $singular_name = 'Meeting Team Grid';
    private static $plural_name = 'Meeting Team Grids';
    private static $table_name = 'MeetingTeamGrid';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'SupportingText' => 'Text',
        'AnchorId' => 'Varchar(60)',
    ];

    private static $has_many = [
        'Picks' => MeetingTeamPick::class,
    ];

    private static $owns = [
        'Picks',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'SupportingText', 'AnchorId']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('Heading', 'Heading (H2)'),
            TextareaField::create('SupportingText', 'Supporting paragraph'),
            TextField::create('AnchorId', 'Anchor id (for header nav, no #)'),
        ]);

        $picksGrid = GridField::create(
            'Picks',
            'Team members',
            $this->Picks(),
            GridFieldConfig_RecordEditor::create()
        );
        $picksGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $picksGrid);

        return $fields;
    }
}
