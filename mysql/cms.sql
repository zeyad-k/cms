-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 08:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(63, 'Php'),
(70, 'Paython'),
(76, 'JavaScript'),
(77, 'Flutter'),
(78, 'Walaa'),
(79, 'Soft Skills');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(11, 2, 'hooodaa', 'vvvvvv@vv.vpm', 'bbbbbb', 'approved', '2023-12-11'),
(15, 7, 'vvvvvvvvvvvv', 'vvvvvvvvvv@gvbb.bbb', 'vvvvvvvvvvvv', 'approved', '2023-12-11'),
(16, 2, 'zeyad comm', 'cv@cv.com', 'this is my comment', 'approved', '2023-12-11'),
(18, 2, 'zeyad comm', 'cv@cv.com', 'this is my comment', 'approved', '2023-12-11'),
(19, 2, 'zeyad comm', 'cv@cv.com', 'this is my comment', 'approved', '2023-12-11'),
(21, 7, 'hhh', 'klkl@hbj.cvb', 'lllllllllllllllllllllllllllllllllllllllllllllllllll[||||||||||||||||||||||||||||', 'approved', '2023-12-13'),
(26, 2, 'v', 'vvvvvv@vv.vpm', 'v', 'approved', '2023-12-19'),
(27, 2, 'v', 'vvvvvv@vv.vpm', 'v', 'approved', '2023-12-19'),
(28, 13, 'zeyad', 'zez@zzzz.com', 'hi from wgypr\r\n', 'approved', '2023-12-23'),
(31, 12, 'zeyad comm test', 'zez@zzzz.com', 'just a test', 'approved', '2023-12-24'),
(32, 12, 'zeyad comm test', 'zez@zzzz.com', 'just a test', 'approved', '2023-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`id`, `session`, `time`) VALUES
(1, 'q0v653hme3ediuijccffvg3g9m', 1703263034),
(2, 'us1983tdb2maaanbkcn76riea1', 1703263052),
(3, 'eddnbpkq5pjiu13frqr7smpa1g', 1703337697),
(4, '0usvffrp2nb74t58o8uo0srfj5', 1703357880),
(5, 'm3k20e88nidlnfd3o748hd3lm9', 1703357599),
(6, '19hm2jsq62ecgf4d68ha7rj1mk', 1703378615),
(7, 'm1cb9iqpdg732avrsscpb0ide4', 1703595224),
(8, '8dk7no2l20afk5f7ckklt2ge33', 1703605353);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(2, 63, 'افضل كورسات تعلم البرمجة على الانترنت', 'أحمد محسن', '2023-12-18', '3.jpg', '', 'برمجه تعلم ', 6, 'published', 9),
(7, 63, 'اهلا ولاء', 'walaa', '2023-12-18', 'Screenshot 2023-08-25 171159.png', '', 'walaa soha ولاء سها', 4, 'published', 1),
(12, 76, 'work time', 'Ahmad', '2023-12-24', 'Screenshot 2023-09-20 061923.png', '', 'ju , yyy,', 4, 'published', 12),
(13, 79, 'another post', 'zeyad author', '2023-12-18', 'Screenshot 2023-07-10 001459.png', '<p><b>السلام عليكم و رحمه&nbsp; الله و بركاته</b></p>', 'steel', 0, 'published', 2),
(37, 79, 'another post', 'zeyad author', '2023-12-26', 'Screenshot 2023-07-10 001459.png', '<p><b>السلام عليكم و رحمه&nbsp; الله و بركاته</b></p>', 'steel', 0, 'published', 0),
(38, 76, 'work time', 'Ahmad', '2023-12-26', 'Screenshot 2023-09-20 061923.png', '', 'ju , yyy,', 0, 'published', 0),
(39, 63, 'اهلا ولاء', 'walaa', '2023-12-26', 'Screenshot 2023-08-25 171159.png', '', 'walaa soha ولاء سها', 0, 'published', 0),
(40, 63, 'افضل كورسات تعلم البرمجة على الانترنت', 'أحمد محسن', '2023-12-26', '3.jpg', '', 'برمجه تعلم ', 0, 'published', 0),
(41, 79, 'another post', 'zeyad author', '2023-12-26', 'Screenshot 2023-07-10 001459.png', '<p><b>السلام عليكم و رحمه&nbsp; الله و بركاته</b></p>', 'steel', 0, 'published', 0),
(42, 76, 'work time', 'Ahmad', '2023-12-26', 'Screenshot 2023-09-20 061923.png', '', 'ju , yyy,', 0, 'published', 0),
(43, 63, 'اهلا ولاء', 'walaa', '2023-12-26', 'Screenshot 2023-08-25 171159.png', '', 'walaa soha ولاء سها', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecreazystring22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(35, 'ahmad', '$2y$10$ec0rdkVVfYiw4iO3itTVSeD1rkIbbHfOAXFFITAlKG0ZlNh5cha3q', 'Ahmad', 'Ali', 'lmmvmld@mnm.com', '1.png', 'subscriber', '$2y$10$iusesomecreazystring22'),
(38, 'zeyad', '$2y$10$MW3IkhBzh4Ox7GvdV0kF/eT2vpA8audbenvrF54idnSL3/XcA2Niq', 'zeyad', 'dd', 'zeyad@demo.com', 'frontend.png', 'admin', '$2y$10$iusesomecreazystring22'),
(40, 'mona', '$2y$10$1UyssX2cF3ddw4gg5wubP.Sij.Brl4RMWD6L246VPogoHflbj1vGK', 'mona', 'cc', 'lmmvmld@mnm.com', 'IMG_5924.jpg', 'admin', '$2y$10$iusesomecreazystring22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
