<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use phpDocumentor\Reflection\Types\Self_;
use App\Model\Wp_tokyo_route_informations;
use App\Model\Wp_tokyo_stations;
use App\Model\Wp_tokyo_service_companies;

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
        //$urlTokaikisen = 'https://www.tokaikisen.co.jp/schedule/';
       // $urlShinshinkisen = 'http://shinshin-kisen.jp/service/index.html';
        //Obtain station name and station code
        $baseURL = "http://api.ekispert.jp/v1/json/search/course/extreme?sort=transfer&answerCount=20&conditionDetail=T3111111232119:F332112212000:A21121141:&resultDetail=addCorporation&addOperationLinePattern=true&checkEngineVersion=true&gcs=tokyo&key=test_NcQdMcXLJ3L";
//        self::crawlDataSchedule($urlTokaikisen);
 //       self::crawlDataShinshinkisen($urlShinshinkisen);
        self::crawlDataApi($baseURL);
    }

    /**
     * @function crawlDataSchedule.
     * @description Get data from web tokaikisen
     * @param $url
     */
//    public function crawlDataSchedule($urlTokaikisen)
//    {
//        $crawler = Goutte::request('GET', $urlTokaikisen);
//
//        /**
//         * @description Get text caption by id of div
//         */
//        $caption = $crawler->filter("div.scheduleIsland div.scheduleTable__header div.caption")->each(function ($caption) {
//            return $caption->text();
//        })[0];
//        $caption = mb_substr($caption, 0, 10);
//
//        /**
//         * @description Get text tr infor in table by id div
//         */
//        $tableInfors = $crawler->filter("div.scheduleIsland__section.sp--js--accordion")->each(function ($tableInfor){
//            return $tableInfor;
//        });
//
//        $dataInsert = [];
//        for($i = 0; $i < count($tableInfors); $i++) {
//            $table = $tableInfors[$i];
//
//            $title = $table->filter('h2')->each(function($title){
//                return $title->text();
//            });
//
//            $dataTable = $table->filter('div.scheduleTable div.scheduleTable__main table.stable')->each(function ($dataTable){
//                return $dataTable;
//            });
//
//            for ($j = 0; $j < count($dataTable); $j++){
//                $dataInfors = $dataTable[$j];
//                $tr = $dataInfors->filter('tr')->each(function ($tr){
//                    return $tr;
//                });
//
//                if (!empty($tr)){
//                    $th = $tr[0]->filter('th')->each(function($th) {
//                        return $th->text();
//                    });
//                }
//                if($th[1] == "発地") {
//                    for($t = 1; $t < count($tr); $t++) {
//                        $td = $tr[$t]->filter('td')->each(function($td) {
//                            return $td->text();
//                        });
//
//                        if (!empty($td)){
//                            $data = [
//                                'date' => $caption,
//                                'datetime_begin' => $td[0],
//                                'departure' => explode("発", $td[1])[0],
//                                'destination' => explode("発着", $title[0])[0],
//                                'datetime_end' => null,
//                                'status' => $td[4],
//                                'price' => null,
//                                'price_lable' => null
//                            ];
//                            $dataInsert[] = $data;
//                        }
//                    }
//                }
//
//                if($th[1] == "行き先") {
//                    for($t = 1; $t < count($tr); $t++) {
//                        $td = $tr[$t]->filter('td')->each(function($td) {
//                            return $td->text();
//                        });
//                        if (!empty($td)){
//                            $data = [
//                                'date' => $caption,
//                                'datetime_begin' => $td[0],
//                                'departure' => explode("発着", $title[0])[0],
//                                'destination' => explode("行", $td[1])[0],
//                                'datetime_end' => null,
//                                'status' => $td[4],
//                                'price' => null,
//                                'price_lable' => null,
//                            ];
//                            $dataInsert[] = $data;
//                        }
//                    }
//                }
//            }
//        }
//
//        foreach ($dataInsert as $value){
//            $idDeparture = Wp_locations::where('name', $value['departure'])->first();
//            $idArrival = Wp_locations::where('name', $value['destination'])->first();
//            $idServiceCompanies = Wp_service_companies::where('name','東海汽船')->first();
//           if(!empty($idServiceCompanies)){
//               $data = [
//                   'departure_id' => $idDeparture['id'],
//                   'arrival_id' => $idArrival['id'],
//                   'date' => $value['date'],
//                   'departure_time' => $value['datetime_begin'],
//                   'arrival_time' => '23:59',
//                   'transportation_type_id' => $idServiceCompanies['type'],
//                   'status' => (!empty($value['status'] == '就航')? 1 : 2),
//                   'price' => 12000,
//                   'price_label' => 12000,
//                   'service_company_id' => $idServiceCompanies['id']
//               ];
//
//              $success = Wp_route_informations::create($data);
//           }
//        }
//        if ($success){
//            echo 'success';
//        }
//    }

    /**
     * @function crawlDataShinshinkisen
     * @description Get data from web shinshinkisen
     * @param $urlShinshinkisen
     */
