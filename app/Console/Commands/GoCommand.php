<?php

namespace App\Console\Commands;

use App\HttpClients\PostHttpClient;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = null;

        // сохраняем весь индекс в табличку
        foreach (PostHttpClient::make()->login()->index()->collect() as $post) {
            Post::firstOrCreate([
                'title' => $post['title'],
            ]);
        }

        // сохраняем фильтрованный индекс в табличку
//        foreach (PostHttpClient::make()
//            ->login()
//            ->index([
//               'tags_title' => 'quas',
//            ])
//            ->collect() as $post) {
//            Post::firstOrCreate([
//                'title' => $post['title'],
//            ]);
//        }

        // сохраняем конкретный пост в табличку
//        $post = PostHttpClient::make()->login()->show(9)->collect();
//        Post::firstOrCreate([
//            'title' => $post['title'],
//        ]);


        // отправляем пост на сохранение через апи
//        $response = PostHttpClient::make()->login()->store([
//            'profile_id' => 1,
//            'title' => 'My Post 241',
//            'category_id' => 1,
//            'image_path' => 'http://some/image/path.jpg',
//            'description' => 'Some description',
//            'content' => 'Some content',
//            'published_at' => '2020-12-20',
//            'status' => 2,
//            'is_published' => true
//        ]);

        // отправляем пост на редактирование через апи
//        $response = PostHttpClient::make()->login()->update(49,[
//            'profile_id' => 6,
//            'title' => 'My Post 111 Edited',
//        ]);

        // удаляем пост
//        $response = PostHttpClient::make()->login()->destroy(51);

        // выводим ответ сервера если есть $response
        if($response) {
            $this->line("HTTP Status: " . $response->status());
            $this->line("Reason: " . $response->reason());
            $this->line(json_encode(json_decode($response->body(), true), JSON_PRETTY_PRINT));
        }

    }
}
