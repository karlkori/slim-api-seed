<?php

class Token {

    /**
     * JWT token for every user
     * @return string
     */
    public static function create($user) {
        global $config;

        $header = new \Psecio\Jwt\Header($config['jwt_secret']);
        $jwt = new \Psecio\Jwt\Jwt($header);

//    $jwt
//        ->issuer('http://example.org')
//        ->audience('http://example.com')
//        ->issuedAt(1356999524)
//        ->notBefore(1357000000)
//        ->expireTime(time()+3600)
//        ->jwtId('id123456')
//        ->type('https://example.com/register')
//        ->custom('user', 'custom-claim');

        $payload = array();
        $payload['id'] = $user['id'];
        $payload['email'] = $user['email'];

        $jwt
            ->audience($config['host'])
            ->custom($payload, 'user');

        $token = $jwt->encode();

        return $token;
    }

    public static function decode($token) {
        global $config;

        $header = new \Psecio\Jwt\Header($config['jwt_secret']);
        $jwt = new \Psecio\Jwt\Jwt($header);

        try {
            $result = $jwt->decode($token);
        } catch (\Exception $ex){
            return false;
        }

        return $result;
    }

}