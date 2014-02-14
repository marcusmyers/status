<script>
$(document).ready(function(){
    $('#jdigiclock').jdigiclock(
	{
                clockImagesPath: '/status/modules/jdigiclock/images/clock/',
                weatherImagesPath: '/status/modules/jdigiclock/images/weather/',
                lang: 'en',
                am_pm: true,
                weatherLocationCode: '43545',
                weatherMetric: 'F',
                weatherUpdate: 10

        }
    );
});

</script>

