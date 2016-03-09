<h1>Selecciona el color de tus ojos</h1>
<p>No reconocimos el color de ojos que nos enviastes. Selecciona uno de la siguiente lista:</p>

<ul>
	{foreach item=item key=i from=$list}
		<li>{link href="PERFIL OJOS {$item}" caption ="{$item}"}</li>
	{/foreach}
</ul>