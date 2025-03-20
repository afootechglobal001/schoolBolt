function textField(options) {
    const {
        id = '',
        title = '',
        type = 'text',
        value = '',
        onKeyPressFunction = null,
		onKeyUpFunction = null,
		readonly = false
    } = options;

    const template = type === "textarea"
        ? `
          <textarea class="text_area" id="${id}" placeholder="" rows="">${value}</textarea>
          <div class="placeholder">${title}:</div>
        `
        : `
          <input class="text_field" type="${type}" id="${id}" placeholder="" value="${value}"
              ${onKeyPressFunction ? `onkeypress="${onKeyPressFunction}"` : ''} 
			  ${onKeyUpFunction ? `onkeyup="${onKeyUpFunction}"` : ''}
			  ${readonly ? 'readonly' : ''}/>
          <div class="placeholder">${title}:</div>
        `;
    $('#' + id + '_container').html(template);
}


function selectField(options) {
    const {
        id = '',
        title = '',
        emptyValue = '',
		fieldValue = '',
		fieldLabel = ''
    } = options;
    
    const template = `
    <select class="text_field selectSearch" id="${id}"
        onclick="_selectOption('${id}')" style="opacity: 1;">
		${fieldValue ? `<option selected="selected" value="${fieldValue}">${fieldLabel}</option>` : '<option selected="selected" value="">Select here</option>'}
    </select>
    <div class="placeholder">${title}:</div>
    <div class="searchPanel addSearchPanel animated fadeIn" id="searchPanel_${id}"
        style="display: none;">
        <input class="searchTxt" placeholder="Type here to search"
            id="txtSearchValue_${id}" autocomplete="off"
            onkeyup="filter('${id}')">
        <ul id="searchList_${id}" data-aos="fade-up" data-aos-duration="200">
            ${emptyValue ? `<li onclick="_clickOption('searchList_${id}', '', '${emptyValue}');">${emptyValue}</li>` : ''}
        </ul>
    </div>
    `;
    $('#' + id + '_container').html(template);
}


function _selectOption(selectBoxId) {
	$('#txtSearchValue_'+selectBoxId).val('');
	filter(selectBoxId);

    if ($('#searchPanel_'+selectBoxId).is(":visible")) {
        $('#searchPanel_'+selectBoxId).css('display', 'none');
    } else {
        $('#searchPanel_'+selectBoxId).css('display', 'flex');
        $('#txtSearchValue_'+selectBoxId).focus();
    }
}

document.addEventListener('click', (e) => {
    document.querySelectorAll('.text_field_container').forEach(container => {
        // If the click is not inside the container, hide its search panel.
        if (!container.contains(e.target)) {
            const searchPanel = container.querySelector('.searchPanel');
            if (searchPanel) {
                searchPanel.style.display = 'none';
            }
        }
    });
});

