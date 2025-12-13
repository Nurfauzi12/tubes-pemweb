-- ============================================================
-- Database: tubes-web
-- Description: Database untuk sistem RPS (Rencana Pembelajaran Semester)
-- Created: 2024-01-17
-- Last Updated: 2024-12-13
-- ============================================================

-- Set configuration
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- ============================================================
-- Database Creation
-- ============================================================
CREATE DATABASE IF NOT EXISTS `tubes-web` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_general_ci;

USE `tubes-web`;

-- ============================================================
-- Drop existing tables (in reverse order of dependencies)
-- ============================================================
DROP TABLE IF EXISTS `korelasi_cpl_cpmk`;
DROP TABLE IF EXISTS `rencana_pembelajaran`;
DROP TABLE IF EXISTS `dosen_pengampu`;
DROP TABLE IF EXISTS `cpl`;
DROP TABLE IF EXISTS `cpmk`;
DROP TABLE IF EXISTS `bahan_kajian`;
DROP TABLE IF EXISTS `mahasiswa`;
DROP TABLE IF EXISTS `matakuliah`;
DROP TABLE IF EXISTS `penyusun`;

-- ============================================================
-- MASTER TABLES (Tables without foreign key dependencies)
-- ============================================================

-- ------------------------------------------------------------
-- Table: penyusun
-- Description: Data penyusun RPS
-- Author: Rafi Khoirulloh (41122100074)
-- ------------------------------------------------------------
CREATE TABLE `penyusun` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pengembangan_rps` VARCHAR(255) NOT NULL,
  `koordinator_rumpun` VARCHAR(255) NOT NULL,
  `ka_prodi` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_pengembangan_rps` (`pengembangan_rps`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Table: matakuliah
-- Description: Data mata kuliah
-- Author: Ghania Fazila (41122100060)
-- ------------------------------------------------------------
CREATE TABLE `matakuliah` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `matakuliah` VARCHAR(255) NOT NULL,
  `kode` VARCHAR(255) NOT NULL,
  `rumpun` VARCHAR(255) NOT NULL,
  `bobot_teori` INT(11) NOT NULL DEFAULT 0,
  `bobot_praktek` INT(11) NOT NULL DEFAULT 0,
  `semester` INT(11) NOT NULL,
  `tanggal` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_kode_matakuliah` (`kode`),
  INDEX `idx_rumpun` (`rumpun`),
  INDEX `idx_semester` (`semester`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Table: mahasiswa
-- Description: Data mahasiswa
-- Author: Alshar Adam (41122100076)
-- ------------------------------------------------------------
CREATE TABLE `mahasiswa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` VARCHAR(255) NOT NULL,
  `jenis_kelamin` VARCHAR(1) NOT NULL,
  `id_prodi` INT(11) NOT NULL,
  `nim` VARCHAR(20) NOT NULL,
  `periode_masuk` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_nim` (`nim`),
  INDEX `idx_prodi` (`id_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- TRANSACTION TABLES (Tables with foreign key dependencies)
-- ============================================================

-- ------------------------------------------------------------
-- Table: bahan_kajian
-- Description: Data bahan kajian mata kuliah
-- Author: Surgana (41121100037)
-- ------------------------------------------------------------
CREATE TABLE `bahan_kajian` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(11) DEFAULT NULL,
  `id_matakuliah` INT(11) DEFAULT NULL,
  `bahan_kajian` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_penyusun` (`id_penyusun`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  CONSTRAINT `fk_bahan_kajian_penyusun` 
    FOREIGN KEY (`id_penyusun`) 
    REFERENCES `penyusun`(`id`) 
    ON DELETE SET NULL 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_bahan_kajian_matakuliah` 
    FOREIGN KEY (`id_matakuliah`) 
    REFERENCES `matakuliah`(`id`) 
    ON DELETE SET NULL 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Table: cpmk
-- Description: Capaian Pembelajaran Mata Kuliah
-- Author: Dwi Chandra Wijaya (41122100068)
-- ------------------------------------------------------------
CREATE TABLE `cpmk` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(11) NOT NULL,
  `id_matakuliah` INT(11) NOT NULL,
  `cpmk` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_penyusun` (`id_penyusun`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  CONSTRAINT `fk_cpmk_penyusun` 
    FOREIGN KEY (`id_penyusun`) 
    REFERENCES `penyusun`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_cpmk_matakuliah` 
    FOREIGN KEY (`id_matakuliah`) 
    REFERENCES `matakuliah`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Table: cpl
-- Description: Capaian Pembelajaran Lulusan
-- Author: Bisma Wirajovi Aulia (41122100061)
-- ------------------------------------------------------------
CREATE TABLE `cpl` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(11) NOT NULL,
  `id_matakuliah` INT(11) NOT NULL,
  `cpl_prodi` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_penyusun` (`id_penyusun`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  CONSTRAINT `fk_cpl_penyusun` 
    FOREIGN KEY (`id_penyusun`) 
    REFERENCES `penyusun`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_cpl_matakuliah` 
    FOREIGN KEY (`id_matakuliah`) 
    REFERENCES `matakuliah`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Table: dosen_pengampu
-- Description: Data dosen pengampu mata kuliah
-- Author: Priki (41122100055)
-- ------------------------------------------------------------
CREATE TABLE `dosen_pengampu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(11) NOT NULL,
  `id_matakuliah` INT(11) NOT NULL,
  `dosen_pengampu` VARCHAR(255) NOT NULL,
  `semester` VARCHAR(50) NOT NULL,
  `tahun_akademik` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_penyusun` (`id_penyusun`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  INDEX `idx_semester` (`semester`),
  INDEX `idx_tahun_akademik` (`tahun_akademik`),
  CONSTRAINT `fk_dosen_pengampu_penyusun` 
    FOREIGN KEY (`id_penyusun`) 
    REFERENCES `penyusun`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_dosen_pengampu_matakuliah` 
    FOREIGN KEY (`id_matakuliah`) 
    REFERENCES `matakuliah`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Table: rencana_pembelajaran
-- Description: Rencana pembelajaran per minggu
-- Author: Mochamad Fajar Nurfauzi (41122100073)
-- Note: Missing sub_cpmk table reference - assuming it will be created
-- ------------------------------------------------------------
CREATE TABLE `rencana_pembelajaran` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(11) NOT NULL,
  `id_matakuliah` INT(11) NOT NULL,
  `minggu_ke` VARCHAR(100) NOT NULL,
  `sub_cpmk` VARCHAR(255) NOT NULL,
  `penilaian_indikator` VARCHAR(255) NOT NULL,
  `penilaian_teknik` VARCHAR(255) NOT NULL,
  `bentuk_pembelajaran` VARCHAR(255) NOT NULL,
  `materi` VARCHAR(255) NOT NULL,
  `bobot_penilaian` VARCHAR(100) NOT NULL,
  `catatan` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_penyusun` (`id_penyusun`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  INDEX `idx_minggu_ke` (`minggu_ke`),
  CONSTRAINT `fk_rencana_pembelajaran_penyusun` 
    FOREIGN KEY (`id_penyusun`) 
    REFERENCES `penyusun`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_rencana_pembelajaran_matakuliah` 
    FOREIGN KEY (`id_matakuliah`) 
    REFERENCES `matakuliah`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Table: korelasi_cpl_cpmk
-- Description: Korelasi antara CPL dan CPMK
-- Author: Anggita Aulia (41122100059)
-- Note: Missing sub_cpmk table reference - assuming it will be created
-- ------------------------------------------------------------
CREATE TABLE `korelasi_cpl_cpmk` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_penyusun` INT(11) NOT NULL,
  `id_matakuliah` INT(11) NOT NULL,
  `id_sub_cpmk` INT(11) NOT NULL,
  `id_cpmk` INT(11) NOT NULL,
  `presentase` INT(11) NOT NULL,
  `bobot_penilaian` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_penyusun` (`id_penyusun`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  INDEX `idx_cpmk` (`id_cpmk`),
  CONSTRAINT `fk_korelasi_cpl_cpmk_penyusun` 
    FOREIGN KEY (`id_penyusun`) 
    REFERENCES `penyusun`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_korelasi_cpl_cpmk_matakuliah` 
    FOREIGN KEY (`id_matakuliah`) 
    REFERENCES `matakuliah`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `fk_korelasi_cpl_cpmk_cpmk` 
    FOREIGN KEY (`id_cpmk`) 
    REFERENCES `cpmk`(`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Commit transaction
-- ============================================================
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;