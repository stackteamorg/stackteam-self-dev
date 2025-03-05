<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ArticleService;

class ArticleCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ArticleService $articleService)
    {
        $articles = $articleService->getLatestArticles();
        print_r($articles->toArray());die();
    }
}
