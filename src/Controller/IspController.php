<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

//config
use App\Config\Config;

//Services
use App\Services\ChileRut;
use App\Services\Correo;
use App\Services\Login;

//Entity
use App\Entity\TblUsuarios;
use App\Entity\TblTiposUsuarios;
use App\Entity\TblIsp;
use App\Entity\TblComunas;
use App\Entity\TblMedicos;
use App\Entity\TblEstablecimientos;
use App\Entity\TblEspecialidades;

class IspController extends AbstractController
{
    /**
     * @Route("/isp", name="isp")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IspController.php',
        ]);
    }

    /**
     * @Route("/isp/crear/perfil/isp", name="isp_crear_perfil_isp", methods={"POST"})
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param ChileRut $chileRut
     * @param Correo $correo
     * @param Config $config
     * @param \Swift_Mailer $mailer
     * @return JsonResponse
     */
    public function crearPerfilIsp(Request $request,
                                   ValidatorInterface $validator,
                                   ChileRut $chileRut,
                                   Correo $correo,
                                   Config $config,
                                   \Swift_Mailer $mailer)
    {
        $response = [];
        $errorArray = [];
        $varErrorArray = [];
        $rut = $request->get('rut', null);
        $nombre = $request->get('nombre', null);
        $apellido = $request->get('apellido', null);
        $direccion = $request->get('direccion', null);
        $fono = $request->get('fono', null);
        $email = $request->get('email', null);
        $idComuna = $request->get('idComuna', null);

        if ($rut !== null
            && $nombre !== null
            && $apellido !== null
            && $direccion !== null
            && $fono !== null
            && $email !== null
            && $idComuna !== null) {

            $usuario = new TblUsuarios();
            $usuario->setRutUsuario($rut);
            $tipoUsuario = $this->getDoctrine()
                ->getRepository(TblTiposUsuarios::class)
                ->findOneBy(['id' => 4]);
            $usuario->setIdTipoUsuario($tipoUsuario);
            $usuario->setPassword($tipoUsuario->getTipoUsuario() . $rut);

            $isp = new TblIsp();
            $isp->setNombreIsp($nombre);
            $isp->setApellidoIsp($apellido);
            $isp->setDireccionIsp($direccion);
            $isp->setFonoIsp($fono);
            $isp->setEmailIsp($email);
            $comuna = $this->getDoctrine()
                ->getRepository(TblComunas::class)
                ->findOneBy(['id' => $idComuna]);
            $isp->setIdComuna($comuna);
            $isp->setCreatedAt(new \DateTime('now'));
            $isp->setUpdatedAt(new \DateTime('now'));

            $errorsUsuario = $validator->validate($usuario);
            $errorsIsp = $validator->validate($isp);
            if (count($errorsUsuario) > 0 || count($errorsIsp) > 0) {
                if (count($errorsUsuario) > 0) {
                    foreach ($errorsUsuario as $key => $error) {
                        array_push($errorArray, $error->getMessage());
                        array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                    }
                }
                if (count($errorsIsp) > 0) {
                    foreach ($errorsIsp as $key => $error) {
                        array_push($errorArray, $error->getMessage());
                        array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                    }
                }
                array_push($response, [
                    'estado' => 'error',
                    'mensaje' => $errorArray,
                    'varError' => $varErrorArray
                ]);
            } else {
                if ($chileRut->check($rut)) {

                    $usuarioExistente = $this->getDoctrine()
                        ->getRepository(TblUsuarios::class)
                        ->findBy(['rutUsuario' => $rut]);

                    if (empty($usuarioExistente)) {
                        $usuario->setPassword(hash('sha256', $usuario->getPassword()));
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($usuario);
                        $em->flush();

                        $isp->setIdIsp($usuario);

                        $em->persist($isp);
                        $em->flush();
                        $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config,$tipoUsuario->getTipoUsuario() . $rut,$rut,1);
                        array_push($response, [
                            'estado' => 'correcto',
                            'mensaje' => 'Se registro correctamente',
                            'usuario' => $usuario,
                            'isp' => $isp
                        ]);
                    } else {
                        array_push($response, [
                            'estado' => 'error',
                            'mensaje' => 'El usuario ya existe'
                        ]);
                    }
                } else {
                    array_push($response, [
                        'estado' => 'error',
                        'mensaje' => 'El rut no es valido'
                    ]);
                }
            }

        } else {
            array_push($response, [
                'estado' => 'error',
                'mensaje' => 'Falta rellanar campos'
            ]);
        }

