/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 5.7.33 : Database - posyandu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`posyandu` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `posyandu`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_user_id_foreign` (`user_id`),
  CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`image`,`desc`,`user_id`,`status`,`created_at`,`updated_at`) values 
(1,'HTML','/202212/1671172543-184.png','html',5,'Active','2022-12-16 13:35:44','2022-12-16 13:35:44');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `laporan_hijau` */

DROP TABLE IF EXISTS `laporan_hijau`;

CREATE TABLE `laporan_hijau` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_telur_ditemukan` int(11) NOT NULL,
  `jml_telur_menetas` int(11) NOT NULL,
  `jml_tukik_dilepas` int(11) NOT NULL,
  `jml_pengunjung` int(11) NOT NULL,
  `inovasi_program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_penyu` int(11) NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_hijau_user_id_foreign` (`user_id`),
  CONSTRAINT `laporan_hijau_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `laporan_hijau` */

/*Table structure for table `laporan_pintar` */

DROP TABLE IF EXISTS `laporan_pintar`;

CREATE TABLE `laporan_pintar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_siswa` int(11) NOT NULL,
  `jenis_training` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_peserta` int(11) NOT NULL,
  `inovasi_program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serapan_industri` int(11) NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_pintar_user_id_foreign` (`user_id`),
  CONSTRAINT `laporan_pintar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `laporan_pintar` */

/*Table structure for table `laporan_sehat` */

DROP TABLE IF EXISTS `laporan_sehat`;

CREATE TABLE `laporan_sehat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_kader` int(11) NOT NULL,
  `jml_balita` int(11) NOT NULL,
  `jml_ibu_hamil` int(11) NOT NULL,
  `jenis_vaksin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_vaksin` int(11) NOT NULL,
  `inovasi_program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_sehat_user_id_foreign` (`user_id`),
  CONSTRAINT `laporan_sehat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `laporan_sehat` */

/*Table structure for table `master_data` */

DROP TABLE IF EXISTS `master_data`;

CREATE TABLE `master_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `master_data` */

insert  into `master_data`(`id`,`type`,`name`,`to`,`created_at`,`updated_at`) values 
(1,'pillar','Sehat Bersama Daihatsu\r\n','sehat','2023-07-28 14:39:27','2023-07-28 14:39:31'),
(2,'pillar','Pintar Bersama Daihatsu\r\n','pintar','2023-07-28 14:39:29','2023-07-28 14:39:33'),
(3,'pillar','Hijau Bersama Daihatsu\r\n','hijau','2023-07-28 14:39:57','2023-07-28 14:39:59'),
(4,'kelompok','Posyandu Sakura X','sehat','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(5,'kelompok','Posyandu Mawar IV','sehat','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(6,'kelompok','Posyandu Mawar VIII\r\n','sehat','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(7,'kelompok','SMK Al-Mufti Subang\r\n','pintar','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(8,'kelompok','SMK Muhammadiyah 1 Bantul\r\n','pintar','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(9,'kelompok','SMK NU Ma\'Arif Kudus\r\n','pintar','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(10,'kelompok','Konservasi Penyu Pasir Jambak\r\n','hijau','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(11,'kelompok','Konservasi Penyu Alun Utara\r\n','hijau','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(12,'kelompok','Konservasi Penyu Batuhiu\r\n','hijau','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(13,'area','Karawang\r\n','sehat','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(14,'area','Jakarta\r\n','sehat','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(15,'area','Jakarta\r\n','sehat','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(16,'area','Subang\r\n','pintar','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(17,'area','Bantul\r\n','pintar','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(18,'area','Kudus\r\n','pintar','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(19,'area','Padang\r\n','hijau','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(20,'area','Bengkulu\r\n','hijau','2023-07-28 14:39:57','2023-07-28 14:39:57'),
(21,'area','Pangandaran\r\n','hijau','2023-07-28 14:39:57','2023-07-28 14:39:57');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2022_01_27_143719_create_roles_table',1),
(6,'2022_01_27_145102_add_role_id_to_users_table',1),
(7,'2022_12_13_041751_create_categories_table',2),
(8,'2022_12_15_024035_create_posts_table',3),
(9,'2022_12_15_090625_create_tags_table',3),
(10,'2022_12_15_091103_create_post_tag_table',3),
(11,'2023_07_28_070233_create_laporan_hijau_table',4),
(12,'2023_07_28_071229_create_laporan_pintar_table',4),
(13,'2023_07_28_071253_create_laporan_sehat_table',4),
(14,'2023_07_28_073722_create_master_data_table',5);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `post_tag` */

DROP TABLE IF EXISTS `post_tag`;

CREATE TABLE `post_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `post_tag` */

insert  into `post_tag`(`id`,`tag_id`,`post_id`,`created_at`,`updated_at`) values 
(1,1,2,NULL,NULL);

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`category_id`,`user_id`,`title`,`slug`,`date`,`image`,`content`,`status`,`created_at`,`updated_at`) values 

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`role`,`created_at`,`updated_at`) values 
(1,'administrator','2022-12-06 15:58:23','2022-12-06 15:58:26'),
(2,'asesi','2022-12-06 15:59:29','2022-12-06 15:59:31'),
(3,'asesor','2023-07-17 14:21:03','2023-07-17 14:21:05'),
(4,'management','2023-07-17 14:21:07','2023-07-17 14:21:09');

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Blog','Portofolio') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tags` */

insert  into `tags`(`id`,`name`,`type`,`status`,`created_at`,`updated_at`) values 
(1,'HTML','Blog','Active','2022-12-15 09:27:38','2022-12-15 09:29:13');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_pillar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`avatar`,`jenis_pillar`,`nama_kelompok`,`wilayah`,`status`,`email_verified_at`,`password`,`remember_token`,`role_id`,`created_at`,`updated_at`,`is_active`) values 
(4,'user','user@gmail.com',NULL,'Pintar Bersama Daihatsu','Posyandu Mawar IV','Karawang','PIC Program (Auditor)',NULL,'$2y$10$rWghmMUmYCpFbxK1G/RgYe4EzUS4VC/Y9FMSJeohFLSfenEcPt0Zm','WQDDGKV2XrPF6JHj844lzefVBDaDlor0tiqP0efg',2,'2023-12-06 08:59:38','2023-01-01 08:59:38','Active'),
(5,'admin','admin@gmail.com',NULL,'Sehat Bersama Daihatsu','SMK Muhammadiyah 1 Bantul','Subang','PIC Kelompok (Auditee)',NULL,'$2y$10$0p8yfH6orBvZ4vd9gmARaO.2g7aE13DZ7bYkSsSO.KYJqHLhtFX0.','qcuGKNwZccQ4gu5bjNf2bGIiPb0J4vgudrkcQv2c',1,'2023-06-13 04:03:17','2023-07-17 16:35:06','Active');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;