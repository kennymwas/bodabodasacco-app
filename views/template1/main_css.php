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
	color: blue;
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
.form-signin{
	
}
.form-control {
  display: block;
  width: 40%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-control:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
.form-control::-moz-placeholder {
  color: #999;
  opacity: 1;
}
.form-control:-ms-input-placeholder {
  color: #999;
}
.form-control::-webkit-input-placeholder {
  color: #999;
}
.form-control::-ms-expand {
  background-color: transparent;
  border: 0;
}
.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}
.btn-primary {
  color: #fff;
  background-color: #337ab7;
  border-color: #2e6da4;
}
.btn-primary:hover {
  color: #fff;
  background-color: #286090;
  border-color: #204d74;
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