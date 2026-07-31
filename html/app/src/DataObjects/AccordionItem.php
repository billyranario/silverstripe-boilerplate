<?php

use SilverStripe\ORM\DataObject;

class AccordionItem extends DataObject {
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Accordion' => Accordion::class,
    ];

    private static $summary_fields = [
        'Title' => 'Title',
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        return $fields;
    }
}