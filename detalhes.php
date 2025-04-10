<?php
require_once 'includes/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (isset($_SESSION['novos_itens']) && is_array($_SESSION['novos_itens'])) {
    foreach ($_SESSION['novos_itens'] as $item) {
        $catalogo[] = $item;
    }
}

$item = buscarItemPorId($catalogo, $id);

if (!$item) {
    header('Location: index.php');
    exit;
}
?>

<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $item['titulo']; ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="image-container">
                <img src="<?php echo $item['imagem']; ?>" class="detalhes-imagem img-fluid" alt="<?php echo $item['titulo']; ?>">
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="detalhes-conteudo">
                <h1 class="mb-3"><?php echo $item['titulo']; ?></h1>
                
                <div class="detalhes-badges mb-4">
                    <span class="badge badge-categoria">
                        <i class="fas fa-home"></i> <?php echo $item['categoria']; ?>
                    </span>
                    <span class="badge badge-tipo">
                        <i class="fas fa-ruler"></i> <?php echo $item['tipo']; ?>
                    </span>
                </div>

                <div class="breed-info p-4 mb-4">
                    <?php $cuidadoInfo = getNivelCuidadoInfo($item['nivel_cuidado'] ?? 'Moderado'); ?>
                    <h4 class="mb-3"><i class="fas fa-info-circle"></i> Informações Principais</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-weight"></i>
                            <strong>Peso Médio:</strong> <?php echo $item['peso_medio']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-ruler-vertical"></i>
                            <strong>Tamanho:</strong> <?php echo $item['tamanho'] ?? 'Médio'; ?>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-heart"></i>
                            <strong>Temperamento:</strong> <?php echo $item['temperamento']; ?>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-heartbeat"></i>
                            <strong>Expectativa de Vida:</strong> <?php echo $item['expectativa_vida']; ?>
                        </li>
                        <li>
                            <i class="fas fa-home"></i>
                            <strong>Habitat:</strong> <?php echo $item['habitat'] ?? 'Doméstico'; ?>
                        </li>
                    </ul>
                </div>

                <div class="descricao-container mb-4">
                    <h4 class="mb-3"><i class="fas fa-book"></i> Sobre a Raça</h4>
                    <p class="lead"><?php echo $item['descricao']; ?></p>
                </div>

                <?php if (isset($item['avaliacao'])): ?>
                <div class="caracteristicas-container">
                    <h4 class="mb-3"><i class="fas fa-star"></i> Características da Raça</h4>
                    <?php echo formatarCaracteristicas($item); ?>
                </div>
                <?php endif; ?>

                <div class="nivel-cuidado mt-4">
                    <h4 class="mb-3"><i class="fas fa-hand-holding-heart"></i> Nível de Cuidado</h4>
                    <div class="alert alert-info">
                        <i class="<?php echo $cuidadoInfo['icon']; ?>"></i>
                        <strong><?php echo $item['nivel_cuidado']; ?></strong>
                        <p class="mb-0 mt-2"><?php echo $cuidadoInfo['desc']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>