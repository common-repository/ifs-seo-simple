<?php
	if (!defined('_VALID_ADD')) die('Direct access not allowed');
	
	if (_LOCAL_DEVELOPMENT) {
		update_option('ifs-seo-install-confirmed','false');
	}
	
	function feedbackBackend() {
		$task=getParam('task');
		if (_LOCAL_DEVELOPMENT) {
			echo '<p>Feedback back-end.</p>';
			echo '<p>Task: '.$task.'.</p>';
		}
		switch ($task) {
			case 'confirminstall': {
				$message='Installation confirmation IFS SEO Simple on '.get_bloginfo('url').'.';
				if (@mail('guus@inspiration-for-success.com','IFS SEO Simple installation confirmation',$message)) {
					if (update_option('ifs-seo-install-confirmed','true')) {
						echo '<p>Your installation has been confirmed. Thank you very much for your cooperation.</p>';
					}
					else {
						echo '<p class="error">An error occurred while setting the confirmation option. Please contact support.</p>';
					}
				}
				else {
					echo '<p>There was an error sending the confirmation e-mail. Please try again or ignore this message or further requests for confirmation.</p>';
				}
				break;
			}
			default: {
				echo '<p class="error">Invalid task.</p>';
				break;
			}
		}
		die;
	}
	
	function ifsSeoFeedback() {
		?>
			<script type="text/javascript">
				<!--
					function callBackForSeoSimpleFeedback(response) {
						//window.alert('Callback for add e-mail');
						resultLocation=document.getElementById('ifsresult');
						if (typeof(resultLocation)=='object') {
							if (response=='waiting') {
								resultLocation.innerHTML='<p class="note">Waiting for result.</p>';
							}
							else {	
								//window.alert(response);
								check=response.substr(0,2);
								//window.alert(displayString);
								if (check=='ok') {	
									displayString=response.substring(2);
									//window.alert('ok');
								}
								else {
									displayString=response;
								}
								resultLocation.innerHTML=displayString;
							}
						}
						else {
							window.alert('Result location not defined.');
						}
					}
				// -->
			</script>
			<?php ifsSeoAjaxScript('callBackForSeoSimpleFeedback');?>
			<script type="text/javascript">
				<!--
					function ifsSeoFeedbackSubmit(task) {
						if (typeof(task)=='undefined') {
							task='confirminstall';
						}
						/*
						titleObject=document.getElementById('titleid');
						descriptionObject=document.getElementById('descriptionid');
						keywordsObject=document.getElementById('keywordsid');
						useBasicTitlesObject=document.getElementById('usebasictitles');
						noIndexArchiveObject=document.getElementById('noindexarchiveid');
						*/
						callBackForSeoSimpleFeedback('waiting');
						var parameters={
							task: task,
						}
						ifsSeoAjaxCall('configuremailer',parameters);
					}
				// -->
			</script>
		<?php
		$installedConfirmation=get_option('ifs-seo-install-confirmed');
		if ($installedConfirmation!='true') {
			echo '<h2>Confirm installation</h2>';
			echo '<p>As per Wordpress plugin rules we are not allowed to send an automatic confirmation to check the number of <span style="font-weight:bold">installed</span> IFS SEO Simple plugins. So we don\'t send anything without your permission.</p>';
			echo '<p>As you may understand we are very curious if the downloaded IFS SEO Simple plugins are actually being installed and used, so please confirm your installation by clicking <input type="button" value="here" onclick="ifsSeoFeedbackSubmit();"/>.</p>';
			echo '<p>This will send an e-mail to us with your site url. Nothing else.</p>';
			echo '<p>So please <input type="button" value="confirm" onclick="ifsSeoFeedbackSubmit();"/> installation of IFS SEO Simple on '.get_bloginfo('url').' by clicking  <input type="button" value="here" onclick="ifsSeoFeedbackSubmit();"/>.</p>';
		}
		?>
		<h2>Support</h2>
		<p>For any question, feedback or support requests just send an e-mail to <a href="mailto:info@inspiration-for-success.com">info@inspiration-for-success.com</a>.</p>
		<h2>Result</h2>
		<div id="ifsresult">
			<p>No message.</p>
		</div>		
		<?php
	}
?>