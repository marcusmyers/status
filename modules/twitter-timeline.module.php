<style>
/* ===== twitter ===== */
#twitter {
	background-color: #ededed;
	font-size: 20pt;
}


#twitter ul {
	list-style-type:none;
	width:5000px;
	position:relative;
}
#twitter li {
	float:left;
	margin-right:10px;
}
#twitter img {
	vertical-align:center;
	margin-right:10px;
	border:0;
	height:20px;
	width:20px;
}
</style>
<script type="text/javascript" src="js/twitterlib.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   var twitterize = 
twitterize('#our_tweets','timeline',<?php echo $_GET['username']; ?>);
</script>

<div id="twitter">
    <div id="our_tweets"></div>
</div>
