<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan RTG - Dashboard Monitoring Modern</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        body { background-color: #f8fafc; color: #0f172a; }
        
        .navbar { 
            background: linear-gradient(135deg, #0f172a 0%, #16c87e 100%); 
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
        .nav-links a:hover, .nav-links a.active { color: #ffffff; font-weight: 700; }

        .container { max-width: 1280px; margin: 30px auto; padding: 0 24px; }
        
        .hero-banner {
            background: linear-gradient(90deg, rgba(235, 243, 250, 0.95) 30%, rgba(235, 243, 250, 0.4) 70%), 
                        url('https://swamediainc.storage.googleapis.com/swa.co.id/wp-content/uploads/2021/09/21062705/Pelabuhan-Tg-Priok.jpg') right center/cover no-repeat;
            border-radius: 16px;
            padding: 40px 45px;
            color: #0f2c4a;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero-banner h1 { font-size: 32px; font-weight: 800; color: #0f2c4a; margin-bottom: 10px; letter-spacing: -0.5px; }
        .hero-banner p { font-size: 15px; color: #475569; font-weight: 500; }

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
        }
        .metric-info p { font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 6px; }
        .metric-info h2 { font-size: 32px; font-weight: 800; color: #0f172a; }
        .metric-info span { font-size: 13px; color: #94a3b8; font-weight: 500; }
        .metric-icon-bg {
            width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;
        }
        .bg-normal { background: #ecfdf5; color: #10b981; }
        .bg-warning { background: #fffbeb; color: #f59e0b; }
        .bg-danger { background: #fef2f2; color: #ef4444; }
        .bg-info { background: #eff6ff; color: #3b82f6; }

        .dot { height: 8px; width: 8px; border-radius: 50%; display: inline-block; }
        .dot-normal { background-color: #10b981; }
        .dot-warning { background-color: #f59e0b; }
        .dot-danger { background-color: #ef4444; }

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

        .unit-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 12px; }
        .unit-card { 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            padding: 14px; 
            background: #ffffff; 
            transition: all 0.2s;
        }
        .unit-card.danger { border-color: #fca5a5; background: #fff8f8; }
        .unit-title { font-size: 15px; font-weight: 800; color: #0f172a; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center; }
        
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-normal { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .unit-sub { font-size: 11px; color: #94a3b8; margin-top: 10px; font-weight: 500; }

        .table-responsive { overflow-x: auto; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        th { color: #64748b; padding: 12px 14px; border-bottom: 2px solid #f1f5f9; font-weight: 700; font-size: 12px; text-transform: uppercase; }
        td { padding: 14px; border-bottom: 1px solid #f8fafc; color: #334155; font-weight: 500; }
        .status-pill { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .pill-baru { background: #0f2c4a; color: white; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-box-seam-fill"></i></div>
            <div>Pelaporan RTG <span style="font-size:11px; font-weight:400; opacity:0.8; display:block;">Operasional Lapangan Terminal</span></div>
        </div>
        <div class="nav-links">
            <a href="/form"><i class="bi bi-file-earmark-plus"></i> Form Pelaporan</a>
<<<<<<< HEAD
            <a href="/dashboard" class="active"><i class="bi bi-grid-1x2-fill"></i> Dashboard Monitoring</a>
=======
            <a href="/" class="active"><i class="bi bi-grid-1x2-fill"></i> Dashboard Monitoring</a>
            <a href="/penanganan"><i class="bi bi-tools"></i> Penanganan Teknisi</a>
>>>>>>> 5d89033e (penanganan.blade.)
        </div>
    </div>

    <div class="container">
        <div class="hero-banner">
            <div>
                <h1>Pelaporan Kendala Operasional</h1>
                <p>Laporkan setiap kendala operasional yang terjadi untuk mendukung kelancaran aktivitas terminal.</p>
            </div>
            <a href="/form" class="btn-primary"><i class="bi bi-plus-lg"></i> Buat Laporan Kendala</a>
        </div>

        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-info">
                    <p>RTG Beroperasi Normal</p>
                    <h2 id="total-ready">35 <span>dari 35 unit</span></h2>
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
                    <h2 id="total-perbaikan">0 <span>unit</span></h2>
                </div>
                <div class="metric-icon-bg bg-danger"><i class="bi bi-wrench-adjustable-circle-fill"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info">
                    <p>Laporan Hari Ini</p>
                    <h2 id="total-laporan">0 <span>laporan masuk</span></h2>
                </div>
                <div class="metric-icon-bg bg-info"><i class="bi bi-file-text-fill"></i></div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="section-card">
                <div class="grid-header">
                    <h3><i class="bi bi-cpu-fill" style="color: #2563eb;"></i> Status Unit RTG (Layout Area)</h3>
                    <div class="status-legend">
                        <span><span class="dot dot-normal"></span> Normal / Ready</span>
                        <span><span class="dot dot-danger"></span> Perlu Perbaikan</span>
                    </div>
                </div>

                <div class="unit-grid" id="unit-grid-container"></div>
            </div>

            <div class="section-card">
                <h3><i class="bi bi-bar-chart-line-fill" style="color: #2563eb;"></i> Grafik Laporan Kendala (7 Hari Terakhir)</h3>
                <div style="margin-top: 15px;">
                    <canvas id="chartLaporan" height="65"></canvas>
                </div>
            </div>

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
                        <tbody id="table-reports-body">
                            <tr>
                                <td colspan="6" style="text-align: center; color: #94a3b8; padding: 20px;">Belum ada laporan masuk.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadRtgDashboard() {
            fetch('/api/rtg-status')
                .then(response => response.json())
                .then(data => {
                    // Update Metric Card
                    let readyCount = data.total_ready || 0;
                    let perbaikanCount = data.total_perbaikan || 0;
                    let totalUnits = data.total_rtg || 35;

                    document.getElementById('total-ready').innerHTML = `${readyCount} <span>dari ${totalUnits} unit</span>`;
                    document.getElementById('total-perbaikan').innerHTML = `${perbaikanCount} <span>unit</span>`;
                    document.getElementById('total-laporan').innerHTML = `${perbaikanCount} <span>laporan masuk</span>`;

                    // Peta Data Status dari DB
                    let statusMap = {};
                    let reportsList = [];

                    if (data.data) {
                        data.data.forEach(item => {
                            statusMap[item.unit_code] = item.status;
                            if (item.status === 'perbaikan') {
                                reportsList.push(item);
                            }
                        });
                    }

                    // Render Unit Grid (38 - 72)
                    const gridContainer = document.getElementById('unit-grid-container');
                    gridContainer.innerHTML = '';

                    for (let i = 38; i <= 72; i++) {
                        let unitCode = `RTG ${i}`;
                        let isPerbaikan = statusMap[unitCode] === 'perbaikan';

                        let cardHtml = `
                            <div class="unit-card ${isPerbaikan ? 'danger' : ''}">
                                <div class="unit-title">
                                    ${unitCode}
                                    ${isPerbaikan ? '<i class="bi bi-wrench" style="color:#ef4444; font-size:14px;"></i>' : ''}
                                </div>
                                <span class="badge ${isPerbaikan ? 'badge-danger' : 'badge-normal'}">
                                    <span class="dot ${isPerbaikan ? 'dot-danger' : 'dot-normal'}"></span>
                                    ${isPerbaikan ? 'Perbaikan' : 'Normal'}
                                </span>
                                <div class="unit-sub">
                                    ${isPerbaikan ? 'Perlu tindakan' : 'Tanpa laporan aktif'}
                                </div>
                            </div>
                        `;
                        gridContainer.innerHTML += cardHtml;
                    }

                    // Render Tabel Laporan Masuk
                    const tableBody = document.getElementById('table-reports-body');
                    if (reportsList.length > 0) {
                        tableBody.innerHTML = '';
                        reportsList.forEach(report => {
                            let row = `
                                <tr>
                                    <td>${report.updated_at ? new Date(report.updated_at).toLocaleDateString('id-ID') : 'Hari Ini'}</td>
                                    <td><b>${report.unit_code}</b></td>
                                    <td>${report.pelapor || 'Operator'}</td>
                                    <td>${report.pra_ops || 'Ada laporan kendala'}</td>
                                    <td>${report.pasca_ops || 'Membutuhkan perbaikan'}</td>
                                    <td><span class="status-pill pill-baru">Baru</span></td>
                                </tr>
                            `;
                            tableBody.innerHTML += row;
                        });
                    }
                })
                .catch(err => console.error('Error loading RTG status:', err));
        }

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
                    y: { beginAtZero: true, ticks: { stepSize: 1, precision: 0 }, grid: { color: '#f1f5f9' }, border: { color: '#cbd5e1', width: 2 } },
                    x: { grid: { display: false }, border: { color: '#cbd5e1', width: 2 } }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', loadRtgDashboard);
    </script>
</body>
</html>