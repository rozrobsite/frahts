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
	$('#Profiles_last_name').mask('aa?aaaaaaaaaaaaaaaaaa');
	$('#Profiles_middle_name').mask('aa?aaaaaaaaaaaaaaaaaa');
	$('#Profiles_first_name').mask('aa?aaaaaaaaaa');
	$('#Profiles_mobile').mask('99999999?9999999');
	$('#Profiles_phone').mask('?999999999999999');
	$('#Profiles_icq').mask('?99999999999');
	$('#Organizations_form_tax').mask('*?*********');
	$('#Organizations_account_number').mask('999?99999999999999999');
	$('#Organizations_mfo').mask('?99999999');
	$('#Organizations_inn').mask('9999999999?99');
	$('#Organizations_certificate').mask('999999?99');
	$('#Organizations_edrpou').mask('99999999?9');
	formOrganization.init();
	$('#Organizations_type_org_id').change();
});