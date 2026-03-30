
(function(){
  const totalSteps = 8;
  const form = document.getElementById('onboardingForm');
  const btnNext = document.getElementById('btnNext');
  const btnPrev = document.getElementById('btnPrev');
  const progressBar = document.getElementById('progressBar');
  const stepIndexLabel = document.getElementById('stepIndexLabel');
  const stepCountLabel = document.getElementById('stepCountLabel');
  const stepper = document.getElementById('stepper');
  const stepPills = Array.from(stepper.querySelectorAll('.step-pill'));
  const stepPanels = Array.from(document.querySelectorAll('.step-panel'));
  const reviewSummary = document.getElementById('reviewSummary');

  const accountHoldersSelect = document.getElementById('accountHoldersCount');
  const holdersContainer = document.getElementById('holdersContainer');
  const numNomineesSelect = document.getElementById('numNominees');
  const nomineesContainer = document.getElementById('nomineeContainer');

  const btnScrollLeft = document.getElementById('stepScrollLeft');
  const btnScrollRight = document.getElementById('stepScrollRight');

  stepCountLabel.textContent = String(totalSteps);
  let currentStep = 1;

  // Accordions
  document.addEventListener('click', (e)=>{
    const head = e.target.closest('[data-toggle="acc"]');
    if(!head) return; head.closest('.app-accordion').classList.toggle('open');
  });

  // Render holders with ALL fields from screenshots
  function holderBlock(i){
    const n=i, s=i===1?'st':i===2?'nd':i===3?'rd':'th';
    return `
    <div class="app-accordion open" data-holder="${n}">
      <div class="app-acc-head" data-toggle="acc"><span class="app-acc-title">${n}${s} Holder</span><span class="app-acc-chevron">▾</span></div>
      <div class="app-acc-body">
        <div class="row g-3">
          <div class="col-md-6"><label for="pan${n}" class="form-label">PAN Number</label><input id="pan${n}" class="form-control text-uppercase" placeholder="ABCDE1234F" required /></div>
          <div class="col-md-6"><label for="dob${n}" class="form-label">Date of Birth</label><input id="dob${n}" class="form-control" placeholder="DD/MM/YYYY" required /></div>
          <div class="col-12"><label class="form-check-label"><input type="checkbox" id="consent${n}" required /> <span class="ms-1">Once you submit, your KYC information (like address, name, contact etc.) will be fetched from NSDL Pan Site & KRA system. Please accept to continue.</span></label><div class="form-error" data-for="consent${n}">Consent required.</div></div>
          <div class="col-12"><button type="button" class="btn btn-kra" data-action="getKra" data-holder="${n}">Get Details</button></div>
          <div class="col-12"><div class="note small-tag">Congratulations, you are KRA compliant. If KRA documents are not valid, we will use uploaded docs for account opening (may need in‑person verification).</div></div>

          <div class="col-md-6"><label for="nameAsPan${n}" class="form-label">Name as per Pan Card</label><input id="nameAsPan${n}" class="form-control" placeholder="As on PAN" required /></div>
          <div class="col-md-6"><label for="ckyc${n}" class="form-label">Enter CKYC Number</label><input id="ckyc${n}" class="form-control" placeholder="14-digit CKYC" /></div>
          <div class="col-12"><label for="panUpload${n}" class="form-label">Upload PAN Card scanned copy — Images should be horizontal</label><input id="panUpload${n}" type="file" class="form-control" accept="image/*,application/pdf" required /></div>

          <div class="col-12"><label class="form-label d-block">Legal Status</label><div class="d-flex flex-wrap gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="legal${n}" id="legal${n}Res" value="Resident Indian" required><label class="form-check-label" for="legal${n}Res">Resident Indian</label></div><div class="form-check"><input class="form-check-input" type="radio" name="legal${n}" id="legal${n}Fr" value="Foreign National Residing in India"><label class="form-check-label" for="legal${n}Fr">Foreign National Residing in India</label></div></div></div>
          <div class="col-12"><label class="form-label d-block">Gender</label><div class="d-flex flex-wrap gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="gender${n}" id="gender${n}M" value="Male" required><label class="form-check-label" for="gender${n}M">Male</label></div><div class="form-check"><input class="form-check-input" type="radio" name="gender${n}" id="gender${n}F" value="Female"><label class="form-check-label" for="gender${n}F">Female</label></div><div class="form-check"><input class="form-check-input" type="radio" name="gender${n}" id="gender${n}O" value="Others"><label class="form-check-label" for="gender${n}O">Others</label></div></div></div>
          <div class="col-12"><label class="form-label d-block">Marital Status</label><div class="d-flex flex-wrap gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="marital${n}" id="marital${n}M" value="Married" required><label class="form-check-label" for="marital${n}M">Married</label></div><div class="form-check"><input class="form-check-input" type="radio" name="marital${n}" id="marital${n}U" value="Unmarried"><label class="form-check-label" for="marital${n}U">Unmarried</label></div><div class="form-check"><input class="form-check-input" type="radio" name="marital${n}" id="marital${n}O" value="Others"><label class="form-check-label" for="marital${n}O">Others</label></div></div></div>

          <div class="col-md-4"><label for="cob${n}" class="form-label">Country of Birth</label><input id="cob${n}" class="form-control" placeholder="Country" required /></div>
          <div class="col-md-4"><label for="pob${n}" class="form-label">Place of Birth</label><input id="pob${n}" class="form-control" placeholder="City / Town" /></div>
          <div class="col-md-4"><label for="nationality${n}" class="form-label">Nationality</label><input id="nationality${n}" class="form-control" placeholder="Nationality" required /></div>
          <div class="col-md-6"><label for="mother${n}" class="form-label">Mother Name</label><input id="mother${n}" class="form-control" placeholder="Mother's full name" /></div>
          <div class="col-md-6"><label for="father${n}" class="form-label">Father Name</label><input id="father${n}" class="form-control" placeholder="Father's full name" /></div>

          <div class="col-md-6"><label for="contact${n}" class="form-label">Contact Number</label><input id="contact${n}" class="form-control" placeholder="10-digit" minlength="10" maxlength="10" required /></div>
          <div class="col-md-6"><label class="form-label d-block">Contact Number Belongs to</label><div class="d-flex flex-wrap gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="contactBelongs${n}" value="Me" required><label class="form-check-label">Me</label></div><div class="form-check"><input class="form-check-input" type="radio" name="contactBelongs${n}" value="My spouse"><label class="form-check-label">My spouse</label></div><div class="form-check"><input class="form-check-input" type="radio" name="contactBelongs${n}" value="Dependent children"><label class="form-check-label">Dependent children</label></div><div class="form-check"><input class="form-check-input" type="radio" name="contactBelongs${n}" value="Dependent parents"><label class="form-check-label">Dependent parents</label></div></div></div>

          <div class="col-md-6"><label for="email${n}" class="form-label">Email Address</label><input id="email${n}" type="email" class="form-control" placeholder="email@example.com" required /></div>
          <div class="col-md-6"><label class="form-label d-block">Email Address Belongs to</label><div class="d-flex flex-wrap gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="emailBelongs${n}" value="Me" required><label class="form-check-label">Me</label></div><div class="form-check"><input class="form-check-input" type="radio" name="emailBelongs${n}" value="My spouse"><label class="form-check-label">My spouse</label></div><div class="form-check"><input class="form-check-input" type="radio" name="emailBelongs${n}" value="Dependent children"><label class="form-check-label">Dependent children</label></div><div class="form-check"><input class="form-check-input" type="radio" name="emailBelongs${n}" value="Dependent parents"><label class="form-check-label">Dependent parents</label></div></div></div>

          <div class="col-md-6"><label class="form-label d-block">Edu Qualifications</label><div class="d-flex flex-wrap gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="edu${n}" value="Non-Graduate" required><label class="form-check-label">Non‑Graduate</label></div><div class="form-check"><input class="form-check-input" type="radio" name="edu${n}" value="Graduate"><label class="form-check-label">Graduate</label></div><div class="form-check"><input class="form-check-input" type="radio" name="edu${n}" value="Post Graduate"><label class="form-check-label">Post Graduate</label></div><div class="form-check"><input class="form-check-input" type="radio" name="edu${n}" value="Others"><label class="form-check-label">Others</label></div></div></div>
          <div class="col-md-6"><label for="occupation${n}" class="form-label">Occupation</label><select id="occupation${n}" class="form-select" required><option value="">Select</option><option>Service</option><option>Business</option><option>Professional</option><option>Student</option><option>Retired</option><option>Homemaker</option><option>Others</option></select></div>
          <div class="col-md-6"><label for="employer${n}" class="form-label">Name of Employer / Business / Entity</label><input id="employer${n}" class="form-control" placeholder="Organisation name" /></div>
          <div class="col-md-6"><label for="profile${n}" class="form-label">Profile / Nature of Employer / Business</label><input id="profile${n}" class="form-control" placeholder="Brief profile" /></div>
          <div class="col-md-6"><label for="designation${n}" class="form-label">Designation / Job Title</label><input id="designation${n}" class="form-control" placeholder="Job title" /></div>

          <div class="col-12"><label class="form-label d-block">Gross Annual Income</label>
            <div class="d-flex flex-wrap gap-3">
              <div class="form-check"><input class="form-check-input" type="radio" name="income${n}" value="<1 Lakh" required><label class="form-check-label">< 1 Lakhs</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="income${n}" value="1-5 Lakhs"><label class="form-check-label">1 - 5 Lakhs</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="income${n}" value="5-10 Lakhs"><label class="form-check-label">5 - 10 Lakhs</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="income${n}" value="10-25 Lakhs"><label class="form-check-label">10 - 25 Lakhs</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="income${n}" value="25L-1C"><label class="form-check-label">25 Lakhs - 1 Crore</label></div>
              <div class="form-check"><input class="form-check-input" type="radio" name="income${n}" value=">1 Crore"><label class="form-check-label">> 1 Crore</label></div>
            </div>
          </div>
          <div class="col-12"><label for="sof${n}" class="form-label">Details of Source Of Fund</label><input id="sof${n}" class="form-control" placeholder="e.g., Salary, Business income, Capital gains, Others" /></div>
          <div class="col-md-6"><label for="networth${n}" class="form-label">Net Worth (Last 1 year)</label><input id="networth${n}" class="form-control" placeholder="Amount in ₹" /></div>
          <div class="col-md-6"><label for="nwdate${n}" class="form-label">Net Worth Date</label><input id="nwdate${n}" class="form-control" placeholder="DD/MM/YYYY" /></div>
          <div class="col-md-6"><label for="proposed${n}" class="form-label">Proposed Quantum of Investment (₹)</label><input id="proposed${n}" class="form-control" placeholder="Please fill" /></div>

          <div class="col-12"><label class="form-label d-block">PEP (Politically Exposed Person)</label>
            <div class="d-flex flex-wrap gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="pep${n}" value="PEP" required><label class="form-check-label">Politically Exposed Person</label></div><div class="form-check"><input class="form-check-input" type="radio" name="pep${n}" value="Relative of PEP"><label class="form-check-label">Relative of Politically exposed Person</label></div><div class="form-check"><input class="form-check-input" type="radio" name="pep${n}" value="Not Applicable"><label class="form-check-label">Not Applicable</label></div></div>
          </div>

          <div class="col-md-6"><label class="form-label d-block">Are you a tax resident of any country other than India?</label>
            <div class="d-flex gap-3"><div class="form-check"><input class="form-check-input" type="radio" name="taxres${n}" value="Yes" required><label class="form-check-label">Yes</label></div><div class="form-check"><input class="form-check-input" type="radio" name="taxres${n}" value="No"><label class="form-check-label">No</label></div></div>
          </div>
          <div class="col-md-6"><label for="gst${n}" class="form-label">GST Number (if not applicable add "NA")</label><input id="gst${n}" class="form-control" placeholder="GST or NA" /></div>

          <!-- KYC & Address Proofs -->
          <div class="col-12"><hr class="section-divider" /></div>
          <div class="col-12"><div class="panel-title mb-2">KYC & Address Proofs</div></div>
          <div class="col-12"><label for="bankProof${n}" class="form-label">Upload Bank Proof of the Account Holder (Cancelled Cheque / Bank Statement with IFSC Code) — Images should be horizontal</label><input id="bankProof${n}" type="file" class="form-control" accept="image/*,application/pdf" /></div>
          <div class="col-md-6"><label for="resProofType${n}" class="form-label">Residence Address Proof Document Type</label><select id="resProofType${n}" class="form-select"><option value="">Select</option><option>Aadhaar Card</option><option>Passport</option><option>Driving Licence</option><option>Electricity Bill</option><option>Bank Statement</option></select></div>
          <div class="col-md-6"><label for="resProofFile${n}" class="form-label">Upload scanned Residence Address proof — Images should be horizontal</label><input id="resProofFile${n}" type="file" class="form-control" accept="image/*,application/pdf" /></div>
          <div class="col-md-4"><label for="idDocNum${n}" class="form-label">Proof of Identity Document Number</label><input id="idDocNum${n}" class="form-control" placeholder="Document Number" /></div>
          <div class="col-md-4"><label for="idDocExp${n}" class="form-label">Proof of Identity Document Expiry</label><input id="idDocExp${n}" class="form-control" placeholder="DD/MM/YYYY" /></div>
          <div class="col-md-4"><label for="idDocName${n}" class="form-label">Name as per ID Proof Document</label><input id="idDocName${n}" class="form-control" placeholder="As per ID" /></div>
        </div>
      </div>
    </div>`;
  }

  function renderHolders(count){
    holdersContainer.innerHTML='';
    const n = Number(count||0); if(!n) return;
    for(let i=1;i<=n;i++){ holdersContainer.insertAdjacentHTML('beforeend', holderBlock(i)); }
  }

  if(accountHoldersSelect){ accountHoldersSelect.addEventListener('change', (e)=> renderHolders(e.target.value)); }

  // Dynamic nominees (simple)
  function renderNominees(count){
    if(!nomineesContainer) return; nomineesContainer.innerHTML='';
    const n = Number(count||0); if(!n) return;
    for(let i=1;i<=n;i++){
      const block = document.createElement('div');
      block.className='mb-3';
      block.innerHTML = `
        <div class="panel-title mb-2">${i} Nominee</div>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label" for="nom${i}Name">Nominee Name</label><input class="form-control" id="nom${i}Name" placeholder="Nominee full name" required /></div>
          <div class="col-md-3"><label class="form-label" for="nom${i}Dob">Nominee Date of Birth</label><input class="form-control" id="nom${i}Dob" placeholder="DD/MM/YYYY" required /></div>
          <div class="col-md-3"><label class="form-label" for="nom${i}Share">Nominee % Share</label><input class="form-control" id="nom${i}Share" type="number" min="0" max="100" placeholder="e.g. ${i===1?'100':''}" required /></div>
          <div class="col-md-6"><label class="form-label" for="nom${i}Rel">Relationship with 1st Applicant(s)</label><input class="form-control" id="nom${i}Rel" placeholder="Relationship" /></div>
          <div class="col-md-6"><label class="form-label" for="nom${i}Email">Nominee Email Address</label><input class="form-control" id="nom${i}Email" type="email" placeholder="name@example.com" /></div>
        </div>`;
      nomineesContainer.appendChild(block);
    }
  }
  if(numNomineesSelect){ numNomineesSelect.addEventListener('change', (e)=> renderNominees(e.target.value)); }

  // STEP NAVIGATION
  function setStep(step){
    currentStep = Math.min(Math.max(step,1), totalSteps);
    stepPanels.forEach(p=> p.classList.toggle('active', Number(p.dataset.step)===currentStep));
    stepPills.forEach(p=>{ const idx=Number(p.dataset.step); p.classList.toggle('active', idx===currentStep); p.classList.toggle('completed', idx<currentStep); p.classList.toggle('disabled', idx>currentStep); });
    stepIndexLabel.textContent = String(currentStep);
    btnPrev.disabled = currentStep===1;
    btnNext.textContent = currentStep===totalSteps ? 'Submit Application' : 'Next Step';
    const ratio = (currentStep-1)/(totalSteps-1||1); progressBar.style.width = `${Math.round(ratio*100)}%`;
    if(currentStep===totalSteps){ buildSummary(); }
  }

  btnNext.addEventListener('click', (e)=>{ if(currentStep<totalSteps){ e.preventDefault(); if(!validateStep(currentStep)) return; setStep(currentStep+1); }});
  btnPrev.addEventListener('click', ()=>{ if(currentStep>1) setStep(currentStep-1); });
  stepPills.forEach(p=> p.addEventListener('click', ()=>{ const s=Number(p.dataset.step); if(s>currentStep) return; setStep(s); }));
  if(btnScrollLeft && btnScrollRight){ btnScrollLeft.addEventListener('click',()=> stepper.scrollBy({left:-150, behavior:'smooth'})); btnScrollRight.addEventListener('click',()=> stepper.scrollBy({left:150, behavior:'smooth'})); }

  // VALIDATION (lean)
  function clearErrorsForStep(step){ const panel = stepPanels.find(p=>Number(p.dataset.step)===step); if(!panel) return; panel.querySelectorAll('.is-invalid').forEach(el=>el.classList.remove('is-invalid')); panel.querySelectorAll('.form-error').forEach(el=> el.style.display='none'); }
  function showFieldError(input){ input.classList.add('is-invalid'); const id=input.id||input.name; if(!id) return; const err=form.querySelector(`.form-error[data-for="${id}"]`); if(err) err.style.display='block'; }
  function validateStep(step){
    clearErrorsForStep(step); const panel = stepPanels.find(p=>Number(p.dataset.step)===step); if(!panel) return true; let valid=true;
    const required = Array.from(panel.querySelectorAll('input[required], select[required], textarea[required]'));
    required.forEach(input=>{
      const type=input.type; const value=(input.value||'').trim();
      if(type==='checkbox'){ if(!input.checked){ valid=false; showFieldError(input);} return; }
      if(type==='radio'){
        const name=input.name; if(!name) return; const group=panel.querySelectorAll(`input[type=radio][name="${name}"]`); if(!Array.from(group).some(r=>r.checked)){ valid=false; showFieldError(input);} return; }
      if(type==='file'){ if(!input.files||!input.files.length){ valid=false; showFieldError(input);} return; }
      if(!value){ valid=false; showFieldError(input); return; }
      if(input.id.toLowerCase().includes('pan')){ const re=/^[A-Z]{5}[0-9]{4}[A-Z]$/; if(!re.test(value.toUpperCase())){ valid=false; showFieldError(input);} }
      if(input.id.toLowerCase().includes('contact')){ if(!/^\d{10}$/.test(value)){ valid=false; showFieldError(input);} }
      if(input.type==='email'){ const ee=/^[^\s@]+@[^\s@]+\.[^\s@]+$/; if(!ee.test(value)){ valid=false; showFieldError(input);} }
    });
    return valid;
  }
  Array.from(form.elements).forEach(el=>{ if(!(el instanceof HTMLElement)) return; el.addEventListener('input', ()=>{ el.classList.remove('is-invalid'); const id=el.id||el.name; if(!id) return; const err=form.querySelector(`.form-error[data-for="${id}"]`); if(err) err.style.display='none'; }); });

  // REVIEW SUMMARY
  function buildSummary(){ if(!reviewSummary) return; const v=(id)=>{ const el=document.getElementById(id); if(!el) return ''; if(el.tagName==='SELECT') return el.value||''; return el.value||''; };
    const sections=[
      {title:'Sign Up', rows:[["Mobile Number", v('signupMobile')],["Email Address", v('signupEmail')]]},
      {title:'Account', rows:[["Account Type", v('accountType')],["Strategy", v('portfolioName')],["Investment Type", v('investmentType')],["Holders", v('accountHoldersCount')]]},
      {title:'Application', rows:[["Nominees", v('numNominees')],["Negative Securities", (function(){ const el=form.querySelector('input[name="negativeSecurities"]:checked'); return el?el.value:''; })()]]},
    ];
    const container=document.createElement('div');
    sections.forEach(sec=>{ const has=sec.rows.some(([,value])=>value); if(!has) return; const block=document.createElement('div'); block.className='mb-3 pb-2'; block.style.borderBottom='1px dashed rgba(148,163,184,.6)'; const t=document.createElement('h6'); t.textContent=sec.title; t.style.fontSize='13px'; t.style.fontWeight='600'; t.style.marginBottom='6px'; block.appendChild(t); sec.rows.forEach(([label,value])=>{ if(!value) return; const line=document.createElement('div'); line.className='d-flex justify-content-between mb-1'; const l=document.createElement('span'); l.className='text-muted'; l.textContent=label; const r=document.createElement('span'); r.textContent=value; line.appendChild(l); line.appendChild(r); block.appendChild(line); }); container.appendChild(block); });
    reviewSummary.innerHTML=''; reviewSummary.appendChild(container);
  }

  // INIT
  setStep(1);
})();