function filter(selectBoxId) {
	var valThis = $('#txtSearchValue_'+selectBoxId).val();
	$('#searchList_'+selectBoxId+' > li').each(function() {
		var text = $(this).text();
		(text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show(): $(this).hide();
	});
};
function _clickOption(selectedOption, id, value) {
	selectBoxId = selectedOption.replace("searchList_", "");
	// Clear previous options and set the selected one
	$('#'+selectBoxId).html(`<option selected="selected" value="${id}">${value}</option>`);
	_selectOption(selectBoxId);
};
















    
function _getSelectPaymentMethod(fieldId){
	const data=[
		{
			'paymentMethodId': 1,
			'paymentMethodName': 'DEBIT/CREDIT CARD',
		},
		{
			'paymentMethodId': 2,
			'paymentMethodName': 'PAY WITH WALLET',
		},
		{
			'paymentMethodId': 3,
			'paymentMethodName': 'BANK TRANSFER',
		}
	]

	for (let i = 0; i < data.length; i++) {
		const id = data[i].paymentMethodId;
		const value = data[i].paymentMethodName;
		$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
	}	
}

function _getSelectDeliveryLocation(fieldId){
	const data=[
		{
			'deliveryLocationId': 1,
			'deliveryLocationName': 'GATEWAY POLYTECHNIC, SAAPADE',
		},
		{
			'deliveryLocationId': 2,
			'deliveryLocationName': 'OLABISI ONABANJO UNIVERSITY',
		}
	]

	for (let i = 0; i < data.length; i++) {
		const id = data[i].deliveryLocationId;
		const value = data[i].deliveryLocationName;
		$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
	}		
}

function _getSelectDeliveryArea(fieldId){
	const data=[
		{
			'deliveryAreaId': 1,
			'deliveryAreaName': 'AGBERO ODE',
		},
		{
			'deliveryAreaId': 2,
			'deliveryAreaName': 'SABO ISHARA',
		},
		{
			'deliveryAreaId': 3,
			'deliveryAreaName': 'GARAGE IPARA',
		}
	]

	for (let i = 0; i < data.length; i++) {
		const id = data[i].deliveryAreaId;
		const value = data[i].deliveryAreaName;
		$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
	}	
}

///// Admin SelectFields ///////////

function _getSelectStatusId(fieldId, statusIds){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/preset-data/fetch-status?statusId="+statusIds,
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey,
				'userOsBrowser': userOsBrowser,
				'userIpAddress': userIpAddress,
				'userDeviceId': userDeviceId,
				'clientId': clientId,
				'clientAddress': clientAddress,
				'Authorization': 'Bearer ' + loginAccessKey
			},
			success: function(info) {
				const data = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].statusId;
						const value = data[i].statusName;
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

function _getSelectGender(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/preset-data/fetch-gender",
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].genderId;
						const value = data[i].genderName;
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

function _getSelectMaritalStatus(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/preset-data/fetch-marital-status",
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].maritalStatusId;
						const value = data[i].maritalStatusName;
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

function _getSelectTitle(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/preset-data/fetch-title',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].titleId;
						const value = data[i].titleName;
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

function _getSelectBirthDay(fieldId) {
	for (let i = 1; i <= 31; i++) {
		const id = i;
		const value = i;
		$('#searchList_' + fieldId).append(
			'<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">' + value + '</li>'
		);
	}
}

function _getSelectBirthMonth(fieldId){
	const data = [
		{
			'birthMonthId': 1,
			'birthMonthName': 'Jan',
		},
		{
			'birthMonthId': 2,
			'birthMonthName': 'Feb',
		},
		{
			'birthMonthId': 3,
			'birthMonthName': 'Mar',
		},
		{
			'birthMonthId': 4,
			'birthMonthName': 'Apr',
		},
		{
			'birthMonthId': 5,
			'birthMonthName': 'May',
		},
		{
			'birthMonthId': 6,
			'birthMonthName': 'Jun',
		},
		{
			'birthMonthId': 7,
			'birthMonthName': 'Jul',
		},
		{
			'birthMonthId': 8,
			'birthMonthName': 'Aug',
		},
		{
			'birthMonthId': 9,
			'birthMonthName': 'Sep',
		},
		{
			'birthMonthId': 10,
			'birthMonthName': 'Oct',
		},
		{
			'birthMonthId': 11,
			'birthMonthName': 'Nov',
		},
		{
			'birthMonthId': 12,
			'birthMonthName': 'Dec',
		}
	];

	for (let i = 0; i < data.length; i++) {
		const id = data[i].birthMonthId;
		const value = data[i].birthMonthName;
		$('#searchList_' + fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">' + value + '</li>');
	}	
}

function _getSelectBlogCategory(fieldId){
	const data=[
		{
			'blogCatId': 1,
			'blogCatName': 'GENERAL',
		},
		{
			'blogCatId': 2,
			'blogCatName': 'ANNOUNCEMENT',
		},
		{
			'blogCatId': 3,
			'blogCatName': 'PRODUCTS',
		}
	]

	for (let i = 0; i < data.length; i++) {
		const id = data[i].blogCatId;
		const value = data[i].blogCatName;
		$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
	}	
}


