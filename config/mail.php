<?php
return [
    "server" => [
        "protocol"  => "smtp",
        "security"  => "tls",
        "host"      => "smtp.gmail.com",
        "port"      => 587,
        "username"  => "2daw.equip01@fp.insjoaquimmir.cat",
        "password"  => "tarda1234",
        # See https://github.com/PHPMailer/PHPMailer/wiki/SMTP-Debugging
        "debug"     => [
            // OFF (0), CLIENT (1), SERVER (2), CONNECTION (3), LOWLEVEL (4)
            "level"     => 0,
            // "echo" (default), "html", "error_log2
            "output"    => "error_log"  
        ]
    ],
    "from" => [
        "name"      => "Marc",
        "mail"      => "2daw.equip01@fp.insjoaquimmir.cat"
    ],
    "reply" => [
        "name"      => "Tusa",
        "mail"      => "2daw.equip01@fp.insjoaquimmir.cat"
    ]
];