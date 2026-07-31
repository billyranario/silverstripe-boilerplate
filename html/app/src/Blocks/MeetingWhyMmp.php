<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\ToggleCompositeField;

/**
 * "Why MMP" — white, 2 columns (0.9fr heading / 1.1fr paragraphs +
 * rule-topped italic testimonial), per SILVERSTRIPE-BUILD-SPEC.md
 * §3.7. No image — distinct from ImageTextPair (built for
 * /private-vendor-counsel, which always pairs an image).
 */
class MeetingWhyMmp extends BaseElement
{
    private static $singular_name = 'Meeting Why MMP';
    private static $plural_name = 'Meeting Why MMP Blocks';
    private static $table_name = 'MeetingWhyMmp';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'ParagraphOne' => 'HTMLText',
        'ParagraphTwo' => 'HTMLText',
        'TestimonialQuote' => 'Varchar(255)',
        'TestimonialAttribution' => 'Varchar(255)',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Eyebrow', 'Heading', 'ParagraphOne', 'ParagraphTwo',
            'TestimonialQuote', 'TestimonialAttribution',
        ]);

        $fields->addFieldToTab('Root.Main', ToggleCompositeField::create(
            'LeftColumn',
            'Left column (heading)',
            [
                TextField::create('Eyebrow', 'Eyebrow label'),
                TextField::create('Heading', 'Heading (H2)'),
            ]
        )->setStartClosed(false));

        $fields->addFieldToTab('Root.Main', ToggleCompositeField::create(
            'RightColumn',
            'Right column (paragraphs + testimonial)',
            [
                HTMLEditorField::create('ParagraphOne', 'Paragraph 1')->setRows(4),
                HTMLEditorField::create('ParagraphTwo', 'Paragraph 2')->setRows(4),
                TextField::create('TestimonialQuote', 'Testimonial quote')
                    ->setDescription('Rendered in italics, rule above it.'),
                TextField::create('TestimonialAttribution', 'Testimonial attribution')
                    ->setDescription('e.g. "Phillip Jordan"'),
            ]
        )->setStartClosed(false));

        return $fields;
    }
}
