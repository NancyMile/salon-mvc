let step=1,initialStep=1,lastStep=3;const appointment={name:"",id:"",date:"",time:"",services:[]};function startApp(){displaySection(),tabs(),paginationButtons(),previousPage(),nextPage(),queryingAPI(),clientId(),clientName(),selectDate(),seletTime(),displayResume()}function displaySection(){const e=document.querySelector(".visible");e&&e.classList.remove("visible");document.querySelector("#step-"+step).classList.add("visible");const t=document.querySelector(".active");t&&t.classList.remove("active");document.querySelector(`[data-step="${step}"]`).classList.add("active")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){step=parseInt(e.target.dataset.step),displaySection(),paginationButtons()}))})}function paginationButtons(){const e=document.querySelector("#previous"),t=document.querySelector("#next");1===step?(e.classList.add("hide"),t.classList.remove("hide")):3===step?(e.classList.remove("hide"),t.classList.add("hide"),displayResume()):(e.classList.remove("hide"),t.classList.remove("hide"))}function previousPage(){document.querySelector("#previous").addEventListener("click",(function(){step<=initialStep||(step--,paginationButtons(),displaySection())}))}function nextPage(){document.querySelector("#next").addEventListener("click",(function(){step>=lastStep||(step++,paginationButtons(),displaySection())}))}async function queryingAPI(){try{const e="http://localhost:8080/api/services",t=await fetch(e);displayServices(await t.json())}catch(e){console.log(e)}}function displayServices(e){e.forEach(e=>{const{id:t,name:n,price:i}=e,s=document.createElement("P");s.classList.add("service-name"),s.textContent=n;const c=document.createElement("P");c.classList.add("service-price"),c.textContent="$ "+i;const a=document.createElement("DIV");a.classList.add("service"),a.dataset.idService=t,a.onclick=function(){selectService(e)},a.appendChild(s),a.appendChild(c),document.querySelector("#services").appendChild(a)})}function selectService(e){const{id:t}=e,{services:n}=appointment,i=document.querySelector(`[data-id-service="${t}"]`);n.some(e=>e.id===t)?(appointment.services=n.filter(e=>e.id!==t),i.classList.remove("selected")):(appointment.services=[...n,e],i.classList.add("selected"))}function clientName(){appointment.name=document.querySelector("#name").value}function clientId(){appointment.id=document.querySelector("#id").value}function selectDate(){document.querySelector("#date").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[0,6].includes(t)?(e.target.value="",displayAlert("Close on weekends","error",".form")):appointment.date=e.target.value}))}function seletTime(){document.querySelector("#time").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t>10&&t<18?appointment.time=e.target.value:(e.target.value="",displayAlert("Open from 10am to 6pm","error",".form"))}))}function displayAlert(e,t,n,i=!0){const s=document.querySelector(".alert");s&&s.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alert"),c.classList.add(t);document.querySelector(n).appendChild(c),i&&setTimeout(()=>{c.remove()},3e3)}function displayResume(){const e=document.querySelector(".content-resume");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(appointment).includes("")||0===appointment.services.length)return void displayAlert("Services,date or time missing.","error",".content-resume",!1);const{name:t,date:n,time:i,services:s}=appointment,c=document.createElement("H3");c.textContent="Services Resume",e.appendChild(c),s.forEach(t=>{const{id:n,name:i,price:s}=t,c=document.createElement("DIV");c.classList.add("container-service");const a=document.createElement("P");a.textContent=i;const o=document.createElement("P");o.innerHTML="<span>Price:</span>$"+s,c.appendChild(a),c.appendChild(o),e.appendChild(c)});const a=document.createElement("H3");a.textContent="Appointment Resume",e.appendChild(a);const o=document.createElement("P");o.innerHTML="<span>Name:</span>"+t;const d=document.createElement("P");d.innerHTML="<span>Date:</span>"+n;const r=document.createElement("P");r.innerHTML="<span>Time:</span>"+i;const l=document.createElement("BUTTON");l.classList.add("button"),l.textContent="Book Appointment",l.onclick=bookAppointment,e.appendChild(o),e.appendChild(d),e.appendChild(r),e.appendChild(l)}async function bookAppointment(){const{id:e,name:t,date:n,time:i,services:s}=appointment,c=s.map(e=>e.id),a=new FormData;a.append("date",n),a.append("time",i),a.append("user_id",e),a.append("services",c);const o=await fetch("http://localhost:8080/api/services",{method:"POST",body:a});await o.json()}document.addEventListener("DOMContentLoaded",(function(){startApp()}));