function _getActivePage(props) {
	const {
        page = '',
        divid = '',
		nav= ''
    } = props;
	_getActiveLink(divid, nav);
	if(page){
		_getPage({page: page, url: adminPortalLocalUrl});
	}
}
	

function _getActiveLink(divid, nav) {
	_removeClass()
	$('#side-'+divid).addClass('active-li');
	$('#top-'+divid).addClass('active-li');
	$("#page-title").html($("#_" + divid).html());
	_getNav(nav);
}
function _removeClass(){
	$('#side-dashboard, #side-staff, #side-customers, #side-products, #side-orders, #side-publish, #side-reports, #side-branches, #top-dashboard, #top-staff').removeClass('active-li');
}
function _getNav(nav){
	if(nav==''){
		_closeNav();
	}else{
	   	$('#link-products, #link-orders, #link-publish, #link-publish, #link-reports').css({'display':'none'});
		$('#link-'+nav).css({'display':'block'});
	   	$('.side-nav-bg-sub-div').animate({'left':'100px'},200);
	}
}
function _closeNav(){
	$('.side-nav-bg-sub-div').animate({'left':'-100%'},400);
    $('#side-nav-div').animate({'left':'-100px'},200);
}
function _closeAllNav(){
	_closeNav();
	_removeClass();
}


function capitalizeFirstLetterOfEachWord(inputText) {
	const words = inputText.toLowerCase().split(' ');
	for (let i = 0; i < words.length; i++) {
		words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
	}
	const result = words.join(' ');
	return result;
}
function _toggleProfileDiv() {
    $(".toggle-profile-div").toggle("slow");
}

function _closeProfileDiv(event) {
    if (!$(event.target).closest(".toggle-profile-div, .right-icon-div").length) {
        $(".toggle-profile-div").hide("slow");
    }
}
$(document).on("click", _closeProfileDiv);

function _logOut(){
	sessionStorage.clear();
	window.parent.location.href = adminUrl;
}

function getAuthHeaders(includeAuth = false) {
    return {
        'apiKey': apiKey,
        'userOsBrowser': userOsBrowser,
        'userIpAddress': userIpAddress,
        'userDeviceId': userDeviceId,
        'Authorization': includeAuth ? ('Bearer ' + (loginAccessKey ?? '')) : undefined
    };
}


function select_search() {
	$(".srch-select").toggle("fast");
}
function srch_custom(text){
	$('#srch-text').html(text);
	$('.custom-srch-div').fadeIn(500);
};

function _nextPage(next_id, icon, divid) {
	$("#account_settings_id,#account_detail").hide();
	$("#" + next_id).fadeIn(1000);
	$("#panel-title").html($("#" + icon).html() + $("#" + divid).html());
}
  
function _prevPage(next_id) {
	$("#account_settings_id,#account_detail").hide();
	$("#" + next_id).fadeIn(1000);
	$("#panel-title").html(
	  '<i class="bi-gear"></i> </span id="app_text"> APP SETTINGS'
	);
}
function filters(selectBoxId) {
	var valThis = $('#search'+selectBoxId).val();
		$('#page'+selectBoxId+' > tbody .tb-row, .grid-div, .faq-back-div, .role-list-div').each(function() {
		var text = $(this).text();
		(text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show(): $(this).hide();
	});
};




let permissionElements = {
    7: `
    <div class="nav-div" title="Branches" onclick="_getActivePage({page:'branches', divid:'branches'});" id="side-branches">
        <div class="icon"><i class="bi-diagram-3"></i> Branches</div> 
        <div class="hidden" id="_branches"><i class="bi-diagram-3"></i> Branches</div>
    </div
    `,

    10: `
    <div class="nav-div" title="Staff" onclick="_getActivePage({page:'staff', divid:'staff'});" id="side-staff">
        <div class="icon"><i class="bi-people"></i> Staff</div> 
        <div class="hidden" id="_staff"><i class="bi-people"></i> Active Staff</div>
    </div>
    `,

    13: `
    <div class="nav-div" title="Customers" onclick="_getActivePage({page:'customers', divid:'customers'});" id="side-customers">
        <div class="icon"><i class="bi-people"></i> Customers</div> 
    </div>
    `,

    15: `
    <div class="nav-div" title="Products" onclick="_getActivePage({nav:'products', divid:'products'});" id="side-products">
        <div class="icon"><i class="bi-boxes"></i> Products</div> 
    </div>
    `,

    34: `
    <div class="nav-div" title="Publish" onclick="_getActivePage({nav:'publish', divid:'publish'});" id="side-publish">
        <div class="icon"><i class="bi-cloud-upload"></i> Publish</div> 
    </div>
    `,

    41: `
    <div class="nav-div" title="Report" onclick="_getActivePage({nav:'reports', divid:'reports'});" id="side-reports">
        <div class="icon"><i class="bi-graph-up-arrow"></i> Report</div> 
    </div>
    `
};



function _getSelectTermId(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint +'/preset-data/fetch-term',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].termId;
						const value = data[i].termName;
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
					}	
				} else {
					_actionAlert(info.message, false); 
				}
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
	}
}