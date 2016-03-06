<?php /* Smarty version 3.1.27, created on 2016-03-04 03:37:07
         compiled from "D:\workspace\sandbox\app\layouts\email_default.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2470156d902e3ea65f3_23142342%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b43d908db58cbe455c6bc15622c05e7de3028e62' => 
    array (
      0 => 'D:\\workspace\\sandbox\\app\\layouts\\email_default.tpl',
      1 => 1456722358,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2470156d902e3ea65f3_23142342',
  'variables' => 
  array (
    'APRETASTE_SERVICE_NAME' => 0,
    'APRETASTE_TOP_AD' => 0,
    'APRETASTE_BOTTOM_AD' => 0,
    'APRETASTE_SERVICE_RELATED' => 0,
    'APRETASTE_SERVICE' => 0,
    'APRETASTE_SERVICE_CREATOR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56d902e4a78b22_37628641',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56d902e4a78b22_37628641')) {
function content_56d902e4a78b22_37628641 ($_smarty_tpl) {
if (!is_callable('smarty_function_link')) require_once 'D:\\workspace\\sandbox/app/plugins\\function.link.php';
if (!is_callable('smarty_function_separator')) require_once 'D:\\workspace\\sandbox/app/plugins\\function.separator.php';
if (!is_callable('smarty_function_img')) require_once 'D:\\workspace\\sandbox/app/plugins\\function.img.php';
if (!is_callable('smarty_function_space10')) require_once 'D:\\workspace\\sandbox/app/plugins\\function.space10.php';
if (!is_callable('smarty_function_apretaste_support_email')) require_once 'D:\\workspace\\sandbox/app/plugins\\function.apretaste_support_email.php';

$_smarty_tpl->properties['nocache_hash'] = '2470156d902e3ea65f3_23142342';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['APRETASTE_SERVICE_NAME']->value;?>
</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<style type="text/css">
			@media only screen and (max-width: 600px) {
				#container {
					width: 100%;
				}
			}
			@media only screen and (max-width: 480px) {
				.button {
					display: block !important;
				}
				.button a {
					display: block !important;
					font-size: 18px !important; width: 100% !important;
					max-width: 600px !important;
				}
				.section {
					width: 100%;
					margin: 2px 0px;
					display: block;
				}
				.phone-block {
					display: block;
				}
			}
			h1{
				color: #5EBB47;
				text-decoration: underline;
				font-size: 24px;
				margin-top: 0px;
			}
			h2{
				color: #5EBB47;
				font-size: 16px;
				margin-top: 0px;
			}
		</style>
	</head>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="font-family: Arial;">
		<center>
			<table id="container" border="0" cellpadding="0" cellspacing="0" valign="top" align="center" width="600">
				<!--top links-->
					<tr>
					<td align="right" bgcolor="#D0D0D0" style="padding: 5px;">
						<small>
							<?php echo smarty_function_link(array('href'=>"AYUDA",'caption'=>"Ayuda"),$_smarty_tpl);
echo smarty_function_separator(array(),$_smarty_tpl);?>

							<?php echo smarty_function_link(array('href'=>"INVITAR escriba aqui las direcciones email de sus amigos",'caption'=>"Invitar",'body'=>''),$_smarty_tpl);
echo smarty_function_separator(array(),$_smarty_tpl);?>

							<?php echo smarty_function_link(array('href'=>"PERFIL",'caption'=>"Mi perfil"),$_smarty_tpl);
echo smarty_function_separator(array(),$_smarty_tpl);?>

							<?php echo smarty_function_link(array('href'=>"SERVICIOS",'caption'=>"M&aacute;s servicios"),$_smarty_tpl);?>

						</small>
					</td>
				</tr>

				<!--logo & service name-->
				<tr>
					<td bgcolor="#F2F2F2" align="center" valign="middle">
						<table border="0">
							<tr>
								<td class="phone-block" style="margin-right: 20px;" valign="middle">
									<span style="white-space:nowrap;">
										<nobr>
											<font size="10" face="Tahoma" color="#5ebb47"><i>A</i>pretaste</font>
											<font style="margin-left:-5px;" size="18" face="Curlz MT" color="#A03E3B"><i>!</i></font>
										</nobr>
									</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<!--top ad-->
				<?php if ($_smarty_tpl->tpl_vars['APRETASTE_TOP_AD']->value) {?>
				<tr>
					<td align="center">
						<?php echo smarty_function_img(array('src'=>((string)$_smarty_tpl->tpl_vars['APRETASTE_TOP_AD']->value),'alt'=>"Top Ad",'width'=>"100%"),$_smarty_tpl);?>

					</td>
				</tr>
				<?php }?>

				<!--main section to load the user template-->
				<tr>
					<td align="left" style="padding: 0px 5px;">
						<?php echo smarty_function_space10(array(),$_smarty_tpl);?>

						<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['APRETASTE_USER_TEMPLATE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

						<?php echo smarty_function_space10(array(),$_smarty_tpl);?>

					</td>
				</tr>

				<!--bottom ad-->
				<?php if ($_smarty_tpl->tpl_vars['APRETASTE_BOTTOM_AD']->value) {?>
				<tr>
					<td align="center">
						<?php echo smarty_function_img(array('src'=>((string)$_smarty_tpl->tpl_vars['APRETASTE_BOTTOM_AD']->value),'alt'=>"Bottom Ad",'width'=>"100%"),$_smarty_tpl);?>

					</td>
				</tr>
				<?php }?>

				<!--services related-->
				<?php if (count($_smarty_tpl->tpl_vars['APRETASTE_SERVICE_RELATED']->value) > 0) {?> 
				<tr>
					<td align="left" style="padding: 0px 5px;">
						<?php echo smarty_function_space10(array(),$_smarty_tpl);?>

						<small>
							Servicios similares:
							<?php
$_from = $_smarty_tpl->tpl_vars['APRETASTE_SERVICE_RELATED']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->_loop = false;
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->total= $_smarty_tpl->_count($_from);
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->value) {
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->_loop = true;
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->iteration++;
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->last = $_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->iteration == $_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->total;
$foreach_APRETASTE_SERVICE_Sav = $_smarty_tpl->tpl_vars['APRETASTE_SERVICE'];
?>
								<?php echo smarty_function_link(array('href'=>((string)$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->value),'caption'=>((string)$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->value)),$_smarty_tpl);?>

								<?php if (!$_smarty_tpl->tpl_vars['APRETASTE_SERVICE']->last) {
echo smarty_function_separator(array(),$_smarty_tpl);
}?>
							<?php
$_smarty_tpl->tpl_vars['APRETASTE_SERVICE'] = $foreach_APRETASTE_SERVICE_Sav;
}
?>
						</small>
					</td>
				</tr>
				<?php }?>

				<!--footer-->
				<tr>
					<td align="center">
						<hr style="border: 1px solid #A03E3B;" />
						<p>
							<small>
								<div style="margin-bottom:5px;"><?php echo $_smarty_tpl->tpl_vars['APRETASTE_SERVICE_NAME']->value;?>
 fue creado por <b><?php echo $_smarty_tpl->tpl_vars['APRETASTE_SERVICE_CREATOR']->value;?>
</b></div>
								Escriba dudas e ideas a <a href="mailto:<?php echo smarty_function_apretaste_support_email(array(),$_smarty_tpl);?>
"><?php echo smarty_function_apretaste_support_email(array(),$_smarty_tpl);?>
</a>.<br/> 
								Lea nuestros <?php echo smarty_function_link(array('href'=>"TERMINOS",'caption'=>"T&eacute;rminos de uso"),$_smarty_tpl);?>
.<br/> 
								Copyright &copy; 2012 - <?php echo date('Y');?>
 Pragres Corp.
							</small>
						</p>
					</td>
				</tr>
			</table>
		</center>
	</body>
</html><?php }
}
?>