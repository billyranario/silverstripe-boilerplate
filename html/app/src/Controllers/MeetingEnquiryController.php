<?php

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\Email\Email;

/**
 * Handles the real enquiry form on the /meeting (Private Vendor
 * Counsel, VC·26) page — per SILVERSTRIPE-BUILD-SPEC.md §5.4: writes a
 * ConsultationEnquiry record so the "confirmed within one working day"
 * promise never depends solely on an inbox, AND emails reception.
 *
 * Plain HTTPRequest handler (matching the existing MailchimpController
 * pattern in this codebase) rather than an Elemental per-element
 * controller — simpler and avoids Elemental's per-block routing for
 * what is, functionally, a standalone form POST.
 */
class MeetingEnquiryController extends Controller
{
    private static $allowed_actions = [
        'index',
    ];

    private const RECEPTION_EMAIL = 'reception@mmp.co.nz';

    public function index(HTTPRequest $request)
    {
        if (!$request->isPOST()) {
            return HTTPResponse::create('Invalid request method', 405)
                ->addHeader('Content-Type', 'text/plain');
        }

        $referer = $request->getHeader('Referer') ?: '/meeting';
        $redirectBase = strtok($referer, '?');

        // Honeypot: a field named to entice bots, hidden from humans via
        // CSS (not type="hidden", which some scrapers skip). If filled,
        // pretend success without saving or emailing anything.
        if ($request->postVar('Website')) {
            return $this->redirect($redirectBase . '?enquiry=success');
        }

        $name = trim((string) $request->postVar('Name'));
        $propertyAddress = trim((string) $request->postVar('PropertyAddress'));
        $phone = trim((string) $request->postVar('Phone'));
        $email = trim((string) $request->postVar('Email'));
        $preferredTime = trim((string) $request->postVar('PreferredTime'));
        $reference = trim((string) $request->postVar('Reference')) ?: 'VC·26';
        $source = trim((string) $request->postVar('Source'));

        if ($name === '' || $propertyAddress === '' || $phone === '') {
            return $this->redirect($redirectBase . '?enquiry=error#enquiry');
        }

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->redirect($redirectBase . '?enquiry=error#enquiry');
        }

        $enquiry = ConsultationEnquiry::create();
        $enquiry->Name = $name;
        $enquiry->PropertyAddress = $propertyAddress;
        $enquiry->Phone = $phone;
        $enquiry->Email = $email;
        $enquiry->PreferredTime = $preferredTime;
        $enquiry->Reference = $reference;
        $enquiry->Source = $source;
        $enquiry->EmailSent = $this->sendReceptionEmail($enquiry);
        $enquiry->write();

        return $this->redirect($redirectBase . '?enquiry=success#enquiry');
    }

    private function sendReceptionEmail(ConsultationEnquiry $enquiry): bool
    {
        try {
            $body = sprintf(
                "New consultation enquiry (Reference %s)\n\n" .
                "Name: %s\nProperty address: %s\nPhone: %s\nEmail: %s\n" .
                "Preferred time to be contacted: %s\nSource: %s\n",
                $enquiry->Reference,
                $enquiry->Name,
                $enquiry->PropertyAddress,
                $enquiry->Phone,
                $enquiry->Email ?: '(not provided)',
                $enquiry->PreferredTime ?: '(not specified)',
                $enquiry->Source ?: '(direct)'
            );

            $email = Email::create()
                ->setFrom(self::RECEPTION_EMAIL)
                ->setTo(self::RECEPTION_EMAIL)
                ->setSubject('New consultation enquiry — Reference ' . $enquiry->Reference)
                ->setBody($body);

            if ($enquiry->Email) {
                $email->setReplyTo($enquiry->Email);
            }

            $email->send();

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
