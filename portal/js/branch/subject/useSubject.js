function _getSelectSubjectTeachers(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/staff/fetch-staff?branchId=${getEachBranchDetailsSession.branchId}&statusId=1`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const teacherFirstName = data[i].firstName;
            const teacherLastName = data[i].lastName;
            const id = data[i].staffId;
            const value = teacherFirstName + " " + teacherLastName;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>"
            );
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _getSelectSubjectDepartment(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/department/fetch-branch-departments?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            if (data[i].checked) {
              const id = data[i].departmentId;
              const value = data[i].departmentName;
              $("#searchList_" + fieldId).append(
                "<li onclick=\"_clickOption('searchList_" +
                  fieldId +
                  "', '" +
                  id +
                  "', '" +
                  value +
                  "'); _fetchSelectSujectDepartmentClass();\">" +
                  value +
                  "</li>"
              );
            }
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _fetchSelectSujectDepartmentClass() {
  _getSelectSubjectClass("classId");
}

function _getSelectSubjectClass(fieldId) {
  const departmentId = $("#departmentId").val();
  try {
    $.ajax({
      type: "GET",
      url:
        endPoint +
        "/admin/settings/departments/fetch-department-classes?departmentId=" +
        departmentId,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          $("#searchList_" + fieldId).html("");
          const checkedClasses = data.filter((item) => item.checked === true);
          for (let i = 0; i < checkedClasses.length; i++) {
            const id = checkedClasses[i].classId;
            const value = checkedClasses[i].className;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "'); _fetchSelectSubjectClassArm();\">" +
                value +
                "</li>"
            );
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _fetchSelectSubjectClassArm() {
  _getSelectSubjectArm("armId");
}

function _getSelectSubjectArm(fieldId) {
  const departmentId = $("#departmentId").val();
  const classId = $("#classId").val();
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/students/fetch-department-class-arms?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.armData;
        const success = info.success;

        if (success === true) {
          $("#searchList_" + fieldId).html("");
          for (let i = 0; i < data.length; i++) {
            const id = data[i].armId;
            const value = data[i].armName;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>"
            );
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _proceedFetchBranchSubject() {
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

  const fetchSubjectsParams = {
    departmentId: departmentId,
    classId: classId,
    armId: armId,
  };

  sessionStorage.setItem(
    "fetchSubjectsParams",
    JSON.stringify(fetchSubjectsParams)
  );
  _getActiveBranchPage({
    divid: "branch_subject_page",
    page: "branch_subject_page",
    url: adminPortalLocalUrl,
  });
  _alertClose(2);
}

function _fetchBranchSubjects() {
  let fetchSubjectsParams = JSON.parse(
    sessionStorage.getItem("fetchSubjectsParams")
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );
  $("#pageContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>'
    )
    .fadeIn("fast");
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/subject/fetch-branch-class-subjects?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchSubjectsParams.departmentId}&classId=${fetchSubjectsParams.classId}&armId=${fetchSubjectsParams.armId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        _getBranchPagesActiveLink("branch_subjects");
        const fetch = info.data;
        const success = info.success;
        const session = info.session;
        const termName = info.termData.termName;
        const departmentName = info.departmentData.departmentName;
        const departmentId = info.departmentData.departmentId;
        const className = info.classData.className;
        const classId = info.classData.classId;
        const armName = info.armData.armName;
        const armId = info.armData.armId;

        $("#subjectSession").html(session);
        $("#departmentName3").html(departmentName);
        $("#className2").html(className);
        $("#subjectTermName").html(termName);
        $("#armName2").html(armName);

        let text = "";
        let no = 0;
        text = `
					<thead>
						<tr class="tb-col">
							<th>sn</th>
							<th>Session</th>
							<th>Term</th>
							<th>Department</th>
							<th>Class</th>
							<th>Arm</th>
							<th>Subject</th>
							<th>Subject Teacher</th>
							<th>Edit</th>
						</tr>
					</thead>`;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const fetchInfo = fetch[i];
            const subjectData = fetchInfo.subjectData;
            const teacherData = fetchInfo.teacherData;

            text += `
						 	<tbody>
								<tr class="tb-row">
									<td>${no}</td>
									<td>${session}</td>
									<td>${termName}</td>
									<td>${departmentName}</td>
									<td>${className}</td>
                  <td>${armName}</td>
									<td>${subjectData.subjectName}</td>`;

            if (teacherData && typeof teacherData) {
              const fullname = teacherData.fullname;
              const emailAddress = teacherData.emailAddress;
              const profilePix = teacherData.profilePix
                ? teacherData.profilePix
                : "default.jpg";

              text += `
											<td>
												<div class="text-back-div">
													<div class="image-div general-passport">
														<img src="${websiteUrl}/uploaded_files/staffPix/${profilePix}" alt="${fullname}"/>
													</div>

													<div class="text-div">
														<div class="first-class">${fullname}</div>
														<div class="second-class">${emailAddress}</div>
													</div>
												</div>
											</td>`;
            } else {
              text += "<td>No Teacher Allocated</td>";
            }

            if (teacherData && typeof teacherData) {
              text += `
              <td>
                <div class="btn-div">
                  <button class="btn view-btn decline-btn" title="Click to deallocate Subject Teacher" id="deallocateSubjectTeacherBtn_${subjectData.subjectId}" onclick="_deallocateSubjectTeacher('${departmentId}','${classId}','${armId}','${subjectData.subjectId}');"><i class="bi-x-circle"></i> DEALLOCATE</button>
                </div>
              </td>`;
            } else {
              text += `
              <td>
                <div class="btn-div">
                  <button class="btn view-btn" title="Click to edit allocate class teacher" onclick="_fetchSubjectTeacher('${departmentId}','${classId}','${armId}','${subjectData.subjectId}');"><i class="bi-bookmark-check"></i> ALLOCATE</button>
                </div>
              </td>`;
            }
            text += `
              </tr>
            </tbody>`;
          }
          $("#pageContent").html(text);
        } else {
          _actionAlert(info.message, false);

          text += `
						<tbody>
							<tr>
								<td colspan="15">
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
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _fetchSubjectTeacher(departmentId, classId, armId, subjectId) {
  $("#get-more-div-secondary")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/subject/fetch-subject-teacher?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success) {
          sessionStorage.setItem(
            "getSubjectTeacherSession",
            JSON.stringify(info)
          );
          _getForm({
            page: "assign_subject_staff",
            layer: 2,
            url: adminPortalLocalUrl,
          });
        } else {
          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    _alertClose();
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function allocateSubjectTeacher() {
  try {
    const staffId = $("#staffId").val();

    $("#staffId").removeClass("issue");

    if (!staffId) {
      $("#staffId").addClass("issue");
      _actionAlert("Select class teacher to continue", false);
      return;
    }

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submitBtn").html();
      $("#submitBtn").html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      $("#submitBtn").prop("disabled", true);

      const formData = {
        staffId: staffId,
      };

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/subject/subject-teacher-allocation?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${getSubjectTeacherSession.departmentData.departmentId}&classId=${getSubjectTeacherSession.classData.classId}&armId=${getSubjectTeacherSession.armData.armId}&subjectId=${getSubjectTeacherSession.subjectData.subjectId}`,
        data: JSON.stringify(formData),
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        processData: false,
        success: function (info) {
          if (info.success) {
            let getSubjectTeacherSession = info.data;
            sessionStorage.setItem(
              "getSubjectTeacherSession",
              JSON.stringify(getSubjectTeacherSession)
            );

            _actionAlert(info.message, true);
            _getActiveBranchPage({
              divid: "branch_subject_page",
              page: "branch_subject_page",
              url: adminPortalLocalUrl,
            });
            _alertClose(2);
          } else {
            _actionAlert(info.message, false);
          }
          $("#submitBtn").html(btn_text).prop("disabled", false);
        },
        error: function (error) {
          _actionAlert(
            "An error occurred while processing your request! Please Try Again",
            false
          );
          $("#submitBtn").html(btn_text).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $("#submitBtn").prop("disabled", false);
  }
}

function _deallocateSubjectTeacher(departmentId, classId, armId, subjectId) {
	try {
		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $(`#deallocateSubjectTeacherBtn_${subjectId}`).html();
			$(`#deallocateSubjectTeacherBtn_${subjectId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$(`#deallocateSubjectTeacherBtn_${subjectId}`).prop("disabled", true);

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/branch/subject/subject-teacher-disallocation?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}`,
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_getActiveBranchPage({
            divid: "branch_subject_page",
            page: "branch_subject_page",
             url: adminPortalLocalUrl,
          });
				} else {
					_actionAlert(data.message, false);
				}
				$(`#deallocateSubjectTeacherBtn_${subjectId}`).html(btn_text).prop("disabled", false);
			},
				error: function (error) {
					_actionAlert('An error occurred while processing your request! Please Try Again', false);
					$(`#deallocateSubjectTeacherBtn_${subjectId}`).html(btn_text).prop("disabled", false);
				}
			});
		}
	} catch (error) {
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}



