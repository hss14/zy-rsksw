<?php
	class PageZyrsksw {
		public $title="枣阳人事考试网";
		public $style="./css/homepage.css";
		public $content;
		public $buttons = array( "首页" => "index.php",
					 "新闻动态" => "xinwendongtai.php",
					 "公示公告" => "gongshigonggao.php",
					 "专业技术考试" => "zhuanyejishukaoshi.php",
					 "事业单位考试" => "shiyedanweikaoshi.php",
					 "社会化考试" => "shehuihuakaoshi.php",
					 "公务员考试" => "gongwuyuankaoshi.php",
					 "办事指南" => "banshizhinan.php",
					 "资料下载" => "ziliaoxiazai.php"	);

		public function __set($name, $value) {
			$this->name = $value;
		}

		public function Display() {
			$this->DisplayHead();
			$this->DisplayMenu($this->buttons);
			echo $this->content;
			$this->Displayfooter();
		}

		public function DisplayHead( ) {
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
			echo "\t<title>".$this->title."</title>\n";
			echo "\t<link href='".$this->style."' rel='stylesheet' type='text/css' />\n";
?>
	<meta name="description" content="欢迎访问枣阳人事考试网,枣阳市人事考试院,枣阳教育考试网,地址：湖北省枣阳市民主路23号,电话：0710-6311315 " />
	<meta name="keywords" content="枣阳人事考试网,枣阳人事培训考试中心,枣阳教育考试网" />
</head>
<body>
<div class='div900c'>
	<div class="head_title marginAuto"></div>
<?php
		}

		public function IsURLCurrentPage( $url="" ) {
			if( $url == "" )
				return false;
			if( strpos( $_SERVER['PHP_SELF'], $url ) == false )
				return false;
			return true;
		}

		public function DisplayButton( $width, $name, $url, $active=true ) {
			if( $active )
				echo "<td width='".$width."%'><a href='".$url."' title='".$name."'>".$name."</a></td>\n";
			else
				echo "<td width='".$width."%'>".$name."</td>\n";
		}

		public function DisplayMenu( $buttons ) {

        		echo "\t<div class='head_menu marginAuto'>\n";
            		echo "\t\t<div id='head_A' class='left_10p top_10p' style='float: left;'>\n";
			echo "\t\t\t<table width='100%' cellpadding='12' cellspacing='0' border='0'><tr>\n";
			$width = 100 / count($buttons) ;
			foreach ($buttons as $name => $url ) {
				echo "\t\t\t\t";
				$this->DisplayButton($width, $name, $url, ! $this->IsURLCurrentPage($url) );
			}
			echo "\t\t\t</tr></table>\n"."\t\t</div>\n"."\t</div>\n";
		}


		public function Displayfooter() {
?>

	<div class='footer footerimg marginAuto' style='line-height:140%;font-size:13px;'>
	        <A title='工信部备案许可证' href='http://www.miibeian.gov.cn/' target='_blank' rel='nofollow'>鄂ICP备14015568号-1</a>技术支持：<A title='襄阳华维网络' href='http://www.huavee.com/' target='_blank' rel='nofollow'>襄阳华维网络</a><br/>
		版权所有<font color='#4e5766'>：枣阳市人事考试院</font><br/>
        	地址：湖北省枣阳市民主路23号　　　 电话：0710-6311315 
		<script type='text/javascript'>var cnzz_protocol = (('https:' == document.location.protocol) ? ' https://' : ' http://');document.write(unescape('%3Cspan id='cnzz_stat_icon_1253584961'%3E%3C/span%3E%3Cscript src='' + cnzz_protocol + 's11.cnzz.com/stat.php%3Fid%3D1253584961%26show%3Dpic' type='text/javascript'%3E%3C/script%3E'));</script>

	</div>
</div>
</body>
</html>
<?php
		}
	}
?>
