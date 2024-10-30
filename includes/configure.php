<?php
	if (!defined('_VALID_ADD')) die('Direct access not allowed');
	
	function ifs_seo_simple_configureX() {
		?>
			<script type="text/javascript">
				<!--
					function callBackForSeoSimpleConfiguration(response) {
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
			<?php ifsSeoAjaxScript('callBackForSeoSimpleConfiguration');?>
			<h2>Configuration IFS SEO Simple.</h2>
			<?php
				if (defined('_LOCAL_DEVELOPMENT')) {
					echo '<p>';
					$meta=get_user_meta(1);
					if (isset($meta['metaboxhidden_post'])) {
						print_r($meta['metaboxhidden_post']);
					}
					else {
						print_r('No metaboxhidden_post');
					}
					echo '</p>';
				}
			?>
			<p>On this page you can configure options for IFS SEO Simple.</p>
			<form action="/" method="post">
				<script type="text/javascript">
					<!--
						function ifsSeoConfigureSubmit() {
							titleObject=document.getElementById('titleid');
							descriptionObject=document.getElementById('descriptionid');
							useBasicTitlesObject=document.getElementById('usebasictitles');
							noIndexArchiveObject=document.getElementById('noindexarchiveid');
							useOpenGraphObject=document.getElementById('useopengraphid');
							imageUrlObject=document.getElementById('ogimageid');
							analyticsObject=document.getElementById('analyticsid');
							callBackForSeoSimpleConfiguration('waiting');
							var parameters={
								task: 'configure',
								title: titleObject.value,
								description: descriptionObject.value,
								analyticsid: analyticsObject.value,
								useopengraph: useOpenGraphObject.checked,
								usebasictitles: useBasicTitlesObject.checked,
								noindexarchive: noIndexArchiveObject.checked,
								ogimageurl: imageUrlObject.value
							}
							ifsSeoAjaxCall('configuremailer',parameters);
						}
					// -->
				</script>
				<h3>Default title</h3>
				<p>This is the default site title and will be the title of the homepage. It is the most important item in the site, not only for search engines, but also for humans deciding whether to click or not.</p>
				<?php
					$defaultTitle=get_option('ifs_default_site_title');
					if (!$defaultTitle) {
						if (defined('_TITLE')) { // For our own backwards compatibility.
							$defaultTitle=_TITLE; 
						}
						else {
							$defaultTitle=get_bloginfo();
						}
					}
				?>
				<p><input id="titleid" type="text" size="100" name="title" value="<?php echo $defaultTitle;?>"/></p>
				<h3>Default description:</h3>
				<?php
					$defaultDescription=get_option('ifs_default_site_description');
				?>
				<p>This is the default description for the site and shown in the 'meta description' tag. We consider this the second most important element in any website as it is also the first thing people see in a search engine.</p>
				<textarea id="descriptionid" cols="100" rows="5" name="description"><?php echo $defaultDescription;?></textarea>
				<h3>Open Graph</h3>
				<?php
					$useOpenGraph=get_option('ifs-use-open-graph');
				?>
				<p>Add <a href="http://ogp.me/" target="opengraph">Open Graph</a> meta tags: <input id="useopengraphid" type="checkbox" name="useopengraph"<?php echo ($useOpenGraph==='true')?' checked="checked"':'';?> value="<?php echo ($useOpenGraph==='true')?'true':'';?>"/></p>
				<p>Title and description are taken from the &lt;title&gt; and meta description tags.</p>
				<?php
					$defaultOGImage=get_option('ifs_default_open_graph_image_url');
				?>
				<p>The plugin checks for availability of an post thumbnail. If not available below default image is being used. If no default image is set, a default IFS SEO Simple image is being used.</p>
				<p>Default Open Graph image url: <input id="ogimageid" type="text" size="100" name="ogimageurl" value="<?php echo $defaultOGImage;?>"/></p>
				<p>The system does NOT check the validity of the image here yet. The image is displayed after saving so you can check if the default image is set properly.</p>
				<h3>Use basic titles</h3>
				<?php
					$useBasicTitles=get_option('ifs-use-basic-titles');
				?>
				<p>To keep a clean site towards search engines we recommend to only use the page title, exclusive of the blog title.</p>
				<p>Check to use basic titles: <input id="usebasictitles" type="checkbox" name="usebasictitles"<?php echo ($useBasicTitles==='true')?' checked="checked"':'';?> value="<?php echo ($useBasicTitles==='true')?'true':'';?>"/></p>
				<h3>Archive pages</h3>
				<?php
					$doNotIndexArchive=get_option('ifs_do_not_index_archive_pages');
				?>
				<p>To keep a clean site towards search engines with only the real content pages indexed you may want to tell Google not to index archive pages. An archive page is a category, tag, author or a date based page. So for the technical people: we will add a meta tag &lt;meta name="robots" content="noindex, follow"/&gt; for archive pages.</p>
				<p>Check to not index archive pages: <input id="noindexarchiveid" type="checkbox" name="noindexarchive"<?php echo ($doNotIndexArchive==='true')?' checked="checked"':'';?> value="<?php echo ($doNotIndexArchive==='true')?'true':'';?>"/></p>
				<p>Can only be set for all archive pages, more detailed options planned.</p>
				<h3>Google Analytics</h3>
				<p>Inclusion of the Google Analytics code is not really SEO, but it may save you another plugin, so I just include it.</p>
				<?php
					$analyticsId=get_option('ifs_google_analytics_id');
				?>
				<p>Google Analytics Id (leave empty if you don't want this plugin add the Google Analytics code):</p>
				<p><input id="analyticsid" type="text" size="20" name="analyticscode" value="<?php echo $analyticsId;?>"/> Just enter the id, not the script. Normally looks like UA-XXXXX-Y.</p>
			</form>
			<h2>Save and result</h2>
			<p><input type="button" value="Save" onclick="ifsSeoConfigureSubmit();"/></p>
			<div id="ifsresult">
				<p>Nothing submitted yet.</p>
			</div>
			<h2>Notes</h2>
			<p>Please note we don't do check on duplicate meta description tags. This could happen if you have multiple plugins installed for this reason.</p>
			<h2>Technical</h2>
			<p>We found that we had to set our filter hook priority parameter in order to bypass some default Wordpress theme action hooks. We have set it to 20 and that seems fine.</p>
		<?php
	}
?>