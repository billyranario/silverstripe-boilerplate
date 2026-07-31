<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;

/**
 * Picks one existing TeamMember record (reused, not duplicated, per
 * PHOTO-CREDITS.md/SILVERSTRIPE-BUILD-SPEC.md §5.1) into a
 * MeetingTeamGrid block, with an optional role-label override.
 *
 * RoleOverride exists because the handoff's campaign copy
 * (CONTENT.md) uses simplified role labels ("SENIOR ASSOCIATE",
 * "ASSOCIATE") that don't always match the site's own TeamMember.Role
 * text ("Senior Solicitor", etc). Leave blank to just show the site's
 * own role.
 */
class MeetingTeamPick extends DataObject
{
    private static $table_name = 'MeetingTeamPick';

    private static $db = [
        'RoleOverride' => 'Varchar(255)',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'MeetingTeamGrid' => MeetingTeamGrid::class,
        'TeamMember' => TeamMember::class,
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'TeamMember.Name' => 'Name',
        'TeamMember.Role' => 'Site role',
        'RoleOverride' => 'Campaign role override',
    ];

    public function getCMSFields()
    {
        return FieldList::create(
            DropdownField::create(
                'TeamMemberID',
                'Team member',
                TeamMember::get()->map('ID', 'Name')
            )->setEmptyString('-- select --'),
            TextField::create('RoleOverride', 'Role label override')
                ->setDescription('Leave blank to use the team member\'s own Role field.')
        );
    }

    public function getDisplayRole()
    {
        if ($this->RoleOverride) {
            return $this->RoleOverride;
        }

        return $this->TeamMember() ? $this->TeamMember()->Role : '';
    }
}
