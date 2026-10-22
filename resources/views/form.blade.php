<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan RTG - Form Pelaporan Modern</title>
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

        /* Header Banner Form */
        .hero-banner {
            background: linear-gradient(90deg, rgba(235, 243, 250, 0.95) 30%, rgba(235, 243, 250, 0.4) 70%), 
                        url('https://www.titikomapost.com/wp-content/uploads/2021/02/IMG-20210209-WA0179.jpg') right center/cover no-repeat;
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

        /* Form Layout */
        .layout { display: grid; grid-template-columns: 2.2fr 1fr; gap: 24px; }
        
        .form-card { 
            background: white; 
            border-radius: 16px; 
            padding: 30px; 
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03); 
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 22px; }
        .form-group { margin-bottom: 22px; }
        .form-group label { 
            display: block; 
            font-size: 13px; 
            font-weight: 700; 
            color: #334155; 
            margin-bottom: 8px; 
        }
        
        input[type="text"], input[type="date"], select, textarea { 
            width: 100%; 
            padding: 12px 14px; 
            border: 1px solid #cbd5e1; 
            border-radius: 10px; 
            font-size: 14px; 
            background-color: #ffffff;
            color: #0f172a;
            transition: all 0.2s;
            outline: none;
        }
        
        input[type="text"]:focus, input[type="date"]:focus, select:focus, textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        textarea { height: 100px; resize: none; }

        /* Button Action */
        .btn-group { display: flex; align-items: center; gap: 12px; margin-top: 10px; }
        .btn-submit { 
            background-color: #2563eb; 
            color: white; 
            border: none; 
            padding: 12px 24px; 
            border-radius: 10px; 
            font-weight: 700; 
            font-size: 14px;
            cursor: pointer; 
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }
        .btn-submit:hover { background-color: #1d4ed8; transform: translateY(-2px); }
        
        .btn-reset { 
            background-color: white; 
            border: 1px solid #cbd5e1; 
            color: #475569;
            padding: 12px 20px; 
            border-radius: 10px; 
            font-weight: 600; 
            font-size: 14px;
            cursor: pointer; 
            transition: all 0.2s;
        }
        .btn-reset:hover { background-color: #f8fafc; color: #0f172a; }

        /* Info Card Sidebar */
        .info-card { 
            background: white; 
            border-radius: 16px; 
            padding: 24px; 
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03); 
            margin-bottom: 20px;
        }
        .info-card h4 { 
            font-size: 15px; 
            font-weight: 700; 
            color: #0f172a; 
            margin-bottom: 14px; 
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-card p { font-size: 13px; color: #64748b; line-height: 1.6; }
        .info-card p b { color: #334155; }

        .info-box {
            background: #eff6ff;
            border-left: 4px solid #2563eb;
            padding: 14px;
            border-radius: 8px;
            font-size: 12px;
            color: #1e40af;
            margin-top: 15px;
        }
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
            <a href="/form" class="active"><i class="bi bi-file-earmark-plus-fill"></i> Form Pelaporan</a>
            <a href="/"><i class="bi bi-grid-1x2"></i> Dashboard Monitoring</a>
        </div>
    </div>

    <div class="container">
        <!-- Banner Header Form -->
       <div class="hero-banner">
            <h1>Pelaporan Kendala Operasional</h1>
            <p>Laporkan setiap kendala operasional yang terjadi untuk mendukung kelancaran aktivitas terminal.</p>
        </div>

        <div class="layout">
            <!-- Form Card Utama -->
            <div class="form-card">
                <form>
                    <div class="form-row">
                        <div>
                            <label for="pelapor"><i class="bi bi-person-fill" style="color: #2563eb;"></i> 01 Nama Pelapor / Operator</label>
                            <input type="text" id="pelapor" placeholder="Nama lengkap operator" required>
                        </div>
                        <div>
                            <label for="tanggal"><i class="bi bi-calendar-event-fill" style="color: #2563eb;"></i> 02 Tanggal Pelaporan</label>
                            <input type="date" id="tanggal" value="2026-10-19" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="unit_code"><i class="bi bi-truck-front-fill" style="color: #2563eb;"></i> 03 Nomor RTG yang Terkendala</label>
                        <select id="unit_code" name="unit_code" required>
                            <option value="" disabled selected>-- Pilih unit RTG (38 - 72) --</option>
                            <option value="RTG 38">RTG 38</option>
                            <option value="RTG 39">RTG 39</option>
                            <option value="RTG 40">RTG 40</option>
                            <option value="RTG 41">RTG 41</option>
                            <option value="RTG 42">RTG 42</option>
                            <option value="RTG 43">RTG 43</option>
                            <option value="RTG 44">RTG 44</option>
                            <option value="RTG 45">RTG 45</option>
                            <option value="RTG 46">RTG 46</option>
                            <option value="RTG 47">RTG 47</option>
                            <option value="RTG 48">RTG 48</option>
                            <option value="RTG 49">RTG 49</option>
                            <option value="RTG 50">RTG 50</option>
                            <option value="RTG 51">RTG 51</option>
                            <option value="RTG 52">RTG 52</option>
                            <option value="RTG 53">RTG 53</option>
                            <option value="RTG 54">RTG 54</option>
                            <option value="RTG 55">RTG 55</option>
                            <option value="RTG 56">RTG 56</option>
                            <option value="RTG 57">RTG 57</option>
                            <option value="RTG 58">RTG 58</option>
                            <option value="RTG 59">RTG 59</option>
                            <option value="RTG 60">RTG 60</option>
                            <option value="RTG 61">RTG 61</option>
                            <option value="RTG 62">RTG 62</option>
                            <option value="RTG 63">RTG 63</option>
                            <option value="RTG 64">RTG 64</option>
                            <option value="RTG 65">RTG 65</option>
                            <option value="RTG 66">RTG 66</option>
                            <option value="RTG 67">RTG 67</option>
                            <option value="RTG 68">RTG 68</option>
                            <option value="RTG 69">RTG 69</option>
                            <option value="RTG 70">RTG 70</option>
                            <option value="RTG 71">RTG 71</option>
                            <option value="RTG 72">RTG 72</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pra_ops"><i class="bi bi-shield-exclamation" style="color: #2563eb;"></i> 04 Temuan / Kendala Pra-Pengoperasian Alat</label>
                        <textarea id="pra_ops" placeholder="Contoh: suhu oli hidrolik tinggi saat pemanasan, lampu sorot redup..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="pasca_ops"><i class="bi bi-tools" style="color: #2563eb;"></i> 05 Temuan / Kendala Pasca-Pengoperasian Alat</label>
                        <textarea id="pasca_ops" placeholder="Contoh: bunyi gesek pada roda gantry, rem trolley kurang pakem..."></textarea>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn-submit"><i class="bi bi-send-fill"></i> Kirim Laporan</button>
                        <button type="reset" class="btn-reset">Kosongkan Form</button>
                    </div>
                </form>
            </div>

            <!-- Sidebar Informasi / Panduan -->
            <div>
                <div class="info-card">
                    <h4><i class="bi bi-info-circle-fill" style="color: #2563eb;"></i> Panduan Pengisian</h4>
                    <p><b>Pra-Pengoperasian:</b> Pengecekan sebelum alat dijalankan (kondisi fisik, oli, rem, lampu, alarm, dan kabel).</p>
                    <br>
                    <p><b>Pasca-Pengoperasian:</b> Catatan setelah alat selesai dipakai (bunyi tidak normal, getaran berlebih, atau gerakan tidak mulus).</p>
                    
                    <div class="info-box">
                        <i class="bi bi-check-all"></i> Laporan yang dikirim akan otomatis muncul di Dashboard Monitoring untuk segera ditindaklanjuti oleh tim maintenance.
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>