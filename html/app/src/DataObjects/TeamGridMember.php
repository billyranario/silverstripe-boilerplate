<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

/**
 * A single photo card in a CompactTeamGrid block.
 *
 * Deliberately separate from the site-wide TeamMember/TeamMemberGrid
 * (which renders full profile pages with bios and expertise tags) —
 * this is a small curated photo+name+role card for a single landing
 * page, not a link into the global team directory.
 */
class TeamGridMember extends DataObject
{
    private static $table_name = 'TeamGridMember';

    private static $db = [
        'Name' => 'Varchar(255)',
        'Role' => 'Varchar(255)',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'CompactTeamGrid' => CompactTeamGrid::class,
        'Photo' => Image::class,
    ];

    private static $owns = [
        'Photo',
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'Name' => 'Name',
        'Role' => 'Role',
    ];

    public function getCMSFields()
    {
        $fields = FieldList::create(
            UploadField::create('Photo', 'Photo'),
            TextField::create('Name', 'Name'),
            TextField::create('Role', 'Role')
        );

        return $fields;
    }
}
