<?php

namespace App\Services\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

class Requestable
{
    public static function get($path, $auth = null)
    {
        return self::process(Request::create($path, 'GET'), $auth);
    }

    public static function post($path, $data, $auth = null)
    {
        return self::process(Request::create($path, 'POST', $data), $auth);
    }

    public static function put($path, $data, $auth = null)
    {
        return self::process(Request::create($path, 'PUT', $data), $auth);
    }

    public static function del($path, $data, $auth = null)
    {
        return self::process(Request::create($path, 'DELETE'), $auth);
    }

    private static function process($request, $auth)
    {
        if ($auth) {
            $request->headers->set('Authorization', 'Bearer '.$auth);
        }
        $request = Route::dispatch($request);

        $response = json_decode($request->getContent(), true);

        //echo "<pre>", var_dump($response);
        //echo "<pre>", var_dump(session()->all());
        //die();

        $response["status_code"] = $request->getStatusCode();

        if (!in_array($response["status_code"], [200,201])) {
            $response["errors"] = [["something went wrong! http response ".$response["status_code"]]];
        }

        if ($response["status_code"] === 401 && $auth != 'login') {
            session()->flush();
        }

        if ($response["status_code"] === 302) {
            $response["errors"] = json_decode(session()->get("errors"), 1);
        }

        return $response;
    }
}
