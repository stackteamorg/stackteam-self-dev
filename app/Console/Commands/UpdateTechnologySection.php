<?php

namespace App\Console\Commands;

use App\Models\TechnologySection;
use Illuminate\Console\Command;

class UpdateTechnologySection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:techsec {id : آی‌دی بخش تکنولوژی}
                            {--name= : نام بخش تکنولوژی}
                            {--title= : عنوان بخش تکنولوژی}
                            {--description= : توضیحات بخش تکنولوژی}
                            {--icon= : آیکون بخش تکنولوژی}
                            {--lang= : زبان بخش تکنولوژی}
                            {--article= : آی‌دی مقاله مرتبط (0 برای حذف ارتباط)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'به‌روزرسانی یک بخش تکنولوژی موجود';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        
        // یافتن بخش تکنولوژی
        $section = TechnologySection::find($id);
        
        if (!$section) {
            $this->error("بخش تکنولوژی با آی‌دی {$id} یافت نشد.");
            return 1;
        }
        
        $this->info("در حال ویرایش بخش تکنولوژی: {$section->name} (آی‌دی: {$section->id})");
        
        // دریافت مقادیر برای به‌روزرسانی
        $data = [];
        
        if ($this->option('name')) {
            $data['name'] = $this->option('name');
        } elseif ($this->confirm('آیا می‌خواهید نام را به‌روزرسانی کنید؟', false)) {
            $data['name'] = $this->ask('نام جدید را وارد کنید', $section->name);
        }
        
        if ($this->option('title')) {
            $data['title'] = $this->option('title');
        } elseif ($this->confirm('آیا می‌خواهید عنوان را به‌روزرسانی کنید؟', false)) {
            $data['title'] = $this->ask('عنوان جدید را وارد کنید', $section->title);
        }
        
        if ($this->option('description')) {
            $data['description'] = $this->option('description');
        } elseif ($this->confirm('آیا می‌خواهید توضیحات را به‌روزرسانی کنید؟', false)) {
            $data['description'] = $this->ask('توضیحات جدید را وارد کنید', $section->description);
        }
        
        if ($this->option('icon')) {
            $data['icon'] = $this->option('icon');
        } elseif ($this->confirm('آیا می‌خواهید آیکون را به‌روزرسانی کنید؟', false)) {
            $data['icon'] = $this->ask('آیکون جدید را وارد کنید', $section->icon);
        }
        
        if ($this->option('lang')) {
            $data['lang'] = $this->option('lang');
        } elseif ($this->confirm('آیا می‌خواهید زبان را به‌روزرسانی کنید؟', false)) {
            $data['lang'] = $this->choice('زبان جدید را انتخاب کنید', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], array_search($section->lang, ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de']) ?: 0);
        }
        
        // مدیریت article_id
        $articleIdOption = $this->option('article');
        if ($articleIdOption !== null) {
            $data['article_id'] = $articleIdOption == 0 ? null : $articleIdOption;
        } elseif ($this->confirm('آیا می‌خواهید مقاله مرتبط را به‌روزرسانی کنید؟', false)) {
            $removeArticle = $this->confirm('آیا می‌خواهید ارتباط با مقاله را حذف کنید؟', false);
            
            if ($removeArticle) {
                $data['article_id'] = null;
            } else {
                $articles = \App\Models\Article::all();
                
                if ($articles->isEmpty()) {
                    $this->warn('هیچ مقاله‌ای یافت نشد.');
                } else {
                    $this->info('مقالات موجود:');
                    $articles->each(function ($article) {
                        $this->line("[{$article->id}] {$article->title}");
                    });
                    
                    $data['article_id'] = $this->ask('آی‌دی مقاله مرتبط را وارد کنید');
                }
            }
        }
        
        // به‌روزرسانی بخش تکنولوژی اگر تغییراتی وجود دارد
        if (empty($data)) {
            $this->info('هیچ تغییری در بخش تکنولوژی اعمال نشد.');
        } else {
            $section->update($data);
            $this->info("بخش تکنولوژی '{$section->name}' با موفقیت به‌روزرسانی شد.");
        }
        
        return Command::SUCCESS;
    }
}
