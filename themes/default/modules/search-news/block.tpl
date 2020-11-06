<!-- BEGIN: main -->
<form method="get" action="{NV_BASE_SITEURL}index.php?">
<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}"/>
<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}"/>
<div class="snw-block">
	<div class="snw-title">
		{LANG.search_detail}
	</div>
	<div class="snw-content">
		<table class="snw-table">
			<tr>
				<td><input onfocus="if(this.value == '{LANG.search_enter}') {this.value = '';}" onblur="if (this.value == '') {this.value = '{LANG.search_enter}';}" type="text" class="snw-input" name="q" value="{KEY}"/></td>
				<td>
					<select class="snw-select" name="catid">
						<option value="0">{LANG.cat}</option>
						<!-- BEGIN: catid -->
						<option value="{CATID.catid}"{CATID.selected}>{CATID.xtitle}{CATID.title}</option>
						<!-- END: catid -->
					</select>
				</td>
				<td>
					<select class="snw-select" name="topicid">
						<option value="0">{LANG.topic}</option>
						<!-- BEGIN: topicid -->
						<option value="{TOPICID.topicid}"{TOPICID.selected}>{TOPICID.title}</option>
						<!-- END: topicid -->
					</select>
				</td>
				<td>
					<button class="snw-button" type="submit">
						<span>{LANG.search_title}</span>
					</button>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
<!-- END: main -->