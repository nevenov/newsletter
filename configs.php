<?php 
//error_reporting(0);

include( dirname(__FILE__). "/allinfo.php");

$sql_prefix = "newsletter2";

//////////////////////////////////////////
////////// DO NOT CHANGE BELOW ///////////
//////////////////////////////////////////

$CONFIG["upload_folderNL"]='upload/';
$CONFIG["upload_thumbsNL"]='upload/thumbs/';

$TABLE["News"] 			= $sql_prefix.'_news';
$TABLE["Categories"]	= $sql_prefix.'_categories';
$TABLE["Subscribers"]	= $sql_prefix.'_subscribers';
$TABLE["Options"] 		= $sql_prefix.'_options';

$Version = "2.2";

$php_version_min = "5.2.0";
$mysql_version_min = "5.0.0";

if ($installed!='yes') {	
	$connNL = mysqli_connect($CONFIG["hostname"], $CONFIG["mysql_user"], $CONFIG["mysql_password"], $CONFIG["mysql_database"]);
	if (mysqli_connect_errno()) {
		die('MySQL connection error: .'.mysqli_connect_error());
	}
	mysqli_set_charset($connNL, "utf8");
}

//require_once('include/functions.php');

//// front-end functions

// function that replace SELECT, INSERT, UPDATE and DELETE sql statements
if(!function_exists('sql_result')){ 
	function sql_resultNL($sql) {
		global $connNL;
		$sql_result = mysqli_query ($connNL, $sql) or die ('Could not execute MySQL query: '.$sql.' . Error: '.mysqli_error($connNL));
		return $sql_result;
	}
}


// function for safety SELECT, INSERT, UPDATE and DELETE sql statements
if(!function_exists('SafetyDBNL')){ 
	function SafetyDBNL($str) {
		global $connNL;
		return mysqli_real_escape_string($connNL, $str); 
	}
}

// function for escaping quotes in INSERT and UPDATE sql statements
if(!function_exists('SaveDB')){ 
	function SaveDB($str) {
		if (!get_magic_quotes_gpc()) {	
			return addslashes($str); 
		} else {
			return $str;
		}
	}
}

// function for escaping quotes in SELECT sql statements
if(!function_exists('ReadDB')){ 
	function ReadDB($str) {
		return stripslashes($str);
	}
}

// function for escaping quotes in SELECT sql statements with showing the quotes
if(!function_exists('ReadHTML')){ 
	function ReadHTML($str) {
		return htmlspecialchars(stripslashes($str), ENT_QUOTES);
	}
}

// function that formatting date and time in admin area
if(!function_exists('admin_date')){ 
	function admin_date($db_date) {
		return date("d.m.Y, H:i",strtotime($db_date));
	}
}

// function that invert colors in HTML
if(!function_exists('invert_colour')){ 
	function invert_colour($start_colour) {
		if($start_colour!='') {
			$colour_red = hexdec(substr($start_colour, 1, 2));
			$colour_green = hexdec(substr($start_colour, 3, 2));
			$colour_blue = hexdec(substr($start_colour, 5, 2));
			
			$new_red = dechex(255 - $colour_red);
			$new_green = dechex(255 - $colour_green);
			$new_blue = dechex(255 - $colour_blue);
			
			if (strlen($new_red) == 1) {$new_red .= '0';}
			if (strlen($new_green) == 1) {$new_green .= '0';}
			if (strlen($new_blue) == 1) {$new_blue .= '0';}
			
			$new_colour = '#'.$new_red.$new_green.$new_blue;
		} else {
			$new_colour = '#000000';
		}
		return $new_colour;
	}
}


// function that generate color picker and color fields
if(!function_exists('color_field')){ 
	function color_field($field, $color) {
		$picker  = '<input id="'.$field.'" name="'.$field.'" type="text" size="7" value="'.$color.'" style="background-color:'.$color.';" />';
		$picker .= '<button class="jscolor{valueElement:\''.$field.'\', styleElement:\''.$field.'\', hash:true, required:false, closable:true, width:260, height:150} color_field">&nbsp;</button><sub> - you can pick the color from pallette or you can put it manualy</sub>';
		
		return $picker;
	}
}


