<?php

/*
 * documin - minimal document management system
 * Copyright (C) 2014  Jim Trainor
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.  You should have received a
 * copy of the GNU General Public License along with this program.  If
 * not, see <http://www.gnu.org/licenses/>.
 * 
 * Documin was derived from the Encode Explorer file browser by Marek
 * Rei (http://encode-explorer.siineiolekala.net). All images except
 * file_cabinet were designed by Mark James (http://www.famfamfam.com)
 * and distributed under the Creative Commons Attribution 3.0
 * License. The file_cabinet image came from
 * http://commons.wikimedia.org/wiki/File:Golden_file_cabinet.png and
 * is distributed under the GNU Free Documentation License, Version
 * 1.2.
 */

$_CONFIG     = array();
$_ERROR      = "";
$_START_TIME = microtime(TRUE);

/***************************************************************************
 *   Configuration 
 ***************************************************************************/

// Document database file.
$_CONFIG['dbfile'] = 'documin.sqlite';

// Choose a language. (Only "en" for now.)
$_CONFIG['lang'] = "en";

// Will the files be opened in a new window? true/false 
$_CONFIG['open_in_new_window'] = false;

// Will the page header be displayed? 0=no, 1=yes. 
$_CONFIG['show_top'] = true;
//
// The page title
$_CONFIG['main_title'] = "documin";

// Display breadcrumbs (relative path of the location).
$_CONFIG['show_path'] = true;

// Display the file count, load time it took to load the page, etc.
$_CONFIG['show_info'] = true;

// The time format for the "last changed" column.
$_CONFIG['time_format'] = "d.m.y H:i:s";

// Charset. Use the one that suits for you. 
$_CONFIG['charset'] = "UTF-8";

// Regular expression to match files that should be hidden.
$_CONFIG['hidden_file_regex'] = "/^\\.|~$|index.php|documin.php|documin.db|documin.sqlite/";

// Regular expression to match directories that should be hidden.
$_CONFIG['hidden_dir_regex'] = "";

// Enable/disaable file upload and creatiion new directories.
$_CONFIG['upload_enable'] = true;

// MIME type that are allowed to be uploaded.
// For example, to only allow uploading of common image types, you could use:
// $_CONFIG['upload_allow_type'] = array("image/png", "image/gif", "image/jpeg");
$_CONFIG['upload_allow_type'] = array();

// File extensions that are not allowed for uploading.
// For example: $_CONFIG['upload_reject_extension'] = array("php", "html", "htm");
$_CONFIG['upload_reject_extension'] = array("php");

// The starting directory. Normally no need to change this.
// Use only relative subdirectories! 
// For example: $_CONFIG['starting_dir'] = "./mysubdir/";
$_CONFIG['starting_dir'] = ".";

// Location in the server. Usually this does not have to be set manually.
// Default: $_CONFIG['basedir'] = "";
$_CONFIG['basedir'] = "";

// Big files. If you have some very big files (>4GB), enable this for correct
// file size calculation.
// Default: $_CONFIG['large_files'] = false;
$_CONFIG['large_files'] = false;

// The file hash type.
// "md5int32" - decimal md5sum mod 2^31
// "md5int364" - decimal md5sum mod 2^63
// [any other value] - 128 bit hex md5sum (default)
$_CONFIG['hash_type'] = "md5int32";

// File mode for new uploads
$_CONFIG['file_mode'] = 0444;

/***************************************************************************
 *   Translations
 ***************************************************************************/

$_TRANSLATIONS = array();

// English
$_TRANSLATIONS["en"] = array(
  "file_name" => "File name",
  "size" => "Size",
  "last_changed" => "Last changed",
  "upload" => "Upload",
  "failed_upload" => "Failed to upload the file!",
  "failed_move" => "Failed to move the file into the right directory!",
  "make_directory" => "New dir",
  "new_dir_failed" => "Failed to create directory",
  "unable_to_read_dir" => "Unable to read directory",
  "upload_not_allowed" => "The script configuration does not allow uploading in this directory.",
  "upload_dir_not_writable" => "This directory does not have write permissions.",
  "upload_type_not_allowed" => "This file type is not allowed for uploading.",
  "failed_file_chmod" => "Failed to change the permissions of the uploaded file.",
  "page_load_time" => "page load time %.0f ms",
  "file_index_count" => "%d indexed",
  "file_sum_size" => "%s managed"
);

/***************************************************************************
 *  CSS Styles
 ***************************************************************************/

function css()
{
?>
<style type="text/css">

/* General styles */

BODY {
	background-color:#FFFFFF;
	font-family:Verdana;
	font-size:small;
}

A {
	color: #000000;
	text-decoration: none;
}

A:hover {
	text-decoration: underline;
}

#top_image {
	width:100%;
        background: url( "?img=file_cabinet" );
        background-repeat: repeat-x;
        background-position: center;
        height: 128px;
        align: center;
}

#top_title div {
        width: 100%;
}

#top_title a  {
        display:block;
}

#top_title a span {
	color:#68a9d2;
	font-weight:bold;
	font-size:large;
	padding: 10;
        display:block;
        text-align:center;
}

div.subtitle{
	width:80%;
	margin: 0 auto;
	color:#68a9d2;
	text-align:center;
}

#frame {
	border: 1px solid #CDD2D6;
	text-align:left;
	position: relative;
	margin: 0 auto;
	overflow:hidden;
}

#error {
	max-width:50%;
	background-color:#FFE4E1;
	color:#000000;
	padding:7pt;
	position: relative;
	margin: 10pt auto;
	text-align:center;
	border: 1px dotted #CDD2D6;
}

input {
	border: 1px solid #CDD2D6;
}

.bar{
	width:100%;
	clear:both;
	height:1px;
}

/* File list */

table.table {
	width:100%;
	border-collapse: collapse; 
}

table.table td{
	padding:3px;
}

table.table tr.row.two {
	background-color:#fcfdfe;
}

table.table tr.row.one {
	background-color:#f8f9fa;
}

table.table tr.row td.icon {
	width:25px;
	padding-top:3px;
	padding-bottom:1px;
}

table.table tr.row td.size {
	width: 100px; 
	text-align: right;
}

table.table tr.row td.changed {
	width: 150px;
	text-align: center;
}

table.table tr.row td.fileid {
        font-family: monospace;
	text-align: center;
}

table.table tr.header img {
	vertical-align:bottom;
}

table img{
	border:0;
}

/* Info area */ 

#info {
	color:#000000;
	font-family:Verdana;
	max-width:680px;
	position: relative;
        margin: auto;
	margin-top: 10px;
	text-align:center;
	font-size:x-small;
}

/* Upload area */

#upload {
	margin: 0 auto;
	margin-top:2px;
	max-width:680px;
}

#upload #password_container {
	margin-right:20px;
}

#upload #newdir_container, #upload #password_container {
	float:left;
}

