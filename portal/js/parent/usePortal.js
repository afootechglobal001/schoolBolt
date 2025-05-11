function _getActiveStudentPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='getStudentDetails',
		ids=''
    } = props;
	_getStudentPageActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer, url: parentPortalLocalUrl, ids: ids});
	}
}

function _getStudentPageActiveLink(divid){
	$('#studentDashbaord').removeClass('active');
	$("#"+divid).addClass('active');
}

function capitalizeFirstLetterOfEachWord(inputText) {
	const words = inputText.toLowerCase().split(' ');
	for (let i = 0; i < words.length; i++) {
		words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
	}
	const result = words.join(' ');
	return result;
}


function _getFetchStudents() {
	let sessionStudentData = JSON.parse(sessionStorage.getItem("sessionStudentData"));

	try {
		let fetchSessionStudent = sessionStudentData;
		let text = '';

		if (fetchSessionStudent && fetchSessionStudent.length > 0) {
			for (let i = 0; i < fetchSessionStudent.length; i++) {
				const studentInfo = fetchSessionStudent[i];
				const studentId = studentInfo.studentData.studentId;
				const surName = studentInfo.studentData.surName;
				const firstName = studentInfo.studentData.firstName;
				const otherNames = studentInfo.studentData.otherNames;
				const fullname = capitalizeFirstLetterOfEachWord(surName + ' ' + firstName + ' ' + otherNames);
				const passport = studentInfo.studentData.passport || 'default.jpg';
				const className = studentInfo.classData.className;
				const armName = studentInfo.armData.armName;
				const statusName = studentInfo.studentData.statusName;

				text += `
					<div class="student-profile">
						<div class="details">
							<div class="pix">
								<img src="${studentPixPath}/${passport}" alt="${fullname}" />
							</div>
							<div class="text">
								<h3>${fullname}</h3>
								<div class="info">
									<p>Class: <span>${className}</span> - Arm: <span>${armName}</span></p>
									<button class="status-btn ${statusName}">${statusName}</button>
								</div>
							</div>
						</div>
						<button class="btn" onClick="_getForm({page: 'studentProfile', url: parentPortalLocalUrl, ids: '${studentId}'});">VIEW DETAILS</button>
					</div>`;
			}
			$('#pageContent').html(text);
		} else {
			text +=`
			<div class="false-notification-div">
				<p>No Record Found!!!</p>
			</div>`;
			$('#pageContent').html(text);
		}
			
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}


function _getFetchEachStudentDetails(studentIdToFind){
	let sessionStudentData = JSON.parse(sessionStorage.getItem("sessionStudentData"));

	let allStudent=sessionStudentData.studentData;
    const students = allStudent.find(s => s.studentId === studentIdToFind);

	let titleProfile='';
	// let profileDetails ='';
		
	titleProfile +=`	
				<div class="mini-profile">
                    <label>
                        <div class="img-div" onClick="takeSnapShot('updateStaffPix')" id="cam-pix">
                            <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="Profile Image">
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name">${students.surname}</div>

                                <div class="text">
                                    ID:<strong>STUDENT05020250328113504</strong> | <strong>Junior - JSS 2 B</strong>
                                    <div>
                                        <div id="statusBtn" class="status-btn ACTIVE"><span>ACTIVE</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				`;
	$('#profile-title-div').html(titleProfile);

		
		
  }
