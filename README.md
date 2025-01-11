# AutoService Project

## Описание
Этот проект представляет собой систему управления данными автосервиса. Реализованы два задания:
1. Создание базы данных автосервиса с данными о марках и моделях автомобилей, их производстве, стоимости и времени выполнения работ.
2. Вывод данных на веб-страницу с использованием PHP и PDO:
   - Список автомобилей, снятых с производства.
   - Список актуальных автомобилей с работами, стоимость которых превышает 1000 рублей.
   - Список автомобилей, отсортированных по типу кузова.

Проект выполнен без использования фреймворков. Для стилизации используется CSS-фреймворк Bootstrap.

---

## Файлы проекта
- **setup.php**: Скрипт для создания базы данных, таблиц и добавления тестовых данных.
- **index.php**: Основной файл приложения для вывода данных на веб-страницу.
- **Database.php**: Класс для работы с базой данных с использованием PDO.
- **config.php**: Конфигурационный файл с данными для подключения к базе данных.
- **autoservice.sql**: Экспортированная база данных с таблицами.

---

## Структура базы данных
### Таблицы
1. **brands**: Марки автомобилей.
   - `id` (int, PK)
   - `name` (varchar)
2. **models**: Модели автомобилей.
   - `id` (int, PK)
   - `brand_id` (int, FK → brands.id)
   - `model_name` (varchar)
   - `start_date` (date)
   - `end_date` (date, nullable)
   - `body_type` (varchar)
   - `image_url` (varchar)
3. **works**: Работы и их стоимость.
   - `id` (int, PK)
   - `work_name` (varchar)
   - `price` (float)
   - `duration` (float)
