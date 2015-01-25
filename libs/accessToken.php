<?php

/**
 * Check request header param: access_token
 */
return function () {

//    global $db;
    global $user;

    $app = \Slim\Slim::getInstance();
    $authorization = $app->request->headers->get("X-Authorization");

    if ($authorization == null) {

        jsonResponse(401, array(
            "status" => $authorization,
            "errors" => array(
                "message" => "Unauthorized!",
                "developerMessage" => "Unauthorized, access_token is empty, please specify request header parameter: Authorization: Bearer xxx",
            )
        ));
    }

    $access_token = str_replace('Bearer ', '', $authorization);
    $tokenData = validateAccessToken($access_token);

    if (!$tokenData) {

        jsonResponse(401, array(
            "status" => 401,
            "errors" => array(
                "message" => "Unauthorized!",
                "developerMessage" => "Unauthorized, access token is wrong, please specify correct request header parameter: Authorization: Bearer xxx",
            )
        ));
    } else {
        $user = $tokenData->user;
    }

};