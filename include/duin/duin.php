<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">Usulan Dokumen</div>
</div>
<div class="block-content collapse in">
<div class="span12">

<?php
if($_GET['act']=="tambah"){
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/y");
$tgl			 = date("d-m-y");
$tgl1			 = date("Y-m-d");
$tgl3			 = date("d-M-Y");
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Usulan Dokumen</legend>

    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker span6" id="tgl" type="hidden" name="tgl" value="<?php echo $tgl1 ?>" required="required" ><?php  echo $tgl3; ?></div>
    </div>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059){
	?>
    
  <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select span6" name="pengusul2">
            	<option>Pilih Pengusul</option>
   	
            <?php
				$cv = mysql_query("SELECT cId, cNama, cIdjab, cJabatan FROM users ORDER BY cNama");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}

			
			?>
           	</select>
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
        <input type=hidden name=kepada value=1><b>Dokumentasi</b>
        </div> 
    </div>
	<? }
	else {
    echo"<input type=hidden name=kepada value=2>";
	?>
	 <!--<div class="control-group">-->
		<!--<label class="control-label" for="tgl">Tanggal Usulan</label>-->
  <!--      <div class="controls"> <?  //echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>-->
  <!--  </div>-->
    <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul2" class="chzn-select span6" name="pengusul2">
            	<?
				$e = mysql_fetch_array(mysql_query("SELECT cId, cNama, cAtasan FROM users WHERE cId='$_SESSION[atasan]'"));	
				echo "
				<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>";
         ?> 
           	</select>
        </div> 
    </div>
	<? } 
	echo"<input type=hidden name=pengusul value=$_SESSION[cv]>";
	?>	
	<?php //$tambahduin = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE suid='$_GET[id]' OR dikodok='$_GET[id]'")); 
	    $tambahduin = '';
	?>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan <span style="color:red">*</span></label>
        <div class="controls">
          	 <select id="jenisud" class="chzn-select span6" name="jenisud" required>
            	<option value=''><strong>Pilih Jenis Usulan (Wajib pilih !)</strong></option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
				<option value=3>Usulan Penghapusan Dokumen</option>
           	</select>
        </div> 
	</div>
  <!--<div class="control-group">-->
		<!--<label class="control-label" for="cc">Nomor CC</label>-->
  <!--      <div class="controls"><input type="text" name="uccnmr" value='<? //echo"$_GET[id2]"; ?>' minlength="14" class="input-large span6"> -->
  <!--      <br><small>(Masukkan 14 Karakter. Contoh : CC-12-22-11019)</small></div>-->
  <!--  </div>-->
    <!--tidak ada di user biasa, hanya ada di tim cc. no cc-->
  <div class="control-group">
		<label class="control-label" for="udket">Judul Usulan Perubahan /CC</label>
        <div class="controls"><input type="text" name="udket" value='<? echo"$_GET[udket]"; ?>' class="input-large span6"> <br>
        <small>(Lihat Judul Usulan Perubahan di Form Monitoring CC)</small>
        </div>
    </div>
  <div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input type="text" name="ukodok" value='<?=$tambahduin[dikodok];?>' class="input-large span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input type="text" name="revisi" value='<?=$tambahduin[direv];?>' class="input-small span6"><br>
        <small>(Kosongkan jika Usulan Dok. Baru)</small></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input type="text" name="ujudok" value='<?=$tambahduin[dijudok];?>' class="input-xxlarge span6" ></div>
    </div>
	
    <!--<div class="control-group">-->
    <!--	<label class="control-label" for="ket">Alasan/ Ringkasan/<br>Isi Usulan<br> (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>-->
    <!--    <div class="controls">-->
				<!--<textarea name="udket" id="editor">-->
				    
<!--				No. CC = <? //echo"$_GET[id2]"; ?>-->
<!--				<p><b>Uraian Usulan :</b><br>-->
<!--				1. Bisa pakai konsep file lampiran (attachment)<br>-->
<!--				2. Bisa pakai tabel dibawah ini jika usulan perubahan dokumen<br>-->
<!--				3. Atau hapus tabel dan menggunakan tulisan bebas, copy paste dll</p>-->
<!--<table border="1" cellpadding="1" cellspacing="1" width="100%">-->
<!--	<tbody>-->
<!--		<tr>-->
<!--			<td><b>No</b></td>-->
<!--			<td><b>Halaman</b></td>-->
<!--			<td><b>Sebelum</b></td>-->
<!--			<td><b>Revisi</b></td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--			<td>&nbsp;</td>-->
<!--		</tr>-->
<!--	</tbody>-->
<!--</table>-->
<!--<br>-->
<!--<p><b>Penerima Distribusi Dokumen :</b> (Jika Usulan Baru Wajib diisi, jika Usulan Perubahan apabila berubah)</p>-->
<!--1.<br>-->
<!--2.<br>-->

<!--<p><b>Dokumen yang terkait :</b> </p>-->
<!--1.<br>-->
<!--2.<br>	-->
		
				
				<!--</textarea>-->
    <!--    </div>-->
    <!--</div>-->
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen <span style="color: red;">*</span></label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 150 MB<br>
        	<small>(Usulan Penghapusan Dokumen Tidak wajib melampirkan dokumen)</small>
        </div>
    </div>
    <fieldset>
  <legend>List Penerima Dokumen Terkendali <span style="color:red; font-size:16px;">* (Wajib Diisi)</span></legend>

  <div class="alert alert-error" style="background-color: #f2dede; color: #b94a48; border: 1px solid #eed3d7; padding: 10px; margin-bottom: 15px;">
    <strong>PERHATIAN PEMBUAT DOKUMEN:</strong><br>
    Wajib isi daftar penerima ini untuk <b>Usulan Dokumen Baru</b> maupun <b>Usulan Perubahan Dokumen</b>.
    <br>(Pastikan isi di awal). Bila tidak diisi, proses akan terhambat.
  </div>

  <div class="row-fluid" style="margin-bottom:8px">
    <div class="span2">
      <label for="jabatan_filter" class="control-label">Filter Jabatan:</label>
    </div>
    <div class="span4">
      <select id="jabatan_filter" class="chzn-select" data-placeholder="Pilih jabatan...">
        <option value="">--Pilih Jabatan Penerima--</option>
        <option value="asisten">ASMAN</option>
        <option value="visor">SPV</option>
        <option value="gabungan">Asman + SPV</option>
        <option value="gabungan_mgr">Asman + SPV + Manager</option>
      </select>
      <small>(Silakan tambahkan atau hapus penerima setelah memilih untuk menyesuaikan penerima distribusi sesuai kebutuhan)</small>
    </div>
    <div class="span6" style="margin-top:4px">
      <button id="tambahPenerima1" type="button" class="btn btn-primary">Tambah Penerima Manual</button>
      <button id="hapusSemua" type="button" class="btn btn-danger">Hapus Semua</button>
    </div>
  </div>


  <table id="tabelPenerima" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="width:60px">No.</th>
        <th>Penerima</th>
        <th style="width:90px">Aksi</th>
      </tr>
    </thead>
    <tbody id="bodyTabelPenerima">
      <?php
      // --- Render awal dari DB (opsional). Tetap hormati blacklist biar konsisten.
      $no = 1;
      if (isset($_GET['id'])) {
        $suid = $_GET['id'];
        $data = mysql_fetch_array(mysql_query("SELECT * FROM dister WHERE suid='$suid'"));
        // Ambil penerima yang sudah tersimpan untuk dok ini, gabung users utk nama/jabatan
        $rs = mysql_query("
          SELECT DISTINCT u.cId, u.cNama, u.cJabatan
          FROM dister ds
          INNER JOIN disin b ON b.suid = ds.suid_dinter
          LEFT JOIN users u ON u.cId = b.cId
          WHERE ds.suid_dinter = '".mysql_real_escape_string($data['suid_dinter'])."'
          GROUP BY u.cId
          ORDER BY b.copyke ASC
        ");
        while ($row = mysql_fetch_assoc($rs)) {
          $nama = strtolower(trim($row['cNama']));
          $jab  = strtolower(trim($row['cJabatan']));
          $skip = (
            ($nama==='rian ramdani' && $jab==='spv pengendalian bahan baku') ||
            ($jab==='asisten manager k3l') ||
            ($jab==='asman fungsional pemastian mutu')
          );
          if ($skip) continue;
          ?>
          <tr id="row-<?= (int)$row['cId'] ?>">
            <td><?= $no++; ?></td>
            <td>
              <select name="disin[]" class="chzn-select span6 select-user" data-initial="1">
                <option value="<?= (int)$row['cId'] ?>" selected><?= htmlspecialchars($row['cJabatan']) ?> - <?= htmlspecialchars($row['cNama']) ?></option>
              </select>
            </td>
            <td>
              <button type="button" class="btn btn-danger hapusPenerimalp" data-user-id="<?= (int)$row['cId'] ?>">Hapus</button>
            </td>
          </tr>
          <?php
        }
      }
      ?>
    </tbody>
  </table>
</fieldset>

<script>
// ===============================
// Util & Aturan Khusus
// ===============================
function norm(s){ return (s||"").toLowerCase().trim(); }
function escHTML(s){
  return String(s == null ? '' : s).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

// Siapa yang WAJIB ada bila cocok (tidak bikin user bayangan)
const MUST_HAVE = [
  { key: "dewi",     nameLike: ["dewi","sari","kurniasih"], jabatanLike: ["pengawasan proses pengemasan"] },
  { key: "jaenudin", nameLike: ["jaenudin"],                 jabatanLike: ["boiler","pengolahan air"] },
];

// ===============================
// Helpers Tabel
// ===============================
function updateNomorUrut() {
  $("#bodyTabelPenerima tr").each(function(idx){
    $(this).find("td:first").text(idx + 1);
  });
}

function currentIdsSet(){
  const ids = new Set();
  $("#bodyTabelPenerima select.select-user").each(function(){
    const val = $(this).val();
    if (val) ids.add(String(val));
  });
  return ids;
}

function tambahPenerima(userId, jabatan, nama) {
  const exists = currentIdsSet().has(String(userId));
  if (exists) return; // hindari duplikat

  let noUrut = $("#bodyTabelPenerima tr").length + 1;
  let row = `
    <tr id="row-${escHTML(userId)}">
      <td>${noUrut}</td>
      <td>
        <select name="disin[]" class="chzn-select select-user">
          <option value="${escHTML(userId)}" selected>${escHTML(jabatan)} - ${escHTML(nama)}</option>
        </select>
      </td>
      <td>
        <button type="button" class="btn btn-danger hapusPenerimalp" data-user-id="${escHTML(userId)}">Hapus</button>
      </td>
    </tr>
  `;
  $("#bodyTabelPenerima").append(row);
  // Init chosen hanya untuk elemen baru
  $("#bodyTabelPenerima tr:last .chzn-select").chosen({ width: "100%" });
  updateNomorUrut();
}

// ===============================
// AJAX: Ambil users dari server
// ===============================
function parseUsersResp(resp){
  // Kompatibel: array langsung atau {ok,data}
  if (Array.isArray(resp)) return resp;
  if (resp && resp.ok && Array.isArray(resp.data)) return resp.data;
  return [];
}

function fetchUsers(jabatanFilter, cb){
  $.ajax({
    url: "include/dister/get_userselect.php",
    type: "POST",
    data: { jabatan_filter: jabatanFilter || "" },
    dataType: "json",
    success: function(resp){
      const users = parseUsersResp(resp);
      if (!users.length && (!resp || resp.ok !== true)) {
        console.error("Bad JSON:", resp);
      }
      cb(users);
    },
    error: function(xhr, s, e){
      console.error("AJAX Error:", e);
      alert("Gagal mengambil data user.");
      cb([]);
    }
  });
}

// ===============================
// Builder dropdown <option>
// ===============================
function buildOptions(users, placeholder){
  const ph = `<option value="">${placeholder||'-- Pilih Penerima --'}</option>`;
  const opts = (users || []).map(u=>{
    const id = String(u.cId || '');
    const j  = u.cJabatan || '';
    const n  = u.cNama || '';
    return `<option value="${escHTML(id)}" data-jabatan="${escHTML(j)}" data-nama="${escHTML(n)}">
              ${escHTML(j)} - ${escHTML(n)}
            </option>`;
  }).join("");
  return ph + opts;
}

// ===============================
// Force add Dewi & Jaenudin
// ===============================
function forceAddMustHave(users, selectedJabatan){
  const idsNow = currentIdsSet();

  // helper cocok Dewi & Jaenudin lebih fleksibel
  function matchDewi(u){
    const n = norm(u.cNama), j = norm(u.cJabatan);
    const nameOk = (n.includes("dewi") && (n.includes("kurniasih") || n.includes("sari")));
    const jabOk  = (j.includes("pengawasan proses") && j.includes("pengemasan"));
    return nameOk || jabOk;
  }
  function matchJaenudin(u){
    const n = norm(u.cNama), j = norm(u.cJabatan);
    return n.includes("jaenudin") || j.includes("boiler") || j.includes("pengolahan air");
  }
  
  // Update logic filter disini untuk mengakomodir 'gabungan_mgr'
  function passFilter(j){
    if (selectedJabatan === "") return true;
    if (selectedJabatan === "gabungan") {
      return j.includes("asman") || j.includes("spv") || j.includes("visor") || j.includes("asisten") || j.includes("supervisor");
    }
    // Logic Tambahan untuk Gabungan + Manager
    if (selectedJabatan === "gabungan_mgr") {
      return j.includes("asman") || j.includes("spv") || j.includes("visor") || j.includes("asisten") || j.includes("supervisor") || j.includes("manager") || j.includes("manajer");
    }
    return j.includes(selectedJabatan);
  }

  // Cari dari data server saat ini
  const dewi = users.find(u => matchDewi(u) && passFilter(norm(u.cJabatan)));
  if (dewi && !idsNow.has(String(dewi.cId))) {
    tambahPenerima(dewi.cId, dewi.cJabatan, dewi.cNama);
  }

  const jae = users.find(u => matchJaenudin(u) && passFilter(norm(u.cJabatan)));
  if (jae && !idsNow.has(String(jae.cId))) {
    tambahPenerima(jae.cId, jae.cJabatan, jae.cNama);
  }
}


// ===============================
// DOM Ready
// ===============================
$(document).ready(function () {
  // Inisialisasi chosen untuk elemen yang sudah ada (jika ada)
  $(".chzn-select").chosen({ width: "100%" });

  // Hapus baris
  $("#bodyTabelPenerima").on('click', '.hapusPenerimalp', function () {
    $(this).closest('tr').remove();
    updateNomorUrut();
  });
  
    // ===== helper fetch gabungan & util filter/sort =====
    function fetchMultipleUsers(filters, cb){
      // terima array filter, panggil fetchUsers per filter lalu gabungkan unik by cId
      let pending = filters.length;
      let all = [];
      if (!pending) { cb([]); return; }
     
      filters.forEach(f => {
        fetchUsers(f, function(users){
          all = all.concat(Array.isArray(users) ? users : []);
          pending--;
          if (pending === 0) {
            const seen = new Set();
            const uniq = [];
            all.forEach(u=>{
              const key = String(u && u.cId || "");
              if (key && !seen.has(key)) { seen.add(key); uniq.push(u); }
            });
            cb(uniq);
          }
        });
      });
    }
    
    function roleRank(jabatan){
      const j = norm(jabatan || "");
      if (j.includes("manager") || j.includes("manajer")) return 0;   // MANAGER
      if (j.includes("asman") || j.includes("asisten")) return 1;     // ASMAN
      if (j.includes("spv") || j.includes("visor") || j.includes("supervisor")) return 2; // SPV
      return 99;
    }
    function filterSPVAsmanManager(users){
      return (users||[]).filter(u=>{
        const j = norm(u.cJabatan||"");
        return j.includes("admin")      || j.includes("pelaksana")   ||
               j.includes("manager") || j.includes("manajer") ||
               j.includes("asman")    || j.includes("asisten") ||
               j.includes("spv")      || j.includes("visor")    || j.includes("supervisor");
      });
    }
    function sortUsersForManual(users){
      return (users||[]).slice().sort((a,b)=>{
        const ra = roleRank(a.cJabatan), rb = roleRank(b.cJabatan);
        if (ra !== rb) return ra - rb;
        const ja = (a.cJabatan||"").localeCompare(b.cJabatan||"", "id", {sensitivity:"base"});
        if (ja !== 0) return ja;
        return (a.cNama||"").localeCompare(b.cNama||"", "id", {sensitivity:"base"});
      });
    }

    
    $("#tambahPenerima1").off("click").on("click", function () {
      // Abaikan filter UI; manual picker SELALU memuat SPV+ASMAN+MANAGER saja
      const filters = [
        "spv","visor","supervisor",   
        "asman","asisten",            
        "manager","manajer","pelaksana", "admin"
      ];
     
      fetchMultipleUsers(filters, function(allUsers){
        // Saring agar hanya SPV/ASMAN/MANAGER, lalu urutkan
        let users = filterSPVAsmanManager(allUsers);
        users = sortUsersForManual(users);
     
        if (users.length === 0) {
          alert("Tidak ada data pengguna (SPV/ASMAN/MANAGER).");
          return;
        }
     
        const noUrut = $("#bodyTabelPenerima tr").length + 1;
        const selectOptions = buildOptions(users, "-- Pilih Personel --");
     
        const newRow = `
          <tr>
            <td>${noUrut}</td>
            <td>
              <select name="disin[]" class="chzn-select select-user select-user-editable">
                ${selectOptions}
              </select>
            </td>
            <td>
              <button type="button" class="btn btn-danger hapusPenerimalp">Hapus</button>
            </td>
          </tr>
        `;
        $("#bodyTabelPenerima").append(newRow);
        // init Chosen hanya untuk elemen baru
        $("#bodyTabelPenerima tr:last .chzn-select").chosen({ width: "100%" });
        updateNomorUrut();
      });
    });

  // Saat user memilih value di dropdown editable, cegah duplikat
  $("#bodyTabelPenerima").on("change", "select.select-user-editable", function(){
    const val = $(this).val();
    if (!val) return;

    // hitung kemunculan id yang sama
    let count = 0;
    $("#bodyTabelPenerima select.select-user").each(function(){
      if (String($(this).val()) === String(val)) count++;
    });

    if (count > 1){
      alert("Penerima sudah ada di daftar.");
      $(this).val("").trigger("chosen:updated");
    }
  });

  // Hapus semua
  $("#hapusSemua").click(function () {
    $("#bodyTabelPenerima").empty();
  });

  // Filter Jabatan
  $("#jabatan_filter").change(function () {
    const selectedJabatan = (($(this).val() || "") + "").toLowerCase();
    
    // Kirim value filter ke server
    // (Pastikan file get_userselect.php menangani logic 'gabungan_mgr' jika perlu)
    fetchUsers(selectedJabatan, function(users){
      $("#bodyTabelPenerima").empty();

      if (users.length === 0) {
        alert("Tidak ada pengguna yang cocok dengan filter.");
        return;
      }

      // Render semua dari server (server sudah terapkan blacklist)
      users.forEach(u => {
        if (!u.cNama || !u.cJabatan) return;
        tambahPenerima(u.cId, u.cJabatan, u.cNama);
      });

      // Force add Dewi & Jaenudin kalau ada (mengikuti filter)
      forceAddMustHave(users, selectedJabatan);

      // Info ringan bila akun Dewi belum ada di master
      const dewiFound = users.some(u => {
        const n = norm(u.cNama);
        return n.includes("dewi") && n.includes("kurniasih");
      });
      if (!dewiFound) {
        console.warn("Catatan: Akun Dewi Sari Kurniasih belum ditemukan di master users.");
      }

      updateNomorUrut();
    });
  });

  // ===============================
 // Poin 2: Wajib isi di Form Usulan (Update: Kondisi Penghapusan)
 // ===============================
 $('form').submit(function(e){
      // Ambil nilai jenis usulan
      var jenisUsulan = $("#jenisud").val();
      // Cek jumlah baris di tabel penerima
       var jumlahPenerima = $("#bodyTabelPenerima tr").length;

      // Jika JENIS USULAN bukan '3' (Penghapusan Dokumen)
      // Maka validasi list penerima dijalankan
      if(jenisUsulan !== "3") {
          if(jumlahPenerima === 0) {
             // Alert keras
             alert("PERINGATAN!\n\nAnda belum mengisi List Penerima Dokumen Terkendali.\nKolom ini WAJIB DIISI (Asman/SPV/Manager terkait) agar proses tidak terhambat.");
             // Scroll ke tabel
             $('html, body').animate({
                 scrollTop: $("#tabelPenerima").offset().top - 150
             }, 500);

             // Batalkan submit
             e.preventDefault();
             return false;
          }
     }
      // Jika jenisUsulan === "3", maka form akan langsung terkirim meski tabel kosong
    });

});
</script>
<!--</form>-->

	
	
<br>

    <div class="control-group">
        
        <div class="control-label">
            <small>Tanda <span style="color:red">*</span> Wajib Diisi</small>
        </div><br>
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET['act']=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=edit&id=<?=$e[uid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Usulan Dokumen</legend>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059 OR $_SESSION[cv]==1052){
	?>
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[udtgl];?>" required="required"><?=$e[udtgl];?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <input class="input-small" id="pengusul" type="text" name="pengusul" value="<?= $e[udpengusul]; ?>" required="required">
            <!--<select id="pengusul" class="chzn-select span6" name="pengusul">-->
            <?php
				// echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				// $cv = mysql_query("SELECT cId, cNama FROM users");
				// while ($dcv=mysql_fetch_array($cv)){
				// echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				// }
			?>
           	<!--</select>-->
        </div> 
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Status Usulan Dokumen</label>
        <div class="controls">
          	  <select id="statusud" class="chzn-select span5" name="statusud" required="required">
			  <? if ($e[udstatus]==1){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3>Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  elseif ($e[udstatus]==2){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1>Dalam Proses</option>
				<option value=2 selected>Selesai/ NET</option>
			    <option value=3 >Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  elseif ($e[udstatus]==3){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3 selected>Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  else {
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3>Pending</option>
			    <option value=4 selected>Tidak Jadi</option>";}
				?>
           	</select>
        </div> 
	</div>
	 
	<div class="control-group">
		<label class="control-label" for="tgl_terima">Tanggal diterima SSDR</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_terima" type="text" name="tgl_terima" value="<?=$e[udtgl_terima];?>"></div>
    </div>
    
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_selesai" value="<?=$e[udtgl_selesai];?>"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
          	  <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
			  <? 
			  if ($e[jenisud]==1){
				  echo"
            	<option value=0>Pilih/Cari Jenis Usulan</option>
				<option value=1 selected>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
			  <option value=3>Usulan Penghapusan Dokumen</option>";}
			  elseif ($e[jenisud]==2){
				  echo"
            	<option value=0>Pilih/Cari Jenis Usulan</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2 selected>Usulan Perubahan Dokumen</option>
			  <option value=3>Usulan Penghapusan Dokumen</option>";}
			  else {
				  echo"
            	<option value=0>Pilih/Cari Jenis Usulan</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
			  <option value=3 selected>Usulan Penghapusan Dokumen</option>";
			  }
				?>
           	</select>
        </div> 
	</div>
	<div class="control-group">
		<label class="control-label" for="kodedok">No. Reg. Usulan</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="udnmr"  value="<?=$e[udnmr];?>"><?=$e[udnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor CC</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="uccnmr"  value="<?=$e[uccnmr];?>"><?=$e[uccnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge" id="juduldok" type="text" name="ujudok"  value="<?=$e[ujudok];?>" ></div>
    </div>
	
	<? } 
	else {
		echo"<input type=hidden name=statusud value=$e[udstatus]>
		<input type=hidden name=tgl_selesai value=$e[udtgl_selesai]>
		<input type=hidden name=tgl_terima value=$e[udtgl_terima]>
		
		";
	 ?>

	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[udtgl];?>"><? echo tgl_indo($e[udtgl]); ?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Pengusul">Pengusul</label>
        <div class="controls">
            <select id="Pengusul" class="chzn-select" name="pengusul" required="required">
            <?php
            
				echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				
			?>
           	</select>
        </div> 
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
          	  <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
			  <? if ($e[jenisud]==1){
				  echo"
				<option value=1 selected>Usulan Pembuatan Dokumen Baru</option>";}
			  elseif ($e[jenisud]==2){
				  echo"
				<option value=2 selected>Usulan Perubahan Dokumen</option>";}
			  else {
				  echo"<option value=3 selected>Usulan Penghapusan Dokumen</option>";
			   }
				?>
           	</select>
        </div> 
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[ujudok];?>"></div>
    </div>
	
<? } ?>

	
 <!--   <div class="control-group">-->
 <!--   	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris)</label>-->
 <!--   <div class="controls">-->
		
	<!--		<textarea name="udket" id="editor"><?php //echo $e[udket];?>-->
			
		
				
	<!--			</textarea>-->
 <!--   </div>-->
	<!--</div>-->
	 <div class="control-group">
		<label class="control-label" for="cc">Nomor CC</label>
        <div class="controls"><input type="text" name="uccnmr" value='<? echo"$e[uccnmr]"; ?>' minlength="14" class="input-large span6">
        </div>
    </div>
  <div class="control-group">
		<label class="control-label" for="ket">Judul Usulan Perubahan / CC</label>
        <div class="controls"><input type="text" name="ket" value='<? echo"$e[udket]"; ?>' class="input-large span6"><br>
        <small>(Lihat Judul Usulan Perubahan di Form Monitoring CC)</small>
        </div>
    </div>

   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" value="<?php echo $e[udfile] ?>"> Max. 150MB <br>
        	<small>(Usulan Penghapusan Dokumen Tidak wajib melampirkan dokumen)</small>
        </div>
    </div>
	
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

<?php
}elseif($_GET['act']=="edit2"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=edit&id=<?=$e[uid];?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Usulan Dokumen</legend>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059){
	?>
<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[udtgl];?>" required="required"><?=$e[udtgl];?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <input class="input-small" id="pengusul" type="hidden" name="pengusul" value="<?= $e[udpengusul]; ?>" required="required"><?php echo $ef[cNama]; ?>
            <!--<select id="pengusul" class="chzn-select span6" name="pengusul">-->
            <?php
				// echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				// $cv = mysql_query("SELECT cId, cNama FROM users");
				// while ($dcv=mysql_fetch_array($cv)){
				// echo "<option value=$dcv[cId]>$dcv[cNama]</option>";
				// }
			?>
           	<!--</select>-->
        </div> 
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Status Usulan Dokumen</label>
        <div class="controls">
          	  <select id="statusud" class="chzn-select span5" name="statusud" required="required">
			  <? if ($e[udstatus]==1){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3>Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  elseif ($e[udstatus]==2){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1>Dalam Proses</option>
				<option value=2 selected>Selesai/ NET</option>
			    <option value=3 >Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  elseif ($e[udstatus]==3){
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3 selected>Pending</option>
			    <option value=4>Tidak Jadi</option>";}
			  else {
				  echo"
            	<option value=0>Pilih Status Usulan</option>
				<option value=1 selected>Dalam Proses</option>
				<option value=2>Selesai/ NET</option>
			    <option value=3>Pending</option>
			    <option value=4 selected>Tidak Jadi</option>";}
				?>
           	</select>
        </div> 
	</div>
	 
	<div class="control-group">
		<label class="control-label" for="tgl_terima">Tanggal diterima SSDR</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_terima" type="text" name="tgl_terima" value="<?=$e[udtgl_terima];?>"></div>
    </div>
    
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_selesai" value="<?=$e[udtgl_selesai];?>"></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
            <input class="input-small" id="jenisud" type="hidden" name="jenisud" value="<?=$e[jenisud];?>"><?php
                if($e[jenisud]==1){
    				 "Usulan Pembuatan Dokumen Baru";
                }elseif($e[jenisud]==2){
    				  echo"Usulan Perubahan Dokumen";
                    
                }else {
    				  echo"Usulan Penghapusan Dokumen";
			    }
			  ?>
          	  <!--<select id="jenisud" class="chzn-select span5" name="jenisud" required="required">-->
			  <? 
			 // if ($e[jenisud]==1){
				//   echo"
    //         	<option value=0>Pilih/Cari Jenis Usulan</option>
				// <option value=1 selected>Usulan Pembuatan Dokumen Baru</option>
				// <option value=2>Usulan Perubahan Dokumen</option>
			 // <option value=3>Usulan Penghapusan Dokumen</option>";}
			 // elseif ($e[jenisud]==2){
				//   echo"
    //         	<option value=0>Pilih/Cari Jenis Usulan</option>
				// <option value=1>Usulan Pembuatan Dokumen Baru</option>
				// <option value=2 selected>Usulan Perubahan Dokumen</option>
			 // <option value=3>Usulan Penghapusan Dokumen</option>";}
			 // else {
				//   echo"
    //         	<option value=0>Pilih/Cari Jenis Usulan</option>
				// <option value=1>Usulan Pembuatan Dokumen Baru</option>
				// <option value=2>Usulan Perubahan Dokumen</option>
			 // <option value=3 selected>Usulan Penghapusan Dokumen</option>";
			 // }
				?>
           	<!--</select>-->
        </div> 
	</div>
	<div class="control-group">
		<label class="control-label" for="kodedok">No. Reg. Usulan</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="udnmr"  value="<?=$e[udnmr];?>"><?=$e[udnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Nomor CC</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="hidden" name="uccnmr"  value="<?=$e[uccnmr];?>"><?=$e[uccnmr];?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[ujudok];?>" required="required"></div>
    </div>
	
	<? } 
	else {
		echo"<input type=hidden name=statusud value=$e[udstatus]>
		<input type=hidden name=tgl_selesai value=$e[udtgl_selesai]>
		<input type=hidden name=tgl_terima value=$e[udtgl_terima]>
		
		";
	 ?>

	<div class="control-group">
		<label class="control-label" for="tgl">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="hidden" name="tgl" value="<?=$e[udtgl];?>"><? echo tgl_indo($e[udtgl]); ?></div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="Pengusul">Pengusul</label>
        <div class="controls">
            <select id="Pengusul" class="chzn-select" name="pengusul" required="required">
            <?php
                     
				echo "<option value=$e[udpengusul] selected>$ef[cNama]</option>";
				$cv = mysql_query("SELECT cId, cNama FROM users");
				
			?>
           	</select>
        </div> 
    </div>
	
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
        <div class="controls">
          	  <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
			  <? if ($e[jenisud]==1){
				  echo"
				<option value=1 selected>Usulan Pembuatan Dokumen Baru</option>";}
			  elseif ($e[jenisud]==2){
				  echo"
				<option value=2 selected>Usulan Perubahan Dokumen</option>";}
			  else {
				  echo"<option value=3 selected>Usulan Penghapusan Dokumen</option>";
			   }
				?>
           	</select>
        </div> 
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[ukodok];?>"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?=$e[udrev];?>"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[ujudok];?>"></div>
    </div>
	
<? } ?>

	
 <!--   <div class="control-group">-->
 <!--   	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris)</label>-->
 <!--   <div class="controls">-->
		
	<!--		<textarea name="udket" id="editor"><?php //echo $e[udket];?>-->
			
		
				
	<!--			</textarea>-->
 <!--   </div>-->
	<!--</div>-->
	 <div class="control-group">
		<label class="control-label" for="cc">Nomor CC</label>
        <div class="controls"><input type="text" name="uccnmr" value='<? echo"$e[uccnmr]"; ?>' minlength="14" class="input-large span6">
        </div>
    </div>
  <div class="control-group">
		<label class="control-label" for="ket">Judul Usulan Perubahan / CC</label>
        <div class="controls"><input type="hidden" name="ket" value='<? echo"$e[udket]"; ?>' class="input-medium"> <? echo"$e[udket]"; ?><br>
        <small>(Lihat Judul Usulan Perubahan di Form Monitoring CC)</small>
        </div>
    </div>

   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen </label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload" value="<?php echo $e[udfile] ?>"> Max. 150MB <br>
        	<small>(Usulan Penghapusan Dokumen Tidak wajib melampirkan dokumen)</small>
        </div>
    </div>
	
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Simpan</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>

<?php
}elseif($_GET['act']=="tambah2"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM dokumen WHERE kode_dok='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
?>
<form method="post" action="include/duin/aksi_duin.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Tambah Usulan Dokumen</legend>
    
    <div class="control-group">
		<label class="control-label" for="tgl">Tanggal Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl" type="text" name="tgl" value="<?php echo $tgl1 ?>" required="required"></div>
    </div>
<?php
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059){
	?>
   
  <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            	<option>Pilih Pengusul</option>
            <?php
				$cv = mysql_query("SELECT cId, cNama, cjabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cNama] ($dcv[cJabatan])</option>";
				}
			?>
           	</select>
        </div> 
    </div>
    <div class="control-group">
    	<label class="control-label" for="kepada">Kepada</label>
        <div class="controls">
        <input type=hidden name=kepada value=2><b>MR</b>
        </div> 
    </div>
	<? }
	else {
    echo"<input type=hidden name=kepada value=2>";
	?>
	 <!--<div class="control-group">-->
		<!--<label class="control-label" for="tgl">Tanggal Usulan</label>-->
  <!--      <div class="controls"> <?  //echo "<input type=hidden name=tgl value=$tgl1><b>$tgl</b>";  ?></div>-->
  <!--  </div>-->
    <div class="control-group">
    	<label class="control-label" for="pengusul">Pengusul</label>
        <div class="controls">
            <select id="pengusul" class="chzn-select" name="pengusul">
            	<?
	       echo "
			<option value='$_SESSION[cv]' selected>$_SESSION[namacv]</option>
		</select>";
         ?> 
           	</select>
        </div> 
    </div>
	
	<? } ?>	
	<div class="control-group">
    	<label class="control-label" for="Jenisud">Jenis Usulan</label>
        <div class="controls">
          	 <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
            	<option value=0 selected>Pilih Jenis Usulan (Wajib)</option>
				<option value=1>Usulan Pembuatan Dokumen Baru</option>
				<option value=2>Usulan Perubahan Dokumen</option>
				<option value=3>Usulan Penghapusan Dokumen</option>
           	</select>
        </div> 
	</div>
	
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen</label>
        <div class="controls"><input class="input-large focused" id="kodedok" type="text" name="ukodok"  value="<?=$e[kode_dok];?>" required="required"></div>
    </div>
	  <div class="control-group">
		<label class="control-label" for="revisi">Revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="" required="required"></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="ujudok"  value="<?=$e[judul_dok];?>" required="required"></div>
    </div>
	
    <div class="control-group">
    	<label class="control-label" for="ket">Alasan/ Ringkasan/Isi Usulan (Tekan Shift+Enter untuk pindah baris, Ctrl+V Paste)</label>
        <div class="controls">
				<textarea name="udket" id="editor">
				<p>Bisa pakai tabel dibawah ini jika usulan perubahan dokumen atau dihapus jika tidak dipakai :</p>
<table border="1" cellpadding="1" cellspacing="1" width="100%">
	<tbody>
		<tr>
			<td>No</td>
			<td>Halaman</td>
			<td>Sebelum</td>
			<td>Sesudah</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
<br>
<p>Penerima Distribusi Dokumen : (Jika Usulan Baru Wajib diisi, jika Usulan Perubahan apabila berubah)</p>
1.<br>
2.<br>				
				</textarea>
        </div>
    </div>
	
   	<div class="control-group">
    	<label class="control-label" for="fileInput">Lamp. Dokumen</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15MB<br>
        	<small>(Usulan Penghapusan Dokumen Tidak wajib melampirkan dokumen)</small>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>



<?php
}elseif($_GET['act']=="terima"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));

 $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$_SESSION[cv]'"));
if ($e[udstatus1]=='N' AND $_SESSION[cv]=='0' OR $e[udstatus1]=='N' AND $_SESSION[cv]=='1' OR $e[udstatus1]=='N' AND $_SESSION[cv]=='53'OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1059'){

mysql_query("UPDATE udokumen SET udstatus1='Y' WHERE uid='$_GET[id]'")or die(mysql_error());

}

    if ($e[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]=='0' OR $e[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]=='1' OR $_SESSION[cv]=='1051' OR $_SESSION[cv]=='1052' OR $_SESSION[cv]=='1054' OR $_SESSION[cv]=='1055' OR $_SESSION[cv]=='1056' OR $_SESSION[cv]=='1057' OR $_SESSION[cv]=='1058' OR $_SESSION[cv]=='1059' OR $_SESSION[cv]=='1000' OR $e[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]=='53'){
                    
        if ($e[jenisud]=='1'){
                               
                                
        $f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));
        
            $tgl_sekarang = date("Y-m-d");
            $thn			 = date("y");
            $bln			 = date("m");
            $query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%B$bln-$thn/$f[bagian]%'";
            $hasil = mysql_query($query);
            $hitung = mysql_num_rows($hasil);
            $data  = mysql_fetch_array($hasil); 
            $idMax = $data['max_no'];
            $noUrut = (int) substr($idMax, 9, 3);
            $noUrut++;
            $newID = sprintf("B$bln-$thn/$f[bagian]%03s", $noUrut);
        }elseif ($e[jenisud]=='2'){
            $f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));
            
            $tgl_sekarang = date("Y-m-d");
            $thn			 = date("y");
            $bln			 = date("m");
            $query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%R$bln-$thn/$f[bagian]%'";
            $hasil = mysql_query($query);
            $hitung = mysql_num_rows($hasil);
            $data  = mysql_fetch_array($hasil); 
            $idMax = $data['max_no'];
            $noUrut = (int) substr($idMax, 9, 3);
            $noUrut++;
            $newID = sprintf("R$bln-$thn/$f[bagian]%03s", $noUrut);
        }elseif ($e[jenisud]=='3'){
            $f = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));
            
            $tgl_sekarang = date("Y-m-d");
            $thn			 = date("y");
            $bln			 = date("m");
            $query = "SELECT max(udnmr) as max_no FROM udokumen WHERE udnmr LIKE '%O$bln-$thn/$f[bagian]%'";
            $hasil = mysql_query($query);
            $hitung = mysql_num_rows($hasil);
            $data  = mysql_fetch_array($hasil); 
            $idMax = $data['max_no'];
            $noUrut = (int) substr($idMax, 9, 3);
            $noUrut++;
            $newID = sprintf("O$bln-$thn/$f[bagian]%03s", $noUrut);
        }
        
        $tgl_sekarang = date("Y-m-d");
    
        $qq = mysql_query("UPDATE udokumen SET udtgl_terima='$tgl_sekarang', udstatus1='Y', udnmr='$newID' WHERE uid='$_GET[id]'")or die(mysql_error());
        
        
        $get_kodeaktifitas = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
    
    	            if($user['cAudit']=='Y'){
    				    
    				}else{		
                    	$q=mysql_query("INSERT INTO aktivitas_dokumen(kode_aktivitas,
                    		                            user,
                                                       jabatan,
                                                       ip_address,
                                                       user_agent, 
                    								   kode_dokumen,
                    								   dokumen,
                    								   action,
                    								   deskripsi) 
                    	                     VALUES('$get_kodeaktifitas[kode_aktivitas]',
                    	                            '$_SESSION[cNama]',
                    	                            '$_SESSION[cJabatan]',
                    	                            '-',
                    	                            '-',
                    	                            '$get_kodeaktifitas[ukodok]',
                    	                            '$get_kodeaktifitas[ujudok]',
                    	                            'create',
                    	                            'Melakukan Penerimaan Usulan Dokumen dengan judul $_POST[ujudok]'
                    	                     )");
    				}
    
    }

    if ($qq){
    	 echo "<script>window.alert('Usulan Dokumen Diterima');window.location=('home.php?pages=usulandok&act=detail&id=$_GET[id]')</script>";
      }else{
    	  echo "<script>window.alert('Data Gagal Tersimpan');self.history.back();</script>";
      }


}elseif($_GET['act']=="detail"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));

/*
if ($e[udstatus1]=='N' AND $_SESSION[cv]==0 OR $e[udstatus1]=='N' AND $_SESSION[cv]=='1' OR $e[udstatus1]=='N' AND $_SESSION[cv]=='53'){

mysql_query("UPDATE udokumen SET udstatus1='Y' WHERE uid='$_GET[id]'");

}
*/


?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>Nomor CC</td><b><td>: <b><?=$e[uccnmr];?></b></td></tr>
    <tr><td>Judul Usulan Perubahan /CC</td><b><td>: <b><?=$e[udket];?></b></td></tr>
    <tr><td>Judul Dokumen</td><b><td>: <b><?=$e[ujudok];?></b></td></tr>
	<!--<tr><td>Lihat Usulan CC</td><td>: <strong>-->
	<?php
	
// 	if ($e[uccnmr]!=''){
//     $n = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'"));
// 	}
// 	else {
	    
// 	}
//     echo"<a href='home.php?pages=ccinter&act=detail&id=$n[ccid]' target=_blank>Klik disini lihat detail usulan CC</a>";
    ?>
	<!--</strong></td></tr>-->
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cJabatan];?>)</b><br>
    <!--: <b><?php //echo $ef[cNama];?> (<?php //echo $ef[cJabatan];?>)</b>-->
    </td></tr>
    <tr><td>Tgl Terima SSDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
  
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Lampiran Usulan</td><td>: 	<a href="https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a> </td></tr>
	</table>
	<br></b></strong></b></strong>

<?php /*
  <tr><td>Tgl Pembahasan</td><td>: <b><?=tgl_indo($e[udtgl_bahas]);?></b></td></tr>
  <tr><td>Dibahas oleh</td><td>: <b><?=$e[ud_bahas_oleh];?></b></td></tr>
    
/<a title="Lampiran" href="https://view.officeapps.live.com/op/view.aspx?src=https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Buka Online (Jika Ada)</a>

<!--<table width="100%">-->
<!--    <tr><td><b>Judul Usulan Perubahan :</b></td><tr>-->
<!--	<tr><td><?php //echo $e[udket];?></td></tr>-->
<!--</table>-->
*/ ?>

<?php	


if ($_SESSION[cv]=='0'){ 
if ($e[udtgl_acc]=='0000-00-00' ) {

    echo"<form method='post' action='include/duin/aksi_duin.php?act=acc2&id=$e[uid]'>
	<div class='control-group'>
			<label class='control-label' for='info'><b>Pilih ACC atau TIDAK ACC dan komentar (jika ada) :</b></label>
        <div class='controls'>
        <select name='comment0'>
            	<option value='ACC' selected>ACC</option>
				<option value='TIDAK ACC'>TIDAK ACC</option>
           	</select><br>Komentar :<br>
		<textarea name='comment'></textarea>
    </div>";?>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>ACC/Komentar</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<br>
<br>
<br>
";

}
}
?>



<?php
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.*,c.cNama,c.cFoto,d.* FROM alurusulan a 
									LEFT JOIN uddis b ON a.uid=b.uid 
									LEFT JOIN users c ON b.pId=c.cId 
									LEFT JOIN duin d ON a.uid=d.uid
									WHERE b.cId='2' AND pudid=$_GET[pudid] AND a.uid=$_GET[id]"));
									
$ed = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cNama='$e[cNama]'"));


$qds = mysql_query("SELECT a.*,(SELECT cNama FROM users WHERE cId=$_SESSION[cv]) as dPengirim FROM alurusulan a WHERE a.uid='$_GET[id]'");
$ds = mysql_fetch_array($qds);
$jds = mysql_num_rows($qds);

if ($jds>0){ 
?>

<!-- isi alurusulan-->
<legend>Alur Usulan Dokumen (Kirim-Kembali Usulan) :</legend>
<table class="table table-bordered" border=1 width=100% >
<thead>
	<td ><b>Tgl</b></td>
    <td ><b>Kepada</b></td>
	<td width=35%><b>Info Kirim</b></td>
	<td width=25%><b>Info Kembali</b></td>
	<td></td>
	<td></td>
      
</thead>
<?php
$pds = mysql_query("SELECT a.*,
					(SELECT b.cNama FROM users b WHERE b.cId=a.pId) As oleh,
					(SELECT b.cNama FROM users b WHERE b.cId=a.cId) As kepada, 
					(SELECT b.cIdjab FROM users b WHERE b.cId=a.cId) As kepadajab
					FROM uddis a WHERE a.uid='$_GET[id]' ORDER BY a.pudid DESC");

while ($t=mysql_fetch_array($pds)){
    $edf = mysql_fetch_array(mysql_query("SELECT * FROM alurusulan WHERE dNoalur='$t[pNoalur]'"));
	$tglBaca = tgl_indo1($t[psTglbaca]);
	$tglSelesai = tgl_indo1($t[psTglselesai]);
	$tglDis = tgl_indo1($t[ptgl]);
	$tgltarget = tgl_indo1($t[ptgls]);
	if ($t[psTglbaca]=='' ){
		$tglBaca="<span class='label label-important'>Belum dilihat</span>";
	}
	if ($t[psTglselesai]=='' ){
		$tglSelesai="<span class='label label-important'>Belum selesai</span>";
	}
	if ($t[psACC]=="N"){
		echo "<tr>
				<td>$tglDis</td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]<br>
				<b>File Usulan untuk dikoreksi :</b> <a href='https://docs.kfpb.kimiafarma.co.id/konsep_kirim/$edf[disfile]' target=_blank>Download</a></td>
				<td>$t[info]";
				if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])){
				 echo"<a href='?pages=usulandok2&act=kembali&id=$t[pudid]' class='btn btn-info'>Kembali ke SDDR</i>";
								// <td><a href='home.php?pages=usulandok2&act=editalur&id=$t[pudid]' class='btn btn-info pull-center' target=_blank>
								// <i class='icon-edit'></i> Edit</a></td>
				
				}
				echo"
				</td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
			 </tr>";
			 
	}else{
		echo "<tr class='info'>
				<td>$tglDis<br></td>
				<td>$t[kepada] ($t[kepadajab])</td>
				<td>$t[pInstruksi]<br>
				<b>File Usulan untuk dikoreksi :</b> <a href='https://docs.kfpb/kimiafarma.co.id/konsep_kirim/$edf[disfile]' target=_blank>Download</a></td>
				<td>$t[info]<p><b>File koreksi (dari user) :</b> <a href='https://docs.kfpb.kimiafarma.co.id/jwb_usulandok/$t[filedis]' target=_blank>Download</a></td>
				<td><b>Tgl Baca:</b><br> $tglBaca<br><b>Tgl Slesai:<br></b> $tglSelesai</td>
				<td>
				<a href='home.php?pages=usulandok2&act=editalur&id=$t[pudid]' class='btn btn-info pull-center' target=_blank><i class='icon-edit'></i> Edit</a>";?>
				<!--<a href='include/duin/aksi_duin.php?act=hapusalur&id=$edf[dId]'  onClick=\'return confirm('Yakin ingin menghapus??')\' class='btn btn-info pull-center'><i class='icon-edit'></i> Hapus</a>-->
				<?php
                    $id = htmlspecialchars($edf['dId'], ENT_QUOTES, 'UTF-8'); // Sanitize the ID
                    $idpudid = htmlspecialchars($t['pudid'], ENT_QUOTES, 'UTF-8'); // Sanitize the ID
                    $url = "include/duin/aksi_duin.php?act=hapusalur&id=" . urlencode($id) . "&idpudid=" . urlencode($idpudid); // URL Encode
                ?>
                <a href='<?php echo $url; ?>'  onClick="return confirm('Yakin ingin menghapus??');" class='btn btn-info pull-center' target='_blank'><i class='icon-edit'></i> Hapus</a>
			<?php "</td>
			 </tr>";
	}
}
?>
</table>
<!-- /isi alurusulan-->
<?php	
}
?>

<?
}


