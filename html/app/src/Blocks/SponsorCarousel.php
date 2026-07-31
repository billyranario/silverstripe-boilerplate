<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;

class SponsorCarousel extends BaseElement {
    private static $singular_name = 'Sponsor Carousel';
    private static $plural_name = 'Sponsor Carousel';
    private static $table_name = 'SponsorCarousel';

    private static $inline_editable = false;

    private static $many_many = [
        'Sponsors' => Sponsor::class
    ];

    public function getType()
    {
        return 'Sponsor Carousel';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', GridField::create(
            'Sponsors',
            'Sponsors',
            $this->Sponsors(),
            GridFieldConfig_RelationEditor::create()
        ));

        return $fields;
    }
}