-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2024 at 12:52 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kheta_estratigya`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supper_admin` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `supper_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$6UtQiaD.3FmF/S7hPh.N8OfSDnwW5QnAXLy4V1FNtteMJkP0M2/Wi', NULL, 1, '2024-01-14 20:36:01', '2024-01-14 20:36:01'),
(2, NULL, 'adminsss@gmail.com', NULL, '$2y$10$RsPJUF7Q8DvQAqxVGVpPlud2uoIm5ygsC5TbSqA/PkTgno2yXw5zq', NULL, 0, '2024-01-16 19:45:23', '2024-01-30 22:58:26'),
(5, NULL, 'drmohabdo@yahoo.com', NULL, '$2y$10$AdPaKKh9X8vv37UoxAL2MOpBd.qgbJFh3teRTnAoZgfsdmqFkMbKG', NULL, 0, '2024-02-17 19:59:53', '2024-02-17 19:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `video_type` int(11) NOT NULL DEFAULT '0',
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `old_price` double(8,2) NOT NULL DEFAULT '0.00',
  `level` tinyint(1) NOT NULL COMMENT '1: Beginner, 2: Intermediate, 3: Expert',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: top, 0: not_top',
  `is_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: active, 0: not_active',
  `is_free` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: free, 0: not_free',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_prerequisites`
--

CREATE TABLE `course_prerequisites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `course_prerequisites` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` tinyint(1) NOT NULL COMMENT '1: youtube, 2: vimeo',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `embed` text COLLATE utf8mb4_unicode_ci,
  `upload_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `execution_years`
--

CREATE TABLE `execution_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `kheta_id` bigint(20) UNSIGNED NOT NULL,
  `selected` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `execution_years`
--

