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
    "#student_profile_details, #studentTranscriptPage, #student_activities, #student_report, #studentPaymentHistory, #studentFundHistory, #studentDiscountScholarship",
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

$(function () {
  studentPixPreview = {
    UpdatePreview: function (obj, action = "register") {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
        return;
      }

      const file = obj.files[0];
      const maxSize = 300 * 1024; // 300KB

      if (file.size > maxSize) {
        if (action === "updateStudentPix") {
          document.getElementById("cam-pix").innerHTML =
            `<img id="passport" src="${websiteUrl}/uploaded_files/studentPix/default.jpg" />`;
        } else {
          document.getElementById("cam-pix").innerHTML =
            `<img id="passport" src="${websiteUrl}/images/sample.jpg" />`;
        }
        _actionAlert(
          "Image is too large! Maximum allowed size is 300KB.",
          false,
        );
        return;
      }

      var reader = new FileReader();

      reader.onload = function (e) {
        document.getElementById("cam-pix").innerHTML =
          '<img id="passport" src="' + e.target.result + '"/>';

        if (action === "updateStudentPix") {
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
                "</li>",
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

function _getSelectDepartment(fieldId, isAlumni = false) {
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/department/fetch-branch-departments?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        if (info.success === true) {
          $("#searchList_" + fieldId).html("");
          for (let i = 0; i < data.length; i++) {
            if (data[i].checked) {
              const id = data[i].departmentId;
              const value = data[i].departmentName;

              $("#searchList_" + fieldId).append(`
                <li onclick="
                  _clickOption(
                    'searchList_${fieldId}',
                    '${id}',
                    '${value}'
                  );
                  _getSelectDepartmentClass(
                    'classId',
                    ${isAlumni}
                  );
                ">
                  ${value}
                </li>
              `);
            }
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error(error);
  }
}

function _fetchSelectDepartmentClass() {
  _getSelectDepartmentClass('classId', isAlumni);
}

function _getSelectDepartmentClass(fieldId, isAlumni = false) {
  const departmentId = $("#departmentId").val();
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/settings/departments/fetch-department-classes?departmentId=${departmentId}${isAlumni ? "&isAlumni=true" : ""}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        if (info.success === true) {
          $("#searchList_" + fieldId).html("");
          const checkedClasses = data.filter(
            item => item.checked === true
          );
          for (let i = 0; i < checkedClasses.length; i++) {
            const id = checkedClasses[i].classId;
            const value = checkedClasses[i].className;

            $("#searchList_" + fieldId).append(`
              <li onclick="
                _clickOption(
                  'searchList_${fieldId}',
                  '${id}',
                  '${value}'
                );

                _fetchSelectDepartmentClassArm();
              ">
                ${value}
              </li>
            `);
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error(error);
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
                "</li>",
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
    sessionStorage.getItem("getEachBranchDetailsSession"),
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
      "#surName, #firstName, #genderId, #maritalStatusId, #dateOfBirth, #countryId, #stateId, #lgaId, #address, #email, #mobileNumber, #fatherEmail, #motherEmail, #departmentId, #classId, #armId, #accommodationId, #statusId",
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
          '/images/loading.gif" width="12px" alt="Loading"/>',
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
            $("#submitBtn").html(btn_text).prop("disabled", false);
          }
        },
        error: function () {
          _actionAlert(
            "An error occurred while processing your request! Please Try Again",
            false,
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
  $("#get-more-third-layer")
    .html(
      `
      <div class="alert-loading-div">
          <div class="icon">
              <img src="${websiteUrl}/images/loading.gif" width="20px" alt="Uploading"/>
          </div> 
          <div class="text">
              <p>UPLOADING STUDENT PICTURE! PLEASE WAIT...</p>
          </div>
      </div>
    `,
    )
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);

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
      $("#get-more-third-layer").fadeOut();
    },
  });
  $("#get-more-third-layer").fadeOut();
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
    JSON.stringify(fetchStudentsParams),
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
    sessionStorage.getItem("fetchStudentsParams"),
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  $("#branchStudentpageContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>',
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
					<button class="btn" title="EXPORT RECORDS" onclick="exportAccountTableToExcel('pageContent','Student_List');">
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
							<th>Accommodation</th>
							<th>Status</th>
							<th>View</th>
						</tr>
					</thead>`;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const branchId = fetch[i]?.branchId;
            const departmentId = fetch[i]?.departmentId;
            const classId = fetch[i]?.classId;
            const armId = fetch[i]?.armId;

            const fetchStudentData = fetch[i]?.studentData;
            if (!fetchStudentData) continue;
            const fetchDepartmentData = fetch[i]?.departmentData;
            const fetchClassData = fetch[i]?.classData;
            const fetchArmData = fetch[i]?.armData;
            const fetchAccommodationData = fetch[i]?.accommodationData;

            const studentId = fetchStudentData?.studentId;
            const passport = fetchStudentData?.passport || "default.jpg";
            const surName = fetchStudentData?.surName;
            const firstName = fetchStudentData?.firstName;
            const otherNames = fetchStudentData?.otherNames;
            const fullname = surName + " " + firstName + " " + otherNames;
            const genderName = fetchStudentData?.genderName;
            const departmentName = fetchDepartmentData?.departmentName;
            const className = fetchClassData?.className;
            const armName = fetchArmData?.armName;
            const statusName = fetchStudentData?.statusName;
            const accommodationName = fetchAccommodationData?.accommodationName;
            const age = _calculateAge(fetchStudentData?.dateOfBirth);

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
          $("#branchStudentpageContent").html(text);
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
          $("#branchStudentpageContent").html(text);

          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert("Check your internet connection and try again.", false);
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
  statusId,
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
            JSON.stringify(info.data[0]),
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
        _actionAlert("Check your internet connection and try again.", false);
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
    sessionStorage.getItem("getEachBranchStudentsSession"),
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
      "#surName, #firstName, #genderId, #maritalStatusId, #dateOfBirth, #countryId, #stateId, #lgaId, #address, #email, #mobileNumber, #fatherEmail, #motherEmail, #departmentId, #classId, #armId, #accommodationId, #statusId",
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
          '/images/loading.gif" width="12px" alt="Loading"/>',
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
            false,
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
    sessionStorage.getItem("getEachBranchStudentsSession"),
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
          false,
        );
      },
    });
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
  }
}

function _searchBranchStudents() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
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
        '/images/spinner.gif" alt="Loading"/></div>',
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
        _actionAlert("Check your internet connection and try again.", false);
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
				<th>Accommodation</th>
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
  let getEachBranchStudentsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchStudentsSession"),
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  try {
    const formData = {
      studentId: getEachBranchStudentsSession?.studentData?.studentId,
      branchId: getEachBranchDetailsSession?.branchId,
      departmentId: getEachBranchStudentsSession?.departmentData?.departmentId,
      classId: getEachBranchStudentsSession?.classData?.classId,
      armId: getEachBranchStudentsSession?.armData?.armId,
    };

    $.ajax({
      type: "POST",
      url: `${endPoint}/parent/payment/fetch-payment-history`,
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      processData: false,
      success: function (info) {
        const fetch = info.data;
        const success = info.success;

        let text = "";
        let no = 0;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const fetchedPayment = fetch[i];
            const paymentId = fetchedPayment.paymentId;
            const currentTerm = fetchedPayment.termData.currentTerm;
            const session = fetchedPayment.session;
            const className = fetchedPayment.classData.className;
            const armName = fetchedPayment.armData.armName;
            const totalAmount = thousandSeperator(fetchedPayment.totalAmount);
            const paymentMethodName =
              fetchedPayment.paymentMethodData.paymentMethodName;
            const statusName = fetchedPayment.statusData.statusName;
            const createdTime = fetchedPayment.createdTime;
            const paydate = fetchedPayment.paydate
              ? fetchedPayment.paydate
              : createdTime;

            text += `
							<tr class="tb-row">
								<td>${no}</td>
								<td>${paydate}</td>
								<td><span>${paymentId}</span></td>
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
							</tr>`;
          }
          $("#transactionHistoryContent").html(text);
        } else {
          _actionAlert(info.message, false);
          text += `
							<tr>
								<td colspan="11">
									<div class="false-notification-div">
										<p>${info.message}</p>
									</div>
								</td>
							</tr>`;
          $("#transactionHistoryContent").html(text);

          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _fetchStudentCurrentPayableFees() {
  let getEachBranchStudentsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchStudentsSession"),
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const departmentId =
    getEachBranchStudentsSession?.departmentData?.departmentId;
  const classId = getEachBranchStudentsSession?.classData?.classId;
  const armId = getEachBranchStudentsSession?.armData?.armId;
  const studentId = getEachBranchStudentsSession?.studentId;

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
      url: `${endPoint}/admin/branch/account/fetch-student-current-payable-fees?branchId=${getEachBranchDetailsSession?.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success) {
          sessionStorage.setItem(
            "studentCurrentPayableFeesSession",
            JSON.stringify(info),
          );
          _getForm({ page: "payableFess", layer: 3, url: adminPortalLocalUrl });
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
          false,
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
  let getEachBranchStudentsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchStudentsSession"),
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const departmentId =
    getEachBranchStudentsSession?.departmentData?.departmentId;
  const classId = getEachBranchStudentsSession?.classData?.classId;
  const armId = getEachBranchStudentsSession?.armData?.armId;
  const studentId = getEachBranchStudentsSession?.studentId;

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
          '/images/loading.gif" width="12px" alt="Loading"/>',
      );
      $("#submitBtn").prop("disabled", true);

      const formData = {
        feesIds: selectedFees,
      };

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/account/update-student-mandatory-fees?branchId=${getEachBranchDetailsSession?.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
        data: JSON.stringify(formData),
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        processData: false,
        success: function (info) {
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
        error: function (textStatus, errorThrown) {
          console.error("AJAX Error: ", textStatus, errorThrown);
          _actionAlert("Check your internet connection and try again.", false);
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
    $("#submitBtn").html(btnText).prop("disabled", false);
  }
}

function _deleteMandatoryFees(feesId) {
  let getEachBranchStudentsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchStudentsSession"),
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const departmentId =
    getEachBranchStudentsSession?.departmentData?.departmentId;
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
        success: function (info) {
          const { success, message } = info;

          if (success === true) {
            _actionAlert(message, true);
            _fetchStudentCurrentPayableFees();
          } else {
            _actionAlert(message, false);
          }
        },
        error: function (xhr, textStatus, errorThrown) {
          console.error("AJAX Error: ", textStatus, errorThrown);
          _actionAlert(
            "An error occurred while sending data! Please try again.",
            false,
          );
        },
      });
    }
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _fetchBranchArchivedStudents() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  $("#pageContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>',
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
							<th>Accommodation</th>
							<th>Status</th>
							<th>View</th>
						</tr>
					</thead>`;

        if (success === true) {
          let showButtons = `
            <button class="btn" title="EXPORT RECORDS" onclick="exportAccountTableToExcel('pageContent','Archived_Students_List');">
              <i class="bi-file-earmark-excel"></i> EXPORT
            </button>`;
          $("#printAndExportButton").html(showButtons);
          
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const branchId = fetch[i]?.branchId;
            const departmentId = fetch[i]?.departmentId;
            const classId = fetch[i]?.classId;
            const armId = fetch[i]?.armId;
            const session = fetch[i]?.session;
            const statusId = fetch[i]?.statusId;

            const fetchStudentData = fetch[i]?.studentData;
            const fetchDepartmentData = fetch[i]?.departmentData;
            const fetchClassData = fetch[i]?.classData;
            const fetchArmData = fetch[i]?.armData;
            const fetchAccommodationData = fetch[i]?.accommodationData;

            const studentId = fetchStudentData?.studentId;
            const passport = fetchStudentData?.passport || "default.jpg";
            const surName = fetchStudentData?.surName;
            const firstName = fetchStudentData?.firstName;
            const otherNames = fetchStudentData?.otherNames;
            const fullname = surName + " " + firstName + " " + otherNames;
            const genderName = fetchStudentData?.genderName;
            const departmentName = fetchDepartmentData?.departmentName;
            const className = fetchClassData?.className;
            const armName = fetchArmData?.armName;
            const statusName = fetchStudentData?.statusName;
            const accommodationName = fetchAccommodationData?.accommodationName;
            const age = _calculateAge(fetchStudentData?.dateOfBirth);

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
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

///// Get Select Alumni Session ////
function _getSelectAlumniSession(fieldId){
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/preset-data/fetch-alumni-session?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].session;
						const value = data[i].session;
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

//// Proceed Fetch Alumni Students /////
function _proceedviewAlumniStudents() {
  const session = $("#alumniSession").val().trim();

  // Get the selected text (name)
  const sessionName = $("#alumniSession option:selected").text();

  let issueCount = 0;
  issueCount += _validateEmptyValue("alumniSession", "SESSION");

  if (issueCount > 0) return;

  const fetchAlumniStudentsParams = {
    session: session,
    sessionName: sessionName,
  };

  sessionStorage.setItem(
    "fetchAlumniStudentsParams",
    JSON.stringify(fetchAlumniStudentsParams),
  );

  _getActiveBranchPage({
    divid: "branchAlumniStudentsPage",
    page: "branchAlumniStudentsPage",
    url: adminPortalLocalUrl,
  });
  _alertClose(2);
}

//// Fetch Alumni Department Classes ////
function _fetchBranchAlumniDepartmentClasses() {
    const getEachBranchDetailsSession = JSON.parse(
      sessionStorage.getItem("getEachBranchDetailsSession")
    );
    const fetchAlumniStudentsParams = JSON.parse(
      sessionStorage.getItem("fetchAlumniStudentsParams")
    );

    const branchId = getEachBranchDetailsSession?.branchId;
    const alumniSession = fetchAlumniStudentsParams?.session;

    $('#alumniPageContent').html(`
      <div class="ajax-loader pages-ajax-loader">
        <img src="${websiteUrl}/images/spinner.gif" alt="Loading"/>
      </div>
    `).fadeIn("fast");

    try {
      $.ajax({
          type: "GET",
          url: `${endPoint}/admin/branch/students/fetch-alumni-class?branchId=${branchId}&alumniSession=${alumniSession}`,
          dataType: "json",
          cache: false,
          headers: getAuthHeaders(true),
          success: function (info) {
              const fetch = info.data;
              const success = info.success;
              const alumniSession = info.alumniSession;

              let mainContent = '';
              let no = 0;

              if (success === true) {
                  for (let i = 0; i < fetch.length; i++) {
                      no++;
                      const department = fetch[i];
                      const departmentName = department.departmentName;
                      const departmentId = department.departmentId;
                      const classData = department.classData;
                      const classId = classData?.classId;
                      const className = classData?.className;
                      const armData = department.armData;

                      let innerContent = '';
                      let sn = 0;
                      if (armData.length > 0) {
                        for (let k = 0; k < armData.length; k++) {
                          sn++;
                          const armInfo = armData[k];
                          const armName = armInfo.armName;
                          const armId = armInfo.armId;

                          innerContent += `
                              <tr class="tb-row">
                                  <td>${sn}</td>
                                  <td>${departmentName}</td>
                                  <td>${className} ${armName}</td>
                                  <td>${alumniSession}</td>

                                  <td>
                                      <div class="btn-div">
                                          <button 
                                              class="btn view-btn"
                                              id="proceedBtn_${classId}_${armId}"
                                              title="Click to view alumni students"
                                              onclick="_fetchAlumniStudentsByClass('${alumniSession}','${departmentId}','${classId}','${armId}');"
                                          >
                                              <i class="bi-printer"></i>
                                              PROCEED TO VIEW ALUMNI STUDENTS
                                          </button>
                                      </div>
                                  </td>
                              </tr>
                          `;
                        }
                      } else {
                        innerContent += `
                        <tr class="tb-row">
                          <td>1</td>
                          <td>${departmentName}</td>
                          <td>${className} (No Arm)</td>
                          <td>${alumniSession}</td>

                          <td>
                              <div class="false-notification-div">
                                  No Class Arm Found
                              </div>
                          </td>
                        </tr>
                        `;
                      }

                      mainContent += `
                        <div class="pages-toggle-div">
                          <div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view classess">
                            <h3>${departmentName} (${className})</h3>
                            <div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
                          </div>

                          <div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
                            <div class="table-div animated fadeIn">
                              <table class="table" cellspacing="0" style="width:100%">
                                <thead>
                                  <tr class="tb-col">
                                    <th>sn</th>
                                    <th>Department</th>
                                    <th>Class</th>
                                    <th>Session</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                
                                <tbody>
                                  ${innerContent}
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      `;
                  }

                $('#alumniPageContent').html(mainContent);
              } else {
                _actionAlert(info.message, false);
                $('#alumniPageContent').html(`
                  <div class="false-notification-div">
                      <p>${info.message}</p>
                  </div>
                `);

                if (info.response < 100) {
                    _logOut();
                }
              }
          },
          error: function (textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
            _actionAlert(
                'Check your internet connection and try again.',
                false
            );
          }
      });
    } catch (error) {
      console.error("Error:", error);
      _actionAlert(
          'An unexpected error occurred! Please try again.',
          false
      );
    }
}

///// Fetch Alumni Students By Class /////
function _fetchAlumniStudentsByClass(alumniSession, departmentId, classId, armId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  try {
	const btnText = $(`#proceedBtn_${classId}_${armId}`).html();
    _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, true);
	
    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/students/fetch-alumni-students?branchId=${branchId}&alumniSession=${alumniSession}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success=== true) {
          sessionStorage.setItem(
            "useAlumniStudentByClassSession",
            JSON.stringify(response),
          );
          _getForm({page: 'alumniStudentByClassModal', layer: 2, url: adminPortalLocalUrl})
        } else {
          _alertClose(2);
          _actionAlert(response.message, false);
		      _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
        }
		    _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
      })
      .catch((error) => {
        _alertClose(2);
        console.error("Error:", error);
        _callAjaxError(() =>
          _fetchAlumniStudentsByClass(alumniSession, departmentId, classId, armId),
        ); // retry if needed
		    _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
      });
  } catch (error) {
    _alertClose(2);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchAlumniStudentsByClass(alumniSession, departmentId, classId, armId),
    ); // retry if needed
	  _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
  }
}

