function _createOrUpdatePage() {
	let publishId = JSON.parse(sessionStorage.getItem("publishId"));
	
	tinyMCE.triggerSave();
	try {
		const pageTitle = $('#pageTitle').val();
		const pageUrl = $('#pageUrl').val();
		const seoKeywords = $('#seoKeywords').val();
		const seoDescription = $('#seoDescription').val();
		const pageContent = $('#pageContent').val();
		
		$('#pageTitle, #pageTitle, #seoKeywords, #seoDescription, #pageContent, #seoFlyer').removeClass('issue');

		if (!pageTitle) {
			$('#pageTitle').addClass("issue");
			_actionAlert('Provide Page Title to continue', false);
		return;
		} 

		if (!pageUrl) {
			$('#pageUrl').addClass('issue');
			_actionAlert('Provide Page Url to continue', false);
		return;
		} 

		if (!seoKeywords) {
			$('#seoKeywords').addClass("issue");
			_actionAlert('Provide Seo Keywords to continue', false);
		return;
		} 

		if (!seoDescription) {
			$('#seoDescription').addClass("issue");
			_actionAlert('Provide Seo Description to continue', false);
		return;
		}

		if (!pageContent) {
			$('#pageContent').addClass("issue");
			_actionAlert('Provide Page Content to continue', false);
		return;
		}

		if (!seoFlyer) {
			$('#seoFlyer').addClass("issue");
			_actionAlert('Provide seo flyer to continue', false);
		return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
            const btn_text = $("#saveBtn").html();
            $("#saveBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
            $("#saveBtn").prop("disabled", true);
			
			const formData = new FormData();
			const totalFiles = $('#seoFlyer').get(0).files.length;
			formData.append("pageTitle", pageTitle);
			formData.append("pageUrl", pageUrl);
			formData.append("seoKeywords", seoKeywords);
			formData.append("seoDescription", seoDescription);
			formData.append("pageContent", pageContent);

			if (totalFiles>0){
				for(var i = 0; i < totalFiles; i++){
					formData.append("seoFlyer[]", $("#seoFlyer").get(0).files[i]);
				}
			}

			$.ajax({
                type: "POST",
				url: `${endPoint}/admin/pages/create-or-update-page?publishId=${publishId}&pageCategory=${pageCategory.productCategory}`,
				data: formData,
                dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				headers: getAuthHeaders(true),
				success: function (data) {
					const success = data.success;
					// const message = data.message;
		
					if (success === true) {
						_actionAlert(data.message, true);
					} else {
                        _actionAlert(data.message, false);
                    }
                    $("#saveBtn").html(btn_text).prop("disabled", false);
                },
                error: function () {
                    _actionAlert('An error occurred while processing your request! Please Try Again', false);
                    $("#saveBtn").html(btn_text).prop("disabled", false);
                }
            });
        }
    } catch (error) {
        _actionAlert('An unexpected error occurred! Please Try Again', false);
        $("#saveBtn").prop("disabled", false);
    }
}

function _fetchPageContent() {
	let publishId = JSON.parse(sessionStorage.getItem("publishId"));
	try {
		$.ajax({
			type: "POST",
			url: `${endPoint}/admin/pages/fetch-page?publishId=${publishId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (success == true) {
					const data = info.data[0];
					const pageUrl = data.pageUrl;
					const pageTitle = data.pageTitle;
					const seoKeywords = data.seoKeywords;
					const seoDescription = data.seoDescription;
					const seoFlyer = data.seoFlyer;
					const pageContent = data.pageContent;

					$('#pageUrl').val(pageUrl);
					$('#pageTitle').val(pageTitle);
					$('#seoKeywords').val(seoKeywords);
					$('#seoDescription').val(seoDescription);
					$('#seo_flyer_preview_pix').attr('src', documentStoragePath + '/' + seoFlyer);
					
					setTimeout(function() {
						tinymce.get('pageContent').setContent(pageContent);
					}, 2000);	
					
				} else {
					const response = info.response;
					if(response<100){
						_logOut();
					}else{
						_actionAlert(message, false);
					}
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}