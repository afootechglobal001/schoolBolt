function _previewProductCatPix(){
	$('#pixPreview').html('');
	var totalFiles = $('#productPix').get(0).files.length;
	for(var i = 0; i < totalFiles; i++){
		$('#pixPreview').append("<div class='product-pictures'><div class='img'><img src='"+URL.createObjectURL(event.target.files[i])+"'/></div></div>");
	}
}

$(function () {
	seoFlyerPreview = {
	UpdatePreview: function (obj) {
		if (!window.FileReader) {
		// Handle browsers that don't support FileReader
		console.error("FileReader is not supported.");
		} else {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#seoFlyerPreviewPix').prop("src", e.target.result);
		};
		reader.readAsDataURL(obj.files[0]);
		}
	},
	};
});

function _getActiveProductCatPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='get_product_cat_details'
    } = props;
	_getProductCatPagesActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: adminPortalLocalUrl});
	}
}
function _getProductCatPagesActiveLink(divid){
	$('#product_cat_page_content').removeClass('active-li');
	$("#"+divid).addClass('active-li');
}


function _createUpdateProductCategory() {
	let getEachProductCatSession = JSON.parse(sessionStorage.getItem("getEachProductCatSession"));
    try {
        const productName = $('#productName').val();
        const productTags = $('#productTags').val();
        const statusId = $('#statusId').val();

        $('#productName, #productTags, #statusId').removeClass('issue');

        if (!productName) {
            $('#productName').addClass('issue');
            _actionAlert('Provide product category name to continue', false);
            return;
        }

        if (!productTags) {
            $('#productTags').addClass("issue");
            _actionAlert('Provide product tags to continue', false);
            return;
        }

        if (!statusId) {
            $('#statusId').addClass("issue");
            _actionAlert('Select status to continue', false);
            return;
        }

        if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
            const btn_text = $("#submitBtn").html();
            $("#submitBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
            $("#submitBtn").prop("disabled", true);

			const formData = new FormData();
			const totalFiles = $('#productPix').get(0).files.length;
			formData.append("productName", productName);
			formData.append("productTags", productTags);
			formData.append("statusId", statusId);

			if (totalFiles>0){
				for(var i = 0; i < totalFiles; i++){
					formData.append("productPix[]", $("#productPix").get(0).files[i]);
				}
			}
			
			let callUrl= getEachProductCatSession?.productId ? `${endPoint}/admin/products/update-product-category?productId=${getEachProductCatSession.productId}` : `${endPoint}/admin/products/create-product-category`;
            $.ajax({
                type: "POST",
				url: callUrl,
				data: formData,
                dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				headers: getAuthHeaders(true),
				success: function (data) {
					const success = data.success;
					const message = data.message;

					if (success=== true) {
						const newProductPixNames = data.newProductPixNames;
						const oldProductPixNames = data.oldProductPixNames;

					_uploadProductCatPicture(oldProductPixNames, newProductPixNames, message);
                    } else {
                        _actionAlert(data.message, false);
                    }
                    $("#submitBtn").html(btn_text).prop("disabled", false);
                },
                error: function () {
                    _actionAlert('An error occurred while processing your request! Please Try Again', false);
                    $("#submitBtn").html(btn_text).prop("disabled", false);
                }
            });
        }
    } catch (error) {
        _actionAlert('An unexpected error occurred! Please Try Again', false);
        $("#submitBtn").prop("disabled", false);
    }
}


function _uploadProductCatPicture(oldProductPixNames, newProductPixNames, message) {
    const action = "upload_product_cat_pix";

    const formData = new FormData();
	const totalFiles = $('#productPix').get(0).files.length;
    formData.append("action", action);
    formData.append("oldProductPixNames", oldProductPixNames);
	formData.append("newProductPixNames", newProductPixNames);

	for(let i = 0; i < totalFiles; i++){
		formData.append("productPix[]", $("#productPix").get(0).files[i]);
	}

    $.ajax({
        url: adminPortalLocalUrl,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (html) {
            _actionAlert(message, true);
            _alertClose();
            _getPage({ page: 'product_category', url: adminPortalLocalUrl });
        },
        error: function () {
            _actionAlert('Upload failed! Please try again.', false);
        }
    });
}




function _fetchProductCategory() {
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/products/fetch-product-category',
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';
				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						const productId = fetch[i].productId;
						const productName = fetch[i].productName;
						const status = fetch[i].statusData[0].statusName;
						const productPix = fetch[i].picturesData[0].productPix;

						text +=`
							<div class="product-cat-div">
								<div class="btn-div">
									<button class="btn active-btn" onclick="_fetchEachProductCat('${productId}', 'edit');">EDIT</button>
									<button class="btn" onclick="_fetchEachProductCat('${productId}', 'page');">EDIT PAGE DETAILS</button>
								</div>
								<div class="status-div ${status}">${status}</div>
								<div class="image-div">
									<img src="${productCategoryPixPath}/${productPix}" alt="${productName}" />
								</div>
								<div class="count-div" title="Click to view products" onclick="_getActivePage({page:'product_page', divid:'products'});">
									<span>Number of products <div class="num">0</div></span>
								</div>
								<div class="text-div">
									<div class="inner-div">
										<h3>${productName}</h3>
									</div>
								</div>
							</div>
						`;
					}
					$('#pageContent').html(text);
				} else {
					_actionAlert(info.message, false);
					text +=`
					<div class="false-notification-div">
						<p>${info.message}</p>
						<div>
							<button class="btn" onclick="_getForm({page: 'product_cat_reg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD NEW PRODUCT CATEGORY</button>
						</div>
					</div>`;
					$('#pageContent').html(text);

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
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}


function _fetchEachProductCat(productId, action) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/products/fetch-product-category?productId=${productId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachProductCatSession", JSON.stringify(info.data[0]));
					sessionStorage.setItem("publishId", JSON.stringify(info.data[0].productId));
					_getForm({page: action==='edit' ? 'product_cat_reg': 'product_category_modal_form', url: adminPortalLocalUrl});
				} else {
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
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}