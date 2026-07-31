<?php

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * The real enquiry form for /meeting (Private Vendor Counsel, VC·26)
 * — replaces the handoff reference's mailto: placeholder per the
 * locked-in decision (real form, writes to DB + emails reception).
 * Posts to MeetingEnquiryController (api/meeting/enquiry).
 */
class MeetingEnquiryForm extends BaseElement
{
    private static $singular_name = 'Meeting Enquiry Form';
    private static $plural_name = 'Meeting Enquiry Forms';
    private static $table_name = 'MeetingEnquiryForm';

    private static $inline_editable = false;

    private static $db = [
        'Eyebrow' => 'Varchar(255)',
        'Heading' => 'Varchar(255)',
        'IntroText' => 'Text',
        'SubmitLabel' => 'Varchar(255)',
        'PhoneText' => 'Varchar(255)',
        'PhoneLink' => 'Varchar(255)',
        'AnchorId' => 'Varchar(60)',
    ];

    private static $defaults = [
        'SubmitLabel' => 'Request your consultation',
        'AnchorId' => 'enquiry',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Eyebrow', 'Heading', 'IntroText', 'SubmitLabel',
            'PhoneText', 'PhoneLink', 'AnchorId',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Eyebrow', 'Eyebrow label'),
            TextField::create('Heading', 'Heading'),
            TextareaField::create('IntroText', 'Intro text'),
            TextField::create('SubmitLabel', 'Submit button label'),
            TextField::create('PhoneText', '"Or telephone" — display text'),
            TextField::create('PhoneLink', '"Or telephone" — tel: link'),
            TextField::create('AnchorId', 'Anchor id (for header nav / CTA links, no #)'),
        ]);

        return $fields;
    }

    /**
     * "success" | "error" | null — read from the redirect query string
     * MeetingEnquiryController sends back after a submission.
     */
    public function getSubmissionStatus()
    {
        $request = Controller::curr()->getRequest();

        return $request->getVar('enquiry');
    }

    /**
     * Records likely-print (no source) vs. digital arrivals, per
     * SILVERSTRIPE-BUILD-SPEC.md §5.5: "?s=p" or utm_source on the
     * querystring, blank if the visitor arrived with neither.
     */
    public function getSourceValue()
    {
        $request = Controller::curr()->getRequest();

        return $request->getVar('utm_source') ?: $request->getVar('s') ?: '';
    }
}
