<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldConfig;
use Symbiote\GridFieldExtensions\GridFieldAddNewInlineButton;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;

class GlobalSettingsExtension extends Extension
{
    private static $db = [
        'Phone' => 'Varchar(50)',
        'Mobile' => 'Varchar(50)',
        'Email' => 'Varchar(100)',
        'Address' => 'Text',
    ];
    
    private static $many_many = [
        'FooterMenuItems' => SiteTree::class
    ];

    private static $has_one = [
        'Logo' => Image::class,
        'Favicon' => Image::class
    ];

    private static $owns = [
        'Logo',
        'Favicon'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('Tagline');
        $fields->addFieldToTab('Root.Main', TextField::create('Phone', 'Phone'));
        $fields->addFieldToTab('Root.Main', TextField::create('Mobile', 'Mobile'));
        $fields->addFieldToTab('Root.Main', TextField::create('Email', 'Email'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Address', 'Address'));

        $fields->addFieldToTab('Root.Main', UploadField::create('Logo', 'Logo')
            ->setFolderName('Logos')
            ->setAllowedFileCategories('image'));

        $fields->addFieldToTab('Root.Main', UploadField::create('Favicon', 'Favicon')
            ->setFolderName('Favicons')
            ->setAllowedFileCategories('image'));

        // Footer Menu
        $footerMenuConfig = GridFieldConfig::create()
            ->addComponent(new GridFieldToolbarHeader())
            ->addComponent(new GridFieldEditableColumns())
            ->addComponent(new GridFieldDeleteAction())
            ->addComponent(new GridFieldOrderableRows('SortOrder'))
            ->addComponent(new GridFieldAddNewInlineButton('toolbar-header-right')) // Inline add (no redirect)
            ->addComponent(new GridFieldAddExistingAutocompleter());

        $footerMenuColumns = $footerMenuConfig->getComponentByType(GridFieldEditableColumns::class);
        $footerMenuColumns->setDisplayFields([
            'PageLinkID' => [
                'title' => 'Page',
                'callback' => function ($record, $column, $grid) {
                    if ($record->exists()) {
                        return TreeDropdownField::create($column, 'Page', SiteTree::class)
                            ->setForm($grid->getForm());
                    }
                    return TextField::create($column, 'Page')
                        ->setReadonly(true)
                        ->setAttribute('value', 'Save the record first to select a page.');
                }
            ]
        ]);

        $fields->addFieldToTab("Root.FooterMenu", GridField::create(
            "FooterMenuItems",
            "Footer Menu",
            $this->owner->FooterMenuItems(),
            $footerMenuConfig
        ));
    }

    public function onAfterWrite(): void
    {
        foreach (['Logo', 'Favicon'] as $imageField) {
            $image = $this->owner->{$imageField}();
            if ($image && $image->isInDB() && $image->isOnDraft()) {
                $image->publishSingle();
            }
        }
    }
}
