<!DOCTYPE html>
<html>

<head>
    <title>Tiket Voluntrip Anda</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style type="text/css">
        /* CSS Inline untuk Kompatibilitas Email Client */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            /* bg-gray-100 */
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            width: 100% !important;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            /* rounded-lg */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* shadow-lg */
            max-width: 500px;
            margin: 20px auto;
            border: 1px solid #e5e7eb;
            /* border border-gray-200 */
            overflow: hidden;
        }

        .header {
            background-color: #fcd34d;
            /* bg-yellow-300 */
            padding: 24px;
            /* p-6 */
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            /* text-2xl */
            font-weight: bold;
            color: #4b5563;
            /* text-gray-700 */
            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;
            /* text-sm */
            color: #6b7280;
            /* text-gray-600 */
        }

        .body-content {
            padding: 24px;
            /* p-6 */
        }

        .section-title {
            font-size: 20px;
            /* text-xl */
            font-weight: bold;
            color: #1f2937;
            /* text-gray-900 */
            margin-bottom: 20px;
        }

        .detail-item {
            margin-bottom: 16px;
        }

        .detail-item span {
            font-weight: 600;
            /* font-semibold */
            color: #1f2937;
            /* text-gray-900 */
            font-size: 14px;
            /* text-sm */
        }

        .detail-item p {
            font-size: 14px;
            /* text-sm */
            color: #4b5563;
            /* text-gray-700 */
            margin-top: 4px;
        }

        .amount-highlight {
            font-size: 16px;
            /* text-base */
            font-weight: bold;
            color: #10b981;
            /* text-green-600 */
        }

        .ticket-footer {
            border-top: 1px dashed #e5e7eb;
            /* border-t border-dashed border-gray-200 */
            padding: 24px;
            /* p-6 */
            text-align: center;
            font-size: 12px;
            /* text-xs */
            color: #6b7280;
            /* text-gray-600 */
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #10b981;
            /* green-500 */
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            /* rounded-md */
            font-weight: bold;
            font-size: 16px;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Tiket Voluntrip Anda</h1>
            <p>Konfirmasi partisipasi Anda dalam {{ $voluntrip->name }}</p>
        </div>

        <div class="body-content">
            <h2 class="section-title">{{ $voluntrip->name }}</h2>

            <div class="detail-item">
                <span>Nama Peserta:</span>
                <p>{{ $volunteer->name }}</p>
            </div>

            <div class="detail-item">
                <span>Email Peserta:</span>
                <p>{{ $volunteer->email }}</p>
            </div>

            <div class="detail-item">
                <span>Nomor Telepon:</span>
                <p>{{ $volunteer->number_phone }}</p>
            </div>

            <div class="detail-item">
                <span>Tanggal Voluntrip:</span>
                <p>{{ \Carbon\Carbon::parse($voluntrip->start_date)->translatedFormat('d F Y') }} -
                    {{ \Carbon\Carbon::parse($voluntrip->end_date)->translatedFormat('d F Y') }}</p>
            </div>

            <div class="detail-item">
                <span>Lokasi:</span>
                <p>{{ $voluntrip->location ?? 'Belum ditentukan' }}</p>
            </div>

            <hr style="border-top: 1px dashed #e5e7eb; margin: 20px 0;">

            <h2 class="section-title" style="font-size: 18px;">Detail Pembayaran</h2>

            <div class="detail-item">
                <span>Booking ID:</span>
                <p>{{ $payment->uuid }}</p>
            </div>

            <div class="detail-item">
                <span>Jumlah Tiket:</span>
                <p>{{ $payment->volunteers->count() }} orang</p>
            </div>

            <div class="detail-item">
                <span>Total Pembayaran:</span>
                <p class="amount-highlight">Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
            </div>

            {{-- Anda bisa menambahkan QR Code di sini jika Anda generate di server dan menyediakannya sebagai URL atau base64 --}}
            {{-- Contoh placeholder QR Code: --}}
            <div class="qr-code">
                <img src="https://via.placeholder.com/150/0000FF/FFFFFF?text=QR+CODE" alt="QR Code Tiket"
                    style="width: 150px; height: 150px; border: 1px solid #ccc; border-radius: 8px;">
                <p style="font-size: 12px; color: #6b7280; margin-top: 10px;">Pindai kode ini untuk verifikasi</p>
            </div>

            <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #4b5563;">
                Mohon tunjukkan tiket ini saat verifikasi di lokasi Voluntrip.
            </p>
        </div>

        <div class="ticket-footer">
            <p>&copy; {{ date('Y') }} Nama Perusahaan Anda. Terima kasih atas partisipasi Anda!</p>
        </div>
    </div>
</body>

</html>
