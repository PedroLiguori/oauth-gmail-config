<?php
require_once 'vendor/autoload.php';
$client = new Google_Client();
$client->setClientId('SEU_CLIENT_ID');
$client->setClientSecret('SEU_CLIENT_SECRET');
$client->setRedirectUri('SUA_URL_DE_REDIRECIONAMENTO');
$client->addScope(Google_Service_Gmail::GMAIL_SEND);

// Fluxo de autorização
if (!isset($_GET['code'])) {
    $authUrl = $client->createAuthUrl();
    header("Location: " . $authUrl);
    exit();
} else {
    $client->authenticate($_GET['code']);
    $accessToken = $client->getAccessToken();
    
    // Não esquecer de armazenar o $accessToken de forma segura
}
?>