// function that remove unnecessary characters, quotes, spaces in the meta tags
if(!function_exists('remove_quote')){ 
	function remove_quote($key_text) {	
		$key_text = str_replace("á", "a", $key_text);
		$key_text = str_replace("â", "a", $key_text);
		$key_text = str_replace("ã", "a", $key_text);
		$key_text = str_replace("à", "a", $key_text);
		$key_text = str_replace("é", "e", $key_text);
		$key_text = str_replace("ê", "e", $key_text);
		$key_text = str_replace("í", "i", $key_text);
		$key_text = str_replace("ó", "o", $key_text);
		$key_text = str_replace("ô", "o", $key_text);
		$key_text = str_replace("õ", "o", $key_text);
		$key_text = str_replace("ú", "u", $key_text);
		$key_text = str_replace("\t", "", $key_text);
		$key_text = str_replace("\r", "", $key_text);
		$key_text = str_replace("\n", "", $key_text);	
		$key_text = str_replace("&reg;", "", $key_text);
		$key_text = str_replace("&nbsp;", "", $key_text);
		$key_text = str_replace("&trade;", "", $key_text);
		$key_text = str_replace("&amp;", "&", $key_text);
		$key_text = str_replace("&nbsp;", " ", $key_text);
		$key_text = str_replace("&rsquo;", " ", $key_text);
		$key_text = str_replace("&hellip;", ".. ", $key_text);
		$key_text = str_replace("&ntilde;", ".. ", $key_text);
		$key_text = str_replace("&ldquo;", ".. ", $key_text);
		$key_text = str_replace("&rdquo;", ".. ", $key_text);
		$key_text = str_replace("                       ", " ", $key_text);	
		$key_text = str_replace("                      ", " ", $key_text);
		$key_text = str_replace("                     ", " ", $key_text);
		$key_text = str_replace("                    ", " ", $key_text);
		$key_text = str_replace("                   ", " ", $key_text);
		$key_text = str_replace("                  ", " ", $key_text);
		$key_text = str_replace("                 ", " ", $key_text);
		$key_text = str_replace("                ", " ", $key_text);
		$key_text = str_replace("               ", " ", $key_text);
		$key_text = str_replace("              ", " ", $key_text);
		$key_text = str_replace("             ", " ", $key_text);
		$key_text = str_replace("            ", " ", $key_text);
		$key_text = str_replace("           ", " ", $key_text);
		$key_text = str_replace("          ", " ", $key_text);
		$key_text = str_replace("         ", " ", $key_text);
		$key_text = str_replace("        ", " ", $key_text);
		$key_text = str_replace("       ", " ", $key_text);
		$key_text = str_replace("      ", " ", $key_text);
		$key_text = str_replace("     ", " ", $key_text);
		$key_text = str_replace("    ", " ", $key_text);
		$key_text = str_replace("   ", " ", $key_text);
		$key_text = str_replace("  ", " ", $key_text);
		$key_text = str_replace("'", "", $key_text);
		$key_text = str_replace('"', '', $key_text);
		return $key_text;	
	}
}

// function that cut text to necessay character
if(!function_exists('cutText')){ 
	function cutText($strMy, $maxLength)
	{
		$ret = substr($strMy, 0, $maxLength);
		if (substr($ret, strlen($ret)-1,1) != " " && strlen($strMy) > $maxLength) {
			$ret1 = substr($ret, 0, strrpos($ret," "))." ...";
		} elseif(substr($ret, strlen($ret)-1,1) == " " && strlen($strMy) > $maxLength) {
			$ret1 = $ret." ...";
		} else {
			$ret1 = $ret;
		}
		return $ret1;
	}
}


// function for resize image. If $thumbnail is not set then creates the full description image
if(!function_exists('Resize_File')){ 
	function Resize_File($full_file, $max_width, $max_height, $thumbnail="") {
		
		if (preg_match("/\.png$/i", $full_file)) {
			$img = imagecreatefrompng($full_file);
		}
		
		if (preg_match("/\.(jpg|jpeg)$/i", $full_file)) {
			$img = imagecreatefromjpeg($full_file);
		}
		
		if (preg_match("/\.gif$/i", $full_file)) {
			$img = imagecreatefromgif($full_file);
		}
		
		$FullImage_width = imagesx($img);
		$FullImage_height = imagesy($img);
		
		if (isset($max_width) && isset($max_height) && $max_width != 0 && $max_height != 0 && $FullImage_width>$max_width && $FullImage_height>$max_height) {
			$new_width = $max_width;
			$new_height = $max_height;
		} elseif (isset($max_width) && $max_width != 0 && $FullImage_width>$max_width) {
			$new_width = $max_width;
			$new_height = ((int)($new_width * $FullImage_height) / $FullImage_width);
		} elseif (isset($max_height) && $max_height != 0 && $FullImage_height>$max_height) {
			$new_height = $max_height;
			$new_width = ((int)($new_height * $FullImage_width) / $FullImage_height);
		} else {
			$new_height = $FullImage_height;
			$new_width = $FullImage_width;
		}
		
		$full_id = imagecreatetruecolor((int)$new_width, (int)$new_height);
		if (preg_match("/\.png$/i", $full_file) or preg_match("/\.gif$/i", $full_file)) {
			imagecolortransparent($full_id, imagecolorallocatealpha($full_id, 0, 0, 0, 0));
		}
		imagecopyresampled($full_id, $img, 0, 0, 0, 0, (int)$new_width, (int)$new_height, $FullImage_width, $FullImage_height);
		
		
		if (preg_match("/\.(jpg|jpeg)$/i", $full_file)) {
			if($thumbnail!="") {
				imagejpeg($full_id, $thumbnail, 100);
			} else {
				imagejpeg($full_id, $full_file, 100);
			}
		}
		
		if (preg_match("/\.png$/i", $full_file)) {		
			if($thumbnail!="") {
				imagepng($full_id, $thumbnail);
			} else {
				imagepng($full_id, $full_file);
			}
		}
		
		if (preg_match("/\.gif$/i", $full_file)) {		
			if($thumbnail!="") {
				imagegif($full_id, $thumbnail);
			} else {
				imagegif($full_id, $full_file);
			}
		}
		
		imagedestroy($full_id);
		unset($max_width);
		unset($max_height);
	}
}

