<?php
require_once 'vendor/autoload.php';
require_once 'email_sender.php';
require_once 'config.php';

class ContactFormHandler {
    private $emailSender;
    private $config;

    public function __construct() {
        $this->config = require 'config.php';
        $this->emailSender = new PointCMemailsender();
    }

    //criei fake depois vc edita com os campos que existem no form real

    public function handleSubmission($dadosFormulario) {
        try {
            $resultado = $this->emailSender->enviaremailcontato(
                $dadosFormulario['nome'],
                $dadosFormulario['email'],
                $dadosFormulario['telefone'],
                $dadosFormulario['mensagem']
            );

            if ($resultado) {
                return [
                    'status' => 'sucesso',
                    'mensagem' => 'Formulário enviado com sucesso'
                ];
            } else {
                return [
                    'status' => 'erro',
                    'mensagem' => 'Falha no envio do formulário'
                ];
            }
        } catch (Exception $e) {
            error_log('Erro no processamento do formulário: ' . $e->getMessage());
            return [
                'status' => 'erro',
                'mensagem' => 'Erro interno no processamento do formulário'
            ];
        }
    }
}
      //criei fake depois vc edita com os campos que existem no form real
 
// Processa o formulário enviado via POST e retorna a resposta em JSON.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $handler = new ContactFormHandler();
    $resultado = $handler->handleSubmission($_POST);
    
    echo json_encode($resultado);
    exit();
}
?>