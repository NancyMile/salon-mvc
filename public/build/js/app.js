let step=1;function startApp(){displaySection(),tabs(),paginationButtons()}function displaySection(){const t=document.querySelector(".visible");t&&t.classList.remove("visible");document.querySelector("#step-"+step).classList.add("visible");const e=document.querySelector(".active");e&&e.classList.remove("active");document.querySelector(`[data-step="${step}"]`).classList.add("active")}function tabs(){document.querySelectorAll(".tabs button").forEach(t=>{t.addEventListener("click",(function(t){step=parseInt(t.target.dataset.step),displaySection(),paginationButtons()}))})}function paginationButtons(){const t=document.querySelector("#previous"),e=document.querySelector("#next");1===step?(t.classList.add("hide"),e.classList.remove("hide")):3===step?(t.classList.remove("hide"),e.classList.add("hide")):(t.classList.remove("hide"),e.classList.remove("hide"))}document.addEventListener("DOMContentLoaded",(function(){startApp()}));