-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Фев 10 2019 г., 20:13
-- Версия сервера: 10.1.37-MariaDB-0+deb9u1
-- Версия PHP: 7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fabric`
--

CREATE TABLE `fabric` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `fabric`
--

INSERT INTO `fabric` (`id`, `name`, `description`) VALUES
(1, 'Лен', 'Мягкий. Применяется для подушек.'),
(2, 'Хлопок', 'Мягкий. Применяется для подушек.');

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `header` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `username` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `updated` date NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `productid`, `header`, `comment`, `username`, `date`, `updated`, `deleted`) VALUES
(1, 1, 'Отзыв хороший', 'Какой-то хороший отзыв много текста', 'имя1', '2019-02-04', '0000-00-00', 0),
(2, 1, 'Отзыв нормальный', 'Какой-то отзыв много текста', 'имядругое', '2019-02-03', '0000-00-00', 0),
(3, 2, 'Отзыв нормальный', 'Какой-то отзыв много текстаrtrtrtrt', 'имядругое', '2019-01-01', '2019-02-10', 0),
(5, 1, 'new comment', 'правкаправкаправкаправкаправкаправка', 'user', '2019-02-10', '2019-02-10', 0),
(7, 1, 'rrr', 'ewewwe', 'rrr', '2019-02-10', '2019-02-10', 1),
(8, 2, 'new comment', 'erererer', 'user', '2019-02-10', '2019-02-10', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `filepath` varchar(256) NOT NULL,
  `filesize` int(11) NOT NULL DEFAULT '0',
  `name` varchar(256) NOT NULL DEFAULT 'название картинки',
  `views` int(11) NOT NULL DEFAULT '0',
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `filepath`, `filesize`, `name`, `views`, `description`) VALUES
(1, 'http://localhost/img/product1.jpg', 30213, 'Маленькая подушка', 4, 'Описание маленькой декоративной подушки'),
(3, 'http://localhost/img/product2.jpg', 29602, 'Большая подушка', 3, 'Описание большой подушки'),
(5, 'http://localhost/img/product3.jpg', 15057, 'Прямоугольная подушка', 5, 'Описание прямоугольной подушки'),
(8, 'http://localhost/img/empty.jpg', 0, 'название картинки', 1, 'пустая картинка'),
(10, 'http://localhost/img/bd4bd7efa8a9143cfd709aaa336c1286.jpg', 60890, 'другая картинка', 1, 'другое описание');

-- --------------------------------------------------------

--
-- Структура таблицы `paint`
--

CREATE TABLE `paint` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `paint`
--

INSERT INTO `paint` (`id`, `name`, `description`) VALUES
(1, 'Латексная', 'Не пахнет'),
(2, 'Термотрансферная', 'Дешевая, нужна сушка');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL,
  `imgsmall` varchar(256) NOT NULL,
  `imgbig` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `description` text NOT NULL,
  `size` varchar(16) NOT NULL,
  `fabricid` int(11) NOT NULL,
  `paintid` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `imgsmall`, `imgbig`, `intro`, `description`, `size`, `fabricid`, `paintid`, `views`) VALUES
(1, 'Подушка декоративная большая', 'products/product1/product1.jpg', 'products/product1/small/product1.jpg', 'products/product1/big/product1.jpg', 'Краткое описание Подушки декоративной большой', 'Мягкий лен Lorem ipsum dolor sit amet. Лебяжий пух Lorem ipsum dolor sit amet.', '60х60 см', 1, 1, 55),
(2, 'Подушка декоративная маленькая', 'products/product2/product2.jpg', 'products/product2/small/product2.jpg', 'products/product2/big/product2.jpg', 'Краткое описание Подушки декоративной маленькой', 'Мягкий лен Lorem ipsum dolor sit amet. Лебяжий пух Lorem ipsum dolor sit amet.', '30х30 см', 1, 1, 12),
(3, 'Подушка декоративная прямоугольная', 'products/product3/product3.jpg', 'products/product3/big/product3.jpg', 'products/product3/big/product3.jpg', 'Краткое описание Подушки декоративной прямоугольной', 'Мягкий лен Lorem ipsum dolor sit amet. Лебяжий пух Lorem ipsum dolor sit amet.', '30х90 см', 2, 1, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `fabric`
--
ALTER TABLE `fabric`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`(191)),
  ADD KEY `description` (`description`(191));

--
-- Индексы таблицы `paint`
--
ALTER TABLE `paint`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `fabric`
--
ALTER TABLE `fabric`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `paint`
--
ALTER TABLE `paint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
