<?php
/**
 * Private Message - Locked Group & Request System
 * Converted from HTML to PHP
 */
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title id="app-title">Private Message (লকড গ্রুপ ও রিকোয়েস্ট সিস্টেম)</title>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #00a884;
            --primary-gradient: linear-gradient(135deg, #00a884 0%, #005c4b 100%);
            --send-btn-color: #00a884;
            --bg-color: #efeae2;
            --card-bg: #ffffff;
            --text-color: #111b21;
            --secondary-text: #667781;
            --chat-bubble-sent: #d9fdd3;
            --chat-bubble-recv: #ffffff;
            --header-bg: #00a884;
        }

        body {
            box-sizing: border-box; margin: 0; padding: 0; font-family: 'Hind Siliguri', sans-serif;
            background-color: var(--bg-color); color: var(--text-color); display: flex; justify-content: center;
            -webkit-touch-callout: none; -webkit-user-select: none; user-select: none;
            overflow: hidden; 
            overscroll-behavior-x: none; 
            position: fixed; width: 100%; height: 100%;
        }

        input, textarea, select {
            -webkit-user-select: text !important; user-select: text !important;
        }

        /* ডাউনলোড এবং কপি প্রটেকশনের জন্য CSS ক্লাস */
        .no-download {
            -webkit-touch-callout: none !important;
            -webkit-user-select: none !important;
            user-select: none !important;
            pointer-events: auto;
        }
        
        .no-download img {
            pointer-events: none;
            -webkit-touch-callout: none;
        }

        .app-wrapper {
            width: 100%; max-width: 480px; height: 100vh; height: 100dvh;
            background: var(--bg-color); display: flex; flex-direction: column;
            position: relative; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden;
            overscroll-behavior-x: none;
        }

        #splash-screen {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: #ffffff; display: flex; flex-direction: column;
            align-items: center; justify-content: center; z-index: 9999;
            transition: opacity 0.5s ease;
        }
        .splash-logo {
            width: 110px; height: 110px; border-radius: 50%; object-fit: cover;
            box-shadow: 0 4px 15px rgba(0,168,132,0.3); animation: pulseLogo 1.5s infinite alternate;
        }
        @keyframes pulseLogo {
            0% { transform: scale(0.95); opacity: 0.8; }
            100% { transform: scale(1.05); opacity: 1; }
        }
        .splash-title {
            margin-top: 15px; font-size: 18px; font-weight: 700; color: var(--primary-color);
        }
        .splash-loader {
            margin-top: 20px; width: 30px; height: 30px; border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color); border-radius: 50%;
            animation: spinLoader 1s linear infinite;
        }
        @keyframes spinLoader {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #auth-page {
            display: flex; flex-direction: column; align-items: center; justify-content: flex-start;
            min-height: 100vh; padding: 20px 25px 40px 25px; text-align: center; overflow-y: auto; 
            background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%); box-sizing: border-box;
            overscroll-behavior-x: none;
        }
        
        .brand-logo-container {
            width: 65px; height: 65px; border-radius: 50%; object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 168, 132, 0.4); border: 2px solid #fff;
            margin-bottom: 4px; display: inline-block;
        }

        .auth-card {
            width: 100%; background: #fff; padding: 20px; border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 168, 132, 0.12); margin-top: 10px; margin-bottom: 20px;
            border: 1px solid rgba(0, 168, 132, 0.2);
        }
        .form-group { text-align: left; margin-bottom: 12px; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 5px; color: #334155; }
        .form-group input {
            width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 10px;
            outline: none; font-size: 14px; box-sizing: border-box; font-family: inherit;
            transition: all 0.3s; background: #f8fafc;
        }
        .form-group input:focus {
            border-color: var(--primary-color); background: #fff;
            box-shadow: 0 0 0 3px rgba(0, 168, 132, 0.15);
        }
        .btn-primary {
            width: 100%; padding: 12px; background: var(--primary-gradient); color: #fff;
            border: none; border-radius: 10px; font-weight: bold; font-size: 15px; cursor: pointer; margin-top: 10px;
            box-shadow: 0 4px 12px rgba(0, 168, 132, 0.3); transition: transform 0.1s;
        }
        .btn-primary:active { transform: scale(0.98); }

        .divider { display: flex; align-items: center; margin: 15px 0; color: #94a3b8; font-size: 13px; font-weight: 500; }
        .divider::before, .divider::after { content: ""; flex: 1; border-bottom: 1.5px solid #e2e8f0; }
        .divider::before { margin-right: 10px; }
        .divider::after { margin-left: 10px; }

        .google-btn {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            background: #fff; border: 1.5px solid #cbd5e1; padding: 11px;
            border-radius: 28px; font-weight: bold; cursor: pointer; color: #334155;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05); width: 100%; transition: background 0.2s;
        }
        .google-btn:hover { background: #f8fafc; }

        .toggle-text { font-size: 13px; margin-top: 15px; color: #64748b; }
        .toggle-text span:last-child { color: var(--primary-color); cursor: pointer; font-weight: bold; text-decoration: underline; }

        .header { padding: 12px 15px; background: var(--header-bg); color: white; display: flex; align-items: center; justify-content: space-between; }
        .search-bar { padding: 8px 12px; background: #fff; border-bottom: 1px solid #eee; display: flex; gap: 8px; align-items: center;}
        .search-bar input {
            flex: 1; padding: 8px 15px; border-radius: 20px; border: none;
            outline: none; background: #f0f2f5; box-sizing: border-box; font-size: 14px;
        }
        .create-group-btn { background: #005c4b; color: #fff; border: none; padding: 7px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; cursor: pointer; white-space: nowrap; }

        .content-area { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 6px; padding-bottom: 90px; overscroll-behavior-x: none; }
        .user-item {
            display: flex; align-items: center; gap: 12px; padding: 10px 12px; background: #fff;
            border-radius: 8px; cursor: pointer; transition: 0.2s; position: relative; margin-bottom: 4px;
        }
        .user-item:hover { background: #f2f2f2; }
        .avatar-container { position: relative; display: inline-block; cursor: pointer; }
        .avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
        
        .status-dot {
            position: absolute; bottom: 2px; right: 2px; width: 12px; height: 12px;
            border-radius: 50%; border: 2px solid #fff; background: #ccc;
        }
        .status-dot.online { background: #31a24c; }

        .user-info { flex: 1; border-bottom: 1px solid #f0f2f5; padding-bottom: 6px; }
        .user-info h4 { margin: 0 0 2px 0; font-size: 16px; font-weight: 500; }
        .user-info p { margin: 0; font-size: 13px; color: var(--secondary-text); }

        #chat-screen {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: var(--bg-color); display: none; flex-direction: column; z-index: 10;
            overflow: hidden; overscroll-behavior-x: none;
        }
        .chat-header { padding: 8px 12px; background: var(--header-bg); color: #fff; display: flex; align-items: center; gap: 8px; z-index: 15; }
        .back-btn { background: none; border: none; font-size: 18px; color: white; cursor: pointer; padding: 0; }
        
        .chat-body { 
            flex: 1; padding: 15px; overflow-y: auto; overflow-x: hidden; display: flex; 
            flex-direction: column; gap: 8px; padding-bottom: 85px; 
            background-image: radial-gradient(#d1d7db 0.75px, transparent 0.75px);
            background-size: 24px 24px;
            overscroll-behavior-x: none;
        }

        .msg-row { display: flex; flex-direction: column; margin-bottom: 2px; position: relative; }
        .msg-row.sent { align-items: flex-end; }
        .msg-row.recv { align-items: flex-start; }

        .msg-bubble-wrapper { display: flex; align-items: flex-end; gap: 4px; max-width: 82%; position: relative; }
        .msg { padding: 8px 12px; border-radius: 7.5px; font-size: 14.5px; word-break: break-word; position: relative; box-shadow: 0 1px 0.5px rgba(0,0,0,0.13); }
        .sent .msg { background: var(--chat-bubble-sent); color: #111b21; border-top-right-radius: 0; }
        .recv .msg { background: var(--chat-bubble-recv); color: #111b21; border-top-left-radius: 0; }
        
        .msg img { max-width: 100%; border-radius: 6px; margin-top: 4px; display: block; cursor: pointer; }
        .msg video { max-width: 100%; max-height: 220px; border-radius: 6px; margin-top: 4px; display: block; }
        .msg audio { max-width: 200px; height: 35px; margin-top: 4px; }

        .msg-meta { display: flex; align-items: center; gap: 3px; font-size: 10px; color: #667781; float: right; margin-top: 4px; margin-left: 6px; }

        .msg-context-menu {
            position: absolute; background: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: none; z-index: 1000; overflow: hidden; font-size: 13px; font-weight: 600;
        }
        .msg-context-menu div { padding: 10px 18px; cursor: pointer; color: #e74c3c; border-bottom: 1px solid #f0f2f5; }
        .msg-context-menu div:hover { background: #f8f9fa; }

        .chat-input-area { 
            position: absolute; bottom: max(8px, env(safe-area-inset-bottom));
            left: 8px; right: 8px; display: flex; align-items: center; gap: 6px; background: transparent; z-index: 99; box-sizing: border-box;
        }
        .input-pill-box {
            flex: 1; display: flex; align-items: center; background: #ffffff;
            border-radius: 24px; padding: 6px 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); gap: 8px; min-width: 0;
        }
        .input-pill-box input[type="text"] { 
            flex: 1; min-width: 0; padding: 6px 0; border: none; outline: none; background: transparent; font-size: 15px; color: #111b21;
        }
        .icon-btn { background: none; border: none; font-size: 20px; cursor: pointer; color: #54656f; padding: 0; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .send-btn { 
            background: var(--send-btn-color); color: #fff; border: none; width: 45px; height: 45px;
            border-radius: 50%; cursor: pointer; font-size: 18px; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.2); flex-shrink: 0;
        }

        .settings-group { padding: 15px; display: flex; flex-direction: column; gap: 12px; align-items: center; background: #fff; height: 100%; overflow-y: auto; overflow-x: hidden; box-sizing: border-box; overscroll-behavior-x: none; }
        
        .profile-container-edit { position: relative; cursor: pointer; display: inline-block; }
        .profile-preview { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary-color); display: block; }
        .profile-edit-overlay {
            position: absolute; bottom: 0; right: 0; background: var(--primary-color); color: #fff;
            width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 14px; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .settings-group label { align-self: flex-start; font-weight: bold; font-size: 13px; margin-bottom: -6px; }
        .settings-group input[type="text"], .settings-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-family: inherit; font-size: 14px; }
        .save-btn { width: 100%; padding: 11px; background: var(--primary-color); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .logout-btn { width: 100%; padding: 11px; background: #e74c3c; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .setting-card-item { width: 100%; display: flex; justify-content: space-between; align-items: center; background: #f9f9f9; padding: 10px 12px; border-radius: 8px; border: 1px solid #eee; font-size: 13px; font-weight: 600; }

        .bottom-nav { 
            position: absolute; bottom: 0; left: 0; right: 0; width: 100%; height: 58px; 
            display: flex; justify-content: space-around; align-items: center; background: #ffffff; 
            border-top: 1px solid #e2e8f0; z-index: 5; padding-bottom: env(safe-area-inset-bottom);
        }
        .nav-item { border: none; background: none; font-size: 20px; color: #54656f; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 2px; font-size: 11px; font-weight: 600; }
        .nav-item span.nav-icon { font-size: 20px; }
        .nav-item.active { color: var(--primary-color); }

        #image-viewer-modal {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.92); display: none; justify-content: center; align-items: center; z-index: 1000; flex-direction: column; padding: 20px; box-sizing: border-box;
            -webkit-touch-callout: none; -webkit-user-select: none; user-select: none;
        }
        #image-viewer-modal img { 
            max-width: 95%; max-height: 55%; border-radius: 8px; object-fit: contain; 
            pointer-events: none;
            -webkit-touch-callout: none;
        }
        #image-viewer-close { position: absolute; top: 20px; right: 20px; color: #fff; font-size: 28px; cursor: pointer; font-weight: bold; background: none; border: none; z-index: 1001; }

        .panel-box { padding: 15px; background: #fff; border-radius: 8px; margin-bottom: 10px; border: 1px solid #e2e8f0; }
        
        .sticker-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px; padding: 10px 0; max-height: 250px; overflow-y: auto; }
        .sticker-item { font-size: 26px; cursor: pointer; text-align: center; padding: 6px; background: #f0f2f5; border-radius: 8px; transition: 0.1s; }
        .sticker-item:active { transform: scale(0.9); background: #e2e8f0; }

        .story-container { display: flex; gap: 12px; overflow-x: auto; overflow-y: hidden; padding: 10px; background: #fff; margin-bottom: 10px; border-radius: 8px; align-items: center; overscroll-behavior-x: none; }
        .story-circle { display: flex; flex-direction: column; align-items: center; gap: 4px; cursor: pointer; flex-shrink: 0; }
        .story-ring { width: 62px; height: 62px; border-radius: 50%; border: 3px solid var(--primary-color); padding: 2px; display: flex; align-items: center; justify-content: center; background: #fff; }
        .story-ring img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; pointer-events: none; }
        .story-circle span { font-size: 11px; max-width: 65px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; text-align: center; }
        .add-story-ring { border: 3px dashed #ccc; color: #00a884; font-size: 24px; font-weight: bold; background: #f9f9f9; }
    </style>
</head>
<body oncontextmenu="return false;">

<div class="app-wrapper">

    <!-- স্প্ল্যাশ স্ক্রিন -->
    <div id="splash-screen">
        <img src="https://i.ibb.co/FqnNRtgQ/1000106655.png" class="splash-logo" alt="Logo">
        <div class="splash-title">Private Message</div>
        <div class="splash-loader"></div>
    </div>

    <!-- লগইন ও সাইনআপ পেজ -->
    <div id="auth-page" style="display: none;">
        <div style="margin-top: 10px;">
            <img src="https://i.ibb.co/FqnNRtgQ/1000106655.png" class="brand-logo-container" alt="Brand Logo">
        </div>
        <h2 style="margin: 5px 0 2px 0; color: #0f766e; font-size: 22px;">Private Message</h2>
        <p id="t-auth-subtitle" style="color: #475569; margin-top: 0; margin-bottom: 15px; font-size: 13px; font-weight: 500;">নিরাপদ চ্যাট, গ্রুপ এবং স্টোরি সিস্টেম</p>

        <!-- লগইন বক্স -->
        <div class="auth-card" id="login-box">
            <h3 id="t-login-title" style="margin-bottom: 15px; margin-top: 0; color: #1e293b; font-size: 18px;">লগইন করুন</h3>
            <div class="form-group">
                <label id="t-email-label">ইমেইল:</label>
                <input type="email" id="login-email" placeholder="আপনার আসল ইমেইল দিন">
            </div>
            <div class="form-group">
                <label id="t-pass-label">পাসওয়ার্ড:</label>
                <input type="password" id="login-password" placeholder="পাসওয়ার্ড দিন">
            </div>
            <button class="btn-primary" id="email-login-btn">লগইন</button>

            <div class="divider" id="t-or">অথবা</div>

            <button class="google-btn" id="google-login">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" width="18">
                <span id="t-google-btn">গুগল দিয়ে প্রবেশ করুন</span>
            </button>

            <div class="toggle-text">
                <span id="t-no-acc">অ্যাকাউন্ট নেই? </span> <span onclick="toggleAuthForms('register')" id="t-reg-link">নতুন রেজিস্ট্রেশন করুন</span>
            </div>
        </div>

        <!-- রেজিস্ট্রেশন বক্স -->
        <div class="auth-card" id="register-box" style="display: none;">
            <h3 id="t-reg-title" style="margin-bottom: 15px; margin-top: 0; color: #1e293b; font-size: 18px;">নতুন অ্যাকাউন্ট</h3>
            <div class="form-group">
                <label id="t-name-label">আপনার নাম:</label>
                <input type="text" id="reg-name" placeholder="পুরো নাম">
            </div>
            <div class="form-group">
                <label id="t-orig-email-label">অরজিনাল ইমেইল:</label>
                <input type="email" id="reg-email" placeholder="যেটিতে ভেরিফিকেশন লিংক যাবে">
            </div>
            <div class="form-group">
                <label id="t-reg-pass-label">পাসওয়ার্ড:</label>
                <input type="password" id="reg-password" placeholder="কমপক্ষে ৬ ডিজিট">
            </div>
            <button class="btn-primary" id="email-reg-btn">রেজিস্ট্রেশন ও ভেরিফিকেশন পাঠান</button>

            <div class="toggle-text">
                <span id="t-has-acc">আগে থেকেই অ্যাকাউন্ট আছে? </span> <span onclick="toggleAuthForms('login')" id="t-login-link">লগইন করুন</span>
            </div>
        </div>
    </div>

    <!-- মেইন অ্যাপ ইন্টারফেস -->
    <div id="main-app" style="display:none; flex-direction:column; height:100%; position:relative;">
        <div class="header">
            <h2 id="page-title" style="margin:0; font-size:20px;">Chats</h2>
            <div style="display: flex; align-items: center; gap: 10px;">
                <span id="my-user-id" style="font-size: 11px; background: rgba(0,0,0,0.15); padding: 3px 6px; border-radius: 6px;">ID: ...</span>
            </div>
        </div>

        <div class="search-bar" id="search-container">
            <input type="text" id="search-input" placeholder="ইউজার বা গ্রুপ খুঁজুন...">
            <button class="create-group-btn" id="t-create-group-btn" onclick="openCreateGroupModal()">➕ গ্রুপ</button>
        </div>

        <div class="content-area" id="main-content" onclick="hideGlobalContextMenu()"></div>

        <div class="bottom-nav">
            <button class="nav-item active" id="tab-btn-chats" onclick="switchTab('chats')">
                <span class="nav-icon">💬</span><span id="t-nav-chats">Chats</span>
            </button>
            <button class="nav-item" id="tab-btn-updates" onclick="switchTab('updates')">
                <span class="nav-icon">⭕</span><span id="t-nav-updates">Updates</span>
            </button>
            <button class="nav-item" id="tab-btn-communities" onclick="switchTab('communities')">
                <span class="nav-icon">👥</span><span id="t-nav-communities">Communities</span>
            </button>
            <button class="nav-item" id="tab-btn-settings" onclick="switchTab('settings')">
                <span class="nav-icon">⚙️</span><span id="t-nav-settings">Settings</span>
            </button>
        </div>
    </div>

    <!-- মডাল উইন্ডোজ -->
    <div class="modal-overlay" id="story-upload-modal" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:500;">
        <div style="width:90%; max-width:340px; background:#fff; border-radius:12px; padding:20px; box-sizing:border-box; text-align:center;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <b id="t-publish-story">স্টোরি পাবলিশ করুন</b>
                <span style="cursor:pointer; font-weight:bold; font-size:18px;" onclick="closeStoryUploadModal()">✕</span>
            </div>
            <div style="margin-bottom:12px;" class="no-download">
                <img id="story-modal-preview" style="width:100%; max-height:180px; object-fit:contain; border-radius:8px; background:#000;" src="">
            </div>
            <div class="form-group">
                <label id="t-story-caption-label">স্টোরি টাইটেল / ক্যাপশন:</label>
                <input type="text" id="story-caption-input" placeholder="আপনার মনের কথা বা টাইটেল লিখুন...">
            </div>
            <div style="display:flex; gap:8px;">
                <button class="btn-primary" id="t-send-msg-story" style="background:#54656f;" onclick="shareStoryAsMessage()">💬 মেসেজে পাঠান</button>
                <button class="btn-primary" id="t-post-story" onclick="confirmUploadStory()">⭕ স্টোরিতে দিন</button>
            </div>
        </div>
    </div>

    <!-- গ্রুপ তৈরির মডাল -->
    <div class="modal-overlay" id="group-modal" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:500;">
        <div style="width:90%; max-width:340px; background:#fff; border-radius:12px; padding:20px; box-sizing:border-box;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <b id="t-create-group-title">গ্রুপ তৈরি করুন</b>
                <span style="cursor:pointer; font-weight:bold; font-size:18px;" onclick="closeCreateGroupModal()">✕</span>
            </div>
            <div style="text-align:center; margin-bottom:12px;">
                <div class="profile-container-edit" onclick="document.getElementById('group-img-file-input').click()" title="গ্রুপের ছবি দিন">
                    <img id="group-img-preview" class="profile-preview no-download" style="width:80px; height:80px;" src="https://via.placeholder.com/150/00a884/ffffff?text=LOCKED">
                    <div class="profile-edit-overlay" style="width:24px; height:24px; font-size:11px;">🔒</div>
                </div>
                <input type="file" id="group-img-file-input" accept="image/*" style="display:none;">
            </div>
            <div class="form-group">
                <label id="t-group-name-label">গ্রুপের নাম:</label>
                <input type="text" id="group-name-input" placeholder="যেমন: প্রাইভেট স্টাডি জোন">
            </div>
            <div class="form-group">
                <label id="t-group-desc-label">গ্রুপের বিবরণ / রুলস:</label>
                <input type="text" id="group-title-input" placeholder="যেমন: জয়েন করতে এডমিনের অনুমতি লাগবে">
            </div>
            <button class="btn-primary" id="t-create-group-action" onclick="createGroupAction()">গ্রুপ তৈরি করুন</button>
        </div>
    </div>

    <div class="modal-overlay" id="edit-group-modal" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:500;">
        <div style="width:90%; max-width:340px; background:#fff; border-radius:12px; padding:20px; box-sizing:border-box;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <b id="t-edit-group-title">গ্রুপ সেটিংস ও এডিট</b>
                <span style="cursor:pointer; font-weight:bold; font-size:18px;" onclick="closeEditGroupModal()">✕</span>
            </div>
            <div style="text-align:center; margin-bottom:12px;">
                <div class="profile-container-edit" onclick="document.getElementById('edit-group-img-file').click()" title="গ্রুপের ছবি পরিবর্তন করুন">
                    <img id="edit-group-img-preview" class="profile-preview no-download" style="width:80px; height:80px;" src="https://via.placeholder.com/150">
                    <div class="profile-edit-overlay" style="width:24px; height:24px; font-size:11px;">📷</div>
                </div>
                <input type="file" id="edit-group-img-file" accept="image/*" style="display:none;">
            </div>
            <div class="form-group">
                <label id="t-edit-g-name">গ্রুপের নাম:</label>
                <input type="text" id="edit-group-name">
            </div>
            <div class="form-group">
                <label id="t-edit-g-desc">গ্রুপের বিবরণ:</label>
                <input type="text" id="edit-group-title">
            </div>
            <button class="btn-primary" id="t-save-g-edit" onclick="saveGroupEditAction()">পরিবর্তন সেভ করুন</button>
        </div>
    </div>

    <!-- জয়েন রিকোয়েস্ট ম্যানেজ করার মডাল -->
    <div class="modal-overlay" id="group-requests-modal" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:500;">
        <div style="width:90%; max-width:340px; background:#fff; border-radius:12px; padding:20px; box-sizing:border-box; max-height:80vh; display:flex; flex-direction:column;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <b id="t-req-modal-title">গ্রুপ জয়েন রিকোয়েস্টসমূহ</b>
                <span style="cursor:pointer; font-weight:bold; font-size:18px;" onclick="closeRequestsModal()">✕</span>
            </div>
            <div id="requests-list-container" style="flex:1; overflow-y:auto; max-height:250px; margin-bottom:10px;"></div>
            <button class="btn-primary" id="t-close-modal" onclick="closeRequestsModal()">বন্ধ করুন</button>
        </div>
    </div>

    <div class="modal-overlay" id="sticker-modal" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:500;">
        <div style="width:90%; max-width:340px; background:#fff; border-radius:12px; padding:15px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                <b id="t-sticker-title">স্টিকার ও ইমোজি প্যাক</b>
                <span style="cursor:pointer; font-weight:bold; font-size:18px;" onclick="closeStickerModal()">✕</span>
            </div>
            <div class="sticker-grid">
                <div class="sticker-item" onclick="sendSticker('😀')">😀</div>
                <div class="sticker-item" onclick="sendSticker('😂')">😂</div>
                <div class="sticker-item" onclick="sendSticker('😱')">😱</div>
                <div class="sticker-item" onclick="sendSticker('💝')">💝</div>
                <div class="sticker-item" onclick="sendSticker('💘')">💘</div>
                <div class="sticker-item" onclick="sendSticker('💞')">💞</div>
                <div class="sticker-item" onclick="sendSticker('💋')">💋</div>
                <div class="sticker-item" onclick="sendSticker('🙋🏻‍♂️')">🙋🏻‍♂️</div>
                <div class="sticker-item" onclick="sendSticker('🍂')">🍂</div>
                <div class="sticker-item" onclick="sendSticker('🌿')">🌿</div>
                <div class="sticker-item" onclick="sendSticker('🧧')">🧧</div>
                <div class="sticker-item" onclick="sendSticker('💯')">💯</div>
                <div class="sticker-item" onclick="sendSticker('💸')">💸</div>
                <div class="sticker-item" onclick="sendSticker('📢')">📢</div>
                <div class="sticker-item" onclick="sendSticker('🚫')">🚫</div>
                <div class="sticker-item" onclick="sendSticker('✅')">✅</div>
                <div class="sticker-item" onclick="sendSticker('❎')">❎</div>
                <div class="sticker-item" onclick="sendSticker('💲')">💲</div>
                <div class="sticker-item" onclick="sendSticker('✔️')">✔️</div>
                <div class="sticker-item" onclick="sendSticker('🇧🇩')">🇧🇩</div>
                <div class="sticker-item" onclick="sendSticker('⚠️')">⚠️</div>
                <div class="sticker-item" onclick="sendSticker('📳')">📳</div>
                <div class="sticker-item" onclick="sendSticker('🔕')">🔕</div>
                <div class="sticker-item" onclick="sendSticker('😍')">😍</div>
                <div class="sticker-item" onclick="sendSticker('🔥')">🔥</div>
                <div class="sticker-item" onclick="sendSticker('👍')">👍</div>
                <div class="sticker-item" onclick="sendSticker('🎉')">🎉</div>
                <div class="sticker-item" onclick="sendSticker('❤️')">❤️</div>
                <div class="sticker-item" onclick="sendSticker('😎')">😎</div>
                <div class="sticker-item" onclick="sendSticker('😢')">😢</div>
                <div class="sticker-item" onclick="sendSticker('🙏')">🙏</div>
                <div class="sticker-item" onclick="sendSticker('🚀')">🚀</div>
                <div class="sticker-item" onclick="sendSticker('⭐')">⭐</div>
                <div class="sticker-item" onclick="sendSticker('👏')">👏</div>
                <div class="sticker-item" onclick="sendSticker('👑')">👑</div>
                <div class="sticker-item" onclick="sendSticker('🌹')">🌹</div>
                <div class="sticker-item" onclick="sendSticker('💡')">💡</div>
                <div class="sticker-item" onclick="sendSticker('⚡')">⚡</div>
                <div class="sticker-item" onclick="sendSticker('🎁')">🎁</div>
                <div class="sticker-item" onclick="sendSticker('🐱')">🐱</div>
                <div class="sticker-item" onclick="sendSticker('🐶')">🐶</div>
            </div>
        </div>
    </div>

    <div id="image-viewer-modal" class="no-download">
        <button id="image-viewer-close" onclick="closeImageViewer()">✕</button>
        <img id="fullscreen-img-src" src="">
        <p id="fullscreen-img-caption" style="color: white; margin: 10px 0; font-size: 15px; font-weight: bold; text-align:center;"></p>
        
        <div id="story-view-stats" style="display:none; color:#fff; font-size:13px; background:rgba(0,0,0,0.6); padding:4px 12px; border-radius:12px; margin-bottom:8px; text-align:center;">
            👁️ <span id="story-view-count">0</span> <span id="t-viewers-text">জন দেখেছে</span>
        </div>

        <div id="story-action-box" style="display:none; width:90%; max-width:380px; flex-direction:column; gap:8px; margin-top:5px;">
            <div style="display:flex; justify-content:center; gap:12px;">
                <button onclick="sendStoryReaction('❤️')" style="background:none; border:none; font-size:26px; cursor:pointer;">❤️</button>
                <button onclick="sendStoryReaction('🔥')" style="background:none; border:none; font-size:26px; cursor:pointer;">🔥</button>
                <button onclick="sendStoryReaction('😍')" style="background:none; border:none; font-size:26px; cursor:pointer;">😍</button>
                <button onclick="sendStoryReaction('👏')" style="background:none; border:none; font-size:26px; cursor:pointer;">👏</button>
                <button onclick="sendStoryReaction('😂')" style="background:none; border:none; font-size:26px; cursor:pointer;">😂</button>
            </div>
            <div style="display:flex; gap:6px; width:100%;">
                <input type="text" id="story-comment-input" placeholder="রিপ্লাই বা কমেন্ট লিখুন..." style="flex:1; padding:8px 12px; border-radius:20px; border:none; outline:none; font-size:14px;">
                <button onclick="submitStoryComment()" id="t-send-comment-btn" style="background:var(--primary-color); color:#fff; border:none; padding:8px 16px; border-radius:20px; font-weight:bold; cursor:pointer;">পাঠান</button>
            </div>
        </div>
    </div>

    <div id="msg-context-menu" class="msg-context-menu">
        <div id="delete-msg-btn">ডার্লিট করুন (Delete)</div>
    </div>

    <div id="group-context-menu" class="msg-context-menu">
        <div id="delete-group-btn" style="color:#e74c3c;">গ্রুপ ডিলিট করুন</div>
    </div>

    <div id="chat-screen">
        <div class="chat-header">
            <button class="back-btn" onclick="closeChat()">⬅️</button>
            <div class="avatar-container" onclick="previewTargetProfile()">
                <img id="chat-user-img" class="avatar no-download" style="width:38px; height:38px;">
                <span id="chat-target-status-dot" class="status-dot" style="width:10px; height:10px; bottom:0; right:0;"></span>
            </div>
            <div style="cursor:pointer; flex:1; min-width:0;" onclick="previewTargetProfile()">
                <h4 id="chat-user-name" style="margin:0; font-size:15px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">...</h4>
                <p style="font-size:11px; color:#e2e8f0; margin:0;" id="chat-status">অফলাইন</p>
            </div>
            <button id="group-requests-btn" class="icon-btn" style="color:#fff; display:none; font-size:18px; margin-right:5px;" onclick="openRequestsModal()" title="জয়েন রিকোয়েস্ট">👥📩</button>
            <button id="group-edit-btn" class="icon-btn" style="color:#fff; display:none; font-size:20px; margin-right:5px;" onclick="openEditGroupModal()" title="গ্রুপ এডিট">⚙️</button>
        </div>
        
        <div class="chat-body" id="chat-messages" onclick="hideContextMenu()"></div>
        
        <div class="chat-input-area" id="chat-input-area-box">
            <div class="input-pill-box">
                <button class="icon-btn" type="button" onclick="openStickerModal()">😊</button>
                <input type="text" id="chat-input-text" placeholder="মেসেজ লিখুন...">
                <button class="icon-btn" type="button" onclick="document.getElementById('chat-file-input').click()">📎</button>
            </div>
            <button class="send-btn" id="send-msg-btn" type="button">➤</button>
            <button class="send-btn" id="record-audio-btn" type="button" style="background:#54656f;" onclick="toggleVoiceRecording()">🎤</button>
            <input type="file" id="chat-file-input" accept="image/*,video/*" style="display:none;">
            <input type="file" id="story-file-input" accept="image/*" style="display:none;">
        </div>
    </div>

</div>

<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

<script>
    const firebaseConfig = {
        apiKey: "AIzaSyDEmxPZisclLYns5MKnj-ar9fSOjZ_Glho",
        authDomain: "my-incame-chait.firebaseapp.com",
        databaseURL: "https://my-incame-chait-default-rtdb.firebaseio.com",
        projectId: "my-incame-chait",
        storageBucket: "my-incame-chait.appspot.com",
        messagingSenderId: "610034577258",
        appId: "1:610034577258:web:cd870a6960a697258ebf13"
    };

    firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();
    const db = firebase.database();

    const IMGBB_API_KEY = "d617dab9d2117228e38549791d42104a";

    let currentUser = null;
    let activeChatTarget = null;
    let currentChatRef = null;
    let selectedProfileImageUrl = null;
    let newGroupPhotoUrl = 'https://via.placeholder.com/150/00a884/ffffff?text=LOCKED';
    let editGroupPhotoUrl = '';
    let mediaRecorder = null;
    let audioChunks = [];
    let targetStatusListener = null;
    let activeLongPressMsgKey = null;
    let activeLongPressGroupId = null;
    let pendingStoryFile = null;
    let viewingStoryOwnerUid = null;

    const translations = {
        bn: {
            appTitle: "Private Message (লকড গ্রুপ ও রিকোয়েস্ট সিস্টেম)",
            authSubtitle: "নিরাপদ চ্যাট, গ্রুপ এবং স্টোরি সিস্টেম",
            loginTitle: "লগইন করুন",
            emailLabel: "ইমেইল:",
            passLabel: "পাসওয়ার্ড:",
            loginEmailPlaceholder: "আপনার আসল ইমেইল দিন",
            loginPassPlaceholder: "পাসওয়ার্ড দিন",
            loginBtn: "লগইন",
            or: "অথবা",
            googleBtn: "গুগল দিয়ে প্রবেশ করুন",
            noAcc: "অ্যাকাউন্ট নেই?",
            regLink: "নতুন রেজিস্ট্রেশন করুন",
            regTitle: "নতুন অ্যাকাউন্ট",
            nameLabel: "আপনার নাম:",
            origEmailLabel: "অরজিনাল ইমেইল:",
            regPassLabel: "পাসওয়ার্ড:",
            regBtn: "রেজিস্ট্রেশন ও ভেরিফিকেশন পাঠান",
            hasAcc: "আগে থেকেই অ্যাকাউন্ট আছে?",
            loginLink: "লগইন করুন",
            navChats: "Chats",
            navUpdates: "Updates",
            navCommunities: "Communities",
            navSettings: "Settings",
            communitiesSoon: "কমিউনিটি ফিচার শীঘ্রই আসছে...",
            createGroupBtn: "➕ গ্রুপ",
            searchInputPlaceholder: "ইউজার বা গ্রুপ খুঁজুন...",
            publishStory: "স্টোরি পাবলিশ করুন",
            storyCaptionLabel: "স্টোরি টাইটেল / ক্যাপশন:",
            sendMsgStory: "💬 মেসেজে পাঠান",
            postStory: "⭕ স্টোরিতে দিন",
            createGroupTitle: "গ্রুপ তৈরি করুন",
            groupNameLabel: "গ্রুপের নাম:",
            groupDescLabel: "গ্রুপের বিবরণ / রুলস:",
            createGroupAction: "গ্রুপ তৈরি করুন",
            editGroupTitle: "গ্রুপ সেটিংস ও এডিট",
            editGName: "গ্রুপের নাম:",
            editGDesc: "গ্রুপের বিবরণ:",
            saveGEdit: "পরিবর্তন সেভ করুন",
            reqModalTitle: "গ্রুপ জয়েন রিকোয়েস্টসমূহ",
            closeModal: "বন্ধ করুন",
            stickerTitle: "স্টিকার ও ইমোজি প্যাক",
            viewersText: "জন দেখেছে",
            sendCommentBtn: "পাঠান",
            deleteMsg: "ডার্লিট করুন (Delete)",
            deleteGroup: "গ্রুপ ডিলিট করুন",
            online: "অনলাইন",
            offline: "অফলাইন",
            chatInputPlaceholder: "মেসেজ লিখুন...",
            myStory: "আমার স্টোরি",
            statusTitle: "স্ট্যাটাস / স্টোরি",
            myIdText: "আপনার আইডি:",
            updateNameLabel: "আপনার নাম",
            updateStatusLabel: "বায়ো / স্ট্যাটাস",
            langLabel: "ভাষা নির্বাচন (Language)",
            notifSound: "নোটিফিকেশন সাউন্ড",
            saveProfileBtn: "পরিবর্তন সেভ করুন",
            logoutBtn: "লগ-আউট করুন"
        },
        en: {
            appTitle: "Private Message (Locked Group & Request System)",
            authSubtitle: "Secure Chat, Group & Story System",
            loginTitle: "Login",
            emailLabel: "Email:",
            passLabel: "Password:",
            loginEmailPlaceholder: "Enter your real email",
            loginPassPlaceholder: "Enter password",
            loginBtn: "Login",
            or: "OR",
            googleBtn: "Continue with Google",
            noAcc: "Don't have an account?",
            regLink: "Register New",
            regTitle: "New Account",
            nameLabel: "Your Name:",
            origEmailLabel: "Original Email:",
            regPassLabel: "Password:",
            regBtn: "Register & Send Verification",
            hasAcc: "Already have an account?",
            loginLink: "Login",
            navChats: "Chats",
            navUpdates: "Updates",
            navCommunities: "Communities",
            navSettings: "Settings",
            communitiesSoon: "Community feature coming soon...",
            createGroupBtn: "➕ Group",
            searchInputPlaceholder: "Search user or locked group...",
            publishStory: "Publish Story",
            storyCaptionLabel: "Story Title / Caption:",
            sendMsgStory: "💬 Send in Chat",
            postStory: "⭕ Post to Story",
            createGroupTitle: "Create Group",
            groupNameLabel: "Group Name:",
            groupDescLabel: "Group Description / Rules:",
            createGroupAction: "Create Locked Group",
            editGroupTitle: "Group Settings & Edit",
            editGName: "Group Name:",
            editGDesc: "Group Description:",
            saveGEdit: "Save Changes",
            reqModalTitle: "Group Join Requests",
            closeModal: "Close",
            stickerTitle: "Stickers & Emoji Pack",
            viewersText: "views",
            sendCommentBtn: "Send",
            deleteMsg: "Delete Message",
            deleteGroup: "Delete Group",
            online: "Online",
            offline: "Offline",
            chatInputPlaceholder: "Type a message...",
            myStory: "My Story",
            statusTitle: "Status / Story",
            myIdText: "Your ID:",
            updateNameLabel: "Your Name",
            updateStatusLabel: "Bio / Status",
            langLabel: "Language Selection",
            notifSound: "Notification Sound",
            saveProfileBtn: "Save Changes",
            logoutBtn: "Log Out"
        },
        hi: {
            appTitle: "Private Message (लॉक्ड ग्रुप और अनुरोध सिस्टम)",
            authSubtitle: "सुरक्षित चैट, ग्रुप और स्टोरी सिस्टम",
            loginTitle: "लॉगिन करें",
            emailLabel: "ईमेल:",
            passLabel: "पासवर्ड:",
            loginEmailPlaceholder: "अपना असली ईमेल दर्ज करें",
            loginPassPlaceholder: "पासवर्ड दर्ज करें",
            loginBtn: "लॉगिन",
            or: "अथवा",
            googleBtn: "गूगल के साथ जारी रखें",
            noAcc: "खाता नहीं है?",
            regLink: "नया पंजीकरण करें",
            regTitle: "नया खाता",
            nameLabel: "आपका नाम:",
            origEmailLabel: "मूल ईमेल:",
            regPassLabel: "पासवर्ड:",
            regBtn: "रजिस्टर और सत्यापन भेजें",
            hasAcc: "पहले से खाता है?",
            loginLink: "लॉगिन करें",
            navChats: "Chats",
            navUpdates: "Updates",
            navCommunities: "Communities",
            navSettings: "Settings",
            communitiesSoon: "कम्युनिटी फीचर जल्द आ रहा है...",
            createGroupBtn: "➕ लॉक्ड ग्रुप",
            searchInputPlaceholder: "यूजर या लॉक्ड ग्रुप खोजें...",
            publishStory: "स्टोरी पब्लिश करें",
            storyCaptionLabel: "स्टोरी टाइटल / कैप्शन:",
            sendMsgStory: "💬 चैट में भेजें",
            postStory: "⭕ स्टोरी में डालें",
            createGroupTitle: "लॉक्ड ग्रुप बनाएं",
            groupNameLabel: "ग्रुप का नाम:",
            groupDescLabel: "ग्रुप विवरण / नियम:",
            createGroupAction: "लॉक्ड ग्रुप बनाएं",
            editGroupTitle: "ग्रुप सेटिंग्स और संपादन",
            editGName: "ग्रुप का नाम:",
            editGDesc: "ग्रुप विवरण:",
            saveGEdit: "बदलाव सहेजें",
            reqModalTitle: "ग्रुप ज्वाइन अनुरोध",
            closeModal: "बंद करें",
            stickerTitle: "स्टिकर और इमोजी पैक",
            viewersText: "लोग देख चुके हैं",
            sendCommentBtn: "भेजें",
            deleteMsg: "डिलीट करें",
            deleteGroup: "ग्रुप डिलीट करें",
            online: "ऑनलाइन",
            offline: "ऑफ़लाइन",
            chatInputPlaceholder: "संदेश लिखें...",
            myStory: "मेरी स्टोरी",
            statusTitle: "स्टेटस / स्टोरी",
            myIdText: "आपकी आईडी:",
            updateNameLabel: "आपका नाम",
            updateStatusLabel: "बायो / स्टेटस",
            langLabel: "भाषा चयन (Language)",
            notifSound: "नोटिफिकेशन साउंड",
            saveProfileBtn: "बदलाव सहेजें",
            logoutBtn: "लॉग-आउट करें"
        },
        ar: {
            appTitle: "Private Message (المجموعة المغلقة ونظام الطلبات)",
            authSubtitle: "دردشة آمنة، مجموعات وقصص",
            loginTitle: "تسجيل الدخول",
            emailLabel: "البريد الإلكتروني:",
            passLabel: "كلمة المرور:",
            loginEmailPlaceholder: "أدخل بريدك الإلكتروني الحقيقي",
            loginPassPlaceholder: "أدخل كلمة المرور",
            loginBtn: "تسجيل الدخول",
            or: "أو",
            googleBtn: "المتابعة باستخدام جوجل",
            noAcc: "ليس لديك حساب؟",
            regLink: "تسجيل جديد",
            regTitle: "حساب جديد",
            nameLabel: "اسمك:",
            origEmailLabel: "البريد الإلكتروني الأصلي:",
            regPassLabel: "كلمة المرور:",
            regBtn: "تسجيل وإرسال التحقق",
            hasAcc: "لديك حساب بالفعل؟",
            loginLink: "تسجيل الدخول",
            navChats: "Chats",
            navUpdates: "Updates",
            navCommunities: "Communities",
            navSettings: "Settings",
            communitiesSoon: "ميزة المجتمع قريباً...",
            createGroupBtn: "➕ مجموعة مغلقة",
            searchInputPlaceholder: "ابحث عن مستخدم أو مجموعة...",
            publishStory: "نشر القصة",
            storyCaptionLabel: "عنوان القصة / التعليق:",
            sendMsgStory: "💬 إرسال في الدردشة",
            postStory: "⭕ نشر كقصة",
            createGroupTitle: "إنشاء مجموعة مغلقة",
            groupNameLabel: "اسم المجموعة:",
            groupDescLabel: "وصف المجموعة / القواعد:",
            createGroupAction: "إنشاء مجموعة مغلقة",
            editGroupTitle: "إعدادات وتعديل المجموعة",
            editGName: "اسم المجموعة:",
            editGDesc: "وصف المجموعة:",
            saveGEdit: "حفظ التغييرات",
            reqModalTitle: "طلبات الانضمام للمجموعة",
            closeModal: "إغلاق",
            stickerTitle: "الملصقات والرموز التعبيرية",
            viewersText: "مشاهدة",
            sendCommentBtn: "إرسال",
            deleteMsg: "حذف الرسالة",
            deleteGroup: "حذف المجموعة",
            online: "متصل",
            offline: "غير متصل",
            chatInputPlaceholder: "اكتب رسالة...",
            myStory: "قصتي",
            statusTitle: "الحالة / القصة",
            myIdText: "معرفك:",
            updateNameLabel: "اسمك",
            updateStatusLabel: "السيرة الذاتية / الحالة",
            langLabel: "اختيار اللغة",
            notifSound: "صوت الإشعارات",
            saveProfileBtn: "حفظ التغييرات",
            logoutBtn: "تسجيل الخروج"
        },
        es: {
            appTitle: "Private Message (Grupo Bloqueado y Sistema de Solicitudes)",
            authSubtitle: "Chat seguro, grupos y sistema de historias",
            loginTitle: "Iniciar Sesión",
            emailLabel: "Correo Electrónico:",
            passLabel: "Contraseña:",
            loginEmailPlaceholder: "Ingresa tu correo real",
            loginPassPlaceholder: "Ingresa contraseña",
            loginBtn: "Iniciar Sesión",
            or: "O",
            googleBtn: "Continuar con Google",
            noAcc: "¿No tienes una cuenta?",
            regLink: "Registrarse",
            regTitle: "Nueva Cuenta",
            nameLabel: "Tu Nombre:",
            origEmailLabel: "Correo Original:",
            regPassLabel: "Contraseña:",
            regBtn: "Registrar y Enviar Verificación",
            hasAcc: "¿Ya tienes una cuenta?",
            loginLink: "Iniciar Sesión",
            navChats: "Chats",
            navUpdates: "Updates",
            navCommunities: "Communities",
            navSettings: "Settings",
            communitiesSoon: "Función de comunidad próximamente...",
            createGroupBtn: "➕ Grupo Bloqueado",
            searchInputPlaceholder: "Buscar usuario o grupo...",
            publishStory: "Publicar Historia",
            storyCaptionLabel: "Título / Leyenda de la historia:",
            sendMsgStory: "💬 Enviar al Chat",
            postStory: "⭕ Publicar en Historia",
            createGroupTitle: "Crear Grupo Bloqueado",
            groupNameLabel: "Nombre del Grupo:",
            groupDescLabel: "Descripción / Reglas:",
            createGroupAction: "Crear Grupo Bloqueado",
            editGroupTitle: "Configuración del Grupo",
            editGName: "Nombre del Grupo:",
            editGDesc: "Descripción del Grupo:",
            saveGEdit: "Guardar Cambios",
            reqModalTitle: "Solicitudes de Unión",
            closeModal: "Cerrar",
            stickerTitle: "Stickers y Emojis",
            viewersText: "vistos",
            sendCommentBtn: "Enviar",
            deleteMsg: "Eliminar Mensaje",
            deleteGroup: "Eliminar Grupo",
            online: "En línea",
            offline: "Desconectado",
            chatInputPlaceholder: "Escribe un mensaje...",
            myStory: "Mi Historia",
            statusTitle: "Estado / Historia",
            myIdText: "Tu ID:",
            updateNameLabel: "Tu Nombre",
            updateStatusLabel: "Biografía / Estado",
            langLabel: "Selección de Idioma",
            notifSound: "Sonido de Notificación",
            saveProfileBtn: "Guardar Cambios",
            logoutBtn: "Cerrar Sesión"
        }
    };

    function applyTranslations() {
        const lang = localStorage.getItem('appLang') || 'bn';
        const t = translations[lang] || translations['bn'];

        document.getElementById('app-title').innerText = t.appTitle;
        document.getElementById('t-auth-subtitle').innerText = t.authSubtitle;
        document.getElementById('t-login-title').innerText = t.loginTitle;
        document.getElementById('t-email-label').innerText = t.emailLabel;
        document.getElementById('t-pass-label').innerText = t.passLabel;
        document.getElementById('login-email').placeholder = t.loginEmailPlaceholder;
        document.getElementById('login-password').placeholder = t.loginPassPlaceholder;
        document.getElementById('email-login-btn').innerText = t.loginBtn;
        document.getElementById('t-or').innerText = t.or;
        document.getElementById('t-google-btn').innerText = t.googleBtn;
        document.getElementById('t-no-acc').innerText = t.noAcc;
        document.getElementById('t-reg-link').innerText = t.regLink;

        document.getElementById('t-reg-title').innerText = t.regTitle;
        document.getElementById('t-name-label').innerText = t.nameLabel;
        document.getElementById('t-orig-email-label').innerText = t.origEmailLabel;
        document.getElementById('t-reg-pass-label').innerText = t.passLabel;
        document.getElementById('email-reg-btn').innerText = t.regBtn;
        document.getElementById('t-has-acc').innerText = t.hasAcc;
        document.getElementById('t-login-link').innerText = t.loginLink;

        document.getElementById('t-nav-chats').innerText = t.navChats;
        document.getElementById('t-nav-updates').innerText = t.navUpdates;
        document.getElementById('t-nav-communities').innerText = t.navCommunities;
        document.getElementById('t-nav-settings').innerText = t.navSettings;
        document.getElementById('t-create-group-btn').innerText = t.createGroupBtn;
        document.getElementById('search-input').placeholder = t.searchInputPlaceholder;

        document.getElementById('t-publish-story').innerText = t.publishStory;
        document.getElementById('t-story-caption-label').innerText = t.storyCaptionLabel;
        document.getElementById('t-send-msg-story').innerText = t.sendMsgStory;
        document.getElementById('t-post-story').innerText = t.postStory;

        document.getElementById('t-create-group-title').innerText = t.createGroupTitle;
        document.getElementById('t-group-name-label').innerText = t.groupNameLabel;
        document.getElementById('t-group-desc-label').innerText = t.groupDescLabel;
        document.getElementById('t-create-group-action').innerText = t.createGroupAction;

        document.getElementById('t-edit-group-title').innerText = t.editGroupTitle;
        document.getElementById('t-edit-g-name').innerText = t.editGName;
        document.getElementById('t-edit-g-desc').innerText = t.editGDesc;
        document.getElementById('t-save-g-edit').innerText = t.saveGEdit;

        document.getElementById('t-req-modal-title').innerText = t.reqModalTitle;
        document.getElementById('t-close-modal').innerText = t.closeModal;
        document.getElementById('t-sticker-title').innerText = t.stickerTitle;
        document.getElementById('t-viewers-text').innerText = t.viewersText;
        document.getElementById('t-send-comment-btn').innerText = t.sendCommentBtn;
        document.getElementById('delete-msg-btn').innerText = t.deleteMsg;
        document.getElementById('delete-group-btn').innerText = t.deleteGroup;
        document.getElementById('chat-input-text').placeholder = t.chatInputPlaceholder;

        const activeTabEl = document.querySelector('.nav-item.active');
        if (activeTabEl && activeTabEl.id === 'tab-btn-communities') {
            const container = document.getElementById('main-content');
            container.innerHTML = `<div class="panel-box"><p style="text-align:center;">${t.communitiesSoon}</p></div>`;
        }
    }

    function changeAppLanguage(lang) {
        localStorage.setItem('appLang', lang);
        applyTranslations();
        alert(lang === 'bn' ? 'ভাষা সফলভাবে পরিবর্তন করা হয়েছে!' : 'Language changed successfully!');
        switchTab('settings');
    }

    window.addEventListener('load', () => {
        applyTranslations();
        setTimeout(() => {
            const splash = document.getElementById('splash-screen');
            if (splash) {
                splash.style.opacity = '0';
                setTimeout(() => splash.style.display = 'none', 500);
            }
        }, 1200);
    });

    function toggleAuthForms(type) {
        document.getElementById('login-box').style.display = type === 'register' ? 'none' : 'block';
        document.getElementById('register-box').style.display = type === 'register' ? 'block' : 'none';
    }

    document.getElementById('email-reg-btn').onclick = () => {
        const name = document.getElementById('reg-name').value.trim();
        const email = document.getElementById('reg-email').value.trim();
        const password = document.getElementById('reg-password').value;
        if(!name || !email || !password) return alert('সকল ঘর পূরণ করুন!');

        auth.createUserWithEmailAndPassword(email, password)
            .then(res => {
                const user = res.user;
                user.updateProfile({ displayName: name }).then(() => {
                    user.sendEmailVerification().then(() => {
                        alert('রেজিস্ট্রেশন সফল হয়েছে! আপনার আসল ইমেইলে ( ' + email + ' ) একটি ভেরিফিকেশন লিংক পাঠানো হয়েছে। ভেরিফাই করে লগইন করুন।');
                        auth.signOut();
                        toggleAuthForms('login');
                    }).catch(err => alert('ভেরিফিকেশন ইমেইল পাঠাতে সমস্যা: ' + err.message));
                });
            })
            .catch(err => alert(err.message));
    };

    document.getElementById('email-login-btn').onclick = () => {
        const email = document.getElementById('login-email').value.trim();
        const password = document.getElementById('login-password').value;
        if(!email || !password) return alert('ইমেইল ও পাসওয়ার্ড দিন!');

        auth.signInWithEmailAndPassword(email, password)
            .then(res => {
                const user = res.user;
                if (!user.emailVerified) {
                    alert('আপনার ইমেইলটি এখনো ভেরিফাইড নয়! জিমেইল ইনবক্স চেক করে ভেরিফাই করুন।');
                    auth.signOut();
                }
            })
            .catch(err => alert(err.message));
    };

    document.getElementById('google-login').onclick = () => {
        const provider = new firebase.auth.GoogleAuthProvider();
        auth.signInWithPopup(provider).then(result => {
            const user = result.user;
            const userRef = db.ref('users/' + user.uid);
            
            userRef.once('value', snapshot => {
                let googlePhoto = user.photoURL ? user.photoURL.replace('=s96-c', '=s400-c') : 'https://via.placeholder.com/150';
                let googleName = user.displayName || 'Google User';

                if (!snapshot.exists()) {
                    const customID = 'ID-' + Math.floor(1000 + Math.random() * 9000);
                    userRef.set({
                        uid: user.uid,
                        name: googleName,
                        email: user.email,
                        photoURL: googlePhoto,
                        customID: customID,
                        statusText: 'Hey there! I am using Private Message.',
                        status: 'online'
                    });
                } else {
                    userRef.update({
                        name: googleName,
                        photoURL: googlePhoto,
                        status: 'online'
                    });
                }
            });
        }).catch(err => alert(err.message));
    };

    auth.onAuthStateChanged(user => {
        if (user && (user.emailVerified || user.providerData.some(p => p.providerId === 'google.com'))) {
            currentUser = user;
            document.getElementById('auth-page').style.display = 'none';
            document.getElementById('main-app').style.display = 'flex';
            
            const userStatusDatabaseRef = db.ref('users/' + user.uid + '/status');
            const userLastSeenRef = db.ref('users/' + user.uid + '/lastSeen');
            const connectedRef = db.ref('.info/connected');

            connectedRef.on('value', (snapshot) => {
                if (snapshot.val() === true) {
                    userStatusDatabaseRef.onDisconnect().set('offline');
                    userLastSeenRef.onDisconnect().set(firebase.database.ServerValue.TIMESTAMP);
                    userStatusDatabaseRef.set('online');
                }
            });

            const userRef = db.ref('users/' + user.uid);
            userRef.once('value', snapshot => {
                if (!snapshot.exists()) {
                    const customID = 'ID-' + Math.floor(1000 + Math.random() * 9000);
                    userRef.set({
                        uid: user.uid,
                        name: user.displayName || 'User',
                        email: user.email,
                        photoURL: user.photoURL || 'https://via.placeholder.com/150',
                        customID: customID,
                        statusText: 'Hey there! I am using Private Message.',
                        status: 'online'
                    });
                    document.getElementById('my-user-id').innerText = customID;
                } else {
                    document.getElementById('my-user-id').innerText = snapshot.val().customID || 'ID-0000';
                    userRef.update({ status: 'online' });
                }
            });
            switchTab('chats');
        } else {
            if (currentUser) {
                db.ref('users/' + currentUser.uid).update({
                    status: 'offline',
                    lastSeen: firebase.database.ServerValue.TIMESTAMP
                });
            }
            document.getElementById('auth-page').style.display = 'flex';
            document.getElementById('main-app').style.display = 'none';
        }
    });

    document.getElementById('search-input').oninput = (e) => {
        const query = e.target.value.trim().toLowerCase();
        const container = document.getElementById('main-content');
        if (query.length < 1) { switchTab('chats'); return; }

        db.ref('users').once('value', snapshot => {
            container.innerHTML = '';
            let found = false;
            snapshot.forEach(child => {
                const u = child.val();
                if(u.uid !== currentUser.uid) {
                    const nameMatch = u.name && u.name.toLowerCase().includes(query);
                    const idMatch = u.customID && u.customID.toLowerCase().includes(query);
                    if(nameMatch || idMatch) {
                        found = true;
                        container.appendChild(createUserCard(u));
                    }
                }
            });
            if(!found) {
                container.innerHTML = '<p style="text-align:center; padding:20px; color:gray;">কোনো ইউজার পাওয়া যায়নি!</p>';
            }
        });
    };

    function createUserCard(user) {
        const div = document.createElement('div');
        div.className = 'user-item';
        const isOnline = user.status === 'online';
        const lang = localStorage.getItem('appLang') || 'bn';
        const t = translations[lang] || translations['bn'];
        
        div.innerHTML = `
            <div class="avatar-container" onclick="event.stopPropagation(); openFullscreenImage('${user.photoURL || 'https://via.placeholder.com/150'}', '${user.name}')">
                <img class="avatar no-download" src="${user.photoURL || 'https://via.placeholder.com/150'}">
                <span class="status-dot ${isOnline ? 'online' : ''}" id="card-dot-${user.uid}"></span>
            </div>
            <div class="user-info" onclick="openPrivateChat(${JSON.stringify(user).replace(/"/g, '&quot;')})">
                <h4>${user.name}</h4>
                <p id="card-status-text-${user.uid}">${isOnline ? t.online : formatLastSeen(user.lastSeen)}</p>
            </div>
        `;

        db.ref('users/' + user.uid).on('value', (snapshot) => {
            const updatedUser = snapshot.val();
            if(updatedUser) {
                const dot = div.querySelector(`#card-dot-${user.uid}`);
                const text = div.querySelector(`#card-status-text-${user.uid}`);
                if(updatedUser.status === 'online') {
                    if(dot) dot.classList.add('online');
                    if(text) text.innerText = t.online;
                } else {
                    if(dot) dot.classList.remove('online');
                    if(text) text.innerText = formatLastSeen(updatedUser.lastSeen);
                }
            }
        });

        return div;
    }

    function createGroupCard(group) {
        const div = document.createElement('div');
        div.className = 'user-item';
        div.id = 'group-card-' + group.id;

        const isCreator = group.createdBy === currentUser.uid;
        const isMember = group.members && group.members[currentUser.uid] === true;
        
        let actionText = '🔒 Locked Group (Join Request)';
        let badgeStyle = 'color:#e67e22; font-weight:bold;';

        if (isCreator) {
            actionText = '👑 Admin (Group Chat)';
            badgeStyle = 'color:#00a884; font-weight:bold;';
        } else if (isMember) {
            actionText = '✅ Member (Group Chat)';
            badgeStyle = 'color:#31a24c; font-weight:bold;';
        }

        div.innerHTML = `
            <div class="avatar-container">
                <img class="avatar no-download" src="${group.photoURL || 'https://via.placeholder.com/150/00a884/ffffff?text=LOCKED'}">
            </div>
            <div class="user-info" onclick='handleGroupClick(${JSON.stringify(group)})'>
                <h4>👥 ${group.name}</h4>
                <p style="${badgeStyle}">${actionText}</p>
            </div>
        `;

        if (isCreator) {
            let pressTimer;
            const startPress = (e) => {
                pressTimer = setTimeout(() => {
                    showGroupContextMenu(e, group.id);
                }, 600);
            };

            const cancelPress = () => clearTimeout(pressTimer);

            div.addEventListener('touchstart', startPress);
            div.addEventListener('touchend', cancelPress);
            div.addEventListener('touchmove', cancelPress);
            div.addEventListener('mousedown', startPress);
            div.addEventListener('mouseup', cancelPress);
            div.addEventListener('mouseleave', cancelPress);
        }

        return div;
    }

    window.handleGroupClick = function(group) {
        const isCreator = group.createdBy === currentUser.uid;
        const isMember = group.members && group.members[currentUser.uid] === true;

        if (isCreator || isMember) {
            openGroupChat(group);
        } else {
            db.ref('groups/' + group.id + '/joinRequests/' + currentUser.uid).once('value', snap => {
                if (snap.exists()) {
                    alert('আপনার জয়েন রিকোয়েস্ট ইতিমধ্যে পাঠানো হয়েছে!');
                } else {
                    if (confirm(`"${group.name}" একটি গ্রুপ। আপনি কি জয়েন রিকোয়েস্ট পাঠাতে চান?`)) {
                        db.ref('groups/' + group.id + '/joinRequests/' + currentUser.uid).set({
                            uid: currentUser.uid,
                            name: currentUser.displayName || 'User',
                            photoURL: currentUser.photoURL || 'https://via.placeholder.com/150',
                            time: firebase.database.ServerValue.TIMESTAMP
                        }).then(() => {
                            alert('জয়েন রিকোয়েস্ট সফলভাবে পাঠানো হয়েছে!');
                        });
                    }
                }
            });
        }
    };

    function showGroupContextMenu(e, groupId) {
        e.preventDefault();
        activeLongPressGroupId = groupId;
        const menu = document.getElementById('group-context-menu');
        
        let clientX = e.clientX || (e.touches && e.touches[0] ? e.touches[0].clientX : 150);
        let clientY = e.clientY || (e.touches && e.touches[0] ? e.touches[0].clientY : 200);

        menu.style.display = 'block';
        menu.style.left = Math.min(clientX, window.innerWidth - 150) + 'px';
        menu.style.top = Math.min(clientY, window.innerHeight - 80) + 'px';
    }

    function hideGlobalContextMenu() {
        document.getElementById('msg-context-menu').style.display = 'none';
        document.getElementById('group-context-menu').style.display = 'none';
        activeLongPressMsgKey = null;
        activeLongPressGroupId = null;
    }

    document.getElementById('delete-group-btn').onclick = () => {
        if (activeLongPressGroupId) {
            if (confirm("আপনি কি নিশ্চিতভাবে এই গ্রুপটি ডিলিট করতে চান?")) {
                db.ref('groups/' + activeLongPressGroupId).remove();
                db.ref('group_chats/' + activeLongPressGroupId).remove();
                hideGlobalContextMenu();
                switchTab('chats');
            }
        }
    };

    function formatLastSeen(timestamp) {
        if(!timestamp) return 'অফলাইন';
        const date = new Date(timestamp);
        return `শেষ দেখা: ${date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;
    }

    function openPrivateChat(targetUser) {
        activeChatTarget = targetUser;
        document.getElementById('chat-user-name').innerText = targetUser.name;
        document.getElementById('chat-user-img').src = targetUser.photoURL || 'https://via.placeholder.com/150';
        document.getElementById('chat-target-status-dot').style.display = 'inline-block';
        document.getElementById('group-requests-btn').style.display = 'none';
        document.getElementById('group-edit-btn').style.display = 'none';
        document.getElementById('chat-input-area-box').style.display = 'flex';
        document.getElementById('chat-screen').style.display = 'flex';

        const lang = localStorage.getItem('appLang') || 'bn';
        const t = translations[lang] || translations['bn'];

        if(targetStatusListener) targetStatusListener.off();
        targetStatusListener = db.ref('users/' + targetUser.uid);
        targetStatusListener.on('value', (snapshot) => {
            const uData = snapshot.val();
            const dot = document.getElementById('chat-target-status-dot');
            const statusText = document.getElementById('chat-status');
            if(uData && uData.status === 'online') {
                dot.classList.add('online');
                statusText.innerText = t.online;
            } else {
                dot.classList.remove('online');
                statusText.innerText = uData ? formatLastSeen(uData.lastSeen) : t.offline;
            }
        });

        const chatRoomID = currentUser.uid < targetUser.uid ? `${currentUser.uid}_${targetUser.uid}` : `${targetUser.uid}_${currentUser.uid}`;
        setupChatListener('private_chats/' + chatRoomID);
    }

    function openGroupChat(group) {
        activeChatTarget = { uid: group.id, name: group.name, title: group.title, photoURL: group.photoURL, createdBy: group.createdBy, isGroup: true };
        document.getElementById('chat-user-name').innerText = group.name;
        document.getElementById('chat-user-img').src = group.photoURL || 'https://via.placeholder.com/150/00a884/ffffff?text=LOCKED';
        document.getElementById('chat-target-status-dot').style.display = 'none';
        document.getElementById('chat-status').innerText = group.title || 'গ্রুপ চ্যাট';
        
        const isCreator = group.createdBy === currentUser.uid;
        document.getElementById('group-requests-btn').style.display = isCreator ? 'block' : 'none';
        document.getElementById('group-edit-btn').style.display = isCreator ? 'block' : 'none';
        
        const isMember = group.members && group.members[currentUser.uid] === true;
        if (isCreator || isMember) {
            document.getElementById('chat-input-area-box').style.display = 'flex';
            setupChatListener('group_chats/' + group.id);
        } else {
            document.getElementById('chat-input-area-box').style.display = 'none';
            document.getElementById('chat-messages').innerHTML = '<p style="text-align:center; color:red; margin-top:30px;">আপনি এই গ্রুপের সদস্য নন!</p>';
        }

        document.getElementById('chat-screen').style.display = 'flex';

        db.ref('groups/' + group.id).on('value', (snapshot) => {
            const updated = snapshot.val();
            if(updated && activeChatTarget && activeChatTarget.isGroup && activeChatTarget.uid === group.id) {
                activeChatTarget.name = updated.name;
                activeChatTarget.title = updated.title;
                activeChatTarget.photoURL = updated.photoURL;
                document.getElementById('chat-user-name').innerText = updated.name;
                document.getElementById('chat-status').innerText = updated.title || 'লকড গ্রুপ চ্যাট';
                document.getElementById('chat-user-img').src = updated.photoURL || 'https://via.placeholder.com/150/00a884/ffffff?text=LOCKED';
            }
        });
    }

    window.openRequestsModal = function() {
        if(!activeChatTarget || !activeChatTarget.isGroup) return;
        const container = document.getElementById('requests-list-container');
        container.innerHTML = '<p style="text-align:center; color:gray;">লোড হচ্ছে...</p>';
        document.getElementById('group-requests-modal').style.display = 'flex';

        db.ref('groups/' + activeChatTarget.uid + '/joinRequests').on('value', snapshot => {
            container.innerHTML = '';
            if (!snapshot.exists()) {
                container.innerHTML = '<p style="text-align:center; color:gray;">কোনো নতুন জয়েন রিকোয়েস্ট নেই।</p>';
                return;
            }
            snapshot.forEach(child => {
                const reqUser = child.val();
                const item = document.createElement('div');
                item.className = 'user-item';
                item.style.marginBottom = '6px';
                item.innerHTML = `
                    <img class="avatar no-download" style="width:40px; height:40px;" src="${reqUser.photoURL || 'https://via.placeholder.com/150'}">
                    <div class="user-info">
                        <h4 style="font-size:14px; margin:0;">${reqUser.name}</h4>
                        <p style="font-size:11px; margin:0;">জয়েন করতে চায়</p>
                    </div>
                    <button class="create-group-btn" style="background:#31a24c;" onclick="acceptJoinRequest('${activeChatTarget.uid}', '${reqUser.uid}', '${reqUser.name}')">অ্যাপ্রুভ</button>
                `;
                container.appendChild(item);
            });
        });
    };

    function closeRequestsModal() {
        document.getElementById('group-requests-modal').style.display = 'none';
    }

    window.acceptJoinRequest = function(groupId, userUid, userName) {
        db.ref('groups/' + groupId + '/members/' + userUid).set(true).then(() => {
            db.ref('groups/' + groupId + '/joinRequests/' + userUid).remove();
            db.ref('group_chats/' + groupId).push({
                sender: 'system',
                senderName: 'System',
                text: `${userName} এর জয়েন রিকোয়েস্ট গৃহীত হয়েছে।`,
                timestamp: firebase.database.ServerValue.TIMESTAMP
            });
            alert('রিকোয়েস্ট অ্যাপ্রুভ করা হয়েছে!');
        });
    };

    window.openFullscreenImage = function(imgSrc, captionText = '', storyOwnerUid = null) {
        document.getElementById('fullscreen-img-src').src = imgSrc;
        document.getElementById('fullscreen-img-caption').innerText = captionText;
        
        viewingStoryOwnerUid = storyOwnerUid;
        const actionBox = document.getElementById('story-action-box');
        const statsBox = document.getElementById('story-view-stats');
        
        if (storyOwnerUid) {
            db.ref('stories/' + storyOwnerUid + '/viewers/' + currentUser.uid).set({
                name: currentUser.displayName || 'User',
                time: firebase.database.ServerValue.TIMESTAMP
            });

            db.ref('stories/' + storyOwnerUid + '/viewers').on('value', snap => {
                const count = snap.numChildren();
                document.getElementById('story-view-count').innerText = count;
            });
            statsBox.style.display = 'block';

            if (storyOwnerUid !== currentUser.uid) {
                actionBox.style.display = 'flex';
            } else {
                actionBox.style.display = 'none';
            }
        } else {
            statsBox.style.display = 'none';
            actionBox.style.display = 'none';
        }

        document.getElementById('image-viewer-modal').style.display = 'flex';
    };

    window.closeImageViewer = function() {
        if (viewingStoryOwnerUid) {
            db.ref('stories/' + viewingStoryOwnerUid + '/viewers').off();
        }
        document.getElementById('image-viewer-modal').style.display = 'none';
        viewingStoryOwnerUid = null;
        document.getElementById('story-action-box').style.display = 'none';
        document.getElementById('story-view-stats').style.display = 'none';
    };

    function sendStoryReaction(emoji) {
        if (!viewingStoryOwnerUid) return;
        const chatRoomID = currentUser.uid < viewingStoryOwnerUid ? `${currentUser.uid}_${viewingStoryOwnerUid}` : `${viewingStoryOwnerUid}_${currentUser.uid}`;
        
        db.ref('private_chats/' + chatRoomID).push({
            sender: currentUser.uid,
            senderName: currentUser.displayName || 'User',
            text: `স্টোরিতে রিঅ্যাকশন দিয়েছেন: <span style="font-size:24px;">${emoji}</span>`,
            timestamp: firebase.database.ServerValue.TIMESTAMP
        }).then(() => {
            alert('রিঅ্যাকশন পাঠানো হয়েছে!');
            closeImageViewer();
        });
    }

    function submitStoryComment() {
        const comment = document.getElementById('story-comment-input').value.trim();
        if (!comment || !viewingStoryOwnerUid) return;
        const chatRoomID = currentUser.uid < viewingStoryOwnerUid ? `${currentUser.uid}_${viewingStoryOwnerUid}` : `${viewingStoryOwnerUid}_${currentUser.uid}`;

        db.ref('private_chats/' + chatRoomID).push({
            sender: currentUser.uid,
            senderName: currentUser.displayName || 'User',
            text: `স্টোরি কমেন্ট: ${comment}`,
            timestamp: firebase.database.ServerValue.TIMESTAMP
        }).then(() => {
            document.getElementById('story-comment-input').value = '';
            alert('কমেন্ট সফলভাবে ইনবক্সে পাঠানো হয়েছে!');
            closeImageViewer();
        });
    }

    function previewTargetProfile() {
        if(activeChatTarget) {
            if(!activeChatTarget.isGroup && activeChatTarget.photoURL) {
                openFullscreenImage(activeChatTarget.photoURL, activeChatTarget.name);
            } else if(activeChatTarget.isGroup && activeChatTarget.photoURL) {
                openFullscreenImage(activeChatTarget.photoURL, activeChatTarget.name);
            }
        }
    }

    function setupChatListener(path) {
        if(currentChatRef) currentChatRef.off();
        currentChatRef = db.ref(path);
        document.getElementById('chat-messages').innerHTML = '';

        currentChatRef.on('child_added', snapshot => {
            appendMessage(snapshot.key, snapshot.val());
        });

        currentChatRef.on('child_removed', snapshot => {
            const el = document.getElementById('msg-row-' + snapshot.key);
            if(el) el.remove();
        });
    }

    function closeChat() {
        if(targetStatusListener && activeChatTarget) {
            targetStatusListener.off();
        }
        document.getElementById('chat-target-status-dot').style.display = 'inline-block';
        document.getElementById('group-requests-btn').style.display = 'none';
        document.getElementById('group-edit-btn').style.display = 'none';
        document.getElementById('chat-input-area-box').style.display = 'flex';
        document.getElementById('chat-screen').style.display = 'none';
        document.getElementById('chat-messages').innerHTML = '';
        hideGlobalContextMenu();
        if(currentChatRef) currentChatRef.off();
    }

    document.getElementById('send-msg-btn').onclick = () => {
        const text = document.getElementById('chat-input-text').value.trim();
        if(!text) return;
        currentChatRef.push({
            sender: currentUser.uid,
            senderName: currentUser.displayName || 'User',
            text: text,
            timestamp: firebase.database.ServerValue.TIMESTAMP
        });
        document.getElementById('chat-input-text').value = '';
    };

    function appendMessage(key, msg) {
        const isMe = msg.sender === currentUser.uid;
        const div = document.createElement('div');
        div.className = `msg-row ${isMe ? 'sent' : 'recv'}`;
        div.id = 'msg-row-' + key;
        const timeStr = new Date(msg.timestamp || Date.now()).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        let senderNameHTML = (!isMe && activeChatTarget && activeChatTarget.isGroup) ? `<div style="font-size:11px; font-weight:bold; color:#00a884; margin-bottom:2px;">${msg.senderName || 'Member'}</div>` : '';

        let tickHTML = '';
        if (isMe) {
            let isTargetOnline = false;
            const statusDot = document.getElementById('chat-target-status-dot');
            if (statusDot && statusDot.classList.contains('online')) {
                isTargetOnline = true;
            }
            tickHTML = `<span style="font-size: 13px; color: ${isTargetOnline ? '#53bdeb' : '#667781'}; margin-left: 3px; font-weight: bold;">${isTargetOnline ? '✓✓' : '✓'}</span>`;
        }

        div.innerHTML = `
            <div class="msg-bubble-wrapper" id="msg-bubble-${key}">
                <div class="msg">
                    ${senderNameHTML}
                    ${msg.text ? msg.text : ''}
                    ${msg.image ? `<img src="${msg.image}" class="no-download" onclick="openFullscreenImage('${msg.image}')">` : ''}
                    ${msg.video ? `<video controls src="${msg.video}"></video>` : ''}
                    ${msg.audio ? `<audio controls src="${msg.audio}"></audio>` : ''}
                    <div class="msg-meta">
                        <span>${timeStr}</span>
                        ${tickHTML}
                    </div>
                </div>
            </div>
        `;

        const bubbleEl = div.querySelector(`#msg-bubble-${key}`);
        
        if (isMe) {
            let pressTimer;
            const startPress = (e) => {
                pressTimer = setTimeout(() => {
                    showContextMenu(e, key);
                }, 600);
            };

            const cancelPress = () => clearTimeout(pressTimer);

            bubbleEl.addEventListener('touchstart', startPress);
            bubbleEl.addEventListener('touchend', cancelPress);
            bubbleEl.addEventListener('touchmove', cancelPress);
            bubbleEl.addEventListener('mousedown', startPress);
            bubbleEl.addEventListener('mouseup', cancelPress);
            bubbleEl.addEventListener('mouseleave', cancelPress);
        }

        const body = document.getElementById('chat-messages');
        body.appendChild(div);
        body.scrollTop = body.scrollHeight;
    }

    function showContextMenu(e, msgKey) {
        e.preventDefault();
        activeLongPressMsgKey = msgKey;
        const menu = document.getElementById('msg-context-menu');
        
        let clientX = e.clientX || (e.touches && e.touches[0] ? e.touches[0].clientX : 150);
        let clientY = e.clientY || (e.touches && e.touches[0] ? e.touches[0].clientY : 200);

        menu.style.display = 'block';
        menu.style.left = Math.min(clientX, window.innerWidth - 140) + 'px';
        menu.style.top = Math.min(clientY, window.innerHeight - 80) + 'px';
    }

    document.getElementById('delete-msg-btn').onclick = () => {
        if(activeLongPressMsgKey && currentChatRef) {
            currentChatRef.child(activeLongPressMsgKey).remove()
                .then(() => hideGlobalContextMenu())
                .catch(err => alert("ডিলিট করতে সমস্যা হয়েছে: " + err.message));
        }
    };

    document.getElementById('chat-file-input').onchange = (e) => {
        const file = e.target.files[0];
        if(!file) return;

        const reader = new FileReader();
        reader.onload = (evt) => {
            const fileData = evt.target.result;
            if (file.type.startsWith('image/')) {
                currentChatRef.push({
                    sender: currentUser.uid,
                    senderName: currentUser.displayName || 'User',
                    image: fileData,
                    timestamp: firebase.database.ServerValue.TIMESTAMP
                });
            } else if (file.type.startsWith('video/')) {
                currentChatRef.push({
                    sender: currentUser.uid,
                    senderName: currentUser.displayName || 'User',
                    video: fileData,
                    timestamp: firebase.database.ServerValue.TIMESTAMP
                });
            }
        };
        reader.readAsDataURL(file);
    };

    function openStickerModal() { document.getElementById('sticker-modal').style.display = 'flex'; }
    function closeStickerModal() { document.getElementById('sticker-modal').style.display = 'none'; }
    window.sendSticker = function(emoji) {
        closeStickerModal();
        currentChatRef.push({
            sender: currentUser.uid,
            senderName: currentUser.displayName || 'User',
            text: `<span style="font-size:36px;">${emoji}</span>`,
            timestamp: firebase.database.ServerValue.TIMESTAMP
        });
    };

    function toggleVoiceRecording() {
        if (!mediaRecorder || mediaRecorder.state === "inactive") {
            navigator.mediaDevices.getUserMedia({ audio: true }).then(stream => {
                mediaRecorder = new MediaRecorder(stream);
                audioChunks = [];
                mediaRecorder.ondataavailable = e => audioChunks.push(e.data);
                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: 'audio/mp3' });
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        currentChatRef.push({
                            sender: currentUser.uid,
                            senderName: currentUser.displayName || 'User',
                            audio: e.target.result,
                            timestamp: firebase.database.ServerValue.TIMESTAMP
                        });
                    };
                    reader.readAsDataURL(audioBlob);
                };
                mediaRecorder.start();
                document.getElementById('record-audio-btn').style.background = '#e74c3c';
            }).catch(() => alert("মাইক্রোফোন পারমিশন পাওয়া যায়নি!"));
        } else {
            mediaRecorder.stop();
            document.getElementById('record-audio-btn').style.background = '#54656f';
        }
    }

    document.getElementById('group-img-file-input').onchange = (e) => {
        const file = e.target.files[0];
        if(!file) return;
        uploadImageToImgBB(file, (url) => {
            newGroupPhotoUrl = url;
            document.getElementById('group-img-preview').src = url;
        });
    };

    function openCreateGroupModal() {
        newGroupPhotoUrl = 'https://via.placeholder.com/150/00a884/ffffff?text=LOCKED';
        document.getElementById('group-img-preview').src = newGroupPhotoUrl;
        document.getElementById('group-name-input').value = '';
        document.getElementById('group-title-input').value = '';
        document.getElementById('group-modal').style.display = 'flex';
    }
    function closeCreateGroupModal() { document.getElementById('group-modal').style.display = 'none'; }
    
    function createGroupAction() {
        const groupName = document.getElementById('group-name-input').value.trim();
        const groupTitle = document.getElementById('group-title-input').value.trim();
        if(!groupName) return alert('গ্রুপের নাম লিখুন!');
        
        const newGroupRef = db.ref('groups').push();
        const groupData = {
            id: newGroupRef.key,
            name: groupName,
            title: groupTitle || 'গ্রুপ চ্যাট',
            photoURL: newGroupPhotoUrl,
            createdBy: currentUser.uid,
            timestamp: firebase.database.ServerValue.TIMESTAMP
        };
        
        newGroupRef.set(groupData).then(() => {
            db.ref('groups/' + newGroupRef.key + '/members/' + currentUser.uid).set(true);
            closeCreateGroupModal();
            alert('গ্রুপ তৈরি সফল হয়েছে!');
            switchTab('chats');
        }).catch(err => {
            alert("গ্রুপ তৈরি করতে সমস্যা হয়েছে: " + err.message);
        });
    }

    function openEditGroupModal() {
        if(!activeChatTarget || !activeChatTarget.isGroup) return;
        editGroupPhotoUrl = activeChatTarget.photoURL || 'https://via.placeholder.com/150';
        document.getElementById('edit-group-img-preview').src = editGroupPhotoUrl;
        document.getElementById('edit-group-name').value = activeChatTarget.name || '';
        document.getElementById('edit-group-title').value = activeChatTarget.title || '';
        document.getElementById('edit-group-modal').style.display = 'flex';
    }

    function closeEditGroupModal() {
        document.getElementById('edit-group-modal').style.display = 'none';
    }

    document.getElementById('edit-group-img-file').onchange = (e) => {
        const file = e.target.files[0];
        if(!file) return;
        uploadImageToImgBB(file, (url) => {
            editGroupPhotoUrl = url;
            document.getElementById('edit-group-img-preview').src = url;
        });
    };

    function saveGroupEditAction() {
        if(!activeChatTarget || !activeChatTarget.isGroup) return;
        const groupId = activeChatTarget.uid;
        const newName = document.getElementById('edit-group-name').value.trim();
        const newTitle = document.getElementById('edit-group-title').value.trim();

        if(!newName) return alert('গ্রুপের নাম খালি রাখা যাবে না!');

        db.ref('groups/' + groupId).update({
            name: newName,
            title: newTitle,
            photoURL: editGroupPhotoUrl
        }).then(() => {
            closeEditGroupModal();
            alert('গ্রুপ সফলভাবে আপডেট করা হয়েছে!');
        }).catch(err => {
            alert('গ্রুপ আপডেট করতে সমস্যা হয়েছে: ' + err.message);
        });
    }

    function uploadImageToImgBB(file, callback) {
        const formData = new FormData();
        formData.append("image", file);

        const uploadMsgBox = document.createElement('div');
        uploadMsgBox.style.cssText = "position:fixed; top:20px; left:50%; transform:translateX(-50%); background:#000; color:#fff; padding:8px 15px; border-radius:20px; font-size:12px; z-index:9999;";
        uploadMsgBox.innerText = "ছবি আপলোড হচ্ছে...";
        document.body.appendChild(uploadMsgBox);

        fetch(`https://api.imgbb.com/1/upload?key=${IMGBB_API_KEY}`, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.body.removeChild(uploadMsgBox);
            if (data && data.success) {
                callback(data.data.url);
            } else {
                alert("ছবি আপলোড ব্যর্থ হয়েছে!");
            }
        })
        .catch(err => {
            document.body.removeChild(uploadMsgBox);
            alert("নেটওয়ার্ক সমস্যা: " + err.message);
        });
    }

    function switchTab(tab) {
        const container = document.getElementById('main-content');
        container.innerHTML = '';
        document.querySelectorAll('.nav-item').forEach(btn => btn.classList.remove('active'));

        const lang = localStorage.getItem('appLang') || 'bn';
        const t = translations[lang] || translations['bn'];

        if (tab === 'chats') {
            document.getElementById('tab-btn-chats').classList.add('active');
            document.getElementById('page-title').innerText = t.navChats;
            document.getElementById('search-container').style.display = "flex";
            
            db.ref('groups').on('value', snapshot => {
                const existingGroups = container.querySelectorAll('.user-item');
                existingGroups.forEach(el => {
                    if(el.id && el.id.startsWith('group-card-')) el.remove();
                });

                snapshot.forEach(child => {
                    const group = child.val();
                    container.prepend(createGroupCard(group));
                });
            });

            db.ref('users').limitToLast(20).once('value', snapshot => {
                snapshot.forEach(child => {
                    if(child.val().uid !== currentUser.uid) container.appendChild(createUserCard(child.val()));
                });
            });
        } else if (tab === 'updates') {
            document.getElementById('tab-btn-updates').classList.add('active');
            document.getElementById('page-title').innerText = t.navUpdates;
            document.getElementById('search-container').style.display = "none";

            let storyHtml = `
                <div class="panel-box" style="margin-bottom:10px;">
                    <h3 style="margin:0 0 10px 0; font-size:15px;">${t.statusTitle}</h3>
                    <div class="story-container" id="story-list-container">
                        <div class="story-circle" onclick="document.getElementById('story-file-input').click()">
                            <div class="story-ring add-story-ring">＋</div>
                            <span>${t.myStory}</span>
                        </div>
                    </div>
                </div>
            `;
            container.innerHTML = storyHtml;

            document.getElementById('story-file-input').onchange = (e) => {
                const file = e.target.files[0];
                if(!file) return;
                pendingStoryFile = file;
                const reader = new FileReader();
                reader.onload = (evt) => {
                    document.getElementById('story-modal-preview').src = evt.target.result;
                    document.getElementById('story-caption-input').value = '';
                    document.getElementById('story-upload-modal').style.display = 'flex';
                };
                reader.readAsDataURL(file);
            };

            db.ref('stories').on('value', snapshot => {
                const storyContainer = document.getElementById('story-list-container');
                if(!storyContainer) return;
                storyContainer.innerHTML = `
                    <div class="story-circle" onclick="document.getElementById('story-file-input').click()">
                        <div class="story-ring add-story-ring">＋</div>
                        <span>${t.myStory}</span>
                    </div>
                `;
                
                const now = Date.now();
                snapshot.forEach(child => {
                    const st = child.val();
                    
                    if (st.expiresAt && now > st.expiresAt) {
                        db.ref('stories/' + st.uid).remove();
                        return;
                    }

                    const storyDiv = document.createElement('div');
                    storyDiv.className = 'story-circle';
                    
                    storyDiv.innerHTML = `
                        <div class="story-ring">
                            <img src="${st.storyImg}" class="no-download">
                        </div>
                        <span>${st.uid === currentUser.uid ? t.myStory : st.name}</span>
                    `;
                    
                    storyDiv.onclick = () => {
                        openFullscreenImage(st.storyImg, `${st.name}: ${st.caption || ''}`, st.uid);
                    };

                    let pressTimer;
                    const startPress = () => {
                        pressTimer = setTimeout(() => {
                            if (st.uid === currentUser.uid) {
                                if (confirm("আপনি কি আপনার এই স্টোরিটি ডিলিট করতে চান?")) {
                                    db.ref('stories/' + currentUser.uid).remove().then(() => {
                                        alert('স্টোরি ডিলিট করা হয়েছে!');
                                    });
                                }
                            }
                        }, 600);
                    };
                    const cancelPress = () => clearTimeout(pressTimer);

                    storyDiv.addEventListener('touchstart', startPress);
                    storyDiv.addEventListener('touchend', cancelPress);
                    storyDiv.addEventListener('touchmove', cancelPress);
                    storyDiv.addEventListener('mousedown', startPress);
                    storyDiv.addEventListener('mouseup', cancelPress);
                    storyDiv.addEventListener('mouseleave', cancelPress);

                    storyContainer.appendChild(storyDiv);
                });
            });

        } else if (tab === 'communities') {
            document.getElementById('tab-btn-communities').classList.add('active');
            document.getElementById('page-title').innerText = t.navCommunities;
            document.getElementById('search-container').style.display = "none";
            container.innerHTML = `<div class="panel-box"><p style="text-align:center;">${t.communitiesSoon}</p></div>`;
        } else if (tab === 'settings') {
            document.getElementById('tab-btn-settings').classList.add('active');
            document.getElementById('page-title').innerText = t.navSettings;
            document.getElementById('search-container').style.display = "none";

            db.ref('users/' + currentUser.uid).once('value', snapshot => {
                const userData = snapshot.val() || {};
                selectedProfileImageUrl = userData.photoURL || 'https://via.placeholder.com/150';

                container.innerHTML = `
                    <div class="settings-group">
                        <div class="profile-container-edit" onclick="document.getElementById('profile-file-input').click()" title="প্রোফাইল ছবি পরিবর্তন করতে ক্লিক করুন">
                            <img id="profile-preview-img" class="profile-preview no-download" src="${selectedProfileImageUrl}">
                            <div class="profile-edit-overlay">📷</div>
                        </div>
                        <input type="file" id="profile-file-input" accept="image/*" style="display:none;">

                        <div style="width:100%; background:#f0f2f5; padding:8px; border-radius:8px; font-size:13px; font-weight:bold; color:var(--primary-color); text-align:center;">
                            ${t.myIdText} ${userData.customID || 'ID-0000'}
                        </div>

                        <label>${t.updateNameLabel}</label>
                        <input type="text" id="update-name" value="${userData.name || ''}">

                        <label>${t.updateStatusLabel}</label>
                        <input type="text" id="update-status" value="${userData.statusText || ''}">

                        <label>${t.langLabel}</label>
                        <select id="global-lang-select" onchange="changeAppLanguage(this.value)">
                            <option value="bn" ${lang === 'bn' ? 'selected' : ''}>বাংলা (Bengali)</option>
                            <option value="en" ${lang === 'en' ? 'selected' : ''}>English</option>
                            <option value="hi" ${lang === 'hi' ? 'selected' : ''}>हिन्दी (Hindi)</option>
                            <option value="ar" ${lang === 'ar' ? 'selected' : ''}>العربية (Arabic)</option>
                            <option value="es" ${lang === 'es' ? 'selected' : ''}>Español (Spanish)</option>
                        </select>

                        <div class="setting-card-item">
                            <span>${t.notifSound}</span>
                            <input type="checkbox" checked style="width:18px; height:18px; cursor:pointer;">
                        </div>

                        <button class="save-btn" onclick="saveProfile()">${t.saveProfileBtn}</button>
                        <button class="logout-btn" onclick="auth.signOut()">${t.logoutBtn}</button>
                    </div>
                `;

                document.getElementById('profile-file-input').onchange = (e) => {
                    const file = e.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (evt) => {
                        document.getElementById('profile-preview-img').src = evt.target.result;
                    };
                    reader.readAsDataURL(file);

                    uploadImageToImgBB(file, (url) => {
                        selectedProfileImageUrl = url;
                        document.getElementById('profile-preview-img').src = selectedProfileImageUrl;
                        alert("ছবি আপলোড হচ্ছে");
                    });
                };
            });
        }
    }

    function closeStoryUploadModal() {
        document.getElementById('story-upload-modal').style.display = 'none';
        pendingStoryFile = function(){};
    }

    function shareStoryAsMessage() {
        if(!pendingStoryFile || !activeChatTarget) {
            alert('দয়া করে প্রথমে চ্যাট উইন্ডো ওপেন করে তারপর চ্যাটে ছবি পাঠান!');
            closeStoryUploadModal();
            return;
        }
        const reader = new FileReader();
        reader.onload = (evt) => {
            currentChatRef.push({
                sender: currentUser.uid,
                senderName: currentUser.displayName || 'User',
                image: evt.target.result,
                timestamp: firebase.database.ServerValue.TIMESTAMP
            });
            closeStoryUploadModal();
            alert('ছবিটি সফলভাবে চ্যাটে পাঠানো হয়েছে!');
        };
        reader.readAsDataURL(pendingStoryFile);
    }

    function confirmUploadStory() {
        if(!pendingStoryFile) return;
        const caption = document.getElementById('story-caption-input').value.trim();
        const currentTime = Date.now();
        const expireTime = currentTime + (24 * 60 * 60 * 1000);
        
        uploadImageToImgBB(pendingStoryFile, (imgData) => {
            db.ref('stories/' + currentUser.uid).set({
                uid: currentUser.uid,
                name: currentUser.displayName || 'User',
                photoURL: currentUser.photoURL || 'https://via.placeholder.com/150',
                storyImg: imgData,
                caption: caption,
                timestamp: currentTime,
                expiresAt: expireTime
            }).then(() => {
                closeStoryUploadModal();
                alert('স্টোরি সফলভাবে আপলোড হয়েছে!');
                switchTab('updates');
            });
        });
    }

    window.saveProfile = function() {
        const name = document.getElementById('update-name').value.trim();
        const statusText = document.getElementById('update-status').value.trim();
        const photoURL = selectedProfileImageUrl || currentUser.photoURL || '';

        currentUser.updateProfile({ displayName: name, photoURL: photoURL }).then(() => {
            db.ref('users/' + currentUser.uid).update({ name: name, photoURL: photoURL, statusText: statusText }).then(() => {
                alert('Profile Successful ✅');
            });
        });
    };
</script>
</body>
</html>
