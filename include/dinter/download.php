<script>

fetch('/download.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ fileId, userInput })
})
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok.');
    }
    return response.json();
})
.then(data => {
    if (data.error) {
        // Tangani error jika ada (misalnya tampilkan pesan error)
        alert(data.error);
    } else {
        // Unduh file jika berhasil
        const link = document.createElement('a');
        link.href = data.pdfFile;
        link.download = data.filename;
        link.click();
    }
})
.catch(error => {
    // Tangani error jaringan atau error lainnya
    console.error('Fetch error:', error);
    alert('Terjadi kesalahan saat mengunduh dokumen.');
});

// ... (kode JavaScript lainnya)
</script>