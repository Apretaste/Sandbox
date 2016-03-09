<h1>Selecciona tu religi&oacute;n</h1>
<p>No reconocimos la religi&oacute;n que nos enviastes. Selecciona uno de la siguiente lista, y si no perteneces a ninguna de la lista, selecciona "otra":</p>

<ul>
	{foreach item=item key=i from=$list}
		<li>{link href="PERFIL RELIGION {$item}" caption ="{$item}"}</li>
	{/foreach}
</ul>