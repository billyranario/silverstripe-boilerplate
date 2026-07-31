<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * Two-column image + text pair, with a togglable image side.
 *
 * Distinct from the existing ImageTextHalf block: that one renders a
 * single HTMLText blob with no separate eyebrow/heading fields and
 * always places its content column first. This design needs a proper
 * eyebrow + heading + prose split and an image-left layout.
 *
 * Source reference: "Why MMP Lawyers" / "Established Nelson, 1991",
 * page 2 of "MMP Landing Redesign-1.pdf".
 */
class ImageTextPair extends BaseElement
{
    private static $singular_name = 'Image Text Pair';
    private static $plural_name = 'Image Text Pairs';
    private static $table_name = 'ImageTextPair';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'ImagePosition' => "Enum('Left,Right','Left')",
    ];

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

        $fields->removeByName(['Eyebrow', 'Heading', 'Content', 'ImagePosition']);

        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Image'));

        $fields->addFieldsToTab('Root.Main', [
            DropdownField::create('ImagePosition', 'Image position', [
                'Left' => 'Left',
                'Right' => 'Right',
            ]),
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('Heading', 'Heading'),
            HTMLEditorField::create('Content', 'Content')
                ->setDescription('Use <strong> for emphasis, matching the source copy.'),
        ]);

        return $fields;
    }
}