        return new JsonResponse($response);
    }

    public function verificacionDePerfil($login, $token)
    {
        $response = [];
        if ($token !== null) {
            if ($login->checkToken($token)[0]['estado'] === 'correcto') {
                if ($login->checkToken($token)[0]['identidad']->tipo === 4) {
                    array_push($response, [
                        'estado' => 'correcto'
                    ]);
                } else {
                    array_push($response, [
                        'estado' => 'error',
                        'mensaje' => 'ud no pertenece al Isp'
                    ]);
                }
            } else {
                array_push($response, [
                    'estado' => 'error',
                    'mensaje' => 'El token es incorrecto'
                ]);
            }
        } else {
            array_push($response, [
                'estado' => 'error',
                'mensaje' => 'Falta autenticarse'
            ]);
        }
        return $response;
    }

    // $response = [];
    //        $token = $request->headers->get('Authorization', null);
    //
    //        if ($this->verificacionDePerfil($login, $token)[0]['estado'] === 'correcto') {
    //
    //        } else {
    //            array_push($response, $this->verificacionDePerfil($login, $token)[0]);
    //        }
    //        return new JsonResponse($response);

    /**
     * @Route("/isp/crear/perfil/medico", name="isp_crear_perfil_medico", methods={"POST"})
     * @param Login $login
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param Config $config
     * @param \Swift_Mailer $mailer
     * @param Correo $correo
     * @param ChileRut $chileRut
     * @return JsonResponse
     */
    public function crearPerfilDoctor(Login $login,
                                      Request $request,
                                      ValidatorInterface $validator,
                                      Config $config,
                                      \Swift_Mailer $mailer,
                                      Correo $correo,
                                      ChileRut $chileRut)
    {
        $response = [];
        $token = $request->headers->get('Authorization', null);

        if ($this->verificacionDePerfil($login, $token)[0]['estado'] === 'correcto') {
            $errorArray = [];
            $varErrorArray = [];
            $rcm = $request->get('rcm', null);
            $rut = $request->get('rut', null);
            $nombre = $request->get('nombre', null);
            $apellido = $request->get('apellido', null);
            $direccion = $request->get('direccion', null);
            $fono = $request->get('fono', null);
            $email = $request->get('email', null);
            $idComuna = $request->get('idComuna', null);
            $idEstablecimiento = $request->get('idEstablecimiento', null);
            $idEspecialidad = $request->get('idEspecialidad', null);
            if ($rut !== null &&
                $nombre !== null &&
                $apellido !== null &&
                $direccion !== null &&
                $fono !== null &&
                $email !== null &&
                $idComuna !== null &&
                $rcm !== null &&
                $idEstablecimiento !== null) {

                $usuario = new TblUsuarios();
                $usuario->setRutUsuario($rut);
                $tipoUsuario = $this->getDoctrine()
                    ->getRepository(TblTiposUsuarios::class)
                    ->findOneBy(['id' => 2]);
                $usuario->setIdTipoUsuario($tipoUsuario);
                $usuario->setPassword($tipoUsuario->getTipoUsuario() . $rut);

                $medico = new TblMedicos();
                $medico->setRcmMedico($rcm);
                $medico->setNombreMedico($nombre);
                $medico->setApellidosMedico($apellido);
                $medico->setDireccionMedico($direccion);
                $establecimiento = $this->getDoctrine()
                    ->getRepository(TblEstablecimientos::class)
                    ->findOneBy(['id' => $idEstablecimiento]);
                $medico->setIdEstablecimiento($establecimiento);
                $comuna = $this->getDoctrine()
                    ->getRepository(TblComunas::class)
                    ->findOneBy(['id' => $idComuna]);
                $medico->setIdComuna($comuna);
                $medico->setEmailMedico($email);
                $medico->setFonoMedico($fono);
                $especialidad = $this->getDoctrine()
                    ->getRepository(TblEspecialidades::class)
                    ->findOneBy(['id' => $idEspecialidad]);
                $medico->setIdEspecialidad($especialidad);
                $medico->setFirmaMedico('firma');

                $errorsUsuario = $validator->validate($usuario);
                $errorsMedico = $validator->validate($medico);
                if (count($errorsUsuario) > 0 || count($errorsMedico) > 0) {
                    if (count($errorsUsuario) > 0) {
                        foreach ($errorsUsuario as $key => $error) {
                            array_push($errorArray, $error->getMessage());
                            array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                        }
                    }
                    if (count($errorsMedico) > 0) {
                        foreach ($errorsMedico as $key => $error) {
                            array_push($errorArray, $error->getMessage());
                            array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                        }
                    }
                    array_push($response, [
                        'estado' => 'error',
                        'mensaje' => $errorArray,
                        'varError' => $varErrorArray
                    ]);
                } else {
                    if ($chileRut->check($rut)) {
                        $medicoExistente = $this->getDoctrine()
                            ->getRepository(TblUsuarios::class)
                            ->findBy(['rutUsuario' => $rut]);
                        if (empty($medicoExistente)) {
                            $usuario->setPassword(hash('sha256', $usuario->getPassword()));
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($usuario);
                            $em->flush();

                            $medico->setIdMedico($usuario);
                            $em->persist($medico);
                            $em->flush();
                            $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config,$tipoUsuario->getTipoUsuario() . $rut,$rut,1);
                            array_push($response, [
                                'estado' => 'correcto',
                                'mensaje' => 'Se registro correctamente',
                                'usuario' => $usuario,
                                'medico' => $medico
                            ]);
                        } else {
                            array_push($response, [
                                'estado' => 'error',
                                'mensaje' => 'El usuario ya existe'
                            ]);
                        }
                    } else {
                        array_push($response, [
                            'estado' => 'error',
                            'mensaje' => 'El rut es incorrecto'
                        ]);
                    }
                }
            } else {
                array_push($response, [
                    'estado' => 'error',
                    'mensaje' => 'Falta rellanar campos'
                ]);
            }

        } else {
            array_push($response, $this->verificacionDePerfil($login, $token)[0]);
        }
        return new JsonResponse($response);
    }

}


