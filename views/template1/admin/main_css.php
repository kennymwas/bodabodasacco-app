<?php
header("Content-type: text/css");
?>
body,td,th {
	font-family: tahoma;
	font-size: 11px;
	color: #464646;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEEEEE;
}
.style1 {
	color: #FFFFFF;
	font-size: 10px;
}
.style2 {
	color: #346FAC;
	font-weight: bold;
	font-size: 12px;
}
.style9 {
	color: #000000;
	font-size: 10px;
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	color: #CCCCCC;
	text-decoration: none;
}
a:hover {
	color: #0FF0F0;
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style4 {color: #FFFFFF}
.style5 {
	color: #346FAC;
	font-weight: bold;
}
/*******/
table.dotted td { padding: 6px 5px; background-image: url('<?php echo $template_path ?>images/dotline_horizontal_blu.gif'); background-repeat: repeat-x; background-position: left bottom; }
table.nodotted td { padding: 0px; background-image: none ! important; }
table.udotted td { padding: 6px 5px; }
table.udotted tr { background-image: url('<?php echo $template_path ?>images/dotline_horizontal_blu.gif'); background-repeat: repeat-x; background-position: left top; }
table.dotted tr.header td { background: transparent none repeat scroll 0% 0%; }
table.dotted tr.bg2, table.udotted tr.bg2, .bg2 { background-color: rgb(244, 246, 249); }
table.dotted tr.divider, table.udotted tr.divider { padding: 0pt ! important; height: 1px; }
table.hint { width: 180px; table-layout: fixed; }
table.hint th { padding: 10px 10px 0px; background: transparent url('<?php echo $template_path ?>images/query_bg_top3.gif') no-repeat scroll left top; font-weight: normal; font-size: 90%; text-align: left; }
table.hint td { height: 10px ! important; }
tr, td { vertical-align: top; }
tr.nobg th, .bottom { vertical-align: bottom ! important; }
/*******/
.highlight { color: rgb(253, 147, 44); }