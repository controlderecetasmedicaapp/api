<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

//config
use App\Config\Config;

//Services
use App\Services\ChileRut;
use App\Services\Correo;
use App\Services\Login;

//Entity
use App\Entity\TblUsuarios;
use App\Entity\TblTiposUsuarios;
use App\Entity\TblComunas;
use App\Entity\TblPacientes;
use App\Entity\TblSexo;
use App\Entity\TblMedicos;
use App\Entity\TblMedicosTratantes;

class MedicoController extends AbstractController
{
    /**
     * @Route("/medico", name="medico")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MedicoController.php',
        ]);
    }


    public function verificacionDePerfil($login, $token)
    {
        $response = [];
        if ($token !== null) {
            if ($login->checkToken($token)[0]['estado'] === 'correcto') {
                if ($login->checkToken($token)[0]['identidad']->tipo === 2) {
                    array_push($response, [
                        'estado' => 'correcto'
                    ]);
                } else {
                    array_push($response, [
                        'estado' => 'error',
                        'mensaje' => 'ud no es médico'
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
     * @Route("/medico/crear/paciente", name="medico_crear_paciente", methods={"POST"})
     * @param Login $login
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param Config $config
     * @param \Swift_Mailer $mailer
     * @param Correo $correo
     * @param ChileRut $chileRut
     * @return JsonResponse
     */
    public function crearPaciente(Login $login,
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
            $rut = $request->get('rut', null);
            $nombre = $request->get('nombre', null);
            $apellido = $request->get('apellido', null);
            $direccion = $request->get('direccion', null);
            $fono = $request->get('fono', null);
            $email = $request->get('email', null);
            $fecha = $request->get('fecha', null);
            $peso = $request->get('peso', null);
            $altura = $request->get('altura', null);
            $idSexo = $request->get('idSexo', null);
            $idComuna = $request->get('idComuna', null);
            $usuarioExistente = $this->getDoctrine()
                ->getRepository(TblUsuarios::class)
                ->findOneBy(['rutUsuario' => $rut]);

//            var_dump(gettype((int)$usuarioExistente->getIdTipoUsuario()->getId()));
//            var_dump(empty($usuarioExistente));
//            die();
            if (empty($usuarioExistente)) {
                if ($rut !== null &&
                    $nombre !== null &&
                    $apellido !== null &&
                    $direccion !== null &&
                    $fono !== null &&
                    $email !== null &&
                    $fecha !== null &&
                    $peso !== null &&
                    $altura !== null &&
                    $idSexo !== null &&
                    $idComuna !== null) {


                    $usuario = new TblUsuarios();
                    $usuario->setRutUsuario($rut);
                    $tipo = $this->getDoctrine()->getRepository(TblTiposUsuarios::class)->findOneBy(['id' => 1]);
                    $usuario->setIdTipoUsuario($tipo);
                    $usuario->setPassword($tipo->getTipoUsuario() . $rut);

                    $paciente = new TblPacientes();
                    $paciente->setNombrePaciente(ucwords($nombre));
                    $paciente->setApellidoPaciente(ucwords($apellido));
                    $paciente->setDireccionPaciente($direccion);
                    $paciente->setFonoPaciente($fono);
                    $paciente->setEmailPaciente($email);
                    $paciente->setFechaNacimiento(\DateTime::createFromFormat('Y-m-d', $fecha));
                    $paciente->setPeso($peso);
                    $paciente->setAltura($altura);
                    $sexo = $this->getDoctrine()->getRepository(TblSexo::class)->findOneBy(['id' => $idSexo]);
                    $paciente->setIdSexo($sexo);
                    $comuna = $this->getDoctrine()->getRepository(TblComunas::class)->findOneBy(['id' => $idComuna]);
                    $paciente->setIdComuna($comuna);
                    $paciente->setCreatedAt(new \DateTime('now'));
                    $paciente->setUpdatedAt(new \DateTime('now'));


                    $errorsUsuario = $validator->validate($usuario);
                    $errorsPaciente = $validator->validate($paciente);
                    if (count($errorsUsuario) > 0 || count($errorsPaciente)) {
                        if (count($errorsUsuario) > 0) {
                            foreach ($errorsUsuario as $key => $error) {
                                array_push($errorArray, $error->getMessage());
                                array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                            }
                        }

                        if (count($errorsPaciente) > 0) {
                            foreach ($errorsPaciente as $key => $error) {
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
                            $usuario->setPassword(hash('sha256', $usuario->getPassword()));
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($usuario);
                            $em->flush();

                            $paciente->setIdPaciente($usuario);

                            $em->persist($paciente);
                            $em->flush();

                            $medicoTratante = new TblMedicosTratantes();
                            $medicoTratante->setIdPaciente($paciente);
                            $medico = $this->getDoctrine()
                                ->getRepository(TblMedicos::class)
                                ->findOneBy(['idMedico' => $login->checkToken($token)[0]['identidad']->id]);
                            $medicoTratante->setIdMedico($medico);

                            $em->persist($medicoTratante);
                            $em->flush();

                            $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config,$tipo->getTipoUsuario() . $rut,$rut,1);
                            array_push($response, [
                                'estado' => 'correcto',
                                'mensaje' => 'Se registro correctamente',
                                'usuario' => $paciente
                            ]);

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
            } else {

                switch ((int)$usuarioExistente->getIdTipoUsuario()->getId()) {
                    case 1:

                        $pacienteExistente = $this->getDoctrine()
                            ->getRepository(TblMedicosTratantes::class)
                            ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId(),
                                    'idMedico' => $login->checkToken($token)[0]['identidad']->id]
                            );
                        if (empty($pacienteExistente)) {

                            $paciente = $this->getDoctrine()
                                ->getRepository(TblPacientes::class)
                                ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId()]);
                            $paciente->setNombrePaciente(ucwords($nombre));
                            $paciente->setApellidoPaciente(ucwords($apellido));
                            $paciente->setDireccionPaciente($direccion);
                            $paciente->setFonoPaciente($fono);
                            $paciente->setEmailPaciente($email);
                            $paciente->setFechaNacimiento(\DateTime::createFromFormat('Y-m-d', $fecha));
                            $paciente->setPeso($peso);
                            $paciente->setAltura($altura);
                            $sexo = $this->getDoctrine()->getRepository(TblSexo::class)->findOneBy(['id' => $idSexo]);
                            $paciente->setIdSexo($sexo);
                            $comuna = $this->getDoctrine()->getRepository(TblComunas::class)->findOneBy(['id' => $idComuna]);
                            $paciente->setIdComuna($comuna);
                            $paciente->setCreatedAt(new \DateTime('now'));
                            $paciente->setUpdatedAt(new \DateTime('now'));

                            $errorsPaciente = $validator->validate($paciente);
                            if (count($errorsPaciente)) {
                                foreach ($errorsPaciente as $key => $error) {
                                    array_push($errorArray, $error->getMessage());
                                    array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                                }
                                array_push($response, [
                                    'estado' => 'error',
                                    'mensaje' => $errorArray,
                                    'varError' => $varErrorArray
                                ]);

                            } else {
                                if ($chileRut->check($rut)) {

                                    $em = $this->getDoctrine()->getManager();

                                    $paciente->setIdPaciente($usuarioExistente);

                                    $em->persist($paciente);
                                    $em->flush();

                                    $medicoTratante = new TblMedicosTratantes();
                                    $medicoTratante->setIdPaciente($paciente);
                                    $medico = $this->getDoctrine()
                                        ->getRepository(TblMedicos::class)
                                        ->findOneBy(['idMedico' => $login->checkToken($token)[0]['identidad']->id]);
                                    $medicoTratante->setIdMedico($medico);

                                    $em->persist($medicoTratante);
                                    $em->flush();

                                    //Todo: Email de se agrego un doctor nuevo, sin modificar el usuario
                                    $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config,'','',2);
                                    array_push($response, [
                                        'estado' => 'correcto',
                                        'mensaje' => 'Se registro correctamente',
                                        'usuario' => $paciente
                                    ]);

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
                                'mensaje' => 'El paciente ya existe'
                            ]);
                        }
                        break;

                    case 2:
                        if ($usuarioExistente->getIdTipoUsuario()->getRutUsuario() !== $login->checkToken($token)[0]['identidad']->rut) {
                            $pacienteExistente = $this->getDoctrine()
                                ->getRepository(TblMedicosTratantes::class)
                                ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId(),
                                        'idMedico' => $login->checkToken($token)[0]['identidad']->id]
                                );

