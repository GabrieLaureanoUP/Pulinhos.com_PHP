<?php
function getCategorias($array) {
    $categorias = [];
    foreach ($array as $item) {
        if (!in_array($item['categoria'], $categorias)) {
            $categorias[] = $item['categoria'];
        }
    }
    return $categorias;
}

function getTipos($array) {
    $tipos = [];
    foreach ($array as $item) {
        if (!in_array($item['tipo'], $tipos)) {
            $tipos[] = $item['tipo'];
        }
    }
    return $tipos;
}

function formatarCaracteristicas($item) {
    $caracteristicas = [];
    if (isset($item['peso_medio'])) $caracteristicas[] = "Peso: " . $item['peso_medio'];
    if (isset($item['temperamento'])) $caracteristicas[] = "Temperamento: " . $item['temperamento'];
    if (isset($item['expectativa_vida'])) $caracteristicas[] = "Expectativa de vida: " . $item['expectativa_vida'];
    return implode(' | ', $caracteristicas);
}

function formatarData($data) {
    $timestamp = strtotime($data);
    return date('d/m/Y', $timestamp);
}

function truncarTexto($texto, $limite = 100) {
    if (strlen($texto) <= $limite) {
        return $texto;
    }
    
    $textoLimitado = substr($texto, 0, $limite);
    return $textoLimitado . '...';
}

function buscarItemPorId($array, $id) {
    foreach ($array as $item) {
        if ($item['id'] == $id) {
            return $item;
        }
    }
    return null;
}

function filtrarItens($array, $categoria = null, $tipo = null, $nome = null, $nivelCuidado = null) {
    $resultado = $array;
    
    if ($categoria) {
        $resultado = array_filter($resultado, function($item) use ($categoria) {
            return $item['categoria'] === $categoria;
        });
    }
    
    if ($tipo) {
        $resultado = array_filter($resultado, function($item) use ($tipo) {
            return $item['tipo'] === $tipo;
        });
    }
      if ($nome) {
        $resultado = array_filter($resultado, function($item) use ($nome) {
            return stripos($item['titulo'], $nome) !== false;
        });
    }
    
    if ($nivelCuidado) {
        $resultado = array_filter($resultado, function($item) use ($nivelCuidado) {
            return isset($item['nivel_cuidado']) && $item['nivel_cuidado'] === $nivelCuidado;
        });
    }
    
    return $resultado;
}

function getNivelCuidadoInfo($nivel) {
    $info = [
        'Fácil' => [
            'icon' => 'fas fa-smile',
            'desc' => 'Ideal para iniciantes, requer cuidados básicos'
        ],
        'Moderado' => [
            'icon' => 'fas fa-meh',
            'desc' => 'Necessita atenção regular e alguns cuidados específicos'
        ],
        'Alto' => [
            'icon' => 'fas fa-clipboard-list',
            'desc' => 'Requer cuidados especiais e atenção constante'
        ],
        'Natural' => [
            'icon' => 'fas fa-leaf',
            'desc' => 'Espécie selvagem, adaptada ao habitat natural'
        ]
    ];
    
    return isset($info[$nivel]) ? $info[$nivel] : [
        'icon' => 'fas fa-question-circle',
        'desc' => 'Nível de cuidado não especificado'
    ];
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
}

function verificarSenha($password, $hash) {
    return password_verify($password, $hash);
}
function validarForcaSenha($password) {
    // Mínimo 8 caracteres
    if (strlen($password) < 8) {
        return false;
    }
    
    // Deve conter pelo menos um número
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    
    // Deve conter pelo menos uma letra maiúscula
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    
    // Deve conter pelo menos uma letra minúscula
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }
    
    return true;
}
?>