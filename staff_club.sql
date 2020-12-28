-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `option_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_member_id_foreign` (`member_id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_option_id_foreign` (`option_id`),
  CONSTRAINT `answers_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `faculties`;
CREATE TABLE `faculties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faculties` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1,	NULL,	NULL,	'كلية التربية'),
(2,	NULL,	NULL,	'كلية العلوم'),
(3,	NULL,	NULL,	'كلية الآداب'),
(4,	NULL,	NULL,	'كلية الطب البشري'),
(5,	NULL,	NULL,	'كلية التجارة'),
(6,	NULL,	NULL,	'كلية الزراعة'),
(7,	NULL,	NULL,	'كلية التعليم الصناعى'),
(8,	NULL,	NULL,	'كلية التمريض'),
(9,	NULL,	NULL,	'كلية الطب البيطري'),
(10,	NULL,	NULL,	'كلية الهندسة'),
(11,	NULL,	NULL,	'كلية التربية الرياضية'),
(12,	NULL,	NULL,	'كلية الصيدلة'),
(13,	NULL,	NULL,	'كلية الحقوق'),
(14,	NULL,	NULL,	'كلية اللآثار'),
(15,	NULL,	NULL,	'كلية الألسن'),
(16,	NULL,	NULL,	'كلية الحاسبات والمعلومات'),
(17,	NULL,	NULL,	'المدن الجامعية'),
(18,	NULL,	NULL,	'مركز نور البصيرة');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `family_relatives`;
CREATE TABLE `family_relatives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nat_id` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` double(10,2) DEFAULT NULL,
  `pic` text COLLATE utf8mb4_unicode_ci,
  `member_id` bigint unsigned NOT NULL,
  `kinship_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `family_relatives_member_id_foreign` (`member_id`),
  KEY `family_relatives_kinship_id_foreign` (`kinship_id`),
  CONSTRAINT `family_relatives_kinship_id_foreign` FOREIGN KEY (`kinship_id`) REFERENCES `kinships` (`id`),
  CONSTRAINT `family_relatives_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `kinships`;
CREATE TABLE `kinships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kinships` (`id`, `created_at`, `updated_at`, `type`) VALUES
(1,	NULL,	NULL,	'son'),
(2,	NULL,	NULL,	'daughter'),
(3,	NULL,	NULL,	'mother'),
(4,	NULL,	NULL,	'father'),
(5,	NULL,	NULL,	'husband'),
(6,	NULL,	NULL,	'wife');

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fullname` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nat_id` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` double DEFAULT NULL,
  `password` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logout` tinyint(1) NOT NULL DEFAULT '0',
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `members_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `members_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `members` (`id`, `created_at`, `updated_at`, `fullname`, `nat_id`, `gender`, `phone`, `age`, `password`, `logout`, `pic`, `designation`, `faculty_id`) VALUES
(1,	'2020-12-28 16:55:26',	'2020-12-28 16:55:26',	'عضو هيئة التدريس 1',	'12345678912345',	'male',	'01205977272',	NULL,	'walid',	0,	'default.jpg',	'مدرس مساعد',	1);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27,	'2014_10_12_000000_create_users_table',	1),
(28,	'2014_10_12_100000_create_password_resets_table',	1),
(29,	'2019_08_19_000000_create_failed_jobs_table',	1),
(30,	'2020_12_13_185917_create_faculties_table',	1),
(31,	'2020_12_14_103850_create_members_table',	1),
(32,	'2020_12_14_104930_create_kinships_table',	1),
(33,	'2020_12_14_104938_create_family_relatives_table',	1),
(34,	'2020_12_18_172721_create_polls_table',	1),
(35,	'2020_12_18_172741_create_questions_table',	1),
(36,	'2020_12_18_172803_create_options_table',	1),
(37,	'2020_12_18_172818_create_answers_table',	1),
(38,	'2020_12_18_220902_create_poll_voters_table',	1),
(39,	'2020_12_19_045622_create_mods_table',	1);

DROP TABLE IF EXISTS `mods`;
CREATE TABLE `mods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fullname` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nat_id` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` double DEFAULT NULL,
  `password` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logout` tinyint(1) NOT NULL DEFAULT '0',
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mods` (`id`, `created_at`, `updated_at`, `fullname`, `nat_id`, `gender`, `phone`, `age`, `password`, `logout`, `pic`) VALUES
(1,	NULL,	NULL,	'mod1',	'12345678912345',	'male',	NULL,	NULL,	'mod1',	0,	'default.jpg'),
(2,	NULL,	NULL,	'mod2',	'12345678912346',	'male',	NULL,	NULL,	'mod2',	0,	'default.jpg'),
(3,	NULL,	NULL,	'mod3',	'12345678912347',	'male',	NULL,	NULL,	'mod3',	0,	'default.jpg'),
(4,	NULL,	NULL,	'mod4',	'12345678912348',	'male',	NULL,	NULL,	'mod4',	0,	'default.jpg'),
(5,	NULL,	NULL,	'mod5',	'12345678912349',	'male',	NULL,	NULL,	'mod5',	0,	'default.jpg'),
(6,	NULL,	NULL,	'mod6',	'12345678912350',	'male',	NULL,	NULL,	'wali6',	0,	'default.jpg'),
(7,	NULL,	NULL,	'mod7',	'12345678912351',	'male',	NULL,	NULL,	'mod7',	0,	'default.jpg');

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `option_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `options_question_id_foreign` (`question_id`),
  CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `poll_voters`;
CREATE TABLE `poll_voters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` bigint unsigned NOT NULL,
  `poll_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_voters_member_id_foreign` (`member_id`),
  KEY `poll_voters_poll_id_foreign` (`poll_id`),
  CONSTRAINT `poll_voters_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `poll_voters_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_poll_id_foreign` (`poll_id`),
  CONSTRAINT `questions_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2020-12-28 19:03:41
