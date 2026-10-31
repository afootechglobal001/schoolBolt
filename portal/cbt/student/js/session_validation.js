(function() {
    function _checkActiveStudentSession() {
        let studentLoginData_ = JSON.parse(sessionStorage.getItem("studentLoginData"));       
        if (!studentLoginData_ || !studentLoginData_?.studentData?.hasOwnProperty("studentId")) {
            _studentLogOut();
        }
    }
    _checkActiveStudentSession();
})();