<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use phpDocumentor\Reflection\Types\Self_;
use App\Model\Wp_route_informations;
use App\Model\Wp_locations;
use App\Model\Wp_service_companies;

class scrapeTokioHarbor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:tokyo';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $urlSchedule = 'https://www.tokaikisen.co.jp/schedule/';
        self::crawlDataSchedule($urlSchedule);
    }

    /**
     * @function crawlDataSchedule.
     * @description Get data from other web
     * @param $url
     */
    public function crawlDataSchedule($urlSchedule)
    {
        $crawler = Goutte::request('GET', $urlSchedule);

        /**
         * @description Get text caption by id of div
         */
        $caption = $crawler->filter("div.scheduleIsland div.scheduleTable__header div.caption")->each(function ($caption) {
            return $caption->text();
        })[0];
        $caption = mb_substr($caption, 0, 10);

        /**
         * @description Get text tr infor in table by id div
         */
        $tableInfors = $crawler->filter("div.scheduleIsland__section.sp--js--accordion")->each(function ($tableInfor){
            return $tableInfor;
        });

        $dataInsert = [];
        for($i = 0; $i < count($tableInfors); $i++) {
            $table = $tableInfors[$i];

            $title = $table->filter('h2')->each(function($title){
                return $title->text();
            });

            $dataTable = $table->filter('div.scheduleTable div.scheduleTable__main table.stable')->each(function ($dataTable){
                return $dataTable;
            });

            for ($j = 0; $j < count($dataTable); $j++){
                $dataInfors = $dataTable[$j];
                $tr = $dataInfors->filter('tr')->each(function ($tr){
                    return $tr;
                });

                if (!empty($tr)){
                    $th = $tr[0]->filter('th')->each(function($th) {
                        return $th->text();
                    });
                }
                if($th[1] == "発地") {
                    for($t = 1; $t < count($tr); $t++) {
                        $td = $tr[$t]->filter('td')->each(function($td) {
                            return $td->text();
                        });

                        if (!empty($td)){
                            $data = [
                                'date' => $caption,
                                'datetime_begin' => $caption.$td[0],
                                'departure' => explode("発", $td[1])[0],
                                'destination' => explode("発着", $title[0])[0],
                                'datetime_end' => null,
                                'status' => $td[4],
                                'price' => null,
                                'price_lable' => null
                            ];
                            $dataInsert[] = $data;
                        }
                    }
                }

                if($th[1] == "行き先") {
                    for($t = 1; $t < count($tr); $t++) {
                        $td = $tr[$t]->filter('td')->each(function($td) {
                            return $td->text();
                        });
                        if (!empty($td)){
                            $data = [
                                'datetime_begin' => $caption.$td[0],
                                'departure' => explode("発着", $title[0])[0],
                                'destination' => explode("行", $td[1])[0],
                                'datetime_end' => null,
                                'status' => $td[4],
                                'price' => null,
                                'price_lable' => null,
                            ];
                            $dataInsert[] = $data;
                        }
                    }
                }
            }
        }

        foreach ($dataInsert as $value){
            $idDeparture = Wp_locations::where('name', $value['departure'])->first();
            $idArrival = Wp_locations::where('name', $value['destination'])->first();
            $idServiceCompanies = Wp_service_companies::where('name','東海汽船')->first();
           if(!empty($idServiceCompanies)){
               $data = [
                   'departure_id' => $idDeparture['id'],
                   'arrival_id' => $idArrival['id'],
                   'departure_time' => $value['datetime_begin'],
                   'arrival_time' => null,
                   'transportation_type_id' => $idServiceCompanies['type'],
                   'status' => (!empty($value['status'] == '就航')? 1 : 2),
                   'price' => null,
                   'price_label' => null,
                   'service_company_id' => $idServiceCompanies['id']
               ];
               $success = Wp_route_informations::create($data);
           }
        }
        if ($success){
            echo 'success';
        }
    }
}
