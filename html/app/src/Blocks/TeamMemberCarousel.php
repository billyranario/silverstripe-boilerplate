<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;

class TeamMemberCarousel extends BaseElement {
    private static $singular_name = 'Team Member Carousel';
    private static $plural_name = 'Team Member Carousels';
    private static $table_name = 'TeamMemberCarousel';

    private static $inline_editable = false;
    
    private static $db = [
        'HeadingContent' => 'HTMLText'
    ];

    private static $many_many = [
        'TeamMembers' => TeamMember::class
    ];

    public function getType()
    {
        return 'Team Member Carousel';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('HeadingContent'));
        $fields->addFieldToTab('Root.Main', GridField::create(
            'TeamMembers',
            'Team Members',
            $this->TeamMembers(),
            GridFieldConfig_RelationEditor::create()
        ));

        return $fields;
    }
}