<?php

use DNADesign\Elemental\Models\BaseElement;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class HeroCarousel extends BaseElement
{
    private static $singular_name = 'Hero Carousel';
    private static $plural_name = 'Hero Carousels';
    private static $table_name = 'Hero Carousel';

    private static $inline_editable = false;

    private static $has_many = [
        'Slides' => Hero::class,
    ];

    public function getType()
    {
        return 'Hero Carousel';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', GridField::create(
            'Slides',
            'Slides',
            $this->Slides(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }

    public function getFirstMobileImage()
    {
        // Get the first slide
        $firstSlide = $this->Slides()->first();

        // Check if the first slide exists and has a background image
        if ($firstSlide && $firstSlide->BackgroundImage && $firstSlide->BackgroundImage()->exists()) {
            // Return the mobile-optimized version of the background image
            return $firstSlide->BackgroundImage()->FillMax(520, 500)->getURL();
        }

        // Return null if there is no image
        return null;
    }
}