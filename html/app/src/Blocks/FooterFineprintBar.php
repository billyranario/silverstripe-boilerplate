<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

/**
 * A minimal footer replacement — a single fine-print paragraph, used
 * in place of the site's full multi-column footer on standalone
 * campaign/landing pages (paired with the Page-level "Hide site
 * footer" toggle).
 */
class FooterFineprintBar extends BaseElement
{
    private static $singular_name = 'Footer Fineprint Bar';
    private static $plural_name = 'Footer Fineprint Bars';
    private static $table_name = 'FooterFineprintBar';

    private static $inline_editable = false;

    private static $db = [
        'Content' => 'HTMLText',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Content']);

        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Content', 'Content')
            ->setDescription('Use <a> for policy links, matching the source copy.')
            ->setRows(4));

        return $fields;
    }
}
