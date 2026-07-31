<?php

use DNADesign\Elemental\Models\BaseElement;

class NewsletterSignUp extends BaseElement {
    private static $singular_name = 'Newsletter Sign Up';
    private static $plural_name = 'Newsletter Sign Ups';
    private static $table_name = 'NewsletterSignUp';

    private static $db = [
        'Title' => 'Varchar',
    ];

    private static $defaults = [
        'Title' => 'Newsletter Sign Up',
    ];

    public function getType()
    {
        return 'Newsletter Sign Up';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        return $fields;
    }
}