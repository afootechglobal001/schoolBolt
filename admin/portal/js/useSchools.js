function _getActiveSchoolsPage(props) {
    const { page = "", divid = "", pageContainer = "getSchoolsDetails" } = props;
    _getSchoolsPagesActiveLink(divid);
    if (page) {
        _getPage({
        page: page,
        pageContainer: pageContainer,
        url: portalMiddleWareUrl,
        });
    }
}
function _getSchoolsPagesActiveLink(divid) {
    $("#schoolDashboard, #schoolProfileDetails, #schoolBranches").removeClass("active");
    $("#" + divid).addClass("active");
}

//// Filter Schools ////
function _filtersSchools(value) {
    $("#schoolContent .tb-row").each(function () {
        var text = $(this).text();
        text.toLowerCase().indexOf(value.toLowerCase()) > -1
        ? $(this).show()
        : $(this).hide();
    });
}

/// Fetch Schools Data ///
function _fetchSchoolsData() {
    const response = {
        data: [
            {
                schoolId: "SCL202608001",
                clientId: "CLT202608001",
                schoolName: "Ar-Rahman Group of Schools",
                schoolEmail: "info@arrahmangroupofschools.com",
                schoolPhoneNumber: "+2348031234567",
                websiteUrl: "https://arrahmangroupofschools.com",
                schoolAddress: "Plot 12, Iwo Road, Ibadan, Oyo State",
                administratorName: "Muhammad Adebayo",
                walletBalance: "250000.00",
                onboardingDate: "2026-08-01 10:15:30",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                schoolId: "SCL202608002",
                clientId: "CLT202608002",
                schoolName: "Advanced Breed Group of Schools",
                schoolEmail: "admin@advancedbreedgroupofschool.com",
                schoolPhoneNumber: "+2348023456789",
                websiteUrl: "https://www.advancedbreedgroupofschool.com",
                schoolAddress: "Block 13, Oba Erinwole II Road, G.R.A.,Sagamu, Ogun State.",
                administratorName: "Mr Ologbon Johnson",
                walletBalance: "125500.00",
                onboardingDate: "2026-08-04 14:22:18",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                schoolId: "SCL202608003",
                clientId: "CLT202608003",
                schoolName: "Mayflower Private School",
                schoolEmail: "contact@mayflowerprivateschool.com",
                schoolPhoneNumber: "+2348059876543",
                websiteUrl: "https://mayflowerprivateschool.com",
                schoolAddress: "Mayflower Private School, Tai Solarin Way, Ikenne-Remo, Ogun State, Nigeria.",
                administratorName: "Mr Joseph Ameh",
                walletBalance: "0.00",
                onboardingDate: "2026-08-08 09:10:45",
                statusData: {
                    statusName: "ACTIVE"
                }
            }
        ]
    };

    _initFetchSchoolsData(response.data);
}

/// Render Schools Data ///
function _renderSchoolsData(data, start) {
    return data.map((item, i) => `
        <tr class="tb-row">
            <td>${start + i + 1}</td>
            <td>${item.clientId}</td>
            <td class="clickable-td"
                title="Click to view school profile"
                onclick="_fetchEachSchool('${item.schoolId}');">
                <div class="text-back-div">
                    <div class="text-div">
                        <div class="first-class">${item.schoolName}</div>
                        <a title="Click to visit ${item.schoolName} website" href="${item.websiteUrl}" target="_blank">
                        <div class="second-class">${item.websiteUrl}</div>
                        </a>
                    </div>
                </div>
            </td>
			<td>
                <div class="text-back-div">
                    <div class="text-div">
                        <div class="first-class">${item.schoolEmail}</div>
                        <div class="second-class">${item.schoolPhoneNumber}</div>
                    </div>
                </div>
            </td>
            <td>${item.schoolAddress}</td>
            <td>${item.administratorName}</td>
            <td><s>N</s>${thousandSeperator(item.walletBalance)}</s></td>
            <td>${item.onboardingDate}</td>
            <td>
                <div class="status-div ${item.statusData?.statusName}">
                    ${item.statusData?.statusName}
                </div>
            </td>
            <td>
                <button class="btn view-btn"
                    title="Click to view school profile"
                    onclick="_fetchEachSchool('${item.schoolId}');">
                    VIEW
                </button>
            </td>
        </tr>
    `).join("");
}

/// Initialize Fetch Schools Data ///
function _initFetchSchoolsData(data) {
  const paginator = new Paginator(
    data,
    _renderSchoolsData,
    "schoolsContentPaginationControls",
    "schoolsContent",
    10
  );
  __paginatorHandlers["schoolsContentPaginationControls"] = paginator;
  paginator.renderPage();
}

//// Fetch Each School ////
// function _fetchEachSchool(schoolId) {
//     $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
// 	try {
// 		//// call endpoint //////
// 		_callFetchEndPoints({
// 			url: `admin/staff/fetch-staff?staffId=${staffId}`,
// 			accessKey: true,
// 		})
// 		.then((response) => {
// 			sessionStorage.setItem("getEachSchoolDetailsSession", JSON.stringify(response.data[0]));
// 			_getForm({page: 'schoolProfile', url: portalMiddleWareUrl});
// 		 })
// 		.catch((error) => {
// 			_staffValidationCheck(error.response);
// 			_alertClose();
// 			console.error("Error:", error);
// 			_callAjaxError(() => _fetchEachSchool(staffId), error.message); // retry if needed
// 		});
// 	} catch (error) {
// 		_alertClose();
// 		console.error("Error:", error);
// 		_callCatchError(() => _fetchEachSchool(staffId));
//   	}
// }

