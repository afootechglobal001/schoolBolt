function formatDate(newDate) {
  if (!newDate) return "";

  const d = new Date(newDate);
  const weekday = d.toLocaleDateString("en-US", { weekday: "long" }).toUpperCase();
  const day = d.getDate();
  const month = d.toLocaleDateString("en-US", { month: "long" }).toUpperCase();
  const year = d.getFullYear();

  // Get ordinal suffix
  const getOrdinal = (n) => {
    const j = n % 10,
      k = n % 100;
    if (j === 1 && k !== 11) return `${n}ST`;
    if (j === 2 && k !== 12) return `${n}ND`;
    if (j === 3 && k !== 13) return `${n}RD`;
    return `${n}TH`;
  };

  return `${weekday} ${getOrdinal(day)} ${month}, ${year}`;
}

function _calculateAge(dateString) {
  if (!dateString) return "N/A";

  let dob;
  if (dateString.includes("/")) {
    let parts = dateString.split("/");
    dob = `${parts[2]}-${parts[1]}-${parts[0]}`;
  } else {
    dob = dateString;
  }

  let birthDate = new Date(dob);
  if (isNaN(birthDate)) return "Invalid date";

  let today = new Date();
  let age = today.getFullYear() - birthDate.getFullYear();

  if (
    today <
    new Date(today.getFullYear(), birthDate.getMonth(), birthDate.getDate())
  ) {
    age--;
  }
  return age;
}