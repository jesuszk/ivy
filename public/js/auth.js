const checkbox = document.getElementById("checkbox");
checkbox.addEventListener("change", () => {
  checkbox.checked
    ? localStorage.setItem("theme", "dark")
    : localStorage.setItem("theme", "light");
  document.body.classList.toggle("dark");
});

const startTheme = () => {
  let theme = localStorage.getItem("theme") ?? "light";
  if (theme === "light") document.body.classList.remove("dark");
  else {
    document.getElementById("checkbox").checked = true;
    document.body.classList.add("dark");
  }
};

startTheme();
