<center>
	{if ! empty($profile->thumbnail)}
		<table cellpadding="3"><tr><td bgcolor="#202020">
		{img src="{$profile->thumbnail}" alt="Picture" width="300"}
		</td></tr></table>
	{else}
		{noimage width="300" height="200" text="Tristemente ...<br/>Sin foto de perfil :'-("}
	{/if}

	{space10}

	{if ! empty($message)}
		<p>{$message}</p>
	{/if}
</center>

{if $profile->about_me ne ""}
	<center>
		<p>{$profile->about_me}</p>
	</center>
{/if}

{if $profile->interests|@count gt 0}
	{space5}
	<table width="100%" cellpadding="3"><tr><td bgcolor="#F2F2F2">
		{space5}
		<center> 
		<p>Cosas que me motivan:</p>
		<p>
		{foreach $profile->interests as $interest}
		   	<nobr><span style="white-space:nowrap; padding:1px 8px; margin-top:5px; background-color:#202020; color:white; border-radius:5px; font-size:12px;">{$interest|upper}</span></nobr>
		{/foreach}
		</p>
		</center>
		{space5}
	</td></tr></table>
{/if}

{space10}

{if $ownProfile}
	<center>
		{assign var="btncaption" value="Editar mi Perfil"}
		{if $completion lt 85}
			<p><small>Solo ha llenado el <font color="red">{$completion|number_format}%</font> de su perfil</small></p>
			{assign var="btncaption" value="Completar mi Perfil"}
		{/if}
		{button href="PERFIL EDITAR" caption="{$btncaption}" body="Envie este email tal y como esta. Recibira como respuesta su perfil en modo de edicion."}
	</center>

	{space15}

	<h1>Mi cr&eacute;dito</h1>
	<p>Usted tiene ${$profile->credit|money_format} en cr&eacute;dito de Apretaste</p>
	
	<h1>Mis tickets para la rifa</h1>
	<p>Usted tiene {$profile->raffle_tickets} ticket(s) para la {link href="RIFA" caption="rifa"}</p>

	{space10}
{else}
	 <center>
		{button href="CUPIDO LIKE @{$profile->username}" caption="&hearts; Me gusta" color="green"} 
		{button href="NOTA @{$profile->username} Hola @{$profile->username}. Me gusto tu perfil. Pareces una persona interesante y me gustaria saber mas de ti. Por favor respondeme." caption="Enviar nota" color="grey" body="Cambie la nota en el asunto por la que usted desea"}
	</center>
{/if}