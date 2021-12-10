-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-12-2021 a las 14:34:09
-- Versión del servidor: 8.0.27-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Tortas', NULL, 'tortas', '2021-08-27 10:35:49', '2021-08-27 10:35:49'),
(2, 'Galletas', NULL, 'galletas', '2021-08-27 11:41:27', '2021-08-27 11:41:27'),
(3, 'Tacos', NULL, 'tacos', '2021-08-27 11:44:33', '2021-08-27 11:44:33'),
(4, 'Helados', NULL, 'helados', '2021-08-27 11:56:43', '2021-08-27 11:56:43'),
(5, 'Frutas', NULL, 'frutas', '2021-12-10 19:26:22', '2021-12-10 19:26:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `province_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `province_id`, `name`, `type`, `postal_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Arequipa', 'Ciudad', '04000', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `percentage` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `due_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `percentage`, `amount`, `due_date`, `created_at`, `updated_at`) VALUES
(1, 'Cuponcito La Salle', 'LASALLE2021', 50, NULL, '2021-12-31 23:59:00', '2021-11-25 10:34:35', '2021-12-08 12:39:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupon_product`
--

CREATE TABLE `coupon_product` (
  `id` bigint UNSIGNED NOT NULL,
  `coupon_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `coupon_product`
--

INSERT INTO `coupon_product` (`id`, `coupon_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 1, 1, NULL, NULL),
(4, 1, 4, NULL, NULL),
(6, 1, 2, NULL, NULL),
(7, 1, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `activate_token` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `email`, `password`, `phone_number`, `activate_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Olva Courier', 'olva_courier@gmail.com', '$2y$10$J/TYRuDkAmjVW2WllZi07uVN8Fxi37XkHcI.wL0jvutJr0q0fPWBC', '+01 714 0909', 'lSIcTj5zKU4DKd5bCr4cR2635b3FTP', 1, '2021-11-03 03:47:48', NULL),
(2, 'Shalom', 'shalom@gmail.com', '$2y$10$mz4v5FFKPrh5m3SFWkzweuvat33xe/F91mu/wuQQSbNm8H/ku7QYK', '(01) 5007878', 'xNw75LlsWSw0ebG3gIzPKI8iNKgNyY', 1, '2021-11-04 15:50:22', '2021-11-04 15:50:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `activate_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone_number`, `address`, `district_id`, `activate_token`, `status`, `created_at`, `updated_at`) VALUES
(16, 'Daniel Mendiguri', 'dmendiguric@ulasalle.edu.pe', '$2y$10$q7hx9AjXbA6/qHfPJ4VbTOiifSPLmSq5WA/7sn5LHEsMw5eruHb02', '958555555', 'Calle El Guri 666', 1, 'vzG6nFBVGWC3ORUIagE3ibzuqkg3MN', 0, '2021-08-27 13:01:11', '2021-08-27 13:01:11'),
(17, 'Daniela Vilchez', 'dvilchezs@ulasalle.edu.pe', '$2y$10$lGvH0sVEisom07dw.nRDv.TT2IlKtfriB/71sv0L9U8IZ/jfnNgRa', '969696969', 'Calle La Dani 777', 1, NULL, 1, '2021-09-10 05:39:23', '2021-10-01 09:12:53'),
(18, 'Daniel MDeveloper', 'crazydani.developer@gmail.com', '$2y$10$J/TYRuDkAmjVW2WllZi07uVN8Fxi37XkHcI.wL0jvutJr0q0fPWBC', '999666771', 'Calle El Guri 699', 1, 'oY9Ng1S4v7yEJDXmei7Nr8QoSY8mbD', 1, '2021-09-30 18:09:05', '2021-10-19 12:35:39'),
(27, 'Maribel Quiroz 2', 'mquirozp1@ulasalle.edu.pe', '$2y$10$i6bbDdYA2kdJ4lf0brebN.c.sn4NpRELhon0Z7OvZhzeycipvz2wm', '958555555', 'Otra calle', 1, 'orejHJbQIwEsrKNruw4XYqmczfNin6', 0, '2021-10-01 08:59:53', '2021-10-01 08:59:53'),
(28, 'Otra persona', 'otrapersona@gmail.com', '$2y$10$u1y/V37dA6cqbflS3K.xj.kU855Wj88gzINRLpvcQfU8tvNUKb1Bm', '958555555', 'Otra calle 2', 1, '9bwxAcxLFi6UPkk4bN6IXt1JnlJl1b', 0, '2021-10-01 09:03:03', '2021-10-01 09:03:03'),
(29, 'NuevoUsuario', 'nuevo_usuario12334514@gmail.com', '$2y$10$cCM2wXr8FGKpxq/HEePf5uDuo1D4Vg9DCESGy1h3yo33Xgme1WJaq', '22222221', 'Otra Calle 102', 1, 'LMwvVFFNZsygh9soBzUKAzHMbq3hDH', 0, '2021-10-13 09:11:56', '2021-10-13 09:11:56'),
(30, 'Otro Daniel', 'otrodaniel@gmail.com', '$2y$10$lGvH0sVEisom07dw.nRDv.TT2IlKtfriB/71sv0L9U8IZ/jfnNgRa', '54524352542', 'Calle El otro Guri 666', 1, 'lSIcTj5zKU4DKd5bCr4cR2635b3FTP', 1, '2021-10-18 17:55:21', '2021-10-18 17:56:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_product`
--

CREATE TABLE `customer_product` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customer_product`
--

INSERT INTO `customer_product` (`id`, `customer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(7, 17, 6, NULL, NULL),
(9, 17, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery_guys`
--

CREATE TABLE `delivery_guys` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `activate_token` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `courier_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `delivery_guys`
--

INSERT INTO `delivery_guys` (`id`, `name`, `email`, `password`, `phone_number`, `activate_token`, `status`, `courier_id`, `created_at`, `updated_at`) VALUES
(1, 'Juanito Pérez', 'juanitoperez@gmail.com', '$2y$10$J/TYRuDkAmjVW2WllZi07uVN8Fxi37XkHcI.wL0jvutJr0q0fPWBC', '+51 956785433', 'lSIcTj5zKU4DKd5bCr4cR2635b3FTP', 1, 1, '2021-11-04 03:21:33', NULL),
(2, 'Ramón Sancho Panza', 'sanchopanza@gmail.com', '$2y$10$J/TYRuDkAmjVW2WllZi07uVN8Fxi37XkHcI.wL0jvutJr0q0fPWBC', '+51 958785991', 'lSIcTj5zKU4DKd5bCr4cR2635b3FTP', 1, 1, '2021-11-04 03:21:43', NULL),
(3, 'Raul Mercedes', 'raul_mercedes@gmail.com', '$2y$10$IqrAesM7YzTgWSaq/GreUumRF9rLE3Zm1hADd3ADBSCUcUzQaHzPC', '+51 982222222', 'InrgKCYHvB0YLwnhsmmrRfbCeDcn4x', 1, 1, '2021-11-04 15:27:40', '2021-11-04 15:28:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `percentage` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `percentage`, `amount`, `due_date`, `created_at`, `updated_at`) VALUES
(1, 'Descuento Galleta Charada', 12, NULL, '2021-12-01 21:25:00', '2021-11-18 02:27:13', '2021-11-24 15:34:07'),
(2, 'equis somos chavos', NULL, 3, '2021-12-04 21:29:00', '2021-11-18 02:29:44', '2021-12-10 08:35:38'),
(6, 'Fiesta de tacos uwu', NULL, 2, '2021-12-03 23:41:00', '2021-11-18 16:43:26', '2021-12-08 12:32:13'),
(7, 'Descuento en todos los productos seleccionados', 20, NULL, '2021-12-01 16:11:00', '2021-11-19 09:12:10', '2021-12-08 17:17:47'),
(8, 'Black Friday', 30, NULL, '2021-12-31 15:36:00', '2021-11-26 08:36:43', '2021-12-08 11:44:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount_product`
--

CREATE TABLE `discount_product` (
  `id` bigint UNSIGNED NOT NULL,
  `discount_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `discount_product`
--

INSERT INTO `discount_product` (`id`, `discount_id`, `product_id`, `created_at`, `updated_at`) VALUES
(6, 2, 4, NULL, NULL),
(7, 1, 2, NULL, NULL),
(8, 6, 4, NULL, NULL),
(9, 8, 3, NULL, NULL),
(11, 6, 5, NULL, NULL),
(13, 7, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `districts`
--

CREATE TABLE `districts` (
  `id` bigint UNSIGNED NOT NULL,
  `province_id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `districts`
--

INSERT INTO `districts` (`id`, `province_id`, `city_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Arequipa', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `free_for_packs`
--

CREATE TABLE `free_for_packs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `due_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `free_for_packs`
--

INSERT INTO `free_for_packs` (`id`, `name`, `type`, `due_date`, `created_at`, `updated_at`) VALUES
(1, '3x2 en Helados', '3x2', '2021-12-31 01:38:00', '2021-11-25 18:38:37', '2021-11-25 18:38:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `free_for_pack_product`
--

CREATE TABLE `free_for_pack_product` (
  `id` bigint UNSIGNED NOT NULL,
  `free_for_pack_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `free_for_pack_product`
--

INSERT INTO `free_for_pack_product` (`id`, `free_for_pack_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_23_024436_create_categories_table', 1),
(5, '2020_07_23_024458_create_products_table', 1),
(6, '2020_07_23_024514_create_customers_table', 1),
(7, '2020_07_23_024535_create_provinces_table', 1),
(8, '2020_07_23_024554_create_cities_table', 1),
(9, '2020_07_23_024619_create_districts_table', 1),
(10, '2020_07_23_024639_create_orders_table', 1),
(11, '2020_07_23_024700_create_order_details_table', 1),
(12, '2020_07_25_072946_add_field_status_to_products_table', 1),
(13, '2020_07_25_090116_create_jobs_table', 1),
(14, '2020_07_29_021244_add_field_password_to_customers_table', 1),
(15, '2021_09_16_084132_create_customers_products_table', 2),
(16, '2021_09_16_084132_create_customer_product_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `subtotal` float NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'confirmed',
  `courier_id` bigint UNSIGNED DEFAULT NULL,
  `delivery_guy_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `invoice`, `customer_id`, `customer_name`, `customer_phone`, `customer_address`, `district_id`, `subtotal`, `status`, `courier_id`, `delivery_guy_id`, `created_at`, `updated_at`) VALUES
(1, 'k14b-1630023078', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:11:18', '2021-08-27 12:11:18'),
(2, 'Htt1-1630023189', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:13:09', '2021-08-27 12:13:09'),
(3, 'jjYe-1630023273', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:14:33', '2021-08-27 12:14:33'),
(4, 'lABn-1630023755', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:22:35', '2021-08-27 12:22:35'),
(5, 'DB6W-1630024300', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:31:40', '2021-08-27 12:31:40'),
(6, 'rbQZ-1630024399', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:33:19', '2021-08-27 12:33:19'),
(7, 'jDi0-1630024968', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:42:48', '2021-08-27 12:42:48'),
(8, 'X4ST-1630025138', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:45:38', '2021-08-27 12:45:38'),
(9, 'NGwU-1630025182', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:46:22', '2021-08-27 12:46:22'),
(10, 'AREA-1630025587', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 12:53:07', '2021-08-27 12:53:07'),
(11, 'PMAF-1630026071', '16', 'Daniel Mendiguri', '958555555', 'Calle El Guri 666', 1, 4, 'confirmed', 1, NULL, '2021-08-27 13:01:11', '2021-08-27 13:01:11'),
(12, '1LPk-1631209163', '17', 'Daniela Vilchez', '988666666', 'Calle La Dani 666', 1, 42, 'confirmed', 1, NULL, '2021-09-10 05:39:23', '2021-09-10 05:39:23'),
(13, 'ENPd-1633015390', '18', 'Daniel M', '999666777', 'Calle El Guri 699', 1, 12, 'confirmed', 1, NULL, '2021-10-01 03:23:10', '2021-10-01 03:23:10'),
(14, 'wJyU-1633035593', '27', 'Maribel Quiroz 2', '958555555', 'Otra calle', 1, 17, 'confirmed', 1, NULL, '2021-10-01 08:59:53', '2021-10-01 08:59:53'),
(15, 'mXER-1633035783', '28', 'Otra persona', '958555555', 'Otra calle 2', 1, 70, 'confirmed', 1, NULL, '2021-10-01 09:03:03', '2021-10-01 09:03:03'),
(16, 'fgB8-1634076216', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-13 10:03:36', '2021-10-13 10:03:36'),
(17, 'L8Ig-1634081603', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-13 11:33:23', '2021-10-13 11:33:23'),
(18, '4eU5-1634083180', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-13 11:59:40', '2021-10-13 11:59:40'),
(19, 'rp2T-1634083238', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-13 12:00:38', '2021-10-13 12:00:38'),
(20, 'oUCW-1634083264', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-13 12:01:04', '2021-10-13 12:01:04'),
(21, '1C87-1634083273', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-13 12:01:13', '2021-10-13 12:01:13'),
(22, 'xoqu-1634083314', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-13 12:01:54', '2021-10-13 12:01:54'),
(23, '6jup-1634083499', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-13 12:04:59', '2021-10-13 12:04:59'),
(24, 'qoHC-1634083705', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-13 12:08:25', '2021-10-13 12:08:25'),
(25, 'Fs5n-1634084038', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 5, 'confirmed', 1, NULL, '2021-10-13 12:13:58', '2021-10-13 12:13:58'),
(26, 'D6Uk-1634084538', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 12, 'confirmed', 1, NULL, '2021-10-13 12:22:18', '2021-10-13 12:22:18'),
(27, 'dOKn-1634085068', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-13 12:31:08', '2021-10-13 12:31:08'),
(28, 'ygfQ-1634085172', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-13 12:32:52', '2021-10-13 12:32:52'),
(29, 'Eh9l-1634088508', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 30, 'confirmed', 1, NULL, '2021-10-13 13:28:28', '2021-10-13 13:28:28'),
(30, 'iMjL-1634088813', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 24, 'confirmed', 1, NULL, '2021-10-13 13:33:33', '2021-10-13 13:33:33'),
(31, 'brER-1634090838', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 10, 'confirmed', 1, NULL, '2021-10-13 14:07:18', '2021-10-13 14:07:18'),
(32, '3EpK-1634164044', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 14, 'confirmed', 1, NULL, '2021-10-14 10:27:24', '2021-10-14 10:27:24'),
(33, 'V1ny-1634164148', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 14, 'confirmed', 1, NULL, '2021-10-14 10:29:08', '2021-10-14 10:29:08'),
(34, 'P5Ef-1634164272', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 5, 'confirmed', 1, NULL, '2021-10-14 10:31:12', '2021-10-14 10:31:12'),
(35, 'BGkE-1634164557', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:35:57', '2021-10-14 10:35:57'),
(36, '0XUn-1634164858', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:40:58', '2021-10-14 10:40:58'),
(37, 'oW5S-1634165140', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:45:40', '2021-10-14 10:45:40'),
(38, 'fZZ0-1634165178', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:46:18', '2021-10-14 10:46:18'),
(39, 'wDCl-1634165205', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:46:45', '2021-10-14 10:46:45'),
(40, 'Vibz-1634165213', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:46:53', '2021-10-14 10:46:53'),
(41, 'xQbg-1634165252', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:47:32', '2021-10-14 10:47:32'),
(42, 'rrO8-1634165390', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:49:50', '2021-10-14 10:49:50'),
(43, 'OyT9-1634165574', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:52:54', '2021-10-14 10:52:54'),
(44, 'diM4-1634165641', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 404, 'confirmed', 1, NULL, '2021-10-14 10:54:01', '2021-10-14 10:54:01'),
(45, 'lLbP-1634165981', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 10:59:41', '2021-10-14 10:59:41'),
(46, 'O1BL-1634166761', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 11:12:41', '2021-10-14 11:12:41'),
(47, '9teQ-1634168170', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 11:36:10', '2021-10-14 11:36:10'),
(48, 'WQlz-1634169066', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 11:51:06', '2021-10-14 11:51:06'),
(49, 'kScd-1634169183', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 11:53:03', '2021-10-14 11:53:03'),
(50, 'NvG6-1634169290', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 11:54:50', '2021-10-14 11:54:50'),
(51, 'JCZT-1634169365', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 11:56:05', '2021-10-14 11:56:05'),
(52, '9xbt-1634169748', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:02:28', '2021-10-14 12:02:28'),
(53, 'wr5B-1634169777', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:02:57', '2021-10-14 12:02:57'),
(54, 'UtSx-1634169992', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:06:32', '2021-10-14 12:06:32'),
(55, 'x03T-1634170286', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:11:26', '2021-10-14 12:11:26'),
(56, 'kYEA-1634170548', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:15:48', '2021-10-14 12:15:48'),
(57, 'Xoqy-1634170673', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:17:53', '2021-10-14 12:17:53'),
(58, '2MHn-1634170727', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:18:47', '2021-10-14 12:18:47'),
(59, 'PyJG-1634170815', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:20:15', '2021-10-14 12:20:15'),
(60, 'iwVd-1634170885', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-14 12:21:25', '2021-10-14 12:21:25'),
(61, 'd5cp-1634178650', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 12, 'confirmed', 1, NULL, '2021-10-14 14:30:50', '2021-10-14 14:30:50'),
(62, 'H32u-1634603189', '18', 'Daniel MDeveloper', '999666777', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-19 12:26:29', '2021-10-19 12:26:29'),
(63, 'qK2S-1634603828', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 15, 'confirmed', 1, NULL, '2021-10-19 12:37:08', '2021-10-19 12:37:08'),
(64, 'QRie-1635307606', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 16:06:46', '2021-10-27 16:06:46'),
(65, '7M7y-1635309473', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 16:37:53', '2021-10-27 16:37:53'),
(66, 'yq0l-1635309679', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 16:41:20', '2021-10-27 16:41:20'),
(67, 'NBLl-1635309826', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 5, 'confirmed', 1, NULL, '2021-10-27 16:43:46', '2021-10-27 16:43:46'),
(68, 'EJpL-1635310232', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 12, 'confirmed', 1, NULL, '2021-10-27 16:50:32', '2021-10-27 16:50:32'),
(69, 'y6LQ-1635310508', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 16:55:08', '2021-10-27 16:55:08'),
(70, 'Ikaa-1635310712', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 16:58:32', '2021-10-27 16:58:32'),
(71, 'DOqE-1635310786', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 16:59:46', '2021-10-27 16:59:46'),
(72, 'T3LP-1635312260', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 17:24:20', '2021-10-27 17:24:20'),
(73, 'Pp2x-1635312314', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 17:25:14', '2021-10-27 17:25:14'),
(74, 'sYhV-1635312537', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 30, 'confirmed', 1, NULL, '2021-10-27 17:28:57', '2021-10-27 17:28:57'),
(75, 'AtE7-1635312630', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 17:30:30', '2021-10-27 17:30:30'),
(76, '5aN7-1635312713', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 17:31:53', '2021-10-27 17:31:53'),
(77, 'EMpE-1635312825', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 17:33:45', '2021-10-27 17:33:45'),
(78, 'oJuN-1635312980', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 17:36:20', '2021-10-27 17:36:20'),
(79, 'wMcq-1635313338', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 17:42:18', '2021-10-27 17:42:18'),
(80, 'uQWt-1635313456', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 17:44:16', '2021-10-27 17:44:16'),
(81, '9N1q-1635313654', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-10-27 17:47:34', '2021-10-27 17:47:34'),
(83, 'Fb4e-1635314020', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 17:53:40', '2021-10-27 17:53:40'),
(84, 'VkQO-1635314274', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-10-27 17:57:54', '2021-10-27 17:57:54'),
(85, 'zENZ-1635314390', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-10-27 17:59:50', '2021-10-27 17:59:50'),
(86, 'nVtm-1635314497', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 31, 'confirmed', 1, NULL, '2021-10-27 18:01:37', '2021-10-27 18:01:37'),
(87, 'Qnnv-1635314573', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'delivery_received', 1, 1, '2021-10-27 18:02:53', '2021-11-05 09:08:55'),
(88, 'ppCj-1635366769', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 5, 'picked_by_courier', 1, 2, '2021-10-28 08:32:49', '2021-11-04 11:34:11'),
(89, 'Hs9W-1635904018', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 10, 'ready_for_pick_up', 1, 2, '2021-11-03 13:46:58', '2021-11-04 12:55:47'),
(90, 'C5F0-1635904408', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'delivery_received', 1, 1, '2021-11-03 13:53:28', '2021-11-04 16:21:44'),
(91, '2mDu-1637728383', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 9.4, 'confirmed', 1, NULL, '2021-11-24 16:33:03', '2021-11-24 16:33:03'),
(92, '7537-1637729231', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 3.2, 'confirmed', 1, NULL, '2021-11-24 16:47:11', '2021-11-24 16:47:11'),
(93, 'pzZM-1637729343', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 3.2, 'confirmed', 1, NULL, '2021-11-24 16:49:03', '2021-11-24 16:49:03'),
(94, '5u4Z-1637729365', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 3.2, 'confirmed', 1, NULL, '2021-11-24 16:49:25', '2021-11-24 16:49:25'),
(95, 'IkWM-1637729623', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 3.2, 'confirmed', 1, NULL, '2021-11-24 16:53:43', '2021-11-24 16:53:43'),
(96, 'VdNp-1637729728', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 3.2, 'confirmed', 1, NULL, '2021-11-24 16:55:28', '2021-11-24 16:55:28'),
(97, 'NCmk-1637730209', '17', 'Daniela Vilchez', '969696969', 'Calle La Dani 777', 1, 3, 'confirmed', 1, NULL, '2021-11-24 17:03:29', '2021-11-24 17:03:29'),
(98, 'TSIt-1637730303', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6.2, 'confirmed', 1, NULL, '2021-11-24 17:05:03', '2021-11-24 17:05:03'),
(99, '3KUo-1637730446', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6.2, 'confirmed', 1, NULL, '2021-11-24 17:07:26', '2021-11-24 17:07:26'),
(100, 'jUJl-1637730647', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6.2, 'confirmed', 1, NULL, '2021-11-24 17:10:47', '2021-11-24 17:10:47'),
(101, 'Y9lu-1637731048', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6.2, 'confirmed', 1, NULL, '2021-11-24 17:17:28', '2021-11-24 17:17:28'),
(102, 'BFnx-1637732284', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 11.2, 'confirmed', 1, NULL, '2021-11-24 17:38:04', '2021-11-24 17:38:04'),
(103, 'LuSn-1637732970', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 9.28, 'confirmed', 1, NULL, '2021-11-24 17:49:30', '2021-11-24 17:49:30'),
(104, 'oL9J-1637733129', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 5.28, 'confirmed', 1, NULL, '2021-11-24 17:52:09', '2021-11-24 17:52:09'),
(105, 'X7M8-1637813617', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 19, 'confirmed', 1, NULL, '2021-11-25 16:13:37', '2021-11-25 16:13:37'),
(106, 'djrT-1637813822', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 19, 'confirmed', 1, NULL, '2021-11-25 16:17:02', '2021-11-25 16:17:02'),
(107, 'JI0K-1637813881', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 19, 'confirmed', 1, NULL, '2021-11-25 16:18:01', '2021-11-25 16:18:01'),
(108, '9j4q-1637814028', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 19, 'confirmed', 1, NULL, '2021-11-25 16:20:28', '2021-11-25 16:20:28'),
(109, 'U7Ij-1637814450', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 19, 'confirmed', 1, NULL, '2021-11-25 16:27:30', '2021-11-25 16:27:30'),
(110, 'Cwbo-1637814614', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 19, 'confirmed', 1, NULL, '2021-11-25 16:30:14', '2021-11-25 16:30:14'),
(111, 'WRQF-1637815296', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 16:41:36', '2021-11-25 16:41:36'),
(112, 'kPOZ-1637815408', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 16:43:28', '2021-11-25 16:43:28'),
(113, 'AqVG-1637815708', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 16:48:28', '2021-11-25 16:48:28'),
(114, 'FN3p-1637816351', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 16:59:11', '2021-11-25 16:59:11'),
(115, 'lSkV-1637816625', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 17:03:45', '2021-11-25 17:03:45'),
(116, 'lA7v-1637816719', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 7, 'confirmed', 1, NULL, '2021-11-25 17:05:19', '2021-11-25 17:05:19'),
(117, '7iX5-1637817324', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 17:15:24', '2021-11-25 17:15:24'),
(118, 'xBZE-1637817371', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 17:16:11', '2021-11-25 17:16:11'),
(119, 'RbK0-1637817457', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-11-25 17:17:37', '2021-11-25 17:17:37'),
(120, 'Nt6C-1637817878', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 17:24:38', '2021-11-25 17:24:38'),
(121, 'cN6H-1637818013', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-11-25 17:26:53', '2021-11-25 17:26:53'),
(122, 'sdW0-1637847208', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-11-26 01:33:28', '2021-11-26 01:33:28'),
(123, 'VZ0u-1637851603', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 20, 'confirmed', 1, NULL, '2021-11-26 02:46:43', '2021-11-26 02:46:43'),
(124, 'FoPQ-1637851703', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 20, 'confirmed', 1, NULL, '2021-11-26 02:48:23', '2021-11-26 02:48:23'),
(125, 'VAFG-1637851754', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 20, 'confirmed', 1, NULL, '2021-11-26 02:49:14', '2021-11-26 02:49:14'),
(126, 'qrjQ-1637851838', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 02:50:38', '2021-11-26 02:50:38'),
(127, 'WpEW-1637851928', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 02:52:08', '2021-11-26 02:52:08'),
(128, 'xqh2-1637852098', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 02:54:58', '2021-11-26 02:54:58'),
(129, '3oKl-1637852326', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 02:58:46', '2021-11-26 02:58:46'),
(130, 'OlfG-1637852538', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 03:02:18', '2021-11-26 03:02:18'),
(131, '3Xud-1637852726', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 03:05:26', '2021-11-26 03:05:26'),
(132, 'lgZ7-1637853013', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 03:10:13', '2021-11-26 03:10:13'),
(133, 'kJ2V-1637853100', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-11-26 03:11:40', '2021-11-26 03:11:40'),
(134, '21Fc-1638897903', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2, 'confirmed', 1, NULL, '2021-12-08 05:25:03', '2021-12-08 05:25:03'),
(158, 'iSjE-1638899872', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 05:57:52', '2021-12-08 05:57:52'),
(159, 'cHNs-1638899919', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 05:58:39', '2021-12-08 05:58:39'),
(160, 'cBql-1638900074', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:01:14', '2021-12-08 06:01:14'),
(161, 'wi28-1638900136', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:02:16', '2021-12-08 06:02:16'),
(162, 'WsJb-1638900215', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:03:35', '2021-12-08 06:03:35'),
(163, 'tXAX-1638900318', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:05:18', '2021-12-08 06:05:18'),
(188, 'GeRI-1638900668', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:11:08', '2021-12-08 06:11:08'),
(189, 'JxMn-1638900943', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:15:43', '2021-12-08 06:15:43'),
(190, 'CXc4-1638902059', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:34:19', '2021-12-08 06:34:19'),
(191, 'oMZZ-1638902174', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:36:14', '2021-12-08 06:36:14'),
(192, 'wiJd-1638903214', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 3.2, 'confirmed', 1, NULL, '2021-12-08 06:53:34', '2021-12-08 06:53:34'),
(193, 'sP7S-1638922385', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2.5, 'confirmed', 1, NULL, '2021-12-08 12:13:05', '2021-12-08 12:13:05'),
(194, 'oDpD-1638923305', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 2.5, 'confirmed', 1, NULL, '2021-12-08 12:28:25', '2021-12-08 12:28:25'),
(195, '8IYP-1638923604', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4.5, 'confirmed', 1, NULL, '2021-12-08 12:33:24', '2021-12-08 12:33:24'),
(196, 'HW1j-1638924161', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 8, 'confirmed', 1, NULL, '2021-12-08 12:42:41', '2021-12-08 12:42:41'),
(197, '3gZY-1638929667', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-12-08 14:14:27', '2021-12-08 14:14:27'),
(198, 'lv1D-1638929813', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-12-08 14:16:53', '2021-12-08 14:16:53'),
(199, 'zsSI-1638929906', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-12-08 14:18:26', '2021-12-08 14:18:26'),
(200, 'iXFS-1638929993', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-12-08 14:19:53', '2021-12-08 14:19:53'),
(201, 'sevk-1638930128', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-12-08 14:22:08', '2021-12-08 14:22:08'),
(202, '3BwD-1638930259', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-12-08 14:24:19', '2021-12-08 14:24:19'),
(203, 'QMfv-1639082250', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 6, 'confirmed', 1, NULL, '2021-12-10 08:37:30', '2021-12-10 08:37:30'),
(204, 'neft-1639096199', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 5, 'confirmed', 1, NULL, '2021-12-10 12:29:59', '2021-12-10 12:29:59'),
(205, 'lArb-1639096243', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 5, 'confirmed', 1, NULL, '2021-12-10 12:30:43', '2021-12-10 12:30:43'),
(206, '6Pzt-1639096409', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 5, 'confirmed', 1, NULL, '2021-12-10 12:33:29', '2021-12-10 12:33:29'),
(207, 'vJE1-1639096752', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-12-10 12:39:12', '2021-12-10 12:39:12'),
(208, 'YARq-1639096856', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-12-10 12:40:56', '2021-12-10 12:40:56'),
(209, 'LvE7-1639096953', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-12-10 12:42:33', '2021-12-10 12:42:33'),
(210, 'HOMT-1639097098', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'confirmed', 1, NULL, '2021-12-10 12:44:58', '2021-12-10 12:44:58'),
(211, 'fLXJ-1639139933', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:38:53', '2021-12-10 19:38:53'),
(212, 'lLXJ-1639140252', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:12', '2021-12-10 19:44:12'),
(213, 'D9bu-1639140256', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:16', '2021-12-10 19:44:16'),
(214, 'FDoe-1639140259', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:19', '2021-12-10 19:44:19'),
(215, '0aHe-1639140263', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:23', '2021-12-10 19:44:23'),
(216, '9MeQ-1639140266', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:26', '2021-12-10 19:44:26'),
(217, 'vdRJ-1639140270', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:30', '2021-12-10 19:44:30'),
(218, 'jyaW-1639140274', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:34', '2021-12-10 19:44:34'),
(219, 'w3Gn-1639140277', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:37', '2021-12-10 19:44:37'),
(220, 'Ifl5-1639140281', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:41', '2021-12-10 19:44:41'),
(221, 'p3Kt-1639140284', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:44', '2021-12-10 19:44:44'),
(222, '8b4q-1639140287', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:47', '2021-12-10 19:44:47'),
(223, 'QE60-1639140291', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:51', '2021-12-10 19:44:51'),
(224, 'aaiX-1639140295', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:55', '2021-12-10 19:44:55'),
(225, '7uRW-1639140298', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:44:58', '2021-12-10 19:44:58'),
(226, 'qUui-1639140307', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:45:07', '2021-12-10 19:45:07'),
(227, 'N4Tv-1639140310', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:45:10', '2021-12-10 19:45:10'),
(228, 'STLB-1639140314', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:45:14', '2021-12-10 19:45:14'),
(229, 'i0zH-1639140328', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:45:28', '2021-12-10 19:45:28'),
(230, 'c9hJ-1639140426', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:47:06', '2021-12-10 19:47:06'),
(231, 'Proy-1639140626', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 1, 'confirmed', 1, NULL, '2021-12-10 19:50:26', '2021-12-10 19:50:26'),
(232, '4MWI-1639142988', '18', 'Daniel MDeveloper', '999666771', 'Calle El Guri 699', 1, 4, 'ready_for_pick_up', 1, 1, '2021-12-10 20:29:48', '2021-12-10 21:28:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  `weight` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `qty`, `weight`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 4, 1, 300, '2021-08-27 12:11:18', '2021-08-27 12:11:18'),
(2, 2, 5, 4, 1, 300, '2021-08-27 12:13:09', '2021-08-27 12:13:09'),
(3, 3, 5, 4, 1, 300, '2021-08-27 12:14:33', '2021-08-27 12:14:33'),
(4, 4, 5, 4, 1, 300, '2021-08-27 12:22:35', '2021-08-27 12:22:35'),
(5, 5, 5, 4, 1, 300, '2021-08-27 12:31:40', '2021-08-27 12:31:40'),
(6, 6, 5, 4, 1, 300, '2021-08-27 12:33:19', '2021-08-27 12:33:19'),
(7, 7, 5, 4, 1, 300, '2021-08-27 12:42:48', '2021-08-27 12:42:48'),
(8, 8, 5, 4, 1, 300, '2021-08-27 12:45:38', '2021-08-27 12:45:38'),
(9, 9, 5, 4, 1, 300, '2021-08-27 12:46:22', '2021-08-27 12:46:22'),
(10, 10, 5, 4, 1, 300, '2021-08-27 12:53:07', '2021-08-27 12:53:07'),
(11, 11, 5, 4, 1, 300, '2021-08-27 13:01:11', '2021-08-27 13:01:11'),
(12, 12, 5, 4, 3, 300, '2021-09-10 05:39:23', '2021-09-10 05:39:23'),
(13, 12, 4, 6, 5, 300, '2021-09-10 05:39:23', '2021-09-10 05:39:23'),
(14, 13, 6, 4, 3, 250, '2021-10-01 03:23:10', '2021-10-01 03:23:10'),
(15, 14, 6, 4, 3, 250, '2021-10-01 08:59:53', '2021-10-01 08:59:53'),
(16, 14, 1, 5, 1, 300, '2021-10-01 08:59:53', '2021-10-01 08:59:53'),
(17, 15, 1, 5, 14, 300, '2021-10-01 09:03:03', '2021-10-01 09:03:03'),
(18, 16, 6, 4, 1, 250, '2021-10-13 10:03:36', '2021-10-13 10:03:36'),
(19, 17, 6, 4, 1, 250, '2021-10-13 11:33:23', '2021-10-13 11:33:23'),
(20, 18, 5, 4, 1, 300, '2021-10-13 11:59:40', '2021-10-13 11:59:40'),
(21, 19, 5, 4, 1, 300, '2021-10-13 12:00:38', '2021-10-13 12:00:38'),
(22, 20, 5, 4, 1, 300, '2021-10-13 12:01:04', '2021-10-13 12:01:04'),
(23, 21, 5, 4, 1, 300, '2021-10-13 12:01:13', '2021-10-13 12:01:13'),
(24, 22, 5, 4, 1, 300, '2021-10-13 12:01:54', '2021-10-13 12:01:54'),
(25, 23, 4, 6, 1, 300, '2021-10-13 12:04:59', '2021-10-13 12:04:59'),
(26, 24, 3, 6, 1, 300, '2021-10-13 12:08:25', '2021-10-13 12:08:25'),
(27, 25, 1, 5, 1, 300, '2021-10-13 12:13:58', '2021-10-13 12:13:58'),
(28, 26, 3, 6, 2, 300, '2021-10-13 12:22:18', '2021-10-13 12:22:18'),
(29, 27, 2, 6, 1, 300, '2021-10-13 12:31:08', '2021-10-13 12:31:08'),
(30, 28, 3, 6, 1, 300, '2021-10-13 12:32:52', '2021-10-13 12:32:52'),
(31, 29, 4, 6, 5, 300, '2021-10-13 13:28:28', '2021-10-13 13:28:28'),
(32, 30, 3, 6, 4, 300, '2021-10-13 13:33:33', '2021-10-13 13:33:33'),
(33, 31, 6, 4, 1, 250, '2021-10-13 14:07:18', '2021-10-13 14:07:18'),
(34, 31, 2, 6, 1, 300, '2021-10-13 14:07:18', '2021-10-13 14:07:18'),
(35, 32, 6, 4, 2, 250, '2021-10-14 10:27:24', '2021-10-14 10:27:24'),
(36, 32, 4, 6, 1, 300, '2021-10-14 10:27:24', '2021-10-14 10:27:24'),
(37, 33, 6, 4, 2, 250, '2021-10-14 10:29:08', '2021-10-14 10:29:08'),
(38, 33, 4, 6, 1, 300, '2021-10-14 10:29:08', '2021-10-14 10:29:08'),
(39, 34, 1, 5, 1, 300, '2021-10-14 10:31:12', '2021-10-14 10:31:12'),
(40, 35, 5, 4, 1, 300, '2021-10-14 10:35:57', '2021-10-14 10:35:57'),
(41, 36, 5, 4, 1, 300, '2021-10-14 10:40:58', '2021-10-14 10:40:58'),
(42, 37, 5, 4, 1, 300, '2021-10-14 10:45:40', '2021-10-14 10:45:40'),
(43, 38, 5, 4, 1, 300, '2021-10-14 10:46:18', '2021-10-14 10:46:18'),
(44, 39, 5, 4, 1, 300, '2021-10-14 10:46:45', '2021-10-14 10:46:45'),
(45, 40, 5, 4, 1, 300, '2021-10-14 10:46:53', '2021-10-14 10:46:53'),
(46, 41, 5, 4, 1, 300, '2021-10-14 10:47:32', '2021-10-14 10:47:32'),
(47, 42, 5, 4, 1, 300, '2021-10-14 10:49:50', '2021-10-14 10:49:50'),
(48, 43, 5, 4, 1, 300, '2021-10-14 10:52:54', '2021-10-14 10:52:54'),
(49, 44, 6, 4, 101, 250, '2021-10-14 10:54:01', '2021-10-14 10:54:01'),
(50, 45, 5, 4, 1, 300, '2021-10-14 10:59:41', '2021-10-14 10:59:41'),
(51, 46, 6, 4, 1, 250, '2021-10-14 11:12:41', '2021-10-14 11:12:41'),
(52, 47, 6, 4, 1, 250, '2021-10-14 11:36:10', '2021-10-14 11:36:10'),
(53, 48, 6, 4, 1, 250, '2021-10-14 11:51:06', '2021-10-14 11:51:06'),
(54, 49, 6, 4, 1, 250, '2021-10-14 11:53:03', '2021-10-14 11:53:03'),
(55, 50, 6, 4, 1, 250, '2021-10-14 11:54:50', '2021-10-14 11:54:50'),
(56, 51, 6, 4, 1, 250, '2021-10-14 11:56:05', '2021-10-14 11:56:05'),
(57, 52, 6, 4, 1, 250, '2021-10-14 12:02:28', '2021-10-14 12:02:28'),
(58, 53, 6, 4, 1, 250, '2021-10-14 12:02:57', '2021-10-14 12:02:57'),
(59, 54, 6, 4, 1, 250, '2021-10-14 12:06:32', '2021-10-14 12:06:32'),
(60, 55, 6, 4, 1, 250, '2021-10-14 12:11:26', '2021-10-14 12:11:26'),
(61, 56, 5, 4, 1, 300, '2021-10-14 12:15:48', '2021-10-14 12:15:48'),
(62, 57, 5, 4, 1, 300, '2021-10-14 12:17:53', '2021-10-14 12:17:53'),
(63, 58, 5, 4, 1, 300, '2021-10-14 12:18:47', '2021-10-14 12:18:47'),
(64, 59, 5, 4, 1, 300, '2021-10-14 12:20:15', '2021-10-14 12:20:15'),
(65, 60, 5, 4, 1, 300, '2021-10-14 12:21:25', '2021-10-14 12:21:25'),
(66, 61, 2, 6, 2, 300, '2021-10-14 14:30:50', '2021-10-14 14:30:50'),
(67, 62, 6, 4, 1, 250, '2021-10-19 12:26:29', '2021-10-19 12:26:29'),
(68, 63, 1, 5, 3, 300, '2021-10-19 12:37:08', '2021-10-19 12:37:08'),
(69, 64, 6, 4, 1, 250, '2021-10-27 16:06:46', '2021-10-27 16:06:46'),
(70, 65, 6, 4, 1, 250, '2021-10-27 16:37:53', '2021-10-27 16:37:53'),
(71, 66, 5, 4, 1, 300, '2021-10-27 16:41:20', '2021-10-27 16:41:20'),
(72, 67, 1, 5, 1, 300, '2021-10-27 16:43:46', '2021-10-27 16:43:46'),
(73, 68, 4, 6, 2, 300, '2021-10-27 16:50:32', '2021-10-27 16:50:32'),
(74, 69, 3, 6, 1, 300, '2021-10-27 16:55:08', '2021-10-27 16:55:08'),
(75, 70, 2, 6, 1, 300, '2021-10-27 16:58:32', '2021-10-27 16:58:32'),
(76, 71, 4, 6, 1, 300, '2021-10-27 16:59:46', '2021-10-27 16:59:46'),
(77, 72, 4, 6, 1, 300, '2021-10-27 17:24:20', '2021-10-27 17:24:20'),
(78, 73, 4, 6, 1, 300, '2021-10-27 17:25:14', '2021-10-27 17:25:14'),
(79, 74, 3, 6, 5, 300, '2021-10-27 17:28:57', '2021-10-27 17:28:57'),
(80, 75, 2, 6, 1, 300, '2021-10-27 17:30:30', '2021-10-27 17:30:30'),
(81, 76, 4, 6, 1, 300, '2021-10-27 17:31:53', '2021-10-27 17:31:53'),
(82, 77, 6, 4, 1, 250, '2021-10-27 17:33:45', '2021-10-27 17:33:45'),
(83, 78, 6, 4, 1, 250, '2021-10-27 17:36:20', '2021-10-27 17:36:20'),
(84, 79, 6, 4, 1, 250, '2021-10-27 17:42:18', '2021-10-27 17:42:18'),
(85, 80, 5, 4, 1, 300, '2021-10-27 17:44:16', '2021-10-27 17:44:16'),
(86, 81, 4, 6, 1, 300, '2021-10-27 17:47:34', '2021-10-27 17:47:34'),
(87, 83, 5, 4, 1, 300, '2021-10-27 17:53:40', '2021-10-27 17:53:40'),
(88, 84, 5, 4, 2, 300, '2021-10-27 17:57:54', '2021-10-27 17:57:54'),
(89, 85, 5, 4, 1, 300, '2021-10-27 17:59:50', '2021-10-27 17:59:50'),
(90, 86, 6, 4, 1, 250, '2021-10-27 18:01:37', '2021-10-27 18:01:37'),
(91, 86, 5, 4, 1, 300, '2021-10-27 18:01:37', '2021-10-27 18:01:37'),
(92, 86, 4, 6, 1, 300, '2021-10-27 18:01:37', '2021-10-27 18:01:37'),
(93, 86, 3, 6, 1, 300, '2021-10-27 18:01:37', '2021-10-27 18:01:37'),
(94, 86, 2, 6, 1, 300, '2021-10-27 18:01:37', '2021-10-27 18:01:37'),
(95, 86, 1, 5, 1, 300, '2021-10-27 18:01:37', '2021-10-27 18:01:37'),
(96, 87, 6, 4, 1, 250, '2021-10-27 18:02:53', '2021-10-27 18:02:53'),
(97, 87, 5, 4, 1, 300, '2021-10-27 18:02:53', '2021-10-27 18:02:53'),
(98, 88, 1, 5, 1, 300, '2021-10-28 08:32:49', '2021-10-28 08:32:49'),
(99, 89, 1, 5, 2, 300, '2021-11-03 13:46:58', '2021-11-03 13:46:58'),
(100, 90, 6, 4, 1, 250, '2021-11-03 13:53:28', '2021-11-03 13:53:28'),
(101, 91, 6, 4, 2, 250, '2021-11-24 16:33:03', '2021-11-24 16:33:03'),
(102, 91, 5, 4, 1, 300, '2021-11-24 16:33:03', '2021-11-24 16:33:03'),
(103, 92, 6, 4, 1, 250, '2021-11-24 16:47:11', '2021-11-24 16:47:11'),
(104, 93, 6, 4, 1, 250, '2021-11-24 16:49:03', '2021-11-24 16:49:03'),
(105, 94, 6, 4, 1, 250, '2021-11-24 16:49:25', '2021-11-24 16:49:25'),
(106, 95, 6, 4, 1, 250, '2021-11-24 16:53:43', '2021-11-24 16:53:43'),
(107, 96, 6, 4, 1, 250, '2021-11-24 16:55:28', '2021-11-24 16:55:28'),
(108, 97, 5, 4, 1, 300, '2021-11-24 17:03:29', '2021-11-24 17:03:29'),
(109, 98, 5, 4, 1, 300, '2021-11-24 17:05:03', '2021-11-24 17:05:03'),
(110, 98, 6, 4, 1, 250, '2021-11-24 17:05:03', '2021-11-24 17:05:03'),
(111, 99, 6, 4, 1, 250, '2021-11-24 17:07:26', '2021-11-24 17:07:26'),
(112, 99, 5, 4, 1, 300, '2021-11-24 17:07:26', '2021-11-24 17:07:26'),
(113, 100, 6, 4, 1, 250, '2021-11-24 17:10:47', '2021-11-24 17:10:47'),
(114, 100, 5, 4, 1, 300, '2021-11-24 17:10:47', '2021-11-24 17:10:47'),
(115, 101, 6, 4, 1, 250, '2021-11-24 17:17:28', '2021-11-24 17:17:28'),
(116, 101, 5, 4, 1, 300, '2021-11-24 17:17:28', '2021-11-24 17:17:28'),
(117, 102, 6, 4, 1, 250, '2021-11-24 17:38:04', '2021-11-24 17:38:04'),
(118, 102, 5, 4, 1, 300, '2021-11-24 17:38:04', '2021-11-24 17:38:04'),
(119, 102, 1, 5, 1, 300, '2021-11-24 17:38:04', '2021-11-24 17:38:04'),
(120, 103, 2, 6, 1, 300, '2021-11-24 17:49:30', '2021-11-24 17:49:30'),
(121, 103, 4, 6, 1, 300, '2021-11-24 17:49:30', '2021-11-24 17:49:30'),
(122, 104, 2, 6, 1, 300, '2021-11-24 17:52:09', '2021-11-24 17:52:09'),
(123, 105, 6, 4, 8, 250, '2021-11-25 16:13:37', '2021-11-25 16:13:37'),
(124, 105, 5, 4, 1, 300, '2021-11-25 16:13:37', '2021-11-25 16:13:37'),
(125, 106, 6, 4, 8, 250, '2021-11-25 16:17:02', '2021-11-25 16:17:02'),
(126, 106, 5, 4, 1, 300, '2021-11-25 16:17:02', '2021-11-25 16:17:02'),
(127, 107, 6, 4, 8, 250, '2021-11-25 16:18:01', '2021-11-25 16:18:01'),
(128, 107, 5, 4, 1, 300, '2021-11-25 16:18:01', '2021-11-25 16:18:01'),
(129, 108, 6, 4, 8, 250, '2021-11-25 16:20:28', '2021-11-25 16:20:28'),
(130, 108, 5, 4, 1, 300, '2021-11-25 16:20:28', '2021-11-25 16:20:28'),
(131, 109, 6, 4, 8, 250, '2021-11-25 16:27:30', '2021-11-25 16:27:30'),
(132, 109, 5, 4, 1, 300, '2021-11-25 16:27:30', '2021-11-25 16:27:30'),
(133, 110, 6, 4, 8, 250, '2021-11-25 16:30:14', '2021-11-25 16:30:14'),
(134, 110, 5, 4, 1, 300, '2021-11-25 16:30:14', '2021-11-25 16:30:14'),
(135, 111, 6, 4, 1, 250, '2021-11-25 16:41:36', '2021-11-25 16:41:36'),
(136, 112, 6, 4, 1, 250, '2021-11-25 16:43:28', '2021-11-25 16:43:28'),
(137, 113, 6, 4, 1, 250, '2021-11-25 16:48:28', '2021-11-25 16:48:28'),
(138, 114, 6, 4, 1, 250, '2021-11-25 16:59:11', '2021-11-25 16:59:11'),
(139, 115, 6, 4, 1, 250, '2021-11-25 17:03:45', '2021-11-25 17:03:45'),
(140, 116, 6, 4, 2, 250, '2021-11-25 17:05:19', '2021-11-25 17:05:19'),
(141, 116, 5, 4, 1, 300, '2021-11-25 17:05:19', '2021-11-25 17:05:19'),
(142, 117, 6, 4, 1, 250, '2021-11-25 17:15:24', '2021-11-25 17:15:24'),
(143, 118, 6, 4, 1, 250, '2021-11-25 17:16:11', '2021-11-25 17:16:11'),
(144, 119, 6, 4, 2, 250, '2021-11-25 17:17:37', '2021-11-25 17:17:37'),
(145, 120, 6, 4, 1, 250, '2021-11-25 17:24:38', '2021-11-25 17:24:38'),
(146, 121, 6, 4, 1, 250, '2021-11-25 17:26:53', '2021-11-25 17:26:53'),
(147, 122, 6, 4, 2, 250, '2021-11-26 01:33:28', '2021-11-26 01:33:28'),
(148, 123, 6, 4, 3, 250, '2021-11-26 02:46:43', '2021-11-26 02:46:43'),
(149, 124, 6, 4, 3, 250, '2021-11-26 02:48:23', '2021-11-26 02:48:23'),
(150, 125, 6, 4, 3, 250, '2021-11-26 02:49:14', '2021-11-26 02:49:14'),
(151, 126, 6, 4, 3, 250, '2021-11-26 02:50:38', '2021-11-26 02:50:38'),
(152, 127, 6, 4, 3, 250, '2021-11-26 02:52:08', '2021-11-26 02:52:08'),
(153, 128, 6, 4, 3, 250, '2021-11-26 02:54:58', '2021-11-26 02:54:58'),
(154, 129, 6, 4, 3, 250, '2021-11-26 02:58:46', '2021-11-26 02:58:46'),
(155, 130, 6, 4, 3, 250, '2021-11-26 03:02:18', '2021-11-26 03:02:18'),
(156, 131, 6, 4, 3, 250, '2021-11-26 03:05:26', '2021-11-26 03:05:26'),
(157, 132, 6, 4, 3, 250, '2021-11-26 03:10:13', '2021-11-26 03:10:13'),
(158, 133, 6, 4, 3, 250, '2021-11-26 03:11:40', '2021-11-26 03:11:40'),
(159, 134, 5, 4, 1, 300, '2021-12-08 05:25:03', '2021-12-08 05:25:03'),
(160, 158, 6, 4, 1, 250, '2021-12-08 05:57:52', '2021-12-08 05:57:52'),
(161, 159, 6, 4, 1, 250, '2021-12-08 05:58:39', '2021-12-08 05:58:39'),
(162, 160, 6, 4, 1, 250, '2021-12-08 06:01:14', '2021-12-08 06:01:14'),
(163, 161, 6, 4, 1, 250, '2021-12-08 06:02:16', '2021-12-08 06:02:16'),
(164, 162, 6, 4, 1, 250, '2021-12-08 06:03:35', '2021-12-08 06:03:35'),
(165, 163, 6, 4, 1, 250, '2021-12-08 06:05:18', '2021-12-08 06:05:18'),
(166, 188, 6, 4, 1, 250, '2021-12-08 06:11:08', '2021-12-08 06:11:08'),
(167, 189, 6, 4, 1, 250, '2021-12-08 06:15:43', '2021-12-08 06:15:43'),
(168, 190, 6, 4, 1, 250, '2021-12-08 06:34:19', '2021-12-08 06:34:19'),
(169, 191, 6, 4, 1, 250, '2021-12-08 06:36:14', '2021-12-08 06:36:14'),
(170, 192, 6, 4, 1, 250, '2021-12-08 06:53:34', '2021-12-08 06:53:34'),
(171, 193, 1, 5, 1, 300, '2021-12-08 12:13:05', '2021-12-08 12:13:05'),
(172, 194, 1, 5, 1, 300, '2021-12-08 12:28:25', '2021-12-08 12:28:25'),
(173, 195, 5, 4, 1, 300, '2021-12-08 12:33:24', '2021-12-08 12:33:24'),
(174, 195, 1, 5, 1, 300, '2021-12-08 12:33:24', '2021-12-08 12:33:24'),
(175, 196, 6, 4, 3, 250, '2021-12-08 12:42:42', '2021-12-08 12:42:42'),
(176, 197, 4, 6, 1, 300, '2021-12-08 14:14:27', '2021-12-08 14:14:27'),
(177, 197, 5, 4, 1, 300, '2021-12-08 14:14:27', '2021-12-08 14:14:27'),
(178, 198, 4, 6, 1, 300, '2021-12-08 14:16:53', '2021-12-08 14:16:53'),
(179, 198, 5, 4, 1, 300, '2021-12-08 14:16:53', '2021-12-08 14:16:53'),
(180, 199, 4, 6, 1, 300, '2021-12-08 14:18:26', '2021-12-08 14:18:26'),
(181, 199, 5, 4, 1, 300, '2021-12-08 14:18:26', '2021-12-08 14:18:26'),
(182, 200, 4, 6, 1, 300, '2021-12-08 14:19:53', '2021-12-08 14:19:53'),
(183, 200, 5, 4, 1, 300, '2021-12-08 14:19:53', '2021-12-08 14:19:53'),
(184, 201, 4, 6, 1, 300, '2021-12-08 14:22:08', '2021-12-08 14:22:08'),
(185, 201, 5, 4, 1, 300, '2021-12-08 14:22:08', '2021-12-08 14:22:08'),
(186, 202, 4, 6, 1, 300, '2021-12-08 14:24:19', '2021-12-08 14:24:19'),
(187, 202, 5, 4, 1, 300, '2021-12-08 14:24:19', '2021-12-08 14:24:19'),
(188, 203, 4, 6, 2, 300, '2021-12-10 08:37:30', '2021-12-10 08:37:30'),
(189, 204, 1, 5, 1, 300, '2021-12-10 12:29:59', '2021-12-10 12:29:59'),
(190, 205, 1, 5, 1, 300, '2021-12-10 12:30:44', '2021-12-10 12:30:44'),
(191, 206, 1, 5, 1, 300, '2021-12-10 12:33:29', '2021-12-10 12:33:29'),
(192, 207, 5, 4, 1, 300, '2021-12-10 12:39:12', '2021-12-10 12:39:12'),
(193, 208, 6, 4, 1, 250, '2021-12-10 12:40:56', '2021-12-10 12:40:56'),
(194, 209, 6, 4, 1, 250, '2021-12-10 12:42:33', '2021-12-10 12:42:33'),
(195, 210, 6, 4, 1, 250, '2021-12-10 12:44:58', '2021-12-10 12:44:58'),
(196, 211, 7, 1, 1, 500, '2021-12-10 19:38:53', '2021-12-10 19:38:53'),
(197, 212, 7, 1, 1, 500, '2021-12-10 19:44:12', '2021-12-10 19:44:12'),
(198, 213, 7, 1, 1, 500, '2021-12-10 19:44:16', '2021-12-10 19:44:16'),
(199, 214, 7, 1, 1, 500, '2021-12-10 19:44:19', '2021-12-10 19:44:19'),
(200, 215, 7, 1, 1, 500, '2021-12-10 19:44:23', '2021-12-10 19:44:23'),
(201, 216, 7, 1, 1, 500, '2021-12-10 19:44:26', '2021-12-10 19:44:26'),
(202, 217, 7, 1, 1, 500, '2021-12-10 19:44:30', '2021-12-10 19:44:30'),
(203, 218, 7, 1, 1, 500, '2021-12-10 19:44:34', '2021-12-10 19:44:34'),
(204, 219, 7, 1, 1, 500, '2021-12-10 19:44:37', '2021-12-10 19:44:37'),
(205, 220, 7, 1, 1, 500, '2021-12-10 19:44:41', '2021-12-10 19:44:41'),
(206, 221, 7, 1, 1, 500, '2021-12-10 19:44:44', '2021-12-10 19:44:44'),
(207, 222, 7, 1, 1, 500, '2021-12-10 19:44:47', '2021-12-10 19:44:47'),
(208, 223, 7, 1, 1, 500, '2021-12-10 19:44:51', '2021-12-10 19:44:51'),
(209, 224, 7, 1, 1, 500, '2021-12-10 19:44:55', '2021-12-10 19:44:55'),
(210, 225, 7, 1, 1, 500, '2021-12-10 19:44:58', '2021-12-10 19:44:58'),
(211, 226, 7, 1, 1, 500, '2021-12-10 19:45:07', '2021-12-10 19:45:07'),
(212, 227, 7, 1, 1, 500, '2021-12-10 19:45:10', '2021-12-10 19:45:10'),
(213, 228, 7, 1, 1, 500, '2021-12-10 19:45:14', '2021-12-10 19:45:14'),
(214, 229, 7, 1, 1, 500, '2021-12-10 19:45:28', '2021-12-10 19:45:28'),
(215, 230, 7, 1, 1, 500, '2021-12-10 19:47:06', '2021-12-10 19:47:06'),
(216, 231, 7, 1, 1, 500, '2021-12-10 19:50:26', '2021-12-10 19:50:26'),
(217, 232, 6, 4, 1, 250, '2021-12-10 20:29:48', '2021-12-10 20:29:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `weight` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `description`, `image`, `price`, `weight`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Torta de chocolate', 'torta-de-chocolate', 1, '<p>Tortita de chocolate</p>', '1630021122torta-de-chocolate.jpg', 5, 300, 1, '2021-08-27 10:36:19', '2021-08-27 11:38:42'),
(2, 'Charadas', 'charadas', 2, '<p>Estas son unas charadas bien ricas</p>', '1630021385charadas.jpg', 6, 300, 1, '2021-08-27 11:43:05', '2021-08-27 11:43:05'),
(3, 'Torta de fresa', 'torta-de-fresa', 1, '<p>Esta es una torta de fresa</p>', '1630021443torta-de-fresa.jpg', 6, 300, 1, '2021-08-27 11:44:03', '2021-08-27 11:44:03'),
(4, 'Tacos de pollo', 'tacos-de-pollo', 3, '<p>Tacos de pollo bien ricos</p>', '1630021547tacos-de-pollo.jpg', 6, 300, 0, '2021-08-27 11:45:47', '2021-08-27 11:45:47'),
(5, 'Taquito vegetariano', 'taquito-vegetariano', 3, '<p>Taquito bien rico y vegetariano uwu</p>', '1630022334taquito-vegetariano.png', 4, 300, 0, '2021-08-27 11:58:54', '2021-09-22 10:24:22'),
(6, 'Queso Helado', 'queso-helado', 4, '<p>Rico queso helado&nbsp;arequipe&ntilde;o original con leche fresca.</p>', '1631824394queso-helado.png', 4, 250, 1, '2021-09-17 08:33:14', '2021-09-17 08:33:14'),
(7, 'Naranjas', 'naranjas', 5, '<p>Ricas naranjas frescas</p>', '1639139304naranjas.png', 1, 500, 1, '2021-12-10 19:28:24', '2021-12-10 19:28:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Arequipa', NULL, NULL),
(2, 'Lima', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Daniel Mendiguri', 'dmendiguric@ulasalle.edu.pe', NULL, '$2y$10$un0fLoIKGVZslHKzrLCuxeIgUfYaomjyRj2LielGFj5gLJuNRzWzK', NULL, '2021-08-27 10:34:35', '2021-08-27 10:34:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indices de la tabla `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `district_id` (`district_id`);

--
-- Indices de la tabla `customer_product`
--
ALTER TABLE `customer_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_product_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_product_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `delivery_guys`
--
ALTER TABLE `delivery_guys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `courier_id` (`courier_id`);

--
-- Indices de la tabla `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `discount_product`
--
ALTER TABLE `discount_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_id` (`discount_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `free_for_packs`
--
ALTER TABLE `free_for_packs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `free_for_pack_product`
--
ALTER TABLE `free_for_pack_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `free_for_pack_id` (`free_for_pack_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_invoice_unique` (`invoice`);

--
-- Indices de la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `coupon_product`
--
ALTER TABLE `coupon_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `customer_product`
--
ALTER TABLE `customer_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `delivery_guys`
--
ALTER TABLE `delivery_guys`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `discount_product`
--
ALTER TABLE `discount_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `free_for_packs`
--
ALTER TABLE `free_for_packs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `free_for_pack_product`
--
ALTER TABLE `free_for_pack_product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Filtros para la tabla `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD CONSTRAINT `coupon_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_product_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Filtros para la tabla `customer_product`
--
ALTER TABLE `customer_product`
  ADD CONSTRAINT `customer_product_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `customer_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `delivery_guys`
--
ALTER TABLE `delivery_guys`
  ADD CONSTRAINT `delivery_guys_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`);

--
-- Filtros para la tabla `discount_product`
--
ALTER TABLE `discount_product`
  ADD CONSTRAINT `discount_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `discount_product_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Filtros para la tabla `free_for_pack_product`
--
ALTER TABLE `free_for_pack_product`
  ADD CONSTRAINT `free_for_pack_product_ibfk_1` FOREIGN KEY (`free_for_pack_id`) REFERENCES `free_for_packs` (`id`),
  ADD CONSTRAINT `free_for_pack_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
