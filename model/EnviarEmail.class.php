<?php
 

class EnviarEmail extends PHPMailer\PHPMailer\PHPMailer {
    /**
   * inicializa a classe com os dados iniciais
   * @return void
   */
    
    function __construct() {
     
        parent::__construct();
        parent::IsSMTP();
	//smtp.dominio.com.br //seu servidor smtp
        $this->Host = Config::EMAIL_SMTP; 
        //define se tem ou autenticação no SMTP
        $this->SMTPAuth = Config::EMAIL_SMTPAUTH; 
        $this->Username = Config::EMAIL_USER;
        $this->Password = Config::EMAIL_PASS;
        $this->SMTPSecure = '';
        $this->Port = Config::EMAIL_PORT; 
        $this->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
        // codificação charset padrao UTF8
        $this->CharSet = 'UTF-8';
        // modo debug 0=off 1 e 2=mostram informações do envio ou erros
        //$this->SMTPDebug = 0;
        //Indica a porta do seu servidor
        $this->setFrom(Config::EMAIL_USER, Config::EMAIL_NAME);
        parent::IsHTML(true);        
        // define dados do remetendo EMAIL, SENHA  da conta SMTP
        //$this->FromName    = Config::EMAIL_NAME;
        $this->From = Config::EMAIL_USER;
        
    }

    function Enviar($assunto, $msg, $destinatario, $destinatariosOculto=array()) {
        //seto dados da mensagem
        $this->Subject = $assunto;
        $this->Body = $msg;
        $this->AddAddress($destinatario);
        foreach($destinatariosOculto as $email):
            $this->addBCC($email); //PARA MIM
        endforeach;
	  
        //enviando o email 
        if (parent::Send()):
            $this->ClearAllRecipients();
        else:
            echo "<h4>Mailer Error: " . $this->ErrorInfo . "</h4>";
        endif;
    }
    
    
    function parametrosPadroesTemplate($tituloEmail) {
        if($tituloEmail){
            $dadosAdmin = new DadosAdmin();
            return array(
                'TITULO'=> $tituloEmail,
                'URL_SITE'=> Config::SITE_URL,
                'URL_LOGO'=> Rotas::get_UrlImages().'/logo-email.png',
                'URL_SOBRE'=> Rotas::pagina_Sobre(),
                'URL_CONTATO'=> Rotas::pagina_Contato(),
                'URL_FACEBOOK'=> Rotas::pagina_Facebook(),
                'URL_IMG_FACEBOOK'=> Rotas::get_UrlImages().'/facebook-email.png',
                'URL_INSTAGRAM'=> Rotas::pagina_Instagram(),
                'URL_IMG_INSTAGRAM'=> Rotas::get_UrlImages().'/instagram-email.png',
                'NOME_LOJA'=> Config::SITE_NOME,
                'ENDERECO'=> $dadosAdmin->getConfigAdmin('logradouro'),
                'MUNICIPIO'=> $dadosAdmin->getConfigAdmin('cidade'),
                'UF'=> $dadosAdmin->getConfigAdmin('uf'),
                'CEP'=> $dadosAdmin->getConfigAdmin('cep'),
                'SITE'=> $dadosAdmin->getConfigAdmin('siteLoja'),
                'ANO'=> date('Y')
            );
        } else {
            return 'informe o titulo do corpo do e-mail';
            exit();
        }
        
    }
 
    
}
