<?php
require_once 'vendor/autoload.php';

class PointCMEmailSender {
    private $client;
    private $destinatarios = ['eventos2@pointcm.com.br', 'point@pointcm.com.br'];

    public function __construct() {
        $this->client = new Google_Client();
        $this->client->setClientId('208532931494-lmgepbpo7d6dusn4k1s0apaokkc1rhia.apps.googleusercontent.com');
        $this->client->setClientSecret('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');
        $this->client->setRedirectUri('https://pointcm.com.br/oauth-callback');
        $this->client->addScope(Google_Service_Gmail::GMAIL_SEND);
    }

    public function enviarEmailContato($nome, $email, $telefone, $mensagem) {
        try {
            $this->autenticarECarregarToken();
            $service = new Google_Service_Gmail($this->client);

            foreach ($this->destinatarios as $destinatario) {
                $corpoEmail = $this->montarCorpoEmail($nome, $email, $telefone, $mensagem);
                $mensagemEmail = $this->criarMensagemEmail($destinatario, 'Novo Contato - Site', $corpoEmail);
                
                $service->users_messages->send('me', $mensagemEmail);
            }

            return true;
        } catch (Exception $e) {
            error_log('Erro no envio de e-mail: ' . $e->getMessage());
            return false;
        }
    }

    private function montarCorpoEmail($nome, $email, $telefone, $mensagem) {
        return "Novo contato via site:\n\n" .
               "Nome: $nome\n" .
               "E-mail: $email\n" .
               "Telefone: $telefone\n\n" .
               "Mensagem:\n$mensagem";
    }

    private function criarMensagemEmail($para, $assunto, $corpo) {
        $message = new Google_Service_Gmail_Message();
        $rawMessage = strtr(base64_encode("To: $para\r\n" .
            "Subject: $assunto\r\n" .
            "Content-Type: text/plain; charset=utf-8\r\n\r\n" .
            $corpo), ['+' => '-', '/' => '_']);
        $message->setRaw($rawMessage);
        return $message;
    }

    private function autenticarECarregarToken() {
        // Lógica para carregar e autenticar o token
        // Implementação específica dependerá de como você armazena o token
    }
}
?>