<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;

class TestimonialCarousel extends BaseElement
{
    private static $singular_name = 'Testimonial Carousel';
    private static $plural_name = 'Testimonial Carousels';
    private static $table_name = 'TestimonialCarousel';

    private static $inline_editable = false;

    private static $db = [
        'Title' => 'Varchar(255)',
    ];

    private static $has_one = [
        'BackgroundImage' => Image::class,
    ];

    private static $many_many = [
        'Testimonials' => Testimonial::class,
    ];

    private static $owns = [
        'Testimonials',
        'BackgroundImage',
    ];

    public function getType()
    {
        return 'Testimonial Carousel';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', UploadField::create('BackgroundImage')
            ->setFolderName('Uploads/BackgroundImages')
        );
        $fields->addFieldToTab(
            'Root.Main',
            GridField::create(
                'Testimonials',
                'Testimonials',
                $this->Testimonials(),
                GridFieldConfig_RelationEditor::create()
            )
        );

        return $fields;
    }
}