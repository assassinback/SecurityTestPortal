-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2023 at 12:18 PM
-- Server version: 8.0.34
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secure_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `id` int NOT NULL,
  `user_type` text COLLATE utf8mb4_general_ci NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `enabled` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`id`, `user_type`, `username`, `password`, `full_name`, `enabled`) VALUES
(1, 'admin', 'admin', 'ziakhan1198@', 'Admin', 1),
(2, 'user', 'user', 'user123', 'test', 1),
(3, 'user', 'Imran', 'Scbyte@1234', 'Ivan', 1),
(4, 'user', 'Shahroz', 'Scbyte@1234', 'Harry', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bug_info`
--

CREATE TABLE `bug_info` (
  `id` int NOT NULL,
  `bug_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `bug_report` text COLLATE utf8mb4_general_ci NOT NULL,
  `meta_data` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bug_info`
--

INSERT INTO `bug_info` (`id`, `bug_name`, `bug_report`, `meta_data`) VALUES
(1, 'Click Jacking', 'Greetings,\n\nAs a bug bounty hunter and web security researcher, my main objective is to protect the internet from cyberattacks. I specialize in identifying and reporting bugs on websites, providing comprehensive vulnerability assessment reports that detail the identified issues. During my recent research efforts, I came across your website, ‘[website_name]’.\n\nVulnerability: Clickjacking (User Interface redress attack, UI redress attack, UI redressing)\n\nThis is a malicious technique whereby a web user is deceived into interacting (in most cases by clicking) with something other than what the user believes they are interacting with, thus potentially revealing confidential information or taking control of their computer while clicking on seemingly innocuous web pages.\n\nThe server didn\'t return an X-Frame-Options header which means that this website could be at risk of a clickjacking attack. The X-Frame-Options HTTP response header can be used to indicate whether a browser should be allowed to render a page in a <frame> or <iframe>. This is a client-side security issue that affects a variety of browsers and platforms.\n\nSteps to reproduce:\n\n1. Create a new HTML file\n2. Put the following code inside the file\n<pre lang=\"JavaScript\" line=\"1\">\n<html>\n<head>\n<title>ClickJacking PoC</title>\n</head>\nClickJacking PoC\n<iframe src=\"[extra_data]\" height=\"450\" width=\"1000\"></iframe>\n</body>\n</html>\n</pre>\n3. Save the file\n4. Open the document in the browser\n\nImpact:\n\nThe victim surfs the attacker’s web page intending to interact with the visible user interface but is inadvertently performing actions on the hidden page. Using the hidden page, an attacker can deceive users into performing actions they never intended to perform through the positioning of the hidden elements in the web page.\n\nPoC:\n\n\nRemediation:\n\nThe frame-busting technique is the better framing protection technique. Sending the proper X-FrameOptions HTTP response headers that instruct the browser to not allow framing from other domains. For more information about Clickjacking, visit\nhttps://owasp.org/www-project-web-security-testing-guide/v41/4-\nWeb_Application_Security_Testing/11-Client_Side_Testing/09-Testing_for_Clickjacking Also check out a HackerOne report about Clickjacking https://hackerone.com/reports/591432\n\nNote:\n\nI will share detailed reports for further vulnerabilities once this one is validated.\n\nHoping to receive a monetary reward/ bounty for potentially responsible disclosure.\n\nBest regards,\n[full_name]\n\nLet’s secure the Network\n\n', ''),
(2, 'DMARC RED', 'Greetings,\n\nAs a bug bounty hunter and web security researcher, my main objective is to protect the internet from cyberattacks. I specialize in identifying and reporting bugs on websites, providing comprehensive vulnerability assessment reports that detail the identified issues. During my recent research efforts, I came across your website, ‘[website_name]’.\n\nVulnerability: Missing DMARC Record\n\nDMARC is an email authentication protocol designed to help domain owners protect their domains from unauthorized use, specifically email spoofing. Its implementation aims to defend against business email compromise attacks, phishing emails, email scams, and other cyber threats. A DMARC Record includes a policy that determines how unauthenticated or forged emails should be handled. The absence of this record creates an opportunity for attackers to exploit the domain name. On your website, I discovered a similar issue where anyone can send emails from Your Emails [extra_data] to other users.\n\nBy using the following DMARC record, I successfully sent a manipulated email to my own address, making it appear as if it originated from Contact Form: [extra_data]\n\nScreenshot Proof-of-Concept\n\n\n\nImpact:\n\nThis phishing technique can be highly effective, allowing attackers to send forged emails from your domain and impersonate your company\'s official representatives. They can manipulate victims into providing sensitive information, including money or credentials. Extensive research studies highlight the critical importance of implementing DMARC and SPF protocols to mitigate such risks.\n\nIf you need further assistance or have any additional questions, please feel free to reach out. I\'m here to help. I would like to mention that I\'m looking forward to being eligible for a bug bounty reward through the responsible disclosure of this issue. Once this matter is addressed and resolved, I hope to report any additional bugs that I may come across.\nFix:\n\nPlease let me know if you need any assistance with resolving this issue\n\nThank you and regards,\n\n[full_name]', ''),
(3, 'DMARC YELLOW', 'Greetings,\n\nAs a bug bounty hunter and web security researcher, my main objective is to protect the internet from cyberattacks. I specialize in identifying and reporting bugs on websites, providing comprehensive vulnerability assessment reports that detail the identified issues. During my recent research efforts, I came across your website, ‘[website_name]’.\n\nVulnerability: Missing DMARC Policy\n\nDMARC is an email authentication protocol designed to help domain owners protect their domains from unauthorized use, specifically email spoofing. Its implementation aims to defend against business email compromise attacks, phishing emails, email scams, and other cyber threats. When DMARCs policy is enabled it determines how unauthenticated or forged emails should be handled. When the DMARC policy is disabled it creates an opportunity for attackers to exploit the domain name. On your website, I discovered a similar issue where anyone can send emails from [extra_data] Your Emails to other users.\n\nI successfully sent a manipulated email to my own address, making it appear as if it originated from Contact Form: [extra_data]\n\nScreenshot Proof-of-Concept\n\n\n\nImpact:\n\nThis phishing technique can be highly effective, allowing attackers to send forged emails from your domain and impersonate your company\'s official representatives. They can manipulate victims into providing sensitive information, including money or credentials. Extensive research studies highlight the critical importance of implementing DMARC and SPF protocols to mitigate such risks.\n\nIf you need further assistance or have any additional questions, please feel free to reach out. I\'m here to help. I would like to mention that I\'m looking forward to being eligible for a bug bounty reward through the responsible disclosure of this issue. Once this matter is addressed and resolved, I hope to report any additional bugs that I may come across.\n\nFix:\n\nPlease let me know if you need any assistance with resolving this issue\n\nThank you and regards,\n\n[full_name]', ''),
(4, 'Ticket', 'Hello,\r\n\r\nI came across your website [website_name] during my research and admire your online presence! :)\r\n\r\nWhile navigating your website, I stumbled upon a vulnerability that could potentially pose a threat.\r\n\r\nCould you kindly direct me to the appropriate individual to discuss this matter with, and provide their contact information to disclose the complete vulnerability report responsibly? I assure you that my intentions are purely to enhance the security of your platform.\r\n\r\nFurthermore, I would like to inquire if you would consider offering a monetary reward as a gesture of gratitude, once the vulnerability is thoroughly validated and addressed.\r\n\r\nYou can reach out to me for any correspondence.\r\n\r\nBest Regards,\r\n[full_name]', '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `config_key` varchar(32) NOT NULL,
  `config_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config_key`, `config_value`) VALUES
(1, 'site_title', 'Security Portal'),
(2, 'admin_title', 'Security Portal'),
(3, 'smtp_username', 'mail@mgtcloud.co.uk'),
(4, 'smtp_password', 'mgtm4il789'),
(5, 'smtp_host', 'auth.smtp.1and1.co.uk'),
(6, 'smtp_from_name', 'Pitch'),
(7, 'smtp_from_email', 'admin@pitchrmt.com'),
(8, 'mail_type', 'SMTP'),
(9, 'blog_date_format', 'd.m.Y'),
(10, 'default_date_format', 'd/m/Y'),
(11, 'copyright_text', '&copy; %s PitchRMT Ltd. All Rights Reserved'),
(12, 'site_email', 'admin@pitchrmt.com'),
(13, 'site_phone_no', '07496975890'),
(14, 'site_address', 'University of Northampton Innovation Centre<br> Green Street<br>Northampton<br> NN1 1SY'),
(15, 'contact_email', 'admin@pitchrmt.com'),
(16, 'google_api_key', 'AIzaSyD8MLK2jUdUEmELPJXXcoA4y7azeV-NGfk'),
(17, 'default_date_time_format', 'd/m/Y H:i A'),
(18, 'currency_code', 'GBP'),
(19, 'currency_symbol', '&pound;'),
(20, 'currency_position', 'left'),
(21, 'judo_id', '100403658'),
(22, 'judo_api_token', 'rM9MgnOdvg2sw5E7'),
(23, 'judo_api_secret', '8d42450f285f832a0c34d59062e6b42677429b0a36d418f91e6d9802062e86a5'),
(24, 'judo_reference_prefix', 'PITCH'),
(25, 'judo_production', '1'),
(27, 'judo_api_sandbox_token', '2hdFclZ3IzumACTs'),
(28, 'judo_api_sandbox_secret', 'e8e2d4c6dd5b3af2071d858f1c4a443e29435ee03c281d65fe4a4e023d98b483'),
(29, 'smtp_port', '587');

-- --------------------------------------------------------

--
-- Table structure for table `website_info`
--

CREATE TABLE `website_info` (
  `id` int NOT NULL,
  `date` text COLLATE utf8mb4_general_ci NOT NULL,
  `website` text COLLATE utf8mb4_general_ci NOT NULL,
  `bug` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` text COLLATE utf8mb4_general_ci NOT NULL,
  `insert_admin` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_info`
--
ALTER TABLE `bug_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_info`
--
ALTER TABLE `website_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bug_info`
--
ALTER TABLE `bug_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `website_info`
--
ALTER TABLE `website_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
