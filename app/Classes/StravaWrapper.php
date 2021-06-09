<?php


namespace App\Classes;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StravaWrapper
{

    public function curlActivities(Request $request){

        try{
            if ($request->session()->has('access_token')) {
                $token = $request->session()->get('access_token');

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://www.strava.com/api/v3/athlete/activities',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer '.$token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $result= json_decode($response);
            }
            else{
                return 0;
            }
        }catch (\Exception $e){
            Log::error('Error en la llamada a strava para pedir actividades '. $e->getMessage());
            return 0;
        }

        return $result;
    }

}
