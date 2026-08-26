<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nomor Batch ke PDF</title>
    <style>
        #kode_dokumen {
            z-index: 1050; /* Pastikan elemen dropdown berada di atas elemen lainnya */
            position: relative; /* Untuk memastikan z-index bekerja */
        }
    
        .block-content {
            overflow: visible; /* Pastikan konten dalam div tidak tersembunyi */
        }
    
        .chzn-container {
            z-index: 1050 !important; /* Jika Anda menggunakan plugin seperti Chosen */
        }
        .spinner-border {
            width: 1.5rem;
            height: 1.5rem;
            border-width: 0.2em;
        }

    </style>

    <script src="../../config/pdf-lib.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@4.0.2/dist/tesseract.min.js"></script>
</head>
<body>
   <div class="block-content collapse in" style="overflow: visible;">
    <div class="card">
        <div class="card-body">
            <legend class="mb-4">Detail Permintaan Copy Batch Record</legend>
                <?php
                    session_start();
                    $userId = $_SESSION[cv]; // Ambil ID user dari session
                    $idPermintaan = $_GET['permintaanId']; // Ambil ID permintaan dari URL
                    
                            $query = "SELECT COUNT(*) as total_notif 
                                      FROM notifikasi_status_permintaan_bets 
                                      WHERE user_id = '$userId' AND sudah_dilihat = 'N'";
                            $result = mysql_query($query);
                            $data = mysql_fetch_assoc($result);
                        
                    
                             $getdatabaca = "
                                                SELECT COUNT(*) as total_notif 
                                                FROM notifikasi_status_permintaan_bets ns
                                                INNER JOIN permintaan_dokumen_batch pdb ON ns.id_permintaan = pdb.id_permintaan
                                                WHERE ns.user_id = '$userId' 
                                                  AND ns.sudah_dilihat = 'Y' 
                                                  AND pdb.status = 'dicetak'
                                            ";

                            $resultdatabaca = mysql_query($getdatabaca);
                            $databaca = mysql_fetch_assoc($resultdatabaca);
                            
                            $notifCount = $data['total_notif'];
                            $notifCountCetak = $databaca['total_notif'];
                    
                        if($notifCount > 0){
                                // Update status notifikasi
                                $query = "UPDATE notifikasi_status_permintaan_bets 
                                          SET sudah_dilihat = 'Y', waktu_dilihat = NOW() 
                                          WHERE id_permintaan = '$idPermintaan' AND user_id = '$userId'";
                                mysql_query($query) or die(mysql_error());
                        }elseif($notifCountCetak > 0){
                             // Update status notifikasi
                                $query = "UPDATE notifikasi_status_permintaan_bets 
                                          SET sudah_dilihat_cetak = 'Y', waktu_dilihat_cetak = NOW() 
                                          WHERE id_permintaan = '$idPermintaan' AND user_id = '$userId'";
                                mysql_query($query) or die(mysql_error());
                        }
                ?>
            <?php
            $detailpermintaan = mysql_fetch_array(mysql_query("SELECT * FROM permintaan_dokumen_batch WHERE id_permintaan='$_GET[permintaanId]'"));
            
            if($detailpermintaan[dikodok] != null) {
                $detaildokumen = mysql_fetch_array(mysql_query("SELECT * FROM dinter WHERE dikodok='$detailpermintaan[dikodok]'"));
            }
            ?>

            <!-- Detail Permintaan -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th class="w-25">Kode Dokumen</th>
                            <td><?= $detailpermintaan['dikodok']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Dokumen</th>
                            <td><?= isset($detaildokumen['dijudok']) ? $detaildokumen['dijudok'] : 'Tidak tersedia'; ?></td>

                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td><?= $detailpermintaan['nama_produk']; ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Bets</th>
                            <td><?= $detailpermintaan['nomor_batch']; ?></td>
                        </tr>
                        <tr>
                            <th>Besar Bets</th>
                            <td><?= $detailpermintaan['besaran_bets']; ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Dokumen</th>
                            <td><?= $detailpermintaan['jenis_dokumen']; ?></td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td><?= $detailpermintaan['catatan']; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?= $detailpermintaan['status'] === 'diminta' 
                                    ? '<span class="label label-warning">Diminta</span>' 
                                    : '<span class="label label-success">Dicetak</span>'; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Lampiran</th>
                            <td>
                                  <?php
                                        $directory = '../../copy_ebr/lampiran_copyebr';
                                        $files = scandir($directory);
                                        
                                        if ($detailpermintaan['file_lampiran'] !== null) {
                                            $filePath = $directory . '/' . $detailpermintaan['file_lampiran'];
                                        
                                            // if (file_exists($filePath)) {
                                                echo "<div class='card'>";
                                                echo "<ul class='list-group list-group-flush' style='list-style-type: none; padding-left: 0;'>"; // Menghapus bullet points
                                                
                                                $fileUrl = str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath($filePath)); // Konversi ke URL relatif
                                                
                                                echo "<li class='list-group-item d-flex justify-content-between align-items-center' style='border: none;'>"; // Menghapus border jika diinginkan
                                                echo "<a href='../../include/copy_ebr/lampiran_copyebr/$detailpermintaan[file_lampiran]' target='_blank' class='btn btn-sm btn-success'>Lihat File</a>";
                                                echo "</li>";
                                                
                                                echo "</ul>";
                                                echo "</div>";
                                            // } else {
                                            //     // File tidak ditemukan meskipun ada entri di database
                                            //     echo "<div class='alert alert-warning'>Tidak Menyertakan lampiran file!</div>";
                                            // }
                                        } else {
                                            // Tidak ada file terkait di database
                                            echo "<div class='alert alert-warning'>Tidak ada file terkait di direktori ini.</div>";
                                        }
