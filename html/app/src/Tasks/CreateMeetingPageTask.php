<?php

use SilverStripe\Assets\Folder;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\BuildTask;
use SilverStripe\Versioned\Versioned;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * One-off task: creates the /meeting page (Private Vendor Counsel,
 * reference VC·26) per the formal developer handoff
 * (~/Downloads/handoff/SILVERSTRIPE-BUILD-SPEC.md + CONTENT.md),
 * superseding the earlier /first-response build which used the wrong
 * design file.
 *
 * Locked-in decisions (see session history): build fresh at /meeting
 * (letters not yet mailed, no redirect needed), a real enquiry form
 * (not the reference's mailto: placeholder), noindex + hidden from
 * nav (invitation-only campaign page).
 *
 * Safe to re-run: if a page with URLSegment 'meeting' already exists,
 * its existing ElementalArea elements are removed and rebuilt from
 * scratch rather than duplicated.
 */
class CreateMeetingPageTask extends BuildTask
{
    private static string $segment = 'CreateMeetingPage';

    protected string $title = 'Create /meeting (Private Vendor Counsel, VC·26) page';

    protected static string $description = 'Creates/rebuilds the /meeting page per the formal handoff spec and verbatim CONTENT.md copy.';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        // See CreateFirstResponsePageTask for why this is required in a
        // bare CLI/sake context — without it every element below writes
        // with ParentID=0: present in the DB, invisible on the page.
        Versioned::set_stage(Versioned::DRAFT);

        $page = Page::get()->filter('URLSegment', 'meeting')->first();

        if ($page && $page->exists()) {
            $output->writeln('Existing page found — clearing its elements before rebuild.');
            foreach ($page->ElementalArea()->Elements() as $existing) {
                $existing->delete();
            }
        } else {
            $page = Page::create();
            $page->Title = 'Private Vendor Counsel — MMP Lawyers';
            $page->URLSegment = 'meeting';
        }

        $page->MetaDescription = 'The sale of your home deserves counsel, not a call centre. Reserve a complimentary consultation with a senior property lawyer — MMP Lawyers, Nelson.';
        $page->ShowInSearch = false;
        $page->ShowInMenus = false; // invitation-only campaign page — locked-in decision
        $page->NoIndex = true;      // locked-in decision: noindex + hide from nav
        $page->HideHeader = true;   // uses its own MeetingHeader block instead
        $page->HideFooter = true;   // uses its own FooterFineprintBar instead
        $page->write();

        $area = $page->ElementalArea();
        $sort = 0;

        $folder = Folder::find_or_make('Uploads/Meeting');
        $markImage = $this->importImage('meeting-mmp-mark.png', $folder, $output);
        $wordmarkImage = $this->importImage('meeting-mmp-wordmark.png', $folder, $output);
        $heroImage = $this->importImage('meeting-hero.jpg', $folder, $output, 'Dummy Bay, Kaiteriteri');
        $bandImage = $this->importImage('meeting-band.jpg', $folder, $output, 'Boulder Bank lighthouse, Nelson');
        $nelsonImage = $this->importImage('meeting-nelson.jpg', $folder, $output, 'Nelson city and Boulder Bank');
        $tasmanImage = $this->importImage('meeting-tasman.jpg', $folder, $output, 'Kaiteriteri Beach, Tasman');
        $westImage = $this->importImage('meeting-west.jpg', $folder, $output, 'Pancake Rocks, Punakaiki');

        // 1. Header
        $header = MeetingHeader::create();
        $header->Title = 'Header — mark, wordmark, nav, phone';
        $header->MarkImageID = $markImage->ID;
        $header->WordmarkImageID = $wordmarkImage->ID;
        $header->NavLabel1 = 'The offer';
        $header->NavAnchor1 = '#offer';
        $header->NavLabel2 = 'Your counsel';
        $header->NavAnchor2 = '#counsel';
        $header->NavLabel3 = 'How we begin';
        $header->NavAnchor3 = '#how-we-begin';
        $header->PhoneText = '03 548 2154';
        $header->PhoneLink = 'tel:035482154';
        $header->ParentID = $area->ID;
        $header->Sort = ++$sort;
        $header->write();

        // 2. Hero
        $hero = MeetingHero::create();
        $hero->Title = 'Hero — The sale of your home deserves counsel';
        $hero->Eyebrow = 'BY INVITATION · VENDORS IN NELSON, TASMAN & THE WEST COAST';
        $hero->Heading = 'The sale of your home deserves counsel, not a call centre.';
        $hero->LedeOne = 'The lawyer you appoint now will hold your title, your deposit and, in due course, every dollar of your settlement. Most vendors make that appointment in an afternoon, sight unseen, only to discover mid-negotiation whose hands their sale actually rests in.';
        $hero->LedeTwo = 'We believe work of this weight belongs in senior hands from the first conversation to the day your proceeds clear.';
        $hero->CtaText = 'Request your consultation';
        $hero->CtaLink = '#enquiry';
        $hero->PhoneText = 'or telephone 03 548 2154';
        $hero->PhoneLink = 'tel:035482154';
        $hero->ReferenceLine = 'PRIVATE VENDOR COUNSEL · REFERENCE VC·26';
        $hero->ImageID = $heroImage->ID;
        $hero->ImageAlt = 'Dummy Bay, Kaiteriteri';
        $hero->ParentID = $area->ID;
        $hero->Sort = ++$sort;
        $hero->write();

        // 3. The offer
        $offer = MeetingNumberedGrid::create();
        $offer->Title = 'The offer — four things we put in writing';
        $offer->Eyebrow = 'THE OFFER · PRIVATE VENDOR COUNSEL';
        $offer->ReferenceLabel = 'REFERENCE VC·26';
        $offer->Heading = 'Four things we put in writing, so that you may hold us to them.';
        $offer->Columns = '2';
        $offer->RuleBottom = true;
        $offer->AnchorId = 'offer';
        $offer->ParentID = $area->ID;
        $offer->Sort = ++$sort;
        $offer->write();

        $this->writeNumberedItems($offer, [
            ['Title' => 'A complimentary private consultation', 'Description' => 'With a senior property lawyer, either at our Hardy Street chambers, at your property, or by video, before you accept any offer. The half hour costs you nothing, taken before you sign.'],
            ['Title' => 'One senior lawyer, beginning to end', 'Description' => "Your matter is overseen by a senior lawyer; you hold your counsel's direct line and personal email. Experienced legal executives will assist to keep your matter organised and progressing."],
            ['Title' => 'Counsel when offers actually arrive', 'Description' => 'Private and Trade Me offers land on evenings and weekends, your lawyer reviews them quickly, not next Tuesday.'],
            ['Title' => 'A single professional fee, in writing', 'Description' => 'Confirmed at engagement. No hourly billing, no meter running while you negotiate, unless, of course, your matter becomes complex.'],
        ]);

        // 4. Your counsel
        $team = MeetingTeamGrid::create();
        $team->Title = 'Your counsel — senior hands, known by name';
        $team->Eyebrow = 'YOUR COUNSEL';
        $team->Heading = 'Senior hands, known by name.';
        $team->SupportingText = 'One of these lawyers will be yours from the first conversation to the day your proceeds clear, and you will hold their direct line.';
        $team->AnchorId = 'counsel';
        $team->ParentID = $area->ID;
        $team->Sort = ++$sort;
        $team->write();

        $this->writeTeamPicks($team, [
            ['Name' => 'Alex Reith', 'RoleOverride' => ''],
            ['Name' => 'Nigel McFadden', 'RoleOverride' => ''],
            ['Name' => 'Sam Sullivan', 'RoleOverride' => ''],
            ['Name' => 'William Rasburn', 'RoleOverride' => 'Senior Associate'],
            ['Name' => 'Callum Osborne', 'RoleOverride' => 'Associate'],
            ['Name' => 'Senna Dodd', 'RoleOverride' => ''],
        ], $output);

        // 5. The engagement
        $engagement = MeetingEngagementColumns::create();
        $engagement->Title = 'The engagement — before / during / after';
        $engagement->Eyebrow = 'THE ENGAGEMENT';
        $engagement->Heading = 'What personal counsel looks like in practice.';
        $engagement->ParentID = $area->ID;
        $engagement->Sort = ++$sort;
        $engagement->write();

        $stageSort = 0;
        foreach ([
            ['Label' => 'BEFORE', 'Title' => 'Your position, examined', 'Description' => 'Title, LIM and agency agreement read before an offer exists, so that nothing arrives as a surprise on a Saturday afternoon.'],
            ['Label' => 'DURING', 'Title' => 'Every offer, weighed', 'Description' => 'Each offer read against your position rather than its headline price: conditions, dates, deposit, and what it costs you should it fail.'],
            ['Label' => 'AFTER', 'Title' => 'Settlement, personally seen through', 'Description' => 'The same lawyer sees the matter to settlement and confirms, to you, that every dollar of your proceeds has cleared.'],
        ] as $data) {
            $stage = MeetingEngagementStage::create();
            $stage->Label = $data['Label'];
            $stage->Title = $data['Title'];
            $stage->Description = $data['Description'];
            $stage->Sort = ++$stageSort;
            $stage->MeetingEngagementColumnsID = $engagement->ID;
            $stage->write();
        }

        // 6. Nelson photo band (reusing the generic FullBleedImage block)
        $band = FullBleedImage::create();
        $band->Title = 'Photo band — Boulder Bank lighthouse, Nelson';
        $band->ImageID = $bandImage->ID;
        $band->ParentID = $area->ID;
        $band->Sort = ++$sort;
        $band->write();

        // 7. Why MMP
        $why = MeetingWhyMmp::create();
        $why->Title = 'Why MMP — established Nelson, 1991';
        $why->Eyebrow = 'WHY MMP LAWYERS';
        $why->Heading = 'Established Nelson, 1991.';
        $why->ParagraphOne = 'MMP was founded by Nigel McFadden, Jane McMeeken and David Phillips, and is one of the oldest firms still practising in the region. Three decades of Nelson and Tasman titles have passed across these desks.';
        $why->ParagraphTwo = 'This attention does not scale, so we will not pretend otherwise: we accept twelve new vendor engagements each month across the three regions.';
        $why->TestimonialQuote = 'Good people, working for you.';
        $why->TestimonialAttribution = 'Phillip Jordan';
        $why->ParentID = $area->ID;
        $why->Sort = ++$sort;
        $why->write();

        // 8. The three regions
        $regions = MeetingRegionGrid::create();
        $regions->Title = 'The three regions we serve';
        $regions->Eyebrow = 'THE THREE REGIONS WE SERVE';
        $regions->AnchorId = 'regions';
        $regions->ParentID = $area->ID;
        $regions->Sort = ++$sort;
        $regions->write();

        $tileSort = 0;
        foreach ([
            ['Title' => 'Nelson', 'Caption' => 'CHAMBERS ON HARDY STREET', 'Alt' => 'Nelson city and Boulder Bank', 'Image' => $nelsonImage],
            ['Title' => 'Tasman', 'Caption' => 'MAPUA TO GOLDEN BAY', 'Alt' => 'Kaiteriteri Beach, Tasman', 'Image' => $tasmanImage],
            ['Title' => 'The West Coast', 'Caption' => 'WESTPORT TO HOKITIKA', 'Alt' => 'Pancake Rocks, Punakaiki', 'Image' => $westImage],
        ] as $data) {
            $tile = MeetingRegionTile::create();
            $tile->Title = $data['Title'];
            $tile->Caption = $data['Caption'];
            $tile->Alt = $data['Alt'];
            $tile->ImageID = $data['Image']->ID;
            $tile->Sort = ++$tileSort;
            $tile->MeetingRegionGridID = $regions->ID;
            $tile->write();
        }

        // 9. How we begin
        $begin = MeetingNumberedGrid::create();
        $begin->Title = 'How we begin — 01/02/03';
        $begin->Eyebrow = 'THE MANNER OF ENGAGEMENT';
        $begin->Heading = 'How we begin.';
        $begin->Columns = '3';
        $begin->RuleBottom = false;
        $begin->AnchorId = 'how-we-begin';
        $begin->ParentID = $area->ID;
        $begin->Sort = ++$sort;
        $begin->write();

        $this->writeNumberedItems($begin, [
            ['Title' => 'You reply, at your convenience', 'Description' => 'Telephone 03 548 2154 or write to reception@mmp.co.nz, mentioning reference VC·26. Your consultation will be confirmed within one working day.'],
            ['Title' => 'We meet, without obligation', 'Description' => 'Half an hour at our Hardy Street chambers, at your property, or by video. You leave with our view of your position, whether or not you engage us.'],
            ['Title' => 'Your counsel stands ready', 'Description' => 'Should you appoint us, the same senior lawyer carries the matter from that conversation through to settlement.'],
        ]);

        // 10. Enquiry form (real form — locked-in decision, replaces the
        // reference render's mailto: placeholder)
        $form = MeetingEnquiryForm::create();
        $form->Title = 'Enquiry form — request your consultation';
        $form->Eyebrow = 'REQUEST YOUR CONSULTATION';
        $form->Heading = 'Reserve your complimentary consultation.';
        $form->IntroText = 'Tell us a little about your property and when suits you — we confirm every enquiry within one working day.';
        $form->SubmitLabel = 'Request your consultation';
        $form->PhoneText = 'or telephone 03 548 2154';
        $form->PhoneLink = 'tel:035482154';
        $form->AnchorId = 'enquiry';
        $form->ParentID = $area->ID;
        $form->Sort = ++$sort;
        $form->write();

        // 11. Privacy Act 2020 statement — legally load-bearing, verbatim
        $privacy = MeetingPrivacyNotice::create();
        $privacy->Title = 'Privacy Act 2020 — a word on how we wrote to you';
        $privacy->Eyebrow = 'PRIVACY ACT 2020';
        $privacy->Heading = 'A word on how we wrote to you';
        $privacy->Content = 'You received our letter because your property is publicly advertised for sale, and courtesy obliges us to be as careful with your information as we would be with your title. The address details used for this single introduction were compiled from publicly available listing information by our marketing partner ValueProp, as the Privacy Act 2020 permits. They are held securely in New Zealand, used for no other purpose, never sold or shared, and removed when the campaign concludes or your property sells. The Act entitles you to see the information we hold, to correct it, or to have it deleted, and we honour each request without question. Should you prefer no further correspondence, a brief reply to <a href="mailto:reception@mmp.co.nz">reception@mmp.co.nz</a> or a call to <a href="tel:035482154">03 548 2154</a> will see your details removed within five working days. Our Privacy Officer may be reached at the same address, and the Office of the Privacy Commissioner (privacy.org.nz) is available to you should any concern remain.';
        $privacy->ParentID = $area->ID;
        $privacy->Sort = ++$sort;
        $privacy->write();

        // 12. Closing band (navy) — reusing CentredStatement's 'Meeting' variant
        $closing = CentredStatement::create();
        $closing->Title = 'Closing CTA — twelve engagements this month';
        $closing->Eyebrow = 'PRIVATE VENDOR COUNSEL · REFERENCE VC·26';
        $closing->Heading = 'Twelve engagements this month. One of them, if you wish, is yours.';
        $closing->Prose = 'Reserve a complimentary consultation with a senior property lawyer before your first offer arrives.';
        $closing->ButtonText = 'Request your consultation';
        $closing->ButtonLink = '#enquiry';
        $closing->SecondaryText = 'or telephone 03 548 2154';
        $closing->SecondaryLink = 'tel:035482154';
        $closing->FootnoteLine = '<a href="mailto:reception@mmp.co.nz">reception@mmp.co.nz</a> · <a href="tel:035482154">03 548 2154</a> · Level 2, 241 Hardy Street, Nelson';
        $closing->Variant = 'Meeting';
        $closing->Ruled = false;
        $closing->ParentID = $area->ID;
        $closing->Sort = ++$sort;
        $closing->write();

        // 13. Footer (reusing the generic FooterFineprintBar block)
        $footer = FooterFineprintBar::create();
        $footer->Title = 'Footer — firm line, small print, photo credits';
        $footer->Content = $this->footerContent();
        $footer->ParentID = $area->ID;
        $footer->Sort = ++$sort;
        $footer->write();

        $page->publishRecursive();

        $output->writeln("Done. Page ID {$page->ID}, URL segment '{$page->URLSegment}', {$sort} elements created and published.");

        return Command::SUCCESS;
    }

    /**
     * @param array<int, array{Title: string, Description: string}> $items
     */
    private function writeNumberedItems(MeetingNumberedGrid $grid, array $items): void
    {
        $itemSort = 0;
        foreach ($items as $data) {
            $item = MeetingNumberedItem::create();
            $item->Title = $data['Title'];
            $item->Description = $data['Description'];
            $item->Sort = ++$itemSort;
            $item->MeetingNumberedGridID = $grid->ID;
            $item->write();
        }
    }

    /**
     * @param array<int, array{Name: string, RoleOverride: string}> $picks
     */
    private function writeTeamPicks(MeetingTeamGrid $grid, array $picks, OutputInterface $output): void
    {
        $pickSort = 0;
        foreach ($picks as $data) {
            $member = TeamMember::get()->filter('Name', $data['Name'])->first();

            if (!$member || !$member->exists()) {
                $output->writeln("WARNING: no existing TeamMember record found for '{$data['Name']}' — skipped.");
                continue;
            }

            $pick = MeetingTeamPick::create();
            $pick->TeamMemberID = $member->ID;
            $pick->RoleOverride = $data['RoleOverride'];
            $pick->Sort = ++$pickSort;
            $pick->MeetingTeamGridID = $grid->ID;
            $pick->write();
        }
    }

    private function importImage(string $filename, Folder $folder, OutputInterface $output, string $title = ''): Image
    {
        $existing = Image::get()->filter([
            'ParentID' => $folder->ID,
            'Name' => $filename,
        ])->first();

        if ($existing && $existing->exists()) {
            return $existing;
        }

        $sourcePath = BASE_PATH . '/public/assets/_tmp-import/' . $filename;

        $image = Image::create();
        $image->setFromLocalFile($sourcePath, 'Uploads/Meeting/' . $filename);
        $image->ParentID = $folder->ID;
        $image->Title = $title ?: str_replace(['meeting-', '.jpg', '.png'], '', $filename);
        $image->write();
        $image->publishSingle();

        $output->writeln("Imported image: {$filename}");

        return $image;
    }

    private function footerContent(): string
    {
        return '<p><strong>MMP Lawyers</strong> · Level 2, 241 Hardy Street, Nelson · Serving Nelson, Tasman and the West Coast since 1991 · Correspondence delivered in association with ValueProp.</p>'
            . '<p class="mt-4">The complimentary consultation and written fee confirmation carry no obligation to engage. Our fixed professional fee is confirmed in writing before work begins and covers a standard residential sale; titles or ownership structures of unusual complexity (unit titles, cross-leases, trusts, companies, rural holdings) are quoted individually, also in writing and in advance. Disbursements such as LINZ and search fees are itemised at cost. Monthly engagement capacity applies across new vendor matters in Nelson, Tasman and the West Coast. This page is general information, not legal advice. '
            . '<a href="/privacy-policy">Privacy Policy</a> · <a href="/client-care-rules">Client Care Rules</a> · <a href="/terms-of-engagement">Terms of Engagement</a> — mmp.co.nz</p>'
            . '<p class="mt-4">Photography: Kaiteriteri, Dummy Bay &copy; Michal Klajban (CC BY-SA 4.0); Boulder Bank lighthouse &copy; Flying-Penguin (CC BY 3.0); Nelson and Boulder Bank, Pseudopanax (public domain); Kaiteriteri Beach &copy; RuinDig / Yuki Uchida (CC BY 4.0); Pancake Rocks, Punakaiki &copy; Jun Jie Yam (CC BY 4.0). Via Wikimedia Commons.</p>';
    }
}
