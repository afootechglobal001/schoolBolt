function formatDate(newDate) {
  if (!newDate) return "";

  const d = new Date(newDate);
  const weekday = d.toLocaleDateString("en-US", { weekday: "long" }).toUpperCase();
  const day = d.getDate();
  const month = d.toLocaleDateString("en-US", { month: "long" }).toUpperCase();
  const year = d.getFullYear();

  return `${weekday} ${day} ${month}, ${year}`;
}
