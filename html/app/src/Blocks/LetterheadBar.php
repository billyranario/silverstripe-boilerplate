<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;

/**
 * Minimal letterhead-style header bar — wordmark, a short tagline and
 * a boxed phone number. Used in place of the site's full navigation
 * header on standalone campaign/landing pages (paired with the
 * Page-level "Hide site header" toggle).
 */
class LetterheadBar extends BaseElement
{
    private static $singular_name = 'Letterhead Bar';
    private static $plural_name = 'Letterhead Bars';
    private static $table_name = 'LetterheadBar';

    private static $inline_editable = false;

    private static $db = [
        'Wordmark' => 'Varchar(255)',
        'Tagline' => 'Varchar(255)',
        'PhoneText' => 'Varchar(255)',
        'PhoneLink' => 'Varchar(255)',
    ];

    private static $defaults = [
        'Wordmark' => 'MMP Lawyers',
        'Tagline' => 'Nelson · Est. 1991',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Wordmark', 'Tagline', 'PhoneText', 'PhoneLink']);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Wordmark', 'Wordmark text'),
            TextField::create('Tagline', 'Tagline')
                ->setDescription('e.g. "Nelson · Est. 1991"'),
            FieldGroup::create(
                TextField::create('PhoneText', 'Phone display text'),
                TextField::create('PhoneLink', 'Phone tel: link')
            )->setTitle('Phone'),
        ]);

        return $fields;
    }
}
