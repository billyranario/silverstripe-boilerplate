<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Control\Controller;
use SilverStripe\Model\List\PaginatedList;

class JobListing extends BaseElement
{
    private static $singular_name = 'Job Listing';
    private static $plural_name = 'Job Listings';
    private static $table_name = 'JobListing';

    private static $inline_editable = false;

    private static $db = [
        'Title' => 'Varchar',
    ];

    private static $defaults = [
        'Title' => 'Job Listing',
    ];

    private static $many_many = [
        'Jobs' => Job::class,
    ];
    
    public function getType()
    {
        return 'Job Listing';
    }

    public function PaginatedJobs() {
        $jobs = $this->Jobs();

        // Get the current request
        $request = Controller::curr()->getRequest();

        // Create a PaginatedList
        $paginatedList = new PaginatedList($jobs, $request);
        $paginatedList->setPageLength(6); // Set the number of items per page

        return $paginatedList;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Jobs', GridField::create(
            'Jobs',
            'Jobs',
            $this->Jobs(),
            GridFieldConfig_RelationEditor::create()
        ));

        return $fields;
    }
}