function _getSelectNewSubjectAllocationDepartment(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/department/fetch-branch-departments?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            if (data[i].checked) {
              const id = data[i].departmentId;
              const value = data[i].departmentName;
              $("#searchList_" + fieldId).append(
                "<li onclick=\"_clickOption('searchList_" +
                  fieldId +
                  "', '" +
                  id +
                  "', '" +
                  value +
                  "'); _fetchSelectNewSujectAllocationDepartmentClass(); _getSelectNewSubjectAllocationArm(); _fetchSelectNewSujectAllocationClassSubject();\">" +
                  value +
                  "</li>"
              );
            }
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _fetchSelectNewSujectAllocationDepartmentClass() {
  // clear previous Class selection completely
  _clearSelectField("classId");
  _getSelectNewSubjectAllocationClass("classId");
}

function _getSelectNewSubjectAllocationClass(fieldId) {
  const departmentId = $("#departmentId").val();
  // always reset before loading
  $("#"+fieldId).val("");
  $("#searchList_" + fieldId).html("");

  try {
    $.ajax({
      type: "GET",
      url:
        endPoint +
        "/admin/settings/departments/fetch-department-classes?departmentId=" +
        departmentId,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          $("#searchList_" + fieldId).html("");
          const checkedClasses = data.filter((item) => item.checked === true);
          for (let i = 0; i < checkedClasses.length; i++) {
            const id = checkedClasses[i].classId;
            const value = checkedClasses[i].className;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "'); _fetchSelectNewSubjectAllocationClassArm(); _fetchSelectNewSujectAllocationClassSubject();\">" +
                value +
                "</li>"
            );
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _fetchSelectNewSubjectAllocationClassArm() {
  _getSelectNewSubjectAllocationArm();
}

function _fetchSelectNewSujectAllocationClassSubject() {
  // clear previous Subject selection completely
  _clearSelectField("subjectId");
  _getSelectNewSubjectByClass("subjectId");
}

function _getSelectNewSubjectByClass(fieldId) {
  const classId = $("#classId").val();

  // always reset before loading
  $("#"+fieldId).val("");
  $("#searchList_" + fieldId).html("");

  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/settings/classes/fetch-class-subjects?classId=${classId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          $("#searchList_" + fieldId).html("");
          const checkedClasses = data.filter((item) => item.checked === true);
          for (let i = 0; i < checkedClasses.length; i++) {
            const id = checkedClasses[i].subjectId;
            const value = checkedClasses[i].subjectName;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>"
            );
          }
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

/// Fetch Subject Allocation Arm Toggle ///
function _getSelectNewSubjectAllocationArm() {
  const departmentId = $("#departmentId").val();
  const classId = $("#classId").val();

	try {
		_callFetchEndPoints({
		url: `admin/branch/students/fetch-department-class-arms?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}`,
		accessKey: true,
		})
		.then((response) => {
      if (response?.success === true) {
        _initFetchSubjectAllocationArm(response?.armData);
      } else {
        $('#fetchArmToggle').html(`
          <div class="false-notification-div">
            <p>${response?.message}</p>
          </div>
        `);
      }
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
	}
}

//// Initialize Fetch Subject Allocation Arm Toggle ////
function _initFetchSubjectAllocationArm(armData) {
  let armHtml = '';
	for (let i = 0; i < armData.length; i++) {
		const {armId, armName} = armData[i];

		armHtml += `
      <div class="each-toggle-div">
        <span>${armName}</span>
        <label for="arm_${armId}" class="switch">
          <input type="checkbox" class="child exam-checkbox" id="arm_${armId}" name="armId[]" data-value="${armId}">
          <span class="slider"></span>
          <span class="toggle-label">No</span>
        </label>
      </div>`;
	}
	$('#fetchArmToggle').html(armHtml);
	_toggleCheck();
}

//// Function Clear SelectField ////
function _clearSelectField(fieldId) {
    // clear actual select value
    $("#" + fieldId).val("");

    // reset displayed option
    $("#" + fieldId).html(`
        <option selected="selected" value="">
            Select here
        </option>
    `);
}

/// Proceed Allocate Subject ////
function _proceedAllocateSubject() {
  try {
    let issueCount = 0;
    ////////get all needed values////////////
    const departmentId = $('#departmentId').val().trim();
    const classId = $('#classId').val().trim();
    const subjectId = $('#subjectId').val().trim();
    const staffId = $('#staffId').val().trim();

    issueCount += _validateEmptyValue("departmentId", "DEPARTMENT");
    issueCount += _validateEmptyValue("classId", "CLASS");
    issueCount += _validateEmptyValue("subjectId", "SUBJECT");
    issueCount += _validateEmptyValue("staffId", "STAFF");

    if (issueCount > 0) return;

    let selectedArms = [];
		$('.child:checked').each(function() {
			selectedArms.push({ armId: $(this).data('value') });
		});

    const checked = $('input[name="armId[]"]:checked').length;
		$("#armId").removeClass("issue");

		if (checked < 1) {
			$("#armId").addClass("issue");
			_actionAlert('Assign at least an arm to continue', false);
			return;
		}

    // Gather form data
    const formData = {
      departmentId,
      classId,
      armIds: selectedArms,
      subjectId,
      staffId,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _proceedAllocateSubjectCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedAllocateSubject());
  }
}

//// Proceed To Allocate Subject CallBack /////
function _proceedAllocateSubjectCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  try {
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/subject/subject-teacher-bulk-allocations?branchId=${getEachBranchDetailsSession?.branchId}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _alertClose(2);
            },
            title: "Success!",
            message: response.message,
            alertType: "success",
            trueActionBtnText: "OK, Thanks.",
            closeOnOverlayClick: false,
          });
        } else {
          _showCustomConfirm({
            title: "Unable To Allocate Subject",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("submitBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _proceedAllocateSubjectCallback(formData)); // retry if needed
        _btnDisable("submitBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedAllocateSubjectCallback(formData));
    _btnDisable("submitBtn", btnText, false);
  }
}