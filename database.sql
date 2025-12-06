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