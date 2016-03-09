<h1>Selecciona tu estado civil</h1>
<p>No reconocimos el estado civil que nos enviastes. Selecciona uno de la siguiente lista:</p>

<ul>
	{foreach item=item key=i from=$list}
		<li>{link href="PERFIL ESTADO {$item}" caption ="{$item}"}</li>
	{/foreach}
</ul>