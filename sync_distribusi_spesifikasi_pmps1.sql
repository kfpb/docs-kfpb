-- ==============================================================================
-- Script Sinkronisasi Distribusi Dokumen Spesifikasi untuk Akun pmps1
-- Sistem: DOCS KFPB (Document Control Assistance System)
-- ==============================================================================
-- Fungsi:
-- Memasukkan akun 'pmps1' (Pelaksana PMP - Stabilitas) ke tabel penerima distribusi (`disin`)
-- untuk seluruh dokumen spesifikasi (kode berawalan 'S-' atau judul mengandung 'spesifikasi')
-- yang berstatus aktif (distatus = 'Y') yang belum terdaftar.
-- ==============================================================================

INSERT INTO `disin` (`cId`, `suid`, `copyke`, `distatus`, `tgl_baca`, `jml_copy`)
SELECT 
    u.cId,
    d.suid,
    COALESCE((SELECT MAX(di.copyke) + 1 FROM `disin` di WHERE di.suid = d.suid), 1) AS copyke,
    'N' AS distatus,
    NULL AS tgl_baca,
    0 AS jml_copy
FROM `dinter` d
JOIN `users` u ON (u.cUser = 'pmps1')
WHERE (d.dikodok LIKE 'S-%' OR d.dijudok LIKE '%spesifikasi%' OR d.dijudok LIKE '%Spesifikasi%')
  AND d.distatus = 'Y'
  AND NOT EXISTS (
      SELECT 1 FROM `disin` di WHERE di.suid = d.suid AND di.cId = u.cId
  );
