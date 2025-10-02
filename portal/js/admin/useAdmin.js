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
	$('#mobile-'+divid).addClass('active-li');
	$("#page-title").html($("#_" + divid).html());
	_getNav(nav);
}
function _removeClass(){
	$('#side-dashboard, #side-staff, #side-fees, #side-customers, #side-products, #side-orders, #side-publish, #side-reports, #side-branches, #top-dashboard, #top-staff').removeClass('active-li');
	$('#mobile-dashboard,#mobile-branches,#mobile-staff,#mobile-reports').removeClass('active-li');
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
	var x = document.getElementById("menu-div");
	x.innerHTML = '<i class="bi-text-right"></i>';
    $('#side-nav-div').animate({'left':'-100px'},200);
}
function _closeAllNav(){
	_closeNav();
	_removeClass();
}

function _openMenu(){
	var x = document.getElementById("menu-div");
	if (x.innerHTML === '<i class="bi-text-right"></i>') {
	x.innerHTML = '<i class="bi-x-lg"></i>';
		$('#side-nav-div').animate({'left':'0px'},200);
	} else {
	x.innerHTML = '<i class="bi-text-right"></i>';
	_closeAllNav()
	}
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
		'clientId': clientId,
		'clientAddress': clientAddress,
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

function _toggleCheck(){
	$('.switch input').on('change', function () {
		const label = $(this).next().next(); // Grab the toggle-label span
		label.text($(this).prop('checked') ? 'Yes' : 'No');
	});
}

function _collapse(divId) {
	var x = document.getElementById(divId + 'num');
	if (x.innerHTML === '&nbsp;<i class="bi-chevron-down"></i>&nbsp;') {
	  x.innerHTML = '&nbsp;<i class="bi-chevron-up"></i>&nbsp;';
	} else {
	  x.innerHTML = '&nbsp;<i class="bi-chevron-down"></i>&nbsp;';
	}
	  $('#'+divId+'answer').slideToggle('slow');
  }
  

function _getFormDetails(nextId) {
	$('#user_form_details').hide();
	$("#" + nextId).fadeIn(500);
	$('#user_details, #edit_btn').fadeOut(500);
}

function _getComputeForm(nextId) {
	$('#computeScoreParent').hide();
	$("#" + nextId).show();
	$('#assessmentParent').hide();
}

//////////////////////////// upload image from webcam//////////////////////////
Webcam.set({
    width: 270,
    height: 200,
    image_format: 'jpeg',
    jpeg_quality: 1000
});

function takeSnapShot(action='normal'){
$('.webcam-div').fadeIn(500);
Webcam.attach( '#my_camera' );
sessionStorage.setItem("takeSnapShotAction", JSON.stringify(action));
}
function snapPicture() {
    Webcam.snap( function(data_uri) {
        $('#passport').val(data_uri);
        document.getElementById('cam-pix').innerHTML = '<img id="passport" src="'+data_uri+'"/>';
    $('.webcam-div').fadeOut(500);
    } );
     Webcam.reset();
	 let takeSnapShotAction = JSON.parse(sessionStorage.getItem("takeSnapShotAction"));
	 if(takeSnapShotAction=='updateStaffPix'){
		_updateStaffPix();
	 }
	 if(takeSnapShotAction=='updateStudentPix'){
		_updateStudentPix();
	 }
}
//////////////////////////// end upload image from webcam//////////////////////////

function _confirmLogOut() {
  _showCustomConfirm({
    callback: () => {
      _logOut();
    },
    title: "Confirm Logout Action!",
    message:
      "Are you sure you want to log out? You may miss important notifications or updates until you sign in again.",
    alertType: "warning",
    falseActionBtn: true,
  });
}


///// Dashbaord Statistics ////////
function _fetchDashboardStatistics() {
  $.ajax({
    type: "GET",
    url: `${endPoint}/admin/dashboard/fetch-dashboard-statistics`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.data.length > 0) {
        const data = info.data[0];

        $('#totalActiveBranchCount').html(data.total_active_branch_count);
        $('#totalActiveStaffCount').html(data.total_active_staff_count);
        $('#totalActiveStudentCount').html(data.total_active_student_count);
        $('#totalAlumniStudentCount').html(data.total_alumni_student_count);
        $('#totalActiveDepartmentCount').html(data.total_active_department_count);
        $('#totalActiveClassCount').html(data.total_active_class_count);
        $('#totalActiveSubjectCount').html(data.total_active_subject_count);

        if (info.staffMatrix && info.staffMatrix.length > 0) {
          	let dataPoints = [];

			for (let i = 0; i < info.staffMatrix.length; i++) {
				const fetchedData = info.staffMatrix[i];
				const roleName = fetchedData.roleName
				const role_count =  parseInt(fetchedData.role_count);

				dataPoints.push({
				label: roleName,
				y: role_count
				});
			}

			const options = {
				data: [{
					type: "pie",
					startAngle: 45,
					showInLegend: "False",
					legendText: "{label}",
					indexLabel: "{label} ({y})",
					yValueFormatString: "#,##0.#" % "",
					indexLabelFontSize: 9,
					dataPoints: dataPoints
				}]
			};

          	$("#chartContainer1").CanvasJSChart(options);
        }
      } else {
        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      }
    }
  });
}
