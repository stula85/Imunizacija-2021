<?php
if(!function_exists("clearUTF")){
	function clearUTF($s){
	    $r = '';
	    $s1 = iconv("UTF-8", "UTF-8//IGNORE", $s);
	    for ($i = 0; $i < strlen($s1); $i++)
	    {
	        $ch1 = $s1[$i];
	        $ch2 = mb_substr($s, $i, 1);

	        $r .= $ch1=='?'?$ch2:$ch1;
	    }

	    $str_from = ["Š", "š", "Č", "č", "Ć", "ć", "Đ", "đ", "Ž", "ž", "Ш", "ш", "Ч", "ч", "Ћ", "ћ", "Ђ", "ђ", "Ж", "ж", "Њ", "њ", "Љ", "Љ", "Џ", "џ"];
	    $str_to = ["S", "s", "C", "c", "C", "c", "Dj", "dj", "Z", "z", "S", "s", "C", "c", "c", "c", "Dj", "dj", "Z", "z", "Nj", "nj", "Lj", "lj", "Dz", "dz", "", ""];

	    $r = str_replace($str_from, $str_to, $r);

	    return $r;
	}
}
if(!function_exists("makeSlug")) {
	function makeSlug($text, $args = array()) {
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		//$text = iconv("UTF-8", "ASCII//TRANSLIT", $text);

		// remove unwanted characters
		//$text = preg_replace('~[^-\w]+~', '', $text);
		$text = clearUTF($text);
		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		$text = translateText($text, true);

		// lowercase
		$text = mb_strtolower($text);

		//Izvrsiti provjeru da li slug vec postoji, ako postoji dodati X (broj) na kraju
		if(!empty($args) && !empty($text)){
			$CI = &get_instance();
			$idCol = 'id';

			if(!empty($args['slug']) && strpos($args['slug'], $text) !== FALSE)
				return $args['slug'];

			$CI->db->like($args['kolona'], $text);

			$cnt = $CI->db->get($args['table'])->num_rows();
			if($cnt > 0)
				$text = $text . "-" . $cnt;
		}

		if (empty($text))
			return 'n-a';

		return $text;
	}
}

if(!function_exists("translateText")){
	function translateText($text, $forceTranslate = false){
		$lang = "srpski";
		$subLang = "cir";

		$ci =& get_instance();

		if(null != $ci->session->userdata('lang'))
			$lang = $ci->session->userdata('lang');

		if(null != get_cookie("_lang"))
			$lang = get_cookie("_lang");

		if(null != $ci->session->userdata('subLang'))
			$subLang = $ci->session->userdata('subLang');

		if(null != get_cookie("_subLang"))
			$subLang = get_cookie("_subLang");
			
		$str_from = array ("Џа", "Џе", "Џи", "Џо", "Џу", "Ња", "Ње", "Њи", "Њо", "Њу", "Ља", "Ље", "Љи", "Љо", "Љу", "а","б","в","г","д","ђ","е","ж","з","и","ј","к","л","љ","м","н","њ","о","п","р","с","т","ћ","у","ф","х","ц","ч","џ","ш","А","Б","В","Г","Д","Ђ","Е","Ж","З","И","Ј","К","Л","Љ","М","Н","Њ","О","П","Р","С","Т","Ћ","У","Ф","Х","Ц","Ч","Џ","Ш","č","Č","ć","Ć","ž","Ž","đ","Đ","š","Š");
		// set destination script to UTF-8 Serbian Latin
		$str_to = array ("Dža", "Dže", "Dži", "Džo", "Džu", "Nja", "Nje", "Nji", "Njo", "Nju", "Lja", "Lje", "Lji", "Ljo", "Lju", "a","b","v","g","d","đ","e","ž","z","i","j","k","l","lj","m","n","nj","o","p","r","s","t","ć","u","f","h","c","č","dž","š","A","B","V","G","D","Đ","E","Ž","Z","I","J","K","L","Lj","M","N","Nj","O","P","R","S","T","Ć","U","F","H","C","Č","Dž","Š","č","Č","ć","Ć","ž","Ž","đ","Đ","š","Š");

		//$text = parseShortCodes($text);
		if($lang != "srpski")
			$forceTranslate = true;

		return (($lang == "srpski" && $subLang == "lat") || $forceTranslate) ? str_replace($str_from, $str_to, $text) : $text;
	}
}

if(!function_exists("dump")){
	function dump($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

if(!function_exists("dd")){
	function dd($data){
		dump($data);
		die(1);
	}
}