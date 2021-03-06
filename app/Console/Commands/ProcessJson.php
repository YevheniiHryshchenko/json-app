<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\Content;
use App\Models\Category;
use App\Models\Media;

class ProcessJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process json and save its data to db';

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
        $feedData = json_decode(Storage::disk('local')->get('feed.json'), true);

        foreach ($feedData as $el) {
            $article = Article::create([
                'title' => $el['title'],
                'slug' => $el['slug']
            ]);

            foreach ($el['content'] as $elContent) {
                $content = Content::create([
                    'type' => $elContent['type'],
                    'content' => $elContent['content'],
                    'attributes' => json_encode($elContent['attributes'])
                ]);

                $article->content()->attach($content->id);
            }

            $categories = [
                $el['categories']['primary'],
                ...$el['categories']['additional']
            ];

            foreach ($categories as $key => $category) {
                if ($category) {
                    $categoryModel = Category::firstOrCreate([
                        'name' => $category
                    ]);

                    $article->categories()->attach($categoryModel->id, [
                        'is_primary' => $key === 0 || ($key === 1 && !$categories[0])
                    ]);
                }
            }

            foreach ($el['media'] as $elMedia) {
                $media = Media::create([
                    'is_featured' => $elMedia['type'] === 'featured',
                    'info' => json_encode($elMedia['media'])
                ]);

                $article->media()->attach($media->id);
            }
        }
    }
}
