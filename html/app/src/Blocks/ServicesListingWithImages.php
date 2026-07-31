<?php

class ServicesListingWithImages extends ServicesListing {
    private static $singular_name = 'Services Listing With Images';
    private static $plural_name = 'Services Listings With Images';
    private static $table_name = 'ServicesListingWithImages';

    private static $defaults = [
        'Title' => 'Services Listing With Images',
    ];

    public function getType() {
        return 'Services Listing With Images';
    }
}