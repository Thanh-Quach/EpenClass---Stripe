<!DOCTYPE html>

<?php

include'header.php';
include'preloader.php';
include'03_loginForm/form.php';
include'00_siteNavigation/globalNav.php';
include'09_dialog/notice.php';


switch(@$_GET['page'])
{

	default:
	include_once '01_homePage/home.php';
	break;

	case 'login' :
	include_once '02_login/login.php';
	break;

	case 'usrIndex' :
	include_once '08_user/usrIndex.php';
	break;

	case 'careers' :
	include_once '05_careers/careers.php';
	break;

	case 'pricing' :
	include_once '06_pricing/pricing.php';
	break;

	case 'about' :
	include_once '07_about/about.php';
	break;
	
}

include '00_siteNavigation/footerNav.php';
include'footer.php'

?>
