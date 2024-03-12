<?php
/**
 * Fichier de configuration de la base de données
 */
    $_ENV["username"] = "data_user"; // utilisateur de la base de données
    $_ENV["password"] = "datapswd222"; // mot de passe de l'utilisateur de la base de données
    $_ENV["dsn"] = "mysql:host=172.30.0.65;dbname=tableau_bord;port=3306"; // data source name
    $_ENV["options"] = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'') // option pour le driver PDO : UTF8 pour gérer les accents
?>
