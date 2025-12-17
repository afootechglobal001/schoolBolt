function _getActiveStudentPage(props) {
  const {
    page = "",
    divid = "",
    pageContainer = "get_student_details",
  } = props;
  _getStudentPagesActiveLink(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getStudentPagesActiveLink(divid) {
  $(
    "#student_profile_details, #tanscript, #student_activities, #student_report").removeClass("active");
  $("#" + divid).addClass("active");
}

$(function () {
  studentPixPreview = {
    UpdatePreview: function (obj, action = 'register') {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
        return;
      }

      const file = obj.files[0];
      const maxSize = 300 * 1024; // 300KB

      if (file.size > maxSize) {
        if (action === 'updateStudentPix') {
          document.getElementById("cam-pix").innerHTML =
          `<img id="passport" src="${websiteUrl}/uploaded_files/studentPix/default.jpg" />`;
        } else {
          document.getElementById("cam-pix").innerHTML =
            `<img id="passport" src="${websiteUrl}/images/sample.jpg" />`;
        }
        _actionAlert("Image is too large! Maximum allowed size is 300KB.", false);
        return;
      }
      
      var reader = new FileReader();

      reader.onload = function (e) {
        document.getElementById("cam-pix").innerHTML =
            '<img id="passport" src="' + e.target.result + '"/>';

        if (action === 'updateStudentPix') {
            _updateStudentPix();
        }
      };
      reader.readAsDataURL(obj.files[0]);
    },
  };
});


function copyTextbox() {
  setTimeout(function () {
    let addressVal = $("#address").val();
    let surnameVal = $("#surName").val();

    $("#motherAddress, #fatherAddress").val(addressVal);
    $("#fatherSurName, #motherSurName").val(surnameVal);
  }, 0);
}

function _getSelectAccomodation(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: endPoint + "/preset-data/fetch-accommodation",
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const id = data[i].accommodationId;
            const value = data[i].accommodationName;
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

function _getSelectDepartment(fieldId) {
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
                  "'); _fetchSelectDepartmentClass();\">" +
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
  }
}

function _fetchSelectDepartmentClass() {
  _getSelectDepartmentClass("classId");
}

function _getSelectDepartmentClass(fieldId) {
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
                "'); _fetchSelectDepartmentClassArm();\">" +
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

function _fetchSelectDepartmentClassArm() {
  _getSelectDepartmentArm("armId");
}

function _getSelectDepartmentArm(fieldId) {
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

function formatDate(date) {
  if (!date) return "";
  const parts = date.split("-"); // Convert "1990-05-20" to ["1990", "05", "20"]
  return `${parts[2]}/${parts[1]}/${parts[0]}`; // Output: "20/05/1990"
}

function _createStudent(view) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );
  try {
    const passport = document.getElementById("passport").src;
    const surName = $("#surName").val();
    const firstName = $("#firstName").val();
    const otherNames = $("#otherNames").val();
    const genderId = $("#genderId").val();
    const maritalStatusId = $("#maritalStatusId").val();
    const dateOfBirth = formatDate($("#dateOfBirth").val());
    const countryId = $("#countryId").val();
    const stateId = $("#stateId").val();
    const lgaId = $("#lgaId").val();
    const address = $("#address").val();
    const email = $("#email").val();
    const mobileNumber = $("#mobileNumber").val();
    const fatherTitleId = $("#fatherTitleId").val();
    const fatherSurName = $("#fatherSurName").val();
    const fatherOtherNames = $("#fatherOtherNames").val();
    const fatherAddress = $("#fatherAddress").val();
    const fatherEmail = $("#fatherEmail").val();
    const fatherMobileNumber = $("#fatherMobileNumber").val();
    const fatherDayOfBirth = $("#fatherDayOfBirth").val();
    const fatherMonthOfBirth = $("#fatherMonthOfBirth").val();
    const fatherOccupation = $("#fatherOccupation").val();
    const motherTitleId = $("#motherTitleId").val();
    const motherSurName = $("#motherSurName").val();
    const motherOtherNames = $("#motherOtherNames").val();
    const motherAddress = $("#motherAddress").val();
    const motherEmail = $("#motherEmail").val();
    const motherMobileNumber = $("#motherMobileNumber").val();
    const motherDayOfBirth = $("#motherDayOfBirth").val();
    const motherMonthOfBirth = $("#motherMonthOfBirth").val();
    const motherOccupation = $("#motherOccupation").val();
    const officialStudentId = $("#officialStudentId").val();
    const departmentId = $("#departmentId").val();
    const classId = $("#classId").val();
    const armId = $("#armId").val();
    const accommodationId = $("#accommodationId").val();
    const statusId = $("#statusId").val();

    $(
      "#surName, #firstName, #genderId, #maritalStatusId, #dateOfBirth, #countryId, #stateId, #lgaId, #address, #email, #mobileNumber, #fatherEmail, #motherEmail, #departmentId, #classId, #armId, #accommodationId, #statusId"
    ).removeClass("issue");

    if (!surName) {
      $("#surName").addClass("issue");
      _actionAlert("Provide surname to continue", false);
      return;
    }

    if (!firstName) {
      $("#firstName").addClass("issue");
      _actionAlert("Provide first name to continue", false);
      return;
    }

    if (!genderId) {
      $("#genderId").addClass("issue");
      _actionAlert("Select gender to continue", false);
      return;
    }

    if (!maritalStatusId) {
      $("#maritalStatusId").addClass("issue");
      _actionAlert("Select marital status to continue", false);
      return;
    }

    if (!dateOfBirth) {
      $("#dateOfBirth").addClass("issue");
      _actionAlert("Provide date of birth to continue", false);
      return;
    }

    if (!countryId) {
      $("#countryId").addClass("issue");
      _actionAlert("Select country to continue", false);
      return;
    }

    if (!stateId) {
      $("#stateId").addClass("issue");
      _actionAlert("Select state to continue", false);
      return;
    }

    if (!lgaId) {
      $("#lgaId").addClass("issue");
      _actionAlert("Select LGA to continue", false);
      return;
    }

    if (!address) {
      $("#address").addClass("issue");
      _actionAlert("Provide address to continue", false);
      return;
    }

    if (
      email &&
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)
    ) {
      $("#email").addClass("issue");
      _actionAlert("Provide correct email to continue", false);
      return;
    }

    if (
      fatherEmail &&
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(fatherEmail)
    ) {
      $("#fatherEmail").addClass("issue");
      _actionAlert("Provide father's correct email to continue", false);
      return;
    }

    if (
      motherEmail &&
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(motherEmail)
    ) {
      $("#motherEmail").addClass("issue");
      _actionAlert("Provide mother's correct email to continue", false);
      return;
    }

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

    if (!accommodationId) {
      $("#accommodationId").addClass("issue");
      _actionAlert("Select accommodation status to continue", false);
      return;
    }

    if (!statusId) {
      $("#statusId").addClass("issue");
      _actionAlert("Select status to continue", false);
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

      const formData = new FormData();
      formData.append("surName", surName);
      formData.append("firstName", firstName);
      formData.append("otherNames", otherNames);
      formData.append("genderId", genderId);
      formData.append("maritalStatusId", maritalStatusId);
      formData.append("dateOfBirth", dateOfBirth);
      formData.append("countryId", countryId);
      formData.append("stateId", stateId);
      formData.append("lgaId", lgaId);
      formData.append("address", address);
      formData.append("email", email);
      formData.append("mobileNumber", mobileNumber);
      formData.append("fatherTitleId", fatherTitleId);
      formData.append("fatherSurName", fatherSurName);
      formData.append("fatherOtherNames", fatherOtherNames);
      formData.append("fatherAddress", fatherAddress);
      formData.append("fatherEmail", fatherEmail);
      formData.append("fatherMobileNumber", fatherMobileNumber);
      formData.append("fatherDayOfBirth", fatherDayOfBirth);
      formData.append("fatherMonthOfBirth", fatherMonthOfBirth);
      formData.append("fatherOccupation", fatherOccupation);
      formData.append("motherTitleId", motherTitleId);
      formData.append("motherSurName", motherSurName);
      formData.append("motherOtherNames", motherOtherNames);
      formData.append("motherAddress", motherAddress);
      formData.append("motherEmail", motherEmail);
      formData.append("motherMobileNumber", motherMobileNumber);
      formData.append("motherDayOfBirth", motherDayOfBirth);
      formData.append("motherMonthOfBirth", motherMonthOfBirth);
      formData.append("motherOccupation", motherOccupation);
      formData.append("officialStudentId", officialStudentId);
      formData.append("departmentId", departmentId);
      formData.append("classId", classId);
      formData.append("armId", armId);
      formData.append("accommodationId", accommodationId);
      formData.append("statusId", statusId);
      formData.append("passport", passport);

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/students/create-student?branchId=${getEachBranchDetailsSession.branchId}`,
        data: formData,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        headers: getAuthHeaders(true),
        success: function (info) {
          const data = info.data[0];
          const success = info.success;
          const message = info.message;

          if (success === true) {
            const newPassportName = data.studentData[0].passport;
            const oldPassportName = data.oldPassportName;

            if (newPassportName === "default.jpg") {
              _actionAlert(message, true);
              _proceedFetchBranchStudents();
            } else {
              _uploadStudentPicture(oldPassportName, newPassportName, message);
            }
          } else {
            _actionAlert(message, false);
          }
          $("#submitBtn").html(btn_text).prop("disabled", false);
        },
        error: function () {
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

function _uploadStudentPicture(oldPassportName, newPassportName, message) {
  const action = "upload_student_pix";

  const formData = new FormData();
  var passport = document.getElementById("passport").src;
  formData.append("action", action);
  formData.append("passport", passport);
  formData.append("oldPassportName", oldPassportName);
  formData.append("newPassportName", newPassportName);

  $.ajax({
    url: adminPortalLocalUrl,
    type: "POST",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    success: function (html) {
      _actionAlert(message, true);
      _proceedFetchBranchStudents();
    },
    error: function () {
      _actionAlert("Upload failed! Please try again.", false);
    },
  });
}

function _proceedFetchBranchStudents() {
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
  const fetchStudentsParams = {
    departmentId: departmentId,
    classId: classId,
    armId: armId,
  };

  sessionStorage.setItem(
    "fetchStudentsParams",
    JSON.stringify(fetchStudentsParams)
  );
  _alertClose(2);
  _getActiveBranchPage({
    divid: "branch_student_page",
    page: "branch_student_page",
    url: adminPortalLocalUrl,
  });
}

function _fetchBranchStudents() {
  let fetchStudentsParams = JSON.parse(
    sessionStorage.getItem("fetchStudentsParams")
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
      url: `${endPoint}/admin/branch/students/fetch-student?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchStudentsParams.departmentId}&classId=${fetchStudentsParams.classId}&armId=${fetchStudentsParams.armId}`,
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

        $("#pageSession").html(session);
        $("#departmentName3").html(departmentName);
        $("#className2").html(className);
        $("#pageTermName").html(termName);
        $("#armName2").html(armName);

        let showButtons = `
					<button class="btn" title="PRINT RECORDS" id="printStudentsByClassBtn" onclick="_printStudentByClass('${info.departmentData.departmentId}','${info.classData.classId}','${info.armData.armId}')">
						<i class="bi-printer"></i> PRINT
					</button>
					<button class="btn" title="EXPORT RECORDS" onclick="_exportStudents('${session}','${departmentName}','${className}','${armName}');">
						<i class="bi-file-earmark-excel"></i> EXPORT
					</button>
				`;
        $("#printAndExportButton").html(showButtons);

        let text = "";
        let no = 0;
        text = `
					<thead>
						<tr class="tb-col">
							<th>sn</th>
							<th>Student Info</th>
							<th>Gender</th>
							<th>Age</th>
							<th>Session</th>
							<th>Term</th>
							<th>Department</th>
							<th>Class</th>
							<th>Arm</th>
							<th>Accomodation</th>
							<th>Status</th>
							<th>View</th>
						</tr>
					</thead>`;

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
            const fetchAccommodationData = fetch[i].accommodationData;

            const studentId = fetchStudentData.studentId;
            const passport = fetchStudentData.passport || "default.jpg";
            const surName = fetchStudentData.surName;
            const firstName = fetchStudentData.firstName;
            const otherNames = fetchStudentData.otherNames;
            const fullname = surName + " " + firstName + " " + otherNames;
            const genderName = fetchStudentData.genderName;
            const departmentName = fetchDepartmentData.departmentName;
            const className = fetchClassData.className;
            const armName = fetchArmData.armName;
            const statusName = fetchStudentData.statusName;
            const accommodationName = fetchAccommodationData.accommodationName;
            const age = _calculateAge(fetchStudentData.dateOfBirth);

            text += `
						 	<tbody>
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
									<td>${genderName}</td>
									<td>${age}</td>
									<td>${session}</td>
									<td>${termName}</td>
									<td>${departmentName}</td>
									<td>${className}</td>
									<td>${armName}</td>
									<td>${accommodationName}</td>
									<td><div class="status-div ${statusName}">${statusName}</div></td>
									<td><button class="btn view-btn" title="Click to view student profile" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">VIEW</button></td>
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

function _fetchEachBranchStudents(
  branchId,
  departmentId,
  classId,
  armId,
  studentId,
  statusId
) {
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
      url: `${endPoint}/admin/branch/students/fetch-student?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}&statusId=${statusId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success && info.data.length > 0) {

          sessionStorage.setItem(
            "getEachBranchStudentsSession",
            JSON.stringify(info.data[0])
          );

           sessionStorage.setItem(
            "getEachBranchDetailsSession",
            JSON.stringify({ branchId: branchId })
          );

          _getForm({
            page: "student_profile",
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

function _updateBranchStudents() {
  let getEachBranchStudentsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchStudentsSession")
  );
  try {
    const surName = $("#surName").val();
    const firstName = $("#firstName").val();
    const otherNames = $("#otherNames").val();
    const genderId = $("#genderId").val();
    const maritalStatusId = $("#maritalStatusId").val();
    const dateOfBirth = formatDate($("#dateOfBirth").val());
    const countryId = $("#countryId").val();
    const stateId = $("#stateId").val();
    const lgaId = $("#lgaId").val();
    const address = $("#address").val();
    const email = $("#email").val();
    const mobileNumber = $("#mobileNumber").val();
    const fatherTitleId = $("#fatherTitleId").val();
    const fatherSurName = $("#fatherSurName").val();
    const fatherOtherNames = $("#fatherOtherNames").val();
    const fatherAddress = $("#fatherAddress").val();
    const fatherEmail = $("#fatherEmail").val();
    const fatherMobileNumber = $("#fatherMobileNumber").val();
    const fatherDayOfBirth = $("#fatherDayOfBirth").val();
    const fatherMonthOfBirth = $("#fatherMonthOfBirth").val();
    const fatherOccupation = $("#fatherOccupation").val();
    const motherTitleId = $("#motherTitleId").val();
    const motherSurName = $("#motherSurName").val();
    const motherOtherNames = $("#motherOtherNames").val();
    const motherAddress = $("#motherAddress").val();
    const motherEmail = $("#motherEmail").val();
    const motherMobileNumber = $("#motherMobileNumber").val();
    const motherDayOfBirth = $("#motherDayOfBirth").val();
    const motherMonthOfBirth = $("#motherMonthOfBirth").val();
    const motherOccupation = $("#motherOccupation").val();
    const officialStudentId = $("#officialStudentId").val();
    const departmentId = $("#departmentId").val();
    const classId = $("#classId").val();
    const armId = $("#armId").val();
    const accommodationId = $("#accommodationId").val();
    const statusId = $("#statusId").val();

    $(
      "#surName, #firstName, #genderId, #maritalStatusId, #dateOfBirth, #countryId, #stateId, #lgaId, #address, #email, #mobileNumber, #fatherEmail, #motherEmail, #departmentId, #classId, #armId, #accommodationId, #statusId"
    ).removeClass("issue");

    if (!surName) {
      $("#surName").addClass("issue");
      _actionAlert("Provide surname to continue", false);
      return;
    }

    if (!firstName) {
      $("#firstName").addClass("issue");
      _actionAlert("Provide first name to continue", false);
      return;
    }

    if (!genderId) {
      $("#genderId").addClass("issue");
      _actionAlert("Select gender to continue", false);
      return;
    }

    if (!maritalStatusId) {
      $("#maritalStatusId").addClass("issue");
      _actionAlert("Select marital status to continue", false);
      return;
    }

    if (!dateOfBirth) {
      $("#dateOfBirth").addClass("issue");
      _actionAlert("Provide date of birth to continue", false);
      return;
    }

    if (!countryId) {
      $("#countryId").addClass("issue");
      _actionAlert("Select country to continue", false);
      return;
    }

    if (!stateId) {
      $("#stateId").addClass("issue");
      _actionAlert("Select state to continue", false);
      return;
    }

    if (!lgaId) {
      $("#lgaId").addClass("issue");
      _actionAlert("Select LGA to continue", false);
      return;
    }

    if (!address) {
      $("#address").addClass("issue");
      _actionAlert("Provide address to continue", false);
      return;
    }

    if (
      email &&
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)
    ) {
      $("#email").addClass("issue");
      _actionAlert("Provide correct email to continue", false);
      return;
    }

    if (
      fatherEmail &&
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(fatherEmail)
    ) {
      $("#fatherEmail").addClass("issue");
      _actionAlert("Provide father's correct email to continue", false);
      return;
    }

    if (
      motherEmail &&
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(motherEmail)
    ) {
      $("#motherEmail").addClass("issue");
      _actionAlert("Provide mother's correct email to continue", false);
      return;
    }

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

    if (!accommodationId) {
      $("#accommodationId").addClass("issue");
      _actionAlert("Select accommodation status to continue", false);
      return;
    }

    if (!statusId) {
      $("#statusId").addClass("issue");
      _actionAlert("Select status to continue", false);
      return;
    }

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#updateBtn").html();
      $("#updateBtn").html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      $("#updateBtn").prop("disabled", true);

      const formData = new FormData();
      formData.append("surName", surName);
      formData.append("firstName", firstName);
      formData.append("otherNames", otherNames);
      formData.append("genderId", genderId);
      formData.append("maritalStatusId", maritalStatusId);
      formData.append("dateOfBirth", dateOfBirth);
      formData.append("countryId", countryId);
      formData.append("stateId", stateId);
      formData.append("lgaId", lgaId);
      formData.append("address", address);
      formData.append("email", email);
      formData.append("mobileNumber", mobileNumber);
      formData.append("fatherTitleId", fatherTitleId);
      formData.append("fatherSurName", fatherSurName);
      formData.append("fatherOtherNames", fatherOtherNames);
      formData.append("fatherAddress", fatherAddress);
      formData.append("fatherEmail", fatherEmail);
      formData.append("fatherMobileNumber", fatherMobileNumber);
      formData.append("fatherDayOfBirth", fatherDayOfBirth);
      formData.append("fatherMonthOfBirth", fatherMonthOfBirth);
      formData.append("fatherOccupation", fatherOccupation);
      formData.append("motherTitleId", motherTitleId);
      formData.append("motherSurName", motherSurName);
      formData.append("motherOtherNames", motherOtherNames);
      formData.append("motherAddress", motherAddress);
      formData.append("motherEmail", motherEmail);
      formData.append("motherMobileNumber", motherMobileNumber);
      formData.append("motherDayOfBirth", motherDayOfBirth);
      formData.append("motherMonthOfBirth", motherMonthOfBirth);
      formData.append("motherOccupation", motherOccupation);
      formData.append("officialStudentId", officialStudentId);
      formData.append("departmentId", departmentId);
      formData.append("classId", classId);
      formData.append("armId", armId);
      formData.append("accommodationId", accommodationId);
      formData.append("statusId", statusId);

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/students/update-student?branchId=${getEachBranchStudentsSession.branchId}&studentId=${getEachBranchStudentsSession.studentId}`,
        data: formData,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        headers: getAuthHeaders(true),
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success === true) {
            _actionAlert(message, true);
           	_proceedFetchBranchStudents(departmentId, classId, armId);
            _alertClose(2);
          } else {
            _actionAlert(message, false);
          }
          $("#updateBtn").html(btn_text).prop("disabled", false);
        },
        error: function () {
          _actionAlert(
            "An error occurred while processing your request! Please Try Again",
            false
          );
          $("#updateBtn").html(btn_text).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $("#updateBtn").prop("disabled", false);
  }
}

