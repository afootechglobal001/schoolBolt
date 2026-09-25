function textField(options) {
  const {
    id = "",
    title = "",
    type = "text",
    value = "",
    onKeyPressFunction = null,
    onKeyUpFunction = null,
    readonly = false,
    maxlength = null,
    rows = null,
  } = options;

  const isPassword = type === "password";
  const template =
    type === "textarea"
      ? `
          <textarea class="text_area" id="${id}" placeholder="" rows="${rows}"
		  ${maxlength ? `maxlength="${maxlength}"` : ""} ${rows ? `rows="${rows}"` : ""}>${value}</textarea>
          <div class="placeholder">${title}</div>
		  <div class="issueText" id="issue_${id}"></div>
        `
      : `
          <input class="text_field" type="${type}" id="${id}" placeholder="" value="${value}"
            ${onKeyPressFunction ? `onkeypress="${onKeyPressFunction}"` : ""} 
			${onKeyUpFunction ? `onkeyup="${onKeyUpFunction}"` : ""}
			${readonly ? "readonly" : ""}
			${maxlength ? `maxlength="${maxlength}"` : ""}/>
          <div class="placeholder">${title}:</div>
		  <div class="issueText" id="issue_${id}"></div>
      ${isPassword ? `<span class="toggle-password" data-target="${id}"><i class='bi bi-eye-fill'></i></span>` : ""}
    `;
  $("#" + id + "_container").html(template);
}

function selectField(options) {
  const {
    id = "",
    title = "",
    emptyValue = "",
    fieldValue = "",
    fieldLabel = "",
  } = options;

  const template = `
    <select class="text_field select_text_field selectSearch" id="${id}"
        onclick="_selectOption('${id}')" style="opacity: 1;">
		${
      fieldValue
        ? `<option selected="selected" value="${fieldValue}">${fieldLabel}</option>`
        : '<option selected="selected" value="">Select here</option>'
    }
    </select>
    <div class="placeholder">${title}:</div>
    <div class="searchPanel addSearchPanel animated fadeIn" id="searchPanel_${id}"
        style="display: none;">
        <input class="searchTxt" placeholder="Type here to search"
            id="txtSearchValue_${id}" autocomplete="off"
            onkeyup="filter('${id}')">
        <ul id="searchList_${id}">
            ${
              emptyValue
                ? `<li onclick="_clickOption('searchList_${id}', '', '${emptyValue}');">${emptyValue}</li>`
                : ""
            }
        </ul>
    </div>
	<div class="issueText" id="issue_${id}"></div>
    `;
  $("#" + id + "_container").html(template);
}

function otpField(options) {
  const { id = "otpCode", length = 6, onKeyPressFunction = null } = options;
  let inputs = "";
  for (let i = 0; i < length; i++) {
    inputs += `
      <input
        class="otp_text_field"
        type="text"
        inputmode="numeric"
        maxlength="1"
        data-index="${i}"
        ${onKeyPressFunction ? `onkeypress="${onKeyPressFunction}"` : ''}
      />
    `;
  }

  const template = `
  <div class="otp-wrapper">
    <div class="otp-container" id="${id}_box">
      ${inputs}
    </div>
    <input type="hidden" id="${id}" />
    <div class="issueText" id="issue_${id}"></div>
  </div>
  `;
  $("#" + id + "_container").html(template);

  const otpInputs = $("#" + id + "_box .otp_text_field");

  // Auto move + update hidden input
  otpInputs.on("input", function () {
    let value = $(this).val();

    if (value.length === 1) {
      $(this).next(".otp_text_field").focus();
    }
    updateOTP();
  });

  // Paste OTP (e.g. 109735)
  otpInputs.on("paste", function (e) {
    e.preventDefault();

    let pastedData = e.originalEvent.clipboardData.getData("text")
      .replace(/\D/g, "")
      .slice(0, length);
    
    for (let i = 0; i < pastedData.length; i++) {
      otpInputs.eq(i).val(pastedData[i]);
    }

    updateOTP();
    // focus next empty or last box
    otpInputs.eq(pastedData.length - 1).focus();
  });

  // Backspace move back
  otpInputs.on("keydown", function (e) {
    if (e.key === "Backspace" && $(this).val() === "") {
      $(this).prev(".otp_text_field").focus();
    }
  });

  function updateOTP() {
    let otp = "";
    otpInputs.each(function () {
      otp += $(this).val();
    });
    $("#" + id).val(otp);
  }
}

function _selectOption(selectBoxId) {
  $("#txtSearchValue_" + selectBoxId).val("");
  filter(selectBoxId);

  if ($("#searchPanel_" + selectBoxId).is(":visible")) {
    $("#searchPanel_" + selectBoxId).css("display", "none");
  } else {
    $("#searchPanel_" + selectBoxId).css("display", "flex");
    $("#txtSearchValue_" + selectBoxId).focus();
  }
}

document.addEventListener("click", (e) => {
  document.querySelectorAll(".text_field_container").forEach((container) => {
    // If the click is not inside the container, hide its search panel.
    if (!container.contains(e.target)) {
      const searchPanel = container.querySelector(".searchPanel");
      if (searchPanel) {
        searchPanel.style.display = "none";
      }
    }
  });
});

function filter(selectBoxId) {
  var valThis = $("#txtSearchValue_" + selectBoxId).val();
  $("#searchList_" + selectBoxId + " > li").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(valThis.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}
function _clickOption(selectedOption, id, value) {
  selectBoxId = selectedOption.replace("searchList_", "");
  // Clear previous options and set the selected one
  $("#" + selectBoxId).html(
    `<option selected="selected" value="${id}">${value}</option>`,
  );
  _selectOption(selectBoxId);
}

/// Toggle Password Visibility ///
$(document).on("input", ".text_field[type='password']", function () {
  const icon = $(".toggle-password[data-target='" + this.id + "']");
  if (this.value.length > 0) {
    icon.show();
  } else {
    icon.hide();
    $(this).attr("type", "password");
    icon.find("i").removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
  }
});

// Click the eye icon to show or hide password
$(document).on("click", ".toggle-password", function () {
  const input = $("#" + $(this).data("target"));
  const icon = $(this).find("i");

  if (input.attr("type") === "password") {
    input.attr("type", "text"); // show password
    icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
  } else {
    input.attr("type", "password"); // hide password
    icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
  }
});


function _getSelectCategory(fieldId) {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/settings/information-category/fetch-information-category?statusId=1`,
			accessKey: true,
		})
		.then((response) => {
			for (let i = 0; i < response.data.length; i++) {
				const id = response.data[i].categoryId;
				const value = response.data[i].categoryName;
				$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
			}				
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
  	}
}