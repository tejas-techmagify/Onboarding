<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Customer Onboarding - ValueQuest</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --primary: #1a56db; --primary-light: #e8f0fe; --primary-dark: #1040b0;
      --success: #0d9488; --danger: #ef4444;
      --gray-50:#f9fafb; --gray-100:#f3f4f6; --gray-200:#e5e7eb; --gray-300:#d1d5db;
      --gray-400:#9ca3af; --gray-500:#6b7280; --gray-600:#4b5563; --gray-700:#374151;
      --gray-800:#1f2937; --gray-900:#111827; --white:#ffffff; --radius:10px;
    }
    body {
      font-family:'DM Sans',sans-serif;
      background:#f0f4f8;
      min-height:100vh; display:flex; align-items:flex-start; justify-content:center;
      padding:24px 12px 48px; color:var(--gray-800);
    }
    .shell { width:90%; max-width:1100px; }
    .card { background:var(--white); border-radius:18px; box-shadow:0 8px 32px rgba(0,0,0,0.12); overflow:hidden; }

    /* HEADER */
    .hdr {
      background:#0a0a0a; color:#fff; padding:14px 28px;
      display:flex; align-items:center; justify-content:space-between; gap:12px;
      border-bottom:1px solid rgba(255,255,255,0.07);
    }
    .hdr-logo { height:36px; display:flex; align-items:center; }
    .hdr-logo img { height:36px; width:auto; object-fit:contain; display:block; }
    .hdr-right { text-align:right; }
    .hdr-right .lbl { font-size:11px; color:rgba(255,255,255,0.5); }
    .hdr-right .cnt { font-size:13px; font-weight:600; color:#fff; }

    /* STEPPER */
    .stp-wrap {
      background:var(--white); border-bottom:1px solid var(--gray-200);
      padding:0 18px; display:flex; align-items:center; gap:8px;
    }
    .stp-scroll { background:none; border:1.5px solid var(--gray-300); border-radius:50%; width:26px; height:26px; min-width:26px; cursor:pointer; font-size:12px; color:var(--gray-600); display:flex; align-items:center; justify-content:center; transition:all .2s; }
    .stp-scroll:hover { border-color:var(--primary); color:var(--primary); }
    .stp { display:flex; gap:4px; padding:10px 0; overflow-x:auto; flex:1; }
    .stp::-webkit-scrollbar { display:none; }
    .pill { display:flex; align-items:center; gap:6px; padding:5px 13px; border-radius:30px; cursor:pointer; border:1.5px solid var(--gray-200); background:var(--white); color:var(--gray-500); font-size:12px; font-weight:500; white-space:nowrap; transition:all .2s; font-family:'DM Sans',sans-serif; }
    .pill .n { width:19px; height:19px; border-radius:50%; background:var(--gray-200); color:var(--gray-600); font-size:10px; font-weight:700; display:flex; align-items:center; justify-content:center; transition:all .2s; }
    .pill.active { background:var(--primary-light); border-color:var(--primary); color:var(--primary); }
    .pill.active .n { background:var(--primary); color:#fff; }
    .pill.done { border-color:var(--success); color:var(--success); }
    .pill.done .n { background:var(--success); color:#fff; }

    /* BODY */
    .body { padding:24px 28px; background:var(--white); }
    .sp { display:none; }
    .sp.active { display:block; }

    .pt { font-family:'Playfair Display',serif; font-size:18px; font-weight:700; color:var(--gray-900); margin-bottom:3px; }
    .ps { font-size:13px; color:var(--gray-500); margin-bottom:20px; line-height:1.5; }

    .div { border:none; border-top:1px solid var(--gray-100); margin:18px 0; }
    .sub {
      font-size:11px; font-weight:700; color:var(--primary); text-transform:uppercase;
      letter-spacing:.8px; margin-bottom:12px; margin-top:4px;
      display:flex; align-items:center; gap:8px;
    }
    .sub::after { content:''; flex:1; height:1px; background:var(--primary-light); }

    /* GRIDS */
    .g3 { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:14px; }
    .g2 { display:grid; grid-template-columns:repeat(2,1fr); gap:14px; margin-bottom:14px; }
    .g4 { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:14px; }
    .s2 { grid-column:span 2; }
    .s3 { grid-column:span 3; }

    /* FORM */
    .fg { display:flex; flex-direction:column; gap:4px; }
    .lbl { font-size:11.5px; font-weight:600; color:var(--gray-700); display:flex; align-items:center; gap:4px; }
    .req { color:var(--danger); }
    .fc, .fs {
      width:100%; padding:8px 11px; border:1.5px solid var(--gray-200); border-radius:8px;
      font-size:13px; font-family:'DM Sans',sans-serif; color:var(--gray-800);
      background:var(--white); outline:none; transition:border-color .18s,box-shadow .18s;
      -webkit-appearance:none; appearance:none;
    }
    .fs {
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
      background-repeat:no-repeat; background-position:right 11px center; padding-right:30px;
    }
    .fc:focus,.fs:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(26,86,219,.09); }
    .fc::placeholder { color:var(--gray-400); font-size:12px; }
    .fc[readonly] { background:var(--gray-50); color:var(--gray-500); cursor:default; }
    .ig { display:flex; }
    .ig .pfx { background:var(--gray-100); border:1.5px solid var(--gray-200); border-right:none; border-radius:8px 0 0 8px; padding:8px 10px; font-size:12px; color:var(--gray-600); white-space:nowrap; display:flex; align-items:center; }
    .ig .fc { border-radius:0 8px 8px 0; }
    .rg { display:flex; flex-wrap:wrap; gap:12px; }
    .ri { display:flex; align-items:center; gap:5px; font-size:13px; cursor:pointer; color:var(--gray-700); }
    .ri input { accent-color:var(--primary); width:14px; height:14px; cursor:pointer; }
    textarea.fc { resize:vertical; min-height:64px; }
    .hint { font-size:10.5px; color:var(--gray-400); margin-top:2px; }
    .ba { font-size:9.5px; font-weight:600; background:#fef3c7; color:#92400e; border-radius:4px; padding:1px 5px; }
    .bo { font-size:9.5px; font-weight:500; background:var(--gray-100); color:var(--gray-500); border-radius:4px; padding:1px 5px; }

    /* KRA FETCH */
    .kra-row { display:grid; grid-template-columns:1fr 1fr auto; gap:14px; align-items:end; margin-bottom:14px; }
    .btn-kra {
      padding:0 18px; border:none; border-radius:8px; height:38px;
      background:var(--primary); color:#fff; font-size:12px; font-weight:600;
      font-family:'DM Sans',sans-serif; cursor:pointer; white-space:nowrap;
      transition:all .2s; display:flex; align-items:center; gap:6px;
    }
    .btn-kra:hover { background:var(--primary-dark); transform:translateY(-1px); }
    .btn-kra svg { width:14px; height:14px; flex-shrink:0; }

    /* HOLDER SECTION */
    .ht { display:flex; align-items:center; gap:8px; font-size:13px; font-weight:700; color:var(--gray-800); margin-bottom:16px; }
    .hbadge { background:var(--primary); color:#fff; border-radius:6px; padding:2px 9px; font-size:11px; font-weight:700; }
    .hbadge.jh { background:#3b82f6; }

    /* JOINT HOLDER TOGGLE */
    .jht { border:1.5px dashed var(--gray-300); border-radius:var(--radius); padding:14px 18px; margin-bottom:12px; display:flex; align-items:center; justify-content:space-between; background:var(--white); }
    .jht span { font-size:13px; font-weight:600; color:var(--gray-700); }

    /* BUTTONS */
    .btn-tgl { padding:6px 16px; border:1.5px solid var(--primary); border-radius:20px; background:var(--white); color:var(--primary); font-size:12px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; }
    .btn-tgl:hover,.btn-tgl.on { background:var(--primary); color:#fff; }

    /* NOMINEE */
    .ns { border:1.5px solid #bbf7d0; border-radius:var(--radius); padding:18px; margin-bottom:14px; background:var(--white); }
    .nh { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
    .nt { font-size:13px; font-weight:700; color:var(--success); }

    /* UPLOAD */
    .uz { border:2px dashed var(--gray-300); border-radius:var(--radius); padding:14px 12px; text-align:center; color:var(--gray-500); font-size:12px; cursor:pointer; transition:all .2s; background:var(--white); }
    .uz:hover { border-color:var(--primary); color:var(--primary); background:var(--primary-light); }
    .uz input[type="file"] { display:none; }
    .uz .uzi { font-size:20px; margin-bottom:4px; display:block; }
    .uz .uzl { font-size:12px; font-weight:500; }
    .uz .uzh { font-size:10.5px; color:var(--gray-400); margin-top:2px; }

    /* REVIEW */
    .rb { margin-bottom:18px; }
    .rbt { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.8px; color:var(--primary); border-bottom:1.5px solid var(--primary-light); padding-bottom:5px; margin-bottom:10px; }
    .rgd { display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:10px; }
    .rvl { font-size:10px; color:var(--gray-400); font-weight:600; text-transform:uppercase; letter-spacing:.4px; }
    .rvv { font-size:13px; color:var(--gray-800); font-weight:500; margin-top:2px; }

    /* FOOTER */
    .ftr { display:flex; align-items:center; gap:14px; padding:16px 28px; border-top:1px solid var(--gray-100); background:var(--white); }
    .pr { flex:1; height:5px; background:var(--gray-200); border-radius:10px; overflow:hidden; }
    .pb { height:100%; background:linear-gradient(90deg,var(--primary),#60a5fa); border-radius:10px; transition:width .4s ease; }
    .btn-g { padding:8px 20px; border:1.5px solid var(--gray-300); border-radius:30px; background:var(--white); color:var(--gray-600); font-size:13px; font-weight:500; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all .2s; }
    .btn-g:hover:not(:disabled) { border-color:var(--primary); color:var(--primary); }
    .btn-g:disabled { opacity:.4; cursor:not-allowed; }
    .btn-p { padding:8px 22px; border:none; border-radius:30px; background:linear-gradient(100deg,var(--primary),var(--primary-dark)); color:#fff; font-size:13px; font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif; box-shadow:0 2px 8px rgba(26,86,219,.22); transition:all .2s; }
    .btn-p:hover { transform:translateY(-1px); box-shadow:0 4px 16px rgba(26,86,219,.32); }

    @media(max-width:700px){
      .shell{width:98%;}
      .g3,.g4{grid-template-columns:1fr 1fr;}
      .g2{grid-template-columns:1fr;}
      .kra-row{grid-template-columns:1fr 1fr;}
      .kra-row .btn-kra{grid-column:span 2;width:fit-content;}
      .body{padding:16px;}
    }
    @media(max-width:480px){ .g3,.g4,.g2{grid-template-columns:1fr;} }
  </style>
</head>
<body>
<div class="shell"><div class="card">

  <!-- HEADER -->
  <header class="hdr">
    <div class="hdr-logo"><img src="uploads/vq-logo.png" alt="ValueQuest"/></div>
    <div class="hdr-right">
      <div class="lbl">Welcome <strong style="color:#fff;">User</strong></div>
      <div class="cnt">Step <span id="si">1</span> of 8</div>
    </div>
  </header>

  <!-- STEPPER -->
  <div class="stp-wrap">
    <button class="stp-scroll" id="sl">&#8592;</button>
    <div class="stp" id="stp">
      <button class="pill active" data-step="1"><span class="n">1</span> Disclaimer &amp; Agreement</button>
      <button class="pill" data-step="2"><span class="n">2</span> Investment Details</button>
      <button class="pill" data-step="3"><span class="n">3</span> Holder Details</button>
      <button class="pill" data-step="4"><span class="n">4</span> Joint Holders</button>
      <button class="pill" data-step="5"><span class="n">5</span> Nomination</button>
      <button class="pill" data-step="6"><span class="n">6</span> Bank &amp; Demat</button>
      <button class="pill" data-step="7"><span class="n">7</span> Risk Profile</button>
      <button class="pill" data-step="8"><span class="n">8</span> Documents &amp; Review</button>
    </div>
    <button class="stp-scroll" id="sr">&#8594;</button>
  </div>

  <main class="body">
  <form id="frm" novalidate>

  <!-- ══════════════ STEP 1 – INVESTMENT DETAILS ══════════════ -->
  <!-- ══════════════ STEP 1 – DISCLAIMER & AGREEMENT ══════════════ -->
  <section class="sp active" data-step="1">
    <div class="pt">Disclaimer &amp; Agreement</div>
    <div class="ps">Please read the following carefully and provide your consent before proceeding with the onboarding process.</div>

    <div class="sub">Important Disclaimer</div>
    <div style="background:#fffbeb; border:1.5px solid #fde68a; border-radius:var(--radius); padding:16px 18px; margin-bottom:18px; font-size:12.5px; line-height:1.7; color:#78350f;">
      <strong style="display:block; margin-bottom:8px; font-size:13px; color:#92400e;">⚠️ Please Read Before Proceeding</strong>
      Portfolio Management Services (PMS) and Alternative Investment Funds (AIF) are investment products regulated by the Securities and Exchange Board of India (SEBI). Investments in securities market are subject to market risks. Please read all scheme-related documents carefully before investing. Past performance is not indicative of future returns. The minimum investment amount for PMS is ₹50 Lakhs and for Category I &amp; II AIF is ₹1 Crore as per SEBI regulations. ValueQuest Investment Advisors Pvt. Ltd. is registered with SEBI as a Portfolio Manager (Registration No. INP000006183). This onboarding form is for KYC and account opening purposes only and does not constitute a solicitation or guarantee of returns.
    </div>

    <div class="sub">SEBI &amp; Regulatory Declarations</div>
    <div style="background:#f0f9ff; border:1.5px solid #bae6fd; border-radius:var(--radius); padding:16px 18px; margin-bottom:18px; font-size:12.5px; line-height:1.7; color:#0c4a6e;">
      <strong style="display:block; margin-bottom:8px; font-size:13px; color:#0369a1;">📋 Regulatory Information</strong>
      As per SEBI (Portfolio Managers) Regulations 2020 and SEBI (Alternative Investment Funds) Regulations 2012, the investor is required to submit KYC documents and complete the onboarding process. The Portfolio Manager / Fund Manager shall not be liable for any losses arising out of market fluctuations. All investments shall be subject to the terms and conditions mentioned in the Disclosure Document / Private Placement Memorandum (PPM). The investor confirms that the funds being invested are from legitimate sources and comply with Prevention of Money Laundering Act (PMLA), 2002.
    </div>

    <div style="background:var(--gray-50); border:1.5px solid var(--gray-200); border-radius:var(--radius); padding:14px 16px; display:flex; align-items:center; gap:12px;">
      <input type="checkbox" id="agreeAll" style="accent-color:#1a56db; width:17px; height:17px; flex-shrink:0;" onchange="toggleAllAgreements(this)"/>
      <label for="agreeAll" style="font-size:13px; font-weight:700; color:var(--gray-800); cursor:pointer;">I have read and agree to all the above declarations, disclaimers and agreements.</label>
    </div>

    <div class="sub">Client Agreements &amp; Consents</div>
    <div style="display:flex; flex-direction:column; gap:14px; margin-bottom:20px;">

      <label style="display:flex; align-items:flex-start; gap:12px; cursor:pointer; padding:14px 16px; border:1.5px solid var(--gray-200); border-radius:var(--radius); transition:border-color .2s;" onmouseover="this.style.borderColor='#1a56db'" onmouseout="this.style.borderColor=this.querySelector('input').checked?'#1a56db':'#e5e7eb'">
        <input type="checkbox" name="agreeTerms" style="accent-color:#1a56db; width:16px; height:16px; margin-top:2px; flex-shrink:0;" onchange="checkAllAgreed()"/>
        <div>
          <div style="font-size:13px; font-weight:600; color:var(--gray-800); margin-bottom:3px;">Terms &amp; Conditions</div>
          <div style="font-size:12px; color:var(--gray-500); line-height:1.5;">I have read, understood and agree to the Terms &amp; Conditions of ValueQuest Investment Advisors Pvt. Ltd. and the applicable scheme documents including the Disclosure Document / PPM.</div>
        </div>
      </label>

      <label style="display:flex; align-items:flex-start; gap:12px; cursor:pointer; padding:14px 16px; border:1.5px solid var(--gray-200); border-radius:var(--radius); transition:border-color .2s;" onmouseover="this.style.borderColor='#1a56db'" onmouseout="this.style.borderColor=this.querySelector('input').checked?'#1a56db':'#e5e7eb'">
        <input type="checkbox" name="agreeRisk" style="accent-color:#1a56db; width:16px; height:16px; margin-top:2px; flex-shrink:0;" onchange="checkAllAgreed()"/>
        <div>
          <div style="font-size:13px; font-weight:600; color:var(--gray-800); margin-bottom:3px;">Risk Acknowledgement</div>
          <div style="font-size:12px; color:var(--gray-500); line-height:1.5;">I acknowledge that investments in securities are subject to market risks and there is no assurance or guarantee of returns. I understand the risk factors associated with the portfolio strategy and confirm that this investment is suitable for my financial profile.</div>
        </div>
      </label>

      <label style="display:flex; align-items:flex-start; gap:12px; cursor:pointer; padding:14px 16px; border:1.5px solid var(--gray-200); border-radius:var(--radius); transition:border-color .2s;" onmouseover="this.style.borderColor='#1a56db'" onmouseout="this.style.borderColor=this.querySelector('input').checked?'#1a56db':'#e5e7eb'">
        <input type="checkbox" name="agreePmla" style="accent-color:#1a56db; width:16px; height:16px; margin-top:2px; flex-shrink:0;" onchange="checkAllAgreed()"/>
        <div>
          <div style="font-size:13px; font-weight:600; color:var(--gray-800); margin-bottom:3px;">PMLA &amp; Source of Funds Declaration</div>
          <div style="font-size:12px; color:var(--gray-500); line-height:1.5;">I declare that the funds being invested are from legitimate and disclosed sources. I confirm compliance with the Prevention of Money Laundering Act (PMLA), 2002 and agree to provide any additional documents required for AML/KYC verification.</div>
        </div>
      </label>

      <label style="display:flex; align-items:flex-start; gap:12px; cursor:pointer; padding:14px 16px; border:1.5px solid var(--gray-200); border-radius:var(--radius); transition:border-color .2s;" onmouseover="this.style.borderColor='#1a56db'" onmouseout="this.style.borderColor=this.querySelector('input').checked?'#1a56db':'#e5e7eb'">
        <input type="checkbox" name="agreePrivacy" style="accent-color:#1a56db; width:16px; height:16px; margin-top:2px; flex-shrink:0;" onchange="checkAllAgreed()"/>
        <div>
          <div style="font-size:13px; font-weight:600; color:var(--gray-800); margin-bottom:3px;">Privacy Policy &amp; Data Consent</div>
          <div style="font-size:12px; color:var(--gray-500); line-height:1.5;">I consent to the collection, storage and processing of my personal data as outlined in the Privacy Policy for KYC, regulatory compliance and communication purposes. I authorize ValueQuest to fetch my KYC data from KRA/CKYC registries.</div>
        </div>
      </label>

      <label style="display:flex; align-items:flex-start; gap:12px; cursor:pointer; padding:14px 16px; border:1.5px solid var(--gray-200); border-radius:var(--radius); transition:border-color .2s;" onmouseover="this.style.borderColor='#1a56db'" onmouseout="this.style.borderColor=this.querySelector('input').checked?'#1a56db':'#e5e7eb'">
        <input type="checkbox" name="agreePms" style="accent-color:#1a56db; width:16px; height:16px; margin-top:2px; flex-shrink:0;" onchange="checkAllAgreed()"/>
        <div>
          <div style="font-size:13px; font-weight:600; color:var(--gray-800); margin-bottom:3px;">PMS / AIF Client Agreement</div>
          <div style="font-size:12px; color:var(--gray-500); line-height:1.5;">I agree to execute the Portfolio Management Agreement / Subscription Agreement as applicable and authorize ValueQuest Investment Advisors to manage my portfolio in accordance with the agreed investment strategy, fee structure and discretionary powers as outlined in the agreement.</div>
        </div>
      </label>

    </div>

    

    <div id="disclaimerWarning" style="display:none; margin-top:10px; padding:10px 14px; background:#fef2f2; border:1.5px solid #fecaca; border-radius:8px; font-size:12px; color:#dc2626; font-weight:500;">
      ⚠️ Please accept all agreements before proceeding.
    </div>
  </section>

  <!-- ══════════════ STEP 2 – INVESTMENT DETAILS ══════════════ -->
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
        <input type="number" class="fc" name="commitmentAmount" placeholder="Enter amount in numbers" min="0"/></div>
      <div class="fg s2"><label class="lbl">Commitment Amount (in Words) <span class="req">*</span></label>
        <input type="text" class="fc" name="commitmentAmountWords" placeholder="e.g. Fifty Lakhs Only"/></div>
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
      <div class="fg"><label class="lbl">PPM No. <span class="req">*</span></label>
        <input type="text" class="fc" name="ppmNo" placeholder="Enter PPM / Series number"/></div>
      <div class="fg"><label class="lbl">No. of Account Holders <span class="req">*</span></label>
        <select class="fs" name="numHolders"><option value="">Select</option><option value="1">1 – Sole Holder</option><option value="2">2 – Two Holders</option><option value="3">3 – Three Holders</option></select></div>
    </div>
  </section>

  <!-- ══════════════ STEP 2 – HOLDER DETAILS ══════════════ -->
  <section class="sp" data-step="3">
    <div class="pt">First / Sole Holder Details</div>
    <div class="ps">Enter PAN &amp; DOB, click Fetch KRA — remaining fields will auto-fill. Complete any missing details manually.</div>

    <div class="">
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

      <div class="sub">Personal Details</div>
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
          <input type="text" class="fc" name="h1CountryBirth" placeholder="e.g. India"/></div>
        <div class="fg"><label class="lbl">Gender <span class="req">*</span></label>
          <select class="fs" name="h1Gender"><option value="">Select</option><option>Male</option><option>Female</option><option>Others</option></select></div>
        <div class="fg"><label class="lbl">Marital Status <span class="req">*</span></label>
          <select class="fs" name="h1MaritalStatus"><option value="">Select</option><option>Married</option><option>Unmarried</option><option>Others</option></select></div>
      </div>

      <div class="g3">
        <div class="fg"><label class="lbl">Nationality <span class="req">*</span></label>
          <select class="fs" name="h1Nationality"><option value="">Select</option><option>Indian</option><option>NRI</option><option>Other</option></select></div>
        <div class="fg"><label class="lbl">Residential Status <span class="req">*</span></label>
          <select class="fs" name="h1ResidentialStatus"><option value="">Select</option><option>Resident Indian</option><option>Non-Resident Indian</option><option>Foreign National</option></select></div>
        <div class="fg"><label class="lbl">Tax Resident <span class="req">*</span></label>
          <input type="text" class="fc" name="h1TaxResident" placeholder="Country of tax residency"/></div>
      </div>

      <div class="g3">
        <div class="fg"><label class="lbl">US Person <span class="req">*</span></label>
          <select class="fs" name="h1UsPerson"><option value="">Select</option><option>Yes</option><option>No</option></select></div>
        <div class="fg"><label class="lbl">PEP Status <span class="req">*</span></label>
          <select class="fs" name="h1PepStatus"><option value="">Select</option><option>PEP</option><option>RPEP</option><option>Not Applicable</option></select></div>
        <div class="fg"><label class="lbl">CKYC Number <span class="req">*</span></label>
          <input type="text" class="fc" name="h1Ckyc" placeholder="Max 19 digits" maxlength="19"/></div>
      </div>

      <div class="sub">Professional &amp; Financial</div>
      <div class="g3">
        <div class="fg"><label class="lbl">Occupation <span class="req">*</span></label>
          <select class="fs" name="h1Occupation"><option value="">Select</option><option>Private Sector</option><option>Public Sector</option><option>Government Service</option><option>Business</option><option>Professional</option><option>Agriculturist</option><option>Retired</option><option>Housewife</option><option>Student</option><option>Others please specify</option></select></div>
        <div class="fg"><label class="lbl">Professional Type</label>
          <select class="fs" name="h1Professional"><option value="">Select</option><option>Advocate</option><option>Doctor</option><option>Self Employed</option></select></div>
        <div class="fg"><label class="lbl">Education <span class="req">*</span></label>
          <input type="text" class="fc" name="h1Education" placeholder="Highest qualification"/></div>
      </div>

      <div class="g3">
        <div class="fg"><label class="lbl">Source of Fund <span class="req">*</span></label>
          <select class="fs" name="h1SourceFund"><option value="">Select</option><option>Savings</option><option>Business</option><option>Ancestral / Inheritance</option><option>Gift</option><option>Others please specify</option></select></div>
        <div class="fg"><label class="lbl">Trading / Dealing Exp. <span class="req">*</span></label>
          <select class="fs" name="h1TradingExp"><option value="">Select</option><option>1 Year</option><option>2 Years</option><option>3 Years</option><option>4 Years</option><option>&gt;5 Years</option></select></div>
        <div class="fg"><label class="lbl">Annual Income <span class="req">*</span></label>
          <select class="fs" name="h1AnnualIncome"><option value="">Select range</option><option>Below Rs.25 Lacs</option><option>Rs.25–50 Lacs</option><option>Rs.50–75 Lacs</option><option>Rs.75–100 Lakhs</option><option>Above Rs.100 Lakhs</option></select></div>
      </div>

      <div class="g3">
        <div class="fg"><label class="lbl">Net Worth (₹) <span class="req">*</span></label>
          <input type="number" class="fc" name="h1NetWorth" placeholder="Enter net worth"/></div>
        <div class="fg"><label class="lbl">Net Worth Date <span class="req">*</span></label>
          <input type="date" class="fc" name="h1NetWorthDate"/></div>
        <div class="fg"><label class="lbl">Brief Details <span class="req">*</span></label>
          <input type="text" class="fc" name="h1BriefDetails" placeholder="Brief description"/></div>
      </div>

      <div class="sub">Contact Details</div>
      <div class="g3">
        <div class="fg"><label class="lbl">KRA Mobile No. <span class="ba">Auto</span></label>
          <div class="ig"><span class="pfx">+91</span><input type="tel" class="fc" name="h1KraMobile" placeholder="KRA Fetch" readonly/></div></div>
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
          <select class="fs" name="h1CorState"><option value="">Auto-populate</option><option>Maharashtra</option><option>Delhi</option><option>Karnataka</option><option>Gujarat</option><option>Tamil Nadu</option><option>Rajasthan</option></select></div>
        <div class="fg"><label class="lbl">Country <span class="ba">Auto</span></label>
          <select class="fs" name="h1CorCountry"><option value="">Auto-populate</option><option>India</option><option>USA</option><option>UK</option></select></div>
      </div>

      <div class="sub">Permanent Address <span class="bo" style="text-transform:none;letter-spacing:0;">Optional</span></div>
      <div style="margin-bottom:12px;">
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
          <select class="fs" name="h1PerState"><option value="">Select state</option><option>Maharashtra</option><option>Delhi</option><option>Karnataka</option><option>Gujarat</option></select></div>
      </div>

      <div class="sub">NRI Details <span class="bo" style="text-transform:none;letter-spacing:0;">Only for NRI</span></div>
      <div class="g3">
        <div class="fg"><label class="lbl">Date of Becoming NRI</label><input type="date" class="fc" name="h1NriDate"/></div>
        <div class="fg"><label class="lbl">Country (NRI)</label><input type="text" class="fc" name="h1NriCountry" placeholder="Country name"/></div>
        <div class="fg"><label class="lbl">TIN No.</label><input type="text" class="fc" name="h1TinNo" placeholder="Tax Identification Number"/></div>
      </div>
    </div>
  </section>

  <!-- ══════════════ STEP 3 – JOINT HOLDERS ══════════════ -->
  <section class="sp" data-step="4">
    <div class="pt">Joint Holder Details</div>
    <div class="ps">Add up to 2 additional joint holders. Click the button to expand each holder's form.</div>

    <!-- JH2 -->
    <div class="jht">
      <span>&#128100; Joint Holder 2</span>
      <button type="button" class="btn-tgl" id="tJH2" onclick="toggleJH(2)">+ Add Joint Holder 2</button>
    </div>
    <div id="jh2" style="display:none;">
      <div class="">
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
        <div class="sub">Personal Details</div>
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
            <input type="text" class="fc" name="h2MiddleName" placeholder="KRA Fetch"/></div>
          <div class="fg"><label class="lbl">Last Name <span class="req">*</span></label>
            <input type="text" class="fc" name="h2LastName" placeholder="KRA Fetch"/></div>
          <div class="fg"><label class="lbl">Gender <span class="req">*</span></label>
            <select class="fs" name="h2Gender"><option value="">Select</option><option>Male</option><option>Female</option><option>Others</option></select></div>
        </div>
        <div class="g3">
          <div class="fg"><label class="lbl">PEP Status</label>
            <select class="fs" name="h2PepStatus"><option value="">Select</option><option>PEP</option><option>RPEP</option><option>Not Applicable</option></select></div>
          <div class="fg"><label class="lbl">KRA Status <span class="ba">Auto</span></label>
            <input type="text" class="fc" name="h2KraStatus" placeholder="KRA Fetch" readonly/></div>
          <div class="fg"><label class="lbl">Email Id <span class="ba">Auto</span></label>
            <input type="email" class="fc" name="h2Email" placeholder="KRA Fetch" readonly/></div>
        </div>
        <div class="g3">
          <div class="fg"><label class="lbl">Mobile No. <span class="ba">Auto</span></label>
            <div class="ig"><span class="pfx">+91</span><input type="tel" class="fc" name="h2Mobile" placeholder="KRA Fetch" readonly/></div></div>
          <div class="fg"><label class="lbl">Occupation</label>
            <select class="fs" name="h2Occupation"><option value="">Select</option><option>Private Sector</option><option>Business</option><option>Professional</option><option>Retired</option><option>Other</option></select></div>
          <div class="fg"><label class="lbl">Annual Income</label>
            <select class="fs" name="h2AnnualIncome"><option value="">Select range</option><option>Below Rs.25 Lacs</option><option>Rs.25–50 Lacs</option><option>Rs.50–75 Lacs</option><option>Above Rs.100 Lakhs</option></select></div>
        </div>
      </div>
    </div>

    <!-- JH3 -->
    <div class="jht">
      <span>&#128100; Joint Holder 3</span>
      <button type="button" class="btn-tgl" id="tJH3" onclick="toggleJH(3)">+ Add Joint Holder 3</button>
    </div>
    <div id="jh3" style="display:none;">
      <div class="">
        <div class="ht"><span class="hbadge jh">H3</span> Joint Holder 3</div>
        <div class="sub">PAN &amp; KRA Verification</div>
        <div class="kra-row">
          <div class="fg"><label class="lbl">PAN Number <span class="req">*</span></label>
            <input type="text" class="fc" name="h3Pan" placeholder="e.g. ABCDE1234F" maxlength="10" style="text-transform:uppercase"/></div>
          <div class="fg"><label class="lbl">Date of Birth <span class="req">*</span></label>
            <input type="date" class="fc" name="h3Dob"/></div>
          <button type="button" class="btn-kra" onclick="kra('h3')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>Fetch KRA
          </button>
        </div>
        <div class="sub">Personal Details</div>
        <div class="g3">
          <div class="fg"><label class="lbl">Relationship with H1 <span class="req">*</span></label>
            <select class="fs" name="h3Relation"><option value="">Select</option><option>Spouse</option><option>Parent</option><option>Sibling</option><option>Child</option><option>Other</option></select></div>
          <div class="fg"><label class="lbl">Salutation</label>
            <select class="fs" name="h3Salutation"><option value="">Select</option><option>Mr.</option><option>Ms.</option><option>Mrs.</option><option>M/s</option></select></div>
          <div class="fg"><label class="lbl">First Name <span class="req">*</span></label>
            <input type="text" class="fc" name="h3FirstName" placeholder="KRA Fetch"/></div>
        </div>
        <div class="g3">
          <div class="fg"><label class="lbl">Middle Name <span class="bo">Optional</span></label>
            <input type="text" class="fc" name="h3MiddleName" placeholder="KRA Fetch"/></div>
          <div class="fg"><label class="lbl">Last Name <span class="req">*</span></label>
            <input type="text" class="fc" name="h3LastName" placeholder="KRA Fetch"/></div>
          <div class="fg"><label class="lbl">Gender</label>
            <select class="fs" name="h3Gender"><option value="">Select</option><option>Male</option><option>Female</option><option>Others</option></select></div>
        </div>
        <div class="g3">
          <div class="fg"><label class="lbl">PEP Status</label>
            <select class="fs" name="h3PepStatus"><option value="">Select</option><option>PEP</option><option>RPEP</option><option>Not Applicable</option></select></div>
          <div class="fg"><label class="lbl">KRA Status <span class="ba">Auto</span></label>
            <input type="text" class="fc" name="h3KraStatus" placeholder="KRA Fetch" readonly/></div>
          <div class="fg"><label class="lbl">Email Id <span class="ba">Auto</span></label>
            <input type="email" class="fc" name="h3Email" placeholder="KRA Fetch" readonly/></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════════ STEP 4 – NOMINATION ══════════════ -->
  <section class="sp" data-step="5">
    <div class="pt">Nomination Details</div>
    <div class="ps">Add nominee(s) to receive benefits. You may opt-out of nomination.</div>

    <div class="g3" style="margin-bottom:16px;">
      <div class="fg"><label class="lbl">Nomination Option <span class="req">*</span></label>
        <div class="rg" style="margin-top:6px;">
          <label class="ri"><input type="radio" name="nominationOpt" value="optin" checked onchange="toggleNomination(this)"/> Opt-In (Add Nominee)</label>
          <label class="ri"><input type="radio" name="nominationOpt" value="optout" onchange="toggleNomination(this)"/> Opt-Out (No Nominee)</label>
        </div>
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
        <div class="g3">
          <div class="fg s2"><label class="lbl">Address</label><input type="text" class="fc" name="nom1Address" placeholder="Full address"/></div>
          <div class="fg"><label class="lbl">ID Proof Type</label>
            <select class="fs" name="nom1IdType"><option value="">Select</option><option>PAN</option><option>Aadhaar</option><option>Passport</option><option>Birth Proof</option><option>Others</option></select></div>
        </div>
        <div class="g3">
          <div class="fg"><label class="lbl">ID Proof No.</label><input type="text" class="fc" name="nom1IdNo" placeholder="Document number"/></div>
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
    <button type="button" class="btn-tgl" onclick="addNom()" id="btnAddNom" style="margin-top:4px;">+ Add Nominee (up to 2 more)</button>
  </section>

  <!-- ══════════════ STEP 5 – BANK & DEMAT ══════════════ -->
  <section class="sp" data-step="6">
    <div class="pt">Bank &amp; Demat Details</div>
    <div class="ps">Enter bank account for payouts, demat account details, and upload photographs.</div>

    <div class="sub">Bank Account</div>
    <div class="g3">
      <div class="fg"><label class="lbl">Bank Name <span class="req">*</span></label>
        <select class="fs" name="bankName"><option value="">Select bank</option><option>HDFC Bank</option><option>ICICI Bank</option><option>SBI</option><option>Axis Bank</option><option>Kotak Mahindra Bank</option><option>Yes Bank</option></select></div>
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
        <select class="fs" name="dpName"><option value="">Select DP</option><option>Zerodha</option><option>Angel One</option><option>Sharekhan</option><option>ICICIdirect</option><option>HDFC Securities</option></select></div>
      <div class="fg"><label class="lbl">DP ID <span class="req">*</span></label>
        <input type="text" class="fc" name="dpId" placeholder="Depository Participant ID"/></div>
    </div>
    <div class="g3">
      <div class="fg"><label class="lbl">Client ID <span class="req">*</span></label>
        <input type="text" class="fc" name="dematClientId" placeholder="Demat client ID"/></div>
    </div>

    <div class="sub">Photograph Upload</div>
    <div class="g3">
      <div class="fg"><label class="lbl">Holder 1 – Photograph <span class="req">*</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="photoH1" accept="image/*" onchange="upld(this)"/>
          <span class="uzi">📷</span><span class="uzl">Upload Photograph</span><span class="uzh">JPG / PNG, max 2MB</span>
        </div></div>
      <div class="fg"><label class="lbl">Holder 2 – Photograph <span class="bo">If Joint</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="photoH2" accept="image/*" onchange="upld(this)"/>
          <span class="uzi">📷</span><span class="uzl">Upload Photograph</span><span class="uzh">JPG / PNG, max 2MB</span>
        </div></div>
      <div class="fg"><label class="lbl">Holder 3 – Photograph <span class="bo">If Joint</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="photoH3" accept="image/*" onchange="upld(this)"/>
          <span class="uzi">📷</span><span class="uzl">Upload Photograph</span><span class="uzh">JPG / PNG, max 2MB</span>
        </div></div>
    </div>
  </section>

  <!-- ══════════════ STEP 6 – RISK PROFILE QUESTIONNAIRE ══════════════ -->
  <section class="sp" data-step="7">
    <div class="pt">Risk Profile Questionnaire</div>
    <div class="ps">Mandatory regulatory declarations regarding your investor category and compliance status.</div>

    <div class="sub">Investor Category</div>

    <div style="margin-bottom:16px;"><div class="fg">
      <label class="lbl">Are you a Qualified Institutional Buyer (QIB) / Qualified Buyer (QB) / Entity regulated by RBI? <span class="req">*</span></label>
      <select class="fs" name="isQib" style="max-width:320px;margin-top:6px;" onchange="document.getElementById('qibSpec').style.display=this.value&&this.value!=='Not Applicable'?'block':'none'">
        <option value="">Select</option><option>Not Applicable</option><option>QIB</option><option>QB</option><option>Regulated by RBI</option>
      </select>
      <div id="qibSpec" style="display:none;margin-top:8px;"><input type="text" class="fc" name="qibDetails" placeholder="Please specify details" style="max-width:400px;"/></div>
    </div></div>

    <div style="margin-bottom:16px;"><div class="fg">
      <label class="lbl">Are you a citizen(s) of / residing in any country which shares a land border with India? <span class="req">*</span></label>
      <div class="rg" style="margin-top:6px;">
        <label class="ri"><input type="radio" name="landBorderCitizen" value="Yes"/> Yes</label>
        <label class="ri"><input type="radio" name="landBorderCitizen" value="No"/> No</label>
      </div>
    </div></div>

    <div style="margin-bottom:16px;"><div class="fg">
      <label class="lbl">Are you an entity whose beneficial owners (as per PMLA Rules 2005) are citizens of / residing in countries sharing a land border with India? <span class="req">*</span></label>
      <div class="rg" style="margin-top:6px;">
        <label class="ri"><input type="radio" name="beneficialOwnerBorder" value="Yes"/> Yes</label>
        <label class="ri"><input type="radio" name="beneficialOwnerBorder" value="No"/> No</label>
      </div>
    </div></div>

    <div style="margin-bottom:16px;"><div class="fg">
      <label class="lbl">Are you an investor or investors of the same group? <span class="req">*</span></label>
      <div class="rg" style="margin-top:6px;">
        <label class="ri"><input type="radio" name="sameGroupInvestor" value="Yes"/> Yes</label>
        <label class="ri"><input type="radio" name="sameGroupInvestor" value="No"/> No</label>
      </div>
    </div></div>

    <div style="margin-bottom:16px;"><div class="fg">
      <label class="lbl">Are you an entity established, owned or controlled by the Central / State Government or Government of a foreign country (including central banks &amp; sovereign wealth funds)? <span class="req">*</span></label>
      <div class="rg" style="margin-top:6px;">
        <label class="ri"><input type="radio" name="govtEntity" value="Yes"/> Yes</label>
        <label class="ri"><input type="radio" name="govtEntity" value="No"/> No</label>
      </div>
    </div></div>

    <div style="margin-bottom:16px;"><div class="fg">
      <label class="lbl">Are you an AIF or a fund set up outside India or in International Financial Services Centres (IFSC) in India? <span class="req">*</span></label>
      <div class="rg" style="margin-top:6px;">
        <label class="ri"><input type="radio" name="aifOrIfsc" value="Yes" onchange="document.getElementById('aifSub').style.display='block'"/> Yes</label>
        <label class="ri"><input type="radio" name="aifOrIfsc" value="No" onchange="document.getElementById('aifSub').style.display='none'"/> No</label>
      </div>
    </div></div>

    <div id="aifSub" style="display:none;margin-left:20px;border-left:3px solid var(--primary-light);padding-left:18px;margin-bottom:16px;">
      <div style="margin-bottom:14px;"><div class="fg">
        <label class="lbl">1(a). Do investor(s) of the same group contribute 50% or more to the corpus? AND (b) Are they also QIBs / QBs? <span class="req">*</span></label>
        <div class="rg" style="margin-top:6px;">
          <label class="ri"><input type="radio" name="aifQ1" value="Yes"/> Yes</label>
          <label class="ri"><input type="radio" name="aifQ1" value="No"/> No</label>
        </div>
      </div></div>
      <div style="margin-bottom:14px;"><div class="fg">
        <label class="lbl">2(a). Do investor(s) of the same group contribute 25% or more to the corpus? AND (b) Are they also regulated by RBI? <span class="req">*</span></label>
        <div class="rg" style="margin-top:6px;">
          <label class="ri"><input type="radio" name="aifQ2" value="Yes"/> Yes</label>
          <label class="ri"><input type="radio" name="aifQ2" value="No"/> No</label>
        </div>
      </div></div>
    </div>

    <div class="sub">Confirmation</div>
    <div style="margin-bottom:16px;"><div class="fg">
      <label class="lbl">If your answer to Q3, Q4, or Q6 is Yes — provide names &amp; PANs of such persons / entities. Confirmation required? <span class="req">*</span></label>
      <select class="fs" name="confirmationRequired" style="max-width:260px;margin-top:6px;" onchange="document.getElementById('confirmDetails').style.display=this.value==='Yes'?'block':'none'">
        <option value="">Select</option><option>Yes</option><option>No</option><option>Not Applicable</option>
      </select>
      <div id="confirmDetails" style="display:none;margin-top:8px;">
        <textarea class="fc" name="confirmationDetails" rows="3" placeholder="Provide names and PAN of such persons / entities"></textarea>
      </div>
    </div></div>
  </section>

  <!-- ══════════════ STEP 7 – DOCUMENTS & REVIEW ══════════════ -->
  <section class="sp" data-step="8">
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
    <div class="g3">
      <div class="fg"><label class="lbl">Bank Proof <span class="bo">Optional</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="docBankProof" accept="image/*,application/pdf" onchange="upld(this)"/>
          <span class="uzi">🏦</span><span class="uzl">Cancelled Cheque</span><span class="uzh">PDF / Image</span>
        </div></div>
      <div class="fg"><label class="lbl">CML <span class="bo">Optional</span></label>
        <div class="uz" onclick="this.querySelector('input').click()">
          <input type="file" name="docCml" accept="image/*,application/pdf" onchange="upld(this)"/>
          <span class="uzi">📋</span><span class="uzl">Client Master List</span><span class="uzh">PDF / Image</span>
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
        <div><div class="rvl">Client ID</div><div class="rvv" id="rv_dematClientId">—</div></div>
      </div>
    </div>
  </section>

  </form>
  </main>

  <!-- FOOTER NAV -->
  <footer class="ftr">
    <button type="button" class="btn-g" id="btnPrev" disabled>&#8592; Previous</button>
    <div class="pr"><div class="pb" id="pb" style="width:12.5%"></div></div>
    <button type="button" class="btn-p" id="btnNext">Next Step &#8594;</button>
  </footer>

  <!-- COPYRIGHT FOOTER -->
  <div style="background:#f9fafb; border-top:1px solid var(--gray-100); padding:14px 28px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px;">
    <div style="display:flex; align-items:center; gap:8px;">
      <img src="uploads/vq-logo.png" alt="ValueQuest" style="height:16px; opacity:0.45;"/>
      <span style="font-size:11.5px; color:#94a3b8;">&copy; 2026 <strong style="color:#64748b;">ValueQuest Investment Advisors Pvt. Ltd.</strong> &mdash; All rights reserved.</span>
    </div>
    <div style="font-size:11px; color:#b0bec5; display:flex; gap:12px;">
      <a href="#" style="color:#94a3b8; text-decoration:none;">Privacy Policy</a>
      <span style="color:#d1d5db;">·</span>
      <a href="#" style="color:#94a3b8; text-decoration:none;">Terms of Use</a>
      <span style="color:#d1d5db;">·</span>
      <a href="#" style="color:#94a3b8; text-decoration:none;">Support</a>
    </div>
  </div>

</div></div>

<script>
  /* DISCLAIMER CHECKBOXES */
  const agreementFields = ['agreeTerms','agreeRisk','agreePmla','agreePrivacy','agreePms'];

  function checkAllAgreed(){
    const allChecked = agreementFields.every(n => document.querySelector(`[name="${n}"]`)?.checked);
    document.getElementById('agreeAll').checked = allChecked;
    document.getElementById('disclaimerWarning').style.display = 'none';
    // update border colors
    agreementFields.forEach(n => {
      const cb = document.querySelector(`[name="${n}"]`);
      if(cb) cb.closest('label').style.borderColor = cb.checked ? '#1a56db' : '#e5e7eb';
    });
  }

  function toggleAllAgreements(masterCb){
    agreementFields.forEach(n => {
      const cb = document.querySelector(`[name="${n}"]`);
      if(cb){ cb.checked = masterCb.checked; cb.closest('label').style.borderColor = masterCb.checked ? '#1a56db' : '#e5e7eb'; }
    });
    document.getElementById('disclaimerWarning').style.display = 'none';
  }

  /* NOMINATION TOGGLE */
  function toggleNomination(radio){
    const show = radio.value === 'optin';
    document.getElementById('nc').style.display = show ? '' : 'none';
    document.getElementById('btnAddNom').style.display = show ? '' : 'none';
  }

  const TOTAL=8; let cur=1;
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
      bNext.style.background='linear-gradient(100deg,#0d9488,#065f46)';
      updateReview();
    } else { bNext.textContent='Next Step →'; bNext.style.background=''; }
    window.scrollTo({top:0,behavior:'smooth'});
    cur=s;
  }
  bNext.addEventListener('click',()=>{
    if(cur === 1){
      const allChecked = agreementFields.every(n => document.querySelector(`[name="${n}"]`)?.checked);
      if(!allChecked){
        document.getElementById('disclaimerWarning').style.display = 'block';
        document.getElementById('disclaimerWarning').scrollIntoView({behavior:'smooth', block:'center'});
        return;
      }
    }
    if(cur<TOTAL) goTo(cur+1); else alert('Application submitted successfully! Thank you.');
  });
  bPrev.addEventListener('click',()=>{ if(cur>1) goTo(cur-1); });
  pills.forEach(p=>p.addEventListener('click',()=>goTo(+p.dataset.step)));
  document.getElementById('sl').addEventListener('click',()=>stp.scrollBy({left:-160,behavior:'smooth'}));
  document.getElementById('sr').addEventListener('click',()=>stp.scrollBy({left:160,behavior:'smooth'}));

  /* KRA FETCH */
  function kra(pfx){
    const pan=document.querySelector(`[name="${pfx}Pan"]`)?.value;
    if(!pan||pan.length<10){ alert('Please enter a valid 10-digit PAN number first.'); return; }
    const d={ FirstName:'Deepak',MiddleName:'',LastName:'Sharma', KraStatus:'KYC Verified',FatherSpouseName:'Ramesh Sharma',
      Gender:'Male',MaritalStatus:'Married',Nationality:'Indian',ResidentialStatus:'Resident Indian',
      KraMobile:'9876543210',Email:'deepak@example.com',
      CorAddr1:'12, Green Valley',CorAddr2:'Bandra West',CorAddr3:'',
      CorCity:'Mumbai',CorDistrict:'Mumbai',CorPin:'400050',CorState:'Maharashtra',CorCountry:'India',Mobile:'9876543210' };
    Object.entries(d).forEach(([k,v])=>{
      const el=document.querySelector(`[name="${pfx}${k}"]`);
      if(el){ el.value=v; el.style.borderColor='#0d9488'; setTimeout(()=>el.style.borderColor='',2000); }
    });
    alert('✓ KRA data fetched for PAN: '+pan.toUpperCase());
  }

  /* COPY ADDRESS */
  function copyAddr(cb){
    if(!cb.checked) return;
    const m={h1PerAddr1:'h1CorAddr1',h1PerAddr2:'h1CorAddr2',h1PerCity:'h1CorCity',h1PerDistrict:'h1CorDistrict',h1PerPin:'h1CorPin'};
    Object.entries(m).forEach(([to,from])=>{ const s=document.querySelector(`[name="${from}"]`); const d=document.querySelector(`[name="${to}"]`); if(s&&d) d.value=s.value; });
  }

  /* JOINT HOLDER TOGGLE */
  function toggleJH(n){
    const f=document.getElementById('jh'+n); const b=document.getElementById('tJH'+n);
    const open=f.style.display!=='none';
    f.style.display=open?'none':'block';
    b.textContent=open?'+ Add Joint Holder '+n:'− Remove Joint Holder '+n;
    b.classList.toggle('on',!open);
  }

  /* ADD NOMINEE */
  let nomC=1;
  function addNom(){
    if(nomC>=3){ alert('Maximum 3 nominees allowed.'); return; }
    nomC++; const n=nomC;
    const div=document.createElement('div'); div.className='ns';
    div.innerHTML=`<div class="nh"><div class="nt">Nominee ${n}</div><button type="button" onclick="this.closest('.ns').remove();nomC--;" style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:12px;font-weight:600;">✕ Remove</button></div>
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
    <div class="g3">
      <div class="fg s2"><label class="lbl">Address</label><input type="text" class="fc" name="nom${n}Address" placeholder="Full address"/></div>
      <div class="fg"><label class="lbl">ID Proof Type</label><select class="fs" name="nom${n}IdType"><option value="">Select</option><option>PAN</option><option>Aadhaar</option><option>Passport</option></select></div>
    </div>`;
    document.getElementById('nc').appendChild(div);
  }

  /* FILE UPLOAD FEEDBACK */
  function upld(input){
    if(!input.files.length) return;
    const z=input.closest('.uz');
    z.innerHTML=`<input type="file" name="${input.name}" style="display:none" accept="${input.accept}" onchange="upld(this)"/>
      <span style="font-size:22px;display:block;margin-bottom:4px;">✅</span>
      <span style="font-size:12px;font-weight:600;color:#0d9488;">${input.files[0].name}</span>`;
    z.style.borderColor='#0d9488'; z.style.background='#f0fdf4';
    z.onclick=()=>z.querySelector('input').click();
  }

  /* REVIEW */
  function updateReview(){
    const m={rv_product:'product',rv_fundName:'fundName',rv_accountCategory:'accountCategory',rv_feeType:'feeType',rv_investmentType:'investmentType',rv_h1Pan:'h1Pan',rv_h1Dob:'h1Dob',rv_h1Gender:'h1Gender',rv_h1Email:'h1Email',rv_h1OvdType:'h1OvdType',rv_bankName:'bankName',rv_bankAccNo:'bankAccNo',rv_bankIfsc:'bankIfsc',rv_dematType:'dematType',rv_dpName:'dpName',rv_dematClientId:'dematClientId'};
    Object.entries(m).forEach(([id,name])=>{ const el=document.querySelector(`[name="${name}"]`); const rv=document.getElementById(id); if(el&&rv) rv.textContent=el.value||'—'; });
    const fn=document.querySelector('[name="h1FirstName"]')?.value||'';
    const mn=document.querySelector('[name="h1MiddleName"]')?.value||'';
    const ln=document.querySelector('[name="h1LastName"]')?.value||'';
    const ne=document.getElementById('rv_h1Name'); if(ne) ne.textContent=[fn,mn,ln].filter(Boolean).join(' ')||'—';
    const amt=document.querySelector('[name="commitmentAmount"]')?.value;
    const ae=document.getElementById('rv_commitmentAmount'); if(ae&&amt) ae.textContent='₹ '+parseInt(amt).toLocaleString('en-IN');
  }

  goTo(1);
</script>
</body>
</html>