<?php include('util.php') ?>

<?php 



// Informações recebidas pelo formulário

$email = $_POST['email'];

$cliente = $_POST['cliente'];

$telefone = $_POST['telefone'];

$valorFinanciado = $_POST['valorFinanciado'];

$prazoPagamento = $_POST['prazoPagamento'];

$taxaJurosMensal = $_POST['taxaJurosMensal'];

$prazoCarencia = $_POST['prazoCarencia'];





$tabela = gerarTabelaEmail($valorFinanciado, $prazoPagamento, $taxaJurosMensal, $prazoCarencia);



//Variaveis fixas

$remetente = 'simulacao@luConsultoria.com.br';

$assunto = "Simulação - Consultoria Lu's";

 

$para = $email;



$message = 'Olá '.$email.', <br /><br /> Segue a simulação solicitada no site Consultoria Lu s:<br /><br /><a href="http://www.consultorialus.com"><img src="http://www.velummarketingdigital.com.br/simuladorleandro/img/logo.png" alt="ConsultoriaLogo  Lus"></a><br /><br />'. $tabela;

$headers = 'From: '. $remetente . "\r\n";

$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 

if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Verifica se o e-mail é válido.

	mail($para, $assunto, $message, $headers) or die('Não foi possível enviar o e-mail'); //Método que envia o e-mail

	echo "A simulação foi enviada com sucesso para o e-mail ".$email."!"; ; 

	}else{

	echo "E-mail inválido, digite um e-mail válido.";

}



//Variaveis fixas

$assunto2 = "O " . $email . " fez uma simulação";

 

$para2 = $remetente;



$message2 = 'Olá Lu, o cliente '.$cliente.' fez uma simulação com essa tabela. Entre em contato com ele:<br /><br /> Os dados dele são os email: '.$email.' e telefone '.$telefone.' <br /><br /> '. $tabela;

$headers2 = 'From: '. $remetente . "\r\n";

$headers2 .= "MIME-Version: 1.0\r\n";

$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



mail($para2, $assunto2, $message2, $headers2); //Método que envia o e-mail





?>



