function _getActiveCustomerPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='get_customer_details'
    } = props;
	_getCustomerPagesActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: adminPortalLocalUrl});
	}
}
function _getCustomerPagesActiveLink(divid){
	$('#customer_dashboard, #customer_profile_details, #order_history, #wallet_history, #customer_activities').removeClass('active');
	$("#"+divid).addClass('active');
}