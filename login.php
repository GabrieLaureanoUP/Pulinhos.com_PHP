<?php
require_once 'includes/header.php';

$erro = '';
$sucesso = false;
$mensagem_timeout = '';

// Verificar se houve timeout da sessão
if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
    $mensagem_timeout = 'Sua sessão expirou por inatividade. Por favor, faça login novamente.';
}

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Debug temporário
    error_log("Tentativa de login - Usuario: " . $username);
    error_log("Hash armazenada: " . (isset($users[$username]) ? $users[$username] : 'usuário não encontrado'));
    error_log("Resultado verify: " . (password_verify($password, $users[$username]) ? 'true' : 'false'));
    
    // Verificar se o usuário existe e a senha está correta usando password_verify
    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        // Login bem-sucedido
        $_SESSION['logado'] = true;
        $_SESSION['username'] = $username;
        
        // Inicializar o array de novos itens se não existir
        if (!isset($_SESSION['novos_itens'])) {
            $_SESSION['novos_itens'] = [];
        }
        
        $sucesso = true;
          // Redirecionar para a área protegida após 2 segundos        header("refresh:2;url=protegido.php");
    } else {
        $erro = 'Usuário ou senha incorretos.';
    }
}
?>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="login-card card">
                    <div class="card-header">
                        <h2 class="text-center mb-0"><i class="fas fa-user-lock"></i> Login</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($sucesso): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Login realizado com sucesso! Você será redirecionado em instantes...
                            </div>
                        <?php else: ?>                            <?php if ($mensagem_timeout): ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock"></i> <?php echo $mensagem_timeout; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($erro): ?>
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $erro; ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="login.php">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="username" class="form-control" placeholder="Usuário" required autofocus>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="Senha" required>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Entrar
                                </button>                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>