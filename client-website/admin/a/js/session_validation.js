(function() {
    function _check_active_session() {
        let staffLoginData_ = JSON.parse(sessionStorage.getItem("staffLoginData"));
        if (!staffLoginData_ || !staffLoginData_.staff[0].hasOwnProperty("staff_id")) {
            _logout();
        }
    }
    _check_active_session();
})();