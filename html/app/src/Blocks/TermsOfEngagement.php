<?php

use DNADesign\Elemental\Models\BaseElement;

class TermsOfEngagement extends BaseElement {
    private static $singular_name = 'Terms Of Engagement Content';
    private static $plural_name = 'Terms Of Engagement Contents';
    private static $table_name = 'TermsOfEngagementContent';

    private static $db = [
        'Content' => 'HTMLText',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        return $fields;
    }

    public function getType() {
        return 'Terms Of Engagement Content';
    }
}
