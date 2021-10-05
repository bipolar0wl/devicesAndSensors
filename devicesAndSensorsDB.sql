-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 16 2021 г., 14:42
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `salikhovar_dvasn`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application_sphere`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `application_sphere`;
CREATE TABLE `application_sphere` (
  `application_sphere_id` int(11) NOT NULL,
  `application_sphere_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `application_sphere`
--

INSERT INTO `application_sphere` (`application_sphere_id`, `application_sphere_name`) VALUES
(2, 'авиационная техника'),
(6, 'охрана окружающей среды'),
(7, 'нефтегазовая промышленность'),
(8, 'нефтехимическая промышленность'),
(9, 'химическая промышленность'),
(10, 'металлургическая промышленность'),
(14, 'медицинское оборудование'),
(20, 'машиностроение'),
(22, 'автомобильная электроника'),
(26, 'технологические процессы'),
(61, 'пищевая промышленность');

-- --------------------------------------------------------

--
-- Структура таблицы `changes_info`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `changes_info`;
CREATE TABLE `changes_info` (
  `change_id` int(11) NOT NULL COMMENT 'Номер изменения',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `type` int(11) NOT NULL COMMENT 'Датчик - 0, Прибор - 1',
  `id` int(11) NOT NULL COMMENT 'id датчика или прибора',
  `date` datetime NOT NULL COMMENT 'Дата изменения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `changes_info`
--

INSERT INTO `changes_info` (`change_id`, `user_id`, `type`, `id`, `date`) VALUES
(1, 11, 0, 367, '2021-04-22 13:32:42'),
(2, 11, 0, 367, '2021-04-22 13:33:11'),
(3, 11, 0, 367, '2021-04-22 13:33:35'),
(4, 18, 0, 368, '2021-05-18 20:16:50'),
(5, 18, 0, 368, '2021-05-18 20:16:55'),
(6, 18, 0, 369, '2021-05-18 20:20:05'),
(7, 18, 0, 370, '2021-05-18 20:23:49'),
(8, 18, 0, 371, '2021-05-18 20:28:20'),
(9, 18, 0, 372, '2021-05-18 20:30:41');

-- --------------------------------------------------------

--
-- Структура таблицы `devices`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL COMMENT 'Идентификатор',
  `name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Название',
  `producer_id` int(11) DEFAULT NULL COMMENT 'Производитель',
  `manufacturing_technology_id` int(11) DEFAULT NULL COMMENT 'технология изготовления',
  `device_type_id` int(11) DEFAULT NULL COMMENT 'Тип прибора',
  `in_resistance` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Входное сопротивление',
  `out_resistance` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Выходное сопротивление',
  `width` float DEFAULT NULL COMMENT 'Ширина',
  `length` float DEFAULT NULL COMMENT 'Длина',
  `height` float DEFAULT NULL COMMENT 'Высота',
  `diameter` float DEFAULT NULL COMMENT 'Диаметр',
  `unit_of_length` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Единица измерения длины',
  `weight` float DEFAULT NULL COMMENT 'Масса',
  `unit_of_weight` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Единица измерения массы',
  `measurement_error` float DEFAULT NULL COMMENT 'Относительная погрешность',
  `output_voltage` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Выходное напряжение',
  `power` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Питание(Вольт)',
  `protection_class` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Класс защиты',
  `lower_temperature_threshold` float DEFAULT NULL COMMENT 'Нижний порог температуры',
  `upper_temperature_threshold` float DEFAULT NULL COMMENT 'Верхний порог температуры',
  `temperature_unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Единица измерения температуры',
  `description` longtext COLLATE utf8mb4_unicode_ci COMMENT 'описание',
  `device_purpose_id` int(11) DEFAULT NULL COMMENT 'назначение',
  `control_type_id` int(11) DEFAULT NULL COMMENT 'способ управления',
  `measure_show_type_id` int(11) DEFAULT NULL COMMENT 'способ воспр. изм. вел.',
  `resource` float DEFAULT NULL COMMENT 'Наработка (Часов)',
  `ad_running_time_unit` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_measuremethod` int(11) DEFAULT NULL,
  `measure_min` float DEFAULT NULL,
  `measure_max` float DEFAULT NULL,
  `unit_of_measuring` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_devdop` int(11) DEFAULT NULL,
  `operation_principle_id` int(11) DEFAULT NULL COMMENT 'Принцип действия',
  `scheme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Схема',
  `blueprint` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Чертеж',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Изображение',
  `dynamic_warm_up_time` float DEFAULT NULL COMMENT 'Время разогрева',
  `din_t_heat_ed_ad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dynamic_shift_factor` float DEFAULT NULL COMMENT 'Коэффициент смещения',
  `dynamic_frequency_response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Частотная характеристика (изображение)',
  `dynamic_time_constant` float DEFAULT NULL COMMENT 'Постоянная времени (сек)',
  `dynamic_cutoff_frequency_min` float DEFAULT NULL COMMENT 'Минимальная частота среза (Герц)',
  `dynamic_cutoff_frequency_max` float DEFAULT NULL COMMENT 'Максимальная частота среза (Герц)',
  `din_faz_sdvig_ad` float DEFAULT NULL,
  `dynamic_resonant_frequency` float DEFAULT NULL COMMENT 'Резонансная частота (Герц)',
  `dynamic_damping_factor` float DEFAULT NULL COMMENT 'Коэффициент демпфирования',
  `dynamic_static_sensitivity` float DEFAULT NULL COMMENT 'Коэффициент стат. чувств.',
  `dynamic_description` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Дополнительные сведения',
  `dynamic_error` float DEFAULT NULL COMMENT 'Динамическая погрешность (%)',
  `user_id` int(11) DEFAULT NULL COMMENT 'Пользователь-автор',
  `deleted` tinyint(1) DEFAULT NULL COMMENT 'Ключ удаления'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `devices`
--

INSERT INTO `devices` (`device_id`, `name`, `producer_id`, `manufacturing_technology_id`, `device_type_id`, `in_resistance`, `out_resistance`, `width`, `length`, `height`, `diameter`, `unit_of_length`, `weight`, `unit_of_weight`, `measurement_error`, `output_voltage`, `power`, `protection_class`, `lower_temperature_threshold`, `upper_temperature_threshold`, `temperature_unit`, `description`, `device_purpose_id`, `control_type_id`, `measure_show_type_id`, `resource`, `ad_running_time_unit`, `id_measuremethod`, `measure_min`, `measure_max`, `unit_of_measuring`, `id_devdop`, `operation_principle_id`, `scheme`, `blueprint`, `picture`, `dynamic_warm_up_time`, `din_t_heat_ed_ad`, `dynamic_shift_factor`, `dynamic_frequency_response`, `dynamic_time_constant`, `dynamic_cutoff_frequency_min`, `dynamic_cutoff_frequency_max`, `din_faz_sdvig_ad`, `dynamic_resonant_frequency`, `dynamic_damping_factor`, `dynamic_static_sensitivity`, `dynamic_description`, `dynamic_error`, `user_id`, `deleted`) VALUES
(1, 'АГБ-3К', 30, 1, 1, '10 Ом', '5 Ом', 10, 12, 30, NULL, 'см', 5, 'кг', 0, '12 В', '27 В', 'IP-65', -20, 60, 'C', 'Гироскопическая система авиагоризонта АГБ-3(АГБ-ЗК) представляет собой гироскоп с тремя степенями свободы, главная ось которого поддерживается в вертикали места (т.е. перпендикулярно плоскости истинного горизонта) системой электри­ческой маятниковой коррекции. Как известно, главная ось некорректируемого трехстепенного гироскопа вследствие суточного вращения Земли и перемещения самолета в полете относительно земли, а также под влиянием трения в опорах карданова подвеса, остаточной несбалан­сированности гироскопа и ряда других причин бу­дет с течением времени отклоняться от положения истинной вертикали места.', 1, 1, 1, 5000, 'час', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 'АШ-1', 30, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, 'ТЭ-4В', 29, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(5, 'ТМИ', 29, NULL, 2, '10 Ом', '5 Ом', 10, 12, 30, NULL, 'см', 1, 'кг', 1, '12 В', '', 'IP-54', -20, 60, 'C', 'Двухстрелочный электрический дистанционный тахометр', 2, 1, 1, 5000, 'час.', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(6, 'ТМ', 29, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(7, '8ТМ', 29, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(8, 'ТЭ-Д', 29, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(9, 'АГК-47Б', 30, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(10, 'АГ-83', 30, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(12, 'АГР-74', 30, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(13, 'АГР-72А', 30, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(14, 'АГК-47У', 30, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(15, 'АГК-77', 30, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(16, 'ДА-30П', 29, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(17, 'ДА-200', 29, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(18, 'ДА-200К', 29, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(19, 'ППЛЗ-СВС', 32, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Измерение, вычисление, индикация высотно-скоростных параметров и передача их в бортовые системы. Устанавливается на самолеты Ан-74, Ан-124, Ан-148, Ил-114', 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(21, 'ВБЭ-ЦМ', 32, NULL, 5, NULL, NULL, 85, 85, 235, NULL, 'мм', 2, 'кг', 1, NULL, '27', NULL, -99, 60, 'С', NULL, 1, 2, 1, NULL, NULL, NULL, -503, 15240, 'м', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(22, 'АЧС-1 МК', 33, NULL, 6, NULL, NULL, 91, 85, 91, NULL, 'мм', 655, 'г', NULL, NULL, '27', NULL, -60, 60, '°С', NULL, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `device_application_sphere`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_application_sphere`;
CREATE TABLE `device_application_sphere` (
  `application_sphere_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `device_application_sphere`
--

INSERT INTO `device_application_sphere` (`application_sphere_id`, `device_id`) VALUES
(2, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `device_control_type`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_control_type`;
CREATE TABLE `device_control_type` (
  `control_type_id` int(11) NOT NULL,
  `control_type_name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `device_control_type`
--

INSERT INTO `device_control_type` (`control_type_id`, `control_type_name`) VALUES
(1, 'Дистанционный'),
(2, 'Недистанционный');

-- --------------------------------------------------------

--
-- Структура таблицы `device_environment`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_environment`;
CREATE TABLE `device_environment` (
  `device_id` int(11) NOT NULL,
  `environment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `device_literature`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_literature`;
CREATE TABLE `device_literature` (
  `device_id` int(11) NOT NULL,
  `literature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `device_measurable_value`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_measurable_value`;
CREATE TABLE `device_measurable_value` (
  `measurable_value_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `device_measurable_value`
--

INSERT INTO `device_measurable_value` (`measurable_value_id`, `device_id`) VALUES
(3, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `device_measure_show_type`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_measure_show_type`;
CREATE TABLE `device_measure_show_type` (
  `measure_show_type_id` int(11) NOT NULL,
  `measure_show_type_name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `device_measure_show_type`
--

INSERT INTO `device_measure_show_type` (`measure_show_type_id`, `measure_show_type_name`) VALUES
(1, 'Непосредственная выдача информации'),
(2, 'Регистрирующий');

-- --------------------------------------------------------

--
-- Структура таблицы `device_purpose`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_purpose`;
CREATE TABLE `device_purpose` (
  `device_purpose_id` int(11) NOT NULL,
  `device_purpose_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `device_purpose`
--

INSERT INTO `device_purpose` (`device_purpose_id`, `device_purpose_name`) VALUES
(1, 'Пилотажно-навигационные приборы'),
(2, 'Приборы контроля силовых установок'),
(3, 'Приборы для измерения параметров окружающей среды'),
(4, 'Приборы контроля за работой отдельных систем и агрегатов самолета'),
(5, 'Показание текущего времени');

-- --------------------------------------------------------

--
-- Структура таблицы `device_type`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `device_type`;
CREATE TABLE `device_type` (
  `device_type_id` int(11) NOT NULL,
  `device_type_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `device_type`
--

INSERT INTO `device_type` (`device_type_id`, `device_type_name`) VALUES
(1, 'Авиагоризонт'),
(2, 'Тахометр'),
(3, 'Вариометр'),
(4, 'Прибор пилотажный комбинированный'),
(5, 'Высотомер'),
(6, 'Авиационные часы');

-- --------------------------------------------------------

--
-- Структура таблицы `environment`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `environment`;
CREATE TABLE `environment` (
  `environment_id` int(11) NOT NULL,
  `environment_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `environment_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `environment`
--

INSERT INTO `environment` (`environment_id`, `environment_name`, `environment_description`) VALUES
(2, 'газ', 'Агрегатное состояние вещества, характеризующееся очень слабыми связями между составляющими его частицами (молекулами, атомами или ионами), а также их большой подвижностью.'),
(3, 'твердое тело', NULL),
(4, 'нефть', NULL),
(5, 'кислота', NULL),
(7, 'щелочь', NULL),
(8, 'жидкость', NULL),
(9, 'воздух', NULL),
(11, 'агрессивные среды', NULL),
(12, 'wswswswswswswsdccddc', 'swswsw');

-- --------------------------------------------------------

--
-- Структура таблицы `literature`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `literature`;
CREATE TABLE `literature` (
  `literature_id` int(11) NOT NULL,
  `literature_name` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `literature_author` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `literature_date` int(11) DEFAULT NULL,
  `literature_publisher` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_file_lit` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_lit` longblob,
  `literature_website` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `literature`
--

INSERT INTO `literature` (`literature_id`, `literature_name`, `literature_author`, `literature_date`, `literature_publisher`, `name_file_lit`, `file_lit`, `literature_website`) VALUES
(1, 'Пьезоэлектрические датчики', 'Шарапов В. М., Мусиенко М. П., Шарапова Е. В.', 2006, 'Техносфера', NULL, NULL, 'www.ya.ru'),
(2, 'Датчики измерительных систем', 'Ж. Аш', 1992, 'Мир', NULL, NULL, ''),
(3, 'Пьезоэлектрические датчики', 'Малов В. В.', 1989, 'Энергоатомиздат', NULL, NULL, 'http://ya.ru'),
(4, 'Изделия электронной техники. Пьезоэлектрические и электромеханические приборы: Справочник. ', 'Ладик А. И., Сташкевич А. И.', 1993, 'Радио и связь', NULL, NULL, ''),
(5, '	Упругие элементы приборов', 'Андреева Л. Е.', 1962, 'Машгиз', NULL, NULL, ''),
(6, '	Проектирование датчиков для измерения  механических величин', 'Е. П. Осадчий', 1979, 'Машиностроение', NULL, NULL, ''),
(7, '	Элементы автоматических приборных устройств: Учебное пособие для вузов. ', 'Лаврова А. Т.', 1975, 'Машиностроение', NULL, NULL, ''),
(8, 'Техника измерения давления, расхода, количества и уровня жидкости, газа и пара: Учебное пособие для техникумов.', 'Хансуваров К. И., Цейтлин В. Г.', 1990, 'Издательство стандартов', NULL, NULL, ''),
(9, 'Датчики контроля и регулирования', 'Кузнецова Н.Н.', 1965, 'Машиностроение', NULL, NULL, ''),
(12, 'Датчики теплофизических и механических параметров', 'Ю.Н. Коптев', 2000, 'Радиотехника', NULL, NULL, ''),
(29, 'Прибор звездной ориентации БОКЗ', 'Г.А. Аванесов, Р.В. Бессонов, В.Ю. Дементьев', 2013, 'Институт космических исследований РАН', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturing_technology`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `manufacturing_technology`;
CREATE TABLE `manufacturing_technology` (
  `manufacturing_technology_id` int(11) NOT NULL,
  `manufacturing_technology_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturing_technology_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `manufacturing_technology`
--

INSERT INTO `manufacturing_technology` (`manufacturing_technology_id`, `manufacturing_technology_name`, `manufacturing_technology_description`) VALUES
(2, 'Элементная', ''),
(3, 'Интегральная', '');

-- --------------------------------------------------------

--
-- Структура таблицы `measurable_value`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `measurable_value`;
CREATE TABLE `measurable_value` (
  `measurable_value_id` int(11) NOT NULL,
  `measurable_value_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measurable_value_description` longtext COLLATE utf8mb4_unicode_ci,
  `ad_measurerange_min` float(24,0) DEFAULT NULL,
  `ad_measurerange_max` float(24,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `measurable_value`
--

INSERT INTO `measurable_value` (`measurable_value_id`, `measurable_value_name`, `measurable_value_description`, `ad_measurerange_min`, `ad_measurerange_max`) VALUES
(3, 'Давление', 'Физическая величина, равная силе F, действующей на единицу площади поверхности S перпендикулярно этой поверхности. Давление характеризует состояние сплошной среды и является диагональной компонентой тензора напряжений. В простейшем случае изотропной равновесной неподвижной среды давление не зависит от ориентации. Давление можно считать также мерой запасённой в сплошной среде потенциальной энергии на единицу объёма и измерять в единицах энергии, отнесённых к единице объёма.', NULL, NULL),
(4, 'Ускорение', 'Ускорение - производная от скорости по времени...', NULL, NULL),
(6, 'Температура', NULL, NULL, NULL),
(15, 'Размер', ' Измеряются габариты объекта', NULL, NULL),
(16, 'Влажность', NULL, NULL, NULL),
(17, 'Расход', NULL, NULL, NULL),
(19, 'Перемещение', NULL, NULL, NULL),
(22, 'Плотность суммарного теплового потока', NULL, NULL, NULL),
(29, 'Направление', NULL, NULL, NULL),
(30, 'Горизонтальное или вертикальное положения', NULL, NULL, NULL),
(32, 'Положение и расстояние', NULL, NULL, NULL),
(34, 'Уровень', NULL, NULL, NULL),
(35, 'Угол', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `operation_principle`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `operation_principle`;
CREATE TABLE `operation_principle` (
  `operation_principle_id` int(11) NOT NULL,
  `operation_principle_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_principle_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `operation_principle`
--

INSERT INTO `operation_principle` (`operation_principle_id`, `operation_principle_name`, `operation_principle_description`) VALUES
(3, 'Пьезорезистивный', 'В основе лежит прямой пьезоэлектрический эффект, при котором пьезоэлемент генерирует электрический сигнал, пропорциональный действующей на него силе или давлению.'),
(4, 'Емкостной', 'Используется свойство конденсатора изменять свою емкость при различных внешних воздействиях.'),
(5, 'Тензорезистивный', 'Метод основан на преобразовании изменения электрического сопротивления измерительного элемента в зависимости от его механической деформации.'),
(6, 'Поплавковый', NULL),
(7, 'Полупроводниковый ', NULL),
(9, 'Электродный', 'Слежение за изменением уровня контактного электрода'),
(11, 'Разность давлений', NULL),
(13, 'Терморезистивный', NULL),
(17, 'Индуктивно-трансформаторный', NULL),
(21, 'Ультразвуковой', NULL),
(30, 'Инерциальный', NULL),
(35, 'Герконовый', NULL),
(36, 'Эффект Холла', NULL),
(37, 'Механический', NULL),
(42, 'Оппозитный', NULL),
(43, 'Принцип Пелтона', NULL),
(46, 'Рефлекторный', NULL),
(47, 'Механический', NULL),
(48, 'Фотоэлектрический', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `output_signal`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `output_signal`;
CREATE TABLE `output_signal` (
  `output_signal_id` int(11) NOT NULL,
  `output_signal_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `output_signal_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `output_signal`
--

INSERT INTO `output_signal` (`output_signal_id`, `output_signal_name`, `output_signal_description`) VALUES
(2, 'дискретный', 'Дискретный сигнал - сигнал, имеющий конечное число значений. Обычно сигналы, передаваемые через дискретные каналы, имеют два или три значения. Использование сигналов с тремя значениями обеспечивает синхронизацию передачи.'),
(3, 'импульсный', 'Импульсный сигнал представляет собой сигнал с кратковременным изменением установившегося состояния, характеризующийся малым интервалом времени по сравнению с временными характеристиками установившегося процесса.'),
(4, 'цифровой', 'Цифровой сигнал — дискретный сигнал, квантованный по амплитуде. Сигналы представляют собой дискретные электрические или световые импульсы. При таком способе вся емкость коммуникационного канала используется для передачи одного сигнала. Цифровой сигнал использует всю полосу пропускания кабеля.'),
(5, 'аналоговый', 'Аналоговый сигнал — сигнал данных, у которого каждый из представляющих параметров описывается функцией времени и непрерывным множеством возможных значений. Аналоговые сигналы описываются непрерывными функциями времени, поэтому аналоговый сигнал иногда называют непрерывным сигналом. ');

-- --------------------------------------------------------

--
-- Структура таблицы `producer`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `producer`;
CREATE TABLE `producer` (
  `producer_id` int(11) NOT NULL,
  `producer_name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producer_address` longtext COLLATE utf8mb4_unicode_ci,
  `producer_phone` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producer_website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producer_email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `producer`
--

INSERT INTO `producer` (`producer_id`, `producer_name`, `producer_address`, `producer_phone`, `producer_website`, `producer_email`) VALUES
(3, 'BD Sensors RUS', 'Россия, Москва, Варшавское шоссе, д.37А', '(495) 380-1683', 'http://www.bdsensors.ru/', NULL),
(5, 'Электроремонтные мастерские энергоуправления', 'Нальчик', NULL, NULL, NULL),
(6, 'ВНИИКАНефтегаз', 'Москва', '', '', ''),
(7, 'Texas Instruments', 'USA, Texas Instruments\nPost Office Box 655303 Dallas, Texas 75265', NULL, NULL, NULL),
(8, 'Электропульт', 'Ленинград', '', '', ''),
(9, 'Завод тепловых приборов ', 'Рязань ', NULL, NULL, NULL),
(10, 'Philips Semiconductors', NULL, 'Fax: +31 40 27 24825', 'http://www.semiconductors.philips.com.', 'sales.addresses@www.semiconductors.philips.com.'),
(11, 'опытный завод института стекла ', 'Москва', NULL, NULL, NULL),
(12, 'Frescale', NULL, NULL, NULL, NULL),
(13, 'motorolla', NULL, NULL, NULL, NULL),
(14, 'Kobold ', NULL, NULL, NULL, NULL),
(15, 'Dallas', NULL, NULL, NULL, NULL),
(16, 'НИИ физических измерений ', 'г. Пенза', NULL, NULL, NULL),
(17, 'Honeywell', 'Honeywell\n11 West Spring Street\nFreeport, Illinois 61032', '1-800-537-6945', 'www.honeywell.com/sensing', 'info.sc@honeywell.com'),
(18, 'МНПК Авионика', 'г. Москва', NULL, NULL, NULL),
(19, 'НПО измерительной техники', 'г. Королёв', NULL, NULL, NULL),
(20, 'Техприбор', NULL, NULL, NULL, NULL),
(21, 'Микросенсорные технологии ', 'г. Москва', NULL, NULL, NULL),
(22, 'Brown', 'г. Вильнюс Литва', NULL, NULL, NULL),
(23, 'Omron', 'Wegalaan 57\n2132 JD Hoofddorp\nThe Netherlands', '+31 23 568 1200', NULL, NULL),
(24, 'Freesale', NULL, NULL, 'www.freescale.com', NULL),
(25, 'Crydom', NULL, NULL, NULL, NULL),
(26, 'Baumer', 'Германия', NULL, NULL, NULL),
(27, 'Autonics ', 'Ю. Корея', NULL, NULL, NULL),
(28, 'Метра', NULL, NULL, NULL, NULL),
(29, 'Саранский приборостроительный завод', 'Саранск, Россия', NULL, NULL, NULL),
(30, 'Уральский приборостроительный завод', NULL, NULL, NULL, NULL),
(32, 'Аэроприбор-Восход', '', '', '', ''),
(33, 'Челябинский часовой завод \"Молния\"', 'Россия, Чклябинская область, ул. Цвиллинга, д. 25', '', '', ''),
(34, 'Analog Devices', '', '', '', ''),
(35, 'On Semiconductor', '5005 East McDowell Road Phoenix, USA, 85008', '+358408309390', 'https://www.onsemi.com/', 'onsemi@mtgroup.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `sensitive_element`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `sensitive_element`;
CREATE TABLE `sensitive_element` (
  `sensitive_element_id` int(11) NOT NULL,
  `sensitive_element_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensitive_element_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sensitive_element`
--

INSERT INTO `sensitive_element` (`sensitive_element_id`, `sensitive_element_name`, `sensitive_element_description`) VALUES
(3, 'Поплавковый элемент', 'Кремниевый полупроводник, изменяющий электрическое сопротивление в зависимости от деформации.'),
(4, 'Кремниевый тензорезистор', 'Кремниевые тензорезисторы характеризуются высокой стабильностью сигнала.'),
(5, 'Емкость', 'Используется свойство емкости изменять свои параметры при различных внешних воздействиях.'),
(6, 'Биметаллическая спираль', 'Биметаллическую спираль образуют две полоски из металлов с различными коэффициентами линейного расширения, соединенные вместе своими плоскостями и скрученные в спираль.'),
(7, 'Пьезоэлемент', ''),
(8, 'Тензорезистор', NULL),
(9, 'Полупроводниковый температурный сенсор', NULL),
(10, 'Термочувствительный элемент', NULL),
(11, 'Гребенка электродов', NULL),
(12, 'Кремниевый диод', NULL),
(13, 'Дифференциальный чувствительный элемент', 'Дифференциальный чувствительный элемент имеет верхнюю и нижнюю неподвижные пластины и центральную пластину, закрепленную при помощи упругих элементов. Центральная пластина обладает сейсмомассой и может смещаться под воздействием ускорения. '),
(14, 'Металлическая мембрана', NULL),
(15, 'Сопло-заслонка', NULL),
(16, 'Измерительная ячейка', NULL),
(18, 'Втулка', NULL),
(19, 'Измерительный стержень', NULL),
(20, 'Калориметр', NULL),
(21, 'Ультразвуковой излучатель', NULL),
(24, 'Турбина', NULL),
(25, 'Гальванический элемент', NULL),
(26, 'Тепловоспринимающий диск', NULL),
(28, 'Термопара', NULL),
(31, 'Электроды', NULL),
(32, 'Статор и сердечник', NULL),
(35, 'Индуктивность', NULL),
(36, 'Термореактивный элемент', NULL),
(37, 'NTC-термистор', NULL),
(38, 'Фототранзистор', NULL),
(41, 'Оптический фазовый детектор', NULL),
(44, 'Турбинное колесо', NULL),
(45, 'Оптический элемент', NULL),
(46, 'Маятник', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `sensors`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `sensors`;
CREATE TABLE `sensors` (
  `sensor_id` int(11) NOT NULL COMMENT 'Идентификатор',
  `name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Название',
  `height` float DEFAULT NULL COMMENT 'Высота',
  `width` float DEFAULT NULL COMMENT 'Ширина',
  `length` float DEFAULT NULL COMMENT 'Длина',
  `diameter` float DEFAULT NULL COMMENT 'Диаметр',
  `unit_of_length` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Единица измерения длины',
  `weight` float DEFAULT NULL COMMENT 'Масса',
  `unit_of_weight` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Единица измерения массы',
  `measure_min` float DEFAULT NULL COMMENT 'Нижняя граница измерений',
  `measure_max` float DEFAULT NULL COMMENT 'Верхняя граница измерений',
  `unit_of_measuring` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Единица измерения величины',
  `measurement_error` float DEFAULT NULL COMMENT 'Относительная погрешность',
  `output` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `power` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Питание(Вольт)',
  `protection_class` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Класс защиты',
  `temperature_unit` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Единица измерения температуры',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Изображение',
  `blueprint` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Чертеж',
  `description` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Описание',
  `scheme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Схема',
  `sensor_type_id` int(11) DEFAULT NULL COMMENT 'Тип датчика',
  `output_signal_id` int(11) DEFAULT NULL COMMENT 'Характер выходного сигнала',
  `manufacturing_technology_id` int(11) DEFAULT NULL COMMENT 'Технология изготовления',
  `signal_conversation_id` int(11) DEFAULT NULL COMMENT 'Характер преобразования сигнала',
  `producer_id` int(11) DEFAULT NULL COMMENT 'Производитель',
  `measuring_channels` int(11) DEFAULT NULL COMMENT 'Количество измерительных каналов',
  `Vid_vh_vel` int(11) DEFAULT NULL,
  `operation_principle_id` int(11) DEFAULT NULL COMMENT 'Принцип действия',
  `sensitive_element_id` int(11) DEFAULT NULL COMMENT 'Чувствительный элемент',
  `lower_temperature_threshold` float DEFAULT NULL COMMENT 'Нижний порог температуры',
  `upper_temperature_threshold` float DEFAULT NULL COMMENT 'Верхний порог температуры	',
  `measure_min_real` float DEFAULT NULL,
  `measure_max_real` float DEFAULT NULL,
  `id_base` int(11) DEFAULT NULL,
  `id_dopparam` int(11) DEFAULT NULL,
  `resource` float DEFAULT NULL COMMENT 'Ресурс работы(Часы)',
  `dynamic_warm_up_time` float DEFAULT NULL COMMENT 'Время разогрева',
  `din_t_heat_ed` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dynamic_shift_factor` float DEFAULT NULL COMMENT 'Коэффициент смещения',
  `dynamic_frequency_response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Частотная характеристика (изображение)',
  `dynamic_time_constant` float DEFAULT NULL COMMENT 'Постоянная времени (сек)',
  `dynamic_cutoff_frequency_min` float DEFAULT NULL COMMENT 'Минимальная частота среза (Герц)',
  `dynamic_cutoff_frequency_max` float DEFAULT NULL COMMENT 'Максимальная частота среза (Герц)',
  `din_faz_sdvig` float DEFAULT NULL,
  `dynamic_resonant_frequency` float DEFAULT NULL COMMENT 'Резонансная частота (Герц)',
  `dynamic_damping_factor` float DEFAULT NULL COMMENT 'Коэффициент демпфирования',
  `dynamic_static_sensitivity` float DEFAULT NULL COMMENT 'Коэффициент стат. чувств.',
  `dynamic_description` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Дополнительные сведения',
  `file_path` longtext COLLATE utf8mb4_unicode_ci,
  `file_book` longblob,
  `dynamic_error` float DEFAULT NULL COMMENT 'Динамическая погрешность (%)',
  `fix_error` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Пользователь-автор',
  `deleted` tinyint(1) DEFAULT NULL COMMENT 'Ключ удаления'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sensors`
--

INSERT INTO `sensors` (`sensor_id`, `name`, `height`, `width`, `length`, `diameter`, `unit_of_length`, `weight`, `unit_of_weight`, `measure_min`, `measure_max`, `unit_of_measuring`, `measurement_error`, `output`, `power`, `protection_class`, `temperature_unit`, `picture`, `blueprint`, `description`, `scheme`, `sensor_type_id`, `output_signal_id`, `manufacturing_technology_id`, `signal_conversation_id`, `producer_id`, `measuring_channels`, `Vid_vh_vel`, `operation_principle_id`, `sensitive_element_id`, `lower_temperature_threshold`, `upper_temperature_threshold`, `measure_min_real`, `measure_max_real`, `id_base`, `id_dopparam`, `resource`, `dynamic_warm_up_time`, `din_t_heat_ed`, `dynamic_shift_factor`, `dynamic_frequency_response`, `dynamic_time_constant`, `dynamic_cutoff_frequency_min`, `dynamic_cutoff_frequency_max`, `din_faz_sdvig`, `dynamic_resonant_frequency`, `dynamic_damping_factor`, `dynamic_static_sensitivity`, `dynamic_description`, `file_path`, `file_book`, `dynamic_error`, `fix_error`, `user_id`, `deleted`) VALUES
(24, 'DS 4', NULL, NULL, 55, 23, 'мм', 35, 'г', 0, 10, 'МПа', 2, '4...20 мА', '14...36 В', 'IP 54', 'C', NULL, NULL, NULL, NULL, 9, 5, NULL, NULL, 3, NULL, 1, 5, 4, 0, 50, 0, 10000000, 1, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0),
(30, 'HMP 331-A-S', 83, 113, 165, NULL, 'мм', 2000, 'г', 0, 25, 'МПа', 0.15, '4...20 мА', '12...45 В', 'IP 67', 'C', NULL, NULL, NULL, NULL, 10, 4, NULL, 3, 3, NULL, 1, 4, 5, -40, 100, 0, 25000000, 1, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(31, 'HU 300', NULL, NULL, 101, 82, 'мм', 2100, 'г', 0, 103, 'МПа', 0.25, '4...20 мА', '10...30 В', 'IP 67', 'C', NULL, NULL, 'Тензометрический чувствительный элемент имеет малый дрейф и отличную долговременную стабильность. Монолитный штуцер предотвращает изменение характери­стик датчика при монтаже. ', NULL, 9, 5, NULL, NULL, 3, NULL, 1, 5, 4, -40, 125, 0, 103000000, 0, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\_Education\\5 курс\\Белобжеский\\Диплом Алины\\_Сбор датчиков\\_bdsensors.ru\\hu300.pdf', NULL, NULL, 0, 0, 0),
(33, 'DMP 333', NULL, 35, 109, NULL, 'мм', 140, 'бар', 0, 600, 'бар', 0.35, '4..20 мА', '12..36 В', '', 'C', NULL, NULL, '', NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -25, 125, 0, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(38, 'UltraHeat 2WR', 112, 80, 88, NULL, 'мм', NULL, 'г', 0, 3, 'куб.м./ч', 0.1, '30 мА', '30 В', 'IP54', 'C', NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -20, 60, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(53, 'DMP 334', NULL, NULL, NULL, NULL, 'мм', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(54, 'TMP100', NULL, NULL, NULL, NULL, 'мм', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(56, 'TMP100', NULL, NULL, NULL, NULL, 'мм', NULL, NULL, -60, 150, '°C', 3, 'I2C Serial 2-Wire', '2.7V to 5.5V', NULL, 'C', NULL, NULL, NULL, NULL, 24, 4, NULL, 6, 7, NULL, 0, 7, 9, -60, 150, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Новая папка\\tmp100(1).pdf', NULL, NULL, 3, 0, 0),
(70, 'TMP100-EP', NULL, NULL, NULL, NULL, 'мм', NULL, NULL, -55, 125, '°C', 3, 'I2C Serial 2-Wire', '2.7V to 5.5V', NULL, 'C', NULL, NULL, NULL, NULL, 24, 4, NULL, 6, 7, NULL, 1, 7, 9, -55, 125, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Новая папка\\tmp100(1).pdf', NULL, NULL, 3, 0, 0),
(71, 'РУК', NULL, NULL, NULL, NULL, 'мм', NULL, NULL, 275, 275, NULL, 20, NULL, NULL, NULL, 'C', NULL, NULL, 'Реле предназначено для контроля уровня жидкостей в колодцах канализации.', NULL, 20, 5, NULL, NULL, 9, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, 0, 1),
(111, 'DS1820', 5, 10, 50, 5, 'мм', 40, 'С', -55, 125, '°C', 2, NULL, '5', NULL, 'C', NULL, NULL, NULL, NULL, 24, 4, NULL, 6, 15, NULL, 0, 13, 10, -55, 125, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0),
(121, 'HIH-4000', 3, 5, 20, 5, 'мм', 20, 'г', 0, 100, '%', 4, NULL, '5', NULL, 'C', NULL, NULL, NULL, NULL, 38, 5, NULL, NULL, NULL, NULL, 0, 7, 16, -40, 85, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 0),
(130, 'Турбинные расходомеры Kobold DRB-R', NULL, NULL, NULL, NULL, 'мм', 2, 'кг', 30, 750, 'л/мин', 3, '4 - 20 мA', NULL, NULL, 'C', NULL, NULL, NULL, NULL, 30, 4, NULL, 3, 14, NULL, 0, 17, NULL, NULL, NULL, 30, 750, 0, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0),
(141, 'ФЛА 003', 41, NULL, NULL, 50, 'мм', 310, 'г', 0, 100, 'кВт/м2', 6, NULL, '5', NULL, 'C', NULL, NULL, 'Предназначен для одноразового измерения ПЛТП, поступающего в его ТВЭ', NULL, 46, 5, NULL, NULL, 16, NULL, 0, 13, 26, -40, 50, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, 0),
(145, '38 DLPlus', 211, 125, 46, NULL, 'мм', 1, 'кг', 0, 635, 'мм', NULL, NULL, 'От батареи или сети', NULL, 'C', NULL, NULL, 'Предназначен для различных задач, связанных с измерением толщины материала, как в полевых условиях, так и на производстве. Может работать при повышенной влажности, грязи, холоде, жаре, ярком свете или недостаточной освещенности.\nОбрезиненный корпус.', NULL, 39, 4, NULL, 6, NULL, NULL, 0, 21, 21, -10, 50, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(163, 'MG2', 152, 84, 40, NULL, 'мм', 340, 'г', 0, 635, 'мм', NULL, NULL, 'АА х3', NULL, 'C', NULL, NULL, 'Для измерения остаточной толщины труб, резервуаров и др. подверженных внутренней коррозии.\nКомпактный и доступный по цене.\nБлагодаря малому весу и размеру можно управлять одной рукой.', NULL, 39, 4, NULL, 6, NULL, NULL, NULL, 21, 21, -20, 50, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(168, '25 DLPlus', 238, 138, 38, NULL, 'мм', 1, 'кг', 0, 500, 'мм', NULL, NULL, '6В аккумулятор или АА батарейки', NULL, 'C', NULL, NULL, 'Работает с большим количеством материалов.\n', NULL, 39, 4, 0, 6, 0, NULL, 0, 21, 21, -10, 50, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(211, 'AWM5101VA', 32, 36, 163, NULL, 'мм', NULL, NULL, 0, 5000, 'см3/мин ', 3, '5 мВ', '8,0…15,0', NULL, 'C', NULL, NULL, NULL, NULL, 10, 5, NULL, NULL, 17, NULL, 0, 13, 10, -20, 70, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Новая папка\\AWM5000.pdf', NULL, NULL, 3, 0, 0),
(220, 'АДИС 2-1', NULL, 45, 130, 37, 'мм', 450, 'г', -11, 11, 'м/с2', 0.05, NULL, '27', NULL, 'C', NULL, NULL, 'Акселерометр АДИС 2-1 предназначен для измерения линейныйх  ускорений во взлетно-посадочных режимах летательного аппарата. Принцип действия акселерометра  АДИС 2Основани на уровновешивании  силы инерции.', NULL, 63, 5, NULL, 6, 20, NULL, 0, 4, 5, -60, 70, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(227, 'Турбинные расходомеры Kobold SFL-R', NULL, NULL, NULL, NULL, 'мм', 1, 'кг', 0, 20, 'л/мин', 1, 'импульс', NULL, NULL, 'C', NULL, NULL, 'Расходомер для малых расходов модели SFL особенно подходит для работы с жидкостями, не содержащих твёрдых частиц.\n', NULL, 30, 3, NULL, NULL, 14, NULL, 0, 17, 24, 0, 90, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0),
(231, 'HIH-4010', 2, 4, 20, NULL, 'мм', 12, 'г', 0, 100, '%', 3.5, NULL, '5.8', NULL, 'C', NULL, NULL, NULL, NULL, 38, 5, 0, 0, 17, NULL, 0, 4, 36, -40, 85, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0),
(236, 'HIH-4030', 3, 4, 13, NULL, 'мм', 15, 'г', 0, 100, '%', 3.5, NULL, '5', NULL, 'C', NULL, NULL, NULL, NULL, 38, 5, 0, 0, 17, NULL, 0, 4, 36, -40, 85, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0),
(244, 'D6A-N ', 33, 9, 33, NULL, 'мм', NULL, NULL, 0, 1, 'м/с', NULL, '5.2V max', '12.0V DC', NULL, 'C', NULL, NULL, NULL, NULL, 46, 5, NULL, NULL, 23, NULL, 0, 7, 37, 0, 45, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student.K303\\Рабочий стол\\sensors\\D6AN.pdf', NULL, NULL, NULL, 0, 0),
(245, 'D6F-W01A1', 9, 20, 39, NULL, 'мм', NULL, NULL, 0, 1, 'м/с', 5, '1,0…5,0', '10,8…26,4', NULL, 'C', NULL, NULL, NULL, NULL, 46, 5, NULL, NULL, 23, NULL, 0, 7, 37, -10, 60, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student.K303\\Рабочий стол\\sensors\\D6F-W.pdf', NULL, NULL, 5, 0, 0),
(249, 'MAG3110', 1, 2, 2, NULL, 'мм', NULL, NULL, NULL, NULL, NULL, 0.1, NULL, '3,6', NULL, 'C', NULL, NULL, NULL, NULL, 69, 4, NULL, NULL, 24, NULL, 0, NULL, 35, -40, 85, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(250, 'LLE103000', 17, NULL, 250, 19, 'мм', NULL, NULL, 0, 0, NULL, NULL, '10 mA max. @ 25 °C ', '5,0…12,0', NULL, 'C', NULL, NULL, NULL, NULL, 20, 5, NULL, NULL, 17, NULL, 0, 48, 38, -20, 80, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student.K303\\Рабочий стол\\sensors\\Datasheet -- LLE103000.mht', NULL, NULL, NULL, 0, 0),
(254, 'ПДУ-И', NULL, 80, 180, 69, 'мм', NULL, NULL, 0, 2000, 'мм', NULL, NULL, '24', 'IP67', 'C', NULL, NULL, 'Магнитный поплавковый уровнемер конструктивно состоит из измерительного стержня и магнитного поплавка,перемещающегося вдоль стержня.', NULL, 20, 5, NULL, 6, 20, NULL, NULL, 37, 3, -60, 125, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(262, 'IPRM12', 90, NULL, NULL, 12, 'мм', 0, 'кг', 0, 2, 'мм', NULL, NULL, '12..30V', 'IP 67 ', 'C', NULL, NULL, NULL, NULL, 43, 5, NULL, NULL, 26, NULL, 0, 17, NULL, 0, 60, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Sensors\\IPRM_12I9505_S14_web_EN.pdf', NULL, NULL, NULL, 0, 0),
(271, 'D6B-2', 4, 6, 6, NULL, 'мм', NULL, NULL, NULL, NULL, NULL, NULL, 'горизонтальное положение- 0,5 В,,,наклонное положение 0,5 В', '2,7 … 3,3 В ', NULL, 'C', NULL, NULL, NULL, NULL, 71, 5, NULL, NULL, 23, NULL, 0, 36, 35, -10, 60, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Sensors\\D6B.pdf', NULL, NULL, NULL, 0, 0),
(272, 'D7E-3', 23, 30, 36, NULL, 'мм', NULL, NULL, NULL, NULL, NULL, NULL, 'from 0.1mA at 5VDC to', '5...30VDC', 'IP67', 'C', NULL, NULL, NULL, NULL, 71, 5, NULL, NULL, 23, NULL, 0, 37, NULL, -25, 60, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Sensors\\D7E-3.pdf', NULL, NULL, NULL, 0, 0),
(273, 'Z4D-B01', 35, 14, 16, NULL, 'мм', NULL, NULL, 0, 6, 'мм', 2, '0,2 … UПИТ-0,3 В', '4,5 … 5,5 В', NULL, 'C', NULL, NULL, NULL, NULL, 81, 5, NULL, NULL, 23, NULL, 0, 48, 41, -10, 65, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Новая папка\\Z4D-B01.pdf', NULL, NULL, 2, 0, 0),
(283, 'IWRM 12Z', NULL, NULL, 60, 12, 'мм', 0, 'кг', 0, 4, 'мм', 0.01, NULL, '15..30V', 'IP 67', 'C', NULL, NULL, NULL, NULL, 43, 5, NULL, NULL, 26, NULL, 0, 17, NULL, -10, 70, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Sensors\\IWRM_12Z8704_S14C_web_EN.pdf', NULL, NULL, 0, 0, 0),
(288, 'ADS-A', 60, 26, 224, NULL, 'мм', 0, 'кг', 0, 3000, 'мм', 0.1, NULL, '24..240V', 'IP 50 ', 'C', NULL, NULL, NULL, NULL, 43, 2, NULL, NULL, 27, NULL, 0, 48, NULL, -20, 50, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\Documents and Settings\\student\\Рабочий стол\\Sensors\\K-54~60(ADS-A).pdf', NULL, NULL, 0, 0, 0),
(304, 'БДЛУ 2-3', 60, 20, 50, NULL, 'мм', 400, 'г', 25, 45, 'м/с2	', 0.05, NULL, '12', NULL, 'C', NULL, NULL, '\n', NULL, 63, 4, 0, 6, 8, NULL, 0, 4, 5, -60, 60, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(314, 'расходомер DPE', NULL, NULL, NULL, NULL, 'мм', 1, 'кг', 50, 750, 'л/мин', 2.5, NULL, NULL, 'IP 65', 'C', NULL, NULL, NULL, NULL, 30, 3, NULL, NULL, 14, NULL, 0, 17, 24, 0, 80, 50, 750, 1, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0),
(319, 'FR M12 DC', NULL, NULL, 75, 12, 'мм', NULL, NULL, 5, NULL, 'м', 10, '150mA', '10-30 В', 'IP67', 'C', NULL, NULL, 'Оптический датчик для применения в промышленном оборудовании, предназначен для контроля положения и расстояния в различных технологических условиях.', NULL, 81, 2, NULL, NULL, NULL, NULL, 0, 42, 38, -25, 55, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0, 0),
(353, 'SEN OP Q45VR3', 44, 54, 88, NULL, 'мм', NULL, NULL, 60, NULL, 'м', NULL, '5A', '12-250 В  DC', 'IP67', 'C', NULL, NULL, 'Оптический датчик для применения в промышленном оборудовании, предназначен для контроля положения и расстояния в различных технологических условиях', NULL, 81, 2, NULL, NULL, NULL, NULL, 0, 42, 38, -25, 55, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(359, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(366, 'ADXL103CE', 2, 5, 5, NULL, 'мм', 1, 'г', -1.7, 1.7, 'g', 0.06, NULL, '3…6 vdc', NULL, 'C', 'upload/picture/ID-366_2021-01-20_02-26-12.jpg', 'upload/blueprint/ID-366_2021-01-20_02-26-12.jpg', 'Корпус CLCC8, Диапазон измерения ±1.7g/±5g/±18 g', 'upload/scheme/ID-366_2021-01-20_02-26-12.png', 63, 0, 0, 0, 34, NULL, NULL, 0, 0, -40, 125, NULL, NULL, NULL, NULL, 30000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 0),
(367, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Похоже даже это', NULL, 'круто рабо', NULL, NULL, 'тест тест', NULL, 9, 0, 0, 0, 0, NULL, NULL, 0, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 0),
(368, 'CR18-8DP', 20, 18, 75, NULL, 'мм', 72, 'гр', 0, 5.6, 'мм', NULL, NULL, '10-30V', 'IP66', 'С', 'upload/picture/ID-368_2021-05-18_20-16-46.png', 'upload/blueprint/ID-368_2021-05-18_20-16-46.png', NULL, NULL, 81, 0, 0, 0, 27, NULL, NULL, 4, 5, -25, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 0),
(369, 'CR30-15DN', 50, 42, 71, NULL, 'мм', 212, 'гр', 0, 10.5, 'мм', NULL, NULL, '10-30V', 'IP65', 'С', 'upload/picture/ID-369_2021-05-18_20-20-01.png', 'upload/blueprint/ID-369_2021-05-18_20-20-01.png', NULL, NULL, 81, 0, 0, 0, 27, NULL, NULL, 4, 5, -25, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 0),
(370, 'PR08-1,5DN', 30, 15, 15, NULL, 'мм', 36, 'гр', 0, 1.5, 'мм', NULL, NULL, '10-30V', 'IP67', 'С', 'upload/picture/ID-370_2021-05-18_20-23-46.png', 'upload/blueprint/ID-370_2021-05-18_20-23-46.png', NULL, NULL, 81, 0, 0, 0, 27, NULL, NULL, 17, 35, -20, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 0),
(371, 'QRD1114', 4.65, 6.1, 4.49, NULL, 'мм', 0.28, 'гр', 0, 12.5, 'мм', NULL, NULL, '5V', NULL, 'С', 'upload/picture/ID-371_2021-05-18_20-28-12.png', 'upload/blueprint/ID-371_2021-05-18_20-28-12.png', NULL, NULL, 81, 0, 2, 3, 35, NULL, NULL, 0, 38, -40, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 0),
(372, 'UNDK10', 14, 27, 10, NULL, 'мм', 4, 'гр', 10, 200, 'мм', NULL, NULL, '12-30V', 'IP67', 'С', 'upload/picture/ID-372_2021-05-18_20-30-38.png', 'upload/blueprint/ID-372_2021-05-18_20-30-38.png', NULL, NULL, 81, 5, 0, 6, 26, NULL, NULL, 21, 21, -10, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `sensors_in_devices`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `sensors_in_devices`;
CREATE TABLE `sensors_in_devices` (
  `device_id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sensor_application_sphere`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `sensor_application_sphere`;
CREATE TABLE `sensor_application_sphere` (
  `sensor_id` int(11) NOT NULL,
  `application_sphere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sensor_application_sphere`
--

INSERT INTO `sensor_application_sphere` (`sensor_id`, `application_sphere_id`) VALUES
(31, 2),
(41, 2),
(42, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(52, 2),
(58, 2),
(61, 2),
(64, 2),
(65, 2),
(67, 2),
(71, 2),
(81, 2),
(90, 2),
(149, 2),
(154, 2),
(206, 2),
(211, 2),
(212, 2),
(214, 2),
(215, 2),
(216, 2),
(217, 2),
(223, 2),
(226, 2),
(227, 2),
(240, 2),
(242, 2),
(271, 2),
(272, 2),
(273, 2),
(289, 2),
(291, 2),
(292, 2),
(293, 2),
(294, 2),
(295, 2),
(296, 2),
(297, 2),
(298, 2),
(299, 2),
(300, 2),
(301, 2),
(302, 2),
(313, 2),
(314, 2),
(318, 2),
(321, 2),
(323, 2),
(325, 2),
(328, 2),
(331, 2),
(335, 2),
(338, 2),
(339, 2),
(52, 6),
(65, 6),
(203, 6),
(208, 6),
(246, 6),
(248, 6),
(250, 6),
(251, 6),
(252, 6),
(253, 6),
(254, 6),
(255, 6),
(256, 6),
(259, 6),
(271, 6),
(272, 6),
(273, 6),
(313, 6),
(318, 6),
(323, 6),
(325, 6),
(328, 6),
(331, 6),
(335, 6),
(338, 6),
(339, 6),
(30, 7),
(57, 7),
(137, 7),
(208, 7),
(314, 7),
(30, 8),
(57, 8),
(59, 8),
(244, 8),
(245, 8),
(24, 9),
(30, 9),
(31, 9),
(69, 9),
(73, 9),
(90, 9),
(142, 9),
(211, 9),
(223, 9),
(225, 9),
(226, 9),
(227, 9),
(229, 9),
(240, 9),
(243, 9),
(244, 9),
(245, 9),
(30, 10),
(58, 10),
(211, 10),
(223, 10),
(229, 10),
(234, 10),
(240, 10),
(243, 10),
(246, 10),
(250, 10),
(303, 10),
(24, 14),
(31, 14),
(58, 14),
(211, 14),
(229, 14),
(242, 14),
(243, 14),
(246, 14),
(248, 14),
(250, 14),
(251, 14),
(252, 14),
(47, 20),
(79, 20),
(209, 20),
(212, 20),
(216, 20),
(217, 20),
(304, 20),
(305, 20),
(306, 20),
(307, 20),
(308, 20),
(309, 20),
(310, 20),
(311, 20),
(151, 26),
(155, 26),
(170, 26),
(202, 26),
(205, 26),
(211, 26),
(240, 26),
(242, 26),
(243, 26),
(248, 26),
(252, 26),
(150, 61),
(208, 61),
(223, 61),
(248, 61),
(250, 61),
(251, 61),
(252, 61),
(254, 61),
(255, 61),
(256, 61),
(258, 61),
(259, 61),
(261, 61),
(277, 61),
(278, 61),
(279, 61),
(280, 61),
(313, 61),
(318, 61),
(323, 61),
(325, 61),
(328, 61),
(331, 61),
(335, 61),
(338, 61),
(339, 61);

-- --------------------------------------------------------

--
-- Структура таблицы `sensor_environment`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `sensor_environment`;
CREATE TABLE `sensor_environment` (
  `sensor_id` int(11) NOT NULL,
  `environment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sensor_environment`
--

INSERT INTO `sensor_environment` (`sensor_id`, `environment_id`) VALUES
(30, 2),
(31, 2),
(41, 2),
(44, 2),
(46, 2),
(47, 2),
(58, 2),
(65, 2),
(79, 2),
(114, 2),
(150, 2),
(154, 2),
(206, 2),
(208, 2),
(212, 2),
(214, 2),
(215, 2),
(216, 2),
(217, 2),
(218, 2),
(223, 2),
(225, 2),
(226, 2),
(227, 2),
(293, 2),
(294, 2),
(295, 2),
(296, 2),
(297, 2),
(298, 2),
(299, 2),
(301, 2),
(302, 2),
(314, 2),
(317, 2),
(321, 2),
(30, 3),
(30, 4),
(57, 4),
(24, 5),
(30, 5),
(31, 5),
(33, 5),
(74, 5),
(227, 5),
(254, 5),
(24, 7),
(30, 7),
(31, 7),
(223, 7),
(227, 7),
(257, 7),
(24, 8),
(30, 8),
(31, 8),
(41, 8),
(42, 8),
(44, 8),
(45, 8),
(47, 8),
(51, 8),
(52, 8),
(58, 8),
(59, 8),
(61, 8),
(65, 8),
(67, 8),
(69, 8),
(71, 8),
(74, 8),
(75, 8),
(76, 8),
(78, 8),
(94, 8),
(142, 8),
(147, 8),
(150, 8),
(154, 8),
(203, 8),
(206, 8),
(208, 8),
(212, 8),
(214, 8),
(215, 8),
(216, 8),
(217, 8),
(218, 8),
(223, 8),
(225, 8),
(226, 8),
(227, 8),
(246, 8),
(248, 8),
(250, 8),
(251, 8),
(252, 8),
(253, 8),
(254, 8),
(255, 8),
(256, 8),
(257, 8),
(258, 8),
(259, 8),
(260, 8),
(261, 8),
(263, 8),
(277, 8),
(278, 8),
(279, 8),
(280, 8),
(293, 8),
(294, 8),
(295, 8),
(296, 8),
(297, 8),
(298, 8),
(299, 8),
(301, 8),
(302, 8),
(314, 8),
(317, 8),
(321, 8),
(24, 9),
(46, 9),
(79, 9),
(138, 9),
(139, 9),
(140, 9),
(142, 9),
(146, 9),
(149, 9),
(150, 9),
(154, 9),
(155, 9),
(170, 9),
(220, 9),
(221, 9),
(222, 9),
(223, 9),
(224, 9),
(225, 9),
(227, 9),
(233, 9),
(244, 9),
(245, 9),
(303, 9),
(304, 9),
(305, 9),
(306, 9),
(307, 9),
(308, 9),
(309, 9),
(310, 9),
(311, 9),
(90, 11),
(234, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `sensor_literature`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `sensor_literature`;
CREATE TABLE `sensor_literature` (
  `sensor_id` int(11) NOT NULL,
  `literature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sensor_literature`
--

INSERT INTO `sensor_literature` (`sensor_id`, `literature_id`) VALUES
(30, 1),
(30, 2),
(31, 4),
(31, 6),
(41, 6),
(24, 7),
(24, 8),
(51, 9),
(52, 9),
(57, 9),
(59, 9),
(61, 9),
(67, 9),
(69, 9),
(71, 9),
(73, 9),
(74, 9),
(75, 9),
(76, 9),
(78, 9),
(87, 9),
(114, 9),
(123, 9),
(125, 9),
(138, 9),
(139, 9),
(140, 9),
(146, 9),
(149, 9),
(151, 9),
(155, 9),
(170, 9),
(234, 9),
(262, 9),
(264, 9),
(265, 9),
(266, 9),
(268, 9),
(269, 9),
(270, 9),
(281, 9),
(282, 9),
(283, 9),
(284, 9),
(285, 9),
(286, 9),
(287, 9),
(288, 9),
(179, 12),
(192, 12),
(193, 12),
(195, 12),
(198, 12),
(199, 12),
(202, 12),
(205, 12),
(207, 12),
(209, 12),
(213, 12),
(220, 12),
(221, 12),
(222, 12),
(224, 12),
(233, 12),
(303, 12),
(304, 12),
(305, 12),
(306, 12),
(307, 12),
(308, 12),
(309, 12),
(310, 12),
(311, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `sensor_type`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `sensor_type`;
CREATE TABLE `sensor_type` (
  `sensor_type_id` int(11) NOT NULL,
  `measurable_value_id` int(11) DEFAULT NULL,
  `sensor_type_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sensor_type`
--

INSERT INTO `sensor_type` (`sensor_type_id`, `measurable_value_id`, `sensor_type_name`) VALUES
(9, 3, 'Абсолютного давления'),
(10, 3, 'Избыточного давления'),
(20, 34, 'Уровня'),
(24, 6, 'Температуры'),
(30, 17, 'Расхода'),
(38, 16, 'Влажности'),
(39, 15, 'Размера и толщины'),
(43, 19, 'Перемещения'),
(46, 22, 'Скорости потока'),
(63, 4, 'Ускорения'),
(69, 29, 'Магнитного поля'),
(71, 30, 'Наклона'),
(81, 32, 'Положения и расстояния'),
(82, 35, 'Угла поворота');

-- --------------------------------------------------------

--
-- Структура таблицы `signal_conversation`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `signal_conversation`;
CREATE TABLE `signal_conversation` (
  `signal_conversation_id` int(11) NOT NULL,
  `signal_conversation_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signal_conversation_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `signal_conversation`
--

INSERT INTO `signal_conversation` (`signal_conversation_id`, `signal_conversation_name`, `signal_conversation_description`) VALUES
(3, 'ЦАП', 'Преобразует цифровой код в аналоговую величину.'),
(6, 'АЦП', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `status_list`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `status_list`;
CREATE TABLE `status_list` (
  `status` int(11) NOT NULL,
  `status_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status_list`
--

INSERT INTO `status_list` (`status`, `status_name`, `status_description`) VALUES
(1, 'Студент', 'Только просмотр'),
(2, 'Студент-разработчик', 'Добавление и редактирование добавленных изделий'),
(3, 'Разработчик', 'Редактирование любых изделий'),
(4, 'Преподаватель', 'Редактирование данных пользователей и их уровня доступа'),
(5, 'Администратор', 'Полный спектр возможностей, не может быть изменен другим пользователем');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Фев 25 2021 г., 17:31
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `status`, `surname`, `name`, `patronymic`, `email`, `regDate`) VALUES
(1, 'admin', 'novell', 5, NULL, NULL, NULL, NULL, '1930-03-20 00:00:00'),
(2, 'yaroslav', 'yaroslav', 2, 'Баранов', 'Ярослав', 'Вячеславовович', 'bar051098@bk.ru', '2020-09-30 09:30:00'),
(3, 'artem', 'artem', 2, 'Губин ', 'Артем', 'Андреевич', 'zertalls@mail.ru', '2020-09-30 09:30:00'),
(4, 'evgen', 'evgen', 2, 'Дашковский', 'Евгений', 'Алексеевич', 'evgeniy230197@mail.ru', '2020-09-30 09:30:00'),
(5, 'vadim', 'vadim', 2, 'Жосану', 'Вадим', 'Анатольевич', 'vadim14067@yandex.ru', '2020-09-30 09:30:00'),
(6, 'eldar', 'eldar', 2, 'Исмаилов', 'Эльдар', 'Гасанович', 'ehl7665@icloud.com', '2020-09-30 09:30:00'),
(7, 'ayaz', 'ayaz', 3, 'Салихов', 'Аяз', 'Рустэмович', 'salikhov.a.r@outlook.com', '1961-04-12 06:07:00'),
(8, 'pavel', 'pavel', 2, 'Синицкий', 'Павел', 'Юрьевич', 'pashka-sinii@yandex.ru', '2020-09-30 09:30:00'),
(9, 'danil', 'danil', 2, 'Юдин', 'Данил', 'Александрович', 'bullmastif@mail.ru', '2020-09-30 09:30:00'),
(10, 'test', 'qwerty', 1, 'test', 'test', 'test', '', '2021-03-02 06:30:42'),
(11, 'dezisque', 'qwerty', 3, 'Aderkin', 'Ivan', 'Aleksandrovich', 'dzsq1337@yandex.ru', '2021-04-22 13:24:18'),
(12, 'ViktorKhramkin', '071299ViteK', 3, 'Храмкин', 'Виктор', 'Олегович', 'vitek9@bk.ru', '2021-04-22 13:25:11'),
(13, 'VanGaghi', '4164079i', 3, 'Матяш', 'Игорь', 'Олегович', 'matyash.1998@mail.ru', '2021-04-22 13:28:50'),
(14, 'Vlad', 'gvozdkovazinaidaalexandrovna20', 3, 'Зеленцов', 'Владислав', 'Романович', 'zelentsov99@yandex.ru', '2021-04-22 13:29:47'),
(15, 'alex', '144Alex144', 3, 'Цвенгер', 'Александр', 'Сергеевич', 'tsvenger.alexander@gmail.com', '2021-04-22 13:34:17'),
(16, 'Taloonys', 'max626999', 3, 'Макроусов', 'Вадим', 'Александрович', 'werwolf200071@yandex.ru', '2021-04-22 13:35:07'),
(17, 'Lait', 'RyzM1999', 3, 'Рыжов', 'Михаил', 'Владимирович', 'mikhail.ryzhov.99@mail.ru', '2021-05-14 11:58:36'),
(18, 'Hexecutor', 'Bor1882818Bor', 3, 'Бородачев', 'Дмитрий', 'Андреевич', 'borodachev.58@yandex.ru', '2021-05-16 20:27:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application_sphere`
--
ALTER TABLE `application_sphere`
  ADD PRIMARY KEY (`application_sphere_id`);

--
-- Индексы таблицы `changes_info`
--
ALTER TABLE `changes_info`
  ADD PRIMARY KEY (`change_id`);

--
-- Индексы таблицы `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `FK_Aviation_Devices_Dev_Dop_Param1` (`id_devdop`),
  ADD KEY `FK_Aviation_Devices_AvDev_Type` (`device_type_id`),
  ADD KEY `FK_Aviation_Devices_AvDev_Purpose` (`device_purpose_id`),
  ADD KEY `FK_Aviation_Devices_AvDev_MeasureShowType` (`measure_show_type_id`),
  ADD KEY `FK_Aviation_Devices_AvDev_ControlType` (`control_type_id`),
  ADD KEY `FK_Aviation_Devices_Princip_deystviya` (`operation_principle_id`),
  ADD KEY `FK_Aviation_Devices_Proizvoditel` (`producer_id`);

--
-- Индексы таблицы `device_application_sphere`
--
ALTER TABLE `device_application_sphere`
  ADD PRIMARY KEY (`application_sphere_id`,`device_id`),
  ADD KEY `FK_AvDev_Obl_Aviation_Devices` (`device_id`);

--
-- Индексы таблицы `device_control_type`
--
ALTER TABLE `device_control_type`
  ADD PRIMARY KEY (`control_type_id`);

--
-- Индексы таблицы `device_environment`
--
ALTER TABLE `device_environment`
  ADD PRIMARY KEY (`device_id`,`environment_id`),
  ADD KEY `FK_Sreda_AvDev_Sreda` (`environment_id`);

--
-- Индексы таблицы `device_literature`
--
ALTER TABLE `device_literature`
  ADD PRIMARY KEY (`device_id`,`literature_id`),
  ADD KEY `FK_AvDev_Lit_Literature` (`literature_id`);

--
-- Индексы таблицы `device_measurable_value`
--
ALTER TABLE `device_measurable_value`
  ADD PRIMARY KEY (`measurable_value_id`,`device_id`),
  ADD KEY `FK_AvDev_IzmerVelichina_Aviation_Devices` (`device_id`);

--
-- Индексы таблицы `device_measure_show_type`
--
ALTER TABLE `device_measure_show_type`
  ADD PRIMARY KEY (`measure_show_type_id`);

--
-- Индексы таблицы `device_purpose`
--
ALTER TABLE `device_purpose`
  ADD PRIMARY KEY (`device_purpose_id`);

--
-- Индексы таблицы `device_type`
--
ALTER TABLE `device_type`
  ADD PRIMARY KEY (`device_type_id`);

--
-- Индексы таблицы `environment`
--
ALTER TABLE `environment`
  ADD PRIMARY KEY (`environment_id`);

--
-- Индексы таблицы `literature`
--
ALTER TABLE `literature`
  ADD PRIMARY KEY (`literature_id`);

--
-- Индексы таблицы `manufacturing_technology`
--
ALTER TABLE `manufacturing_technology`
  ADD PRIMARY KEY (`manufacturing_technology_id`);

--
-- Индексы таблицы `measurable_value`
--
ALTER TABLE `measurable_value`
  ADD PRIMARY KEY (`measurable_value_id`);

--
-- Индексы таблицы `operation_principle`
--
ALTER TABLE `operation_principle`
  ADD PRIMARY KEY (`operation_principle_id`);

--
-- Индексы таблицы `output_signal`
--
ALTER TABLE `output_signal`
  ADD PRIMARY KEY (`output_signal_id`);

--
-- Индексы таблицы `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`producer_id`);

--
-- Индексы таблицы `sensitive_element`
--
ALTER TABLE `sensitive_element`
  ADD PRIMARY KEY (`sensitive_element_id`);

--
-- Индексы таблицы `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`sensor_id`),
  ADD KEY `FK_Datchik_Proizvoditel` (`producer_id`),
  ADD KEY `FK_Datchik_Sens_element` (`sensitive_element_id`),
  ADD KEY `FK_Datchik_Haracter_preobr_signala` (`signal_conversation_id`),
  ADD KEY `FK_Datchik_Princip_deystviya` (`operation_principle_id`),
  ADD KEY `FK_Datchik_Tehn_izg` (`manufacturing_technology_id`),
  ADD KEY `FK_Datchik_Tip_datchika` (`sensor_type_id`),
  ADD KEY `FK_Datchik_Vih_signal` (`output_signal_id`),
  ADD KEY `FK_Datchik_Sensor_Dop_Param` (`id_dopparam`);

--
-- Индексы таблицы `sensors_in_devices`
--
ALTER TABLE `sensors_in_devices`
  ADD KEY `device_id` (`device_id`),
  ADD KEY `sensor_id` (`sensor_id`);

--
-- Индексы таблицы `sensor_application_sphere`
--
ALTER TABLE `sensor_application_sphere`
  ADD PRIMARY KEY (`sensor_id`,`application_sphere_id`),
  ADD KEY `FK_Dat_Obl_Oblast_prim` (`application_sphere_id`);

--
-- Индексы таблицы `sensor_environment`
--
ALTER TABLE `sensor_environment`
  ADD PRIMARY KEY (`sensor_id`,`environment_id`),
  ADD KEY `FK_Dat_Sreda_Sreda` (`environment_id`);

--
-- Индексы таблицы `sensor_literature`
--
ALTER TABLE `sensor_literature`
  ADD PRIMARY KEY (`sensor_id`,`literature_id`),
  ADD KEY `FK_Dat_Lit_Literature` (`literature_id`);

--
-- Индексы таблицы `sensor_type`
--
ALTER TABLE `sensor_type`
  ADD PRIMARY KEY (`sensor_type_id`),
  ADD KEY `FK_Tip_datchika_Izmer_velichina` (`measurable_value_id`);

--
-- Индексы таблицы `signal_conversation`
--
ALTER TABLE `signal_conversation`
  ADD PRIMARY KEY (`signal_conversation_id`);

--
-- Индексы таблицы `status_list`
--
ALTER TABLE `status_list`
  ADD PRIMARY KEY (`status`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application_sphere`
--
ALTER TABLE `application_sphere`
  MODIFY `application_sphere_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `changes_info`
--
ALTER TABLE `changes_info`
  MODIFY `change_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Номер изменения', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `device_control_type`
--
ALTER TABLE `device_control_type`
  MODIFY `control_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `device_measure_show_type`
--
ALTER TABLE `device_measure_show_type`
  MODIFY `measure_show_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `device_purpose`
--
ALTER TABLE `device_purpose`
  MODIFY `device_purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `device_type`
--
ALTER TABLE `device_type`
  MODIFY `device_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `environment`
--
ALTER TABLE `environment`
  MODIFY `environment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `literature`
--
ALTER TABLE `literature`
  MODIFY `literature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `manufacturing_technology`
--
ALTER TABLE `manufacturing_technology`
  MODIFY `manufacturing_technology_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `measurable_value`
--
ALTER TABLE `measurable_value`
  MODIFY `measurable_value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `operation_principle`
--
ALTER TABLE `operation_principle`
  MODIFY `operation_principle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `output_signal`
--
ALTER TABLE `output_signal`
  MODIFY `output_signal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `producer`
--
ALTER TABLE `producer`
  MODIFY `producer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `sensitive_element`
--
ALTER TABLE `sensitive_element`
  MODIFY `sensitive_element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `sensors`
--
ALTER TABLE `sensors`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор', AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT для таблицы `sensor_type`
--
ALTER TABLE `sensor_type`
  MODIFY `sensor_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT для таблицы `signal_conversation`
--
ALTER TABLE `signal_conversation`
  MODIFY `signal_conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `status_list`
--
ALTER TABLE `status_list`
  MODIFY `status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
