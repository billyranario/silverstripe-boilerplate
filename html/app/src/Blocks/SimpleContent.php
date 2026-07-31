<?php

use DNADesign\Elemental\Models\BaseElement;

class SimpleContent extends BaseElement {
    private static $singular_name = 'Simple Content';
    private static $plural_name = 'Simple Contents';
    private static $table_name = 'SimpleContent';

    private static $db = [
        'Content' => 'HTMLText',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        return $fields;
    }

    public function getType() {
        return 'Simple Content';
    }
}
