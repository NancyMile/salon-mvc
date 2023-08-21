let step=1,initialStep=1,lastStep=3;const appointment={name:"",date:"",time:"",services:[]};function startApp(){displaySection(),tabs(),paginationButtons(),previousPage(),nextPage(),queryingAPI(),clientName()}function displaySection(){const e=document.querySelector(".visible");e&&e.classList.remove("visible");document.querySelector("#step-"+step).classList.add("visible");const t=document.querySelector(".active");t&&t.classList.remove("active");document.querySelector(`[data-step="${step}"]`).classList.add("active")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){step=parseInt(e.target.dataset.step),displaySection(),paginationButtons()}))})}function paginationButtons(){const e=document.querySelector("#previous"),t=document.querySelector("#next");1===step?(e.classList.add("hide"),t.classList.remove("hide")):3===step?(e.classList.remove("hide"),t.classList.add("hide")):(e.classList.remove("hide"),t.classList.remove("hide"))}function previousPage(){document.querySelector("#previous").addEventListener("click",(function(){step<=initialStep||(step--,paginationButtons(),displaySection())}))}function nextPage(){document.querySelector("#next").addEventListener("click",(function(){step>=lastStep||(step++,paginationButtons(),displaySection())}))}async function queryingAPI(){try{const e="http://localhost:8080/services",t=await fetch(e);displayServices(await t.json())}catch(e){console.log(e)}}function displayServices(e){e.forEach(e=>{const{id:t,name:n,price:s}=e,i=document.createElement("P");i.classList.add("service-name"),i.textContent=n;const c=document.createElement("P");c.classList.add("service-price"),c.textContent="$ "+s;const o=document.createElement("DIV");o.classList.add("service"),o.dataset.idService=t,o.onclick=function(){selectService(e)},o.appendChild(i),o.appendChild(c),document.querySelector("#services").appendChild(o)})}function selectService(e){const{id:t}=e,{services:n}=appointment,s=document.querySelector(`[data-id-service="${t}"]`);n.some(e=>e.id===t)?(appointment.services=n.filter(e=>e.id!==t),console.log(appointment),s.classList.remove("selected")):(appointment.services=[...n,e],console.log(appointment),s.classList.add("selected"))}function clientName(){appointment.name=document.querySelector("#name").value}document.addEventListener("DOMContentLoaded",(function(){startApp()}));