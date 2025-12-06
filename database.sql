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
CREATE TABLE `penyusun` (
  `id` int(11) NOT NULL,
  `pengembangan_rps` varchar(255) NOT NULL,
  `koordinator_rumpun` varchar(255) NOT NULL,
  `ka_prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: Rencana Pembelajaran - Mochamad Fajar Nurfauzi (41122100073)
-- --------------------------------------------------------
CREATE TABLE `rencana_pembelajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` int(11) NOT NULL,
  `id_matakuliah` int(11) NOT NULL,
  `minggu_ke` varchar(100) NOT NULL,
  `sub_cpmk` varchar(255) NOT NULL,
  `penilaian_indikator` varchar(255) NOT NULL,
  `penilaian_teknik` varchar(255) NOT NULL,
  `bentuk_pembelajaran` varchar(255) NOT NULL,
  `bobot_penilaian` varchar(100) NOT NULL,
  `catatan` varchar(255),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_penyusun`) REFERENCES `penyusun`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: Bahan Kajian - Surgana (41121100037)
-- --------------------------------------------------------

CREATE TABLE `bahan_kajian` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_penyusun` INT NULL,
    `id_matakuliah` INT NULL,
    `bahan_kajian` TEXT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT fk_bk_penyusun
        FOREIGN KEY (`id_penyusun`) REFERENCES `penyusun`(`id`)
          ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: CPMK - Dwi Chandra Wijaya (41122100068)
-- --------------------------------------------------------
CREATE TABLE `cpmk` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(20) NOT NULL,
  `id_matakuliah` INT(20) NOT NULL,
  `cpmk` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  -- --------------------------------------------------------
  -- Table: Korelasi CPL CPMK - Anggita Aulia (41122100059)
  -- --------------------------------------------------------
  CREATE TABLE `korelasi_cpl_cpmk` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_penyusun` int(11) NOT NULL,
    `id_matakuliah` int(11) NOT NULL,
    `id_sub_cpmk` int(11) NOT NULL,
    `id_cpmk` int(11) NOT NULL,
    `presentase` int(11) NOT NULL,
    `bobot_penilaian` int(11) NOT NULL,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_penyusun`) REFERENCES `penyusun`(`id`),
    FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah`(`id`),
    FOREIGN KEY (`id_sub_cpmk`) REFERENCES `sub_cpmk`(`id`),
    FOREIGN KEY (`id_cpmk`) REFERENCES `cpmk`(`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: Mahasiswa - Alshar Adam (41122100076)
-- --------------------------------------------------------

CREATE TABLE mahasiswa (
    id INT PRIMARY KEY,
    nama_mahasiswa varchar(255) NOT NULL,
    jenis_kelamin varchar(1) NOT NULL,
    id_prodi int(11) NOT NULL,
    nim int(11) NOT NULL,
    periode_masuk varchar(255) NOT NULL
);

-- --------------------------------------------------------
-- Table: CPL - Bisma Wirajovi Aulia (41122100061)
-- --------------------------------------------------------

CREATE TABLE `CPL` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(11) NOT NULL,
  `id_matakuliah` INT(11) NOT NULL,
  `cpl_prodi` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_penyusun`) REFERENCES `penyusun`(`id`),
  FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
