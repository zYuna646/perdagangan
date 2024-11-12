<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Data Bidang Perdagangan</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .container {
            text-align: center;
            max-width: 1200px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .login-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            gap: 20px;
        }

        .logo-container img {
            width: 80px;
            height: auto;
        }

        .chart {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .level {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .position {
            text-align: center;
            margin: 0 10px;
        }

        .position img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 5px;
            border: 2px solid #ccc;
        }

        .position .title {
            font-weight: bold;
            font-size: 14px;
        }

        .position .name {
            font-size: 13px;
            color: #555;
        }

        /* Lines connecting positions */
        .line {
            width: 100%;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .line div {
            width: 2px;
            height: 100%;
            background-color: #333;
        }

        .line-horizontal {
            height: 2px;
            width: 80%;
            background-color: #333;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <a href="{{ route('login') }}" class="login-btn">Login</a>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo-container">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Aplikasi">
            <img src="{{ asset('assets/images/daerah.png') }}" alt="Logo Pemerintah">
        </div>

        <h2>Struktur Data Bidang Perdagangan</h2>
        <div class="chart">

            <!-- Top Level -->
            <div class="level">
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Kabid Perdagangan">
                    <div class="title">Kabid Perdagangan</div>
                    <div class="name">Iwan Ahmad Sondakh, SH. MH</div>
                    <div class="name">NIP: 196810042002121005</div>
                    <div class="name">Pangkat: Pembina IV/a</div>
                </div>
            </div>

            <!-- Second Level -->
            <div class="line">
                <div class="line-horizontal"></div>
            </div>
            <div class="level">
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Pengawas Perdagangan Ahli Muda">
                    <div class="title">Pengawas Perdagangan Ahli Muda</div>
                    <div class="name">Fauziah Utiarahaman, SH, MH</div>
                    <div class="name">NIP: 197109182006042013</div>
                    <div class="name">Pangkat: Pembina IV/a</div>
                </div>
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Pengawas Perdagangan Ahli Muda">
                    <div class="title">Pengawas Perdagangan Ahli Muda</div>
                    <div class="name">Rizaldy Lihawa, ST</div>
                    <div class="name">NIP: 198409162009011001</div>
                    <div class="name">Pangkat: Penata Tkt 1 III/d</div>
                </div>
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Pengawas Perdagangan Ahli Muda">
                    <div class="title">Pengawas Perdagangan Ahli Muda</div>
                    <div class="name">Eka Widyastuti, SH</div>
                    <div class="name">NIP: 198304082010012003</div>
                    <div class="name">Pangkat: Penata TK.I III/d</div>
                </div>
            </div>

            <!-- Third Level -->
            <div class="line">
                <div class="line-horizontal"></div>
            </div>
            <div class="level">
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Penyusuna Pengembangan Harga">
                    <div class="title">Penyusuna Pengembangan Harga</div>
                    <div class="name">Yusni Nggule, S.IP</div>
                    <div class="name">NIP: 197402152007012019</div>
                    <div class="name">Pangkat: Penata Muda Tkt I III/d</div>
                </div>
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Penyusun Perkembangan Harga">
                    <div class="title">Penyusun Perkembangan Harga</div>
                    <div class="name">Rahmawaty Rahim, SH</div>
                    <div class="name">NIP: 198705202010012001</div>
                    <div class="name">Pangkat: Penata TK.I III/d</div>
                </div>
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Pengelola Distribusi dan Pemasaran">
                    <div class="title">Pengelola Distribusi dan Pemasaran</div>
                    <div class="name">Erwinsyah Lamalani, ST, M.Si</div>
                    <div class="name">NIP: 198207142011011001</div>
                    <div class="name">Pangkat: Penata III/d</div>
                </div>
            </div>

            <!-- Additional Pelaksana Level -->
            <div class="line">
                <div class="line-horizontal"></div>
            </div>
            <div class="level">
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Pengadministrasi Perencanaan">
                    <div class="title">Pengadministrasi Perencanaan</div>
                    <div class="name">Rizvy Rusmini Herizal, A.Md</div>
                    <div class="name">NIP: 198804202011012001</div>
                    <div class="name">Pangkat: Penata Muda III/b</div>
                </div>
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Penyusun Perkembangan Harga">
                    <div class="title">Penyusun Perkembangan Harga</div>
                    <div class="name">Rini Rivanny Hilipito, SH</div>
                    <div class="name">NIP: 198401162011012001</div>
                    <div class="name">Pangkat: Penata TK.I III/d</div>
                </div>
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Pengadministrasi Perencanaan">
                    <div class="title">Pengadministrasi Perencanaan</div>
                    <div class="name">Ardam Bata</div>
                    <div class="name">NIP: 198002162010011003</div>
                    <div class="name">Pangkat: Penata TK.I III/d</div>
                </div>
                <div class="position">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Pengelola Distribusi dan Pemasaran">
                    <div class="title">Pengelola Distribusi dan Pemasaran</div>
                    <div class="name">Ervina U. Menu</div>
                    <div class="name">NIP: 197504042010012001</div>
                    <div class="name">Pangkat: Pengatur TK.I II/d</div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
