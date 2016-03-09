<h1>Edite su perfil</h1>
{space5}
{if empty($thumbnail)}
<table width="100%">
	<tr>
		<td align="center" bgcolor="#F6CED8">
			<p><small>Usted no tiene foto de perfil. {link href="PERFIL FOTO" body="Adjunte su foto de perfil" caption="Agregue su foto"} para aumentar en un 70% la posibilidad de que otros usuarios le escriban.</small></p>
		</td>
	</tr>
</table>
{/if}
<table width="100%">
	<!-- PICTURE -->
	{if not empty($thumbnail)}
	<tr>
		<td>Foto</td>
		<td valign="middle">
				{img src="{$thumbnail}" alt="Picture" width="100"}
			</td>
		<td align="right" valign="middle">
			{button href="PERFIL FOTO" body="Por favor adjunte su foto de perfil y envie este email tal y como esta." caption="Cambiar" size="small"}
		</td>
	</tr>
	{/if}
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>
	<!-- NAME -->
	<tr>
		<td valign="middle">Nombre</td>
		<td valign="middle"><b>{$full_name}</b></td>
		<td align="right" valign="middle">
			{if $full_name eq ""}{assign var="btncaption" value="Agregar"}{else}{assign var="btncaption" value="Cambiar"}{/if}
			{button size="small" caption="{$btncaption}" href="PERFIL NOMBRE {$full_name}" body="Escriba su nombre completo en el asunto, despues de la palabra NOMBRE y envie este email."}
		</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- GENDER -->
	<tr>
		<td valign="middle">Sexo</td>
		<td valign="middle"><b>{$gender}</b></td>
		<td align="right" valign="middle">{link caption="Masculino" href="PERFIL SEXO
			MASCULINO"}{separator} {link caption="Femenino" href="PERFIL SEXO
			FEMENINO"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- SEXUAL ORIENTATION -->
	<tr>
		<td valign="middle">Orientaci&oacute;n sexual</td>
		<td valign="middle"><b>{$sexual_orientation}</b></td>
		<td align="right" valign="middle">{link caption="Hetero" href="PERFIL
			ORIENTACION HETERO"} {separator} {link caption="Gay" href="PERFIL
			ORIENTACION HOMO"} {separator} {link caption="Bi" href="PERFIL
			ORIENTACION BI"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- DAY OF BIRTH -->
	<tr>
		<td valign="middle">Cumplea&ntilde;os</td>
		<td valign="middle"><b>{$date_of_birth|date_format:"%e/%m/%Y"}</b></td>
		<td align="right" valign="middle">
			{if $date_of_birth eq ""}{assign var="btncaption" value="Agregar"}{else}{assign var="btncaption" value="Cambiar"}{/if}
			{button size="small" caption="{$btncaption}" href="PERFIL CUMPLEANOS {$date_of_birth|date_format:"%e/%m/%Y"}" body="Escriba su fecha de cumpleannos en el asunto de este email despues de la palabra CUMPLEANOS. Es recomendado usar la notacion DD/MM/AAAA, por ejemplo: 5/2/1980 seria 5 de Febrero del anno 1980."}
		</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- BODY TYPE -->
	<tr>
		<td valign="middle">Cuerpo</td>
		<td valign="middle"><b>{$body_type}</b></td>
		<td align="right" valign="middle">{link caption="Delgado" href="PERFIL CUERPO
			DELGADO"}{separator} {link caption="Medio" href="PERFIL CUERPO
			MEDIO"}{separator} {link caption="Extra" href="PERFIL CUERPO
			EXTRA"}{separator} {link caption="Atl&eacute;tico" href="PERFIL CUERPO
			ATLETICO"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- EYES -->
	<tr>
		<td valign="middle">Ojos</td>
		<td valign="middle"><b>{$eyes}</b></td>
		<td align="right" valign="middle">{link caption="Negros" href="PERFIL OJOS
			NEGRO"}{separator} {link caption="Carmelitas" href="PERFIL OJOS
			CARMELITA"}{separator} {link caption="Verdes" href="PERFIL OJOS
			VERDE"}{separator} {link caption="Azules" href="PERFIL OJOS
			AZUL"}{separator} {link caption="Avellana" href="PERFIL OJOS
			AVELLANA"}{separator} {link caption="Otro color" href="PERFIL OJOS
			OTRO"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- HAIR -->
	<tr>
		<td valign="middle">Pelo</td>
		<td valign="middle"><b>{$hair}</b></td>
		<td align="right" valign="middle">{link caption="Trigue&ntilde;o" href="PERFIL
			PELO TRIGUENO"}{separator} {link caption="Casta&ntilde;o"
			href="PERFIL PELO CASTANO"}{separator} {link caption="Rubio"
			href="PERFIL PELO RUBIO"}{separator} {link caption="Negro"
			href="PERFIL PELO NEGRO"}{separator} {link caption="Rojo"
			href="PERFIL PELO ROJO"}{separator} {link caption="Blanco"
			href="PERFIL PELO BLANCO"}{separator} {link caption="Otro"
			href="PERFIL PELO OTRO"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- SKIN -->
	<tr>
		<td valign="middle">Piel</td>
		<td valign="middle"><b>{$skin}</b></td>
		<td align="right" valign="middle">{link caption="Blanca" href="PERFIL PIEL
			BLANCO"}{separator} {link caption="Negra" href="PERFIL PIEL
			NEGRO"}{separator} {link caption="Mestiza" href="PERFIL PIEL
			MESTIZO"}{separator} {link caption="Otro" href="PERFIL PIEL OTRO"}</td>
	</tr>

	<!-- MARITAL STATUS -->
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>
	<tr>
		<td valign="middle">Estado civil</td>
		<td valign="middle"><b>{$marital_status}</b></td>
		<td align="right" valign="middle">{link caption="Soltero" href="PERFIL ESTADO
			SOLTERO"}{separator} {link caption="Saliendo" href="PERFIL ESTADO
			SALIENDO"}{separator} {link caption="Comprometido" href="PERFIL
			ESTADO COMPROMETIDO"}{separator} {link caption="Casado" href="PERFIL
			ESTADO CASADO"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- HIGHEST SCHOOL LEVEL-->
	<tr>
		<td valign="middle">Nivel escolar</td>
		<td valign="middle"><b>{$highest_school_level}</b></td>
		<td align="right" valign="middle">{link caption="Primaria" href="PERFIL NIVEL
			PRIMARIO"}{separator} {link caption="Secundaria" href="PERFIL NIVEL
			SECUNDARIO"}{separator} {link caption="T&eacute;cnico" href="PERFIL
			NIVEl TECNICO"}{separator} {link caption="Universitario" href="PERFIL
			NIVEl UNIVERSITARIO"}{separator} {link caption="Postgraduado"
			href="PERFIL NIVEl POSTGRADUADO"}{separator} {link
			caption="Doctorado" href="PERFIL NIVEl DOCTORADO"}{separator} {link
			caption="Otro" href="PERFIL NIVEl OTRO"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- OCCUPATION -->
	<tr>
		<td valign="middle">Profesi&oacute;n</td>
		<td valign="middle"><b>{$occupation}</b></td>
		<td align="right" valign="middle">
			{if $occupation eq ""}{assign var="btncaption" value="Agregar"}{else}{assign var="btncaption" value="Cambiar"}{/if}
			{button size="small" caption="{$btncaption}" href="PERFIL PROFESION {$occupation}" body="Escriba su profesion en el asunto de este email, despues de la palabra PROFESION. Por ejemplo: profesor, camarero, cuentapropista."}
		</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- PROVINCE-->
	<tr>
		<td valign="middle">Provincia</td>
		<td valign="middle"><b>{$province}</b></td>
		<td align="right" valign="middle">
			{link caption="Pinar" href="PERFIL PROVINCIA PINAR_DEL_RIO"}{separator}
			{link caption="Habana" href="PERFIL PROVINCIA LA_HABANA"}{separator}
			{link caption="Artemisa" href="PERFIL PROVINCIA ARTEMISA"}{separator}
			{link caption="Mayabeque" href="PERFIL PROVINCIA MAYABEQUE"}{separator}
			{link caption="Matanzas" href="PERFIL PROVINCIA MATANZAS"}{separator}
			{link caption="Las Villas" href="PERFIL PROVINCIA VILLA CLARA"}{separator}
			{link caption="Cienfuegos" href="PERFIL PROVINCIA CIENFUEGOS"}{separator}
			{link caption="Sancti Sp&iacute;ritus" href="PERFIL PROVINCIA SANCTI_SPIRITUS"}{separator}
			{link caption="Ciego" href="PERFIL PROVINCIA CIEGO_DE_AVILA"}{separator}
			{link caption="Camag&uuml;ey" href="PERFIL PROVINCIA CAMAGUEY"}{separator}
			{link caption="Las Tunas" href="PERFIL PROVINCIA LAS_TUNAS"}{separator}
			{link caption="Holgu&iacute;n" href="PERFIL PROVINCIA HOLGUIN"}{separator}
			{link caption="Granma" href="PERFIL PROVINCIA GRANMA"}{separator}
			{link caption="Santiago" href="PERFIL PROVINCIA SANTIAGO_DE_CUBA"}{separator}
			{link caption="Guant&aacute;namo" href="PERFIL PROVINCIA GUANTANAMO"}{separator}
			{link caption="Isla" href="PERFIL PROVINCIA ISLA_DE_LA_JUVENTUD"}
		</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- CITY -->
	<tr>
		<td valign="middle">Ciudad</td>
		<td valign="middle"><b>{$city}</b></td>
		<td align="right" valign="middle">
			{if $city eq ""}{assign var="btncaption" value="Agregar"}{else}{assign var="btncaption" value="Cambiar"}{/if}
			{button size="small" caption="{$btncaption}" href="PERFIL CIUDAD {$city}" body="Escriba el nombre de la ciudad o pueblo donde vive en el asunto, despues de la palabra CIUDAD. Por ejemplo: Marianao, Santa Efigenia, Puerta de golpe"}
		</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- INTERESTS -->
	<tr>
		<td valign="middle">Intereses</td>
		<td valign="middle"><b>{$interests}</b></td>
		<td align="right" valign="middle">
			{if $interests eq ""}{assign var="btncaption" value="Agregar"}{else}{assign var="btncaption" value="Cambiar"}{/if}
			{button size="small" caption="{$btncaption}" href="PERFIL INTERESES {$interests}" body="Escriba sus intereses separados por coma en el asunto, despues de la palabra INTERESES. Por ejemplo: jardineria, musica, bailar, playa, lectura"}
		</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>

	<!-- RELIGION -->
	<tr>
		<td valign="middle">Religi&oacute;n</td>
		<td valign="middle"><b>{$religion}</b></td>
		<td align="right" valign="middle">{link caption="Ate&iacute;smo" href="PERFIL
			RELIGION ATEISMO"}{separator} {link caption="Secularismo"
			href="PERFIL RELIGION SECULARISMO"}{separator} {link
			caption="Agnosticismo" href="PERFIL RELIGION
			AGNOSTICISMO"}{separator} {link caption="Catolicismo" href="PERFIL
			RELIGION CATOLICISMO"}{separator} {link caption="Cristianismo"
			href="PERFIL RELIGION CRISTIANISMO"}{separator} {link caption="Islam"
			href="PERFIL RELIGION ISLAM"}{separator} {link caption="Raftafarismo"
			href="PERFIL RELIGION PROTESTANTE"}{separator} {link
			caption="Judaismo" href="PERFIL RELIGION JUDAISMO"}{separator} {link
			caption="Espiritismo" href="PERFIL RELIGION SANTERO"}{separator}
			{link caption="Sijismo" href="PERFIL RELIGION YORUBA"}{separator}
			{link caption="Sijismo" href="PERFIL RELIGION ABAKUA"}{separator}
			{link caption="Budismo" href="PERFIL RELIGION BUDISMO"}{separator}
			{link caption="Otra" href="PERFIL RELIGION OTRA"}</td>
	</tr>
	<tr>
		<td valign="middle" colspan="4"><hr /></td>
	</tr>
</table>

{space15}
<center>
	{button href="PERFIL" caption="Ver Perfil"}
</center>
{space10}