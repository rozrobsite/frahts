var formOrganization = {
	init: function(){
		$('#Organizations_type_org_id').on('change', function(e){
			var type_org_id = $('#Organizations_type_org_id').val();
        
			if(type_org_id == 1){
				$('#edrpou').hide();
				$('#private_label').show();
				$('#private_certificate_label').show();
				$('#corporate_label').hide();
				$('#corporate_certificate_label').hide();
			} else {
				$('#edrpou').show();
				$('#corporate_label').show();
				$('#corporate_certificate_label').show();
				$('#private_label').hide();
				$('#private_certificate_label').hide();
			}
		});
	}
};

$(document).ready(function(){
	formOrganization.init();
	$('#Organizations_type_org_id').change();
});