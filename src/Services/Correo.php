<?php


namespace App\Services;


class Correo
{
    public function enviarEmail($email, $nombre, $apellido, $mailer, $config)
    {
        $mensaje = (new \Swift_Message())
            ->setSubject('Control de recetas médicas')
            ->setFrom($config->configEmail()['emailFrom'], 'Control de recetas médicas')
            ->setTo($email, $nombre . ' ' . $apellido)
            ->addPart('<h1>Email</h1>', 'text/html');
        $mailer->send($mensaje);
    }
}
