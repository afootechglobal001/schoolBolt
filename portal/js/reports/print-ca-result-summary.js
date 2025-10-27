function _printCaResultSummary() {
	let getViewResultSummarySession = JSON.parse(sessionStorage.getItem("getViewResultSummarySession"));
	
	if (getViewResultSummarySession) {
		sessionStorage.setItem("printResultSummarySession", JSON.stringify(getViewResultSummarySession));
		windowPop(`${websiteUrl}/reports/print-ca-result-summary`);
	}
}