function _updateStudentPix() {
  getEachBranchStudentsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchStudentsSession")
  );
  try {
    var passport = document.getElementById("passport").src;

    const formData = new FormData();
    formData.append("passport", passport);
    $.ajax({
      type: "POST",
      url: `${endPoint}/admin/branch/students/update-student-picture?branchId=${getEachBranchStudentsSession.branchId}&studentId=${getEachBranchStudentsSession.studentId}`,

      data: formData,
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const success = info.success;
        const message = info.message;

        if (success === true) {
          const data = info.data[0];
          const oldPassportName = data.oldPassportName;
          const newPassportName = data.studentData[0].passport;
          if (newPassportName != "default.jpg") {
            _uploadStudentPicture(oldPassportName, newPassportName, message);
          }
        } else {
          _actionAlert(message, false);
        }
      },
      error: function (error) {
        _actionAlert(
          "An error occurred while processing your request! Please Try Again",
          false
        );
      },
    });
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
  }
}

function _searchBranchStudents() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );

  const q = $("#q").val();
  $("#q").removeClass("issue");

  if (!q) {
    $("#q").addClass("issue");
    _actionAlert("Provide student information to continue", false);
    return;
  }

  $("#pageContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader student-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>'
    )
    .fadeIn("fast");

  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/students/search-student?q=${q}&branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const success = info.success;
        const message = info.message;

        if (success === true) {
          _getSearchStudents(success, fetch, message);
        } else {
          _getSearchStudents(false, [], message);
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

function _getSearchStudents(success, fetch, message) {
  let text = "";
  let no = 0;
  text = `
		<thead>
			<tr class="tb-col">
				<th>sn</th>
				<th>Student Info</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Department</th>
				<th>Class</th>
				<th>Arm</th>
				<th>Accomodation</th>
				<th>Status</th>
				<th>View</th>
			</tr>
		</thead>`;

  if (success === true) {
    for (let i = 0; i < fetch.length; i++) {
      no++;
      const branchId = fetch[i].branchId;
      const departmentId = fetch[i].departmentId;
      const classId = fetch[i].classId;
      const armId = fetch[i].armId;

      const fetchStudentData = fetch[i];
      const fetchDepartmentData = fetch[i].departmentData;
      const fetchClassData = fetch[i].classData;
      const fetchArmData = fetch[i].armData;
      const fetchAccommodationData = fetch[i].accommodationData;

      const studentId = fetchStudentData.studentId;
      const passport = fetchStudentData.passport || "default.jpg";
      const surName = fetchStudentData.surName;
      const firstName = fetchStudentData.firstName;
      const otherNames = fetchStudentData.otherNames;
      const fullname = surName + " " + firstName + " " + otherNames;
      const genderName = fetchStudentData.genderName;
      const departmentName = fetchDepartmentData.departmentName;
      const className = fetchClassData.className;
      const armName = fetchArmData.armName;
      const statusId = fetchStudentData.statusId;
      const statusName = fetchStudentData.statusName;
      const accommodationName = fetchAccommodationData.accommodationName;
      const age = _calculateAge(fetchStudentData.dateOfBirth);

      text += `
				<tbody>
					<tr class="tb-row">
						<td>${no}</td>
						<td>
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
						<td>${genderName}</td>
						<td>${age}</td>
						<td>${departmentName}</td>
						<td>${className}</td>
						<td>${armName}</td>
						<td>${accommodationName}</td>
						<td><div class="status-div ${statusName}">${statusName}</div></td>
						<td><button class="btn view-btn" title="Click to view student profile" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','${statusId}');">VIEW</button></td>
					</tr>
				</tbody>`;
    }
    $("#pageContent").html(text);
  } else {
    text += `
			<tbody>
				<tr>
					<td colspan="15">
						<div class="false-notification-div">
							<p>${
                message
                  ? message
                  : "No student records to display yet. Please search to begin."
              }</p>
						</div>
					</td>
				</tr>
			</tbody>`;
    $("#pageContent").html(text);
  }
}

function _fetchPaymentHistory() {
  let getEachBranchStudentsSession = JSON.parse(sessionStorage.getItem("getEachBranchStudentsSession"));
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	try {

		const formData = {
			"studentId": getEachBranchStudentsSession?.studentData?.studentId,
			"branchId": getEachBranchDetailsSession?.branchId,
			"departmentId": getEachBranchStudentsSession?.departmentData?.departmentId,
			"classId": getEachBranchStudentsSession?.classData?.classId,
			"armId": getEachBranchStudentsSession?.armData?.armId
		};

		$.ajax({
			type: "POST",
			url: `${endPoint}/parent/payment/fetch-payment-history`,
			data: JSON.stringify(formData),
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			processData: false,
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				let text = '';
				let no=0;

				if (success===true) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const fetchedPayment = fetch[i];
						const paymentId = fetchedPayment.paymentId;
						const studentId = fetchedPayment.studentId;
						const branchId = fetchedPayment.branchId;
						const departmentId = fetchedPayment.departmentData.departmentId;
						const currentTerm = fetchedPayment.termData.currentTerm;
						const termId = fetchedPayment.termData.termId;
						const session = fetchedPayment.session;
						const className = fetchedPayment.classData.className;
						const classId = fetchedPayment.classData.classId;
						const armName = fetchedPayment.armData.armName;
						const armId = fetchedPayment.armData.armId;
						const totalAmount = thousandSeperator(fetchedPayment.totalAmount);
						const paymentMethodName = fetchedPayment.paymentMethodData.paymentMethodName;
						const statusName = fetchedPayment.statusData.statusName;
						const createdTime = fetchedPayment.createdTime;
						const paydate = fetchedPayment.paydate ? fetchedPayment.paydate : createdTime;

						text +=`
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td>${paydate}</td>
								<td><span onclick="_viewPaymentDetails('${session}','${termId}','${studentId}','${branchId}','${departmentId}','${classId}','${armId}');">${paymentId}</span></td>
								<td>
									<div class="text-div">
										<div>${session}</div> 
										<div>${currentTerm}</div>
									</div>
								</td>
								<td>
									<div class="text-div">
										<div>${className} ${armName}</div>
									</div>
								</td>
								<td><span><s>N</s>${totalAmount}</span></td>
								<td>${paymentMethodName}</td>
								<td><div class="status-div ${statusName}">${statusName}</div></td>
							</tr>
						</tbody>`;
					}
					$('#pageContent2').html(text);
				} else {
					_actionAlert(info.message, false);
					text += `
						tbody>
							<tr>
								<td colspan="11">
									<div class="false-notification-div">
										<p>${info.message}</p>
									</div>
								</td>
							</tr>
						</tbody>`;
					$('#pageContent2').html(text);

					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchStudentCurrentPayableFees() {
  let getEachBranchStudentsSession = JSON.parse(sessionStorage.getItem("getEachBranchStudentsSession"));
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

  const departmentId= getEachBranchStudentsSession?.departmentData?.departmentId;
  const classId= getEachBranchStudentsSession?.classData?.classId;
  const armId= getEachBranchStudentsSession?.armData?.armId;
  const studentId= getEachBranchStudentsSession?.studentId;

  try {
    $("#get-more-third-layer")
      .css({
        display: "flex",
        "justify-content": "center",
        "align-items": "center",
      })
      .fadeIn(500);

    $.ajax({
      type: "GET",
      url:`${endPoint}/admin/branch/account/fetch-student-current-payable-fees?branchId=${getEachBranchDetailsSession?.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success) {
          sessionStorage.setItem("studentCurrentPayableFeesSession", JSON.stringify(info));
					_getForm({page: 'payableFess', layer:3, url: adminPortalLocalUrl});
        } else {
          _actionAlert(info.message, false);
          _alertClose(3);
          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function () {
        _actionAlert(
          "Unable to reach the server. Please check your connection.",
          false
        );
        _alertClose(3);
      },
    });
  } catch (error) {
    console.error("Unexpected error:", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
    _alertClose(3);
  }
}

function _updateStudentMandatoryFess() {
  let getEachBranchStudentsSession = JSON.parse(sessionStorage.getItem("getEachBranchStudentsSession"));
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

  const departmentId= getEachBranchStudentsSession?.departmentData?.departmentId;
  const classId= getEachBranchStudentsSession?.classData?.classId;
  const armId= getEachBranchStudentsSession?.armData?.armId;
  const studentId= getEachBranchStudentsSession?.studentId;

	try {
    let selectedFees = [];

    $(".child:checked").each(function () {
      const feesId = $(this).data("value");
      selectedFees.push({ feesId: feesId });
    });

    if (selectedFees.length === 0) {
      _actionAlert("Please select at least one fee to continue.", false);
      return;
    }

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btnText = $("#submitBtn").html();
      $("#submitBtn").html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      $("#submitBtn").prop("disabled", true);

      const formData = {
        feesIds: selectedFees,
      };

      $.ajax({
        type: "POST",
        url:`${endPoint}/admin/branch/account/update-student-mandatory-fees?branchId=${getEachBranchDetailsSession?.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
        data: JSON.stringify(formData),
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        processData: false,
        success: function(info) {
          const success = info.success;
          const message = info.message;

          if (success === true) {
            _actionAlert(message, true);
            _fetchStudentCurrentPayableFees();
          } else {
            _actionAlert(message, false);
          }
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
        error: function(textStatus, errorThrown) {
          console.error("AJAX Error: ", textStatus, errorThrown);
          _actionAlert('Check your internet connection and try again.', false);
          $("#submitBtn").html(btnText).prop("disabled", false);
        }
      });
    }
    } catch (error) {
      console.error("Error: ", error);
      _actionAlert('An unexpected error occurred! Please try again.', false);
      $("#submitBtn").html(btnText).prop("disabled", false);
    }
}

function _deleteMandatoryFees(feesId) {

  let getEachBranchStudentsSession = JSON.parse(sessionStorage.getItem("getEachBranchStudentsSession"));
  let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

  const departmentId = getEachBranchStudentsSession?.departmentData?.departmentId;
  const classId = getEachBranchStudentsSession?.classData?.classId;
  const armId = getEachBranchStudentsSession?.armData?.armId;
  const studentId = getEachBranchStudentsSession?.studentId;

  try {
    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {

      const formData = { feesId: feesId };

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/account/delete-student-mandatory-fees?branchId=${getEachBranchDetailsSession?.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
        data: JSON.stringify(formData),
        contentType: "application/json",
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        processData: false,
        success: function(info) {
          const { success, message } = info;

          if (success === true) {
            _actionAlert(message, true);
            _fetchStudentCurrentPayableFees();
          } else {
            _actionAlert(message, false);
          }
        },
        error: function(xhr, textStatus, errorThrown) {
          console.error("AJAX Error: ", textStatus, errorThrown);
          _actionAlert('An error occurred while sending data! Please try again.', false);
        }
      });
    }
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert('An unexpected error occurred! Please try again.', false);
  }
}

function _fetchBranchArchivedStudents() {
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
      url: `${endPoint}/admin/branch/students/fetch-student-archived?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const success = info.success;
        const message = info.message;

        let text = "";
        let no = 0;
        text = `
					<thead>
						<tr class="tb-col">
							<th>sn</th>
							<th>Student Info</th>
							<th>Gender</th>
							<th>Age</th>
							<th>Session</th>
							<th>Department</th>
							<th>Class</th>
							<th>Arm</th>
							<th>Accomodation</th>
							<th>Status</th>
							<th>View</th>
						</tr>
					</thead>`;

        if (success === true) {

          let showButtons = `
            <button class="btn" title="PRINT RECORDS" onclick="_printStudentByClass('${fetch[0].departmentData.departmentId}','${fetch[0].classData.classId}','${fetch[0].armData.armId}');">
              <i class="bi-printer"></i> PRINT
            </button>
            <button class="btn" title="EXPORT RECORDS" onclick="_exportStudents('${fetch[0].session}','${fetch[0].departmentData.departmentName}','${fetch[0].classData.className}','${fetch[0].armData.armName}');">
              <i class="bi-file-earmark-excel"></i> EXPORT
            </button>`;
          $("#printAndExportButton").html(showButtons);

          for (let i = 0; i < fetch.length; i++) {
            no++;
            const branchId = fetch[i].branchId;
            const departmentId = fetch[i].departmentId;
            const classId = fetch[i].classId;
            const armId = fetch[i].armId;
            const session = fetch[i].session;
            const statusId = fetch[i].statusId;

            const fetchStudentData = fetch[i].studentData;
            const fetchDepartmentData = fetch[i].departmentData;
            const fetchClassData = fetch[i].classData;
            const fetchArmData = fetch[i].armData;
            const fetchAccommodationData = fetch[i].accommodationData;

            const studentId = fetchStudentData.studentId;
            const passport = fetchStudentData.passport || "default.jpg";
            const surName = fetchStudentData.surName;
            const firstName = fetchStudentData.firstName;
            const otherNames = fetchStudentData.otherNames;
            const fullname = surName + " " + firstName + " " + otherNames;
            const genderName = fetchStudentData.genderName;
            const departmentName = fetchDepartmentData.departmentName;
            const className = fetchClassData.className;
            const armName = fetchArmData.armName;
            const statusName = fetchStudentData.statusName;
            const accommodationName = fetchAccommodationData.accommodationName;
            const age = _calculateAge(fetchStudentData.dateOfBirth);

            text += `
						 	<tbody>
								<tr class="tb-row">
									<td>${no}</td>
									<td class="clickable-td" title="Click to view student details" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','${statusId}');">
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
									<td>${genderName}</td>
									<td>${age}</td>
									<td>${session}</td>
									<td>${departmentName}</td>
									<td>${className}</td>
									<td>${armName}</td>
									<td>${accommodationName}</td>
									<td><div class="status-div ${statusName}">${statusName}</div></td>
									<td><button class="btn view-btn" title="Click to view student profile" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','${statusId}');">VIEW</button></td>
								</tr>
							</tbody>`;
          }
          $("#pageContent").html(text);
        } else {
          _actionAlert(message, false);

          text += `
						<tbody>
							<tr>
								<td colspan="15">
									<div class="false-notification-div">
										<p>${message}</p>
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