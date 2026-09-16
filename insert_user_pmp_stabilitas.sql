-- =====================================================================
-- SQL INSERT: Akun Pelaksana PMP - Stabilitas untuk sistem DOCS KFPB
-- =====================================================================
-- Keterangan:
-- cId menggunakan AUTO_INCREMENT secara otomatis oleh database MySQL.
-- Sistem PHP DOCS KFPB sudah disesuaikan untuk mengenali user ini baik
-- melalui cId maupun username (cUser = 'pmps1').
--
-- Kredensial Default:
-- Username : pmps1
-- Password : stabilitas123 (MD5: 02816f1a9236750cc52cbfd976077ff6)
-- Atasan   : 9 (Sofia Susilawati - Supervisor Pemeriksaan Stabilitas & Contoh Pertinggal)
-- Bagian   : QC (Pengawasan Mutu)
-- Level    : 9 (Pelaksana)
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
    `cSession`,
    `idj`,
    `bagian`,
    `bagian2`,
    `level`,
    `delegasi`
) VALUES (
    'PMP',
    'pmps1',
    'Pelaksana PMP - Stabilitas',
    'Pelaksana PMP - Stabilitas',
    '9',
    'N',
    'N',
    '',
    'pmp.stabilitas@kimiafarma.co.id',
    '',
    '',
    MD5('stabilitas123'),
    '',
    9,
    'QC',
    '',
    '',
    '0'
) ON DUPLICATE KEY UPDATE
    `cIdjab`     = VALUES(`cIdjab`),
    `cNama`      = VALUES(`cNama`),
    `cJabatan`   = VALUES(`cJabatan`),
    `cAtasan`    = VALUES(`cAtasan`),
    `cPass`      = VALUES(`cPass`),
    `idj`        = VALUES(`idj`),
    `bagian`     = VALUES(`bagian`);
