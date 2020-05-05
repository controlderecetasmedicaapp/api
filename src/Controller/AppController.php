<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

//services
use App\Services\Login;

//Entity
use App\Entity\TblUsuarios;
use App\Entity\TblIsp;
use App\Entity\TblMedicos;

class AppController extends AbstractController
{
    /**
     * @Route("/app", name="app")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AppController.php',
        ]);
    }

    /**
     * @Route("/app/login", name="app_login", methods={"POST"})
     * @param Request $request
     * @param Login $login
     * @return JsonResponse
     */
    public function login(Request $request, Login $login)
    {

        $rut = $request->get('rut', null);
        $password = $request->get('password', null);
        $nombre = '';
        $usuario = $this->getDoctrine()
            ->getRepository(TblUsuarios::class)
            ->findOneBy(['rutUsuario' => $rut, 'password' => hash('sha256', $password)]);
        if (!empty($usuario)) {
            if ($usuario->getIdTipoUsuario()->getId() === 4) {
                $isp = $this->getDoctrine()->getRepository(TblIsp::class)->findOneBy(['idIsp' => $usuario->getId()]);
                $nombre = $isp->getNombreIsp() . ' ' . $isp->getApellidoIsp();
            }

            if ($usuario->getIdTipoUsuario()->getId() === 2) {
                $medico = $this->getDoctrine()->getRepository(TblMedicos::class)->findOneBy(['idMedico' => $usuario->getId()]);
                $nombre = $medico->getNombreMedico() . ' ' . $medico->getApellidosMedico();
            }

        }
        return new JsonResponse($login->login($nombre, $usuario));
    }
}
