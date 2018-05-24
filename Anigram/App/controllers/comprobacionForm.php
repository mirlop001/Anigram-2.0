<?php 
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'includes/PHPMailer-master/src/Exception.php';
    require 'includes/PHPMailer-master/src/PHPMailer.php';
    require 'includes/PHPMailer-master/src/SMTP.php';
    require_once "usuario_controller.php";  
    require_once "../models/usuario_model.php"; 
    
    $usuario_controller = new es\ucm\fdi\aw\Usuario_Controller();
    $result = false;

    $email = htmlspecialchars(trim(strip_tags($_POST['UserMail'])));
    
    if($_POST['comprobacion'] == 'registro'){
        $result = ($usuario_controller->getUserByEmail($_POST['UserMail']) == 0);
        
    }else if($_POST['comprobacion'] == 'email_olvido'){
        $email = htmlspecialchars(trim(strip_tags($_POST['UserMail'])));
        $result = ($usuario_controller->getUserByEmail($_POST['UserMail']) == 0);

       //Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                  
       
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "equipoanigram@gmail.com";
        //Password to use for SMTP authentication
        $mail->Password = "estoesanigram";
        //Set who the message is to be sent from
        $mail->setFrom('equipoanigram@gmail.com', 'First Last');
        //Set an alternative reply-to address
        $mail->addReplyTo('miriambleble@gmail.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress('lopezsierramiriam@gmail.com', 'John Doe');
        //Set the subject line
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
        }
    }else{
        $clave = htmlspecialchars(trim(strip_tags($_POST['Password'])));
        $usuario = $usuario_controller->getDatosLogin( $email);
        if($usuario){
            if($result = password_verify($clave, $usuario['Clave'])){
                $_SESSION['LoginSuccess'] = true;
                $_SESSION['UserID'] = $usuario['ID'];
                $_SESSION['Nombre'] = $usuario['Nombre'];
                $_SESSION['RolUsuario'] = $usuario['Rol'];
                  
            }
        }
    }   
    echo $result;
?>