<?
//Variáveis configuráveis

$img_setas_dir="/img";//diretório que contém as imagens com as setas de navegação
                      // ex: $img_setas_dir="/imagens";
$site_endereco="localhost";//Endereço que está hospedado o site
                     //ex: $site_endereco="www.evandro.org";
$img_seta_esq="seta_esquerda_bg_preto.gif";
$img_seta_dir="seta_direita_bg_preto.gif";

// Fim Variáveis configuráveis






$handle=opendir('.');
$fotos=array();
$cont=0;

while (($file = readdir($handle))!==false) {
        if (strtolower(substr($file,-4)) == ".jpg" || strtolower(substr($file,-4)) == ".gif" || strtolower(substr($file,-4)) == ".png" || strtolower(substr($file,-5)) == ".jpeg")
        {
              if($file!=$img_seta_esq && $file!=$img_seta_dir)
              {
                $fotos[$cont] = $file;
                $cont++;
              }
        }
}
closedir($handle);

sort($fotos);
reset($fotos);
$indice_foto=-1;
?>
<html>
<head>
<title>Navegador de Fotos&reg; por Evandro Jr</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../css/styles.css" type="text/css">
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  nw = window.open(theURL,winName,features);
  nw.focus();
}
//-->
</script>
</head>
<? if($foto=="" && !$sobre)
{?>
   <body bgcolor="#000000" text="#FFFFFF" link="#FFFFFF" vlink="#FFFF00" alink="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_openBrWindow('<? echo "http://".$site_endereco.$PHP_SELF?>?foto=<? echo $fotos[0]?>','novo','fullscreen=yes,toolbar=no,scrollbars=no');">
Feche esta janela.
<?
exit();
}
else
{?>
   <body bgcolor="#000000" text="#FFFFFF" link="#FFFFFF" vlink="#FFFF00" alink="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?}?>
<form name="frm" method="get" action="<? echo $PHP_SELF ?>">
<? if($sobre)
{
  echo "<div align=\"center\">Navegador de Fotos desenvolvido em PHP por Evandro Jr<br>
         Permite a visualização de fotos em um diretório<br>
         Você pode copiá-lo livremente em <A href=\"http://evandro.org/dl/foto_navegador.zip\">http://evandro.org/dl/foto_navegador.zip</A>
         </div>";

exit();
}

?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr align="center">
      <td colspan="3"> <font size="4" face="Courier New, Courier, mono" color="#FF3333">
        <i> <font color="#FFFF00">
        <?
      $pos = strpos ($foto, ".");
      echo ucfirst(substr($foto,0,$pos));
       ?>
        </font></i></font></td>
    </tr>
    <tr align="center">
      <td colspan="3">
        <div align="center"><img src="<? echo $foto ?>" > </div>
      </td>
    </tr>
    <tr>
      <td align="right"  width="5%">
      <?
      for($i=0; $i<$cont; $i++)
      {

              if($fotos[$i]==$foto)
              {
                 $indice_foto=$i;
              }
      }
       if($foto!=$fotos[0])
      {?>
        <a href="<? echo $PHP_SELF."?foto=".$fotos[($indice_foto-1)] ?>" ><img src="<? echo $img_setas_dir."/seta_esquerda_bg_preto.gif"?>" border=0 ></a>
        <?}?>
      </td>
      <td align="center" width="90%">
        <select name="foto" onChange="document.frm.submit()">
          <?
          for($i=0; $i<$cont; $i++)
          {
              $pos = strpos ($fotos[$i], ".");
              if($fotos[$i]==$foto)
              {
                 $str_sel="SELECTED";
                 $indice_foto=$i;
              }
              else
                 $str_sel="";
          ?>
          <option value="<? echo $fotos[$i] ?>" <? echo $str_sel ?> >
          <? echo substr($fotos[$i],0,$pos) ?>
          </option>
          <?}?>
        </select>
      </td>
      <td align="left" width="5%">
        <? if($foto!=$fotos[$cont-1])
      {?>
        <a href="<? echo $PHP_SELF."?foto=".$fotos[($indice_foto+1)] ?>" ><img src="<? echo $img_setas_dir."/seta_direita_bg_preto.gif"?>" border=0 ></a>
        <?}?>
      </td>
    </tr>
    <tr>
      <td align="center"  colspan="3"><br>
        <font COLOR="#00FF00"><a href="#" onclick="window.close();">Fechar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<? echo $PHP_SELF ?>?sobre=1">Sobre
        o Navedor de Fotos&reg;</a></font></td>
    </tr>
  </table>
</form>
</body>
</html>
