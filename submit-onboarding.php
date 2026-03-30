<?php
session_start();
require_once 'includes/onboarding-functions.php';

// CSRF validation
if(!isset($_POST['form_token']) || !validateFormToken($_POST['form_token'])) {
    die('Invalid form submission');
}

$action = $_POST['action'] ?? '';
$current_step = $_POST['current_step'] ?? 1;

// Basic form data save
foreach($_POST as $key => $value) {
    if(!in_array($key, ['action', 'form_token', 'current_step', 'btnNext', 'btnSubmit'])) {
        $_SESSION['form_data'][$key] = $value;
    }
}

// File upload directory
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Handle file uploads
$file_fields = ['wetSignature', 'residenceProofFile', 'bankProofFile'];
foreach($file_fields as $field) {
    if(isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
        $filename = $field . '_' . time() . '.' . $ext;
        move_uploaded_file($_FILES[$field]['tmp_name'], $upload_dir . $filename);
        $_SESSION['form_data'][$field . '_path'] = $filename;
    }
}

// Handle photo data from canvas
if(!empty($_POST['photo1_data'])) {
    $photo_data = $_POST['photo1_data'];
    $photo_data = str_replace('data:image/png;base64,', '', $photo_data);
    $photo_data = str_replace(' ', '+', $photo_data);
    $photo_data = base64_decode($photo_data);
    
    $filename = 'photo1_' . time() . '.png';
    file_put_contents($upload_dir . $filename, $photo_data);
    $_SESSION['form_data']['photo1_path'] = $filename;
}

if(!empty($_POST['photo2_data'])) {
    $photo_data = $_POST['photo2_data'];
    $photo_data = str_replace('data:image/png;base64,', '', $photo_data);
    $photo_data = str_replace(' ', '+', $photo_data);
    $photo_data = base64_decode($photo_data);
    
    $filename = 'photo2_' . time() . '.png';
    file_put_contents($upload_dir . $filename, $photo_data);
    $_SESSION['form_data']['photo2_path'] = $filename;
}

if($action === 'submit_form' || isset($_POST['btnSubmit'])) {
    // Final submission logic
    $_SESSION['form_submitted'] = true;
    
    // Yahan database mein save kar sakte ho
    // mail send kar sakte ho
    
    // Clear form token
    unset($_SESSION['form_token']);
    
    header('Location: index.php?submitted=1');
    exit;
} else {
    // Next step
    $next_step = $current_step + 1;
    if($next_step <= 8) {
        $_SESSION['current_step'] = $next_step;
        header('Location: index.php?step=' . $next_step);
    } else {
        header('Location: index.php?step=8');
    }
    exit;
}
?>