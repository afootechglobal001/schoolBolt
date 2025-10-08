function _printStudentByClass(departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-student-by-class?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printStudentByClassSession", JSON.stringify(info));
					windowPop(`${websiteUrl}/reports/print-student-by-class`);
					_alertClose(2);
				} else {
					_actionAlert(info.message, false);
					_alertClose(2);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _printAllocatedStudents(departmentId, classId, armId) {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-student-by-class?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printStudentByClassSession", JSON.stringify(info));
					windowPop(`${websiteUrl}/reports/print-student-by-class`);
					_alertClose(2);
				} else {
					_actionAlert(info.message, false);
					_alertClose(2);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function windowPop(url) {
	newwindow=window.open(url,'name','height=500,width=950, directories=no, titlebar=no, toolbar=no, manubar=no, left='+((screen.width/2)-(950/2))+', top='+((screen.height/2)-(500/2))+', directories=no, location=no');
	if (window.focus) {newwindow.focus()}
	return false;
}

function _exportStudents(session, departmentName, className, armName) {
    let fileName = `${session} ${departmentName} ${className} ${armName} Students`;
    exportTableToExcel("pageContent", fileName);
}

function exportTableToExcel(tableID, filename) {
    var dataType = 'application/vnd.ms-excel';
    var $table = $('#' + tableID);
    var removedImages = [];

    // Temporarily remove all images from the table
    $table.find('img').each(function () {
        var $img = $(this);
        removedImages.push({
            parent: $img.parent(),
            nextSibling: $img.next(),
            element: $img
        });
        $img.remove();
    });

    // Convert table to HTML
    var tableHTML = $table.prop('outerHTML').replace(/ /g, '%20').replace(/#/g, '%23');

    // Specify file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link
    var $downloadLink = $('<a></a>');
    $('body').append($downloadLink);

    if (window.navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
        window.navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        $downloadLink.attr('href', 'data:' + dataType + ', ' + tableHTML);
        $downloadLink.attr('download', filename);
        $downloadLink[0].click();
    }

    // Restore the removed images
    $.each(removedImages, function (i, item) {
        if (item.nextSibling.length) {
            item.element.insertBefore(item.nextSibling);
        } else {
            item.parent.append(item.element);
        }
    });

    // Clean up
    $downloadLink.remove();
}
