<?php
session_start();

$_SESSION['error_msg'] = "";
// Webauth details
$deanauth_dir = dirname($_SERVER['PHP_SELF']).'/';
$webauth_service = urlencode('https://'.$_SERVER['HTTP_HOST'].$deanauth_dir.'webauth.php');

$webauth_banner = urlencode('SBS Lists');
$href = 'https://webauth.arizona.edu/webauth/login?service='.$webauth_service.'&banner='.$webauth_banner;

$signon_link = "https://".$_SERVER["HTTP_HOST"]."/Shibboleth.sso/Login?target=".$webauth_service;
$signoff_link = "https://".$_SERVER["HTTP_HOST"]."/Shibboleth.sso/Logout?return=https://shibboleth.arizona.edu/cgi-bin/logout.pl";

if ($_GET['logout']) {
    $_SESSION['redir_page'] = $_SERVER['HTTP_REFERER'];
    unset($_SESSION['admin']);
    header("location: $signoff_link");
    exit;
}
else
{
	//check shib server information, if uid exists, continues
	if($_SERVER["Shib-uid"]){

		$client["netid"] =  $_SERVER["Shib-uid"];
		$client["sid"] =  $_SERVER["Shib-emplId"];

		//check if netid exists in shib variables
		if(!empty($client)){

			extract($client);

			//if( $netid == 'xiaz' or $netid == 'mikagb' or $netid == 'pedroza' or $netid == 'harwoodl' or $netid == 'arajashekar' or $netid == 'zsaenz' or $netid == 'smathers' or $netid == 'jcg' or $netid == 'smathers' or $netid == 'jcg' or  $netid == 'smathers' or $netid == 'vgarriso' or  $netid == 'fletch' or $netid == 'ymin')
			if( $netid == 'xiaz' or $netid == 'arajashekar')
			{
				$_SESSION["admin"] = $netid;
				header("location: index.php");
				exit;
			}
		}


		echo "You are not authorized to access this resource!";
		exit;
	}
}

header("location: ".$signon_link);
exit;
