<?php
session_start();
if ($_SESSION['usuario'] == NULL || $_SESSION['password'] == NULL) {
    header("location: ../usuario/login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="../../dist/img/logo-single.png" type="image/x-icon">
    <title>g-stock</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../dist/css/mycss.css">
</head>
<body class="hold-transition sidebar-mini roboto-condensed">
<div class="wrapper">
    <!-- Navbar -->
    <?php include('../componentes/nav.php') ?>
    <!-- /.navbar -->
    <?php include('../componentes/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="col-md-12 mt-3">
            <!-- general form elements -->
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-people-arrows nav-icon"></i> Alterar Fornecedor</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?php
                require_once('../../back/controllers/FornecedorController.php');
                $f = new FornecedorController();
                $fornecedores = $f->listUniqueFornecedor($_GET['idfornecedor']);
                foreach ($fornecedores as $value) {
                    ?>
                    <form role="form" id="fornecedorform" method="post">
                        <input type="hidden" name="edit" value="1">
                        <input type="hidden" name="idfornecedor" value="<?= $_GET['idfornecedor'] ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-normal" for="exampleInputEmail1">Nome</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       placeholder="Qual nome do forncedor?" name="fornecedor"
                                       value="<?= $value->nome_fornecedor ?>">
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label class="font-weight-normal">Telefone</label>
                                        <input type="text" class="form-control" placeholder="Número p/ contato"
                                               name="telefone_fornecedor" value="<?= $value->contato_fornecedor ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label class="font-weight-normal">E-mail</label>
                                        <input type="email" class="form-control" placeholder="E-mail p/ contato"
                                               name="email_fornecedor" value="<?= $value->email_fornecedor ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label class="font-weight-normal">CPF/CNPJ</label>
                                        <input type="text" class="form-control"
                                               placeholder="Identificação do fornecedor"
                                               name="cnpj_fornecedor" value="<?= $value->cnpj_f ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-normal">Endereço</label>
                                <textarea class="form-control" rows="3" placeholder="Onde ele se localiza?"
                                          name="endereco_fornecedor"><?= $value->endereco_f ?></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success col-md-2">Alterar</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <!-- general form elements -->
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-people-arrows nav-icon"></i> Produtos Fornececidos</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        $produtosFornecedor = $f->listProdFornecedores($_GET['idfornecedor']);
                        foreach ($produtosFornecedor as $prod):
                            ?>

                            <li class="list-group-item"><?= $prod->produto_e ?></li>


                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include('../componentes/footer.php'); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- RequestAJAX -->
<script src="../../requests/fornecedores-ajax/post-fornecedores.js"></script>
</body>
</html>
