<?php
require_once 'includes/header.php';

// Adiciona os itens da sessão (se existirem) ao catálogo
if (isset($_SESSION['novos_itens']) && is_array($_SESSION['novos_itens'])) {
    foreach ($_SESSION['novos_itens'] as $item) {
        $catalogo[] = $item;
    }
}

// Obter categorias e tipos
$categorias = getCategorias($catalogo);
$tipos = getTipos($catalogo);
$nivelDeCuidado = ['Fácil', 'Moderado', 'Alto'];

// Usar nossa nova função para filtrar os itens
$categoria_filtro = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$tipo_filtro = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$nome_filtro = isset($_GET['nome']) ? $_GET['nome'] : '';
$nivelDeCuidado_filtro = isset($_GET['nivel_cuidado']) ? $_GET['nivel_cuidado'] : 'Moderado';
$itens_filtrados = filtrarItens($catalogo, $categoria_filtro, $tipo_filtro, $nome_filtro, $nivelDeCuidado_filtro);
?>

<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Filtrar Raças</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card filter-card">
                <div class="card-header">
                    <h2 class="mb-0"><i class="fas fa-filter"></i> Filtrar Catálogo</h2>
                </div>
                <div class="card-body">
                    <form action="filtrar.php" method="GET" class="filter-form">
                        <div class="row align-items-end mb-4">
                            <div class="col-md-5">
                                <div class="form-group mb-md-0">
                                    <label for="categoria" class="form-label"><i class="fas fa-home"></i> Habitat:</label>
                                    <select name="categoria" id="categoria" class="form-select">
                                        <option value="">Todos os habitats</option>
                                        <?php foreach($categorias as $categoria): ?>
                                            <option value="<?php echo $categoria; ?>" <?php echo ($categoria_filtro === $categoria) ? 'selected' : ''; ?>>
                                                <?php echo $categoria; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mb-md-0">
                                    <label for="tipo" class="form-label"><i class="fas fa-ruler"></i> Porte:</label>
                                    <select name="tipo" id="tipo" class="form-select">
                                        <option value="">Todos os portes</option>
                                        <?php foreach($tipos as $tipo): ?>
                                            <option value="<?php echo $tipo; ?>" <?php echo ($tipo_filtro === $tipo) ? 'selected' : ''; ?>>
                                                <?php echo $tipo; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-filter w-100">
                                    <i class="fas fa-search"></i> Filtrar
                                </button>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <label class="form-label mb-3"><i class="fas fa-heart"></i> Nível de Cuidado</label>
                                <div class="care-level-group" role="group">
                                    <input type="radio" class="btn-check" name="nivel_cuidado" id="facil" value="Fácil" autocomplete="off">
                                    <label class="btn btn-outline-care" for="facil">Fácil</label>

                                    <input type="radio" class="btn-check" name="nivel_cuidado" id="moderado" value="Moderado" autocomplete="off">
                                    <label class="btn btn-outline-care" for="moderado">Moderado</label>

                                    <input type="radio" class="btn-check" name="nivel_cuidado" id="alto" value="Alto" autocomplete="off">
                                    <label class="btn btn-outline-care" for="alto">Alto</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div><br></div>
    
    <div class="results-summary mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0">
                <i class="fas fa-list"></i> 
                Resultados encontrados: <?php echo count($itens_filtrados); ?>
            </h3>
            <?php if ($categoria_filtro || $tipo_filtro): ?>
                <a href="filtrar.php" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Limpar Filtros
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <?php if (empty($itens_filtrados)): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Nenhuma raça encontrada com os filtros selecionados.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($itens_filtrados as $item): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <div class="card-image-wrapper">
                            <img src="<?php echo $item['imagem']; ?>" class="card-img-top" alt="<?php echo $item['titulo']; ?>">
                            <div class="card-badges">
                                <span class="badge badge-categoria"><?php echo $item['categoria']; ?></span>
                                <span class="badge badge-tipo"><?php echo $item['tipo']; ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item['titulo']; ?></h5>
                            <p class="card-text"><?php echo truncarTexto($item['descricao'], 100); ?></p>
                            
                            <?php $cuidadoInfo = getNivelCuidadoInfo($item['nivel_cuidado'] ?? 'Moderado'); ?>
                            <div class="breed-info">
                                <div class="breed-characteristics">
                                    <span class="breed-size">
                                        <i class="fas fa-ruler"></i> <?php echo $item['tamanho']; ?>
                                    </span>
                                    <span class="care-level">
                                        <i class="<?php echo $cuidadoInfo['icon']; ?>"></i> <?php echo $item['nivel_cuidado']; ?>
                                    </span>
                                </div>
                                <a href="detalhes.php?id=<?php echo $item['id']; ?>" class="btn btn-primary mt-3">
                                    <i class="fas fa-paw"></i> Conhecer Raça
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>