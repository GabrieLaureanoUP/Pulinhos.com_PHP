<?php
function init_session() {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 1);
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header('Location: login.php?timeout=1');
        exit;
    }
    
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } else if (time() - $_SESSION['created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }
    
    $_SESSION['last_activity'] = time();
}

function check_auth() {
    init_session();
    if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
        header('Location: login.php');
        exit;
    }
}

function logout() {
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    header('Location: login.php');
    exit;
}
?>
