<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Technology;
use App\Models\TechnologySection;
use Illuminate\Console\Command;

class AssignArticleToTechnology extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tech:assign-article {--lang=fa : زبان بخش‌های تکنولوژی}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'نمایش بخش‌های تکنولوژی و تکنولوژی‌های هر بخش و اختصاص یک مقاله به تکنولوژی انتخاب شده';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lang = $this->option('lang');
        
        // گام 1: دریافت تمام بخش‌های تکنولوژی
        $sections = TechnologySection::where('lang', $lang)->get();
        
        if ($sections->isEmpty()) {
            $this->error("هیچ بخش تکنولوژی با زبان '$lang' یافت نشد.");
            return 1;
        }
        
        $this->info("=== بخش‌های تکنولوژی ===");
        $sectionsArray = [];
        foreach ($sections as $index => $section) {
            $this->line("[" . ($index + 1) . "] {$section->name} - {$section->title}");
            $sectionsArray[$index + 1] = $section;
        }
        
        // گام 2: انتخاب یک بخش تکنولوژی
        $sectionChoice = $this->ask('شماره بخش تکنولوژی را وارد کنید');
        if (!isset($sectionsArray[$sectionChoice])) {
            $this->error("بخش تکنولوژی با شماره $sectionChoice یافت نشد.");
            return 1;
        }
        
        $selectedSection = $sectionsArray[$sectionChoice];
        $this->info("بخش انتخاب شده: {$selectedSection->name}");
        
        // گام 3: دریافت تکنولوژی‌های بخش انتخاب شده
        $technologies = Technology::where('technology_section_id', $selectedSection->id)
            ->where('lang', $lang)
            ->get();
            
        if ($technologies->isEmpty()) {
            $this->error("هیچ تکنولوژی در بخش '{$selectedSection->name}' یافت نشد.");
            
            // پیشنهاد اضافه کردن تکنولوژی جدید
            if ($this->confirm('آیا می‌خواهید یک تکنولوژی جدید به این بخش اضافه کنید؟', false)) {
                $this->call('make:tech', [
                    '--section' => $selectedSection->id,
                    '--lang' => $lang
                ]);
                return 0;
            }
            
            return 1;
        }
        
        $this->info("=== تکنولوژی‌های بخش {$selectedSection->name} ===");
        $technologiesArray = [];
        foreach ($technologies as $index => $technology) {
            $articleInfo = $technology->article_id ? " (مقاله: {$technology->article->title})" : " (بدون مقاله)";
            $this->line("[" . ($index + 1) . "] {$technology->name} - {$technology->title}{$articleInfo}");
            $technologiesArray[$index + 1] = $technology;
        }
        
        // گام 4: انتخاب یک تکنولوژی
        $technologyChoice = $this->ask('شماره تکنولوژی را وارد کنید');
        if (!isset($technologiesArray[$technologyChoice])) {
            $this->error("تکنولوژی با شماره $technologyChoice یافت نشد.");
            return 1;
        }
        
        $selectedTechnology = $technologiesArray[$technologyChoice];
        $this->info("تکنولوژی انتخاب شده: {$selectedTechnology->name}");
        
        // گام 5: دریافت تمام مقالات
        $articles = Article::where('lang', $lang)->get();
        
        if ($articles->isEmpty()) {
            $this->error("هیچ مقاله‌ای با زبان '$lang' یافت نشد.");
            return 1;
        }
        
        $this->info("=== مقالات موجود ===");
        $articlesArray = [0 => null]; // گزینه 0 برای حذف مقاله فعلی
        $this->line("[0] بدون مقاله (حذف مقاله فعلی)");
        
        foreach ($articles as $index => $article) {
            $this->line("[" . ($index + 1) . "] {$article->title}");
            $articlesArray[$index + 1] = $article;
        }
        
        // گام 6: انتخاب یک مقاله
        $articleChoice = $this->ask('شماره مقاله را وارد کنید (0 برای حذف مقاله فعلی)');
        if (!isset($articlesArray[$articleChoice])) {
            $this->error("مقاله با شماره $articleChoice یافت نشد.");
            return 1;
        }
        
        // گام 7: اختصاص مقاله به تکنولوژی
        $selectedArticle = $articlesArray[$articleChoice];
        
        if ($articleChoice == 0) {
            $selectedTechnology->article_id = null;
            $selectedTechnology->save();
            $this->info("مقاله از تکنولوژی '{$selectedTechnology->name}' حذف شد.");
        } else {
            $selectedTechnology->article_id = $selectedArticle->id;
            $selectedTechnology->save();
            $this->info("مقاله '{$selectedArticle->title}' به تکنولوژی '{$selectedTechnology->name}' اختصاص داده شد.");
        }
        
        return 0;
    }
}
