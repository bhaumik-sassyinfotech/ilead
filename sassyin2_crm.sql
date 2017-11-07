-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2017 at 09:38 PM
-- Server version: 5.6.32-78.1-log
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sassyin2_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `website_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta_title` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `website_title`, `keyword`, `project`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'safety support1', 'safety_support', NULL, '<p>It is a long established fact that a reader will be distracted by the readable content of a</p>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'safety support System1', 'safety support system1', 'safety_support_System1', 1, '2017-08-04 06:28:39', '2017-09-13 15:06:40', NULL),
(2, 'privacy policy', 'privacypolicy', NULL, '<p>It is a long established fact that a reader will be distracted by the readable content of a</p>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<p>{{test1}}</p>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 1, '2017-08-08 03:52:25', '2017-09-08 16:47:29', NULL),
(4, 'Curren Analogue Black', 'curren_analogue', NULL, '<p>It is a long established fact that a reader will be distracted by the readable content of a</p>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Curren Analogue Black', 'Curren Analogue Black', 'Curren Analogue Black', 0, '2017-08-14 08:32:44', '2017-09-13 14:39:23', NULL),
(5, 'Terms Conditions', 'terms_conditions', NULL, '<p>It is a long established fact that a reader will be distracted by the readable content of a</p>\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Terms Conditions', 'Terms Conditions', 'Terms Conditions', 1, '2017-08-18 06:59:02', '2017-08-25 22:32:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cold_leads`
--

CREATE TABLE IF NOT EXISTS `cold_leads` (
  `lead_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source_id` int(11) NOT NULL DEFAULT '0',
  `currency` int(11) NOT NULL DEFAULT '0',
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `industry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staff_size` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distance` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linked_in` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_1` text COLLATE utf8_unicode_ci NOT NULL,
  `address_2` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `user_added_by` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cold_lead_notes`
--

CREATE TABLE IF NOT EXISTS `cold_lead_notes` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL COMMENT 'lead id for which notes are added',
  `note_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `user_added_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lable` varchar(100) CHARACTER SET utf8 NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `simbol` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `default_currency` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=8 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `lable`, `code`, `simbol`, `default_currency`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Indian Rupees', 'INR', '₹', 1, '2017-10-05 01:01:00', '2017-10-05 01:05:18', NULL),
(2, 'Australian Dollar', 'AUD', 'AU$', 1, '2017-10-05 01:07:30', '2017-10-05 01:07:30', NULL),
(3, 'US Dollar', 'USD', '$', 1, '2017-10-05 01:07:45', '2017-10-05 01:07:45', NULL),
(4, 'Canadian Dollar', 'CAD', '$', 1, '2017-10-28 15:33:42', '2017-10-28 15:35:00', NULL),
(5, 'Euro', 'Euro', '€', 1, '2017-10-28 15:34:22', '2017-10-28 15:34:22', NULL),
(6, 'Singapore Dollar', 'SGD', 'S$', 1, '2017-10-28 15:35:21', '2017-10-28 15:35:21', NULL),
(7, 'British Pound', 'GBP', '£', 1, '2017-10-28 15:36:59', '2017-10-28 15:36:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplate`
--

CREATE TABLE IF NOT EXISTS `emailtemplate` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `macros` varchar(255) DEFAULT NULL,
  `is_deleted` int(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `emailtemplate`
--

INSERT INTO `emailtemplate` (`id`, `title`, `keyword`, `subject`, `content`, `macros`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Forgot_Password', 'Forgot_Password', 'Password reset', '<p>Hello <strong>&nbsp;{{USERNAME}}</strong>,</p>\n<p>Please click on the following link to updated your password:</p>\n<p>Your new password= "{{FORGOTPASSWORDURL}}"</p>\n<p>Best regards,</p>\n<p>Gopark Team</p>', '{{USERNAME}}', 0, '2017-08-30 13:27:59', '2017-08-25 03:23:23', NULL),
(2, 'Register_Activate', 'Register_Activate', 'Register Activate', '      					      					<p>Hello {{USERNAME}},</p>\r\n\r\n<p>Welcome to ClickChat! Please click on the following link to confirm your GoPark account:</p>\r\n\r\n<p>Account activation URL <strong>:</strong> {{ACTIVATIONURL}}</p>\r\n\r\n<p>Best regards,</p>\r\n\r\n<p>GoPark Team</p>\r\n      				\r\n      				', '{{USERNAME}}', 0, '2017-08-30 13:28:01', '2017-08-03 03:03:35', NULL),
(4, 'Contact_Us', 'Contact_Us', 'Contact Us', '\r\n\r\n    <!DOCTYPE HTML>\r\n<html lang="en-US">\r\n<head>\r\n    <meta charset="UTF-8">\r\n    <title></title>\r\n</head>\r\n<body>\r\n    <p>Hello ,</p>\r\n    <p>We have received a new contact mail.</p>\r\n    <p>The provided details are:</p>\r\n    <p>Name: [NAME]</p>\r\n    <p>Email: [EMAIL]</p>\r\n<p>Phone: [PHONE]</p>\r\n<p>Message: [MESSAGE]</p>\r\n</body>\r\n</html>', '{{USERNAME}}', 0, '2017-08-30 13:28:03', '2017-04-24 12:49:33', NULL),
(5, 'Success_Book', 'Success_Book', 'Book Added To Queue', '\r\n    <meta charset="UTF-8">\r\n    <title></title>\r\n\r\n\r\n<p>Hello [USERNAME],</p>\r\n<p>Thank you for using BookHive.PK</p><p>Your requested book has been added to your Book Queue and will be delivered as per your Queue.</p>\r\n<p>Best regards,</p>\r\n<p>BookHive Team</p>\r\n\r\n', '{{USERNAME}}', 0, '2017-08-30 13:28:07', '2017-05-14 23:19:51', NULL),
(6, 'Rented On Book\n', 'Rented On Book', 'Rented On Book', '\r\n\r\n    <html lang="en-US">\r\n<head>\r\n    <meta charset="UTF-8">\r\n    <title></title>\r\n</head>\r\n<body>\r\n<p>Hello [USERNAME],</p>\r\n<p>congratulations.</p>\r\n<p>Your book is succesfullly deliver to you. have a fun.</p>\r\n<p>Best regards,</p>\r\n<p>BookHive Team</p>\r\n</body>\r\n</html>', '{{USERNAME}}', 0, '2017-08-30 13:28:05', '2017-04-24 16:01:29', NULL),
(7, 'Book Return Request', 'Book Return Request', 'Book Return Request', '<html lang="en-US">\r\n<head>\r\n    <meta charset="UTF-8">\r\n    <title></title>\r\n</head>\r\n<body>\r\n<p>Hello [USERNAME],</p>\r\n<p>Your return book request is sucessfully deliver to admin. he will contact you as soon as possible.</p>\r\n<p>Best regards,</p>\r\n<p>BookHive Team</p>\r\n</body>\r\n</html>', '{{USERNAME}}', 0, '2017-08-30 13:28:09', '2017-04-24 16:11:06', NULL),
(9, 'Invoice', 'Invoice', 'Invoice', '\r\n\r\n\r\n\r\n    <meta charset="utf-8">\r\n    <title></title>\r\n    <style>\r\n    .invoice-box{\r\n        max-width:800px;\r\n        margin:auto;\r\n        padding:30px;\r\n        border:1px solid #eee;\r\n        box-shadow:0 0 10px rgba(0, 0, 0, .15);\r\n        font-size:16px;\r\n        line-height:24px;\r\n        font-family:''Helvetica Neue'', ''Helvetica'', Helvetica, Arial, sans-serif;\r\n        color:#555;\r\n    }\r\n    \r\n    .invoice-box table{\r\n        width:100%;\r\n        line-height:inherit;\r\n        text-align:left;\r\n    }\r\n    \r\n    .invoice-box table td{\r\n        padding:5px;\r\n        vertical-align:top;\r\n    }\r\n    \r\n    .invoice-box table tr td:nth-child(2){\r\n        text-align:right;\r\n    }\r\n    \r\n    .invoice-box table tr.top table td{\r\n        padding-bottom:20px;\r\n    }\r\n    \r\n    .invoice-box table tr.top table td.title{\r\n        font-size:45px;\r\n        line-height:45px;\r\n        color:#333;\r\n    }\r\n    \r\n    .invoice-box table tr.information table td{\r\n        padding-bottom:40px;\r\n    }\r\n    \r\n    .invoice-box table tr.heading td{\r\n        background:#eee;\r\n        border-bottom:1px solid #ddd;\r\n        font-weight:bold;\r\n    }\r\n    \r\n    .invoice-box table tr.details td{\r\n        padding-bottom:20px;\r\n    }\r\n    \r\n    .invoice-box table tr.item td{\r\n        border-bottom:1px solid #eee;\r\n    }\r\n    \r\n    .invoice-box table tr.item.last td{\r\n        border-bottom:none;\r\n    }\r\n    \r\n    .invoice-box table tr.total td:nth-child(2){\r\n        border-top:2px solid #eee;\r\n        font-weight:bold;\r\n    }\r\n    \r\n    @media only screen and (max-width: 600px) {\r\n        .invoice-box table tr.top table td{\r\n            width:100%;\r\n            display:block;\r\n            text-align:center;\r\n        }\r\n        \r\n        .invoice-box table tr.information table td{\r\n            width:100%;\r\n            display:block;\r\n            text-align:center;\r\n        }\r\n    }\r\n    </style>\r\n\r\n\r\n\r\n    <div class="invoice-box">\r\n		<p>Dear [USERNAME],</p>\r\n        <table cellspacing="0" cellpadding="0">\r\n            <tbody><tr class="top">\r\n                <td colspan="2">\r\n                    <table>\r\n                        <tbody><tr>\r\n                            <td class="title">\r\n                                <img src="http://bookhive.sipl-demo.com/public/assets/img/logo.png" style="width:100%; max-width:300px;">\r\n                            </td>\r\n                            <td>\r\n                                Invoice INV00[INVOICEID]<br>\r\n                                Created: [CREATED]<br>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody></table>\r\n                </td>\r\n            </tr>\r\n            <tr class="information">\r\n                <td colspan="2">\r\n                    <table>\r\n                        <tbody><tr>\r\n                            <td>\r\n                                <strong>BOOKHIVE</strong><br>\r\n								3946 Penn Street<br>\r\n								Birmingham, AL 35209<br>\r\n								admin@bookhive.com<br>\r\n								SALES TAX:254876\r\n                            </td>\r\n                            <td>\r\n                                [USERNAME]<br>\r\n								[ADDRESS]<br>\r\n								[CITY]<br>\r\n								[STATE]<br>\r\n								[COUNTRY]<br>\r\n                            </td>\r\n                        </tr>\r\n                    </tbody></table>\r\n                </td>\r\n            </tr>\r\n            <tr class="heading">\r\n                <td>Item</td>\r\n                <td>Price ($)</td>\r\n            </tr>\r\n            <tr class="item">\r\n                <td>[PACKAGE]<br>([DURATION])</td>\r\n                <td>$[PRICE]</td>\r\n            </tr>\r\n            <tr class="total">\r\n                <td></td>\r\n                <td>Total: $[PRICE]</td>\r\n            </tr>\r\n        </tbody></table>\r\n</div>\r\n\r\n\r\n\r\n', '{{USERNAME}}', 0, '2017-08-30 13:28:08', '2017-05-09 16:52:57', NULL),
(10, 'Change Password', 'Change Password', 'Your Password Changed Sucessfully', '<p><strong>Your Password Changed Sucessfully</strong></p>\r\n\r\n<p>Thanks</p>\r\n', '{{USERNAME}}', 0, '2017-08-30 13:28:13', '2017-08-09 06:35:56', NULL),
(11, 'Change Password', 'Change Password', 'Your Password Changed Sucessfully', '<p><strong>Your Password Changed Sucessfully</strong></p>\r\n\r\n<p>Thanks</p>\r\n', '{{USERNAME}}', 0, '2017-08-30 13:28:15', '2017-08-09 06:36:00', NULL),
(12, 'test', 'tttt', 'this is demo', '<p>this is dfmeo test macros</p>', '{{TEST}}', 0, '2017-08-30 13:36:21', '2017-08-30 08:06:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

CREATE TABLE IF NOT EXISTS `follow_ups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `follow_ups`
--

INSERT INTO `follow_ups` (`id`, `label`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'email', 'Email', '2017-10-05 07:45:29', '2017-10-28 15:38:00', NULL),
(2, 'call_back', 'Call Back', '2017-10-28 15:38:17', '2017-10-28 15:38:17', NULL),
(3, 'send_email', 'Send Email', '2017-10-28 15:38:32', '2017-10-28 15:38:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE IF NOT EXISTS `gifts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `design_image` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `day` int(11) DEFAULT NULL,
  `coins` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gifts_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `international_leads`
--

CREATE TABLE IF NOT EXISTS `international_leads` (
  `lead_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(301) COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refer_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `currency` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `source_id` int(11) NOT NULL DEFAULT '0',
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_secondary` varchar(25) COLLATE utf8_unicode_ci DEFAULT '  ',
  `email_secondary` varchar(50) COLLATE utf8_unicode_ci DEFAULT ' ',
  `skype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_added_by` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lead_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `international_leads`
--

INSERT INTO `international_leads` (`lead_id`, `project_name`, `contact_person`, `job_title`, `refer_id`, `type`, `currency`, `amount`, `source_id`, `tags`, `comment`, `status`, `url`, `location`, `email`, `phone_number_secondary`, `email_secondary`, `skype`, `phone_number`, `user_added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'project 1', 'BHAUMIK', 'web', '', 0, 1, 12.20, 1, 'dfadfda,vdda,vdaf', 'fdaff', 'closed', 'http://www.example.com', '', 'bhaumik.sassyinfotech@gmail.com', '', 'bhaumik.sassyinfotech@gmail.com', '', '', '1', '2017-10-27 17:47:50', '2017-11-03 23:53:05', NULL),
(2, 'ABCD', '45446787346523$@#@$$', 'IT Company', 'A001', 0, 1, 500.00, 0, 'PHP,Word Press,CSS3', 'This is Testing Comment... Kindly Ignore It...!!!', 'open', 'http://www.sassyinfotech.com', 'Surat, Gujarat', 'keyur.sassyinfotech@gmail.com', '1234567890', 'keyur.sassyinfotech@gmail.com', 'keyur.sassyinfotech', '1234567890', '1', '2017-10-27 20:18:18', '2017-11-03 23:53:10', NULL),
(3, 'XYZ', 'Chintan Maheta', 'Business Development', 'A002', 0, 1, 1500.00, 0, '', '', 'closed', 'http://www.sassyinfotech.com', 'Mumbai', 'chintan.sassyinfotech@gmail.com', '1234567890', 'sdfadasd', 'chintan.sassyinfotech', '1234567890', '1', '2017-10-27 20:39:30', '2017-11-03 22:43:57', NULL),
(4, 'ABCD1234', 'Chintan', 'IT', 'A003', 1, 3, 500.00, 1, '', '', 'closed', 'http://www.example.com', 'Cleavland, Ohio', '', '23', '', '', '123456789', '2', '2017-10-28 00:14:24', '2017-11-04 00:31:28', '2017-11-04 00:31:28'),
(5, 'Sub Chitan', 'Testing', 'IT', 'KKK.com', 0, 2, 800.00, 1, 'php,laravel', '', 'converted', 'http://www.sassyinfotech', 'Surat', 'skjdf@skjdf.com', '1654680980', 'skjdf@#skjdf.com', 'kjasedf.asdjk', '12345657890', '3', '2017-10-27 15:21:43', '2017-11-04 00:31:16', NULL),
(6, 'asdasdasd', 'asdasda', 'sdasdasd', 'asdasda', 3, 2, 234.00, 1, 'asdfasd,.ad,asd,asdasd,ertr,erhfgyjgyj', 'sdfdghserfehtrgdg', 'converted', 'http://www.example.com', 'sdfsdf', 'sdfsdf@sdf.dfgy', '456456456456', 'sdfsdf@sdf.dfgy', 'fghdfgdg', '456456456456', '3', '2017-10-28 16:09:05', '2017-11-04 00:00:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `international_lead_notes`
--

CREATE TABLE IF NOT EXISTS `international_lead_notes` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL COMMENT 'lead id for which notes are added',
  `note_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `user_added_by` int(11) NOT NULL DEFAULT '0',
  `user_updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `international_lead_notes`
--

INSERT INTO `international_lead_notes` (`note_id`, `lid`, `note_desc`, `user_added_by`, `user_updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'call to client', 1, 1, '2017-10-27 17:48:56', '2017-10-27 17:49:04', NULL),
(2, 1, 'fadfdafdaf', 1, 1, '2017-10-27 17:49:58', '2017-10-27 17:49:58', NULL),
(3, 2, 'Arranage Call Back', 1, 1, '2017-10-27 20:46:19', '2017-10-27 20:46:19', NULL),
(4, 2, 'Test1', 1, 1, '2017-10-27 20:47:04', '2017-10-27 20:48:35', NULL),
(5, 2, 'Test3', 1, 1, '2017-10-27 20:47:07', '2017-10-27 20:47:07', NULL),
(6, 2, 'Test2', 1, 1, '2017-10-27 20:47:09', '2017-10-27 20:47:09', NULL),
(7, 4, 'Inquiry Closed', 2, 2, '2017-10-28 00:14:53', '2017-10-28 00:14:53', NULL),
(8, 6, 'asdasdasd', 1, 1, '2017-10-28 18:02:18', '2017-10-28 18:02:22', '2017-10-28 18:02:22'),
(9, 6, 'asdasd', 1, 1, '2017-10-28 18:02:30', '2017-10-28 18:02:48', '2017-10-28 18:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `international_reminders`
--

CREATE TABLE IF NOT EXISTS `international_reminders` (
  `reminder_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `remind_at` datetime NOT NULL,
  `lid` int(11) NOT NULL,
  `user_added_by` int(11) NOT NULL,
  `user_updated_by` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reminder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `international_reminders`
--

INSERT INTO `international_reminders` (`reminder_id`, `remind_at`, `lid`, `user_added_by`, `user_updated_by`, `subject`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2017-10-28 14:45:00', 2, 1, 1, 'Call to Keyur', '2017-10-27 20:45:53', '2017-10-27 20:47:22', NULL),
(2, '2017-11-19 06:55:00', 2, 1, 1, 'Call to Keyur1', '2017-10-27 20:47:51', '2017-10-27 20:47:51', NULL),
(3, '2018-01-01 09:00:00', 4, 2, 2, 'Need to call after 1Year', '2017-10-28 00:15:25', '2017-10-28 00:15:25', NULL),
(4, '2017-10-28 12:03:36', 6, 1, 1, 'asd', '2017-10-28 18:03:36', '2017-10-28 18:03:45', '2017-10-28 18:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `local_leads`
--

CREATE TABLE IF NOT EXISTS `local_leads` (
  `lead_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT '0',
  `phone_number_1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `industry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `type` int(11) DEFAULT '0',
  `refer_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `currency` int(11) DEFAULT '0',
  `amount` double(8,2) DEFAULT '0.00',
  `user_added_by` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `import_type` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lead_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `local_leads`
--

INSERT INTO `local_leads` (`lead_id`, `company_name`, `contact_person`, `job_title`, `source_id`, `phone_number_1`, `phone_number_2`, `email`, `address`, `industry`, `url`, `comment`, `type`, `refer_id`, `status`, `tags`, `currency`, `amount`, `user_added_by`, `import_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Action Aviation Ltd', 'Suzzy Davis', NULL, 0, '18583349939', NULL, 'sdavis@actionaviation.com', 'Suite517,B Wing Carlton towers,1 Airport Rd  Bangalore - 560008, INDIA', NULL, 'londoncranfield.aero', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(2, 'N/A', 'Pankaj Sharma', NULL, 0, '917023888828', NULL, 'pnkj4996@gmail.com', 'A 37 anand vihar railway coloney jagatpura Rajasthan jaipur - 302017, INDIA', NULL, '2way.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(3, NULL, 'Vipin Singh', NULL, 0, '19198352246', NULL, 'singh_vipin@ymail.com', '570/1483-A UP Lucknow - 226001, INDIA', NULL, 'orbitcoin.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(4, NULL, 'Ganesh Singhania', NULL, 0, '919830071750', NULL, 'contact@squarefourgroup.com', '238A, AJC BOSE ROAD|2nd floor, suite no 2B West Bengal Kolkata - 700020, INDIA', NULL, 'paycrypto.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(5, NULL, 'Ganesh Singhania', NULL, 0, '919830071750', NULL, 'contact@squarefourgroup.com', '238A, AJC BOSE ROAD|2nd floor, suite no 2B West Bengal Kolkata - 700020, INDIA', NULL, 'payrentcoin.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(6, 'Hoichoi Technologies Pvt Ltd', 'Aloke Mazumdar', NULL, 0, '913366555000', NULL, 'domains@svf.in', 'Acropolis, 18th Floor|1858/1 Rajdanga Main Road West Bengal Kolkata - 700019, INDIA', NULL, 'hoichoi.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(7, 'Hoichoi Technologies Pvt Ltd', 'Aloke Mazumdar', NULL, 0, '913366555000', NULL, 'domains@svf.in', 'Acropolis, 18th Floor|1858/1 Rajdanga Main Road West Bengal Kolkata - 700019, INDIA', NULL, 'svf.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(8, 'Scintillate Marketing', 'Prasad S', NULL, 0, '919600141056', NULL, 'prasad.scintillate@gmail.com', 'T Nagar Tamil Nadu Chennai - 600017, INDIA', NULL, 'scintillate.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(9, 'Singer India Limited', 'Akshay Aggarwal', NULL, 0, '9140617777', NULL, 'akshay@singerindia.net', 'A26/4 2nd floor Mohan Cooperative|Industrial Estate Delhi New Delhi - 110044, INDIA', NULL, 'singerindia.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(10, NULL, 'Tarang Rana', NULL, 0, '918750453821', NULL, 'tarang886547@gmail.com', 'E-E2, Sai Complex, Part I, 40 feet Road,Opp.C-1, New Janak Puri|Block D 1, Adarsh Nagar, Bindapur, New Delhi Delhi New Delhi - 110059, INDIA', NULL, 'tarang8plkhome.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(11, NULL, 'Tarang Rana', NULL, 0, '918750453821', NULL, 'tarang886547@gmail.com', 'E-E2, Sai Complex, Part I, 40 feet Road,Opp.C-1, New Janak Puri|Block D 1, Adarsh Nagar, Bindapur, New Delhi Delhi New Delhi - 110059, INDIA', NULL, 'tarang8plkhub.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(12, NULL, 'Tarang Rana', NULL, 0, '918750453821', NULL, 'tarang886547@gmail.com', 'E-E2, Sai Complex, Part I, 40 feet Road,Opp.C-1, New Janak Puri|Block D 1, Adarsh Nagar, Bindapur, New Delhi Delhi New Delhi - 110059, INDIA', NULL, 'tarang8plknow.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(13, NULL, 'Tarang Rana', NULL, 0, '918750453821', NULL, 'tarang886547@gmail.com', 'E-E2, Sai Complex, Part I, 40 feet Road,Opp.C-1, New Janak Puri|Block D 1, Adarsh Nagar, Bindapur, New Delhi Delhi New Delhi - 110059, INDIA', NULL, 'tarang8plklab.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(14, NULL, 'Tarang Rana', NULL, 0, '918750453821', NULL, 'tarang886547@gmail.com', 'E-E2, Sai Complex, Part I, 40 feet Road,Opp.C-1, New Janak Puri|Block D 1, Adarsh Nagar, Bindapur, New Delhi Delhi New Delhi - 110059, INDIA', NULL, 'tarang8plktech.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL),
(15, NULL, 'Tarang Rana', NULL, 0, '918750453821', NULL, 'tarang886547@gmail.com', 'E-E2, Sai Complex, Part I, 40 feet Road,Opp.C-1, New Janak Puri|Block D 1, Adarsh Nagar, Bindapur, New Delhi Delhi New Delhi - 110059, INDIA', NULL, 'tarang8plkpro.asia', NULL, 0, '0', NULL, NULL, 1, 0.00, '1', 1, '2017-10-31 17:07:48', '2017-10-31 17:07:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `local_lead_notes`
--

CREATE TABLE IF NOT EXISTS `local_lead_notes` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL COMMENT 'lead id for which notes are added',
  `note_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `user_added_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE IF NOT EXISTS `metas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`id`, `url`, `website_title`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, '/mummaco/adminPanel/index', 'Mummaco1', 'Mummaco1', 'Mummaco1', 'Mammaco home page1', '2017-08-18 03:38:21', '2017-08-26 01:48:11', NULL),
(10, '/mummaco/index', 'Mummaco1', 'Mummaco Home1', 'Mummaco Home1', 'Mammaco home page1', '2017-08-18 03:38:21', '2017-08-26 01:48:22', NULL),
(11, 'test33', 'testtetst', 'test22', 'test55', 'test44', '2017-08-26 01:53:45', '2017-09-13 15:35:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2016_11_01_093059_create_roles_table', 1),
('2016_11_01_093059_create_users_table', 1),
('2016_11_01_093100_create_user_actions_table', 1),
('2016_11_01_093938_create_currencies_table', 1),
('2016_11_01_094240_create_transaction_types_table', 1),
('2016_11_01_094436_create_income_sources_table', 1),
('2016_11_01_094559_create_client_statuses_table', 1),
('2016_11_01_094644_create_project_statuses_table', 1),
('2016_11_02_011723_create_clients_table', 1),
('2016_11_02_013141_create_projects_table', 1),
('2016_11_02_020222_create_notes_table', 1),
('2016_11_02_020435_create_documents_table', 1),
('2016_11_02_021725_create_transactions_table', 1),
('2017_08_01_115312_create_cms_table', 1),
('2017_08_02_072843_create_permission_table', 1),
('2017_08_02_115231_create_plans_table', 1),
('2017_08_03_063401_create_coins_table', 1),
('2017_08_03_110957_create_badge_table', 1),
('2017_08_03_114524_create_design_table', 1),
('2017_08_04_094024_create_gift_category_table', 2),
('2017_08_04_095318_create_gifts_table', 3),
('2017_09_15_130103_create_international_leads_table', 4),
('2017_09_18_064756_create_follow_ups_table', 4),
('2017_09_22_045353_create_international_lead_notes_table', 4),
('2017_10_02_123446_create_sources_table', 4),
('2017_10_03_120807_create_local_leads_table', 4),
('2017_10_03_131001_create_local_lead_notes_table', 4),
('2017_10_03_131057_create_cold_leads_table', 4),
('2017_10_03_131101_create_cold_lead_notes_table', 4),
('2017_10_16_114847_create_cache_table', 5),
('2017_10_26_111726_create_international_reminders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `identifier`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 'this is test123', '2017-08-26 06:44:18', '2017-09-13 15:10:50', NULL),
(2, 'noti', '<p>fddsf111011</p>', '2017-08-26 06:46:27', '2017-08-28 02:10:10', '2017-08-28 02:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_title_unique` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `permissions`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '{"add":"TRUE","delete":"TRUE","view":"TRUE","update":"TRUE"}', 1, '2017-08-04 03:57:23', '2017-10-13 06:26:53', NULL),
(14, 'Manager', '{"add":"TRUE","delete":"FALSE","view":"TRUE","update":"TRUE"}', 1, '2017-10-10 07:58:48', '2017-10-28 16:55:10', NULL),
(15, 'Employee', '{"add":"TRUE","delete":"FALSE","view":"TRUE","update":"FALSE"}', 1, '2017-10-12 07:29:30', '2017-10-28 16:55:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'websiteid+++general+++websitename1', 'Test', '2017-08-30 13:22:14', '2017-08-30 13:22:14', '2017-08-30 13:22:14'),
(2, 'websiteid+++general+++websitename2', 'chat', '2017-08-30 13:22:14', '2017-08-30 13:22:14', '2017-08-30 13:22:14'),
(3, 'websiteid+++general+++gender', '1', '2017-08-30 13:22:14', '2017-08-30 13:22:14', '2017-08-30 13:22:14'),
(4, 'websiteid+++general+++gende', '1', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(5, 'websiteid+++general+++game', '0', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(6, 'social+++social_icon+++facebook', 'facebook.com', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(7, 'social+++social_icon+++instagram', 'instagram.com', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(8, 'social+++social_icon+++twitter', 'twitter.com', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(9, 'social+++social_icon+++google_plus', 'google.com', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(10, 'social+++social_icon1+++facebook1', 'fb1', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(11, 'social+++social_icon1+++instagram1', 'instra1', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(12, 'social+++social_icon1+++twitter1', 'twit1', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(13, 'social+++social_icon1+++google_plus1', 'google1', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15'),
(14, 'active_tab+++0+++0', 'websiteid', '2017-08-30 13:22:15', '2017-08-30 13:22:15', '2017-08-30 13:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `label`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'skype', 'Skype', '2017-10-05 07:45:35', '2017-10-28 15:38:57', NULL),
(2, 'email', 'Email', '2017-10-28 15:39:08', '2017-10-28 15:39:08', NULL),
(3, 'referral', 'Referral', '2017-10-28 15:39:21', '2017-10-28 15:39:21', NULL),
(4, 'none', 'None', '2017-10-28 15:39:29', '2017-10-28 15:39:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_language`
--

CREATE TABLE IF NOT EXISTS `store_language` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(50) NOT NULL,
  `iso_631_1_code` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `store_language`
--

INSERT INTO `store_language` (`id`, `lang_name`, `iso_631_1_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Abkhazian1', 'ab', '2017-08-28 04:58:18', '2017-08-28 05:07:40', NULL),
(2, 'English', 'EN', '2017-09-13 16:03:22', '2017-09-13 16:03:22', NULL),
(3, 'Hindi', 'Hi', '2017-09-13 16:09:31', '2017-09-13 16:09:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `manager_id` int(11) NOT NULL DEFAULT '0',
  `module` text COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(11) DEFAULT '1',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daily_target` int(11) NOT NULL DEFAULT '0',
  `monthly_target` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_4_role_role_id_user` (`role_id`),
  KEY `users_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `lastname`, `email`, `profile_pic`, `password`, `role_id`, `manager_id`, `module`, `is_admin`, `remember_token`, `daily_target`, `monthly_target`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bhaumik', 'Mehta', 'admin@admin.com', '10892.jpg', '$2y$10$Mwo9dPOnN/C/mdyMkA590OfbF88cDEFy2kysn1l0AsW88jIM9HOgO', 1, 0, '{"international":"TRUE","cold":"TRUE","local":"TRUE"}', 1, 'GPAjH5F1CQIEGOBYKuciLUGRoXFklgOEehflRJtqMQXMYw0j10XKVPn0tkEt', 0, '0', 1, '2017-08-04 03:57:23', '2017-09-14 11:00:41', NULL),
(2, 'Keyur', 'Parmar', 'keyur.sassyinfotech@gmail.com', '21538.jpg', '$2y$10$xP4WvbEO2oRnig194ceaZufJBNJ84OHu9lWvjgFgrRKHurQwG2Ve6', 14, 0, '{"international":"TRUE","cold":"FALSE","local":"FALSE"}', 1, 'DbydUJYzCtiNbClvMgiayrTuG7UmmQyXwuzwbwYrHdtINgk4dCj3VnSkt3ah', 123, '0', 0, '2017-10-28 00:10:33', '2017-10-28 17:35:02', NULL),
(3, 'Chintan', 'Maheta', 'chintan.sassyinfotech@gmail.com', '17578.png', '$2y$10$qaODo.zgKebqCSgcJDDYpeoYU1jG6D47d5Z.wMak.WCaerMeVNfKK', 15, 0, '{"international":"TRUE","cold":"FALSE","local":"FALSE"}', 1, 'Pz2utMQCCiTvJJGu2nxZz924J0hjy7y3RE9xmI2y2CAV3eXr3n1XjGqkrAi9', 45, '950', 1, '2017-10-28 00:26:55', '2017-10-28 00:26:55', NULL),
(4, 'Riddhi', 'Naik', 'riddhi.sassyinfotech@gmail.com', '25539.png', '$2y$10$ZSBXpxP4OcFeEYVtvg07n.YaRgIJmhgY4lQigzns7LnBZ9/hmXb5a', 1, 0, '{"international":"TRUE","cold":"FALSE","local":"FALSE"}', 1, '3Iaa0kUw3Fq6IvlzgBpnJrAvtZLXe8egdcfhJjX5rMmSjF8QXaE2PPhKVqxt', 100, '0', 1, '2017-10-28 17:26:39', '2017-10-28 17:26:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE IF NOT EXISTS `user_actions` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_5_user_user_id_user_action` (`user_id`),
  KEY `user_actions_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_actions`
--

INSERT INTO `user_actions` (`id`, `user_id`, `action`, `action_model`, `action_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'updated', 'users', 1, '2017-08-08 05:58:10', '2017-08-08 05:58:10', NULL),
(2, 1, 'updated', 'users', 1, '2017-08-08 05:58:35', '2017-08-08 05:58:35', NULL),
(3, 1, 'updated', 'users', 1, '2017-08-08 06:01:35', '2017-08-08 06:01:35', NULL),
(4, 1, 'updated', 'users', 1, '2017-08-09 06:06:34', '2017-08-09 06:06:34', NULL),
(5, 1, 'updated', 'users', 1, '2017-08-09 06:25:11', '2017-08-09 06:25:11', NULL),
(6, 1, 'updated', 'users', 1, '2017-08-09 06:32:44', '2017-08-09 06:32:44', NULL),
(7, 1, 'updated', 'users', 1, '2017-08-09 06:34:38', '2017-08-09 06:34:38', NULL),
(8, 1, 'created', 'users', 2, '2017-08-09 08:46:44', '2017-08-09 08:46:44', NULL),
(9, 1, 'updated', 'users', 1, '2017-08-09 08:46:57', '2017-08-09 08:46:57', NULL),
(10, 2, 'updated', 'users', 2, '2017-08-09 08:49:38', '2017-08-09 08:49:38', NULL),
(11, 1, 'updated', 'users', 1, '2017-08-10 06:33:44', '2017-08-10 06:33:44', NULL),
(12, 2, 'updated', 'users', 2, '2017-08-10 06:36:53', '2017-08-10 06:36:53', NULL),
(13, 1, 'updated', 'users', 1, '2017-08-10 09:24:27', '2017-08-10 09:24:27', NULL),
(14, 1, 'updated', 'users', 1, '2017-08-11 05:08:40', '2017-08-11 05:08:40', NULL),
(15, 1, 'updated', 'users', 1, '2017-08-11 05:47:36', '2017-08-11 05:47:36', NULL),
(16, 1, 'updated', 'users', 1, '2017-08-11 09:11:17', '2017-08-11 09:11:17', NULL),
(17, 1, 'updated', 'users', 1, '2017-08-11 09:22:36', '2017-08-11 09:22:36', NULL),
(18, 1, 'updated', 'users', 1, '2017-08-11 09:31:22', '2017-08-11 09:31:22', NULL),
(19, 1, 'created', 'users', 3, '2017-08-12 06:17:52', '2017-08-12 06:17:52', NULL),
(20, 1, 'created', 'users', 4, '2017-08-12 06:18:13', '2017-08-12 06:18:13', NULL),
(21, 1, 'created', 'users', 5, '2017-08-12 06:18:31', '2017-08-12 06:18:31', NULL),
(22, 1, 'created', 'users', 6, '2017-08-12 06:18:46', '2017-08-12 06:18:46', NULL),
(23, 1, 'updated', 'users', 1, '2017-08-12 07:28:06', '2017-08-12 07:28:06', NULL),
(24, 1, 'updated', 'users', 1, '2017-08-12 07:28:32', '2017-08-12 07:28:32', NULL),
(25, 1, 'updated', 'users', 5, '2017-08-12 10:26:06', '2017-08-12 10:26:06', NULL),
(26, 1, 'updated', 'users', 5, '2017-08-12 10:26:18', '2017-08-12 10:26:18', NULL),
(27, 1, 'updated', 'users', 5, '2017-08-12 10:27:24', '2017-08-12 10:27:24', NULL),
(28, 1, 'created', 'users', 7, '2017-08-12 10:28:05', '2017-08-12 10:28:05', NULL),
(29, 1, 'updated', 'users', 1, '2017-08-14 06:02:49', '2017-08-14 06:02:49', NULL),
(30, 1, 'updated', 'users', 1, '2017-08-14 06:02:55', '2017-08-14 06:02:55', NULL),
(31, 1, 'updated', 'users', 1, '2017-08-14 06:09:42', '2017-08-14 06:09:42', NULL),
(32, 1, 'updated', 'users', 1, '2017-08-14 06:10:58', '2017-08-14 06:10:58', NULL),
(33, 1, 'updated', 'users', 1, '2017-08-14 06:11:07', '2017-08-14 06:11:07', NULL),
(34, 1, 'updated', 'users', 1, '2017-08-14 06:12:22', '2017-08-14 06:12:22', NULL),
(35, 1, 'updated', 'users', 1, '2017-08-14 09:25:09', '2017-08-14 09:25:09', NULL),
(36, 1, 'updated', 'users', 1, '2017-08-14 17:24:32', '2017-08-14 17:24:32', NULL),
(37, 1, 'updated', 'users', 1, '2017-08-14 17:28:07', '2017-08-14 17:28:07', NULL),
(38, 1, 'updated', 'users', 1, '2017-08-14 17:28:34', '2017-08-14 17:28:34', NULL),
(39, 1, 'updated', 'users', 1, '2017-08-14 17:42:07', '2017-08-14 17:42:07', NULL),
(40, 1, 'updated', 'users', 1, '2017-08-14 17:54:26', '2017-08-14 17:54:26', NULL),
(41, 1, 'created', 'users', 8, '2017-08-16 08:19:06', '2017-08-16 08:19:06', NULL),
(42, 1, 'created', 'users', 9, '2017-08-17 04:54:55', '2017-08-17 04:54:55', NULL),
(43, 1, 'created', 'users', 10, '2017-08-17 04:56:59', '2017-08-17 04:56:59', NULL),
(44, 1, 'created', 'users', 11, '2017-08-17 05:01:03', '2017-08-17 05:01:03', NULL),
(45, 1, 'created', 'users', 12, '2017-08-17 05:03:51', '2017-08-17 05:03:51', NULL),
(46, 1, 'created', 'users', 13, '2017-08-17 05:16:21', '2017-08-17 05:16:21', NULL),
(47, 1, 'created', 'users', 14, '2017-08-17 05:19:13', '2017-08-17 05:19:13', NULL),
(48, 1, 'created', 'users', 15, '2017-08-17 05:21:23', '2017-08-17 05:21:23', NULL),
(49, 1, 'created', 'users', 16, '2017-08-17 05:22:40', '2017-08-17 05:22:40', NULL),
(50, 1, 'created', 'users', 17, '2017-08-17 05:23:57', '2017-08-17 05:23:57', NULL),
(51, 1, 'created', 'users', 18, '2017-08-17 05:25:55', '2017-08-17 05:25:55', NULL),
(52, 1, 'updated', 'users', 18, '2017-08-17 05:25:55', '2017-08-17 05:25:55', NULL),
(53, 1, 'updated', 'users', 18, '2017-08-17 05:33:24', '2017-08-17 05:33:24', NULL),
(54, 1, 'updated', 'users', 18, '2017-08-17 05:33:46', '2017-08-17 05:33:46', NULL),
(55, 1, 'updated', 'users', 18, '2017-08-17 05:33:46', '2017-08-17 05:33:46', NULL),
(56, 1, 'updated', 'users', 18, '2017-08-17 05:37:10', '2017-08-17 05:37:10', NULL),
(57, 1, 'updated', 'users', 18, '2017-08-17 05:38:00', '2017-08-17 05:38:00', NULL),
(58, 1, 'updated', 'users', 1, '2017-08-17 05:49:31', '2017-08-17 05:49:31', NULL),
(59, 1, 'updated', 'users', 1, '2017-08-17 05:52:05', '2017-08-17 05:52:05', NULL),
(60, 1, 'updated', 'users', 1, '2017-08-17 05:52:05', '2017-08-17 05:52:05', NULL),
(61, 1, 'updated', 'users', 1, '2017-08-17 05:55:36', '2017-08-17 05:55:36', NULL),
(62, 1, 'updated', 'users', 1, '2017-08-17 05:55:36', '2017-08-17 05:55:36', NULL),
(63, 1, 'updated', 'users', 1, '2017-08-17 05:55:58', '2017-08-17 05:55:58', NULL),
(64, 1, 'updated', 'users', 1, '2017-08-17 05:55:58', '2017-08-17 05:55:58', NULL),
(65, 1, 'updated', 'users', 1, '2017-08-17 11:01:09', '2017-08-17 11:01:09', NULL),
(66, 1, 'updated', 'users', 1, '2017-08-17 11:03:21', '2017-08-17 11:03:21', NULL),
(67, 1, 'updated', 'users', 1, '2017-08-17 11:03:29', '2017-08-17 11:03:29', NULL),
(68, 1, 'updated', 'users', 1, '2017-08-17 11:13:19', '2017-08-17 11:13:19', NULL),
(69, 1, 'updated', 'users', 1, '2017-08-17 11:22:41', '2017-08-17 11:22:41', NULL),
(70, 1, 'updated', 'users', 1, '2017-08-17 11:23:10', '2017-08-17 11:23:10', NULL),
(71, 1, 'updated', 'users', 1, '2017-08-21 04:24:18', '2017-08-21 04:24:18', NULL),
(72, 1, 'updated', 'users', 1, '2017-08-21 04:26:55', '2017-08-21 04:26:55', NULL),
(73, 1, 'updated', 'users', 1, '2017-08-21 04:29:54', '2017-08-21 04:29:54', NULL),
(74, 1, 'updated', 'users', 1, '2017-08-21 04:31:25', '2017-08-21 04:31:25', NULL),
(75, 1, 'updated', 'users', 1, '2017-08-21 04:34:19', '2017-08-21 04:34:19', NULL),
(76, 1, 'updated', 'users', 1, '2017-08-21 04:35:07', '2017-08-21 04:35:07', NULL),
(77, 1, 'updated', 'users', 1, '2017-08-21 04:37:28', '2017-08-21 04:37:28', NULL),
(78, 1, 'updated', 'users', 1, '2017-08-21 04:37:36', '2017-08-21 04:37:36', NULL),
(79, 1, 'updated', 'users', 1, '2017-08-22 00:00:41', '2017-08-22 00:00:41', NULL),
(80, 1, 'updated', 'users', 1, '2017-08-22 00:00:47', '2017-08-22 00:00:47', NULL),
(81, 1, 'created', 'users', 19, '2017-08-22 01:48:54', '2017-08-22 01:48:54', NULL),
(82, 1, 'created', 'users', 20, '2017-08-22 01:50:17', '2017-08-22 01:50:17', NULL),
(83, 1, 'created', 'users', 21, '2017-08-22 02:01:16', '2017-08-22 02:01:16', NULL),
(84, 1, 'updated', 'users', 1, '2017-08-22 03:46:33', '2017-08-22 03:46:33', NULL),
(85, 19, 'updated', 'users', 19, '2017-08-22 04:50:22', '2017-08-22 04:50:22', NULL),
(86, 19, 'updated', 'users', 19, '2017-08-22 04:59:18', '2017-08-22 04:59:18', NULL),
(87, 19, 'updated', 'users', 19, '2017-08-22 04:59:39', '2017-08-22 04:59:39', NULL),
(88, 19, 'updated', 'users', 19, '2017-08-22 05:04:36', '2017-08-22 05:04:36', NULL),
(89, 1, 'updated', 'users', 1, '2017-08-22 05:12:50', '2017-08-22 05:12:50', NULL),
(90, 1, 'updated', 'users', 1, '2017-08-22 05:18:31', '2017-08-22 05:18:31', NULL),
(91, 19, 'updated', 'users', 19, '2017-08-22 05:53:52', '2017-08-22 05:53:52', NULL),
(92, 1, 'updated', 'users', 1, '2017-08-23 06:06:51', '2017-08-23 06:06:51', NULL),
(93, 1, 'updated', 'users', 1, '2017-08-23 22:50:28', '2017-08-23 22:50:28', NULL),
(94, 1, 'updated', 'users', 1, '2017-08-23 22:59:18', '2017-08-23 22:59:18', NULL),
(95, 1, 'updated', 'users', 1, '2017-08-23 23:04:52', '2017-08-23 23:04:52', NULL),
(96, 1, 'updated', 'users', 1, '2017-08-24 03:57:16', '2017-08-24 03:57:16', NULL),
(97, 1, 'deleted', 'users', 21, '2017-08-24 04:00:29', '2017-08-24 04:00:29', NULL),
(98, 1, 'deleted', 'users', 20, '2017-08-24 04:00:54', '2017-08-24 04:00:54', NULL),
(99, 1, 'deleted', 'users', 21, '2017-08-24 04:41:15', '2017-08-24 04:41:15', NULL),
(100, 1, 'deleted', 'users', 21, '2017-08-24 04:41:58', '2017-08-24 04:41:58', NULL),
(101, 1, 'deleted', 'users', 20, '2017-08-24 04:42:07', '2017-08-24 04:42:07', NULL),
(102, 1, 'created', 'users', 22, '2017-08-24 05:26:58', '2017-08-24 05:26:58', NULL),
(103, 1, 'created', 'users', 23, '2017-08-24 05:27:04', '2017-08-24 05:27:04', NULL),
(104, 1, 'deleted', 'users', 23, '2017-08-24 05:42:24', '2017-08-24 05:42:24', NULL),
(105, 1, 'updated', 'users', 1, '2017-08-25 02:03:18', '2017-08-25 02:03:18', NULL),
(106, 1, 'updated', 'users', 1, '2017-08-25 02:03:40', '2017-08-25 02:03:40', NULL),
(107, 1, 'updated', 'users', 1, '2017-08-25 02:06:39', '2017-08-25 02:06:39', NULL),
(108, 1, 'updated', 'users', 1, '2017-08-25 02:10:16', '2017-08-25 02:10:16', NULL),
(109, 1, 'updated', 'users', 1, '2017-08-25 02:15:57', '2017-08-25 02:15:57', NULL),
(110, 1, 'updated', 'users', 1, '2017-08-25 02:16:06', '2017-08-25 02:16:06', NULL),
(111, 1, 'updated', 'users', 1, '2017-08-25 03:13:01', '2017-08-25 03:13:01', NULL),
(112, 1, 'updated', 'users', 2, '2017-08-25 03:21:05', '2017-08-25 03:21:05', NULL),
(113, 1, 'updated', 'users', 2, '2017-08-25 03:21:05', '2017-08-25 03:21:05', NULL),
(114, 1, 'updated', 'users', 1, '2017-08-25 03:51:48', '2017-08-25 03:51:48', NULL),
(115, 1, 'updated', 'users', 1, '2017-08-25 23:26:40', '2017-08-25 23:26:40', NULL),
(116, 1, 'updated', 'users', 1, '2017-08-31 10:40:36', '2017-08-31 10:40:36', NULL),
(117, 1, 'updated', 'users', 1, '2017-08-31 17:48:26', '2017-08-31 17:48:26', NULL),
(118, 1, 'updated', 'users', 1, '2017-09-01 10:36:29', '2017-09-01 10:36:29', NULL),
(119, 1, 'updated', 'users', 1, '2017-09-05 08:51:45', '2017-09-05 08:51:45', NULL),
(120, 1, 'updated', 'users', 1, '2017-09-05 08:58:02', '2017-09-05 08:58:02', NULL),
(121, 1, 'updated', 'users', 1, '2017-09-07 16:15:46', '2017-09-07 16:15:46', NULL),
(122, 1, 'updated', 'users', 1, '2017-09-08 18:51:48', '2017-09-08 18:51:48', NULL),
(123, 1, 'updated', 'users', 1, '2017-09-08 19:07:51', '2017-09-08 19:07:51', NULL),
(124, 2, 'updated', 'users', 2, '2017-09-08 19:08:33', '2017-09-08 19:08:33', NULL),
(125, 1, 'updated', 'users', 1, '2017-09-09 09:21:44', '2017-09-09 09:21:44', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
