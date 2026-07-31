<?php

use SilverStripe\Assets\Folder;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\BuildTask;
use SilverStripe\Versioned\Versioned;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * One-off task: creates a "Private Vendor Counsel" SimplePage-style
 * landing page (Page, not SimplePage — see CreateFirstResponsePageTask
 * for why) and populates it with the 10 blocks demonstrated for the
 * "MMP Landing Redesign" concept, using copy taken verbatim from
 * MMP Landing Redesign-1.pdf. Photos are the actual images embedded
 * in that PDF, extracted with pdfimages and imported here.
 *
 * Safe to re-run: if a page with URLSegment 'private-vendor-counsel'
 * already exists, its existing ElementalArea elements are removed and
 * rebuilt from scratch rather than duplicated.
 */
class CreateLandingRedesignPageTask extends BuildTask
{
    private static string $segment = 'CreateLandingRedesignPage';

    protected string $title = 'Create Landing Redesign demo page';

    protected static string $description = 'Creates/rebuilds a page demonstrating the 10 Landing Redesign blocks with the approved PDF copy and photos.';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        // See CreateFirstResponsePageTask for why this is required in a
        // bare CLI/sake context — without it every element below writes
        // with ParentID=0: present in the DB, invisible on the page.
        Versioned::set_stage(Versioned::DRAFT);

        $existingPage = Page::get()->filter('URLSegment', 'private-vendor-counsel')->first();

        if ($existingPage && $existingPage->exists() && $existingPage->ClassName !== Page::class) {
            $output->writeln("Existing page is a {$existingPage->ClassName}, not Page — deleting it before rebuild.");
            $existingPage->doArchive();
            $existingPage = null;
        }

        $page = $existingPage;

        if ($page && $page->exists()) {
            $output->writeln('Existing page found — clearing its elements before rebuild.');
            foreach ($page->ElementalArea()->Elements() as $existing) {
                $existing->delete();
            }
        } else {
            $page = Page::create();
            $page->Title = 'Private Vendor Counsel — MMP Lawyers';
            $page->URLSegment = 'private-vendor-counsel';
            $page->MetaDescription = 'The sale of your home deserves counsel, not a call centre. MMP Lawyers offers private vendor counsel to homeowners in Nelson, Tasman and the West Coast — one senior lawyer, beginning to end.';
            $page->ShowInSearch = false; // cold-outreach page — not for organic discovery
            $page->HideHeader = true;
            $page->HideFooter = true;
            $page->write();
        }

        $area = $page->ElementalArea();
        $sort = 0;

        $folder = Folder::find_or_make('Uploads/LandingRedesign');
        $streetPhoto = $this->importImage('nelson-street.png', $folder, $output);
        $handsPhoto = $this->importImage('why-mmp-hands.png', $folder, $output);
        $teamPhotos = [
            'Alex Reith' => $this->importImage('alex-reith.png', $folder, $output),
            'Nigel McFadden' => $this->importImage('nigel-mcfadden.png', $folder, $output),
            'Sam Sullivan' => $this->importImage('sam-sullivan.png', $folder, $output),
            'William Rasburn' => $this->importImage('william-rasburn.png', $folder, $output),
            'Callum Osborne' => $this->importImage('callum-osborne.png', $folder, $output),
            'Senna Dodd' => $this->importImage('senna-dodd.png', $folder, $output),
        ];

        // 1. Letterhead bar (header replacement)
        $letterhead = LetterheadBar::create();
        $letterhead->Title = 'Letterhead — MMP Lawyers / Nelson · Est. 1991';
        $letterhead->Wordmark = 'MMP Lawyers';
        $letterhead->Tagline = 'Nelson · Est. 1991';
        $letterhead->PhoneText = '03 548 2154';
        $letterhead->PhoneLink = 'tel:035482154';
        $letterhead->ParentID = $area->ID;
        $letterhead->Sort = ++$sort;
        $letterhead->write();

