<p>Lo sentimos, pero <b>{$email}</b> parece estar mal escrito. Por favor revise que cada letra sea correcta e intente nuevamente.</p>

{if $isEmail}
	<p>Si el email es correcto, puede que este a&uacute;n no use Apretaste. Usted puede invitar a {$email} a usar Apretaste y ganar tickets para {link href="RIFA" caption="nuestra rifa"}.</p>

	{space10}

	<center>
		{button href="INVITAR {$email}" caption="Invitar a Apretaste"}
	</center>
{/if}
