<?php
	require_once("template.inc.php");

	class bulletin extends PageZyrsksw {

		$tablename = $_SERVER['PHP_SELF'];  //title of the table;  should be set for each page;
		// $contentarray      # the array? get from sql? store title, url, ...

		public function Display() {
			$this->DisplayHead();
			$this->DisplayMenu($this->buttons);
			$this->DisplayTable();
			$this->Displayfooter();
		}

		public function DisplayTable() {
		
			echo "\n\t<div class='div900c'>   <!-- parallel to head, menu, footer  -->\n";
			echo "\t\t<div class='panel_NoTopLine'>\n";
			echo "\t\t\t<h3>".$tablename."</h3>\n";
?>                	
			<table class="datagrid" cellspacing="0" cellpadding="3" rules="all" border="1" id="ctl00_ContentPlaceHolder1_dg" style="width:99%;border-collapse:collapse;">

				<tr class="dghs" align="center" style="border-style:None;white-space:nowrap;">
				<td style="width:40px;">序号</td><td>标题</td><td style="width:100px;">发布人</td><td style="width:140px;">发布时间</td>
				</tr>
<?php
			foreach() {   // condition?   change index, a-url, a-title, admin, time !!!!!
				echo "\t\t\t\t<tr class='dgis'  valign='top' OnMouseOut=\"this.style.backgroundColor='White';this.style.color='Black'\" OnMouseOver=\"this.style.backgroundColor='#CCDBEC';this.style.color='blue'\">\n";
				echo "\t\t\t\t\t<td title='1'  align='center'>1</td>\n";
				echo "\t\t\t\t\t<td align='left'><span id='ctl00_ContentPlaceHolder1_dg_ctl03_lblTitle'><a  target='_blank' href='/shiyedanweikaoshi/2016/0418/1261.html' title='关于2015年度襄阳市机关事业单位工勤人员技术等级考核结果的通知'>关于2015年度襄阳市机关事业单位工勤人员技术等级考核结果的通知</a></span></td>\n";
        			echo "\t\t\t\t\t<td style='width:100px;' align='center'>admin</td>\n";
				echo "\t\t\t\t\t<td style='width:140px;' align='center'>2016-04-13</td>\n";
				echo "\t\t\t\t</tr>\n\n";
			} // end of loop who echo each line of the table
?>

			</table>
    		</div>  <!-- end of div class 'panel_NoTopLine' -->


		<div class="page r">   <!-- more than one page??? -->
			<ul>
<?php
			if () {  // if one page is enough
				echo "\t\t\t\t<li><span class='pageinfo'>共 <strong>"."1"."</strong>页<strong>"
					."8"."</strong>条记录</span></li>\n";
			} else {
				echo "\t\t\t\t<li>首页</li>\n";
				echo "\t\t\t\t<li class='thisclass'>1</li>";
				for () {  //condition??? url? page?
					echo "<li><a href='list_279_2.html'>2</a></li>";
				}
				echo "<li><a href='list_279_2.html'>下一页</a></li>";  // how to point to next page? url ?
				echo "<li><a href='list_279_3.html'>末页</a></li>";  // how to get url point to end page?
				echo "<li><select name='sldd' style='width:36px' onchange='location.href=this.options[this.selectedIndex].value;'>
					<option value='list_279_1.html' selected>1</option>
					<option value='list_279_2.html'>2</option>
					<option value='list_279_3.html'>3</option>
					</select></li>";    // another forloop ???
			}
?>
			</ul>
		</div>  <!-- end of div class page r -->
        </div>  <!-- end of div class div900c -->
<?php
		} // end of function DisplayTable()

	}  // end of class bulletin

?>