// function that get time zones 
if(!function_exists('get_timezones')){ 
	function get_timezones() {
		$o = array();
		 
		$t_zones = timezone_identifiers_list();
		 
		foreach($t_zones as $a) {
			$t = '';
			 
			try {
				//this throws exception for 'US/Pacific-New'
				$zone = new DateTimeZone($a);
				 
				$seconds = $zone->getOffset( new DateTime("now" , $zone) );
				$hours = sprintf( "%+02d" , intval($seconds/3600));
				$minutes = sprintf( "%02d" , ($seconds%3600)/60 );
		 
				$t = $a ."  [ $hours:$minutes ]" ;
				 
				$o[$a] = $t;
			}
			 
			//exceptions must be catched, else a blank page
			catch(Exception $e) {
				//die("Exception : " . $e->getMessage() . '<br />');
				//what to do in catch ? , nothing just relax
			}
		}
		 
		ksort($o);
		 
		return $o;
	}
} 


// list of all the fonts in select drop-down menu
if (!function_exists("font_family_list")) { 
	function font_family_list($fontSelected) {
		
		$fonts = array(
					'Arial'=>'Arial,Helvetica Neue,Helvetica,sans-serif', 
					'Arial Black'=>'Arial Black,Arial Bold,Gadget,sans-serif',
					'Arial Narrow'=>'Arial Narrow,Arial,sans-serif', 
					'Brush Script MT'=>'Brush Script MT,cursive', 
					'Book Antiqua'=>'Book Antiqua,Palatino,Palatino Linotype,Palatino LT STD,Georgia,serif', 
					'Century Gothic'=>'Century Gothic,CenturyGothic,AppleGothic,sans-serif',
					'Comic Sans MS'=>'Comic Sans MS, cursive, sans-serif', 
					'Copperplate'=>'Copperplate,Copperplate Gothic Light,fantasy', 
					'Courier New'=>'Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace', 
					'Gill Sans'=>'Gill Sans,Gill Sans MT,Calibri,sans-serif', 
					'Garamond'=>'Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif', 
					'Georgia'=>'Georgia,Times,Times New Roman,serif', 
					'Helvetica'=>'Helvetica Neue,Helvetica,Arial,sans-serif', 
					'Impact'=>'Impact, Charcoal, sans-serif',
					'Lucida Bright'=>'Lucida Bright,Georgia,serif', 
					'Lucida Console'=>'Lucida Console,Lucida Sans Typewriter,monaco,Bitstream Vera Sans Mono,monospace', 
					'Lucida Sans Unicode'=>'Lucida Sans Unicode, Lucida Grande, sans-serif', 
					'Palatino'=>'Palatino,Palatino Linotype,Palatino LT STD,Book Antiqua,Georgia,serif',
					'Papyrus'=>'Papyrus,fantasy', 
					'Tahoma'=>'Tahoma,Verdana,Segoe,sans-serif', 
					'Times New Roman'=>'TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif', 
					'Trebuchet MS'=>'Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif', 
					'Verdana'=>'Verdana,Geneva,sans-serif', 
					'inherit'=>'inherit',
					'-- custom fonts --'=>'--custom fonts--',  
					'AG-Foreigner-Light-Plain-Medium'=>'AG-Foreigner-Light-Plain-Medium,Helvetica,sans-serif',  
					'Avalon-Bold'=>'Avalon-Bold,Helvetica Neue,Helvetica,sans-serif',
					'Avalon-Plain'=>'Avalon-Plain,Helvetica Neue,Helvetica,sans-serif',
					'Azbuka04'=>'Azbuka04,Helvetica Neue,Helvetica,sans-serif', 
					'Cour'=>'Cour,Helvetica Neue,Helvetica,sans-serif',
					'DSNote'=>'DSNote,Helvetica Neue,Helvetica,sans-serif',
					'HebarU'=>'HebarU,Helvetica Neue,Helvetica,sans-serif',
					'Lato-Regular'=>'Lato-Regular,Helvetica Neue,Helvetica,sans-serif',
					'Montserrat-Regular'=>'Montserrat-Regular,Helvetica Neue,Helvetica,sans-serif',
					'MTCORSVA'=>'MTCORSVA,Helvetica Neue,Helvetica,sans-serif',  
					'Nicoletta_script'=>'Nicoletta_script,Helvetica Neue,Helvetica,sans-serif',  
					'Oswald-Light'=>'Oswald-Light,Helvetica Neue,Helvetica,sans-serif',     
					'Oswald-Regular'=>'Oswald-Regular,Helvetica Neue,Helvetica,sans-serif', 
					'Raleway-Regular'=>'Raleway-Regular,Helvetica Neue,Helvetica,sans-serif',
					'Regina Kursiv'=>'Regina Kursiv,Helvetica Neue,Helvetica,sans-serif',
					'Segoe-UI'=>'Segoe-UI,Helvetica Neue,Helvetica,sans-serif', 
					'Tex Gyre Adventor'=>'Tex Gyre Adventor,Helvetica Neue,Helvetica,sans-serif',			
					'Ubuntu-R'=>'Ubuntu-R,Helvetica Neue,Helvetica,sans-serif'
				);	
		
		$listInput = "";		
		foreach($fonts as $Font=>$FontFull) {
			$listInput .= "<option value='".$FontFull."'";
			if($FontFull==$fontSelected) $listInput .= " selected='selected'";
			if($Font=='-- custom fonts --') $listInput .= " disabled";
			$listInput .= ">".$Font."</option>\n\t\t\t\t";	
		}
		
		return $listInput;
	}
}

