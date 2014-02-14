function render_module(name, args, firstrun) {
  $('#' + name).load('modules/' + name + '/' + name + '.module.php?' + args , function() {
    if (firstrun==1)
        module_init (name);
    });
}

function activate_module(name, seconds, args) {
  render_module(name, args, 1);
  if (seconds > 0) {
    setInterval("render_module('"+name+"', '"+args+"', '0')", (seconds * 1000));
  }
}

$(document).ready(function() {
  $('.middle').each(function(id, val) {
    var outer_height = $(val).height();
    var inner_height = $(val).children().first().height();
    var buffer = (outer_height - inner_height) / 2;
    var SEL = '#' + $(val).attr('id') + '>div';
    $(SEL).css('marginTop', buffer);
    $(SEL).css('marginBottom', buffer);
  });
});

// Could use for possible stock ticker
// just defaulting for now
function module_init (name) {
    switch (name) {
        default:
	break;
    }
}

