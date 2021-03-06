<!-- BEGIN: main -->
<link href="{NV_BASE_SITEURL}themes/{MODULE_THEME}/css/real_perfect-scrollbar.min.css" rel="stylesheet">
<script src="{NV_BASE_SITEURL}themes/{MODULE_THEME}/js/real_jquery.mousewheel.js"></script>
<script src="{NV_BASE_SITEURL}themes/{MODULE_THEME}/js/real_perfect-scrollbar.min.js"></script>

<style type="text/css">
	#scolling {
		height: 300px;
		width: 320px;
		overflow: hidden;
		position: absolute;
		margin-top: 32px;
		border: none
	}

	#result {
		position: absolute;
		width: 320px;
		padding: 10px;
		display: none;
		margin-top: -1px;
		border-top: 0px;
		overflow: hidden;
		border: 1px #CCC solid;
		background-color: white;
	}
	.show {
		padding: 10px;
		border-bottom: 1px #999 dashed;
		font-size: 15px;
		height: 50px;
		background-color: #ffffff;
	}
	.show:hover {
		background: #4c66a4;
		color: #FFF;
		cursor: pointer;
	}
</style>

<script type="text/javascript">
	$(document).ready(function($) {
		$("#scolling").hide();
		$('#scolling').perfectScrollbar();
	});

	$(function() {
		$(".search").keyup(function() {
			var keywords = $(this).val();
			var dataString = 'keywords=' + keywords;
			if (keyword != '') {
				$.ajax({
					type : "POST",
					url : "{SEARCH_URL}",
					data : dataString,
					cache : false,
					success : function(html) {
						if (html != '') {
							$("#scolling").show();
							$("#result").html(html).show();
						} else {
							$("#result").hide();
							$("#scolling").hide();
						}
					}
				});
			}
			return false;
		});

		jQuery(document).on("click", function(e) {
			var $clicked = $(e.target);
			if (! $clicked.hasClass("search")) {
				jQuery("#result").fadeOut();
			}
		});

		$('#keyword').click(function() {
			jQuery("#result").fadeIn();
		});
	});
</script>

<div class="search-widget">
	<form action="{NV_BASE_SITEURL}" method="get" name="frm_search" onsubmit="return onsubmitsearch();" class="search-box" _lpchecked="1">
		<input autocomplete="off" class="search" id="keyword" type="text" value="{value_keyword}" name="keyword" placeholder="{LANG.search}" />
		<button type="button" type="button" name="submit" id="submit" onclick="onsubmitsearch('{MODULE_NAME}')">
			<i class="fa fa-search"></i>
		</button>
		<br />
		<div id="scolling" class="wrapper">
			<div id="result"></div>
		</div>
	</form>
</div>
<!-- END: main -->
