var statBoard = function () {
	return {
		iconizeWorkers : function (selector) {
			$(selector).each(function (i, el) {
				var el = $(el), 
					workers = el.text().split(' '),
					path = '';
				
				$.each(workers, function (i, val) {
					path += '<img src="images/' + val.toLowerCase() + '.png" alt="'+ val + '" />';
				});
				
				el.html(path);
			});
		},
        
        getTickets : function () {
            setInterval(tickets, 3000);

            function tickets(){
                    $.getJSON('/status/proxy/php/ticketNum.php', function(data) {
                        $("div#tickets p").html(data.tickets);
            	    });
            }
        },
        
        getSiteStats : function (selector){
            var el = $(selector),
                data = [],
            prev = null, i,
            showTooltip = function(x, y, contents){
                $("<div />", {
                id: 'tooltip',
                text: contents,
                css: {
                   top: y+5,
                   left: x+5
                }
                }).appendTo('body').fadeIn(200);
            };
                           
            el.height( $('#schedule').outerHeight());
	 

            	$.ajax({
            	    url: '/status/proxy/php/sitestats.php',
            	    dataType: 'json',
            	    success:  function(pata) {
            	    $.each(pata, function(i, it){
            	        data.push([i, it]);
            	    $.plot(el, [{ label: "Last 10 Days", data: data, color:'#000046', lines : { show: true }, points : { show : true} }],
           	         { xaxis : { mode : 'time', timeformat : '%b %d' }, grid : { hoverable : true, clickable : true, backgroundColor: { colors: ["#fff", "#eee"]} } });
            	    });
           	    },
		    timeout: 3000                
            	});
	    
	   
	
	  

            el.bind('plothover', function (event, pos, item) {
                if (item) {
                    if (prev != item.datapoint) {
                        prev = item.datapoint;
                        $('#tooltip').remove();
                        showTooltip(item.pageX, item.pageY, item.datapoint[1]);
                    }
                }
                else {
                    $('#tooltip').remove();
                    prev = null;
                }
            });
        }
    }
};
