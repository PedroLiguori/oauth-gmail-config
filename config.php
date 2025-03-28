<?php
return [
    'oauth' => [
        'client_id' => '208532931494-lmgepbpo7d6dusn4k1s0apaokkc1rhia.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect_uri' => 'https://pointcm.com.br/oauth-callback',
        'scopes' => [
            Google_Service_Gmail::GMAIL_SEND
        ]
    ],
    'emails' => [
        'destinatarios' => [
            'eventos2@pointcm.com.br',
            'point@pointcm.com.br'
        ]
    ],
    'token_path' => $_SERVER['DOCUMENT_ROOT'] . '/google_oauth_token.json'
];
?>