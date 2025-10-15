function _proceedFetchBranchParents() {
  const departmentId = $("#departmentId").val();
  const classId = $("#classId").val();
  const armId = $("#armId").val();

  $("#departmentId, #classId, #armId").removeClass("issue");

  if (!departmentId) {
    $("#departmentId").addClass("issue");
    _actionAlert("Select department to continue", false);
    return;
  }

  if (!classId) {
    $("#classId").addClass("issue");
    _actionAlert("Select class to continue", false);
    return;
  }

  if (!armId) {
    $("#armId").addClass("issue");
    _actionAlert("Select arm to continue", false);
    return;
  }
  const fetchParentsParams = {
    departmentId: departmentId,
    classId: classId,
    armId: armId,
  };

  sessionStorage.setItem(
    "fetchParentsParams",
    JSON.stringify(fetchParentsParams)
  );
  _getActiveBranchPage({
    divid: "branch_parent_page",
    page: "branch_parent_page",
    url: adminPortalLocalUrl,
  });
  _alertClose(2);
}

function _fetchBranchParents() {
  let fetchParentsParams = JSON.parse(
    sessionStorage.getItem("fetchParentsParams")
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/students/fetch-student?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchParentsParams.departmentId}&classId=${fetchParentsParams.classId}&armId=${fetchParentsParams.armId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const success = info.success;
        const session = info.session;
        const termName = info.termData.termName;
        const departmentName = info.departmentData.departmentName;
        const className = info.classData.className;
        const armName = info.armData.armName;

        let pageTitle = `
            <div>
            <span><i class="bi-person-bounding-box"></i></span> BRANCH PARENT'S LIST ----
            <span>${session}</span> - 
            <span>${termName}</span> - 
            <span>${departmentName}</span> - 
            <span>${className}</span> - 
            <span>${armName}</span>
            </div>
            <div class="btn-container">
                  <button class="btn" title="EXPORT RECORDS" onclick="_exportStudents('${session}','${departmentName}','${className}','${armName}');">
                    <i class="bi-file-earmark-excel"></i> EXPORT
                  </button>
            </div>
					
				`;
        $("#pageTitleDiv").html(pageTitle);

        let text = "";
        let no = 0;
    
        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const branchId = fetch[i].branchId;
            const departmentId = fetch[i].departmentId;
            const classId = fetch[i].classId;
            const armId = fetch[i].armId;

            const fetchStudentData = fetch[i].studentData;
            const fetchDepartmentData = fetch[i].departmentData;
            const fetchClassData = fetch[i].classData;
            const fetchArmData = fetch[i].armData;

            const studentId = fetchStudentData.studentId;
            const passport = fetchStudentData.passport || "default.jpg";
            const surName = fetchStudentData.surName;
            const firstName = fetchStudentData.firstName;
            const otherNames = fetchStudentData.otherNames;
            const fullname = surName + " " + firstName + " " + otherNames;
            const departmentName = fetchDepartmentData.departmentName;
            const className = fetchClassData.className;
            const armName = fetchArmData.armName;
            const statusName = fetchStudentData.statusName;

            const fetchFatherData = fetch[i].fatherData;
            const fatherFullname =
              fetchFatherData.titleId +
              " " +
              fetchFatherData.surName +
              " " +
              fetchFatherData.otherNames;
            const fatherEmail = fetchFatherData.email;
            const fatherMobileNumber = fetchFatherData.mobileNumber;

            const fetchMotherData = fetch[i].motherData;
            const motherFullname =
              fetchMotherData.titleId +
              " " +
              fetchMotherData.surName +
              " " +
              fetchMotherData.otherNames;
            const motherEmail = fetchMotherData.email;
            const motherMobileNumber = fetchMotherData.mobileNumber;

            text += `
								<tr class="tb-row">
									<td>${no}</td>
									<td class="clickable-td" title="Click to view student details" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
										<div class="text-back-div">
											<div class="image-div general-passport">
												<img src="${studentPixPath}/${passport}" alt="${fullname}"/>
											</div>

											<div class="text-div">
												<div class="first-class">${fullname}</div>
												<div class="second-class">${studentId}</div>
											</div>
										</div>
									</td>
                  <td class="clickable-td" title="Click to view father details" onclick="_loginOnbehalfOfParent('${fetchFatherData.email}','${fetchFatherData.recordFor}','${studentId}');">
										<div class="text-back-div">
											<div class="text-div">
												<div class="first-class">${fatherFullname}</div>
												<div class="second-class">${fatherEmail}</div>
                        <div class="second-class">${fatherMobileNumber}</div>
											</div>
										</div>
									</td>
                  <td class="clickable-td" title="Click to view mother details" onclick="_loginOnbehalfOfParent('${fetchMotherData.email}','${fetchMotherData.recordFor}','${studentId}');">
										<div class="text-back-div">
											<div class="text-div">
                      <div class="first-class">${motherFullname}</div>
												<div class="second-class">${motherEmail}</div>
                        <div class="second-class">${motherMobileNumber}</div>
											</div>
										</div>
									</td>
									<td>${session}</td>
									<td>${termName}</td>
									<td>${departmentName}</td>
									<td>${className}</td>
									<td>${armName}</td>
									<td><div class="status-div ${statusName}">${statusName}</div></td>
								</tr>`;
          }
          $("#pageContent").html(text);
        } else {
          _actionAlert(info.message, false);

          text += `
						<tbody>
							<tr>
								<td colspan="20">
									<div class="false-notification-div">
										<p>${info.message}</p>
									</div>
								</td>
							</tr>
						</tbody>`;
          $("#pageContent").html(text);

          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "An error occurred while fetching data! Please try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _loginOnbehalfOfParent(email, parentTypeId, studentId) {
  try {
    $("#get-more-div-secondary")
      .css({
        display: "flex",
        "justify-content": "center",
        "align-items": "center",
      })
      .fadeIn(500);

    $.ajax({
      type: "GET",
      url:`${endPoint}/admin/branch/account/parentAuth?email=${email}&parentTypeId=${parentTypeId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success) {
          localStorage.setItem("parentSessionData", JSON.stringify(info));

          const studentData = info.students?.find(s => s.studentId === studentId);
          const parentData = info.parentData;

          const sessionPayload = {
            student: studentData,
            parent: parentData
          };
          sessionStorage.setItem("studentParentSessionData", JSON.stringify(sessionPayload));
					_getForm({page: 'parentStudentForm', layer:2, url: adminPortalLocalUrl});
        } else {
          _actionAlert(info.message, false);
          _alertClose(2);
        }
      },
      error: function () {
        _actionAlert(
          "Unable to reach the server. Please check your connection.",
          false
        );
        _alertClose(2);
      },
    });
  } catch (error) {
    console.error("Unexpected error:", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
    _alertClose(2);
  }
}
