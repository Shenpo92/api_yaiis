<?php

namespace Todos\Middleware;

use Todos\Models\ApiUser;

class Authentication {

public static function authenticate($request, $app)
{
    $auth = $request->headers->get("Authorization");
    $apikey = substr($auth, strpos($auth, ' '));
    $apikey = trim($apikey);

    $ApiUser = new ApiUser();
    $check = $ApiUser->authenticate($apikey);


    if(!$check){
        $app->abort(401, "Authentification failed");
    }
    else $request->attributes->set('userid',$check);
    }
}
?>
