<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation du debugger XDEBUG pour PHP</title>
</head>
<body>
<?php
ob_start(); // Début de la bufférisation de la sortie
phpinfo(); // Envoyer les informations de configuration dans le buffer de sortie
$contenu= ob_get_clean();
if(str_contains($contenu, "Support Xdebug on Patreon"))
    {
       // Pas besoin d'installer XDEBUG
       $contenu= "Xdebug est déja installé<br>Vérifiez sa version après le composant 'tokenizer' \n<hr>" . $contenu;
       echo $contenu;
    }
    else
    {
        ?>
        <h1>Il faut installer la DLL XDEBUG et configurer votre système</h1>
        <a href="https://kodementor.com/configure-xdebug-xampp-and-vscode-in-windows/" target="_blank">Suivre les conseils ici sur https://kodementor.com/</a><br>
        <br>
        Copier/coller les informations de "phpinfo" (voir ci-dessous) dans le "textarea" de <a href="https://xdebug.org/wizard" target="_blank">https://xdebug.org/wizard</a> puis choisir et downloader la DLL conseillée<br>
        Renommer puis copie la dll dans le dossier 'C:\xampp\php\ext\php_xdebug.dll'<br>
            <h2>Exemple de configuration à ajouter dans C:\xampp\php\php.ini</h2>
        <code>
[Xdebug 2]
zend_extension = "C:\xampp\php\ext\php_xdebug.dll"
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.client_port=9003
xdebug.client_host = localhost 
        </code>
        <h2>Exemple de configuration à copier dans C:\xampp\htdocs\.....\monappli\.vscode\launch.json</h2>
        Cette configuration sera activée uniquement dans le répertoire .....\monappli\<br>
        <code>
        {
    // Utilisez IntelliSense pour en savoir plus sur les attributs possibles.
    // Pointez pour afficher la description des attributs existants.
    // Pour plus d'informations, visitez : https://go.microsoft.com/fwlink/?linkid=830387
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003
        },
        {
            "name": "Launch currently open script",
            "type": "php",
            "request": "launch",
            "program": "${file}",
            "cwd": "${fileDirname}",
            "port": 0,
            "runtimeArgs": [
                "-dxdebug.start_with_request=yes"
            ],
            "env": {
                "XDEBUG_MODE": "debug,develop",
                "XDEBUG_CONFIG": "client_port=${port}"
            }
        },
        {
            "name": "Launch Built-in web server",
            "type": "php",
            "request": "launch",
            "runtimeArgs": [
                "-dxdebug.mode=debug",
                "-dxdebug.start_with_request=yes",
                "-S",
                "localhost:0"
            ],
            "program": "",
            "cwd": "${workspaceRoot}",
            "port": 9003,
            "serverReadyAction": {
                "pattern": "Development Server \\(http://localhost:([0-9]+)\\) started",
                "uriFormat": "http://localhost:%s",
                "action": "openExternally"
            }
        }
    ]
}   
        </code>
        <hr>
        <?php
        echo $contenu;
    }
?>
</body>
</html>
