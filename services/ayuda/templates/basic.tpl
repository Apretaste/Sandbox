<h1>Ayuda de Apretaste</h1>
<p>Apretaste le permite acceder a Internet mediante su email. Con Apretaste usted puede Comprar o Vender, consultar Wikipedia, Traducir documentos a decenas de idiomas, ver el Estado del Tiempo y mucho m&aacute;s; siempre desde su email.</p>

{space15}

<table>
	<tr>
		<td valign="top">
			<h2>Pruebe nuestra Tienda por email</h2>
			<p><b>1.</b> Cree nuevo email. En la secci&oacute;n "Para" escriba: {apretaste_email}</p>
			<p><b>2.</b> En la secci&oacute;n "Asunto" escriba: <span style="color:green;">TIENDA televisor LCD</span></p>
			<p><b>3.</b> Env&iacute;e el email. En segundos recibir&aacute; otro email con televisores a la venta</p>
			{space10}
			<center>
				{button href="TIENDA televisor LCD" caption="Probar Tienda"}
			</center>
		</td>
		<td valign="top">
			{emailbox title="Tienda" from="{$userEmail}" subject="TIENDA televisor LCD"}
		</td>
	</tr>
</table>


{space30}
{space10}


<table>
	<tr>
		<td valign="top">
			<h2>Consulte Wikipedia en tiempo real, directo desde Internet</h2>
			<p><b>1.</b> Cree un nuevo email. En la secci&oacute;n "Para" escriba: {apretaste_email}</p>
			<p><b>2.</b> En la secci&oacute;n "Asunto" escriba: <span style="color:green;">WIKIPEDIA</span> seguido del nombre de una persona, lugar u obra famosa</p>
			<p><b>3.</b> Env&iacute;e el email. En segundos recibir&aacute; otro email con la informaci&oacute;n pedida</p>
			{space10}
			<center>
				{button href="WIKIPEDIA jose marti" caption="Probar Wikipedia"}
			</center>
		</td>
		<td valign="top">
			{emailbox title="Wikipedia" from="{$userEmail}" subject="WIKIPEDIA jose marti"}
		</td>
	</tr>
</table>


{space30}
{space10}


<table>
	<tr>
		<td valign="top">
			<h2>Traduzca palabras y documentos a infinidad de idiomas</h2>
			<p><b>1.</b> Cree un nuevo email. En la secci&oacute;n "Para" escriba: {apretaste_email}</p>
			<p><b>2.</b> En la secci&oacute;n "Asunto" escriba: <span style="color:green;">TRADUCIR </span> seguido del idioma a traducir</p>
			<p><b>3.</b> En el cuerpo del mensaje escriba el texto a traducir.</p>
			<p><b>4.</b> Env&iacute;e el email. En segundos recibir&aacute; otro email con el texto traducido</p>
			{space10}
			<center>
				{button href="TRADUCIR al ingles" caption="Probar Traducir" body="Este es un texto en espanol que pronto sera traducido al ingles"}
			</center>
		</td>
		<td valign="top">
			{emailbox title="Traducir" from="{$userEmail}" subject="TRADUCIR ingles" body="Este es un texto en espanol que pronto sera traducido al ingles"}
		</td>
	</tr>
</table>


{space30}
{space10}


<table>
	<tr>
		<td valign="top">
			<h2>Vea el mapa de alg&uacute;n barrio o fotos de estructuras famosas</h2>
			<p><b>1.</b> Cree un nuevo email. En la secci&oacute;n "Para" escriba: {apretaste_email}</p>
			<p><b>2.</b> En la secci&oacute;n "Asunto" escriba: <span style="color:green;">MAPA</span> seguido de una direcci&oacute;n o del nombre de una estructura famosa</p>
			<p><b>3.</b> Env&iacute;e el email. En segundos recibir&aacute; otro email con el mapa pedido</p>
			{space10}
			<center>
				{button href="MAPA capitolio, Cuba" caption="Probar Mapa"}
			</center>
		</td>
		<td valign="top">
			{emailbox title="Mapas" from="{$userEmail}" subject="MAPA Capitolio, Cuba"}
		</td>
	</tr>
</table>


{space30}
{space10}


<table>
	<tr>
		<td valign="top">
			<h2>Consultar el estado del tiempo</h2>
			<p><b>1.</b> Cree un nuevo email. En la secci&oacute;n "Para" escriba: {apretaste_email}</p>
			<p><b>2.</b> En la secci&oacute;n "Asunto" escriba: <span style="color:green;">CLIMA</span></p>
			<p><b>3.</b> Env&iacute;e el email. En segundos recibir&aacute; otro email con el estado del tiempo</p>
			{space10}
			<center>
				{button href="CLIMA" caption="Estado del tiempo"}
			</center>
		</td>
		<td valign="top">
			{emailbox title="Estado del tiempo" from="{$userEmail}" subject="CLIMA"}
		</td>
	</tr>
</table>


{space30}
{space10}


<h1>Tenemos muchos m&aacute;s servicios</h1>
<p>Brindamos muchos m&aacute;s servicios, y todos los meses incrementamos la lista. &#191;Quiere sugerir alg&uacute;n servicio? &#191;Tiene alguna pregunta? Escribanos a <a href="mailto:{apretaste_support_email}">{apretaste_support_email}</a> y le atenderemos al momento.</p>
{space10}
<center>
	{button href="SERVICIOS" caption="Otros servicios"}
</center>

{space30}
{space10}

<h1>Invite a sus amigos y familia</h1>
<p>&#191;Le gusta el trabajo que hacemos? Invite a sus amigos y familia a conocer Apretaste y gane tickets para {link href="RIFA" caption="nuestra rifa mensual"}.</p>
<table>
	<tr>
		<td valign="top">
			<p><b>1.</b> Cree un nuevo email. En la secci&oacute;n "Para" escriba: {apretaste_email}</p>
			<p><b>2.</b> En la secci&oacute;n "Asunto" escriba: <span style="color:green;">INVITAR</span> seguido del email de su amigo</p>
			<p><b>3.</b> Env&iacute;e el email. Su amigo ser&aacute; invitado y usted recibir&aacute; tickets para {link href="RIFA" caption="nuestra rifa"}</p>
			{space10}
			<center>
				{button href="INVITAR su@amigo.cu" caption="Invitar un amigo"}
			</center>
		</td>
		<td valign="top">
			{emailbox title="Invitar a un amigo" from="{$userEmail}" subject="INVITAR su@amigo.cu"}
		</td>
	</tr>
</table>
{space10}
