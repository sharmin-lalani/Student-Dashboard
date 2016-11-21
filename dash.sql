-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2013 at 07:50 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dash`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation`
--

CREATE TABLE IF NOT EXISTS `activation` (
  `user_id` int(10) NOT NULL,
  `random` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activation`
--


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `assign_id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NOT NULL,
  `teacher_id` int(10) DEFAULT NULL,
  `eval_criteria` varchar(100) DEFAULT NULL,
  `topic` varchar(20) NOT NULL,
  `total_marks` tinyint(3) NOT NULL,
  `deadline` date NOT NULL,
  `file_path` varchar(250) NOT NULL,
  `file_size` int(8) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`assign_id`),
  KEY `course_id` (`course_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assign_id`, `course_id`, `teacher_id`, `eval_criteria`, `topic`, `total_marks`, `deadline`, `file_path`, `file_size`, `is_published`) VALUES
(1, 1, 101081052, 'Attempt any two questions', 'Agents', 50, '2013-02-20', 'assignments/Nidhi_Shah_Resume.pdf.pdf', 107992, 1),
(2, 3, 101081052, 'Study should be complete.', 'Feasibility Test', 10, '2013-03-01', 'assignments/CShellII.pdf.pdf', 91392, 0),
(3, 3, 101081052, 'Complete and Unambiguous', 'SRS ', 25, '2013-04-11', 'assignments/SQL 8-8-2012.docx.docx', 12373, 0),
(4, 3, 101081052, 'Should be in specified format', 'Software Requirement', 50, '2013-03-02', 'assignments/24sept.ppt', 296960, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `post_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post` text NOT NULL,
  `rating` int(5) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`post_id`, `user_id`, `title`, `post`, `rating`, `date_time`) VALUES
