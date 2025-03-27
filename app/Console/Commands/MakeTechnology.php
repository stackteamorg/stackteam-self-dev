<?php

namespace App\Console\Commands;

use App\Models\Technology;
use App\Models\TechnologySection;
use Illuminate\Console\Command;

class MakeTechnology extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tech
                            {--name= : نام تکنولوژی}
                            {--title= : عنوان تکنولوژی}
                            {--description= : توضیحات تکنولوژی}
                            {--icon= : آیکون تکنولوژی}
                            {--lang=fa : زبان تکنولوژی}
                            {--section= : آی‌دی بخش تکنولوژی}
                            {--article= : آی‌دی مقاله مرتبط}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ایجاد یک تکنولوژی جدید';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name') ?: $this->ask('نام تکنولوژی را وارد کنید');
        $title = $this->option('title') ?: $this->ask('عنوان تکنولوژی را وارد کنید');
        $description = $this->option('description') ?: $this->ask('توضیحات تکنولوژی را وارد کنید');
        $icon = $this->option('icon') ?: $this->ask('آیکون تکنولوژی را وارد کنید (برای رد کردن دکمه Enter را فشار دهید)', null);
        $lang = $this->option('lang') ?: $this->choice('زبان تکنولوژی را انتخاب کنید', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], 0);
        
        // انتخاب بخش تکنولوژی
        $sectionId = $this->option('section');
        if ($sectionId === null) {
            // لیست تمام بخش‌های تکنولوژی برای انتخاب
            $sections = TechnologySection::byLang($lang)->get();
            
            if ($sections->isEmpty()) {
                $this->warn('هیچ بخش تکنولوژی یافت نشد. ابتدا یک بخش تکنولوژی ایجاد کنید.');
                
                if ($this->confirm('آیا می‌خواهید یک بخش تکنولوژی جدید ایجاد کنید؟', true)) {
                    $sectionName = $this->ask('نام بخش تکنولوژی را وارد کنید');
                    $sectionTitle = $this->ask('عنوان بخش تکنولوژی را وارد کنید');
                    $sectionDescription = $this->ask('توضیحات بخش تکنولوژی را وارد کنید');
                    
                    $section = TechnologySection::create([
                        'name' => $sectionName,
                        'title' => $sectionTitle,
                        'description' => $sectionDescription,
                        'lang' => $lang,
                    ]);
                    
                    $this->info("بخش تکنولوژی '{$section->name}' با موفقیت ایجاد شد. آی‌دی: {$section->id}");
                    $sectionId = $section->id;
                } else {
                    $this->error('بدون بخش تکنولوژی نمی‌توان تکنولوژی ایجاد کرد.');
                    return 1;
                }
            } else {
                $this->info('بخش‌های تکنولوژی موجود:');
                $sections->each(function ($section) {
                    $this->line("[{$section->id}] {$section->name}");
                });
                
                $sectionId = $this->ask('آی‌دی بخش تکنولوژی را وارد کنید');
            }
        }
        
        // بررسی مقاله مرتبط
        $articleId = $this->option('article');
        if ($articleId === null && $this->confirm('آیا می‌خواهید این تکنولوژی را با یک مقاله مرتبط کنید؟', false)) {
            $articles = \App\Models\Article::all();
            
            if ($articles->isEmpty()) {
                $this->warn('هیچ مقاله‌ای یافت نشد.');
            } else {
                $this->info('مقالات موجود:');
                $articles->each(function ($article) {
                    $this->line("[{$article->id}] {$article->title}");
                });
                
                $articleId = $this->ask('آی‌دی مقاله مرتبط را وارد کنید');
            }
        }
        
        // ایجاد تکنولوژی
        $technology = Technology::create([
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'lang' => $lang,
            'technology_section_id' => $sectionId,
            'article_id' => $articleId,
        ]);
        
        $this->info("تکنولوژی '{$technology->name}' با موفقیت ایجاد شد. آی‌دی: {$technology->id}");
        
        return Command::SUCCESS;
    }
}
