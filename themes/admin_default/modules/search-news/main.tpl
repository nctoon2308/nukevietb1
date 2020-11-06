<!-- BEGIN: main -->
<p>{LANG.config_info}</p>
<form action="{FORM_ACTION}" method="post">
	<table class="tab1">
		<col width="10"/>
		<!-- BEGIN: mod -->
		<tbody>
			<tr>
				<td><input type="radio" value="{DATA.module_name}"{DATA.checked} name="searchIn" /></td>
				<td>{DATA.custom_title}</td>
			</tr>
		</tbody>
		<!-- END: mod -->
		<tfoot>
			<tr>
				<td colspan="7">
					<input type="submit" name="submit" value="{LANG.submit}"/>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
<!-- END: main -->
