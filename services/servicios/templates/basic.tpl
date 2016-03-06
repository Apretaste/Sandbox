<h1>Lista de servicios</h1>
<p>Lista de servicios de Apretaste. Hasta el momento contamos con {$serviceNum} servicios.</p>
{space10}

{foreach from=$services key=key item=item}
	<h2>{$key|capitalize}</h2>
	<table cellspacing="0" cellpadding="10" border="0">
	{foreach from=$item item=service}
		<tr {if $service@iteration is odd}style="background-color:#F2F2F2;"{/if}>
			<td width="120">
				{link href="AYUDA {$service->name}" caption="{$service->name}"}
			</td>
			<td>
				{$service->description}
			</td>
		</tr>
	{/foreach}
	</table>
	{space10}
	{space10}
{/foreach}