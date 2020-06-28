-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2020 at 02:41 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rod_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `id` int(10) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_qualification` varchar(25) NOT NULL,
  `user_bio` text NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `confirm_password` varchar(200) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `full_name`, `user_name`, `user_email`, `user_qualification`, `user_bio`, `user_image`, `password`, `confirm_password`, `added_by`, `status`, `datetime`) VALUES
(1, 'Super Admin', 'super.adminb7u', 'super.admin@gmail.com', 'Web  Developers-PHP', 'Hi, I am Sonjoy Barua John and also a Full Stack Web Developer in PHP. And My Education background is CSE. ', '667-super.adminb7u-avatar.png', '$2y$10$pBa4JN0R7Tmq9g/ubkYXwO4F9cySAWmw495j47BFRwcE6yo4bVKpG', '$2y$10$O0oM9I6OAQr5LN4IM07tSe5Sn24I//iH4Z41m2dh7mHkNmsZoZ76K', 'Super Admin', 1, '2020-Jan-19 04:31:04PM'),
(2, 'Admin-1', 'adminb7u-1', 'admin@gmail.com', 'Network Enginner', 'Hi, I am Piyal Barua and also a Full Stack Network Engineer. And My Education background is CSE.', '478-adminb7u-1-avatar04.png', '$2y$10$Et67tV7MUJoq2EIx0fg3aukaNRpJveD7UEsdUc2Q2QuFtbErkJceK', '$2y$10$nf1pwGzIZnJBha96fwh6kOUI7JF/YbLYayaX0fW4qFIfRxpfFmMfK', 'Super Admin', 1, '2020-Jan-19 03:06:59PM'),
(3, 'Sonjoy Barua', 'sonjoyb7u', 'sonjoy@gmail.com', 'Web  Developers', ' Hi, I am Sonjoy Barua and also a Full Stack Web Developers. And My Education background is CSE.      ', '949-sonjoyb7u-avatar5.png', '$2y$10$mInlPBVp9BlWGRSIFALZ..0qZgL.GrsrzHSbhNQXLRByYcXyyJjXS', '$2y$10$owk8gdt1n9ZboVNOBSKv1OoQKzyjyzODcMAJL0Y3e9PnFb5OVA/xy', 'Super Admin', 0, '2020-Jan-19 04:30:45PM'),
(4, 'John Barua', 'johnb7u', 'john@gmail.com', 'Web  Developers', ' I am a Full Stack Web Developers. And My Education background is BBA.', '454-johnb7u-avatar04.png', '$2y$10$UD8Eaa..EWDB7n4WePjeleu2C4VB..M2yTwNOScWCv3zUe0pvrcS6', '$2y$10$2V8xBZo/1s/AnCWfCv6Eueux03ljsINp.cex78ij/Js.ISzm7NfCy', 'Super Admin', 0, '2020-Jan-19 03:03:54PM'),
(7, 'Payel Barua', 'payelb7u', 'payel@gmail.com', 'Photoshop Designers', ' I am a Photoshop Web Designers. And My education background is MBA.', '317-piyalb7u-avatar3.png', '$2y$10$g.rsMutjPrvHryTyyYKEW.Lv9xDm/5xZr6z.aqptChr4FWeRSNQNW', '$2y$10$4LUUAqx8puKBCmgERgx2ReXFDebKvELVOhb3MPoHP4ySGVGit4i1C', 'Super Admin', 0, '2020-Jan-19 02:57:53PM'),
(8, 'Peow Barua', 'peowb7u', 'peow@gmail.com', 'Web Designers', ' I am a Full Stack Web Designers.', '502-peowb7u-avatar2.png', '$2y$10$0f/yUJDP7CfuPuGn787OGOXyaUiM.8HkK0eGZA9O.nJrjZZlTXHie', '$2y$10$b2sOaoAzaioHD9gjxyDyweA9sUvG3tHPi6o8Vo3qG8nxK1L9hso8a', 'Sonjoy Barua', 1, '2020-Jan-19 02:51:16PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `total_posts` int(10) NOT NULL,
  `datetime` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `title`, `total_posts`, `datetime`) VALUES
(1, 'Technology', 0, '2020-Jan-12 10:57:31AM'),
(2, 'Fashion', 0, '2020-Jan-12 10:57:41AM'),
(3, 'Tour and Travel News', 1, '2020-Jan-16 05:57:49PM'),
(4, 'Foods', 1, '2020-Jan-12 10:58:12AM'),
(6, 'Jokes', 1, '2019-Dec-30 02:11:27PM'),
(11, 'All Internation News', 0, '2020-Jan-12 10:58:38AM'),
(12, 'Fitness Zone', 0, '2020-Jan-12 10:58:47AM'),
(13, 'Sports News', 1, '2019-Dec-30 02:27:05PM'),
(15, 'All BD News', 1, '2020-Jan-09 08:49:42PM'),
(16, 'Funny News', 0, '2020-Jan-09 08:49:08PM'),
(17, 'Friendship', 1, '2020-Jan-07 10:13:49AM'),
(18, 'Weather News', 0, '2020-Jan-11 08:08:18PM'),
(21, 'Technological News', 1, '2020-Jan-16 05:45:24PM'),
(22, 'Social Science', 0, '2020-Jan-17 11:20:32AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comments` varchar(500) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `post_id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `name`, `email`, `comments`, `approved_by`, `status`, `post_id`, `datetime`) VALUES
(1, 'Tapu Barua', 'tapu@hotmail.com', 'Hi, Guys - Nice post. I like your post,,,', 'Sonjoy Barua John', 1, 3, '2020-Feb-08 07:01:26PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `full_name`, `email`, `website`, `message`, `datetime`) VALUES
(1, 'Sonjoy Barua', 'sonjoy.john@gmail.com', 'https://www.facebook.com/sonjoy.john', 'Testing Purposes,,,', '2020-Feb-09 11:21:31AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `id` int(10) NOT NULL,
  `u_id` int(11) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `post_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `post_desc` text NOT NULL,
  `post_image` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `datetime` varchar(50) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `u_id`, `cat_id`, `post_title`, `post_desc`, `post_image`, `status`, `datetime`) VALUES
