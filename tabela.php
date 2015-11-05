<?php  

    //Define as variáveis como vazio, caso não entre no if.
    $valorFinanciado = 0;
    $valorEntrada = 0;
    $prazoPagamento = 0;
    $prazoCarencia = 0;
    $taxaAnual = null;
    $operacao = null;

    //Obtém as variáveis do Browser via GET, caso elas existam.

    if(isset($_GET["vf"])){
        $valorFinanciado = str_replace(".", "", $_GET["vf"]);
    }

    if(isset($_GET["ve"])){
        $valorEntrada  = str_replace(".", "", $_GET["ve"]);
    }

    if(isset($_GET["pp"])){
        $prazoPagamento = $_GET["pp"];
    }

    if(isset($_GET["pc"])){
        $prazoCarencia = $_GET["pc"];
    }

    if(isset($_GET["operacao"])){
        $operacao = $_GET["operacao"];
    }  

    //Define taxa de juros baseado na operacao
    switch ($operacao) {
        case 'FCO':
            $taxaAnual = 0.07;
            break;
        case 'PROGER':
            $taxaAnual = 0.085;
            break;
        case 'BNDES':
            $taxaAnual = 0.12;
            break;
        case 'FINAME':
            $taxaAnual = 0.065;
            break;
        case 'SUDECO':
            $taxaAnual = 0.075;
            break;
        case 'SUDENE':
            $taxaAnual = 0.035;
            break;                                                                        
        default:
            //Default FCO
            $taxaAnual = 0.07;
            break;
    }      

    //Fórmula da taxa de juros mensal
    $taxaJurosMensal = pow((1 + $taxaAnual),(1/12))-1;

    //Calculo da primeira prestação       
    $primeiraPrestacao = $valorFinanciado * ( $taxaJurosMensal + 1 / $prazoPagamento);  
 
?>