// list of all the timezones
if (!function_exists("timezone_list")) { 
	function timezone_list(){
		$t_id_list=array(0=>"Africa/Abidjan",1=>"Africa/Accra",2=>"Africa/Addis_Ababa",3=>"Africa/Algiers",4=>"Africa/Asmara",5=>"Africa/Bamako",6=>"Africa/Bangui",7=>"Africa/Banjul",8=>"Africa/Bissau",9=>"Africa/Blantyre",10=>"Africa/Brazzaville",11=>"Africa/Bujumbura",12=>"Africa/Cairo",13=>"Africa/Casablanca",14=>"Africa/Ceuta",15=>"Africa/Conakry",16=>"Africa/Dakar",17=>"Africa/Dar_es_Salaam",18=>"Africa/Djibouti",19=>"Africa/Douala",20=>"Africa/El_Aaiun",21=>"Africa/Freetown",22=>"Africa/Gaborone",23=>"Africa/Harare",24=>"Africa/Johannesburg",25=>"Africa/Kampala",26=>"Africa/Khartoum",27=>"Africa/Kigali",28=>"Africa/Kinshasa",29=>"Africa/Lagos",30=>"Africa/Libreville",31=>"Africa/Lome",32=>"Africa/Luanda",33=>"Africa/Lubumbashi",34=>"Africa/Lusaka",35=>"Africa/Malabo",36=>"Africa/Maputo",37=>"Africa/Maseru",38=>"Africa/Mbabane",39=>"Africa/Mogadishu",40=>"Africa/Monrovia",41=>"Africa/Nairobi",42=>"Africa/Ndjamena",43=>"Africa/Niamey",44=>"Africa/Nouakchott",45=>"Africa/Ouagadougou",46=>"Africa/Porto-Novo",47=>"Africa/Sao_Tome",48=>"Africa/Tripoli",49=>"Africa/Tunis",50=>"Africa/Windhoek",51=>"America/Adak",52=>"America/Anchorage",53=>"America/Anguilla",54=>"America/Antigua",55=>"America/Araguaina",56=>"America/Argentina/Buenos_Aires",57=>"America/Argentina/Catamarca",58=>"America/Argentina/Cordoba",59=>"America/Argentina/Jujuy",60=>"America/Argentina/La_Rioja",61=>"America/Argentina/Mendoza",62=>"America/Argentina/Rio_Gallegos",63=>"America/Argentina/Salta",64=>"America/Argentina/San_Juan",65=>"America/Argentina/San_Luis",66=>"America/Argentina/Tucuman",67=>"America/Argentina/Ushuaia",68=>"America/Aruba",69=>"America/Asuncion",70=>"America/Atikokan",71=>"America/Bahia",72=>"America/Bahia_Banderas",73=>"America/Barbados",74=>"America/Belem",75=>"America/Belize",76=>"America/Blanc-Sablon",77=>"America/Boa_Vista",78=>"America/Bogota",79=>"America/Boise",80=>"America/Cambridge_Bay",81=>"America/Campo_Grande",82=>"America/Cancun",83=>"America/Caracas",84=>"America/Cayenne",85=>"America/Cayman",86=>"America/Chicago",87=>"America/Chihuahua",88=>"America/Costa_Rica",89=>"America/Cuiaba",90=>"America/Curacao",91=>"America/Danmarkshavn",92=>"America/Dawson",93=>"America/Dawson_Creek",94=>"America/Denver",95=>"America/Detroit",96=>"America/Dominica",97=>"America/Edmonton",98=>"America/Eirunepe",99=>"America/El_Salvador",100=>"America/Fortaleza",101=>"America/Glace_Bay",102=>"America/Godthab",103=>"America/Goose_Bay",104=>"America/Grand_Turk",105=>"America/Grenada",106=>"America/Guadeloupe",107=>"America/Guatemala",108=>"America/Guayaquil",109=>"America/Guyana",110=>"America/Halifax",111=>"America/Havana",112=>"America/Hermosillo",113=>"America/Indiana/Indianapolis",114=>"America/Indiana/Knox",115=>"America/Indiana/Marengo",116=>"America/Indiana/Petersburg",117=>"America/Indiana/Tell_City",118=>"America/Indiana/Vevay",119=>"America/Indiana/Vincennes",120=>"America/Indiana/Winamac",121=>"America/Inuvik",122=>"America/Iqaluit",123=>"America/Jamaica",124=>"America/Juneau",125=>"America/Kentucky/Louisville",126=>"America/Kentucky/Monticello",127=>"America/La_Paz",128=>"America/Lima",129=>"America/Los_Angeles",130=>"America/Maceio",131=>"America/Managua",132=>"America/Manaus",133=>"America/Marigot",134=>"America/Martinique",135=>"America/Matamoros",136=>"America/Mazatlan",137=>"America/Menominee",138=>"America/Merida",139=>"America/Metlakatla",140=>"America/Mexico_City",141=>"America/Miquelon",142=>"America/Moncton",143=>"America/Monterrey",144=>"America/Montevideo",145=>"America/Montreal",146=>"America/Montserrat",147=>"America/Nassau",148=>"America/New_York",149=>"America/Nipigon",150=>"America/Nome",151=>"America/Noronha",152=>"America/North_Dakota/Beulah",153=>"America/North_Dakota/Center",154=>"America/North_Dakota/New_Salem",155=>"America/Ojinaga",156=>"America/Panama",157=>"America/Pangnirtung",158=>"America/Paramaribo",159=>"America/Phoenix",160=>"America/Port-au-Prince",161=>"America/Port_of_Spain",162=>"America/Porto_Velho",163=>"America/Puerto_Rico",164=>"America/Rainy_River",165=>"America/Rankin_Inlet",166=>"America/Recife",167=>"America/Regina",168=>"America/Resolute",169=>"America/Rio_Branco",170=>"America/Santa_Isabel",171=>"America/Santarem",172=>"America/Santiago",173=>"America/Santo_Domingo",174=>"America/Sao_Paulo",175=>"America/Scoresbysund",176=>"America/Shiprock",177=>"America/Sitka",178=>"America/St_Barthelemy",179=>"America/St_Johns",180=>"America/St_Kitts",181=>"America/St_Lucia",182=>"America/St_Thomas",183=>"America/St_Vincent",184=>"America/Swift_Current",185=>"America/Tegucigalpa",186=>"America/Thule",187=>"America/Thunder_Bay",188=>"America/Tijuana",189=>"America/Toronto",190=>"America/Tortola",191=>"America/Vancouver",192=>"America/Whitehorse",193=>"America/Winnipeg",194=>"America/Yakutat",195=>"America/Yellowknife",196=>"Antarctica/Casey",197=>"Antarctica/Davis",198=>"Antarctica/DumontDUrville",199=>"Antarctica/Macquarie",200=>"Antarctica/Mawson",201=>"Antarctica/McMurdo",202=>"Antarctica/Palmer",203=>"Antarctica/Rothera",204=>"Antarctica/South_Pole",205=>"Antarctica/Syowa",206=>"Antarctica/Vostok",207=>"Arctic/Longyearbyen",208=>"Asia/Aden",209=>"Asia/Almaty",210=>"Asia/Amman",211=>"Asia/Anadyr",212=>"Asia/Aqtau",213=>"Asia/Aqtobe",214=>"Asia/Ashgabat",215=>"Asia/Baghdad",216=>"Asia/Bahrain",217=>"Asia/Baku",218=>"Asia/Bangkok",219=>"Asia/Beirut",220=>"Asia/Bishkek",221=>"Asia/Brunei",222=>"Asia/Choibalsan",223=>"Asia/Chongqing",224=>"Asia/Colombo",225=>"Asia/Damascus",226=>"Asia/Dhaka",227=>"Asia/Dili",228=>"Asia/Dubai",229=>"Asia/Dushanbe",230=>"Asia/Gaza",231=>"Asia/Harbin",232=>"Asia/Ho_Chi_Minh",233=>"Asia/Hong_Kong",234=>"Asia/Hovd",235=>"Asia/Irkutsk",236=>"Asia/Jakarta",237=>"Asia/Jayapura",238=>"Asia/Jerusalem",239=>"Asia/Kabul",240=>"Asia/Kamchatka",241=>"Asia/Karachi",242=>"Asia/Kashgar",243=>"Asia/Kathmandu",244=>"Asia/Kolkata",245=>"Asia/Krasnoyarsk",246=>"Asia/Kuala_Lumpur",247=>"Asia/Kuching",248=>"Asia/Kuwait",249=>"Asia/Macau",250=>"Asia/Magadan",251=>"Asia/Makassar",252=>"Asia/Manila",253=>"Asia/Muscat",254=>"Asia/Nicosia",255=>"Asia/Novokuznetsk",256=>"Asia/Novosibirsk",257=>"Asia/Omsk",258=>"Asia/Oral",259=>"Asia/Phnom_Penh",260=>"Asia/Pontianak",261=>"Asia/Pyongyang",262=>"Asia/Qatar",263=>"Asia/Qyzylorda",264=>"Asia/Rangoon",265=>"Asia/Riyadh",266=>"Asia/Sakhalin",267=>"Asia/Samarkand",268=>"Asia/Seoul",269=>"Asia/Shanghai",270=>"Asia/Singapore",271=>"Asia/Taipei",272=>"Asia/Tashkent",273=>"Asia/Tbilisi",274=>"Asia/Tehran",275=>"Asia/Thimphu",276=>"Asia/Tokyo",277=>"Asia/Ulaanbaatar",278=>"Asia/Urumqi",279=>"Asia/Vientiane",280=>"Asia/Vladivostok",281=>"Asia/Yakutsk",282=>"Asia/Yekaterinburg",283=>"Asia/Yerevan",284=>"Atlantic/Azores",285=>"Atlantic/Bermuda",286=>"Atlantic/Canary",287=>"Atlantic/Cape_Verde",288=>"Atlantic/Faroe",289=>"Atlantic/Madeira",290=>"Atlantic/Reykjavik",291=>"Atlantic/South_Georgia",292=>"Atlantic/St_Helena",293=>"Atlantic/Stanley",294=>"Australia/Adelaide",295=>"Australia/Brisbane",296=>"Australia/Broken_Hill",297=>"Australia/Currie",298=>"Australia/Darwin",299=>"Australia/Eucla",300=>"Australia/Hobart",301=>"Australia/Lindeman",302=>"Australia/Lord_Howe",303=>"Australia/Melbourne",304=>"Australia/Perth",305=>"Australia/Sydney",306=>"Europe/Amsterdam",307=>"Europe/Andorra",308=>"Europe/Athens",309=>"Europe/Belgrade",310=>"Europe/Berlin",311=>"Europe/Bratislava",312=>"Europe/Brussels",313=>"Europe/Bucharest",314=>"Europe/Budapest",315=>"Europe/Chisinau",316=>"Europe/Copenhagen",317=>"Europe/Dublin",318=>"Europe/Gibraltar",319=>"Europe/Guernsey",320=>"Europe/Helsinki",321=>"Europe/Isle_of_Man",322=>"Europe/Istanbul",323=>"Europe/Jersey",324=>"Europe/Kaliningrad",325=>"Europe/Kiev",326=>"Europe/Lisbon",327=>"Europe/Ljubljana",328=>"Europe/London",329=>"Europe/Luxembourg",330=>"Europe/Madrid",331=>"Europe/Malta",332=>"Europe/Mariehamn",333=>"Europe/Minsk",334=>"Europe/Monaco",335=>"Europe/Moscow",336=>"Europe/Oslo",337=>"Europe/Paris",338=>"Europe/Podgorica",339=>"Europe/Prague",340=>"Europe/Riga",341=>"Europe/Rome",342=>"Europe/Samara",343=>"Europe/San_Marino",344=>"Europe/Sarajevo",345=>"Europe/Simferopol",346=>"Europe/Skopje",347=>"Europe/Sofia",348=>"Europe/Stockholm",349=>"Europe/Tallinn",350=>"Europe/Tirane",351=>"Europe/Uzhgorod",352=>"Europe/Vaduz",353=>"Europe/Vatican",354=>"Europe/Vienna",355=>"Europe/Vilnius",356=>"Europe/Volgograd",357=>"Europe/Warsaw",358=>"Europe/Zagreb",359=>"Europe/Zaporozhye",360=>"Europe/Zurich",361=>"Indian/Antananarivo",362=>"Indian/Chagos",363=>"Indian/Christmas",364=>"Indian/Cocos",365=>"Indian/Comoro",366=>"Indian/Kerguelen",367=>"Indian/Mahe",368=>"Indian/Maldives",369=>"Indian/Mauritius",370=>"Indian/Mayotte",371=>"Indian/Reunion",372=>"Pacific/Apia",373=>"Pacific/Auckland",374=>"Pacific/Chatham",375=>"Pacific/Chuuk",376=>"Pacific/Easter",377=>"Pacific/Efate",378=>"Pacific/Enderbury",379=>"Pacific/Fakaofo",380=>"Pacific/Fiji",381=>"Pacific/Funafuti",382=>"Pacific/Galapagos",383=>"Pacific/Gambier",384=>"Pacific/Guadalcanal",385=>"Pacific/Guam",386=>"Pacific/Honolulu",387=>"Pacific/Johnston",388=>"Pacific/Kiritimati",389=>"Pacific/Kosrae",390=>"Pacific/Kwajalein",391=>"Pacific/Majuro",392=>"Pacific/Marquesas",393=>"Pacific/Midway",394=>"Pacific/Nauru",395=>"Pacific/Niue",396=>"Pacific/Norfolk",397=>"Pacific/Noumea",398=>"Pacific/Pago_Pago",399=>"Pacific/Palau",400=>"Pacific/Pitcairn",401=>"Pacific/Pohnpei",402=>"Pacific/Port_Moresby",403=>"Pacific/Rarotonga",404=>"Pacific/Saipan",405=>"Pacific/Tahiti",406=>"Pacific/Tarawa",407=>"Pacific/Tongatapu",408=>"Pacific/Wake",409=>"Pacific/Wallis",410=>"UTC "); 
	return $t_id_list; 
	} 
}

