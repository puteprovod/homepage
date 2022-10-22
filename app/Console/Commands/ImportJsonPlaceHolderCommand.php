<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use Illuminate\Console\Command;

class ImportJsonPlaceHolderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:jsonplaceholder';

    protected $description = 'Get data from json placeholder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'posts');
        $data = json_decode($response->getBody()->getContents());
        foreach ($data as $item) {
            Post::firstOrCreate(
                [
                    'title' => $item->title
                ]
                ,
                [
                    'title' => $item->title,
                    'content' => $item->body,
                    'image' => '1.jpg',
                    'category_id' => 1,
                ]);

        }
        Return 'ok';
    }
}
