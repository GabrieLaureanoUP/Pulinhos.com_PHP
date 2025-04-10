<?php
require_once 'includes/header.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
    header('Location: login.php');
    exit;
}

// Lógica para deletar um item específico
if (isset($_POST['delete_item']) && isset($_POST['item_id'])) {
    $item_id = intval($_POST['item_id']);
    if (isset($_SESSION['novos_itens'])) {
        foreach ($_SESSION['novos_itens'] as $key => $item) {
            if ($item['id'] === $item_id) {
                unset($_SESSION['novos_itens'][$key]);
                $_SESSION['novos_itens'] = array_values($_SESSION['novos_itens']); // Reindexar o array
                $mensagem = 'Item deletado com sucesso!';
                $tipo_mensagem = 'success';
                break;
            }
        }
    }
}

// Lógica para deletar todos os itens
if (isset($_POST['delete_all'])) {
    $_SESSION['novos_itens'] = [];
    $mensagem = 'Todos os itens foram deletados com sucesso!';
    $tipo_mensagem = 'success';
}

$mensagem = isset($mensagem) ? $mensagem : '';
$tipo_mensagem = isset($tipo_mensagem) ? $tipo_mensagem : '';

// Verificar se um novo item foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete_item']) && !isset($_POST['delete_all'])) {
    // Validação simples para criação de nova raça
    if (empty($_POST['titulo']) || empty($_POST['categoria']) || empty($_POST['tipo']) || empty($_POST['descricao'])) {
        $mensagem = 'Por favor, preencha todos os campos obrigatórios.';
        $tipo_mensagem = 'danger';
    } else {
        // Inicializar o array de novos itens se não existir
        if (!isset($_SESSION['novos_itens'])) {
            $_SESSION['novos_itens'] = [];
        }

        // Encontrar o maior ID atual
        $maior_id = 0;
        foreach ($catalogo as $item) {
            if ($item['id'] > $maior_id) {
                $maior_id = $item['id'];
            }
        }
        
        if (isset($_SESSION['novos_itens']) && !empty($_SESSION['novos_itens'])) {
            foreach ($_SESSION['novos_itens'] as $item) {
                if ($item['id'] > $maior_id) {
                    $maior_id = $item['id'];
                }
            }
        }

        // Criar o novo item com informações da raça
        $novo_item = [
            'id' => $maior_id + 1,
            'titulo' => $_POST['titulo'],
            'categoria' => $_POST['categoria'],
            'tipo' => $_POST['tipo'],
            'descricao' => $_POST['descricao'],
            'imagem' => !empty($_POST['imagem']) ? $_POST['imagem'] : 'assets/images/default.jpg',
            'tamanho' => $_POST['tipo'],
            'nivel_cuidado' => $_POST['nivel_cuidado'],
            'peso_medio' => $_POST['peso_medio'],
            'temperamento' => $_POST['temperamento'],
            'expectativa_vida' => $_POST['expectativa_vida'],
            'habitat' => $_POST['categoria']
        ];
        
        // Adicionar o novo item à sessão
        $_SESSION['novos_itens'][] = $novo_item;
        
        $mensagem = 'Raça cadastrada com sucesso!';
        $tipo_mensagem = 'success';
    }
}

// Obter categorias e tipos existentes para o formulário
$categorias = getCategorias($catalogo);
$tipos = getTipos($catalogo);
?>

