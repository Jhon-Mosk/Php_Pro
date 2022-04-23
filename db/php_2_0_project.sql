-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 04 2022 г., 01:39
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php_2.0_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `login` varchar(60) NOT NULL,
  `price` varchar(255) NOT NULL,
  `uniqId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `session_id`, `login`, `price`, `uniqId`) VALUES
(176, 25, 'js5rlolna5fc4be56g3fg1drknn8hfkt', 'anonymous', '865', '1325081646249cd19b34d70.60883620'),
(177, 25, '441f551ili2qfn2501nud4h60a9c2b43', 'anonymous', '865', '19209162886249d68df31b22.23875877'),
(178, 25, 'fifavbpvvf27celsifocor474u0skln7', 'anonymous', '865', '19480547866249e163148ec0.63234572'),
(179, 25, 'ga7506csajt2fflta9gdd1b5mqerc29b', 'anonymous', '865', '3626839826249e17b390c52.90598878'),
(180, 25, 'uplvt028j05iqjppr6qdrpj593k89vsd', 'anonymous', '865', '11747480536249e1d6b7c384.82206365'),
(185, 25, '4hddr819is7o8ddgeo3req7ohdrkdprj', 'admin', '865', '11845565216249e37cab50d8.48194348'),
(186, 25, '4hddr819is7o8ddgeo3req7ohdrkdprj', 'admin', '865', '10074727526249e37ce8ef21.34752022'),
(187, 25, '4hddr819is7o8ddgeo3req7ohdrkdprj', 'admin', '865', '1207737546249e37d243ad1.34688091'),
(188, 25, '4hddr819is7o8ddgeo3req7ohdrkdprj', 'admin', '865', '3127058156249e37d5b1a03.21786948'),
(189, 25, '4hddr819is7o8ddgeo3req7ohdrkdprj', 'admin', '865', '1258194356249e37d81e902.24084228'),
(192, 25, 'v08sp56q7muffu90g9u2jioad0v0r330', 'admin', '865', '7092286136249e5694f36d5.95793824'),
(193, 25, 'v08sp56q7muffu90g9u2jioad0v0r330', 'admin', '865', '3593310006249e569779ee3.00153416'),
(194, 25, 'v08sp56q7muffu90g9u2jioad0v0r330', 'admin', '865', '14727529326249e569b25e85.99377387');

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_product` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `feedback`, `id_product`) VALUES
(5, 'fs', '87696', 25),
(12, 'sfsdf', 'rqerqwe', 26),
(20, '324', 'erwr', 25);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(20) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `login`, `phone`, `session_id`, `date`, `status`) VALUES
(8, 'anonymous', 'sd', 'ga7506csajt2fflta9gdd1b5mqerc29b', '2022-04-03 21:05:09', 'await'),
(9, 'anonymous', 's', 'uplvt028j05iqjppr6qdrpj593k89vsd', '2022-04-03 21:05:14', 'finish'),
(10, 'admin', '143124', 'tomkhccapug3ri6ounjt0j17hqnlv3op', '2022-04-03 21:05:43', 'await'),
(11, 'admin', '234234', 'v08sp56q7muffu90g9u2jioad0v0r330', '2022-04-03 21:22:33', 'delete');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `actualPrice` varchar(255) NOT NULL,
  `oldPrice` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `corner` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `actualPrice`, `oldPrice`, `address`, `description`, `corner`, `category`) VALUES
