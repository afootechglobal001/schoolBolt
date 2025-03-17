function _getActiveProductViewPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='getProductView'
    } = props;
	_getProductViewPagesActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer, url: adminPortalLocalUrl});
	}
}
function _getProductViewPagesActiveLink(divid){
	$('#gridView, #listView').removeClass('active-li');
	$("#"+divid).addClass('active-li');
}