elseif($_GET['act']=="terimacc"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));


?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>Nomor CC</td><b><td>: <b><?=$e[uccnmr];?></b></td></tr>
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cJabatan];?>)</b><br>
    </td></tr>
    <tr><td>Tgl Terima SSDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
    <tr><td>Tgl Pembahasan</td><td>: <b><?=tgl_indo($e[udtgl_bahas]);?></b></td></tr>
    <tr><td>Dibahas oleh</td><td>: <b><?=$e[ud_bahas_oleh];?></b></td></tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Dokumen Pendukung Awal</td><td>: 	<a href="https://docs.kfpb.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a></td></tr>
	</table>
	<br></b></strong></b></strong>
<table width="100%">
    <tr><td><b>Judul Usulan Perubahan :</b></td><tr>
	<tr><td><?=$e[udket];?></td></tr>
</table>

<?php	


if ($e[ccstatus]=='N' ) {

    echo"<form method='post' action='include/duin/aksi_duin.php?act=accchangecontrol&id=$e[uid]'>
";?>
<hr>
<h3>Terima Usulan</h3>

    	<div class='control-group'>
			<label class='control-label' for='info'><b>Nomor CC</b> <span style="color: red">*</span></label>
            <div class='controls'>
            <input class="input-large" id="nocc" type="text" name="nocc" value="<?=$e[uccnmr];?>" minlength="14" required>
            <br><small>(Masukkan 14 Karakter. Contoh : CC-12-22-11019)</small></div>
        </div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Terima</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
";

}

