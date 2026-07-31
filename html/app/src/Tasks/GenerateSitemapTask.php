<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\Core\Path;
use SilverStripe\Dev\BuildTask;
use SilverStripe\Model\ArrayData;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\SSViewer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Task for generating the site's sitemap.xml file.
 */
class GenerateSitemapTask extends BuildTask
{
    private static string $segment = 'GenerateSitemap';

    protected string $title = 'Generate XML Sitemap';

    protected static string $description = 'Creates a sitemap.xml file in the web root for search engines.';

    private static string $sitemap_file = 'sitemap.xml';

    /**
     * The main execution method for the task.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->log($output, "Starting sitemap generation...");

        $publicPath = BASE_PATH . DIRECTORY_SEPARATOR . 'public';
        $sitemapPath = $publicPath . DIRECTORY_SEPARATOR . $this->config()->get('sitemap_file');
        $pages = $this->getSitemapEntries();

        if ($pages->count() === 0) {
            $this->log($output, "No pages found to include in the sitemap. Aborting.", 'WARNING');
            return Command::SUCCESS; // Still a success, just nothing to do.
        }

        $this->log($output, "Found {$pages->count()} pages to include.");

        $viewer = SSViewer::create(['SitemapXML']);
        $sitemapContent = $viewer->process(ArrayData::create([
            'Pages' => $pages
        ]));

        if (file_put_contents($sitemapPath, $sitemapContent)) {
            $this->log($output, "Successfully generated sitemap.xml at: {$sitemapPath}", 'SUCCESS');
            $this->log($output, "Executing external generate-robots.php script...", 'INFO');
            $robotsScriptPath = BASE_PATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'generate-robots.php';

            if (file_exists($robotsScriptPath)) {
                // Use shell_exec to run the php script via the command line
                shell_exec('php ' . escapeshellarg($robotsScriptPath));
                $this->log($output, "✅ Finished executing generate-robots.php.", 'SUCCESS');
            } else {
                $this->log($output, "❌ Could not find generate-robots.php at {$robotsScriptPath}.", 'ERROR');
            }
        } else {
            $this->log($output, "Failed to write to sitemap.xml at: {$sitemapPath}. Check file permissions.", 'ERROR');
            return Command::FAILURE; // Return failure status code
        }

        $this->log($output, "Sitemap generation finished.");

        // Return success status code
        return Command::SUCCESS;
    }

    /**
     * Fetches all pages to be included in the sitemap.
     *
     * @return ArrayList
     */
    protected function getSitemapEntries(): ArrayList
    {
        $currentTime = gmdate('Y-m-d\TH:i:s\+00:00');
        $baseURL = 'https://mmp.co.nz';
        $entries = ArrayList::create();
        $pages = Versioned::get_by_stage(SiteTree::class, Versioned::LIVE)
            ->filter('ShowInSearch', true)
            ->exclude('ClassName', 'SilverStripe\ErrorPage\ErrorPage');
        $addedLinks = [];

        foreach ($pages as $page) {
            $link = rtrim($baseURL, '/') . '/' . ltrim($page->Link(), '/');

            // Clean the link if necessary (retaining your existing logic).
            $link = $this->cleanLink($link);

            // Skip if this link has already been added
            if (isset($addedLinks[$link])) {
                continue;
            }

            $entries->push(ArrayData::create([
                'Link' => $link,
                'LastModified' => $currentTime,
                'ChangeFrequency' => 'weekly',
                'Priority' => $this->getDefaultPriority($page)
            ]));

            // Mark this link as added
            $addedLinks[$link] = true;
        }

        $blogPosts = BlogPost::get();
        foreach ($blogPosts as $post) {
            $link = rtrim($baseURL, '/') . '/' . ltrim($post->Link(), '/');

            if (isset($addedLinks[$link])) {
                continue;
            }
            $entries->push(ArrayData::create([
                'Link' => $link,
                'LastModified' => gmdate('c', strtotime($post->LastEdited)),
                'ChangeFrequency' => 'monthly',
                'Priority' => '0.7'
            ]));

            // Mark this link as added
            $addedLinks[$link] = true;
        }

        $jobs = Job::get();
        foreach ($jobs as $job) {
            $link = rtrim($baseURL, '/') . '/careers/job/' . $job->ID;
            if (isset($addedLinks[$link])) {
                continue;
            }
            $entries->push(ArrayData::create([
                'Link' => $link,
                'LastModified' => gmdate('c', strtotime($job->LastEdited)),
                'ChangeFrequency' => 'monthly',
                'Priority' => '0.5'
            ]));

            // Mark this link as added
            $addedLinks[$link] = true;
        }

        return $entries;
    }

    /**
     * Calculates default priority based on page depth.
     *
     * @param SiteTree $page
     * @return string
     */
    protected function getDefaultPriority(SiteTree $page): string
    {
        if ($page->URLSegment === 'home') {
            return '1.0';
        }
        $depth = count($page->getAncestors()) + 1;
        if ($depth === 1) {
            return '0.8';
        }
        if ($depth === 2) {
            return '0.6';
        }
        return '0.5';
    }

    /**
     * Removes the ?stage=Stage parameter from a URL.
     *
     * @param string $url The URL to clean.
     * @return string The cleaned URL.
     */
    private function cleanLink(string $url): string
    {
        return preg_replace('/\?stage=[^&]*/', '', $url);
    }

    /**
     * Helper to log messages using the Symfony Console OutputInterface.
     *
     * @param OutputInterface $output The output object.
     * @param string $message The message to log.
     * @param string $type SUCCESS, ERROR, WARNING, or INFO
     * @return void
     */
    private function log(OutputInterface $output, string $message, string $type = 'INFO'): void
    {
        $style = match (strtoupper($type)) {
            'SUCCESS' => 'info', // Green text
            'ERROR' => 'error', // Red background
            'WARNING' => 'comment', // Yellow text
            default => 'question', // Black background, cyan text
        };

        // Use Symfony style tags for agnostic output
        $output->writeln("<$style>[$type]</$style> $message");
    }
}
