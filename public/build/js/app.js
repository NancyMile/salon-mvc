let step=1;function startApp(){displaySection(),tabs()}function displaySection(){const t=document.querySelector(".visible");t&&t.classList.remove("visible");document.querySelector("#step-"+step).classList.add("visible")}function tabs(){document.querySelectorAll(".tabs button").forEach(t=>{t.addEventListener("click",(function(t){step=parseInt(t.target.dataset.step),displaySection()}))})}document.addEventListener("DOMContentLoaded",(function(){startApp()}));