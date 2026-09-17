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

		/*
		_callFetchEndPoints({
			url: ``,
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
		*/

		// Dummy backend response
		const dummyResponse = {
			response: 200,
			success: true,
			message: "SUBJECT FETCH SUCCESFFULY!",
			allRecordCount: 4,

			data: [
				{
					cbtId: "CBT001",
					cbtTitle: "WELCOME TEST",

					cbtConfigData: [
						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT029",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT029",
								subjectName: "MATHEMATICS"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT033",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT033",
								subjectName: "SOCIAL STUDIES"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT034",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT034",
								subjectName: "TECHNICAL DRAWING"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT036",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT036",
								subjectName: "YORUBA LANGUAGE"
							}
						}
					]
				},

				{
					cbtId: "CBT002",
					cbtTitle: "MOCK EXAMINATION",

					cbtConfigData: [
						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT029",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT029",
								subjectName: "MATHEMATICS"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT033",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT033",
								subjectName: "SOCIAL STUDIES"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT034",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT034",
								subjectName: "TECHNICAL DRAWING"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT036",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT036",
								subjectName: "YORUBA LANGUAGE"
							}
						}
					]
				},

				{
					cbtId: "CBT003",
					cbtTitle: "FIRST CA TEST",

					cbtConfigData: [
						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT029",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT029",
								subjectName: "MATHEMATICS"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT033",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT033",
								subjectName: "SOCIAL STUDIES"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT034",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT034",
								subjectName: "TECHNICAL DRAWING"
							}
						},

						{
							departmentId: "DEPARTMENT00420260327041353",
							classId: "CLASS01020260327041803",
							subjectId: "SUBJECT036",

							departmentData: {
								departmentId: "DEPARTMENT00420260327041353",
								departmentName: "JUNIOR"
							},

							classData: {
								classId: "CLASS01020260327041803",
								className: "JS 1"
							},

							subjectData: {
								subjectId: "SUBJECT036",
								subjectName: "YORUBA LANGUAGE"
							}
						}
					]
				}
			]
		};

		_initFetchAllAssignedSubjectData(dummyResponse?.data);
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
		const cbtConfigData = item?.cbtConfigData || [];

		const subjectContent = cbtConfigData.length > 0 ? cbtConfigData.map((subjectItem) => {
			const subjectName = subjectItem?.subjectData?.subjectName;
			const departmentName = subjectItem?.departmentData?.departmentName;
			const className = subjectItem?.classData?.className;

			return `
				<div class="toggle-list">
					<div class="title">
						<h4>
							${departmentName} - ${className} (${subjectName})
						</h4>

						<div class="count">10</div>
					</div>

					<div class="btn-container">
						<button
							class="btn"
							title="MANAGE CBT"
							onclick="event.stopPropagation(); _getForm({page: 'cbtPageDetails', url: cbtAdminMiddleWareUrl});">
							<i class="bi bi-tv"></i> MANAGE CBT
						</button>
					</div>
				</div>
			`;
		}).join("")
		: `
			<div class="empty-state-div">
				<p>No subject assigned to this CBT.</p>
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