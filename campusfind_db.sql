-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Okt 2026 pada 01.50
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campusfind_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'fa-box',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `icon_class`, `created_at`) VALUES
(1, 'Dokumen/KTM', 'fa-id-card', '2026-10-20 13:23:59'),
(2, 'Elektronik', 'fa-laptop', '2026-10-20 13:23:59'),
(3, 'Kunci/Aksesori', 'fa-key', '2026-10-20 13:23:59'),
(4, 'Tas/Pakaian', 'fa-shirt', '2026-10-20 13:23:59'),
(5, 'Lainnya', 'fa-box', '2026-10-20 13:23:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `item_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporter_id` int NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Hilang','Ditemukan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incident_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Hilang','Ditemukan','Diklaim') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hilang',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`item_id`, `reporter_id`, `category_id`, `title`, `type`, `location`, `incident_date`, `description`, `status`, `image_url`, `created_at`, `updated_at`) VALUES
('LF-2026-001', 1, 1, 'KTM Teknik Informatika (a.n. Rian Ardianto)', 'Ditemukan', 'Gedung MIPA Lt. 2 (Ruang 204)', '2026-03-28', 'Tercecer di meja baris ketiga. KTM dilengkapi gantungan tali hijau motif kampus.', 'Ditemukan', NULL, '2026-10-20 13:24:01', '2026-10-20 13:24:01'),
('LF-2026-002', 1, 3, 'Kunci Motor Honda + Smart Key', 'Ditemukan', 'Kantin Parkir Barat', '2026-03-29', 'Gantungan pita hitam. Terjatuh di area bangku makan outdoor #04.', 'Ditemukan', NULL, '2026-10-20 13:24:01', '2026-10-20 13:24:01'),
('LF-2026-003', 1, 2, 'AirPods Pro Gen 2 Case Transparan', 'Ditemukan', 'Perpustakaan Pusat Lt. 3', '2026-03-27', 'Tertinggal di kubikel belajar no 12. Case menggunakan silikon transparan.', 'Diklaim', NULL, '2026-10-20 13:24:01', '2026-10-20 13:24:01'),
('LF-2026-004', 4, 4, 'Jaket Parka Hitam Size L', 'Hilang', 'Auditorium Utama Kampus', '2026-03-29', 'Hilang saat seminar. Terdapat pin logo himpunan mahasiswa di dada kiri.', 'Hilang', NULL, '2026-10-20 13:24:01', '2026-10-20 13:24:01'),
('LF-2026-005', 3, 1, 'Dompet Kulit Cokelat Eiger', 'Hilang', 'Lapangan Basket Outdoor', '2026-03-30', 'Berisi SIM A, KTP, dan kartu debit. Terjatuh di tribun penonton.', 'Hilang', NULL, '2026-10-20 13:24:01', '2026-10-20 13:24:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_claims`
--

CREATE TABLE `item_claims` (
  `claim_id` int NOT NULL,
  `item_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `claimant_id` int NOT NULL,
  `verified_by` int DEFAULT NULL,
  `claim_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `proof_notes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Pending','Approved','Rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `item_claims`
--

INSERT INTO `item_claims` (`claim_id`, `item_id`, `claimant_id`, `verified_by`, `claim_date`, `proof_notes`, `status`) VALUES
(1, 'LF-2026-003', 2, 1, '2026-10-20 20:24:01', 'Telah dicocokkan dengan nomor seri pada kotak dus AirPods dan verifikasi identitas KTM.', 'Approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `nim_nip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('student','staff','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'student',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `nim_nip`, `full_name`, `phone_number`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'SAT-001', 'Pak Ahmad (Satpam MIPA)', '081234560001', 'ahmad.satpam@campus.ac.id', 'admin', '2026-10-20 13:24:01', '2026-10-20 13:24:01'),
(2, '21010190', 'Rian Ardianto', '081234560002', 'rian.ardianto@student.ac.id', 'student', '2026-10-20 13:24:01', '2026-10-20 13:24:01'),
(3, '21010191', 'Fikri Permana', '081234560003', 'fikri@student.ac.id', 'student', '2026-10-20 13:24:01', '2026-10-20 13:24:01'),
(4, '21010192', 'Dina Kurnia', '081234560004', 'dina@student.ac.id', 'student', '2026-10-20 13:24:01', '2026-10-20 13:24:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_items_reporter` (`reporter_id`),
  ADD KEY `idx_items_search` (`title`,`location`),
  ADD KEY `idx_items_filter` (`category_id`,`type`,`status`,`incident_date`);

--
-- Indeks untuk tabel `item_claims`
--
ALTER TABLE `item_claims`
  ADD PRIMARY KEY (`claim_id`),
  ADD KEY `fk_claims_item` (`item_id`),
  ADD KEY `fk_claims_claimant` (`claimant_id`),
  ADD KEY `fk_claims_verifier` (`verified_by`),
  ADD KEY `idx_claims_status` (`status`,`claim_date`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `nim_nip` (`nim_nip`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `item_claims`
--
ALTER TABLE `item_claims`
  MODIFY `claim_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_items_reporter` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item_claims`
--
ALTER TABLE `item_claims`
  ADD CONSTRAINT `fk_claims_claimant` FOREIGN KEY (`claimant_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_claims_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_claims_verifier` FOREIGN KEY (`verified_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
