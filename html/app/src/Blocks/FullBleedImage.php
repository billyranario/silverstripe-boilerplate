<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\RequiredFields;

/**
 * A plain full-bleed photo band — no text, no overlay, no caption.
 * A breathing-room device between text-heavy sections.
 */
class FullBleedImage extends BaseElement
{
    private static $singular_name = 'Full Bleed Image';
    private static $plural_name = 'Full Bleed Images';
    private static $table_name = 'FullBleedImage';

    private static $inline_editable = false;

    private static $has_one = [
        'Image' => Image::class,
    ];

    private static $owns = [
        'Image',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Image'));

        return $fields;
    }

    public function getCMSValidator()
    {
        return RequiredFields::create('Image');
    }
}