(2, 1, 6, 'Rod Blog Post Of Jokes.', '১) স্বামীর পাশে শুয়েই মাঝরাতে স্ত্রী-র পরকিয়া, বাংলায় এক মজার জোকস :-\r\n\r\nমাঝরাতে বেডরুমের টেলিফোন বেজে উঠলো। স্বামী(স্ত্রীকে) - কেউ আমার কথা জিজ্ঞাসা করলে বলে দেবে আমি বাড়িতে নেই। স্ত্রী(ফোन ধরে) - আমার স্বামী বাড়িতেই আছে, বলেই ফোনটা কেটে দিল। স্বামী(রেগে গিয়ে) - আমি বললাম না, কেউ আমার কথা জিজ্ঞাসা করলে বলবে আমি বাড়িতে নেই। স্ত্রী(বিরক্তির সহিত) - চুপ করো! এটা জরুরি নয় যে সব ফোন তোমার জন্যই আসবে|\r\n\r\n\r\n২) বল্টু পাশে বসতেই বান্ধবী বলল এক রাতের জন্যও নয় :-\r\n\r\nক্লাসে বল্টুর প্রথম দিন- (এক ছাত্রীর পাশে গিয়ে)- বল্টু- আমি কি তোমার পাশে বসতে পারি? ছাত্রী- (চিৎকার করে) না তুমি এক রাতের জন্য আমার কাছে থাকতে পারো না!!\r\n-- (বল্টু শুনে খুব বিব্রত বোধ করল এবং ক্লাসের বাকিরা বল্টুর দিকে বাঁকা চোখে তাকিয়ে রইলো।)\r\n-- কিছুক্ষণ পরে মেয়েটি বল্টুর কানের কাছে এসে বললো, আমি সাইকোলজির ছাত্রী, তাই তোমার মনের খবর বুঝি!!\r\n-- এই কথা শুনে বল্টুর চিৎকার- বলে উঠল- ;কী মাত্র এক রাতের জন্য ২০,০০০ টাকা!! মেয়েটির দিকে এবার সারা ক্লাস আড়চোখে তাকিয়ে, মেয়েটি ভীষণ লজ্জা পেলো। একটু পরে বল্টু মেয়েটির কানের কাছে গিয়ে বললো, আমি আইনের ছাত্র তাই বুঝি কী-ভাবে মানুষকে দোষী করতে হয়!!', '206-1-blog5.png', 1, '2020-Feb-07 09:59:33AM'),
(3, 1, 17, 'Rod Blog Post Of Best School Friends.', '১৯ বছর পর ফেসবুকে অনেক কষ্টে খুঁজে পেলাম হারিয়ে যাওয়া স্কুল বন্ধুকে ।  আর দেখা হওয়ার পর মনের হল সত্যিকারের এক অসাধারণ অনুভূতি যা কিছু সময় এর জন্য আমাকে নিয়ে গিয়েছিল ১৯ বছর আগের সেই স্কুল জীবনে....... ধন্যবাদ বন্ধু  Sonjoy Barua.', '691-1-School-friend.png', 1, '2020-Feb-07 10:09:48AM'),
(4, 2, 4, 'Rod Blog Post Of Deshi Good Foods.', 'Food Quotes :- \r\n\r\nThere are people in the world so hungry, that God cannot appear to them except in the form of bread.&rdquo;\r\n― Mahatma Gandhi\r\nAll you need is love. But a little chocolate now and then doesn&amp; hurt.\r\n― Charles M. Schulz\r\nIf more of us valued food and cheer and song above hoarded gold, it would be a merrier world.\r\n― J.R.R. Tolkien\r\nI love you like a fat kid loves cake!\r\n― Scott Adams\r\n\r\nOne cannot think well, love well, sleep well, if one has not dined well.\r\n― Virginia Woolf, A Room of One&amp;Own\r\nPull up a chair. Take a taste. Come join us. Life is so endlessly delicious.\r\n― Ruth Reichl\r\n\r\nPopcorn for breakfast! Why not? It&amp; a grain. It&amp; like, like, grits, but with high self-esteem.\r\n― James Patterson, The Angel Experiment.\r\nCakes are healthy too, you just eat a small slice.&rdquo;\r\n― Mary Berry', '658-4-blog7.png', 1, '2020-Feb-08 10:26:38PM'),
(5, 2, 15, 'Rod Blog Post Of Biman Bangladesh Airlines.', 'বিমান বাংলাদেশ এয়ারলাইন্সের ঢাকা-ম্যানচেষ্টার ফ্লাইট :\r\n\r\nবিমান বাংলাদেশ এয়ারলাইন্সের ঢাকা-ম্যানচেষ্টার ফ্লাইট বিজি ০০৭ আগামী ৫ জানুয়ারী ২০২০ (রবিবার) ম্যানচেষ্টার-এর উদ্দেশ্যে ঢাকা ছেড়ে যাবে। বেসামরিক বিমান পরিবহন ও পর্যটন মন্ত্রণালয়ের মাননীয় প্রতিমন্ত্রী জনাব মোঃ মাহবুব আলী এমপি প্রধান অতিথি হিসেবে হযরত শাহজালাল আন্তর্জাতিক বিমান বন্দরে উপস্থিত থেকে ম্যানচেষ্টার ফ্লাইট উদ্বোধন করবেন। তিনি মোনাজাত ও ফিতা কেটে ফ্লাইট উদ্বোধন করবেন এবং সম্মাণিত যাত্রীদের সাথে কুশল বিনিময় করে তাদের বিদায় জানাবেন। এসময় মন্ত্রণালয়ের সিনিয়র সচিব, চেয়ারম্যান বিমান পরিচালনা পর্যদ, বিমানের ব্যবস্থাপনা পরিচালক ও সিইও, বিট্রিশ হাইকমিশনার সহ মন্ত্রণালয়, বিমান, সিভিল এভিয়েশন ও বিমানের পদস্থ কর্মকর্তারা উপস্থিত থাকবেন।\r\nবিমান বহরে সদ্য সংযোজিত বোয়িং ৭৮৭-৯ ড্রিমলাইনার দিয়ে উদ্বোধন হচ্ছে ঢাকা-ম্যানচেস্টার রুটের যাত্রা। সপ্তাহে ৩ দিন-রবিবার, মঙ্গলবার ও বৃহস্পতিবার ফ্লাইট পরিচালিত হবে। যুক্তরাজ্যের ম্যানচেষ্টারে প্রায় ৯০ হাজার বাংলাদেশী বসবাস করেন। তাদের অনেক দিনের আকাংখা ম্যানচেষ্টার রুটে বিমানের ফ্লাইট। এটি বিমানের ১৭তম রুট। উল্লেখ্য, পূর্বে বিমানের এই রুটে বিমানের ফ্লাইট পরিচালিত হতো সেপ্টেম্বর ২০১২-এ উড়োজাহাজ স্বল্পতার কারনে অস্থায়ীভাবে রুটটি বন্ধ রাখা হয়।\r\n\r\nনতুন বোয়িং ৭৮৭-৯ এ সর্বমোট আসন সংখ্যা ২৯৮টি। এ উড়োজাহাজে ৩০ টি বিজনেস ক্লাস,২১ টি প্রিমিয়াম ইকোনমি ক্লাস এবং২৪৭টি ইকোনমি ক্লাস রয়েছে। বর্তমান বিমান বহর পূর্বের যে কোন সময়ের তুলনায় অত্যাধুনিক ও তারুণ্যদীপ্ত। বহরে রয়েছে ৬টি ড্রিমলাইনারসহ মোট ১৮টি উড়োজাহাজ। প্রতিটি উড়োজাহাজে রয়েছে উন্নত যাত্রীসেবা সম্বলিত সকল সুযোগ-সুবিধা। আশা করা যাচ্ছে, যুক্তরাজ্যের বিপুল সংখ্যক প্রবাসী বাংলাদেশী এবং ইউরোপগামী বিভিন্ন দেশের ভ্রমণপিপাসু, শিক্ষার্থী ও ব্যবসায়ীগণ বিমান বহরের আধুনিক এ উড়োজাহাজগুলোতে ভ্রমনে আকৃষ্ট হবেন। প্রবাসী যুক্তরাজ্যের বিপুল সংখ্যক অভিজাত যাত্রীগণও আকৃষ্ট হবেন। আসন্ন প্রতিক্ষীত নিউইর্য়ক ও টরেন্টো রুটের হাব হিসেবে ম্যানচেষ্টার ব্যবহৃত হবে।\r\n\r\nবিমানের মোবাইল এ্যাপস ব্যবহার করে সম্মাণিত যাত্রীগণ নিজের মোবাইল থেকেই কিনতে পারবেন বিমানের সকল গন্তব্যের টিকেট। মূল্য পরিশোধ করতে পারবেন বিকাশ/রকেট/যেকোন কার্ডের মাধ্যমে। গুগল প্লে স্টোর অথবা অ্যাপল স্টোর থেকে যে কোন স্মার্টফোনে এ্যাপসটি ডাউনলোড করলে পৃথিবীর যেকোন প্রান্ত হতে বিমানের ফ্লাইট সংক্রান্ত সকল তথ্য পাওয়া যাবে। এই এ্যাপসের মাধ্যমে যাত্রীগণ ফ্লাইট সম্পর্কিত সকল তথ্য, ফ্লাইট ষ্ট্যাটাস,ফ্লাইট শিডিউল, সেলস সেন্টার সমূহের ঠিকানা, অনলাইন টিকেট ও রিফান্ড হেল্পডেক্স এবং টিকেট বুকিং সংক্রান্ত সমস্ত তথ্য জানতে পারবেন।', '175-2-blog10.png', 1, '2020-Feb-07 10:19:16AM'),
(6, 3, 21, 'Rod Blog Post Of PHP Programing Language.', 'Dutch PHP Conference 2020 : \r\n\r\n20 Dec 2019\r\nSubmit your talks no later than January 28th, 2020 We are looking for high-quality, technical sessions from speakers who can cover advanced topics and keep our demanding audience inspired. Submissions are accepted up to and including January 28th, 2020. This is your chance to share. Submit your talks now!\r\n\r\nWe&rsquo;re looking for high-quality, technical and non-technical sessions from speakers who can cover advanced topics and keep our demanding audience inspired.\r\n\r\nWe&rsquo;ve had great speakers presenting talks about the PHP ecosystem, frameworks, DevOps, architecture, JavaScript, scaling, testing, performance, security and more. And we would like to advance on these very topics for this year&rsquo;s conference as well.\r\n\r\nBut we also would like to invite speakers to talk about non-technical subjects that are increasingly instrumental in maintaining success as a developer or development team. These are topics like communication, understanding, relationships, (self) management and even the business and economics part of development. In other words: the soft skills that complement the deep technical skills. And about the surrounding environment necessary to be successful as a technical developer.\r\n\r\nThis invitation is intentionally a bit broad in the hope to inspire everyone to share their ideas and insights and hard-fought experience in the broader development arena that we all thrive in.\r\n\r\nThe call for papers is open up to and including January 28th. You can send in as many proposals as you like, so start submitting your talks!\r\n\r\nIbuildings and the DPC team are working on improving diversity in line-up of our conference. We strongly encourage anyone who faces under-representation, systemic bias, or discrimination in the technology industry of their country to submit proposals. We believe diversity enriches our community and supports the principal purpose of our conference: sharing ideas, experience and insights with each other in an open, inclusive environment. We are committed to maximize opportunities for underrepresented groups to responsibly do our part in helping to resolve the imbalance that exists today in our communities.', '703-3-blog11.png', 1, '2020-Feb-07 10:38:01AM'),
(7, 1, 13, 'Rod Blog Post Of Bangladesh Cricketer Bowler Mustafizur Rahman.', 'News Of Bangladesh Cricket :-\r\n\r\nBangladesh left-arm pace bowler Mustafizur Rahman is looking for consistency in bowling and believes he can achieve it by sorting the problem with his run-up. The 24-year-old has had a dip in his bowling fortunes since the rapid start to his career in 2015 which is only down partly to his recent tryst with injuries.\r\n\r\nMustafizur failed to impress in the three T20Is against India and missed the two-match Test series that followed. Even in the initial phase of Bangabandhu Bangladesh Premier League he looked far from his best and only began to shine from the Chattogram phase. Mustafizur eventually give an indication of his abilities with a superlative performance for Rangpur Rangers against Sylhet Royals, where he claimed 3-10 and more importantly bowled in the manner that brought him the fame and the nickname Fizz.\r\n\r\nIt is not like everything is ok but I am trying. But doing well in only two matches won&#039;t help much as I need to perform on consistent basis, Mustafizur said. &quot;For the last couple of days I was having problem with my run-up. Today the best part was that my run-up was smooth and so I could bowl the way I wanted to. Earlier whenever I tried to bowl something different or trying to bowl my yorker my foot was landing outside but now I am trying to sort it out.\r\nThe left-armer revealed he has always preferred bowling in the day as opposed to bowling under lights when his cutters are negated. It is better for me if the game is on day time because my biggest weapon is my cutter and it is effective in dry wicket. At night it is hard to bowl the cutter because of the wicket because the ball skids more as it is wet due to dew, he added.\r\n\r\nMustafizur&#039;s recent form comes as relief to the national team management, who were looking at the BBPL as a metric to assess the fast bowler&#039;s progress. We don&#039;t have any doubt on his skill but he needed to execute it in the middle and the way he is doing it now it is certainly a very good news for Bangladesh cricket, national selector Habibul Bashar said.', '657-13-image-1.png', 0, '2020-Feb-07 10:28:43PM'),
(8, 2, 3, 'Rod Blog Post Of  Tour To Lalbhag Khella, Dhaka.', 'Dhaka Capital of Bangladesh :-\r\n\r\nDhaka is the capital city of Bangladesh, in southern Asia. Set beside the Buriganga River, it&rsquo;s at the center of national government, trade and culture. The 17th-century old city was the Mughal capital of Bengal, and many palaces and mosques remain. American architect Louis Khan&rsquo;s National Parliament House complex typifies the huge, fast-growing modern metropolis.\r\n\r\nIn Dhaka&rsquo;s old city, grand, 17th-century Lalbagh Fort contains a museum of paintings, weapons and decorative arts. The Dhakeshwari Temple is the focus of the city&rsquo;s Hindu community. The National Museum traces Bangladesh&rsquo;s natural, religious and political history. Graphic displays at the Liberation War Museum reveal the horrors of the 1971 War of Independence. The elaborate 19th-century Ahsan Manzil, or Pink Palace, stands beside the river. Wooden boats offer trips on the water from the busy Sadarghat boat terminal, the heart of traditional riverside life. Colorful painted rickshaws are the city&rsquo;s main mode of transport', '702-3-Lalbag-kella.png', 1, '2020-Feb-09 10:30:51AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_qualification` varchar(50) NOT NULL,
  `user_bio` text,
  `user_password` varchar(255) NOT NULL,
  `user_confirm_password` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `user_address` varchar(150) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_email_confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(20) DEFAULT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `full_name`, `user_name`, `user_email`, `user_qualification`, `user_bio`, `user_password`, `user_confirm_password`, `user_mobile`, `user_image`, `user_address`, `role`, `status`, `is_email_confirmed`, `token`, `datetime`) VALUES