                            if (empty($pacienteExistente)) {
                                $medicoPaciente = $this->getDoctrine()
                                    ->getRepository(TblPacientes::class)
                                    ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId()]);

                                if (empty($medicoPaciente)) {
                                    $paciente = new TblPacientes();
                                    $paciente->setNombrePaciente(ucwords($nombre));
                                    $paciente->setApellidoPaciente(ucwords($apellido));
                                    $paciente->setDireccionPaciente($direccion);
                                    $paciente->setFonoPaciente($fono);
                                    $paciente->setEmailPaciente($email);
                                    $paciente->setFechaNacimiento(\DateTime::createFromFormat('Y-m-d', $fecha));
                                    $paciente->setPeso($peso);
                                    $paciente->setAltura($altura);
                                    $sexo = $this->getDoctrine()->getRepository(TblSexo::class)->findOneBy(['id' => $idSexo]);
                                    $paciente->setIdSexo($sexo);
                                    $comuna = $this->getDoctrine()->getRepository(TblComunas::class)->findOneBy(['id' => $idComuna]);
                                    $paciente->setIdComuna($comuna);
                                    $paciente->setCreatedAt(new \DateTime('now'));
                                    $paciente->setUpdatedAt(new \DateTime('now'));


                                    $errorsPaciente = $validator->validate($paciente);
                                    if (count($errorsPaciente)) {
                                        foreach ($errorsPaciente as $key => $error) {
                                            array_push($errorArray, $error->getMessage());
                                            array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                                        }
                                        array_push($response, [
                                            'estado' => 'error',
                                            'mensaje' => $errorArray,
                                            'varError' => $varErrorArray
                                        ]);

                                    } else {
                                        if ($chileRut->check($rut)) {

                                            $em = $this->getDoctrine()->getManager();

                                            $paciente->setIdPaciente($usuarioExistente);

                                            $em->persist($paciente);
                                            $em->flush();

                                            $medicoTratante = new TblMedicosTratantes();
                                            $medicoTratante->setIdPaciente($paciente);
                                            $medico = $this->getDoctrine()
                                                ->getRepository(TblMedicos::class)
                                                ->findOneBy(['idMedico' => $login->checkToken($token)[0]['identidad']->id]);
                                            $medicoTratante->setIdMedico($medico);

                                            $em->persist($medicoTratante);
                                            $em->flush();

                                            //Todo: Email se agrego un doctor nuevo, sin modificar el usuario
                                            $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config,'','',2);
                                            array_push($response, [
                                                'estado' => 'correcto',
                                                'mensaje' => 'Se registro correctamente',
                                                'usuario' => $paciente
                                            ]);

                                        } else {
                                            array_push($response, [
                                                'estado' => 'error',
                                                'mensaje' => 'El rut no es valido'
                                            ]);
                                        }
                                    }
                                } else {

                                    $paciente = $this->getDoctrine()
                                        ->getRepository(TblPacientes::class)
                                        ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId()]);

                                    $paciente->setNombrePaciente(ucwords($nombre));
                                    $paciente->setApellidoPaciente(ucwords($apellido));
                                    $paciente->setDireccionPaciente($direccion);
                                    $paciente->setFonoPaciente($fono);
                                    $paciente->setEmailPaciente($email);
                                    $paciente->setFechaNacimiento(\DateTime::createFromFormat('Y-m-d', $fecha));
                                    $paciente->setPeso($peso);
                                    $paciente->setAltura($altura);
                                    $sexo = $this->getDoctrine()->getRepository(TblSexo::class)->findOneBy(['id' => $idSexo]);
                                    $paciente->setIdSexo($sexo);
                                    $comuna = $this->getDoctrine()->getRepository(TblComunas::class)->findOneBy(['id' => $idComuna]);
                                    $paciente->setIdComuna($comuna);
                                    $paciente->setCreatedAt(new \DateTime('now'));
                                    $paciente->setUpdatedAt(new \DateTime('now'));

                                    $errorsPaciente = $validator->validate($paciente);
                                    if (count($errorsPaciente)) {
                                        foreach ($errorsPaciente as $key => $error) {
                                            array_push($errorArray, $error->getMessage());
                                            array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                                        }
                                        array_push($response, [
                                            'estado' => 'error',
                                            'mensaje' => $errorArray,
                                            'varError' => $varErrorArray
                                        ]);

                                    } else {
                                        if ($chileRut->check($rut)) {

                                            $em = $this->getDoctrine()->getManager();

                                            $paciente->setIdPaciente($usuarioExistente);

                                            $em->persist($paciente);
                                            $em->flush();

                                            $medicoTratante = new TblMedicosTratantes();
                                            $medicoTratante->setIdPaciente($paciente);
                                            $medico = $this->getDoctrine()
                                                ->getRepository(TblMedicos::class)
                                                ->findOneBy(['idMedico' => $login->checkToken($token)[0]['identidad']->id]);
                                            $medicoTratante->setIdMedico($medico);

                                            $em->persist($medicoTratante);
                                            $em->flush();

                                            //Todo: Se agrego un doctor como paciente
                                            $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config,'','',2);
                                            array_push($response, [
                                                'estado' => 'correcto',
                                                'mensaje' => 'Se registro correctamente',
                                                'usuario' => $paciente
                                            ]);

                                        } else {
                                            array_push($response, [
                                                'estado' => 'error',
                                                'mensaje' => 'El rut no es valido'
                                            ]);
                                        }
                                    }

                                }

                            } else {
                                array_push($response, [
                                    'estado' => 'error',
                                    'mensaje' => 'El paciente ya existe'
                                ]);
                            }

                        } else {
                            array_push($response, [
                                'estado' => 'error',
                                'mensaje' => 'Ud no puede ser su doctor'
                            ]);
                        }
                        break;
                    case 3:
                        var_dump('farmacia');
                        break;
                    case 4:

                        $pacienteExistente = $this->getDoctrine()
                            ->getRepository(TblMedicosTratantes::class)
                            ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId(),
                                    'idMedico' => $login->checkToken($token)[0]['identidad']->id]
                            );

                        if (empty($pacienteExistente)) {
                            $IspPaciente = $this->getDoctrine()
                                ->getRepository(TblPacientes::class)
                                ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId()]);

                            if (empty($IspPaciente)) {
                                $paciente = new TblPacientes();
                                $paciente->setNombrePaciente(ucwords($nombre));
                                $paciente->setApellidoPaciente(ucwords($apellido));
                                $paciente->setDireccionPaciente($direccion);
                                $paciente->setFonoPaciente($fono);
                                $paciente->setEmailPaciente($email);
                                $paciente->setFechaNacimiento(\DateTime::createFromFormat('Y-m-d', $fecha));
                                $paciente->setPeso($peso);
                                $paciente->setAltura($altura);
                                $sexo = $this->getDoctrine()->getRepository(TblSexo::class)->findOneBy(['id' => $idSexo]);
                                $paciente->setIdSexo($sexo);
                                $comuna = $this->getDoctrine()->getRepository(TblComunas::class)->findOneBy(['id' => $idComuna]);
                                $paciente->setIdComuna($comuna);
                                $paciente->setCreatedAt(new \DateTime('now'));
                                $paciente->setUpdatedAt(new \DateTime('now'));


                                $errorsPaciente = $validator->validate($paciente);
                                if (count($errorsPaciente)) {
                                    foreach ($errorsPaciente as $key => $error) {
                                        array_push($errorArray, $error->getMessage());
                                        array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                                    }
                                    array_push($response, [
                                        'estado' => 'error',
                                        'mensaje' => $errorArray,
                                        'varError' => $varErrorArray
                                    ]);

                                } else {
                                    if ($chileRut->check($rut)) {

                                        $em = $this->getDoctrine()->getManager();

                                        $paciente->setIdPaciente($usuarioExistente);

                                        $em->persist($paciente);
                                        $em->flush();

                                        $medicoTratante = new TblMedicosTratantes();
                                        $medicoTratante->setIdPaciente($paciente);
                                        $medico = $this->getDoctrine()
                                            ->getRepository(TblMedicos::class)
                                            ->findOneBy(['idMedico' => $login->checkToken($token)[0]['identidad']->id]);
                                        $medicoTratante->setIdMedico($medico);

                                        $em->persist($medicoTratante);
                                        $em->flush();

                                        //Todo: Email de se agrego un doctor nuevo, sin modificar el usuario
                                        $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config);
                                        array_push($response, [
                                            'estado' => 'correcto',
                                            'mensaje' => 'Se registro correctamente',
                                            'usuario' => $paciente
                                        ]);

                                    } else {
                                        array_push($response, [
                                            'estado' => 'error',
                                            'mensaje' => 'El rut no es valido'
                                        ]);
                                    }
                                }
                            } else {

                                $paciente = $this->getDoctrine()
                                    ->getRepository(TblPacientes::class)
                                    ->findOneBy(['idPaciente' => $usuarioExistente->getIdTipoUsuario()->getId()]);

                                $paciente->setNombrePaciente(ucwords($nombre));
                                $paciente->setApellidoPaciente(ucwords($apellido));
                                $paciente->setDireccionPaciente($direccion);
                                $paciente->setFonoPaciente($fono);
                                $paciente->setEmailPaciente($email);
                                $paciente->setFechaNacimiento(\DateTime::createFromFormat('Y-m-d', $fecha));
                                $paciente->setPeso($peso);
                                $paciente->setAltura($altura);
                                $sexo = $this->getDoctrine()->getRepository(TblSexo::class)->findOneBy(['id' => $idSexo]);
                                $paciente->setIdSexo($sexo);
                                $comuna = $this->getDoctrine()->getRepository(TblComunas::class)->findOneBy(['id' => $idComuna]);
                                $paciente->setIdComuna($comuna);
                                $paciente->setCreatedAt(new \DateTime('now'));
                                $paciente->setUpdatedAt(new \DateTime('now'));

                                $errorsPaciente = $validator->validate($paciente);
                                if (count($errorsPaciente)) {
                                    foreach ($errorsPaciente as $key => $error) {
                                        array_push($errorArray, $error->getMessage());
                                        array_push($varErrorArray, explode(':', explode('.', (string)$error)[1])[0]);
                                    }
                                    array_push($response, [
                                        'estado' => 'error',
                                        'mensaje' => $errorArray,
                                        'varError' => $varErrorArray
                                    ]);

                                } else {
                                    if ($chileRut->check($rut)) {

                                        $em = $this->getDoctrine()->getManager();

                                        $paciente->setIdPaciente($usuarioExistente);

                                        $em->persist($paciente);
                                        $em->flush();

                                        $medicoTratante = new TblMedicosTratantes();
                                        $medicoTratante->setIdPaciente($paciente);
                                        $medico = $this->getDoctrine()
                                            ->getRepository(TblMedicos::class)
                                            ->findOneBy(['idMedico' => $login->checkToken($token)[0]['identidad']->id]);
                                        $medicoTratante->setIdMedico($medico);

                                        $em->persist($medicoTratante);
                                        $em->flush();

                                        //Todo: Se agrego un doctor como paciente
                                        $correo->enviarEmail($email, $nombre, $apellido, $mailer, $config);
                                        array_push($response, [
                                            'estado' => 'correcto',
                                            'mensaje' => 'Se registro correctamente',
                                            'usuario' => $paciente
                                        ]);

                                    } else {
                                        array_push($response, [
                                            'estado' => 'error',
                                            'mensaje' => 'El rut no es valido'
                                        ]);
                                    }
                                }

                            }

                        } else {
                            array_push($response, [
                                'estado' => 'error',
                                'mensaje' => 'El paciente ya existe'
                            ]);
                        }

                        break;
                    default:
                        var_dump('Error');
                        break;
                }
            }
        } else {
            array_push($response, $this->verificacionDePerfil($login, $token)[0]);
        }
        return new JsonResponse($response);

    }

}
