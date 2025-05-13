<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pembayaran Anda</title>
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

        .button {
            display: inline-block;
            margin-top: 25px;
            background-color: #0d6efd;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
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
            <h1>Verifikasi Pembayaran</h1>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $volunteer->name }}</strong>,</p>
            <p>
                Terima kasih telah mendaftar sebagai volunteer untuk acara
                <strong>{{ $volunteer->voluntrip->name }}</strong>.
            </p>
            <p>
                Untuk melanjutkan proses dan mengaktifkan status keikutsertaan Anda, silakan klik tombol di bawah untuk
                memverifikasi pembayaran Anda:
            </p>

            <p style="text-align: center;">
                <a href="{{ route('volunteer.verify', ['token' => $volunteer->verify_token, $paymentChannel]) }}"
                    class="button">
                    Verifikasi Pembayaran
                </a>
            </p>

            <p>
                Jika Anda tidak merasa melakukan pendaftaran ini, silakan abaikan email ini.
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Jejak Kebaikan. Semua hak dilindungi.
        </div>
    </div>
</body>

</html>
