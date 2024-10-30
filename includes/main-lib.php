<?php

	if (!defined('_VALID_ADD')) die('Direct access not allowed');

	require_once(ABSPATH.'/wp-content/plugins/ifs-seo-simple/includes/add_mini_lib.php');
	
	function ifs_seo_action() {
		
		$task=getParam('task');
		
		switch ($task) {
			case 'confirminstall':
			case 'sendfeedback': {
				require_once(ABSPATH.'/wp-content/plugins/ifs-seo-simple/includes/feedback.php'); // Still thinking about performance AND readability...
				feedbackBackend();
				die;
			}
			default: {
				ifs_seo_action_old();
				die;
			}
		}
	}
	
	function ifs_seo_action_old() {
	
		$title=getParam('title');
		$description=getParam('description');
		$useBasicTitles=getParam('usebasictitles');
		$noIndexArchive=getParam('noindexarchive');
		$useOpenGraph=getParam('useopengraph');
		$openGraphImageUrl=getParam('ogimageurl');
		$analyticsId=getParam('analyticsid','');
		//$analyticsId=str_replace(' ','',$analyticsId); // Remove spaces
		$currentTitleOption=get_option('ifs_default_site_title');
		$currentDescriptionOption=get_option('ifs_default_site_description');
		$useOpenGraphOption=get_option('ifs-use-open-graph');
		$openGraphImageUrlOption=get_option('ifs_default_open_graph_image_url');
		$useBasicTitlesOption=get_option('ifs-use-basic-titles');
		$noIndexArchiveOption=get_option('ifs_do_not_index_archive_pages');
		$currentAnalyticsOption=get_option('ifs_google_analytics_id');
		if (true) { // We still have some slashes issue
			$title=stripslashes($title);
			$description=stripslashes($description);
		}
		if ($title==$currentTitleOption) {
			echo '<p class="note">Title not changed.</p>';
		}
		else {
			if (update_option('ifs_default_site_title',$title)) {
				echo '<p class="note">Site default title changed from <span style="font-style:italic">'.$currentTitleOption.'</span> to <span style="font-style:italic">'.$title.'</span>.</p>'; 
			}
			else {
				echo '<p class="error">Error setting new default site title. Please contact support.</p>';
			}
		}
		if ($description==$currentDescriptionOption) {
			echo '<p class="note">Default meta description not changed.</p>';
		}
		else {
			if (update_option('ifs_default_site_description',$description)) {
				echo '<p class="note">Site default meta description changed from<p>';
				echo '<p style="margin-left:5%;font-style:italic">'.$currentDescriptionOption.'</p>';
				echo '<p style="margin-left:5%">to</p>';
				echo '<p style="margin-left:5%;font-style:italic">'.$description.'.</p>'; 
			}
			else {
				echo '<p class="error">Error setting new default site meta description. Please contact support.</p>';
			}
		}
		$og=false;
		if ($useOpenGraph=='true') {
			if ($useOpenGraphOption=='true') { // It was set before
				echo '<p class="note">Use Open Graph setting did not change and is and was set to \'use Open Graph\'. This is the recommended setting.</p>';
				$og=true;
			}
			else { // Value changed from false to true
				if (update_option('ifs-use-open-graph','true')) {
					echo '<p class="note">Use Open Graph setting turned on. This is the recommended setting.</p>'; 
					$og=true;
				}
				else {
					echo '<p class="error">Error setting basic titles setting option. Please contact support.</p>';
				}
			}
		}
		else { // $useOpenGraph is false
			if ($useOpenGraphOption=='false') {
				echo '<p class="note">Use Open Graph setting did not change and is and was set to \' not use Open Graph\'. This is NOT the recommended setting.</p>';
			}
			else {
				if (update_option('ifs-use-open-graph','false')) {
					echo '<p class="note">Use Open Graph turned off. This is NOT the recommended setting.</p>'; 			
				}
				else {
					echo '<p class="error">Error setting archive indexing option. Please contact support.</p>';
				}
			}
		}
		if ($og) {
			if ($openGraphImageUrl==$openGraphImageUrlOption) {
				echo '<p class="note">Open Graph image did not change.</p>';
				echo '<p><img src="'.$openGraphImageUrl.'" style="height:100px" alt="Open Graph image"/></p>';
			}
			else {
				if (update_option('ifs_default_open_graph_image_url',$openGraphImageUrl)) {
					echo '<p class="note">Open Graph image url changed from <span style="font-style:italic">'.$openGraphImageUrlOption.'</span> to <span style="font-style:italic">'.$openGraphImageUrl.'</span>.</p>'; 
					echo '<p><img src="'.$openGraphImageUrl.'" style="height:100px" alt="Open Graph image"/></p>';
				}
				else {
					echo '<p class="error">Error setting new Open Graph image. Please contact support.</p>';
				}
			}
		}
		if ($useBasicTitles=='true') {
			if ($useBasicTitlesOption=='true') { // It was set before
				echo '<p class="note">Use basic titles setting did not change and is and was set to \'use basic titles\'. This is the recommended setting.</p>';
			}
			else { // Value changed from false to true
				if (update_option('ifs-use-basic-titles','true')) {
					echo '<p class="note">Use basic titles setting turned on. This is the recommended setting.</p>'; 			
				}
				else {
					echo '<p class="error">Error setting basic titles setting option. Please contact support.</p>';
				}
			}
		}
		else { // $useBasicTitles is false
			if ($useBasicTitlesOption=='false') {
				echo '<p class="note">Use basic titles setting did not change and is and was set to \' not use basic titles\'. This is NOT the recommended setting.</p>';
			}
			else {
				if (update_option('ifs-use-basic-titles','false')) {
					echo '<p class="note">Use basic titles turned off. This is NOT the recommended setting.</p>'; 			
				}
				else {
					echo '<p class="error">Error setting archive indexing option. Please contact support.</p>';
				}
			}
		}
		if ($noIndexArchive=='true') {
			if ($noIndexArchiveOption=='true') { // It was set before
				echo '<p class="note">Do not archive indexing setting did not change and is and was set to \'do not index archive pages\'. This is the recommended setting.</p>';
			}
			else { // Value changed from false to true
				if (update_option('ifs_do_not_index_archive_pages','true')) {
					echo '<p class="note">Do not archive indexing turned on. This is the recommended setting.</p>'; 			
				}
				else {
					echo '<p class="error">Error setting archive indexing option. Please contact support.</p>';
				}
			}
		}
		else { // $noIndexArchive is false
			if ($noIndexArchiveOption=='false') {
				echo '<p class="note">Do not archive indexing setting did not change and is and was set to \'do index archive pages\'. This is NOT the recommended setting.</p>';
			}
			else {
				if (update_option('ifs_do_not_index_archive_pages','false')) {
					echo '<p class="note">Do not archive indexing turned off. This is NOT the recommended setting.</p>'; 			
				}
				else {
					echo '<p class="error">Error setting archive indexing option. Please contact support.</p>';
				}
			}
		}
		$includeText=($analyticsId=='')?' Google Analytics script will not be included.':' Google Analytics script will be included.';
		if ($analyticsId==$currentAnalyticsOption) {
			$analyticsId=($analyticsId=='')?'&lt;no Google Analytics Id&gt;':$analyticsId;
			echo '<p class="note">Google Analytics id not changed. Was and is <span style="font-style:italic">'.$analyticsId.'</span>.'.$includeText.'</p>';
		}
		else {
			if (update_option('ifs_google_analytics_id',$analyticsId)) {
				$analyticsId=($analyticsId=='')?'&lt;no Google Analytics Id&gt;':$analyticsId;
				$currentAnalyticsOption=($currentAnalyticsOption=='')?'&lt;no Google Analytics Id&gt;':$currentAnalyticsOption;
				echo '<p class="note">Google Analytics Id changed from <span style="font-style:italic">'.$currentAnalyticsOption.'</span> to <span style="font-style:italic">'.$analyticsId.'</span>.'.$includeText.'</p>'; 
			}
			else {
				echo '<p class="error">Error setting new Google Analytics Id. Please contact support.</p>';
			}
		}
		die;
	}
	
	function ifsSeoAjaxScript($jsCallbackFunctionName='myAlert') {
		?>
			<script type="text/javascript">
				<!--
					function myAlert(response) {
						alert('Got this from the server: ' + response);				
					}
					function merge_objects(obj1,obj2){
						var obj3 = {};
						for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
						for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
						return obj3;
					}
					
					function ifsSeoAjaxCall(task,parameters) {
						//window.alert(parameters.name);
						if (typeof(task)=='undefined') {
							task='';
						}
						jQuery(document).ready(function($) {
							var data = {
								action: 'ifs_seo_action',
								task: task,
								whatever: 1234
							};
							//window.alert(typeof(parameters));
							if (typeof(parameters=='object')) {
								data=merge_objects(data,parameters);
							}
							// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
							$.post(ajaxurl, data, function(response) {
								<?php echo $jsCallbackFunctionName;?>(response);
							});
						});
					}
				// -->
			</script>
		<?php
	}
?>