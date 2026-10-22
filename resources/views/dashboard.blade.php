<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan RTG - Dashboard Monitoring Modern</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font & Icon Google -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        body { background-color: #f8fafc; color: #0f172a; }
        
        /* Navbar Modern */
        .navbar { 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
            color: white; 
            padding: 16px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .brand { display: flex; align-items: center; gap: 12px; font-weight: 700; font-size: 16px; }
        .brand-icon { 
            background: #2563eb; 
            color: white; 
            padding: 8px 12px; 
            border-radius: 10px; 
            font-size: 18px; 
            display: flex; 
            align-items: center; 
            justify-content: center;
        }
        .nav-links a { 
            color: #94a3b8; 
            text-decoration: none; 
            margin-left: 24px; 
            font-size: 14px; 
            font-weight: 500;
            transition: all 0.2s;
        }
        .nav-links a:hover, .nav-links a.active { 
            color: #ffffff; 
            font-weight: 700; 
        }

        .container { max-width: 1280px; margin: 30px auto; padding: 0 24px; }
        
        /* Header Hero dengan Visual Banner Gambar/Ilustrasi Pelabuhan */
        .hero-banner {
            background: linear-gradient(90deg, rgba(235, 243, 250, 0.95) 30%, rgba(235, 243, 250, 0.4) 70%), 
                        url('https://swamediainc.storage.googleapis.com/swa.co.id/wp-content/uploads/2021/09/21062705/Pelabuhan-Tg-Priok.jpg') right center/cover no-repeat;
            border-radius: 16px;
            padding: 40px 45px;
            color: #0f2c4a; /* Warna teks biru gelap */
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .hero-banner h1 { 
            font-size: 32px; 
            font-weight: 800; 
            color: #0f2c4a; 
            margin-bottom: 10px; 
            letter-spacing: -0.5px;
        }

        .hero-banner p { 
            font-size: 15px; 
            color: #475569; 
            font-weight: 500; 
        }
    
        
        .btn-primary { 
            background: #2563eb; 
            color: white; 
            padding: 12px 24px; 
            border-radius: 10px; 
            text-decoration: none; 
            font-size: 14px; 
            font-weight: 600; 
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-2px); }

        /* Metric Cards Modern */
        .metrics-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 30px; }
        .metric-card { 
            background: white; 
            padding: 22px; 
            border-radius: 14px; 
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03); 
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }
        .metric-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
        .metric-info p { font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 6px; }
        .metric-info h2 { font-size: 32px; font-weight: 800; color: #0f172a; }
        .metric-info span { font-size: 13px; color: #94a3b8; font-weight: 500; }
        .metric-icon-bg {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
        .bg-normal { background: #ecfdf5; color: #10b981; }
        .bg-warning { background: #fffbeb; color: #f59e0b; }
        .bg-danger { background: #fef2f2; color: #ef4444; }
        .bg-info { background: #eff6ff; color: #3b82f6; }

        .dot { height: 8px; width: 8px; border-radius: 50%; display: inline-block; }
        .dot-normal { background-color: #10b981; }
        .dot-warning { background-color: #f59e0b; }
        .dot-danger { background-color: #ef4444; }

        /* Dashboard Content & Section Cards */
        .dashboard-content { display: flex; flex-direction: column; gap: 24px; margin-bottom: 30px; }
        .section-card { 
            background: white; 
            padding: 24px; 
            border-radius: 16px; 
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03); 
        }

        .grid-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .grid-header h3 { font-size: 18px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; }
        .status-legend { display: flex; gap: 16px; font-size: 12px; font-weight: 600; color: #64748b; }

        /* Unit Grid 7 Kolom x 5 Baris Modern */
        .unit-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 12px; }
        .unit-card { 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            padding: 14px; 
            background: #ffffff; 
            transition: all 0.2s;
            position: relative;
        }
        .unit-card:hover { transform: translateY(-2px); box-shadow: 0 6px 12px rgba(0,0,0,0.05); }
        .unit-card.warning { border-color: #fcd34d; background: #fffdf5; }
        .unit-card.danger { border-color: #fca5a5; background: #fff8f8; }
        .unit-title { font-size: 15px; font-weight: 800; color: #0f172a; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center; }
        
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-normal { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .unit-sub { font-size: 11px; color: #94a3b8; margin-top: 10px; font-weight: 500; }

        /* Tabel Modern */
        .table-responsive { overflow-x: auto; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        th { color: #64748b; padding: 12px 14px; border-bottom: 2px solid #f1f5f9; font-weight: 700; font-size: 12px; text-transform: uppercase; }
        td { padding: 14px; border-bottom: 1px solid #f8fafc; color: #334155; font-weight: 500; }
        .status-pill { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .pill-baru { background: #0f2c4a; color: white; }
        .pill-ditangani { border: 1px solid #94a3b8; color: #475569; }
    </style>
</head>
<body>

    <!-- Navbar Modern -->
    <div class="navbar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-box-seam-fill"></i></div>
            <div>Pelaporan RTG <span style="font-size:11px; font-weight:400; opacity:0.8; display:block;">Operasional Lapangan Terminal</span></div>
        </div>
        <div class="nav-links">
            <a href="/form"><i class="bi bi-file-earmark-plus"></i> Form Pelaporan</a>
            <a href="/" class="active"><i class="bi bi-grid-1x2-fill"></i> Dashboard Monitoring</a>
        </div>
    </div>

    <div class="container">
        <!-- Hero Banner dengan Gambar/Ilustrasi Pelabuhan -->
       <div class="hero-banner">
            <h1>Pelaporan Kendala Operasional</h1>
            <p>Laporkan setiap kendala operasional yang terjadi untuk mendukung kelancaran aktivitas terminal.</p>
        </div>
            <a href="/form" class="btn-primary"><i class="bi bi-plus-lg"></i> Buat Laporan Kendala</a>
        </div>

        <!-- Metric Cards dengan Icon Visual -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-info">
                    <p>RTG Beroperasi Normal</p>
                    <h2>17 <span>dari 35 unit</span></h2>
                </div>
                <div class="metric-icon-bg bg-normal"><i class="bi bi-check-circle-fill"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info">
                    <p>RTG Perlu Perhatian</p>
                    <h2>0 <span>unit</span></h2>
                </div>
                <div class="metric-icon-bg bg-warning"><i class="bi bi-exclamation-triangle-fill"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info">
                    <p>RTG Perlu Perbaikan</p>
                    <h2>18 <span>unit</span></h2>
                </div>
                <div class="metric-icon-bg bg-danger"><i class="bi bi-wrench-adjustable-circle-fill"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info">
                    <p>Laporan Hari Ini</p>
                    <h2>3 <span>laporan masuk</span></h2>
                </div>
                <div class="metric-icon-bg bg-info"><i class="bi bi-file-text-fill"></i></div>
            </div>
        </div>

        <div class="dashboard-content">
            <!-- Peta Status Grid Unit RTG (7 Kolom x 5 Baris) -->
            <div class="section-card">
                <div class="grid-header">
                    <h3><i class="bi bi-cpu-fill" style="color: #2563eb;"></i> Status Unit RTG (Layout Area)</h3>
                    <div class="status-legend">
                        <span><span class="dot dot-normal"></span> Normal / Ready</span>
                        <span><span class="dot dot-warning"></span> Perlu Perhatian</span>
                        <span><span class="dot dot-danger"></span> Perlu Perbaikan</span>
                    </div>
                </div>

                <div class="unit-grid">
                    <!-- Baris 1: Blok A (RTG 38 - RTG 44) -->
                    <div class="unit-card danger"><div class="unit-title">RTG 38 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 39</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 40</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 41</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 42 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 43 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 18 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 44</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>

                    <!-- Baris 2: Blok B (RTG 45 - RTG 51) -->
                    <div class="unit-card danger"><div class="unit-title">RTG 45 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 46</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 47</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 48 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 49 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 18 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 50</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 51</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>

                    <!-- Baris 3: Blok C (RTG 52 - RTG 58) -->
                    <div class="unit-card danger"><div class="unit-title">RTG 52 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 53 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 54</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 55 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 18 Okt</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 56 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 57 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 58</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>

                    <!-- Baris 4: Blok D (RTG 59 - RTG 65) -->
                    <div class="unit-card danger"><div class="unit-title">RTG 59 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 60</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 61 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 62</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 63</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 64 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 65</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>

                    <!-- Baris 5: Blok E (RTG 66 - RTG 72) -->
                    <div class="unit-card"><div class="unit-title">RTG 66</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 67</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 68</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 69</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 70</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card"><div class="unit-title">RTG 71</div><span class="badge badge-normal"><span class="dot dot-normal"></span> Normal</span><div class="unit-sub">Tanpa laporan aktif</div></div>
                    <div class="unit-card danger"><div class="unit-title">RTG 72 <i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i></div><span class="badge badge-danger"><span class="dot dot-danger"></span> Perbaikan</span><div class="unit-sub">Dilaporkan 19 Okt</div></div>
                </div>
            </div>

            <!-- Grafik Batang Laporan 7 Hari Terakhir -->
            <div class="section-card">
                <h3><i class="bi bi-bar-chart-line-fill" style="color: #2563eb;"></i> Grafik Laporan Kendala (7 Hari Terakhir)</h3>
                <div style="margin-top: 15px;">
                    <canvas id="chartLaporan" height="65"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Laporan Terbaru -->
        <div class="section-card">
            <div class="grid-header">
                <h3><i class="bi bi-journal-text" style="color: #2563eb;"></i> Laporan Kendala Terbaru</h3>
                <a href="/form" style="font-size:13px; color:#2563eb; font-weight:700; text-decoration:none;">Buat Laporan Baru →</a>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>RTG</th>
                            <th>Pelapor</th>
                            <th>Temuan Pra-Pengoperasian</th>
                            <th>Temuan Pasca-Pengoperasian</th>
                            <th>Status Penanganan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>19 Okt 2026</td>
                            <td><b>RTG 38</b></td>
                            <td>Budi Santoso</td>
                            <td>Suhu oli hidrolik tinggi saat pemanasan</td>
                            <td>Rem trolley terasa kurang pakem</td>
                            <td><span class="status-pill pill-baru">Baru</span></td>
                        </tr>
                        <tr>
                            <td>19 Okt 2026</td>
                            <td><b>RTG 42</b></td>
                            <td>Agus Prasetyo</td>
                            <td>Tidak ada temuan</td>
                            <td>Bunyi gesek pada roda gantry kanan</td>
                            <td><span class="status-pill pill-baru">Baru</span></td>
                        </tr>
                        <tr>
                            <td>18 Okt 2026</td>
                            <td><b>RTG 55</b></td>
                            <td>Rizky Hidayat</td>
                            <td>Alarm spreader tidak muncul di layar</td>
                            <td>Spreader tidak mengunci pada sudut tertentu</td>
                            <td><span class="status-pill pill-ditangani">Proses Perbaikan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Chart.js Batang dengan Sumbu X dan Y -->
    <script>
        const ctx = document.getElementById('chartLaporan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sel 13', 'Rab 14', 'Kam 15', 'Jum 16', 'Sab 17', 'Min 18', 'Sen 19'],
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: [2, 1, 3, 2, 2, 2, 3],
                    backgroundColor: '#2563eb',
                    hoverBackgroundColor: '#1d4ed8',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, precision: 0 },
                        grid: { color: '#f1f5f9' },
                        border: { display: true, color: '#cbd5e1', width: 2 }
                    },
                    x: {
                        grid: { display: false },
                        border: { display: true, color: '#cbd5e1', width: 2 }
                    }
                }
            }
        });
    </script>
</body>
</html>