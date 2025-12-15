function _getActiveBranchPage(props) {
  const { page = "", divid = "", pageContainer = "get_branch_details" } = props;
  _getBranchPagesActiveLink(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getBranchPagesActiveLink(divid) {
  $(
    "#branch_dashboard, #branch_settings, #branch_staff, #branch_department_class, #branch_subjects, #branch_profile, #branch_account, #branch_activities, #branch_subject_page"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

function _getActiveCommentNav(props) {
  const {
    page = "",
    divid = "",
    pageContainer = "getNavPage",
  } = props;
  _getCommentActiveNav(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getCommentActiveNav(divid) {
  $(
    "#malePage, #femalePage"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

$(function () {
  schoolLogoPixPreview = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        // Handle browsers that don't support FileReader
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();

        reader.onload = function (e) {
          $("#schoolLogoPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

$(function () {
  principalSignaturePixPreview = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        // Handle browsers that don't support FileReader
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();

        reader.onload = function (e) {
          $("#principalSignaturePreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

$(function () {
  midTermResultHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        // Handle browsers that don't support FileReader
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();

        reader.onload = function (e) {
          $("#midTermResultHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

$(function () {
  caResultSummaryHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        // Handle browsers that don't support FileReader
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();

        reader.onload = function (e) {
          $("#caResultSummaryHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

$(function () {
  caBroadSheetHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        // Handle browsers that don't support FileReader
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();

        reader.onload = function (e) {
          $("#caBroadSheetHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

$(function () {
  terminalBroadSheetHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        // Handle browsers that don't support FileReader
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();

        reader.onload = function (e) {
          $("#terminalBroadSheetHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

$(function () {
  classListHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#classListHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  cummulativeMarkBookHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#cummulativeMarkBookHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  markBookHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#markBookHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  progressReportHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#progressReportHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  scoreSheetHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#scoreSheetHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  studentListHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#studentListHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  subjectListHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#subjectListHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  terminalResultSummaryHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#terminalResultSummaryHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  terminalResultHeaderPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#terminalResultHeaderPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };

  watermarkPreviewPix = {
    UpdatePreview: function (obj) {
      if (!window.FileReader) {
        console.error("FileReader is not supported.");
      } else {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#watermarkPreviewPix").prop("src", e.target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


function _getSelectBranchManagerId(fieldId) {
  let $searchList = $("#searchList_" + fieldId);
  $searchList.html("<li>Loading data...</li>");

  try {
    $.ajax({
      type: "GET",
      url: endPoint + "/admin/staff/fetch-staff?statusId=1",
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;
        $searchList.empty();

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const managerFirstName = data[i].firstName;
            const managerLastName = data[i].lastName;
            const id = data[i].staffId;
            const value = managerFirstName + " " + managerLastName;
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

function _getSelectSchoolCategory(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: endPoint + "/preset-data/fetch-school-category",
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const id = data[i].schoolCategoryId;
            const value = data[i].schoolCategoryName;
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


function _createBranch() {
  try {
    const schoolCategoryId = $("#schoolCategoryId").val();
    const name = $("#name").val();
    const mobileNumber = $("#mobileNumber").val();
    const stateId = $("#stateId").val();
    const lgaId = $("#lgaId").val();
    const address = $("#address").val();
    const smtpHost = $("#smtpHost").val();
    const smtpUsername = $("#smtpUsername").val();
    const smtpPassword = $("#smtpPassword").val();
    const smtpPort = $("#smtpPort").val();
    const supportEmail = $("#supportEmail").val();
    const accountName = $("#accountName").val();
    const paymentKey = $("#paymentKey").val();
    const secretKey = $("#secretKey").val();
    const receiverKey = $("#receiverKey").val();
    const session = $("#session").val();
    const managerId = $("#staffId").val();
    const termId = $("#termId").val();
    const statusId = $("#statusId").val();

    $(
      "#schoolCategoryId, #name, #mobileNumber, #stateId, #lgaId, #address, #smtpHost, #smtpUsername, #smtpPassword, #smtpPort, #supportEmail, #accountName, #paymentKey, #secretKey, #receiverKey, #session, #staffId, #termId, #statusId"
    ).removeClass("issue");

    let selectedDepartment = [];

    $(".child:checked").each(function () {
      const departmentId = $(this).data("value");
      selectedDepartment.push({ departmentId: departmentId });
    });

     if (!schoolCategoryId) {
      $("#schoolCategoryId").addClass("issue");
      _actionAlert("Select school category to continue", false);
      return;
    }

    if (!name) {
      $("#name").addClass("issue");
      _actionAlert("Provide branch name to continue", false);
      return;
    }

    if (!mobileNumber) {
      $("#mobileNumber").addClass("issue");
      _actionAlert("Provide branch mobile number to continue", false);
      return;
    }

    if (!stateId) {
      $("#stateId").addClass("issue");
      _actionAlert("Select branch state to continue", false);
      return;
    }

    if (!lgaId) {
      $("#lgaId").addClass("issue");
      _actionAlert("Select branch local govt area to continue", false);
      return;
    }

    if (!address) {
      $("#address").addClass("issue");
      _actionAlert("Provide branch address to continue", false);
      return;
    }

    if (!smtpHost || !/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(smtpHost)) {
      $("#smtpHost").addClass("issue");
      _actionAlert("Provide a valid SMTP Host to continue", false);
      return;
    }

    if (
      !smtpUsername ||
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(
        $("#smtpUsername").val()
      )
    ) {
      $("#smtpUsername").addClass("issue");
      _actionAlert("Provide a valid SMTP Username (email) to continue", false);
      return;
    }

    if (!smtpPassword) {
      $("#smtpPassword").addClass("issue");
      _actionAlert("Provide branch Smtp Password to continue", false);
      return;
    }

    if (!smtpPort) {
      $("#smtpPort").addClass("issue");
      _actionAlert("Provide branch Smtp Port to continue", false);
      return;
    }

    if (
      !supportEmail ||
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(supportEmail)
    ) {
      $("#supportEmail").addClass("issue");
      _actionAlert("Provide a valid Support Email to continue", false);
      return;
    }

    if (!accountName) {
      $("#accountName").addClass("issue");
      _actionAlert("Provide account name to continue", false);
      return;
    }

    if (!paymentKey) {
      $("#paymentKey").addClass("issue");
      _actionAlert("Provide branch payment key to continue", false);
      return;
    }

    if (!secretKey) {
      $("#secretKey").addClass("issue");
      _actionAlert("Provide secret key to continue", false);
      return;
    }

    if (!receiverKey) {
      $("#receiverKey").addClass("issue");
      _actionAlert("Provide receiver key to continue", false);
      return;
    }

    if (!session) {
      $("#session").addClass("issue");
      _actionAlert("Provide session to continue", false);
      return;
    }

    if (selectedDepartment.length === 0) {
      _actionAlert("Please select at least one department to continue.", false);
      return;
    }

    if (!managerId) {
      $("#staffId").addClass("issue");
      _actionAlert("Select branch manager to continue", false);
      return;
    }

    if (!termId) {
      $("#termId").addClass("issue");
      _actionAlert("Select term to continue", false);
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

      const formData = {
        schoolCategoryId: schoolCategoryId,
        name: name,
        mobileNumber: mobileNumber,
        stateId: stateId,
        lgaId: lgaId,
        address: address,
        smtpHost: smtpHost,
        smtpUsername: smtpUsername,
        smtpPassword: smtpPassword,
        smtpPort: smtpPort,
        supportEmail: supportEmail,
        accountName: accountName,
        paymentKey: paymentKey,
        secretKey: secretKey,
        receiverKey: receiverKey,
        session: session,
        departmentIds: selectedDepartment,
        managerId: managerId,
        termId: termId,
        statusId: statusId,
      };

      $.ajax({
        type: "POST",
        url: endPoint + "/admin/branch/create-branch",
        data: JSON.stringify(formData),
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        processData: false,
        success: function (data) {
          if (data.success) {
            _actionAlert(data.message, true);
            _alertClose();
            _getPage({ page: "branches", url: adminPortalLocalUrl });
          } else {
            _actionAlert(data.message, false);
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

function _fetchBranches() {
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
      url: endPoint + "/admin/branch/fetch-branch",
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const success = info.success;
       
        let statusContent = "";
        statusContent += `
          <ul>
            <li title="Department"><span>
            <i class="bi-diagram-3"></i> Active</span>
                <div class="num">${info.activeBranchCount}</div>
            </li>
            <li title="Classes"><span><i
                class="bi-diagram-3"></i> Suspended</span>
                <div class="num">${info.suspendedBranchCount}</div>
            </li>
          </ul>`;

        $("#statusContent").html(statusContent);

        let text = "";
        let no = 0;

        text = `
				<thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>Name</th>
						<th>Session</th>
						<th>Term</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Manager</th>
                        <th>No. of Staff</th>
                        <th>No. of Students</th>
                        <th>Date of Reg.</th>
                        <th>Status</th>
						<th>View</th>
                    </tr>
                </thead>`;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const branchId = fetch[i].branchId;
            const name = fetch[i].name;
            const smtpUsername = fetch[i].smtpUsername;
            const session = fetch[i].session;
            const termName = fetch[i].termData[0]?.termName;
            const mobileNumber = fetch[i].mobileNumber;
            const address = fetch[i].address;
            const managerName = fetch[i].managerName;
            const staffId = fetch[i].managerId;
            const totalNumberOfStaff = fetch[i].totalNumberOfStaff;
            const totalNumberOfStudents = fetch[i].totalNumberOfStudents;
            const createdTime = fetch[i].createdTime;
            const statusName = fetch[i].statusName;

            text += `
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td class="clickable-td" title="Click to view branch profile" onclick="_fetchEachBranches('${branchId}');">${name}<br/><span>${smtpUsername}</span></td>
								<td>${session}</td>
								<td>${termName}</td>
								<td>${mobileNumber}</td>
								<td>${address}</td>
								<td class="clickable-td" onclick="_fetchEachStaff('${staffId}');">${managerName}</td>
								<td>${totalNumberOfStaff}</td>
                <td>${totalNumberOfStudents}</td>
								<td>${createdTime}</td>
								<td><div class="status-div ${statusName}">${statusName}</div></td>
								<td><button class="btn view-btn" title="Click to view branch profile" onclick="_fetchEachBranches('${branchId}');">VIEW</button></td>
							</tr>
						</tbody>`;
          }
          $("#pageContent").html(text);
        } else {
          _actionAlert(info.message, false);
          text += `
						tbody>
							<tr>
								<td colspan="11">
									<div class="false-notification-div">
										<p>${info.message}</p>
										<div>
											<button class="btn" onclick="_getForm({page: 'branch_reg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD NEW BRANCH</button>
										</div>
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

function _fetchEachBranches(branchId) {
  $("#get-form-more-div")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/fetch-branch?branchId=${branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success && info.data.length > 0) {
          sessionStorage.setItem(
            "getEachBranchDetailsSession",
            JSON.stringify(info.data[0])
          );
          _getForm({ page: "branch_pages", url: adminPortalLocalUrl });
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

function _updateBranch() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );
  try {
    const schoolCategoryId = $("#schoolCategoryId").val();
    const name = $("#updateName").val();
    const mobileNumber = $("#updateMobileNumber").val();
    const stateId = $("#stateId").val();
    const lgaId = $("#lgaId").val();
    const address = $("#updateAddress").val();
    const supportEmail = $("#updateSupportEmail").val();
    const accountName = $("#updateAccountName").val();
    const paymentKey = $("#updatePaymentKey").val();
    const secretKey = $("#updateSecretKey").val();
    const receiverKey = $("#updateReceiverKey").val();
    const session = $("#updateSession").val();
    const managerId = $("#updateStaffId").val();
    const termId = $("#updateTermId").val();
    const timeSchoolOpened = $("#timeSchoolOpened").val();
    const schoolResumptionDate = $("#schoolResumptionDate").val();
    const statusId = $("#updateStatusId").val();

    $(
      "#schoolCategoryId, #updateName, #updateMobileNumber, #stateId, #lgaId, #updateAddress, #updateSupportEmail, #updateAccountName, #updatePaymentKey, #updateSecretKey, #updateReceiverKey, #updateSession, #updateStaffId, #updateTermId, #timeSchoolOpened, #schoolResumptionDate, #updateStatusId"
    ).removeClass("issue");

    if (!schoolCategoryId) {
      $("#schoolCategoryId").addClass("issue");
      _actionAlert("Select school category to continue", false);
      return;
    }

    if (!name) {
      $("#updateName").addClass("issue");
      _actionAlert("Provide branch name to continue", false);
      return;
    }

     if (!name) {
      $("#updateName").addClass("issue");
      _actionAlert("Provide branch name to continue", false);
      return;
    }

    if (!mobileNumber) {
      $("#updateMobileNumber").addClass("issue");
      _actionAlert("Provide branch mobile number to continue", false);
      return;
    }

    if (!stateId) {
      $("#stateId").addClass("issue");
      _actionAlert("Select branch state to continue", false);
      return;
    }

    if (!lgaId) {
      $("#lgaId").addClass("issue");
      _actionAlert("Select branch local govt area to continue", false);
      return;
    }

    if (!address) {
      $("#updateAddress").addClass("issue");
      _actionAlert("Provide branch address to continue", false);
      return;
    }

    if (
      !supportEmail ||
      !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(supportEmail)
    ) {
      $("#updateSupportEmail").addClass("issue");
      _actionAlert("Provide a valid Support Email to continue", false);
      return;
    }

    if (!accountName) {
      $("#updateAccountName").addClass("issue");
      _actionAlert("Provide account name to continue", false);
      return;
    }

    if (!paymentKey) {
      $("#updatePaymentKey").addClass("issue");
      _actionAlert("Provide branch payment key to continue", false);
      return;
    }

    if (!secretKey) {
      $("#updateSecretKey").addClass("issue");
      _actionAlert("Provide secret key to continue", false);
      return;
    }

    if (!receiverKey) {
      $("#updateReceiverKey").addClass("issue");
      _actionAlert("Provide receiver key to continue", false);
      return;
    }

    if (!session) {
      $("#updateSession").addClass("issue");
      _actionAlert("Provide session to continue", false);
      return;
    }

    if (!managerId) {
      $("#updateStaffId").addClass("issue");
      _actionAlert("Select branch manager to continue", false);
      return;
    }

    if (!termId) {
      $("#updateTermId").addClass("issue");
      _actionAlert("Select term to continue", false);
      return;
    }

    if (!timeSchoolOpened) {
      $("#timeSchoolOpened").addClass("issue");
      _actionAlert("Provide Time School Opened to continue", false);
      return;
    }

    if (!schoolResumptionDate) {
      $("#schoolResumptionDate").addClass("issue");
      _actionAlert("Provide School Resumption Date to continue", false);
      return;
    }

    if (!statusId) {
      $("#updateStatusId").addClass("issue");
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

      const formData = {
        schoolCategoryId: schoolCategoryId,
        name: name,
        mobileNumber: mobileNumber,
        stateId: stateId,
        lgaId: lgaId,
        address: address,
        supportEmail: supportEmail,
        accountName: accountName,
        paymentKey: paymentKey,
        secretKey: secretKey,
        receiverKey: receiverKey,
        session: session,
        managerId: managerId,
        termId: termId,
        timeSchoolOpened: timeSchoolOpened,
        schoolResumptionDate: schoolResumptionDate,
        statusId: statusId,
      };

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/update-branch?branchId=${getEachBranchDetailsSession.branchId}`,
        data: JSON.stringify(formData),
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        processData: false,
        success: function (data) {
          if (data.success) {
            let getEachBranchDetailsSession = data.data[0];
            sessionStorage.setItem(
              "getEachBranchDetailsSession",
              JSON.stringify(getEachBranchDetailsSession)
            );

            _actionAlert(data.message, true);
            _fetchEachBranches(getEachBranchDetailsSession.branchId);
            _getPage({ page: "branches", url: adminPortalLocalUrl });
          } else {
            _actionAlert(data.message, false);
          }
          $("#updateBtn").html(btn_text).prop("disabled", false);
        },
        error: function (error) {
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

function _updateBranchConfig() {
  try {
    let issueCount = 0;
    const session = $("#currentSession").val();
    const termId = $("#termId").val();
    const timeSchoolOpened = $("#timeSchoolOpened").val();
    const schoolResumptionDate = $("#schoolResumptionDate").val();
    const schoolLogo = $("#schoolLogo").prop("files")[0];
    const principalSignature = $("#principalSignature").prop("files")[0];

    //  Newly added headers
    const midTermResultHeader = $("#midTermResultHeader").prop("files")[0];
    const caResultSummaryHeader = $("#caResultSummaryHeader").prop("files")[0];
    const caBroadSheetHeader = $("#caBroadSheetHeader").prop("files")[0];
    const terminalBroadSheetHeader = $("#terminalBroadSheetHeader").prop("files")[0];
    const classListHeader = $("#classListHeader").prop("files")[0];
    const cummulativeMarkBookHeader = $("#cummulativeMarkBookHeader").prop("files")[0];
    const markBookHeader = $("#markBookHeader").prop("files")[0];
    const progressReportHeader = $("#progressReportHeader").prop("files")[0];
    const scoreSheetHeader = $("#scoreSheetHeader").prop("files")[0];
    const studentListHeader = $("#studentListHeader").prop("files")[0];
    const subjectListHeader = $("#subjectListHeader").prop("files")[0];
    const terminalResultSummaryHeader = $("#terminalResultSummaryHeader").prop("files")[0];
    const terminalResultHeader = $("#terminalResultHeader").prop("files")[0];
    const watermark = $("#watermark").prop("files")[0];

    $("#currentSession, #termId, #timeSchoolOpened, #schoolResumptionDate").removeClass("issue");
    $("#issue_currentSession, #issue_termId, #issue_timeSchoolOpened, #issue_schoolResumptionDate").html("");

    if (!session) {
      $("#currentSession").addClass("issue");
      $("#issue_currentSession").html("USER ERROR! Kindly Select current session to continue");
      issueCount++;
    }

    if (!termId) {
      $("#termId").addClass("issue");
      $("#issue_termId").html("USER ERROR! Kindly Select term to continue");
      issueCount++;
    }

    if (!timeSchoolOpened) {
      $("#timeSchoolOpened").addClass("issue");
      $("#issue_timeSchoolOpened").html("USER ERROR! Kindly Provide time school opened to continue");
      issueCount++;
    }

    if (!schoolResumptionDate) {
      $("#schoolResumptionDate").addClass("issue");
      $("#issue_schoolResumptionDate").html("USER ERROR! Kindly Provide school resumption date to continue");
      issueCount++;
    }

    if (issueCount > 0) return;

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btnText = $("#submitBtn").html();
      $("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
      $("#submitBtn").prop("disabled", true);

      const formData = new FormData();
      formData.append("session", session);
      formData.append("termId", termId);
      formData.append("timeSchoolOpened", timeSchoolOpened);
      formData.append("schoolResumptionDate", schoolResumptionDate);

      if (schoolLogo) formData.append("schoolLogo", schoolLogo);
      if (principalSignature) formData.append("principalSignature", principalSignature);
      
      // Append new files
      if (midTermResultHeader) formData.append("midTermResultHeader", midTermResultHeader);
      if (caResultSummaryHeader) formData.append("caResultSummaryHeader", caResultSummaryHeader);
      if (caBroadSheetHeader) formData.append("caBroadSheetHeader", caBroadSheetHeader);
      if (terminalBroadSheetHeader) formData.append("terminalBroadSheetHeader", terminalBroadSheetHeader);
      if (classListHeader) formData.append("classListHeader", classListHeader);
      if (cummulativeMarkBookHeader) formData.append("cummulativeMarkBookHeader", cummulativeMarkBookHeader);
      if (markBookHeader) formData.append("markBookHeader", markBookHeader);
      if (progressReportHeader) formData.append("progressReportHeader", progressReportHeader);
      if (scoreSheetHeader) formData.append("scoreSheetHeader", scoreSheetHeader);
      if (studentListHeader) formData.append("studentListHeader", studentListHeader);
      if (subjectListHeader) formData.append("subjectListHeader", subjectListHeader);
      if (terminalResultSummaryHeader) formData.append("terminalResultSummaryHeader", terminalResultSummaryHeader);
      if (terminalResultHeader) formData.append("terminalResultHeader", terminalResultHeader);
      if (watermark) formData.append("watermark", watermark);

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/update-branch-config?branchId=${getEachBranchDetailsSession.branchId}`,
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
            const data = info.data;

            const oldSchoolLogo = data.oldSchoolLogo;
            const newSchoolLogo = data.schoolLogo;

            const oldPrincipalSignature = data.oldPrincipalSignature;
            const newPrincipalSignature = data.principalSignature;

            // New upload response variables
            const oldMidTermResultHeader = data.oldMidTermResultHeader;
            const newMidTermResultHeader = data.midTermResultHeader;

            const oldCaResultSummaryHeader = data.oldCaResultSummaryHeader;
            const newCaResultSummaryHeader = data.caResultSummaryHeader;

            const oldCaBroadSheetHeader = data.oldCaBroadSheetHeader;
            const newCaBroadSheetHeader = data.caBroadSheetHeader;

            const oldTerminalBroadSheetHeader = data.oldTerminalBroadSheetHeader;
            const newTerminalBroadSheetHeader = data.terminalBroadSheetHeader;

            const oldClassListHeader = data.oldClassListHeader;
            const newClassListHeader = data.classListHeader;

            const oldCummulativeMarkBookHeader = data.oldCummulativeMarkBookHeader;
            const newCummulativeMarkBookHeader = data.cummulativeMarkBookHeader;

            const oldMarkBookHeader = data.oldMarkBookHeader;
            const newMarkBookHeader = data.markBookHeader;

            const oldProgressReportHeader = data.oldProgressReportHeader;
            const newProgressReportHeader = data.progressReportHeader;

            const oldScoreSheetHeader = data.oldScoreSheetHeader;
            const newScoreSheetHeader = data.scoreSheetHeader;

            const oldStudentListHeader = data.oldStudentListHeader;
            const newStudentListHeader = data.studentListHeader;

            const oldSubjectListHeader = data.oldSubjectListHeader;
            const newSubjectListHeader = data.subjectListHeader;

            const oldTerminalResultSummaryHeader = data.oldTerminalResultSummaryHeader;
            const newTerminalResultSummaryHeader = data.terminalResultSummaryHeader;

            const oldTerminalResultHeader = data.oldTerminalResultHeader;
            const newTerminalResultHeader = data.terminalResultHeader;

            const oldWatermark = data.oldWatermark;
            const newWatermark = data.watermark;

            if (newSchoolLogo !== "") _uploadSchoolLogo("schoolLogo", oldSchoolLogo, newSchoolLogo, message);
            if (newPrincipalSignature !== "") _uploadSchoolLogo("principalSignature", oldPrincipalSignature, newPrincipalSignature, message);

            // New upload checks
             if (newMidTermResultHeader !== "") _uploadSchoolLogo("midTermResultHeader", oldMidTermResultHeader, newMidTermResultHeader, message);
            if (newCaResultSummaryHeader !== "") _uploadSchoolLogo("caResultSummaryHeader", oldCaResultSummaryHeader, newCaResultSummaryHeader, message);
            if (newCaBroadSheetHeader !== "") _uploadSchoolLogo("caBroadSheetHeader", oldCaBroadSheetHeader, newCaBroadSheetHeader, message);
            if (newTerminalBroadSheetHeader !== "") _uploadSchoolLogo("terminalBroadSheetHeader", oldTerminalBroadSheetHeader, newTerminalBroadSheetHeader, message);
            if (newClassListHeader !== "") _uploadSchoolLogo("classListHeader", oldClassListHeader, newClassListHeader, message);
            if (newCummulativeMarkBookHeader !== "") _uploadSchoolLogo("cummulativeMarkBookHeader", oldCummulativeMarkBookHeader, newCummulativeMarkBookHeader, message);
            if (newMarkBookHeader !== "") _uploadSchoolLogo("markBookHeader", oldMarkBookHeader, newMarkBookHeader, message);
            if (newProgressReportHeader !== "") _uploadSchoolLogo("progressReportHeader", oldProgressReportHeader, newProgressReportHeader, message);
            if (newScoreSheetHeader !== "") _uploadSchoolLogo("scoreSheetHeader", oldScoreSheetHeader, newScoreSheetHeader, message);
            if (newStudentListHeader !== "") _uploadSchoolLogo("studentListHeader", oldStudentListHeader, newStudentListHeader, message);
            if (newSubjectListHeader !== "") _uploadSchoolLogo("subjectListHeader", oldSubjectListHeader, newSubjectListHeader, message);
            if (newTerminalResultSummaryHeader !== "") _uploadSchoolLogo("terminalResultSummaryHeader", oldTerminalResultSummaryHeader, newTerminalResultSummaryHeader, message);
            if (newTerminalResultHeader !== "") _uploadSchoolLogo("terminalResultHeader", oldTerminalResultHeader, newTerminalResultHeader, message);
            if (newWatermark !== "") _uploadSchoolLogo("watermark", oldWatermark, newWatermark, message);

            if (
              newSchoolLogo === "" &&
              newPrincipalSignature === "" &&
              newMidTermResultHeader === "" &&
              newCaResultSummaryHeader === "" &&
              newCaBroadSheetHeader === "" &&
              newTerminalBroadSheetHeader === "" &&
              newClassListHeader === "" &&
              newCummulativeMarkBookHeader === "" &&
              newMarkBookHeader === "" &&
              newProgressReportHeader === "" &&
              newScoreSheetHeader === "" &&
              newStudentListHeader === "" &&
              newSubjectListHeader === "" &&
              newTerminalResultSummaryHeader === "" &&
              newTerminalResultHeader === "" &&
              newWatermark === ""
            ) {
              _actionAlert(message, true);
              _fetchEachBranches(getEachBranchDetailsSession.branchId);
              _getPage({ page: "branches", url: adminPortalLocalUrl });
              _alertClose(2);
            }
          } else {
            _actionAlert(message, false);
          }
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
        error: function (error) {
          _actionAlert("An error occurred while processing your request! Please Try Again", false);
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $("#submitBtn").prop("disabled", false);
  }
}


let _pendingUploads = 0;
function _uploadSchoolLogo(fileType, oldFile, newFile, message) {
  _pendingUploads++; // track uploads

  const uploadedFile = $("#" + fileType).prop("files")[0];

  const formData = new FormData();
  formData.append("action", "uploadFile");
  formData.append("fileType", fileType);
  formData.append("oldFile", oldFile);
  formData.append("newFile", newFile);
  formData.append(fileType, uploadedFile);

  $.ajax({
    url: adminPortalLocalUrl,
    type: "POST",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    success: function () {
      _pendingUploads--;

      if (_pendingUploads === 0) {
        // all uploads done
        _actionAlert(message, true);
        _fetchEachBranches(getEachBranchDetailsSession.branchId);
        _getPage({ page: "branches", url: adminPortalLocalUrl });
        _alertClose(2);
      }
    },
    error: function () {
      _pendingUploads--;
      _actionAlert("Upload failed! Please try again.", false);
    },
  });
}


///// Dashbaord Statistics ////////
function _fetchBranchDashboardStatistics() {
  $.ajax({
    type: "GET",
    url: `${endPoint}/admin//branch/account/fetch-dashboard-statistics?branchId=${getEachBranchDetailsSession.branchId}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.data.length > 0) {
        const data = info.data[0];

        $("#totalActiveBranchStaffCount").html(data.total_active_staff_count);
        $("#totalActiveBranchStudentCount").html(data.total_active_student_count);
        $("#totalAlumniBranchStudentCount").html(data.total_alumni_student_count);
        $("#totalActiveBranchDepartmentCount").html(data.total_active_department_count);

      } else {
        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      }
    },
  });
}

///// Dashbaord Custom Revenue Filtering ////////
function _fetchBranchRevenueFiltering(filterWith, text) {
  $("#srch-text").html(text);
  $(".custom-srch-div").fadeOut(500);
  let dateFrom;
  const dateTo = new Date().toISOString().split("T")[0];
  if (filterWith === "srch-today") {
    dateFrom = new Date().toISOString().split("T")[0];
  } else if (filterWith === "srch-week") {
    const currentDate = new Date();
    const firstDayOfWeek = new Date(
      currentDate.setDate(currentDate.getDate() - currentDate.getDay())
    )
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfWeek;
  } else if (filterWith === "srch-7") {
    /// for last 7 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 6))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-30") {
    /// for last 30 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 29))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-90") {
    /// for last 90 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 89))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-month") {
    const currentDate = new Date();
    const firstDayOfMonth = new Date(
      currentDate.getFullYear(),
      currentDate.getMonth(),
      2
    )
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfMonth;
  } else if (filterWith === "srch-year") {
    const currentDate = new Date();
    const firstDayOfYear = new Date(currentDate.getFullYear(), 0, 2)
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfYear;
  } else if (filterWith === "srch-1year") {
    /// for last 1 year
    const currentDate = new Date();
    const pastDate = new Date(
      currentDate.setFullYear(currentDate.getFullYear() - 1)
    )
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  }

  _revenueBranchFiltering(dateFrom, dateTo);
}
function _fetchBranchCustomRevenueFiltering() {
  let issueCount = 0;

  const dateFrom = $("#datepickers-from").val();
  const dateTo = $("#datepickers-to").val();

  $("#datepickers-from, #datepickers-to").removeClass("issue");
  $("#issue_from, #issue_to").html("");

  if (!dateFrom) {
    $("#issue_from").html("Kindly Provide Start Date To Continue");
    issueCount++;
  }

  if (!dateTo) {
    $("#issue_to").html("Kindly Provide End Date To Continue");
    issueCount++;
  }

  if (issueCount > 0) {
    return;
  }

  _revenueBranchFiltering(dateFrom, dateTo);
}

function _revenueBranchFiltering(dateFrom, dateTo) {
  $("#get-more-div-secondary")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  $.ajax({
    type: "GET",
    url: `${endPoint}/admin/branch/account/fetch-dashboard-revenue?branchId=${getEachBranchDetailsSession.branchId}&dateFrom=${dateFrom}&dateTo=${dateTo}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.statistics.length > 0) {
        const statistics = info.statistics[0];

        // Update custom date from and date to///
        $("#branchRevenueFrom, #branchBursarRevenueFrom").html(info.dateFrom);
        $("#branchRevenueTo, #branchBursarRevenueTo").html(info.dateTo);

        // Update dashboard credit and bank transfer///
        $("#branchRevenueCreditCard, #branchBursarRevenueCreditCard").html(
          "<s>N</s>" + thousandSeperator(statistics.sumCreditCardPayments)
        );
        $("#branchRevenueBankTransfer, #branchBursarRevenueBankTransfer").html(
          "<s>N</s>" + thousandSeperator(statistics.sumBankTransferPayments)
        );

        // Update Pie Chart credit and bank transfer ///
        const options = {
          title: {
            text: "",
          },
          data: [
            {
              type: "pie",
              startAngle: 45,
              showInLegend: "False",
              legendText: "{label}",
              indexLabel: "{label} ({y})",
              yValueFormatString: "#,##0.#" % "",
              indexLabelFontSize: 9,
              dataPoints: [
                {
                  label: "Debit/Credit Card",
                  y: parseInt(statistics.countCreditCardPayments),
                },
                {
                  label: "Bank Transfer",
                  y: parseInt(statistics.countBankTransferPayments),
                },
              ],
            },
          ],
        };

        $("#chartContainer2").CanvasJSChart(options);
        const dataPoints = [];
        // Update dashboard revenue bar Chart ///
        if (info.data && info.data.length > 0) {
          for (let i = 0; i < info.data.length; i++) {
            const fetchedData = info.data[i];
            const payDate = new Date(fetchedData.payDate);
            const totalFeesPaid = parseFloat(fetchedData.totalFeesPaid);

            dataPoints.push({
              x: payDate,
              y: totalFeesPaid,
            });
          }
        }
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          theme: "light2",
          axisX: {
            valueFormatString: "DD MMM",
            crosshair: {
              enabled: true,
              snapToDataPoint: true,
            },
          },
          axisY: {
            title: "",
            includeZero: true,
            crosshair: {
              enabled: true,
            },
          },
          toolTip: {
            shared: true,
          },
          legend: {
            cursor: "pointer",
            verticalAlign: "bottom",
            horizontalAlign: "left",
            dockInsidePlotArea: true,
            itemclick: toogleDataSeries,
          },
          data: [
            {
              type: "column",
              showInLegend: true,
              name: "Revenue",
              xValueFormatString: "DD MMM, YYYY",
              color: "#328ab3",
              dataPoints: dataPoints,
            },
          ],
        });

        chart.render();

        function toogleDataSeries(e) {
          if (
            typeof e.dataSeries.visible === "undefined" ||
            e.dataSeries.visible
          ) {
            e.dataSeries.visible = false;
          } else {
            e.dataSeries.visible = true;
          }
          chart.render();
        }
      } else {
        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      }
    },
    error: function (err) {
      console.error(err);
    },
  });
  $("#get-more-div-secondary").fadeOut(500);
}

function _publishResult(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const newSession = $('#newSession').val().trim();
    const newTermId = $('#newTermId').val().trim();
		
		///// empty field validation//////////
    issueCount += _validateEmptyValue("newSession", "SESSION");
    issueCount += _validateEmptyValue("newTermId", "TERM");

		if (issueCount > 0) return;

		/////Gather form data////
		const formData = {
      newSession,
      newTermId,
    };

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_publishResultCallback(formData);
		},
			title: "Are you sure?",
			message: 'Once you publish this result, the current student result data cannot be updated. Ensure all scores and details are 100% correct before proceeding.',
			alertType: "warning",
			falseActionBtn: true,
      trueActionBtnText: "Yes, Publish",
      falseActionBtnText: "Cancel",
      closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _publishResult());
	}
}

function _publishResultCallback(formData) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	///// get btn text/////
	const btnText = $("#publishResultBtn").html();
	_btnDisable("publishResultBtn", btnText, true);
	
	//// call endpoint //////
	 _callRawEndPoints({
		url: `reports/publish-results?branchId=${getEachBranchDetailsSession.branchId}`,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_staffValidationCheck(response.response);
		if (response.success) {
      _showCustomConfirm({
				callback: () => {
				  _alertClose(2);
          _fetchEachBranches(getEachBranchDetailsSession.branchId);
          _getPage({ page: "branches", url: adminPortalLocalUrl });
				},
          title: "Success!",
          message: response.message,
          alertType: "success",
          trueActionBtnText: "Okay, Thanks",
          closeOnOverlayClick: false,
      });
			_btnDisable("publishResultBtn", btnText, false);
		} else {
			_btnDisable("publishResultBtn", btnText, false);
			_showCustomConfirm({
				title: "Unable to Publish Result!",
				message: response.message,
				alertType: "error",
				trueActionBtnText: "OK",
			});
		}
    })
    .catch((error) => {
		console.error("Error:", error);
		_callAjaxError(() => _publishResultCallback(formData)); // retry if needed
		_btnDisable("publishResultBtn", btnText, false);
    });
}