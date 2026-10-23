<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monitoring & Penanganan Teknisi RTG</title>
    <!-- Font & Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body { background-color: #f1f5f9; color: #0f172a; display: flex; flex-direction: column; min-height: 100vh; }

        /* ======================== MAIN CONTENT ======================== */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Navbar Hijau */
        .header-navbar {
            background: #0f766e; 
            color: white; 
            padding: 12px 28px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); 
            position: sticky; 
            top: 0; 
            z-index: 100;
        }

        .topnav-search {
            flex: 1;
            max-width: 380px;
            position: relative;
        }
        .topnav-search input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 9px 14px 9px 38px;
            font-size: 13px;
            color: #334155;
            outline: none;
            transition: all 0.2s;
        }
        .topnav-search input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        .topnav-search i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 15px; }

        .topnav-divider { width: 1px; height: 28px; background: rgba(255,255,255,0.2); }

        .topnav-location {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #ecfdf5;
        }
        .topnav-location i { color: #6ee7b7; }

        .badge-live {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.15);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .badge-live .live-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #34d399;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .gate-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255,255,255,0.15);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .user-avatar {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 12px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 10px;
            cursor: pointer;
            color: white;
        }
        .avatar-img {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: #2563eb;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 700;
        }
        .user-info { font-size: 12px; }
        .user-info .name { font-weight: 700; color: white; }
        .user-info .role { color: #a7f3d0; font-size: 10px; }

        /* Page Content */
        .page-content { padding: 24px 28px; flex: 1; }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 6px;
        }
        .breadcrumb a { color: #94a3b8; text-decoration: none; }
        .breadcrumb a:hover { color: #2563eb; }
        .breadcrumb i { font-size: 10px; }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 14px;
        }
        .page-title h1 { font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-title p { font-size: 13px; color: #64748b; font-weight: 500; }

        .page-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

        .btn-refresh {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: white;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 9px 16px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-refresh:hover { background: #f8fafc; color: #0f172a; }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #2563eb;
            color: white;
            padding: 10px 18px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
        }
        .btn-add:hover { background: #1d4ed8; transform: translateY(-1px); }

        /* FILTER BAR */
        .filter-bar {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }
        .filter-search {
            position: relative;
            flex: 1;
            min-width: 200px;
            max-width: 300px;
        }
        .filter-search input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px 8px 34px;
            font-size: 13px;
            color: #334155;
            outline: none;
        }
        .filter-search i { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        .filter-divider { width: 1px; height: 22px; background: #e2e8f0; margin: 0 4px; }
        .filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569;
            transition: all 0.2s;
        }
        .filter-btn:hover, .filter-btn.active { background: #eff6ff; border-color: #bfdbfe; color: #2563eb; }
        .filter-select {
            padding: 7px 28px 7px 12px;
            border-radius: 7px;
            border: 1px solid #e2e8f0;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            background: white;
            outline: none;
            cursor: pointer;
        }
        .filter-select:focus { border-color: #2563eb; }

        .filter-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #fef3c7;
            color: #92400e;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .ms-auto { margin-left: auto; }

        /* METRICS */
        .metrics-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 22px; }
        .metric-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .metric-card:hover { box-shadow: 0 6px 16px rgba(0,0,0,0.06); transform: translateY(-1px); transition: all 0.2s; }
        .metric-label { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .metric-value { font-size: 34px; font-weight: 800; color: #0f172a; line-height: 1; margin-bottom: 4px; }
        .metric-sub { font-size: 11px; color: #94a3b8; font-weight: 600; }
        .metric-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .icon-blue { background: #eff6ff; color: #2563eb; }
        .icon-orange { background: #fff7ed; color: #ea580c; }
        .icon-purple { background: #f5f3ff; color: #7c3aed; }
        .icon-green { background: #f0fdf4; color: #16a34a; }

        /* KANBAN BOARD */
        .kanban-board {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            align-items: start;
        }

        .kanban-col {
            background: #f8fafc;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .kanban-header {
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
        }
        .kanban-header-left { display: flex; align-items: center; gap: 8px; }
        .kanban-col-title { font-size: 13px; font-weight: 700; color: #0f172a; }
        .col-count {
            width: 22px; height: 22px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px;
            font-weight: 800;
        }
        .col-new .kanban-header { background: #fef2f2; }
        .col-new .col-count { background: #ef4444; color: white; }
        .col-working .kanban-header { background: #eff6ff; }
        .col-working .col-count { background: #2563eb; color: white; }
        .col-waiting .kanban-header { background: #fff7ed; }
        .col-waiting .col-count { background: #ea580c; color: white; }
        .col-done .kanban-header { background: #f0fdf4; }
        .col-done .col-count { background: #16a34a; color: white; }

        .kanban-status-dot { width: 8px; height: 8px; border-radius: 50%; }
        .dot-red { background: #ef4444; }
        .dot-blue { background: #2563eb; }
        .dot-orange { background: #ea580c; }
        .dot-green { background: #16a34a; }

        .kanban-col-add {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 16px;
        }
        .kanban-col-add:hover { background: rgba(0,0,0,0.05); color: #475569; }

        .kanban-cards { padding: 12px; display: flex; flex-direction: column; gap: 10px; min-height: 80px; }

        /* Tiket Cards */
        .tiket-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 14px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .tiket-card:hover { box-shadow: 0 6px 16px rgba(0,0,0,0.08); transform: translateY(-1px); border-color: #cbd5e1; }

        .tiket-header { display: flex; align-items: center; gap: 6px; margin-bottom: 8px; flex-wrap: wrap; }
        .tiket-id { font-size: 10px; color: #94a3b8; font-weight: 700; }
        .tiket-block-badge {
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            background: #f1f5f9;
            color: #475569;
        }
        .priority-badge {
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            margin-left: auto;
        }
        .priority-kritis { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .priority-tinggi { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
        .priority-sedang { background: #fffbeb; color: #ca8a04; border: 1px solid #fde68a; }
        .priority-rendah { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }

        .tiket-title { font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1.3; }
        .tiket-subtitle {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tiket-meta { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .tiket-teknisi {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: #475569;
            font-weight: 600;
        }
        .teknisi-avatar {
            width: 22px; height: 22px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 9px;
            font-weight: 800;
            flex-shrink: 0;
        }
        .teknisi-avatar.green { background: linear-gradient(135deg, #10b981, #16a34a); }
        .teknisi-avatar.blue { background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .teknisi-avatar.orange { background: linear-gradient(135deg, #ea580c, #f59e0b); }

        .tiket-time {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 10px;
            color: #94a3b8;
            font-weight: 600;
            margin-left: auto;
        }
        .tiket-time.urgent { color: #ef4444; }

        .tiket-footer {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-tiket {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569;
            transition: all 0.2s;
        }
        .btn-tiket:hover { background: #f8fafc; }
        .btn-tiket-blue {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }
        .btn-tiket-blue:hover { background: #dbeafe; }
        .btn-tiket-green {
            background: #f0fdf4;
            color: #16a34a;
            border-color: #bbf7d0;
        }
        .btn-tiket-green:hover { background: #dcfce7; }

        .eta-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f0fdf4;
            color: #16a34a;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            margin-left: auto;
        }
        .eta-badge.orange { background: #fff7ed; color: #ea580c; }

        .tiket-card.selesai-card {
            border-left: 3px solid #16a34a;
            opacity: 0.9;
        }
        .selesai-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #dcfce7;
            color: #16a34a;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
        }
        .mttr-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f0f9ff;
            color: #0369a1;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
        }

        .kanban-empty {
            text-align: center;
            padding: 24px 12px;
            color: #94a3b8;
            font-size: 12px;
        }
        .kanban-empty i { font-size: 28px; display: block; margin-bottom: 6px; }

        /* MODAL */
        .modal-backdrop {
            position: fixed; inset: 0;
            background: rgba(15,23,42,0.6);
            z-index: 200;
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(3px);
        }
        .modal-backdrop.show { display: flex; }
        .modal-box {
            background: white;
            border-radius: 18px;
            padding: 28px;
            width: 100%;
            max-width: 580px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
        .modal-header h3 { font-size: 18px; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 8px; }
        .modal-close {
            background: #f1f5f9;
            border: none;
            border-radius: 8px;
            padding: 7px 10px;
            cursor: pointer;
            font-size: 16px;
            color: #64748b;
            transition: all 0.2s;
        }
        .modal-close:hover { background: #e2e8f0; color: #0f172a; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 13px;
            color: #0f172a;
            outline: none;
            background: white;
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }
        .form-group textarea { height: 80px; resize: none; }
        .modal-footer { display: flex; gap: 10px; margin-top: 20px; justify-content: flex-end; }
        .btn-cancel {
            background: white;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 10px 20px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-cancel:hover { background: #f8fafc; }
        .btn-save {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .btn-save:hover { background: #1d4ed8; }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }

        /* Responsive */
        @media (max-width: 1200px) {
            .kanban-board { grid-template-columns: repeat(2, 1fr); }
            .metrics-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .kanban-board { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- ======================== MAIN CONTENT ======================== -->
    <div class="main-content">

        <!-- TOP NAVBAR HIJAU (Sesuai Gambar 2) -->
        <header class="header-navbar">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="background: #2563eb; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <div style="font-size: 15px; font-weight: 800; line-height: 1.2;">Pelaporan RTG</div>
                    <div style="font-size: 11px; color: #a7f3d0; font-weight: 500;">Operasional Lapangan Terminal</div>
                </div>
            </div>

            <!-- Navigation Links Horizontal -->
            <nav style="display: flex; align-items: center; gap: 24px; font-size: 13px; font-weight: 600;">
                <a href="/form" style="color: #ecfdf5; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <i class="bi bi-file-earmark-text" style="font-size: 15px;"></i> Form Pelaporan
                </a>
                <a href="/" style="color: white; background: rgba(255,255,255,0.15); padding: 7px 14px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.25); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <i class="bi bi-speedometer2" style="font-size: 15px;"></i> Dashboard Monitoring
                </a>
                <a href="/penanganan" style="color: #ecfdf5; text-decoration: none; display: flex; align-items: center; gap: 8px; opacity: 0.85;">
                    <i class="bi bi-tools" style="font-size: 15px;"></i> Penanganan Teknisi
                </a>
            </nav>
        </header>


        <!-- Page Content -->
        <div class="page-content">

            <!-- Alert Flash Message -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
            @endif

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="/">Beranda</a>
                <i class="bi bi-chevron-right"></i>
                <a href="/">Data Tiket & Pemeliharaan</a>
                <i class="bi bi-chevron-right"></i>
                <span style="color:#0f172a; font-weight:600;">Monitoring & Penanganan Teknisi</span>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title">
                    <h1>Monitoring & Penanganan Teknisi RTG</h1>
                    <p>Papan kendali work order penanganan kerusakan, inspeksi mekanikal-elektrikal, dan alokasi tim teknisi lapangan secara real-time.</p>
                </div>
                <div class="page-actions">
                    <span style="display:inline-flex; align-items:center; gap:6px; background:#fef2f2; color:#dc2626; padding:8px 14px; border-radius:8px; font-size:12px; font-weight:700; border:1px solid #fecaca;">
                        <i class="bi bi-arrow-repeat" style="animation: spin 2s linear infinite;"></i>
                        LIVE TOS SYNC
                    </span>
                    <a href="/penanganan" class="btn-refresh">
                        <i class="bi bi-arrow-clockwise"></i> Refresh Data
                    </a>
                    <button class="btn-add" onclick="openModal()">
                        <i class="bi bi-plus-lg"></i> Tambah Work Order Manual
                    </button>
                </div>
            </div>

            <!-- Metric Cards -->
            <div class="metrics-grid">
                <div class="metric-card">
                    <div>
                        <div class="metric-label">Total Tiket Aktif</div>
                        <div class="metric-value">{{ $total_aktif }}</div>
                        <div class="metric-sub">Tiket</div>
                    </div>
                    <div class="metric-icon icon-blue">
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                </div>
                <div class="metric-card">
                    <div>
                        <div class="metric-label">Butuh Tindakan Cepat</div>
                        <div class="metric-value">{{ $butuh_tindakan_cepat }}</div>
                        <div class="metric-sub">Unit (P1/High)</div>
                    </div>
                    <div class="metric-icon icon-orange">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                </div>
                <div class="metric-card">
                    <div>
                        <div class="metric-label">Rata-rata MTTR</div>
                        <div class="metric-value">{{ $rata_mttr }}</div>
                        <div class="metric-sub">Menit</div>
                    </div>
                    <div class="metric-icon icon-purple">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
                <div class="metric-card">
                    <div>
                        <div class="metric-label">Teknisi On-Duty</div>
                        <div class="metric-value">{{ $teknisi_on_duty }}</div>
                        <div class="metric-sub">Personel Aktif</div>
                    </div>
                    <div class="metric-icon icon-green">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="filter-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="kanbanSearch" placeholder="Cari tiket, RTG, atau teknisi...">
                </div>
                <div class="filter-divider"></div>
                <button class="filter-btn active" onclick="filterAll(this)">Semua Blok (A, B, C)</button>
                <div class="filter-divider"></div>
                <select class="filter-select" onchange="filterPriority(this.value)">
                    <option value="">Tingkat Urgensi: Semua</option>
                    <option value="kritis">Kritis</option>
                    <option value="tinggi">Tinggi</option>
                    <option value="sedang">Sedang</option>
                    <option value="rendah">Rendah</option>
                </select>
                <select class="filter-select" onchange="filterTipe(this.value)">
                    <option value="">Semua Tim Penugasan</option>
                    <option value="mekanikal">Mekanikal</option>
                    <option value="elektrikal">Elektrikal</option>
                    <option value="hidrolik">Hidrolik</option>
                </select>
                <div class="ms-auto" style="display:flex; gap:8px; align-items:center;">
                    <span class="filter-badge">
                        <i class="bi bi-funnel-fill"></i> Filter Aktif
                    </span>
                    <button class="filter-btn" style="font-size:11px;">
                        <i class="bi bi-people-fill"></i> Shift 1 Pagi
                    </button>
                    <button class="filter-btn" onclick="openModal()">
                        <i class="bi bi-plus"></i> Reset
                    </button>
                </div>
            </div>

            <!-- Kanban Board -->
            <div class="kanban-board">

                <!-- Kolom 1: Laporan Baru -->
                <div class="kanban-col col-new">
                    <div class="kanban-header">
                        <div class="kanban-header-left">
                            <span class="kanban-status-dot dot-red"></span>
                            <span class="kanban-col-title">Laporan Baru</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span class="col-count">{{ $laporan_baru->count() }}</span>
                            <button class="kanban-col-add" onclick="openModal()"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                    <div class="kanban-cards" id="col-laporan_baru">
                        @forelse($laporan_baru as $wo)
                        <div class="tiket-card" id="card-{{ $wo->id }}">
                            <div class="tiket-header">
                                <span class="tiket-id">{{ $wo->ticket_number }}</span>
                                <span class="tiket-block-badge">{{ $wo->block }}</span>
                                <span class="priority-badge priority-{{ $wo->priority }}">
                                    @if($wo->priority === 'kritis') 🔴 @elseif($wo->priority === 'tinggi') 🟠 @elseif($wo->priority === 'sedang') 🟡 @else 🟢 @endif
                                    {{ ucfirst($wo->priority) }}
                                </span>
                            </div>
                            <div class="tiket-title">{{ $wo->unit_code }} • {{ $wo->block }}</div>
                            <div class="tiket-subtitle">{{ $wo->title }}</div>
                            @if($wo->teknisi_nama)
                            <div class="tiket-meta">
                                <div class="tiket-teknisi">
                                    <div class="teknisi-avatar">{{ strtoupper(substr($wo->teknisi_nama, 0, 2)) }}</div>
                                    {{ $wo->teknisi_nama }}
                                </div>
                                @if($wo->eta_minutes)
                                <div class="tiket-time {{ $wo->eta_minutes <= 30 ? 'urgent' : '' }}">
                                    <i class="bi bi-clock"></i>
                                    {{ $wo->eta_minutes }} mnt
                                </div>
                                @endif
                            </div>
                            @endif
                            <div class="tiket-footer">
                                <button class="btn-tiket btn-tiket-blue" onclick="updateStatus({{ $wo->id }}, 'sedang_dikerjakan')">
                                    <i class="bi bi-play-fill"></i> Tugaskan
                                </button>
                                <span style="margin-left:auto; font-size:10px; color:#94a3b8; font-weight:600;">
                                    {{ $wo->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="kanban-empty">
                            <i class="bi bi-inbox"></i>
                            Tidak ada laporan baru
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kolom 2: Sedang Dikerjakan -->
                <div class="kanban-col col-working">
                    <div class="kanban-header">
                        <div class="kanban-header-left">
                            <span class="kanban-status-dot dot-blue"></span>
                            <span class="kanban-col-title">Sedang Dikerjakan</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span class="col-count">{{ $sedang_dikerjakan->count() }}</span>
                        </div>
                    </div>
                    <div class="kanban-cards" id="col-sedang_dikerjakan">
                        @forelse($sedang_dikerjakan as $wo)
                        <div class="tiket-card" id="card-{{ $wo->id }}">
                            <div class="tiket-header">
                                <span class="tiket-id">{{ $wo->ticket_number }}</span>
                                <span class="tiket-block-badge">{{ $wo->block }}</span>
                                <span class="priority-badge priority-{{ $wo->priority }}">
                                    @if($wo->priority === 'kritis') 🔴 @elseif($wo->priority === 'tinggi') 🟠 @elseif($wo->priority === 'sedang') 🟡 @else 🟢 @endif
                                    {{ ucfirst($wo->priority) }}
                                </span>
                            </div>
                            <div class="tiket-title">{{ $wo->unit_code }} • {{ $wo->block }}</div>
                            <div class="tiket-subtitle">{{ $wo->title }}</div>
                            @if($wo->description)
                            <div class="tiket-subtitle" style="color:#475569;">{{ Str::limit($wo->description, 60) }}</div>
                            @endif
                            <div class="tiket-meta">
                                @if($wo->teknisi_nama)
                                <div class="tiket-teknisi">
                                    <div class="teknisi-avatar blue">{{ strtoupper(substr($wo->teknisi_nama, 0, 2)) }}</div>
                                    {{ $wo->teknisi_nama }}
                                </div>
                                @endif
                                @if($wo->started_at)
                                <div class="tiket-time">
                                    <i class="bi bi-stopwatch"></i>
                                    {{ $wo->started_at->diffForHumans() }}
                                </div>
                                @elseif($wo->eta_minutes)
                                <div class="tiket-time">
                                    <i class="bi bi-clock"></i>
                                    ETA {{ $wo->eta_minutes }} mnt
                                </div>
                                @endif
                            </div>
                            <div class="tiket-footer">
                                <button class="btn-tiket" onclick="updateStatus({{ $wo->id }}, 'menunggu_suku_cadang')">
                                    <i class="bi bi-box-seam"></i> Tunggu Part
                                </button>
                                <button class="btn-tiket btn-tiket-green" onclick="updateStatus({{ $wo->id }}, 'selesai')">
                                    <i class="bi bi-check2"></i> Selesai
                                </button>
                                <span style="margin-left:auto; font-size:10px; color:#94a3b8; font-weight:600;">
                                    {{ $wo->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="kanban-empty">
                            <i class="bi bi-wrench"></i>
                            Tidak ada pekerjaan aktif
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kolom 3: Menunggu Suku Cadang -->
                <div class="kanban-col col-waiting">
                    <div class="kanban-header">
                        <div class="kanban-header-left">
                            <span class="kanban-status-dot dot-orange"></span>
                            <span class="kanban-col-title">Menunggu Suku Cadang</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span class="col-count">{{ $menunggu_suku_cadang->count() }}</span>
                        </div>
                    </div>
                    <div class="kanban-cards" id="col-menunggu_suku_cadang">
                        @forelse($menunggu_suku_cadang as $wo)
                        <div class="tiket-card" id="card-{{ $wo->id }}">
                            <div class="tiket-header">
                                <span class="tiket-id">{{ $wo->ticket_number }}</span>
                                <span class="tiket-block-badge">{{ $wo->block }}</span>
                                <span class="priority-badge priority-{{ $wo->priority }}">
                                    @if($wo->priority === 'kritis') 🔴 @elseif($wo->priority === 'tinggi') 🟠 @elseif($wo->priority === 'sedang') 🟡 @else 🟢 @endif
                                    {{ ucfirst($wo->priority) }}
                                </span>
                            </div>
                            <div class="tiket-title">{{ $wo->unit_code }} • {{ $wo->block }}</div>
                            <div class="tiket-subtitle">{{ $wo->title }}</div>
                            @if($wo->part_needed)
                            <div style="display:inline-flex; align-items:center; gap:5px; background:#fff7ed; color:#c2410c; padding:4px 10px; border-radius:6px; font-size:11px; font-weight:700; margin-bottom:8px;">
                                <i class="bi bi-box-seam"></i>
                                Part: {{ $wo->part_needed }}
                            </div>
                            @endif
                            <div class="tiket-meta">
                                @if($wo->teknisi_nama)
                                <div class="tiket-teknisi">
                                    <div class="teknisi-avatar orange">{{ strtoupper(substr($wo->teknisi_nama, 0, 2)) }}</div>
                                    {{ $wo->teknisi_nama }}
                                </div>
                                @endif
                                @if($wo->eta_minutes)
                                <span class="eta-badge orange">
                                    <i class="bi bi-clock"></i> ETA {{ $wo->eta_minutes }} mnt
                                </span>
                                @endif
                            </div>
                            <div class="tiket-footer">
                                <button class="btn-tiket btn-tiket-blue" onclick="updateStatus({{ $wo->id }}, 'sedang_dikerjakan')">
                                    <i class="bi bi-play-fill"></i> Lanjut Kerjakan
                                </button>
                                <button class="btn-tiket btn-tiket-green" onclick="updateStatus({{ $wo->id }}, 'selesai')">
                                    <i class="bi bi-check2"></i> Selesai
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="kanban-empty">
                            <i class="bi bi-box-seam"></i>
                            Tidak ada menunggu part
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kolom 4: Selesai Hari Ini -->
                <div class="kanban-col col-done">
                    <div class="kanban-header">
                        <div class="kanban-header-left">
                            <span class="kanban-status-dot dot-green"></span>
                            <span class="kanban-col-title">Selesai Hari Ini</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span class="col-count">{{ $selesai_hari_ini->count() }}</span>
                        </div>
                    </div>
                    <div class="kanban-cards" id="col-selesai">
                        @forelse($selesai_hari_ini as $wo)
                        <div class="tiket-card selesai-card" id="card-{{ $wo->id }}">
                            <div class="tiket-header">
                                <span class="tiket-id">{{ $wo->ticket_number }}</span>
                                <span class="tiket-block-badge">{{ $wo->block }}</span>
                                <span class="selesai-badge"><i class="bi bi-check-circle-fill"></i> Ready OPS</span>
                            </div>
                            <div class="tiket-title">{{ $wo->unit_code }} • {{ $wo->block }}</div>
                            <div class="tiket-subtitle">{{ $wo->title }}</div>
                            <div class="tiket-meta">
                                @if($wo->teknisi_nama)
                                <div class="tiket-teknisi">
                                    <div class="teknisi-avatar green">{{ strtoupper(substr($wo->teknisi_nama, 0, 2)) }}</div>
                                    {{ $wo->teknisi_nama }}
                                </div>
                                @endif
                                @if($wo->mttr_minutes)
                                <span class="mttr-badge">
                                    <i class="bi bi-stopwatch"></i>
                                    MTTR: {{ $wo->mttr_minutes }} mnt
                                </span>
                                @endif
                            </div>
                            @if($wo->completed_at)
                            <div style="font-size:10px; color:#94a3b8; margin-top:8px; font-weight:600;">
                                <i class="bi bi-clock-history"></i>
                                Selesai: {{ $wo->completed_at->format('H:i') }} WIB
                            </div>
                            @endif
                            <div class="tiket-footer">
                                <button class="btn-tiket" style="font-size:10px; color:#475569;" disabled>
                                    <i class="bi bi-archive"></i> Arsip
                                </button>
                                <span style="margin-left:auto;">
                                    <form action="/penanganan/{{ $wo->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-tiket" style="color:#ef4444; border-color:#fecaca;" onclick="return confirm('Hapus work order ini?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="kanban-empty">
                            <i class="bi bi-check-all"></i>
                            Belum ada yang selesai hari ini
                        </div>
                        @endforelse
                    </div>
                </div>

            </div><!-- end kanban-board -->
        </div><!-- end page-content -->
    </div><!-- end main-content -->

<!-- ======================== MODAL TAMBAH WORK ORDER ======================== -->
<div class="modal-backdrop" id="modalBackdrop" onclick="closeModalOutside(event)">
    <div class="modal-box">
        <div class="modal-header">
            <h3><i class="bi bi-plus-circle-fill" style="color:#2563eb;"></i> Tambah Work Order Manual</h3>
            <button class="modal-close" onclick="closeModal()"><i class="bi bi-x-lg"></i></button>
        </div>
        <form action="/penanganan" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label><i class="bi bi-truck-front-fill" style="color:#2563eb;"></i> Nomor RTG</label>
                    <select name="unit_code" required>
                        <option value="" disabled selected>Pilih RTG...</option>
                        @for($i = 38; $i <= 72; $i++)
                        <option value="RTG {{ $i }}">RTG {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="bi bi-geo-alt-fill" style="color:#2563eb;"></i> Blok Area</label>
                    <select name="block" required>
                        <option value="" disabled selected>Pilih Blok...</option>
                        <option value="Blok A">Blok A</option>
                        <option value="Blok B">Blok B</option>
                        <option value="Blok C">Blok C</option>
                        <option value="Blok D">Blok D</option>
                        <option value="Blok E">Blok E</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label><i class="bi bi-card-heading" style="color:#2563eb;"></i> Judul / Jenis Kerusakan</label>
                <input type="text" name="title" placeholder="Contoh: Spreader Lock Error, Tekanan Hidrolik Turun..." required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label><i class="bi bi-exclamation-triangle-fill" style="color:#2563eb;"></i> Tingkat Prioritas</label>
                    <select name="priority" required>
                        <option value="sedang">Sedang</option>
                        <option value="rendah">Rendah</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="kritis">Kritis (P1)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="bi bi-person-badge-fill" style="color:#2563eb;"></i> Teknisi yang Ditugaskan</label>
                    <input type="text" name="teknisi_nama" placeholder="Nama teknisi (opsional)">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label><i class="bi bi-clock-fill" style="color:#2563eb;"></i> Estimasi Waktu (menit)</label>
                    <input type="number" name="eta_minutes" placeholder="Contoh: 45" min="1">
                </div>
                <div class="form-group">
                    <label><i class="bi bi-box-seam-fill" style="color:#2563eb;"></i> Suku Cadang Dibutuhkan</label>
                    <input type="text" name="part_needed" placeholder="Nama part (opsional)">
                </div>
            </div>
            <div class="form-group">
                <label><i class="bi bi-person-fill" style="color:#2563eb;"></i> Dilaporkan Oleh</label>
                <input type="text" name="reported_by" placeholder="Nama operator / pelapor">
            </div>
            <div class="form-group">
                <label><i class="bi bi-file-text-fill" style="color:#2563eb;"></i> Deskripsi Detail</label>
                <textarea name="description" placeholder="Deskripsi lengkap kerusakan / kendala..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-save"><i class="bi bi-send-fill"></i> Buat Work Order</button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    function openModal() {
        document.getElementById('modalBackdrop').classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        document.getElementById('modalBackdrop').classList.remove('show');
        document.body.style.overflow = '';
    }
    function closeModalOutside(e) {
        if (e.target === document.getElementById('modalBackdrop')) closeModal();
    }

    function updateStatus(workOrderId, newStatus) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        fetch(`/penanganan/${workOrderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memperbarui status.');
        });
    }

    document.getElementById('kanbanSearch').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.tiket-card').forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(q) ? '' : 'none';
        });
    });

    document.getElementById('globalSearch').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.tiket-card').forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(q) ? '' : 'none';
        });
    });

    function filterAll(btn) {
        document.querySelectorAll('.tiket-card').forEach(card => card.style.display = '');
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    function filterPriority(val) {
        document.querySelectorAll('.tiket-card').forEach(card => {
            if (!val) { card.style.display = ''; return; }
            const badge = card.querySelector('.priority-badge');
            if (badge && badge.className.includes('priority-' + val)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function filterTipe(val) {
        document.querySelectorAll('.tiket-card').forEach(card => {
            card.style.display = '';
        });
    }

    setTimeout(() => window.location.reload(), 60000);
</script>

</body>
</html>