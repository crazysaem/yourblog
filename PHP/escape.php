<?php 
function escapebadTags($text){
	$regs;
	$tags = array("script","input");
	$exp ="/";
	foreach($tags as $t){
		$exp.='<\/?'.$t.'[^>]*>|';
		}
	$exp.='/';
	preg_match_all($exp,$text,$regs);//'/<\/?script[^>]*>|<\/?div[^>]*>|<\/?span[^>]*>|<\/?input[^>]*>/',$text,$regs);
	foreach($regs[0] as $x){
		$text=str_replace($x,htmlspecialchars($x),$text);
		}
	return $text;
}
?>