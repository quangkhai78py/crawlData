<?php

namespace App\Console\Commands;
use App\Model\Post;
use Illuminate\Console\Command;
use Goutte;

class scrapeDantri extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:dantri';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


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
     * @function handle.
     * @description Get link, handle link and return link did handle for function scrapePosr.
     */
    public function handle()
    {
        $category = [];
        for ($i = 2; $i <= 5; $i++){
            $category[] = 'the-thao/trang-'. $i . '.htm';
        }

        foreach ($category as $value){
            $string = env('DAN_TRI'). '/' . $value;
            $crawler = Goutte::request('GET', $string);
            $linkPost = $crawler->filter('a.fon6')->each(function ($node) {
                return $node->attr('href');
            });
            foreach ($linkPost as $link){
                $url = env('DAN_TRI') . $link;
                self::scrapePosr($url);
            }
        }
    }

    /**
     * @function scrapePosr.
     * @description Phân tích dữ liệu web và trỏ đến dữ liệu cần lấy.
     * @param $url
     */
    public function scrapePosr($url)
    {
        $crawler = Goutte::request('GET', $url);

        /**
         * @description get data title from web dan tri
         * @return text;
         */
        $title = $crawler->filter('h1.fon31.mgb15')->each(function ($title){
            return $title->text();
        });
        if(isset($title[0])){
            $title = $title[0];
        }

        /**
         * @description get data description from web dan tri
         * @return text;
         */
        $description = $crawler->filter('h2.fon33.mt1.sapo')->each(function ($description){
            return $description->text();
        });
        $description = str_replace('Dân trí','', $description );
        if(isset($description[0])){
            $description = $description[0];
        }

        /**
         * @description get data content from web dan tri
         * @return text;
         */
        $content  = $crawler->filter('div.fon34.mt3.mr2.fon43.detail-content p')->each(function ($content){
            return $content->text();
        });
        if(isset($content[0])){
            $content = $content[0];
        }

        /**
         * @description get data src from web dan tri -> get image
         * @return src;
         */
        $image = $crawler->filter('div.fon34.mt3.mr2.fon43.detail-content figure img')->each(function ($image){
            return $image->attr('src');
        });
        if(isset($image[0])){
            $image = $image[0];
        }
        $fileName = basename($image);

        ///////////////////////////////////////////////////////////////
        $data  = [
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'avatar' => $fileName,
        ];

        var_dump($data);
//        $post  = Post::create($data);
//
//        if ($post){
//            print ('lấy dữ liệu post thành công')."\n";
//        }
    }

}
