<?php

use SilverStripe\Dev\BuildTask;
use SilverStripe\Versioned\Versioned;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * One-off task: unpublishes the /first-response page (built from the
 * wrong design). The FR·26-only blocks stay in the codebase in case
 * they're reused later — only the live page is taken down.
 */
class UnpublishFirstResponseTask extends BuildTask
{
    private static string $segment = 'UnpublishFirstResponse';

    protected string $title = 'Unpublish First Response page';

    protected static string $description = 'Unpublishes the /first-response page without deleting it or its blocks.';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        Versioned::set_stage(Versioned::DRAFT);

        $page = Page::get()->filter('URLSegment', 'first-response')->first();

        if (!$page) {
            $output->writeln('No page found with URLSegment "first-response".');
            return Command::SUCCESS;
        }

        if (!$page->isPublished()) {
            $output->writeln("Page ID {$page->ID} is already unpublished.");
            return Command::SUCCESS;
        }

        $page->doUnpublish();

        $output->writeln("Unpublished page ID {$page->ID} ('{$page->Title}', /first-response). Draft record and blocks left intact.");

        return Command::SUCCESS;
    }
}