/// make SEO friendly titles -> from "Title Number One" to "title-number-one" ///
if (!function_exists("url_slug")) { 
	function url_slug($str, $options = array()) {
		// Make sure string is in UTF-8 and strip invalid UTF-8 characters
		$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
		
		$defaults = array(
			'delimiter' => '-',
			'limit' => null,
			'lowercase' => true,
			'replacements' => array(),
			'transliterate' => true,
		);
		
		// Merge options
		$options = array_merge($defaults, $options);
		
		$char_map = array(
			// Latin
			'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
			'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
			'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
			'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
			'ß' => 'ss', 
			'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
			'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
			'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
			'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
			'ÿ' => 'y',
			// Latin symbols
			'©' => '(c)',
			// Greek
			'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
			'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
			'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
			'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
			'Ϋ' => 'Y',
			'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
			'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
			'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
			'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
			'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
			// Turkish
			'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
			'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
			// Russian
			'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
			'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
			'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
			'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
			'Я' => 'Ya',
			'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
			'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
			'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
			'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
			'я' => 'ya',
			// Ukrainian
			'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
			'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
			// Czech
			'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
			'Ž' => 'Z', 
			'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
			'ž' => 'z', 
			// Polish
			'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
			'Ż' => 'Z', 
			'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
			'ż' => 'z',
			// Latvian
			'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
			'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
			'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
			'š' => 's', 'ū' => 'u', 'ž' => 'z'
		);
		
		// Make custom replacements
		$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
		
		// Transliterate characters to ASCII
		if ($options['transliterate']) {
			$str = str_replace(array_keys($char_map), $char_map, $str);
		}
		
		// Replace non-alphanumeric characters with our delimiter
		$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
		
		// Remove duplicate delimiters
		$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
		
		// Truncate slug to max. characters
		$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
		
		// Remove delimiter from ends
		$str = trim($str, $options['delimiter']);
		
		return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}
}