function _fetchEachSchool(schoolId) {
    $("#get-form-more-div")
        .css({
            'display': 'flex',
            'justify-content': 'center',
            'align-items': 'center'
        })
        .fadeIn(500);

    try {
        const response = {
            data: {
                schoolId: schoolId,
                clientId: "CLT202608001",
                schoolName: "Ar-Rahman Group of Schools",
                schoolEmail: "info@arrahmangroupofschools.com",
                schoolPhoneNumber: "+2348031234567",
                schoolAddress: "Plot 12, Iwo Road, Ibadan, Oyo State",
                onboardedDate: "2026-08-01 10:15:30",
                lastLoginTime: "2026-08-12 08:45:12",
                schoolBoltWalletBalance: "250000.00",
                administratorData: {
                    administratorId: "ADM202608001",
                    firstName: "Muhammad",
                    lastName: "Adebayo",
                    emailAddress: "administrator@arrahmangroupofschools.com",
                    phoneNumber: "+2348039876543"
                },
                statusData: {
                    statusId: "1",
                    statusName: "ACTIVE"
                }
            }
        };

        sessionStorage.setItem(
            "getEachSchoolDetailsSession",
            JSON.stringify(response.data)
        );
        _getForm({
            page: 'schoolsProfile',
            url: portalMiddleWareUrl
        });
    } catch (error) {
        _alertClose();
        console.error("Error:", error);
        _callCatchError(() => _fetchEachSchool(schoolId));
    }
}

/// Fetch Branches Data ///
function _fetchBranchesData() {
    const response = {
        data: [
            {
                branchId: "BRANCH00220250308091807",
                clientId: "CLT202608001sdd",
                schoolName: "ARRAHMAN MONTESSORI SCHOOL, KETU LAGOS",
                schoolEmail: "aagsadmin@schoolbolt.org",
                schoolPhoneNumber: "+2348031234567",
                websiteUrl: "https://arrahmangroupofschools.com",
                schoolAddress: "Plot 12, Iwo Road, Ibadan, Oyo State",
                administratorName: "Muhammad Adebayo",
                numberOfStudents: "80",
                numberOfStaff: "9",
                walletBalance: "250000.00",
                session: "20205/20206",
                termData: {
                    termName: "THIRD TERM"
                },
                onboardingDate: "2026-08-01 10:15:30",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                branchId: "BRANCH00420250322094210",
                clientId: "CLT202608002",
                schoolName: "	ARRAHMAN COLLEGE, KETU, LAGOS",
                schoolEmail: "aagsadmin@schoolbolt.org",
                schoolPhoneNumber: "+2348023456789",
                websiteUrl: "https://www.advancedbreedgroupofschool.com",
                schoolAddress: "Block 13, Oba Erinwole II Road, G.R.A.,Sagamu, Ogun State.",
                administratorName: "Mr Ologbon Johnson",
                numberOfStudents: "80",
                numberOfStaff: "9",
                walletBalance: "125500.00",
                session: "20205/20206",
                termData: {
                    termName: "THIRD TERM"
                },
                onboardingDate: "2026-08-04 14:22:18",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                branchId: "BRANCH02720260331093838",
                clientId: "CLT202608003",
                schoolName: "ARRAHMAN COLLEGE, AGEGE, LAGOS",
                schoolEmail: "aagsadmin@schoolbolt.org",
                schoolPhoneNumber: "+2348059876543",
                websiteUrl: "https://mayflowerprivateschool.com",
                schoolAddress: "Mayflower Private School, Tai Solarin Way, Ikenne-Remo, Ogun State, Nigeria.",
                administratorName: "Mr Joseph Ameh",
                numberOfStudents: "80",
                numberOfStaff: "9",
                walletBalance: "0.00",
                session: "20205/20206",
                termData: {
                    termName: "THIRD TERM"
                },
                onboardingDate: "2026-08-08 09:10:45",
                statusData: {
                    statusName: "ACTIVE"
                }
            }
        ]
    };

    _initFetchBranchesData(response.data);
}

/// Render Branches Data ///
function _renderBranchesData(data, start) {
    return data.map((item, i) => `
        <tr class="tb-row">
            <td>${start + i + 1}</td>
            <td class="clickable-td"
                title="Click to view Branch profile"
                onclick="_fetchEachSchool('${item.branchId}');">
                <div class="text-back-div">
                    <div class="text-div">
                        <div class="first-class">${item.schoolName}</div>
                        <div class="second-class">${item.branchId}</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="text-back-div">
                    <div class="text-div">
                        <div class="first-class">${item.schoolEmail}</div>
                        <div class="second-class">${item.schoolPhoneNumber}</div>
                    </div>
                </div>
            </td>
			<td>
                <div class="text-back-div">
                    <div class="text-div">
                        <div class="first-class">${item.session}</div>
                        <div class="second-class">${item.termData?.termName}</div>
                    </div>
                </div>
            </td>
            <td>${item.schoolAddress}</td>
            <td>${item.administratorName}</td>
            <td>${item.numberOfStaff}</td>
            <td>${item.numberOfStudents}</td>
            <td><s>N</s>${thousandSeperator(item.walletBalance)}</s></td>
            <td>${item.onboardingDate}</td>
            <td>
                <div class="status-div ${item.statusData?.statusName}">
                    ${item.statusData?.statusName}
                </div>
            </td>
            <td>
                <button class="btn view-btn"
                    title="Click to view school profile"
                    onclick="_fetchEachSchool('${item.schoolId}');">
                    VIEW
                </button>
            </td>
        </tr>
    `).join("");
}

/// Initialize Fetch Branches Data ///
function _initFetchBranchesData(data) {
  const paginator = new Paginator(
    data,
    _renderBranchesData,
    "branchesContentPaginationControls",
    "branchesContent",
    10
  );
  __paginatorHandlers["branchesContentPaginationControls"] = paginator;
  paginator.renderPage();
}