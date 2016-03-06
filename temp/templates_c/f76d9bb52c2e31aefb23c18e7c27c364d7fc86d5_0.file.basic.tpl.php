<?php /* Smarty version 3.1.27, created on 2016-03-04 03:37:08
         compiled from "D:\workspace\sandbox\services\primo\templates\basic.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2341056d902e4c75969_64258053%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f76d9bb52c2e31aefb23c18e7c27c364d7fc86d5' => 
    array (
      0 => 'D:\\workspace\\sandbox\\services\\primo\\templates\\basic.tpl',
      1 => 1456979135,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2341056d902e4c75969_64258053',
  'variables' => 
  array (
    'respuesta' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56d902e4c822c3_18591742',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56d902e4c822c3_18591742')) {
function content_56d902e4c822c3_18591742 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2341056d902e4c75969_64258053';
?>
<h1>Numeros primos</h1>
<p><?php echo $_smarty_tpl->tpl_vars['respuesta']->value;?>
</p>
<?php }
}
?>