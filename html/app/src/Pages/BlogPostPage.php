<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\DataObject;

class BlogPostPage extends Page
{
    
}

class BlogPostPageController extends PageController {
    private static $allowed_actions = [
        'post'
    ];

    protected $blogPostID;

    public function init() {
        parent::init();

        // Get the ID from the URL
        $urlParams = $this->getRequest()->allParams();
        $this->blogPostID = isset($urlParams['ID']) ? $urlParams['ID'] : null;
    }

    public function getBlogPost() {
        return BlogPost::get()->byID($this->blogPostID);
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
}