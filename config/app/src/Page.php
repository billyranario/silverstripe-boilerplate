<?php

namespace {

    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Assets\Image;
    use SilverStripe\CMS\Model\SiteTree;

    class Page extends SiteTree
    {
        private static $db = [];

        private static $has_one = [
            'Thumbnail' => Image::class,
        ];

        private static $owns = [
            'Thumbnail',
        ];

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();

            $fields->removeByName(['Metadata']);

            $fields->addFieldToTab('Root.Images', 
                UploadField::create('Thumbnail', 'Page Thumbnail')
                    ->setFolderName('Thumbnails')
                    ->setAllowedFileCategories('image')
            );

            return $fields;
        }
    }
}