<?php include('util.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- tag importante para responsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simulador de Financiamento Consultoria LU's">
    <meta name="author" content="Leandro Rezende">

    <title>Simulador <?php echo $operacao; ?> - Consultoria Lu's</title>

    <!-- font google -->
    <link href='http://fonts.googleapis.com/css?family=open+sans' rel='stylesheet' type='text/css'>

    <!-- css do bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/vendor/bootstrap.min.css"> -->

    <!-- meu css -->
    <link href="css/theme.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

    <body>


        <!-- o conteúdo fica boxed -->
        <div class="container">

            <section id ="header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 logoHeader">
                        <div><a href="http://www.consultorialus.com"><img src="img/logo.png" alt="ConsultoriaLogo  Lus"></a></div>
                    </div> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 titleHeader">
                        <div><img src="img/img1.png" alt="Simulador de Financiamento"></div>
                    </div>
                </div>
            </section>

            <section id="menu">

                  <!-- Static navbar -->
                  <nav class=" navbar-default">

                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>

                        <?php if (isset($_GET["operacao"])) { ?>
                            <a class="navbar-brand visible-xs" href="#">Selecionado: <?php echo $operacao; ?></a>
                        <?php } else { ?>
                            <a class="navbar-brand visible-xs" href="#">Escolha o financiamento:</a>
                        <?php } ?>

                      </div>
                      <div id="navbar" class="navbar-collapse collapse menuSimulador">
                        <ul class="nav navbar-nav">
                          <li class="<?php if ($operacao == "FCO") echo 'active' ?>"><a href="index.php?operacao=FCO">FCO</a></li>
                          <li class="<?php if ($operacao == "PROGER") echo 'active' ?>"><a href="index.php?operacao=PROGER">PROGER</a></li>
                          <li class="<?php if ($operacao == "BNDES") echo 'active' ?>"><a href="index.php?operacao=BNDES">BNDES</a></li>
                          <li class="<?php if ($operacao == "FINAME") echo 'active' ?>"><a href="index.php?operacao=FINAME">FINAME</a></li>
                          <li class="<?php if ($operacao == "SUDECO") echo 'active' ?>"><a href="index.php?operacao=SUDECO">SUDECO</a></li>
                          <li class="<?php if ($operacao == "SUDENE") echo 'active' ?>"><a href="index.php?operacao=SUDENE">SUDENE</a></li>                                                                              
                        </ul>
                      </div><!--/.nav-collapse -->

                  </nav>

            </section>

            <section id="resultados">

                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <h3>Resumo do financiamento (<?php echo $operacao ?>) </h3>
                            <br />
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 "> 
                                    <div class="col-lg-12 box-valor">
                                        <h6>Empréstimo</h6>
                                        <h4><span style="font-size:12px"> R$</span> <?php echo number_format($valorFinanciado, 2, ',', '.'); ?></h4>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 "> 
                                    <div class="col-lg-12 box-valor">
                                        <h6>Parcelas</h6>
                                        <h4><?php echo $prazoPagamento ?><span style="font-size:12px"> meses</span></h4>
                                    </div>                           
                                </div> 
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 "> 
                                    <div class="col-lg-12 box-valor">
                                        <h6>Primeira prestação</h6>
                                        <h4><span style="font-size:12px"> R$</span> <?php echo number_format($primeiraPrestacao, 2, ',', '.'); ?></h4>
                                    </div>                           
                                </div>                                                                   
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 "> 
                                    <div class="col-lg-12 box-valor">
                                        <h6>Entrada</h6>
                                        <h4><span style="font-size:12px"> R$</span> <?php echo number_format($valorEntrada, 2, ',', '.'); ?></h4>
                                    </div>                           
                                </div>     
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 "> 
                                    <div class="col-lg-12 box-valor">
                                        <h6>Juros (<?php echo $operacao; ?>)</h6>
                                        <h4><?php echo $taxaAnual*100 ?> <span style="font-size:12px"> % a.a.</span></h4>                                   
                                    </div>
                                </div>                                                               
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 "> 
                                    <div class="col-lg-12 box-valor">
                                        <h6>Carência</h6>
                                        <h4><?php echo $prazoCarencia ?> <span style="font-size:12px"> meses</span></h4>                                   
                                    </div>
                                </div>                                
                            </div>  
                            
                            
                            
                            <Br />

                            <form action="index.php" method="get">    
                                <input type="hidden" name="operacao" value="<?php echo $operacao ?>"> 
                                <div class='col-lg-12 visible-xs'>
                                    <input type="submit" value="Nova Simulação" class="btn btn-success btn-lg btn-block">
                                </div>
                                <div class='col-lg-12 hidden-xs' style="text-align:center;">
                                    <input type="submit" value="Nova Simulação" class="btn btn-success btn-lg">
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
            </section>  

            <section id="contatoTopoSection">
                <div class="emailLine">
                    <div class="row">
                    <form id="contatoTopo" method="post">
                            <h4>Envie a simulação para o seu e-mail</h4>
                            <div class="col-lg-offset-2 col-md-offset-2 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <input type="text" id="email1" name="email" class="form-control" placeholder="Digite o seu E-mail">
                                <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Digite o seu Nome">
                                <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Digite o seu Telefone">
                                <input type="hidden" name="valorFinanciado" class="form-control" value="<?php echo $valorFinanciado; ?>">
                                <input type="hidden" name="prazoPagamento" class="form-control" value="<?php echo $prazoPagamento; ?>">
                                <input type="hidden" name="taxaJurosMensal" class="form-control" value="<?php echo $taxaJurosMensal; ?>">
                            </div>
                            <br class="visible-xs visible-sm" /><br class="visible-xs visible-sm" />
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input id="submit1" type="button" value="Enviar simulação" class="btn btn-default btn-block">
                            </div>                        
                        </div>
                    </form>
                    <div id="success1" style="color: #444; margin-top:20px"></div>
                </div>
            </section>  

            <section id="tabela" style="margin-top:20px">

                <div id="conteudoTabelaEmail"><?php echo gerarTabelaEmail($valorFinanciado, $prazoPagamento, $taxaJurosMensal); ?></div>

            </section>   

            <section id="contatoBottomSection" style="margin-bottom:20px">
                <div class="emailLine">
                    <div class="row">
                    <form id="contatoBottom" method="post">
                            <h4>Envie a simulação para o seu e-mail</h4>
                            <div class="col-lg-offset-2 col-md-offset-2 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <input type="text" id="email2" name="email" class="form-control" placeholder="Digite o seu E-mail...">
                                <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Digite o seu Nome">
                                <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Digite o seu Telefone">
                                <input type="hidden" name="valorFinanciado" class="form-control" value="<?php echo $valorFinanciado; ?>">
                                <input type="hidden" name="prazoPagamento" class="form-control" value="<?php echo $prazoPagamento; ?>">
                                <input type="hidden" name="taxaJurosMensal" class="form-control" value="<?php echo $taxaJurosMensal; ?>">
                            </div>
                            <br class="visible-xs visible-sm" /><br class="visible-xs visible-sm" />
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input id="submit2" type="button" value="Enviar simulação" class="btn btn-default btn-block">
                            </div>                        
                        </div>
                    </form>
                    <div id="success2" style="color: #444; margin-top:20px"></div>
                </div>
            </section>  

            <section id="simulacao2" >
                <div style="margin-bottom:20px">
                    <form action="index.php" method="get" >    
                        <input type="hidden" name="operacao" value="<?php echo $operacao ?>"> 
                        <div class='col-lg-12 visible-xs'>
                            <input type="submit" value="Nova Simulação" class="btn btn-success btn-lg btn-block">
                        </div>
                        <div class='col-lg-12 hidden-xs' style="text-align:center;">
                            <input type="submit" value="Nova Simulação" class="btn btn-success btn-lg">
                        </div>                                
                    </form>  
                    <br /><br />  
                </div>   
            </section>                            

        </div>    


        <!-- Latest compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <!-- script src="js/vendor/jquery-1.11.3.min.js"></script-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- script src="js/vendor/bootstrap.min.js"></script-->
        <script src="js/vendor/jquery.mask.min.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
