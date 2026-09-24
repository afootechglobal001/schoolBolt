$(document).ready(function () {
    function trim(s) {
        return s.replace(/^\s*/, "").replace(/\s*$/, "");
    }
    $("#viewLogin").keydown(function (e) {
        if (e.keyCode == 13) {
        _confirmCbtAdminLogin();
        }
    });
});

function _getStudentNextPage(props) {
    const { page = ""} = props;
    if (page) {
        sessionStorage.setItem("currentAuthPage", page);
        _getPage({ page: page, url: cbtStudentLoginMiddleWareUrl });
    }
    
}