<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class Generatesitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = SitemapGenerator::create('https://nigeriaschoolinfo.com')->getSitemap();

        $sitemap->add(Url::create('/')->setPriority(0.5));

        foreach (Post::all() as $post) {
            $sitemap->add(Url::create($post->path())->setPriority(0.5));
        }
        foreach (Schools::all() as $school) {
            $sitemap->add(Url::create($school->path())->setPriority(0.5));
        }
        foreach (Courses::all() as $course) {
            $sitemap->add(Url::create($course->path())->setPriority(0.5));
        }
        foreach (Job::all() as $job) {
            $sitemap->add(Url::create($job->path())->setPriority(0.5));
        }
        foreach (Exams::all() as $exam) {
            $sitemap->add(Url::create($exam->path())->setPriority(0.5));
        }
        foreach (Scholarship::all() as $scholarship) {
            $sitemap->add(Url::create($scholarship->path())->setPriority(0.5));
        }
        
        $sitemap->writeToFile('sitemap.xml');
    }
}
