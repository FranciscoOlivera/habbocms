var Loader;

function myLoader() {
    Loader = setTimeout(showPage, 500);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("loaded").style.display = "block";
}