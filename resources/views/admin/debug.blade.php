<?php
use App\Models\Estoque\Fornecedor;
use App\Models\Estoque\Marca;
use App\Models\Estoque;
use App\Models\Estoque\Unidade;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;
use App\Models\Estoque\Estoque_aux;
?>
@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')
<h3>Novo cliente</h3>
@stop

@section('content')


<form id="getfm" action="{{route('clientes.saveEdit')}}" Method="post">
<input name="id"/> 
<div class="form-group">
  <label for="nome">Nome completo</label>
  <input type="text" id="nome" required="required" name="nome" class="form-control" placeholder="Nome" aria-describedby="basic-addon1">
  </div>
{{ csrf_field() }}
<button>Debug</button>
</form>
<?php 


        $cem =0;
        $cquenta =0;
        $vinte=0;
        $dez=0;
        $cinco=0;
        $dois = 0;
        $um=0;
        
        $real  = 551;
        $realint = $real;
        
        //Enquanto o valor nao zera mantem o loop
        while($real > 0){
            
            //se valor é maior ou igual a 100
            if($real >= 100){
                //divide o valor por 100 resultando no numero de notas e add a variavel $cem
                $cem = (int)($real/100);
               
                //subtrai o valor  pelo recultado de numero de notas vezes o valor delas  
                $real = $real -($cem*100);
                }
            elseif($real >=50){
                $cquenta = (int)($real/50);
                $real = $real -($cquenta*50);
            }
            elseif($real >=20){
                $vinte = (int)($real/20);
                $real = $real -($vinte*20);
            }
            elseif($real >=10){
                $dez = (int)($real/10);
                $real = $real -($dez*10);
            }
            elseif($real >=5){
                $cinco = (int)($real/5);
                $real = $real -($cinco*5);
            }
            elseif($real >=2){
                $dois = (int)($real/2);
                $real = $real -($dois*2);
            }
            elseif($real >=1){
                $um = (int)($real/1);
                $real = $real -($um*1);
            }
            
            
        }
        echo 'Valor: R$'.$realint.
        '<br>notas de 100: '.$cem . 
        '<br> notas de 50:'. $cquenta .
        '<br>notas de 20: '.$vinte . 
        '<br> notas de 10:'. $dez .
        '<br>notas de 5: '.$cinco . 
        '<br> notas de 2:'. $dois .
        '<br>notas de 1: '.$um ;
    
        $xmlstring = '<?xml version="1.0" encoding="UTF-8"?><nfeProc versao="3.10" xmlns="http://www.portalfiscal.inf.br/nfe"><NFe xmlns="http://www.portalfiscal.inf.br/nfe"><infNFe versao="3.10" Id="NFe42180318500774000147550010000010041000010041"><ide><cUF>42</cUF><cNF>00001004</cNF><natOp>VENDA PROD DO ESTAB</natOp><indPag>1</indPag><mod>55</mod><serie>1</serie><nNF>1004</nNF><dhEmi>2018-03-26T15:58:00-03:00</dhEmi><dhSaiEnt>2018-03-26T15:58:00-03:00</dhSaiEnt><tpNF>1</tpNF><idDest>2</idDest><cMunFG>4211603</cMunFG><tpImp>1</tpImp><tpEmis>1</tpEmis><cDV>1</cDV><tpAmb>1</tpAmb><finNFe>1</finNFe><indFinal>0</indFinal><indPres>0</indPres><procEmi>0</procEmi><verProc>3.1.00</verProc></ide><emit><CNPJ>18500774000147</CNPJ><xNome>AMG INDUSTRIA E COMERCIO DE CONFECCOES LTDA - ME</xNome><xFant>AMG INDUSTRIA E COMERCIO DE CONFECCOES LTDA - ME</xFant><enderEmit><xLgr>RUA FRANCISCA VITALI MILANEZ</xLgr><nro>000</nro><xBairro>CARAVAGGIO</xBairro><cMun>4211603</cMun><xMun>NOVA VENEZA</xMun><UF>SC</UF><CEP>88868000</CEP><cPais>1058</cPais><xPais>BRASIL</xPais><fone>4834760992</fone></enderEmit><IE>257093125</IE><CRT>1</CRT></emit><dest><CNPJ>29450928000150</CNPJ><xNome>THAIS MACHADO DA ROSA</xNome><enderDest><xLgr>RUA DUQUE DE CAXIAS</xLgr><nro>1190</nro><xBairro>CENTRO</xBairro><cMun>4302907</cMun><xMun>CACEQUI</xMun><UF>RS</UF><CEP>97450000</CEP><cPais>1058</cPais><xPais>BRASIL</xPais><fone>55999721716</fone></enderDest><indIEDest>2</indIEDest><email>SILVANEMACHADO@YAHOO.COM.BR</email></dest><autXML><CNPJ>10766881000100</CNPJ></autXML><autXML><CNPJ>00428307000511</CNPJ></autXML><det nItem="1"><prod><cProd>182004</cProd><cEAN/><xProd>SAIA MIDI PLISSADA</xProd><NCM>61045900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>136.9000000000</vUnCom><vProd>136.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>136.9000000000</vUnTrib><vDesc>12.83</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="2"><prod><cProd>182007</cProd><cEAN/><xProd>CALCA ESTAMPADA FENDA</xProd><NCM>61046900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>3.0000</qCom><vUnCom>139.6000000000</vUnCom><vProd>418.80</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>3.0000</qTrib><vUnTrib>139.6000000000</vUnTrib><vDesc>39.24</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="3"><prod><cProd>182008</cProd><cEAN/><xProd>SAIA LONGA DRAPEADA</xProd><NCM>61045900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>119.9000000000</vUnCom><vProd>119.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>119.9000000000</vUnTrib><vDesc>11.23</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="4"><prod><cProd>182017</cProd><cEAN/><xProd>SAIA ESTAMPA LOCALIZADA</xProd><NCM>61045900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>87.9000000000</vUnCom><vProd>87.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>87.9000000000</vUnTrib><vDesc>8.24</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="5"><prod><cProd>182020</cProd><cEAN/><xProd>CALCA ESTAMPADA ABOTOAMENTO</xProd><NCM>61046900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>139.9000000000</vUnCom><vProd>139.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>139.9000000000</vUnTrib><vDesc>13.11</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="6"><prod><cProd>182103</cProd><cEAN/><xProd>BLUSA MANGA LONGA C/ BABADO</xProd><NCM>61069000</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>3.0000</qCom><vUnCom>79.9000000000</vUnCom><vProd>239.70</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>3.0000</qTrib><vUnTrib>79.9000000000</vUnTrib><vDesc>22.47</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="7"><prod><cProd>182107</cProd><cEAN/><xProd>T-SHIRT BABADOS</xProd><NCM>61099000</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>66.9000000000</vUnCom><vProd>66.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>66.9000000000</vUnTrib><vDesc>6.27</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="8"><prod><cProd>182110</cProd><cEAN/><xProd>BLUSA CROPPED</xProd><NCM>61069000</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>94.9000000000</vUnCom><vProd>94.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>94.9000000000</vUnTrib><vDesc>8.89</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="9"><prod><cProd>182116</cProd><cEAN/><xProd>BODY ESTAMPADO</xProd><NCM>61124900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>3.0000</qCom><vUnCom>89.9000000000</vUnCom><vProd>269.70</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>3.0000</qTrib><vUnTrib>89.9000000000</vUnTrib><vDesc>25.27</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="10"><prod><cProd>182122</cProd><cEAN/><xProd>CAMISA C/ DETALHE PLISSADO</xProd><NCM>61069000</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>109.9000000000</vUnCom><vProd>109.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>109.9000000000</vUnTrib><vDesc>10.30</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="11"><prod><cProd>182125</cProd><cEAN/><xProd>BODY ESTAMPA FLORES</xProd><NCM>61124900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>2.0000</qCom><vUnCom>83.9000000000</vUnCom><vProd>167.80</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>2.0000</qTrib><vUnTrib>83.9000000000</vUnTrib><vDesc>15.72</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="12"><prod><cProd>182127</cProd><cEAN/><xProd>BODY C/ MANGA DE TULE</xProd><NCM>61124100</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>117.9000000000</vUnCom><vProd>117.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>117.9000000000</vUnTrib><vDesc>11.05</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="13"><prod><cProd>182135</cProd><cEAN/><xProd>BODY LISTRADO MANGA LONGA</xProd><NCM>61124900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>104.9000000000</vUnCom><vProd>104.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>104.9000000000</vUnTrib><vDesc>9.83</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="14"><prod><cProd>182204</cProd><cEAN/><xProd>VESTIDO ESTAMPA LOCAL</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>99.9000000000</vUnCom><vProd>99.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>99.9000000000</vUnTrib><vDesc>9.36</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="15"><prod><cProd>182207</cProd><cEAN/><xProd>MACACAO CALCA FLARE</xProd><NCM>61046200</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>164.9000000000</vUnCom><vProd>164.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>164.9000000000</vUnTrib><vDesc>15.45</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="16"><prod><cProd>182210</cProd><cEAN/><xProd>VESTIDO MANGA BUFANTE</xProd><NCM>61044200</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>118.9000000000</vUnCom><vProd>118.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>118.9000000000</vUnTrib><vDesc>11.14</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="17"><prod><cProd>182213</cProd><cEAN/><xProd>VESTIDO MIDI GOLA ALTA</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>2.0000</qCom><vUnCom>109.9000000000</vUnCom><vProd>219.80</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>2.0000</qTrib><vUnTrib>109.9000000000</vUnTrib><vDesc>20.60</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="18"><prod><cProd>182220</cProd><cEAN/><xProd>VESTIDO MIDI C/ BABADOS</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>169.9000000000</vUnCom><vProd>169.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>169.9000000000</vUnTrib><vDesc>15.92</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="19"><prod><cProd>182222</cProd><cEAN/><xProd>VESTIDO MIDI ESTAMPADO</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>2.0000</qCom><vUnCom>129.9000000000</vUnCom><vProd>259.80</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>2.0000</qTrib><vUnTrib>129.9000000000</vUnTrib><vDesc>24.34</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="20"><prod><cProd>182225</cProd><cEAN/><xProd>VESTIDO AMARRADO OMBRO</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>149.9000000000</vUnCom><vProd>149.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>149.9000000000</vUnTrib><vDesc>14.05</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="21"><prod><cProd>182230</cProd><cEAN/><xProd>VESTIDO OMBRO A OMBRO</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>119.9000000000</vUnCom><vProd>119.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>119.9000000000</vUnTrib><vDesc>11.23</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="22"><prod><cProd>182234</cProd><cEAN/><xProd>VESTIDO ESTAMPADO C/ VELUDO</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>158.9000000000</vUnCom><vProd>158.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>158.9000000000</vUnTrib><vDesc>14.89</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="23"><prod><cProd>182238</cProd><cEAN/><xProd>VESTIDO LONGO GOLA VELUDO</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>179.9000000000</vUnCom><vProd>179.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>179.9000000000</vUnTrib><vDesc>16.86</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><det nItem="24"><prod><cProd>182244</cProd><cEAN/><xProd>VESTIDO C/ AMARRACAO</xProd><NCM>61044900</NCM><CFOP>6101</CFOP><uCom>PC</uCom><qCom>1.0000</qCom><vUnCom>144.9000000000</vUnCom><vProd>144.90</vProd><cEANTrib/><uTrib>PC</uTrib><qTrib>1.0000</qTrib><vUnTrib>144.9000000000</vUnTrib><vDesc>13.51</vDesc><indTot>1</indTot></prod><imposto><ICMS><ICMSSN101><orig>0</orig><CSOSN>101</CSOSN><pCredSN>0.0000</pCredSN><vCredICMSSN>0.00</vCredICMSSN></ICMSSN101></ICMS><IPI><cEnq>999</cEnq><IPITrib><CST>99</CST><vBC>0.00</vBC><pIPI>0.0000</pIPI><vIPI>0.00</vIPI></IPITrib></IPI><PIS><PISOutr><CST>99</CST><vBC>0.00</vBC><pPIS>0.0000</pPIS><vPIS>0.00</vPIS></PISOutr></PIS><COFINS><COFINSOutr><CST>99</CST><vBC>0.00</vBC><pCOFINS>0.0000</pCOFINS><vCOFINS>0.00</vCOFINS></COFINSOutr></COFINS></imposto></det><total><ICMSTot><vBC>0.00</vBC><vICMS>0.00</vICMS><vICMSDeson>0.00</vICMSDeson><vBCST>0.00</vBCST><vST>0.00</vST><vProd>3861.80</vProd><vFrete>0.00</vFrete><vSeg>0.00</vSeg><vDesc>361.80</vDesc><vII>0.00</vII><vIPI>0.00</vIPI><vPIS>0.00</vPIS><vCOFINS>0.00</vCOFINS><vOutro>0.00</vOutro><vNF>3500.00</vNF></ICMSTot></total><transp><modFrete>0</modFrete><transporta><CNPJ>00428307000511</CNPJ><xNome>EXPRESSO SAO MIGUEL</xNome><IE>1330056121</IE><xEnder>ROD RS 404</xEnder><xMun>SARANDI</xMun><UF>RS</UF></transporta><vol><qVol>1</qVol><esp>CAIXA</esp></vol></transp><cobr><dup><nDup>1004 / 1</nDup><dVenc>2018-03-26</dVenc><vDup>3500.00</vDup></dup></cobr><infAdic><infAdFisco>VOCe PAGOU APROXIMADAMENTE R$ 470,77 CORRESPONDENE A 0,13% DE TRIBUTOS FEDERAIS; R$ 594,98 CORRESPONDENTE A 0,17% DE TRIBUTOS ESTADUAIS; R$ 0,00 CORRESPONDENTE A 0,00% DE TRIBUTOS MUNICIPAIS;R$ 2.434,25 PELOS PRODUTOS/SERVIcOS DESTE DOCUMENTO. FONTE: &#39;IBPT/EMPRESOMETRO.COM.BR A5G7R1 &#39;18.1.A EMPRESA OPTANTE PELO SIMPLES NACIONAL, PERMITE APROVEIT. DE CREDITO NO VALOR DE 0,00% DE ICMS CORRESPONDENTE AO VALOR DE 0,00 NOS TERMOS DO ART. 23 DA LC 123/2006.</infAdFisco><obsCont xCampo="Pedido"><xTexto>RS4 N Rem.: 1</xTexto></obsCont><obsCont xCampo="Qtde de Pecas"><xTexto>33</xTexto></obsCont></infAdic></infNFe><Signature xmlns="http://www.w3.org/2000/09/xmldsig#"><SignedInfo><CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /><SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" /><Reference URI="#NFe42180318500774000147550010000010041000010041"><Transforms><Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" /><Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" /></Transforms><DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" /><DigestValue>ykKY2ImQlrDMAAYn85i2Qp/r9zA=</DigestValue></Reference></SignedInfo><SignatureValue>dPtrLcaayM1SRePUZr1s5KyOzFNBQcqcIZifaXXUZOs6c/Ukz2VTPgUjBoxNoeu8SktLZFwe+D8zWk/TvyQe9Cp7xlZL43Re+dt2xY+N3NV+mKeUdmBzlhY9guDmbQ+tZvNbsP14Vc+d97GDrHwlcbTpiBjo1rg1U8h/KzIqE8I=</SignatureValue><KeyInfo><X509Data><X509Certificate>MIICOTCCAaKgAwIBAgIQJpLn3fwH17RNXJHw5VenaDANBgkqhkiG9w0BAQUFADBbMVkwVwYDVQQDHlAAdwB3AHcALgBmAHMAaQBzAHQALgBjAG8AbQAuAGIAcgAgACgAUwBFAE0AIABWAEEATABJAEQAQQBEAEUAIABKAFUAUgDNAEQASQBDAEEAKTAeFw0xNTEyMjQwODI1MjVaFw0xODEyMjQwODI1MjVaMFsxWTBXBgNVBAMeUAB3AHcAdwAuAGYAcwBpAHMAdAAuAGMAbwBtAC4AYgByACAAKABTAEUATQAgAFYAQQBMAEkARABBAEQARQAgAEoAVQBSAM0ARABJAEMAQQApMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDX4BYmJiNwrPz9At2ioXYkMuMWAOf669VPS3SAzIKkJLhSE7Bf9sbTjGHRFZhs6STxKkMBKKnx6dqAEMGlQwDSU42/kqhGya28SUn3HigH2w3dR/536Gt4eAxyLp9ODNXUqWTpnraWCeT41kcnJ27cmOAUMxzxDcsA93n32L4u8wIDAQABMA0GCSqGSIb3DQEBBQUAA4GBAAN89zf+wSFL+4+2Ic8mGva8Z51EzYzNgYEqXwEMHxw4jCxxbsuxewQWedSGWi3SFZla6zmNUEA+UO95tSZ353klTvWDzut2BFSJOPLcMu8HPTTdnMt4ofVeVqKyi2vp+3t78vjqDAAfSAu5C9wT7stoUx41Nok+L6WbmpOIgvHy</X509Certificate></X509Data></KeyInfo></Signature></NFe><protNFe versao="3.10"><infProt><tpAmb>1</tpAmb><verAplic>3.1.00</verAplic><chNFe>42180318500774000147550010000010041000010041</chNFe><dhRecbto>2018-03-26T16:04:06-03:00</dhRecbto><nProt>342180039765972</nProt><digVal>ykKY2ImQlrDMAAYn85i2Qp/r9zA=</digVal><cStat>100</cStat><xMotivo>Autorizado o uso da NF-e</xMotivo></infProt></protNFe></nfeProc>'; 
        
       $venda = Venda::all();
       foreach($venda as $v){
           Estoque_aux::getOff($v->codigo_estoque_aux, $v->quantidade);
       }
      //  saveXml($xmlstring);
        function saveXml($xmlstring){
            $xml = simplexml_load_string($xmlstring);
            $emissor = $xml->NFe->infNFe->emit->xFant;
            $fornecedor = Fornecedor::where('fornecedor','=',$emissor)->get();
            if(count($fornecedor) <1){
                $fornecedor = new Fornecedor();
                $fornecedor->fornecedor = $emissor;
                $fornecedor->save();
            }
            $marca = Marca::where('marca','=',$emissor)->get();
            if(count($marca) <1){
                $marca = new Marca();
                $marca->marca = $emissor;
                $marca->save();
            }
            
            foreach($xml->NFe->infNFe->det as $prod){
                echo( $prod->prod->cProd . ' : ' . $prod->prod->xProd . ' x'. number_format((float)$prod->prod->qCom,0));
                echo '<br />';
                $estoque  = new Estoque();
                $estoque->codigo = $prod->prod->cProd;
                $estoque->nome = $prod->prod->xProd;
                $estoque->marca = $emissor;
                $estoque->categoria = 'Roupas';
                $estoque->unidade = $prod->prod->uCom;
                $estoque->fornecedor = $emissor;
                $estoque->estoque = number_format((float)$prod->prod->qCom,0);
                $estoque->preco_custo = number_format((float)$prod->prod->vUnTrib,2);
                $estoque->lucro = 115;
                $estoque->preco = $estoque->preco_custo + (($estoque->lucro/100)*$estoque->preco_custo);
                $unidade = Unidade::where('unidade','=',$prod->prod->uCom)->get();
                if(count($unidade)<1){
                    $unidade = new Unidade();
                    $unidade->unidade = $prod->prod->uCom;
                    $unidade->save();
                }
                try{
                    $estoque->save();
                    echo 'savo';
                }catch(\Illuminate\Database\QueryException $e){
                    echo $e->errorInfo[2];
                }
            }
            
        }
        
        
        
?>
@stop