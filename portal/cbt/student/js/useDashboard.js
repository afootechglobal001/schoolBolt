function _getActivePage(props) {
  const { page = "" } = props;
  if (page) {
    sessionStorage.setItem("currentDashboardPage", page);
    _getPage({ page: page, url: cbtStudentPortalMiddleWareUrl });
  }
}

function _open_li(ids) {
  $("#" + ids + "-sub-li").toggle("slow");
}

function _toggleCbtProfileDiv() {
  $(".toggle").toggle("slow");
}

function _closeProfileDiv(event) {
  if (!$(event.target).closest(".toggle, .img-div").length) {
    $(".toggle").hide("slow");
  }
}
$(document).on("click", _closeProfileDiv);
$(document).on("click", ".toggle li", function () {
  $(".toggle").hide("slow");
});

$(document).ready(function () {
    function updateThemeIcon() {
      if ($("html").hasClass("dark-mode")) {
        $("#darkModeBtn i").removeClass("bi-moon-stars-fill").addClass("bi-sun-fill");
      } else {
        $("#darkModeBtn i").removeClass("bi-sun-fill").addClass("bi-moon-stars-fill");
      }
    }

    // Get saved theme
    const savedTheme = localStorage.getItem("theme");
    // Default to light mode if no theme has been saved
    if (savedTheme === "dark") {
        $("html").addClass("dark-mode");
    } else {
        $("html").removeClass("dark-mode");
    }

    updateThemeIcon();
    // Toggle theme
    $("#darkModeBtn").click(function () {
        $("html").toggleClass("dark-mode");
        const currentTheme = $("html").hasClass("dark-mode")
            ? "dark"
            : "light";
        localStorage.setItem("theme", currentTheme);
        updateThemeIcon();
    });
});

function select_search() {
  $(".srch-select").toggle("fast");
}

function srch_custom(text) {
  $("#srch-text").html(text);
  $(".custom-srch-div").fadeIn(500);
}

function _closeSearchDiv(event) {
  if (!$(event.target).closest(".srch-select, .text-right").length) {
    $(".srch-select").hide("slow");
  }
}
$(document).on("click", _closeSearchDiv);

function _chevronCollapse(divId) {
  var x = document.getElementById(divId + "num");
  var titleDiv = x.closest(".pages-toggle-title");

  if (x.innerHTML === '&nbsp;<i class="bi bi-chevron-up"></i>&nbsp;') {
    x.innerHTML = '&nbsp;<i class="bi bi-chevron-down"></i>&nbsp;';
    $("#" + divId + "answer").addClass("active-li");
    $(titleDiv).addClass("active-toggle");
  } else {
    x.innerHTML = '&nbsp;<i class="bi bi-chevron-up"></i>&nbsp;';
    $(titleDiv).removeClass("active-toggle");
  }

  $("#" + divId + "answer").slideToggle("slow");
}

function _logOut() {
  // sessionStorage.clear();
  // localStorage.clear();
  window.parent.location.href = cbtStudentLoginUrl;
}

function _confirmLogOut() {
  _showCustomConfirm({
    callback: () => {
      _logOut();
    },
    title: "Confirm Logout Action!",
    message:
      "Are you sure you want to log out? You may miss important notifications or updates until you sign in again.",
    alertType: "warning",
    falseActionBtn: true,
    closeOnOverlayClick: true,
  });
}

function _staffValidationCheck(code) {
  if (code === 401 || code === 403) {
    _logOut();
    return;
  }
}

//// Get Status Preset Data ////
function _getSelectStatusId(fieldId, statusIds) {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `cbt/preset-data/fetch-status?&statusId=${statusIds}`,
      accessKey: true,
		})
      .then((response) => {
        $("#searchList_" + fieldId).html("");
        for (let i = 0; i < response.data.length; i++) {
          const id = response.data[i].statusId;
          const value = response.data[i].statusName;
                  
          $("#searchList_" + fieldId).append(`
            <li onclick="
              _clickOption(
                'searchList_${fieldId}',
                '${id}',
                '${value}'
              );
            ">
              ${value}
            </li>
          `);
        }				
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
  }
}