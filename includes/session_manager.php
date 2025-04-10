<?php
// Iniciar ou retomar a sessão com configurações seguras
function init_session() {
    // Configurar opções seguras para a sessão
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 1);
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Verificar timeout da sessão (30 minutos)
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header('Location: login.php?timeout=1');
        exit;
    }
    
    // Regenerar ID da sessão periodicamente para prevenir fixação de sessão
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } else if (time() - $_SESSION['created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }
    
    // Atualizar último acesso
    $_SESSION['last_activity'] = time();
}

// Verificar se o usuário está autenticado
function check_auth() {
    init_session();
    if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
        header('Location: login.php');
        exit;
    }
}

// Função para logout seguro
function logout() {
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    header('Location: login.php');
    exit;
}
?>