/// filter Alumni Students Data ///
function _filtersAlumniStudents(value) {
  $("#fetchAlumiStudentPageContent .tb-row").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

//// Print Alumni Students By Class ////
function _printAlumniStudentByClass(alumniSession, departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
  const branchId = getEachBranchDetailsSession?.branchId;

	try {
		const btnText = $("#printAlumniBtn").html();
		$("#printAlumniBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printAlumniBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/students/fetch-alumni-students?branchId=${branchId}&alumniSession=${alumniSession}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printAlumniStudentByClassSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-alumni-student-by-class`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printAlumniBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#printAlumniBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printAlumniBtn").prop("disabled", false);
	}
}

///// Fetch Alumni Students By Class /////
function _fetchEachBranchAlumniStudents(branchId, alumniSession, departmentId, classId, armId, studentId) {
  $("#get-more-third-layer")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    }).fadeIn(500);

  try {
    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/students/fetch-alumni-students?branchId=${branchId}&alumniSession=${alumniSession}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success=== true) {
          sessionStorage.setItem(
            "getEachBranchStudentsSession",
            JSON.stringify(response.data[0]),
          );

          _getForm({
            page: "student_profile",
            layer: 3,
            url: adminPortalLocalUrl,
          });
        } else {
          _alertClose(3);
          _actionAlert(response.message, false);
        }
      })
      .catch((error) => {
        _alertClose(3);
        console.error("Error:", error);
        _callAjaxError(() =>
          _fetchEachBranchAlumniStudents(departmentId, classId, armId, studentId),
        ); // retry if needed
      });
  } catch (error) {
    _alertClose(3);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchEachBranchAlumniStudents(departmentId, classId, armId, studentId),
    ); // retry if needed
  }
}

