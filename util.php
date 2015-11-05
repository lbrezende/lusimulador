<?php 
    function gerarTabelaEmail($valorFinanciado, $prazoPagamento, $taxaJurosMensal, $prazoCarencia) {
            $linhasTabelaEmail = null; 
            $linhaTabela = null;
            $tabelaemail=null;
            $tabelaHeader = '
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" border="1">    
                    <thead>        
                        <tr>            
                            <th>Parc.</th>            
                            <th>Prestação</th>            
                            <th>Saldo Devedor</th>                                            
                            <th>Juros</th>            
                            <th>Saldo Inicial</th>                                            
                            <th>Saldo Atualizado</th> 
                        </tr>                        
                    </thead>                                           
                    <tbody> ';

            /*Variaveis fixas
                $valorFinanciado;
                $valorEntrada;
                $prazoPagamento;
                $prazoCarencia;
                $taxaJurosMensal;
                $operacao;
            */

            //Cálculo das variáveis da tabela iterando $prazoPagamento vezes

            // for ($i=1; $i <= $prazoCarencia < ; $i++) { 
            //     $prestacao = $juros + $amortizacao/2;

            //     $linhaTabela = '
            //             <tr>
            //                 <td>'.$parcela.'</td>
            //                 <td><span style="font-size:10px">R$</span> '. number_format($prestacao, 2, ',', '.'). '</td>
            //                 <td><span style="font-size:10px">R$</span> '. number_format($saldoDevedor, 2, ',', '.'). '</td>
            //                 <td><span style="font-size:10px">R$</span> '. number_format($juros, 2, ',', '.'). '</td>
            //                 <td><span style="font-size:10px">R$</span> '. number_format($saldoInicial, 2, ',', '.'). '</td>
            //                 <td><span style="font-size:10px">R$</span> '. number_format($saldoAtualizado, 2, ',', '.'). '</td>
            //             </tr>'; 

            //     //Grava a linha para enviar por e-mail 
            //     $linhasTabelaEmail = $linhasTabelaEmail . $linhaTabela; 

            // } 


            $saldoInicial = $valorFinanciado;

            for ($i=1; $i <= ($prazoPagamento + $prazoCarencia) ; $i++) { 

                //Valores fixos de acordo com entrada de dados     
                $parcela = $i;                                              
                $amortizacao = $valorFinanciado / $prazoPagamento;

                if ($i<=$prazoCarencia) {
                    $juros = $saldoInicial * $taxaJurosMensal;
                    $saldoAtualizado = $saldoInicial;
                    $prestacao = $juros;
                    $saldoDevedor = $saldoAtualizado; 
                }

                if ($i>$prazoCarencia) { 
                    //Valores calculados
                    $juros = $saldoInicial * $taxaJurosMensal;
                    $saldoAtualizado = $saldoInicial + $juros;
                    $prestacao = $juros + $amortizacao;
                    $saldoDevedor = $saldoAtualizado - $prestacao; 
                }  
               

                $linhaTabela = '
                        <tr>
                            <td>'.$parcela.'</td>
                            <td><span style="font-size:10px">R$</span> '. number_format($prestacao, 2, ',', '.'). '</td>
                            <td><span style="font-size:10px">R$</span> '. number_format($saldoDevedor, 2, ',', '.'). '</td>
                            <td><span style="font-size:10px">R$</span> '. number_format($juros, 2, ',', '.'). '</td>
                            <td><span style="font-size:10px">R$</span> '. number_format($saldoInicial, 2, ',', '.'). '</td>
                            <td><span style="font-size:10px">R$</span> '. number_format($saldoAtualizado, 2, ',', '.'). '</td>
                        </tr>'; 

                //Grava a linha para enviar por e-mail 
                $linhasTabelaEmail = $linhasTabelaEmail . $linhaTabela; 

                //Salva o valor do saldo anterior para próxima iteração
                $saldoInicial = $saldoDevedor;
            }

            $tabelaFooter = '
                    </tbody>
                </table>
            </div>';


            $tabelaEmail = $tabelaHeader . $linhasTabelaEmail . $tabelaFooter;  

            return $tabelaEmail;
    }                  
    
?>
