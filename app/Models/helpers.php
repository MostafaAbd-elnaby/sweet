<?php
/**
 * @return mixed
 * Custom functions made by themeqx
 */


/**
 * @return string
 */


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Contracts\Cookie\Factory as CookieFactory;
    use Twilio\Rest\Client;

    if (!function_exists('pageJsonData')) {
    function pageJsonData()
    {


        $jobModalOpen = false;
        if (session('job_validation_fails')) {
            $jobModalOpen = true;
        }

        $data = [
            'home_url' => '',
            'asset_url' => asset('assets'),
            'csrf_token' => csrf_token(),
            'jobModalOpen' => $jobModalOpen,
            'flag_job_validation_fails' => session('flag_job_validation_fails'),
            'share_job_validation_fails' => session('share_job_validation_fails'),
            //'my_dashboard' => route('my_dashboard'),
        ];

        $routeLists = Route::getRoutes();

        $routes = [];
        foreach ($routeLists as $route) {
            $routes[$route->getName()] = $data['home_url'].'/'.$route->uri;
        }
        $data['routes'] = $routes;

        return json_encode($data);
    }
}

    if (!function_exists('SendSms')) {
        function SendSms($to, $body)
        {
            try {
                $twilio = new Client( config('services.twilio.sid'), config('services.twilio.token'));
                return $twilio->messages->create('+' . $to , [
                    "from" => 'kushkatna',
                    "messagingServiceSid" => config('services.twilio.messagingServiceSid'),
                    "body" => $body
                ]);
            } catch (Throwable $e) {
                report($e);
                return false;
            }
        }
    }


//function e_form_error($field = '', $errors)
//{
//    $output = null;
//    if ($errors)
//        $output = $errors->has($field) ? '<span class="invalid-feedback" role="alert"><strong>'.$errors->first($field).'</strong></span>' : '';
//    return $output;
//}
//
//function e_form_invalid_class($field = '', $errors)
//{
//    if ($errors)
//        return $errors->has($field) ? ' is-invalid' : '';
//    return ;
//}