?>


<?
}



elseif($_GET['act']=="returncc"){
$e = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.cNama, b.cIdjab, b.bagian, b.cJabatan FROM udokumen a,users b WHERE a.udpengusul2=b.cId AND a.uid='$_GET[id]'"));


?>
<? echo"<a href='home1.php?pages=duin1&act=print&id=$_GET[id]' class='btn btn-info pull-right' target=_blank><i class='icon-print'></i> Cetak Usulan</a>";?>

<legend>Detail Usulan Dokumen</legend>
<table width="100%" border=1>
	<tr><td width="20%">Nomor Reg Usulan</td><td>: <b><?=$e[udnmr];?></b></td></tr>
    <tr><td>Tanggal Usulan</td><b><td>: <b><?=tgl_indo($e[udtgl]);?></b></td></tr>
    <tr><td>Nomor CC</td><b><td>: <b><?=$e[uccnmr];?></b></td></tr>
    <tr><td>Judul Usulan Perubahan</td><b><td>: <b><?=$e[udket];?></b></td></tr>
	<!--<tr><td>Lihat Usulan CC</td><td>: <strong>-->
	<?php
	
// 	if ($e[uccnmr]!=''){
//     $n = mysql_fetch_array(mysql_query("SELECT * FROM ccinter WHERE ccnmr1='$e[uccnmr]'"));
// 	}
// 	else {
	    
// 	}
//     echo"<a href='home.php?pages=ccinter&act=detail&id=$n[ccid]' target=_blank>Klik disini lihat detail usulan CC</a>";
    ?>
	<!--</strong></td></tr>-->
	<tr><td>Jenis Usulan</td><td>: <?
	if ($e[jenisud]==1) { echo"<b>Usulan Pembuatan Dokumen Baru</b>";}
	elseif ($e[jenisud]==2) { echo"<b>Usulan Perubahan Dokumen</b>";}
	else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	?></td></tr>
    <tr><td>Pengusul</td><td>: <b><?=$e[cNama];?> (<?=$e[cJabatan];?>)</b><br>
    <!--: <b><?php //echo $ef[cNama];?> (<?php //echo $ef[cJabatan];?>)</b>-->
    </td></tr>
    <tr><td>Tgl Terima SSDR</td><td>: <b><?=tgl_indo($e[udtgl_terima]);?></b></td></tr>
	<tr><td>Status Usulan</td><td>: <?
	if ($e[udstatus]==1) { echo"<b>Belum Selesai</b>";}
	elseif ($e[udstatus]==2) { echo"<b>Selesai (Net)</b>";}
	elseif ($e[udstatus]==3) { echo"<b>Pending</b>";}
	else { echo"<b>Tidak Jadi</b>";}
	?></td></tr>
	<tr><td>Tgl Selesai</td><td>: <b><?=tgl_indo($e[udtgl_selesai]);?></b></td></tr>
	<tr><td>Lampiran Usulan</td><td>: 	<a href="https://docs.kimiafarma.co.id/udmasuk/<?=$e[udfile];?>" target=_blank>Download</a></td></tr>
	</table>
	<br></b></strong></b></strong>

<?php	

if ($e[ccstatus]=='N' ) {

    echo"<form method='post' action='include/duin/aksi_duin.php?act=returncc&id=$e[uid]'>
";?>
<hr>
<h4>Pengembalian Usulan ke User</h4>
    	<div class='control-group'>
			<label class='control-label' for='info'><b>Keterangan/ informasi pengembalian :</b></label>
        <div class='controls'>
		<textarea name='keterangan' id="editor"></textarea>
</div>
	<?
		echo"<div class='control-group'>
        <div class='controls'>
		<button class='btn btn-primary'>Return</button> 
        <button type='reset' class='btn' onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
";

}

?>


<?
}


