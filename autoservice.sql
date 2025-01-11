-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 11 2025 г., 12:48
-- Версия сервера: 5.7.39-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autoservice`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Audi'),
(2, 'BMW'),
(3, 'Volvo'),
(4, 'Lada'),
(5, 'Mercedes'),
(6, 'Toyota'),
(7, 'Ford'),
(8, 'Chevrolet'),
(9, 'Nissan'),
(10, 'Honda');

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `model_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `body_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `models`
--

INSERT INTO `models` (`id`, `brand_id`, `model_name`, `start_date`, `end_date`, `body_type`, `image`) VALUES
(1, 1, 'Audi A6', '1997-01-01', '2016-09-15', 'Sedan', 'audi_a4.jpg'),
(2, 2, 'BMW X3', '2005-01-01', '2012-12-31', 'SUV', 'bmw_x3.jpg'),
(3, 3, 'Volvo S60', '2010-01-01', '2020-12-31', 'Sedan', 'volvo_s60.jpg'),
(4, 4, 'Lada Granta', '2011-01-01', NULL, 'Sedan', 'lada_granta.jpg'),
(5, 5, 'Mercedes-Benz C-Class', '2007-01-01', '2020-12-31', 'Sedan', 'mercedes_c_class.jpg'),
(6, 6, 'Toyota Corolla', '2000-01-01', '2001-01-01', 'Sedan', 'toyota_corolla.jpg'),
(7, 7, 'Ford Focus', '1998-01-01', '2019-12-31', 'Hatchback', 'ford_focus.jpg'),
(8, 8, 'Chevrolet Camaro', '2012-01-01', NULL, 'Coupe', 'chevrolet_camaro.jpg'),
(9, 9, 'Nissan Qashqai', '2007-01-01', NULL, 'SUV', 'nissan_qashqai.jpg'),
(10, 10, 'Honda Civic', '2006-01-01', NULL, 'Sedan', 'honda_civic.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL,
  `work_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_hours` decimal(5,2) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `work_name`, `time_hours`, `price`) VALUES
(1, 'Замена тормозных колодок передних', '0.50', '1200'),
(2, 'Замена масла в двигателе', '1.00', '500'),
(3, 'Замена аккумулятора', '1.50', '1500'),
(4, 'Ремонт подвески', '2.50', '2500'),
(5, 'Замена воздушного фильтра', '0.30', '600'),
(6, 'Диагностика двигателя', '0.50', '1000');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Индексы таблицы `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
