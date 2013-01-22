var block = {
  start: function(object){
      $(object).block({
          message: '<img src="images/elements/loaders/7.gif" />',
          css: {border: 'none', backgroundColor: 'transparent', cursor: 'default'},
          overlayCSS: {backgroundColor: '#E8E8E8', cursor: 'default'}
      });
  },
  stop: function(object){
      $(object).unblock();
  }
};

var updateSelect = {
    update: function(element){
        $.uniform.update(element);
//        $(element).trigger('liszt:updated');
    }
};