elseif($_GET['act']=="selesai"){
$tgl			 = date("Y-m-d");
$tglthn          = date("Y")+3;
$tglbln			 = date("-m-d");
$tgl1 = $tglthn.$tglbln;

$e = mysql_fetch_array(mysql_query("SELECT * FROM udokumen WHERE uid='$_GET[id]'"));
$ef = mysql_fetch_array(mysql_query("SELECT a.*, b.* FROM udokumen a,users b WHERE a.udpengusul=b.cId AND a.uid='$_GET[id]'"));
if ($e[udrev]=='' OR $e[udrev]=='-'){
$rev = 0;
} else {
// $rev = $e[udrev]+1;

    if ($e[jenisud]==1) { 
// 		echo"<b>Usulan Pembuatan Dokumen Baru</b>";
				        
	}elseif ($e[jenisud]==2) { 
// 		echo"<b>Usulan Perubahan Dokumen</b>";
			$rev = $e[udrev]+1;	        
// 			$rev = $e[udrev];	        
	}else { 
	   // echo"<b>Usulan Penghapusan Dokumen</b>";
	    	$rev = $e[udrev];
	}
}
// var_dump($e[uid], $e[ukodok]);die();

?>

<form method="post" action="include/duin/aksi_duin.php?act=selesai2&id=<?=$e[uid];?>" class="form-horizontal">
<fieldset>
    <?php //echo($e[kode_aktivitas]);die(); ?>
    
<input class="input-small" id="kode_aktivitas" type="hidden" name="kode_aktivitas" value="<?=$e[kode_aktivitas];?>">
<input class="input-small" id="id_udokumen" type="hidden" name="id_udokumen" value="<?=$e[uid];?>">

<legend>Usulan Dokumen Net Selesai</legend>
<input class="input-small datepicker" id="pengusul" type="hidden" name="jenisud" value="<?=$e[jenisud];?>">
	<div class="control-group">
		<label class="control-label" for="tgl_slesai">Tanggal Selesai Usulan</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_slesai" type="text" name="tgl_selesai" value="<?=$tgl;?>"><?php //echo tgl_indo($tgl); ?></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="tgl_berlaku">Tanggal Efektif</label>
        <div class="controls"><input class="input-small datepicker" id="tgl_berlaku" type="text" name="tgl_berlaku" value="<?=$tgl;?>"></div>
    </div>
  <!--  <div class="control-group">-->
		<!--<label class="control-label" for="tgl_review">Tanggal Review</label>-->
  <!--      <div class="controls"><input class="input-small datepicker" id="tgl_review" type="text" name="tgl_review" value="<?php //echo $tgl1;?>"></div>-->
  <!--  </div>-->
	<div class="control-group">
		<label class="control-label" for="kodedok">Kode Dokumen <span style="color: red">*</span></label>
        <div class="controls"><input class="input-small focused" id="kodedok" type="text" name="kode_dok"  value="<?=$e[ukodok];?>" required></div>
    </div>
	<div class="control-group">
		<label class="control-label" for="juduldok">Judul Dokumen</label>
        <div class="controls"><input class="input-xxlarge focused" id="juduldok" type="text" name="judul_dok"  value="<?=$e[ujudok];?>"></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label" for="Jenisdok">Jenis Dokumen <span style="color: red">*</span></label>
        <div class="controls">
          	 <select id="jenisdok" class="chzn-select span4" name="jenisdok" required>
            	<option>Pilih Jenis Dokumen</option>
            <?php
				$vc = mysql_query("SELECT id_jendok, nama_jendok FROM jendok ORDER BY id_jendok ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[id_jendok]'>$dvc[nama_jendok]</option>";
				}
			?>
           	</select> (Wajib Pilih)
        </div> 
	</div>
    
    <div class="control-group">
    	<label class="control-label" for="leveldok">Level Dokumen <span style="color: red">*</span></label>
        <div class="controls">
          	 <select id="leveldok" class="chzn-select span4" name="leveldok" required>
            	<option selected>Pilih Level Dokumen</option>
                <option value='1'>Manual MK3L, Manual Sistem Jaminan Halal, Site Master File, Cleaning Validation Plan, Validasi Master Plan, Facility Validation Plan, Proses Validasi & Analisis Metode Validasi Plan</option>
                <option value='2'>Prosedur</option>
                <option value='3'>Instruksi Kerja, Spesifikasi PPI & PGI </option>
                <option value='4'>Formulir/Catatan/Laporan Analisis dan dokumen Lainnya</option>
			
           	</select> (Wajib Pilih)
        </div> 
	</div>
        <div class="control-group">
            	<label class="control-label" for="Jenisud">Jenis Usulan Dokumen</label>
                <div class="controls">
                  	  <select id="jenisud" class="chzn-select span5" name="jenisud" required="required">
        			  <? 
        			  if ($e[jenisud]==1){
        				  echo"
                    	<option value=0>Pilih/Cari Jenis Usulan</option>
        				<option value=1 selected>Usulan Pembuatan Dokumen Baru</option>
        				<option value=2>Usulan Perubahan Dokumen</option>
        			  <option value=3>Usulan Penghapusan Dokumen</option>";}
        			  elseif ($e[jenisud]==2){
        				  echo"
                    	<option value=0>Pilih/Cari Jenis Usulan</option>
        				<option value=1>Usulan Pembuatan Dokumen Baru</option>
        				<option value=2 selected>Usulan Perubahan Dokumen</option>
        			  <option value=3>Usulan Penghapusan Dokumen</option>";}
        			  else {
        				  echo"
                    	<option value=0>Pilih/Cari Jenis Usulan</option>
        				<option value=1>Usulan Pembuatan Dokumen Baru</option>
        				<option value=2>Usulan Perubahan Dokumen</option>
        			  <option value=3 selected>Usulan Penghapusan Dokumen</option>";
        			  }
        				?>
                   	</select>
                </div> 
                <small>Pastikan Jenis Usulan Tersebut Sesuai</small>
        	</div>
	<div class="control-group">
		<label class="control-label" for="juduldok">Menjadi revisi ke</label>
        <div class="controls"><input class="input-small focused" id="revisi" type="text" name="revisi"  value="<?php echo $rev;?>"></div>
    </div>
    
    <? $euser = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'")); ?>
    <div class="control-group">
    	<label class="control-label" for="pjdok">Penanggung jawab dokumen</label>
        <div class="controls">
          	 <select id="atasan" class="chzn-select span6" name="pjdok" required="required">
            	<option>Pilih/Cari</option>
				
            <?php
			$v = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$e[udpengusul]'"));
				echo"<option value='$e[udpengusul]' selected>$v[cNama]</option>";
				$vc = mysql_query("SELECT cId, cNama, cJabatan FROM users ORDER BY cNama ASC");
				while ($dvc=mysql_fetch_array($vc)){
	    	     	echo "<option value='$dvc[cId]'>$dvc[cNama] ($dvc[cJabatan])</option>";
				}
			?>
           	</select>
        </div> 
	</div>
	<?php //var_dump($e[uid]);?>
		 <label class="control-label" for="dsin">Penerima Dokumen:</label>
			  <div class="controls">
    			<select multiple="multiple" id="disin" name="disin[]" class="chzn-select span8" disabled="true">
                	<?php
                	
                            
    				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId IN(SELECT cId FROM disin WHERE suid='$e[uid]') AND cId NOT IN (1103, 1104)");
    			?>
    			<?php
    				while ($dcv=mysql_fetch_array($cv)){
    	    	     	echo "<option value='$dcv[cId]' selected>$dcv[cJabatan] - $dcv[cNama]</option>";
    				}
    				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users WHERE cId NOT IN(SELECT cId FROM disin WHERE suid='$data[uid]') AND cId NOT IN (1103, 1104)");
    				while ($dcv=mysql_fetch_array($cv)){
    	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
    				}
    				
    				?>                             
                </select>
                <br>
        <small>Lakukan Perubahan penerima di halaman distribusi</small>
            </div>
	<div class="control-group">
	    <div class="control-label">
	        Tanda <span style="color: red">*</span> Wajib Diisi!
	    </div><br>
        <div class="controls">
            <button class="btn btn-primary">Selesai</button> 
            <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
<br><br><br><br><br><br><br><br>
    
<?php
//batas dari alurusulan.php
}elseif($_GET['act']=="tambahalur"){
$uid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoalur) as max_no FROM alurusulan WHERE dNoalur LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("AU-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/duin/aksi_duin.php?act=tambahalur&uid=<?=$uid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Buat Alur Usulan Kirim Kembali</legend>
	<div class="control-group">
		<label class="control-label" for="noalur">Nomor Alur </label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noalur" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>
<?php /*
	if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
	?>
    <div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"><input class="input-small datepicker" id="tglm" type="text" name="tglm" required="required"></div>
    </div>
	<? } else {	 ?>
		<? } */?>
	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
<input  type="hidden" name="tgls" value='0000-00-00'>

    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
		<?php 
		/*
		if($_SESSION[cv]==0 OR $_SESSION[cv]==1 OR $_SESSION[cv]==53){
		        echo "<select id='pengirim' class='chzn-select' name='pengirim'>";    
            
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$_SESSION[cv]){
		    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
					}else{
						echo "<option value='$dcv[cId]'>$dcv[cNama]</option>";
					}
				}
			
		}
		else {
		}
		</select>	
		*/

			echo "<input type=hidden name=pengirim value='$_SESSION[cv]'><b>$_SESSION[namacv]</b>";
            ?>
           	
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
            	<option value="A">Rutin</option>
                <option value="B">Cito</option>
                <option value="C">Super CITO</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima Alur Usulan harus jawab</option>
                <option value="N">Tidak, penerima Alur Usulan tidak perlu jawab</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="uddis" name="uddis[]" class="chzn-select span4">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian, cJabatan FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[cJabatan] - $dcv[cNama]</option>";
				}
				?>                             
            </select>
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi</label>
        <div class="controls">
			<textarea name="isi" id="editor"></textarea>
        </div>
	</div>
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran Usulan (Jika ada)</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<?php
}elseif($_GET['act']=="editalur"){
$uid=$_GET['id'];
$acak            = rand(1,99);
$acak2           = rand(1,99);
$bln			 = date("m/Y");
$thn			 = date("Y");	
$tgl			 = date("d-M-Y");
$tgl1			 = date("Y-m-d");

$query = "SELECT max(dNoalur) as max_no FROM alurusulan WHERE dNoalur LIKE '%$thn%'";
$hasil = mysql_query($query);
$hitung = mysql_num_rows($hasil);
$data  = mysql_fetch_array($hasil); 
$idMax = $data['max_no'];
$noUrut = (int) substr($idMax, 3, 4);
$noUrut++;
$newID = sprintf("AU-%04s/$_SESSION[nppcv]/$bln", $noUrut);

?>
<form method="post" action="include/duin/aksi_duin.php?act=editalur&uid=<?=$uid;?>" enctype="multipart/form-data" class="form-horizontal">
<fieldset>
<legend>Edit Alur Usulan Kirim Kembali</legend>
	<div class="control-group">
		<label class="control-label" for="noalur">Nomor Alur </label>
        <div class="controls"><input class="input-medium focused" id="noagenda" type="hidden" name="noalur" value="<? echo "$newID" ?>" required="required"><?=$newID;?></div>
    </div>

	<div class="control-group">
		<label class="control-label" for="tglm">Tanggal</label>
        <div class="controls"> <?
		$tgl			 = date("d-M-Y");
		$tgl1			 = date("Y-m-d");
		echo "<input type=hidden name='tglm' value='$tgl1'><b>$tgl</b>";  ?></div>
    </div>
    <div class="control-group">
		<label class="control-label" for="pengirim">Pengirim</label>
        <div class="controls">
		<?php
		
		    if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])){
		            echo "<select id='pengirim' class='chzn-select' name='pengirim'>";
            
				$cv = mysql_query("SELECT cId, cNama FROM users");
				while ($dcv=mysql_fetch_array($cv)){
					if ($dcv[cId]==$_SESSION[cv]){
		    	     	echo "<option value='$dcv[cId]' selected>$dcv[cNama]</option>";
					}else{
					}
				}
			
		}
		else {

			echo "<input type=hidden name=pengirim value=$_SESSION[cv]><b>$_SESSION[namacv]</b>";
		}
			
		?>
           	</select>
        </div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="sifat">Sifat</label>
        <div class="controls">
        	<select id="sifat" name="sifat" class="span2">
            	<option value="A">Rutin</option>
                <option value="B">Cito</option>
                <option value="C">Super CITO</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="jawab">Perlu Jawaban?</label>
        <div class="controls">
        	<select id="jawab" name="jawab" class="span2">
            	<option value="Y" selected>Ya, penerima Alur Usulan harus jawab</option>
                <option value="N">Tidak, penerima Alur Usulan tidak perlu jawab</option>
            </select>
		</div>
    </div>
	<div class="control-group">
    	<label class="control-label" for="isi">Kepada</label>
    <div class="controls">
        	<select multiple="multiple" id="uddis" name="uddis[]" class="chzn-select span4" required="required">
             	<?php
				$cv = mysql_query("SELECT cId, cNama, bagian FROM users");
				while ($dcv=mysql_fetch_array($cv)){
	    	     	echo "<option value='$dcv[cId]'>$dcv[bagian] - $dcv[cNama]</option>";
				}
				?>                             
            </select>*Bisa Pilih Grup 
        </div> 
		</div>
    <div class="control-group">
    	<label class="control-label" for="isi">Instuksi/Informasi</label>
        <div class="controls">
			<textarea name="isi" id="editor"></textarea>
        </div>
	</div>
	<div class="control-group">
    	<label class="control-label" for="fileInput">Lampiran Usulan (Jika ada)</label>
        <div class="controls">
        	<input class="input-file uniform_on" id="fileInput" type="file" name="fupload"> Max. 15 MB
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
        <button class="btn btn-primary">Kirim</button> 
        <button type="reset" class="btn" onclick=self.history.back()>Batal</button>
        </div>
    </div>
