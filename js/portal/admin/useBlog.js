function _getActiveBlogPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='get_blog_details'
    } = props;
	_getBlogPagesActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: adminPortalLocalUrl});
	}
}
function _getBlogPagesActiveLink(divid){
	$('#page_content, #picture_page').removeClass('active-li');
	$("#"+divid).addClass('active-li');
}
