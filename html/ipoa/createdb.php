<?php
//any other function before redirection
include "conn.php";
date_default_timezone_set("Africa/Nairobi");
$query="CREATE TABLE `sm_main_complaint` (
  `complaintid` varchar(30) COLLATE latin1_general_ci  NOT NULL,
  `complaint` text COLLATE latin1_general_ci  NOT NULL,
  `complainant` text COLLATE latin1_general_ci  NOT NULL,
  `againist` text COLLATE latin1_general_ci  NOT NULL,
  `witnesses` text COLLATE latin1_general_ci  NOT NULL,
  `natureid` varchar(255) COLLATE latin1_general_ci  NOT NULL,
  `incident location` text COLLATE latin1_general_ci  NOT NULL,
  `incident date` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `date reported` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `approved for investigation` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `approval date` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `openned for investigation` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `openning date` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `concluded` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `date concluded` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `closed` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `date closed` varchar(50) COLLATE latin1_general_ci  NOT NULL,
  `uneditable` varchar(20) COLLATE latin1_general_ci  NOT NULL,
  `evidence` text COLLATE latin1_general_ci  NOT NULL,
  `Casefile No` varchar(255) COLLATE latin1_general_ci  NOT NULL,
  `Case No` varchar(255) COLLATE latin1_general_ci  NOT NULL
) ;



CREATE TABLE `sm_main_complaintnature` (
  `natureid` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `naturetype` text COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL
) ;



CREATE TABLE `sm_main_county` (
  `countyid` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `county` text COLLATE latin1_general_ci NOT NULL
) ;



CREATE TABLE `sm_main_evidence` (
  `evidenceid` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `evidence` text COLLATE latin1_general_ci NOT NULL,
  `path` text COLLATE latin1_general_ci NOT NULL,
  `isimg` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `date uploaded` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `uploadby` varchar(50)  COLLATE latin1_general_ci NOT NULL
) ;



CREATE TABLE `sm_main_investigation` (
  `investigationid` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `complaintid` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `investigator` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `dateassigned` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `findings` text COLLATE latin1_general_ci NOT NULL,
  `recommendation` text COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `conclusion` text COLLATE latin1_general_ci NOT NULL,
  `date concluded` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `closed by` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `date closed` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `action` text COLLATE latin1_general_ci NOT NULL
) ;



CREATE TABLE `sm_main_persons` (
  `personsid` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `ID No` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `surname` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `address` text COLLATE latin1_general_ci NOT NULL,
  `mobile` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `county` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `ward` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `gender` varchar(50)  COLLATE latin1_general_ci NOT NULL,
  `officer` varchar(20)  COLLATE latin1_general_ci NOT NULL,
  `job details` text COLLATE latin1_general_ci NOT NULL,
  `station` text COLLATE latin1_general_ci NOT NULL,
  `rank` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `pf no` varchar(255)  COLLATE latin1_general_ci NOT NULL,
  `incustody` varchar(10)  COLLATE latin1_general_ci NOT NULL,
  `custodystation` text COLLATE latin1_general_ci NOT NULL,
  `photo` text COLLATE latin1_general_ci NOT NULL
) ;



CREATE TABLE `sm_main_ptown` (
  `ptownid` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `town` text COLLATE latin1_general_ci NOT NULL
) ;



CREATE TABLE `sm_main_pward` (
  `pwardid` varchar(30)  COLLATE latin1_general_ci NOT NULL,
  `ward` text COLLATE latin1_general_ci NOT NULL,
  `County` varchar(255)  COLLATE latin1_general_ci NOT NULL
) ;



CREATE TABLE `sm_main_user` (
  `userid` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `names` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `scope` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Faculty` text COLLATE latin1_general_ci NOT NULL,
  `Status` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `MacAddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `MacOptions` varchar(50) COLLATE latin1_general_ci NOT NULL
);



CREATE TABLE `staff` (
  `staffid` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `names` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `contacts` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `office` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `photo` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `clearance` text COLLATE latin1_general_ci NOT NULL,
  `noclearance` text COLLATE latin1_general_ci NOT NULL,
  `level` text COLLATE latin1_general_ci NOT NULL
) ;
"; 
mysql_query($query);
?>