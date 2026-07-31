<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;

/**
 * A single photo tile ("Nelson" / "Tasman" / "The West Coast") in a
 * MeetingRegionGrid block, per SILVERSTRIPE-BUILD-SPEC.md §3.8.
 */
class MeetingRegionTile extends DataObject
{
    private static $table_name = 'MeetingRegionTile';

    private static $db = [
        'Title' => 'Varchar(255)',
        'Caption' => 'Varchar(255)',
        'Alt' => 'Varchar(255)',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'MeetingRegionGrid' => MeetingRegionGrid::class,
        'Image' => Image::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $default_sort = 'Sort';

    private static $summary_fields = [
        'Title' => 'Title',
        'Caption' => 'Caption',
    ];

    public function getCMSFields()
    {
        return FieldList::create(
            UploadField::create('Image', 'Image'),
            TextField::create('Title', 'Title'),
            TextField::create('Caption', 'Caption'),
            TextField::create('Alt', 'Image alt text')
        );
    }
}