// Returns filesystem-safe string after cleaning, filtering, and trimming input
if (!function_exists("str_file_filter")) { 
	function str_file_filter($str, $sep = '_', $strict = false, $trim = 248) {
	
		$str = strip_tags(htmlspecialchars_decode(strtolower($str))); // lowercase -> decode -> strip tags
		$str = str_replace("%20", ' ', $str); // convert rogue %20s into spaces
		$str = preg_replace("/%[a-z0-9]{1,2}/i", '', $str); // remove hexy things
		$str = str_replace("&nbsp;", ' ', $str); // convert all nbsp into space
		$str = preg_replace("/&#?[a-z0-9]{2,8};/i", '', $str); // remove the other non-tag things
		$str = preg_replace("/\s+/", $sep, $str); // filter multiple spaces
		$str = preg_replace("/\.+/", '.', $str); // filter multiple periods
		$str = preg_replace("/^\.+/", '', $str); // trim leading period
	
		if ($strict) {
			$str = preg_replace("/([^\w\d\\" . $sep . ".])/", '', $str); // only allow words and digits
		} else {
			$str = preg_replace("/([^\w\d\\" . $sep . "\[\]\(\).])/", '', $str); // allow words, digits, [], and ()
		}
	
		$str = preg_replace("/\\" . $sep . "+/", $sep, $str); // filter multiple separators
		$str = substr($str, 0, $trim); // trim filename to desired length, note 255 char limit on windows
	
		return $str;
	}
}