<div class="container">
    <div class="area-restrita">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-plus-circle"></i> Adicionar Nova Raça</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($mensagem): ?>
                            <div class="alert-restrita alert-<?php echo $tipo_mensagem; ?>">
                                <i class="fas fa-<?php echo $tipo_mensagem === 'success' ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
                                <?php echo $mensagem; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="protegido.php" class="form-restrita">
                            <div class="form-section">
                                <h3 class="section-title"><i class="fas fa-info-circle"></i> Informações Básicas</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="titulo" class="form-label">
                                                <i class="fas fa-font"></i> Nome da Raça
                                            </label>
                                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="imagem" class="form-label">
                                                <i class="fas fa-image"></i> URL da Imagem
                                            </label>
                                            <input type="url" class="form-control" id="imagem" name="imagem" placeholder="http://...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h3 class="section-title"><i class="fas fa-paw"></i> Características</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria" class="form-label">
                                                <i class="fas fa-home"></i> Habitat
                                            </label>
                                            <select class="form-control" id="categoria" name="categoria" required>
                                                <option value="">Selecione...</option>
                                                <option value="Doméstico">Doméstico</option>
                                                <option value="Selvagem">Selvagem</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo" class="form-label">
                                                <i class="fas fa-ruler"></i> Porte
                                            </label>
                                            <select class="form-control" id="tipo" name="tipo" required>
                                                <option value="">Selecione...</option>
                                                <option value="Pequeno Porte">Pequeno Porte</option>
                                                <option value="Médio Porte">Médio Porte</option>
                                                <option value="Grande Porte">Grande Porte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nivel_cuidado" class="form-label">
                                                <i class="fas fa-heart"></i> Nível de Cuidado
                                            </label>
                                            <select class="form-control" id="nivel_cuidado" name="nivel_cuidado" required>
                                                <option value="">Selecione...</option>
                                                <option value="Fácil">Fácil</option>
                                                <option value="Moderado">Moderado</option>
                                                <option value="Alto">Alto</option>
                                                <option value="Natural">Natural (Selvagem)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h3 class="section-title"><i class="fas fa-clipboard-list"></i> Detalhes Específicos</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="peso_medio" class="form-label">
                                                <i class="fas fa-weight"></i> Peso Médio
                                            </label>
                                            <input type="text" class="form-control" id="peso_medio" name="peso_medio" placeholder="Ex: 2-3 kg" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="temperamento" class="form-label">
                                                <i class="fas fa-smile"></i> Temperamento
                                            </label>
                                            <input type="text" class="form-control" id="temperamento" name="temperamento" placeholder="Ex: Dócil e Sociável" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expectativa_vida" class="form-label">
                                                <i class="fas fa-heartbeat"></i> Expectativa de Vida
                                            </label>
                                            <input type="text" class="form-control" id="expectativa_vida" name="expectativa_vida" placeholder="Ex: 8-10 anos" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h3 class="section-title"><i class="fas fa-align-left"></i> Descrição Detalhada</h3>
                                <div class="form-group">
                                    <textarea class="form-control" id="descricao" name="descricao" rows="4" 
                                        placeholder="Descreva as características principais, comportamento e cuidados específicos desta raça..." required></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn-cadastrar">
                                <i class="fas fa-save"></i> Cadastrar Nova Raça
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['novos_itens']) && !empty($_SESSION['novos_itens'])): ?>
        <div class="row itens-cadastrados">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2><i class="fas fa-list"></i> Raças Cadastradas</h2>
                            <form method="POST" class="m-0">
                                <button type="submit" name="delete_all" class="btn-excluir-todos">
                                    <i class="fas fa-trash-alt"></i> Apagar Todas
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($_SESSION['novos_itens'] as $item): ?>
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100">
                                        <img src="<?php echo $item['imagem'] ?: 'assets/images/default.jpg'; ?>" 
                                            class="card-img-top" alt="<?php echo $item['titulo']; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $item['titulo']; ?></h5>
                                            <div class="breed-characteristics">
                                                <span class="characteristic-tag">
                                                    <i class="fas fa-home"></i> <?php echo $item['categoria']; ?>
                                                </span>
                                                <span class="characteristic-tag">
                                                    <i class="fas fa-ruler"></i> <?php echo $item['tipo']; ?>
                                                </span>
                                            </div>
                                            <div class="btn-group">
                                                <a href="detalhes.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">
                                                    <i class="fas fa-info-circle"></i> Detalhes
                                                </a>
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                                    <button type="submit" name="delete_item" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i> Deletar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>