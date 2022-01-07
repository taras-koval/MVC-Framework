<?php

use App\Core\App;

class Version1
{
    public function up()
    {
        $db = App::$database;
        $sql = <<<SQL
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                status TINYINT DEFAULT 1 NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        SQL;
        $db->pdo->exec($sql);
    }
    
    public function down()
    {
        $db = App::$database;
        $sql = <<<SQL
            DROP TABLE users;
        SQL;
        $db->pdo->exec($sql);
    }
}