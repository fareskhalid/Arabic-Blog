-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 15, 2022 at 02:54 PM
-- Server version: 8.0.30-0ubuntu0.22.04.1
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tadwinat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` int NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`) VALUES
(1, 'fares@tadwinat.com', 123456, 'Fares Khalid');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_date`) VALUES
(3, 'بلوجر', '2022-10-10 13:27:00'),
(4, 'اندرويد', '2022-10-10 13:27:05'),
(6, 'برمجة', '2022-10-10 16:05:12'),
(7, 'بايثون', '2022-10-10 17:25:35'),
(8, 'php', '2022-10-10 18:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `post_title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `post_category` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `post_image` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `post_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_author` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_category`, `post_image`, `post_content`, `post_date`, `post_author`) VALUES
(8, 'ما هي البرمجة؟', 'برمجة', 'posts_images/586-vlcsnap-2022-09-29-15h39m05s001.png', 'البرمجة هي عملية كتابة تعليمات وتوجيه أوامر لجهاز الحاسوب أو أي جهاز آخر مثل قارئات أقراص الدي في دي أو أجهزة استقبال الصوت والصورة في نظم الاتصالات الحديثة، لتوجيه هذا الجهاز وإعلامه بكيفية التعامل مع البيانات أو كيفية تنفيذ سلسلة من الأعمال المطلوبة تسمى خوارزمية.\r\n\r\nوتتبع عملية البرمجة قواعد خاصة باللغة التي اختارها المبرمج. وكل لغة برمجة لها خصائصها التي تميزها عن الأخرى وتجعلها مناسبة بدرجات متفاوتة لكل نوع من أنواع البرامج وحسب المهمة المطلوبة من هذا البرنامج. كما أن اللغات البرمجية  أيضا لها خصائص مشتركة وحدود مشتركة بحكم أن كل هذه اللغات صممت للتعامل مع الحاسوب. وتتطور لغات البرمجة (السوفتوير Software) بتطور عتاد الحاسوب المرئي (الهاردوير Hardware). فعندما ابتكر الحاسوب في الأربعينيات والخمسينيات من القرن الماضي (بعد أجهزة الحساب الكهربائية في العشرينات) - وكان الكمبيوتر يعمل بأعداد كبيرة من الصمامات الإلكترونية - كانت لغة البرمجة معقدة هي الأخرى، حتى أنها كانت عبارة عن سلسلة من الأعداد لا يدخلها إلا الصفر (0) والواحد (1) وذلك لأن الحاسب يفهم حالتين فقط وجود التيار (1) أو عدم وجوده (0)، وكان ذلك صعبا على المبرمجين. ولكن بابتكار الترانزيستور صغر حجم الحاسوب كثيرا وزادت إمكانياته، واستطاع المختصون في نفس الوقت أن يبتكروا لغات أسهل للاستخدام، وأصبحت لغات البرمجة مفهومة إلى حد بعيد للمختصين. ولا يزال التطوير والتسهيل جاريا وتسمى هذه اللغات سهلة التعامل بالنسبة للمبرمجين باللغات عالية المستوى.\r\n\r\nبرمجة الحاسوب: هي عملية كتابة، اختبار، تصحيح للأخطاء وتطوير للشيفرة المصدرية لبرنامج حاسوبي يقوم بها الإنسان، تهدف البرمجة إلى إنشاء برامج تقوم بتطبيق وتنفيذ خوارزميات لها سلوك معين بمعنى أن لها وظيفة محددة مسبقا ومتوقعة النتائج. تتم هذه العملية باستخدام إحدى لغات البرمجة. الهدف من البرمجة هو إنشاء برنامج حيث ينفذ عمليات محددة أو يظهر سلوك مطلوب محدد. بشكل عام البرمجة عملية تستلزم معرفة في مجالات مختلفة منها معرفة بالرياضيات والمنطق والخوارزميات.', '2022-10-15 13:32:02', 'فارس خالد');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
