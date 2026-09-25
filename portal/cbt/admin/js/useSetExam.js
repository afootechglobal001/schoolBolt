/// Set Exam Search Filter ////
function _filtersCbtExam(value) {
  $("#fetchAssignedSubjectContent .toggle-card").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

//// Fetch all Assigned Subject Data ////
function _fetchAssignedSubjectData() {
	try {
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-teachers-subject-for-each-cbt`,
			accessKey: true,
		})
		.then((response) => {
			_initFetchAllAssignedSubjectData(response?.data);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);

			if (error.status == 0) {
				_showEmptyState({
					container: "fetchAssignedSubjectContent",
					message: "Check your internet connection and try again",
				});

				_callAjaxError(
					() => _fetchAssignedSubjectData(),
					error.message
				);
			} else {
				_showEmptyState({
					container: "fetchAssignedSubjectContent",
					message: error.message,
				});
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchAssignedSubjectData());
	}
}

/// Render All Assigned Subject Data ///
function _initFetchAllAssignedSubjectData(data) {
	const content = data?.length > 0 ? data.map((item, start) => {
		const viewId = `view${item?.cbtId}`;
		const cbtTitle = item?.cbtTitle;
		const subjectAllocatedData = item?.subjectAllocatedData || [];

		const subjectContent = subjectAllocatedData.length > 0 ? subjectAllocatedData.map((subjectItem) => {
			const subjectName = subjectItem?.subjectData?.subjectName;
			const subjectId = subjectItem?.subjectData?.subjectId;
			const departmentName = subjectItem?.departmentData?.departmentName;
			const departmentId = subjectItem?.departmentData?.departmentId;
			const className = subjectItem?.classData?.className;
			const classId = subjectItem?.classData?.classId;

			return `
				<div class="toggle-list">
					<div class="title">
						<h4>
							${departmentName} - ${className} (${subjectName})
						</h4>
					</div>

					<div class="btn-container">
						<button
							class="btn"
							title="MANAGE CBT"
							onclick="event.stopPropagation(); _fetchEachCbtPageDetails('${item?.cbtId}', '${departmentId}', '${classId}', '${subjectId}');">
							<i class="bi bi-tv"></i> MANAGE CBT
						</button>
					</div>
				</div>
			`;
		}).join("")
		: `
			<div class="empty-state-div">
				<div class="icon">
					<img
						src="${websiteUrl}/all-images/images/no-record.png"
						alt="Warning" />
				</div>
				<p>No subject assigned to this CBT. <br>Kindly contact the administrator to assign subjects.</p>
			</div>
		`;

		return `
			<div
				class="toggle-card"
				onclick="_chevronCollapse('${viewId}')">

				<div class="title-content">
					<div class="number">
						${start + 1}
					</div>

					<div class="content-div">
						<div class="left-content">
							<div class="text-div">
								<h2>
									${cbtTitle}
								</h2>
							</div>
						</div>

						<div class="nav-wrapper">
							<div
								class="nav-cont toggle-nav"
								id="${viewId}num">

								<i class="bi bi-chevron-down"></i>
							</div>
						</div>
					</div>
				</div>

				<div
					class="open-toggle"
					id="${viewId}answer"
					style="display: none;">

					<div class="toggle-list-wrapper">
						${subjectContent}
					</div>
				</div>
			</div>
		`;

		}).join("")
		: `
			<div class="empty-state-div">
				<div class="icon">
					<img
						src="${websiteUrl}/all-images/images/no-record.png"
						alt="Warning" />
				</div>

				<p>No CBT configuration found.</p>
			</div>
		`;
	$("#fetchAssignedSubjectContent").html(content);
}

/// Fetch Each CBT Page Details ////
function _fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId) {
	$("#get-form-more-div")
		.css({
			'display': 'flex',
			'justify-content': 'center',
			'align-items': 'center'
		})
		.fadeIn(500);
	try {
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-subject-exam-details?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem(
				"useEachCbtPageDetailsSession",
				JSON.stringify(response?.data)
			);

			_getForm({
				page: 'cbtPageDetails',
				url: cbtAdminMiddleWareUrl
			});
		})	
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			if (error.status==0) {
				_callAjaxError(
					() => _fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId),
					error.message
				); // retry if needed
				_alertClose();
			} else {
				_showCustomConfirm({
					title: "Unable to fetch details!",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_alertClose();
			}
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId));
	}
}