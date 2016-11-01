<?php
//check access
if (!function_exists('is_admin')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

//start settings page
function zegersot_add_list_page() {
global $wpdb;
$zegersot_table_name = $wpdb -> prefix . "zegersot_persian";
?>
<div class="postbox-container" style="margin: 5px;margin-top: 0px;width: 95%;">
	<div class="metabox-holder">
		<div class="meta-box-sortables">
			<div class="postbox">
				<div class="handlediv">
					<br />
				</div>
				<h3 class="hndle"><span> جایگزین کردن </span></h3>
				<div class="inside">
<center>
<?php
if($_POST)
{
function zegersot_clean($string) {
	$string = trim($string);
	$string = htmlspecialchars($string);
	$string = strip_tags($string);
	$string = mysql_real_escape_string($string);
	return $string;
}
if($_POST[text1] and $_POST[text2]){
$sql=$wpdb -> insert($zegersot_table_name, array('text1' => zegersot_clean($_POST['text1']), 'text2' => zegersot_clean($_POST['text2'])));
//$sql=mysql_query("INSERT INTO ".$zegersot_table_name." (`id`, `text1`, `text2`) VALUES (NULL, '".zegersot_clean($_POST['text1'])."', '".zegersot_clean($_POST['text2'])."');");
if($sql)
echo '<font face="Tahoma" size="3" color="#008000">با موفقیت اضافه شد</font>';
else
echo '<font face="Tahoma" size="3" color="#FF0000">علمیات اضافه با مشکل روبرو شد</font>';
}else{
echo '<font face="Tahoma" size="3" color="#FF0000">لطفا تمامی موارد را کامل کنید</font>';
}
}
?></center>	
				<form class="uniform" name="news" method="post" action="?page=persian-world-add">
<table border="0" width="100%">
	<tr>
		<td>کلمه‌ی مورد نظر :</td>
		<td><input type="text" value="" size="30"  name="text1" dir="rtl"></td>
	</tr>
	<tr>
		<td>جایگزین شود با :</td>
		<td><input type="text" value="" size="30"  name="text2" dir="rtl"></td>
	</tr>
	
	<tr>
		<td><br> <br><button class="button button-primary" type="submit">ذخیره تغییرات</button></td>
		<td>&nbsp;</td>
	</tr>
</table>

</form>
				

					</div>
			</div>
		</div>
	</div>
	

<?php
}

?>
