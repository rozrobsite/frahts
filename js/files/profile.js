var formOrganization = {
	init: function(){
		$('#Organizations_type_org_id').on('change', function(e){
			var type_org_id = $('#Organizations_type_org_id').val();
        
			if(type_org_id == 1){
				$('#Organizations_name_org').val($('#privateName').val());
			} else {
				$('#Organizations_name_org').val('');
			}
		});
	}
};

$(document).ready(function(){
//	formOrganization.init();
//	$('#Organizations_type_org_id').change();
});