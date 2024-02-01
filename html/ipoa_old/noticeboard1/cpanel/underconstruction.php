<?php
	if($_GET['sessid']!='smetsysmocmas')
	{
		header("location:index.php?pid=6");
	}
?>
<script language="javascript" src="scripts/counterajax.js"></script>
<link href="/stacs/css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #0000CC}
.style2 {color: #0000FF}
-->
</style>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<table width="634" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="shadeTable">
                  <!--DWLayoutTable-->
                  <tr>
                    <td width="178" height="125">&nbsp;</td>
                    <td width="263">&nbsp;</td>
                    <td width="193">&nbsp;</td>
              </tr>
                  <tr>
                    <td height="102">&nbsp;</td>
                    <td valign="top"><img src="images/contruction.png" width="263" height="102" /></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="45">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="19" colspan="3" valign="top" class="HorizontalRuler"><!--DWLayoutEmptyCell-->&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="56" colspan="3" valign="top">
                      	<div align="center" class="PlainContent_Box1 style1"><span class="style2"><?php include("contactsdvc.php");?></div></td>
              </tr>
            </table>
