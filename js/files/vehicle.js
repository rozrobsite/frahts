var make = {
    change: function(make_id){
        $('select.make').live('change', function(e){
            e.stopPropagation();
            e.preventDefault();
          
            var make_id = $(this).val();
            var url = $(this).attr('link');
            
            model.change(url, make_id);
        });
    }  
};

var model = {
    update: function(){
        make.change($('select.make').val());
        
        this.change($('select.make').attr('link'), $('select.make').val());
    },
    change: function(url, make_id){
        $.post(url, {
            make_id: make_id
        }, function(response){
            if(response == null) return;

            $('select.model').html($(response).find('select.model').html());
                
            updateSelect.update($('select.model'));
        });
    }
};

$(document).ready(function(){
    if($('select.make').length) {
        model.update();
    }
});