#upload #upload_container{
	float:right;
}

#upload input.upload_dirname, #upload input.upload_password{
	width:140px;
}

#upload input.upload_file{
	font-size:small;
}

/* Breadcrumbs */

div.breadcrumbs {
	display:block;
	padding:1px 3px;
	color:#9999999;
	font-size:x-small;
}

div.breadcrumbs a{
	display:inline-block;
	color:#999999;
	padding:2px 0;
	font-size:small;
}

/* admin link */
div.adminlink {
       float: right;
}

</style>

<?php
}

/***************************************************************************
 *   IMAGE CODES IN BASE64
 *   You can generate your own with a converter        
 *   Like here: http://www.motobit.com/util/base64-decoder-encoder.asp
 *   Or here: http://www.greywyvern.com/code/php/binary2base64
 *   Or just use PHP base64_encode() function
 ***************************************************************************/

$_IMAGES = array();

// thanks, http://commons.wikimedia.org/wiki/File:Golden_file_cabinet.png
$_IMAGES["file_cabinet"] = 
"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";

$_IMAGES["arrow_down"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAABbSURBVCjPY/jPgB8yDCkFB/7v+r/5/+r/
i/7P+N/3DYuC7V93/d//fydQ0Zz/9eexKFgtsejLiv8b/8/8X/WtUBGrGyZLdH6f8r/sW64cTkdW
SRS+zpQbgiEJAI4UCqdRg1A6AAAAAElFTkSuQmCC";
$_IMAGES["arrow_up"]   = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAABbSURBVCjPY/jPgB8yDDkFmyVWv14kh1PB
eoll31f/n/ytUw6rgtUSi76s+L/x/8z/Vd8KFbEomPt16f/1/1f+X/S/7X/qeSwK+v63/K/6X/g/
83/S/5hvQywkAdMGCdCoabZeAAAAAElFTkSuQmCC";

$_IMAGES["directory"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAGrSURBVDjLxZO7ihRBFIa/6u0ZW7GHBUV0
UQQTZzd3QdhMQxOfwMRXEANBMNQX0MzAzFAwEzHwARbNFDdwEd31Mj3X7a6uOr9BtzNjYjKBJ6ni
cP7v3KqcJFaxhBVtZUAK8OHlld2st7Xl3DJPVONP+zEUV4HqL5UDYHr5xvuQAjgl/Qs7TzvOOVAj
xjlC+ePSwe6DfbVegLVuT4r14eTr6zvA8xSAoBLzx6pvj4l+DZIezuVkG9fY2H7YRQIMZIBwycmz
H1/s3F8AapfIPNF3kQk7+kw9PWBy+IZOdg5Ug3mkAATy/t0usovzGeCUWTjCz0B+Sj0ekfdvkZ3a
bBv+U4GaCtJ1iEm6ANQJ6fEzrG/engcKw/wXQvEKxSEKQxRGKE7Izt+DSiwBJMUSm71rguMYhQKr
BygOIRStf4TiFFRBvbRGKiQLWP29yRSHKBTtfdBmHs0BUpgvtgF4yRFR+NUKi0XZcYjCeCG2smkz
LAHkbRBmP0/Uk26O5YnUActBp1GsAI+S5nRJJJal5K1aAMrq0d6Tm9uI6zjyf75dAe6tx/SsWeD/
/o2/Ab6IH3/h25pOAAAAAElFTkSuQmCC";

$_IMAGES["image"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAGWSURBVBgZpcE/a1NhGMbh3/OeN56cKq2D
p6AoCOKmk4uCn8DNycEOIojilr2TaBfRzVnESQR3Bz+FFDoWA2IjtkRqmpyc97k9qYl/IQV7XSaJ
w4g0VlZfP0m13dwepPbuiH85fyhyWCx4/ubxjU6kkdxWHt69VC6XpZlFBAhwJgwJJHAmRKorbj94
ewvoRBrbuykvT5R2/+lLTp05Tp45STmEJYJBMAjByILxYeM9jzr3GCczGpHGYAQhRM6fO8uFy1fJ
QoaUwCKYEcwwC4QQaGUBd36KTDmQ523axTGQmEcIEBORKQfG1ZDxcA/MkBxXwj1ggCQyS9TVAMmZ
iUxJ8Ln/kS+9PmOvcSW+jrao0mmMH5bzHfa+9UGBmciUBJ+2Fmh1h+yTQCXSkJkdCrpd8btIwwEJ
QnaEkOXMk7XaiF8CUxL/JdKQOwb0Ntc5SG9zHXQNd/ZFGsaEeLa2ChjzXQcqZiKNxSL0vR4unVww
MENMCATib0ZdV+QtE41I42geXt1Ze3dlMNZFdw6Ut6CIvKBhkjiM79Pyq1YUmtkKAAAAAElFTkSu
QmCC";

$_IMAGES["textdocument"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAIdSURBVDjLjZO7a5RREMV/9/F9yaLBzQY3
CC7EpBGxU2O0EBG0sxHBUitTWYitYCsiiJL0NvlfgoWSRpGA4IMsm43ZXchmv8e9MxZZN1GD5MCB
W8yce4aZY1QVAGPMaWAacPwfm8A3VRUAVJWhyIUsy7plWcYQgh7GLMt0aWnpNTADWFX9Q2C+LMu4
s7Oj/X5/xF6vp51OR1utloYQtNls6vLy8kjE3Huz9qPIQjcUg/GZenVOokIEiSBBCKUSQ+TFwwa1
Wo2iKBARVlZW3iwuLr7izssPnwZ50DLIoWz9zPT+s/fabrf/GQmY97GIIXGWp28/08si5+oV1jcG
TCSO6nHH2pddYqmkaUq320VECCFQr9cBsBIVBbJcSdXQmK7Q6Qsnq54sj2gBplS896RpSpIkjI2N
jVZitdh7jAOSK6trXcpC2GjlfP1esHD+GDYozjm893jvSZJkXyAWe+ssc6W5G9naLqkaw/pGxBrl
1tVpJCrWWpxzI6GRgOQKCv2BYHPl5uUatROeSsVy7eIkU9UUiYoxBgDnHNbagw4U6yAWwpmphNvX
T6HAhAZuLNRx1iDDWzHG/L6ZEbyJVLa2c54/PgsKgyzw5MHcqKC9nROK/aaDvwN4KYS7j959DHk2
PtuYnBUBFUEVVBQRgzX7I/wNM7RmgEshhFXAcDSI9/6KHQZKAYkxDgA5SnOMcReI5kCcG8M42yM6
iMDmL261eaOOnqrOAAAAAElFTkSuQmCC";

$_IMAGES["spreadsheet"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0                                                                                   
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAIpSURBVDjLjZNPSFRRFMZ/9707o0SOOshM                                                                                                              
0x/JFtUmisKBooVEEUThsgi3KS0CN0G2lagWEYkSUdsRWgSFG9sVFAW1EIwQqRZiiDOZY804b967                                                                                                              
954249hUpB98y/PjO5zzKREBQCm1E0gDPv9XHpgTEQeAiFCDHAmCoBhFkTXGyL8cBIGMjo7eA3YD                                                                                                              
nog0ALJRFNlSqSTlcrnulZUVWV5elsXFRTHGyMLCgoyNjdUhanCyV9ayOSeIdTgnOCtY43DWYY3j
9ulxkskkYRjinCOXy40MDAzcZXCyVzZS38MeKRQKf60EZPXSXInL9y+wLZMkCMs0RR28mJ2grSWJ
Eo+lH9/IpNPE43GKxSLOOYwxpFIpAPTWjiaOtZ+gLdFKlJlD8u00xWP8lO/M5+e5efEB18b70Vqj
lMJai++vH8qLqoa+nn4+fJmiNNPCvMzQnIjzZuo1V88Ns3/HAcKKwfd9tNZorYnFYuuAMLDMfJ3m
+fQznr7L0Vk9zGpLmezB4zx++YggqhAFEZ7n4ft+HVQHVMoB5++cJNWaRrQwMjHM9qCLTFcnJJq5
9WSIMLAopQDwfR/P8+oAbaqWK2eGSGxpxVrDnvQ+3s++4tPnj4SewYscUdUgIiilcM41/uXZG9kN
z9h9aa+EYdjg+hnDwHDq+iGsaXwcZ6XhsdZW+FOqFk0B3caYt4Bic3Ja66NerVACOGttBXCbGbbW
rgJW/VbnXbU6e5tMYIH8L54Xq0cq018+AAAAAElFTkSuQmCC";

$_IMAGES["unknown"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAC4SURBVCjPdZFbDsIgEEWnrsMm7oGGfZro
hxvU+Iq1TyjU60Bf1pac4Yc5YS4ZAtGWBMk/drQBOVwJlZrWYkLhsB8UV9K0BUrPGy9cWbng2CtE
EUmLGppPjRwpbixUKHBiZRS0p+ZGhvs4irNEvWD8heHpbsyDXznPhYFOyTjJc13olIqzZCHBouE0
FRMUjA+s1gTjaRgVFpqRwC8mfoXPPEVPS7LbRaJL2y7bOifRCTEli3U7BMWgLzKlW/CuebZPAAAA
AElFTkSuQmCC";

$_IMAGES["pdf"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHhSURBVDjLjZPLSxtRFIfVZRdWi0oFBf+B
rhRx5dKVYKG4tLhRqlgXPmIVJQiC60JCCZYqFHQh7rrQlUK7aVUUfCBRG5RkJpNkkswrM5NEf73n
6gxpHujAB/fOvefjnHM5VQCqCPa1MNoZnU/Qxqhx4woE7ZZlpXO53F0+n0c52Dl8Pt/nQkmhoJOC
dUWBsvQJ2u4ODMOAwvapVAqSJHGJKIrw+/2uxAmuJgFdMDUVincSxvEBTNOEpmlIp9OIxWJckMlk
oOs6AoHAg6RYYNs2kp4RqOvfuIACVFVFPB4vKYn3pFjAykDSOwVta52vqW6nlEQiwTMRBKGygIh9
GEDCMwZH6EgoE+qHLMuVBdbfKwjv3yE6Ogjz/PQ/CZVDPSFRRYE4/RHy1y8wry8RGWGSqyC/nM1m
eX9IQpQV2JKIUH8vrEgYmeAFwuPDCHa9QehtD26HBhCZnYC8ucGzKSsIL8wgsjiH1PYPxL+vQvm5
B/3sBMLyIm7GhhCe90BaWykV/Gp+VR9oqPVe9vfBTsruM1HtBKVPmFIUNusBrV3B4ev6bsbyXlPd
kbr/u+StHUkxruBPY+0KY8f38oWX/byvNAdluHNLeOxDB+uyQQfPCWZ3NT69BYJWkjxjnB1o9Fv/
ASQ5s+ABz8i2AAAAAElFTkSuQmCC";

$_IMAGES["webpage"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAJwSURBVDjLjZPdT1JhHMetvyO3/gfLKy+6
8bLV2qIAq7UyG6IrdRPL5hs2U5FR0MJIAqZlh7BVViI1kkyyiPkCyUtztQYTYbwJE8W+Pc8pjofK
1dk+OxfP+X3O83srAVBCIc8eQhmh/B/sJezm4niCsvX19cTm5uZWPp/H3yDnUKvVKr6ELyinwWtr
a8hkMhzJZBLxeBwrKyusJBwOQ6PRcJJC8K4DJ/dXM04DOswNqNOLybsRo9N6LCy7kUgkEIlEWEE2
mwX9iVar/Smhglqd8IREKwya3qhg809gPLgI/XsrOp/IcXVMhqnFSayurv6RElsT6ZCoov5u1fzU
VwvcKRdefVuEKRCA3OFHv2MOxtlBdFuaMf/ZhWg0yt4kFAoVCZS3Hd1gkpOwRt9h0LOES3YvamzP
cdF7A6rlPrSbpbhP0kmlUmw9YrHYtoDku2T6pEZ/2ICXEQ8kTz+g2TkNceAKKv2nIHachn6qBx1M
I5t/Op1mRXzBd31AiRafBp1vZyEcceGCzQ6p24yjEzocGT6LUacS0iExcrkcK6Fsp6AXLRnmFOjy
PMIZixPHmAAOGxZQec2OQyo7zpm6cNN6GZ2kK1RAofPAr8GA4oUMrdNNkIw/wPFhDwSjX3Dwlg0C
Qy96HreiTlcFZsaAjY0NNvh3QUXtHeHcoKMNA7NjqLd8xHmzDzXDRvRO1KHtngTyhzL4SHeooAAn
KMxBtUYQbGWa0Dc+AsWzSVy3qkjeItLCFsz4XoNMaRFFAm4SyTXbmQa2YHQSGacR/pAXO+zGFif4
JdlHCpShBzstEz+YfJtmt5cnKKWS/1jnAnT1S38AGTynUFUTzJcAAAAASUVORK5CYII=";

$_IMAGES["txt"] = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0
U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAADoSURBVBgZBcExblNBGAbA2ceegTRBuIKO
giihSZNTcC5LUHAihNJR0kGKCDcYJY6D3/77MdOinTvzAgCw8ysThIvn/VojIyMjIyPP+bS1sUQI
V2s95pBDDvmbP/mdkft83tpYguZq5Jh/OeaYh+yzy8hTHvNlaxNNczm+la9OTlar1UdA/+C2A4tr
RCnD3jS8BB1obq2Gk6GU6QbQAS4BUaYSQAf4bhhKKTFdAzrAOwAxEUAH+KEM01SY3gM6wBsEAQB0
gJ+maZoC3gI6iPYaAIBJsiRmHU0AALOeFC3aK2cWAACUXe7+AwO0lc9eTHYTAAAAAElFTkSuQmCC";

$_IMAGES["doc"]  = $_IMAGES["textdocument"];
$_IMAGES["docx"] = $_IMAGES["textdocument"];

$_IMAGES["xls"]  = $_IMAGES["spreadsheet"];
$_IMAGES["xlsx"] = $_IMAGES["spreadsheet"];

$_IMAGES["htm"]  = $_IMAGES["webpage"];
$_IMAGES["html"] = $_IMAGES["webpage"];

$_IMAGES["jpg"]  = $_IMAGES["image"];
$_IMAGES["jpeg"] = $_IMAGES["image"];
$_IMAGES["odt"]  = $_IMAGES["textdocument"];

$_IMAGES["png"] = $_IMAGES["image"];

/***************************************************************************/
/*   PHP code
/***************************************************************************/

// thanks: stackoverflow
function getScriptUrl()
{
  $uri = $_SERVER['REQUEST_URI'];
  if (strpos($uri, "?") !== false) {
    $uriSplit = explode("?", $uri);
    $uri      = $uriSplit[0];
  }
  
  if (isset($_SERVER['HTTPS'])) {
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
  } else {
    $protocol = 'http';
  }
  
  return $protocol . "://" . $_SERVER['HTTP_HOST'] . $uri;
}

function getScriptRootDir() {
  $parts = explode("/", $_SERVER['SCRIPT_NAME']);
  return $parts[sizeof($parts)-2];
}

// thanks http://www.php.net/manual/en/ref.bc.php
function bchexdec($hex)
{
  if (strlen($hex) == 1) {
    return hexdec($hex);
  } else {
    $remain = substr($hex, 0, -1);
    $last   = substr($hex, -1);
    return bcadd(bcmul(16, bchexdec($remain)), hexdec($last));
  }
}

function documin_file_hash($filePath)
{
  $hashType = Documin::getConfig("hash_type");
  $md5sum = md5_file($filePath);
  if ($hashType == "md5int32") {
    return bcmod(bchexdec($md5sum), strval(pow(2,31)));
  }
  else if ($hashType == "md5int64") {
    return bcmod(bchexdec($md5sum), strval(pow(2,63)));
  }
  else {
    return $md5sum;
  }
}

//
// The class that displays images (icons).
//
class ImageServer
{
  //
  // Checks if an image is requested and displays one if needed
  //
  public static function handleImageRequest()
  {
    global $_IMAGES;
    if (isset($_GET['img'])) {
      if (strlen($_GET['img']) > 0) {
        $mtime = gmdate('r', filemtime($_SERVER['SCRIPT_FILENAME']));
        $etag  = md5($mtime . $_SERVER['SCRIPT_FILENAME']);
        
        if ((isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $mtime) ||
            (isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $etag)) {
          header('HTTP/1.1 304 Not Modified');
          return true;
        } else {
          header('ETag: "' . $etag . '"');
          header('Last-Modified: ' . $mtime);
          header('Content-type: image/gif');
          if (isset($_IMAGES[$_GET['img']]))
            print base64_decode($_IMAGES[$_GET['img']]);
          else
            print base64_decode($_IMAGES["unknown"]);
        }
      }
      return true;
    }
    return false;
  }
}

//
// Database utility class.
//

class Database
{
  const SQL_CREATE_DATABASE = "
      CREATE TABLE IF NOT EXISTS file (id TEXT, size INTEGER, path TEXT);
      CREATE INDEX IF NOT EXISTS file_id_idx ON file(id);
      CREATE UNIQUE INDEX IF NOT EXISTS file_path_idx ON file(path);
     ";
  
  const SQL_INSERT_FILE = "INSERT INTO file VALUES (?, ?, ?)";
  
  const SQL_SELECT_FILE = "SELECT path FROM file WHERE id=? LIMIT 100";
  
  const SQL_SELECT_PATH = "SELECT id FROM file WHERE path=?";

  const SQL_COUNT_FILES = "SELECT count(id) FROM file";

  const SQL_SUM_SIZE_FILES = "SELECT sum(size) FROM file";
  
  public static function handleRemoveRequest()
  {
    if (isset($_GET['do_remove_database'])) {
      $dbfilename = Documin::getConfig('dbfile');
      if (unlink($dbfilename)) {
        print("successfully removed $dbfilename");
      } else {
        print("failed to remove $dbfilename");
      }
      return true;
    }
    
    return false;
  }
  
  private $db = null;
  private $insertFileStmnt = null;
  private $selectFileStmnt = null;
  private $selectPathStmnt = null;
  
  public function __construct()
  {
    $this->db = new PDO("sqlite:" . Documin::getConfig('dbfile'));
    $this->db->exec(self::SQL_CREATE_DATABASE);
  }
  
  public function addFileRecord($id, $size, $path)
  {
    if ($this->insertFileStmnt == null) {
      $this->insertFileStmnt = $this->db->prepare(self::SQL_INSERT_FILE);
    }
    
    $this->insertFileStmnt->execute(array($id, $size, $path));
  }
  
  public function getFileId($path)
  {
    if ($this->selectPathStmnt == null) {
      $this->selectPathStmnt = $this->db->prepare(self::SQL_SELECT_PATH);
    }
    
    $this->selectPathStmnt->execute(array(
      $path
    ));
    
    $all = $this->selectPathStmnt->fetchAll(PDO::FETCH_COLUMN, 0);
    if (count($all) == 0) {
      return null;
    } else {
      assert(count($all) == 1);
      return $all[0];
    }
  }
  
  public function getFilePaths($id)
  {
    if ($this->selectFileStmnt == null) {
      $this->selectFileStmnt = $this->db->prepare(self::SQL_SELECT_FILE);
    }
    
    $this->selectFileStmnt->execute(array(
      $id
    ));
    return $this->selectFileStmnt->fetchAll(PDO::FETCH_COLUMN, 0);
  }

  public function getFileCount() {
    return $this->db->query(self::SQL_COUNT_FILES)->fetchColumn();
  }

  public function getSumSize() {
    return $this->db->query(self::SQL_SUM_SIZE_FILES)->fetchColumn();
  }
}

// 
// File upload and new directory create.
//
class FileManager
{
  function newFolder($location, $dirname)
  {
    if (strlen($dirname) > 0) {
      $forbidden = array(
        ".",
        "/",
        "\\"
      );
      for ($i = 0; $i < count($forbidden); $i++) {
        $dirname = str_replace($forbidden[$i], "", $dirname);
      }
      
      if (!$location->uploadAllowed()) {
        // The system configuration does not allow uploading here
        Documin::setErrorString("upload_not_allowed");
        return;
      }

      if (!$location->isWritable()) {
        // The target directory is not writable
        Documin::setErrorString("upload_dir_not_writable");
        return;
      }

      if (!mkdir($location->getDir(true, false, false, 0) . $dirname)) {
        // Error creating a new directory
        Documin::setErrorString("new_dir_failed");
        return;
      }
    }
  }
  
  function uploadFile($location, $userfile)
  {
    $name = basename($userfile['name']);
    if (get_magic_quotes_gpc())
      $name = stripslashes($name);
    
    $upload_dir  = $location->getFullPath();
    $upload_file = $upload_dir . $name;
    
    if (function_exists("finfo_open") && function_exists("finfo_file"))
      $mime_type = File::getFileMime($userfile['tmp_name']);
    else
      $mime_type = $userfile['type'];
    
    $extension = File::getFileExtension($userfile['name']);
    
    if (!$location->uploadAllowed()) {
      Documin::setErrorString("upload_not_allowed");
    } else if (!$location->isWritable()) {
      Documin::setErrorString("upload_dir_not_writable");
    } else if (!is_uploaded_file($userfile['tmp_name'])) {
      Documin::setErrorString("failed_upload");
    } else if (is_array(Documin::getConfig("upload_allow_type")) && count(Documin::getConfig("upload_allow_type")) > 0 && !in_array($mime_type, Documin::getConfig("upload_allow_type"))) {
      Documin::setErrorString("upload_type_not_allowed");
    } else if (is_array(Documin::getConfig("upload_reject_extension")) && count(Documin::getConfig("upload_reject_extension")) > 0 && in_array($extension, Documin::getConfig("upload_reject_extension"))) {
      Documin::setErrorString("upload_type_not_allowed");
    } else if (!@move_uploaded_file($userfile['tmp_name'], $upload_file)) {
      Documin::setErrorString("failed_move");
    } else if (!chmod($upload_file, Documin::getConfig("file_mode"))) {
      Documin::setErrorString("failed_file_chmod");
    }
  }
    
  //
  // The main function, checks if the user wants to perform any supported operations
  // 
  function run($location)
  {
    if (isset($_POST['userdir']) && strlen($_POST['userdir']) > 0) {
      if ($location->uploadAllowed()) {
        $this->newFolder($location, $_POST['userdir']);
      }
    }
    
    if (isset($_FILES['userfile']['name']) && strlen($_FILES['userfile']['name']) > 0) {
      if ($location->uploadAllowed()) {
        $this->uploadFile($location, $_FILES['userfile']);
      }
    }
  }
}

//
// Dir class holds the information about one directory in the list
//
class Dir
{
  var $name;
  var $location;
  
  //
  // Constructor
  // 
  function Dir($name, $location)
  {
    $this->name     = $name;
    $this->location = $location;
  }
  
  function getName()
  {
    return $this->name;
  }
  
  function getNameHtml()
  {
    return htmlspecialchars($this->name);
  }
  
  function getNameEncoded()
  {
    return rawurlencode($this->name);
  }
}

//
// File class holds the information about one file in the list
//
class File
{
  var $name;
  var $location;
  var $path;
  var $size;
  var $type;
  var $modTime;
  var $fileHash;
  
  //
  // Constructor
  // 
  function File($database, $name, $location)
  {
    $this->name     = $name;
    $this->location = $location;
    
    $this->path = $this->location->getDir(true, false, false, 0) . $this->getName();
    
    $this->type    = File::getFileType($this->path);
    $this->size    = File::getFileSize($this->path);
    $this->modTime = filemtime($this->path);
    
    // Computing the file hash is expensive so check if we
    // have one in the database already.
    $this->fileHash = $database->getFileId($this->path);
    if ($this->fileHash == null) {
      $this->fileHash = documin_file_hash($this->path);
      $database->addFileRecord($this->fileHash, $this->size, $this->path);
    }
  }
  
  function getPath()
  {
    return $this->path;
  }
  
  function getName()
  {
    return $this->name;
  }
  
  function getNameEncoded()
  {
    return rawurlencode($this->name);
  }
  
  function getNameHtml()
  {
    return htmlspecialchars($this->name);
  }
  
  function getSize()
  {
    return $this->size;
  }
  
  function getType()
  {
    return $this->type;
  }
  
  function getModTime()
  {
    return $this->modTime;
  }
  
  function getFileID()
  {
    return $this->fileHash;
  }
  
  //
  // Determine the size of a file
  // 
  public static function getFileSize($file)
  {
    $sizeInBytes = filesize($file);
    
    // If filesize() fails (with larger files), try to get the size from unix command line.
    if (Documin::getConfig("large_files") == true || !$sizeInBytes || $sizeInBytes < 0) {
      $sizeInBytes = exec("ls -l '$file' | awk '{print $5}'");
    }
    return $sizeInBytes;
  }
  
  public static function getFileType($filepath)
  {
    /*
     * This extracts the information from the file contents.
     * Unfortunately it doesn't properly detect the difference between text-based file types.
     * 
     $mime_type = File::getMimeType($filepath);
     $mime_type_chunks = explode("/", $mime_type, 2);
     $type = $mime_type_chunks[1];
     */
    return File::getFileExtension($filepath);
  }
  
  public static function getFileMime($filepath)
  {
    $fhandle          = finfo_open(FILEINFO_MIME);
    $mime_type        = finfo_file($fhandle, $filepath);
    $mime_type_chunks = preg_split('/\s+/', $mime_type);
    $mime_type        = $mime_type_chunks[0];
    $mime_type_chunks = explode(";", $mime_type);
    $mime_type        = $mime_type_chunks[0];
    return $mime_type;
  }
  
  public static function getFileExtension($filepath)
  {
    return strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
  }
  
  function isImage()
  {
    $type = $this->getType();
    if ($type == "png" || $type == "jpg" || $type == "gif" || $type == "jpeg")
      return true;
    return false;
  }
  
  function isPdf()
  {
    if (strtolower($this->getType()) == "pdf")
      return true;
    return false;
  }
  
  public static function isPdfFile($file)
  {
    if (File::getFileType($file) == "pdf")
      return true;
    return false;
  }
}

class Location
{
  var $path;
  
  function __construct()
  {
    $this->init();
  }
  
  //
  // Split a file path into array elements
  // 
  public static function splitPath($dir)
  {
    $dir   = stripslashes($dir);
    $path1 = preg_split("/[\\\\\/]+/", $dir);
    $path2 = array();
    for ($i = 0; $i < count($path1); $i++) {
      if ($path1[$i] == ".." || $path1[$i] == "." || $path1[$i] == "")
        continue;
      $path2[] = $path1[$i];
    }
    return $path2;
  }
  
  //
  // Get the current directory.
  // Options: Include the prefix ("./"); URL-encode the string; HTML-encode the string; return directory n-levels up
  // 
  function getDir($prefix, $encoded, $html, $up)
  {
    $dir = "";
    if ($prefix == true)
      $dir .= "./";
    for ($i = 0; $i < ((count($this->path) >= $up && $up > 0) ? count($this->path) - $up : count($this->path)); $i++) {
      $temp = $this->path[$i];
      if ($encoded)
        $temp = rawurlencode($temp);
      if ($html)
        $temp = htmlspecialchars($temp);
      $dir .= $temp . "/";
    }
    return $dir;
  }
  
  function getPathLink($i, $html)
  {
    if ($html)
      return htmlspecialchars($this->path[$i]);
    else
      return $this->path[$i];
  }
  
  function getFullPath()
  {
    return (strlen(Documin::getConfig('basedir')) > 0 ? Documin::getConfig('basedir') : dirname($_SERVER['SCRIPT_FILENAME'])) . "/" . $this->getDir(true, false, false, 0);
  }
  
  //
  // Set the current directory
  // 
  private function init()
  {
    if (!isset($_GET['dir']) || strlen($_GET['dir']) == 0) {
      $this->path = $this->splitPath(Documin::getConfig('starting_dir'));
    } else {
      $this->path = $this->splitPath($_GET['dir']);
    }
  }
  
  //
  // Check if uploading is allowed into the current directory, based on the configuration
  //
  function uploadAllowed()
  {
    return Documin::getConfig('upload_enable');
  }
  
  function isWritable()
  {
    return is_writable($this->getDir(true, false, false, 0));
  }
}

//
// Redirect ?fileid=value get.
//
class FileRedirector
{
  var $fileid;
  var $database;
  
  public static function handleFileRedirect()
  {
    if (isset($_GET['fileid'])) {
      $fileRedirect = new FileRedirector($_GET['fileid']);
      $fileRedirect->outputFileRedirect();
      return true;
    }
    return false;
  }
  
  function __construct($fileid)
  {
    $this->fileid   = $fileid;
    $this->database = new Database();
  }
  
  function filePathToUrl($relPath)
  {
    $scriptUrl = getScriptUrl();
    
    // If it ends in "/" then we've access the default script (e.g. documin.php),
    // if not then we a accessed a named script (e.g. documin.php) and that 
    // name must be removed to get the base directory path.
    if (1 == preg_match("/\/$/", $scriptUrl)) {
      $path = $scriptUrl . rawurlencode($relPath);
    } else {
      $path = dirname($scriptUrl) . "/" . rawurlencode($relPath);
    }
    
    $path = str_replace("%2F", "/", $path);
    return $path;
  }
  
  public function outputFileRedirect()
  {
    $paths = $this->database->getFilePaths($this->fileid);
    
    if (count($paths) == 0) {
      header("HTTP/1.0 404 Not Found");
      print("No document found for fileid: " . "$this->fileid");
    } else if (count($paths) == 1) {
      header("Location: " . $this->filePathToUrl($paths[0]));
    } else {
      $this->outputFileChoices($paths);
    }
  }
  
  private function getConfig($cfg)
  {
    return Documin::getConfig($cfg);
  }
  
  private function outputFileChoices($paths)
  {
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php
    print $this->getConfig('lang');
?>" lang="<?php
    print $this->getConfig('lang');
?>">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php
    print $this->getConfig('charset');
?>">
<?php
    css();
?>
<!-- <meta charset="<?php
    print $this->getConfig('charset');
?>" /> -->
      <title><?php
    if (Documin::getConfig('main_title') != null)
      print Documin::getConfig('main_title') . ' file choices';
?></title>
</head>
<body class="<?php
    print "standard";
?>">

<?php
    print("<p>Multiple files exist with fileid: $this->fileid.</p>");
    foreach ($paths as $path) {
      print "<a href=\"" . $this->filePathToUrl($path) . "\">" . $path . "</a><br>";
    }
?>
</body>
</html>
<?php
  }
}

//
// The main documein class that implemetns the files browser.
//
$documin = null;
class Documin
{
  var $location;
  var $dirs;
  var $files;
  var $sort_by;
  var $sort_as;
  var $lang;
  var $database;
  var $scriptUrl;
  
  public static function handleBrowseRequest()
  {
    $l  = new Location();
    $d  = new Documin($l);
    $fm = new FileManager();
    $fm->run($l);
    $d->run($l);
    return true;
  }
  
  function __construct($location)
  {
    $this->location = $location;
    $this->init();
  }
  
  //
  // Determine sorting, etc.
  // 
  private function init()
  {
    $this->database  = new Database();
    $this->scriptUrl = getScriptUrl();
    
    $this->sort_by = "";
    $this->sort_as = "";
    if (isset($_GET["sort_by"]) && isset($_GET["sort_as"])) {
      if ($_GET["sort_by"] == "name" || $_GET["sort_by"] == "size" || $_GET["sort_by"] == "mod")
        if ($_GET["sort_as"] == "asc" || $_GET["sort_as"] == "desc") {
          $this->sort_by = $_GET["sort_by"];
          $this->sort_as = $_GET["sort_as"];
        }
    }
    if (strlen($this->sort_by) <= 0 || strlen($this->sort_as) <= 0) {
      $this->sort_by = "name";
      $this->sort_as = "desc";
    }
    
    global $_TRANSLATIONS;
    if (isset($_GET['lang']) && isset($_TRANSLATIONS[$_GET['lang']]))
      $this->lang = $_GET['lang'];
    else
      $this->lang = Documin::getConfig("lang");
  }
  
  function getSubDirs()
  {
    return $this->dirs;
  }
  
  //
  // Read the file list from the directory
  // 
  function processDir()
  {
    //
    // Reading the data of files and directories
    //
    if ($open_dir = @opendir($this->location->getFullPath())) {
      $this->dirs  = array();
      $this->files = array();
      while ($object = readdir($open_dir)) {
        if ($object != "." && $object != "..") {
          if (is_dir($this->location->getDir(true, false, false, 0) . "/" . $object)) {
            if (0 == strlen(Documin::getConfig('hidden_dir_regex')) || 0 == preg_match(Documin::getConfig('hidden_dir_regex'), $object)) {
              $this->dirs[] = new Dir($object, $this->location);
            }
          } else if (0 == preg_match(Documin::getConfig('hidden_file_regex'), $object)) {
            $this->files[] = new File($this->database, $object, $this->location);
          }
        }
      }
      closedir($open_dir);
    } else {
      Documin::setErrorString("unable_to_read_dir");
      ;
    }
  }
  
  function sort()
  {
    if (is_array($this->files)) {
      usort($this->files, "Documin::cmp_" . $this->sort_by);
      if ($this->sort_as == "desc")
        $this->files = array_reverse($this->files);
    }
    
    if (is_array($this->dirs)) {
      usort($this->dirs, "Documin::cmp_name");
      if ($this->sort_by == "name" && $this->sort_as == "desc")
        $this->dirs = array_reverse($this->dirs);
    }
  }
  
  function makeArrow($sort_by)
  {
    if ($this->sort_by == $sort_by && $this->sort_as == "asc") {
      $sort_as = "desc";
      $img     = "arrow_up";
    } else {
      $sort_as = "asc";
      $img     = "arrow_down";
    }
    
    if ($sort_by == "name")
      $text = $this->getString("file_name");
    else if ($sort_by == "size")
      $text = $this->getString("size");
    else if ($sort_by == "mod")
      $text = $this->getString("last_changed");
    
    return "<a href=\"" . $this->makeLink(false, false, $sort_by, $sort_as, null, $this->location->getDir(false, true, false, 0)) . "\">
			$text <img style=\"border:0;\" alt=\"" . $sort_as . "\" src=\"?img=" . $img . "\" /></a>";
  }
  
  function makeLink($switchVersion, $logout, $sort_by, $sort_as, $delete, $dir)
  {
    $link = "?";
    
    if (isset($this->lang) && $this->lang != Documin::getConfig("lang"))
      $link .= "lang=" . $this->lang . "&amp;";
    
    if ($sort_by != null && strlen($sort_by) > 0)
      $link .= "sort_by=" . $sort_by . "&amp;";
    
    if ($sort_as != null && strlen($sort_as) > 0)
      $link .= "sort_as=" . $sort_as . "&amp;";
    
    $link .= "dir=" . $dir;
    if ($delete != null)
      $link .= "&amp;del=" . $delete;
    return $link;
  }
  
  function makeIcon($l)
  {
    $l = strtolower($l);
    return "?img=" . $l;
  }
  
  function formatModTime($time)
  {
    $timeformat = "d.m.y H:i:s";
    if (Documin::getConfig("time_format") != null && strlen(Documin::getConfig("time_format")) > 0)
      $timeformat = Documin::getConfig("time_format");
    return date($timeformat, $time);
  }
  
  static function formatSize($size)
  {
    $sizes = Array(
      'B',
      'KB',
      'MB',
      'GB',
      'TB',
      'PB',
      'EB'
    );
    $y     = $sizes[0];
    for ($i = 1; (($i < count($sizes)) && ($size >= 1024)); $i++) {
      $size = $size / 1024;
      $y    = $sizes[$i];
    }
    return round($size, 1) . " " . $y;
  }
  
  //
  // Comparison functions for sorting.
  //
  
  public static function cmp_name($b, $a)
  {
    return strcasecmp($a->name, $b->name);
  }
  
  public static function cmp_size($a, $b)
  {
    return ($a->size - $b->size);
  }
  
  public static function cmp_mod($b, $a)
  {
    return ($a->modTime - $b->modTime);
  }
  
  //
  // The function for getting a translated string.
  // Falls back to english if the correct language is missing something.
  //
  public static function getLangString($stringName, $lang)
  {
    global $_TRANSLATIONS;
    if (isset($_TRANSLATIONS[$lang]) && is_array($_TRANSLATIONS[$lang]) && isset($_TRANSLATIONS[$lang][$stringName]))
      return $_TRANSLATIONS[$lang][$stringName];
    else if (isset($_TRANSLATIONS["en"]) && is_array($_TRANSLATIONS["en"]) && isset($_TRANSLATIONS["en"][$stringName]))
      return $_TRANSLATIONS["en"][$stringName];
    else
      return "Translation error";
  }
  
  static function getString($stringName)
  {
    return Documin::getLangString($stringName, Documin::getConfig('lang'));
  }
  
  //
  // The function for getting configuration values
  //
  public static function getConfig($name)
  {
    global $_CONFIG;
    if (isset($_CONFIG) && isset($_CONFIG[$name]))
      return $_CONFIG[$name];
    return null;
  }
  
  public static function setError($message)
  {
    global $_ERROR;
    if (isset($_ERROR) && strlen($_ERROR) > 0); // keep the first error and discard the rest
    else
      $_ERROR = $message;
  }
  
  public static function setErrorString($stringName)
  {
    Documin::setError(Documin::getString($stringName));
  }
  
  //
  // Main function, activating tasks
  // 
  private function run()
  {
    $this->processDir();
    $this->sort();
    $this->outputHtml();
  }
  
  function fileIdToUrl($fileid)
  {
    return $this->scriptUrl . "?fileid=" . $fileid;
  }
  
  //
  // Printing the actual page
  // 
  function outputHtml()
  {
    global $_ERROR;
    global $_START_TIME;
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php
    print $this->getConfig('lang');
?>" lang="<?php
    print $this->getConfig('lang');
?>">
<head>
<link rel="shortcut icon" href="?img=file_cabinet"/>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php
    print $this->getConfig('charset');
?>">
<?php
    css();
?>
<!-- <meta charset="<?php
    print $this->getConfig('charset');
?>" /> -->
<title><?php
    if (Documin::getConfig('main_title') != null)
      print Documin::getConfig('main_title') . " - " . getScriptRootDir();
?></title>
</head>
<body class="<?php
    print "standard";
?>">
<?php
    //
    // Print the error (if there is something to print)
    //
    if (isset($_ERROR) && strlen($_ERROR) > 0) {
      print "<div id=\"error\">" . $_ERROR . "</div>";
    }
?>
<div id="frame">
<?php
    if (Documin::getConfig('show_top') == true) {
?>
<div id="top_image"></div>
<div id="top_title">
<a href="<?php print $this->makeLink(false, false, null, null, null, "");?>"><span><?php print Documin::getConfig('main_title');?></span></a>
</div>
<?php
    }
    
    if (Documin::getConfig("show_path") == true) {
?>
<div class="breadcrumbs">
<a href="?dir="><?php
        print getScriptRootDir();
?></a>
<?php
      for ($i = 0; $i < count($this->location->path); $i++) {
        print "&gt; <a href=\"" . $this->makeLink(false, false, null, null, null, $this->location->getDir(false, true, false, count($this->location->path) - $i - 1)) . "\">";
        print $this->location->getPathLink($i, true);
        print "</a>\n";
      }
?>
<div class="adminlink"><a href="?admin">?</a></div>
</div>
<?php
    }
?>

<!-- START: List table -->
<table class="table">
<tr class="row one header">
	<td class="icon"> </td>
	<td class="name"><?php
    print $this->makeArrow("name");
?></td>
	<td class="size"><?php
    print $this->makeArrow("size");
?></td>
	<td class="changed"><?php
    print $this->makeArrow("mod");
?></td>
	<td class="id">ID</td>
</tr>
<tr class="row two">
	<td class="icon"><img alt="dir" src="?img=directory" /></td>
	<td colspan="3" class="long">
		<a class="item" href="<?php
    print $this->makeLink(false, false, null, null, null, $this->location->getDir(false, true, false, 1));
?>">..</a>
	</td>
</tr>
<?php
    //
    // Ready to display folders and files.
    //
    $row = 1;
    
    //
    // Folders first
    //
    if ($this->dirs) {
      foreach ($this->dirs as $dir) {
        $row_style = ($row ? "one" : "two");
        print "<tr class=\"row " . $row_style . "\">\n";
        print "<td class=\"icon\"><img alt=\"dir\" src=\"?img=directory\" /></td>\n";
        print "<td class=\"name\" colspan=\"3\">\n";
        print "<a href=\"" . $this->makeLink(false, false, null, null, null, $this->location->getDir(false, true, false, 0) . $dir->getNameEncoded()) . "\" class=\"item dir\">";
        print $dir->getNameHtml();
        print "</a>\n";
        print "</td>\n";
        print "<td></td>\n";
        print "</tr>\n";
        $row = !$row;
      }
    }
    
    //
    // Now the files
    //
    if ($this->files) {
      $count = 0;
      foreach ($this->files as $file) {
        $row_style = ($row ? "one" : "two");
        print "<tr class=\"row " . $row_style . (++$count == count($this->files) ? " last" : "") . "\">\n";
        print "<td class=\"icon\"><img alt=\"" . $file->getType() . "\" src=\"" . $this->makeIcon($file->getType()) . "\" /></td>\n";
        print "<td class=\"name\">\n";

        print "\t\t<a href=\"" . $this->location->getDir(false, true, false, 0) . $file->getNameEncoded() . "\"";
        if (Documin::getConfig('open_in_new_window') == true) {
          print " target=\"_blank\"";
        }
        print " class=\"item file";
        print "\">";

        print $file->getNameHtml();
        print "</a>\n";
        print "</td>\n";
        print "<td class=\"size\">" . $this->formatSize($file->getSize()) . "</td>\n";
        print "<td class=\"changed\">" . $this->formatModTime($file->getModTime()) . "</td>\n";

        print "<td class=\"fileid\"><a href=\"" . $this->fileIdToUrl($file->getFileID()) . "\"";
        if (Documin::getConfig('open_in_new_window') == true) {
          print " target=\"_blank\"";
        }
        print ">" . $file->getFileID() . "</a></td>\n";

        print "</tr>\n";
        $row = !$row;
      }
    }
    
    
    //
    // The files and folders have been displayed
    //
?>

</table>
<!-- END: List table -->
</div>

<!-- START: Upload area -->
<form enctype="multipart/form-data" method="post">
	<div id="upload">
		<div id="newdir_container">
			<input name="userdir" type="text" class="upload_dirname" />
			<input type="submit" value="<?php
    print $this->getString("make_directory");?>" />
		</div>
		<div id="upload_container">
			<input name="userfile" type="file" class="upload_file" />
			<input type="submit" value="<?php
    print $this->getString("upload");?>" class="upload_sumbit" />
		</div>
		<div class="bar"></div>
	</div>
</form>
<!-- END: Upload area -->

<!-- START: Info area -->
<div id="info">
<?php
    if ($this->getConfig("show_info") == true) {
      printf($this->getString("file_sum_size"), Documin::formatSize($this->database->getSumSize()));
      print(" | ");
      printf($this->getString("file_index_count"), $this->database->getFileCount() );
      print(" | ");
      printf($this->getString("page_load_time"), (microtime(TRUE) - $_START_TIME) * 1000);
    }
?> 
</div>
<!-- END: Info area -->
</body>
</html>
	
<?php
  }
}

class FileIndexer
{
  public static function handleFileIndexRequest()
  {
    if (isset($_GET['do_recursive_index'])) {
      $fileIndexer = new FileIndexer(false);
      $fileIndexer->doRecursiveIndex();
      return true;
    } else if (isset($_GET['do_recursive_sub_index'])) {
      $fileIndexer = new FileIndexer(true);
      $fileIndexer->doRecursiveIndex();
      return true;
    }
    return false;
  }
  
  var $isSubIndex;
  
  function __construct($isSubIndex)
  {
    $this->isSubIndex = $isSubIndex;
  }
  
  private function doRecursiveIndex()
  {
    $location = new Location();
    $documin  = new Documin($location);
    $documin->processDir();
    $subDirs = $documin->getSubDirs();
    
    $mh = curl_multi_init();
    
    $contexts = array();
    foreach ($subDirs as $dir) {
      $link = $documin->makeLink(false, false, null, null, null, $location->getDir(false, true, false, 0) . $dir->getNameEncoded());
      $subDirAccessLink = getScriptUrl() . $link . "&do_recursive_sub_index";
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $subDirAccessLink);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_multi_add_handle($mh, $ch);
      
      $contexts[$link] = $ch;
    }
    
    $running = null;
    do {
      $mrc = curl_multi_exec($mh, $running);
    } while ($running > 0);
    
    $result = $this->isSubIndex ? "" : "indexed directories:<br>";
    
    foreach ($contexts as $link => $ch) {
      $result .= curl_multi_getcontent($ch);
    }
    
    foreach ($contexts as $link => $ch) {
      curl_multi_remove_handle($mh, $ch);
    }
    curl_multi_close($mh);
    
    $result = $result . $location->getDir(true, false, true, 0) . "<br>";
    
    print $result;
  }
}

//
// Handle a admin request
//
class AdminRequest
{
  public static function handleAdminRequest()
  {
    if (isset($_GET['admin'])) {

?> <h2><a href="https://github.com/jptrainor/documin">documin -
minimal document management system</a></h2> Copyright &copy; 2014 Jim
Trainor</p> <p>This program is free software: you can redistribute it
and/or modify it under the terms of the GNU General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.</p> <p>This program is
distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License
for more details.  You should have received a copy of the GNU General
Public License along with this program.  If not, see <a
href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a></p>
<p>Documin was derived from <a
href="http://encode-explorer.siineiolekala.net">Encode Explorer</a>.
All images except the file cabinet were designed by <a
href="http://www.famfamfam.com">Mark James</a> and distributed under
the Creative Commons Attribution 3.0 License.</p> The <a
href="http://commons.wikimedia.org/wiki/File:Golden_file_cabinet.png">file
cabinet image</a> is distributed under the GNU Free Documentation
License, Version 1.2.
<p>Version 0.9.0 (2 June 2014)</p>
<hr>
Admin commands:
<ul>
<li><a href="?do_remove_database">Delete the documin database.</a>
 (Don&#39t worry, it is recreated automatically!)</li>
<li><a href="?do_recursive_index">Re-index all files.</a>
 (This takes a while!)</li>
</ul>
<?php
 
     return true;
    }
    return false;
  }
}

//
// PHP Entry Point
// Only the first to handle a request one is executed.
//

if      ( ImageServer::handleImageRequest()     ) {}
else if ( AdminRequest::handleAdminRequest()    ) {}
else if ( FileRedirector::handleFileRedirect()  ) {}
else if ( Database::handleRemoveRequest()       ) {}
else if ( FileIndexer::handleFileIndexRequest() ) {}
else if ( Documin::handleBrowseRequest()        ) {}

?>
