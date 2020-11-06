<!-- BEGIN: results -->
<div class="snw-result-frame">
	<!-- BEGIN: noneresult -->
	<div class="empty">
		{LANG.search_none} : "<b>{KEY}</b>" {LANG.search_in_module} <b>{INMOD}</b>
	</div>
	<!-- END: noneresult -->
	<div class="cl-result">
		<!-- BEGIN: result -->
		<div class="linktitle">
			<a href="{LINK}">{TITLEROW}</a>
		</div>
		<div class="result-content">
			<p>
			   <!-- BEGIN: result_img -->
			   <a href="{LINK}"><img src="{IMG_SRC}" width="{IMG_WIDTH}px" /></a>
			   <!-- END: result_img -->
			   {CONTENT}
			</p>
		</div>
		<div class="result-author">
			{AUTHOR}
		</div>
		<div class="result-source">
			{LANG.source_title} : <span>{SOURCE}</span>
		</div>
		<div class="hrrrr"></div>
		<!-- END: result -->
		<!-- BEGIN: pages_result -->
		<div class="cl-viewpages">
			{VIEW_PAGES}
		</div>
		<!-- END: pages_result -->
	</div>
	<div class="cl-info">
		<i>{LANG.search_sum_title} {NUMRECORD} {LANG.result_title}</i>
	</div>
</div>
<!-- END: results -->