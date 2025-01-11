<?php

class Database
{
    private $pdo;

    // Конструктор класса, подключение к базе данных
    public function __construct($host, $dbName, $user, $password)
    {
        $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8";
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Метод для выполнения SQL-запросов
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Метод для выполнения SQL-запросов без получения результатов
    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}