        // 2. Hero
        $hero = LeftAlignedHero::create();
        $hero->Title = 'Hero — The sale of your home deserves counsel';
        $hero->Eyebrow = 'By invitation — vendors in Nelson, Tasman & the West Coast';
        $hero->Heading = 'The sale of your home deserves counsel, not a call centre.';
        $hero->Lede = 'Your property is on the market — very likely the most valuable asset you will sell this decade. The lawyer you appoint now will hold your title, your deposit and your settlement. We believe that work belongs in senior hands, held personally from first conversation to the moment your proceeds arrive.';
        $hero->ReferenceLine = 'Kindly mention reference <b>VC·26</b> from your letter when you reply. · reception@mmp.co.nz · 03 548 2154';
        $hero->ParentID = $area->ID;
        $hero->Sort = ++$sort;
        $hero->write();

        // 3. Full-bleed street photo
        $streetBand = FullBleedImage::create();
        $streetBand->Title = 'Photo — Nelson street scene';
        $streetBand->ImageID = $streetPhoto->ID;
        $streetBand->ParentID = $area->ID;
        $streetBand->Sort = ++$sort;
        $streetBand->write();

        // 4. Offer grid
        $offer = BorderedOfferGrid::create();
        $offer->Title = 'Offer — The Offer / Private Vendor Counsel (4 items)';
        $offer->Eyebrow = 'The Offer — Private Vendor Counsel';
        $offer->ReferenceLabel = 'Reference VC·26';
        $offer->FooterNote = 'To preserve this standard of attention, we accept <strong>twelve new vendor engagements each month</strong> across the three regions.';
        $offer->ParentID = $area->ID;
        $offer->Sort = ++$sort;
        $offer->write();

        $offerItems = [
            ['Title' => 'A complimentary private consultation', 'Content' => 'With a senior property lawyer — at our Hardy Street chambers, at your property, or by video for our West Coast clients — before you accept any offer.'],
            ['Title' => 'One senior lawyer, beginning to end', 'Content' => 'Your matter is never delegated down or passed between desks; you hold their direct line and personal email.'],
            ['Title' => 'Counsel when offers actually arrive', 'Content' => 'Private and Trade Me offers land on evenings and weekends — your lawyer reviews them then, not next Tuesday.'],
            ['Title' => 'A single professional fee, in writing', 'Content' => 'Confirmed at engagement. No hourly billing, no meter running while you negotiate.'],
        ];
        $offerSort = 0;
        foreach ($offerItems as $data) {
            $item = OfferItem::create();
            $item->Title = $data['Title'];
            $item->Content = $data['Content'];
            $item->Sort = ++$offerSort;
            $item->BorderedOfferGridID = $offer->ID;
            $item->write();
        }

        // 5. Team grid
        $team = CompactTeamGrid::create();
        $team->Title = 'Team — Senior hands, known by name (6 people)';
        $team->Heading = 'Senior hands, known by name';
        $team->Eyebrow = 'Your Counsel';
        $team->Caption = 'Vendor engagements are held personally by a senior property lawyer — the person you meet is the person who settles your sale.';
        $team->ParentID = $area->ID;
        $team->Sort = ++$sort;
        $team->write();

        $members = [
            ['Name' => 'Alex Reith', 'Role' => 'Principal'],
            ['Name' => 'Nigel McFadden', 'Role' => 'Consultant · Founder'],
            ['Name' => 'Sam Sullivan', 'Role' => 'Senior Associate'],
            ['Name' => 'William Rasburn', 'Role' => 'Senior Associate'],
            ['Name' => 'Callum Osborne', 'Role' => 'Associate'],
            ['Name' => 'Senna Dodd', 'Role' => 'Solicitor'],
        ];
        $memberSort = 0;
        foreach ($members as $data) {
            $member = TeamGridMember::create();
            $member->Name = $data['Name'];
            $member->Role = $data['Role'];
            $member->PhotoID = $teamPhotos[$data['Name']]->ID;
            $member->Sort = ++$memberSort;
            $member->CompactTeamGridID = $team->ID;
            $member->write();
        }

        // 6. Ruled column grid #1 — the engagement
        $engagement = RuledColumnGrid::create();
        $engagement->Title = 'Engagement — What personal counsel looks like (Before/During/After)';
        $engagement->Heading = 'What personal counsel looks like in practice';
        $engagement->Eyebrow = 'The Engagement';
        $engagement->Shaded = true;
        $engagement->ParentID = $area->ID;
        $engagement->Sort = ++$sort;
        $engagement->write();

