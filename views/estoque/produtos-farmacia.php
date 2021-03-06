<?php
session_start();
if ($_SESSION['usuario'] == null || $_SESSION['password'] == null) {
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
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../dist/css/mycss.css">
    <style>
        #tabela {
            display: none;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini roboto-condensed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include '../componentes/nav.php'?>
    <!-- /.navbar -->
    <?php include '../componentes/sidebar.php'?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="col-md-12 mt-3">
            <!-- general form elements -->
            <?php if ($_SESSION['usuario'] == 'compras.hvu' or $_SESSION['usuario'] == 'admin'): ?>
                <div class="card card-olive">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-flask"></i>
                            Cadastro de Materiais & Medicamentos
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" id="estoqueform" method="post">
                        <input type="hidden" name="new" value="1">
                        <input type="hidden" name="usuario" value="<?=$_SESSION['usuario']?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-normal" for="exampleInputEmail1">Principio Ativo</label>
                                    <input type="text" name="p_ativo" class="form-control" id="inputEmail3">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-normal"  for="exampleInputEmail1">Nome Comercial</label>
                                    <input type='text' class='form-control' name='produto_e' placeholder='' required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="font-weight-normal"  for="exampleInputEmail1">Apresentação</label>
                                    <input type='text' class='form-control ' name='apresentacao' placeholder=''>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="font-weight-normal"  for="exampleInputEmail1">Forma Farmacêutica</label>
                                    <input type="text" class="form-control" name="forma_farmaceutica" id="inputEmail4"
                                           placeholder="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-weight-normal"  for="exampleInputEmail1">Concentração</label>
                                    <input type="text" class="form-control" name="concentracao" id="inputEmail4"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-normal"  for="exampleInputEmail1">Estoque Mínimo</label>
                                    <input type="number" class="form-control" name="estoque_minimo_e" id="inputEmail4"
                                           placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-normal"  for="exampleInputEmail1">Quantidade</label>
                                    <input type="number" class="form-control" name="quantidade_e" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-normal"  for="exampleInputEmail1">Valor Unitário</label>
                                    <input type='text' class='form-control ' name='valor_un' placeholder='R$'>
                                    <small>Utilize ponto no lugar da vírgula</small>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-gradient-teal col-md-2 elevation-2">Cadastrar</button>
                        </div>
                    </form>
                </div>
            <?php endif;?>
            <!-- /.card -->
            <div class="card" id="tabela">
                <div class="card-header bg-olive">
                    <h3 class="card-title">Produtos & Materiais Farmacêuticos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="">Princípio Ativo</th>
                            <th class="">Nome Comercial / Material</th>
                            <th class="">Quantidade</th>
                            <th class="">Valor Uni.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
require_once '../../back/controllers/EstoqueController.php';
$view_estoque = new EstoqueController();
$all_estoque = $view_estoque->verEstoqueFarmacia();
foreach ($all_estoque as $v) {
    ?>
                            <tr>
                                <td><?=$v->principio_ativo?></td>
                                <td><a class="text-olive" href=nav/put-produto-view.php?idp=<?=$v->id_estoque?>><?=$v->produto_e?></td>
                                <td><?=$v->quantidade_e?></td>
                                <td><?=$v->valor_un_e?></td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </div>
    <!-- /.content-wrapper -->

    <?php include '../componentes/footer.php';?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../dist/js/dataTableCustom.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- RequestAJAX -->
<script src="../../requests/produtos-ajax/post-cadastro-produto.js"></script>
</body>
</html>
