function _printTerminalResultSummary() {
	let getViewTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("getViewTerminalResultSummarySession"));
	
	if (getViewTerminalResultSummarySession) {
		sessionStorage.setItem("printTerminalResultSummarySession", JSON.stringify(getViewTerminalResultSummarySession));
		windowPop(`${websiteUrl}/reports/print-terminal-result-summary`);
	}
}