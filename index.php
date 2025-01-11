<?php
require_once 'config.php';
require_once 'Database.php';

// Создаем объект базы данных с параметрами из config.php
$db = new Database($host, $dbname, $user, $password);

// Запрос 1: Автомобили, снятые с производства
$query1 = "SELECT brands.name AS brand, models.model_name AS model, models.end_date AS end_date 
           FROM models 
           JOIN brands ON models.brand_id = brands.id 
           WHERE models.end_date IS NOT NULL AND models.end_date < '2018-09-01'";
$carsStoppedProduction = $db->query($query1);

// Запрос 2: Актуальные автомобили и работы стоимостью выше 1000 рублей
$query2 = "SELECT brands.name AS brand, models.model_name AS model, works.work_name AS work, works.price AS price 
           FROM models 
           JOIN brands ON models.brand_id = brands.id 
           CROSS JOIN works 
           WHERE (models.end_date IS NULL OR models.end_date > NOW()) 
             AND works.price > 1000";
$currentCarsAndWorks = $db->query($query2);

// Сортировка по типам кузова
$query3 = "SELECT models.body_type AS body_type, brands.name AS brand, models.model_name AS model 
           FROM models 
           JOIN brands ON models.brand_id = brands.id 
           ORDER BY models.body_type";
$carsSortedByBodyType = $db->query($query3);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автосервис</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Список автомобилей, снятых с производства на сентябрь 2018 года</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Марка</th>
            <th>Модель</th>
            <th>Дата снятия с производства</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($carsStoppedProduction as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car['brand']) ?></td>
                <td><?= htmlspecialchars($car['model']) ?></td>
                <td><?= htmlspecialchars($car['end_date']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Список актуальных автомобилей и работ (стоимость выше 1000 рублей)</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Марка</th>
            <th>Модель</th>
            <th>Работа</th>
            <th>Стоимость</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($currentCarsAndWorks as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['brand']) ?></td>
                <td><?= htmlspecialchars($item['model']) ?></td>
                <td><?= htmlspecialchars($item['work']) ?></td>
                <td><?= htmlspecialchars($item['price']) ?> ₽</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Список автомобилей, отсортированных по типам кузова</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Тип кузова</th>
            <th>Марка</th>
            <th>Модель</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($carsSortedByBodyType as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car['body_type']) ?></td>
                <td><?= htmlspecialchars($car['brand']) ?></td>
                <td><?= htmlspecialchars($car['model']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
