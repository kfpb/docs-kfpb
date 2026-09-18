-- =======================================================================
-- MIGRASI DATABASE: Manajemen Akun PKPA 30 Hari, Device Tracking & Audit Trail
-- Sistem: DOCS KFPB (Kimia Farma Plant Banjaran)
-- =======================================================================

-- 1. Penambahan kolom kontrol PKPA pada tabel `users`
ALTER TABLE `users`
  ADD COLUMN `is_pkpa` ENUM('N','Y') NOT NULL DEFAULT 'N' AFTER `cPass`,
  ADD COLUMN `tgl_mulai` DATE NULL AFTER `is_pkpa`,
  ADD COLUMN `tgl_expired` DATE NULL AFTER `tgl_mulai`,
  ADD COLUMN `status_akun` ENUM('aktif','expired','dibekukan') NOT NULL DEFAULT 'aktif' AFTER `tgl_expired`;

-- 2. Pembuatan tabel pelacakan perangkat PC yang mengakses
CREATE TABLE IF NOT EXISTS `user_registered_devices` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL DEFAULT 0,
  `username` VARCHAR(50) NOT NULL,
  `device_token` VARCHAR(64) NOT NULL,
  `device_sequence` INT(11) NOT NULL DEFAULT 1,
  `ip_address` VARCHAR(100) NULL,
  `user_agent` TEXT NULL,
  `first_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login_count` INT(11) NOT NULL DEFAULT 1,
  `status` ENUM('aktif','diblokir') NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_device` (`username`, `device_token`),
  KEY `idx_token` (`device_token`),
  KEY `idx_user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 3. Pembuatan tabel Audit Trail Terpusat (Kepatuhan CPOB / Data Integrity)
CREATE TABLE IF NOT EXISTS `log_audit_trail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `nama_user` VARCHAR(150) NOT NULL,
  `kategori` VARCHAR(50) NOT NULL, -- LOGIN, LOGOUT, VIEW_DOKUMEN, ANOMALI_DEVICE, EXPIRED_ATTEMPT
  `detail_kegiatan` TEXT NULL,
  `kode_dokumen` VARCHAR(100) NULL,
  `judul_dokumen` VARCHAR(255) NULL,
  `ip_address` VARCHAR(100) NULL,
  `device_token` VARCHAR(64) NULL,
  `device_sequence` INT(11) NULL,
  `status_anomali` ENUM('NORMAL','PERINGATAN','BAHAYA') NOT NULL DEFAULT 'NORMAL',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_time` (`username`, `created_at`),
  KEY `idx_kategori` (`kategori`),
  KEY `idx_dok` (`kode_dokumen`),
  KEY `idx_anomali` (`status_anomali`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
