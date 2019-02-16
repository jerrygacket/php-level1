-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Фев 16 2019 г., 18:55
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
(8, 2, 'new comment', 'erererer', 'user', '2019-02-10', '2019-02-10', 0),
(9, 1, '444444', '54454544', 'gffgfgfg', '2019-02-12', '2019-02-12', 0);

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
(1, 'img/product1.jpg', 30213, 'Маленькая подушка', 5, 'Описание маленькой декоративной подушки'),
(3, 'img/product2.jpg', 29602, 'Большая подушка', 11, 'Описание большой подушки'),
(5, 'img/product3.jpg', 15057, 'Прямоугольная подушка', 10, 'Описание прямоугольной подушки'),
(8, 'img/empty.jpg', 0, 'название картинки', 1, 'пустая картинка'),
(10, 'img/bd4bd7efa8a9143cfd709aaa336c1286.jpg', 60890, 'другая картинка', 2, 'другое описание');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `product_price` decimal(20,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `product_id`, `product_count`, `product_price`, `user_id`, `comment`, `order_date`, `status`) VALUES
(1, '0', 1, 2, '3', 1, 'fgdfg gdfgd fgdfg', '2019-02-16', 'отменен'),
(16, '1550320437', 0, 0, '0', 34, '', '2019-02-16', 'отменен'),
(17, '1550320726', 0, 0, '0', 34, '', '2019-02-16', 'новый');

-- --------------------------------------------------------

--
-- Структура таблицы `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `order_products`
--

INSERT INTO `order_products` (`id`, `order_number`, `product_id`, `product_count`, `product_price`) VALUES
(1, '1550320726', 1, 1, 100),
(2, '1550320726', 2, 5, 75),
(3, '1550320437', 2, 5, 75);

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
  `views` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,0) NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `imgsmall`, `imgbig`, `intro`, `description`, `size`, `fabricid`, `paintid`, `views`, `price`, `status`) VALUES
(1, 'Подушка декоративная большая', 'products/product1/product1.jpg', 'products/product1/small/product1.jpg', 'products/product1/big/product1.jpg', 'Краткое описание Подушки декоративной большой', 'Мягкий лен Lorem ipsum dolor sit amet. Лебяжий пух Lorem ipsum dolor sit amet.', '60х60 см', 1, 1, 71, '100', 'удален'),
(2, 'Подушка декоративная маленькая', 'products/product2/product2.jpg', 'products/product2/small/product2.jpg', 'products/product2/big/product2.jpg', 'Краткое описание Подушки декоративной маленькой', 'Мягкий лен Lorem ipsum dolor sit amet. Лебяжий пух Lorem ipsum dolor sit amet.', '30х30 см', 1, 1, 18, '54', ''),
(3, 'Подушка декоративная прямоугольная', 'products/product3/product3.jpg', 'products/product3/small/product3.jpg', 'products/product3/big/product3.jpg', 'Краткое описание Подушки декоративной прямоугольной', 'Мягкий лен Lorem ipsum dolor sit amet. Лебяжий пух Lorem ipsum dolor sit amet.', '30х90 см', 2, 1, 3, '75', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_users`
--

CREATE TABLE `shop_users` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_login` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `last_login` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `shop_users`
--

INSERT INTO `shop_users` (`id_user`, `user_name`, `user_login`, `user_password`, `last_login`) VALUES
(1, 'admin', 'admin', '$2a$08$ZDYxOGU5ODA0YTk3M2Y1YugWWmWSZ0TTigwlFqe7TePdk6KanN5WS', '0000-00-00'),
(34, 'user1', 'user@xz.xz3', '$2a$08$YjljZmMyMWY0NTNjODA0YeEj94.mNFhGP2tyXNMUk8K46gfjW8jtu', '0000-00-00');

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
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `shop_users`
--
ALTER TABLE `shop_users`
  ADD PRIMARY KEY (`id_user`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
--
-- AUTO_INCREMENT для таблицы `shop_users`
--
ALTER TABLE `shop_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
