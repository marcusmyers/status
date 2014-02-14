<script>
$(document).ready(function(){
    $('#jdigiclock').jdigiclock(
	{
                clockImagesPath: '/images/clock/',
                weatherImagesPath: '/images/weather/',
                lang: 'en',
                am_pm: true,
                weatherLocationCode: '43545',
                weatherMetric: 'F',
                weatherUpdate: 10

        }
    );
});

</script>