(1, 'Sonjoy Barua', 'sonjoyb7u', 'sonjoy@gmail.com', 'BSc In CSE', 'Hi, I am Sonjoy Barua John and also a Full Stack Web Developer in PHP, MYSQL, PDO Extension.  And My Education background is BSC In CSE. ', '$2y$10$hsih7QurXp8MAEskbcR5GuAu4zCYgCmGjZS6KUGod7JieRGeW969W', '$2y$10$tiMYlrczrKVROEPqxFBmCelpTNS9raq2im8XJvtm3N0KKyGVGOrJK', '+8801915464958', '1775-sonjoyb7u-27446.jpg', '93/A, Chattashawri Road, Chittagong, BD.', 1, 1, 0, NULL, '2020-Feb-08 09:03:14PM'),
(2, 'Payel Barua', 'payelb7u', 'payel@gmail.com', 'Class Five', 'Hi, I am Payel Barua and read in Class Five. And My Education background is JSC.  ', '$2y$10$1AqfWj7LS1O1oBfaLO24DOwRwBpVKuSlt/JsRqaZRkQV3iAfAKbGS', '$2y$10$/AP47L8Be742z4wJmKAIVu.Yejmvo/HbwHtyk218S.yNqtBwabzxu', '+8801811591944', '237-payelb7u-payel.jpg', '93/A, Chattashawri Road, Chittagong, BD.', 3, 1, 0, NULL, '2020-Feb-08 09:19:21PM'),
(3, 'John Barua', 'johnb7u', 'john@gmail.com', 'BSc In CSE', 'Hi, I am John Barua John and also a Full Stack Web Designer.  And My Educational background is BSc In CSE. ', '$2y$10$FAom6b.rQOGVx8OY19SVmefF/7FvNEmrwQTRJSgIG7p6ejjhJwylC', '$2y$10$TBAbyYuMUVzcaXPqdpDe2.GAXv9ifdB.xxwD4KimmwsLa0IcCM16q', '+8801673787900', '1458-Sonjoy Barua.jpg-Sonjoy Barua.jpg', '93-A, Saff-Panorama, CTG, BD.', 2, 1, 0, NULL, '2020-Feb-08 10:21:04PM'),
(4, 'Peow Barua', 'peowb7u', 'sonjoy.john@gmail.com', 'Class One', NULL, '$2y$10$pvZtyXyGAFahCPe0cvoggO1K5Tff1plm9GIpgw.76/4iLnz4IGrrO', '$2y$10$xPnL1D77IIrOZOvSh7yVQuyMkVoEKvEEgvA0TeM9lH1Nsc3EIYu/.', '+8801673787900', '1509-peowb7u-avatar3.png', '93/A, Chattashawri Road, Chittagong, BD.', 3, 0, 1, '', '2020-Feb-09 11:33:42AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`u_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `tbl_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