?>

                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php 
            
			if(in_array($_SESSION['cv'], [0, 1, 51, 53, 1000, 1052, 1055, 1054, 1051, 1059, 1058, 1056, 1057])){
                    if($detailpermintaan['status'] != 'dicetak'){?>
                        <!-- Pilihan Dokumen -->
                        <div class="mb-4">
                            <label for="kode_dokumen" class="form-label">Nama Dokumen</label>
                            <select id="kode_dokumen" class="form-select" name="kode_dokumen" required onchange="handleDokumenChange(this)">
                                <option value="" disabled selected>Pilih Dokumen</option>
                                <?php
                                $vc = mysql_query("SELECT jenisdok, difile, dijudok, dikodok FROM dinter");
                                while ($dvc = mysql_fetch_array($vc)) {
                                    echo "<option value='$dvc[dikodok]'>$dvc[dikodok] | $dvc[dijudok]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <div id="fileList" class="mb-3">Pilih File diatas untuk diproses memasukkan nomor batch!</div>
                        <div id="manualUpload" class="mb-4" style="display:none; margin-top:20px;">
                            <h5>Upload File Secara Manual</h5>
                            <input type="file" id="manualFileInput" class="form-control mb-2" accept="application/pdf" onchange="toggleAddBatchButton()" />
                            <button class="btn btn-primary" onclick="processManualFile()">Proses File</button>
                        </div>
                        <!-- Tambahkan elemen spinner untuk loading -->
                        <button id="addBatch" class="btn btn-primary mb-3" style="display:none;" onclick="processSelectedFile()">Tambahkan Nomor Batch Ke File</button>
                        <div id="loadingSpinner" style="display:none; margin-top:10px; text-align:center;">
                            <span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
                            <span>Processing...</span>
                        </div>
        
                        <!--<button id="addBatch" class="btn btn-primary mb-3" style="display:none;" onclick="processSelectedFile()">Tambahkan Nomor Batch Ke File</button>-->
                        <p id="errorMsg" class="text-danger" style="display:none;"></p>
            
                        <hr>
            
                        <p><a id="downloadLink" class="btn btn-success" style="display:none;">Unduh PDF Baru</a></p>
                    <?php }else{?>
                        <div class="mb-3">Dokumen telah dicetak!</div>
                    <?php }?>
                    <?php if($detailpermintaan[status] != 'dicetak'){?>
                            <div class="mb-4">
                                 <form method="post" action="include/copy_ebr/aksi_copyebr.php?act=selesaipermintaanEbr" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="controls">
                                            <input id="idPermintaan" type="hidden" name="idPermintaan" value="<?php echo $detailpermintaan[id_permintaan] ?>">
                                            <input id="dikodok" type="hidden" name="dikodok" value="">
                                        
                                        </div>
                                            <div class="control-group">
                                                <button id="tombol-selesai" style="display:none;" class="btn btn-info">Selesai</button><br>
                                                    <small>
                                                        * Untuk menyelesaikan permintaan klik selesai !
                                                    </small>
                                            </div>
                                </form>
                        </div>
                <?php }
			    }
                ?>
        </div>
    </div>
</div>


    <script>
        let selectedFilePath = '';
      
const batchText = "<?= isset($detailpermintaan['nomor_batch']) ? addslashes($detailpermintaan['nomor_batch']) : 'Batch-Unknown'; ?>";
        function handleDokumenChange(selectElement) {
            const kodeDokumen = selectElement.value;
            console.log(`Kode dokumen dipilih: ${kodeDokumen}`);
        
            if (!kodeDokumen) {
                console.error('Kode dokumen tidak valid.');
                return;
            }
        
            // Isi input tersembunyi dengan nilai kode dokumen yang dipilih
            const dikodokInput = document.getElementById("dikodok");
            dikodokInput.value = kodeDokumen; // Masukkan nilai ke input tersembunyi
        
            console.log(`Input hidden "dikodok" diisi dengan: ${dikodokInput.value}`);
        
            // Panggil fungsi fetchFiles untuk memuat file terkait
            fetchFiles(kodeDokumen);
        }

        

        async function fetchFiles(kodeDokumen) {
            console.log(`fetchFiles dipanggil untuk kode dokumen: ${kodeDokumen}`);
            const fileListDiv = document.getElementById('fileList');
            const manualUploadDiv = document.getElementById('manualUpload');
            const addBatchButton = document.getElementById('addBatch');
            const errorMsg = document.getElementById('errorMsg');
        
            try {
                const response = await fetch(`include/copy_ebr/data_ebr.php?kodedokumen=${encodeURIComponent(kodeDokumen)}`);
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                const files = await response.json();
        
                if (files.length === 0) {
                    fileListDiv.innerHTML = '<p>Tidak ada file tersedia untuk kode dokumen ini.</p>';
                    manualUploadDiv.style.display = 'block';
                    addBatchButton.style.display = 'none'; // Sembunyikan tombol jika tidak ada file
                    return;
                }
        
                manualUploadDiv.style.display = 'none'; // Sembunyikan opsi unggah manual
                addBatchButton.style.display = 'inline'; // Tampilkan tombol Tambahkan Nomor Batch Ke File
        
                // Buat daftar file
                const ul = document.createElement('ul');
                ul.style.listStyleType = 'none';
                files.forEach((file, index) => {
                    const li = document.createElement('li');
                    li.textContent = file.name;
                    li.dataset.filePath = file.path;
                    li.style.cursor = 'pointer';
                    li.addEventListener('click', () => selectFile(file.path));
                    ul.appendChild(li);
        
                    // Otomatis pilih file pertama
                    if (index === 0) {
                        selectFile(file.path);
                    }
                });
        
                fileListDiv.innerHTML = '';
                fileListDiv.appendChild(ul);
            } catch (error) {
                console.error(`Error: ${error.message}`);
                fileListDiv.innerHTML = '<p>Gagal memuat daftar file.</p>';
                errorMsg.style.display = 'block';
                errorMsg.textContent = `Error: ${error.message}`;
                addBatchButton.style.display = 'none'; // Sembunyikan tombol jika terjadi error
            }
        }
        
        function selectFile(filePath) {
            selectedFilePath = filePath;
            console.log(`File terpilih: ${filePath}`);
        
            // Tampilkan tombol Tambahkan Nomor Batch Ke File
            const addBatchButton = document.getElementById('addBatch');
            addBatchButton.style.display = 'inline';
        }
        
        function toggleAddBatchButton() {
            const manualUploadDiv = document.getElementById('manualUpload');
            const addBatchButton = document.getElementById('addBatch');
        
            // Jika file manual dipilih, sembunyikan tombol "Tambahkan Nomor Batch Ke File"
            if (document.getElementById('manualFileInput').files.length > 0) {
                addBatchButton.style.display = 'none';
            }
        }
        
        async function processSelectedFile() {
            const addBatchButton = document.getElementById('addBatch');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const manualUploadDiv = document.getElementById('manualUpload');
        
            if (!selectedFilePath) {
                alert('Klik File Pada bagian bawah Pilih Dokumen terlebih dahulu!');
                return;
            }
        
            // Tampilkan loading spinner dan nonaktifkan tombol
            loadingSpinner.style.display = 'block';
            addBatchButton.disabled = true;
        
            try {
                const response = await fetch(selectedFilePath);
                if (!response.ok) throw new Error(`Gagal memuat file PDF: ${response.status}`);
                const arrayBuffer = await response.arrayBuffer();
        
                await processPDF(arrayBuffer); // Tunggu proses selesai
            } catch (error) {
                console.error("Error:", error);
                alert('Terjadi kesalahan saat memproses file, Upload dokumen dengan manual');
                
                manualUploadDiv.style.display = 'block';
                addBatchButton.style.display = 'none';
            } finally {
                // Sembunyikan loading spinner dan aktifkan tombol kembali
                loadingSpinner.style.display = 'none';
                addBatchButton.disabled = false;
            }
        }


        

    async function processManualFile() {
        const manualFileInput = document.getElementById('manualFileInput');
        const addBatchButton = document.getElementById('addBatch');
        const loadingSpinner = document.getElementById('loadingSpinner');
        if (!manualFileInput.files.length) {
            alert('Pilih file untuk diunggah.');
            return;
        }
        loadingSpinner.style.display = 'block';
        addBatchButton.style.display = 'none'; // Sembunyikan tombol Tambahkan Nomor Batch Ke File
    
        const file = manualFileInput.files[0];
        try {
            const arrayBuffer = await file.arrayBuffer();
            await processManualPDF(arrayBuffer, file.name); // Gunakan fungsi khusus untuk file manual
        } catch (error) {
            console.error("Error:", error);
            alert('File tersebut di Password! Upload secara manual untuk ditambahkan nomor batch.');
        }
    }

    async function processManualPDF(arrayBuffer, fileName = 'output.pdf') {
        try {
            const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);
            const pages = pdfDoc.getPages();
            const batchText = `<?= $detailpermintaan['nomor_batch']; ?>`;
            const kodeDokumen = document.getElementById("dikodok").value;
            const loadingSpinner = document.getElementById('loadingSpinner');
            const textSize = 15;
            const textColor = PDFLib.rgb(1, 0, 0);
            // Embed a standard font (Helvetica-Bold)
            const font = await pdfDoc.embedFont(PDFLib.StandardFonts.HelveticaBold);
    
             console.log(`Total Pages: ${pages.length}`);
    
            // pages.forEach((page, index) => {
            //     const { width, height } = page.getSize();
    
            //     console.log(`Page ${index + 1} - Width: ${width}, Height: ${height}`);
    
            //     let xPosition;
            //     let yPosition;
    
            //     if (Math.abs(width - 952.8) < 0.1 && Math.abs(height - 611.75) < 0.1) { // F4 size
            //         console.log(`Page ${index + 1}: F4 size detected.`);
            //         xPosition = 100; // Penyesuaian untuk F4
            //         yPosition = height - 200;
            //     } else if (Math.abs(width - 841.9) < 0.1 && Math.abs(height - 598.3) < 0.1) { // A4 size
            //         console.log(`Page ${index + 1}: A4 size detected.`);
            //         xPosition = 80; // Penyesuaian untuk A4
            //         yPosition = height - 180;
            //     } else if (Math.abs(width - 595.5) < 0.1 && Math.abs(height - 841.3) < 0.1) { // Custom size
            //         console.log(`Page ${index + 1}: Custom size detected.`);
            //         xPosition = 75; // Penyesuaian untuk ukuran custom
            //         yPosition = height - 150;
            //     } else {
            //         console.log(`Page ${index + 1}: Unknown size.`);
            //         xPosition = 65; // Default posisi
            //         yPosition = height - 100;
            //     }
    
            //     console.log(
            //         `Page ${index + 1}: Drawing text at X: ${xPosition}, Y: ${yPosition}, Rotated: 90°`
            //     );
    
            //     page.drawText(batchText, {
            //         x: xPosition,
            //         y: yPosition,
            //         size: textSize,
            //         color: textColor,
            //         rotate: PDFLib.degrees(90), // Memutar teks ke kanan 90 derajat
            //     });
            // });
    
            pages.forEach((page, index) => {
                const { width, height } = page.getSize();
        
                    // Determine page size based on provided dimensions
                        if (Math.abs(width - 952.8) < 0.1 && Math.abs(height - 611.75) < 0.1) { // F4 size
                                console.log(`Page processPDF 1 : ${index + 1}: F4 size detected - Width: ${width}, Height: ${height}`);
                                const xPosition = width - 150;
                                const yPosition = height - 50;
                                page.drawText(batchText, { x: xPosition, y: yPosition, size: textSize, color: textColor });
                                
                            } else if (Math.abs(width - 841.9) < 0.1 && Math.abs(height - 598.3) < 0.1) { // A4 size
                            
                                console.log(`Page processPDF 2 : ${index + 1}: A4 size detected - Width: ${width}, Height: ${height}`);
                                const xPosition = width - 140;
                                const yPosition = height - 60;
                                page.drawText(batchText, { x: xPosition, y: yPosition, size: textSize, color: textColor });
                                
                            } else if (
                                (width >= 597 && width <= 599) &&
                                (height >= 854 && height <= 873)
                            ) { 
                                
                               console.log(`Page processPDF 3 : ${index + 1}: Custom detected - Width: ${width}, Height: ${height}`);
                                const xPosition = 60; 
                                const yPosition = height - 170; 
                                const rotation = PDFLib.degrees(90); 
                                
                                page.drawText(batchText, { 
                                    x: xPosition, 
                                    y: yPosition, 
                                    size: textSize, 
                                    color: textColor,
                                    font: font,
                                    rotate: rotation 
                                });
                
                            } else {
                                
                                console.log(`Page processPDF 4 : ${index + 1}: Unknown size - Width: ${width}, Height: ${height}`);
                                // const xPosition = width - 140;
                                // const yPosition = height - 60;
                                // page.drawText(batchText, { x: xPosition, y: yPosition, size: textSize, color: textColor });
                                  const xPosition = 60; 
                                    const yPosition = height - 170; 
                                    const rotation = PDFLib.degrees(90); 
                                    
                                    page.drawText(batchText, { 
                                        x: xPosition, 
                                        y: yPosition, 
                                        size: textSize, 
                                        font: font,
                                        color: textColor,
                                        rotate: rotation 
                                    });

                            }
                        });
        
            // Simpan PDF yang telah diperbarui
            const pdfBytes = await pdfDoc.save();
            const blob = new Blob([pdfBytes], { type: "application/pdf" });
            const link = document.getElementById("downloadLink");
            const tombolSelesai = document.getElementById("tombol-selesai");
            loadingSpinner.style.display = 'none';
            tombolSelesai.style.display = "inline";
            link.href = URL.createObjectURL(blob);
            link.download = `${batchText}-${selectedFilePath.split("/").pop()}`; // Gunakan nama file yang dikirim dari processManualFile
            link.style.display = "inline";
            link.textContent = "Unduh PDF Baru";
        } catch (error) {
            if (error.message.includes("Encrypted PDF")) {
                alert("Dokumen PDF ini dienkripsi /password dan tidak dapat diproses. Harap gunakan PDF tanpa enkripsi.");
            } else {
                console.error("Error:", error);
                alert("Terjadi kesalahan saat memproses file, Upload Dokumen Dengan Manual!");
            }
    
            // Tampilkan manualUpload
            const manualUploadDiv = document.getElementById('manualUpload');
            manualUploadDiv.style.display = 'block';
        }
    }

    // async function processPDF(arrayBuffer) {
    //     try {
    //         const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);
    //         const pages = pdfDoc.getPages();
    
    //         const textSize = 15;
    //         const textColor = PDFLib.rgb(1, 0, 0);
    //         const font = await pdfDoc.embedFont(PDFLib.StandardFonts.HelveticaBold);
    
    //         // Daftar ukuran halaman dengan posisi yang sudah diperbaiki
    //         // Daftar ukuran halaman dengan rotasi
    //         const knownSizes = [
    //             { name: "A4", width: 595.44, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
    //             { name: "A4 Variant 1", width: 596.16, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
    //             { name: "A4 Variant 2", width: 597.36, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
    //             { name: "A4 Variant 3", width: 596.64, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
    
    //             // Ukuran Custom
    //             { name: "Custom 1", width: 597.84, height: 878.16, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Custom 2", width: 596.12, height: 876.72, xFixed: 525, yFixed: 680, rotation: 270},
    //             // { name: "Custom 3", width: 612, height: 955.2, xFixed: 60, yFixed: 850, rotation: 90 },
    //             { name: "Custom 3", width: 612, height: 955.2, xFixed: 570, yFixed: 150, rotation: 270 },
    
    //             // Ukuran 
    //             // { name: "Log Custom A", width: 595.2, height: 855.12, xFixed: 525, yFixed: 150, rotation: 270 },
    //             { name: "Log Custom A", width: 595.2, height: 855.12, xFixed: 70, yFixed: 740, rotation: 90 },
    //             // { name: "Log Custom A", width: 595.2, height: 855.12, xFixed: 520, yFixed: 190, rotation: 270 },
    //             { name: "Log Custom B", width: 596.88, height: 855.12, xFixed: 525, yFixed: 150, rotation: 270 },
    //             // { name: "Log Custom B", width: 596.88, height: 855.12, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log Custom C", width: 596.16, height: 855.12, xFixed: 530, yFixed: 200, rotation: 270 },
    //             // { name: "Log Custom D", width: 596.64, height: 857.04, xFixed: 525, yFixed: 150, rotation: 270 },
    //             { name: "Log Custom D", width: 596.64, height: 857.04, xFixed: 70, yFixed: 740, rotation: 90 },
                
    //             { name: "Log Custom E", width: 597.6, height: 856.56, xFixed: 60, yFixed: 740, rotation: 90 },
    //             // { name: "Log Custom F", width: 597.6, height: 858, xFixed: 525, yFixed: 150, rotation: 270 },
    //             { name: "Log Custom F", width: 597.6, height: 858, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log Custom G", width: 597.6, height: 856.8, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log Custom H", width: 597.6, height: 856.56, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log Custom I", width: 596.64, height: 857.04, xFixed: 525, yFixed: 200, rotation: 270 },
    
    //             // { name: "Log 9", width: 595.2, height: 857.76, xFixed: 60, yFixed: 740, rotation: 90 },
    //             // { name: "Log 9", width: 595.2, height: 857.76, xFixed: 60, yFixed: 740, rotation: 90 },
    //             // { name: "Log", width: 597.12, height: 860.64, xFixed: 525, yFixed: 150, rotation: 270 },
    //             { name: "Log", width: 597.12, height: 860.64, xFixed: 70, yFixed: 740, rotation: 90 },
    //             // { name: "Log", width: 597.12, height: 860.64, xFixed: 510, yFixed: 190, rotation: 270 },
    //             { name: "Log Extra", width: 597.12, height: 860.64, xFixed: 525, yFixed: 200, rotation: 270 },
    //             { name: "Log New1", width: 597.12, height: 859.44, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log New2", width: 598.32, height: 860.4, xFixed: 60, yFixed: 740, rotation: 90},
    //             { name: "Log New3", width: 598.56, height: 859.2, xFixed: 60, yFixed: 740, rotation: 90},
    //             { name: "Log New4", width: 598.08, height: 859.68, xFixed: 525, yFixed: 200, rotation: 270 },
    //             { name: "Log 20", width: 597.6, height: 858.24, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log 20", width: 597.6, height: 858.24, xFixed: 530, yFixed: 200, rotation: 270 },
    //             // { name: "Log 18", width: 594.2, height: 857.04, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log 18", width: 594.2, height: 857.04, xFixed: 525, yFixed: 160, rotation: 270 },
    //             { name: "Log 19", width: 596.64, height: 856.56, xFixed: 60, yFixed: 740, rotation: 90 },
    //             { name: "Log 21", width: 597.12, height: 856.32, xFixed: 60, yFixed: 740, rotation: 90 },
    
    //             // Ukuran Wide
    //             { name: "Wide 1", width: 859.92, height: 597.36, xFixed: 690, yFixed: 525, rotation: 0 },
    //             { name: "Wide 2", width: 860.4, height: 597.84, xFixed: 690, yFixed: 525, rotation: 0 },
    //             { name: "Wide 3", width: 955.9, height: 611.75, xFixed: 750, yFixed: 570, rotation: 0 },
    //             { name: "Wide Custom", width: 859.68, height: 597.12, xFixed: 690, yFixed: 525, rotation: 0 },
                
    //               { name: "Log A", width: 841.9, height: 594, xFixed: 690, yFixed: 530, rotation: 0 },
    //                 { name: "Log B", width: 841.9, height: 594.5, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log C", width: 841.9, height: 595.2, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log D", width: 841.9, height: 595.45, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log E", width: 841.9, height: 594.95, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log F", width: 841.9, height: 596.4, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log G", width: 841.9, height: 595.6999999999999, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log H", width: 841.9, height: 595.7, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log I", width: 841.9, height: 595.9, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log J", width: 841.9, height: 594.7, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 { name: "Log K", width: 841.9, height: 595.1999999999999, xFixed: 690, yFixed: 525, rotation: 0 },
                    
    //                 //   { name: "Log4", width: 870.72, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
    //                 //   { name: "Log4", width: 870.72, height: 596.16, xFixed: 120, yFixed: 75, rotation: 180 },
    //                   { name: "Log4", width: 870.72, height: 596.16, xFixed: 720, yFixed: 525, rotation: 0 },
    //                   { name: "Log5", width: 894, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log6", width: 863.28, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log7", width: 864, height: 596.16, xFixed: 690, yFixed: 550, rotation: 0 },
    //                   { name: "Log8", width: 866.16, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log9", width: 865.2, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log10", width: 867.36, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log11", width: 865.92, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log12", width: 864.72, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log13", width: 865.2, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log14", width: 862.08, height: 595.2, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log15", width: 863.04, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log16", width: 863.52, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log17", width: 877.92, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log18", width: 863.28, height: 595.68, xFixed: 690, yFixed: 550, rotation: 0 },
    //                   { name: "Log19", width: 866.16, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log20", width: 864, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log21", width: 864.96, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log22", width: 864.72, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log23", width: 866.88, height: 596.88, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log24", width: 865.2, height: 596.64, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log25", width: 865.92, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log26", width: 863.76, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log28", width: 863.52, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log30", width: 863.04, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log32", width: 863.52, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log33", width: 864.48, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log34", width: 863.52, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log35", width: 866.4, height: 596.4, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log36", width: 863.76, height: 596.4, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log37", width: 863.04, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log38", width: 864, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log39", width: 863.28, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log40", width: 862.8, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log50", width: 857.28, height: 595.68, xFixed: 690, yFixed: 530, rotation: 0 },
    //                   { name: "Log51", width: 891.12, height: 597.59998, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log52", width: 869.52002, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log53", width: 893.76001, height: 599.28003, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log54", width: 870.96002, height: 598.32001, xFixed: 690, yFixed: 525, rotation: 0 },
    //                   { name: "Log55", width: 841.9, height: 591.6, xFixed: 720, yFixed: 520, rotation: 0 },
    //                   { name: "Log56", width: 915.36, height: 596.64, xFixed: 720, yFixed: 520, rotation: 0 },
    //                   { name: "Log57", width: 885.36, height: 596.88, xFixed: 720, yFixed: 520, rotation: 0 },
                        
    //                     // Ukuran baru dari log pemrosesan PDF
    //                 { name: "new1", width: 923.76001, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 }, // Page 1
    //                 { name: "new2", width: 885.12, height: 599.03998, xFixed: 690, yFixed: 525, rotation: 0 },    // Page 2
    //                 { name: "new3", width: 877.20001, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 3
    //                 { name: "new4", width: 880.56, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 11
    //                 { name: "new5", width: 887.76001, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 12
    //                 { name: "new6", width: 888.96002, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },// Page 13
    //                 { name: "new7", width: 867.12, height: 599.03998, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 18
    //                 { name: "new8", width: 866.88, height: 599.03998, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 33
    //                 { name: "new9", width: 873.12, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },      // Page 58
    //                 { name: "new10", width: 863.03998, height: 598.79999, xFixed: 690, yFixed: 525, rotation: 0 }, // Page 66
                    
    //                 { name: "new11", width: 855.84003, height: 597.84003, xFixed: 690, yFixed: 525, rotation: 0 },// Page 4
    //                 { name: "new12", width: 856.79999, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },// Page 7
    //                 { name: "new13", width: 856.56, height: 598.32001, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 55
    //                 { name: "new14", width: 857.03998, height: 597.84003, xFixed: 690, yFixed: 525, rotation: 0 },// Page 94
    //                 { name: "new15", width: 856.32001, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },// Page 96
    //                 { name: "new16", width: 856.56, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },    // Page 99
    //                                 // Ukuran baru dari log terakhir
    //                 { name: "Log54", width: 875.28, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },     // Page 2
    //                 { name: "Log55", width: 882.96, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },     // Page 3
    //                 { name: "Log56", width: 888, height: 595.2, xFixed: 690, yFixed: 525, rotation: 0 },         // Page 21
    //                 { name: "Log57", width: 881.04, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },     // Page 72
    //                 { name: "Log58", width: 859.92, height: 594.96, xFixed: 690, yFixed: 525, rotation: 0 },      // Page 79
    //                 { name: "Log59", width: 952.3, height: 612.25, xFixed: 720, yFixed: 560, rotation: 0 },      // Page 4
    //                 { name: "Log60", width: 952.8, height: 611.75, xFixed: 720, yFixed: 560, rotation: 0 },       // Page 5
                    
    //                 // Ukuran baru dari log terakhir
    //                 { name: "Log70", width: 594.24, height: 860.64, xFixed: 530, yFixed: 150, rotation: 270 },     // Page 11
    //                 { name: "Log80", width: 594.24, height: 859.44, xFixed: 530, yFixed: 150, rotation: 270 },     // Page 13
    //                 { name: "Log90", width: 594.72, height: 859.68, xFixed: 530, yFixed: 150, rotation: 270 },     // Page 17
                    
    //                 { name: "Log100", width: 949.9, height: 611.75, xFixed: 740, yFixed: 570, rotation: 0 },      // Page 4
    //                 { name: "Log101", width: 949.9, height: 612, xFixed: 740, yFixed: 570, rotation: 0 },         // Page 5
    //                 { name: "Log102", width: 949.45, height: 612.25, xFixed: 740, yFixed: 570, rotation: 0 },      // Page 50
                    
    //                 { name: "LogNEW1", width: 902.40002, height: 599.28003, xFixed: 740, yFixed: 530, rotation: 0 },
    //                 { name: "LogNEW2", width: 867.12, height: 602.40002, xFixed: 740, yFixed: 530, rotation: 0 },
    //                 { name: "LogNEW3", width: 946.3, height: 611.05, xFixed: 740, yFixed: 557, rotation: 0 }, // Page 4
                    
                    
    //                 { name: "LogNEW4", width: 912.71997, height: 598.79999, xFixed: 740, yFixed: 545, rotation: 0 },
    //                 { name: "LogNEW5", width: 611.52002, height: 953.03998, xFixed: 560, yFixed: 250, rotation: 270 },
    //                 { name: "LogNEW6", width: 854.64, height: 594.72, xFixed: 650, yFixed: 520, rotation: 0 }, // Page 5
                    
                    
    //                 { name: "LogNEW7", width: 924, height: 600.72, xFixed: 670, yFixed: 530, rotation: 0 }, // Page 48
    //                 { name: "LogNEW8", width: 920.88, height: 598.32, xFixed: 670, yFixed: 530, rotation: 0 }, // Page 49
                    
    //                 { name: "LogNEW9", width: 882.71997, height: 599.03998, xFixed: 670, yFixed: 530, rotation: 0 }, // Page 1
    //                 { name: "LogNEW10", width: 956.15997, height: 608.40002, xFixed: 730, yFixed: 550, rotation: 0 }, // Page 5
                
    //                 { name: "LogNEW11", width: 597.36, height: 865.44, xFixed: 70, yFixed: 740, rotation: 90 },
    //                 // { name: "LogNEW11", width: 597.36, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270 }, 
    //                 { name: "LogNEW12", width: 597.84, height: 863.28, xFixed: 70, yFixed: 740, rotation: 90 }, // Page 4
    //                 // { name: "LogNEW12", width: 597.84, height: 863.28, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 4
    //                 { name: "LogNEW13", width: 598.32, height: 863.28, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 7
    //                 { name: "LogNEW14", width: 597.36, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 11
    //                 { name: "LogNEW15", width: 597.6, height: 864, xFixed: 530, yFixed: 150, rotation: 270  },     // Page 14
    //                 { name: "LogNEW16", width: 598.08, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 22
    //                 { name: "LogNEW17", width: 597.6, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 23
    //                 { name: "LogNEW18", width: 597.36, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 24
    //                 { name: "LogNEW19", width: 597.6, height: 863.28, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 31
    //                 { name: "LogNEW20", width: 597.84, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 32
    //                 { name: "LogNEW21", width: 597.36, height: 866.64, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 49
    //                 { name: "LogNEW22", width: 597.6, height: 868.32, xFixed: 530, yFixed: 150, rotation: 270  },  // Bass 50
    //                 { name: "LogNEW23", width: 598.08, height: 864.72, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 51
    //                 { name: "LogNEW24", width: 597.84, height: 866.4, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 52
    //                 { name: "LogNEW25", width: 597.36, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 53
    //                 { name: "LogNEW26", width: 597.6, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 54
    //                 { name: "LogNEW27", width: 598.08, height: 865.68, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 55
    //                 { name: "LogNEW28", width: 597.6, height: 869.52, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 56
    //                 { name: "LogNEW29", width: 597.6, height: 863.76, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 57
    //                 { name: "LogNEW30", width: 597.84, height: 865.2, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 58
    //                 { name: "LogNEW31", width: 598.08, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 60
    //                 { name: "LogNEW32", width: 597.84, height: 864.96, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 61
    //                 { name: "LogNEW33", width: 597.6, height: 864.48, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 62
    //                 { name: "LogNEW34", width: 598.32, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 63
    //                 { name: "LogNEW35", width: 597.84, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 64
    //                 { name: "LogNEW36", width: 598.32, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 66
    //                 { name: "LogNEW37", width: 598.08, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 67
    //                 { name: "LogNEW38", width: 598.08, height: 864.48, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 68
    //                 { name: "LogNEW39", width: 597.84, height: 863.76, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 69
    //                 { name: "LogNEW40", width: 598.08, height: 865.2, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 70
    //                 { name: "LogNEW41", width: 597.84, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 71
    //                 { name: "LogNEW42", width: 598.08, height: 869.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 72
    //                 { name: "LogNEW43", width: 598.08, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 73
    //                 { name: "LogNEW44", width: 598.08, height: 864, xFixed: 530, yFixed: 150, rotation: 270 },    // Page 74
    //                 { name: "LogNEW45", width: 597.6, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 75
    //                 { name: "LogNEW46", width: 598.08, height: 864.48, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 76
    //                 { name: "LogNEW47", width: 598.08, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 77
    //                 { name: "LogNEW48", width: 598.32, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 79
    //                 { name: "LogNEW49", width: 597.84, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 80
    //                 { name: "LogNEW50", width: 597.6, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270 },   // Page 81
    //                 { name: "LogNEW51", width: 598.08, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 82
    //                 { name: "LogNEW52", width: 597.84, height: 863.52, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 84
    //                 { name: "LogNEW53", width: 597.84, height: 864.72, xFixed: 530, yFixed: 150, rotation: 270 }  // Page 85

    //         ];
    
    //         // Proses setiap halaman PDF
    //         pages.forEach((page, index) => {
    //             const { width, height } = page.getSize();
    
    //             let matchedSize = knownSizes.find(size => 
    //                 Math.abs(width - size.width) < 2 && Math.abs(height - size.height) < 2
    //             );
    
    //             let xPosition, yPosition;
    
    //             if (matchedSize) {
    //                 console.log(`Processing Page ${index + 1}: Width=${width}, Height=${height}, Matched Size=${matchedSize.name}`);
    
    //                 // Gunakan posisi tetap
    //                 xPosition = matchedSize.xFixed;
    //                 yPosition = matchedSize.yFixed;
    //                 textRotation = PDFLib.degrees(matchedSize.rotation);
    
    //             } else {
    //               console.warn(`Processing Page ${index + 1}: Width=${width}, Height=${height} : Unknown size - Using default position.`);
    //                 xPosition = width * 0.10;  // Menggeser teks lebih ke kanan
    //                 yPosition = height * 0.78; // Menurunkan teks lebih ke bawah
    //                 textRotation = PDFLib.degrees(90);
    
    //             }
    
    //             page.drawText(batchText, {
    //                 x: xPosition,
    //                 y: yPosition,
    //                 size: textSize,
    //                 font: font,
    //                 color: textColor,
    //                 rotate: textRotation
    //             });
    //         });
    
    //         // Simpan PDF yang telah diperbarui
    //         const pdfBytes = await pdfDoc.save();
    //         const blob = new Blob([pdfBytes], { type: "application/pdf" });
    //         const link = document.getElementById("downloadLink");
    //         const tombolSelesai = document.getElementById("tombol-selesai");
    
    //         if (tombolSelesai) tombolSelesai.style.display = "inline";
    
    //         if (link) {
    //             link.href = URL.createObjectURL(blob);
    //             link.download = `${batchText}-${selectedFilePath.split("/").pop()}`;
    //             link.style.display = "inline";
    //             link.textContent = "Unduh PDF Baru";
    //         } else {
    //             console.error("Error: Elemen 'downloadLink' tidak ditemukan.");
    //         }
    //     } catch (error) {
    //         if (error.message.includes("Encrypted PDF")) {
    //             alert("Dokumen PDF ini dienkripsi dan tidak dapat diproses. Gunakan PDF tanpa enkripsi.");
    //         } else {
    //             console.error("Error:", error);
    //             alert("Terjadi kesalahan saat memproses file, Upload Dokumen Secara Manual!");
    //         }
    
    //         const manualUploadDiv = document.getElementById('manualUpload');
    //         if (manualUploadDiv) manualUploadDiv.style.display = 'block';
    //     }
    // }

    function getMatchedSizeAdvanced(width, height, rotation, knownSizes, tolerance = 2) {
        const matches = knownSizes.filter(size =>
            Math.abs(size.width - width) < tolerance &&
            Math.abs(size.height - height) < tolerance
        );
    
        if (matches.length === 0) return null;
        if (matches.length === 1) return matches[0];
    
        const matchByRotation = matches.find(size => size.rotation === rotation);
        if (matchByRotation) return matchByRotation;
    
        const isPortrait = height > width;
        const orientationMatches = matches.filter(size => {
            const sizeIsPortrait = size.height > size.width;
            return sizeIsPortrait === isPortrait;
        });
    
        if (orientationMatches.length > 0) {
            return orientationMatches[0];
        }
    
        return matches[0];
    }
    

    async function processPDF(arrayBuffer) {
        try {
            const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);
            const pages = pdfDoc.getPages();
    
            const textSize = 15;
            const textColor = PDFLib.rgb(1, 0, 0);
            const font = await pdfDoc.embedFont(PDFLib.StandardFonts.HelveticaBold);
            
            // const inputValue = document.getElementById("input-batch")?.value?.trim();
            // const batchText = inputValue || "BATCH";

            // const selectedFilePath = window.selectedFilePath || "output.pdf"; // fallback
    //525 asalnya 540
                    const knownSizes = [
                { name: "A4", width: 595.44, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
                { name: "A4 Variant 1", width: 596.16, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
                { name: "A4 Variant 2", width: 597.36, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
                { name: "A4 Variant 3", width: 596.64, height: 841.92, xFixed: 60, yFixed: 720, rotation: 90 },
    
                // Ukuran Custom
                { name: "Custom 1", width: 597.84, height: 878.16, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Custom 2", width: 596.12, height: 876.72, xFixed: 60, yFixed: 750, rotation: 90},
                // { name: "Custom 2", width: 596.12, height: 876.72, xFixed: 525, yFixed: 680, rotation: 270},
                { name: "Custom 3", width: 612, height: 955.2, xFixed: 60, yFixed: 850, rotation: 90 },
                // { name: "Custom 3", width: 612, height: 955.2, xFixed: 570, yFixed: 150, rotation: 270 },
    
                // Ukuran 
                // { name: "Log Custom A", width: 595.2, height: 855.12, xFixed: 525, yFixed: 150, rotation: 270 },
                { name: "Log Custom A", width: 595.2, height: 855.12, xFixed: 70, yFixed: 740, rotation: 90 },
                // { name: "Log Custom A", width: 595.2, height: 855.12, xFixed: 520, yFixed: 190, rotation: 270 },
                { name: "Log Custom B", width: 596.88, height: 855.12, xFixed: 525, yFixed: 150, rotation: 270 },
                // { name: "Log Custom B", width: 596.88, height: 855.12, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log Custom C", width: 596.16, height: 855.12, xFixed: 530, yFixed: 200, rotation: 270 },
                // { name: "Log Custom D", width: 596.64, height: 857.04, xFixed: 525, yFixed: 150, rotation: 270 },
                { name: "Log Custom D", width: 596.64, height: 857.04, xFixed: 70, yFixed: 740, rotation: 90 },
                
                { name: "Log Custom E", width: 597.6, height: 856.56, xFixed: 60, yFixed: 740, rotation: 90 },
                // { name: "Log Custom F", width: 597.6, height: 858, xFixed: 525, yFixed: 150, rotation: 270 },
                { name: "Log Custom F", width: 597.6, height: 858, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log Custom G", width: 597.6, height: 856.8, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log Custom H", width: 597.6, height: 856.56, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log Custom I", width: 596.64, height: 857.04, xFixed: 525, yFixed: 200, rotation: 270 },
    
                // { name: "Log 9", width: 595.2, height: 857.76, xFixed: 60, yFixed: 740, rotation: 90 },
                // { name: "Log 9", width: 595.2, height: 857.76, xFixed: 60, yFixed: 740, rotation: 90 },
                // { name: "Log", width: 597.12, height: 860.64, xFixed: 525, yFixed: 150, rotation: 270 },
                { name: "Log", width: 597.12, height: 860.64, xFixed: 70, yFixed: 740, rotation: 90 },
                // { name: "Log", width: 597.12, height: 860.64, xFixed: 510, yFixed: 190, rotation: 270 },
                { name: "Log Extra", width: 597.12, height: 860.64, xFixed: 525, yFixed: 200, rotation: 270 },
                { name: "Log New1", width: 597.12, height: 859.44, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log New2", width: 598.32, height: 860.4, xFixed: 60, yFixed: 740, rotation: 90},
                { name: "Log New3", width: 598.56, height: 859.2, xFixed: 60, yFixed: 740, rotation: 90},
                { name: "Log New4", width: 598.08, height: 859.68, xFixed: 525, yFixed: 200, rotation: 270 },
                { name: "Log 20", width: 597.6, height: 858.24, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log 20", width: 597.6, height: 858.24, xFixed: 530, yFixed: 200, rotation: 270 },
                // { name: "Log 18", width: 594.2, height: 857.04, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log 18", width: 594.2, height: 857.04, xFixed: 525, yFixed: 160, rotation: 270 },
                { name: "Log 19", width: 596.64, height: 856.56, xFixed: 60, yFixed: 740, rotation: 90 },
                { name: "Log 21", width: 597.12, height: 856.32, xFixed: 60, yFixed: 740, rotation: 90 },
    
                // Ukuran Wide
                { name: "Wide 1", width: 859.92, height: 597.36, xFixed: 690, yFixed: 525, rotation: 0 },
                { name: "Wide 2", width: 860.4, height: 597.84, xFixed: 690, yFixed: 525, rotation: 0 },
                // { name: "Wide 3", width: 955.9, height: 611.75, xFixed: 110, yFixed: 60, rotation: 180 },
                { name: "Wide 3", width: 955.9, height: 611.75, xFixed: 750, yFixed: 570, rotation: 0 },
                { name: "Wide Custom", width: 859.68, height: 597.12, xFixed: 120, yFixed: 75, rotation: 180 },
                
                  { name: "Log A", width: 841.9, height: 594, xFixed: 690, yFixed: 530, rotation: 0 },
                    { name: "Log B", width: 841.9, height: 594.5, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log C", width: 841.9, height: 595.2, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log D", width: 841.9, height: 595.45, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log E", width: 841.9, height: 594.95, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log F", width: 841.9, height: 596.4, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log G", width: 841.9, height: 595.6999999999999, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log H", width: 841.9, height: 595.7, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log I", width: 841.9, height: 595.9, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log J", width: 841.9, height: 594.7, xFixed: 690, yFixed: 525, rotation: 0 },
                    { name: "Log K", width: 841.9, height: 595.1999999999999, xFixed: 690, yFixed: 525, rotation: 0 },
                    
                    //   { name: "Log4", width: 870.72, height: 596.16, xFixed: 690, yFixed: 520, rotation: 0 },
                    //   { name: "Log4", width: 870.72, height: 596.16, xFixed: 120, yFixed: 75, rotation: 180 },
                      { name: "Log4", width: 870.72, height: 596.16, xFixed: 720, yFixed: 525, rotation: 0 },
                      { name: "Log5", width: 894, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log6", width: 863.28, height: 596.16, xFixed: 700, yFixed: 530, rotation: 0 },
                      { name: "Log7", width: 864, height: 596.16, xFixed: 750, yFixed: 520, rotation: 0 },
                      { name: "Log8", width: 866.16, height: 595.44, xFixed: 700, yFixed: 530, rotation: 0 },
                      { name: "Log9", width: 865.2, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log10", width: 867.36, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log11", width: 865.92, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log12", width: 864.72, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log13", width: 865.2, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log14", width: 862.08, height: 595.2, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log15", width: 863.04, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log16", width: 863.52, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log17", width: 877.92, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log18", width: 863.28, height: 595.68, xFixed: 690, yFixed: 550, rotation: 0 },
                      { name: "Log19", width: 866.16, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log20", width: 864, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log21", width: 864.96, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log22", width: 864.72, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log23", width: 866.88, height: 596.88, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log24", width: 865.2, height: 596.64, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log25", width: 865.92, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log26", width: 863.76, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log28", width: 863.52, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log30", width: 863.04, height: 595.44, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log32", width: 863.52, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log33", width: 864.48, height: 596.16, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log34", width: 863.52, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log35", width: 866.4, height: 596.4, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log36", width: 863.76, height: 596.4, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log37", width: 863.04, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log38", width: 864, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log39", width: 863.28, height: 595.92, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log40", width: 862.8, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log50", width: 857.28, height: 595.68, xFixed: 690, yFixed: 530, rotation: 0 },
                      { name: "Log51", width: 891.12, height: 597.59998, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log52", width: 869.52002, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log53", width: 893.76001, height: 599.28003, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log54", width: 870.96002, height: 598.32001, xFixed: 690, yFixed: 525, rotation: 0 },
                      { name: "Log55", width: 841.9, height: 591.6, xFixed: 720, yFixed: 520, rotation: 0 },
                      { name: "Log56", width: 915.36, height: 596.64, xFixed: 720, yFixed: 520, rotation: 0 },
                      { name: "Log57", width: 885.36, height: 596.88, xFixed: 720, yFixed: 520, rotation: 0 },
                        
                        // Ukuran baru dari log pemrosesan PDF
                    { name: "new1", width: 923.76001, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 }, // Page 1
                    { name: "new2", width: 885.12, height: 599.03998, xFixed: 690, yFixed: 525, rotation: 0 },    // Page 2
                    { name: "new3", width: 877.20001, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 3
                    { name: "new4", width: 880.56, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 11
                    { name: "new5", width: 887.76001, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 12
                    { name: "new6", width: 888.96002, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },// Page 13
                    { name: "new7", width: 867.12, height: 599.03998, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 18
                    { name: "new8", width: 866.88, height: 599.03998, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 33
                    { name: "new9", width: 873.12, height: 598.56, xFixed: 690, yFixed: 525, rotation: 0 },      // Page 58
                    { name: "new10", width: 863.03998, height: 598.79999, xFixed: 690, yFixed: 525, rotation: 0 }, // Page 66
                    
                    { name: "new11", width: 855.84003, height: 597.84003, xFixed: 690, yFixed: 525, rotation: 0 },// Page 4
                    { name: "new12", width: 856.79999, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },// Page 7
                    { name: "new13", width: 856.56, height: 598.32001, xFixed: 690, yFixed: 525, rotation: 0 },   // Page 55
                    { name: "new14", width: 857.03998, height: 597.84003, xFixed: 690, yFixed: 525, rotation: 0 },// Page 94
                    { name: "new15", width: 856.32001, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },// Page 96
                    { name: "new16", width: 856.56, height: 598.08002, xFixed: 690, yFixed: 525, rotation: 0 },    // Page 99
                                    // Ukuran baru dari log terakhir
                    { name: "Log54", width: 875.28, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },     // Page 2
                    { name: "Log55", width: 882.96, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },     // Page 3
                    { name: "Log56", width: 888, height: 595.2, xFixed: 690, yFixed: 525, rotation: 0 },         // Page 21
                    { name: "Log57", width: 881.04, height: 595.68, xFixed: 690, yFixed: 525, rotation: 0 },     // Page 72
                    { name: "Log58", width: 859.92, height: 594.96, xFixed: 690, yFixed: 525, rotation: 0 },      // Page 79
                    { name: "Log59", width: 952.3, height: 612.25, xFixed: 720, yFixed: 560, rotation: 0 },      // Page 4
                    { name: "Log60", width: 952.8, height: 611.75, xFixed: 720, yFixed: 560, rotation: 0 },       // Page 5
                    
                    // Ukuran baru dari log terakhir
                    { name: "Log70", width: 594.24, height: 860.64, xFixed: 530, yFixed: 150, rotation: 270 },     // Page 11
                    { name: "Log80", width: 594.24, height: 859.44, xFixed: 530, yFixed: 150, rotation: 270 },     // Page 13
                    { name: "Log90", width: 594.72, height: 859.68, xFixed: 530, yFixed: 150, rotation: 270 },     // Page 17
                    
                    { name: "Log100", width: 949.9, height: 611.75, xFixed: 740, yFixed: 570, rotation: 0 },      // Page 4
                    { name: "Log101", width: 949.9, height: 612, xFixed: 740, yFixed: 570, rotation: 0 },         // Page 5
                    { name: "Log102", width: 949.45, height: 612.25, xFixed: 740, yFixed: 570, rotation: 0 },      // Page 50
                    
                    { name: "LogNEW1", width: 902.40002, height: 599.28003, xFixed: 740, yFixed: 530, rotation: 0 },
                    { name: "LogNEW2", width: 867.12, height: 602.40002, xFixed: 740, yFixed: 530, rotation: 0 },
                    { name: "LogNEW3", width: 946.3, height: 611.05, xFixed: 740, yFixed: 557, rotation: 0 }, // Page 4
                    
                    
                    { name: "LogNEW4", width: 912.71997, height: 598.79999, xFixed: 740, yFixed: 545, rotation: 0 },
                    
                    // { name: "LogNEW5", width: 611.52002, height: 953.03998, xFixed: 50, yFixed: 780, rotation: 90 },
                    { name: "LogNEW5", width: 611.52002, height: 953.03998, xFixed: 560, yFixed: 250, rotation: 270 },
                    { name: "LogNEW6", width: 854.64, height: 594.72, xFixed: 650, yFixed: 520, rotation: 0 }, // Page 5
                    
                    
                    { name: "LogNEW7", width: 924, height: 600.72, xFixed: 670, yFixed: 530, rotation: 0 }, // Page 48
                    { name: "LogNEW8", width: 920.88, height: 598.32, xFixed: 670, yFixed: 530, rotation: 0 }, // Page 49
                    
                    { name: "LogNEW9", width: 882.71997, height: 599.03998, xFixed: 670, yFixed: 530, rotation: 0 }, // Page 1
                    { name: "LogNEW10", width: 956.15997, height: 608.40002, xFixed: 730, yFixed: 550, rotation: 0 }, // Page 5
                
                    { name: "LogNEW11", width: 597.36, height: 865.44, xFixed: 70, yFixed: 740, rotation: 90 },
                    // { name: "LogNEW11", width: 597.36, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270 }, 
                    { name: "LogNEW12", width: 597.84, height: 863.28, xFixed: 70, yFixed: 740, rotation: 90 }, // Page 4
                    // { name: "LogNEW12", width: 597.84, height: 863.28, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 4
                    { name: "LogNEW13", width: 598.32, height: 863.28, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 7
                    { name: "LogNEW14", width: 597.36, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 11
                    { name: "LogNEW15", width: 597.6, height: 864, xFixed: 530, yFixed: 150, rotation: 270  },     // Page 14
                    { name: "LogNEW16", width: 598.08, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 22
                    { name: "LogNEW17", width: 597.6, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 23
                    { name: "LogNEW18", width: 597.36, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 24
                    { name: "LogNEW19", width: 597.6, height: 863.28, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 31
                    { name: "LogNEW20", width: 597.84, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 32
                    { name: "LogNEW21", width: 597.36, height: 866.64, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 49
                    // { name: "LogNEW22", width: 597.6, height: 868.32, xFixed: 530, yFixed: 150, rotation: 270  },  // Bass 50
                    
                        { name: "LogNEW22", width: 597.6, height: 868.32, xFixed: 58, yFixed: 730, rotation: 90 },
                    { name: "LogNEW23", width: 598.08, height: 864.72, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 51
                    { name: "LogNEW24", width: 597.84, height: 866.4, xFixed: 530, yFixed: 150, rotation: 270  },  // Page 52
                    { name: "LogNEW25", width: 597.36, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270  }, // Page 53
                    { name: "LogNEW26", width: 597.6, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 54
                    { name: "LogNEW27", width: 598.08, height: 865.68, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 55
                    { name: "LogNEW28", width: 597.6, height: 869.52, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 56
                    { name: "LogNEW29", width: 597.6, height: 863.76, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 57
                    { name: "LogNEW30", width: 597.84, height: 865.2, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 58
                    { name: "LogNEW31", width: 598.08, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 60
                    { name: "LogNEW32", width: 597.84, height: 864.96, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 61
                    { name: "LogNEW33", width: 597.6, height: 864.48, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 62
                    { name: "LogNEW34", width: 598.32, height: 864.24, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 63
                    { name: "LogNEW35", width: 597.84, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 64
                    { name: "LogNEW36", width: 598.32, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 66
                    { name: "LogNEW37", width: 598.08, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 67
                    { name: "LogNEW38", width: 598.08, height: 864.48, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 68
                    { name: "LogNEW39", width: 597.84, height: 863.76, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 69
                    { name: "LogNEW40", width: 598.08, height: 865.2, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 70
                    { name: "LogNEW41", width: 597.84, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 71
                    { name: "LogNEW42", width: 598.08, height: 869.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 72
                    { name: "LogNEW43", width: 598.08, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 73
                    { name: "LogNEW44", width: 598.08, height: 864, xFixed: 530, yFixed: 150, rotation: 270 },    // Page 74
                    { name: "LogNEW45", width: 597.6, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 75
                    { name: "LogNEW46", width: 598.08, height: 864.48, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 76
                    { name: "LogNEW47", width: 598.08, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 77
                    { name: "LogNEW48", width: 598.32, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 79
                    { name: "LogNEW49", width: 597.84, height: 863.04, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 80
                    { name: "LogNEW50", width: 597.6, height: 862.8, xFixed: 530, yFixed: 150, rotation: 270 },   // Page 81
                    { name: "LogNEW51", width: 598.08, height: 865.44, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 82
                    { name: "LogNEW52", width: 597.84, height: 863.52, xFixed: 530, yFixed: 150, rotation: 270 }, // Page 84
                    { name: "LogNEW53", width: 597.84, height: 864.72, xFixed: 530, yFixed: 150, rotation: 270 },  // Page 85
                    
                    { name: "LogNEW54", width: 954.48, height: 613.92, xFixed: 740, yFixed: 560, rotation: 0 },
                    { name: "LogNEW55", width: 910.56, height: 598.32, xFixed: 740, yFixed: 530, rotation: 0 },
                    
                    { name: "LogNEW56", width: 852.48, height: 594.48, xFixed: 650, yFixed: 520, rotation: 0 },
                    { name: "LogNEW57", width: 852.48, height: 594.96, xFixed: 650, yFixed: 520, rotation: 0 },
                    { name: "LogNEW58", width: 851.76, height: 594.96, xFixed: 650, yFixed: 520, rotation: 0 },
                    { name: "LogNEW59", width: 852.24, height: 595.44, xFixed: 650, yFixed: 520, rotation: 0 },
                    { name: "LogNEW60", width: 852.24, height: 594.96, xFixed: 650, yFixed: 520, rotation: 0 },


            ];

    
            pages.forEach((page, index) => {
                const { width, height } = page.getSize();
                const actualRotation = page.getRotation().angle;
    
                const matchedSize = getMatchedSizeAdvanced(width, height, actualRotation, knownSizes);
    
                let xPosition, yPosition, textRotation;
    
                if (matchedSize) {
                    console.log(`Page ${index + 1} Rotation: ${actualRotation}`);
                    console.log(`Page ${index + 1}: Match: ${matchedSize.name}`);
                    xPosition = matchedSize.xFixed;
                    yPosition = matchedSize.yFixed;
                    textRotation = PDFLib.degrees(matchedSize.rotation);
                } else {
                    console.log(`Page ${index + 1} Rotation: ${actualRotation}`);

                    console.warn(`Page ${index + 1}: Unknown size (${width} x ${height})`);
                    xPosition = width * 0.10;
                    yPosition = height * 0.78;
                    textRotation = PDFLib.degrees(90);
                }
    
                page.drawText(batchText, {
                    x: xPosition,
                    y: yPosition,
                    size: textSize,
                    font: font,
                    color: textColor,
                    rotate: textRotation
                });
            });
    
            const pdfBytes = await pdfDoc.save();
            const blob = new Blob([pdfBytes], { type: "application/pdf" });
    
            const link = document.getElementById("downloadLink");
            const tombolSelesai = document.getElementById("tombol-selesai");
    
            if (tombolSelesai) tombolSelesai.style.display = "inline";
    
            if (link) {
                link.href = URL.createObjectURL(blob);
                link.download = `${batchText}-${selectedFilePath.split("/").pop()}`;
                link.style.display = "inline";
                link.textContent = "Unduh PDF Baru";
            } else {
                console.error("Elemen 'downloadLink' tidak ditemukan.");
            }
        } catch (error) {
            if (error.message.includes("Encrypted PDF")) {
                alert("PDF ini dienkripsi dan tidak dapat diproses.");
            } else {
                console.error("Gagal memproses PDF:", error);
                alert("Terjadi kesalahan. Silakan upload manual.");
            }
    
            const manualUploadDiv = document.getElementById('manualUpload');
            if (manualUploadDiv) manualUploadDiv.style.display = 'block';
        }
    }




    </script>
</body>
</html>
