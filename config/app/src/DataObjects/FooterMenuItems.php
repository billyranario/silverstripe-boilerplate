<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\SiteConfig\SiteConfig;

class FooterMenuItems extends DataObject
{
    private static $table_name = 'FooterMenuItems';

    private static $db = [
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        'SiteConfig' => SiteConfig::class,
        'PageLink' => SiteTree::class,
    ];

    private static $summary_fields = [
        'PageLink.MenuTitle' => 'Menu',
        'PageLink.Link' => 'URL',
    ];
    
    private static $default_sort = 'SortOrder ASC';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder', 
            'SiteConfigID', 
            'FooterMenuItemsID',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TreeDropdownField::create('PageLinkID', 'Page Link', SiteTree::class),
        ]);

        return $fields;
    }
}
