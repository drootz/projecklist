-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2016 at 11:45 PM
-- Server version: 5.6.23
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dracine_projecklist`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation`
--

CREATE TABLE `activation` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reason` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `text_body` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `contact_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_users`
--

CREATE TABLE `deleted_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `deleted_date` datetime NOT NULL,
  `delete_comment` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_history`
--

CREATE TABLE `email_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_previous` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_new` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `change_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `login_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projecklist`
--

CREATE TABLE `projecklist` (
  `id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `projeckt_ref` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `lastmodified_datetime` datetime NOT NULL,
  `fld_project_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_contact_primary_fn` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_contact_primary_ln` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_contact_primary_tel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eml_contact_primary_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eml_contact_primary_email_verification` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_contact_alt_fn` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_contact_alt_ln` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_contact_alt_contact_tel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eml_contact_alt_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eml_contact_alt_email_verification` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opt_familiarity` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opt_timeline` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opt_budget` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_fn` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_ln` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_coname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_area` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_billing_tel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_billing_fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_address_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_province` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_postalcode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_billing_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eml_billing_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eml_billing_email_verification` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bol_t_and_c_reviewed` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_legal` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_brand` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_tagline` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eml_info_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_info_tel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_info_fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_address_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_province` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_postalcode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_info_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_info_description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hra_hours_1` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hhm_hours_sh_1` int(10) DEFAULT NULL,
  `hhm_hours_sm_1` int(10) DEFAULT NULL,
  `hhm_hours_eh_1` int(10) DEFAULT NULL,
  `hhm_hours_em_1` int(10) DEFAULT NULL,
  `cbx_hours_closed_1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hra_hours_2` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hhm_hours_sh_2` int(10) DEFAULT NULL,
  `hhm_hours_sm_2` int(10) DEFAULT NULL,
  `hhm_hours_eh_2` int(10) DEFAULT NULL,
  `hhm_hours_em_2` int(10) DEFAULT NULL,
  `cbx_hours_closed_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hra_hours_3` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hhm_hours_sh_3` int(10) DEFAULT NULL,
  `hhm_hours_sm_3` int(10) DEFAULT NULL,
  `hhm_hours_eh_3` int(10) DEFAULT NULL,
  `hhm_hours_em_3` int(10) DEFAULT NULL,
  `cbx_hours_closed_3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hra_hours_4` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hhm_hours_sh_4` int(10) DEFAULT NULL,
  `hhm_hours_sm_4` int(10) DEFAULT NULL,
  `hhm_hours_eh_4` int(10) DEFAULT NULL,
  `hhm_hours_em_4` int(10) DEFAULT NULL,
  `cbx_hours_closed_4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hra_hours_5` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hhm_hours_sh_5` int(10) DEFAULT NULL,
  `hhm_hours_sm_5` int(10) DEFAULT NULL,
  `hhm_hours_eh_5` int(10) DEFAULT NULL,
  `hhm_hours_em_5` int(10) DEFAULT NULL,
  `cbx_hours_closed_5` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hra_hours_6` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hhm_hours_sh_6` int(10) DEFAULT NULL,
  `hhm_hours_sm_6` int(10) DEFAULT NULL,
  `hhm_hours_eh_6` int(10) DEFAULT NULL,
  `hhm_hours_em_6` int(10) DEFAULT NULL,
  `cbx_hours_closed_6` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hra_hours_7` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hhm_hours_sh_7` int(10) DEFAULT NULL,
  `hhm_hours_sm_7` int(10) DEFAULT NULL,
  `hhm_hours_eh_7` int(10) DEFAULT NULL,
  `hhm_hours_em_7` int(10) DEFAULT NULL,
  `cbx_hours_closed_7` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_hours_holidays` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_product_1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_product_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_product_3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rdo_existing_asset` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_asset_logo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_asset_img` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_asset_audio` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_asset_video` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_asset_docs` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_asset_othercomments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_content_copywriting` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_content_graphicdesign` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_content_photography` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_content_none` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_content_othercomments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_forum` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_forum` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_login` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_login` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_chart` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_chart` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_catalog` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_catalog` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_comparechart` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_comparechart` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_form` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_form` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_advancedform` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_advancedform` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_animation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_animation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_search` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_search` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_advancedsearch` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_advancedsearch` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_social` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_social` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_blog` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_blog` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_timeline` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_timeline` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_newsletter` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_newsletter` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_calculator` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_calculator` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_feature_otherdetails` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_feature_otherdetails` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_site_goal_1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_site_goal_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_site_goal_3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_site_goal_4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_call` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_mail` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_fillform` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_socialshare` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_subscribeemail` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_article` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_searchinfo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_action_purchase` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_action_othercomments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_adjective_1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_adjective_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_adjective_3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_age_kids` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_age_teen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_age_young` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_age_adult` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_age_senior` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_geo_local` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_geo_city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_geo_province` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_geo_country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_geo_world` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_education_hschool` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_education_college` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_education_undergrad` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_education_grad` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_education_none` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_job_salaried` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_job_self` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_job_professional` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_job_entrepreneur` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_job_unemployed` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_wealth_below` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_wealth_average` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_wealth_above` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_gender_man` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_audience_gender_woman` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_audience_description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_design_colour` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_design_theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_design_style` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_design_brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_design_othercomments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_competitor_1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_competitor_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_competitor_3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_competitor_4` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_competitor_5` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_competitor_6` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_1_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_1_like` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_1_improve` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_2_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_2_like` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_2_improve` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_3_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_3_like` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_3_improve` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_4_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_4_like` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_like_4_improve` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_1_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_1_dislike` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_2_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_2_dislike` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_3_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_3_dislike` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_4_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_dislike_4_dislike` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rdo_remark` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_definite_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rdo_architecture_layout` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_architecture_hd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_architecture_legacysupport` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_architecture_othercomments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_accessibility_eyesight` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_accessibility_mobility` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_accessibility_readinglevel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_accessibility_othercomments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_tool_google` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_tool_bing` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_tool_yandex` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_url_optimization` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_structured_data` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_localization` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_mobile_meta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_opengraph_fb` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_opengraph_tw` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_opengraph_gplus` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_opengraph_linkedin` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_opengraph_pinterest` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cbx_seo_analytic` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_domain_1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_domain_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_domain_3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_domain_4` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_domain_5` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fld_domain_6` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rdo_requirehosting` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rdo_domain_mailmatch` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_maintenance_details` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_future_comments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_additional_comments` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `psw_reset_date` date DEFAULT NULL,
  `psw_attempt` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `psw_unlock_datetime` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `last_loggedin_date` datetime NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `project_count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_errors`
--

CREATE TABLE `user_errors` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `err_num` int(10) UNSIGNED NOT NULL,
  `err_file` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `err_string` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `err_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation`
--
ALTER TABLE `activation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_users`
--
ALTER TABLE `deleted_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `email_history`
--
ALTER TABLE `email_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projecklist`
--
ALTER TABLE `projecklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `user_errors`
--
ALTER TABLE `user_errors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation`
--
ALTER TABLE `activation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deleted_users`
--
ALTER TABLE `deleted_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_history`
--
ALTER TABLE `email_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projecklist`
--
ALTER TABLE `projecklist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_errors`
--
ALTER TABLE `user_errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
