<script src="js/jquery.jdigiclock.js"></script>
<script>
$(document).ready(function(){
    $('#jdigiclock').jdigiclock(
	{
                clockImagesPath: '/status/images/clock/',
                weatherImagesPath: '/status/images/weather/',
                lang: 'en',
                am_pm: true,
                weatherLocationCode: '43545',
                weatherMetric: 'F',
                weatherUpdate: 10,
                proxyType: 'php'

        }
    );
});

</script>

