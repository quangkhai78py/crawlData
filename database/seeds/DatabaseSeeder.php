<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ServiceCompaniesDataSeeder');
//        $this->call('LocationsDatabaseSeeder');
    }

}
class LocationsDatabaseSeeder extends Seeder{
    public function run(){
        DB::table('wp_locations')->insert([
            ['name'=>'大島', 'yomi'=>'おおしま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'利島村', 'yomi'=>'とうしまむら','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'新島', 'yomi'=>'にいじま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'神津島', 'yomi'=>'こうづしま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'三宅島', 'yomi'=>'みやけじま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'御蔵島', 'yomi'=>'みくらじま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'八丈町', 'yomi'=>'はちじょうまち','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'青ヶ島', 'yomi'=>'あおがしま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'式根島', 'yomi'=>'しきねじま' ,'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'父島', 'yomi'=>'ちちじま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'母島', 'yomi'=>'ははじま' ,'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'下田', 'yomi'=>'しもだ' ,'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'東京', 'yomi'=>'とうきょう','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'熱海', 'yomi'=>'あたみ','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'横浜', 'yomi'=>'よこはま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'久里浜', 'yomi'=>'くりはま','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'調布', 'yomi'=>'ちょうふ','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name'=>'東京羽田', 'yomi'=>'とうきょうはねだ','created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
class ServiceCompaniesDataSeeder extends Seeder{
    public function run(){
        DB::table('wp_service_companies')->insert([
            ['name' => '東海汽船', 'type' => '1','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '新進汽船', 'type' => '1','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '伊豆諸島', 'type' => '1','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '小笠原海運', 'type' => '1','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '新島', 'type' => '1','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '新中央航空', 'type' => '2','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => '東邦航空', 'type' => '2','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['name' => 'ana', 'type' => '2','created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
