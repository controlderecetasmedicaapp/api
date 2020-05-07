<?php


namespace App\Services;


class Correo
{
    public function enviarEmail($email, $nombre, $apellido, $mailer, $config, $password, $rut, $contenido)
    {
        $mensaje = (new \Swift_Message())
            ->setSubject('Control de recetas médicas')
            ->setFrom($config->configEmail()['emailFrom'], 'Control de recetas médicas')
            ->setTo($email, $nombre . ' ' . $apellido)
            ->addPart($this->estructuraEmail($contenido, $nombre, $apellido, $password, $rut), 'text/html');
        $mailer->send($mensaje);
    }


    public function estructuraEmail($contenido, $nombre, $apellido, $password, $rut)
    {
        $email = '
        
        <style type="text/css">body{background-color:#eeeeee;}</style>

<table align="center" width="600" style="background-color: #fff;">
	<tbody>
		<tr height="90">
			<td width="150"></td>
			<td width="300" align="center"><img src="https://lh3.googleusercontent.com/Xxbit21ZMnEYjLCXLMNTo-ivEpufwuzKDwgGj3udNEVWPmDMpsP68zqAmuxb_meB8iw5e6r4CxS_sw=w1920-h945" class="logo - mail" alt="User Icon"/></td>
			<td width="150"></td>
		</tr>
		<tr height="290">
			<td width="10"></td>
			<td width="580" align="left">
			    ' . $this->contenido($contenido, $nombre, $apellido, $password, $rut) . '
			</td>
			<td width="10"></td>
		</tr>
	</tbody>
</table>

<table align="center">
	<tbody>

		<tr style="background-color:#eeeeee;">
			<td width="600" align="center">
				<p style="line-height: 20px; font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 11px; color: #848484;">(nombre de la app) | Control de recetas médicas </br> Oscar Leiva Lopez - Jonathan Leiva Gómez 2019 - 2020 ©️ <footer></p>
			</td>
		</tr>
	</tbody>
</table>
        
        ';
        return $email;
    }

    public function contenido($contenido, $nombre, $apellido, $password, $rut)
    {
        if ($contenido === 1) {
            $contenido = ' 
            <h3 style="font - family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 17px;">¡Hola ' . $nombre . ' ' . $apellido . '!</h3>
				<p style="line-height: 22px; font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 13px;"> Bienvenido nuestra plataforma <a href="">Link de la pagina</a> , desde ahora podrás visualizar tus recetas médicas de forma rápida.</p>

				<p style="line-height: 22px; font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 13px;"> Para ingresar se te asigno un usuario y contraseña. </br>Tus credenciales son:</p>

				<p style=" font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 14px; font-weight: bold; margin-bottom: 5px;">Usuario: ' . $rut . '</p>
				<p style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 14px; font-weight: bold; margin-top: 5px;">Contraseña:' . $password . '</p>
            
            ';
        }


        if ($contenido === 2) {
            $contenido = ' 
            <h3 style="font - family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 17px;">¡Hola ' . $nombre . ' ' . $apellido . '!</h3>
			<p style="line-height: 22px; font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 13px;"> Bienvenido nuestra plataforma <a href="">Link de la pagina</a> , desde ahora podrás visualizar tus recetas médicas de forma rápida.</p>
			<p>Con tus credenciales podrás acceder a sus recetas</p>
            ';
        }


        return $contenido;
    }
}
