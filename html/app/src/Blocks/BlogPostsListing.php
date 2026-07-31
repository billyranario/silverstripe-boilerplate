<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Control\Controller;
use SilverStripe\Model\List\PaginatedList;

class BlogPostsListing extends BaseElement {
    private static $singular_name = 'Blog Posts Listing';
    private static $plural_name = 'Blog Posts Listings';
    private static $table_name = 'BlogPostsListing';

    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $defaults = [
        'Title' => 'Blog Posts Listing',
    ];

    public function getBlogPosts() {
        $blogPosts = BlogPost::get();

        // Get the current request
        $request = Controller::curr()->getRequest();

        // Create a PaginatedList
        $paginatedList = new PaginatedList($blogPosts, $request);
        $paginatedList->setPageLength(6); // Set the number of items per page

        return $paginatedList;
    }

    public function getAllCategories() {
        return Category::get();
    }

    public function getAllTags() {
        return Tag::get();
    }

    // Get latest 3 blog posts
    public function getLatestBlogPosts() {
        return BlogPost::get()->sort('Created', 'DESC')->limit(3);
    }

    public function getType() {
        return 'Blog Posts Listing';
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            LiteralField::create(
                'BlogPosts',
                '<p>Blog posts can be edited <a href="/admin/blogs" target="_blank">here</a</p>'
            ),
        );

        return $fields;
    }
}