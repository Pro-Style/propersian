<?php
//caption
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
function persian_wordpress_gettext( $text ) {
	static $replace, $keys;
	global $wpdb;
	$zegersot_table_name = $wpdb -> prefix . "zegersot_persian";
	if ( !is_array($replace) ) {
		$replace = array();
		$query	=	mysql_query("select * from $zegersot_table_name");
		if(mysql_num_rows($query)){
		for ( $i = 0 ; $i < mysql_num_rows($query) ; $i++ )
			{
				$id			=  	@mysql_result($query,$i,"id");
			if ( $id != "" )
				{
					$text1	=	@mysql_result($query,$i,"text1");
					$text2	=	@mysql_result($query,$i,"text2");
					$replace[$text1]=$text2;
				}
			}
		}
		$keys = array_keys( $replace );
	}

	return str_replace( $keys, $replace, $text );
}

add_filter( 'gettext', 'persian_wordpress_gettext' );
add_filter( 'gettext_with_context', 'persian_wordpress_gettext' );
add_filter( 'ngettext', 'persian_wordpress_gettext' );
add_filter( 'ngettext_with_context', 'persian_wordpress_gettext' );
?>