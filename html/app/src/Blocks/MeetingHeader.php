<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;

/**
 * The /meeting (Private Vendor Counsel, VC·26) page's own header —
 * mark + wordmark left, 3 in-page nav anchors + phone right, 1px
 * hairline underneath, not sticky. Used in place of the site's full
 * navigation header (paired with the Page-level "Hide site header"
 * toggle), per SILVERSTRIPE-BUILD-SPEC.md §3.1.
 *
 * Distinct from LetterheadBar (built for /private-vendor-counsel):
 * that block has no nav links and uses the site's own navy/gold
 * tokens. This one needs 3 anchors plus this campaign's own tokens.
 */
class MeetingHeader extends BaseElement
{
    private static $singular_name = 'Meeting Header';
    private static $plural_name = 'Meeting Headers';
    private static $table_name = 'MeetingHeader';

    private static $inline_editable = false;

    private static $db = [
        'NavLabel1' => 'Varchar(60)',
        'NavAnchor1' => 'Varchar(60)',
        'NavLabel2' => 'Varchar(60)',
        'NavAnchor2' => 'Varchar(60)',
        'NavLabel3' => 'Varchar(60)',
        'NavAnchor3' => 'Varchar(60)',
        'PhoneText' => 'Varchar(60)',
        'PhoneLink' => 'Varchar(60)',
    ];

    private static $has_one = [
        'MarkImage' => Image::class,
        'WordmarkImage' => Image::class,
    ];

    private static $owns = [
        'MarkImage',
        'WordmarkImage',
    ];

    private static $defaults = [
        'NavLabel1' => 'The offer',
        'NavAnchor1' => '#offer',
        'NavLabel2' => 'Your counsel',
        'NavAnchor2' => '#counsel',
        'NavLabel3' => 'How we begin',
        'NavAnchor3' => '#how-we-begin',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'NavLabel1', 'NavAnchor1', 'NavLabel2', 'NavAnchor2',
            'NavLabel3', 'NavAnchor3', 'PhoneText', 'PhoneLink',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            UploadField::create('MarkImage', 'Mark (icon only)')
                ->setDescription('assets/brand/mmp-mark.png from the handoff.'),
            UploadField::create('WordmarkImage', 'Wordmark')
                ->setDescription('Use the transparent version — assets/brand/mmp-wordmark-transparent.png.'),
            FieldGroup::create(
                TextField::create('NavLabel1', 'Label'),
                TextField::create('NavAnchor1', 'Anchor (e.g. #offer)')
            )->setTitle('Nav item 1'),
            FieldGroup::create(
                TextField::create('NavLabel2', 'Label'),
                TextField::create('NavAnchor2', 'Anchor')
            )->setTitle('Nav item 2'),
            FieldGroup::create(
                TextField::create('NavLabel3', 'Label'),
                TextField::create('NavAnchor3', 'Anchor')
            )->setTitle('Nav item 3'),
            FieldGroup::create(
                TextField::create('PhoneText', 'Display text'),
                TextField::create('PhoneLink', 'tel: link')
            )->setTitle('Phone'),
        ]);

        return $fields;
    }
}
