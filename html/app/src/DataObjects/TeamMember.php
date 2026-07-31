<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\TagField\TagField;
use SilverStripe\ORM\ManyManyList;

class TeamMember extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Role' => 'Varchar',
        'Bio' => 'HTMLText',
        'Phone' => 'Varchar',
        'Email' => 'Varchar',
        'Facebook' => 'Varchar',
        'Twitter' => 'Varchar',
        'LinkedIn' => 'Varchar',
        'URI' => 'Varchar'
    ];

    private static $has_one = [
        'Photo' => Image::class
    ];

    private static $owns = [
        'Photo'
    ];

    private static $many_many = [
        'ExpertiseTags' => ExpertiseTag::class
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'Role' => 'Role',
        'Email' => 'Email',
        'Phone' => 'Phone'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Name'));
        $fields->addFieldToTab('Root.Main', TextField::create('Role'));
        $fields->addFieldToTab(
            'Root.Main',
            UploadField::create('Photo')
                ->setFolderName('Uploads/TeamMembers')
        );
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Bio'));
        $fields->addFieldToTab('Root.Main', TextField::create('Email'));
        $fields->addFieldToTab('Root.Main', TextField::create('Phone'));
        $fields->addFieldToTab('Root.Socials', TextField::create('Facebook'));
        $fields->addFieldToTab('Root.Socials', TextField::create('Twitter'));
        $fields->addFieldToTab('Root.Socials', TextField::create('LinkedIn'));

        $fields->addFieldToTab('Root.Main', TagField::create(
            'ExpertiseTags',
            'Expertise',
            ExpertiseTag::get(),
            $this->ExpertiseTags()
        )->setShouldLazyLoad(true)->setCanCreate(true));

        $fields->addFieldToTab('Root.Main', TextField::create('URI'));

        return $fields;
    }
}

class ExpertiseTag extends DataObject
{
    private static $db = [
        'Title' => 'Varchar(255)'
    ];

    private static $belongs_many_many = [
        'TeamMembers' => TeamMember::class
    ];

    private static $summary_fields = [
        'Title' => 'Title'
    ];
}
