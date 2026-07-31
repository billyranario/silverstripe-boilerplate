<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextField;

class HorizontalPageRule extends BaseElement {
    private static $singular_name = 'Horizontal Page Rule';
    private static $plural_name = 'Horizontal Page Rules';
    private static $table_name = 'HorizontalPageRule';

    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $defaults = [
        'Title' => 'Horizontal Page Rule',
    ];

    public function getType()
    {
        return 'Horizontal Page Rule';
    }
}