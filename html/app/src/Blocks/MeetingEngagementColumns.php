<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * "The engagement" — Paper background, 3 columns (BEFORE / DURING /
 * AFTER), each with a 1px navy LEFT rule and 26px padding — distinct
 * card treatment from MeetingNumberedGrid's top-rule cards, per
 * SILVERSTRIPE-BUILD-SPEC.md §3.5.
 */
class MeetingEngagementColumns extends BaseElement
{
    private static $singular_name = 'Meeting Engagement Columns';
    private static $plural_name = 'Meeting Engagement Columns';
    private static $table_name = 'MeetingEngagementColumns';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
    ];

    private static $has_many = [
        'Stages' => MeetingEngagementStage::class,
    ];

    private static $owns = [
        'Stages',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('Heading', 'Heading (H2)'),
        ]);

        $stagesGrid = GridField::create(
            'Stages',
            'Stages',
            $this->Stages(),
            GridFieldConfig_RecordEditor::create()
        );
        $stagesGrid->getConfig()->addComponent(new GridFieldOrderableRows('Sort'));

        $fields->addFieldToTab('Root.Main', $stagesGrid);

        return $fields;
    }
}
