<?php

use SilverStripe\Dev\BuildTask;
use SilverStripe\Versioned\Versioned;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * One-off task: creates a "First Response" SimplePage and populates
 * its ElementalArea with the 6 First Response blocks, using copy
 * taken verbatim from mmp-premium-C-first-response.html.
 *
 * Safe to re-run: if a page with URLSegment 'first-response' already
 * exists, its existing ElementalArea elements are removed and
 * rebuilt from scratch rather than duplicated.
 */
class CreateFirstResponsePageTask extends BuildTask
{
    private static string $segment = 'CreateFirstResponsePage';

    protected string $title = 'Create First Response demo page';

    protected static string $description = 'Creates/rebuilds a page demonstrating the 6 First Response blocks with the approved source copy.';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        // dnadesign/silverstripe-elemental only auto-creates a page's
        // ElementalArea when Versioned::get_stage() === DRAFT (see
        // ElementalAreasExtension::allowAlteringElementalArea). A bare
        // CLI/sake context doesn't set a reading stage by default, so
        // without this the page writes with ElementalAreaID=0 and every
        // element below silently gets ParentID=0 — present in the DB,
        // invisible on the page, no error anywhere.
        Versioned::set_stage(Versioned::DRAFT);

        // Page (not SimplePage) — SimplePage.ss wraps $ElementalArea inside a
        // narrow bordered "space-y-12" grid meant for RTE-style content.
        // Layout/Page.ss is literally just `$ElementalArea`, which is what
        // full-bleed blocks like these need.
        //
        // Page::get() also returns subclass rows (SimplePage extends Page),
        // so an existing row is checked for exact ClassName and discarded
        // if it's the wrong type rather than silently reused as-is.
        $existingPage = Page::get()->filter('URLSegment', 'first-response')->first();

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
            $page->Title = 'First Response — private client conveyancing';
            $page->URLSegment = 'first-response';
            $page->MetaDescription = "Offers on your property don't keep office hours. MMP Lawyers' First Response service gives vendors in Nelson, Tasman and the West Coast a senior lawyer on call — every offer reviewed within four hours, seven days a week.";
            $page->ShowInSearch = false; // cold-outreach page — not for organic discovery
            $page->write();
        }

        $area = $page->ElementalArea();
        $sort = 0;

        // 1. Hero
        $hero = CentredHero::create();
        $hero->Title = 'Hero — Offers don\'t keep office hours';
        $hero->Eyebrow = 'For vendors currently marketing a property';
        $hero->Heading = "Offers don't keep office hours. <em>Neither do we.</em>";
        $hero->Lede = "The offer that matters will arrive on a Sunday evening, after the second open home, while your competitors' lawyers are unreachable until Tuesday. First Response is our private-client standard for vendors in Nelson, Tasman and the West Coast: <strong>a senior property lawyer on call for your sale — every offer reviewed and advised within four hours, seven days a week.</strong>";
        $hero->PrimaryButtonText = 'Appoint your lawyer';
        $hero->PrimaryButtonLink = 'mailto:reception@mmp.co.nz?subject=First%20Response%20—%20ref.%20FR%C2%B726';
        $hero->SecondaryButtonText = '03 548 2154';
        $hero->SecondaryButtonLink = 'tel:035482154';
        $hero->ReferenceLine = 'A complimentary, no-obligation consultation opens every engagement · reference <b>FR·26</b>';
        $hero->Variant = 'Dark';
        $hero->Ruled = false;
        $hero->ParentID = $area->ID;
        $hero->Sort = ++$sort;
        $hero->write();

        // 2. Timeline
        $timeline = Timeline::create();
        $timeline->Title = 'Timeline — What four-hour counsel looks like';
        $timeline->Eyebrow = 'A Sunday, handled';
        $timeline->Heading = 'What four-hour counsel looks like';
        $timeline->Intro = "Drawn from how a private-sale offer actually unfolds for our vendor clients — the hours when a deal is won are rarely business hours.";
        $timeline->Variant = 'Dark';
        $timeline->Ruled = false;
        $timeline->ParentID = $area->ID;
        $timeline->Sort = ++$sort;
        $timeline->write();

        $moments = [
            ['Time' => 'Sunday, 6.47 pm', 'Title' => 'The offer arrives', 'Content' => "A buyer from the afternoon's open home emails a signed agreement through your Trade Me listing — conditional on finance, ten-day due diligence, a deposit smaller than it should be."],
            ['Time' => '7.10 pm', 'Title' => 'Your lawyer calls you', 'Content' => "Not a portal, not a ticket number — the senior lawyer who holds your file, who has already read the agreement against the title they examined when you engaged us."],
            ['Time' => '8.55 pm', 'Title' => 'Advised, amended, ready', 'Content' => "Deposit lifted, conditions tightened, chattels clarified, timing aligned to your next purchase. You counter-sign that evening from your kitchen table, fully advised."],
            ['Time' => 'Monday, 9.02 am', 'Title' => 'The buyer accepts', 'Content' => "While other vendors are still leaving voicemails, your sale is under contract on your terms. First response, first mover."],
        ];
        $momentSort = 0;
        foreach ($moments as $data) {
            $moment = TimelineMoment::create();
            $moment->Time = $data['Time'];
            $moment->Title = $data['Title'];
            $moment->Content = $data['Content'];
            $moment->Sort = ++$momentSort;
            $moment->TimelineID = $timeline->ID;
            $moment->write();
        }

        // 3. Numbered card grid
        $grid = NumberedCardGrid::create();
        $grid->Title = 'Standard — The First Response standard (4 cards)';
        $grid->Eyebrow = 'The First Response standard';
        $grid->Heading = 'What we hold ourselves to, in writing, for every vendor client';
        $grid->Variant = 'Dark';
        $grid->Ruled = true;
        $grid->ParentID = $area->ID;
        $grid->Sort = ++$sort;
        $grid->write();

        $cards = [
            ['Title' => 'Four hours, seven days', 'Content' => 'Every offer, counter-offer and condition notice reviewed by your lawyer within four hours of receipt, evenings and weekends included — confirmed as a written service standard in our engagement letter.'],
            ['Title' => 'One senior lawyer, directly', 'Content' => "You are given your lawyer's direct line and personal email at engagement. No call centres, no triage, no explaining your matter twice. West Coast clients are served identically, by video and LINZ e-dealing."],
            ['Title' => 'Everything coordinated for you', 'Content' => "We deal directly with your agent, your bank, the buyer's solicitors and, where you wish, your accountant — so the only calls you take are the ones that matter: ours, telling you it's done."],
            ['Title' => 'Settlement, then stewardship', 'Content' => 'Proceeds received into our trust account and paid to you the same day, confirmed personally. And because a significant sale changes your affairs, a complimentary review of your will and enduring powers of attorney follows — with our compliments.'],
        ];
        $cardSort = 0;
        foreach ($cards as $data) {
            $card = NumberedCard::create();
            $card->Title = $data['Title'];
            $card->Content = $data['Content'];
            $card->Sort = ++$cardSort;
            $card->NumberedCardGridID = $grid->ID;
            $card->write();
        }

        // 4. Fee statement
        $fee = CentredStatement::create();
        $fee->Title = 'Fee statement — On the matter of fees';
        $fee->Eyebrow = 'On the matter of fees';
        $fee->Heading = 'Fixed in writing before we begin. Modest against what it protects.';
        $fee->FigureLine = 'A fraction of one per cent of your sale —';
        $fee->Prose = '— agreed as a single professional fee at your first consultation, confirmed in writing, and unchanged thereafter. No hourly billing, no meter running through a weekend negotiation, and nothing payable for the initial consultation itself. Vendors with unit titles, cross-leases, trusts, companies or rural holdings receive the same courtesy: a precise written fee before any work commences. <strong>You will know the cost of our counsel to the dollar before you appoint us</strong> — which is, we think, how a law firm ought to behave.';
        $fee->Variant = 'Dark';
        $fee->Ruled = true;
        $fee->ParentID = $area->ID;
        $fee->Sort = ++$sort;
        $fee->write();

        // 5. Why + Privacy pair
        $pair = TextPairWithPanel::create();
        $pair->Title = 'Why MMP + Privacy Act notice';
        $pair->LeftEyebrow = 'Why MMP Lawyers';
        $pair->LeftHeading = 'Senior counsel, resident here since 1991';
        $pair->LeftContent = "First Response is only possible because of who answers the phone. MMP Lawyers has practised from Hardy Street since 1991 — founded by Nigel McFadden, Jane McMeeken and David Phillips, and today led by principal Alex Reith — making us one of the longest-standing firms in the top of the South. Property is the centre of the practice: thirty-five years of Nelson town sections, Tasman orchards and lifestyle blocks, and coastal and rural titles the length of the West Coast. That depth is what lets a lawyer read your Sunday-evening offer in minutes rather than days. <strong>And because the firm is genuinely full-service, the counsel doesn't stop at the title:</strong> trusts, relationship property, estate planning and — should a transaction ever sour — our own litigation team, all under the one roof, all known to you by name.";
        $pair->RightEyebrow = 'Privacy Act 2020';
        $pair->RightHeading = 'How we came to write to you';
        $pair->RightContent = 'Discretion is a professional habit, so we will be precise. Our letter reached you using publicly available details from your property listing, compiled on our behalf by our marketing partner ValueProp — a collection the Privacy Act 2020 permits. Your details are held securely in New Zealand, used for this introduction alone, never sold or disclosed to anyone else, and deleted once your property sells or this campaign closes. The Act gives you the right to see what we hold, to correct it, and to have it erased; each request is honoured without hesitation. To hear nothing further, one word — "unsubscribe" — to reception@mmp.co.nz, or a call to 03 548 2154, removes you within five working days. Our Privacy Officer may be reached at the same address, and the Office of the Privacy Commissioner (privacy.org.nz) remains open to you should any concern persist.';
        $pair->RightIsPanel = true;
        $pair->Variant = 'Dark';
        $pair->Ruled = true;
        $pair->ParentID = $area->ID;
        $pair->Sort = ++$sort;
        $pair->write();

        // 6. Closing statement
        $closing = CentredStatement::create();
        $closing->Title = 'Closing CTA — be the vendor whose lawyer answers';
        $closing->Eyebrow = 'First Response · Reference FR·26';
        $closing->Heading = 'When your offer arrives, be the vendor whose lawyer <em>answers.</em>';
        $closing->Prose = "Appoint your senior lawyer before the weekend's open homes. The first consultation is complimentary, the fee is fixed in writing, and from that day your counsel is on call.";
        $closing->ButtonText = 'Appoint your lawyer';
        $closing->ButtonLink = 'mailto:reception@mmp.co.nz?subject=First%20Response%20—%20ref.%20FR%C2%B726';
        $closing->FootnoteLine = '<a href="tel:035482154">03 548 2154</a> · <a href="mailto:reception@mmp.co.nz">reception@mmp.co.nz</a> · Level 2, 241 Hardy Street, Nelson';
        $closing->Variant = 'Dark';
        $closing->Ruled = true;
        $closing->ParentID = $area->ID;
        $closing->Sort = ++$sort;
        $closing->write();

        $page->writeToStage(Versioned::DRAFT);
        $page->publishRecursive();

        $output->writeln("Done. Page ID {$page->ID}, URL segment '{$page->URLSegment}', 6 elements created and published.");

        return Command::SUCCESS;
    }
}