        $engagementColumns = [
            ['Label' => 'Before', 'Title' => 'Your position, examined', 'Content' => "We review your title and any instruments upon it, your agency agreement if you hold one, and the questions a careful buyer's lawyer will ask — so nothing surfaces mid-negotiation that we haven't already answered."],
            ['Label' => 'During', 'Title' => 'Every offer, weighed', 'Content' => 'Conditions, deposits, chattels, timing — each clause of the sale and purchase agreement is negotiated to protect you, and explained in plain language before you sign anything.'],
            ['Label' => 'After', 'Title' => 'Settlement, personally seen through', 'Content' => 'Discharge of your mortgage, the LINZ transfer, and your proceeds received into our trust account and paid to you the same day — confirmed by a call from your lawyer, not an automated email.'],
        ];
        $this->writeRuledColumns($engagementColumns, $engagement);

        // 7. Why MMP Lawyers (image + text pair)
        $whyUs = ImageTextPair::create();
        $whyUs->Title = 'Why MMP — Established Nelson, 1991';
        $whyUs->ImagePosition = 'Left';
        $whyUs->ImageID = $handsPhoto->ID;
        $whyUs->Eyebrow = 'Why MMP Lawyers';
        $whyUs->Heading = 'Established Nelson, 1991';
        $whyUs->Content = 'MMP Lawyers was founded on Hardy Street by Nigel McFadden, Jane McMeeken and David Phillips, and remains one of the longest-standing practices in the top of the South Island. Property is the core of the firm — thirty-five years of residential, rural and coastal titles across Nelson, Tasman and the West Coast — and it sits within a full-service practice led by principal Alex Reith. <strong>The sale of a significant asset touches trusts, tax timing, relationship property and estate planning,</strong> and our clients raise those questions with the same lawyer who is settling their sale. Should a transaction ever turn contentious, our litigation team stands behind every file. Discretion, continuity and senior attention are simply how the firm has practised since 1991.';
        $whyUs->ParentID = $area->ID;
        $whyUs->Sort = ++$sort;
        $whyUs->write();

        // 8. Ruled column grid #2 — how we begin
        $howWeBegin = RuledColumnGrid::create();
        $howWeBegin->Title = 'How we begin (3 steps)';
        $howWeBegin->Heading = 'How we begin';
        $howWeBegin->Eyebrow = 'The Manner of Engagement';
        $howWeBegin->Shaded = true;
        $howWeBegin->ParentID = $area->ID;
        $howWeBegin->Sort = ++$sort;
        $howWeBegin->write();

        $beginColumns = [
            ['Label' => '01', 'Title' => 'You reply, at your convenience', 'Content' => 'Telephone or write, mentioning reference VC·26. We confirm your consultation within one working day — in chambers, at your property, or by video.'],
            ['Label' => '02', 'Title' => 'We meet, without obligation', 'Content' => 'An unhurried conversation about your property, your timeframe and your title. You leave with our written advice on your position and a single confirmed fee — whether or not you engage us.'],
            ['Label' => '03', 'Title' => 'Your counsel stands ready', 'Content' => 'From that day, your lawyer is on hand for every offer, every question and every step to settlement. You sell; we hold the legal ground beneath you.'],
        ];
        $this->writeRuledColumns($beginColumns, $howWeBegin);

        // 9. Privacy Act notice
        $privacy = BorderedNoticePanel::create();
        $privacy->Title = 'Privacy Act 2020 notice';
        $privacy->Eyebrow = 'Privacy Act 2020';
        $privacy->Heading = 'A word on how we wrote to you';
        $privacy->Content = 'You received our letter because your property is publicly advertised for sale, and courtesy obliges us to be as careful with your information as we would be with your title. The address details used for this single introduction were compiled from publicly available listing information by our marketing partner ValueProp, as the Privacy Act 2020 permits. They are held securely in New Zealand, used for no other purpose, never sold or shared, and removed when the campaign concludes or your property sells. The Act entitles you to see the information we hold, to correct it, or to have it deleted — and we honour each request without question. Should you prefer no further correspondence, a brief reply to reception@mmp.co.nz or a call to 03 548 2154 will see your details removed within five working days. Our Privacy Officer may be reached at the same address, and the Office of the Privacy Commissioner (privacy.org.nz) is available to you should any concern remain.';
        $privacy->ParentID = $area->ID;
        $privacy->Sort = ++$sort;
        $privacy->write();

