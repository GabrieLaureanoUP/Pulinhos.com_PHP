<?php
require_once 'includes/header.php';
?>

<div class="container guide-container">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Guia de Cuidados</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="guide-header text-center mb-5">
        <h1>Guia Completo de Cuidados com Coelhos</h1>
        <p class="guide-subtitle">Descubra tudo o que você precisa saber para garantir uma vida saudável e feliz para seu coelho.</p>
    </div>

    <div class="row guide-content">
        <div class="col-lg-6 mb-4">
            <div class="guide-card food-card">
                <div class="card-icon">
                    <i class="fas fa-carrot"></i>
                </div>
                <h2>Alimentação</h2>
                <div class="guide-section">
                    <h3>Dieta Básica</h3>
                    <ul>
                        <li>Feno fresco e de qualidade (80% da dieta diária)</li>
                        <li>Vegetais frescos (15% da dieta)</li>
                        <li>Ração específica para coelhos (5% da dieta)</li>
                        <li>Água limpa e fresca sempre disponível</li>
                    </ul>
                </div>
                <div class="guide-section">
                    <h3>Vegetais Recomendados</h3>
                    <div class="food-grid">
                        <div class="food-item">Cenoura</div>
                        <div class="food-item">Couve</div>
                        <div class="food-item">Salsinha</div>
                        <div class="food-item">Rúcula</div>
                        <div class="food-item">Almeirão</div>
                        <div class="food-item">Chicória</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="guide-card environment-card">
                <div class="card-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h2>Ambiente</h2>
                <div class="guide-section">
                    <h3>Espaço Adequado</h3>
                    <ul>
                        <li>Gaiola espaçosa (mínimo 1m² para um coelho)</li>
                        <li>Área para exercícios diários</li>
                        <li>Local protegido de sol direto e chuva</li>
                        <li>Temperatura ideal entre 15-21°C</li>
                    </ul>
                </div>
                <div class="guide-section">
                    <h3>Itens Essenciais</h3>
                    <ul>
                        <li>Comedouro para feno</li>
                        <li>Bebedouro com água fresca</li>
                        <li>Caixa de areia com substrato apropriado</li>
                        <li>Brinquedos seguros para roer</li>
                        <li>Esconderijos e túneis</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="guide-card health-card">
                <div class="card-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>Cuidados de Saúde</h2>
                <div class="guide-section">
                    <h3>Cuidados Básicos</h3>
                    <ul>
                        <li>Vacinação anual</li>
                        <li>Castração recomendada</li>
                        <li>Corte regular das unhas</li>
                        <li>Escovação semanal</li>
                        <li>Consultas veterinárias regulares</li>
                    </ul>
                </div>
                <div class="alert alert-warning">
                    <h3>Sinais de Alerta</h3>
                    <ul>
                        <li>Falta de apetite</li>
                        <li>Letargia</li>
                        <li>Diarreia ou ausência de fezes</li>
                        <li>Secreção nasal ou ocular</li>
                        <li>Inclinação da cabeça</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="guide-card facts-card">
                <div class="card-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h2>Curiosidades</h2>
                <div class="guide-section facts-grid">
                    <div class="fact-item">
                        <i class="fas fa-clock"></i>
                        <p>Vivem entre 8-12 anos com cuidados adequados</p>
                    </div>
                    <div class="fact-item">
                        <i class="fas fa-moon"></i>
                        <p>São mais ativos ao amanhecer e anoitecer</p>
                    </div>
                    <div class="fact-item">
                        <i class="fas fa-eye"></i>
                        <p>Possuem visão quase 360 graus</p>
                    </div>
                    <div class="fact-item">
                        <i class="fas fa-arrows-alt-v"></i>
                        <p>Podem pular até 1 metro de altura</p>
                    </div>
                    <div class="fact-item">
                        <i class="fas fa-users"></i>
                        <p>São animais sociais e muito afetuosos</p>
                    </div>
                    <div class="fact-item">
                        <i class="fas fa-smile"></i>
                        <p>Rangem os dentes quando estão felizes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
