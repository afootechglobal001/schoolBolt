function _printCaBroadSheet(departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));

	const session = fetchPresetDataSession?.session;
	const termId = fetchPresetDataSession?.termData?.termId;
	const assessmentId = fetchPresetDataSession?.assessmentData?.assessmentId;
	
	// SHOW PROGRESS PANEL
    $("#get-more-div-secondary")
        .css({
            display: "flex",
            justifyContent: "center",
            alignItems: "center",
        })
	.html(`
		<div>
			<div class="alert alert-success" id="progress-alert">
				<span>COMPILING BROAD SHEET DATA...</span><br>
				Please DO NOT close this panel as the process takes some time.
				<div class="ajax-progress" style="width:0%;">0%</div>
			</div>
		</div>
	`)
	.fadeIn(500);

	try {
	
		let fakeProgress = 0;
		let progressInterval = setInterval(() => {
			if (fakeProgress < 95) { 
				fakeProgress += Math.random() * 2; // move slowly
				$(".ajax-progress").css("width", fakeProgress + "%");
				$(".ajax-progress").html(Math.floor(fakeProgress) + "%");
			}
		}, 200);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-ca-broad-sheet?branchId=${getEachBranchDetailsSession.branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				clearInterval(progressInterval);

				// COMPLETE PROGRESS BAR
				$(".ajax-progress").css("width", "100%").html("100%");

				setTimeout(() => {
				if (info.success > 0) {
					sessionStorage.setItem("printBroadSheetsession", JSON.stringify(info));
					windowPop(`${websiteUrl}/reports/print-ca-broad-sheet`);
					_alertClose(2);
				} else {
					_actionAlert(info.message, false);
					_alertClose(2);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				}, 300);
			},
			error: function(textStatus, errorThrown) {
				_alertClose(2);
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