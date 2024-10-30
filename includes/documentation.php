<?php

if (!defined('_VALID_ADD')) { echo 'Direct access to this file not allowed'; }

function ifsSeoDocumentation() {
	?>
		<h1>SEO Simple documentation</h1>
		<h2>Why simple</h2>
		<p>We believe on-page optimization starts with something very simple:</p>
		<ul style="margin-left:5%">
			<li>Make sure each page has a good and proper title.</li>
			<li>Make sure each page has a good and proper meta description.</li>
		</ul>
		<p>And there are many reasons for this, but the main reason from a Search Engine Optimization perspective is that normally these are the two items that make people decide to go to your site or page or to anohter one.</p>
		<p>We also believe that there is only one way to create a proper title and meta description for your page or site:</p>
		<p style="font-weight:bold;font-size:200%;text-align:center">MANUALLY.</p>
		<p>So that's why the basic features of IFS SEO Simple are to set a manually configured site title, a manually configured site meta description and the same for each individual page and post.</p>
		<p>And yes, normally the post title may just serve very well, but still, you may want to add or change or delete something there for when people see the summary of your page or site in search results. So we recommend to still review the title for each post carefully and consider overriding it.</p>
		<p>So for now we just add three fields to the page and post edit screens: title and description. If left blank they have no effect, if filled in they will be used as the title tag and meta description tagfor the specific page or post.</p>
		<p>Simple? We think yes. Easy? Not necessarily as we believe summarizing a page or post in a title and a description is not easy.</p>
		<h2>Background</h2>
		<p>We believe that on page SEO can be very simple and don't need very advanced extende plugins, so for our site <a href="http://www.inspiration-for-success.com/" target="_blank">Inspiration for Success</a> we use some very simple rules and ways to make the site search engine friendly.</p>
		<p>As we think Wordpress by default is not specifically search engine friendly we made some changes to the theme that we now want to make available in the form of a plugin.</p>
		<p>So as we are making this anyhow, why not make it available to you.</p>
		<h2>Basic ideas and setup</h2>
		<p>The basis comes from some other plugin which we could not find anymore, so that's why we created our own, with some additional options. And the basic idea of the other simple SEO plugin was very simple: use standard Wordpress custom fields to set title and description. So that's what was the core of our IFS SEO Simple plugin.</p>
		<p>With version 1.2 we created our own fields for title and meta description, so no need to turn on and add custom fields manually. Of course we provide backwards compatibility.</p>
		<p>Custom fields are turned off by default in the Wordpress edit screen, so you have to turn them on to use most of the features of this plugin: go to the 'edit post' and/or 'edit page' screen, go to 'screen options' you see at the right top and check the field 'custom fields'. That's all. Now you will see some stuff below the post or page edit fields.</p>
		<h2>Suggested steps</h2>
		<p>Suggested step for initial setup is:</p>
		<ol>
			<li>Configure the default site title and default site description in the <a href="<?php echo admin_url().'admin.php?page=ifs-seo-configure';?>">IFS SEO Simple configuration screen</a>.</li>
		</ol>
		<p>No need to turn on the custom fields anymore as in previous versions. We do provide backword compatibility, but please note we don't convert the old custom fields data. So just leave the old custom fields.</p>
		<p>Continuous action for each post and page:</p>
		<ul>
			<li>Create a custom field <span style="font-style:italic;font-weight:bold">description</span> for each post and page.</li>
			<li>Create a custom field <span style="font-style:italic;font-weight:bold">title</span> for a post or page if you want the title to be different from the post title as set in the default title field or the default Wordpress title.</li>
		</ul>
		<p>Graphics on the setup to follow.</p>
		<h2>SEO Simple</h2>
		<h3>Title tag</h3>
		<p>As we believe the title tag is the most important item in a web page from an SEO point of view we think there is only one way to set it: manually.</p>
		<p>And it needs to be set on a 'per page' basis, so we want various options to set it.</p>
		<p>Normallly Wordpress uses the blog title as the page title, which in most cases certainly works very well, but we still wanted to have better control.</p>
		<h3>Description meta tag</h3>
		<p>The description meta tag is the second most important item in a web page as it is normally displayed by Google in the search results and will help people decide whether to go to a page or not.</p>
		<p>So we believe that for each page that is to be found through Google the description meta tag should get a lot of attention.</p>
		<h2>Planned changes</h2>
		<p>Planned changes are:</p>
		<ul>
			<li>Handling of titles of archive screens.</li>
			<li>Showing current options in plugin home screen.</li>
			<li>More detailed options for noindex of archive pages.</li>
			<li>Store IFS version number to provide better support for upgrades and conversions in the future.</li>
			<li>Check for duplicate meta description tags.</li>
			<li>Improve the documentation.</li>
			<li>Set option for priority to determine the location of the fields in the edit screen.</li>
		</ul>
		<h2>Credits</h2>
		<p>The origin for this plugin lie in the project <a href="http://www.inspiration-for-success.com/" target="_blank">Inspiration for Success</a>.</p>
		<p>Initial code was made by Guus who is the owner of <a href="http://designs.activediscovery.net/" target="_blank">Active Discovery Designs</a>.</p>
	<?php
}