</fieldset>
</form>
<!-- batas dari alurusulan.php -->
<?php
}else{
?>
<div>
     <form method="post" action='home1.php?pages=printduin' target=_blank>

        <div class="control-group">
    		<label class="control-label" for="lokasi2">Bulan Dan Tahun</label>
            <div class="controls"><input type="date" name="blnn1"> s/d <input type="date" name="blnn2"> </div>
        </div>
        
        <input class="btn btn-primary" type="submit" value="Export" />
    </form>
</div>
	<hr>
	<div style="width:auto;overflow-x:auto;">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="Tb14" width="100%">
	<thead>
		<tr>
		<th style="display: none;"></th>
		<th></th>
			<th>Tanggal Kirim User</th>
			<th>Tanggal Kirim CC</th>
			<th>Tanggal Terima MR</th>
			<?php 
			if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])){
		     ?>
			<th>Alur Usulan</th>
			<?php } ?>
			<th>Kode Dok</th>
			<th>Rev</th>
			<th>Judul Dok</th>
			<th>Jenis Usulan Dok</th>
			<th>Pengusul</th>
			<th>Status</th>
            <th width=20%>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	

if($_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==99 OR $_SESSION[cv]==1060 OR $_SESSION[cv]==1000){
    $udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' ORDER by udstatus!='2' DESC, cctgl_status='0000-00-00' DESC, udtgl DESC, ccstatus='N' DESC");	 
}else{
    // $udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND udtgl_terima!='0000-00-00' AND ccstatus='Y' OR udstatus2='Y' AND udtgl_selesai!='0000-00-00' AND ccstatus='Y' ORDER by udstatus!='2' DESC, udtgl_terima='0000-00-00' DESC, udtgl DESC, udstatus1 ASC");	 
    $udmasuk = mysql_query("SELECT * FROM udokumen WHERE udstatus2='Y' AND ccstatus='Y' ORDER by udstatus!='2' DESC, udtgl_terima='0000-00-00' DESC, udtgl DESC, udstatus1 ASC");	 
}
			   
				
		while($s = mysql_fetch_array($udmasuk)) {
		    
		if($_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==99 OR $_SESSION[cv]==1060 OR $_SESSION[cv]==1000){
		    if($s[ccstatus]=='N' AND $s[cctgl_status]='0000-00-00' ){
		        echo "<tr class=success>";
		    }else{
		        echo "<tr>";
		    }
		    
		}elseif($s[udstatus]!=2 ){
			echo "<tr class=success>";
		}else{
			echo "<tr>";
		}
				echo "<td style='display: none;'></td><td>$s[udstatus1]</td>";
				echo"<td>";echo tgl_indo($s[udtgl_kirimusulan]); echo"</td>";
				echo"<td>";echo tgl_indo($s[cctgl_status]); echo"</td>";
				echo"<td>";echo tgl_indo($s[udtgl_terima]); echo"</td>"; ?>
<?php 
			if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])){ 
				echo "
				<td class='center'>";
				if($_SESSION[cv]==0 AND $s[udtgl_terima]!='0000-00-00' OR $_SESSION[cv]==1 OR $_SESSION[cv]==1051 OR $_SESSION[cv]== 1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059 OR $_SESSION[cv]==1000 AND $s[udtgl_terima]!='0000-00-00' OR $_SESSION[cv]==53 AND $s[udtgl_terima]!='0000-00-00'){
    				$ds = mysql_query("SELECT * FROM alurusulan WHERE uid='$s[uid]'");
    				$jr = mysql_num_rows($ds);
    				
    					if ($jr<1){
    						echo "<a href='?pages=usulandok&act=tambahalur&id=$s[uid]' class='btn btn-info'>Buat</a>";
    					}else{
    						echo "<a href='?pages=usulandok&act=tambahalur&id=$s[uid]' class='btn btn-info'>Tmbh</i>";
    					}
				}
}
			echo "</td>";
    				
			$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE cId='$s[udpengusul2]'"));
			echo "<td>$s[ukodok]</td>
				<td>$s[udrev]</td>
                <td>$s[ujudok]</td>";
				
				
				echo"<td>"; 
				    if ($s[jenisud]==1) { 
				        echo"<b>Usulan Pembuatan Dokumen Baru</b>";
				        
				    }elseif ($s[jenisud]==2) { 
				        echo"<b>Usulan Perubahan Dokumen</b>";
				        
				    }else { echo"<b>Usulan Penghapusan Dokumen</b>";}
	            echo"</td>
	            
				<td>$user[cJabatan]</td>";
				if($s[ccstatus]=='N' AND $s[cctgl_status]='0000-00-00' AND $_SESSION[cv]==81 OR $_SESSION[cv]==55 OR $_SESSION[cv]==99 OR $_SESSION[cv]==1060 OR $_SESSION[cv]==1000){
				    
				    if($s[ccstatus]=='Y' AND $s[cctgl_status]!='0000-00-00'){
				        echo"<td>Usulan Terima CC / Blm diterima SSDR</td>";
				    
				    }else{
    				      echo"<td>Usulan Belum Diterima
            			<a href='home.php?pages=usulandok&act=terimacc&id=$s[uid]' title='Detail, Klik disini' class='btn btn-success'> Terima Usulan </a>";
    				      echo"
            			<a href='home.php?pages=usulandok&act=returncc&id=$s[uid]' title='Return, Klik disini' class='btn btn-warning'> Return Usulan </a></td>";
				    
				    }
				    
				    
				}elseif($s[udstatus]==1 AND $s[udtgl_terima]=='0000-00-00' AND $_SESSION[cv]==1 OR $_SESSION[cv]==53 OR $_SESSION[cv]==1051 OR $_SESSION[cv]==1052 OR $_SESSION[cv]==1054 OR $_SESSION[cv]==1055 OR $_SESSION[cv]==1056 OR $_SESSION[cv]==1057 OR $_SESSION[cv]==1058 OR $_SESSION[cv]==1059 OR $_SESSION[cv]==1000 ){
				    
				    if ($s[ccstatus]=='N'){
				        echo"<td>Usulan Belum diterima</td>";
				    }
				    
				    elseif($s[udstatus]==1 AND $s[udstatus1]=='N' AND
                            $s['udtgl_terima'] == '0000-00-00'){
        				   
        			    echo"<td>Usulan diterima CC / Blm diterima SSDR<br> <a href='home.php?pages=usulandok&act=terima&id=$s[uid]' title='Terima Usulan' class='btn btn-info'>Terima</a>";
        				    
				    }
    				elseif ($s[udstatus]==1 AND  $s[udstatus1]=='Y'){echo"
    				    <td>Diterima";}
    				elseif ($s[udstatus]==2){echo"
    				    <td>Selesai/Net";}
    				elseif ($s[udstatus]==3){echo"
    				    <td>Pending";}
    				elseif ($s[udstatus]==4){echo"
    				    <td>Tdk Jadi";}
    				else{echo"
    				    <td>-</td>";}
				}else{
				if($s[udstatus]==1 AND $s[udtgl_terima]!='0000-00-00'){
				        echo"<td>Diterima";
				    
				}elseif ($s[udstatus]==2){echo"
    				    <td>Selesai/Net";
				    
				}elseif ($s[udstatus]==3){echo"
    				    <td>Pending";
				    
				}elseif ($s[udstatus]==4){echo"
    				    <td>Tdk Jadi";
				}else{echo"
    				    <td>Usulan diterima CC</td>";}
				}
				
				
				echo "<td class='center'>";
				if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1051, 1054, 1055, 1056, 1057, 1058])){
				    if($s[udstatus1]!='Y'){
				    //   echo"<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> ";
    				}
				 if(in_array($_SESSION['cv'], [0, 1, 53, 1000, 1051, 1054, 1055, 1056, 1057, 1058])){
        				  
				            echo" <a href='?pages=usulandok&act=edit2&id=$s[uid]' title='Edit atau Update Usulan'> <i class='icon-pencil'></i> </a>  ";
				            // echo"<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> ";
				            
                            echo "<a href='javascript:void(0);' onClick=\"hapusDokumen('$s[uid]')\"> <i class='icon-trash'></i></a> ";
        				}else{
        				    echo" <a href='?pages=usulandok&act=edit&id=$s[uid]' title='Edit atau Update Usulan'> <i class='icon-pencil'></i></a>  ";
        				}
        				// if (
                            // $s['udstatus'] != 2 && // Status bukan Selesai/Net
                            // ($s['udstatus1'] == 'Y' || 
                            // ($s['udtgl_terima'] != '0000-00-00' && $s['udtgl_selesai'] == null && $s['udstatus1'] != '2'))
                            
                            // $s['udtgl_terima'] != '0000-00-00'
                        // ) {
                            echo "<a href='home.php?pages=usulandok&act=selesai&id=$s[uid]' title='Usulan Dok. Selesai - Klik Disini' class='btn btn-info'> Selesai</a>";
                        // } else {
                            // Kondisi Jika Usulan sudah net/selesai
                            
                            // echo "<a href='home.php?pages=dister&act=tambah2&id=$s[ukodok]' title='Usulan Dok. Selesai - Klik Disini' class='btn btn-info'> Dist Dokumen</a>";
                        // }
    				}elseif(in_array($_SESSION['cv'], [55, 81, 99, 1060])){
    				    echo"<a href='include/duin/aksi_duin.php?act=hapus&id=$s[uid]' onClick=\"return confirm('Yakin ingin menghapus??')\"> <i class='icon-trash'></i></a> ";
    				     echo" <a href='?pages=usulandok&act=edit2&id=$s[uid]' title='Edit atau Update Usulan'> <i class='icon-pencil'></i> </a>";
    				}
				echo" <a href='home.php?pages=usulandok&act=detail&id=$s[uid]' title='Detail, Klik disini' class='btn btn-warning'> Detail</a>
				</td>
				</tr>";	
		
	}
	?>
	</tbody>
</table>
<div style="width:auto;overflow-x:auto;">
<br><br>
	<span class="label label-info">
	<h5>Notifikasi di menu kiri = belum diterima SSDR.<br> Baris Tabel Berwarna HIJAU = <strong>USULAN BELUM SELESAI</strong><br>
	(E) = Untuk edit usulan.<br>
	(D) = Masuk ke Detail dan untuk Konfirmasi Terima Usulan (oleh SSDR) <br>dan Cek Alur Usulan Kirim-Kembali. <br>
	(S) = Jika usulan selesai klik (S).</h5>
	</span>
</div>
</div>
<?php
}
?>
</div><!--/span12-->
</div><!--/block-content-->
 <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script>
        function hapusDokumen(uid) {
            // Prompt untuk alasan penghapusan
            let alasan = prompt("Masukkan alasan penghapusan dokumen:");
            if (alasan === null || alasan.trim() === "") {
                alert("Penghapusan dibatalkan.");
                return;
            }
        
            // Redirect ke aksi PHP dengan alasan sebagai parameter
            window.location.href = `include/duin/aksi_duin.php?act=hapus&id=${uid}&alasan=${encodeURIComponent(alasan)}`;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
        		const jabatanFilter = document.getElementById('jabatan_filter');
        		const disinSelect = document.getElementById('disin');
        		const options = disinSelect.querySelectorAll('option');
        
        		jabatanFilter.addEventListener('change', function() {
        			const selectedJabatan = this.value.toUpperCase(); // Ubah nilai filter menjadi huruf besar
        
        			options.forEach(option => {
        				if (selectedJabatan === '' || option.dataset.jabatan.includes(selectedJabatan)) {
        					option.style.display = 'block';
        				} else {
        					option.style.display = 'none';
        				}
        			});
        
        			// Memperbarui tampilan Chosen.js setelah memfilter opsi
        			$(disinSelect).trigger("chosen:updated");
        		});
        
        		// Inisialisasi Chosen.js setelah elemen DOM dimuat
        		$(disinSelect).chosen();
        	});

        // let button = document.getElementById("btnn")
        // let input = document.getElementById("ujudok")
        // input.addEventListener("input", function(e) {
        // 	if(input.value.length < 1) {
        //       	button.disabled = true
        //       } else {
        //       	button.disabled = false
        //       }
        // });
        
</script>