//// Fetch Student Class Transcript  Data ////
function _fetchStudentClassTranscriptData () {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/publish/faq/fetch-faq`,
			accessKey: true,
		})
		.then((response) => {
      _staffValidationCheck(response.response);
      if (response.success === true) {
        _initFetchStudentClassTranscriptData(response.data);
      } else {
        $('#transcriptClassPageContent').html(`
					<div class="false-notification-div">
						<p>${response.message}</p>
					</div>
				`);
      }
		})
		.catch((error) => {
			console.error("Error:", error);				
			_callAjaxError(() => _fetchStudentClassTranscriptData()); // retry if needed
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchStudentClassTranscriptData());
  }
}

/// Initialize Fetch Student Class Transcript Data ////
function _initFetchStudentClassTranscriptData(data) {
  	const content = data.map((item) => {
    return `
      <div class="pages-toggle-div">
        <div class="pages-toggle-title">
          <h3>JUNIOR</h3>
          <div class="btn-back-div">
              <button class="btn" title="PRINT TRANSCRIPT" id="" onclick="_printStudentTranscript();">
                <i class="bi-printer"></i> PRINT
              </button>
          </div>
        </div>
      </div>
    `;
  }).join("");
  $('#transcriptClassPageContent').html(content);
}

///// Print Student Transcript Data /////
function _printStudentTranscript(departmentId, classId, armId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  try {
	const btnText = $(`#proceedBtn_${classId}_${armId}`).html();
    _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, true);
	
    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/students/fetch-student?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success=== true) {
          sessionStorage.setItem(
            "usePrintStudentTranscriptSession",
            JSON.stringify(response),
          );
          window.open(`${websiteUrl}/reports/print-student-academic-transcript`, '_blank');
        } else {
          _alertClose(2);
          _actionAlert(response.message, false);
		     _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
        }
		    _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
      })
      .catch((error) => {
        _alertClose(2);
        console.error("Error:", error);
        _callAjaxError(() =>
          _printStudentTranscript(departmentId, classId, armId),
        ); // retry if needed
		  _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
    });
  } catch (error) {
    _alertClose(2);
    console.error("Error:", error);
    _callAjaxError(() =>
      _printStudentTranscript(departmentId, classId, armId),
    ); // retry if needed
	  _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
  }
}