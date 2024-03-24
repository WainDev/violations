-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 23 2023 г., 10:24
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bnj`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Application`
--

CREATE TABLE `Application` (
  `IdApplication` int NOT NULL,
  `IdUser` int NOT NULL,
  `Number` varchar(30) NOT NULL,
  `Description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `IdCooperator` int NOT NULL,
  `IdStatus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Application`
--

INSERT INTO `Application` (`IdApplication`, `IdUser`, `Number`, `Description`, `IdCooperator`, `IdStatus`) VALUES
(1, 1, 'А322БВ750', 'Разбился насмерть', 1, 2),
(2, 2, 'И228ДА750', 'Дрифтанул на летней резине', 2, 1),
(3, 3, 'О777ОО750', 'Приняли за галоген', 3, 3),
(4, 4, 'В666ОР62', 'Пускает искры днищем', 4, 1),
(5, 5, 'Е322РР750', 'Не приехал', 5, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Cooperator`
--

CREATE TABLE `Cooperator` (
  `IdCooperator` int NOT NULL,
  `FirstNames` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  `Name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `MiddleNames` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Login` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Password` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Cooperator`
--

INSERT INTO `Cooperator` (`IdCooperator`, `FirstNames`, `Name`, `MiddleNames`, `Login`, `Password`) VALUES
(1, 'Иванов ', 'Иван', 'Иванович', 'iii', '111'),
(2, 'Пупкин', 'Егор', 'Астафьевич', 'ppp', '222'),
(3, 'Липтон', 'Борис', 'Моисеевич', 'lll', '333'),
(4, 'Сидоров', 'Степан', 'Евпатьевич', 'sss', '444'),
(5, 'Савок', 'Людмила', 'Валерьевна', 'ccc', '555');

-- --------------------------------------------------------

--
-- Структура таблицы `Status`
--

CREATE TABLE `Status` (
  `IdStatus` int NOT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Status`
--

INSERT INTO `Status` (`IdStatus`, `Status`) VALUES
(1, 'Приемлемо'),
(2, 'Неприемлемо'),
(3, 'Ожидание');

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `IdUser` int NOT NULL,
  `FirstName` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Names` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `MiddleName` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Password` int NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`IdUser`, `FirstName`, `Names`, `MiddleName`, `Password`, `Email`) VALUES
(1, 'Азарян', 'Юрий', 'Александрович', 123, 'yura228@mail.ru'),
(2, 'Иванов ', 'Даниил', 'Антонович', 1234, 'Daniil228@mail.ru'),
(3, 'Кореш', 'Данила', 'Русланович', 12345, 'koresh228@mail.ru'),
(4, 'Мишин', 'Дмитрий', 'Александрович', 123456, 'mishka228@mail.ru'),
(5, 'Черемизов', 'Ярослав', 'Владиславович', 123456, 'yarik228@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Application`
--
ALTER TABLE `Application`
  ADD PRIMARY KEY (`IdApplication`),
  ADD UNIQUE KEY `IdUser` (`IdUser`),
  ADD KEY `IdCooperator` (`IdCooperator`),
  ADD KEY `IdStatus` (`IdStatus`);

--
-- Индексы таблицы `Cooperator`
--
ALTER TABLE `Cooperator`
  ADD PRIMARY KEY (`IdCooperator`);

--
-- Индексы таблицы `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`IdStatus`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`IdUser`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Application`
--
ALTER TABLE `Application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`IdCooperator`) REFERENCES `Cooperator` (`IdCooperator`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`IdStatus`) REFERENCES `Status` (`IdStatus`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`IdUser`) REFERENCES `User` (`IdUser`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
