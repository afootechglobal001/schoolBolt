function _getActiveBranchTransactionReportNav(props) {
  const {
    page = "",
    divid = "",
    pageContainer = "getBranchTransactionReportNavPage",
  } = props;
  _getBranchTransactionReportNavActiveNav(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getBranchTransactionReportNavActiveNav(divid) {
  $(
    "#filterBranchTransactionByDate, #filterBranchTransactionBySession"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}