(1, 101081018, 'Android versus iphone', 'iPhones<br />\r\n<br />\r\nThe iPhone wasn&#039;t the first smartphone, but its arrival in 2007 changed things beyond recognition. Designer gadget and utilitarian tool, the iPhone wrapped existing features and functions into one desirable package. It&#039;s taken the rest of the world five years to catch up, but catch up it has.<br />\r\n<br />\r\n<br />\r\nThe iPhone has very deep integration with Twitter and Facebook, making it easy to post status updates to either from directly within the operating system without having to dig too deep into the customization of the app.<br />\r\n<br />\r\n<br />\r\nAndroid<br />\r\n<br />\r\nThe first thing you will notice when shopping for an Android smartphone is the massive hardware selection.In addition, Android phones are highly customizable. For example, one of the top apps on the Google Play app store is an app making it easier to type by predicting your next word after synchronizing with your Google and Facebook accounts among others.<br />\r\n<br />\r\nYou&#039;ll also find unique apps you won&#039;t find on the Apple App Store. Google&#039;s app store has also caught up to Apple&#039;s in size. In October, Google Play said it also had more than 700,000 apps.', 0, '2013-02-25 10:51:50'),
(2, 101081018, 'Cellphones Are Great for Sharing Photos - and Bacteria', 'We love our smart phones and tablets - a lot. But the next time you take your phone to lunch, hand it to a coworker to share photos, or bring it to the gym, consider this: Bacteria from a phone can cause flu, pinkeye or diarrhea. Yuck. And people are just as likely to get sick from their phones as from handles of the bathroom. That&#039;s according to a physician interviewed by the Wall Street Journal about the hazards of taking your cell phone everywhere - and then passing it to friends to share an image or message. You don&#039;t have to be a germophobe to dread that bit of news. A lab tested eight randomly selected phones from a Chicago office and all phones showed abnormally high numbers of coliforms, a bacteria that indicates fecal contamination. Of the eight phones tested, there were between about 2,700 and 4,200 units of coliform bacteria. In drinking water, the limit is less than 1 unit per 100 ml of water. The tricky part?<br />\r\n<br />\r\nMost household cleaners and disinfectants can harm your phone&#039;s screen or case. The WSJ has the full report and some suggestions for avoiding the worst of it. Worth a read as we enter the flu season.', 0, '2013-02-28 07:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE IF NOT EXISTS `blog_comment` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`comment_id`, `user_id`, `post_id`, `content`, `date_time`) VALUES
(1, 101081018, 1, 'This was my first post.<br />\r\nSo any comment is welcome :D', '2013-02-26 11:26:52'),
(2, 101081016, 1, 'It was good.<br />\r\nBut you could have elaborated more on the features.', '2013-02-26 11:28:48'),
(3, 101081051, 1, 'very informative!', '2013-02-26 11:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tag`
--

CREATE TABLE IF NOT EXISTS `blog_tag` (
  `post_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_tag`
--

INSERT INTO `blog_tag` (`post_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 3),
(2, 4),
(2, 5),
(1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `cat_name`) VALUES
(2, 'Networks'),
(3, 'Databases'),
(5, 'Technology'),
(8, 'Electronics'),
(9, 'Other'),
(10, 'Web Design');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(10) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) DEFAULT NULL,
  `course_name` varchar(50) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `file_path` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `teacher_id`, `course_name`, `branch`, `year`, `file_path`) VALUES
(1, 101081052, 'Artificial Intelligence', 'I.T.', 'T.Y.', 'report.pdf'),
(3, 101081052, 'Software Project Management', 'I.T.', 'F.Y.', 'Native XML Databases.pdf'),
(8, 101081052, 'Database System', 'I.T.', 'B.Tech', 'AndroidWorkshopSchedule Final.pdf'),
(9, 101081052, 'Information Security', 'Computers', 'S.Y.', 'Bill Bryson - A Short History Of Nearly Everything.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `doc_id` int(10) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(50) NOT NULL,
  `doc_desc` varchar(100) NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `file_path` varchar(250) NOT NULL,
  `file_size` int(8) NOT NULL,
  `uploaded_by` int(10) NOT NULL,
  `data_created` datetime NOT NULL,
  `revised_by` int(10) DEFAULT NULL,
  `revision_date` datetime DEFAULT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `uploaded_by` (`uploaded_by`),
  KEY `revised_by` (`revised_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`doc_id`, `doc_name`, `doc_desc`, `is_private`, `file_path`, `file_size`, `uploaded_by`, `data_created`, `revised_by`, `revision_date`) VALUES
(1, 'Credit Suisse competition rules', '', 0, 'files/666ce2c14dfecb447a6013604b56a77a.pdf', 288554, 101081018, '2013-03-01 03:34:49', NULL, NULL),
(2, 'UML', 'UML notes', 1, 'files/ac5cfd3c0ef1cbd2efb3047df0370c83.doc', 31744, 101081018, '2013-03-01 03:36:06', NULL, NULL),
(3, 'prototype', '', 1, 'files/4a011afba03ac620421209ff5361877d.docx', 3423158, 101081018, '2013-03-01 03:55:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `event_desc` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `user_id`, `event_name`, `date_created`, `event_desc`, `start_date`, `end_date`) VALUES
(1, 101081018, 'Android workshop', '2013-02-28', 'Everyone <em>must</em> get a laptop', '2013-03-01', '2013-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `event_invitee`
--

CREATE TABLE IF NOT EXISTS `event_invitee` (
  `user_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`,`event_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_invitee`
--

INSERT INTO `event_invitee` (`user_id`, `event_id`) VALUES
(101081052, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `thread_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `content` varchar(700) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`thread_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`thread_id`, `category_id`, `user_id`, `topic`, `content`, `date_time`) VALUES
(9, 3, 101081016, 'What database would be best to use with XML?', 'Hello, I am working on a project that has a blogging feature.<br />\r\n<br />\r\nLooks like blogs can be better implemented by XML and have thought to use MySql as the database, Is it a good idea? Does it have good enough support?', '2013-02-22 09:14:00'),
(12, 9, 101081049, 'Textbook for C++', 'Which textbook is good for learning C++ programming?', '2013-02-24 12:19:00'),
(13, 8, 101081018, 'Which cell phone is better?', 'I am confused what cell phone to buy. Xperia miro or tipo??<br />\r\n<br />\r\nAny suggestions?', '2013-02-26 10:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `forum_comment`
--

CREATE TABLE IF NOT EXISTS `forum_comment` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `thread_id` (`thread_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `forum_comment`
--

INSERT INTO `forum_comment` (`comment_id`, `thread_id`, `content`, `date_time`, `user_id`) VALUES
(7, 9, 'I have searched a lot on google, but m not yet sure what to do. please help.', '2013-02-22 09:15:12', 101081016),
(13, 9, 'you should ask prof Nikam. <br />\r\nHe knows a lot about databases.', '2013-02-24 12:11:24', 101081051),
(14, 12, 'You should try <strong>Let us C</strong> by <span style="text-decoration:underline;">Yashwant kanetkar</span>.', '2013-02-24 12:24:45', 101081052),
(15, 12, '<strong>Balguruswamy</strong>', '2013-02-24 11:46:41', 101081018),
(17, 12, 'you should join makarand sir&#039;s classes.', '2013-02-26 08:19:38', 101081016),
(18, 12, 'u can also refer Object-Oriented Programming in C++ by <em>robert lafore</em>', '2013-02-26 10:21:22', 101081016),
(19, 9, 'thank you :D<br />\r\nI&#039;ll do that.', '2013-02-26 10:21:54', 101081016),
(20, 9, 'try db2. It has native support for xml.', '2013-02-26 10:22:45', 101081018),
(21, 13, 'Get xperia Go. Its very sturdy.', '2013-02-26 10:25:13', 101081016),
(22, 12, 'Thank you everyone for your suggestions', '2013-02-26 10:26:52', 101081049),
(23, 13, 'I have Tipo. Its a really good phone and the price is reasonable.', '2013-02-26 10:27:30', 101081049),
(24, 9, 'Yes. You should go with db2.<br />\r\n<br />\r\nYou can also try mysql, but it has limited support for xml.', '2013-02-26 10:28:21', 101081049),
(25, 12, 'You will get all these books on 4shared.', '2013-02-26 10:30:16', 101081052),
(26, 13, 'Why not get Samsung galaxy 2?<br />\r\n', '2013-02-26 10:32:40', 101081051),
(27, 9, 'You are right. Mysql is probably a bad choice.', '2013-02-26 10:47:58', 101081016),
(28, 9, 'Prof <strong>jinal</strong> can tell you more about this', '2013-02-28 09:01:00', 101081018);

-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_appointments`
--

CREATE TABLE IF NOT EXISTS `mail_acal_appointments` (
  `id_appointment` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `access_type` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_appointment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_appointments`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_awm_fnbl_runs`
--

CREATE TABLE IF NOT EXISTS `mail_acal_awm_fnbl_runs` (
  `id_run` int(11) NOT NULL AUTO_INCREMENT,
  `run_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_run`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_awm_fnbl_runs`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_calendars`
--

CREATE TABLE IF NOT EXISTS `mail_acal_calendars` (
  `calendar_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_str_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `calendar_name` varchar(100) NOT NULL DEFAULT '',
  `calendar_description` text,
  `calendar_color` int(11) NOT NULL DEFAULT '0',
  `calendar_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_calendars`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_cron_runs`
--

CREATE TABLE IF NOT EXISTS `mail_acal_cron_runs` (
  `id_run` bigint(20) NOT NULL AUTO_INCREMENT,
  `run_date` datetime DEFAULT NULL,
  `latest_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_run`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_cron_runs`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_eventrepeats`
--

CREATE TABLE IF NOT EXISTS `mail_acal_eventrepeats` (
  `id_repeat` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) DEFAULT NULL,
  `repeat_period` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_order` tinyint(1) NOT NULL DEFAULT '1',
  `repeat_num` int(11) NOT NULL DEFAULT '0',
  `repeat_until` datetime DEFAULT NULL,
  `sun` tinyint(1) NOT NULL DEFAULT '0',
  `mon` tinyint(1) NOT NULL DEFAULT '0',
  `tue` tinyint(1) NOT NULL DEFAULT '0',
  `wed` tinyint(1) NOT NULL DEFAULT '0',
  `thu` tinyint(1) NOT NULL DEFAULT '0',
  `fri` tinyint(1) NOT NULL DEFAULT '0',
  `sat` tinyint(1) NOT NULL DEFAULT '0',
  `week_number` tinyint(1) DEFAULT NULL,
  `repeat_end` tinyint(1) NOT NULL DEFAULT '0',
  `excluded` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_repeat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_eventrepeats`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_events`
--

CREATE TABLE IF NOT EXISTS `mail_acal_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_str_id` varchar(255) DEFAULT NULL,
  `fnbl_pim_id` bigint(20) DEFAULT NULL,
  `calendar_id` int(11) DEFAULT NULL,
  `event_timefrom` datetime DEFAULT NULL,
  `event_timetill` datetime DEFAULT NULL,
  `event_allday` tinyint(1) NOT NULL DEFAULT '0',
  `event_name` varchar(100) NOT NULL DEFAULT '',
  `event_text` text,
  `event_priority` tinyint(4) DEFAULT NULL,
  `event_repeats` tinyint(1) NOT NULL DEFAULT '0',
  `event_last_modified` datetime DEFAULT NULL,
  `event_owner_email` varchar(255) NOT NULL DEFAULT '',
  `event_appointment_access` tinyint(4) NOT NULL DEFAULT '0',
  `event_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_events`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_exclusions`
--

CREATE TABLE IF NOT EXISTS `mail_acal_exclusions` (
  `id_exclusion` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) DEFAULT NULL,
  `id_calendar` int(11) DEFAULT NULL,
  `id_repeat` int(11) DEFAULT NULL,
  `id_recurrence_date` datetime DEFAULT NULL,
  `event_timefrom` datetime DEFAULT NULL,
  `event_timetill` datetime DEFAULT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `event_text` text,
  `event_allday` tinyint(1) NOT NULL DEFAULT '0',
  `event_last_modified` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_exclusion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_exclusions`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_publications`
--

CREATE TABLE IF NOT EXISTS `mail_acal_publications` (
  `id_publication` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_calendar` int(11) DEFAULT NULL,
  `str_md5` varchar(32) DEFAULT NULL,
  `int_access_level` tinyint(4) NOT NULL DEFAULT '1',
  `access_type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_publication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_publications`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_reminders`
--

CREATE TABLE IF NOT EXISTS `mail_acal_reminders` (
  `id_reminder` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `notice_type` tinyint(4) NOT NULL DEFAULT '0',
  `remind_offset` int(11) NOT NULL DEFAULT '0',
  `sent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_reminder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_reminders`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_sharing`
--

CREATE TABLE IF NOT EXISTS `mail_acal_sharing` (
  `id_share` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_calendar` int(11) DEFAULT NULL,
  `id_to_user` int(11) DEFAULT NULL,
  `str_to_email` varchar(255) NOT NULL DEFAULT '',
  `int_access_level` tinyint(4) NOT NULL DEFAULT '2',
  `calendar_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_share`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_sharing`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_acal_users_data`
--

CREATE TABLE IF NOT EXISTS `mail_acal_users_data` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `showweekends` tinyint(1) NOT NULL DEFAULT '0',
  `workdaystarts` tinyint(4) NOT NULL DEFAULT '9',
  `workdayends` tinyint(4) NOT NULL DEFAULT '17',
  `showworkday` tinyint(1) NOT NULL DEFAULT '0',
  `weekstartson` tinyint(4) NOT NULL DEFAULT '0',
  `defaulttab` tinyint(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`settings_id`),
  KEY `MAIL_ACAL_USERS_DATA_USER_ID_INDEX` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_acal_users_data`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_addressbooks`
--

CREATE TABLE IF NOT EXISTS `mail_adav_addressbooks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `principaluri` varchar(255) DEFAULT NULL,
  `displayname` varchar(255) DEFAULT NULL,
  `uri` varchar(200) DEFAULT NULL,
  `description` text,
  `ctag` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mail_adav_addressbooks`
--

INSERT INTO `mail_adav_addressbooks` (`id`, `principaluri`, `displayname`, `uri`, `description`, `ctag`) VALUES
(1, 'principals/nidhi@localhost.localdomain', 'General', 'Default', 'General', 1),
(2, 'principals/nidhi@localhost.localdomain', 'Collected Addresses', 'Collected', 'Collected Addresses', 9),
(3, 'principals/101081018@localhost.org', 'General', 'Default', 'General', 1),
(4, 'principals/101081018@localhost.org', 'Collected Addresses', 'Collected', 'Collected Addresses', 1),
(5, 'principals/101081016@localhost.org', 'General', 'Default', 'General', 1),
(6, 'principals/101081016@localhost.org', 'Collected Addresses', 'Collected', 'Collected Addresses', 2),
(7, 'principals/sharmin@localhost.localdomain', 'General', 'Default', 'General', 1),
(8, 'principals/sharmin@localhost.localdomain', 'Collected Addresses', 'Collected', 'Collected Addresses', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_cache`
--

CREATE TABLE IF NOT EXISTS `mail_adav_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `calendaruri` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `eventid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_adav_cache`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_calendarobjects`
--

CREATE TABLE IF NOT EXISTS `mail_adav_calendarobjects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `calendardata` text,
  `uri` varchar(255) DEFAULT NULL,
  `calendarid` int(11) unsigned NOT NULL,
  `lastmodified` int(11) DEFAULT NULL,
  `etag` varchar(32) NOT NULL DEFAULT '',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `componenttype` varchar(8) NOT NULL DEFAULT '',
  `firstoccurence` int(11) unsigned NOT NULL DEFAULT '0',
  `lastoccurence` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_adav_calendarobjects`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_calendars`
--

CREATE TABLE IF NOT EXISTS `mail_adav_calendars` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `principaluri` varchar(100) DEFAULT NULL,
  `displayname` varchar(100) DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `ctag` int(11) unsigned NOT NULL DEFAULT '0',
  `description` text,
  `calendarorder` int(11) unsigned NOT NULL DEFAULT '0',
  `calendarcolor` varchar(10) DEFAULT NULL,
  `timezone` text,
  `components` varchar(20) DEFAULT NULL,
  `transparent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mail_adav_calendars`
--

INSERT INTO `mail_adav_calendars` (`id`, `principaluri`, `displayname`, `uri`, `ctag`, `description`, `calendarorder`, `calendarcolor`, `timezone`, `components`, `transparent`) VALUES
(1, 'principals/nidhi@localhost.localdomain', 'My Calendar', 'Default', 1, '', 0, '#EF9554', NULL, 'VEVENT,VTODO', 0),
(2, 'principals/101081018@localhost.org', 'My Calendar', 'Default', 1, '', 0, '#EF9554', NULL, 'VEVENT,VTODO', 0),
(3, 'principals/101081016@localhost.org', 'My Calendar', 'Default', 1, '', 0, '#EF9554', NULL, 'VEVENT,VTODO', 0),
(4, 'principals/sharmin@localhost.localdomain', 'My Calendar', 'Default', 1, '', 0, '#EF9554', NULL, 'VEVENT,VTODO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_cards`
--

CREATE TABLE IF NOT EXISTS `mail_adav_cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `addressbookid` int(11) unsigned NOT NULL,
  `carddata` text,
  `uri` varchar(255) DEFAULT NULL,
  `lastmodified` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mail_adav_cards`
--

INSERT INTO `mail_adav_cards` (`id`, `addressbookid`, `carddata`, `uri`, `lastmodified`) VALUES
(1, 2, 'BEGIN:VCARD\r\nVERSION:3.0\r\nX-AFTERLOGIC-USE-FREQUENCY:2\r\nPRODID:-//Afterlogic//6.5.x//EN\r\nUID:0c3afc24-619e-444a-af54-82656b6673bc\r\nX-AFTERLOGIC-USE-FRIENDLY-NAME:1\r\nEMAIL;TYPE=INTERNET;TYPE=HOME;TYPE=PREF:nidhirshah1992@gmail.com\r\nEND:VCARD\r\n', '0c3afc24-619e-444a-af54-82656b6673bc.vcf', 1361907789),
(2, 2, 'BEGIN:VCARD\r\nVERSION:3.0\r\nX-AFTERLOGIC-USE-FREQUENCY:4\r\nPRODID:-//Afterlogic//6.5.x//EN\r\nUID:92786eac-b776-41e0-89ed-087ef9053a8e\r\nX-AFTERLOGIC-USE-FRIENDLY-NAME:1\r\nEMAIL;TYPE=INTERNET;TYPE=HOME;TYPE=PREF:sharmin@localhost.localdomain\r\nEND:VCARD\r\n', '92786eac-b776-41e0-89ed-087ef9053a8e.vcf', 1362162007),
(3, 2, 'BEGIN:VCARD\r\nVERSION:3.0\r\nX-AFTERLOGIC-USE-FREQUENCY:2\r\nPRODID:-//Afterlogic//6.5.x//EN\r\nUID:82679cad-6293-4e9a-bbf4-5ec8c06643eb\r\nX-AFTERLOGIC-USE-FRIENDLY-NAME:1\r\nEMAIL;TYPE=INTERNET;TYPE=HOME;TYPE=PREF:nidhi@second.domain\r\nEND:VCARD\r\n', '82679cad-6293-4e9a-bbf4-5ec8c06643eb.vcf', 1361948537),
(4, 6, 'BEGIN:VCARD\r\nVERSION:3.0\r\nX-AFTERLOGIC-USE-FREQUENCY:1\r\nPRODID:-//Afterlogic//6.5.x//EN\r\nUID:a92d7b01-4f9b-44b4-9d6a-1fc1cec111dc\r\nX-AFTERLOGIC-USE-FRIENDLY-NAME:1\r\nEMAIL;TYPE=INTERNET;TYPE=HOME;TYPE=PREF:101081018@localhost.org\r\nEND:VCARD\r\n', 'a92d7b01-4f9b-44b4-9d6a-1fc1cec111dc.vcf', 1361950102);

-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_delegates`
--

CREATE TABLE IF NOT EXISTS `mail_adav_delegates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `calendarid` int(11) unsigned NOT NULL,
  `principalid` int(11) unsigned NOT NULL,
  `mode` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_adav_delegates`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_groupmembers`
--

CREATE TABLE IF NOT EXISTS `mail_adav_groupmembers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `principal_id` int(11) unsigned NOT NULL,
  `member_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `MAIL_ADAV_GROUPMEMBERS_MEMBER_ID_PRINCIPAL_ID_INDEX` (`principal_id`,`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_adav_groupmembers`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_locks`
--

CREATE TABLE IF NOT EXISTS `mail_adav_locks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner` varchar(100) DEFAULT NULL,
  `timeout` int(11) unsigned DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `scope` tinyint(4) DEFAULT NULL,
  `depth` tinyint(4) DEFAULT NULL,
  `uri` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_adav_locks`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_principals`
--

CREATE TABLE IF NOT EXISTS `mail_adav_principals` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `vcardurl` varchar(80) DEFAULT NULL,
  `displayname` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `MAIL_ADAV_PRINCIPALS_URI_INDEX` (`uri`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mail_adav_principals`
--

INSERT INTO `mail_adav_principals` (`id`, `uri`, `email`, `vcardurl`, `displayname`) VALUES
(1, 'principals/nidhi@localhost.localdomain', 'nidhi@localhost.localdomain', NULL, ''),
(2, 'principals/101081018@localhost.org', '101081018@localhost.org', NULL, ''),
(3, 'principals/101081016@localhost.org', '101081016@localhost.org', NULL, ''),
(4, 'principals/sharmin@localhost.localdomain', 'sharmin@localhost.localdomain', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `mail_adav_reminders`
--

CREATE TABLE IF NOT EXISTS `mail_adav_reminders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `calendaruri` varchar(255) DEFAULT NULL,
  `eventid` varchar(45) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_adav_reminders`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_accounts`
--

CREATE TABLE IF NOT EXISTS `mail_awm_accounts` (
  `id_acct` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_domain` int(11) NOT NULL DEFAULT '0',
  `id_realm` int(11) NOT NULL DEFAULT '0',
  `def_acct` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `quota` int(11) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `friendly_nm` varchar(255) DEFAULT NULL,
  `mail_protocol` tinyint(4) NOT NULL DEFAULT '1',
  `mail_inc_host` varchar(255) DEFAULT NULL,
  `mail_inc_port` int(11) NOT NULL DEFAULT '143',
  `mail_inc_login` varchar(255) DEFAULT NULL,
  `mail_inc_pass` varchar(255) DEFAULT NULL,
  `mail_inc_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `mail_out_host` varchar(255) DEFAULT NULL,
  `mail_out_port` int(11) NOT NULL DEFAULT '25',
  `mail_out_login` varchar(255) DEFAULT NULL,
  `mail_out_pass` varchar(255) DEFAULT NULL,
  `mail_out_auth` tinyint(4) NOT NULL DEFAULT '0',
  `mail_out_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `def_order` tinyint(4) NOT NULL DEFAULT '0',
  `getmail_at_login` tinyint(1) NOT NULL DEFAULT '0',
  `mail_mode` tinyint(4) NOT NULL DEFAULT '1',
  `mails_on_server_days` smallint(6) NOT NULL DEFAULT '7',
  `signature` text,
  `signature_type` tinyint(4) NOT NULL DEFAULT '1',
  `signature_opt` tinyint(4) NOT NULL DEFAULT '0',
  `delimiter` varchar(1) NOT NULL DEFAULT '/',
  `mailbox_size` bigint(20) NOT NULL DEFAULT '0',
  `mailing_list` tinyint(1) NOT NULL DEFAULT '0',
  `namespace` varchar(255) NOT NULL DEFAULT '',
  `custom_fields` text,
  PRIMARY KEY (`id_acct`),
  KEY `MAIL_AWM_ACCOUNTS_ID_USER_INDEX` (`id_user`),
  KEY `MAIL_AWM_ACCOUNTS_ID_ACCT_ID_USER_INDEX` (`id_acct`,`id_user`),
  KEY `MAIL_AWM_ACCOUNTS_EMAIL_INDEX` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mail_awm_accounts`
--

INSERT INTO `mail_awm_accounts` (`id_acct`, `id_user`, `id_domain`, `id_realm`, `def_acct`, `deleted`, `quota`, `email`, `friendly_nm`, `mail_protocol`, `mail_inc_host`, `mail_inc_port`, `mail_inc_login`, `mail_inc_pass`, `mail_inc_ssl`, `mail_out_host`, `mail_out_port`, `mail_out_login`, `mail_out_pass`, `mail_out_auth`, `mail_out_ssl`, `def_order`, `getmail_at_login`, `mail_mode`, `mails_on_server_days`, `signature`, `signature_type`, `signature_opt`, `delimiter`, `mailbox_size`, `mailing_list`, `namespace`, `custom_fields`) VALUES
(1, 1, 0, 0, 1, 0, 0, 'nidhi@localhost.localdomain', '', 1, 'localhost', 143, 'nidhi@localhost.localdomain', '6e070a0607', 0, 'localhost', 25, '', '', 2, 0, 0, 1, 3, 7, '', 1, 0, '.', 0, 0, '', ''),
(2, 2, 0, 0, 1, 0, 0, 'sharmin@localhost.localdomain', '', 1, 'localhost', 143, 'sharmin@localhost.localdomain', '731b12011e1a1d', 0, 'localhost', 25, '', '', 2, 0, 0, 1, 3, 7, '', 1, 0, '.', 0, 0, '', ''),
(3, 3, 0, 0, 1, 0, 0, 'nidhi@second.domain', '', 1, 'localhost', 143, 'nidhi@second.domain', '6e070a0607', 0, 'localhost', 25, '', '', 2, 0, 0, 1, 3, 7, '', 1, 0, '.', 0, 0, '', ''),
(4, 4, 0, 0, 1, 0, 0, 'nidhi@localhost.org', '', 1, 'localhost', 143, 'nidhi@localhost.org', '6e070a0607', 0, 'localhost', 25, '', '', 2, 0, 0, 1, 3, 7, '', 1, 0, '.', 0, 0, '', ''),
(5, 5, 0, 0, 1, 0, 0, '101081018@localhost.org', '', 1, 'localhost', 143, '101081018@localhost.org', '6e070a0607', 0, 'localhost', 25, '', '', 2, 0, 0, 1, 3, 7, '', 1, 0, '.', 0, 0, '', ''),
(6, 6, 0, 0, 1, 0, 0, '101081016@localhost.org', '', 1, 'localhost', 143, '101081016@localhost.org', '731b12011e1a1d', 0, 'localhost', 25, '', '', 2, 0, 0, 1, 3, 7, '', 1, 0, '.', 0, 0, '', ''),
(7, 7, 0, 0, 1, 0, 0, 'sharmin@localhost.org', '', 1, 'localhost', 143, 'sharmin@localhost.org', '731b12011e1a1d', 0, 'localhost', 25, '', '', 2, 0, 0, 1, 3, 7, '', 1, 0, '.', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_addr_book`
--

CREATE TABLE IF NOT EXISTS `mail_awm_addr_book` (
  `id_addr` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `str_id` varchar(255) DEFAULT NULL,
  `fnbl_pim_id` bigint(20) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `view_email` varchar(255) NOT NULL DEFAULT '',
  `use_friendly_nm` tinyint(1) NOT NULL DEFAULT '1',
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `surname` varchar(100) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `h_email` varchar(255) DEFAULT NULL,
  `h_street` varchar(255) DEFAULT NULL,
  `h_city` varchar(200) DEFAULT NULL,
  `h_state` varchar(200) DEFAULT NULL,
  `h_zip` varchar(10) DEFAULT NULL,
  `h_country` varchar(200) DEFAULT NULL,
  `h_phone` varchar(50) DEFAULT NULL,
  `h_fax` varchar(50) DEFAULT NULL,
  `h_mobile` varchar(50) DEFAULT NULL,
  `h_web` varchar(255) DEFAULT NULL,
  `b_email` varchar(255) DEFAULT NULL,
  `b_company` varchar(200) DEFAULT NULL,
  `b_street` varchar(255) DEFAULT NULL,
  `b_city` varchar(200) DEFAULT NULL,
  `b_state` varchar(200) DEFAULT NULL,
  `b_zip` varchar(10) DEFAULT NULL,
  `b_country` varchar(200) DEFAULT NULL,
  `b_job_title` varchar(100) DEFAULT NULL,
  `b_department` varchar(200) DEFAULT NULL,
  `b_office` varchar(200) DEFAULT NULL,
  `b_phone` varchar(50) DEFAULT NULL,
  `b_fax` varchar(50) DEFAULT NULL,
  `b_web` varchar(255) DEFAULT NULL,
  `other_email` varchar(255) DEFAULT NULL,
  `primary_email` tinyint(4) DEFAULT NULL,
  `birthday_day` tinyint(4) NOT NULL DEFAULT '0',
  `birthday_month` tinyint(4) NOT NULL DEFAULT '0',
  `birthday_year` smallint(6) NOT NULL DEFAULT '0',
  `id_addr_prev` bigint(20) DEFAULT NULL,
  `tmp` tinyint(1) NOT NULL DEFAULT '0',
  `use_frequency` int(11) NOT NULL DEFAULT '11',
  `auto_create` tinyint(1) NOT NULL DEFAULT '0',
  `notes` varchar(255) DEFAULT NULL,
  `etag` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_addr`),
  KEY `MAIL_AWM_ADDR_BOOK_ID_USER_INDEX` (`id_user`),
  KEY `MAIL_AWM_ADDR_BOOK_DELETED_ID_USER_INDEX` (`id_user`,`deleted`),
  KEY `MAIL_AWM_ADDR_BOOK_USE_FREQUENCY_INDEX` (`use_frequency`),
  KEY `MAIL_AWM_ADDR_BOOK_VIEW_EMAIL_INDEX` (`view_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_addr_book`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_addr_groups`
--

CREATE TABLE IF NOT EXISTS `mail_awm_addr_groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `group_nm` varchar(255) DEFAULT NULL,
  `group_str_id` varchar(100) DEFAULT NULL,
  `use_frequency` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `organization` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_group`),
  KEY `MAIL_AWM_ADDR_GROUPS_ID_USER_INDEX` (`id_user`),
  KEY `MAIL_AWM_ADDR_GROUPS_USE_FREQUENCY_INDEX` (`use_frequency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_addr_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_addr_groups_contacts`
--

CREATE TABLE IF NOT EXISTS `mail_awm_addr_groups_contacts` (
  `id_addr` bigint(20) NOT NULL DEFAULT '0',
  `id_group` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_awm_addr_groups_contacts`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_channels`
--

CREATE TABLE IF NOT EXISTS `mail_awm_channels` (
  `id_channel` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_channel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_channels`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_columns`
--

CREATE TABLE IF NOT EXISTS `mail_awm_columns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_column` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `column_value` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_COLUMNS_ID_USER_INDEX` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_columns`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_domains`
--

CREATE TABLE IF NOT EXISTS `mail_awm_domains` (
  `id_domain` int(11) NOT NULL AUTO_INCREMENT,
  `id_realm` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_quota` int(11) NOT NULL DEFAULT '0',
  `override_settings` tinyint(1) NOT NULL DEFAULT '0',
  `mail_protocol` tinyint(4) NOT NULL DEFAULT '1',
  `mail_inc_host` varchar(255) DEFAULT NULL,
  `mail_inc_port` int(11) NOT NULL DEFAULT '143',
  `mail_inc_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `mail_out_host` varchar(255) DEFAULT NULL,
  `mail_out_port` int(11) NOT NULL DEFAULT '25',
  `mail_out_auth` tinyint(4) NOT NULL DEFAULT '1',
  `mail_out_login` varchar(255) DEFAULT NULL,
  `mail_out_pass` varchar(255) DEFAULT NULL,
  `mail_out_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `mail_out_method` tinyint(4) NOT NULL DEFAULT '1',
  `allow_webmail` tinyint(1) NOT NULL DEFAULT '1',
  `site_name` varchar(255) DEFAULT NULL,
  `allow_change_interface_settings` tinyint(1) NOT NULL DEFAULT '0',
  `allow_users_add_acounts` tinyint(1) NOT NULL DEFAULT '0',
  `allow_change_account_settings` tinyint(1) NOT NULL DEFAULT '0',
  `allow_new_users_register` tinyint(1) NOT NULL DEFAULT '1',
  `def_user_timezone` int(11) NOT NULL DEFAULT '0',
  `def_user_timeformat` tinyint(4) NOT NULL DEFAULT '0',
  `def_user_dateformat` varchar(100) NOT NULL DEFAULT 'MM/DD/YYYY',
  `msgs_per_page` smallint(6) NOT NULL DEFAULT '20',
  `skin` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `ext_imap_host` varchar(255) NOT NULL DEFAULT '',
  `ext_smtp_host` varchar(255) NOT NULL DEFAULT '',
  `ext_dav_host` varchar(255) NOT NULL DEFAULT '',
  `allow_contacts` tinyint(1) NOT NULL DEFAULT '1',
  `contacts_per_page` smallint(6) NOT NULL DEFAULT '20',
  `allow_calendar` tinyint(1) NOT NULL DEFAULT '1',
  `cal_week_starts_on` tinyint(4) NOT NULL DEFAULT '0',
  `cal_show_weekends` tinyint(1) NOT NULL DEFAULT '0',
  `cal_workday_starts` tinyint(4) NOT NULL DEFAULT '9',
  `cal_workday_ends` tinyint(4) NOT NULL DEFAULT '18',
  `cal_show_workday` tinyint(1) NOT NULL DEFAULT '0',
  `cal_default_tab` tinyint(4) NOT NULL DEFAULT '2',
  `layout` tinyint(4) NOT NULL DEFAULT '0',
  `xlist` tinyint(1) NOT NULL DEFAULT '1',
  `global_addr_book` tinyint(4) NOT NULL DEFAULT '0',
  `check_interval` int(11) NOT NULL DEFAULT '0',
  `allow_registration` tinyint(1) NOT NULL DEFAULT '0',
  `allow_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `is_internal` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_domains`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_fetchers`
--

CREATE TABLE IF NOT EXISTS `mail_awm_fetchers` (
  `id_fetcher` int(11) NOT NULL AUTO_INCREMENT,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `inc_protocol` tinyint(4) NOT NULL DEFAULT '0',
  `inc_security` tinyint(4) NOT NULL DEFAULT '0',
  `inc_host` varchar(255) DEFAULT NULL,
  `inc_port` int(11) DEFAULT NULL,
  `inc_login` varchar(255) DEFAULT NULL,
  `inc_password` varchar(255) DEFAULT NULL,
  `local_user` varchar(255) DEFAULT NULL,
  `local_domain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_fetcher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_fetchers`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_filters`
--

CREATE TABLE IF NOT EXISTS `mail_awm_filters` (
  `id_filter` int(11) NOT NULL AUTO_INCREMENT,
  `id_acct` int(11) NOT NULL DEFAULT '0',
  `field` tinyint(4) NOT NULL DEFAULT '0',
  `condition` tinyint(4) NOT NULL DEFAULT '0',
  `filter` varchar(255) DEFAULT NULL,
  `action` tinyint(4) NOT NULL DEFAULT '0',
  `id_folder` bigint(20) NOT NULL DEFAULT '0',
  `applied` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_filter`),
  KEY `MAIL_AWM_FILTERS_ID_ACCT_ID_FOLDER_INDEX` (`id_acct`,`id_folder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_filters`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_folders`
--

CREATE TABLE IF NOT EXISTS `mail_awm_folders` (
  `id_folder` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_parent` bigint(20) NOT NULL DEFAULT '0',
  `id_acct` int(11) NOT NULL DEFAULT '0',
  `type` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `full_path` varchar(255) DEFAULT NULL,
  `sync_type` tinyint(4) NOT NULL DEFAULT '0',
  `hide` tinyint(1) NOT NULL DEFAULT '0',
  `fld_order` smallint(6) NOT NULL DEFAULT '1',
  `flags` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_folder`),
  KEY `MAIL_AWM_FOLDERS_ID_ACCT_ID_FOLDER_INDEX` (`id_acct`,`id_folder`),
  KEY `MAIL_AWM_FOLDERS_ID_ACCT_ID_PARENT_INDEX` (`id_acct`,`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `mail_awm_folders`
--

INSERT INTO `mail_awm_folders` (`id_folder`, `id_parent`, `id_acct`, `type`, `name`, `full_path`, `sync_type`, `hide`, `fld_order`, `flags`) VALUES
(1, -1, 1, 1, 'INBOX#', 'INBOX#', 5, 0, 0, '\\hasnochildren'),
(2, -1, 1, 3, 'Drafts#', 'Drafts#', 5, 0, 1, '\\hasnochildren'),
(3, -1, 1, 2, 'Sent Items#', 'Sent Items#', 5, 0, 2, '\\hasnochildren'),
(4, -1, 1, 5, 'Spam#', 'Spam#', 5, 0, 3, '\\hasnochildren'),
(5, -1, 1, 4, 'Trash#', 'Trash#', 5, 0, 4, '\\hasnochildren'),
(6, -1, 2, 1, 'INBOX#', 'INBOX#', 5, 0, 0, '\\hasnochildren'),
(7, -1, 2, 3, 'Drafts#', 'Drafts#', 5, 0, 1, '\\hasnochildren'),
(8, -1, 2, 2, 'Sent Items#', 'Sent Items#', 5, 0, 2, '\\hasnochildren'),
(9, -1, 2, 5, 'Spam#', 'Spam#', 5, 0, 3, '\\hasnochildren'),
(10, -1, 2, 4, 'Trash#', 'Trash#', 5, 0, 4, '\\hasnochildren'),
(11, -1, 3, 1, 'INBOX#', 'INBOX#', 5, 0, 0, '\\hasnochildren'),
(12, -1, 3, 3, 'Drafts#', 'Drafts#', 5, 0, 1, '\\hasnochildren'),
(13, -1, 3, 2, 'Sent Items#', 'Sent Items#', 5, 0, 2, '\\hasnochildren'),
(14, -1, 3, 5, 'Spam#', 'Spam#', 5, 0, 3, '\\hasnochildren'),
(15, -1, 3, 4, 'Trash#', 'Trash#', 5, 0, 4, '\\hasnochildren'),
(16, -1, 4, 1, 'INBOX#', 'INBOX#', 5, 0, 0, '\\hasnochildren'),
(17, -1, 4, 3, 'Drafts#', 'Drafts#', 5, 0, 1, '\\hasnochildren'),
(18, -1, 4, 2, 'Sent Items#', 'Sent Items#', 5, 0, 2, '\\hasnochildren'),
(19, -1, 4, 5, 'Spam#', 'Spam#', 5, 0, 3, '\\hasnochildren'),
(20, -1, 4, 4, 'Trash#', 'Trash#', 5, 0, 4, '\\hasnochildren'),
(21, -1, 5, 1, 'INBOX#', 'INBOX#', 5, 0, 0, '\\hasnochildren'),
(22, -1, 5, 3, 'Drafts#', 'Drafts#', 5, 0, 1, '\\hasnochildren'),
(23, -1, 5, 2, 'Sent Items#', 'Sent Items#', 5, 0, 2, '\\hasnochildren'),
(24, -1, 5, 5, 'Spam#', 'Spam#', 5, 0, 3, '\\hasnochildren'),
(25, -1, 5, 4, 'Trash#', 'Trash#', 5, 0, 4, '\\hasnochildren'),
(26, -1, 6, 1, 'INBOX#', 'INBOX#', 5, 0, 0, '\\hasnochildren'),
(27, -1, 6, 3, 'Drafts#', 'Drafts#', 5, 0, 1, '\\hasnochildren'),
(28, -1, 6, 2, 'Sent Items#', 'Sent Items#', 5, 0, 2, '\\hasnochildren'),
(29, -1, 6, 5, 'Spam#', 'Spam#', 5, 0, 3, '\\hasnochildren'),
(30, -1, 6, 4, 'Trash#', 'Trash#', 5, 0, 4, '\\hasnochildren'),
(31, -1, 7, 1, 'INBOX#', 'INBOX#', 5, 0, 0, '\\hasnochildren'),
(32, -1, 7, 3, 'Drafts#', 'Drafts#', 5, 0, 1, '\\hasnochildren'),
(33, -1, 7, 2, 'Sent Items#', 'Sent Items#', 5, 0, 2, '\\hasnochildren'),
(34, -1, 7, 5, 'Spam#', 'Spam#', 5, 0, 3, '\\hasnochildren'),
(35, -1, 7, 4, 'Trash#', 'Trash#', 5, 0, 4, '\\hasnochildren');

-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_folders_tree`
--

CREATE TABLE IF NOT EXISTS `mail_awm_folders_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_folder` bigint(20) NOT NULL DEFAULT '0',
  `id_parent` bigint(20) NOT NULL DEFAULT '0',
  `folder_level` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_FOLDERS_TREE_ID_FOLDER_INDEX` (`id_folder`),
  KEY `MAIL_AWM_FOLDERS_TREE_ID_FOLDER_ID_PARENT_INDEX` (`id_folder`,`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `mail_awm_folders_tree`
--

INSERT INTO `mail_awm_folders_tree` (`id`, `id_folder`, `id_parent`, `folder_level`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0),
(3, 3, 3, 0),
(4, 4, 4, 0),
(5, 5, 5, 0),
(6, 6, 6, 0),
(7, 7, 7, 0),
(8, 8, 8, 0),
(9, 9, 9, 0),
(10, 10, 10, 0),
(11, 11, 11, 0),
(12, 12, 12, 0),
(13, 13, 13, 0),
(14, 14, 14, 0),
(15, 15, 15, 0),
(16, 16, 16, 0),
(17, 17, 17, 0),
(18, 18, 18, 0),
(19, 19, 19, 0),
(20, 20, 20, 0),
(21, 21, 21, 0),
(22, 22, 22, 0),
(23, 23, 23, 0),
(24, 24, 24, 0),
(25, 25, 25, 0),
(26, 26, 26, 0),
(27, 27, 27, 0),
(28, 28, 28, 0),
(29, 29, 29, 0),
(30, 30, 30, 0),
(31, 31, 31, 0),
(32, 32, 32, 0),
(33, 33, 33, 0),
(34, 34, 34, 0),
(35, 35, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_identities`
--

CREATE TABLE IF NOT EXISTS `mail_awm_identities` (
  `id_identity` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_acct` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `friendly_nm` varchar(255) NOT NULL DEFAULT '',
  `signature` text,
  `signature_type` tinyint(4) NOT NULL DEFAULT '1',
  `use_signature` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_identity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_identities`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_mailaliases`
--

CREATE TABLE IF NOT EXISTS `mail_awm_mailaliases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acct` int(11) DEFAULT NULL,
  `alias_name` varchar(255) NOT NULL DEFAULT '',
  `alias_domain` varchar(255) NOT NULL DEFAULT '',
  `alias_to` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_MAILALIASES_ID_ACCT_INDEX` (`id_acct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_mailaliases`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_mailforwards`
--

CREATE TABLE IF NOT EXISTS `mail_awm_mailforwards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acct` int(11) DEFAULT NULL,
  `forward_name` varchar(255) NOT NULL DEFAULT '',
  `forward_domain` varchar(255) NOT NULL DEFAULT '',
  `forward_to` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_MAILFORWARDS_ID_ACCT_INDEX` (`id_acct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_mailforwards`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_mailinglists`
--

CREATE TABLE IF NOT EXISTS `mail_awm_mailinglists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acct` int(11) DEFAULT NULL,
  `list_name` varchar(255) NOT NULL DEFAULT '',
  `list_to` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_MAILINGLISTS_ID_ACCT_INDEX` (`id_acct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_mailinglists`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_messages`
--

CREATE TABLE IF NOT EXISTS `mail_awm_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_msg` bigint(20) NOT NULL DEFAULT '0',
  `id_acct` int(11) NOT NULL DEFAULT '0',
  `id_folder_srv` bigint(20) NOT NULL DEFAULT '0',
  `id_folder_db` bigint(20) NOT NULL DEFAULT '0',
  `str_uid` varchar(255) DEFAULT NULL,
  `int_uid` bigint(20) NOT NULL DEFAULT '0',
  `from_msg` varchar(255) DEFAULT NULL,
  `to_msg` varchar(255) DEFAULT NULL,
  `cc_msg` varchar(255) DEFAULT NULL,
  `bcc_msg` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `msg_date` datetime DEFAULT NULL,
  `attachments` tinyint(1) NOT NULL DEFAULT '0',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `flagged` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `downloaded` tinyint(1) NOT NULL DEFAULT '0',
  `x_spam` tinyint(1) NOT NULL DEFAULT '0',
  `rtl` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_full` tinyint(1) NOT NULL DEFAULT '1',
  `replied` tinyint(1) DEFAULT NULL,
  `forwarded` tinyint(1) DEFAULT NULL,
  `flags` int(11) DEFAULT NULL,
  `body_text` longtext,
  `grayed` tinyint(1) NOT NULL DEFAULT '0',
  `charset` int(11) NOT NULL DEFAULT '-1',
  `sensitivity` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_MESSAGES_ID_ACCT_ID_FOLDER_DB_INDEX` (`id_acct`,`id_folder_db`),
  KEY `MAIL_AWM_MESSAGES_ID_ACCT_ID_FOLDER_DB_SEEN_INDEX` (`id_acct`,`id_folder_db`,`seen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_messages_body`
--

CREATE TABLE IF NOT EXISTS `mail_awm_messages_body` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_msg` bigint(20) NOT NULL DEFAULT '0',
  `id_acct` int(11) NOT NULL DEFAULT '0',
  `msg` longblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `MAIL_AWM_MESSAGES_BODY_ID_ACCT_ID_MSG_INDEX` (`id_acct`,`id_msg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_messages_body`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_reads`
--

CREATE TABLE IF NOT EXISTS `mail_awm_reads` (
  `id_read` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_acct` int(11) NOT NULL DEFAULT '0',
  `str_uid` varchar(255) DEFAULT NULL,
  `tmp` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_read`),
  KEY `MAIL_AWM_READS_ID_ACCT_INDEX` (`id_acct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_reads`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_realms`
--

CREATE TABLE IF NOT EXISTS `mail_awm_realms` (
  `id_realm` int(11) NOT NULL AUTO_INCREMENT,
  `id_channel` int(11) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `login_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quota` int(11) NOT NULL DEFAULT '0',
  `user_count_limit` int(11) NOT NULL DEFAULT '0',
  `domain_count_limit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_realm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_realms`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_senders`
--

CREATE TABLE IF NOT EXISTS `mail_awm_senders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `safety` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_SENDERS_ID_USER_INDEX` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_senders`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_settings`
--

CREATE TABLE IF NOT EXISTS `mail_awm_settings` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `msgs_per_page` smallint(6) NOT NULL DEFAULT '20',
  `contacts_per_page` smallint(6) NOT NULL DEFAULT '20',
  `last_login` datetime DEFAULT NULL,
  `logins_count` int(11) NOT NULL DEFAULT '0',
  `auto_checkmail_interval` int(11) NOT NULL DEFAULT '0',
  `def_skin` varchar(255) NOT NULL DEFAULT 'AfterLogic',
  `def_editor` tinyint(1) NOT NULL DEFAULT '1',
  `layout` tinyint(4) NOT NULL DEFAULT '0',
  `save_mail` tinyint(4) NOT NULL DEFAULT '0',
  `def_timezone` smallint(6) NOT NULL DEFAULT '0',
  `def_time_fmt` varchar(255) DEFAULT NULL,
  `def_lang` varchar(255) DEFAULT NULL,
  `def_date_fmt` varchar(100) NOT NULL DEFAULT 'MM/DD/YYYY',
  `mailbox_limit` bigint(20) NOT NULL DEFAULT '0',
  `incoming_charset` varchar(30) NOT NULL DEFAULT 'iso-8859-1',
  `question_1` varchar(255) DEFAULT NULL,
  `answer_1` varchar(255) DEFAULT NULL,
  `question_2` varchar(255) DEFAULT NULL,
  `answer_2` varchar(255) DEFAULT NULL,
  `enable_fnbl_sync` tinyint(1) NOT NULL DEFAULT '0',
  `capa` varchar(255) DEFAULT NULL,
  `client_timeoffset` int(11) NOT NULL DEFAULT '0',
  `custom_fields` text,
  PRIMARY KEY (`id_setting`),
  UNIQUE KEY `MAIL_AWM_SETTINGS_ID_USER_INDEX` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mail_awm_settings`
--

INSERT INTO `mail_awm_settings` (`id_setting`, `id_user`, `msgs_per_page`, `contacts_per_page`, `last_login`, `logins_count`, `auto_checkmail_interval`, `def_skin`, `def_editor`, `layout`, `save_mail`, `def_timezone`, `def_time_fmt`, `def_lang`, `def_date_fmt`, `mailbox_limit`, `incoming_charset`, `question_1`, `answer_1`, `question_2`, `answer_2`, `enable_fnbl_sync`, `capa`, `client_timeoffset`, `custom_fields`) VALUES
(1, 1, 20, 20, '2013-03-02 06:41:13', 17, 0, 'AfterLogic_Dark', 1, 0, 1, 0, '1', 'English', 'MM/DD/YYYY', 0, 'iso-8859-1', '', '', '', '', 0, '', 330, ''),
(2, 2, 20, 20, '2013-03-02 06:32:34', 6, 0, 'AfterLogic_Dark', 1, 0, 1, 0, '1', 'English', 'MM/DD/YYYY', 0, 'iso-8859-1', '', '', '', '', 0, '', 330, ''),
(3, 3, 20, 20, '2013-02-27 08:44:44', 3, 0, 'AfterLogic_Dark', 1, 0, 1, 0, '1', 'English', 'MM/DD/YYYY', 0, 'iso-8859-1', '', '', '', '', 0, '', 330, ''),
(4, 4, 20, 20, '2013-02-26 20:38:18', 1, 0, 'AfterLogic_Dark', 1, 0, 1, 0, '1', 'English', 'MM/DD/YYYY', 0, 'iso-8859-1', '', '', '', '', 0, '', 330, ''),
(5, 5, 20, 20, '2013-02-27 07:06:14', 2, 0, 'AfterLogic_Dark', 1, 0, 1, 0, '1', 'English', 'MM/DD/YYYY', 0, 'iso-8859-1', '', '', '', '', 0, '', 330, ''),
(6, 6, 20, 20, '2013-02-27 07:08:45', 1, 0, 'AfterLogic_Dark', 1, 0, 1, 0, '1', 'English', 'MM/DD/YYYY', 0, 'iso-8859-1', '', '', '', '', 0, '', 330, ''),
(7, 7, 20, 20, '2013-02-27 18:31:20', 1, 0, 'AfterLogic_Dark', 1, 0, 1, 0, '1', 'English', 'MM/DD/YYYY', 0, 'iso-8859-1', '', '', '', '', 0, '', 330, '');

-- --------------------------------------------------------

--
-- Table structure for table `mail_awm_system_folders`
--

CREATE TABLE IF NOT EXISTS `mail_awm_system_folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acct` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `folder_full_name` varchar(255) DEFAULT NULL,
  `system_type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `MAIL_AWM_SYSTEM_FOLDERS_ID_ACCT_INDEX` (`id_acct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mail_awm_system_folders`
--


-- --------------------------------------------------------

--
-- Table structure for table `mail_a_users`
--

CREATE TABLE IF NOT EXISTS `mail_a_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mail_a_users`
--

INSERT INTO `mail_a_users` (`id_user`, `deleted`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notif_by`
--

CREATE TABLE IF NOT EXISTS `notif_by` (
  `notif_id` int(10) NOT NULL AUTO_INCREMENT,
  `notif_type_id` int(10) NOT NULL,
  `object_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`notif_id`),
  KEY `notif_type_id` (`notif_type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `notif_by`
--

INSERT INTO `notif_by` (`notif_id`, `notif_type_id`, `object_id`, `user_id`) VALUES
(2, 2, 12, 101081016),
(3, 4, 12, 101081016),
(4, 2, 9, 101081016),
(5, 4, 9, 101081016),
(6, 2, 9, 101081018),
(7, 4, 9, 101081018),
(8, 2, 13, 101081016),
(10, 2, 12, 101081049),
(11, 4, 12, 101081049),
(12, 2, 13, 101081049),
(13, 4, 13, 101081049),
(14, 2, 9, 101081049),
(15, 4, 9, 101081049),
(18, 2, 12, 101081052),
(19, 4, 12, 101081052),
(22, 2, 13, 101081051),
(23, 4, 13, 101081051),
(24, 4, 9, 101081016),
(25, 1, 1, 101081016),
(26, 1, 1, 101081051),
(27, 3, 1, 101081051),
(33, 7, 1, 101081052),
(34, 8, 1, 101081052),
(37, 2, 9, 101081018),
(38, 4, 9, 101081018),
(39, 8, 1, 101081052),
(40, 8, 1, 101081052),
(49, 5, 1, 101081018),
(50, 5, 1, 101081018);

-- --------------------------------------------------------

--
-- Table structure for table `notif_for`
--

CREATE TABLE IF NOT EXISTS `notif_for` (
  `notif_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `has_seen` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notif_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif_for`
--

INSERT INTO `notif_for` (`notif_id`, `user_id`, `has_seen`) VALUES
(2, 101081049, 0),
(3, 101081018, 0),
(3, 101081052, 0),
(5, 101081051, 0),
(6, 101081016, 0),
(7, 101081051, 0),
(8, 101081018, 0),
(10, 101081049, 0),
(11, 101081016, 0),
(11, 101081018, 0),
(11, 101081052, 0),
(12, 101081018, 0),
(13, 101081016, 0),
(14, 101081016, 0),
(15, 101081018, 0),
(15, 101081051, 0),
(18, 101081049, 0),
(19, 101081016, 0),
(19, 101081018, 0),
(22, 101081018, 0),
(23, 101081016, 0),
(23, 101081049, 0),
(24, 101081018, 0),
(24, 101081049, 0),
(24, 101081051, 0),
(25, 101081018, 0),
(26, 101081018, 0),
(27, 101081016, 0),
(33, 101081016, 0),
(33, 101081018, 0),
(33, 101081049, 0),
(34, 101081016, 0),
(34, 101081018, 1),
(34, 101081049, 0),
(37, 101081016, 0),
(38, 101081049, 0),
(38, 101081051, 0),
(39, 101081016, 0),
(39, 101081018, 1),
(39, 101081049, 0),
(40, 101081016, 0),
(40, 101081018, 1),
(40, 101081049, 0),
(49, 101081016, 0),
(49, 101081049, 0),
(49, 101081050, 0),
(50, 101081052, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notif_type`
--

CREATE TABLE IF NOT EXISTS `notif_type` (
  `notif_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `notif_desc` varchar(50) NOT NULL,
  PRIMARY KEY (`notif_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `notif_type`
--

INSERT INTO `notif_type` (`notif_type_id`, `notif_desc`) VALUES
(1, 'has commented on your post'),
(2, 'has replied to your thread'),
(3, 'has commented on the post'),
(4, 'has replied to the thread'),
(5, 'has shared with you the document'),
(6, 'has uploaded a revision of the document'),
(7, 'has uploaded an assignment for the course'),
(8, 'has evaluated the assignment');

-- --------------------------------------------------------

--
-- Table structure for table `shared_document`
--

CREATE TABLE IF NOT EXISTS `shared_document` (
  `doc_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`doc_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shared_document`
--

INSERT INTO `shared_document` (`doc_id`, `user_id`) VALUES
(1, 101081016),
(1, 101081049),
(1, 101081050),
(1, 101081052);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(10) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `branch`, `year`) VALUES
(101081012, 'EXTC', 'S.Y.'),
(101081016, 'I.T.', 'T.Y.'),
(101081018, 'I.T.', 'T.Y.'),
(101081049, 'I.T.', 'T.Y.'),
(101081050, 'I.T.', 'T.Y.'),
(101081053, 'I.T.', 'F.Y.');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE IF NOT EXISTS `submission` (
  `assign_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `marks_obtained` tinyint(3) DEFAULT NULL,
  `remarks` varchar(100) NOT NULL DEFAULT ' No Special Remarks',
  `file_path` varchar(250) NOT NULL,
  `file_size` int(8) NOT NULL,
  PRIMARY KEY (`assign_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`assign_id`, `student_id`, `marks_obtained`, `remarks`, `file_path`, `file_size`) VALUES
(1, 101081016, 10, 'Good', '101081016-1362062788.pdf', 92717),
(1, 101081018, 15, 'OK', '101081018-1362062762.pdf', 92717),
(1, 101081049, 20, 'OK', '101081049-1362062920.pdf', 92717);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(20) NOT NULL,
  `frequency` int(10) DEFAULT '1',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `frequency`) VALUES
(1, 'android', 1),
(2, 'iphone', 1),
(3, 'cell phones', 2),
(4, 'bacteria', 1),
(5, 'sharing', 1),
(7, 'android smartphone', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `dept` varchar(20) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `post` varchar(20) NOT NULL,
  `qualification` varchar(150) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`dept`, `teacher_id`, `post`, `qualification`) VALUES
('EXTC', 101081051, 'H.O.D.', 'PHD in EXTC'),
('I.T.', 101081052, 'Teacher', 'Master of Everything,master of computer science, phd in programmin. mbbbbbs, forensicsssss, crime branch');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `mobile` int(11) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `profession` char(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`fname`, `lname`, `gender`, `email`, `password`, `mobile`, `user_id`, `verified`, `profession`) VALUES
('Manali', 'Kumar', 'f', 'manali@gmail.com', '0f225be8b644498c25dd421a12e7cbeb', 0, 101081012, 1, 's'),
('Sharmin', 'Lalani', 'f', 's.lalani19@yahoo.com', '30f88072b59fcea5b439f0fec08d89bb', 1234567890, 101081016, 1, 's'),
('Nidhi', 'Shah', 'f', 'nidhishah@gmail.com', 'a4ba89b6c2184e1c0c8f02547a413daa', 2147483647, 101081018, 1, 's'),
('Gayatri', 'Mehendarge', 'f', 'gayo@yahoo.com', '34eace700b79730481c17bab7e2657e1', 0, 101081049, 1, 's'),
('Shar', 'Lalani', 'f', 'sharmin.19@gmail.com', '30f88072b59fcea5b439f0fec08d89bb', 0, 101081050, 1, 's'),
('Dipen', 'Sanghvi', 'm', 'dipen@yahoo.co.in', '8d923345e2cc631980750dce34e95a00', 0, 101081051, 1, 't'),
('Jinal', 'Thakkar', 'f', 'nidhirshah@gmail.com', '8723b006c2937ff19ecd52ce4208c26e', 2147483647, 101081052, 1, 't'),
('Payal', 'Chheda', 'f', 'hnlalani@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 101081053, 1, 's');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation`
--
ALTER TABLE `activation`
  ADD CONSTRAINT `activation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `blog_comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD CONSTRAINT `blog_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `document_ibfk_2` FOREIGN KEY (`revised_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_invitee`
--
ALTER TABLE `event_invitee`
  ADD CONSTRAINT `event_invitee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_invitee_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `forum_comment`
--
ALTER TABLE `forum_comment`
  ADD CONSTRAINT `forum_comment_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `forum` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notif_by`
--
ALTER TABLE `notif_by`
  ADD CONSTRAINT `notif_by_ibfk_1` FOREIGN KEY (`notif_type_id`) REFERENCES `notif_type` (`notif_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notif_by_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notif_for`
--
ALTER TABLE `notif_for`
  ADD CONSTRAINT `notif_for_ibfk_1` FOREIGN KEY (`notif_id`) REFERENCES `notif_by` (`notif_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notif_for_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shared_document`
--
ALTER TABLE `shared_document`
  ADD CONSTRAINT `shared_document_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `document` (`doc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shared_document_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`assign_id`) REFERENCES `assignment` (`assign_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
