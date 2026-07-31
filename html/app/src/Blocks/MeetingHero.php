<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\RequiredFields;

/**
 * The /meeting (Private Vendor Counsel, VC·26) hero — 2-column grid,
 * eyebrow/H1/2 ledes/CTA+tel/reference rule on the left, a 520px-tall
 * photograph on the right, per SILVERSTRIPE-BUILD-SPEC.md §3.2.
 */
class MeetingHero extends BaseElement
{
    private static $singular_name = 'Meeting Hero';
    private static $plural_name = 'Meeting Heroes';
    private static $table_name = 'MeetingHero';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'LedeOne' => 'HTMLText',
        'LedeTwo' => 'HTMLText',
        'CtaText' => 'Varchar(255)',
        'CtaLink' => 'Varchar(255)',
        'PhoneText' => 'Varchar(255)',
        'PhoneLink' => 'Varchar(255)',
        'ReferenceLine' => 'Varchar(255)',
        'ImageAlt' => 'Varchar(255)',
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

        $fields->removeByName([
            'Eyebrow', 'Heading', 'LedeOne', 'LedeTwo', 'CtaText', 'CtaLink',
            'PhoneText', 'PhoneLink', 'ReferenceLine', 'ImageAlt',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('Heading', 'Heading (H1)'),
            HTMLEditorField::create('LedeOne', 'Paragraph 1')->setRows(4),
            HTMLEditorField::create('LedeTwo', 'Paragraph 2')->setRows(4),
            FieldGroup::create(
                TextField::create('CtaText', 'Button text'),
                TextField::create('CtaLink', 'Button link')
                    ->setDescription('e.g. "#enquiry" to jump to the form section')
            )->setTitle('Primary CTA'),
            FieldGroup::create(
                TextField::create('PhoneText', 'Display text'),
                TextField::create('PhoneLink', 'tel: link')
            )->setTitle('"Or telephone"'),
            TextField::create('ReferenceLine', 'Reference line')
                ->setDescription('e.g. "PRIVATE VENDOR COUNSEL · REFERENCE VC·26"'),
            UploadField::create('Image', 'Hero photograph'),
            TextField::create('ImageAlt', 'Image alt text'),
        ]);

        return $fields;
    }

    public function getCMSValidator()
    {
        return RequiredFields::create('Image');
    }
}
