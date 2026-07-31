<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Forms\CheckboxField;

    class Page extends SiteTree
    {
        private static $db = [
            'HideHeader' => 'Boolean',
            'HideFooter' => 'Boolean',
            'NoIndex' => 'Boolean',
        ];

        private static $has_one = [];

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();

            $fields->addFieldsToTab('Root.Settings', [
                CheckboxField::create('HideHeader', 'Hide site header on this page')
                    ->setDescription('For standalone/campaign pages that need to render without the usual site navigation.'),
                CheckboxField::create('HideFooter', 'Hide site footer on this page'),
                CheckboxField::create('NoIndex', 'Exclude this page from search engines (noindex)')
                    ->setDescription('Adds <meta name="robots" content="noindex,follow">. Also untick "Show in menus" (Root.Main) separately if it should be hidden from navigation.'),
            ]);

            return $fields;
        }
    }
}
