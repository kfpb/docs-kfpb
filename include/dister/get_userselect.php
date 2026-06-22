<?php
/**
 * include/dister/get_userselect.php
 * Versi mysql_* (drop-in). Mengembalikan daftar users yang lolos blacklist + filter jabatan opsional.
 */
header('Content-Type: application/json; charset=utf-8');
include "../../config/koneksi.php";

// Ambil filter dari client (opsional)
$jabatan_filter = isset($_POST['jabatan_filter']) ? strtolower(trim($_POST['jabatan_filter'])) : "";

/**
 * RULE:
 * BLACKLIST (case-insensitive):
 * - Rian Ramdani (apapun jabatan)
 * - SPV/Supervisor Fungsional
 * - Asisten Manager K3L
 * - Asman Fungsional Pemastian Mutu
 * - SPV/Supervisor Perizinan
 * - Pengolahan Air KECUALI jika nama mengandung "jaenudin"
 *
 * WHITELIST (prioritas lolos):
 * - Nama mengandung "dewi" DAN ("kurniasih" ATAU "sari")
 * ATAU jabatan mengandung "pengawasan proses" DAN "pengemasan"
 */
$blackRules = "
    LOWER(TRIM(cNama)) = 'rian ramdani'
    OR LOWER(TRIM(cJabatan)) = 'asisten manager k3l'
    OR LOWER(TRIM(cJabatan)) = 'asman fungsional pemastian mutu'
    OR (LOWER(cJabatan) LIKE '%fungsional%' AND (LOWER(cJabatan) LIKE '%spv%' OR LOWER(cJabatan) LIKE '%supervisor%'))
    OR ((LOWER(cJabatan) LIKE '%perizinan%') AND (LOWER(cJabatan) LIKE '%spv%' OR LOWER(cJabatan) LIKE '%supervisor%'))
    OR (LOWER(cJabatan) LIKE '%pengolahan air%' AND LOWER(TRIM(cNama)) NOT LIKE '%jaenudin%')
";

$whiteRules = "
    (
      (LOWER(cNama) LIKE '%dewi%' AND (LOWER(cNama) LIKE '%kurniasih%' OR LOWER(cNama) LIKE '%sari%'))
      OR (LOWER(cJabatan) LIKE '%pengawasan proses%' AND LOWER(cJabatan) LIKE '%pengemasan%')
    )
";

// Mapping kata kunci filter jabatan → beberapa sinonim
switch ($jabatan_filter) {
  case '':
    $filterCond = "1";
    break;

  case 'gabungan':
    // ASMAN + SPV (+varian ejaan)
    $filterCond = "(
      LOWER(cJabatan) LIKE '%asman%' OR
      LOWER(cJabatan) LIKE '%asisten%' OR
      LOWER(cJabatan) LIKE '%spv%' OR
      LOWER(cJabatan) LIKE '%visor%' OR
      LOWER(cJabatan) LIKE '%supervisor%'
    )";
    break;

  // --- PERUBAHAN DISINI: Menangani opsi baru ---
  case 'gabungan_mgr':
    // ASMAN + SPV + MANAGER
    $filterCond = "(
      LOWER(cJabatan) LIKE '%asman%' OR
      LOWER(cJabatan) LIKE '%asisten%' OR
      LOWER(cJabatan) LIKE '%spv%' OR
      LOWER(cJabatan) LIKE '%visor%' OR
      LOWER(cJabatan) LIKE '%supervisor%' OR
      LOWER(cJabatan) LIKE '%manager%' OR
      LOWER(cJabatan) LIKE '%manajer%'
    )";
    break;
  // --------------------------------------------

  case 'visor':
  case 'spv':
    // Tangkap semua variasi SPV
    $filterCond = "(
      LOWER(cJabatan) LIKE '%spv%' OR
      LOWER(cJabatan) LIKE '%visor%' OR
      LOWER(cJabatan) LIKE '%supervisor%'
    )";
    break;

  case 'asisten':
  case 'asman':
    // Tangkap semua variasi ASMAN
    $filterCond = "(
      LOWER(cJabatan) LIKE '%asman%' OR
      LOWER(cJabatan) LIKE '%asisten%'
    )";
    break;
    
  case 'manager':
  case 'manajer':
    // Tangkap semua variasi Manager/Manajer
    $filterCond = "(
      LOWER(cJabatan) LIKE '%manager%' OR
      LOWER(cJabatan) LIKE '%manajer%'
    )";
    break;

  default:
    $safe = mysql_real_escape_string($jabatan_filter);
    $filterCond = "LOWER(cJabatan) LIKE '%$safe%'";
    break;
}

// Query final: lolos jika TIDAK masuk blacklist ATAU masuk whitelist
$sql = "
  SELECT cId, cNama, cJabatan
  FROM users
  WHERE ( NOT ( $blackRules ) OR ( $whiteRules ) )
    AND ($filterCond)
  ORDER BY cJabatan ASC, cNama ASC
";

$q = mysql_query($sql);
if (!$q) {
  http_response_code(500);
  echo json_encode([
    "ok" => false,
    "error" => "DB error",
    "message" => mysql_error()
  ]);
  exit;
}

$data = [];
while ($row = mysql_fetch_assoc($q)) {
  if (!isset($row['cNama']) || trim($row['cNama']) === '') continue;
  if (!isset($row['cJabatan']) || trim($row['cJabatan']) === '') continue;

  $data[] = [
    "cId"      => isset($row['cId']) ? (string)$row['cId'] : "",
    "cNama"    => $row['cNama'],
    "cJabatan" => $row['cJabatan']
  ];
}

echo json_encode([
  "ok"    => true,
  "count" => count($data),
  "data"  => $data
], JSON_UNESCAPED_UNICODE);
?>