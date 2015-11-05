<?php
    //lbrezende@gmail.com

    //Define as variáveis como vazio, caso não entre no if.
    $valorFinanciado = null;
    $valorEntrada = null;
    $prazoPagamento = null;
    $prazoCarencia = null;
    $taxaAnual = null;    
    $operacao = 'FCO';
  

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
        $operacao = strtoupper($_GET["operacao"]);
    } 

    //Define taxa de juros baseado na operacao
    switch ($operacao) {     
        case 'FCO':
            $prazoMaximoEmMeses = 180;
            $prazoCarenciaEmMeses = 36;
            break;
        case 'PROGER':
            $prazoMaximoEmMeses = 72;
            $prazoCarenciaEmMeses = 12;
            break;
        case 'BNDES':
            $prazoMaximoEmMeses = 72;
            $prazoCarenciaEmMeses = 12;
            break;
        case 'FINAME':
            $prazoMaximoEmMeses = 120;
            $prazoCarenciaEmMeses = 6;
            break;
        case 'SUDECO':
            $prazoMaximoEmMeses = 240;
            $prazoCarenciaEmMeses = 48;
            break;
        case 'SUDENE':
            $prazoMaximoEmMeses = 144;
            $prazoCarenciaEmMeses = 48;
            break;                                                                        
        default:
            //Default FCO
            $prazoMaximoEmMeses = 180;
            $prazoCarenciaEmMeses = 180;
            break;
    }            

