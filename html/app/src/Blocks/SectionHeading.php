<?php

use DNADesign\Elemental\Models\BaseElement;

class SectionHeading extends BaseElement {
    private static $singular_name = 'Section Heading';
    private static $plural_name = 'Section Headings';
    private static $table_name = 'SectionHeading';

    private static $db = [
        'Content' => 'HTMLText',
        'ShowSiteLogo' => 'Boolean'
    ];

    private static $defaults = [
        'Title' => 'Section Heading'
    ];

    public function getType() {
        return 'Section Heading';
    }

}