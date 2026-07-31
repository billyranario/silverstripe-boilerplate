<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Control\Controller;

class BlogPost extends DataObject {
    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Author' => Author::class,
        'Image' => Image::class,
    ];

    private static $many_many = [
        'Categories' => Category::class,
        'Tags' => Tag::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'Author.Name' => 'Author',
    ];

    private static $searchable_fields = [
        'Title',
        'Content',
    ];

    public function getDateCreated() {
        $date = new DateTime($this->Created);
        return $date->format('d/m');
    }

    public function getYearCreated() {
        $date = new DateTime($this->Created);
        return $date->format('Y');
    }

    public function getFullDateCreated() {
        $date = new DateTime($this->Created);
        return $date->format('M d, Y');
    }

    public function getCategoryList() {
        $categories = $this->Categories()->column('Name');
        return implode(', ', $categories);
    }

    public function Link() {
        return Controller::join_links('blog', 'post', $this->ID);
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create(
            'Title',
            'Title'
        ));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create(
            'Content',
            'Content'
        ));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image')
            ->setFolderName('/Uploads/Blogs/ArticleImages')
        );
        $fields->addFieldToTab('Root.Main', DropdownField::create(
            'AuthorID',
            'Author',
            Author::get()->map('ID', 'Name')->toArray())
        );
        
        $categories = Category::get()->map('ID', 'Name')->toArray();
        $fields->addFieldToTab('Root.Main', CheckboxSetField::create(
            'Categories',
            'Categories',
            $categories
        ));

        $tags = Tag::get()->map('ID', 'Name')->toArray();
        $fields->addFieldToTab('Root.Main', CheckboxSetField::create(
            'Tags',
            'Tags',
            $tags
        ));

        return $fields;
    }
}