// function that generate color picker and color fields
if(!function_exists('date_format_list')){ 
	function date_format_list($selectName, $formatSelected) {		
		
		 $dates = array(
		 			'l - F j, Y'=>'l - F j, Y', 
		 			'l - F j Y'=>'l - F j Y', 
		 			'l, F j Y'=>'l, F j Y', 
		 			'l, F j, Y'=>'l, F j, Y', 
		 			'l F j Y'=>'l F j Y', 
		 			'l F j, Y'=>'l F j, Y', 
		 			'F j Y'=>'F j Y', 
		 			'F j, Y'=>'F j, Y', 
		 			'F jS, Y'=>'F jS, Y', 
		 			'F Y'=>'F Y', 
		 			'm-d-Y'=>'m-d-Y', 
		 			'm.d.Y'=>'m.d.Y', 
		 			'm/d/Y'=>'m/d/Y', 
		 			'm-d-y'=>'m-d-y', 
		 			'm.d.y'=>'m.d.y', 
		 			'm/d/y'=>'m/d/y', 
		 			'l - j F, Y'=>'l - j F, Y', 
		 			'l - j F Y'=>'l - j F Y', 
		 			'l, j F Y'=>'l, j F Y', 
		 			'l, j F, Y'=>'l, j F, Y', 
		 			'l j F Y'=>'l j F Y', 
		 			'l j F, Y'=>'l j F, Y', 
		 			'd F Y'=>'d F Y', 
		 			'd F, Y'=>'d F, Y', 
		 			'd-m-Y'=>'d-m-Y', 
		 			'd.m.Y'=>'d.m.Y', 
		 			'd/m/Y'=>'d/m/Y', 
		 			'd-m-y'=>'d-m-y', 
		 			'd.m.y'=>'d.m.y', 
		 			'd/m/y'=>'d/m/y'		 
		 		);	
		
		$listFormatsInput = "";	
		$listFormatsInput .= "<select name='".$selectName."'>";	
		foreach($dates as $Format=>$FormatFull) {
			$listFormatsInput .= "<option value='".$Format."'";
			if($Format==$formatSelected) $listFormatsInput .= " selected='selected'";
			$listFormatsInput .= ">".date($FormatFull)."</option>\n\t\t\t\t";	
		}
		$listFormatsInput .= "</select>";	
		
		return $listFormatsInput;	
		
	}
}

// detect emails in text and return with mailto: link
if (!function_exists("detectEmail")) { 
	function detectEmail($str) {
		//Detect and create email
		$mail_pattern = "/([A-z0-9\._-]+\@[A-z0-9_-]+\.)([A-z0-9\_\-\.]{1,}[A-z])/";
		$str = preg_replace($mail_pattern, '<a href="mailto:$1$2">$1$2</a>', $str);
	
		return $str;
	}
}

// detect website in text and return it as a link
if (!function_exists("detectWebsite")) { 
	
	function detectWebsite($string){

		//The Regular Expression filter
		$reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
	
		// Check if there is a url in the text
		if(preg_match_all($reg_exUrl, $string, $url)) {
	
			// Loop through all matches
			foreach($url[0] as $newLinks){
				if(strstr( $newLinks, ":" ) === false){
					$link = 'http://'.$newLinks;
				}else{
					$link = $newLinks;
				}
	
				// Create Search and Replace strings
				$search  = $newLinks;
				$replace = '<a href="'.$link.'" title="'.$newLinks.'" target="_blank">'.$newLinks.'</a>';
				$string = str_replace($search, $replace, $string);
			}
		}
	
		//Return result
		return $string;
	}
}


$configs_are_set_nl = 1;
?>