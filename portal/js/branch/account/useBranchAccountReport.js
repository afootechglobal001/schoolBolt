function _getActiveBranchReportNav(props) {
  const {
    page = "",
    divid = "",
    pageContainer = "getBranchReportNavPage",
  } = props;
  _getBranchReportActiveNav(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getBranchReportActiveNav(divid) {
  $(
    "#filterBranchByDate, #filterBranchBySession"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

function _getBranchPaymentStatusNav(props) {
  const {
    page = "",
    divid = "",
    id="",
    pageContainer = "getBranchPaymentNav",
  } = props;
  _getActiveBranchPaymentStatusNav(divid);
  if (page) {
    _getPage({
      page: page,
      id: id,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getActiveBranchPaymentStatusNav(divid) {
  $(".title-nav-back-div ul li").removeClass("active-li");
  $("#" + divid).addClass("active-li");
}