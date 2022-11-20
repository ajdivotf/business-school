-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 20 2022 г., 12:27
-- Версия сервера: 5.5.62
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `business_school`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_of_catogory` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_category`, `name_of_catogory`) VALUES
(1, 'Компьютерные науки'),
(2, 'Экономика');

-- --------------------------------------------------------

--
-- Структура таблицы `document`
--

CREATE TABLE `document` (
  `id_document` int(11) NOT NULL,
  `name_of_document` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `document`
--

INSERT INTO `document` (`id_document`, `name_of_document`) VALUES
(1, 'Диплом'),
(2, 'Удостоверение'),
(3, 'Сертификат');

-- --------------------------------------------------------

--
-- Структура таблицы `education`
--

CREATE TABLE `education` (
  `id_education` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `apply_date` date DEFAULT NULL,
  `beginning_date` date DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  `payment` double DEFAULT NULL,
  `doc_number` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `rating` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `education`
--

INSERT INTO `education` (`id_education`, `id_student`, `id_program`, `apply_date`, `beginning_date`, `closing_date`, `payment`, `doc_number`, `status`, `rating`) VALUES
(1, 2, 7, '2022-11-02', NULL, NULL, NULL, 0, 1, 5),
(2, 2, 10, '2022-10-29', NULL, NULL, NULL, 0, 1, 4),
(3, 3, 5, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(4, 3, 15, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(5, 4, 11, '2022-11-05', NULL, NULL, NULL, 0, 2, 0),
(6, 5, 3, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(7, 6, 8, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(8, 6, 25, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(9, 7, 6, '2022-11-01', NULL, NULL, NULL, 0, 1, 5),
(10, 7, 25, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(11, 8, 4, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(12, 8, 7, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(13, 8, 12, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(14, 8, 10, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(15, 9, 24, '2022-11-14', NULL, NULL, NULL, 0, 0, 0),
(16, 10, 23, '2022-11-04', NULL, NULL, NULL, 0, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `form_of_education`
--

CREATE TABLE `form_of_education` (
  `id_form` int(11) NOT NULL,
  `name_of_form` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `form_of_education`
--

INSERT INTO `form_of_education` (`id_form`, `name_of_form`) VALUES
(1, 'Очная'),
(2, 'Дистанционная');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `profile_pic` longblob,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathername` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_day` date DEFAULT NULL,
  `education` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id_student`, `profile_pic`, `lastname`, `firstname`, `fathername`, `birth_day`, `education`, `phone_number`, `email`, `username`, `password`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'manager', 'manager', 'sds2013'),
(2, NULL, 'Яблокова', 'Антонина', 'Петровна', '2004-04-14', NULL, '', 'eckyl@bk.ru', '', 'sds2013'),
(3, NULL, 'Савицкая', 'Елена', 'Алексеевна', '1991-01-24', NULL, '', 'ajdivot@mail.ru', 'eckyl', 'sds2014'),
(4, NULL, 'Левитский', 'Александр', '', '2001-02-17', NULL, '', 'student@mail.ru', 'student@mail.ru', 'sds2014sds'),
(5, NULL, 'Аксенов', 'Максим', 'Владимирович', NULL, NULL, NULL, 'aksenov@bk.ru', 'aksenov_maks', '554455A'),
(6, NULL, 'Журавлев', 'Денис', 'Александрович', NULL, NULL, NULL, 'shadoof_den@gmail.com', 'shadoof_dof', '3467al.oP'),
(7, NULL, 'Круглова', 'Арина', 'Тимофеевна', NULL, NULL, NULL, 'round_beadddy@bk.ru', 'roundybeadddy', 'rounder90$38ALo'),
(8, NULL, 'Морозова', 'Юлия', 'Святославовна', NULL, NULL, NULL, 'frostyggile@@kixotic.com', 'frosty_uia', 'UIOjdf974$ojj*'),
(9, NULL, 'Рябинин', 'Дмитрий', 'Андреевич', NULL, NULL, '', 'rowan_d997@mail.com', 'rowan_rop', 'gmoa90JUU.df'),
(10, NULL, 'Ширяев', 'Денис', 'Никитич', NULL, NULL, NULL, 'wden_dat@bk.com', 'wden_dat', '59kmwden_datpOO');

-- --------------------------------------------------------

--
-- Структура таблицы `subcategory`
--

CREATE TABLE `subcategory` (
  `id_subcategory` int(11) NOT NULL,
  `name_of_subcategory` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subcategory`
--

INSERT INTO `subcategory` (`id_subcategory`, `name_of_subcategory`, `id_category`) VALUES
(1, 'Разработка ПО', 1),
(2, 'Разработка мобильных и веб-приложений', 1),
(3, 'Алгоритмы', 1),
(4, 'Компьютерная безопасность и сети', 1),
(5, 'Дизайн и продукт', 1),
(6, 'Микроэкономика', 2),
(7, 'Макроэкономика', 2),
(8, 'Финансы', 2),
(9, 'Статистика и анализ', 2),
(10, 'Предпринимательство', 2),
(11, 'Тестирование', 1),
(12, 'Компьютерная грамотность', 1),
(14, 'Бухгалтерское дело', 2),
(15, 'Командообразование в IT', 1),
(16, 'Геймдев', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `training_program`
--

CREATE TABLE `training_program` (
  `id_program` int(11) NOT NULL,
  `name_of_program` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_subcategory` int(11) NOT NULL,
  `number_of_hours` int(11) NOT NULL DEFAULT '72',
  `price` double DEFAULT NULL,
  `id_certification` int(11) NOT NULL DEFAULT '1',
  `id_document` int(11) NOT NULL DEFAULT '2',
  `type_of_program` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'повышение квалификации',
  `id_form` int(11) NOT NULL DEFAULT '2',
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` text COLLATE utf8mb4_unicode_ci,
  `average_rate` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `training_program`
--

INSERT INTO `training_program` (`id_program`, `name_of_program`, `id_subcategory`, `number_of_hours`, `price`, `id_certification`, `id_document`, `type_of_program`, `id_form`, `description`, `icon`, `average_rate`) VALUES
(1, 'Анализ данных', 9, 72, 36924, 2, 2, 'Повышение квалификации', 2, 'Программа соответствует требованиям к вакансиям аналитика данных', 'fa-solid fa-pie-chart', 0),
(2, 'Машинное обучение', 3, 120, 17000, 1, 2, 'Повышение квалификации', 2, 'Станьте ценным специалистом, научившись решать задачи бизнеса с помощью нейронных сетей', 'fa-solid fa-brain', 0),
(3, 'Пользователь ПК', 12, 120, 1200, 1, 2, 'Повышение квалификации', 1, 'Базовая компьютерная подготовка. Windows и Интернет для начинающих', 'fa-solid fa-desktop', 0),
(4, 'Экономика и бухучёт', 14, 520, 11000, 1, 1, 'Переобучение', 1, 'Полное погружение в специальность с нуля', 'fa-solid fa-calculator', 0),
(5, 'Веб-дизайн и разработка', 5, 144, 5200, 3, 2, 'Повышение квалификации', 2, 'Получите основы дизайна и навыки работы в Figma, PhotoShop, After effects и Readymag', 'fa-solid fa-palette', 0),
(6, 'Node.js', 2, 72, 11500, 3, 2, 'Повышение квалификации', 2, 'Научитесь писать современные серверные приложения', 'fa-brands fa-node-js', 5),
(7, '1C', 14, 72, 48400, 1, 2, 'Повышение квалификации', 2, 'Научитесь создавать и внедрять решения для бизнеса на платформе 1С', 'fa-solid fa-briefcase', 5),
(8, 'Ручное тестирование', 11, 72, 7470, 1, 2, 'Повышение квалификации', 2, 'IT-специальность, не требующая навыков программирования', 'fa-solid fa-list-check', 0),
(9, 'Анализ финансовых рынков', 7, 40, 7800, 1, 3, 'Повышение квалификации', 1, 'Разработан для формирования компетенций и навыков работы на фондовом рынке', 'fa-solid fa-chart-line', 0),
(10, 'Финансовая экономика', 8, 58, 2000, 1, 3, 'Повышение квалификации', 1, 'Вводный курс финансов, в котором рассматриваются основы финансовых рынков и ценообразования финансовых активов', 'fa-solid fa-money-bill-wave', 4),
(11, 'Блокчейн-технология в бизнесе', 8, 24, 21900, 1, 3, 'Повышение квалификации', 1, 'Рассказывает о преимуществах блокчейн-технологии и об этапах внедрения блокчейна в работающий бизнес.', 'fa-solid fa-cube', 0),
(12, 'Внутренний аудит', 14, 40, 32900, 2, 3, 'Повышение квалификации', 2, 'Демонстрация приемов для успешной реализации функции внутреннего аудита', 'fa-solid fa-magnifying-glass', 0),
(13, 'Микроэкономика: базовый курс', 6, 32, 2700, 1, 3, 'Повышение квалификации', 2, 'Дает общее представление о микроэкономике и ее принципах', 'fa-solid fa-diagram-project', 0),
(14, 'Теория фирмы и рынков', 6, 32, 2800, 1, 3, 'Повышение квалификации', 2, 'Узнайте, как прогнозировать поведение фирм и оценивать состояния, возникающие на отраслевых рынках', 'fa-solid fa-sitemap', 0),
(15, 'Личный бренд', 10, 64, 16026, 1, 1, 'Повышение квалификации', 2, 'Узнайте, как создать сильный личный бренд. Научитесь эффективно взаимодействовать с клиентами и партнёрами.', 'fa-solid fa-wand-magic-sparkles', 0),
(16, 'Менеджер маркетплейсов', 10, 72, 14640, 1, 3, 'Переобучение', 2, 'Узнайте, как на выгодных условиях сотрудничать с начинающими селлерами и крупными компаниями', 'fa-solid fa-box-open', 0),
(17, 'Основы предпринимательства', 10, 144, 14643, 1, 3, 'Переобучение', 2, 'Поймёте, как найти прибыльную нишу и запустить своё дело. Разберётесь в налогообложении и сможете зарегистрировать бизнес.', 'fa-solid fa-handshake', 0),
(18, 'Fullstack-разработчик на PHP', 2, 72, 18924, 3, 1, 'Переобучение', 2, 'Начните карьеру fullstack-специалиста', 'fa-brands fa-php', 0),
(19, 'IOS-разработчик', 2, 144, 23005, 3, 3, 'Переобучение', 2, 'Научитесь создавать приложения для устройств Apple', 'fa-brands fa-apple', 0),
(20, 'Архитектор ПО', 1, 72, 23388, 1, 3, 'Повышение квалификации', 2, 'Познакомьтесь с инструментами и лучшими практиками построения архитектуры ПО', 'fa-brands fa-accusoft', 0),
(21, 'Go-разработчик', 1, 180, 16644, 3, 1, 'Переобучение', 2, 'Научитесь создавать на нём приложения с микросервисной архитектурой', 'fa-brands fa-golang', 0),
(23, 'IT-TeamLead', 15, 72, 17720, 1, 3, 'Переобучение', 2, 'Станьте руководителем команды разработчиков на практике', 'fa-solid fa-people-arrows', 2),
(24, 'Разработчик игр на Unity', 16, 280, 54996, 3, 1, 'Переобучение', 2, 'Начните делать игры сами: освойте C#, Unity с нуля и основы геймдизайна', 'fa-brands fa-unity', 0),
(25, 'Алгоритмы', 3, 40, 2741, 1, 3, 'Повышение квалификации', 2, 'Курс по алгоритмам для разработчиков, готовых выйти на новый уровень в карьере за короткий срок', 'fa-solid fa-network-wired', 0),
(26, 'Информационная безопасность', 4, 400, 165000, 3, 1, 'Переобучение', 2, 'Научитесь проектировать системы безопасности, чтобы отражать кибератаки и помогать бизнесу защищать данные пользователей', 'fa-solid fa-fingerprint', 0),
(27, 'Автоматизатор тестирования на Java', 11, 560, 70000, 3, 2, 'Переобучение', 2, 'Обучитесь внедрять, поддерживать и развивать инфраструктуру автотестов', 'fa-solid fa-bug-slash', 0),
(28, 'Специалист по информационной безопасности', 4, 560, 120000, 3, 1, 'Переобучение', 2, 'Научитесь предвосхищать кибератаки и минимизировать их последствия', 'fa-solid fa-user-shield', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_certification`
--

CREATE TABLE `type_of_certification` (
  `id_certification` int(11) NOT NULL,
  `name_of_certification` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `type_of_certification`
--

INSERT INTO `type_of_certification` (`id_certification`, `name_of_certification`) VALUES
(1, 'Тестирование'),
(2, 'Анектирование'),
(3, 'Проект');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_document`);

--
-- Индексы таблицы `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id_education`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_program` (`id_program`);

--
-- Индексы таблицы `form_of_education`
--
ALTER TABLE `form_of_education`
  ADD PRIMARY KEY (`id_form`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Индексы таблицы `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id_subcategory`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `training_program`
--
ALTER TABLE `training_program`
  ADD PRIMARY KEY (`id_program`),
  ADD UNIQUE KEY `id_program` (`id_program`),
  ADD KEY `id_document` (`id_document`),
  ADD KEY `id_subcategory` (`id_subcategory`),
  ADD KEY `id_certification` (`id_certification`),
  ADD KEY `id_form` (`id_form`);

--
-- Индексы таблицы `type_of_certification`
--
ALTER TABLE `type_of_certification`
  ADD PRIMARY KEY (`id_certification`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `document`
--
ALTER TABLE `document`
  MODIFY `id_document` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `education`
--
ALTER TABLE `education`
  MODIFY `id_education` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `form_of_education`
--
ALTER TABLE `form_of_education`
  MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id_subcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `training_program`
--
ALTER TABLE `training_program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `type_of_certification`
--
ALTER TABLE `type_of_certification`
  MODIFY `id_certification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `education_ibfk_2` FOREIGN KEY (`id_program`) REFERENCES `training_program` (`id_program`);

--
-- Ограничения внешнего ключа таблицы `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Ограничения внешнего ключа таблицы `training_program`
--
ALTER TABLE `training_program`
  ADD CONSTRAINT `id_document` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`),
  ADD CONSTRAINT `training_program_ibfk_1` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategory` (`id_subcategory`),
  ADD CONSTRAINT `training_program_ibfk_2` FOREIGN KEY (`id_certification`) REFERENCES `type_of_certification` (`id_certification`),
  ADD CONSTRAINT `training_program_ibfk_3` FOREIGN KEY (`id_form`) REFERENCES `form_of_education` (`id_form`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
