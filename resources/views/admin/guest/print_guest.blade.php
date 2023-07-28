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
            display: inline-block;
            border: 0px solid #ccc;
            text-align: center;
            width: 70mm; /* Lebar kolom gambar barcode dalam mm */
            height: 25mm; /* Tinggi kolom gambar barcode dalam mm */
        }
        .barcode {
            display: block;
            margin: 0 auto;
        }
        .barcode-text {
            font-size: 12px; /* Ukuran font teks barcode */
            margin-top: 5px;
        }
        .column {
            column-count: 2; /* Jumlah kolom pada satu halaman */
        }
    </style>
</head>
<body>
    <div class="column">
        @php
            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
        @endphp
        @foreach ($data as $barcode)
            <div class="barcode-container">
                <div class="barcode">
                    <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($barcode->kode_guest, $generatorPNG::TYPE_CODE_128, 3, 60)) }}">
                </div>
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
