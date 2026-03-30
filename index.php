<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Customer Onboarding - ValueQuest</title>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --primary: #1a3a5c; --primary-light: #e8f0fb; --primary-dark: #0f2540;
      --accent: #2563eb; --accent-light: #dbeafe;
      --success: #059669; --danger: #dc2626; --warning: #d97706;
      --gray-50:#f8fafc; --gray-100:#f1f5f9; --gray-200:#e2e8f0; --gray-300:#cbd5e1;
      --gray-400:#94a3b8; --gray-500:#64748b; --gray-600:#475569; --gray-700:#334155;
      --gray-800:#1e293b; --gray-900:#0f172a; --white:#ffffff; --radius:10px;
    }
    body {
      font-family:'Outfit',sans-serif;
      background: #eef2f7;
      min-height:100vh; display:flex; align-items:flex-start; justify-content:center;
      padding:24px 12px 48px; color:var(--gray-800);
    }
    .shell { width:92%; max-width:1140px; }
    .card { background:var(--white); border-radius:20px; box-shadow:0 10px 40px rgba(15,37,64,0.13); overflow:hidden; }

    /* ── HEADER ── */
    .hdr {
      background: linear-gradient(110deg, #0a0e1a 0%, #0f2540 100%);
      color:#fff; padding:14px 28px;
      display:flex; align-items:center; justify-content:space-between; gap:12px;
      border-bottom:1px solid rgba(255,255,255,0.06);
    }
    .hdr-logo { height:34px; display:flex; align-items:center; }
    .hdr-logo img { height:34px; width:auto; object-fit:contain; display:block; }
    .hdr-right { text-align:right; }
    .hdr-right .lbl { font-size:11px; color:rgba(255,255,255,0.45); font-weight:400; }
    .hdr-right .cnt { font-size:13px; font-weight:600; color:#fff; }

    /* ── STEPPER ── */
    .stp-wrap { background:var(--white); border-bottom:1px solid var(--gray-200); padding:0 16px; display:flex; align-items:center; gap:6px; }
    .stp-scroll { background:none; border:1.5px solid var(--gray-300); border-radius:50%; width:24px; height:24px; min-width:24px; cursor:pointer; font-size:11px; color:var(--gray-500); display:flex; align-items:center; justify-content:center; transition:all .2s; }
    .stp-scroll:hover { border-color:var(--accent); color:var(--accent); }
    .stp { display:flex; gap:3px; padding:10px 0; overflow-x:auto; flex:1; }
    .stp::-webkit-scrollbar { display:none; }
    .pill { display:flex; align-items:center; gap:5px; padding:5px 12px; border-radius:30px; cursor:pointer; border:1.5px solid var(--gray-200); background:var(--white); color:var(--gray-500); font-size:11.5px; font-weight:500; white-space:nowrap; transition:all .2s; font-family:'Outfit',sans-serif; }
    .pill .n { width:18px; height:18px; border-radius:50%; background:var(--gray-200); color:var(--gray-600); font-size:10px; font-weight:700; display:flex; align-items:center; justify-content:center; transition:all .2s; }
    .pill.active { background:var(--accent-light); border-color:var(--accent); color:var(--accent); }
    .pill.active .n { background:var(--accent); color:#fff; }
    .pill.done { border-color:var(--success); color:var(--success); }
    .pill.done .n { background:var(--success); color:#fff; }

    /* ── BODY ── */
    .body { padding:28px 32px; background:var(--white); }
    .sp { display:none; }
    .sp.active { display:block; animation: fadeIn .25s ease; }
    @keyframes fadeIn { from{opacity:0;transform:translateY(6px)} to{opacity:1;transform:none} }

    .pt { font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:700; color:var(--gray-900); margin-bottom:4px; letter-spacing:-0.3px; }
    .ps { font-size:13px; color:var(--gray-500); margin-bottom:22px; line-height:1.6; font-weight:400; }

    .sub {
      font-size:10.5px; font-weight:700; color:var(--accent); text-transform:uppercase;
      letter-spacing:1px; margin-bottom:14px; margin-top:6px;
      display:flex; align-items:center; gap:8px;
    }
    .sub::after { content:''; flex:1; height:1px; background:var(--accent-light); }

    /* ── GRIDS ── */
    .g3 { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:16px; }
    .g2 { display:grid; grid-template-columns:repeat(2,1fr); gap:16px; margin-bottom:16px; }
    .g4 { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:16px; }
    .s2 { grid-column:span 2; }
    .s3 { grid-column:span 3; }

    /* ── FORM ── */
    .fg { display:flex; flex-direction:column; gap:5px; }
    .lbl { font-size:11.5px; font-weight:600; color:var(--gray-700); display:flex; align-items:center; gap:4px; letter-spacing:0.1px; }
    .req { color:var(--danger); }
    .fc, .fs {
      width:100%; padding:9px 12px; border:1.5px solid var(--gray-200); border-radius:8px;
      font-size:13px; font-family:'Outfit',sans-serif; color:var(--gray-800);
      background:var(--white); outline:none; transition:border-color .18s,box-shadow .18s;
      -webkit-appearance:none; appearance:none;
    }
    .fs {
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
      background-repeat:no-repeat; background-position:right 11px center; padding-right:30px;
    }
    .fc:focus,.fs:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(37,99,235,.1); }
    .fc::placeholder { color:var(--gray-400); font-size:12px; }
    .fc[readonly] { background:var(--gray-50); color:var(--gray-500); cursor:default; }
    .ig { display:flex; }
    .ig .pfx { background:var(--gray-100); border:1.5px solid var(--gray-200); border-right:none; border-radius:8px 0 0 8px; padding:9px 10px; font-size:12px; color:var(--gray-600); white-space:nowrap; display:flex; align-items:center; font-weight:600; }
    .ig .fc { border-radius:0 8px 8px 0; }
    .rg { display:flex; flex-wrap:wrap; gap:14px; }
    .ri { display:flex; align-items:center; gap:6px; font-size:13px; cursor:pointer; color:var(--gray-700); font-weight:500; }
    .ri input { accent-color:var(--accent); width:15px; height:15px; cursor:pointer; }
    textarea.fc { resize:vertical; min-height:70px; }
    .hint { font-size:10.5px; color:var(--gray-400); margin-top:2px; }
    .ba { font-size:9px; font-weight:700; background:#fef3c7; color:#92400e; border-radius:4px; padding:2px 6px; letter-spacing:0.3px; }
    .bo { font-size:9px; font-weight:600; background:var(--gray-100); color:var(--gray-500); border-radius:4px; padding:2px 6px; }

    /* ── KRA ROW ── */
    .kra-row { display:grid; grid-template-columns:1fr 1fr auto; gap:16px; align-items:end; margin-bottom:16px; }
    .btn-kra {
      padding:0 18px; border:none; border-radius:8px; height:40px;
      background:var(--accent); color:#fff; font-size:12px; font-weight:700;
      font-family:'Outfit',sans-serif; cursor:pointer; white-space:nowrap;
      transition:all .2s; display:flex; align-items:center; gap:6px; letter-spacing:0.3px;
    }
    .btn-kra:hover { background:var(--primary-dark); transform:translateY(-1px); box-shadow:0 4px 12px rgba(37,99,235,.3); }
    .btn-kra svg { width:14px; height:14px; flex-shrink:0; }

    /* ── HOLDER BADGE ── */
    .ht { display:flex; align-items:center; gap:8px; font-size:13px; font-weight:700; color:var(--gray-800); margin-bottom:18px; }
    .hbadge { background:var(--accent); color:#fff; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:700; letter-spacing:0.5px; }
    .hbadge.jh { background:#0891b2; }

    /* ── JOINT HOLDER TOGGLE ── */
    .jht { border:1.5px dashed var(--gray-300); border-radius:var(--radius); padding:14px 18px; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; background:var(--gray-50); }
    .jht span { font-size:13px; font-weight:600; color:var(--gray-700); }

    /* ── BUTTONS ── */
    .btn-tgl { padding:7px 18px; border:1.5px solid var(--accent); border-radius:20px; background:var(--white); color:var(--accent); font-size:12px; font-weight:700; font-family:'Outfit',sans-serif; cursor:pointer; transition:all .2s; letter-spacing:0.2px; }
    .btn-tgl:hover,.btn-tgl.on { background:var(--accent); color:#fff; }

    /* ── NOMINEE ── */
    .ns { border:1.5px solid #a7f3d0; border-radius:var(--radius); padding:18px; margin-bottom:16px; background:#f0fdf4; }
    .nh { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
    .nt { font-size:13px; font-weight:700; color:var(--success); }

    /* ── UPLOAD ── */
    .uz { border:2px dashed var(--gray-300); border-radius:var(--radius); padding:16px 12px; text-align:center; color:var(--gray-500); font-size:12px; cursor:pointer; transition:all .2s; background:var(--gray-50); }
    .uz:hover { border-color:var(--accent); color:var(--accent); background:var(--accent-light); }
    .uz input[type="file"] { display:none; }
    .uz .uzi { font-size:22px; margin-bottom:5px; display:block; }
    .uz .uzl { font-size:12px; font-weight:600; }
    .uz .uzh { font-size:10.5px; color:var(--gray-400); margin-top:3px; }

    /* ── CAMERA ── */
    .cam-box { border:2px solid var(--gray-200); border-radius:12px; overflow:hidden; background:#000; position:relative; aspect-ratio:4/3; }
    .cam-box video, .cam-box canvas, .cam-box img.snap { width:100%; height:100%; object-fit:cover; display:block; }
    .cam-overlay { position:absolute; bottom:0; left:0; right:0; padding:10px; display:flex; justify-content:center; gap:8px; background:linear-gradient(transparent,rgba(0,0,0,0.5)); }
    .btn-cam { padding:6px 14px; border:none; border-radius:20px; background:rgba(255,255,255,0.9); color:#0f172a; font-size:12px; font-weight:700; cursor:pointer; font-family:'Outfit',sans-serif; transition:all .2s; }
    .btn-cam:hover { background:#fff; }
    .btn-cam.red { background:#ef4444; color:#fff; }
    .cam-placeholder { display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; color:#64748b; padding:20px; text-align:center; }
    .cam-placeholder span { font-size:32px; margin-bottom:8px; }
    .cam-placeholder p { font-size:12px; }
    .snap-done { position:absolute; top:8px; right:8px; background:#059669; color:#fff; border-radius:20px; padding:3px 10px; font-size:11px; font-weight:700; }

    /* ── REVIEW ── */
    .rb { margin-bottom:20px; }
    .rbt { font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--accent); border-bottom:1.5px solid var(--accent-light); padding-bottom:6px; margin-bottom:12px; }
    .rgd { display:grid; grid-template-columns:repeat(auto-fill,minmax(175px,1fr)); gap:12px; }
    .rvl { font-size:10px; color:var(--gray-400); font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
    .rvv { font-size:13px; color:var(--gray-800); font-weight:600; margin-top:3px; }

    /* ── RISK WIZARD ── */
    .rq-step { display:none; animation: fadeIn .3s ease; }
    .rq-step.active { display:block; }
    .rq-card { border:1.5px solid var(--gray-200); border-radius:14px; padding:28px 32px; max-width:680px; margin:0 auto; }
    .rq-num { font-size:11px; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:1px; margin-bottom:10px; }
    .rq-q { font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:600; color:var(--gray-900); line-height:1.5; margin-bottom:20px; }
    .rq-options { display:flex; flex-direction:column; gap:10px; }
    .rq-opt { display:flex; align-items:center; gap:12px; padding:14px 18px; border:1.5px solid var(--gray-200); border-radius:10px; cursor:pointer; transition:all .2s; font-size:14px; font-weight:500; color:var(--gray-700); }
    .rq-opt:hover { border-color:var(--accent); background:var(--accent-light); color:var(--accent); }
    .rq-opt input { accent-color:var(--accent); width:16px; height:16px; cursor:pointer; flex-shrink:0; }
    .rq-opt.selected { border-color:var(--accent); background:var(--accent-light); color:var(--accent); }
    .rq-nav { display:flex; align-items:center; justify-content:space-between; margin-top:24px; }
    .rq-progress { display:flex; gap:5px; flex:1; margin:0 16px; }
    .rq-dot { flex:1; height:4px; border-radius:10px; background:var(--gray-200); transition:all .3s; }
    .rq-dot.done { background:var(--success); }
    .rq-dot.active { background:var(--accent); }
    .rq-sub { background:#f0f9ff; border:1.5px solid #bae6fd; border-radius:10px; padding:14px 18px; margin-top:14px; display:none; }
    .rq-sub.show { display:block; }

    /* ── DISCLAIMER ── */
    .disc-box { background:#fffbeb; border:1.5px solid #fde68a; border-radius:12px; padding:18px 20px; margin-bottom:18px; font-size:13px; line-height:1.75; color:#78350f; }
    .disc-box strong { display:block; margin-bottom:8px; font-size:13.5px; color:#92400e; }
    .reg-box { background:#f0f9ff; border:1.5px solid #bae6fd; border-radius:12px; padding:18px 20px; margin-bottom:18px; font-size:13px; line-height:1.75; color:#0c4a6e; }
    .reg-box strong { display:block; margin-bottom:8px; font-size:13.5px; color:#0369a1; }
    .agree-all-bar { background:var(--gray-50); border:1.5px solid var(--gray-200); border-radius:10px; padding:14px 18px; display:flex; align-items:center; gap:12px; margin-bottom:20px; }
    .agree-all-bar label { font-size:13.5px; font-weight:700; color:var(--gray-800); cursor:pointer; }
    .agree-item { display:flex; align-items:flex-start; gap:12px; padding:14px 18px; border:1.5px solid var(--gray-200); border-radius:10px; cursor:pointer; transition:border-color .2s,background .2s; margin-bottom:12px; }
    .agree-item:hover { border-color:var(--accent); background:var(--accent-light); }
    .agree-item input { accent-color:var(--accent); width:16px; height:16px; margin-top:3px; flex-shrink:0; cursor:pointer; }
    .agree-item-title { font-size:13px; font-weight:700; color:var(--gray-800); margin-bottom:4px; }
    .agree-item-desc { font-size:12px; color:var(--gray-500); line-height:1.6; }

    /* ── FOOTER NAV ── */
    .ftr { display:flex; align-items:center; gap:14px; padding:16px 32px; border-top:1px solid var(--gray-100); background:var(--white); }
    .pr { flex:1; height:5px; background:var(--gray-200); border-radius:10px; overflow:hidden; }
    .pb { height:100%; background:linear-gradient(90deg,var(--accent),#60a5fa); border-radius:10px; transition:width .4s ease; }
    .btn-g { padding:9px 22px; border:1.5px solid var(--gray-300); border-radius:30px; background:var(--white); color:var(--gray-600); font-size:13px; font-weight:600; cursor:pointer; font-family:'Outfit',sans-serif; transition:all .2s; }
    .btn-g:hover:not(:disabled) { border-color:var(--accent); color:var(--accent); }
    .btn-g:disabled { opacity:.4; cursor:not-allowed; }
    .btn-p { padding:9px 24px; border:none; border-radius:30px; background:linear-gradient(110deg,var(--accent),var(--primary-dark)); color:#fff; font-size:13px; font-weight:700; cursor:pointer; font-family:'Outfit',sans-serif; box-shadow:0 2px 10px rgba(37,99,235,.25); transition:all .2s; }
    .btn-p:hover { transform:translateY(-1px); box-shadow:0 5px 18px rgba(37,99,235,.35); }

    /* ── COPYRIGHT FOOTER ── */
    .copy-ftr { background:var(--gray-50); border-top:1px solid var(--gray-100); padding:13px 32px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px; }
    .copy-ftr img { height:15px; opacity:0.4; }
    .copy-ftr .copy-text { font-size:11.5px; color:#94a3b8; }
    .copy-ftr .copy-text strong { color:#64748b; }
    .copy-ftr .copy-links { display:flex; gap:14px; font-size:11px; }
    .copy-ftr .copy-links a { color:#94a3b8; text-decoration:none; transition:color .2s; }
    .copy-ftr .copy-links a:hover { color:var(--accent); }

    /* ── WARNING ── */
    #disclaimerWarning { display:none; margin-top:12px; padding:12px 16px; background:#fef2f2; border:1.5px solid #fecaca; border-radius:8px; font-size:12.5px; color:#dc2626; font-weight:600; }

    @media(max-width:700px){
      .shell{width:99%;}
      .g3,.g4{grid-template-columns:1fr 1fr;}
      .g2{grid-template-columns:1fr;}
      .kra-row{grid-template-columns:1fr 1fr;}
      .kra-row .btn-kra{grid-column:span 2;width:fit-content;}
      .body{padding:16px;}
      .ftr,.copy-ftr{padding:14px 16px;}
      .rq-card{padding:20px;}
    }
    @media(max-width:480px){ .g3,.g4,.g2{grid-template-columns:1fr;} }
  </style>
</head>
<body>
<div class="shell"><div class="card">

  <!-- HEADER -->
  <header class="hdr">
    <div class="hdr-logo"><img src="uploads/TM-logo.png" alt="ValueQuest"/></div>
    <div class="hdr-right">
      <div class="lbl">Welcome <strong style="color:rgba(255,255,255,0.85);">User</strong></div>
      <div class="cnt">Step <span id="si">1</span> of 10</div>
    </div>
  </header>

  <!-- STEPPER -->
  <div class="stp-wrap">
    <button class="stp-scroll" id="sl">&#8592;</button>
    <div class="stp" id="stp">
      <button class="pill active" data-step="1"><span class="n">1</span> Disclaimer</button>
      <button class="pill" data-step="2"><span class="n">2</span> Investment</button>
      <button class="pill" data-step="3"><span class="n">3</span> Holder – Personal</button>
      <button class="pill" data-step="4"><span class="n">4</span> Holder – Financial</button>
      <button class="pill" data-step="5"><span class="n">5</span> Holder – Address</button>
      <button class="pill" data-step="6"><span class="n">6</span> Joint Holders</button>
      <button class="pill" data-step="7"><span class="n">7</span> Nomination</button>
      <button class="pill" data-step="8"><span class="n">8</span> Bank &amp; Demat</button>
      <button class="pill" data-step="9"><span class="n">9</span> Risk Profile</button>
      <button class="pill" data-step="10"><span class="n">10</span> Documents &amp; Review</button>
    </div>
    <button class="stp-scroll" id="sr">&#8594;</button>
  </div>

  <main class="body">
  <form id="frm" novalidate>

  <!-- ══ STEP 1 – DISCLAIMER & AGREEMENT ══ -->
  <section class="sp active" data-step="1">
    <div class="pt">Disclaimer &amp; Agreement</div>
    <div class="ps">Please read the following carefully and provide your consent before proceeding.</div>

    <div class="disc-box">
      <strong>⚠️ Please Read Before Proceeding</strong>
      Portfolio Management Services (PMS) and Alternative Investment Funds (AIF) are investment products regulated by SEBI. Investments in securities are subject to market risks. Past performance is not indicative of future returns. Minimum investment: ₹50 Lakhs (PMS), ₹1 Crore (AIF Category I &amp; II). ValueQuest Investment Advisors Pvt. Ltd. is registered with SEBI as Portfolio Manager (Reg. No. INP000006183). This onboarding form is for KYC and account opening purposes only.
    </div>
    <div class="reg-box">
      <strong>📋 Regulatory Information</strong>
      As per SEBI (Portfolio Managers) Regulations 2020 and SEBI (Alternative Investment Funds) Regulations 2012, the investor is required to submit KYC documents. The Portfolio Manager shall not be liable for losses from market fluctuations. All investments are subject to the Disclosure Document / PPM terms. Investor confirms funds comply with PMLA, 2002.
    </div>

    <div class="agree-all-bar">
      <input type="checkbox" id="agreeAll" style="accent-color:var(--accent);width:17px;height:17px;flex-shrink:0;" onchange="toggleAllAgreements(this)"/>
      <label for="agreeAll">I have read and agree to all declarations, disclaimers and agreements below.</label>
    </div>

    <div class="agree-item" id="ai_terms">
      <input type="checkbox" name="agreeTerms" onchange="checkAllAgreed()"/>
      <div><div class="agree-item-title">Terms &amp; Conditions</div><div class="agree-item-desc">I have read, understood and agree to the Terms &amp; Conditions of ValueQuest Investment Advisors Pvt. Ltd. and the applicable scheme documents including the Disclosure Document / PPM.</div></div>
    </div>
    <div class="agree-item" id="ai_risk">
      <input type="checkbox" name="agreeRisk" onchange="checkAllAgreed()"/>
      <div><div class="agree-item-title">Risk Acknowledgement</div><div class="agree-item-desc">I acknowledge that investments are subject to market risks and there is no assurance of returns. I understand the risk factors and confirm this investment suits my financial profile.</div></div>
    </div>
    <div class="agree-item" id="ai_pmla">
      <input type="checkbox" name="agreePmla" onchange="checkAllAgreed()"/>
      <div><div class="agree-item-title">PMLA &amp; Source of Funds Declaration</div><div class="agree-item-desc">I declare that the funds being invested are from legitimate sources. I confirm compliance with PMLA, 2002 and agree to provide additional documents required for AML/KYC verification.</div></div>
    </div>
    <div class="agree-item" id="ai_privacy">
      <input type="checkbox" name="agreePrivacy" onchange="checkAllAgreed()"/>
      <div><div class="agree-item-title">Privacy Policy &amp; Data Consent</div><div class="agree-item-desc">I consent to collection, storage and processing of my personal data for KYC, regulatory compliance and communication. I authorize ValueQuest to fetch my KYC data from KRA/CKYC registries.</div></div>
    </div>
    <div class="agree-item" id="ai_pms">
      <input type="checkbox" name="agreePms" onchange="checkAllAgreed()"/>
      <div><div class="agree-item-title">PMS / AIF Client Agreement</div><div class="agree-item-desc">I agree to execute the Portfolio Management Agreement / Subscription Agreement and authorize ValueQuest to manage my portfolio per the agreed strategy, fee structure and discretionary powers.</div></div>
    </div>
    <div id="disclaimerWarning">⚠️ Please accept all agreements before proceeding.</div>
  </section>

  <!-- ══ STEP 2 – INVESTMENT DETAILS ══ -->
  <section class="sp" data-step="2">
    <div class="pt">Investment Details</div>
    <div class="ps">Select product, fund, amount and account configuration.</div>

    <div class="g3">
      <div class="fg"><label class="lbl">Product <span class="req">*</span></label>
        <select class="fs" name="product"><option value="">Select product</option><option>PMS</option><option>AIF</option><option>International</option></select></div>
      <div class="fg"><label class="lbl">Fund Name <span class="req">*</span></label>
        <select class="fs" name="fundName"><option value="">Select fund</option><option>Consistent Compounders PMS</option><option>Little Champs PMS</option><option>Kings of Capital PMS</option><option>Special Situations Fund</option></select></div>
      <div class="fg"><label class="lbl">Class Type <span class="req">*</span></label>
        <select class="fs" name="classType"><option value="">Select class</option><option>Class A</option><option>Class B</option><option>Class C</option></select></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">Commitment Amount (₹) <span class="req">*</span></label>
        <input type="number" class="fc" name="commitmentAmount" placeholder="Enter amount in numbers" min="0" oninput="numToWords(this)"/></div>
      <div class="fg s2"><label class="lbl">Commitment Amount (in Words) <span class="ba">Auto</span></label>
        <input type="text" class="fc" name="commitmentAmountWords" id="commitmentAmountWords" placeholder="Auto-filled when you enter amount above" readonly/></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">Management Fees <span class="ba">Auto</span></label>
        <input type="text" class="fc" name="managementFees" placeholder="Auto from fund master" readonly/></div>
      <div class="fg"><label class="lbl">Fee Type <span class="ba">Auto</span></label>
        <select class="fs" name="feeType"><option value="">Auto from fund master</option><option>Fixed</option><option>Hybrid</option><option>Only Performance</option></select></div>
      <div class="fg"><label class="lbl">Investment Type <span class="ba">Auto</span></label>
        <select class="fs" name="investmentType"><option value="">Auto from fund master</option><option>Lumpsum</option><option>Drawdown</option><option>STP</option></select></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">Account Category <span class="req">*</span></label>
        <select class="fs" name="accountCategory"><option value="">Select category</option><option>Resident Individual (Single)</option><option>Resident Individual (Joint)</option><option>Non-Resident Indian (NRI)</option><option>HUF</option><option>Company / LLP</option><option>Trust</option><option>Other</option></select></div>
      <div class="fg"><label class="lbl">No. of Account Holders <span class="req">*</span></label>
        <select class="fs" name="numHolders"><option value="">Select</option><option value="1">1 – Sole Holder</option><option value="2">2 – Two Holders</option><option value="3">3 – Three Holders</option></select></div>
    </div>
  </section>

  <!-- ══ STEP 3 – HOLDER: PERSONAL ══ -->
  <section class="sp" data-step="3">
    <div class="pt">Holder Details — Personal</div>
    <div class="ps">Enter PAN &amp; DOB then click Fetch KRA. Complete any missing fields manually.</div>
    <div class="ht"><span class="hbadge">H1</span> First / Sole Account Holder</div>

    <div class="sub">PAN &amp; KRA Verification</div>
    <div class="kra-row">
      <div class="fg"><label class="lbl">PAN Number <span class="req">*</span></label>
        <input type="text" class="fc" name="h1Pan" placeholder="e.g. ABCDE1234F" maxlength="10" style="text-transform:uppercase"/></div>
      <div class="fg"><label class="lbl">Date of Birth <span class="req">*</span></label>
        <input type="date" class="fc" name="h1Dob"/></div>
      <button type="button" class="btn-kra" onclick="kra('h1')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>Fetch KRA
      </button>
    </div>

    <div class="sub">Identity</div>
    <div class="g4">
      <div class="fg"><label class="lbl">Salutation <span class="req">*</span></label>
        <select class="fs" name="h1Salutation"><option value="">Select</option><option>Mr.</option><option>Ms.</option><option>Mrs.</option><option>M/s</option></select></div>
      <div class="fg"><label class="lbl">First Name <span class="req">*</span></label>
        <input type="text" class="fc" name="h1FirstName" placeholder="KRA Fetch"/></div>
      <div class="fg"><label class="lbl">Middle Name <span class="bo">Optional</span></label>
        <input type="text" class="fc" name="h1MiddleName" placeholder="KRA Fetch"/></div>
      <div class="fg"><label class="lbl">Last Name <span class="req">*</span></label>
        <input type="text" class="fc" name="h1LastName" placeholder="KRA Fetch"/></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">Father / Spouse Name <span class="req">*</span></label>
        <input type="text" class="fc" name="h1FatherSpouseName" placeholder="KRA Fetch"/></div>
      <div class="fg"><label class="lbl">Mother Name <span class="req">*</span></label>
        <input type="text" class="fc" name="h1MotherName" placeholder="Enter mother's name"/></div>
      <div class="fg"><label class="lbl">Place of Birth <span class="req">*</span></label>
        <input type="text" class="fc" name="h1PlaceBirth" placeholder="City / Town"/></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">Country of Birth <span class="req">*</span></label>
        <select class="fs" name="h1CountryBirth">
          <option value="">Select country</option>
          <option>India</option><option>USA</option><option>UK</option><option>UAE</option>
          <option>Singapore</option><option>Canada</option><option>Australia</option>
          <option>Germany</option><option>France</option><option>Japan</option><option>Other</option>
        </select></div>
      <div class="fg"><label class="lbl">Gender <span class="req">*</span></label>
        <select class="fs" name="h1Gender"><option value="">Select</option><option>Male</option><option>Female</option><option>Others</option></select></div>
      <div class="fg"><label class="lbl">Marital Status <span class="req">*</span></label>
        <select class="fs" name="h1MaritalStatus"><option value="">Select</option><option>Married</option><option>Unmarried</option><option>Others</option></select></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">Nationality <span class="req">*</span></label>
        <select class="fs" name="h1Nationality"><option value="">Select</option><option>Indian</option><option>NRI</option><option>Other</option></select></div>
      <div class="fg"><label class="lbl">Residential Status <span class="req">*</span></label>
        <select class="fs" name="h1ResidentialStatus" onchange="updateMobilePrefix('h1',this.value)">
          <option value="">Select</option>
          <option value="Resident Indian">Resident Indian</option>
          <option value="Non-Resident Indian">Non-Resident Indian</option>
          <option value="Foreign National">Foreign National</option>
        </select></div>
      <div class="fg"><label class="lbl">Tax Resident <span class="req">*</span></label>
        <input type="text" class="fc" name="h1TaxResident" placeholder="Country of tax residency"/></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">US Person <span class="req">*</span></label>
        <select class="fs" name="h1UsPerson"><option value="">Select</option><option>Yes</option><option>No</option></select></div>
      <div class="fg"><label class="lbl">Politically Exposed Person (PEP) Status <span class="req">*</span></label>
        <select class="fs" name="h1PepStatus">
          <option value="">Select PEP status</option>
          <option value="PEP">PEP — Politically Exposed Person</option>
          <option value="RPEP">RPEP — Related to Politically Exposed Person</option>
          <option value="Not Applicable">Not Applicable</option>
        </select></div>
      <div class="fg"><label class="lbl">CKYC Number <span class="req">*</span></label>
        <input type="text" class="fc" name="h1Ckyc" placeholder="Max 19 digits" maxlength="19"/></div>
    </div>

    <div class="sub">Contact</div>
    <div class="g3">
      <div class="fg"><label class="lbl">KRA Mobile No. <span class="ba">Auto</span></label>
        <div class="ig"><span class="pfx" id="h1MobilePrefix">+91</span><input type="tel" class="fc" name="h1KraMobile" placeholder="KRA Fetch" readonly/></div></div>
      <div class="fg"><label class="lbl">Mobile Belongs To <span class="req">*</span></label>
        <select class="fs" name="h1MobileBelongs"><option value="">Select</option><option>Me</option><option>Spouse</option><option>Dependent Parents</option></select></div>
      <div class="fg"><label class="lbl">WhatsApp Consent <span class="req">*</span></label>
        <select class="fs" name="h1WhatsappConsent"><option value="">Select</option><option>Yes</option><option>No</option></select></div>
    </div>
    <div class="g3">
      <div class="fg"><label class="lbl">Email Id <span class="ba">Auto</span></label>
        <input type="email" class="fc" name="h1Email" placeholder="KRA Fetch" readonly/></div>
      <div class="fg"><label class="lbl">Email Belongs To <span class="req">*</span></label>
        <select class="fs" name="h1EmailBelongs"><option value="">Select</option><option>Me</option><option>Spouse</option><option>Dependent Parents</option></select></div>
      <div class="fg"><label class="lbl">KRA Status <span class="ba">Auto</span></label>
        <input type="text" class="fc" name="h1KraStatus" placeholder="KRA Fetch" readonly/></div>
    </div>

    <div class="sub">OVD – Identity Proof</div>
    <div class="g3">
      <div class="fg"><label class="lbl">OVD Proof Type <span class="req">*</span></label>
        <select class="fs" name="h1OvdType"><option value="">Select document</option><option>Aadhaar Card</option><option>Passport Copy</option><option>Voter Id Card</option><option>Driving License</option><option>NREGA Job Card</option></select></div>
      <div class="fg"><label class="lbl">OVD Proof No. <span class="req">*</span></label>
        <input type="text" class="fc" name="h1OvdNo" placeholder="Document number"/></div>
      <div class="fg"><label class="lbl">OVD Expiry Date <span class="req">*</span></label>
        <input type="date" class="fc" name="h1OvdExpiry"/></div>
    </div>

    <!-- LIVE PHOTO SECTION -->
    <div class="sub">Live Photograph Capture</div>
    <div class="ps" style="margin-bottom:16px;">Allow camera access to capture 2 live photographs of the account holder.</div>
    <div class="g2" style="max-width:600px;">
      <div class="fg">
        <label class="lbl">Photo 1 — Front Face <span class="req">*</span></label>
        <div class="cam-box" id="camBox1">
          <div class="cam-placeholder" id="camPh1"><span>📷</span><p>Camera not started</p></div>
          <video id="camVid1" autoplay playsinline style="display:none;"></video>
          <canvas id="camCanvas1" style="display:none;"></canvas>
          <img id="camSnap1" class="snap" style="display:none;" alt="Photo 1"/>
          <span class="snap-done" id="snapDone1" style="display:none;">✓ Captured</span>
          <div class="cam-overlay" id="camOverlay1" style="display:none;">
            <button type="button" class="btn-cam" onclick="capturePhoto(1)">📸 Capture</button>
            <button type="button" class="btn-cam red" onclick="stopCamera(1)">✕ Stop</button>
          </div>
        </div>
        <input type="hidden" name="photoH1_data" id="photoH1_data"/>
        <button type="button" class="btn-tgl" style="margin-top:8px;width:100%;justify-content:center;display:flex;" onclick="startCamera(1)">Start Camera</button>
      </div>
      <div class="fg">
        <label class="lbl">Photo 2 — Side / Blink Check <span class="req">*</span></label>
        <div class="cam-box" id="camBox2">
          <div class="cam-placeholder" id="camPh2"><span>📷</span><p>Camera not started</p></div>
          <video id="camVid2" autoplay playsinline style="display:none;"></video>
          <canvas id="camCanvas2" style="display:none;"></canvas>
          <img id="camSnap2" class="snap" style="display:none;" alt="Photo 2"/>
          <span class="snap-done" id="snapDone2" style="display:none;">✓ Captured</span>
          <div class="cam-overlay" id="camOverlay2" style="display:none;">
            <button type="button" class="btn-cam" onclick="capturePhoto(2)">📸 Capture</button>
            <button type="button" class="btn-cam red" onclick="stopCamera(2)">✕ Stop</button>
          </div>
        </div>
        <input type="hidden" name="photoH2_data" id="photoH2_data"/>
        <button type="button" class="btn-tgl" style="margin-top:8px;width:100%;justify-content:center;display:flex;" onclick="startCamera(2)">Start Camera</button>
      </div>
    </div>
  </section>

  <!-- ══ STEP 4 – HOLDER: FINANCIAL ══ -->
  <section class="sp" data-step="4">
    <div class="pt">Holder Details — Financial &amp; Professional</div>
    <div class="ps">Provide financial profile, occupation and income details.</div>

    <div class="sub">Professional Details</div>
    <div class="g3">
      <div class="fg"><label class="lbl">Occupation <span class="req">*</span></label>
        <select class="fs" name="h1Occupation" onchange="toggleProfType(this)">
          <option value="">Select</option>
          <option>Private Sector Service</option><option>Public Sector Service</option>
          <option>Government Service</option><option>Business / Self Employed</option>
          <option>Professional</option><option>Agriculturist</option>
          <option>Retired</option><option>Housewife</option><option>Student</option>
          <option>Others please specify</option>
        </select></div>
      <div class="fg" id="profTypeWrap" style="display:none;"><label class="lbl">Profession Type <span class="req">*</span></label>
        <select class="fs" name="h1Professional">
          <option value="">Select profession</option>
          <option>Advocate / Lawyer</option><option>Chartered Accountant</option>
          <option>Company Secretary</option><option>Cost Accountant</option>
          <option>Doctor / Medical Professional</option><option>Engineer</option>
          <option>Architect</option><option>Consultant</option>
          <option>Financial Advisor / Planner</option><option>IT Professional</option>
          <option>Journalist / Media</option><option>Professor / Teacher</option>
          <option>Scientist / Researcher</option><option>Self Employed</option>
          <option>Other please specify</option>
        </select></div>
      <div class="fg"><label class="lbl">Education <span class="req">*</span></label>
        <input type="text" class="fc" name="h1Education" placeholder="Highest qualification"/></div>
    </div>

    <div class="g3">
      <div class="fg"><label class="lbl">Source of Fund <span class="req">*</span></label>
        <select class="fs" name="h1SourceFund"><option value="">Select</option><option>Savings</option><option>Business Income</option><option>Salary / Employment</option><option>Ancestral / Inheritance</option><option>Gift</option><option>Sale of Property</option><option>Rental Income</option><option>Dividend Income</option><option>Others please specify</option></select></div>
      <div class="fg"><label class="lbl">Trading / Dealing Exp. <span class="req">*</span></label>
        <select class="fs" name="h1TradingExp"><option value="">Select</option><option>Less than 1 Year</option><option>1 Year</option><option>2 Years</option><option>3 Years</option><option>4 Years</option><option>5 Years</option><option>More than 5 Years</option></select></div>
      <div class="fg"><label class="lbl">Brief Details <span class="req">*</span></label>
        <input type="text" class="fc" name="h1BriefDetails" placeholder="Brief description of work/business"/></div>
    </div>

    <div class="sub">Financial Information</div>
    <div class="g3">
      <div class="fg"><label class="lbl">Annual Income <span class="req">*</span></label>
        <select class="fs" name="h1AnnualIncome">
          <option value="">Select range</option>
          <option>Below ₹1 Lac</option><option>₹1–5 Lacs</option>
          <option>₹5–10 Lacs</option><option>₹10–25 Lacs</option>
          <option>₹25–50 Lacs</option><option>₹50–75 Lacs</option>
          <option>₹75 Lacs–1 Crore</option><option>Above ₹1 Crore</option>
        </select></div>
      <div class="fg"><label class="lbl">Net Worth (₹) <span class="req">*</span></label>
        <input type="number" class="fc" name="h1NetWorth" placeholder="Enter net worth in ₹"/></div>
      <div class="fg"><label class="lbl">Net Worth Date <span class="req">*</span></label>
        <input type="date" class="fc" name="h1NetWorthDate"/></div>
    </div>
  </section>

  <!-- ══ STEP 5 – HOLDER: ADDRESS ══ -->
  <section class="sp" data-step="5">
    <div class="pt">Holder Details — Address</div>
    <div class="ps">Correspondence and permanent address details.</div>

    <div class="sub">Correspondence Address</div>
    <div class="g3">
      <div class="fg"><label class="lbl">Address Type <span class="bo">Optional</span></label>
        <input type="text" class="fc" name="h1CorAddressType" placeholder="e.g. Residence / Office"/></div>
      <div class="fg"><label class="lbl">Address Line 1 <span class="req">*</span></label>
        <input type="text" class="fc" name="h1CorAddr1" placeholder="KRA Fetch"/></div>
      <div class="fg"><label class="lbl">Address Line 2 <span class="req">*</span></label>
        <input type="text" class="fc" name="h1CorAddr2" placeholder="KRA Fetch"/></div>
    </div>
    <div class="g3">
      <div class="fg"><label class="lbl">Address Line 3</label>
        <input type="text" class="fc" name="h1CorAddr3" placeholder="KRA Fetch"/></div>
      <div class="fg"><label class="lbl">City / Town / Village <span class="req">*</span></label>
        <input type="text" class="fc" name="h1CorCity" placeholder="KRA Fetch"/></div>
      <div class="fg"><label class="lbl">District <span class="req">*</span></label>
        <input type="text" class="fc" name="h1CorDistrict" placeholder="KRA Fetch"/></div>
    </div>
    <div class="g3">
      <div class="fg"><label class="lbl">PIN Code <span class="req">*</span></label>
        <input type="text" class="fc" name="h1CorPin" placeholder="6-digit PIN" maxlength="6"/></div>
      <div class="fg"><label class="lbl">State / U.T <span class="ba">Auto</span></label>
        <select class="fs" name="h1CorState"><option value="">Auto-populate</option><option>Andaman and Nicobar Islands</option><option>Andhra Pradesh</option><option>Arunachal Pradesh</option><option>Assam</option><option>Bihar</option><option>Chandigarh</option><option>Chhattisgarh</option><option>Dadra and Nagar Haveli</option><option>Daman and Diu</option><option>Delhi</option><option>Goa</option><option>Gujarat</option><option>Haryana</option><option>Himachal Pradesh</option><option>Jammu and Kashmir</option><option>Jharkhand</option><option>Karnataka</option><option>Kerala</option><option>Ladakh</option><option>Lakshadweep</option><option>Madhya Pradesh</option><option>Maharashtra</option><option>Manipur</option><option>Meghalaya</option><option>Mizoram</option><option>Nagaland</option><option>Odisha</option><option>Puducherry</option><option>Punjab</option><option>Rajasthan</option><option>Sikkim</option><option>Tamil Nadu</option><option>Telangana</option><option>Tripura</option><option>Uttar Pradesh</option><option>Uttarakhand</option><option>West Bengal</option></select></div>
      <div class="fg"><label class="lbl">Country <span class="ba">Auto</span></label>
        <select class="fs" name="h1CorCountry"><option value="">Auto-populate</option><option>India</option><option>USA</option><option>UK</option><option>UAE</option><option>Singapore</option><option>Canada</option><option>Australia</option></select></div>
    </div>

    <div class="sub">Permanent Address <span class="bo" style="text-transform:none;letter-spacing:0;">Optional</span></div>
    <div style="margin-bottom:14px;">
      <label class="ri"><input type="checkbox" name="h1CorSameAsPerm" onchange="copyAddr(this)"/> Same as Correspondence Address</label>
    </div>
    <div class="g3">
      <div class="fg"><label class="lbl">Address Line 1</label><input type="text" class="fc" name="h1PerAddr1" placeholder="Enter permanent address"/></div>
      <div class="fg"><label class="lbl">Address Line 2</label><input type="text" class="fc" name="h1PerAddr2"/></div>
      <div class="fg"><label class="lbl">City / Town</label><input type="text" class="fc" name="h1PerCity"/></div>
    </div>
    <div class="g3">
      <div class="fg"><label class="lbl">District</label><input type="text" class="fc" name="h1PerDistrict"/></div>
      <div class="fg"><label class="lbl">PIN Code</label><input type="text" class="fc" name="h1PerPin" placeholder="6-digit PIN" maxlength="6"/></div>
      <div class="fg"><label class="lbl">State / U.T</label>
        <select class="fs" name="h1PerState"><option value="">Select state</option><option>Maharashtra</option><option>Delhi</option><option>Karnataka</option><option>Gujarat</option><option>Tamil Nadu</option><option>Rajasthan</option><option>Andhra Pradesh</option><option>Telangana</option><option>West Bengal</option><option>Uttar Pradesh</option></select></div>
    </div>

    <div class="sub">NRI Details <span class="bo" style="text-transform:none;letter-spacing:0;">Only for NRI</span></div>
    <div class="g3">
      <div class="fg"><label class="lbl">Date of Becoming NRI</label><input type="date" class="fc" name="h1NriDate"/></div>
      <div class="fg"><label class="lbl">Country (NRI)</label>
        <select class="fs" name="h1NriCountry"><option value="">Select country</option><option>USA</option><option>UK</option><option>UAE</option><option>Singapore</option><option>Canada</option><option>Australia</option><option>Germany</option><option>Other</option></select></div>
      <div class="fg"><label class="lbl">TIN No.</label><input type="text" class="fc" name="h1TinNo" placeholder="Tax Identification Number"/></div>
    </div>
  </section>

  <!-- ══ STEP 6 – JOINT HOLDERS ══ -->
  <section class="sp" data-step="6">
    <div class="pt">Joint Holder Details</div>
    <div class="ps">Add up to 2 additional joint holders. Click the button to expand each holder's form.</div>

    <div class="jht">
      <span>👤 Joint Holder 2</span>
      <button type="button" class="btn-tgl" id="tJH2" onclick="toggleJH(2)">+ Add Joint Holder 2</button>
    </div>
    <div id="jh2" style="display:none;">
      <div class="ht"><span class="hbadge jh">H2</span> Joint Holder 2</div>
      <div class="sub">PAN &amp; KRA Verification</div>
      <div class="kra-row">
        <div class="fg"><label class="lbl">PAN Number <span class="req">*</span></label>
          <input type="text" class="fc" name="h2Pan" placeholder="e.g. ABCDE1234F" maxlength="10" style="text-transform:uppercase"/></div>
        <div class="fg"><label class="lbl">Date of Birth <span class="req">*</span></label>
          <input type="date" class="fc" name="h2Dob"/></div>
        <button type="button" class="btn-kra" onclick="kra('h2')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>Fetch KRA
        </button>
      </div>
      <div class="g3">
        <div class="fg"><label class="lbl">Relationship with H1 <span class="req">*</span></label>
          <select class="fs" name="h2Relation"><option value="">Select</option><option>Spouse</option><option>Parent</option><option>Sibling</option><option>Child</option><option>Other</option></select></div>
        <div class="fg"><label class="lbl">Salutation</label>
          <select class="fs" name="h2Salutation"><option value="">Select</option><option>Mr.</option><option>Ms.</option><option>Mrs.</option><option>M/s</option></select></div>
        <div class="fg"><label class="lbl">First Name <span class="req">*</span></label>
          <input type="text" class="fc" name="h2FirstName" placeholder="KRA Fetch"/></div>
      </div>
      <div class="g3">
        <div class="fg"><label class="lbl">Middle Name <span class="bo">Optional</span></label>
          <input type="text" class="fc" name="h2MiddleName"/></div>
        <div class="fg"><label class="lbl">Last Name <span class="req">*</span></label>
          <input type="text" class="fc" name="h2LastName"/></div>
        <div class="fg"><label class="lbl">Gender</label>
          <select class="fs" name="h2Gender"><option value="">Select</option><option>Male</option><option>Female</option><option>Others</option></select></div>
      </div>
      <div class="g3">
        <div class="fg"><label class="lbl">Politically Exposed Person (PEP) Status</label>
          <select class="fs" name="h2PepStatus"><option value="">Select</option><option value="PEP">PEP — Politically Exposed Person</option><option value="RPEP">RPEP — Related to PEP</option><option value="Not Applicable">Not Applicable</option></select></div>
        <div class="fg"><label class="lbl">KRA Status <span class="ba">Auto</span></label>
          <input type="text" class="fc" name="h2KraStatus" readonly/></div>
        <div class="fg"><label class="lbl">Email Id <span class="ba">Auto</span></label>
          <input type="email" class="fc" name="h2Email" readonly/></div>
      </div>
    </div>

    <div class="jht" style="margin-top:8px;">
      <span>👤 Joint Holder 3</span>
      <button type="button" class="btn-tgl" id="tJH3" onclick="toggleJH(3)">+ Add Joint Holder 3</button>
    </div>
    <div id="jh3" style="display:none;">
      <div class="ht"><span class="hbadge jh">H3</span> Joint Holder 3</div>
      <div class="kra-row">
        <div class="fg"><label class="lbl">PAN Number <span class="req">*</span></label>
          <input type="text" class="fc" name="h3Pan" placeholder="e.g. ABCDE1234F" maxlength="10" style="text-transform:uppercase"/></div>
        <div class="fg"><label class="lbl">Date of Birth <span class="req">*</span></label>
          <input type="date" class="fc" name="h3Dob"/></div>
        <button type="button" class="btn-kra" onclick="kra('h3')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>Fetch KRA
        </button>
      </div>
      <div class="g3">
        <div class="fg"><label class="lbl">Relationship with H1 <span class="req">*</span></label>
          <select class="fs" name="h3Relation"><option value="">Select</option><option>Spouse</option><option>Parent</option><option>Sibling</option><option>Child</option><option>Other</option></select></div>
        <div class="fg"><label class="lbl">First Name <span class="req">*</span></label>
          <input type="text" class="fc" name="h3FirstName"/></div>
        <div class="fg"><label class="lbl">Last Name <span class="req">*</span></label>
          <input type="text" class="fc" name="h3LastName"/></div>
      </div>
    </div>
  </section>

  <!-- ══ STEP 7 – NOMINATION ══ -->
  <section class="sp" data-step="7">
    <div class="pt">Nomination Details</div>
    <div class="ps">Add nominee(s) to receive benefits. You may opt-out of nomination.</div>

    <div style="margin-bottom:18px;">
      <label class="lbl" style="margin-bottom:8px;">Nomination Option <span class="req">*</span></label>
      <div class="rg">
        <label class="ri"><input type="radio" name="nominationOpt" value="optin" checked onchange="toggleNomination(this)"/> Opt-In (Add Nominee)</label>
        <label class="ri"><input type="radio" name="nominationOpt" value="optout" onchange="toggleNomination(this)"/> Opt-Out (No Nominee)</label>
      </div>
    </div>

    <div id="nc">
      <div class="ns">
        <div class="nh"><div class="nt">Nominee 1</div></div>
        <div class="g3">
          <div class="fg"><label class="lbl">Nominee Name</label><input type="text" class="fc" name="nom1Name" placeholder="Full name"/></div>
          <div class="fg"><label class="lbl">Relationship with H1</label>
            <select class="fs" name="nom1Relation"><option value="">Select</option><option>Mother</option><option>Father</option><option>Daughter</option><option>Son</option><option>Sister</option><option>Brother</option><option>Spouse</option><option>Other please specify</option></select></div>
          <div class="fg"><label class="lbl">Share (%)</label><input type="number" class="fc" name="nom1Share" placeholder="e.g. 100" min="0" max="100"/></div>
        </div>
        <div class="g3">
          <div class="fg"><label class="lbl">Date of Birth</label><input type="date" class="fc" name="nom1Dob"/></div>
          <div class="fg"><label class="lbl">Mobile No.</label><input type="tel" class="fc" name="nom1Mobile" placeholder="10-digit number" maxlength="10"/><span class="hint">Should not belong to account holder</span></div>
          <div class="fg"><label class="lbl">Email ID</label><input type="email" class="fc" name="nom1Email" placeholder="nominee@email.com"/></div>
        </div>
        <div class="g2">
          <div class="fg"><label class="lbl">Address</label><input type="text" class="fc" name="nom1Address" placeholder="Full address"/></div>
          <div class="fg"><label class="lbl">ID Proof Type</label>
            <select class="fs" name="nom1IdType"><option value="">Select</option><option>PAN</option><option>Aadhaar</option><option>Passport</option><option>Birth Certificate</option><option>Others</option></select></div>
        </div>
        <div class="sub">Guardian Details <span class="bo" style="text-transform:none;letter-spacing:0;">If Nominee is Minor</span></div>
        <div class="g3">
          <div class="fg"><label class="lbl">Guardian Name</label><input type="text" class="fc" name="nom1GName" placeholder="Guardian full name"/></div>
          <div class="fg"><label class="lbl">Relationship with Nominee</label>
            <select class="fs" name="nom1GRel"><option value="">Select</option><option>Mother</option><option>Father</option><option>Other</option></select></div>
          <div class="fg"><label class="lbl">Guardian ID Proof</label>
            <select class="fs" name="nom1GIdType"><option value="">Select</option><option>PAN</option><option>Aadhaar</option><option>Passport</option></select></div>
        </div>
        <div class="g3">
          <div class="fg"><label class="lbl">Guardian ID Proof No.</label><input type="text" class="fc" name="nom1GIdNo" placeholder="Document number"/></div>
          <div class="fg"><label class="lbl">Guardian Mobile</label><input type="tel" class="fc" name="nom1GMobile" placeholder="10-digit number" maxlength="10"/></div>
          <div class="fg"><label class="lbl">Guardian Email</label><input type="email" class="fc" name="nom1GEmail" placeholder="guardian@email.com"/></div>
        </div>
      </div>
    </div>
    <button type="button" class="btn-tgl" onclick="addNom()" id="btnAddNom" style="margin-top:6px;">+ Add Nominee (up to 2 more)</button>
  </section>

  <!-- ══ STEP 8 – BANK & DEMAT ══ -->
  <section class="sp" data-step="8">
    <div class="pt">Bank &amp; Demat Details</div>
    <div class="ps">Enter bank account for payouts and demat account details.</div>

    <div class="sub">Bank Account</div>
    <div class="g3">
      <div class="fg"><label class="lbl">Bank Name <span class="req">*</span></label>
        <select class="fs" name="bankName"><option value="">Select bank</option><option>HDFC Bank</option><option>ICICI Bank</option><option>State Bank of India (SBI)</option><option>Axis Bank</option><option>Kotak Mahindra Bank</option><option>Yes Bank</option><option>IndusInd Bank</option><option>Punjab National Bank</option><option>Bank of Baroda</option><option>Canara Bank</option></select></div>
      <div class="fg"><label class="lbl">Account Number <span class="req">*</span></label>
        <input type="text" class="fc" name="bankAccNo" placeholder="Bank account number"/></div>
      <div class="fg"><label class="lbl">IFSC Code <span class="req">*</span></label>
        <input type="text" class="fc" name="bankIfsc" placeholder="e.g. HDFC0001234" style="text-transform:uppercase"/></div>
    </div>
    <div class="g3">
      <div class="fg"><label class="lbl">MICR Code <span class="req">*</span></label>
        <input type="text" class="fc" name="bankMicr" placeholder="9-digit MICR code" maxlength="9"/></div>
      <div class="fg"><label class="lbl">Account Type <span class="req">*</span></label>
        <select class="fs" name="bankAccType"><option value="">Select type</option><option>Saving</option><option>Current</option><option>NRE</option><option>NRO</option></select></div>
      <div class="fg"><label class="lbl">Default Account <span class="req">*</span></label>
        <select class="fs" name="bankDefault"><option value="">Select</option><option>Yes</option><option>No</option></select></div>
    </div>

    <div class="sub">Demat Account</div>
    <div class="g3">
      <div class="fg"><label class="lbl">Demat Type <span class="req">*</span></label>
        <select class="fs" name="dematType"><option value="">Select</option><option>CDSL</option><option>NSDL</option></select></div>
      <div class="fg"><label class="lbl">DP Name <span class="req">*</span></label>
        <select class="fs" name="dpName"><option value="">Select DP</option><option>Zerodha</option><option>Angel One</option><option>Sharekhan</option><option>ICICIdirect</option><option>HDFC Securities</option><option>Motilal Oswal</option><option>Kotak Securities</option></select></div>
      <div class="fg"><label class="lbl">DP ID <span class="req">*</span></label>
        <input type="text" class="fc" name="dpId" placeholder="Depository Participant ID"/></div>
    </div>
  </section>

  <!-- ══ STEP 9 – RISK PROFILE (WIZARD) ══ -->
  <section class="sp" data-step="9">
    <div class="pt">Risk Profile Questionnaire</div>
    <div class="ps">Mandatory regulatory declarations. Answer one question at a time.</div>

    <!-- Progress dots -->
    <div class="rq-progress" id="rqProgress" style="max-width:680px;margin:0 auto 24px;"></div>

    <!-- Q1 -->
    <div class="rq-step active" id="rq1">
      <div class="rq-card">
        <div class="rq-num">Question 1 of 6</div>
        <div class="rq-q">Are you a Qualified Institutional Buyer (QIB), Qualified Buyer (QB), or an entity regulated by RBI?</div>
        <div class="rq-options">
          <label class="rq-opt" onclick="selectRQ(this,'isQib','Not Applicable',false)">
            <input type="radio" name="isQib" value="Not Applicable"/> Not Applicable — I am a regular investor
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'isQib','QIB',true,'qibSpec')">
            <input type="radio" name="isQib" value="QIB"/> Yes — I am a Qualified Institutional Buyer (QIB)
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'isQib','QB',true,'qibSpec')">
            <input type="radio" name="isQib" value="QB"/> Yes — I am a Qualified Buyer (QB)
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'isQib','Regulated by RBI',true,'qibSpec')">
            <input type="radio" name="isQib" value="Regulated by RBI"/> Yes — My entity is regulated by RBI
          </label>
        </div>
        <div class="rq-sub" id="qibSpec">
          <label class="lbl" style="margin-bottom:6px;">Please provide details:</label>
          <input type="text" class="fc" name="qibDetails" placeholder="Specify institution name and registration number"/>
        </div>
        <div class="rq-nav">
          <button type="button" class="btn-g" disabled>← Back</button>
          <button type="button" class="btn-p" onclick="nextRQ(1)">Continue →</button>
        </div>
      </div>
    </div>

    <!-- Q2 -->
    <div class="rq-step" id="rq2">
      <div class="rq-card">
        <div class="rq-num">Question 2 of 6</div>
        <div class="rq-q">Do you hold citizenship or residency in a country that shares a land border with India?</div>
        <p style="font-size:12px;color:var(--gray-500);margin-bottom:16px;">(Countries sharing land border: Pakistan, China, Bangladesh, Nepal, Bhutan, Myanmar, Afghanistan)</p>
        <div class="rq-options">
          <label class="rq-opt" onclick="selectRQ(this,'landBorderCitizen','No',false)">
            <input type="radio" name="landBorderCitizen" value="No"/> No — I do not hold citizenship or residency in any such country
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'landBorderCitizen','Yes',false)">
            <input type="radio" name="landBorderCitizen" value="Yes"/> Yes — I hold citizenship or residency in a land-border country
          </label>
        </div>
        <div class="rq-nav">
          <button type="button" class="btn-g" onclick="prevRQ(2)">← Back</button>
          <button type="button" class="btn-p" onclick="nextRQ(2)">Continue →</button>
        </div>
      </div>
    </div>

    <!-- Q3 -->
    <div class="rq-step" id="rq3">
      <div class="rq-card">
        <div class="rq-num">Question 3 of 6</div>
        <div class="rq-q">Are any of the beneficial owners of your entity citizens of or residing in a land-border country with India?</div>
        <p style="font-size:12px;color:var(--gray-500);margin-bottom:16px;">(As per PMLA Rules 2005, Sub-rule 3, Rule 9)</p>
        <div class="rq-options">
          <label class="rq-opt" onclick="selectRQ(this,'beneficialOwnerBorder','No',false)">
            <input type="radio" name="beneficialOwnerBorder" value="No"/> No — None of the beneficial owners are from land-border countries
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'beneficialOwnerBorder','Yes',false)">
            <input type="radio" name="beneficialOwnerBorder" value="Yes"/> Yes — One or more beneficial owners are from land-border countries
          </label>
        </div>
        <div class="rq-nav">
          <button type="button" class="btn-g" onclick="prevRQ(3)">← Back</button>
          <button type="button" class="btn-p" onclick="nextRQ(3)">Continue →</button>
        </div>
      </div>
    </div>

    <!-- Q4 -->
    <div class="rq-step" id="rq4">
      <div class="rq-card">
        <div class="rq-num">Question 4 of 6</div>
        <div class="rq-q">Are you investing as part of a group of investors who are considered the "same group"?</div>
        <div class="rq-options">
          <label class="rq-opt" onclick="selectRQ(this,'sameGroupInvestor','No',false)">
            <input type="radio" name="sameGroupInvestor" value="No"/> No — I am investing independently
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'sameGroupInvestor','Yes',false)">
            <input type="radio" name="sameGroupInvestor" value="Yes"/> Yes — I am part of a group of investors considered the same group
          </label>
        </div>
        <div class="rq-nav">
          <button type="button" class="btn-g" onclick="prevRQ(4)">← Back</button>
          <button type="button" class="btn-p" onclick="nextRQ(4)">Continue →</button>
        </div>
      </div>
    </div>

    <!-- Q5 -->
    <div class="rq-step" id="rq5">
      <div class="rq-card">
        <div class="rq-num">Question 5 of 6</div>
        <div class="rq-q">Is your entity established, owned, or controlled by a Central / State Government or the government of a foreign country?</div>
        <p style="font-size:12px;color:var(--gray-500);margin-bottom:16px;">(Includes central banks and sovereign wealth funds)</p>
        <div class="rq-options">
          <label class="rq-opt" onclick="selectRQ(this,'govtEntity','No',false)">
            <input type="radio" name="govtEntity" value="No"/> No — My entity is not government-owned or controlled
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'govtEntity','Yes',false)">
            <input type="radio" name="govtEntity" value="Yes"/> Yes — My entity is government-established / owned / controlled
          </label>
        </div>
        <div class="rq-nav">
          <button type="button" class="btn-g" onclick="prevRQ(5)">← Back</button>
          <button type="button" class="btn-p" onclick="nextRQ(5)">Continue →</button>
        </div>
      </div>
    </div>

    <!-- Q6 -->
    <div class="rq-step" id="rq6">
      <div class="rq-card">
        <div class="rq-num">Question 6 of 6</div>
        <div class="rq-q">Is your entity an AIF or a fund set up outside India, or in an International Financial Services Centre (IFSC) in India?</div>
        <div class="rq-options">
          <label class="rq-opt" onclick="selectRQ(this,'aifOrIfsc','No',false)">
            <input type="radio" name="aifOrIfsc" value="No"/> No — My entity is not an AIF or IFSC fund
          </label>
          <label class="rq-opt" onclick="selectRQ(this,'aifOrIfsc','Yes',true,'aifSub')">
            <input type="radio" name="aifOrIfsc" value="Yes"/> Yes — My entity is an AIF or fund set up outside India / in IFSC
          </label>
        </div>
        <div class="rq-sub" id="aifSub">
          <div style="margin-bottom:14px;">
            <label class="lbl" style="margin-bottom:8px;">1(a). Do investor(s) of the same group contribute 50% or more to the corpus, AND are they also QIBs / QBs?</label>
            <div class="rg">
              <label class="ri"><input type="radio" name="aifQ1" value="Yes"/> Yes</label>
              <label class="ri"><input type="radio" name="aifQ1" value="No"/> No</label>
            </div>
          </div>
          <div>
            <label class="lbl" style="margin-bottom:8px;">2(a). Do investor(s) of the same group contribute 25% or more to the corpus, AND are they also regulated by RBI?</label>
            <div class="rg">
              <label class="ri"><input type="radio" name="aifQ2" value="Yes"/> Yes</label>
              <label class="ri"><input type="radio" name="aifQ2" value="No"/> No</label>
            </div>
          </div>
        </div>

        <!-- Confirmation -->
        <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--gray-200);">
          <label class="lbl" style="margin-bottom:8px;">If your answer to Q3, Q4, or Q6 is Yes — Confirmation required? <span class="req">*</span></label>
          <select class="fs" name="confirmationRequired" style="max-width:260px;" onchange="document.getElementById('confirmDetails').style.display=this.value==='Yes'?'block':'none'">
            <option value="">Select</option><option>Yes</option><option>No</option><option>Not Applicable</option>
          </select>
          <div id="confirmDetails" style="display:none;margin-top:10px;">
            <textarea class="fc" name="confirmationDetails" rows="3" placeholder="Provide full names and PAN of such persons / entities"></textarea>
          </div>
        </div>

        <div class="rq-nav">
          <button type="button" class="btn-g" onclick="prevRQ(6)">← Back</button>
          <button type="button" class="btn-p" id="rqFinish" onclick="finishRQ()">✓ Complete Risk Profile</button>
        </div>
      </div>
    </div>

    <div id="rqDone" style="display:none; text-align:center; padding:40px 20px;">
      <div style="font-size:48px;margin-bottom:12px;">✅</div>
      <div style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:700;color:var(--gray-900);margin-bottom:8px;">Risk Profile Completed</div>
      <div style="font-size:13px;color:var(--gray-500);">All 6 regulatory questions answered. You may proceed to the next step.</div>
    </div>
  </section>

  <!-- ══ STEP 10 – DOCUMENTS & REVIEW ══ -->
  <section class="sp" data-step="10">
    <div class="pt">Documents &amp; Review</div>
    <div class="ps">Upload required documents and review your application before final submission.</div>

    <div class="sub">Document Uploads</div>
    <div class="g3">
      <div class="fg"><label class="lbl">PAN Card Copy <span class="req">*</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="docPan" accept="image/*,application/pdf" onchange="upld(this)"/>
          <span class="uzi">📄</span><span class="uzl">Upload PAN Card</span><span class="uzh">PDF / Image</span>
        </div></div>
      <div class="fg"><label class="lbl">Address Proof (OVD) <span class="req">*</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="docAddress" accept="image/*,application/pdf" onchange="upld(this)"/>
          <span class="uzi">📄</span><span class="uzl">Upload Address Proof</span><span class="uzh">PDF / Image</span>
        </div></div>
      <div class="fg"><label class="lbl">Specimen Signature <span class="req">*</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="docSignature" accept="image/*" onchange="upld(this)"/>
          <span class="uzi">✍️</span><span class="uzl">Upload Signature</span><span class="uzh">Horizontal on white paper</span>
        </div></div>
    </div>

    <div class="sub">Application Summary</div>
    <div class="rb">
      <div class="rbt">Investment Details</div>
      <div class="rgd">
        <div><div class="rvl">Product</div><div class="rvv" id="rv_product">—</div></div>
        <div><div class="rvl">Fund Name</div><div class="rvv" id="rv_fundName">—</div></div>
        <div><div class="rvl">Account Category</div><div class="rvv" id="rv_accountCategory">—</div></div>
        <div><div class="rvl">Commitment Amount</div><div class="rvv" id="rv_commitmentAmount">—</div></div>
        <div><div class="rvl">Fee Type</div><div class="rvv" id="rv_feeType">—</div></div>
        <div><div class="rvl">Investment Type</div><div class="rvv" id="rv_investmentType">—</div></div>
      </div>
    </div>
    <div class="rb">
      <div class="rbt">First Holder</div>
      <div class="rgd">
        <div><div class="rvl">PAN</div><div class="rvv" id="rv_h1Pan">—</div></div>
        <div><div class="rvl">Full Name</div><div class="rvv" id="rv_h1Name">—</div></div>
        <div><div class="rvl">Date of Birth</div><div class="rvv" id="rv_h1Dob">—</div></div>
        <div><div class="rvl">Gender</div><div class="rvv" id="rv_h1Gender">—</div></div>
        <div><div class="rvl">Email</div><div class="rvv" id="rv_h1Email">—</div></div>
        <div><div class="rvl">OVD Type</div><div class="rvv" id="rv_h1OvdType">—</div></div>
      </div>
    </div>
    <div class="rb">
      <div class="rbt">Bank &amp; Demat</div>
      <div class="rgd">
        <div><div class="rvl">Bank Name</div><div class="rvv" id="rv_bankName">—</div></div>
        <div><div class="rvl">Account No.</div><div class="rvv" id="rv_bankAccNo">—</div></div>
        <div><div class="rvl">IFSC</div><div class="rvv" id="rv_bankIfsc">—</div></div>
        <div><div class="rvl">Demat Type</div><div class="rvv" id="rv_dematType">—</div></div>
        <div><div class="rvl">DP Name</div><div class="rvv" id="rv_dpName">—</div></div>
      </div>
    </div>
  </section>

  </form>
  </main>

  <!-- FOOTER NAV -->
  <footer class="ftr">
    <button type="button" class="btn-g" id="btnPrev" disabled>&#8592; Previous</button>
    <div class="pr"><div class="pb" id="pb" style="width:10%"></div></div>
    <button type="button" class="btn-p" id="btnNext">Next Step &#8594;</button>
  </footer>

  <!-- COPYRIGHT FOOTER -->
  <div class="copy-ftr">
    <div style="display:flex;align-items:center;gap:10px;">
      <img src="uploads/TM-logo.png" alt="ValueQuest"/>
      <span class="copy-text">&copy; 2026 <strong>TechMagify LLP</strong> &mdash; All rights reserved.</span>
    </div>
    <div class="copy-links">
      <a href="#">Privacy Policy</a>
      <span style="color:var(--gray-300);">·</span>
      <a href="#">Terms of Use</a>
      <span style="color:var(--gray-300);">·</span>
      <a href="#">Support</a>
    </div>
  </div>

</div></div>

<script>
/* ═══════════════════════════════════════════
   NUMBER TO WORDS
═══════════════════════════════════════════ */
function numToWords(input){
  const n = parseInt(input.value);
  const el = document.getElementById('commitmentAmountWords');
  if(!el) return;
  if(isNaN(n)||n<0){ el.value=''; return; }
  const ones=['','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen'];
  const tens=['','','Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety'];
  function h(n){ if(n===0)return''; if(n<20)return ones[n]+' '; if(n<100)return tens[Math.floor(n/10)]+' '+(n%10?ones[n%10]+' ':''); return ones[Math.floor(n/100)]+' Hundred '+(n%100?h(n%100):''); }
  function convert(n){
    if(n===0)return'Zero';
    let s='';
    if(n>=10000000){ s+=h(Math.floor(n/10000000))+'Crore '; n%=10000000; }
    if(n>=100000){ s+=h(Math.floor(n/100000))+'Lakh '; n%=100000; }
    if(n>=1000){ s+=h(Math.floor(n/1000))+'Thousand '; n%=1000; }
    s+=h(n);
    return s.trim()+' Only';
  }
  el.value = convert(parseInt(input.value)||0);
}

/* ═══════════════════════════════════════════
   SESSION STATE PERSISTENCE
═══════════════════════════════════════════ */
const STATE_KEY = 'vq_onboard_state';
function saveState(){
  try {
    const data = { step: cur };
    const fields = document.querySelectorAll('[name]');
    fields.forEach(f=>{
      if(f.type==='radio'||f.type==='checkbox'){ if(f.checked) data[f.name]=f.value; }
      else if(f.type!=='file') data[f.name]=f.value;
    });
    sessionStorage.setItem(STATE_KEY, JSON.stringify(data));
  } catch(e){}
}
function loadState(){
  try {
    const raw = sessionStorage.getItem(STATE_KEY);
    if(!raw) return 1;
    const data = JSON.parse(raw);
    Object.entries(data).forEach(([k,v])=>{
      if(k==='step') return;
      const els = document.querySelectorAll(`[name="${k}"]`);
      els.forEach(el=>{
        if(el.type==='radio'){ if(el.value===v) el.checked=true; }
        else if(el.type==='checkbox'){ el.checked=(v===el.value||v==='on'); }
        else el.value=v;
      });
    });
    return data.step || 1;
  } catch(e){ return 1; }
}

/* ═══════════════════════════════════════════
   DISCLAIMER CHECKBOXES
═══════════════════════════════════════════ */
const agreementFields = ['agreeTerms','agreeRisk','agreePmla','agreePrivacy','agreePms'];
function checkAllAgreed(){
  const allChecked = agreementFields.every(n => document.querySelector(`[name="${n}"]`)?.checked);
  document.getElementById('agreeAll').checked = allChecked;
  document.getElementById('disclaimerWarning').style.display = 'none';
  agreementFields.forEach(n => {
    const cb = document.querySelector(`[name="${n}"]`);
    if(cb){ const item=cb.closest('.agree-item'); if(item) item.style.borderColor = cb.checked?'var(--accent)':'var(--gray-200)'; }
  });
}
function toggleAllAgreements(masterCb){
  agreementFields.forEach(n => {
    const cb = document.querySelector(`[name="${n}"]`);
    if(cb){ cb.checked=masterCb.checked; const item=cb.closest('.agree-item'); if(item) item.style.borderColor=masterCb.checked?'var(--accent)':'var(--gray-200)'; }
  });
  document.getElementById('disclaimerWarning').style.display='none';
}

/* ═══════════════════════════════════════════
   NOMINATION TOGGLE
═══════════════════════════════════════════ */
function toggleNomination(radio){
  const show = radio.value==='optin';
  document.getElementById('nc').style.display = show?'':'none';
  document.getElementById('btnAddNom').style.display = show?'':'none';
}

/* ═══════════════════════════════════════════
   MOBILE PREFIX BY RESIDENCY
═══════════════════════════════════════════ */
const prefixMap = { 'Resident Indian':'+91', 'Non-Resident Indian':'+91', 'Foreign National':'+1' };
function updateMobilePrefix(pfx, val){
  const el = document.getElementById(pfx+'MobilePrefix');
  if(el) el.textContent = prefixMap[val]||'+91';
}

/* ═══════════════════════════════════════════
   PROFESSION TYPE TOGGLE
═══════════════════════════════════════════ */
function toggleProfType(sel){
  const wrap = document.getElementById('profTypeWrap');
  if(wrap) wrap.style.display = sel.value==='Professional'?'':'none';
}

/* ═══════════════════════════════════════════
   STEPPER
═══════════════════════════════════════════ */
const TOTAL=10; let cur=1;
const panels=document.querySelectorAll('.sp');
const pills=document.querySelectorAll('.pill');
const si=document.getElementById('si');
const pb=document.getElementById('pb');
const bPrev=document.getElementById('btnPrev');
const bNext=document.getElementById('btnNext');
const stp=document.getElementById('stp');

function goTo(s){
  panels.forEach(p=>p.classList.remove('active'));
  pills.forEach((p,i)=>{ p.classList.remove('active','done'); if(i+1<s) p.classList.add('done'); });
  document.querySelector(`.sp[data-step="${s}"]`).classList.add('active');
  const pill=document.querySelector(`.pill[data-step="${s}"]`);
  if(pill){ pill.classList.add('active'); pill.scrollIntoView({behavior:'smooth',block:'nearest',inline:'center'}); }
  si.textContent=s;
  pb.style.width=((s/TOTAL)*100)+'%';
  bPrev.disabled=s<=1;
  if(s===TOTAL){
    bNext.textContent='✓ Submit Application';
    bNext.style.background='linear-gradient(110deg,#059669,#065f46)';
    updateReview();
  } else { bNext.textContent='Next Step →'; bNext.style.background=''; }
  window.scrollTo({top:0,behavior:'smooth'});
  cur=s;
  saveState();
}

bNext.addEventListener('click',()=>{
  if(cur===1){
    const allChecked=agreementFields.every(n=>document.querySelector(`[name="${n}"]`)?.checked);
    if(!allChecked){
      document.getElementById('disclaimerWarning').style.display='block';
      document.getElementById('disclaimerWarning').scrollIntoView({behavior:'smooth',block:'center'});
      return;
    }
  }
  if(cur<TOTAL) goTo(cur+1);
  else alert('Application submitted successfully! Thank you.');
});
bPrev.addEventListener('click',()=>{ if(cur>1) goTo(cur-1); });
pills.forEach(p=>p.addEventListener('click',()=>goTo(+p.dataset.step)));
document.getElementById('sl').addEventListener('click',()=>stp.scrollBy({left:-160,behavior:'smooth'}));
document.getElementById('sr').addEventListener('click',()=>stp.scrollBy({left:160,behavior:'smooth'}));

/* ═══════════════════════════════════════════
   KRA FETCH (MOCK)
═══════════════════════════════════════════ */
function kra(pfx){
  const pan=document.querySelector(`[name="${pfx}Pan"]`)?.value;
  if(!pan||pan.length<10){ alert('Please enter a valid 10-digit PAN number first.'); return; }
  const d={ FirstName:'Deepak',MiddleName:'',LastName:'Sharma',KraStatus:'KYC Verified',
    FatherSpouseName:'Ramesh Sharma',Gender:'Male',MaritalStatus:'Married',
    Nationality:'Indian',ResidentialStatus:'Resident Indian',
    KraMobile:'9876543210',Email:'deepak@example.com',
    CorAddr1:'12, Green Valley',CorAddr2:'Bandra West',CorAddr3:'',
    CorCity:'Mumbai',CorDistrict:'Mumbai',CorPin:'400050',CorState:'Maharashtra',CorCountry:'India' };
  Object.entries(d).forEach(([k,v])=>{
    const el=document.querySelector(`[name="${pfx}${k}"]`);
    if(el){ el.value=v; el.style.borderColor='var(--success)'; setTimeout(()=>el.style.borderColor='',2000); }
  });
  alert('✓ KRA data fetched for PAN: '+pan.toUpperCase());
}

/* ═══════════════════════════════════════════
   COPY ADDRESS
═══════════════════════════════════════════ */
function copyAddr(cb){
  if(!cb.checked) return;
  const m={h1PerAddr1:'h1CorAddr1',h1PerAddr2:'h1CorAddr2',h1PerCity:'h1CorCity',h1PerDistrict:'h1CorDistrict',h1PerPin:'h1CorPin'};
  Object.entries(m).forEach(([to,from])=>{ const s=document.querySelector(`[name="${from}"]`); const d=document.querySelector(`[name="${to}"]`); if(s&&d) d.value=s.value; });
}

/* ═══════════════════════════════════════════
   JOINT HOLDER TOGGLE
═══════════════════════════════════════════ */
function toggleJH(n){
  const f=document.getElementById('jh'+n); const b=document.getElementById('tJH'+n);
  const open=f.style.display!=='none';
  f.style.display=open?'none':'block';
  b.textContent=open?'+ Add Joint Holder '+n:'− Remove Joint Holder '+n;
  b.classList.toggle('on',!open);
}

/* ═══════════════════════════════════════════
   ADD NOMINEE
═══════════════════════════════════════════ */
let nomC=1;
function addNom(){
  if(nomC>=3){ alert('Maximum 3 nominees allowed.'); return; }
  nomC++; const n=nomC;
  const div=document.createElement('div'); div.className='ns';
  div.innerHTML=`<div class="nh"><div class="nt">Nominee ${n}</div><button type="button" onclick="this.closest('.ns').remove();nomC--;" style="background:none;border:none;color:#dc2626;cursor:pointer;font-size:12px;font-weight:700;">✕ Remove</button></div>
  <div class="g3">
    <div class="fg"><label class="lbl">Nominee Name</label><input type="text" class="fc" name="nom${n}Name" placeholder="Full name"/></div>
    <div class="fg"><label class="lbl">Relationship with H1</label><select class="fs" name="nom${n}Relation"><option value="">Select</option><option>Mother</option><option>Father</option><option>Daughter</option><option>Son</option><option>Spouse</option><option>Other</option></select></div>
    <div class="fg"><label class="lbl">Share (%)</label><input type="number" class="fc" name="nom${n}Share" placeholder="e.g. 50" min="0" max="100"/></div>
  </div>
  <div class="g3">
    <div class="fg"><label class="lbl">Date of Birth</label><input type="date" class="fc" name="nom${n}Dob"/></div>
    <div class="fg"><label class="lbl">Mobile No.</label><input type="tel" class="fc" name="nom${n}Mobile" placeholder="10-digit" maxlength="10"/></div>
    <div class="fg"><label class="lbl">Email ID</label><input type="email" class="fc" name="nom${n}Email" placeholder="nominee@email.com"/></div>
  </div>
  <div class="g2">
    <div class="fg"><label class="lbl">Address</label><input type="text" class="fc" name="nom${n}Address" placeholder="Full address"/></div>
    <div class="fg"><label class="lbl">ID Proof Type</label><select class="fs" name="nom${n}IdType"><option value="">Select</option><option>PAN</option><option>Aadhaar</option><option>Passport</option></select></div>
  </div>`;
  document.getElementById('nc').appendChild(div);
}

/* ═══════════════════════════════════════════
   FILE UPLOAD FEEDBACK
═══════════════════════════════════════════ */
function upld(input){
  if(!input.files.length) return;
  const z=input.closest('.uz');
  z.innerHTML=`<input type="file" name="${input.name}" style="display:none" accept="${input.accept}" onchange="upld(this)"/>
    <span style="font-size:24px;display:block;margin-bottom:5px;">✅</span>
    <span style="font-size:12px;font-weight:700;color:var(--success);">${input.files[0].name}</span>`;
  z.style.borderColor='var(--success)'; z.style.background='#f0fdf4';
  z.onclick=()=>z.querySelector('input').click();
}

/* ═══════════════════════════════════════════
   LIVE CAMERA
═══════════════════════════════════════════ */
const streams = {};
async function startCamera(n){
  try {
    const stream = await navigator.mediaDevices.getUserMedia({video:{width:640,height:480,facingMode:'user'}});
    streams[n] = stream;
    const vid = document.getElementById('camVid'+n);
    const ph = document.getElementById('camPh'+n);
    const overlay = document.getElementById('camOverlay'+n);
    vid.srcObject = stream;
    vid.style.display='block';
    ph.style.display='none';
    overlay.style.display='flex';
    document.getElementById('camSnap'+n).style.display='none';
    document.getElementById('snapDone'+n).style.display='none';
  } catch(e){
    alert('Camera access denied or unavailable. Please allow camera permissions.');
  }
}
function capturePhoto(n){
  const vid = document.getElementById('camVid'+n);
  const canvas = document.getElementById('camCanvas'+n);
  const snap = document.getElementById('camSnap'+n);
  const dataInput = document.getElementById('photoH'+n+'_data');
  canvas.width=vid.videoWidth; canvas.height=vid.videoHeight;
  canvas.getContext('2d').drawImage(vid,0,0);
  const dataURL = canvas.toDataURL('image/jpeg',0.85);
  snap.src = dataURL;
  snap.style.display='block';
  vid.style.display='none';
  document.getElementById('camOverlay'+n).style.display='none';
  document.getElementById('snapDone'+n).style.display='block';
  if(dataInput) dataInput.value=dataURL;
  stopCamera(n);
}
function stopCamera(n){
  if(streams[n]){ streams[n].getTracks().forEach(t=>t.stop()); delete streams[n]; }
  const vid=document.getElementById('camVid'+n);
  const snap=document.getElementById('camSnap'+n);
  if(vid) vid.style.display='none';
  document.getElementById('camOverlay'+n).style.display='none';
  if(!snap||!snap.src){ document.getElementById('camPh'+n).style.display='flex'; }
}

/* ═══════════════════════════════════════════
   RISK PROFILE WIZARD
═══════════════════════════════════════════ */
const RQ_TOTAL = 6;
let rqCur = 1;
function buildRQProgress(){
  const prog = document.getElementById('rqProgress');
  if(!prog) return;
  prog.innerHTML='';
  for(let i=1;i<=RQ_TOTAL;i++){
    const dot=document.createElement('div');
    dot.className='rq-dot'+(i<rqCur?' done':i===rqCur?' active':'');
    prog.appendChild(dot);
  }
}
function selectRQ(label, name, value, hasDetail, detailId){
  label.closest('.rq-options').querySelectorAll('.rq-opt').forEach(o=>o.classList.remove('selected'));
  label.classList.add('selected');
  if(detailId){
    const sub = document.getElementById(detailId);
    if(sub) sub.classList.toggle('show', hasDetail);
  }
}
function nextRQ(n){
  if(n<RQ_TOTAL){ rqCur=n+1; showRQ(n+1); }
}
function prevRQ(n){
  if(n>1){ rqCur=n-1; showRQ(n-1); }
}
function showRQ(n){
  document.querySelectorAll('.rq-step').forEach(s=>s.classList.remove('active'));
  const step=document.getElementById('rq'+n);
  if(step) step.classList.add('active');
  rqCur=n;
  buildRQProgress();
}
function finishRQ(){
  document.querySelectorAll('.rq-step').forEach(s=>s.classList.remove('active'));
  document.getElementById('rqDone').style.display='block';
  rqCur=RQ_TOTAL+1;
  buildRQProgress();
}
buildRQProgress();

/* ═══════════════════════════════════════════
   REVIEW SUMMARY
═══════════════════════════════════════════ */
function updateReview(){
  const m={rv_product:'product',rv_fundName:'fundName',rv_accountCategory:'accountCategory',rv_feeType:'feeType',rv_investmentType:'investmentType',rv_h1Pan:'h1Pan',rv_h1Dob:'h1Dob',rv_h1Gender:'h1Gender',rv_h1Email:'h1Email',rv_h1OvdType:'h1OvdType',rv_bankName:'bankName',rv_bankAccNo:'bankAccNo',rv_bankIfsc:'bankIfsc',rv_dematType:'dematType',rv_dpName:'dpName'};
  Object.entries(m).forEach(([id,name])=>{ const el=document.querySelector(`[name="${name}"]`); const rv=document.getElementById(id); if(el&&rv) rv.textContent=el.value||'—'; });
  const fn=document.querySelector('[name="h1FirstName"]')?.value||'';
  const mn=document.querySelector('[name="h1MiddleName"]')?.value||'';
  const ln=document.querySelector('[name="h1LastName"]')?.value||'';
  const ne=document.getElementById('rv_h1Name'); if(ne) ne.textContent=[fn,mn,ln].filter(Boolean).join(' ')||'—';
  const amt=document.querySelector('[name="commitmentAmount"]')?.value;
  const ae=document.getElementById('rv_commitmentAmount'); if(ae&&amt) ae.textContent='₹ '+parseInt(amt).toLocaleString('en-IN');
}

/* ═══════════════════════════════════════════
   INIT — restore state
═══════════════════════════════════════════ */
const savedStep = loadState();
goTo(savedStep);
</script>
</body>
</html>
