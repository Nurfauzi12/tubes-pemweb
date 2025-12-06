-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2024 pada 02.59
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes-web`
--
CREATE DATABASE IF NOT EXISTS `tubes-web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tubes-web`;


-- --------------------------------------------------------
-- Table: Penyusun - Rafi Khoirulloh (41122100074)
-- --------------------------------------------------------
CREATE TABLE `Penyusun` (
  `id` int(11) NOT NULL,
  `pengembangan_rps` varchar(255) NOT NULL,
  `koordinator_rumpun` varchar(255) NOT NULL,
  `ka_prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: Rencana Pembelajaran - Mochamad Fajar Nurfauzi (41122100073)
-- --------------------------------------------------------

CREATE TABLE `rencana_pembelajaran` (
  `id` int(11) NOT NULL,
  `id_penyusun` varchar(100) NOT NULL,
  `id_matakuliah` year(4) NOT NULL,
  `minggu_ke` varchar(100) NOT NULL,
  `sub_cpmk` varchar(100) NOT NULL,
  `penilaian_indikator` varchar(100) NOT NULL,
  `penilaian_teknik` varchar(100) NOT NULL,
  `bentuk_pembelajaran` varchar(100) NOT NULL,
  `bobot_penilaian` varchar(100) NOT NULL,
  `catatan` varchar(100) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: CPMK - Mochamad Dwi Chandra Wijaya (41122100068)
-- --------------------------------------------------------

CREATE TABLE `cpmk` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` VARCHAR(100) NOT NULL,
  `id_matakuliah` VARCHAR(100) NOT NULL,
  `cpmk` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
