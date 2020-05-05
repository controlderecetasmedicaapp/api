<?php


namespace App\Services;

use \Firebase\JWT\JWT;

//entity
use App\Entity\TblUsuarios;

class Login
{
    public string $key;

    public function __construct()
    {
        $this->key = 'h.-.JYUGn1g_}aT>"DFM!85W;kraUM{J^9|Tqp>8_&zzAS?9.#5atO[BX>reME]';
    }

    public function login($nombre, $usuario)
    {
        $response = [];

        if ($nombre !== null) {

            if (!empty($usuario)) {
                $token = [
                    'id' => $usuario->getId(),
                    'rut' => $usuario->getRutUsuario(),
                    'tipo' => $usuario->getIdTipoUsuario()->getId(),
                    'nombre' => $nombre
                ];
                $jwt = JWT::encode($token, $this->key);
                $decoded = JWT::decode($jwt, $this->key, array('HS256'));
                array_push($response, [
                    'estado' => 'correcto',
                    'jwt' => [
                        'token' => $jwt,
                        'identidad' => $decoded
                    ]
                ]);
            } else {
                array_push($response, [
                    'estado' => 'error',
                    'mensaje' => 'Credenciales incorrectas'
                ]);
            }
        } else {
            array_push($response, [
                'estado' => 'error',
                'mensaje' => 'Faltan campo que rellenar'
            ]);
        }
        return $response;
    }


    public function checkToken($token)
    {
        $response = [];
        if ($token !== null) {
            try {
                $decoded = JWT::decode($token, $this->key, array('HS256'));
            } catch (\DomainException $exception) {
                array_push($response, [
                    'estado' => 'error',
                    'mensaje' => 'El token es incorrecto'
                ]);
            }

            if (isset($decoded)) {
                array_push($response, [
                    'estado' => 'correcto',
                    'identidad' => $decoded
                ]);
            } else {
                array_push($response, [
                    'estado' => 'error',
                    'mensaje' => 'El token es incorrecto'
                ]);
            }
        } else {
            array_push($response, [
                'estado' => 'error',
                'mensaje' => 'Usuario no autenticado'
            ]);
        }
        return $response;
    }

}
