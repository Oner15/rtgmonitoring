
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTG Monitoring System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #123c69;
            --primary-dark: #0a2540;
            --accent: #f4b942;
            --text: #172b42;
            --muted: #68788b;
            --light: #f5f8fc;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 85px;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            line-height: 1.6;
            background: var(--white);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: calc(100% - 100px);
            max-width: 1400px;
            margin-inline: auto;
        }

        /* NAVBAR */
        .navbar {
            height: 76px;
            display: flex;
            align-items: center;
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #e8edf3;
        }

        .nav-content {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            font-weight: 800;
            font-size: 17px;
            color: var(--primary);
            white-space: nowrap;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: var(--primary);
            color: white;
            font-size: 22px;
        }

        .brand small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 1.1px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: clamp(16px, 2.2vw, 30px);
            font-size: 13px;
            font-weight: 600;
            color: #526174;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 22px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            transition: .2s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            color: white;
            background: var(--primary);
        }

        .btn-primary:hover {
            background: #1c548c;
            transform: translateY(-2px);
        }

        .btn-outline {
            color: white;
            border: 1px solid rgba(255,255,255,.55);
            background: rgba(255,255,255,.08);
        }

        .btn-outline:hover {
            background: rgba(255,255,255,.18);
        }

        /* HERO */
        .hero {
            position: relative;
            overflow: hidden;
            min-height: 600px;
            display: flex;
            align-items: center;
            color: white;
            background:
                linear-gradient(90deg,
                    rgba(6, 24, 43, .94) 0%,
                    rgba(6, 24, 43, .79) 48%,
                    rgba(6, 24, 43, .24) 100%),
                url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQND9FVPFRY2SZY55q84k1XoB9d120s82NKYu6U12U4PA&s=10')
                center 52% / cover no-repeat;
        }

        .hero-content {
            max-width: 690px;
            padding: 90px 0 110px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 8px 13px;
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 30px;
            background: rgba(255,255,255,.09);
            color: #f5cc75;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.1px;
            margin-bottom: 25px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #4ade80;
            border-radius: 50%;
        }

        .hero h1 {
            font-size: clamp(36px, 5.2vw, 60px);
            line-height: 1.12;
            letter-spacing: -2px;
            font-weight: 800;
            margin-bottom: 24px;
        }

        .hero h1 span {
            color: var(--accent);
        }

        .hero p {
            max-width: 570px;
            color: #d5e0ed;
            font-size: 15px;
            line-height: 1.9;
            margin-bottom: 32px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 13px;
        }

        .hero-note {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 34px;
            color: #d5e0ed;
            font-size: 12px;
        }

        .hero-note strong {
            color: white;
        }

        /* SECTION GENERAL */
        section {
            padding: 90px 0;
        }

        .section-heading {
            max-width: 650px;
            margin: 0 auto 48px;
            text-align: center;
        }

        .section-label {
            color: #b47a13;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .section-heading h2 {
            color: var(--primary-dark);
            font-size: clamp(27px, 3.5vw, 38px);
            line-height: 1.25;
            letter-spacing: -1px;
            margin-bottom: 15px;
        }

        .section-heading p {
            font-size: 14px;
            color: var(--muted);
        }

        /* FEATURES */
        .features {
            background: var(--light);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feature-card {
            padding: 30px;
            background: white;
            border: 1px solid #e7edf4;
            border-radius: 14px;
            transition: .25s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 35px rgba(18,60,105,.09);
            border-color: #c5d7eb;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: #e9f1fb;
            color: var(--primary);
            font-size: 24px;
            margin-bottom: 22px;
        }

        .feature-card h3 {
            font-size: 17px;
            margin-bottom: 12px;
            color: var(--primary-dark);
        }

        .feature-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.85;
        }

        /* ABOUT */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 65px;
            align-items: center;
        }

        .about-visual {
            min-height: 390px;
            border-radius: 18px;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(0deg, rgba(7,30,53,.7), transparent 65%),
                url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRgyCXhPlGACwsGJtRkQqG9ncvIo9VnDxAamkj9Terfw&s=10')
                center / cover no-repeat;
        }

        .visual-caption {
            position: absolute;
            bottom: 25px;
            left: 25px;
            right: 25px;
            color: white;
        }

        .visual-caption strong {
            display: block;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .visual-caption span {
            color: #dbe6f2;
            font-size: 12px;
        }

        .about-text .section-label {
            text-align: left;
        }

        .about-text h2 {
            font-size: clamp(28px, 3.5vw, 38px);
            line-height: 1.25;
            letter-spacing: -1px;
            color: var(--primary-dark);
            margin-bottom: 20px;
        }

        .about-text > p {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.9;
            margin-bottom: 25px;
        }

        .benefit-list {
            list-style: none;
            display: grid;
            gap: 15px;
            margin-bottom: 28px;
        }

        .benefit-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .check {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #e0f5e9;
            color: #16834b;
            font-size: 12px;
        }

        /* WORKFLOW */
        .workflow {
            background: var(--light);
        }

        .workflow-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            counter-reset: steps;
        }

        .workflow-card {
            position: relative;
            padding: 28px;
            background: white;
            border: 1px solid #e7edf4;
            border-radius: 14px;
        }

        .step-number {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: var(--primary);
            color: white;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .workflow-card h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .workflow-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        /* CTA */
        .cta {
            padding: 75px 0;
            background: var(--primary-dark);
            color: white;
        }

        .cta-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .cta h2 {
            font-size: clamp(25px, 3vw, 34px);
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .cta p {
            color: #c4d2e1;
            font-size: 14px;
        }

        .cta .btn {
            flex-shrink: 0;
            background: var(--accent);
            color: #192b3e;
        }

        .cta .btn:hover {
            background: #ffd16e;
        }

        /* FOOTER */
        footer {
            padding: 27px 0;
            background: #071b2e;
            color: #a8b9ca;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            font-size: 11px;
        }

        .footer-brand {
            color: white;
            font-size: 13px;
            font-weight: 700;
        }

        /* RESPONSIVE */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 25px;
            color: var(--primary);
            cursor: pointer;
        }

        @media (max-width: 850px) {
            .nav-links {
                gap: 17px;
                font-size: 12px;
            }

            .feature-grid,
            .workflow-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-grid {
                gap: 35px;
            }

            .about-visual {
                min-height: 340px;
            }
        }

        @media (max-width: 650px) {
            .navbar {
                height: 68px;
            }

            .brand {
                font-size: 15px;
            }

            .brand-icon {
                width: 38px;
                height: 38px;
            }

            .menu-toggle {
                display: block;
            }

            .nav-content {
                position: relative;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 52px;
                left: 0;
                right: 0;
                padding: 20px;
                background: white;
                border: 1px solid #e7edf4;
                border-radius: 12px;
                box-shadow: 0 12px 30px rgba(0,0,0,.08);
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links .btn {
                width: 100%;
            }

            .hero {
                min-height: 560px;
                background-position: 60% center;
            }

            .hero-content {
                padding: 75px 0;
            }

            .hero h1 {
                letter-spacing: -1.3px;
            }

            .hero p {
                font-size: 14px;
            }

            section {
                padding: 65px 0;
            }

            .feature-grid,
            .workflow-grid,
            .about-grid {
                grid-template-columns: 1fr;
            }

            .feature-card,
            .workflow-card {
                padding: 25px;
            }

            .about-visual {
                min-height: 290px;
                order: 2;
            }

            .about-text {
                order: 1;
            }

            .cta-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .footer-content {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *, *::before, *::after {
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container nav-content">
            <a href="#beranda" class="brand">
                <div class="brand-icon">⚙</div>
                <div>
                    RTG MONITORING
                    <small>OPERATIONAL SYSTEM</small>
                </div>
            </a>

            <button class="menu-toggle" id="menuToggle"
                    aria-label="Buka menu navigasi"
                    aria-expanded="false">☰</button>

            <nav class="nav-links" id="navLinks">
                <a href="#beranda">Beranda</a>
                <a href="#fitur">Fitur</a>
                <a href="#tentang">Tentang Sistem</a>
                <a href="#alur">Alur Kerja</a>
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                    Login <span aria-hidden="true">→</span>
                </a>
            </nav>
        </div>
    </header>

    <main>
        <!-- HERO -->
        <section class="hero" id="beranda">
            <div class="container">
                <div class="hero-content">
                    <div class="eyebrow">
                        <span class="status-dot"></span>
                        SISTEM MONITORING OPERASIONAL
                    </div>

                    <h1>
                        Monitoring RTG untuk
                        <span>Operasional yang Lebih Andal.</span>
                    </h1>

                    <p>
                        Platform monitoring untuk membantu pencatatan kendala,
                        pemantauan proses perbaikan, dan pengelolaan status
                        kelayakan operasional Rubber Tyred Gantry Crane secara
                        terstruktur dan terpusat.
                    </p>

                    <div class="hero-buttons">
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Masuk ke Sistem <span aria-hidden="true">→</span>
                        </a>

                        <a href="#fitur" class="btn btn-outline">
                            Pelajari Fitur
                        </a>
                    </div>

                    <div class="hero-note">
                        <span class="status-dot"></span>
                        <span>
                            Mendukung pengelolaan data dan tindak lanjut
                            kendala operasional RTG.
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section class="features" id="fitur">
            <div class="container">
                <div class="section-heading">
                    <div class="section-label">Fitur Utama</div>
                    <h2>Satu Sistem untuk Memantau Kelayakan RTG</h2>
                    <p>
                        Informasi operasional disusun agar proses pemantauan,
                        pelaporan, dan tindak lanjut kendala lebih mudah dikelola.
                    </p>
                </div>

                <div class="feature-grid">
                    <article class="feature-card">
                        <div class="feature-icon" aria-hidden="true">▦</div>
                        <h3>Monitoring Status RTG</h3>
                        <p>
                            Membantu memantau status kelayakan unit RTG dan
                            mengidentifikasi unit yang memerlukan tindak lanjut.
                        </p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon" aria-hidden="true">✎</div>
                        <h3>Pelaporan Kendala</h3>
                        <p>
                            Mencatat tanggal laporan, nomor RTG, temuan
                            pra-pengoperasian, dan kendala pasca-pengoperasian.
                        </p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon" aria-hidden="true">↻</div>
                        <h3>Tracking Perbaikan</h3>
                        <p>
                            Memudahkan pemantauan status tindak lanjut,
                            tanggal pelaksanaan, tanggal penyelesaian,
                            dan penanggung jawab.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <!-- ABOUT -->
        <section id="tentang">
            <div class="container about-grid">
                <div class="about-visual">
                    <div class="visual-caption">
                        <strong>Reliable Operational Monitoring</strong>
                        <span>
                            Mendukung pengelolaan informasi operasional RTG
                        </span>
                    </div>
                </div>

                <div class="about-text">
                    <div class="section-label">Tentang Sistem</div>
                    <h2>Informasi Terpusat, Tindak Lanjut Lebih Terarah</h2>

                    <p>
                        RTG Monitoring System dirancang sebagai sarana
                        pengelolaan informasi kondisi unit, pencatatan kendala,
                        dan pemantauan progres perbaikan. Data yang tersusun
                        secara terpusat membantu petugas memperoleh informasi
                        yang konsisten untuk mendukung koordinasi operasional.
                    </p>

                    <ul class="benefit-list">
                        <li>
                            <span class="check">✓</span>
                            <span>Pencatatan kendala dalam satu sistem.</span>
                        </li>
                        <li>
                            <span class="check">✓</span>
                            <span>Pemantauan status tindak lanjut per unit.</span>
                        </li>
                        <li>
                            <span class="check">✓</span>
                            <span>Riwayat laporan dan penyelesaian lebih terstruktur.</span>
                        </li>
                    </ul>

                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                        Akses Sistem <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- WORKFLOW -->
        <section class="workflow" id="alur">
            <div class="container">
                <div class="section-heading">
                    <div class="section-label">Alur Kerja</div>
                    <h2>Dari Pelaporan hingga Penyelesaian</h2>
                    <p>
                        Proses pengelolaan kendala dibuat lebih terstruktur
                        agar perkembangan penanganan mudah dipantau.
                    </p>
                </div>

                <div class="workflow-grid">
                    <article class="workflow-card">
                        <div class="step-number">01</div>
                        <h3>Pelaporan Kendala</h3>
                        <p>
                            Petugas mencatat nomor unit RTG, tanggal pelaporan,
                            serta temuan atau kendala yang ditemukan.
                        </p>
                    </article>

                    <article class="workflow-card">
                        <div class="step-number">02</div>
                        <h3>Proses Tindak Lanjut</h3>
                        <p>
                            Informasi pelaksanaan perbaikan, penanggung jawab,
                            dan progres penanganan dicatat dalam sistem.
                        </p>
                    </article>

                    <article class="workflow-card">
                        <div class="step-number">03</div>
                        <h3>Penyelesaian dan Verifikasi</h3>
                        <p>
                            Setelah kendala ditangani, informasi penyelesaian
                            diperbarui untuk mendukung verifikasi status unit.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <!-- CALL TO ACTION -->
        <section class="cta">
            <div class="container cta-content">
                <div>
                    <h2>Kelola Informasi Operasional RTG<br>Melalui Satu Platform.</h2>
                    <p>
                        Masuk ke sistem untuk mengakses fitur sesuai hak akses Anda.
                    </p>
                </div>

                <a href="{{ url('/dashboard') }}" class="btn">
                    Login ke Sistem <span aria-hidden="true">→</span>
                </a>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container footer-content">
            <div class="footer-brand">RTG Monitoring System</div>
            <div>
                Sistem Informasi Monitoring dan Pelaporan Operasional RTG
            </div>
            <div>
                &copy; {{ date('Y') }} TPS Team. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');

        menuToggle.addEventListener('click', function () {
            const isOpen = navLinks.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', isOpen);
            menuToggle.setAttribute(
                'aria-label',
                isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'
            );
            menuToggle.textContent = isOpen ? '✕' : '☰';
        });

        navLinks.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                navLinks.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Buka menu navigasi');
                menuToggle.textContent = '☰';
            });
        });
    </script>

</body>
</html>