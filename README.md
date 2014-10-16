<!DOCTYPE html>
<head>
<meta charset="UTF-8" />

</head>
<body>
<div id="container" style="width:800px;margin-left:auto;margin-right:auto;">
<h1>HELP</h1>
<h4>Preparing for installation</h4>
<div>Change permission in directory <em>ki_config</em> to 777 (or 775 or 755 for your server user, you see permission of directory 
system/logs).This must be the same as permission of the directory "system/logs".
<br>
<img src="helpme/help1.jpg" alt="help01"/><br></div>
<br/>
<div>You <b>run install file</b> <em>www.your_store.net/install.php</em>.

<br>
<img src="helpme/help00.jpg" alt="help00"/><br></div>

<div>Delete <em>install.php</em>.</div>

<div>
<h4>ELSE IF is not success for Install in file install.php</h4>
<p>
Load <em>helpme/kigallery.sql</em> to Your Database. 
Rename koschtit-gallery mysql tables (that's default DB_PREFIX "oc_").
Change English Language id (Default english language id is 1) in table "koschtit_gallery_description".
Add new Layout "line/gallery" from Admin menu Setting/Design/Layout.<br>
Add Your permission in Admin Group to <em>module/kigallery</em> and to <em>line/kigallery.</em>
Install Module Koschtit Gallery. <br>
Copy file <em>helpme/ki_setup_?.txt</em> to directory <em>ki_config</em> and rename file is name <em>ki_setup.php</em>
<br>
Add Your Mysql Connect settings to File <em>ki_config/ki_setup.php</em> (you can see settings from file config.php). Notice: you is not change apostrophes (')!
</p>
<h4>CSS Style</h4>
<p>You Check, that files <em>koschtit_gallery_thumb.css</em>  and <em>koschtit_gallery_fullimg.css</em> is  Your use template in directory stylesheet.</p>
<h4>Change Permissions Directories (These are generals full permissions). These permissions must be same then permission of directory "system/logs".</h4>
pm_galleries > 777<br>
pm_galleries/test > 777<br>
pm_base > 777<br><br/>
After of Install: ki_config > 755<br>

<h4>Create Your Gallery Folder</h4>
<p>Open in admin link "Managefolder". Add at least one directory to Your Gallery images. Link text of Front in file 
catalog/language/english/common/toheader.php</p>

<h4>Addition Images</h4>
<p>Load image in page Upload or load images in FTP. After open your page <em>index.php?route=line/gallery</em>.</p>

<h4>Vqmod XML-files</h4>
<p>
You select xml file in directory vqmod/xml your to E-commerce Version.
Open Catalog/Koschtit Gallery and Update Your Gallery.</p>

<div style="margin-top:20px">Front link in file <em>ki_gallery_front_link.xml:</em><br>
<img src="helpme/help3.jpg" alt="help_3"/><br>
</div>

<div style="margin-top:20px">
Front link in file <em>ki_gallery_category_link.xml:</em><br>
<img src="helpme/help.jpg" alt="help_1"/><br>
</div>


<h4>Example of trade to display the images:</h4>

<div style="margin-top:20px">
Edit the module setting ki_galleries name to "image /".<br>
<img src="helpme/help7.jpg" alt="help_7"/>

</div>


<div style="margin-top:20px">
Create directories for the management of a folder named "data".<br>
<img src="helpme/help8.jpg" alt="help_8"/>
</div>



<h4>Watermark:</h4>

<div style="margin-top:20px">
Create transparent image. Rename image in name "ki_watermark.pic" to directory pm_base.
This example watermark image:<br>

<img src="pm_base/ki_watermark.pic" alt="help_11"/>
</div>

<div style="margin-top:20px">
Checked "Add watermark" in page Upload or in page Change Pictures.
</div>
<br/><br/>

<h3>SEO:</h3>
Paste "htaccess.txt" to your .htaccess file. You to Use file ki_gallery_category_link_seo.xml or file ki_gallery_front_link_seo.xml.
<br/><br/>
<h4>Support:</h4>
Pekka Mansikka<br>
Ollilanojantie 15, 99100 Kittilä<br>
Finland<br>
peku@pm-netti.com<br>
<br>
</div>
</body>
</html>