        // 10. Closing CTA (CentredStatement, Navy variant)
        $closing = CentredStatement::create();
        $closing->Title = 'Closing CTA — Twelve engagements this month (Navy variant)';
        $closing->Eyebrow = 'Private Vendor Counsel · Reference VC·26';
        $closing->Heading = 'Twelve engagements this month. One of them, if you wish, is yours.';
        $closing->Prose = 'Reserve a complimentary consultation with a senior property lawyer before your first offer arrives.';
        $closing->FootnoteLine = 'reception@mmp.co.nz · 03 548 2154 · Level 2, 241 Hardy Street, Nelson';
        $closing->Variant = 'Navy';
        $closing->Ruled = false;
        $closing->ParentID = $area->ID;
        $closing->Sort = ++$sort;
        $closing->write();

        // 11. Footer fineprint bar (footer replacement)
        $footer = FooterFineprintBar::create();
        $footer->Title = 'Footer fineprint';
        $footer->Content = '<p><strong>MMP Lawyers</strong> · Level 2, 241 Hardy Street, Nelson · Serving Nelson, Tasman and the West Coast since 1991 · Correspondence delivered in association with ValueProp.</p>'
            . '<p>The complimentary consultation and written fee confirmation carry no obligation to engage. Our fixed professional fee is confirmed in writing before work begins and covers a standard residential sale; titles or ownership structures of unusual complexity (unit titles, cross-leases, trusts, companies, rural holdings) are quoted individually, also in writing and in advance. Disbursements such as LINZ and search fees are itemised at cost. Monthly engagement capacity applies across new vendor matters in Nelson, Tasman and the West Coast. This page is general information, not legal advice. <a href="https://mmp.co.nz/privacy-policy">Privacy Policy</a> · <a href="https://mmp.co.nz/client-care-rules">Client Care Rules</a> · <a href="https://mmp.co.nz/terms-of-engagement">Terms of Engagement</a> — mmp.co.nz</p>';
        $footer->ParentID = $area->ID;
        $footer->Sort = ++$sort;
        $footer->write();

        $page->writeToStage(Versioned::DRAFT);
        $page->publishRecursive();

        $output->writeln("Done. Page ID {$page->ID}, URL segment '{$page->URLSegment}', 11 elements created and published.");

        return Command::SUCCESS;
    }

    /**
     * Import a PNG copied into public/assets/_tmp-import (see the task's
     * companion docker cp step) as a proper SilverStripe Image asset.
     * Idempotent: re-running the task re-uses the existing Image record
     * for the same filename rather than duplicating it.
     */
    private function importImage(string $filename, Folder $folder, OutputInterface $output): Image
    {
        $targetName = preg_replace('/\.png$/', '', $filename);
        $existing = Image::get()->filter([
            'ParentID' => $folder->ID,
            'Name' => $filename,
        ])->first();

        if ($existing && $existing->exists()) {
            return $existing;
        }

        $sourcePath = BASE_PATH . '/public/assets/_tmp-import/' . $filename;

        $image = Image::create();
        $image->setFromLocalFile($sourcePath, 'Uploads/LandingRedesign/' . $filename);
        $image->ParentID = $folder->ID;
        $image->Title = str_replace('-', ' ', $targetName);
        $image->write();
        $image->publishSingle();

        $output->writeln("Imported image: {$filename}");

        return $image;
    }

    /**
     * @param array<int, array{Label: string, Title: string, Content: string}> $columns
     */
    private function writeRuledColumns(array $columns, RuledColumnGrid $grid): void
    {
        $colSort = 0;
        foreach ($columns as $data) {
            $column = RuledColumn::create();
            $column->Label = $data['Label'];
            $column->Title = $data['Title'];
            $column->Content = $data['Content'];
            $column->Sort = ++$colSort;
            $column->RuledColumnGridID = $grid->ID;
            $column->write();
        }
    }
}
