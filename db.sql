--
-- Скрипт сгенерирован Devart dbForge Studio 2019 for MySQL, Версия 8.2.23.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 01.03.2020 18:26:52
-- Версия сервера: 5.7.25
-- Версия клиента: 4.1
--

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

--
-- Установка базы данных по умолчанию
--
USE lab4;

--
-- Удалить таблицу `car_brands`
--
DROP TABLE IF EXISTS car_brands;

--
-- Удалить таблицу `car_brand_models`
--
DROP TABLE IF EXISTS car_brand_models;

--
-- Установка базы данных по умолчанию
--
USE lab4;

--
-- Создать таблицу `car_brand_models`
--
CREATE TABLE car_brand_models (
  id int(11) NOT NULL AUTO_INCREMENT,
  car_brand_id int(11) NOT NULL,
  name varchar(50) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 5,
AVG_ROW_LENGTH = 4096,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

--
-- Создать таблицу `car_brands`
--
CREATE TABLE car_brands (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 13,
AVG_ROW_LENGTH = 1365,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_unicode_ci;

-- 
-- Вывод данных для таблицы car_brand_models
--
INSERT INTO car_brand_models VALUES
(1, 1, 'M3'),
(2, 2, 'Astra'),
(3, 1, 'M5'),
(4, 3, 'Sunny');

-- 
-- Вывод данных для таблицы car_brands
--
INSERT INTO car_brands VALUES
(1, 'BMW'),
(2, 'OPEL'),
(3, 'Nissan'),
(4, 'Audi'),
(5, 'Lada'),
(6, 'Kia'),
(7, 'Ford'),
(8, 'Honda'),
(9, 'Mazda'),
(10, 'Toyota'),
(11, 'DAF'),
(12, 'Volvo');

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;