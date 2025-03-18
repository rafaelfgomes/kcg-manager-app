<?php

function env(string $envName): ?string
{
    return getenv($envName);
}

function rootPath(): string
{
    return dirname(__DIR__);   
}

function getHtmlTemplate(?string $message = ''): string {
    $text =  $message ?: 'KCG App';

    return "<!DOCTYPE html>
    <html lang=\"pt-br\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Backend</title>
        </head>
        <body>
            <h3>$text</h3>
        </body>
    </html>";
}
