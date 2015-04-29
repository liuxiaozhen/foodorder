<?php
$redis = new redis;
$prekey = 'tigerjoys_food_'.date("Ymd");
try{
    $redis->connect('127.0.0.1', 6379);
    $member_total = $redis->hlen($prekey);
    if(!$member_total) $member_total=0;
    $list_data =  $redis->hgetall($prekey);
}catch(Exception $e){
   
}

function make_list($list_data){
    foreach($list_data  as $each){
		$each = json_decode($each, true);
        $tpl .= '<article class="span3">
                            <figure class="figure">
                                <figcaption>
                                    <h5><a href="#">'.$each['name'].'</a></h5>
                                    <h6><a href="#">'.$each['phone'].'</a></h6>
                                    <h6><a href="#">'.$each['message'].'</a></h6>
                                </figcaption>
                            </figure>
                        </article>';
    }
    return $tpl;
}
?>
<!DOCTYPE HTML>
<html lang="en-us">
<head>
    <title>tigerjoys-food</title>
  	<meta charset="utf-8">
    <meta name="description" content="tigerjoys">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>	
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobilemenu.css">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.session.js"></script>
    <script type="text/javascript" src="js/parallax.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="js/message-form.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript">
		$(window).scroll(function () {
			if (jQuery(this).scrollTop() > 10) {
				jQuery('header').addClass('scrolled');
			} else {
				jQuery('header').removeClass('scrolled');
			}
			$('.flexslider').flexslider({
				animation: "fade",
				animationSpeed: 500,
				smoothHeight: true,
				animationLoop: true,
				touch: true,
				directionNav: false
			});
		});
    </script>
<!--[if lt IE 8]>
<div style=' clear: both; text-align:center; position: relative;'>
 <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
   <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
</a>
</div>
<![endif]-->
<!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
<![endif]-->
</head>
	<body>
		<header class="home_page">
			<div class="container">
            	<div class="row">
                    <div class="span12">
                        <a class="logo" href="index.html">tigerjoys-food</a>
                        <button class="nav-button">menu</button>
                        <ul class="menu">
                            <li><a class="home" href="index.html">老虎致远订餐主页</a></li>
                            <li><a href="list.php">老虎致远订餐统计</a></li>
                        </ul>
                    </div>
                </div>
			</div><!--/container-->
		</header>		
        <div class="row_1">
                <div class="container">
                    <h3 class="border">订餐列表-<?php echo date('Y-m-d');?></h3>
                    <div class="row">
                        <article class="span10 offset1">
                            <p class="text-center">共<?php echo $member_total;?>人订餐</p>
                        </article>
                    </div>
                    <div class="row">
                        <?php echo make_list($list_data); ?>
                    </div>
                </div>
            </div>
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="span12 text-center">
                            &copy; 2015 &nbsp; | &nbsp; all Rights Reserved.  from 老虎致远
                        </div>
                    </div>
                </div>
            </footer>
		</div><!--/container-fill-->
<script type="text/javascript">
</script>
</body>
</html>
