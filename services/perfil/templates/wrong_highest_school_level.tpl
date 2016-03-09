<h1>Selecciona tu nivel escolar</h1>
<p>No reconocimos el nivel escolar que nos enviastes. Selecciona uno de la siguiente lista:</p>

<ul>
	{foreach item=item key=i from=$list}
		<li>{link href="PERFIL NIVEL {$item}" caption ="{$item}"}</li>
	{/foreach}
</ul>