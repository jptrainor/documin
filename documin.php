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
 * http://commons.wikimedia.org/wiki/File:Replacement_filing_cabinet.svg
 * and is in the public domain.
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

// Charset. Use the one that is suitable for you. 
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

$_IMAGES_CONTENT_TYPE = array();
$_IMAGES_CONTENT_TYPE_DEFAULT = "gif";

// thanks, http://commons.wikimedia.org/wiki/File:Golden_file_cabinet.png
$_IMAGES_CONTENT_TYPE["file_cabinet"] = "png"; 
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

/***************************************************************************
 *   PHP code
 ***************************************************************************/

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
          
          $contentType = $_IMAGES_CONTENT_TYPE_DEFAULT;
          if (isset($_IMAGES[$_GET['img']]) && isset($_IMAGES_CONTENT_TYPE[$_GET['img']])) {
             $contentType = $_IMAGES_CONTENT_TYPE[$_GET['img']];
          }

          header('ETag: "' . $etag . '"');
          header('Last-Modified: ' . $mtime);
          header('Content-type: image/' . $contentType);
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
the Creative Commons Attribution 3.0 License. The <a
href="http://commons.wikimedia.org/wiki/File:Replacement_filing_cabinet.svg">file
cabinet image</a> is in the public domain.</p>

<p>Version 0.9.1 (3 June 2014)</p>
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
