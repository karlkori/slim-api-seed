<?php

class Controller {

    /**
     * Send json response
     * @param $status
     * @param string $data
     * @throws \Slim\Exception\Stop
     */
    public static function response($status, $data = '') {
        $app = \Slim\Slim::getInstance();
        $app->response->setStatus($status);
        $app->response->headers->set('Access-Control-Allow-Origin', '*');
        $app->response->headers->set('Content-Type', 'application/json');

        echo json_encode($data);
        $app->stop();
    }
}