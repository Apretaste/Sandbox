<h1>Selecciona tu tipo de cuerpo</h1>
<p>No reconocimos el tipo de cuerpo que nos enviastes. Selecciona uno de la siguiente lista:</p>

<ul>
{foreach item=item key=i from=$list}
	<li>{link href="PERFIL CUERPO {$item}" caption ="{$item}"}</li>
{/foreach}
</ul>