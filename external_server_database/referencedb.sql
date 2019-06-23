

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_msg` text COLLATE utf8mb4_unicode_ci,
  `Question_Bank_DB` text COLLATE utf8mb4_unicode_ci,
  `image` longblob,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_fee` int(4) DEFAULT NULL,
  `total_number_of_student` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_number_of_exam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment` tinyint(1) DEFAULT NULL,
  `amount` smallint(6) NOT NULL DEFAULT '0',
  `payment_date` date DEFAULT NULL,
  `validity` date DEFAULT NULL,
  `payment_request_id` text COLLATE utf8mb4_unicode_ci,
  `student_limit` int(11) NOT NULL DEFAULT '15',
  `exam_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `login_msg`, `Question_Bank_DB`, `image`, `balance`, `student_fee`, `total_number_of_student`, `total_number_of_exam`, `institution_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `payment`, `amount`, `payment_date`, `validity`, `payment_request_id`, `student_limit`, `exam_limit`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `post` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `admin_id`, `admin_email`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `examcode` int(10) UNSIGNED NOT NULL,
  `examtitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` text COLLATE utf8mb4_unicode_ci,
  `tname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `random` tinyint(1) NOT NULL DEFAULT '1',
  `examtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`examcode`, `examtitle`, `publish`, `tname`, `category`, `random`, `examtime`, `admin_id`, `admin_email`, `created_at`, `updated_at`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

CREATE TABLE `exam_question` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_A` text COLLATE utf8mb4_unicode_ci,
  `option_B` text COLLATE utf8mb4_unicode_ci,
  `option_C` text COLLATE utf8mb4_unicode_ci,
  `option_D` text COLLATE utf8mb4_unicode_ci,
  `image_A` text COLLATE utf8mb4_unicode_ci,
  `image_B` text COLLATE utf8mb4_unicode_ci,
  `image_C` text COLLATE utf8mb4_unicode_ci,
  `image_D` text COLLATE utf8mb4_unicode_ci,
  `marks` double(8,2) NOT NULL,
  `negative_marks` double(8,2) NOT NULL,
  `correct_option` text COLLATE utf8mb4_unicode_ci,
  `correct_answer` text COLLATE utf8mb4_unicode_ci,
  `level` text COLLATE utf8mb4_unicode_ci,
  `solution` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_question`
--

INSERT INTO `exam_question` (`id`, `owner_email`, `owner_id`, `examcode`, `subject_code`, `subject`, `image`, `category`, `question`, `option_A`, `option_B`, `option_C`, `option_D`, `image_A`, `image_B`, `image_C`, `image_D`, `marks`, `negative_marks`, `correct_option`, `correct_answer`, `level`, `solution`, `remember_token`, `created_at`, `updated_at`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `exam_subject`
--

CREATE TABLE `exam_subject` (
  `subject_id` int(10) UNSIGNED NOT NULL,
  `examcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_subject`
--

INSERT INTO `exam_subject` (`subject_id`, `examcode`, `subject`, `admin_id`, `admin_email`, `created_at`, `updated_at`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE `fee` (
  `id` int(10) UNSIGNED NOT NULL,
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_01_20_105337_create_admins_table', 2),
(5, '2018_01_21_051956_create_exam_question_table', 3),
(7, '2014_10_12_000000_create_users_table', 4),
(8, '2018_01_26_030323_create_fee_table', 5),
(9, '2018_01_30_162452_create_exam_table', 5),
(10, '2018_02_02_013517_create_examsubject_tabel', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('isc2013008@gmail.com', '$2y$10$GkpBKY4TUAPv0W7wdIm66ecvA40fvPQ4gip2t7bWIbvxYIAcXk5f6', '2018-01-19 17:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `ref_result`
--

CREATE TABLE `ref_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `examcode` int(10) UNSIGNED NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_result`
--

INSERT INTO `ref_result` (`id`, `student_id`, `examcode`, `created_at`, `updated_at`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `ques_id` int(10) UNSIGNED DEFAULT NULL,
  `selected_option` text,
  `givenmarks` double DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `student_id`, `ques_id`, `selected_option`, `givenmarks`, `created_at`, `updated_at`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `post` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `post`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` bigint(10) DEFAULT NULL,
  `category` text COLLATE utf8mb4_unicode_ci,
  `admin_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_request_id` text COLLATE utf8mb4_unicode_ci,
  `validity` date DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `name`, `contact`, `category`, `admin_id`, `admin_email`, `fee`, `payment_request_id`, `validity`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`examcode`);

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_subject`
--
ALTER TABLE `exam_subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `fee`
--
ALTER TABLE `fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `ref_result`
--
ALTER TABLE `ref_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_student_id_unique` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `examcode` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT for table `exam_subject`
--
ALTER TABLE `exam_subject`
  MODIFY `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `fee`
--
ALTER TABLE `fee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ref_result`
--
ALTER TABLE `ref_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1126;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
