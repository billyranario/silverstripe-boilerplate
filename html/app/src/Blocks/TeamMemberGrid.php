<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\LiteralField;

class TeamMemberGrid extends BaseElement {
    private static $singular_name = 'Team Member Grid';
    private static $plural_name = 'Team Member Grids';
    private static $table_name = 'TeamMemberGrid';

    private static $defaults = [
        'Title' => 'Team Member Grid'
    ];

    public function getType()
    {
        return 'Team Member Grid';
    }

    public function TeamMembers()
    {
        return TeamMember::get();
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', LiteralField::create(
            'Team Member Grid Info',
            '<p>Team member details can be edited <a href="/admin/team-members" target="_blank">here</a></p>'
        ));

        return $fields;
    }
}