<?

include("phpmailer/class.phpmailer.php");
//instancia a objetos
$mail = new PHPMailer();
// mandar via SMTP
$mail->IsSMTP(); 
// Seu servidor smtp
$mail->Host = "smtp.safrajaboticabal.com.br"; 
// habilita smtp autenticado
$mail->SMTPAuth = true; 
// usuário deste servidor smtp
$mail->Username = "vendas@safrajaboticabal.com.br"; 
$mail->Password = "*safrajbt*"; // senha
//email utilizado para o envio 
//pode ser o mesmo de username
$mail->From = "vendas@safrajaboticabal.com.br";
$mail->FromName = "Tiago";

//Enderecos que devem ser enviadas as mensagens
$mail->AddAddress("vendas@safrajaboticabal.com.br","Tiago");
$mail->AddAddress("rca_vendas@hotmail.com","Tiago");
//wrap seta o tamanhdo do texto por linha
$mail->WordWrap = 50; 
//anexando arquivos no email
$mail->AddAttachment("anexo/arquivo.zip"); 
$mail->AddAttachment("imagem/foto.jpg");
$mail->IsHTML(true); //enviar em HTML

// recebendo os dados od formulario
if(isset($_POST['nome'])){
	$nome     = ucwords($_POST['nome']);
	$email 	  = $_POST['email'];
	$mensagem   = $_POST['mensagem'];
    // informando a quem devemos responder 
	//ou seja para o mail inserido no formulario
	$mail->AddReplyTo("$email","$nome");
	//criando o codigo html para enviar no email
	//vocepode utilizar qualquer tag html ok
	$msg  = "";
	$msg .= " Nome: $nome<br>\n";
	$msg .= " E-mail: $email<br>\n";
	$msg .= " Mensagem: $mensagem<br>\n";
 }
 
 
$mail->Subject = "Contato do site Safra Jaboticabal";
//adicionando o html no corpo do email
$mail->Body = $msg;
//enviando e retornando o status de envio
if(!$mail->Send())
{
echo "<P>houve um erro ao  enviar o email! </P>".$mail->ErrorInfo;
//$mail->ErrorInfo informa onde ocorreu o erro 
exit;
}

echo "<script>window.location='index.html';alert('$nome, sua mensagem foi enviada com sucesso! Estaremos retornando em breve');</script>";
?>
