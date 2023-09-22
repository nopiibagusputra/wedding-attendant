<!DOCTYPE html>
<html>
<head>
    <title>Barcode Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .page {
            width: 210mm; /* Lebar kertas A4 dalam mm */
            height: 297mm; /* Tinggi kertas A4 dalam mm */
            padding: 2mm; /* Padding halaman untuk menghindari gambar terpotong */
        }
        .barcode-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid #ccc;
            width: 72mm; /* Lebar kolom gambar barcode dalam mm */
            height: 30mm; /* Tinggi kolom gambar barcode dalam mm */
            border-radius: 10px; /* Adjust the value as needed for the desired rounding */
            margin: 10px; /* Add margin between barcode containers */
        }
        .barcode {
            display: block;
            margin: 0 auto;
        }
        .barcode-text {
            font-size: 14px; /* Ukuran font teks barcode */
            margin-top: 5px;
            font-weight: bold;
        }
        .column {
            column-count: 2; /* Jumlah kolom pada satu halaman */
        }

        @media print {
            body {
                margin: 0; /* Remove default margins */
                padding: 0; /* Remove default padding */
            }
            .page {
                width: 210mm; /* Reset width to A4 size for printing */
                height: 297mm; /* Reset height to A4 size for printing */
                page-break-after: always; /* Add page break after each set of columns */
            }
            .barcode-container {
                page-break-inside: avoid; /* Avoid breaking barcode containers across pages */
            }
            .column {
                column-count: 2; /* Print each barcode container in a single column */
            }
        }
    </style>
</head>
<body>
    <div class="column">
        @foreach ($data as $barcode)
            <div class="barcode-container">
                <div class="barcode-text">
                    {{ $barcode->nama }}
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function autoPrint() {
            window.print();
        }

        function autoBack() {
            // Lakukan navigasi kembali ke halaman sebelumnya
            window.history.back();
        }
        
        // Panggil fungsi autoPrint saat halaman selesai dimuat
        window.onload = function () {
            autoPrint();
        };

        // Deteksi saat cetakan selesai
        window.onafterprint = function () {
            autoBack();
        };
    </script>
</body>
</html>