//    public function crawlDataShinshinkisen($urlShinshinkisen){
//
//        $crawler = Goutte::request('GET', $urlShinshinkisen);
//
//        $contentInfors = $crawler->filter("div#contents")->each(function ($contentInfors){
//            return $contentInfors;
//        });
//
//        $tableInfors = $contentInfors[0]->filter('div.tdl_02.tdlEqual_16')->each(function($tableInfors){
//            return $tableInfors;
//        });
//
//        $tableData = $tableInfors[0]->filter('table')->each(function($tableData){
//            return $tableData;
//        });
//
//
//        $schedule = [];
//        for ($i = 0; $i < count($tableData); $i++){
//            $schedule = $tableData[$i];
//
//            $tr = $schedule->filter('tr')->each(function ($tr){
//                return $tr;
//            });
//
//            for ($j = 0; $j < count($tr); $j++){
//                $th = $tr[$j]->filter('th')->each(function($th) {
//                    return $th->text();
//                });
//
//                $td = $tr[$j]->filter('td')->each(function($td) {
//                    return $td->text();
//                });
//                var_dump($td);
//            }
//        }
//
//    }


    /**
     * @function CrawlApiGetData.
     * @description Get data with api from http://api.ekispert.jp
     * @param $baseURL
     */
    public function crawlDataApi($baseURL){
        $port_list = array(
            array(29095,319216),
            array(319204,319205),
            array(319204,319206),
            array(319205,319204),
            array(319206,319204),
            array(319206,319208),
            array(319206,319209),
            array(319206,319214),
            array(319206,319215),
            array(319206,319216),
            array(319206,319220),
            array(319206,319222),
            array(319206,319223),
            array(319207,319216),
            array(319208,319206),
            array(319208,319207),
            array(319208,319213),
            array(319208,319214),
            array(319208,319215),
            array(319208,319216),
            array(319208,319223),
            array(319209,319206),
            array(319209,319210),
            array(319209,319220),
            array(319209,319222),
            array(319210,319209),
            array(319212,319216),
            array(319213,319208),
            array(319213,319214),
            array(319213,319215),
            array(319213,319223),
            array(319214,319206),
            array(319214,319208),
            array(319214,319208),
            array(319214,319213),
            array(319214,319215),
            array(319214,319215),
            array(319214,319216),
            array(319214,319223),
            array(319214,319223),
            array(319215,319206),
            array(319215,319208),
            array(319215,319208),
            array(319215,319213),
            array(319215,319214),
            array(319215,319216),
            array(319215,319223),
            array(319215,319223),
            array(319216,29095),
            array(319216,319206),
            array(319216,319207),
            array(319216,319208),
            array(319216,319212),
            array(319216,319214),
            array(319216,319215),
            array(319216,319217),
            array(319216,319223),
            array(319217,319216),
            array(319220,319206),
            array(319220,319209),
            array(319220,319222),
            array(319222,319206),
            array(319222,319209),
            array(319222,319220),
            array(319223,319206),
            array(319223,319208),
            array(319223,319208),
            array(319223,319213),
            array(319223,319214),
            array(319223,319215),
            array(319223,319216),
            array(22827,29113),
            array(29111,29141),
            array(29112,29141),
            array(29113,22827),
            array(29141,29111),
            array(29141,29112),
            array(29141,29142),
            array(29141,29143),
            array(29142,29141),
            array(29143,29141),
        );
        //$port_list = array(   array(319206,319216),);

        $date_start = strtotime('2019-12-14');
        $date_end = strtotime('2019-12-30');
//$date_end = strtotime('2019-02-01');
        for($run_date = $date_start;$run_date <= $date_end; $run_date = $run_date + 86400){
            $thedate = Date('Ymd',$run_date);
            //データ抽出
            foreach($port_list as $onePort){
                $one = $onePort[0];//from station
                $onedes = $onePort[1];//to station
                $starttimeBack = true;
                $nextflag = "1300";

                //A=>Bのルート検索
                $getUrl = $baseURL . "&viaList={$one}:{$onedes}&time=0000&date=" . $thedate;
//echo $getUrl . "<br>";
                $result = file_get_contents($getUrl);
                $result = json_decode($result,true);
                if(isset($result['ResultSet']['Course']['searchType'])){//結果は１つだけの場合は構成統一
                    $result['ResultSet']['Course'] = array($result['ResultSet']['Course']);
                }
                if (!empty($result['ResultSet']['Course'])){
                    foreach($result['ResultSet']['Course'] as $key => $oneVal){
                        //direct route only will put to database
                        if($oneVal['Route']['transferCount'] == 0){
                            $count_num = count($oneVal['Price']) - 1;

                            $corporation = $oneVal['Route']['Line']['Name'];
                            $price = $oneVal['Price'][$count_num]['Oneway'];
                            $datetimebegin = $oneVal['Route']['Line']['DepartureState']['Datetime']['text'];
                            $datetimebegin = str_replace("T"," ", $datetimebegin);
                            $datetimebegin = str_replace("+09:00","", $datetimebegin);
                            $datetimeend = $oneVal['Route']['Line']['ArrivalState']['Datetime']['text'];
                            $datetimeend = str_replace("T"," ", $datetimeend);
                            $datetimeend = str_replace("+09:00","", $datetimeend);
                            $timeOnBoard = $oneVal['Route']['Line']['timeOnBoard'];
                            //if(is_array($price)) print_r($oneVal);
                            $starttime = $datetimebegin;

                            $csv = "{$one},{$onedes},{$thedate},{$datetimebegin},{$datetimeend},{$timeOnBoard},{$price},{$corporation}";

                            $data = explode(",",$csv);

                            $idDeparture = Wp_tokyo_stations::where('code', $data[0])->first();
                            $idArrival = Wp_tokyo_stations::where('code', $data[1])->first();

                            $datas = [];
                            $datas['departure_id'] = $idDeparture['id'];
                            $datas['arrival_id'] =  $idArrival['id'];
                            $datas['date'] = $data[2];
                            $datas['departure_time'] = $data[3];
                            $datas['arrival_time'] = $data[4];
                            $datas['price'] = $data[6];
                            $datas['transportation_type_id'] = 2;
                            $datas['service_company_id'] = 1;
                            $datas['price_label'] = $data[6];
                            $datas['status'] = 1;

                            $success = Wp_tokyo_route_informations::create($datas);
                        }
                    }
                    if ($success){
                        echo 'get data success';
                    }

                    $count = count($result['ResultSet']['Course']);
                    if(isset($result['ResultSet']['Course']) && $count >= 3){
                        $count_run = 1;
                        do{
                            $getURL = $baseURL . "&viaList={$one}:{$onedes}&date=" . $thedate;
                            self::loopSearch($getURL,$starttime,$starttimeBack,$nextflag,$one,$onedes,$thedate);
                            $count_run ++;
                            if($count_run >= 20){
                                $nextflag = false;
                            }
                        }while($nextflag);
                    }
                }
            }
        }
    }

    /**
     * @function loopSearch
     * @description loop search get data in api from http://api.ekispert.jp
     * @param $getURL
     * @param $starttime
     * @param $starttimeBack
     * @param $nextflag
     * @param $one
     * @param $onedes
     * @param $thedate
     */
    function loopSearch($getURL,$starttime,&$starttimeBack,&$nextflag,$one,$onedes,$thedate){
        $nextflag = false;
        $starttime = str_replace("T"," ", $starttime);
        $starttime = str_replace("+09:00","", $starttime);
//print_r(array($starttime,Date('Hm',strtotime($starttime)+60)));
        $starttime = Date('Hi',strtotime($starttime)+60);
        $getUrl = $getURL . "&time={$starttime}";
        $result = file_get_contents($getUrl);
        $result = json_decode($result,true);
        if(isset($result['ResultSet']['Course']['searchType'])){//結果は１つだけの場合は構成統一
            $result['ResultSet']['Course'] = array($result['ResultSet']['Course']);
        }
//print_r(array($starttime,$getUrl));
        if (!empty($result['ResultSet']['Course'])){
            foreach($result['ResultSet']['Course'] as $key => $oneVal){
                //direct route only will put to database
                if($oneVal['Route']['transferCount'] == 0){
                    $count_num = count($oneVal['Price']) - 1;

                    $corporation = $oneVal['Route']['Line']['Name'];
                    $price = $oneVal['Price'][$count_num]['Oneway'];
                    $datetimebegin = $oneVal['Route']['Line']['DepartureState']['Datetime']['text'];
                    $datetimebegin = str_replace("T"," ", $datetimebegin);
                    $datetimebegin = str_replace("+09:00","", $datetimebegin);
                    $datetimeend = $oneVal['Route']['Line']['ArrivalState']['Datetime']['text'];
                    $datetimeend = str_replace("T"," ", $datetimeend);
                    $datetimeend = str_replace("+09:00","", $datetimeend);
                    $timeOnBoard = $oneVal['Route']['Line']['timeOnBoard'];
                    //if(is_array($price)) print_r($oneVal);
                    $starttimeBack = $datetimebegin;

                    $csv = "{$one},{$onedes},{$thedate},{$datetimebegin},{$datetimeend},{$timeOnBoard},{$price},{$corporation}";
                    $data = explode(",",$csv);
                    dd($data);
                    $idDeparture = Wp_tokyo_stations::where('code', $data[0])->first();
                    $idArrival = Wp_tokyo_stations::where('code', $data[1])->first();
                    $datas = [];
                    $datas['departure_id'] = $idDeparture['id'];
                    $datas['arrival_id'] =  $idArrival['id'];
                    $datas['date'] = $data[2];
                    $datas['departure_time'] = $data[3];
                    $datas['arrival_time'] = $data[4];
                    $datas['price'] = $data[6];
                    $datas['transportation_type_id'] = 2;
                    $datas['price_label'] = $data[6];
                    $datas['service_company_id'] = 1;

                    $success = Wp_tokyo_route_informations::create($datas);

                }
            }
            if ($success){
                echo 'get data success';
            }
        }
        $count = count($result['ResultSet']['Course']);
        $nextflag = isset($result['ResultSet']['Course'])&& $count >= 3 ? true : false;
    }
}
