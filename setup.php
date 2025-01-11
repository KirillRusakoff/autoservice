<?php
require_once 'config.php';
require_once 'Database.php';

try 
{
    $pdo = new PDO('mysql:host=localhost', 'root', ''); // подключение без указания базы данных
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Создаем базу данных
    $pdo->exec("CREATE DATABASE IF NOT EXISTS autoservice");
    echo "База данных autoservice создана или уже существует.<br>";

    // Теперь подключаемся к базе данных autoservice
    $pdo = new PDO('mysql:host=localhost;dbname=autoservice', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Создание таблицы марок автомобилей
    $pdo->exec("CREATE TABLE IF NOT EXISTS brands (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL
    )");
    echo "Таблица марок автомобилей создана.<br>";

    // Добавление марок автомобилей
    $brands = ['Audi', 'BMW', 'Volvo', 'Lada', 'Mercedes', 'Toyota', 'Ford', 'Chevrolet', 'Nissan', 'Honda'];
    foreach ($brands as $brand) {
        $pdo->prepare("INSERT INTO brands (name) VALUES (?)")->execute([$brand]);
    }
    echo "Марки автомобилей добавлены.<br>";

    // Создание таблицы моделей автомобилей
    $pdo->exec("CREATE TABLE IF NOT EXISTS models (
        id INT AUTO_INCREMENT PRIMARY KEY,
        brand_id INT,
        model_name VARCHAR(100) NOT NULL,
        start_date DATE,
        end_date DATE,
        body_type VARCHAR(50),
        image VARCHAR(255),
        FOREIGN KEY (brand_id) REFERENCES brands(id)
    )");
    echo "Таблица моделей автомобилей создана.<br>";

    // Добавление моделей автомобилей
    $models = [
        [1, 'Audi A6', '1997-01-01', '2016-09-15', 'Sedan', 'audi_a4.jpg'],
        [2, 'BMW X3', '2005-01-01', '2012-12-31', 'SUV', 'bmw_x3.jpg'],
        [3, 'Volvo S60', '2010-01-01', '2020-12-31', 'Sedan', 'volvo_s60.jpg'],
        [4, 'Lada Granta', '2011-01-01', NULL, 'Sedan', 'lada_granta.jpg'],
        [5, 'Mercedes-Benz C-Class', '2007-01-01', '2020-12-31', 'Sedan', 'mercedes_c_class.jpg'],
        [6, 'Toyota Corolla', '2000-01-01', '2001-01-01', 'Sedan', 'toyota_corolla.jpg'],
        [7, 'Ford Focus', '1998-01-01', '2019-12-31', 'Hatchback', 'ford_focus.jpg'],
        [8, 'Chevrolet Camaro', '2012-01-01', NULL, 'Coupe', 'chevrolet_camaro.jpg'],
        [9, 'Nissan Qashqai', '2007-01-01', NULL, 'SUV', 'nissan_qashqai.jpg'],
        [10, 'Honda Civic', '2006-01-01', NULL, 'Sedan', 'honda_civic.jpg']
    ];
    foreach ($models as $model) {
        $pdo->prepare("INSERT INTO models (brand_id, model_name, start_date, end_date, body_type, image) 
                       VALUES (?, ?, ?, ?, ?, ?)")->execute($model);
    }
    echo "Модели автомобилей добавлены.<br>";

    // Создание таблицы стоимости работ
    $pdo->exec("CREATE TABLE IF NOT EXISTS works (
        id INT AUTO_INCREMENT PRIMARY KEY,
        work_name VARCHAR(100) NOT NULL,
        time_hours DECIMAL(5,2),
        price DECIMAL(10,0)
    )");
    echo "Таблица стоимости работ создана.<br>";

    // Добавление стоимости работ
    $works = [
        ['Замена тормозных колодок передних', 0.5, 1200],
        ['Замена масла в двигателе', 1.0, 500],
        ['Замена аккумулятора', 1.5, 1500],
        ['Ремонт подвески', 2.5, 2500],
        ['Замена воздушного фильтра', 0.3, 600],
        ['Диагностика двигателя', 0.5, 1000]
    ];
    foreach ($works as $work) {
        $pdo->prepare("INSERT INTO works (work_name, time_hours, price) VALUES (?, ?, ?)")->execute($work);
    }
    echo "Стоимость работ добавлена.<br>";

} 
catch (PDOException $e) {
    echo "Ошибка при работе с базой данных: " . $e->getMessage();
}