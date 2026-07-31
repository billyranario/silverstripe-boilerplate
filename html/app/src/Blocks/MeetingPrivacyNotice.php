<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * "Privacy Act 2020 statement" — white, full content width, inside a
 * 1px hairline box (40px padding). Eyebrow and heading share a
 * baseline row; one long paragraph beneath. Legally load-bearing copy
 * — reproduce CONTENT.md verbatim, with working mailto:/tel: links —
 * per SILVERSTRIPE-BUILD-SPEC.md §3.10.
 */
class MeetingPrivacyNotice extends BaseElement
{
    private static $singular_name = 'Meeting Privacy Notice';
    private static $plural_name = 'Meeting Privacy Notices';
    private static $table_name = 'MeetingPrivacyNotice';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'Content' => 'HTMLText',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Eyebrow', 'Heading', 'Content']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label')
                ->setDescription('e.g. "PRIVACY ACT 2020"'),
            TextField::create('Heading', 'Heading'),
            HTMLEditorField::create('Content', 'Content')
                ->setDescription('Reproduce verbatim. Use real <a href="mailto:..."> and <a href="tel:..."> links.')
                ->setRows(8),
        ]);

        return $fields;
    }
}