INSERT INTO `execution_years` (`id`, `year_name`, `value`, `kheta_id`, `selected`, `created_at`, `updated_at`) VALUES
(11, '2024', '0', 4, 1, '2024-01-15 16:27:22', '2024-02-17 20:14:47'),
(12, '2025', '0', 4, 0, '2024-01-15 16:27:22', '2024-02-17 20:14:31'),
(13, '2026', '0', 4, 0, '2024-01-15 16:27:22', '2024-02-17 20:14:39'),
(14, '2027', '0', 4, 0, '2024-01-15 16:27:22', '2024-02-01 15:22:38'),
(15, '2028', '0', 4, 0, '2024-01-15 16:27:22', '2024-02-17 20:14:47'),
(16, '2029', '0', 4, 0, '2024-01-15 16:27:22', '2024-01-15 16:27:22'),
(17, '2030', '0', 4, 0, '2024-01-15 16:27:22', '2024-02-01 16:21:12'),
(22, '2024', '0', 6, 1, '2024-02-03 14:49:50', '2024-02-17 20:14:47'),
(23, '2025', '0', 6, 0, '2024-02-03 14:49:50', '2024-02-17 20:14:31'),
(24, '2026', '0', 6, 0, '2024-02-03 14:49:50', '2024-02-17 20:14:39'),
(25, '2027', '0', 6, 0, '2024-02-03 14:49:50', '2024-02-03 14:49:50'),
(26, '2028', '0', 6, 0, '2024-02-03 14:49:50', '2024-02-17 20:14:47'),
(27, '2029', '0', 6, 0, '2024-02-03 14:49:50', '2024-02-03 14:49:50'),
(28, '2030', '0', 6, 0, '2024-02-03 14:49:50', '2024-02-03 14:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `goal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objective_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `goal`, `objective_id`, `created_at`, `updated_at`) VALUES
(3, 'تطوير نظم وسياسات القبول والتحويل والتوزيع', 3, '2024-01-15 16:36:04', '2024-01-15 16:36:04'),
(4, 'تطوير واستحداث برامج تعليمية تنافسية تلبي احتياجات تطلعات سوق العمل', 3, '2024-01-15 16:37:00', '2024-01-15 16:37:00'),
(5, 'تطوير واستحداث استراتيجيات التدريس والتعلم ونظم التدريب والقياس والتقويم', 3, '2024-01-15 16:37:39', '2024-01-15 16:37:39'),
(6, 'تهيئة البيئة الجامعية المحفزة للإبداع والابتكار وريادة الأعمال والحصول على براءات الاختراع', 3, '2024-01-15 16:38:30', '2024-01-15 16:38:30'),
(7, 'تقديم رعاية طلابية (خدمات، وأنشطة..) متميزة', 3, '2024-01-15 16:39:09', '2024-01-15 16:39:09'),
(8, 'تعزيز الروابط بين الخريجين والجامعة لتنمية المهارات المهنية ومهارات التوظيف', 3, '2024-01-15 16:40:05', '2024-01-15 16:40:05'),
(13, 'fffff', 4, '2024-01-16 19:44:43', '2024-01-16 19:44:43'),
(14, 'تطوير نظم وسياسات القبول والتحويل والتوزيع', 13, '2024-02-03 18:18:34', '2024-02-03 18:18:34'),
(15, 'تطوير واستحداث برامج تعليمية تنافسية تلبي احتياجات تطلعات سوق العمل', 13, '2024-02-03 18:19:12', '2024-02-03 18:19:12'),
(16, 'تطوير واستحداث استراتيجيات التدريس والتعلم ونظم التدريب والقياس والتقويم', 13, '2024-02-03 18:19:43', '2024-02-03 18:19:43'),
(17, 'تهيئة البيئة الجامعية المحفزة للإبداع والابتكار وريادة الأعمال والحصول على براءات الاختراع', 13, '2024-02-03 18:22:30', '2024-02-03 18:22:30'),
(18, 'تقديم رعاية طلابية (خدمات، وأنشطة..) متميزة', 13, '2024-02-03 18:23:29', '2024-02-03 18:23:29'),
(19, 'تعزيز الروابط بين الخريجين والجامعة لتنمية المهارات المهنية ومهارات التوظيف', 13, '2024-02-03 18:24:02', '2024-02-03 18:24:02'),
(20, 'استحداث وتطوير البرامج الأكاديمية للدراسات العليا', 14, '2024-02-03 20:14:59', '2024-02-03 20:14:59'),
(21, 'تطوير منظومة البحث العلمي بما يتوافق مع المعايير المحلية والإقليمية والدولية', 14, '2024-02-03 20:15:25', '2024-02-03 20:15:25'),
(22, 'توفير بيئة محفزة للبحث العلمي والابتكار والإبداع', 14, '2024-02-03 20:15:51', '2024-02-03 20:15:51'),
(23, 'الارتقاء بمنظومة أخلاقيات البحث العلمي وحوكمة حماية الملكية الفكرية بالجامعة وكلياتها.', 14, '2024-02-03 20:16:19', '2024-02-03 20:16:19'),
(24, 'رفع كفاءة المعامل، والمراكز البحثية، وإمكانيتها بالجامعة، وكلياتها', 14, '2024-02-03 20:16:38', '2024-02-03 20:16:38'),
(25, 'الارتقاء بمستوى الخطط والبرامج المقدمة لخدمة المجتمع', 15, '2024-02-03 22:30:38', '2024-02-03 22:30:38'),
(26, 'مشاركة الجامعة في المبادرات الرئاسية لخدمة المجتمع والارتقاء بجودة الحياة', 15, '2024-02-03 22:36:04', '2024-02-03 22:36:04'),
(27, 'تحقيق التكامل والمشاركة بين الجامعة والمجتمع والصناعة للمساهمة في التنمية المستدامة', 15, '2024-02-03 22:41:52', '2024-02-03 22:41:52'),
(28, 'حوكمة وضمان جودة الخدمات الصحية بالمستشفيات الجامعية', 15, '2024-02-03 22:47:18', '2024-02-03 22:47:18'),
(29, 'تقليل الانبعاثات الكربونية للوصول الي صفر كربون', 16, '2024-02-03 22:51:19', '2024-02-03 22:51:19'),
(30, 'إعداد سفراء جامعة بنها للتنمية المستدامة والمناخ', 16, '2024-02-03 23:05:03', '2024-02-03 23:05:03'),
(31, 'توجيه البحث العلمي لدراسة تأثيرات التغيرات المناخية ومواجهاتها', 16, '2024-02-03 23:06:52', '2024-02-03 23:06:52'),
(32, 'تعزيز الدور المجتمعي بالجامعة للتكيف مع التغيرات المناخية', 16, '2024-02-03 23:10:41', '2024-02-03 23:10:41'),
(33, 'تعزيز حوكمة الأداء المؤسسي', 17, '2024-02-03 23:27:17', '2024-02-03 23:27:17'),
(34, 'تطوير مهارات وقدرات الموارد البشرية في ضوء مهارات القرن الحادي والعشرين', 17, '2024-02-03 23:33:21', '2024-02-03 23:33:21'),
(35, 'دعم وتطوير نظم الجودة طبقاً لمعايير الاعتماد بالجامعة وكلياتها، وبرامجها التعليمية، ومعاملها، وادارتها', 17, '2024-02-03 23:37:19', '2024-02-03 23:37:19'),
(36, 'حصول الجامعة على جوائز التميز محلياً واقليمياً', 17, '2024-02-03 23:50:23', '2024-02-03 23:50:23'),
(37, 'الاستثمار الامثل للموارد المتاحة لتحقيق رسالة وأهداف الجامعة وكلياتها', 18, '2024-02-03 23:56:11', '2024-02-03 23:56:11'),
(38, 'زيادة المشروعات الممولة من الجهات المانحة محليا ودوليا', 18, '2024-02-04 00:01:00', '2024-02-04 00:01:00'),
(39, 'تنويع مصادر تمويل البحوث البينية والتطبيقية وتسويقها', 18, '2024-02-04 00:02:10', '2024-02-04 00:02:10'),
(40, 'زيادة وتنوع مصادر الموارد الذاتية بالجامعة وكلياتها', 18, '2024-02-04 00:03:08', '2024-02-04 00:03:08'),
(41, 'تعزيز الاتاحة والقدرة الاستيعابية بالجامعة وكلياتها', 19, '2024-02-04 00:09:07', '2024-02-04 00:09:07'),
(42, 'إستكمال وتشغيل مستشفى بنها الجامعي الجديد', 19, '2024-02-04 00:23:12', '2024-02-04 00:23:12'),
(43, 'استكمال وتطوير البنية التحتية للمنشآت الحالية والمستقبلية', 19, '2024-02-04 00:25:53', '2024-02-04 00:25:53'),
(44, 'تطوير منظومة المدن الجامعية وزيادة قدرتها الاستيعابية', 19, '2024-02-04 00:27:28', '2024-02-04 00:27:28'),
(45, 'رفع كفاءة المنشآت الجامعية ومرافقها', 19, '2024-02-04 00:29:18', '2024-02-04 00:29:26'),
(46, 'دعم وتعزيز الشراكات الاستراتيجية مع المؤسسات الأكاديمية المتميزة اقليميًا ودوليًا', 20, '2024-02-04 00:39:05', '2024-02-04 00:39:05'),
(47, 'تدويل البرامج والأنشطة العلمية والبحثية', 20, '2024-02-04 00:46:20', '2024-02-04 00:46:20'),
(48, 'جامعة متميزة جاذبة للطلاب الوافدين', 20, '2024-02-04 01:04:29', '2024-02-04 01:04:29'),
(49, 'تعزيز سمعة الجامعة إقليميا ودوليا', 20, '2024-02-04 01:07:49', '2024-02-04 01:07:49'),
(50, 'تبوء الجامعة مراكز متقدمة في التصنيفات الإقليمية والدولية', 20, '2024-02-04 01:20:40', '2024-02-04 01:20:40'),
(51, 'بنية معلوماتية ذكية', 21, '2024-02-04 01:32:44', '2024-02-04 01:32:44'),
(52, 'حرم جامعي ذكي', 21, '2024-02-04 01:37:24', '2024-02-04 01:37:24'),
(53, 'إدارة ذكية', 21, '2024-02-04 01:42:44', '2024-02-04 01:42:44'),
(54, 'كوادر رقمية', 21, '2024-02-04 01:48:03', '2024-02-04 01:48:03'),
(55, 'تعليم وتعلم ذكي', 21, '2024-02-04 01:53:24', '2024-02-04 01:53:24'),
(56, 'تقييم ذكي', 21, '2024-02-04 01:57:17', '2024-02-04 01:57:17'),
(57, 'خدمات ذكية', 21, '2024-02-04 02:02:03', '2024-02-04 02:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_bankdetails`
--

CREATE TABLE `instructor_bankdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_iban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_details`
--

CREATE TABLE `instructor_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_certifications` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teaching_fileds` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teaching_languages` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedIn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_requests`
--

CREATE TABLE `instructor_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: pending, 1: accepted, 2: rejected',
  `requested_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khetas`
--

CREATE TABLE `khetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khetas`
--

INSERT INTO `khetas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'الخطة الاستراتيجية 2024 - 2030', '2024-01-15 16:27:22', '2024-01-15 16:27:22'),
(6, 'الخطة الاستراتيجية لجامعة بنها 2024 - 2030', '2024-02-03 14:49:50', '2024-02-03 14:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: for video,2: for document',
  `provider` tinyint(1) NOT NULL COMMENT '1: youtube, 2: vimeo, 3: url',
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `is_publish` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed` text COLLATE utf8mb4_unicode_ci,
  `upload_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_progress`
--

CREATE TABLE `lesson_progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `is_last_viewed` tinyint(1) NOT NULL DEFAULT '0',
  `time_completed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mangements`
--

CREATE TABLE `mangements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_mangement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `kheta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_01_08_080104_create_khetas_table', 1),
(2, '2013_12_26_150511_create_mangements_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(8, '2016_06_01_000004_create_oauth_clients_table', 1),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2022_09_14_183652_create_comments_table', 1),
(13, '2022_11_08_080042_create_admins_table', 1),
(14, '2022_11_09_085532_create_categories_table', 1),
(15, '2022_11_10_103831_create_courses_table', 1),
(16, '2022_11_10_103832_create_vimeo_folders_table', 1),
(17, '2022_11_10_113809_create_media_table', 1),
(18, '2022_11_10_140907_create_rates_table', 1),
(19, '2022_11_13_093808_create_sections_table', 1),
(20, '2022_11_13_094331_create_course_videos_table', 1),
(21, '2022_11_13_131824_create_lessons_table', 1),
(22, '2022_11_14_101211_create_likes_table', 1),
(23, '2022_11_14_105743_create_enrollments_table', 1),
(24, '2022_11_17_143208_create_course_prerequisites_table', 1),
(25, '2022_11_21_053818_create_views_table', 1),
(26, '2022_11_23_113451_create_jobs_table', 1),
(27, '2022_11_27_070403_create_payment_methods_table', 1),
(28, '2022_11_27_070403_create_transactions_table', 1),
(29, '2022_11_27_070405_create_orders_table', 1),
(30, '2022_11_27_070439_create_order_items_table', 1),
(31, '2022_11_27_080325_create_instructor_requests_table', 1),
(32, '2022_12_07_090242_create_profiles_table', 1),
(33, '2023_01_01_084300_create_lesson_progress_table', 1),
(34, '2023_01_26_084312_create_instructor_details_table', 1),
(35, '2023_01_26_104702_create_instructor_bankdetails_table', 1),
(36, '2023_12_22_195838_create_objectives_table', 1),
(37, '2023_12_22_230338_create_gools_table', 1),
(38, '2023_12_23_150611_create_programs_table', 1),
(39, '2023_12_23_181811_create_mokashers_table', 1),
(40, '2023_12_24_193452_create_mokasher_inputs_table', 1),
(41, '2024_01_01_141739_create_execution_years_table', 1),
(42, '2024_01_04_222310_create_mokasher_geha_inputs_table', 1),
(43, '2024_01_09_173822_create_rating_members_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mokashers`
--

CREATE TABLE `mokashers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `addedBy` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mokashers`
--

INSERT INTO `mokashers` (`id`, `name`, `type`, `program_id`, `addedBy`, `created_at`, `updated_at`) VALUES
(2, 'وجود قواعد ونظم وسياسات للقبول والتحويل مطورة سنويا', '[\"0\"]', 4, 0, '2024-01-15 17:30:16', '2024-02-03 08:27:38'),
(3, 'عدد الكليات التي تم تطوير نظم وقواعد وسياسات القبول والتحويل بها', '[\"0\"]', 4, 0, '2024-01-15 17:46:01', '2024-01-15 17:46:01'),
(10, 'مستشفي كلية الطب', '[\"0\"]', 4, 13, '2024-01-19 07:24:45', '2024-01-19 07:24:45'),
(11, 'انشاء المستشفي ونسبة الانجاز', '[\"0\"]', 7, 13, '2024-01-19 07:26:25', '2024-01-19 07:26:25'),
(12, 'انشاء المستشفي ونسبة الانجاز', '[\"0\"]', 7, 13, '2024-01-19 07:26:41', '2024-01-19 07:26:41'),
(13, '0000000000000000000000', '[\"0\"]', 7, 13, '2024-01-19 07:27:10', '2024-01-19 07:27:10'),
(14, 'مركز الاختبارات الالكترونية', '[\"0\",\"1\"]', 4, 0, '2024-01-26 19:18:33', '2024-02-03 05:11:22'),
(16, 'عدد البرامج المطورة بكليات الجامعة 1', '[\"1\",\"2\",\"3\"]', 4, 0, '2024-01-30 21:05:12', '2024-02-03 05:11:07'),
(17, 'وجود قواعد ونظم وسياسات للقبول والتحويل مطورة سنويا', '[\"0\",\"1\",\"2\"]', 22, 0, '2024-02-03 18:26:52', '2024-02-03 18:26:52'),
(18, 'عدد الكليات التي تم تطوير نظم وقواعد وسياسات القبول والتحويل بها', '[\"0\",\"1\"]', 22, 0, '2024-02-03 18:27:13', '2024-02-03 18:27:13'),
(22, 'عدد البرامج المطورة بكليات الجامعة', '[\"1\",\"2\"]', 26, 0, '2024-02-03 18:39:18', '2024-02-03 18:39:18'),
(23, 'عدد البرامج المستحدثة التي تلبي احتياجات سوق العمل بكليات الجامعة', '[\"0\",\"1\",\"2\"]', 26, 0, '2024-02-03 18:39:42', '2024-02-03 18:39:42'),
(24, 'عدد الدورات التدريبية في مجال استراتيجيات وطرق التدريس الحديثة والتعليم عن بعد لأعضاء هيئة التدريس', '[\"0\",\"1\",\"2\"]', 27, 0, '2024-02-03 18:40:29', '2024-02-03 18:40:29'),
(25, 'نسبة أعضاء هيئة التدريس والهيئة المعاونة الذين تم تدريبهم على استراتيجيات التدريس والتعلم الحديثة والتعليم عن بعد الى العدد الكلي لأعضاء هيئة التدريس', '[\"1\",\"2\"]', 27, 0, '2024-02-03 18:40:59', '2024-02-03 18:41:31'),
(26, 'نسبة المدرسين في الكليات التكنولوجية الذين تم تدريبهم على الأنماط التعليمية الحديثة', '[\"0\",\"1\"]', 27, 0, '2024-02-03 18:42:24', '2024-02-05 18:19:11'),
(27, 'عدد الدورات التدريبية في مجال القياس والتقويم لأعضاء هيئة التدريس والهيئة المعاونة (دورة تدريبية)', '[\"0\",\"1\"]', 28, 0, '2024-02-03 18:45:10', '2024-02-03 18:45:10'),
(28, 'نسبة    أعضاء هيئة التدريس والهيئة المعاونة الذين تم تدريبهم على نظم التقويم الحديثة', '[\"1\",\"2\"]', 28, 0, '2024-02-03 18:45:35', '2024-02-03 18:45:35'),
(29, '(مؤشر للنوع الاجتماعي) نسبة أعضاء هيئة التدريس والهيئة المعاونة والاداريين الذين تم تدريبهم على التعامل مع المعاقين ودمجهم في المجتمع', '[\"0\",\"1\",\"2\"]', 28, 0, '2024-02-03 18:46:59', '2024-02-03 19:20:43'),
(30, 'نسبة الطلاب المشاركين بالوحدات الابتكارية والإبداعية وريادة الأعمال والموهوبين بالجامعة إلى إجمالي أعداد الطلاب', '[\"0\",\"1\",\"2\"]', 29, 0, '2024-02-03 18:49:10', '2024-02-03 18:50:31'),
(31, 'نسبة الطلاب الفائزين بجوائز في مسابقات الموهبة والإبداع والابتكار وريادة الأعمال داخليا وخارجيا إلى إجمالي أعداد الطلاب المشاركين في المسابقات', '[\"1\",\"2\"]', 29, 0, '2024-02-03 18:49:49', '2024-02-04 02:23:43'),
(32, 'عدد الأنشطة الطلابية التي يتم تنفيذها', '[\"0\",\"1\",\"2\"]', 30, 0, '2024-02-03 18:52:34', '2024-02-03 18:52:44'),
(33, 'عدد الطلاب المشاركين في الأنشطة الطلابية', '[\"0\",\"1\",\"2\"]', 30, 0, '2024-02-03 18:53:02', '2024-02-03 18:53:02'),
(34, 'نسبة الطلاب المشاركين في الأنشطة الطلابية', '[\"1\",\"2\"]', 30, 0, '2024-02-03 18:53:17', '2024-02-03 19:41:54'),
(35, '(مؤشر للنوع الاجتماعي) نسبة مشاركة الطلاب ذوي الإعاقة في الأنشطة المختلفة الى اجمالي أعداد الطلاب المشاركين في الأنشطة', '[\"1\",\"2\"]', 30, 0, '2024-02-03 19:24:31', '2024-02-03 19:42:46'),
(36, 'عدد الخدمات وبرامج الرعاية المقدمة الصحية والاجتماعية والبيئية', '[\"0\",\"1\",\"2\"]', 31, 0, '2024-02-03 19:25:29', '2024-02-03 19:25:29'),
(37, '(مؤشر للنوع الاجتماعي) أنواع الرعاية المقدمة للطلاب ذوي الإعاقة', '[\"0\",\"1\",\"2\"]', 31, 0, '2024-02-03 19:25:47', '2024-02-03 19:25:47'),
(38, '(مؤشر للنوع الاجتماعي) نسبة المنح المقدمة للطلاب ذوي الإعاقة الى اجمالي المنح التي تقدمها الجامعة', '[\"0\",\"1\"]', 31, 0, '2024-02-03 19:26:04', '2024-02-03 19:26:04'),
(39, 'عدد المستفيدين من الخدمات وبرامج الرعاية', '[\"0\",\"1\",\"2\"]', 31, 0, '2024-02-03 19:26:21', '2024-02-04 02:25:08'),
(40, 'نسبة انجاز نظام الكتروني لمتابعة خريجي الجامعة', '[\"1\",\"2\"]', 32, 0, '2024-02-03 19:27:17', '2024-02-03 19:27:17'),
(41, 'نسبة تفعيل النظام الالكتروني لمتابعة خريجي الجامعة', '[\"1\",\"2\"]', 32, 0, '2024-02-03 19:29:11', '2024-02-03 19:29:11'),
(42, 'نسبة تفعيل بروتوكولات التعاون الموقعة بين الكليات وجهات التوظيف وذلك لتوظيف الخريجين سنويا', '[\"0\",\"1\",\"2\"]', 32, 0, '2024-02-03 19:29:35', '2024-02-03 19:29:35'),
(43, '- نسبة الخريجين الحاصلين على فرص عمل الى اجمالي عدد الخريجين', '[\"0\",\"1\",\"2\"]', 32, 0, '2024-02-03 19:29:51', '2024-02-03 19:29:51'),
(44, 'نسبة الطلاب المشاركين بالوحدات الابتكارية والإبداعية وريادة الأعمال والموهوبين بالجامعة إلى إجمالي أعداد الطلاب', '[\"0\",\"1\"]', 30, 0, '2024-02-03 19:37:48', '2024-02-03 19:43:25'),
(45, 'عدد الطلاب المقيدين بالجامعة سنويا', '[\"0\",\"1\"]', 28, 0, '2024-02-03 19:59:59', '2024-02-03 19:59:59'),
(46, '(مؤشر للنوع الاجتماعي) نسبة الطالبات المقيدات بالجامعة الي اجمالي أعداد الطلبة', '[\"0\",\"1\"]', 28, 0, '2024-02-03 20:02:50', '2024-02-03 20:02:50'),
(47, 'عدد الخريجين بالألف', '[\"0\",\"1\"]', 28, 0, '2024-02-03 20:04:17', '2024-02-03 20:04:17'),
(48, 'عدد الطلاب الوافدين', '[\"0\",\"1\",\"2\"]', 28, 0, '2024-02-03 20:05:19', '2024-02-03 20:05:19'),
(49, 'عدد الطلاب المقيدين في الكليات التكنولوجيا', '[\"0\",\"1\"]', 28, 0, '2024-02-03 20:07:14', '2024-02-03 20:07:14'),
(50, 'عدد المدرسين في الكليات التكنولوجيا (أساسي - منتدب)', '[\"0\",\"1\"]', 28, 0, '2024-02-03 20:09:37', '2024-02-03 20:09:37'),
(51, 'عدد البرامج مستحدثة للدراسات العليا وفقا لدراسة احتياجات سوق العمل بالمشاركة مع المؤسسات الصناعية', '[\"1\",\"2\"]', 33, 0, '2024-02-03 20:31:29', '2024-02-06 11:46:06'),
(52, 'نسبة انجاز برامج الدراسات العليا المستحدثة في ضوء احتياجات سوق العمل بالمشاركة مع المؤسسات الصناعية', '[\"1\",\"2\"]', 33, 0, '2024-02-03 20:35:29', '2024-02-03 20:35:29'),
(53, 'عدد مكاتب نقل وتسويق التكنولوجيا', '[\"0\",\"1\",\"2\"]', 33, 0, '2024-02-03 20:36:53', '2024-02-03 20:36:53'),
(54, 'نسبة انجاز اللائحة الداخلية لكلية الدراسات العليا للعلوم التطبيقية والتكنولوجيا معتمدة من المجلس الأعلي للجامعات', '[\"1\",\"2\"]', 34, 0, '2024-02-03 20:49:57', '2024-02-03 20:49:57'),
(55, 'عدد برامج لكلية الدراسات العليا (دبلوم- ماجستير) بينية للعلوم التطبيقية والتكنولوجيا ذات تخصصات متعددة بمشاركة دولية بنظام الساعات المعتمدة', '[\"1\",\"2\"]', 34, 0, '2024-02-03 20:53:48', '2024-02-03 20:53:48'),
(56, 'نسبة انجاز أليات جذب الطلاب الوافدين لبرامج الدراسات العليا المستحدثة', '[\"1\",\"2\"]', 35, 0, '2024-02-03 20:58:41', '2024-02-03 20:58:41'),
(57, 'عدد الطلاب الوافدين الملتحقين ببرامج الدراسات العليا المستحدثة', '[\"1\",\"2\"]', 35, 0, '2024-02-03 20:59:51', '2024-02-03 20:59:51'),
(58, 'عدد المعارض التعليمية السنوية التي تتم خارج مصر ونشرها على الموقع الإلكتروني للجامعة', '[\"1\",\"2\"]', 35, 0, '2024-02-03 21:04:20', '2024-02-03 21:04:20'),
(59, 'وجود خطة بحثية بالجامعة 2023/2030 معتمدة ومعلنة ومتفقة مع الخطة البحثية على المستوى القومي', '[\"0\",\"1\"]', 36, 0, '2024-02-03 21:07:00', '2024-02-03 21:08:19'),
(60, 'وجود خطط بحثية للكليات 2023/ 2030 معتمدة ومعلنة ومتفقة مع الخطة البحثية للجامعة', '[\"1\",\"2\"]', 36, 0, '2024-02-03 21:08:11', '2024-02-03 21:08:11'),
(61, 'عدد الأبحاث المنشورة دوليا بكل كلية', '[\"0\",\"1\",\"2\"]', 36, 0, '2024-02-03 21:09:19', '2024-02-03 21:09:19'),
(62, 'عدد الأبحاث المنشورة محليا بكل كلية', '[\"0\",\"1\",\"2\"]', 36, 0, '2024-02-03 21:10:14', '2024-02-03 21:10:14'),
(63, 'عدد البحوث التطبيقية التي تخدم المجتمع ومرتبطة بالصناعة ولها مردود اقتصادي', '[\"1\",\"2\"]', 37, 0, '2024-02-03 21:12:16', '2024-02-04 22:34:26'),
(64, 'عدد الحاضنات التكنولوجية المستهدف إنشاؤها', '[\"0\",\"1\"]', 38, 0, '2024-02-03 21:15:43', '2024-02-03 21:15:43'),
(65, 'واد للتكنولوجيا يضم عدد (6) حاضنات تكنولوجيا بالجامعة', '[\"1\",\"2\"]', 39, 0, '2024-02-03 21:17:20', '2024-02-03 21:17:20'),
(66, 'ورشة عمل توضح أهمية وآليات وخطوات التعاون مع حاضنة بنها للتكنولوجيا الحيوية وحاضنة ميدتيك', '[\"1\",\"2\"]', 40, 0, '2024-02-03 21:18:41', '2024-02-03 21:18:41'),
(67, 'عدد الشركة الناشئة المحتضنة من مخرجات المشاريع البحثية والأفكار الواعدة بالجامعة', '[\"1\",\"2\"]', 41, 0, '2024-02-03 21:19:59', '2024-02-03 21:20:12'),
(68, 'عدد الاتفاقيات والشركات مع الجامعات الإقليمية والدولية والبنوك والمجتمع المدني المحلي والدولي لتوفير دعم مادي لحاضنات جامعة بنها العلمية', '[\"1\",\"2\"]', 42, 0, '2024-02-03 21:22:29', '2024-02-03 21:22:29'),
(69, 'عدد المشاركات في المؤتمرات والندوات والفعاليات الدولية', '[\"0\",\"1\",\"2\"]', 43, 0, '2024-02-03 21:23:17', '2024-02-03 21:23:17'),
(70, 'عدد المشاركات في المؤتمرات والندوات والفعاليات المحلية', '[\"0\",\"1\",\"2\"]', 43, 0, '2024-02-03 21:23:53', '2024-02-03 21:23:53'),
(71, 'عدد الطلاب المسجلين في البعثات و المنح العلمية التنافسية ودعم الرسائل العلمية بالجامعة (علماء الجيل القادم) سنويا', '[\"1\",\"2\"]', 44, 0, '2024-02-03 21:32:14', '2024-02-03 21:32:14'),
(72, 'اجمالي عدد الطلاب المسجلين في البعثات/ المنح الخارجية', '[\"0\",\"1\"]', 44, 0, '2024-02-03 21:32:47', '2024-02-03 21:32:47'),
(73, 'عدد منح الماجستير والدكتوراه ودعم الرسائل العلمية (علماء الجيل القادم)', '[\"0\",\"1\"]', 44, 0, '2024-02-03 21:33:08', '2024-02-03 21:33:08'),
(74, 'عدد دورات النشر العلمي الدولي سنويا', '[\"1\",\"2\"]', 45, 0, '2024-02-03 21:36:33', '2024-02-03 21:36:33'),
(75, 'عدد البحوث المنشورة دوليا بالجامعة ممولة من جهات مانحة', '[\"1\",\"2\"]', 45, 0, '2024-02-03 21:37:58', '2024-02-03 21:37:58'),
(77, 'نسبة تفعيل اللائحة الموحدة لأخلاقيات البحث العلمي بالجامعة وكلياتها', '[\"1\",\"2\"]', 47, 0, '2024-02-03 21:42:43', '2024-02-03 21:42:43'),
(78, 'آليات حوكمة حماية حقوق الملكية الفكرية بالجامعة وكلياتها مفعلة', '[\"1\",\"2\"]', 48, 0, '2024-02-03 21:43:41', '2024-02-03 21:43:41'),
(79, 'عدد براءات الاختراع لمنسوبي الجامعة', '[\"0\",\"1\"]', 49, 0, '2024-02-03 21:46:08', '2024-02-03 21:46:08'),
(80, 'عدد طلبات براءات الاختراع (المتقدمين للحصول على براءات الاختراع)', '[\"0\",\"1\"]', 49, 0, '2024-02-03 21:46:43', '2024-02-03 21:46:43'),
(87, 'نسبة انجاز قاعدة بيانات للمعامل والاجهزة العلمية بالجامعة والكليات مدعمة بالدليل الالكتروني المصور', '[\"1\",\"2\"]', 55, 0, '2024-02-03 22:06:12', '2024-02-03 22:06:12'),
(88, 'المعامل البحثية المركزية والأقسام العلمية في الكليات مرتبطة بوحدة المعامل والأجهزة بالجامعة', '[\"1\",\"2\"]', 56, 0, '2024-02-03 22:09:24', '2024-02-03 22:09:24'),
(89, 'وجود مكتب مفعل للاعتماد المعملي الدولي بالجامعة', '[\"1\",\"2\"]', 57, 0, '2024-02-03 22:10:38', '2024-02-03 22:10:38'),
(90, 'عدد المعامل البحثية المعتمدة', '[\"1\",\"2\"]', 57, 0, '2024-02-03 22:11:08', '2024-02-03 22:11:08'),
(91, 'عدد المجلات العلمية التي تصدرها الجامعة وكلياتها يتم استضافتها على منصة دار نشر Elsevier', '[\"1\",\"2\"]', 58, 0, '2024-02-03 22:13:08', '2024-02-03 22:13:08'),
(92, 'عدد (3) مجلات علمية محكمة ومتخصصة في مجالات (علوم الحاسب- العلاج الطبيعي -الفنون التطبيقية)', '[\"1\",\"2\"]', 59, 0, '2024-02-03 22:14:24', '2024-02-03 22:14:24'),
(93, 'وجود خطة سنوية لخدمة المجتمع المحيط بناءاً على الاحتياجات الفعلية', '[\"1\",\"2\"]', 60, 0, '2024-02-03 22:31:36', '2024-02-03 22:31:36'),
(94, 'نسبة المتحقق (المنفذ) سنوياً من أهداف خطة خدمة المجتمع', '[\"1\",\"2\"]', 60, 0, '2024-02-03 22:32:00', '2024-02-03 22:32:00'),
(95, 'عدد البرامج التسويقية المفعلة لمنتجات الجامعة سنوياً', '[\"1\",\"2\"]', 61, 0, '2024-02-03 22:32:50', '2024-02-03 22:32:50'),
(96, 'عدد المعارض الموسمية المقامة لخدمة المجتمع سنوياً', '[\"1\",\"2\"]', 61, 0, '2024-02-03 22:33:17', '2024-02-03 22:33:17'),
(97, 'عدد الدورات التدريبية المنفذة لتنمية المهارات المهنية والتوظيف سنويا', '[\"1\",\"2\"]', 62, 0, '2024-02-03 22:34:11', '2024-02-03 22:34:11'),
(98, 'عدد ملتقيات التوظيف سنوياً', '[\"1\",\"2\"]', 62, 0, '2024-02-03 22:34:25', '2024-02-03 22:34:25'),
(99, 'وجود خطة سنوية باحتياجات الوحدات والمراكز ذات الطابع الخاص والمكاتب الاستشارية بالجامعة وكلياتها', '[\"1\",\"2\"]', 63, 0, '2024-02-03 22:35:04', '2024-02-03 22:35:04'),
(100, 'عدد المشاركات السنوية بالمبادرات الرئاسية مثل (حياة كريمة، أيادي مصرية، اتكلم عربي، دمج وتمكين متحدي الإعاقة، جامعة الطفل، ومودة وصنايعية مصر)', '[\"1\",\"2\"]', 64, 0, '2024-02-03 22:37:00', '2024-02-03 22:37:00'),
(101, 'عدد البرامج التدريبية للجمهور', '[\"1\",\"2\"]', 64, 0, '2024-02-03 22:37:54', '2024-02-03 22:37:54'),
(102, 'عدد مشاركات الجامعة في أنشطة تنمية الأسرة المصرية سنويا', '[\"1\"]', 65, 0, '2024-02-03 22:38:38', '2024-02-03 22:38:38'),
(103, 'عدد البرامج والندوات والفعاليات التوعوية عن أضرار الزواج المبكر', '[\"0\",\"1\",\"2\"]', 65, 0, '2024-02-03 22:39:07', '2024-02-03 22:39:07'),
(104, 'عدد البرامج والندوات والفعاليات التوعوية عن أهمية وضرورة استكمال تعليم الفتيات', '[\"0\",\"1\",\"2\"]', 65, 0, '2024-02-03 22:39:40', '2024-02-03 22:39:40'),
(105, 'عدد البرامج والندوات والفعاليات التوعوية عن قضايا المرأة وحمايتها من العنف', '[\"0\",\"1\",\"2\"]', 65, 0, '2024-02-03 22:39:56', '2024-02-03 22:39:56'),
(106, 'عدد الأميين الذين تم محو أميتهم سنويا', '[\"1\",\"2\"]', 66, 0, '2024-02-03 22:40:36', '2024-02-03 22:40:36'),
(107, '(مؤشر للنوع الاجتماعي) نسبة السيدات اللاتي تم محو أميتهن إلى اجمالي أعداد الذين تم محو أميتهم', '[\"0\",\"1\",\"2\"]', 66, 0, '2024-02-03 22:41:04', '2024-02-03 22:41:04'),
(108, 'عدد الأطراف المجتمعية المشاركة في اللجان والمجالس والأنشطة بالجامعة وكلياتها سنويا', '[\"1\",\"2\"]', 67, 0, '2024-02-03 22:42:43', '2024-02-03 22:42:43'),
(109, 'عدد البرامج والندوات والفعاليات التوعوية المرتبطة بأبعاد التنمية المستدامة', '[\"0\",\"1\",\"2\"]', 67, 0, '2024-02-03 22:43:15', '2024-02-03 22:43:15'),
(110, 'عدد بروتوكولات التعاون والشراكات المفعلة بين الجامعة وكلياتها والمؤسسات المجتمعية سنويا', '[\"1\",\"2\"]', 68, 0, '2024-02-03 22:43:58', '2024-02-03 22:43:58'),
(111, 'عدد الاستشارات التي قدمتها المراكز الاستشارية بالجامعة للجمهور', '[\"0\",\"1\",\"2\"]', 68, 0, '2024-02-03 22:44:27', '2024-02-03 22:44:27'),
(112, 'وجود خطة سنوية للقوافل المتكاملة والمتخصصة على مستوي الجامعة وكلياتها', '[\"1\",\"2\"]', 69, 0, '2024-02-03 22:45:21', '2024-02-03 22:45:21'),
(113, 'عدد القوافل المنفذة من الخطة سنوياً', '[\"1\",\"2\"]', 69, 0, '2024-02-03 22:45:36', '2024-02-03 22:45:36'),
(114, 'وجود وحدة تسويق لمخرجات البحث العلمي بالجامعة', '[\"1\"]', 70, 0, '2024-02-03 22:46:12', '2024-02-03 22:46:12'),
(115, 'عدد الأبحاث التطبيقية التي تم تسويقها في المجالات المختلفة لخدمة الصناعة سنويا', '[\"1\",\"2\"]', 70, 0, '2024-02-03 22:46:44', '2024-02-03 22:46:44'),
(116, 'عدد الأقسام والخدمات التي تم تطويرها في ضوء معايير جودة المستشفيات الجامعية', '[\"1\"]', 71, 0, '2024-02-03 22:47:52', '2024-02-03 22:48:01'),
(117, 'نسبة المشاركة المجتمعية في استكمال وتطوير المستشفيات الجامعية إلى إجمالي التكلفة', '[\"1\"]', 71, 0, '2024-02-03 22:48:18', '2024-02-03 22:48:18'),
(118, 'عدد المرضى المستفيدين من الخدمات الصحية بعيادات المستشفى سنوياً', '[\"1\"]', 72, 0, '2024-02-03 22:49:03', '2024-02-03 22:49:03'),
(119, 'نسبة الرقعة الخضراء بالكليات والمدن الجامعية والحرم الجامعي بالعبور وكفر سعد', '[\"1\",\"2\"]', 73, 0, '2024-02-03 22:52:16', '2024-02-03 22:53:11'),
(120, 'عدد السيارات التي تعمل بالغاز الطبيعي', '[\"0\",\"1\"]', 74, 0, '2024-02-03 22:54:02', '2024-02-03 22:54:02'),
(121, 'عدد السيارات التي تعمل بالكهرباء', '[\"0\",\"1\"]', 74, 0, '2024-02-03 22:54:29', '2024-02-03 22:54:29'),
(122, 'نسبة مباني الجامعة التي تستخدم الطاقة المتجددة', '[\"1\",\"2\"]', 75, 0, '2024-02-03 22:57:13', '2024-02-03 22:57:13'),
(123, 'نسبة تدوير المخلفات العضوية بنسبة 10% سنويا', '[\"1\",\"2\"]', 76, 0, '2024-02-03 22:58:46', '2024-02-03 22:58:46'),
(124, 'نسبة تدوير المخلفات غير العضوية بنسبة 10% سنويا', '[\"1\",\"2\"]', 76, 0, '2024-02-03 22:59:32', '2024-02-03 22:59:32'),
(125, 'عدد المباني القديمة بالجامعة التي تم ترميمها بمواد صديقة للبيئة', '[\"1\"]', 77, 0, '2024-02-03 23:02:02', '2024-02-03 23:02:15'),
(126, 'عدد مباني الجامعة وكلياتها التي تراعي كود البناء الأخضر', '[\"0\",\"1\"]', 78, 0, '2024-02-03 23:03:01', '2024-02-03 23:03:01'),
(127, 'عدد الفعاليات (البرامج/ الندوات/ المعارض /المؤتمرات /المسابقات) للتوعية بأبعاد التنمية المستدامة والتغيرات المناخية سنويا', '[\"0\",\"1\",\"2\"]', 79, 0, '2024-02-03 23:06:19', '2024-02-03 23:06:19'),
(128, 'عدد برامج الدراسات العليا المتخصصة في الاستدامة البيئية وإدارة الموارد الطبيعية', '[\"0\",\"1\",\"2\"]', 80, 0, '2024-02-03 23:07:34', '2024-02-03 23:07:34'),
(129, 'عدد البحوث العلمية المرتبطة بالبيئة والتغييرات المناخية والتنمية المستدامة سنويا', '[\"0\",\"1\",\"2\"]', 80, 0, '2024-02-03 23:07:57', '2024-02-03 23:07:57'),
(130, 'عدد المشروعات البحثية/ الابتكارات المتعلقة بالتغيرات المناخية سنويا', '[\"1\",\"2\"]', 80, 0, '2024-02-03 23:08:23', '2024-02-03 23:08:23'),
(131, 'زيادة الانتاج الحيواني والسمكي والداجن بنسبة 5% سنويا', '[\"1\",\"2\"]', 81, 0, '2024-02-03 23:09:43', '2024-02-03 23:09:43'),
(132, 'عدد التطبيقات الالكترونية التي تساهم في مواجهة تحديات المزارعين', '[\"1\",\"2\"]', 81, 0, '2024-02-03 23:10:08', '2024-02-03 23:10:08'),
(133, 'عدد البرامج تدريبية للقطاع الصحي على المخاطر التــي تفرضهــا تأثيــرات تغيــر المنــاخ سنويا', '[\"1\"]', 82, 0, '2024-02-03 23:11:46', '2024-02-03 23:11:46'),
(134, 'وجود خريطة صحية للأمراض المرتبطة بالتغيرات المناخية ومسببات الامراض سنويا', '[\"1\"]', 82, 0, '2024-02-03 23:12:31', '2024-02-03 23:12:57'),
(135, 'وجود تطبيق الكتروني لاتخاذ الإجراءات الوقائية للوقاية من مخاطر التغييرات المناخية', '[\"1\",\"2\"]', 82, 0, '2024-02-03 23:13:33', '2024-02-03 23:13:33'),
(136, 'عدد القوافل (الزراعية/ البيطرية / التوعوية /الصحية) سنويا لتوعيــة المواطنيــن بالمخاطــر المتعلقة بالتغييرات المناخية سنويا', '[\"1\",\"2\"]', 83, 0, '2024-02-03 23:15:01', '2024-02-03 23:15:01'),
(137, 'عدد الافلام الوثائقية عن فعاليات الجامعة في مواجهة التغيرات المناخية', '[\"1\",\"2\"]', 83, 0, '2024-02-03 23:15:57', '2024-02-03 23:15:57'),
(138, 'وجود مقاييس معتمدة ومعلنة ومفعلة لتقييم أداء الكوادر البشرية سنويا في ضوء مدونة السلوك الوظيفي', '[\"1\",\"2\"]', 84, 0, '2024-02-03 23:28:53', '2024-02-03 23:28:53'),
(139, '(مؤشر للنوع الاجتماعي) نسبة السيدات اللائي تشغلن مناصب إدارية في الجامعة (رؤساء أقسام -وكلاء -عمداء -نواب رئيس الجامعة) الى أعضاء هيئة التدريس بالجامعة من السيدات', '[\"0\",\"1\"]', 84, 0, '2024-02-03 23:29:45', '2024-02-03 23:29:45'),
(140, 'وجود آليات للشفافية ومكافحة الفساد معتمدة ومعلنة ومفعلة', '[\"0\",\"1\",\"2\"]', 85, 0, '2024-02-03 23:30:59', '2024-02-03 23:30:59'),
(141, 'وجود آليات للمساءلة والمحاسبية معتمدة ومعلنة ومفعلة', '[\"0\",\"1\",\"2\"]', 85, 0, '2024-02-03 23:31:20', '2024-02-03 23:31:20'),
(142, 'وجود منظومة مطورة لشكاوى ومقترحات منسوبي الجامعة', '[\"1\"]', 86, 0, '2024-02-03 23:32:22', '2024-02-03 23:32:22'),
(143, 'عدد الشكاوى التي تم معالجتها من خلال المنظومة سنويا', '[\"1\"]', 86, 0, '2024-02-03 23:32:37', '2024-02-03 23:32:37'),
(144, 'عدد المتدربين من الكوادر البشرية الأكاديمية على مهارات القرن الحادي والعشرين سنويا', '[\"1\"]', 87, 0, '2024-02-03 23:34:22', '2024-02-03 23:34:22'),
(145, 'عدد المتدربين من الكوادر البشرية الإدارية على مهارات القرن الحادي والعشرين سنويا', '[\"1\",\"2\"]', 87, 0, '2024-02-03 23:34:39', '2024-02-03 23:34:47'),
(146, 'عدد البرامج التدريبية المقدمة للجهاز الإداري', '[\"0\",\"1\"]', 87, 0, '2024-02-03 23:35:05', '2024-02-03 23:35:05'),
(147, 'وجود قاعدة بيانات سنوية عن خبراء الجامعة محدثة ومعلنة', '[\"0\",\"1\"]', 88, 0, '2024-02-03 23:36:40', '2024-02-03 23:36:40'),
(148, 'عدد زيارات الدعم الفني لوحدات ضمان الجودة بالكليات سنويا', '[\"1\",\"2\"]', 89, 0, '2024-02-03 23:38:04', '2024-02-03 23:38:04'),
(150, 'عدد المتابعات الالكترونية والميدانية لكل كلية سنويا', '[\"1\",\"2\"]', 91, 0, '2024-02-03 23:41:30', '2024-02-03 23:41:30'),
(151, 'عدد البرامج التعليمية الحاصلة على الاعتماد البرامجي بالكليات', '[\"0\",\"1\",\"2\"]', 92, 0, '2024-02-03 23:42:28', '2024-02-03 23:42:28'),
(152, 'عدد الكليات الحاصلة على الاعتماد', '[\"0\",\"1\"]', 92, 0, '2024-02-03 23:43:03', '2024-02-03 23:43:03'),
(153, 'عدد أعضاء هيئة التدريس', '[\"0\",\"1\"]', 92, 0, '2024-02-03 23:44:48', '2024-02-03 23:44:48'),
(154, 'نسبة الطلبة لأعضاء هيئة التدريس (طالب / عضو)', '[\"0\",\"1\",\"2\"]', 92, 0, '2024-02-03 23:46:36', '2024-02-03 23:46:36'),
(155, 'اعتماد الجامعة من الهيئة القومية لضمان جودة التعليم والاعتماد', '[\"1\"]', 92, 0, '2024-02-03 23:46:58', '2024-02-03 23:46:58'),
(156, 'عدد المعامل الحاصلة على الاعتماد', '[\"0\",\"1\",\"2\"]', 93, 0, '2024-02-03 23:47:53', '2024-02-03 23:47:53'),
(157, 'استدامة حصول إدارات الجامعة على شهادة الجودة الإدارية ايزو 2015/ 9001', '[\"1\"]', 94, 0, '2024-02-03 23:48:56', '2024-02-03 23:48:56'),
(158, 'عدد البرامج التعليمية الحاصلة على الاعتماد الدولي', '[\"0\",\"1\",\"2\"]', 95, 0, '2024-02-03 23:50:00', '2024-02-03 23:50:00'),
(159, 'عدد جوائز التميز الحاصلة عليها الجامعة سنويا', '[\"1\",\"2\"]', 96, 0, '2024-02-03 23:50:54', '2024-02-03 23:50:54'),
(160, 'نسبة زيادة في عائدات المراكز والوحدات ذات الطابع الخاص سنويا', '[\"1\",\"2\"]', 97, 0, '2024-02-03 23:57:12', '2024-02-03 23:57:12'),
(161, 'نسبة زيادة العائد من المعارض الدائمة لمنتجات كليات الجامعة سنويا', '[\"1\",\"2\"]', 98, 0, '2024-02-03 23:58:47', '2024-02-03 23:58:47'),
(162, 'نسبة زيادة العائد من المعارض الموسمية لكليات الجامعة سنويا', '[\"1\",\"2\"]', 98, 0, '2024-02-03 23:59:24', '2024-02-03 23:59:24'),
(163, 'نسبة زيادة الدخل السنوي من استثمار أصول الجامعة في بنها والعبور ومشتهر سنويا', '[\"1\",\"2\"]', 99, 0, '2024-02-04 00:00:26', '2024-02-04 00:00:26'),
(164, 'عدد المشروعات الممولة من الجهات المانحة محليا ودوليا سنويا', '[\"1\",\"2\"]', 100, 0, '2024-02-04 00:01:38', '2024-02-04 00:01:38'),
(165, 'عدد المشاريع التطبيقية المنتجة المرتبطة بحاضنة الجامعة', '[\"1\"]', 101, 0, '2024-02-04 00:02:43', '2024-02-04 00:02:43'),
(166, 'عدد البرامج الجديدة بمصروفات سنوياً', '[\"1\",\"2\"]', 102, 0, '2024-02-04 00:03:42', '2024-02-04 00:03:42'),
(167, 'نسبة زيادة العائد من البرامج الجديدة (بمصروفات) سنويا', '[\"1\",\"2\"]', 102, 0, '2024-02-04 00:04:29', '2024-02-04 00:04:29'),
(168, 'اجمالي حصيلة الرسوم من الوافدين (مليون دولار)', '[\"0\",\"1\"]', 102, 0, '2024-02-04 00:04:55', '2024-02-04 00:04:55'),
(169, 'نسبة الزيادة السنوية في ايرادات دار الضيافة والجناح الفندقي بالمدن الجامعية', '[\"1\"]', 103, 0, '2024-02-04 00:06:01', '2024-02-04 00:06:01'),
(170, 'نسبة الزيادة السنوية في ايرادات المدن الجامعية', '[\"1\"]', 103, 0, '2024-02-04 00:06:22', '2024-02-04 00:06:22'),
(171, 'نسبة الانتهاء من الموافقات والرسوم الهندسية لكليتي الفنون التطبيقية والتربية النوعية', '[\"1\",\"2\"]', 104, 0, '2024-02-04 00:10:48', '2024-02-04 00:10:48'),
(172, 'نسبة انجاز البنية التحتية الأساسية (الأعمال الخرسانية) لمباني كليتي الفنون التطبيقية والتربية النوعية', '[\"1\",\"2\"]', 104, 0, '2024-02-04 00:11:23', '2024-02-04 00:11:23'),
(173, 'نسبة انجاز التشطيبات النهائية لمباني كليتي الفنون التطبيقية والتربية النوعية', '[\"1\",\"2\"]', 104, 0, '2024-02-04 00:11:53', '2024-02-04 00:11:53'),
(174, 'نسبة الانتهاء من التجهيزات النهائية لمباني كليتي الفنون التطبيقية والتربية النوعية', '[\"1\",\"2\"]', 104, 0, '2024-02-04 00:12:09', '2024-02-04 00:12:09'),
(175, 'نسبة الانتهاء من الموافقات والرسوم الهندسية لكلية الطب البشري', '[\"1\",\"2\"]', 105, 0, '2024-02-04 00:13:24', '2024-02-04 00:13:24'),
(176, 'نسبة انجاز البنية التحتية الأساسية (الأعمال الخرسانية) لمبني كلية الطب البشري', '[\"1\",\"2\"]', 105, 0, '2024-02-04 00:13:47', '2024-02-04 00:13:47'),
(177, 'نسبة انجاز التشطيبات النهائية لمبنى كلية الطب البشري', '[\"1\",\"2\"]', 105, 0, '2024-02-04 00:14:06', '2024-02-04 00:14:06'),
(178, 'نسبة الانتهاء من التجهيزات النهائية لمبنى كلية الطب البشري', '[\"1\",\"2\"]', 105, 0, '2024-02-04 00:14:24', '2024-02-04 00:14:24'),
(179, 'الانتهاء من الموافقات والرسوم الهندسية لمعامل كلية التربية', '[\"1\",\"2\"]', 106, 0, '2024-02-04 00:15:32', '2024-02-04 00:15:32'),
(180, 'نسبة انشاء البنية التحتية لمبني المعامل في كلية التربية (الأعمال الخرسانية)', '[\"1\",\"2\"]', 106, 0, '2024-02-04 00:16:01', '2024-02-04 00:16:01'),
(181, 'نسبة انجاز التشطيبات النهائية لمبني المعامل في كلية التربية', '[\"1\",\"2\"]', 106, 0, '2024-02-04 00:16:28', '2024-02-04 00:16:28'),
(182, 'نسبة الانتهاء من التجهيزات النهائية لمبني المعامل في كلية التربية', '[\"1\",\"2\"]', 106, 0, '2024-02-04 00:16:44', '2024-02-04 00:16:44'),
(183, 'نسبة الانتهاء من التجهيزات النهائية لمبني المعامل المركزية في كفر سعد (المرحلة الثانية)', '[\"1\",\"2\"]', 106, 0, '2024-02-04 00:16:59', '2024-02-04 00:16:59'),
(184, 'الانتهاء من الموافقات والرسوم الهندسية لمبنى المدرجات في ارض الجامعة بكفر سعد', '[\"1\"]', 107, 0, '2024-02-04 00:17:44', '2024-02-04 00:17:44'),
(185, 'نسبة انجاز البنية التحتية الأساسية (الأعمال الخرسانية) لمبنى المدرجات في ارض الجامعة بكفر سعد', '[\"1\"]', 107, 0, '2024-02-04 00:18:02', '2024-02-04 00:18:02'),
(186, 'نسبة انجاز التشطيبات النهائية لمبنى المدرجات في ارض الجامعة بكفر سعد', '[\"1\"]', 107, 0, '2024-02-04 00:18:42', '2024-02-04 00:18:42'),
(187, 'نسبة الانتهاء من التجهيزات النهائية لمبنى المدرجات في ارض الجامعة بكفر سعد', '[\"1\"]', 107, 0, '2024-02-04 00:19:06', '2024-02-04 00:19:06'),
(188, 'الانتهاء من الموافقات والرسوم الهندسية', '[\"0\",\"1\"]', 108, 0, '2024-02-04 00:20:07', '2024-02-04 00:20:07'),
(189, 'نسبة انشاء البنية التحتية (الأعمال الخرسانية) لمبني الجامعة التكنولوجية', '[\"0\",\"1\"]', 108, 0, '2024-02-04 00:20:21', '2024-02-04 00:20:21'),
(190, 'نسبة انجاز التشطيبات النهائية لمبني الجامعة التكنولوجية', '[\"0\",\"1\"]', 108, 0, '2024-02-04 00:20:38', '2024-02-04 00:20:38'),
(191, 'نسبة الانتهاء من التجهيزات النهائية لمبني الجامعة التكنولوجية', '[\"0\",\"1\"]', 108, 0, '2024-02-04 00:20:52', '2024-02-04 00:20:52'),
(192, 'عدد الكليات في الجامعة', '[\"0\",\"1\"]', 108, 0, '2024-02-04 00:21:39', '2024-02-04 00:21:39'),
(193, 'عدد المدن الجامعية الجديدة / التي تم تطويرها', '[\"0\",\"1\"]', 108, 0, '2024-02-04 00:22:11', '2024-02-04 00:22:11'),
(194, 'نسبة الانتهاء من مراحل إنشاء المستشفى الجامعي الجديد', '[\"1\"]', 109, 0, '2024-02-04 00:24:33', '2024-02-04 00:24:33'),
(195, 'نسبة الانتهاء من تجهيز المستشفى', '[\"1\"]', 110, 0, '2024-02-04 00:25:21', '2024-02-04 00:25:21'),
(196, 'نسبة الانتهاء من استكمال وتطوير البنية التحتية لمنشآت الجامعة سنوياً', '[\"1\",\"2\"]', 111, 0, '2024-02-04 00:26:42', '2024-02-04 00:26:42'),
(197, 'نسبة الانتهاء من استكمال وتطوير البنية التحتية التكنولوجية في منشئات الجامعة سنويا', '[\"1\",\"2\"]', 111, 0, '2024-02-04 00:26:58', '2024-02-04 00:26:58'),
(198, 'نسبة الانتهاء من تطوير منظومة المدن الجامعية في كفر سعد، وطوخ، ومشتهر وشبرا', '[\"1\"]', 112, 0, '2024-02-04 00:28:13', '2024-02-04 00:28:13'),
(199, 'نسبة الانتهاء من إنشاء المدينة الجامعية في أرض الجامعة بالعبور سنوياً', '[\"1\"]', 113, 0, '2024-02-04 00:28:57', '2024-02-04 00:28:57'),
(200, 'نسبة الانتهاء من إجراء الترميمات والصيانات لمختلف المنشآت الجامعية سنويا', '[\"1\",\"2\"]', 114, 0, '2024-02-04 00:29:56', '2024-02-04 00:29:56'),
(201, 'نسبة الانتهاء من التجهيزات النهائية للطابقين في كلية الحقوق', '[\"1\",\"2\"]', 115, 0, '2024-02-04 00:31:36', '2024-02-04 00:31:36'),
(202, 'نسبة الانتهاء من تطوير مبنى الكيمياء في كلية الهندسة بشبرا', '[\"1\",\"2\"]', 116, 0, '2024-02-04 00:32:14', '2024-02-04 00:32:14'),
(203, 'نسبة الانتهاء من إعادة تأهيل مبنى الخدمات الطلابية والمعهد الفني للتمريض', '[\"1\"]', 117, 0, '2024-02-04 00:32:51', '2024-02-04 00:32:51'),
(204, 'نسبة الانتهاء من تجهيز مبنى الابداع الرقمي', '[\"1\"]', 117, 0, '2024-02-04 00:33:38', '2024-02-04 00:33:38'),
(205, 'نسبة الانتهاء من تطوير مبنى الجراحة في المستشفيات الجامعية', '[\"1\"]', 118, 0, '2024-02-04 00:34:59', '2024-02-04 00:34:59'),
(206, 'نسبة الانتهاء من اعداد وتجهيز 8 كبسولات للعمليا', '[\"1\"]', 119, 0, '2024-02-04 00:35:40', '2024-02-04 00:35:40'),
(207, 'نسبة الانتهاء من اعداد وتجهيز الملاعب في كلية التربية الرياضية', '[\"1\",\"2\"]', 120, 0, '2024-02-04 00:36:15', '2024-02-04 00:36:15'),
(208, 'نسبة الانتهاء من تطوير بدروم كلية الحاسبات والذكاء الاصطناعي', '[\"1\",\"2\"]', 121, 0, '2024-02-04 00:36:44', '2024-02-04 00:36:44'),
(209, 'عدد ورش عمل سنويا مع شركاء دوليا', '[\"1\"]', 122, 0, '2024-02-04 00:39:53', '2024-02-04 00:39:53'),
(210, 'عدد ندوات / مؤتمرات سنويا مع شركاء دوليا', '[\"1\"]', 122, 0, '2024-02-04 00:40:14', '2024-02-04 00:40:14'),
(211, 'نسبة انجاز قواعد البيانات المحدثة على الموقع الالكتروني', '[\"1\"]', 122, 0, '2024-02-04 00:41:43', '2024-02-04 00:41:43'),
(212, 'عدد البروتوكولات / مذكرات تفاهم / الشراكات الدولية المفعلة', '[\"1\"]', 122, 0, '2024-02-04 00:44:30', '2024-02-04 00:44:30'),
(213, 'وجود برنامج تبادل زيارات مفعلة لأعضاء هيئة التدريس مع شركاء إقليمياً ودوليا', '[\"1\"]', 122, 0, '2024-02-04 00:45:42', '2024-02-04 00:45:42'),
(214, 'تبني معايير اكاديمية دولية للبرامج الأكاديمية للمرحلة الجامعية الاولي والدراسات العليا', '[\"1\",\"2\"]', 123, 0, '2024-02-04 00:50:46', '2024-02-04 00:50:46'),
(215, 'عدد البرامج الجديدة المطابقة للمعايير الاكاديمية الدولية', '[\"1\",\"2\"]', 123, 0, '2024-02-04 00:51:40', '2024-02-04 00:51:40'),
(216, 'عدد البرامج الأكاديمية المستحدثة المزدوجة مع جامعات دولية', '[\"1\",\"2\"]', 124, 0, '2024-02-04 00:54:05', '2024-02-04 00:54:05'),
(217, 'عدد الدورات التدريبية وورش العمل مع مؤسسات اكاديمية دولية', '[\"1\"]', 124, 0, '2024-02-04 00:56:05', '2024-02-04 00:56:05'),
(218, 'قواعد بيانات للمشروعات الدولية محدثة على الموقع الالكتروني بالجامعة', '[\"1\"]', 125, 0, '2024-02-04 00:57:25', '2024-02-04 00:57:25'),
(219, 'عدد الفاعليات التعريفية بين جامعة بنها والمؤسسات الإقليمية والدولية', '[\"1\",\"2\"]', 126, 0, '2024-02-04 01:00:12', '2024-02-04 01:00:12'),
(220, 'عدد المشاركات في معارض / مسابقات علمية دولية في مجال الابتكارات', '[\"1\"]', 126, 0, '2024-02-04 01:01:51', '2024-02-04 01:01:51'),
(221, 'عدد طلبات تسجيل براءات الأختراع دولية سنويا', '[\"1\"]', 126, 0, '2024-02-04 01:02:49', '2024-02-04 01:02:49'),
(222, 'عدد ورش عمل /دورات تدريبية علي كيفية التقدم للمنح العلمية والبعثات للطلاب والهيئة المعاونة و أعضاء هيئة التدريس سنويا', '[\"1\"]', 127, 0, '2024-02-04 01:03:48', '2024-02-04 01:03:48'),
(223, 'وجود قنوات التواصل مع السفارات العربية و الاجنبية في مصر', '[\"1\"]', 128, 0, '2024-02-04 01:06:45', '2024-02-04 19:38:26'),
(224, 'عدد الخدمات الصحية المقدمة للوافدين', '[\"1\"]', 128, 0, '2024-02-04 01:07:15', '2024-02-04 01:07:15'),
(225, 'وجود هوية بصرية بالجامعة مطبقة', '[\"1\"]', 129, 0, '2024-02-04 01:08:54', '2024-02-04 01:08:54'),
(226, 'الهوية الرقمية للتطبيقات الالكترونية مطبقة', '[\"1\"]', 129, 0, '2024-02-04 01:09:17', '2024-02-04 01:09:17'),
(227, 'وجود تطبيق الكتروني لإدارة الاتصال المؤسسي بالجامعة سنوياً', '[\"1\"]', 130, 0, '2024-02-04 01:10:39', '2024-02-04 01:10:39'),
(228, 'وجود تقرير عن إدارة الرصـد والمراقبـة والتتبـع الالكتروني سنويا', '[\"1\"]', 130, 0, '2024-02-04 01:11:13', '2024-02-04 01:11:13'),
(229, 'عدد اللقاءات التوعوية/ التدريبية لمنسوبي الجامعة عن بناء السمعة المؤسسية بالجامعة', '[\"1\"]', 131, 0, '2024-02-04 01:14:08', '2024-02-04 01:14:08'),
(230, 'وجود ألية لادارة مخاطر السمعة الإدارية والاكاديمية والبحثية والاعلام', '[\"1\"]', 132, 0, '2024-02-04 01:16:26', '2024-02-04 01:16:26'),
(231, 'وجود تقارير لتقييم و قياس بناء السمعة الاكاديمية والصورة الذهنية للجامعة', '[\"1\"]', 133, 0, '2024-02-04 01:20:07', '2024-02-04 01:20:07'),
(232, 'تقدم الجامعة بتصنيفات Times بمقدار فئتين سنوياً', '[\"1\"]', 134, 0, '2024-02-04 01:21:43', '2024-02-04 01:21:43'),
(233, 'تقدم الجامعة بتصنيف الـUI Green Metrics بمقدار فئتين سنوياً', '[\"1\"]', 134, 0, '2024-02-04 01:22:04', '2024-02-04 01:22:04'),
(234, 'تقدم الجامعة بتصنيف الـQS بمقدار فئة سنوياً', '[\"1\"]', 134, 0, '2024-02-04 01:22:28', '2024-02-04 01:22:28'),
(235, 'تقدم الجامعة بتصنيف الـ Webometrics بمقدار فئة سنوياً', '[\"1\"]', 134, 0, '2024-02-04 01:23:17', '2024-02-04 01:23:17'),
(236, 'تقدم الجامعة بتصنيف الـ URAP بمقدار فئتين سنوياً', '[\"1\"]', 134, 0, '2024-02-04 01:23:31', '2024-02-04 01:23:31'),
(237, 'تقدم الجامعة بتصنيف الـ U.S.Newsبمقدار فئة سنوياً', '[\"1\"]', 134, 0, '2024-02-04 01:23:45', '2024-02-04 01:23:45'),
(238, 'تقدم الجامعة بتصنيف الـ 4ICU بمقدار فئتين', '[\"1\"]', 134, 0, '2024-02-04 01:24:07', '2024-02-04 01:24:07'),
(239, 'تقدم الجامعة بتصنيف الـ SCI Mago بمقدار فئة', '[\"1\"]', 134, 0, '2024-02-04 01:24:23', '2024-02-04 01:24:23'),
(240, 'ادراج الجامعة في تصنيف ليدن الهولاندي', '[\"1\"]', 134, 0, '2024-02-04 01:24:40', '2024-02-04 01:24:40'),
(241, 'ادراج الجامعة في تصنيف الروسي', '[\"1\"]', 134, 0, '2024-02-04 01:24:57', '2024-02-04 01:24:57'),
(242, 'ادراج الجامعة في بالتصنيف العربي', '[\"1\"]', 134, 0, '2024-02-04 01:30:53', '2024-02-04 01:30:53'),
(243, 'عدد المعالجات الموجودة في مركز بيانات الجامعة + المستأجرة من خلال الحوسبة السحابية بنهاية الخطة', '[\"1\"]', 136, 0, '2024-02-04 01:33:21', '2024-02-04 01:33:21'),
(244, 'السعة التخزينية (تيرا بايت) المتوفرة في مركز بيانات الجامعة + المستأجرة من خلال الحوسبة السحابية بنهاية الخطة', '[\"1\"]', 136, 0, '2024-02-04 01:33:39', '2024-02-04 01:33:39'),
(245, 'سرعة الإنترنت /1- الشبكة الخاصة الافتراضية المتوفرة في الجامعة وكلياتها بنهاية الخطة', '[\"1\"]', 137, 0, '2024-02-04 01:34:39', '2024-02-04 01:34:39'),
(246, 'نسبة 100% من النطاقات المؤمنة والشهادات الرقمية الموقعة إلكترونياً- نهاية الخطة', '[\"1\"]', 138, 0, '2024-02-04 01:35:16', '2024-02-04 01:35:16'),
(247, 'تنفيذ أنشطة /1- مهام تأمين وأمن البيانات على مستوى الجامعة بشكل دوري بنهاية الخطة', '[\"1\"]', 139, 0, '2024-02-04 01:35:54', '2024-02-04 01:35:54'),
(248, 'سرعة الإنترنت / الشبكة الخاصة الافتراضية المتوفرة في الجامعة وكلياتها بنهاية الخطة', '[\"1\",\"2\"]', 140, 0, '2024-02-04 01:36:59', '2024-02-04 02:08:06'),
(249, 'نسبة حاملي الهوية الذكية داخل الجامعة وكلياتها بمعدل 25% سنويا', '[\"1\",\"2\"]', 141, 0, '2024-02-04 01:38:05', '2024-02-04 02:12:32'),
(250, 'تغطية الحرم الجامعي بالمراقبة الذكية', '[\"1\"]', 142, 0, '2024-02-04 01:38:45', '2024-02-04 01:41:04'),
(251, 'نسبة المعامل / القاعات الدراسية المزودة باللوحات الذكية / أجهزة العرض الذكية سنويا', '[\"1\",\"2\"]', 143, 0, '2024-02-04 01:40:15', '2024-02-04 02:09:01'),
(252, 'نسبة المقررات الدراسية التي تستخدم المعامل الافتراضية ونظم المحاكاة بنهاية الخطة', '[\"1\",\"2\"]', 144, 0, '2024-02-04 01:42:18', '2024-02-04 02:09:17'),
(253, 'نسبة الأتمتة / الميكنة (Automation) لإدارة سير العمل على مستوى الجامعة', '[\"1\"]', 145, 0, '2024-02-04 01:44:26', '2024-02-04 01:44:26'),
(254, 'نسبة الأتمتة / الميكنة (Automation) لإدارة المستندات على مستوى الجامعة', '[\"1\"]', 146, 0, '2024-02-04 01:45:32', '2024-02-04 01:45:32'),
(255, 'نسبة الأتمتة / الميكنة (Automation) لإدارة موارد / أصول الجامعة خلال سنوات الخطة', '[\"1\"]', 147, 0, '2024-02-04 01:46:34', '2024-02-04 01:46:34'),
(256, 'نسبة الحاصلين على شهادات معتمدة خلال العام الدراسي من الجامعة / المجلس الأعلى للجامعات سنويا من شركات كبرى مثل مايكروسوفت، أمازون، جوجل', '[\"1\"]', 149, 0, '2024-02-04 01:48:58', '2024-02-04 01:48:58'),
(257, 'عدد الطلاب المشاركين في الفعاليات الابداع والابتكار في مجال تكنولوجيا المعلومات خلال العام الدراسي سنويا', '[\"1\",\"2\"]', 150, 0, '2024-02-04 01:50:02', '2024-02-04 02:09:53'),
(258, 'عدد البرامج الدراسية التي تدرس مقرر عن تطبيقات علوم الحاسب', '[\"1\",\"2\"]', 151, 0, '2024-02-04 01:54:48', '2024-02-04 02:10:17'),
(259, 'عدد الرسائل على منصة اتحاد الجامعات العربية', '[\"1\"]', 152, 0, '2024-02-04 01:55:26', '2024-02-04 01:55:26'),
(260, 'تصميم بالجامعة واستضافته منصة المؤتمرات', '[\"1\"]', 152, 0, '2024-02-04 01:56:02', '2024-02-04 01:56:02'),
(261, 'نسبة تفعيل منصة التعليم الإلكتروني ثنكي', '[\"1\",\"2\"]', 153, 0, '2024-02-04 01:56:55', '2024-02-04 02:10:37'),
(262, 'نسبة الأتمتة / الميكنة (Automation) لعمليات التقييم والاختبارات في كليات الجامعة', '[\"1\",\"2\"]', 154, 0, '2024-02-04 01:58:15', '2024-02-04 02:14:03'),
(263, 'نسبة المقررات التي تصحح الكترونيا', '[\"1\",\"2\"]', 155, 0, '2024-02-04 01:59:26', '2024-02-04 02:11:02'),
(264, 'وجود التعاقد على حق استخدام التطبيق سنويا', '[\"1\"]', 156, 0, '2024-02-04 02:00:38', '2024-02-04 02:00:38'),
(265, 'نسبة الاختبارات الالكترونية التي تستخدم المراقبة الذكية', '[\"1\"]', 157, 0, '2024-02-04 02:01:45', '2024-02-04 02:01:45'),
(266, 'نسبة زيادة الخدمات الالكترونية على مستوى الجامعة وكلياتها إلى  الخدمات المقدمة سنوياً', '[\"1\",\"2\"]', 158, 0, '2024-02-04 02:03:52', '2024-02-04 02:11:25'),
(267, 'نسبة الأتمتة / الميكنة (Automation) لعمليات الدفع / السداد في جميع قطاعات الجامعة', '[\"1\",\"2\"]', 159, 0, '2024-02-04 02:05:08', '2024-02-04 02:05:08'),
(268, 'نسبة التكامل مع مستودع البيانات الموحد خلال فترة الخطة', '[\"1\"]', 160, 0, '2024-02-04 02:06:08', '2024-02-04 02:06:08'),
(269, 'نسبة تفعيل نظام إدارة المعلومات الطلابية بكليات الجامعة بنهاية الخطة', '[\"1\",\"2\"]', 161, 0, '2024-02-04 02:07:06', '2024-02-04 02:07:06'),
(270, 'gggggggggggggg', 'مؤشر وزاره', 4, 29, '2024-02-06 11:59:19', '2024-02-06 11:59:19'),
(271, 'اااااااااااااااااااااااااااااااا', 'مؤشر كليه', 4, 19, '2024-02-06 12:10:11', '2024-02-06 12:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `mokasher_execution_years`
--

CREATE TABLE `mokasher_execution_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mokasher_id` bigint(20) UNSIGNED NOT NULL,
  `year_id` bigint(20) UNSIGNED NOT NULL,
  `value` bigint(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mokasher_execution_years`
--

INSERT INTO `mokasher_execution_years` (`id`, `mokasher_id`, `year_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 17, 22, 16, '2024-02-17 22:03:37', '2024-02-17 22:06:11'),
(2, 17, 23, 16, '2024-02-17 22:03:37', '2024-02-17 22:03:37'),
(3, 17, 24, 16, '2024-02-17 22:03:37', '2024-02-17 22:06:11'),
(4, 17, 25, 16, '2024-02-17 22:03:37', '2024-02-17 22:06:11'),
(5, 17, 26, 16, '2024-02-17 22:03:37', '2024-02-17 22:06:11'),
(6, 17, 27, 16, '2024-02-17 22:03:37', '2024-02-17 22:03:37'),
(7, 17, 28, 16, '2024-02-17 22:03:37', '2024-02-17 22:03:37'),
(8, 22, 22, 16, '2024-02-17 23:07:28', '2024-02-17 23:07:28'),
(9, 22, 23, 16, '2024-02-17 23:07:28', '2024-02-17 23:07:28'),
(10, 22, 24, 16, '2024-02-17 23:07:28', '2024-02-17 23:07:28'),
(11, 22, 25, 16, '2024-02-17 23:07:28', '2024-02-17 23:07:28'),
(12, 22, 26, 16, '2024-02-17 23:07:28', '2024-02-17 23:07:28'),
(13, 22, 27, 16, '2024-02-17 23:07:28', '2024-02-17 23:07:28'),
(14, 22, 28, 16, '2024-02-17 23:07:28', '2024-02-17 23:07:28'),
(15, 23, 22, 8, '2024-02-17 23:07:54', '2024-02-17 23:07:54'),
(16, 23, 23, 8, '2024-02-17 23:07:54', '2024-02-17 23:07:54'),
(17, 23, 24, 8, '2024-02-17 23:07:54', '2024-02-17 23:07:54'),
(18, 23, 25, 8, '2024-02-17 23:07:54', '2024-02-17 23:07:54'),
(19, 23, 26, 8, '2024-02-17 23:07:54', '2024-02-17 23:07:54'),
(20, 23, 27, 8, '2024-02-17 23:07:54', '2024-02-17 23:07:54'),
(21, 23, 28, 8, '2024-02-17 23:07:54', '2024-02-17 23:07:54'),
(22, 24, 22, 2, '2024-02-17 23:10:30', '2024-02-17 23:10:30'),
(23, 24, 23, 2, '2024-02-17 23:10:30', '2024-02-17 23:10:30'),
(24, 24, 24, 2, '2024-02-17 23:10:30', '2024-02-17 23:10:30'),
(25, 24, 25, 2, '2024-02-17 23:10:30', '2024-02-17 23:10:30'),
(26, 24, 26, 2, '2024-02-17 23:10:30', '2024-02-17 23:10:30'),
(27, 24, 27, 2, '2024-02-17 23:10:30', '2024-02-17 23:10:30'),
(28, 24, 28, 2, '2024-02-17 23:10:30', '2024-02-17 23:10:30'),
(29, 25, 22, 10, '2024-02-17 23:11:11', '2024-02-18 04:06:54'),
(30, 25, 23, 10, '2024-02-17 23:11:11', '2024-02-17 23:11:11'),
(31, 25, 24, 10, '2024-02-17 23:11:11', '2024-02-17 23:11:11'),
(32, 25, 25, 10, '2024-02-17 23:11:11', '2024-02-17 23:11:11'),
(33, 25, 26, 10, '2024-02-17 23:11:11', '2024-02-17 23:11:11'),
(34, 25, 27, 10, '2024-02-17 23:11:11', '2024-02-17 23:11:11'),
(35, 25, 28, 10, '2024-02-17 23:11:11', '2024-02-17 23:11:11'),
(36, 27, 22, 2, '2024-02-17 23:11:46', '2024-02-17 23:11:46'),
(37, 27, 23, 2, '2024-02-17 23:11:46', '2024-02-17 23:11:46'),
(38, 27, 24, 2, '2024-02-17 23:11:46', '2024-02-17 23:11:46'),
(39, 27, 25, 2, '2024-02-17 23:11:46', '2024-02-17 23:11:46'),
(40, 27, 26, 2, '2024-02-17 23:11:46', '2024-02-17 23:11:46'),
(41, 27, 27, 2, '2024-02-17 23:11:46', '2024-02-17 23:11:46'),
(42, 27, 28, 2, '2024-02-17 23:11:46', '2024-02-17 23:11:46'),
(43, 28, 22, 10, '2024-02-17 23:12:17', '2024-02-17 23:12:17'),
(44, 28, 23, 10, '2024-02-17 23:12:17', '2024-02-17 23:12:17'),
(45, 28, 24, 10, '2024-02-17 23:12:17', '2024-02-17 23:12:17'),
(46, 28, 25, 10, '2024-02-17 23:12:17', '2024-02-17 23:12:17'),
(47, 28, 26, 10, '2024-02-17 23:12:17', '2024-02-17 23:12:17'),
(48, 28, 27, 10, '2024-02-17 23:12:17', '2024-02-17 23:12:17'),
(49, 28, 28, 10, '2024-02-17 23:12:17', '2024-02-17 23:12:17'),
(50, 29, 22, 2, '2024-02-17 23:12:37', '2024-02-18 04:07:27'),
(51, 29, 23, 0, '2024-02-17 23:12:37', '2024-02-17 23:12:37'),
(52, 29, 24, 0, '2024-02-17 23:12:37', '2024-02-17 23:12:37'),
(53, 29, 25, 0, '2024-02-17 23:12:37', '2024-02-17 23:12:37'),
(54, 29, 26, 0, '2024-02-17 23:12:37', '2024-02-17 23:12:37'),
(55, 29, 27, 0, '2024-02-17 23:12:37', '2024-02-17 23:12:37'),
(56, 29, 28, 0, '2024-02-17 23:12:37', '2024-02-17 23:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `mokasher_geha_inputs`
--

CREATE TABLE `mokasher_geha_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mokasher_id` bigint(20) UNSIGNED NOT NULL,
  `geha_id` bigint(20) UNSIGNED NOT NULL,
  `sub_geha_id` bigint(20) UNSIGNED DEFAULT NULL,
  `target` int(11) DEFAULT '0',
  `year_id` bigint(20) UNSIGNED NOT NULL,
  `part_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `rate_part_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `evidence1` text COLLATE utf8mb4_unicode_ci,
  `vivacity1` text COLLATE utf8mb4_unicode_ci,
  `impediments1` text COLLATE utf8mb4_unicode_ci,
  `part_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `rate_part_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `note_part_2` text COLLATE utf8mb4_unicode_ci,
  `note_part_1` text COLLATE utf8mb4_unicode_ci,
  `evidence2` text COLLATE utf8mb4_unicode_ci,
  `vivacity2` text COLLATE utf8mb4_unicode_ci,
  `impediments2` text COLLATE utf8mb4_unicode_ci,
  `part_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `rate_part_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `note_part_3` text COLLATE utf8mb4_unicode_ci,
  `evidence3` text COLLATE utf8mb4_unicode_ci,
  `vivacity3` text COLLATE utf8mb4_unicode_ci,
  `impediments3` text COLLATE utf8mb4_unicode_ci,
  `part_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `rate_part_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `note_part_4` text COLLATE utf8mb4_unicode_ci,
  `evidence4` text COLLATE utf8mb4_unicode_ci,
  `vivacity4` text COLLATE utf8mb4_unicode_ci,
  `impediments4` text COLLATE utf8mb4_unicode_ci,
  `accept` tinyint(4) NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mokasher_geha_inputs`
--

INSERT INTO `mokasher_geha_inputs` (`id`, `mokasher_id`, `geha_id`, `sub_geha_id`, `target`, `year_id`, `part_1`, `rate_part_1`, `evidence1`, `vivacity1`, `impediments1`, `part_2`, `rate_part_2`, `note_part_2`, `note_part_1`, `evidence2`, `vivacity2`, `impediments2`, `part_3`, `rate_part_3`, `note_part_3`, `evidence3`, `vivacity3`, `impediments3`, `part_4`, `rate_part_4`, `note_part_4`, `evidence4`, `vivacity4`, `impediments4`, `accept`, `notes`, `created_at`, `updated_at`) VALUES
(23, 3, 19, 22, 200, 12, '0', '0', '[\"1707221738_\\u0645\\u0646\\u0633\\u0642\\u0648\\u0627 \\u0627\\u0644\\u063a\\u0627\\u064a\\u0627\\u062a.pdf\"]', NULL, NULL, '100', '50', 'ؤسيسيشسيبشسسسسب', NULL, '[\"1707221711_\\u0645\\u0646\\u0633\\u0642\\u0648\\u0627 \\u0627\\u0644\\u063a\\u0627\\u064a\\u0627\\u062a.pdf\"]', NULL, NULL, '50', '0', NULL, NULL, NULL, NULL, '50', '0', NULL, NULL, NULL, NULL, 0, NULL, '2024-02-06 12:11:08', '2024-02-06 12:18:01'),
(24, 17, 29, 92, 16, 22, '4', '2', '[\"1708207813_AI practical New_version.pdf\"]', 'مؤتمر الشباب', 'مؤتمر الشباب', '4', '4', 'كامل', 'نصف كامل', '[\"1708207830_AI practical New_version.pdf\"]', 'مؤتمر الشباب', 'مؤتمر الشباب', '4', '2', 'نصف كامل', '[\"1708207846_AI practical New_version.pdf\"]', 'مؤتمر الشباب', 'مؤتمر الشباب', '4', '1', 'ربع كامل', '[\"1708207860_AI practical New_version.pdf\"]', 'مؤتمر الشباب', 'مؤتمر الشباب', 0, NULL, '2024-02-17 22:08:34', '2024-02-17 22:39:37'),
(25, 17, 28, 93, 16, 22, '4', '4', '[\"1708212043_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '4', '1', 'مقبول', 'ممتاز', '[\"1708212067_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '4', '2', 'جيد', '[\"1708212092_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '4', '3', 'جيد جددا', '[\"1708212113_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', 0, NULL, '2024-02-17 23:08:21', '2024-02-17 23:31:46'),
(26, 23, 29, 94, 8, 22, '2', '2', '[\"1708212288_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '2', '2', 'ممتاز', 'ممتاز', '[\"1708212382_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '2', '1', 'جيد', '[\"1708212402_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '2', '2', 'ممتاز', '[\"1708212424_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', 0, NULL, '2024-02-17 23:08:45', '2024-02-17 23:34:01'),
(27, 24, 29, 92, 2, 22, '1', '1', '[\"1708211902_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '0', '0', NULL, 'ممتاز', NULL, NULL, NULL, '1', '1', 'ممتاز', '[\"1708211927_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '0', '0', NULL, NULL, NULL, NULL, 0, NULL, '2024-02-17 23:14:12', '2024-02-17 23:35:38'),
(28, 25, 29, 93, 10, 22, '2', '1', '[\"1708212143_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '2', '1', 'جيد', 'جيد', '[\"1708212165_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '4', '1', 'جيد', '[\"1708212189_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '2', '2', 'ممتاز', '[\"1708212213_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', 0, NULL, '2024-02-17 23:14:41', '2024-02-17 23:37:16'),
(29, 27, 29, 94, 2, 22, '1', '0', NULL, NULL, 'قلة الموارد', '0', '0', NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, '1', '1', 'ممتاز', '[\"1708212490_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', 0, NULL, '2024-02-17 23:15:10', '2024-02-17 23:37:57'),
(30, 28, 29, 94, 10, 22, '4', '0', NULL, NULL, 'قلة الموارد', '2', '2', 'ممتاز', 'لم رفع ملف', '[\"1708212543_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '3', '0', 'لم يرفع ملف', NULL, NULL, 'قلة الموارد', '1', '1', 'ممتاز', '[\"1708212580_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', 0, NULL, '2024-02-17 23:15:42', '2024-02-17 23:39:18'),
(31, 29, 29, 92, 2, 22, '1', '1', '[\"1708211960_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموارد', '0', '0', NULL, 'ممتاز', NULL, NULL, NULL, '1', '1', 'ممتاز', '[\"1708211987_AI practical New_version.pdf\"]', 'مؤتمر سنوي', 'قلة الموراد', '0', '0', NULL, NULL, NULL, NULL, 0, NULL, '2024-02-17 23:16:07', '2024-02-17 23:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `mokasher_inputs`
--

CREATE TABLE `mokasher_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` bigint(20) DEFAULT NULL,
  `equation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mokasher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mokasher_inputs`
--

INSERT INTO `mokasher_inputs` (`id`, `type`, `target`, `equation`, `users`, `mokasher_id`, `created_at`, `updated_at`) VALUES
(2, 'num', NULL, 'total', '[\"3\",\"5\",\"10\",\"13\",\"19\",\"20\"]', 2, '2024-01-16 17:28:28', '2024-01-30 23:11:29'),
(3, 'num', NULL, 'total', '[\"19\",\"20\"]', 3, '2024-01-18 17:35:08', '2024-02-02 22:26:57'),
(4, 'parcent', NULL, 'total', '[\"10\",\"13\"]', 11, '2024-01-26 17:42:02', '2024-01-26 17:42:02'),
(5, 'parcent', NULL, 'total', '[\"3\",\"10\",\"13\",\"19\",\"20\"]', 10, '2024-01-26 18:56:16', '2024-02-01 14:12:49'),
(6, 'parcent', NULL, 'total', '[\"10\",\"13\",\"19\"]', 14, '2024-01-26 19:19:09', '2024-01-30 23:36:58'),
(7, 'parcent', NULL, 'total', '[\"19\",\"20\"]', 16, '2024-01-30 21:09:24', '2024-01-30 21:09:24'),
(8, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 17, '2024-02-04 21:15:11', '2024-02-17 22:06:11'),
(9, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 22, '2024-02-04 21:17:37', '2024-02-04 21:49:01'),
(10, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 23, '2024-02-04 21:18:17', '2024-02-04 21:50:31'),
(11, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"68\"]', 24, '2024-02-04 21:36:07', '2024-02-05 18:17:13'),
(12, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 25, '2024-02-04 21:46:47', '2024-02-04 22:09:43'),
(13, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"52\",\"68\"]', 27, '2024-02-04 21:54:15', '2024-02-05 18:20:58'),
(14, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"52\",\"68\"]', 28, '2024-02-04 21:57:24', '2024-02-05 18:21:32'),
(15, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"71\"]', 29, '2024-02-04 22:03:23', '2024-02-05 18:24:55'),
(16, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"73\"]', 30, '2024-02-04 22:07:49', '2024-02-05 18:42:34'),
(17, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"73\"]', 31, '2024-02-04 22:08:47', '2024-02-05 18:42:52'),
(18, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\"]', 32, '2024-02-04 22:12:09', '2024-02-05 18:43:34'),
(19, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\"]', 33, '2024-02-04 22:12:43', '2024-02-05 18:43:57'),
(20, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\"]', 34, '2024-02-04 22:13:34', '2024-02-05 18:44:23'),
(21, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\",\"71\"]', 35, '2024-02-04 22:13:55', '2024-02-05 18:44:52'),
(22, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\",\"73\"]', 44, '2024-02-04 22:14:15', '2024-02-05 18:45:25'),
(23, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\"]', 36, '2024-02-04 22:15:38', '2024-02-05 18:45:55'),
(24, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\"]', 37, '2024-02-04 22:15:58', '2024-02-05 18:46:16'),
(25, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"55\"]', 42, '2024-02-04 22:18:35', '2024-02-05 18:55:36'),
(26, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"58\"]', 51, '2024-02-04 22:23:15', '2024-02-05 18:56:40'),
(27, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 52, '2024-02-04 22:24:28', '2024-02-04 22:24:28'),
(28, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"58\"]', 56, '2024-02-04 22:25:40', '2024-02-05 19:01:37'),
(29, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"58\"]', 57, '2024-02-04 22:26:15', '2024-02-05 19:01:59'),
(30, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 60, '2024-02-04 22:28:59', '2024-02-04 22:28:59'),
(31, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"70\"]', 61, '2024-02-04 22:29:50', '2024-02-05 19:05:55'),
(32, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"70\"]', 62, '2024-02-04 22:30:03', '2024-02-05 19:06:10'),
(33, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"58\"]', 63, '2024-02-04 22:34:41', '2024-02-05 19:06:36'),
(34, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"61\"]', 69, '2024-02-04 22:41:01', '2024-02-05 19:19:34'),
(35, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"61\"]', 70, '2024-02-04 22:41:16', '2024-02-05 19:20:07'),
(36, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"61\"]', 71, '2024-02-04 22:41:57', '2024-02-05 19:21:03'),
(37, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"61\"]', 72, '2024-02-04 22:42:22', '2024-02-05 19:21:16'),
(38, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"61\"]', 73, '2024-02-04 22:42:44', '2024-02-05 19:21:34'),
(39, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 75, '2024-02-04 22:43:21', '2024-02-04 22:43:21'),
(40, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 77, '2024-02-04 22:44:26', '2024-02-04 22:44:26'),
(41, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"69\"]', 87, '2024-02-04 22:47:18', '2024-02-05 19:32:16'),
(42, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"69\"]', 88, '2024-02-04 22:48:34', '2024-02-05 19:33:30'),
(43, 'parcent', NULL, 'total', '[\"69\"]', 89, '2024-02-04 22:49:12', '2024-02-05 19:34:43'),
(44, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"69\"]', 90, '2024-02-04 22:49:46', '2024-02-05 19:35:01'),
(45, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"56\"]', 91, '2024-02-04 22:53:35', '2024-02-05 19:36:00'),
(46, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 92, '2024-02-04 22:54:00', '2024-02-04 22:54:00'),
(47, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 93, '2024-02-04 22:56:39', '2024-02-04 22:56:39'),
(48, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 94, '2024-02-04 22:57:18', '2024-02-04 22:57:18'),
(49, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 96, '2024-02-04 22:58:13', '2024-02-05 19:41:27'),
(50, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"79\"]', 97, '2024-02-04 22:59:31', '2024-02-05 19:45:20'),
(51, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 98, '2024-02-04 23:01:44', '2024-02-04 23:01:44'),
(52, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 100, '2024-02-04 23:03:50', '2024-02-05 19:47:05'),
(53, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 101, '2024-02-04 23:07:26', '2024-02-05 19:47:46'),
(54, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 103, '2024-02-04 23:08:18', '2024-02-05 19:50:05'),
(55, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 104, '2024-02-04 23:08:50', '2024-02-05 19:50:25'),
(56, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 105, '2024-02-04 23:09:27', '2024-02-05 19:50:37'),
(57, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 106, '2024-02-04 23:10:55', '2024-02-05 19:51:07'),
(58, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 107, '2024-02-04 23:11:33', '2024-02-05 19:51:40'),
(59, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 108, '2024-02-04 23:12:27', '2024-02-05 19:52:19'),
(60, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 109, '2024-02-04 23:12:49', '2024-02-05 19:52:41'),
(61, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"61\"]', 110, '2024-02-04 23:14:05', '2024-02-05 19:53:32'),
(62, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 111, '2024-02-04 23:14:24', '2024-02-05 19:53:50'),
(63, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 112, '2024-02-04 23:15:09', '2024-02-05 19:54:24'),
(64, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 113, '2024-02-04 23:16:02', '2024-02-05 19:54:37'),
(65, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 119, '2024-02-04 23:17:58', '2024-02-04 23:17:58'),
(66, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"44\"]', 122, '2024-02-04 23:18:54', '2024-02-05 20:05:08'),
(67, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 127, '2024-02-04 23:21:13', '2024-02-05 20:09:06'),
(68, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 128, '2024-02-04 23:24:17', '2024-02-04 23:24:17'),
(69, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 129, '2024-02-04 23:24:38', '2024-02-04 23:24:38'),
(70, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 130, '2024-02-04 23:25:26', '2024-02-04 23:25:26'),
(71, 'parcent', NULL, 'total', '[\"30\",\"37\"]', 131, '2024-02-04 23:26:29', '2024-02-04 23:26:29'),
(72, 'parcent', NULL, 'total', '[\"29\"]', 134, '2024-02-04 23:27:52', '2024-02-04 23:27:52'),
(73, 'num', NULL, 'total', '[\"29\",\"30\",\"35\",\"37\"]', 136, '2024-02-04 23:29:05', '2024-02-04 23:29:05'),
(74, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"81\"]', 145, '2024-02-04 23:30:56', '2024-02-05 20:25:56'),
(75, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"81\"]', 146, '2024-02-04 23:31:26', '2024-02-05 20:27:00'),
(76, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"51\"]', 151, '2024-02-04 23:32:22', '2024-02-05 20:35:14'),
(77, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"66\"]', 154, '2024-02-04 23:32:50', '2024-02-05 20:38:39'),
(78, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"69\"]', 156, '2024-02-04 23:33:37', '2024-02-05 20:39:59'),
(79, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 160, '2024-02-04 23:34:55', '2024-02-05 20:47:46'),
(80, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 161, '2024-02-04 23:35:46', '2024-02-05 20:48:08'),
(81, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"59\"]', 162, '2024-02-04 23:36:11', '2024-02-05 20:48:21'),
(82, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"88\"]', 163, '2024-02-04 23:36:55', '2024-02-05 20:58:35'),
(83, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 166, '2024-02-04 23:38:11', '2024-02-04 23:38:11'),
(84, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\"]', 167, '2024-02-04 23:38:44', '2024-02-04 23:38:44'),
(85, 'parcent', NULL, 'total', '[\"39\",\"40\",\"44\"]', 171, '2024-02-04 23:42:05', '2024-02-04 23:42:05'),
(86, 'parcent', NULL, 'total', '[\"39\",\"40\",\"44\"]', 172, '2024-02-04 23:42:53', '2024-02-04 23:42:53'),
(87, 'parcent', NULL, 'total', '[\"39\",\"40\",\"44\"]', 173, '2024-02-04 23:43:45', '2024-02-04 23:43:45'),
(88, 'parcent', NULL, 'total', '[\"39\",\"40\",\"44\"]', 174, '2024-02-04 23:44:25', '2024-02-04 23:44:25'),
(89, 'parcent', NULL, 'total', '[\"29\",\"44\"]', 175, '2024-02-04 23:45:28', '2024-02-04 23:45:28'),
(90, 'parcent', NULL, 'total', '[\"29\",\"44\"]', 176, '2024-02-04 23:46:11', '2024-02-04 23:46:11'),
(91, 'parcent', NULL, 'total', '[\"29\",\"44\"]', 177, '2024-02-04 23:46:58', '2024-02-04 23:46:58'),
(92, 'parcent', NULL, 'total', '[\"29\",\"44\"]', 178, '2024-02-04 23:47:30', '2024-02-04 23:47:30'),
(93, 'parcent', NULL, 'total', '[\"35\",\"44\"]', 179, '2024-02-04 23:48:27', '2024-02-04 23:48:27'),
(94, 'parcent', NULL, 'total', '[\"35\",\"44\"]', 180, '2024-02-04 23:48:56', '2024-02-04 23:48:56'),
(95, 'parcent', NULL, 'total', '[\"35\",\"44\"]', 181, '2024-02-04 23:49:38', '2024-02-04 23:49:38'),
(96, 'parcent', NULL, 'total', '[\"35\",\"44\"]', 182, '2024-02-04 23:50:03', '2024-02-04 23:50:03'),
(97, 'parcent', NULL, 'total', '[\"44\"]', 183, '2024-02-04 23:50:49', '2024-02-04 23:50:49'),
(98, 'parcent', NULL, 'total', '[\"44\"]', 184, '2024-02-04 23:51:17', '2024-02-04 23:51:17'),
(99, 'parcent', NULL, 'total', '[\"44\"]', 185, '2024-02-04 23:51:53', '2024-02-04 23:51:53'),
(100, 'parcent', NULL, 'total', '[\"44\"]', 186, '2024-02-04 23:52:24', '2024-02-04 23:52:24'),
(101, 'parcent', NULL, 'total', '[\"44\"]', 187, '2024-02-04 23:53:15', '2024-02-04 23:53:15'),
(102, 'parcent', NULL, 'total', '[\"44\"]', 188, '2024-02-04 23:54:54', '2024-02-04 23:54:54'),
(103, 'parcent', NULL, 'total', '[\"44\"]', 189, '2024-02-04 23:55:17', '2024-02-04 23:55:17'),
(104, 'parcent', NULL, 'total', '[\"44\"]', 190, '2024-02-04 23:55:50', '2024-02-04 23:55:50'),
(105, 'parcent', NULL, 'total', '[\"44\"]', 191, '2024-02-04 23:56:23', '2024-02-04 23:56:23'),
(106, 'parcent', NULL, 'total', '[\"44\"]', 194, '2024-02-04 23:57:54', '2024-02-04 23:57:54'),
(107, 'parcent', NULL, 'total', '[\"44\"]', 195, '2024-02-04 23:58:42', '2024-02-04 23:58:42'),
(108, 'parcent', NULL, 'total', '[\"44\"]', 196, '2024-02-05 00:00:01', '2024-02-05 00:00:01'),
(109, 'parcent', NULL, 'total', '[\"44\"]', 197, '2024-02-05 00:00:40', '2024-02-05 00:00:40'),
(110, 'parcent', NULL, 'total', '[\"44\",\"89\"]', 198, '2024-02-05 00:01:30', '2024-02-05 21:10:37'),
(111, 'parcent', NULL, 'total', '[\"44\"]', 199, '2024-02-05 00:01:57', '2024-02-05 00:01:57'),
(112, 'parcent', NULL, 'total', '[\"44\"]', 200, '2024-02-05 00:02:40', '2024-02-05 00:02:40'),
(113, 'parcent', NULL, 'total', '[\"44\"]', 201, '2024-02-05 00:03:02', '2024-02-05 00:03:02'),
(114, 'parcent', NULL, 'total', '[\"44\"]', 202, '2024-02-05 00:03:31', '2024-02-05 00:03:31'),
(115, 'parcent', NULL, 'total', '[\"44\"]', 203, '2024-02-05 00:04:15', '2024-02-05 00:04:15'),
(116, 'parcent', NULL, 'total', '[\"44\"]', 204, '2024-02-05 00:04:37', '2024-02-05 00:04:37'),
(117, 'parcent', NULL, 'total', '[\"44\"]', 205, '2024-02-05 00:05:17', '2024-02-05 00:05:17'),
(118, 'parcent', NULL, 'total', '[\"44\"]', 206, '2024-02-05 00:05:44', '2024-02-05 00:05:44'),
(119, 'parcent', NULL, 'total', '[\"44\"]', 207, '2024-02-05 00:06:19', '2024-02-05 00:06:19'),
(120, 'parcent', NULL, 'total', '[\"44\"]', 208, '2024-02-05 00:06:55', '2024-02-05 00:06:55'),
(121, 'num', NULL, 'total', '[\"45\"]', 18, '2024-02-05 18:15:27', '2024-02-05 18:15:27'),
(122, 'parcent', NULL, 'total', '[\"68\"]', 26, '2024-02-05 18:19:52', '2024-02-05 18:19:52'),
(123, 'num', NULL, 'total', '[\"45\"]', 45, '2024-02-05 18:27:07', '2024-02-05 18:27:07'),
(124, 'parcent', NULL, 'total', '[\"45\"]', 46, '2024-02-05 18:27:25', '2024-02-05 18:27:25'),
(125, 'num', NULL, 'total', '[\"55\"]', 47, '2024-02-05 18:39:26', '2024-02-05 18:39:26'),
(126, 'num', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"53\"]', 48, '2024-02-05 18:41:10', '2024-02-05 18:41:10'),
(127, 'num', NULL, 'total', '[\"72\"]', 49, '2024-02-05 18:41:33', '2024-02-05 18:41:33'),
(128, 'num', NULL, 'total', '[\"72\"]', 50, '2024-02-05 18:41:51', '2024-02-05 18:41:51'),
(129, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"54\",\"61\"]', 38, '2024-02-05 18:47:59', '2024-02-05 18:48:36'),
(130, 'num', NULL, 'total', '[\"54\",\"74\"]', 39, '2024-02-05 18:53:26', '2024-02-05 18:53:26'),
(131, 'parcent', NULL, 'total', '[\"75\"]', 40, '2024-02-05 18:54:04', '2024-02-05 18:54:04'),
(132, 'parcent', NULL, 'total', '[\"55\",\"75\"]', 41, '2024-02-05 18:55:16', '2024-02-05 18:55:16'),
(133, 'num', NULL, 'total', '[\"58\",\"76\"]', 53, '2024-02-05 18:59:21', '2024-02-05 18:59:21'),
(134, 'parcent', NULL, 'total', '[\"58\"]', 54, '2024-02-05 19:00:27', '2024-02-05 19:00:27'),
(135, 'num', NULL, 'total', '[\"58\"]', 55, '2024-02-05 19:00:46', '2024-02-05 19:00:50'),
(136, 'num', NULL, 'total', '[\"58\"]', 58, '2024-02-05 19:02:26', '2024-02-05 19:02:26'),
(137, 'parcent', NULL, 'total', '[\"58\"]', 59, '2024-02-05 19:03:27', '2024-02-05 19:03:27'),
(138, 'num', NULL, 'total', '[\"58\",\"76\"]', 64, '2024-02-05 19:14:00', '2024-02-05 19:14:00'),
(139, 'num', NULL, 'total', '[\"58\",\"76\"]', 65, '2024-02-05 19:16:13', '2024-02-05 19:16:13'),
(140, 'num', NULL, 'total', '[\"58\",\"76\"]', 66, '2024-02-05 19:17:02', '2024-02-05 19:17:02'),
(141, 'num', NULL, 'total', '[\"58\",\"76\"]', 67, '2024-02-05 19:17:55', '2024-02-05 19:17:55'),
(142, 'num', NULL, 'total', '[\"58\",\"76\"]', 68, '2024-02-05 19:18:59', '2024-02-05 19:18:59'),
(143, 'num', NULL, 'total', '[\"68\"]', 74, '2024-02-05 19:22:22', '2024-02-05 19:22:22'),
(144, 'parcent', NULL, 'total', '[\"56\"]', 78, '2024-02-05 19:28:06', '2024-02-05 19:28:06'),
(145, 'num', NULL, 'total', '[\"77\"]', 79, '2024-02-05 19:31:19', '2024-02-05 19:31:19'),
(146, 'num', NULL, 'total', '[\"77\"]', 80, '2024-02-05 19:31:37', '2024-02-05 19:31:37'),
(147, 'num', NULL, 'total', '[\"78\"]', 95, '2024-02-05 19:41:00', '2024-02-05 19:41:00'),
(148, 'parcent', NULL, 'total', '[\"59\"]', 99, '2024-02-05 19:46:03', '2024-02-05 19:48:18'),
(149, 'num', NULL, 'total', '[\"59\"]', 102, '2024-02-05 19:49:46', '2024-02-05 19:49:46'),
(150, 'parcent', NULL, 'total', '[\"78\"]', 114, '2024-02-05 19:55:43', '2024-02-05 19:55:43'),
(151, 'num', NULL, 'total', '[\"78\"]', 115, '2024-02-05 19:56:37', '2024-02-05 19:56:37'),
(152, 'num', NULL, 'total', '[\"57\"]', 116, '2024-02-05 19:58:17', '2024-02-05 19:58:17'),
(153, 'parcent', NULL, 'total', '[\"57\"]', 117, '2024-02-05 19:59:08', '2024-02-05 19:59:08'),
(154, 'num', NULL, 'total', '[\"57\"]', 118, '2024-02-05 19:59:39', '2024-02-05 19:59:39'),
(155, 'num', NULL, 'total', '[\"80\"]', 120, '2024-02-05 20:04:09', '2024-02-05 20:04:09'),
(156, 'num', NULL, 'total', '[\"80\"]', 121, '2024-02-05 20:04:31', '2024-02-05 20:04:31'),
(157, 'parcent', NULL, 'total', '[\"37\",\"44\"]', 123, '2024-02-05 20:06:21', '2024-02-05 20:06:21'),
(158, 'parcent', NULL, 'total', '[\"37\",\"44\"]', 124, '2024-02-05 20:07:11', '2024-02-05 20:07:11'),
(159, 'num', NULL, 'total', '[\"44\"]', 125, '2024-02-05 20:07:34', '2024-02-05 20:07:38'),
(160, 'num', NULL, 'total', '[\"44\"]', 126, '2024-02-05 20:08:26', '2024-02-05 20:08:26'),
(161, 'num', NULL, 'total', '[\"60\"]', 132, '2024-02-05 20:10:37', '2024-02-05 20:10:37'),
(162, 'num', NULL, 'total', '[\"29\",\"57\"]', 133, '2024-02-05 20:11:34', '2024-02-05 20:11:34'),
(163, 'num', NULL, 'total', '[\"60\"]', 135, '2024-02-05 20:13:25', '2024-02-05 20:13:25'),
(164, 'num', NULL, 'total', '[\"59\"]', 137, '2024-02-05 20:14:27', '2024-02-05 20:14:27'),
(165, 'parcent', NULL, 'total', '[\"81\"]', 138, '2024-02-05 20:20:41', '2024-02-05 20:20:41'),
(166, 'parcent', NULL, 'total', '[\"82\"]', 139, '2024-02-05 20:20:57', '2024-02-05 20:20:57'),
(167, 'parcent', NULL, 'total', '[\"83\"]', 140, '2024-02-05 20:21:21', '2024-02-05 20:21:21'),
(168, 'parcent', NULL, 'total', '[\"83\"]', 141, '2024-02-05 20:21:30', '2024-02-05 20:21:30'),
(169, 'parcent', NULL, 'total', '[\"84\"]', 142, '2024-02-05 20:23:40', '2024-02-05 20:23:40'),
(170, 'num', NULL, 'total', '[\"84\"]', 143, '2024-02-05 20:23:58', '2024-02-05 20:23:58'),
(171, 'num', NULL, 'total', '[\"68\"]', 144, '2024-02-05 20:24:57', '2024-02-05 20:24:57'),
(172, 'parcent', NULL, 'total', '[\"51\",\"85\"]', 147, '2024-02-05 20:33:00', '2024-02-05 20:33:00'),
(173, 'num', NULL, 'total', '[\"51\"]', 148, '2024-02-05 20:33:52', '2024-02-05 20:33:52'),
(174, 'num', NULL, 'total', '[\"66\"]', 150, '2024-02-05 20:34:41', '2024-02-05 20:34:41'),
(175, 'num', NULL, 'total', '[\"51\"]', 152, '2024-02-05 20:35:53', '2024-02-05 20:35:53'),
(176, 'num', NULL, 'total', '[\"86\"]', 153, '2024-02-05 20:37:44', '2024-02-05 20:37:44'),
(177, 'num', NULL, 'total', '[\"51\"]', 155, '2024-02-05 20:39:15', '2024-02-05 20:39:15'),
(178, 'num', NULL, 'total', '[\"51\"]', 158, '2024-02-05 20:43:02', '2024-02-05 20:43:02'),
(179, 'parcent', NULL, 'total', '[\"87\"]', 157, '2024-02-05 20:44:40', '2024-02-05 20:44:40'),
(180, 'num', NULL, 'total', '[\"66\"]', 159, '2024-02-05 20:47:08', '2024-02-05 20:47:08'),
(181, 'num', NULL, 'total', '[\"65\"]', 164, '2024-02-05 20:59:49', '2024-02-05 20:59:49'),
(182, 'num', NULL, 'total', '[\"76\"]', 165, '2024-02-05 21:01:05', '2024-02-05 21:01:05'),
(183, 'num', NULL, 'total', '[\"88\"]', 168, '2024-02-05 21:01:57', '2024-02-05 21:01:57'),
(184, 'parcent', NULL, 'total', '[\"88\",\"89\"]', 169, '2024-02-05 21:03:43', '2024-02-05 21:05:02'),
(185, 'parcent', NULL, 'total', '[\"88\",\"89\"]', 170, '2024-02-05 21:05:37', '2024-02-05 21:05:37'),
(186, 'num', NULL, 'total', '[\"66\"]', 192, '2024-02-05 21:09:03', '2024-02-05 21:09:03'),
(187, 'num', NULL, 'total', '[\"89\"]', 193, '2024-02-05 21:09:16', '2024-02-05 21:09:16'),
(188, 'num', NULL, 'total', '[\"90\"]', 209, '2024-02-05 21:14:18', '2024-02-05 21:14:18'),
(189, 'num', NULL, 'total', '[\"90\"]', 229, '2024-02-05 21:15:04', '2024-02-05 21:15:04'),
(190, 'num', NULL, 'total', '[\"75\"]', 243, '2024-02-05 21:16:42', '2024-02-05 21:16:42'),
(191, 'parcent', NULL, 'total', '[\"75\"]', 244, '2024-02-05 21:17:20', '2024-02-05 21:17:20'),
(192, 'parcent', NULL, 'total', '[\"75\"]', 245, '2024-02-05 21:17:48', '2024-02-05 21:17:48'),
(193, 'parcent', NULL, 'total', '[\"75\"]', 246, '2024-02-05 21:18:03', '2024-02-05 21:18:03'),
(194, 'parcent', NULL, 'total', '[\"75\"]', 247, '2024-02-05 21:18:21', '2024-02-05 21:18:21'),
(195, 'parcent', NULL, 'total', '[\"75\"]', 248, '2024-02-05 21:19:53', '2024-02-05 21:19:53'),
(196, 'parcent', NULL, 'total', '[\"75\"]', 249, '2024-02-05 21:20:37', '2024-02-05 21:20:37'),
(197, 'parcent', NULL, 'total', '[\"75\"]', 250, '2024-02-05 21:21:34', '2024-02-05 21:21:34'),
(198, 'parcent', NULL, 'total', '[\"75\"]', 251, '2024-02-05 21:22:18', '2024-02-05 21:22:18'),
(199, 'parcent', NULL, 'total', '[\"75\"]', 252, '2024-02-05 21:22:54', '2024-02-05 21:22:54'),
(200, 'parcent', NULL, 'total', '[\"75\"]', 256, '2024-02-05 21:23:44', '2024-02-05 21:23:44'),
(201, 'parcent', NULL, 'total', '[\"75\"]', 253, '2024-02-05 21:25:25', '2024-02-05 21:25:25'),
(202, 'parcent', NULL, 'total', '[\"75\"]', 254, '2024-02-05 21:26:13', '2024-02-05 21:26:13'),
(203, 'parcent', NULL, 'total', '[\"75\"]', 255, '2024-02-05 21:26:55', '2024-02-05 21:26:55'),
(204, 'num', NULL, 'total', '[\"75\"]', 257, '2024-02-05 21:28:03', '2024-02-05 21:28:10'),
(205, 'parcent', NULL, 'total', '[\"75\"]', 258, '2024-02-05 21:29:02', '2024-02-05 21:29:02'),
(206, 'num', NULL, 'total', '[\"75\"]', 259, '2024-02-05 21:29:29', '2024-02-05 21:29:40'),
(207, 'parcent', NULL, 'total', '[\"75\"]', 260, '2024-02-05 21:30:02', '2024-02-05 21:30:02'),
(208, 'parcent', NULL, 'total', '[\"75\"]', 261, '2024-02-05 21:30:23', '2024-02-05 21:30:23'),
(209, 'parcent', NULL, 'total', '[\"75\",\"91\"]', 262, '2024-02-05 21:33:58', '2024-02-05 21:33:58'),
(210, 'parcent', NULL, 'total', '[\"26\",\"27\",\"28\",\"29\",\"30\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"52\"]', 263, '2024-02-05 21:46:18', '2024-02-05 21:46:18'),
(211, 'parcent', NULL, 'total', '[\"75\"]', 264, '2024-02-05 21:46:37', '2024-02-05 21:46:37'),
(212, 'parcent', NULL, 'total', '[\"91\"]', 265, '2024-02-05 21:47:09', '2024-02-05 21:47:09'),
(213, 'parcent', NULL, 'total', '[\"75\"]', 266, '2024-02-05 21:47:36', '2024-02-05 21:47:36'),
(214, 'parcent', NULL, 'total', '[\"75\"]', 267, '2024-02-05 21:48:14', '2024-02-05 21:48:14'),
(215, 'parcent', NULL, 'total', '[\"75\"]', 268, '2024-02-05 21:48:48', '2024-02-05 21:48:48'),
(216, 'parcent', NULL, 'total', '[\"75\"]', 269, '2024-02-05 21:49:19', '2024-02-05 21:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objectives`
--

CREATE TABLE `objectives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objective` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kheta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `objectives`
--

INSERT INTO `objectives` (`id`, `objective`, `kheta_id`, `created_at`, `updated_at`) VALUES
(3, 'طلاب وخريجون متميزون ومؤهلون لوظائف المستقبل', 4, '2024-01-15 16:27:51', '2024-01-15 16:27:51'),
(4, 'تميز منظومة الدراسات العليا والبحث العلمي', 4, '2024-01-15 16:28:40', '2024-01-15 16:28:40'),
(5, 'كسب ثقة المجتمع', 4, '2024-01-15 16:29:49', '2024-01-15 16:29:49'),
(6, 'تفعيل الاستراتيجية الوطنية للتغيرات المناخية', 4, '2024-01-15 16:31:14', '2024-01-15 16:31:14'),
(7, 'حوكمة وجودة الأداء المؤسسي', 4, '2024-01-15 16:31:58', '2024-01-15 16:31:58'),
(8, 'تنمية الموارد', 4, '2024-01-15 16:32:30', '2024-01-15 16:32:30'),
(9, 'تعزيز القدرة الاستيعابية للجامعة', 4, '2024-01-15 16:33:00', '2024-01-15 16:33:00'),
(13, 'طلاب وخريجون متميزون ومؤهلون لوظائف المستقبل', 6, '2024-02-03 18:11:20', '2024-02-03 18:11:20'),
(14, 'تميز منظومة الدراسات العليا والبحث العلمي', 6, '2024-02-03 18:13:20', '2024-02-03 18:13:20'),
(15, 'كسب ثقة المجتمع', 6, '2024-02-03 18:14:13', '2024-02-03 18:14:13'),
(16, 'تفعيل الاستراتيجية الوطنية للتغيرات المناخية', 6, '2024-02-03 18:14:57', '2024-02-03 18:14:57'),
(17, 'حوكمة وجودة الأداء المؤسسي', 6, '2024-02-03 18:15:31', '2024-02-03 18:15:31'),
(18, 'تنمية الموارد', 6, '2024-02-03 18:15:59', '2024-02-03 18:15:59'),
(19, 'تعزيز القدرة الاستيعابية للجامعة', 6, '2024-02-03 18:16:17', '2024-02-03 18:16:17'),
(20, 'تعزيز المكانة والسمعة الدولية للجامعة', 6, '2024-02-03 18:17:05', '2024-02-03 18:17:05'),
(21, 'جامعة ذكية', 6, '2024-02-03 18:17:40', '2024-02-03 18:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: pending, 2: completed, 3: cancelled, 4: rejected',
  `total_amount` double(8,2) NOT NULL,
  `date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1: active, 2: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `goal_id` bigint(20) UNSIGNED NOT NULL,
  `addedBy` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program`, `added`, `goal_id`, `addedBy`, `created_at`, `updated_at`) VALUES
(4, 'تطوير آليات عمل نظام القبول والتحويلات بالجامعة', NULL, 3, 0, '2024-01-15 17:23:00', '2024-01-15 17:23:00'),
(5, 'rf2we', NULL, 13, 0, '2024-01-16 19:44:57', '2024-01-16 19:44:57'),
(6, 'fdgvdd', NULL, 13, 0, '2024-01-16 19:45:03', '2024-01-16 19:45:03'),
(7, 'مستشفي كلية الطب', NULL, 3, 13, '2024-01-19 07:26:04', '2024-01-19 07:26:04'),
(10, 'استحداث برامج تعليمية جديدة', NULL, 3, 0, '2024-01-30 21:35:04', '2024-01-30 21:35:04'),
(13, 'اتات', NULL, 3, 0, '2024-01-30 21:42:41', '2024-01-30 21:42:41'),
(21, 'هيما2', NULL, 3, 19, '2024-01-31 00:08:36', '2024-01-31 00:09:54'),
(22, 'تطوير آليات عمل نظام القبول والتحويلات بالجامعة', NULL, 14, 0, '2024-02-03 18:24:44', '2024-02-03 18:24:44'),
(26, 'استحداث برامج تعليمية جديدة', NULL, 15, 0, '2024-02-03 18:38:52', '2024-02-03 18:38:52'),
(27, 'تطوير استراتيجيات التدريس والتعلم', NULL, 16, 0, '2024-02-03 18:40:09', '2024-02-03 18:40:09'),
(28, 'تفعيل وحدات القياس والتقويم بالكليات', NULL, 16, 0, '2024-02-03 18:43:54', '2024-02-03 18:43:54'),
(29, 'إنشاء وحدات الإبداع والابتكار والموهوبين بالكليات وتفعيلها', NULL, 17, 0, '2024-02-03 18:48:33', '2024-02-03 18:48:33'),
(30, 'إعداد خطة للأنشطة الطلابية متكاملة ومتميزة بالجامعة والكليات وتفعيلها', NULL, 18, 0, '2024-02-03 18:52:03', '2024-02-03 18:52:03'),
(31, 'تطوير الخدمات الصحية وخدمات الدعم الاجتماعي للطلاب', NULL, 18, 0, '2024-02-03 19:25:01', '2024-02-03 19:25:01'),
(32, 'رفع كفاءة وحدات متابعة الخريجين بالكليات/ الجامعة لتنمية المهارات المهنية لوظائف المستقبل', NULL, 19, 0, '2024-02-03 19:26:56', '2024-02-04 02:27:55'),
(33, 'استحداث برامج أكاديمية للدراسات العليا تلبي احتياجات سوق العمل ومرتبطة بالصناعة', NULL, 20, 0, '2024-02-03 20:19:03', '2024-02-03 20:19:03'),
(34, 'كلية الدراسات العليا للعلوم التطبيقية والتكنولوجيا بمقر الجامعة الحكومي بالعبور.', NULL, 20, 0, '2024-02-03 20:39:00', '2024-02-03 20:39:00'),
(35, 'آليات جذب الطلاب الوافدين للالتحاق بالبرامج الأكاديمية المستحدثة والمطورة للدراسات العليا', NULL, 20, 0, '2024-02-03 20:55:05', '2024-02-03 20:55:43'),
(36, 'خطة بحثية بالجامعة تتوافق والخطط البحثية على المستوى القومي', NULL, 21, 0, '2024-02-03 21:06:03', '2024-02-03 21:06:03'),
(37, 'إعداد بحوث تطبيقية تخدم إقليم القليوبية ومرتبطة بالصناعة ذات مردود اقتصادي', NULL, 21, 0, '2024-02-03 21:11:21', '2024-02-03 21:11:21'),
(38, 'زيادة عدد الحاضنات بأنواعها المختلفة للجامعة', NULL, 22, 0, '2024-02-03 21:15:03', '2024-02-03 21:15:03'),
(39, 'واد للتكنولوجية بالجامعة بالعبور', NULL, 22, 0, '2024-02-03 21:16:31', '2024-02-03 21:16:31'),
(40, 'برامج للتوعية والتعريف بخدمات الحاضنة ومجالات عملها', NULL, 22, 0, '2024-02-03 21:17:44', '2024-02-03 21:17:44'),
(41, 'دعم الأفكار الريادية والواعدة من أعضاء هيئة التدريس، والباحثين، والطلاب، والمبتكرين', NULL, 22, 0, '2024-02-03 21:18:09', '2024-02-03 21:18:09'),
(42, 'عقد اتفاقيات وشراكات مع الجامعات الإقليمية والعالمية والبنوك والمجتمع المدني المحلي', NULL, 22, 0, '2024-02-03 21:20:52', '2024-02-03 21:20:52'),
(43, 'دعم الجامعة لأعضاء هيئة التدريس لحضور المؤتمرات المحلية-الدولية– ورش العمل – الندوات', NULL, 22, 0, '2024-02-03 21:21:16', '2024-02-03 21:21:16'),
(44, 'خطط للحصول على بعثات ومنح علمية تنافسية', NULL, 22, 0, '2024-02-03 21:24:33', '2024-02-03 21:24:33'),
(45, 'بناء قدرات ومهارات شباب الباحثين على مهارات النشر الدولي والحصول على المشروعات البحثية الممولة', NULL, 22, 0, '2024-02-03 21:34:04', '2024-02-03 21:34:04'),
(47, 'الارتقاء بمنظومة أخلاقيات البحث العلمي بالجامعة وكلياتها', NULL, 23, 0, '2024-02-03 21:41:55', '2024-02-03 21:41:55'),
(48, 'حوكمة حماية الملكية الفكرية بالجامعة وكلياتها', NULL, 23, 0, '2024-02-03 21:43:04', '2024-02-03 21:43:04'),
(49, 'تعظيم الاستفادة من مركز دعم الابتكار ونقل وتسويق التكنولوجيا (تايكو) بالجامعة', NULL, 23, 0, '2024-02-03 21:45:09', '2024-02-03 21:45:09'),
(55, 'تحديث قواعد بيانات المعامل، والمراكز البحثية، وإمكانياتها بجامعة، وكلياتها', NULL, 24, 0, '2024-02-03 22:05:00', '2024-02-03 22:05:00'),
(56, 'دعم وحدة المعامل والأجهزة العلمية كحلقة وصل بمعامل الأقسام البحثية والمعامل المركزية والمراكز البحثية بالجامعة متصلة مع البنك القومي بالمجلس الأعلى للجامعات', NULL, 24, 0, '2024-02-03 22:08:11', '2024-02-03 22:08:21'),
(57, 'تأهيل المعامل البحثية المركزية للحصول على شهادة الاعتماد الدولي للمعامل الدولي للمعامل', NULL, 24, 0, '2024-02-03 22:09:54', '2024-02-03 22:09:54'),
(58, 'الوصول بالمجلات العلمية بالجامعة إلي مستوى متميز بين المجلات المحلية والإقليمية والدولية', NULL, 24, 0, '2024-02-03 22:12:25', '2024-02-03 22:12:25'),
(59, 'مجلات علمية متخصصة في مجالات (علوم الحاسب- العلاج الطبيعي -الفنون التطبيقية)', NULL, 24, 0, '2024-02-03 22:13:40', '2024-02-03 22:13:40'),
(60, 'خطط سنوية مقدمة لخدمة المجتمع', NULL, 25, 0, '2024-02-03 22:31:16', '2024-02-03 22:31:16'),
(61, 'برامج تسويقية لمنتجات كليات الجامعة', NULL, 25, 0, '2024-02-03 22:32:30', '2024-02-03 22:32:30'),
(62, 'التنمية المهنية والتدريب على مهارات التوظيف للخريجين', NULL, 25, 0, '2024-02-03 22:33:47', '2024-02-03 22:33:47'),
(63, 'رفع كفاءة الوحدات ذات الطابع الخاص والمكاتب الاستشارية بالجامعة وكلياتها', NULL, 25, 0, '2024-02-03 22:34:43', '2024-02-03 22:34:43'),
(64, 'المشاركة في المبادرات الرئاسية', NULL, 26, 0, '2024-02-03 22:36:24', '2024-02-03 22:36:24'),
(65, 'المشاركة في أنشطة تنمية الأسرة المصرية', NULL, 26, 0, '2024-02-03 22:38:19', '2024-02-03 22:38:19'),
(66, 'المشاركة في برامج محو الأمية وتعليم الكبار', NULL, 26, 0, '2024-02-03 22:40:18', '2024-02-03 22:40:18'),
(67, 'المشاركة بين الجامعة والمجتمع والصناعة للمساهمة في التنمية المستدامة', NULL, 27, 0, '2024-02-03 22:42:23', '2024-02-03 22:42:23'),
(68, 'بروتوكولات وشراكات مع مؤسسات المجتمع', NULL, 27, 0, '2024-02-03 22:43:35', '2024-02-03 22:43:35'),
(69, 'المشاركة في القوافل المتكاملة. والمتخصصة', NULL, 27, 0, '2024-02-03 22:44:55', '2024-02-03 22:44:55'),
(70, 'تسويق البحوث التطبيقية', NULL, 27, 0, '2024-02-03 22:45:55', '2024-02-03 22:45:55'),
(71, 'تطوير الخدمة الصحية وفقا لمتطلبات معايير الجودة بالمستشفيات الجامعية', NULL, 28, 0, '2024-02-03 22:47:33', '2024-02-03 22:47:33'),
(72, 'تنوع الخدمات الصحية التخصصية لرعاية وسلامة المرضى', NULL, 28, 0, '2024-02-03 22:48:41', '2024-02-03 22:48:41'),
(73, 'تشجير الحرم الجامعي والحفاظ على الرقعة الخضراء', NULL, 29, 0, '2024-02-03 22:51:32', '2024-02-03 22:51:32'),
(74, 'زيادة عدد السيارات التي تعمل بالغاز أو الكهرباء', NULL, 29, 0, '2024-02-03 22:53:34', '2024-02-03 22:53:34'),
(75, 'التوسع في استخدام مصادر الطاقة المتجددة والطاقة النظيفة', NULL, 29, 0, '2024-02-03 22:55:35', '2024-02-03 22:55:35'),
(76, 'إعادة تدوير المخلفات بالجامعة', NULL, 29, 0, '2024-02-03 22:57:36', '2024-02-03 22:57:36'),
(77, 'تأهيل المباني القديمة للتكيف مع التغيرات المناخية مع الاحتفاظ بالطراز المعماري للمباني', NULL, 29, 0, '2024-02-03 23:00:10', '2024-02-03 23:00:10'),
(78, 'تطبيق مواصفات المباني الخضراء', NULL, 29, 0, '2024-02-03 23:02:43', '2024-02-03 23:02:43'),
(79, 'تأهيل كوادر لتعزيز التنمية المستدامة والتكيف مع التغيرات المناخية', NULL, 30, 0, '2024-02-03 23:05:35', '2024-02-03 23:05:35'),
(80, 'توجيه البحوث العلمية لوضع حلول مستقبلية للتكيف مع التغيرات المناخية والتنمية المستدامة', NULL, 31, 0, '2024-02-03 23:07:05', '2024-02-03 23:07:05'),
(81, 'تخفيف الآثار الاقتصادية السلبية الناتجة عن التغيرات المناخية', NULL, 31, 0, '2024-02-03 23:09:02', '2024-02-03 23:09:02'),
(82, 'الخدمات الوقائية لحماية المواطنين من أخطار التغيرات المناخية', NULL, 32, 0, '2024-02-03 23:11:01', '2024-02-03 23:11:01'),
(83, 'تعزيز الوعي المجتمعي بمخاطر التغيرات المناخية', NULL, 32, 0, '2024-02-03 23:14:07', '2024-02-03 23:14:14'),
(84, 'تطوير مقاييس تقييم أداء الكوادر البشرية', NULL, 33, 0, '2024-02-03 23:28:26', '2024-02-03 23:28:26'),
(85, 'تفعيل آليات المساءلة والمحاسبية/ مكافحة الفساد', NULL, 33, 0, '2024-02-03 23:30:28', '2024-02-03 23:30:28'),
(86, 'تطوير منظومة فحص شكاوى ومقترحات منسوبي الجامعة', NULL, 33, 0, '2024-02-03 23:32:00', '2024-02-03 23:32:00'),
(87, 'تدريب وتأهيل الكوادر البشرية في ضوء مهارات القرن الحادي والعشرين', NULL, 34, 0, '2024-02-03 23:33:51', '2024-02-03 23:33:51'),
(88, 'قواعد بيانات محدثة عن خبراء الجامعة', NULL, 34, 0, '2024-02-03 23:36:18', '2024-02-03 23:36:18'),
(89, 'تعزيز زيارات الدعم الفني لوحدات ضمان الجودة بالكليات', NULL, 35, 0, '2024-02-03 23:37:39', '2024-02-03 23:37:39'),
(91, 'تعزيز المتابعات الالكترونية والميدانية لتنفيذ الخطة الاستراتيجية بالجامعة وكلياتها', NULL, 35, 0, '2024-02-03 23:41:14', '2024-02-03 23:41:14'),
(92, 'استكمال تأهيل الجامعة وكلياتها وبرامجها الأكاديمية للاعتماد من الهيئة القومية لضمان جودة التعليم والاعتماد', NULL, 35, 0, '2024-02-03 23:41:49', '2024-02-03 23:41:49'),
(93, 'تأهيل معامل الجامعة وكلياتها للحصول على الاعتماد من الجهات المعنية', NULL, 35, 0, '2024-02-03 23:47:25', '2024-02-03 23:47:25'),
(94, 'ضمان استمرارية تطبيق وفاعلية نظم الجودة الإدارية بالجامعة', NULL, 35, 0, '2024-02-03 23:48:27', '2024-02-03 23:48:27'),
(95, 'تأهيل برامج الجامعة للحصول على الاعتماد من الجهات الدولية المعترف بها', NULL, 35, 0, '2024-02-03 23:49:38', '2024-02-03 23:49:38'),
(96, 'دعم ادارة الجامعة لمنسوبيها للتقدم للحصول على جوائز التميز', NULL, 36, 0, '2024-02-03 23:50:36', '2024-02-03 23:50:36'),
(97, 'تعظيم دور المراكز والوحدات ذات الطابع الخاص', NULL, 37, 0, '2024-02-03 23:56:29', '2024-02-03 23:56:29'),
(98, 'زيادة فاعلية المعارض الدائمة والموسمية بالجامعة وكلياتها بالداخل والخارج', NULL, 37, 0, '2024-02-03 23:57:52', '2024-02-03 23:57:52'),
(99, 'الادارة الاقتصادية لأصول الجامعة ببنها والعبور ومشتهر', NULL, 37, 0, '2024-02-03 23:59:44', '2024-02-03 23:59:44'),
(100, 'مشروعات ممولة من الجهات المانحة محليا ودوليا', NULL, 38, 0, '2024-02-04 00:01:21', '2024-02-04 00:01:21'),
(101, 'تطوير مصادر التمويل للبحوث البينية والتطبيقية', NULL, 39, 0, '2024-02-04 00:02:23', '2024-02-04 00:02:23'),
(102, 'استحداث برامج جديدة بمصروفات بكليات الجامعة', NULL, 40, 0, '2024-02-04 00:03:24', '2024-02-04 00:03:24'),
(103, 'تنفيذ خطة تطوير وتنمية موارد المدن الجامعية', NULL, 40, 0, '2024-02-04 00:05:23', '2024-02-04 00:05:23'),
(104, 'إنشاء مباني جديدة لكليتي التربية النوعية والفنون التطبيقية على أرض الجامعة بكفر سعد', NULL, 41, 0, '2024-02-04 00:09:32', '2024-02-04 00:09:32'),
(105, 'إنشاء مباني جديدة لكليات الطب البشري على أرض الجامعة بكفر سعد', NULL, 41, 0, '2024-02-04 00:12:42', '2024-02-04 23:44:53'),
(106, 'استكمال وتجهيز معامل كليات الجامعة بكفر سعد', NULL, 41, 0, '2024-02-04 00:15:10', '2024-02-04 00:15:10'),
(107, 'انشاء مبنى المدرجات في ارض الجامعة بكفر سعد', NULL, 41, 0, '2024-02-04 00:17:23', '2024-02-04 00:17:23'),
(108, 'استكمال وانشاء مباني جديدة بالجامعة وكلياتها في أرض جامعة بنها بالعبور (جامعة بنها التكنولوجية)', NULL, 41, 0, '2024-02-04 00:19:31', '2024-02-04 00:19:31'),
(109, 'استكمال مباني المستشفى الجامعي الجديد', NULL, 42, 0, '2024-02-04 00:23:41', '2024-02-04 00:23:51'),
(110, 'تجهيز المستشفى بالمعدات والأجهزة', NULL, 42, 0, '2024-02-04 00:24:55', '2024-02-04 00:24:55'),
(111, 'استكمال إنشاء وتطوير البنية التحتية التكنولوجية بالجامعة ومنشآتها', NULL, 43, 0, '2024-02-04 00:26:25', '2024-02-04 00:26:25'),
(112, 'تطوير منظومة المدن الجامعية الموجودة في كفر سعد وطوخ ومشتهر وشبرا', NULL, 44, 0, '2024-02-04 00:27:44', '2024-02-04 00:27:52'),
(113, 'إنشاء مدينة جامعية جديدة في أرض الجامعة بالعبور', NULL, 44, 0, '2024-02-04 00:28:41', '2024-02-04 00:28:41'),
(114, 'الصيانة الدورية لمنشآت الجامعة وكلياتها ومرافقها', NULL, 45, 0, '2024-02-04 00:29:41', '2024-02-04 00:29:41'),
(115, 'تجهيز طابقين التعلية في كلية الحقوق', NULL, 45, 0, '2024-02-04 00:31:20', '2024-02-04 00:31:20'),
(116, 'تطوير مبني الكيمياء في كلية الهندسة بشبرا', NULL, 45, 0, '2024-02-04 00:31:51', '2024-02-04 00:31:51'),
(117, 'تأهيل مبنى الخدمات الطلابية والمعهد الفني للتمريض', NULL, 45, 0, '2024-02-04 00:32:31', '2024-02-04 00:32:31'),
(118, 'تطوير مبنى الجراحة في المستشفيات الجامعية', NULL, 45, 0, '2024-02-04 00:34:33', '2024-02-04 00:34:33'),
(119, 'اعداد وتجهيز كبسولات العمليات الجراحية', NULL, 45, 0, '2024-02-04 00:35:19', '2024-02-04 00:35:19'),
(120, 'استكمال اعداد وتجهيز ملاعب الجامعة', NULL, 45, 0, '2024-02-04 00:35:53', '2024-02-04 00:35:53'),
(121, 'تطوير بدروم كلية الحاسبات والذكاء الاصطناعي', NULL, 45, 0, '2024-02-04 00:36:28', '2024-02-04 00:36:28'),
(122, 'عقد شراكات مع جامعات ومؤسسات تعليمية وبحثية إقليمية ودولية', NULL, 46, 0, '2024-02-04 00:39:26', '2024-02-04 00:39:26'),
(123, 'تطوير البرامج الأكاديمية لتتوافق مع المعايير الدولية للمرحلة الجامعية الأولى والدراسات العليا', NULL, 47, 0, '2024-02-04 00:46:36', '2024-02-04 00:46:36'),
(124, 'برامج أكاديمية مزدوجة مع مؤسسات أكاديمية دولية', NULL, 47, 0, '2024-02-04 00:52:23', '2024-02-04 00:52:23'),
(125, 'مشروعات بحثية وبينية مع مؤسسات إقليمية ودولية', NULL, 47, 0, '2024-02-04 00:56:42', '2024-02-04 00:56:42'),
(126, 'تنفيذ أنشطة علمية على المستوى الإقليمي والدولي', NULL, 47, 0, '2024-02-04 00:58:02', '2024-02-04 00:58:02'),
(127, 'رفع قدرات الطلاب وأعضاء هيئة التدريس والباحثين للحصول على المنح العلمية والبعثات والإجازات الدراسية', NULL, 47, 0, '2024-02-04 01:03:12', '2024-02-04 01:03:12'),
(128, 'جودة الخدمات التعليمية والاجتماعية المقدمة للوافدين للمرحلة الجامعية الأولى والدراسات العليا', NULL, 48, 0, '2024-02-04 01:05:00', '2024-02-04 01:05:00'),
(129, 'تطبيق الهوية البصرية بالجامعة', NULL, 49, 0, '2024-02-04 01:08:06', '2024-02-04 01:08:06'),
(130, 'تعزيز وتطوير بناء السمعة المؤسسية بالجامعة لدى الأكاديميين وارباب العمل وسائر المستفيدين', NULL, 49, 0, '2024-02-04 01:09:51', '2024-02-04 01:09:51'),
(131, 'برامج تدريبية وتوعوية لضمان استمرارية الحفاظ على السمعة المؤسسية بالجامعة', NULL, 49, 0, '2024-02-04 01:11:42', '2024-02-04 01:11:42'),
(132, 'إدارة مخاطر السمعة بالجامعة وفقاً للمنهجيات العلمية العالمية', NULL, 49, 0, '2024-02-04 01:14:45', '2024-02-04 01:14:45'),
(133, 'تقييم بناء السمعة بالجامعة', NULL, 49, 0, '2024-02-04 01:17:07', '2024-02-04 01:17:07'),
(134, 'تعزيز ومتابعة تحسين تصنيف الجامعة اقليمياً ودولياً', NULL, 50, 0, '2024-02-04 01:21:07', '2024-02-04 01:21:07'),
(136, 'تحديث وتطوير مركز البيانات وتكنولوجيا المعلومات بالجامعة', NULL, 51, 0, '2024-02-04 01:33:01', '2024-02-04 01:33:01'),
(137, 'رفع كفاءة الاتصال (Connectivity)', NULL, 51, 0, '2024-02-04 01:34:10', '2024-02-04 01:34:10'),
(138, 'تطبيق نظام التوقيع الإلكتروني (Digital Signature)', NULL, 51, 0, '2024-02-04 01:35:01', '2024-02-04 01:35:01'),
(139, 'أمان وتأمين البيانات (Data Safety and Security)', NULL, 51, 0, '2024-02-04 01:35:40', '2024-02-04 01:35:40'),
(140, 'التجديد والإحلال (Renovation and Replacement)', NULL, 51, 0, '2024-02-04 01:36:38', '2024-02-04 01:36:38'),
(141, 'هوية ذكية لمنسوبي الجامعة (Smart Identity)', NULL, 52, 0, '2024-02-04 01:37:42', '2024-02-04 01:37:42'),
(142, 'المراقبة الذكية (Smart Surveillance)', NULL, 52, 0, '2024-02-04 01:38:30', '2024-02-04 01:38:30'),
(143, 'التعلم عن بعد (Online)', NULL, 52, 0, '2024-02-04 01:39:21', '2024-02-04 01:39:21'),
(144, 'المعامل الافتراضية (  3D Virtual Labs) ونظم المحاكاة (Simulators)', NULL, 52, 0, '2024-02-04 01:41:42', '2024-02-04 01:41:42'),
(145, 'إدارة سير العمل (Workflow Management)', NULL, 53, 0, '2024-02-04 01:43:45', '2024-02-04 01:43:45'),
(146, 'إدارة المستندات (Document Management)', NULL, 53, 0, '2024-02-04 01:44:45', '2024-02-04 01:44:45'),
(147, 'إدارة موارد / أصول الجامعة (Asset / Resource Management)', NULL, 53, 0, '2024-02-04 01:46:05', '2024-02-04 01:46:05'),
(149, 'محو الأمية الرقمية (Digital Literacy)', NULL, 54, 0, '2024-02-04 01:48:19', '2024-02-04 01:48:19'),
(150, 'رعاية الإبداع والابتكار في مجال تكنولوجيا المعلومات (Innovation and creation)', NULL, 54, 0, '2024-02-04 01:49:33', '2024-02-04 01:49:33'),
(151, 'التطوير المستمر لتطبيقات علوم الحاسوب في مجال التخصص', NULL, 55, 0, '2024-02-04 01:53:37', '2024-02-04 01:53:37'),
(152, 'رفع كفاءة المستودع الرقمي للإنتاج الفكري بالجامعة', NULL, 55, 0, '2024-02-04 01:55:07', '2024-02-04 01:55:07'),
(153, 'نظام إدارة التعلم (LMS)', NULL, 55, 0, '2024-02-04 01:56:29', '2024-02-04 01:56:29'),
(154, 'تطوير منظومة الاختبارات الإلكترونية (Electronic Assessments)', NULL, 56, 0, '2024-02-04 01:57:36', '2024-02-04 01:57:36'),
(155, 'استكمال منظومة التصحيح الإلكتروني', NULL, 56, 0, '2024-02-04 01:58:49', '2024-02-04 01:58:49'),
(156, 'تطوير مستمر لنظام كشف الاقتباس وتحديد نسبة التشابه في الإنتاج العلمي (Similarity Check)', NULL, 56, 0, '2024-02-04 02:00:05', '2024-02-04 02:00:05'),
(157, 'ادخال نظام المراقبة الإلكترونية للاختبارات (E proctoring)', NULL, 56, 0, '2024-02-04 02:01:13', '2024-02-04 02:01:13'),
(158, '- إتاحة تقديم الخدمات إلكترونياً (Electronic Services)', NULL, 57, 0, '2024-02-04 02:03:03', '2024-02-04 02:03:03'),
(159, 'تطوير الدفع الإلكتروني (ePayment)', NULL, 57, 0, '2024-02-04 02:04:16', '2024-02-04 02:04:16'),
(160, 'تحقيق التكامل (Integration)', NULL, 57, 0, '2024-02-04 02:05:34', '2024-02-04 02:05:34'),
(161, 'نظم المعلومات الطلابية (SIS)', NULL, 57, 0, '2024-02-04 02:06:30', '2024-02-04 02:06:38'),
(162, 'العيادات', NULL, 3, 19, '2024-02-06 12:08:36', '2024-02-06 12:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rateable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rateable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rate` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_members`
--

CREATE TABLE `rating_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci,
  `job_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gehat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kheta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_members`
--

INSERT INTO `rating_members` (`id`, `username`, `job_number`, `password`, `gehat`, `kheta_id`, `created_at`, `updated_at`) VALUES
(6, 'Dr Mohamed', '2024', '$2y$10$7O6aE3aHdoUigXT./MiANuSzHg.hbf1PwSYYZcR.Xtcyf6Rd8hwGe', '[\"29\",\"37\"]', 6, '2024-02-17 22:36:10', '2024-02-17 22:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: pending, 2: completed, 3: cancelled, 4: rejected',
  `type` tinyint(4) NOT NULL COMMENT '1: local, 2: online',
  `amount` double(8,2) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geha` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_manger` tinyint(4) NOT NULL DEFAULT '0',
  `kehta_id` bigint(20) UNSIGNED DEFAULT NULL,
  `geha_id` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_seen` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `job_number`, `geha`, `password`, `is_manger`, `kehta_id`, `geha_id`, `remember_token`, `last_seen`, `created_at`, `updated_at`) VALUES
(3, '123', 'كليه  الحاسبات', '$2y$10$07J6OXTTQD/hrT.hYuiaxuKN9Gd700HKgON0mDZLjr6CyrBN/erya', 1, 4, '1', NULL, '', '2024-01-16 17:27:25', '2024-01-19 15:33:11'),
(5, '111', 'كلية التمريض', '123', 1, 4, '1', NULL, '', '2024-01-16 17:50:50', '2024-01-16 17:50:50'),
(8, '010', 'كليه التربيه', '010', 0, NULL, '7', NULL, '', '2024-01-18 15:59:03', '2024-01-18 15:59:03'),
(10, '124', 'كلية الزراعة', '$2y$10$4jtpDzlzSYaPywJhvyOS7O/vJUj67DFwQhCE7mNf103k.io83oJmq', 1, 4, NULL, NULL, '', '2024-01-18 16:30:28', '2024-01-18 16:30:28'),
(13, '3', 'كلية الزراعة', '$2y$10$sUlAd.HYhNfgIv.amK0JzeX4W.qwqRHmM40JNKHWSn1LtnHt3lJy2', 1, NULL, '10', NULL, '', '2024-01-18 18:11:02', '2024-01-18 18:11:20'),
(19, '2024', 'كلية الطب', '$2y$10$TkNCESICB/VQ0C3ThWlGrubaimNsURZzNvddDxMeMhSTyZ9Lzn/KO', 1, 4, NULL, NULL, '', '2024-01-30 21:07:07', '2024-01-30 21:07:07'),
(20, '2025', 'كلية الفنون', '$2y$10$5JCw58eMVEFRzw6IWfFE6.O4T9ZQRdmVrfvX5Zo2UoZKMDG5RCxSe', 1, 4, NULL, NULL, '', '2024-01-30 21:07:39', '2024-01-30 21:07:39'),
(21, '2026', 'شؤون الطلاب', '$2y$10$zKgq2hHM2XlpO7eTwJ2/4OsQXdL5sPTl93WMkSOv46nEr6GgLWDXW', 0, NULL, '19', NULL, '', '2024-01-30 21:12:17', '2024-02-01 12:40:03'),
(22, '2027', 'رعاية الشباب', '$2y$10$0r8yGpMIgHd6e8u2pi2Zl.gKlI.iYyrWdcr/DXgClHld2.bKEKxau', 0, NULL, '19', NULL, '', '2024-01-30 21:19:06', '2024-02-01 12:42:49'),
(26, '10001', 'كليه الهندسه بشبرا', '$2y$10$NmiP.Vn8iO6rZtjI2Q0hoOSfX9RGDmJAavs3mdGFvmyqsMFaj284i', 1, 6, NULL, NULL, '', '2024-02-04 20:26:03', '2024-02-04 20:26:03'),
(27, '10002', 'كليه الهندسه ببنها', '$2y$10$VuZIQImWV9yultnSSYeBhuQb/./HHjVPvRWXDVvwPITa4JH3o.CJq', 1, 6, NULL, NULL, '', '2024-02-04 20:26:31', '2024-02-04 20:26:31'),
(28, '10003', 'كليه الحاسبات والذكاء الاصطناعي', '$2y$10$4DNhN3kSpCVbmxnLnHbW4.BmEag0aY4zHuaugdtWZGlh0IZpMt8Ne', 1, 6, NULL, NULL, '', '2024-02-04 20:27:37', '2024-02-04 20:27:37'),
(29, '10004', 'كليه الطب', '$2y$10$zuCiOInsRc0E9MG4nnwfEeZ..4p8WknKwuX.3JPzDn4gM19HZytqm', 1, 6, NULL, NULL, '', '2024-02-04 20:28:04', '2024-02-04 20:28:04'),
(30, '10005', 'كليه الطب البيطري', '$2y$10$0wJn9MgJEpDwmGYnQFDyTOAYxFJ4JrVluFvSU0hyxOsnC38aqjK2i', 1, 6, NULL, NULL, '', '2024-02-04 20:28:29', '2024-02-04 20:28:29'),
(32, '10006', 'كليه الاداب', '$2y$10$/MLD3fnGdNnjRUyEHH90BumTFKHQfTmosqNUJSXXHN/kG86YZ5xjm', 1, 6, NULL, NULL, '', '2024-02-04 20:30:35', '2024-02-04 20:30:35'),
(33, '10007', 'كليه التجاره', '$2y$10$KMNsBjdPvwFmUp9rDcraT.b.ao25tmrV.Mxb9eZKT0x3vetpM9S7q', 1, 6, NULL, NULL, '', '2024-02-04 20:30:58', '2024-02-04 20:30:58'),
(34, '10008', 'كليه الحقوق', '$2y$10$swcpurl1kbhkqopvqHQmWeG4okwjy9RTh/Rpod7iaKODSikCgHIZC', 1, 6, NULL, NULL, '', '2024-02-04 20:31:53', '2024-02-04 20:31:53'),
(35, '10009', 'كليه التربيه', '$2y$10$69.gzjIjY0Bc8bqHOfpvKeLS7XJYCWhy1sVcoG77voGRe4Tlpw7OO', 1, 6, NULL, NULL, '', '2024-02-04 20:32:21', '2024-02-04 20:32:21'),
(36, '100010', 'كليه التربيه الرياضيه', '$2y$10$/vmyz4A8EETjHP21HR.34ObvBcxsKSl3NBHMSyz9puJgFcahUFQza', 1, 6, NULL, NULL, '', '2024-02-04 20:40:01', '2024-02-04 20:40:01'),
(37, '100011', 'كليه الزراعه', '$2y$10$fv8QVrNAkx1OMjU4AZB6Ku1Wj0TKmvwInxiDCMRCPu/Q41y/CEwAK', 1, 6, NULL, NULL, '', '2024-02-04 20:40:44', '2024-02-04 20:40:44'),
(38, '100012', 'كليه العلوم', '$2y$10$bTP2GadWtnyfCB7BdjtCjO5tuhshkoFlSz1lUBc44WkpmXCKMflEq', 1, 6, NULL, NULL, '', '2024-02-04 20:41:53', '2024-02-04 20:41:53'),
(39, '100013', 'كليه الفنون التطبيقيه', '$2y$10$OJzakskKblbSjCYEiv0cDucWRZ3OSwGvIKLUCgb/HaMxokzyKM8yK', 1, 6, NULL, NULL, '', '2024-02-04 20:42:21', '2024-02-04 20:42:21'),
(40, '100014', 'كليه التربيه النوعيه', '$2y$10$CtFx4n.2XJPBOXeE8sHHzunE6rvBBQebLzXW7uimG.8fZIUdZ1hYy', 1, 6, NULL, NULL, '', '2024-02-04 20:43:01', '2024-02-04 20:43:01'),
(41, '100015', 'كليه التمريض', '$2y$10$YsrJQ9Be6D/FYV4vd/E8geUV8/Il5xaa/ImbWRdA70qyo8JemL9jG', 1, 6, NULL, NULL, '', '2024-02-04 20:43:23', '2024-02-04 20:43:23'),
(42, '100016', 'كليه العلاج الطبيعى', '$2y$10$SpwhOxMrOJg32ktyA9hSDexp7r8sOoCY0WphjlCyrD1HsptFdBxQm', 1, 6, NULL, NULL, '', '2024-02-04 20:43:47', '2024-02-04 20:43:47'),
(44, '100017', 'الإدارة الهندسية', '$2y$10$0q7BLxf4v1/68ZKrbV7I8Oo0dPc2Dys2RqVJGdjbu44nl/cBSS44C', 1, 6, NULL, NULL, '', '2024-02-04 23:40:42', '2024-02-04 23:40:42'),
(45, '100018', 'إدارة شئون التعليم والطلاب بالجامعة', '$2y$10$vXx8tbrGv9eqCqNsX.8tdOZawdIrh8XYzUYffC0gDKqtYCsYWTVMq', 1, 6, NULL, NULL, '', '2024-02-05 17:58:25', '2024-02-05 17:58:25'),
(46, '100019', 'شبكة المعلومات الرقمية بالجامعة', '$2y$10$frY3qiljCjnpyJZvlHKb9OBH8mJ0SKLwRdTNxJj9m1WJY1Wgvmy16', 1, 6, NULL, NULL, '', '2024-02-05 17:59:42', '2024-02-05 17:59:42'),
(47, '100020', 'مركز التعلم الكتروني', '$2y$10$/vbXljxf5/VoPPqp5Uc2heGST7G5sCSbtcg5toVUlT9/Jn19eRkTi', 1, 6, NULL, NULL, '', '2024-02-05 18:00:08', '2024-02-05 18:00:08'),
(48, '100021', 'المكتبه الرقميه', '$2y$10$xc7czQe4c9LJSxJbuJuu7e1xc7w5.3yPkRPyWGZJAvoL9.DWoFEIK', 1, 6, NULL, NULL, '', '2024-02-05 18:00:35', '2024-02-05 18:00:35'),
(49, '100022', 'مركز التدريب على تكنولوجيا المعلومات', '$2y$10$ioYE58zI1mPTsandk.5wJuhiY5v6/mW997w.jW246N5ODKPOXP58K', 1, 6, NULL, NULL, '', '2024-02-05 18:01:11', '2024-02-05 18:01:11'),
(50, '100023', 'نظم المعلومات الادارية mis', '$2y$10$RnklC.eTlt1aXpdxptbd4u0Gf2Hnh1BJ186yuF5tnxjY9Vf3PSaZi', 1, 6, NULL, NULL, '', '2024-02-05 18:01:41', '2024-02-05 18:01:41'),
(51, '100024', 'مركز ضمان الجوده والإعتماد بالجامعه', '$2y$10$P9.6EsgQWDBV3rhQ1aiByu7uAPPY2UHeAKIhXlDLInxs4SaJ2Xm4e', 1, 6, NULL, NULL, '', '2024-02-05 18:02:13', '2024-02-05 18:02:13'),
(52, '100025', 'مدير مركز القياس والتقويم بالجامعة', '$2y$10$33OLKiBR9tF4vGhz9ZoN2OMvU0F.RLn7RL3a/qXTe7PL2NC0eT8Ny', 1, 6, NULL, NULL, '', '2024-02-05 18:02:42', '2024-02-05 18:02:42'),
(53, '100026', 'وحدة رعاية الوافدين بالجامعة', '$2y$10$5SDfVVaE7M1UDTlpOgag6umKWblRjiEV9Ks4eSj9ExPDGIjsRU6Ti', 1, 6, NULL, NULL, '', '2024-02-05 18:03:19', '2024-02-05 18:38:03'),
(54, '100027', 'إدارة رعاية الشباب بالجامعة', '$2y$10$ADSTB6wpkbwWpknhtZsNAOdVwvROHEGn262q9CAZtISanL8EpYA9K', 1, 6, NULL, NULL, '', '2024-02-05 18:04:28', '2024-02-05 18:04:28'),
(55, '100028', 'وحدة رعاية الخريجين بالجامعة', '$2y$10$o5Eswe/7DLKlC3L8CqW0LeH3cBNG758TEyJSTOUVLXydQs/6CQ/1G', 1, 6, NULL, NULL, '', '2024-02-05 18:04:53', '2024-02-05 18:37:08'),
(56, '100029', 'صندوق دعم البحث العلمي', '$2y$10$l72d2jUrFAvQgr1YvIPW0uXQFVdj8Vz0/WLYO1Hs79nhJgna0Ekqa', 1, 6, NULL, NULL, '', '2024-02-05 18:05:23', '2024-02-05 19:37:30'),
(57, '100030', 'إدارة المستشفى', '$2y$10$bxkJ26Ytaxho5w3ibyWSVO5/5nQZYS4FGLIVGIJM/VdWiVw.GWiaa', 1, 6, NULL, NULL, '', '2024-02-05 18:06:07', '2024-02-05 18:06:07'),
(58, '100031', 'اداره شئون الدراسات العليا و البحوث بالجامعة', '$2y$10$2cCZ6kXS8O6tLrJusIqb2uZQ0.W5bf86sKK5527V.NSvnCOGWK8ae', 1, 6, NULL, NULL, '', '2024-02-05 18:06:33', '2024-02-05 19:25:01'),
(59, '100032', 'ادارة شئون خدمة المجتمع والبيئة بالجامعة', '$2y$10$FXa6eJ0zhjPMD79vi.iwTubtqv82wBcx56.Gorint8w66cdaN2rYa', 1, 6, NULL, NULL, '', '2024-02-05 18:07:01', '2024-02-05 20:54:44'),
(60, '100033', 'مركز الابتكار وريادة الاعمال', '$2y$10$KtIR.ygUpgTHwdT60uqIGuXbmNahq88BB0fPFfKDmH0xM1Tn5Qt1K', 1, 6, NULL, NULL, '', '2024-02-05 18:07:36', '2024-02-05 18:07:36'),
(61, '100034', 'إداراة العلاقات الثقافية بالجامعة', '$2y$10$ZxO7tDkEtES5dpN7nMMFWekMh8.44ASBtQgCaElEmy/o/RvmWRtCC', 1, 6, NULL, NULL, '', '2024-02-05 18:08:00', '2024-02-05 18:08:00'),
(62, '100035', 'مكتب العلاقات الدولية', '$2y$10$WQfAHfZ2qzsydTeJCrpMVeHAOsK07C6X2.Kd/r6hrWEUW04EAcKaC', 1, 6, NULL, NULL, '', '2024-02-05 18:08:23', '2024-02-05 18:08:23'),
(63, '100036', 'اللجنة العليا للتصنيف الدولى بجامعة بنها', '$2y$10$AATwk4tP44ZJ0gAQUMFv9urGhc3mbov3DsXFBl.4.X1piYkr2ae2K', 1, 6, NULL, NULL, '', '2024-02-05 18:08:47', '2024-02-05 18:08:47'),
(64, '100037', 'مجلس ادارة المدن الجامعية', '$2y$10$8zCUnIZiPaByNHebPyS56.REjm3lgT/EGIc6pX3hSIvv3Au9LK0Ea', 1, 6, NULL, NULL, '', '2024-02-05 18:09:36', '2024-02-05 18:09:36'),
(65, '100038', 'وحدة ادارة المشروعات', '$2y$10$HtnZnEdx1TFVdCrU4krwq.S8/nz0/g9wDzk1DOT0ewVTkBbqFHaN.', 1, 6, NULL, NULL, '', '2024-02-05 18:10:30', '2024-02-05 18:10:30'),
(66, '100039', 'الوحدة المركزية للتخطيط الاستراتيجي', '$2y$10$tQcQlF6DJ7FmklUe7fR6N.cvOJ8oTXVybo3cg5LJqME6Wj8l3Czme', 1, 6, NULL, NULL, '', '2024-02-05 18:11:11', '2024-02-05 18:11:11'),
(67, '100040', 'الشئون الإدارية في الجامعة', '$2y$10$AK3rO18d1HWqELsi.l8xBOIwstu/3eZ8RGZzW269.oZ4q0lST8gJa', 1, 6, NULL, NULL, '', '2024-02-05 18:11:38', '2024-02-05 18:11:38'),
(68, '100041', 'مركز تنمية قدرات أعضاء هيئة التدريس', '$2y$10$zpObdT83DyK9gSChCV3lieI9r/AMV8PDi4DbBJjWl2pjiGkM83rqm', 1, 6, NULL, NULL, '', '2024-02-05 18:12:07', '2024-02-05 18:12:07'),
(69, '100042', 'وحدة المعامل والأجهزة', '$2y$10$CyEB.pTZRSAbqGQOxfEjfOJIFkMahq89.WBJGniCxu/hxap9Xd8eG', 1, 6, NULL, NULL, '', '2024-02-05 18:12:39', '2024-02-05 18:12:39'),
(70, '100043', 'البوابة الالكترونية', '$2y$10$Xfg/QnFsS0Gpmp41mQD0EuId7t7dkDTiKGpn4unHXUigyFqxYb9Na', 1, 6, NULL, NULL, '', '2024-02-05 18:13:02', '2024-02-05 18:13:02'),
(71, '100044', 'وحدة متحدي الاعاقة بالجامعة', '$2y$10$aXCzPv2Am0VtQlExd3C.pOYq3yK9iEL6nc.71tg.bhyMs7Wq.AmxS', 1, 6, NULL, NULL, '', '2024-02-05 18:23:33', '2024-02-05 18:25:46'),
(72, '100045', 'الجامعة التكنولوجية', '$2y$10$mhEbBOPxFBxGtCG9tWXUvuTjRkmkCVxMKQGu6iC78n9VjBsLl4Pli', 1, 6, NULL, NULL, '', '2024-02-05 18:34:42', '2024-02-05 18:34:42'),
(73, '100046', 'وحدة المبدعين والموهوبين بالجامعة', '$2y$10$4Vr4S3D1OYnOVcIviSkh6uiN66lRVpCvghcA46JrRN5RFFzUOe6j2', 1, 6, NULL, NULL, '', '2024-02-05 18:36:26', '2024-02-05 18:36:26'),
(74, '100047', 'الادرة الطبية', '$2y$10$p38sYkrUtdt5PvyVmt/KMOr7lbr9uxwYuUueNuLokXfKbG63ayDMK', 1, 6, NULL, NULL, '', '2024-02-05 18:51:03', '2024-02-05 18:51:03'),
(75, '100048', 'تكنولوجيا المعلومات', '$2y$10$zLMi.OQge3Rpq.lI7TxxsOiVoIPU2kK5zlfADtqKyJsFuHRWRGMQi', 1, 6, NULL, NULL, '', '2024-02-05 18:52:33', '2024-02-05 18:52:33'),
(76, '100049', 'الحاضنة التكنولوجية للجامعة', '$2y$10$V4hWZLYd82D28xK0beYbwuEoJ1X2HHxJXIUZIARgzAUmNdyXEFZF2', 1, 6, NULL, NULL, '', '2024-02-05 18:58:32', '2024-02-05 19:26:17'),
(77, '100050', 'مركز دعم الابتكار ونقل وتسويق التكنولوجيا (تايكو) بالجامعة', '$2y$10$eXBu0gw.2xQlqV223Y0nnu9qGOV.ctghhlcrmwQHos6hbq7PwVdEW', 1, 6, NULL, NULL, '', '2024-02-05 19:30:41', '2024-02-05 19:30:41'),
(78, '100051', 'وحدة التسويق بالجامعة', '$2y$10$v/zgJ2jbw4oL1PZbwAr9q.cvHx76SXEi/9p3hU0pawhqsedYP2wd6', 1, 6, NULL, NULL, '', '2024-02-05 19:39:53', '2024-02-05 19:39:53'),
(79, '100052', 'مركز التدريب المهني الوظيفي بكلية الهندسة بشبرا', '$2y$10$6S5Lerwrn8Y5q1/gNAIj2efv0tPDPQSmeAbQvvRXOc7npj8BEh/6m', 1, 6, NULL, NULL, '', '2024-02-05 19:44:17', '2024-02-05 19:44:17'),
(80, '100053', 'ادارة حركة المركبات', '$2y$10$/oC/rFlYCU.2kyLftsBGbu28PiEmijWfH6n998hwDM8nK22vVAe4i', 1, 6, NULL, NULL, '', '2024-02-05 20:03:38', '2024-02-05 20:03:38'),
(81, '100054', 'ضمان الجودة الادارية شئون العاملين بالجامعة', '$2y$10$lNmRbQurijw.GEuTmfx5u.n5ftcW1TgcR9mwe4O2mTVrIQjiJFV/u', 1, 6, NULL, NULL, '', '2024-02-05 20:18:03', '2024-02-05 20:55:41'),
(82, '100055', 'شئون أعضاء هيئة التدريس بالجامعة', '$2y$10$oft8NzU8USEurVZbgppdM.J5YcouX801RIc1oPw3QZ41hB/IJhV3S', 1, 6, NULL, NULL, '', '2024-02-05 20:18:55', '2024-02-05 20:56:38'),
(83, '100056', 'اللجنة المركزية للنزاهة والشفافية بالجامعة', '$2y$10$uCNJS3ur2TMoMfhQceP5Pew8Gkfm8nuxxWUX5eSMS9tPWvyGND.QK', 1, 6, NULL, NULL, '', '2024-02-05 20:19:51', '2024-02-05 20:19:51'),
(84, '100057', 'لجنة الشكاوي والمقترحات بالجامعة', '$2y$10$T3OGUxoOxw/lfN/z7fwBk.w5MORYnmfWK.61yCL6DX4U.EnMKZOgC', 1, 6, NULL, NULL, '', '2024-02-05 20:22:47', '2024-02-05 20:22:47'),
(85, '100058', 'المدير التنفيذي للمعلومات', '$2y$10$Vssy8bD1sr2wvvyPX22iouT66YFcDMKwfictQIKEEtOhRypl6F3RW', 1, 6, NULL, NULL, '', '2024-02-05 20:31:51', '2024-02-05 20:31:51'),
(86, '100059', 'مركز الاحصاء والبيانات', '$2y$10$V/i0kS7ccJcVeXXlDlvukOXLD73bHdXxFooEOL5qDRPmmj3C0fSY6', 1, 6, NULL, NULL, '', '2024-02-05 20:37:10', '2024-02-05 20:37:10'),
(87, '100060', 'منسق الجودة الادارية', '$2y$10$9jtltBotdLSgIWHpbUm2buVEvodOiwi1I.s93emRG6kmB7JfUUtXC', 1, 6, NULL, NULL, '', '2024-02-05 20:44:01', '2024-02-05 20:44:01'),
(88, '100061', 'الموازنة', '$2y$10$tG7OaJOkcJ79deTUNN/LPeYx/BJ8mqpEBJKTCL2.WhOK4wsTHGXLe', 1, 6, NULL, NULL, '', '2024-02-05 20:57:24', '2024-02-05 20:57:24'),
(89, '100062', 'ادارة المدن الجامعية', '$2y$10$m3G218XhS1apmTdk0I63cOkNAFHygpCy3hN7kc249Nau7Srv.w4D2', 1, 6, NULL, NULL, '', '2024-02-05 21:04:35', '2024-02-05 21:04:35'),
(90, '100063', 'العلاقات الدولية', '$2y$10$rPOC9NIAqJo8Q/bEEz6yPOFxatBzeBvMIqi.7GKDXab1vK9Qu0DMS', 1, 6, NULL, NULL, '', '2024-02-05 21:13:20', '2024-02-05 21:13:20'),
(91, '100064', 'مركز الاختبارات الالكترونية', '$2y$10$ICVTm44H6EztLJa2M4qSLeOMAIPbDQtsRNXJhpddkR.pFGInBzyWu', 1, 6, NULL, NULL, '', '2024-02-05 21:33:03', '2024-02-05 21:33:03'),
(92, '1', 'شؤون الطلاب', '$2y$10$pwjyliIh0eeA44x10F4izeeletBfdGlxFNIr6Cmh/6j9YxAGVBuUi', 0, NULL, '29', NULL, '', '2024-02-17 22:06:56', '2024-02-17 22:07:31'),
(93, '2', 'رعاية الشباب', '$2y$10$087m44eeEh4BvA4HuRwSQ.SluxdMGWv8.0qlQMM.mMzK8/HKr0Ifm', 0, NULL, '29', NULL, '', '2024-02-17 22:07:54', '2024-02-17 22:07:54'),
(94, '4', 'شؤون أعضاء هيئة التدريس', '$2y$10$r682ooPrT3a3M9.gHUAEDeYG.kIuK0tSXvYQPweUsjz7rn89xsnd6', 0, NULL, '29', NULL, '', '2024-02-17 22:59:27', '2024-02-17 22:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `viewable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vimeo_folders`
--

CREATE TABLE `vimeo_folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items_count` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

--
-- Indexes for table `course_prerequisites`
--
ALTER TABLE `course_prerequisites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_prerequisites_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_videos_course_id_foreign` (`course_id`),
  ADD KEY `course_videos_folder_id_index` (`folder_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`);

--
-- Indexes for table `execution_years`
--
ALTER TABLE `execution_years`
  ADD PRIMARY KEY (`id`),
  ADD KEY `execution_years_kheta_id_foreign` (`kheta_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goals_objective_id_foreign` (`objective_id`);

--
-- Indexes for table `instructor_bankdetails`
--
ALTER TABLE `instructor_bankdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_bankdetails_user_id_foreign` (`user_id`);

--
-- Indexes for table `instructor_details`
--
ALTER TABLE `instructor_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `instructor_requests`
--
ALTER TABLE `instructor_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `khetas`
--
ALTER TABLE `khetas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`),
  ADD KEY `lessons_section_id_foreign` (`section_id`),
  ADD KEY `lessons_folder_id_index` (`folder_id`);

--
-- Indexes for table `lesson_progress`
--
ALTER TABLE `lesson_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_progress_user_id_foreign` (`user_id`),
  ADD KEY `lesson_progress_course_id_foreign` (`course_id`),
  ADD KEY `lesson_progress_section_id_foreign` (`section_id`),
  ADD KEY `lesson_progress_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `mangements`
--
ALTER TABLE `mangements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mangements_kheta_id_foreign` (`kheta_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mokashers`
--
ALTER TABLE `mokashers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokashers_program_id_foreign` (`program_id`);

--
-- Indexes for table `mokasher_execution_years`
--
ALTER TABLE `mokasher_execution_years`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokasher_execution_years_mokasher_id_foreign` (`mokasher_id`),
  ADD KEY `mokasher_execution_years_year_id_foreign` (`year_id`);

--
-- Indexes for table `mokasher_geha_inputs`
--
ALTER TABLE `mokasher_geha_inputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokasher_geha_inputs_mokasher_id_foreign` (`mokasher_id`),
  ADD KEY `mokasher_geha_inputs_geha_id_foreign` (`geha_id`),
  ADD KEY `mokasher_geha_inputs_year_id_foreign` (`year_id`);

--
-- Indexes for table `mokasher_inputs`
--
ALTER TABLE `mokasher_inputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokasher_inputs_mokasher_id_foreign` (`mokasher_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `objectives`
--
ALTER TABLE `objectives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objectives_kheta_id_foreign` (`kheta_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `orders_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_course_id_foreign` (`course_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_goal_id_foreign` (`goal_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_rateable_type_rateable_id_index` (`rateable_type`,`rateable_id`),
  ADD KEY `rates_user_id_foreign` (`user_id`);

--
-- Indexes for table `rating_members`
--
ALTER TABLE `rating_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_members_kheta_id_foreign` (`kheta_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_course_id_foreign` (`course_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_number_unique` (`transaction_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_kehta_id_foreign` (`kehta_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_viewable_type_viewable_id_index` (`viewable_type`,`viewable_id`),
  ADD KEY `views_user_id_foreign` (`user_id`);

--
-- Indexes for table `vimeo_folders`
--
ALTER TABLE `vimeo_folders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vimeo_folders_folder_id_unique` (`folder_id`),
  ADD UNIQUE KEY `vimeo_folders_name_unique` (`name`),
  ADD KEY `vimeo_folders_user_id_foreign` (`user_id`),
  ADD KEY `vimeo_folders_course_id_foreign` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_prerequisites`
--
ALTER TABLE `course_prerequisites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `execution_years`
--
ALTER TABLE `execution_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `instructor_bankdetails`
--
ALTER TABLE `instructor_bankdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_details`
--
ALTER TABLE `instructor_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_requests`
--
ALTER TABLE `instructor_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khetas`
--
ALTER TABLE `khetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_progress`
--
ALTER TABLE `lesson_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mangements`
--
ALTER TABLE `mangements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `mokashers`
--
ALTER TABLE `mokashers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `mokasher_execution_years`
--
ALTER TABLE `mokasher_execution_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `mokasher_geha_inputs`
--
ALTER TABLE `mokasher_geha_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `mokasher_inputs`
--
ALTER TABLE `mokasher_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objectives`
--
ALTER TABLE `objectives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_members`
--
ALTER TABLE `rating_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vimeo_folders`
--
ALTER TABLE `vimeo_folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_prerequisites`
--
ALTER TABLE `course_prerequisites`
  ADD CONSTRAINT `course_prerequisites_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD CONSTRAINT `course_videos_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_videos_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `vimeo_folders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `execution_years`
--
ALTER TABLE `execution_years`
  ADD CONSTRAINT `execution_years_kheta_id_foreign` FOREIGN KEY (`kheta_id`) REFERENCES `khetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_objective_id_foreign` FOREIGN KEY (`objective_id`) REFERENCES `objectives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor_bankdetails`
--
ALTER TABLE `instructor_bankdetails`
  ADD CONSTRAINT `instructor_bankdetails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor_details`
--
ALTER TABLE `instructor_details`
  ADD CONSTRAINT `instructor_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor_requests`
--
ALTER TABLE `instructor_requests`
  ADD CONSTRAINT `instructor_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lessons_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `vimeo_folders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_progress`
--
ALTER TABLE `lesson_progress`
  ADD CONSTRAINT `lesson_progress_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_progress_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_progress_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mangements`
--
ALTER TABLE `mangements`
  ADD CONSTRAINT `mangements_kheta_id_foreign` FOREIGN KEY (`kheta_id`) REFERENCES `khetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mokashers`
--
ALTER TABLE `mokashers`
  ADD CONSTRAINT `mokashers_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mokasher_execution_years`
--
ALTER TABLE `mokasher_execution_years`
  ADD CONSTRAINT `mokasher_execution_years_mokasher_id_foreign` FOREIGN KEY (`mokasher_id`) REFERENCES `mokashers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mokasher_execution_years_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `execution_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mokasher_geha_inputs`
--
ALTER TABLE `mokasher_geha_inputs`
  ADD CONSTRAINT `mokasher_geha_inputs_geha_id_foreign` FOREIGN KEY (`geha_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mokasher_geha_inputs_mokasher_id_foreign` FOREIGN KEY (`mokasher_id`) REFERENCES `mokashers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mokasher_geha_inputs_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `execution_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mokasher_inputs`
--
ALTER TABLE `mokasher_inputs`
  ADD CONSTRAINT `mokasher_inputs_mokasher_id_foreign` FOREIGN KEY (`mokasher_id`) REFERENCES `mokashers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objectives`
--
ALTER TABLE `objectives`
  ADD CONSTRAINT `objectives_kheta_id_foreign` FOREIGN KEY (`kheta_id`) REFERENCES `khetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_goal_id_foreign` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_members`
--
ALTER TABLE `rating_members`
  ADD CONSTRAINT `rating_members_kheta_id_foreign` FOREIGN KEY (`kheta_id`) REFERENCES `khetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vimeo_folders`
--
ALTER TABLE `vimeo_folders`
  ADD CONSTRAINT `vimeo_folders_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vimeo_folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
