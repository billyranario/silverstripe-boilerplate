<?php

use SilverStripe\ORM\PaginatedList;

class BlogPostListingPage extends Page
{

}

class BlogPostListingPageController extends PageController
{
    // Helper function to get paginated blog posts
    public function PaginateBlogPosts($blogPosts) {
        $request = $this->getRequest();

        // Create a PaginatedList
        $paginatedList = new PaginatedList($blogPosts, $request);
        $paginatedList->setPageLength(6); // Set the number of items per page

        return $paginatedList;
    }

    // Figure out if user is in /blog/tag/ or /blog/category/ or /blog/author and return the appropriate blog posts
    public function getBlogPosts() {
        $tagID = $this->getRequest()->param('tagID');
        $categoryID = $this->getRequest()->param('categoryID');
        $authorID = $this->getRequest()->param('authorID');

        if ($tagID) {
            $tag = Tag::get()->byID($tagID);
            if ($tag) {
                return $this->PaginateBlogPosts($tag->BlogPosts());
            }
        } elseif ($categoryID) {
            $category = Category::get()->byID($categoryID);
            if ($category) {
                return $this->PaginateBlogPosts($category->BlogPosts());
            }
        } elseif ($authorID) {
            $author = Author::get()->byID($authorID);
            if ($author) {
                return $this->PaginateBlogPosts($author->BlogPosts());
            }
        }

        return null;
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