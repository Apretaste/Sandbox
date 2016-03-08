{if $noProfileValuesWereEdited}
	<p>No se hicieron cambios a su perfil. Puede que usted halla llenado su perfil incorrectamente. &iquest;Necesita {link href="AYUDA PERFIL" caption="ayuda llenando su perfil"}?</p>
{else}
	<p>Su perfil se ha editado correctamente. A continuaci&oacute;n se muestran los campos que han cambiado:</p>

	<table border="1" width="100%">
		<thead>
			<tr>
				<th>Campo</th>
				<th>Nuevo valor</th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$editedProfileValues key=field item=value}
			<tr>
				<td>{$field}</td>
				<td>{$value}</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
{/if}

{space10}

<center>
	{button href="PERFIL" caption="Ver mi Perfil"}
	{button href="PERFIL EDITAR" caption="Editar mi Perfil" body="{$editProfileText}"}
</center>

{space10}
