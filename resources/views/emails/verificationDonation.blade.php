<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Donasi Anda</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px;
            color: #343a40;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #0d6efd;
        }

        .content p {
            line-height: 1.6;
        }

        .details-box {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .details-box p {
            margin: 5px 0;
        }

        .button {
            display: inline-block;
            margin-top: 25px;
            background-color: #0d6efd;
            /* Kembali ke biru, karena tidak ada verifikasi khusus */
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            font-size: 0.875rem;
            color: #6c757d;
            text-align: center;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .button {
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Terima Kasih Atas Donasi Anda!</h1>
        </div>

        <div class="content">
            <p>Halo **{{ $donation->name }}**,</p>
            <p>
                Kami ingin mengucapkan terima kasih banyak atas donasi Anda untuk program **{{ $fundraising->name }}**.
                Dukungan Anda sangat berarti bagi kami dan akan digunakan sepenuhnya untuk tujuan mulia.
            </p>
            <p>
                Berikut adalah detail donasi Anda:
            </p>

            <div class="details-box">
                <p><strong>Nama Donatur:</strong> {{ $donation->name }}</p>
                <p><strong>Email:</strong> {{ $donation->email }}</p>
                <p><strong>Nomor Telepon:</strong> {{ $donation->phone_number }}</p>
                <p><strong>Jumlah Donasi:</strong> Rp {{ number_format($amount, 0, ',', '.') }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $paymentChannel }}</p>
                @if ($donation->notes)
                    <p><strong>Catatan:</strong> {{ $donation->notes }}</p>
                @endif
            </div>

            <p>
                Program yang dibantu:
            </p>

            <div class="details-box">
                <p><strong>Nama Program:</strong> {{ $fundraising->name }}</p>
                <p><strong>Kategori Program:</strong> {{ $fundraising->category->name }}</p>
                <p><strong>Tentang Prorgam:</strong> {{ $fundraising->about }}</p>
            </div>

            <p>
                Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut, jangan ragu untuk membalas email
                ini.
            </p>
            <p style="text-align: center;">
                <a href="{{ route('donation.verify', [$donation->verify_token, $paymentChannel, $amount]) }}"
                    class="button">
                    Verifikasi Pembayaran
                </a>
            </p>
            <p>
                Hormat kami,<br>
                Tim Jejak Kebaikan
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Jejak Kebaikan. Semua hak dilindungi.
        </div>
    </div>
</body>

</html>