?>

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

            <section id="form" >

                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <h3>Calcule aqui o seu financiamento (<?php echo $operacao; ?>)</h3><Br />
                            <form id="simulaForm-<?php echo $operacao; ?>" name="simulaForm"  action="tabela.php" method="get">
                                <div class='col-lg-6'>
                                      <div class="form-group ">
                                        <label class="sr-only" for="valor-entrada">Valor financiado (em reais)</label>
                                        <label for="valor-financiado">Valor financiado</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">R$</div>
                                          <input type="text" class="form-control money" name="vf" id="valor-entrada" placeholder="Valor financiado">
                                          <div class="input-group-addon">,00</div>
                                        </div>
                                      </div>
                                </div>
                                <div class='col-lg-6'>
                                    
                                      <div class="form-group ">
                                        <label class="sr-only" for="valor-financiado">Valor entrada (em reais)</label>
                                        <label for="valor-financiado">Valor entrada</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">R$</div>
                                          <input type="text" class="form-control money" name="ve" id="valor-financiado" placeholder="Valor financiado">
                                          <div class="input-group-addon">,00</div>
                                        </div>
                                      </div>
                                </div>
                                <div class='col-lg-6'>
                                    <label for="prazo-pagamento">Prazo pagamento</label> 
                                        <select class="form-control" id="prazo-pagamento" name="pp">
                                          <option value="1">Selecione</option>
                                          <?php for ($i=1; $i <= $prazoMaximoEmMeses ; $i++) { ?>
                                              <option value="<?php echo $i ?>"><?php echo $i ?> meses</option>
                                          <?php } ?>
                                        </select>
                                    <Br />
                                </div>   

                                <div class='col-lg-6'>
                                    <label for="prazo-carencia">Prazo carência</label> 
                                        <select class="form-control" id="prazo-carencia" name="pc">
                                          <option value="0">Selecione</option>
                                          <?php for ($i=1; $i <= $prazoCarenciaEmMeses ; $i++) { ?>
                                              <option value="<?php echo $i ?>"><?php echo $i ?> meses</option>
                                          <?php } ?>
                                        </select>
                                    <Br />
                                </div>       

                                <input type="hidden" name="operacao" value="<?php echo $operacao ?>"> 

                                <div class='col-lg-12 visible-xs'>
                                    <input type="submit" value="Simular Financiamento" class="btn btn-success btn-lg btn-block">
                                </div>

                                <div class='col-lg-12 hidden-xs' style="text-align:center;">
                                    <input type="submit" value="Simular Financiamento" class="btn btn-success btn-lg">
                                </div>         

                            </form>
                        </div>
                    </div>
                </div>
            </section>   

            
            <section id="about-fco" style="<?php if ($operacao != 'FCO') echo 'display:none' ?>">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <article>
                                <h3>FCO - Fundo Constitucional do Centro Oeste</h3>
                                Fundo de crédito constitucional criado em 1988 para os estados da região Centro Oeste.
                                <h4>Finalidade:</h4>
                                Promover o desenvolvimento econômico e social na região Centro-Oeste, destinado a atender mini, pequenas, médias e grandes empresas que desejem iniciar, ampliar ou mesmo modernizar suas atividades na região, com ou sem Capital de Giro Associado.
                                <h4>Teto</h4>
                                R$ 20.000.000,00
                                <h4>Limite de Financiamento</h4>
                                100% o valor do projeto. Para Capital de Giro Associado, uma análise econômico-financeira da empresa será feita determinando o valor que poderá ficar até entre 35% e 50%.
                                <h4>Prazos</h4>
                                Até 15 anos (180 meses) e carência que pode chegar até 36 meses.
                                <h4>Taxas</h4>
                                Juros de 7,00% a.a.
                            </article>
                        </div>
                    </div>
                </div>
            </section>

            <section id="about-proger" style="<?php if ($operacao != 'PROGER') echo 'display:none' ?>">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <article>
                                <h3>PROGER Urbano Empresarial</h3>
                                O Programa de Geração de Emprego e Renda é uma linha de financiamento instituído pelo Ministério do Trabalho e Emprego e pelo CODEFAT.
                                <h4>Finalidade:</h4>
                                Financiar projetos de investimentos com ou sem capital de giro associado, para micro, pequenas e médias empresas com faturamento anual de até R$ 7.500.000,00, que visem a geração de emprego e renda.
                                <h4>Teto</h4>
                                R$ 600.000,00
                                <h4>Limite de Financiamento</h4>
                                De acordo com a análise econômico-financeira da empresa, pode chegar até a 80% do valor do projeto. A parcela de capital de giro associado não poderá ser superior a 50% do valor total do projeto.
                                <h4>Prazos</h4>
                                Até 06 anos (72 meses) e carência que pode chegar até 12 meses.
                                <h4>Taxas</h4>
                                Juros de 8,50% a.a.
                            </article>
                        </div>
                    </div>
                </div>
            </section>

            <section id="about-bndes"  style="<?php if ($operacao != 'BNDES') echo 'display:none' ?>">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <article>
                                <h3>BNDES</h3>
                                Linha de financiamento, criada pelo BNDES e operacionalizada por meio de instituições financeiras credenciadas, para projetos de investimento.
                                <h4>Finalidade:</h4>
                                Apoio para projetos de investimentos de implantação, ampliação, recuperação e modernização de ativos fixos, bem como a aquisição de máquinas e equipamentos novos e de fabricação nacional, devidamente cadastrados no portal do BNDES, automação e até mesmo cursos e treinamento de pessoal relacionado ao projeto.
                                <h4>Teto</h4>
                                R$ 600.000,00
                                <h4>Limite de Financiamento</h4>
                                De acordo com a análise econômico-financeira da empresa, pode chegar até a 80% do valor do projeto. A parcela de capital de giro associado não poderá ser superior a 50% do valor total do projeto.
                                <h4>Prazos</h4>
                                Até 06 anos (72 meses) e carência que pode chegar até 12 meses.
                                <h4>Taxas</h4>
                                Juros de 12,00% a.a.
                            </article>
                        </div>
                    </div>
                </div>
            </section>  

            <section id="about-finame"  style="<?php if ($operacao != 'FINAME') echo 'display:none' ?>">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <article>
                                <h3>Finame</h3>
                                Linha de crédito do BNDES operacionalizada por Instituições Financeiras.
                                <h4>Finalidade:</h4>
                                Apoiar projetos de financiamento para micro, pequena, média empresa, empreendedor individual ou mesmo transportadores autônomos que pretendem adquirir máquinas, equipamentos e veículos novos, como ônibus, caminhão, trator, reboque, guindastes, tanques, etc..
                                <h4>Teto</h4>
                                Operações de valor superior a R$ 10 milhões para financiamento de projetos de investimento poderão ser realizadas através do apoio direto, indireto não automático ou misto.
                                Operações de valor até R$ 20 milhões por empresa a cada período de 12 meses para financiamento de projetos de investimento serão realizadas através do apoio indireto automático.
                                Operações, de qualquer valor, de financiamento isolado de equipamentos serão realizadas através do apoio indireto automático - produtos BNDES Finame, BNDES Finame Agrícola, BNDES Finame Leasing, ou via Cartão BNDES (ver simulação específica).
                                <h4>Limite de Financiamento</h4>
                                Até 100% do valor do projeto.
                                <h4>Prazos:</h4>
                                Até 120 meses, com até 06 meses de carência.
                                <h4>Taxas</h4>
                                6,50% a.a.
                            </article>
                        </div>
                    </div>
                </div>
            </section>   

            <section id="about-sudeco"  style="<?php if ($operacao != 'SUDECO') echo 'display:none' ?>">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <article>
                                <h3>SUDECO - Superintendência do Desenvolvimento do Centro-Oeste</h3>
                                
                                <h4>Finalidade</h4>
                                A Superintendência do Desenvolvimento do Centro-Oeste
                                (Sudeco) tem como objetivo principal promover o desenvolvimento da
                                Região Centro-Oeste, reduzir as desigualdades sociais e regionais e
                                fomentar programas e ações para o seu desenvolvimento. Sua área de
                                atuação abrange os Estados de Mato Grosso, Mato Grosso do Sul e Goiás
                                e o Distrito Federal.
                                <h4>Teto</h4>
                                A assistência mínima global com recursos do FDCO é de R$ 30 milhões,
                                por cliente, grupo empresarial ou grupo agropecuário, respeitados os
                                limites de participação dos recursos do Fundo estabelecidos pelo
                                Conselho Monetário Nacional (Resolução nº 24/2014, de 25/03/2014 do
                                CONDEL/SUDECO).
                                <h4>Limite de Financiamento</h4>
                                Operação de financiamento limitada a R$ 500.000,00.
                                <h4>Prazos</h4>
                                Até 20 (vinte) anos para os projetos de infraestrutura e até
                                12 (doze) anos para os demais empreendimentos, incluindo-se o período
                                de carência, que será de até um ano após a data prevista no projeto
                                para entrada em operação do empreendimento, havendo capitalização de
                                juros durante o período da carência. As amortizações e o pagamento dos
                                juros serão semestrais.
                                <h4>Taxas</h4>
                                    Taxa efetiva de juros de 7,5% a.a. (sete inteiros e cinco décimos por
                                    cento ao ano) até 9,0% a.a. (nove por cento ao ano), para as operações
                                    contratadas ou cuja consulta prévia tenha sido aprovada pela Sudeco e
                                    a carta consulta aprovada pelo agente operador a partir de 1º de
                                    janeiro de 2015 a 31 de dezembro de 2015.
                            </article> 
                        </div>
                    </div>
                </div>
            </section>

            <section id="about-sudene"  style="<?php if ($operacao != 'SUDENE') echo 'display:none' ?>">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <article>
                                <h3>SUDENE</h3>
                                
                                <h4>Finalidade</h4>
                                Contribuir para o desenvolvimento econômico e social do Nordeste,
                                através de instituição financeira federal de caráter regional,
                                mediante a execução de programas de financiamento aos setores
                                produtivos, em consonância com os respectivos planos regionais de
                                desenvolvimento.
                                <h4>Teto</h4>
                                inicial de 100.000,00 mil  a 2.700,000,000,000,00  bilhões
                                juros de  3,5% a.a
                                <h4>Limite de Financiamento</h4>
                                100% o valor do projeto. Para Capital de
                                Giro Associado, uma análise econômico-financeira da empresa será feita
                                determinando o valor que poderá ficar até entre 35% e 50%.
    
                                <h4>Prazos</h4>
                                Até 20 anos (240 meses) e carência que pode chegar até 96 meses.
                                <h4>Taxas</h4>
                                 1% a 3,5% 
                            </article>
                        </div>
                    </div>
                </div>
            </section> 

        </div>    

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <!-- script src="js/vendor/jquery-1.11.3.min.js"></script-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <<!-- script src="js/vendor/bootstrap.min.js"></script-->

        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

        <script src="js/main.js"></script>

    </body>
</html>
