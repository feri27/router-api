<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $client = new Client();
        $res = $client->request('POST','https://api.ic.peplink.com/api/oauth2/token', [
            'form_params' => [
                'client_id' => '0e8e958dd27a4bb12e7adcb0970f95da',
                'client_secret' => '2523a7ca6b61589e6bb13561d22a89dd',
                'grant_type' => 'client_credentials'
            ]
        ])->getBody();

        $token = json_decode($res, true);

        $data=$this->download_csv($token['access_token']);
        $datas[] = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $data));
        $datas = array_map('array_filter', $datas);
        $item[]=json_encode($datas,JSON_FORCE_OBJECT);
        $data_s = json_decode($item[0],true, JSON_UNESCAPED_SLASHES);

        $array=array();
        foreach($data_s as $row[0]){

            foreach($row as $row_i[0]){

                foreach($row_i as $row_ii){
                    
                    $array[]=array(

                        $row_ii
        
                    );

                }
                
            }
            
        }
       $result1=$array[0];
       $result2=$result1[0];

       $array1=array();
       foreach($result2 as $row){

            $array1[]=$row;

       }

        $array2=array();  
        foreach($array1 as $row){
    
                $array2[]=array(
                    $row
            );
        }

        $array3=array();
        for ($x = 1; $x <=100; $x++) {
            $array3[]=$array2[$x][0];
        
        }

        $array4=array();
        foreach($array3 as $row){

            $array4[]=array(
                'date'=>$row[0],
                'mac'=>$row[1],
                'rssi'=>$row[2],
                'chanel'=>$row[3],
        
            );

        }


        $data_r = json_encode($array4);
        $data_s = json_decode($data_r, true);

        return view('dashboard')->with('data',$data_s);

    }


    public function get_data($token)
    {
        $client = new Client();
        $res = $client->request('GET','https://api.ic.peplink.com/rest/o/gPTKNW/d/3', [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ])->getBody();

        $data = json_decode($res, true);
        return $data['data'];
    }


    public function download_csv($token){


        $client = new Client();
        $res = $client->request('GET','https://api.ic.peplink.com/rest/o/gPTKNW/g/1/d/3/wlan_probe?start=2022-03-09&end=&plain_date_format=true', [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ])->getBody()->getContents();

        return $res;
    }


}