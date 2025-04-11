<?php
require_once 'includes/header.php';

if (isset($_SESSION['novos_itens']) && is_array($_SESSION['novos_itens'])) {
    foreach ($_SESSION['novos_itens'] as $item) {
        $catalogo[] = $item;
    }
}
?>

<div class="jumbotron">
    <h1 class="display-4">Bem-vindo ao <?php echo SITE_NAME; ?></h1>
    <p class="lead">Descubra as diferentes raças de coelhos domésticos e selvagens.</p>
    <p>Explore nosso guia completo sobre as características, comportamentos e cuidados específicos de cada raça.</p>
    <a href="filtrar.php" class="btn btn-primary">Filtrar por Características</a>
</div>

<div class="row">
    <?php foreach ($catalogo as $item): ?>    <div class="col-md-4 col-lg-3 mb-4">
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
                
                <?php if (isset($item['avaliacao'])): ?>
                <div class="rating-container mb-2">
                    <?php echo exibirEstrelas($item['avaliacao']); ?>
                </div>
                <?php endif; ?>

                <div class="breed-info">
                    <div class="breed-characteristics">
                        <span class="breed-size">
                            <i class="fas fa-ruler"></i> <?php echo $item['tamanho'] ?? 'Médio'; ?>
                        </span>
                        <span class="care-level">
                            <i class="fas fa-heart"></i> <?php echo $item['nivel_cuidado'] ?? 'Moderado'; ?>
                        </span>
                    </div>
                </div>
                
                <a href="detalhes.php?id=<?php echo $item['id']; ?>" class="btn btn-primary mt-auto">
                    <i class="fas fa-paw"></i> Conhecer Raça
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
require_once 'includes/footer.php';
?>