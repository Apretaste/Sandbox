<h1>Selecciona el color de tu pelo</h1>
<p>No reconocimos el color de pelo que nos enviastes. Selecciona uno de la siguiente lista:</p>

<ul>
	{foreach item=item key=i from=$list}
		<li>{link href="PERFIL PELO {$item}" caption ="{$item}"}</li>
	{/foreach}
</ul>