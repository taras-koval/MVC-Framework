<?php

namespace App\Core;

use PDO;

class Database
{
    public PDO $pdo;
    
    public function __construct()
    {
        $config = require ROOT.'/config/database.php';
        
        $this->pdo = new PDO(
            $config['dsn'],
            $config['user'],
            $config['pass'],
            $config['options']
        );
    }
    
    public function findOneBy(array $criteria)
    {
    
    }
    
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
    
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        
        $files = scandir(ROOT.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        
        $newMigrations = [];
        
        foreach ($toApplyMigrations as $migration) {
            
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            
            require_once ROOT.'/migrations/' . $migration;
            
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $instance->up();
            
            $this->log("Applied migration $migration");
            
            $newMigrations[] = $migration;
        }
        
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }
    
    private function createMigrationsTable()
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        SQL;
        $this->pdo->exec($sql);
    }
    
    private function getAppliedMigrations()
    {
        $stmt = $this->pdo->prepare("SELECT migration FROM migrations");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    private function saveMigrations(array $migrations)
    {
        $values = implode(', ', array_map(fn($value) => "('$value')", $migrations));
        
        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $values");
        $stmt->execute();
    }
    
    private function log($message)
    {
        echo '[' . date('Y-m-d H:i') . '] - ' . $message . PHP_EOL;
    }
}