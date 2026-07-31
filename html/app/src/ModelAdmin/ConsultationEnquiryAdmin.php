<?php

use SilverStripe\Admin\ModelAdmin;

/**
 * Read-only CMS listing of /meeting enquiry-form submissions, so the
 * "confirmed within one working day" promise never depends solely on
 * an inbox — per SILVERSTRIPE-BUILD-SPEC.md §5.4.
 */
class ConsultationEnquiryAdmin extends ModelAdmin
{
    private static $managed_models = [
        ConsultationEnquiry::class,
    ];

    private static $url_segment = 'consultation-enquiries';
    private static $menu_title = 'Consultation Enquiries';
    private static $menu_icon_class = 'font-icon-p-mail';
    private static $menu_priority = 15;
}