(25, 'Single Thruster 2014', '865.00', '0', '/img/surfhouse/products/surf1.jpg', 'Single Thruster 2014', 'productUnitNew', 'New products'),
(26, 'Freestyle Wave FSW', '770.50', '1,270.15', '/img/surfhouse/products/surf2.jpg', 'Freestyle Wave FSW', 'productUnitHot', 'New products'),
(27, 'The White Collection\n                SURFBOARD 2014', '1,580.70', '0', '/img/surfhouse/products/surf3.jpg', 'The White Collection\n                SURFBOARD 2014', '', 'New products'),
(28, 'OG SCALLOP SOLID', '765.00', '0', '/img/surfhouse/products/surf4.jpg', 'OG SCALLOP SOLID', '', 'New products'),
(29, 'STRIPE 19 QS', '230.50', '0', '/img/surfhouse/products/surf5.jpg', 'STRIPE 19 QS', '', 'New products'),
(30, 'YOKE 19 QS', '1,130.70', '0', '/img/surfhouse/products/surf6.jpg', 'YOKE 19 QS', '', 'New products'),
(31, 'Ushingham\n                Lightning 2014', '2,960.95', '3,100.15', '/img/surfhouse/products/springsuit1.jpg', 'Ushingham\n                Lightning 2014', '', 'top Products'),
(32, 'CYPHER HEAT VES M', '849.95', '0', '/img/surfhouse/products/springsuit2.jpg', 'CYPHER HEAT VES M', '', 'top Products'),
(33, 'SYNCRO WOMENS\n                QS M', '1,110.99', '0', '/img/surfhouse/products/springsuit3.jpg', 'SYNCRO WOMENS\n                QS M', '', 'top Products'),
(34, 'SYNCRO MENS QS M', '249.95', '450.15', '/img/surfhouse/products/rashguard.jpg', 'SYNCRO MENS QS M', '', 'sale Products'),
(35, 'RAMOS - SHIRT FOR MEN', '459.65', '570.65', '/img/surfhouse/products/springsuit2.jpg', 'RAMOS - SHIRT FOR MEN', '', 'sale Products'),
(36, 'SixSixOne Evo Wired Full Face', '240.00', '370.65', '/img/surfhouse/products/springsuit3.jpg', 'SixSixOne Evo Wired Full Face', '', 'sale Products'),
(37, 'Single Thruster 2014', '865.00', '0', '/img/surfhouse/products/surf1.jpg', 'Single Thruster 2014', 'productUnitNew', 'New products'),
(38, 'Freestyle Wave FSW', '770.50', '1,270.15', '/img/surfhouse/products/surf2.jpg', 'Freestyle Wave FSW', 'productUnitHot', 'New products'),
(39, 'The White Collection\n                SURFBOARD 2014', '1,580.70', '0', '/img/surfhouse/products/surf3.jpg', 'The White Collection\n                SURFBOARD 2014', '', 'New products'),
(40, 'OG SCALLOP SOLID', '765.00', '0', '/img/surfhouse/products/surf4.jpg', 'OG SCALLOP SOLID', '', 'New products'),
(41, 'STRIPE 19 QS', '230.50', '0', '/img/surfhouse/products/surf5.jpg', 'STRIPE 19 QS', '', 'New products'),
(42, 'YOKE 19 QS', '1,130.70', '0', '/img/surfhouse/products/surf6.jpg', 'YOKE 19 QS', '', 'New products'),
(43, 'Ushingham\n                Lightning 2014', '2,960.95', '3,100.15', '/img/surfhouse/products/springsuit1.jpg', 'Ushingham\n                Lightning 2014', '', 'top Products'),
(44, 'CYPHER HEAT VES M', '849.95', '0', '/img/surfhouse/products/springsuit2.jpg', 'CYPHER HEAT VES M', '', 'top Products'),
(45, 'SYNCRO WOMENS\n                QS M', '1,110.99', '0', '/img/surfhouse/products/springsuit3.jpg', 'SYNCRO WOMENS\n                QS M', '', 'top Products'),
(46, 'SYNCRO MENS QS M', '249.95', '450.15', '/img/surfhouse/products/rashguard.jpg', 'SYNCRO MENS QS M', '', 'sale Products'),
(47, 'RAMOS - SHIRT FOR MEN', '459.65', '570.65', '/img/surfhouse/products/springsuit2.jpg', 'RAMOS - SHIRT FOR MEN', '', 'sale Products'),
(48, 'SixSixOne Evo Wired Full Face', '240.00', '370.65', '/img/surfhouse/products/springsuit3.jpg', 'SixSixOne Evo Wired Full Face', '', 'sale Products');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `role` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`, `role`) VALUES
(2, 'user', '$2y$10$oqTxCcd.qLon0DjqWA62JOrT6mjiDaNFO.VDmy1XBxLhgeZ5jZ1G.', '1876434325620cd4fd7cd5a9.50535768', 0),
(8, 'admin', '$2y$10$zg9Cb/so9sLwUGxrUZSuOe1rP/9A.cbo496z3ipTxfJU5gyRXHTAm', '289408464623b7e62403ac4.63933666', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
