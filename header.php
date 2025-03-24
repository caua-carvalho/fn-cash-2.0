<?php

// NOME DO ARQUIVO ATUAL
$arquivo = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FN-CASH - Sistema de Controle Financeiro Pessoal</title>
    
    <!-- Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!-- DatePicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <!-- DatePicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    
    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

    <!-- ICONE NA GUIA -->
    <link rel="icon" type="image/svg+xml" href="../img/icone.svg">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <a href="index.php" class="sidebar-brand d-flex justify-content align-items">
                    <img src="../img/logo_escrita.svg" alt="FN-CASH" style="width:auto; height: 2rem;">
                </a>
                <button type="button" id="sidebarCollapseBtn" class="d-md-none">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            
            <div class="sidebar-user">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="user-details">
                        <span class="user-name">Usuário</span>
                        <a href="perfil.php" class="user-profile-link">Ver perfil</a>
                    </div>
                </div>
            </div>
            
            <ul class="sidebar-menu">
                <li class="sidebar-item <?php echo ($arquivo == "dashboard.php" ? "active" : "");  ?>">
                    <a href="dashboard.php" class="sidebar-link">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo ($arquivo == "transacoes.php" ? "active" : "");  ?>">
                    <a href="transacoes.php" class="sidebar-link">
                        <i class="bi bi-arrow-left-right"></i>
                        <span>Transações</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo ($arquivo == "contas.php" ? "active" : "");  ?>">
                    <a href="contas.php" class="sidebar-link">
                        <i class="bi bi-wallet2"></i>
                        <span>Contas</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo ($arquivo == "orcamentos.php" ? "active" : "");  ?>">
                    <a href="orcamentos.php" class="sidebar-link">
                        <i class="bi bi-pie-chart"></i>
                        <span>Orçamentos</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo ($arquivo == "metas.php" ? "active" : "");  ?>">
                    <a href="metas.php" class="sidebar-link">
                        <i class="bi bi-bullseye"></i>
                        <span>Metas</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo ($arquivo == "relatorios.php" ? "active" : "");  ?>">
                    <a href="relatorios.php" class="sidebar-link">
                        <i class="bi bi-bar-chart"></i>
                        <span>Relatórios</span>
                    </a>
                </li>
                
                <li class="sidebar-header">Outros</li>
                
                <li class="sidebar-item <?php echo ($arquivo == "categorias.php" ? "active" : "");  ?>">
                    <a href="categorias.php" class="sidebar-link">
                        <i class="bi bi-tags"></i>
                        <span>Categorias</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="contas_recorrentes.php" class="sidebar-link">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Contas Recorrentes</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="investimentos.php" class="sidebar-link">
                        <i class="bi bi-graph-up"></i>
                        <span>Investimentos</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="configuracoes.php" class="sidebar-link">
                        <i class="bi bi-gear"></i>
                        <span>Configurações</span>
                    </a>
                </li>
                
                <li class="sidebar-footer">
                    <a href="logout.php" class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sair</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Page Content -->
        <div id="content">
            <!-- Navbar superior -->
            <nav class="navbar navbar-expand navbar-light top-navbar">
                <button type="button" id="sidebarCollapse" class="btn">
                    <i class="bi bi-list"></i>
                </button>
                
                <div class="navbar-search ml-auto d-none d-md-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar...">
                        <div class="input-group-append">
                            <button class="btn" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge badge-danger badge-counter">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown">
                            <div class="dropdown-header">Notificações</div>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <span>Conta de luz próxima ao vencimento</span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-info-circle text-info"></i>
                                <span>Orçamento de Alimentação quase atingido</span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-check-circle text-success"></i>
                                <span>Meta de economia atingida</span>
                            </a>
                            <div class="dropdown-footer">
                                <a href="#">Ver todas</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            
            <!-- Conteúdo principal -->
            <main class="content-container py-4">