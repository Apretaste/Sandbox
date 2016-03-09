<h1>Selecciona tu provincia</h1>
<p>No reconocimos la provincia que nos enviastes. Selecciona una de la siguiente lista:</p>

<ul>
	{foreach item=item key=i from=$list}
		<li>{link href="PERFIL PROVINCIA {$item}" caption ="{$item}"}</li>
	{/foreach}
</ul>