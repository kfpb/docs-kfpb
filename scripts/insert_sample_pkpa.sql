-- =====================================================================
-- SQL INSERT: Akun Contoh Mahasiswa PKPA untuk Sistem DOCS KFPB
-- Masa Aktif: 30 Hari sejak dibuat
-- =====================================================================
-- Kredensial Default:
-- Username     : pkpa_demo
-- Password     : pkpa12345 (MD5: 1d8350eb9dd0d84f88e1762c2ee032fa)
-- Nama         : Mahasiswa PKPA Farmasi (Demo)
-- Jabatan      : Mahasiswa PKPA
-- Masa Aktif   : 30 Hari dari tanggal eksekusi (CURDATE() s.d CURDATE() + 30)
-- Atasan       : 1 (Administrator / Supervisor Sistem Dokumentasi)
-- Bagian       : QA
-- Level        : 9 (Pelaksana)
-- =====================================================================

INSERT INTO `users` (
    `cIdjab`,
    `cUser`,
    `cNama`,
    `cJabatan`,
    `cAtasan`,
    `cAudit`,
    `cAccatasan`,
    `cTelp`,
    `cEmail`,
    `cEmail2`,
    `cFoto`,
    `cPass`,
    `is_pkpa`,
    `tgl_mulai`,
    `tgl_expired`,
    `status_akun`,
    `cSession`,
    `idj`,
    `bagian`,
    `bagian2`,
    `level`,
    `delegasi`
) VALUES (
    'PKPA',
    'pkpa_demo',
    'Mahasiswa PKPA Farmasi (Demo)',
    'Mahasiswa PKPA - Pemastian Mutu',
    '1',
    'N',
    'T',
    '08123456789',
    'pkpa.demo@kimiafarma.co.id',
    '',
    '',
    MD5('pkpa12345'),
    'Y',
    CURDATE(),
    DATE_ADD(CURDATE(), INTERVAL 30 DAY),
    'aktif',
    '',
    9,
    'QA',
    '',
    '',
    '0'
) ON DUPLICATE KEY UPDATE
    `cNama`       = VALUES(`cNama`),
    `cJabatan`    = VALUES(`cJabatan`),
    `cPass`       = VALUES(`cPass`),
    `is_pkpa`     = VALUES(`is_pkpa`),
    `tgl_mulai`   = VALUES(`tgl_mulai`),
    `tgl_expired` = VALUES(`tgl_expired`),
    `status_akun` = VALUES(`status_akun`);
