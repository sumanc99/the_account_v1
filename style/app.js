document.addEventListener('DOMContentLoaded', ()=>{
 let elems = document.querySelectorAll(".sidenav");
 // let option = {edge:'right'};
 let instances = M.Sidenav.init(elems);

 let dates = document.querySelectorAll(".datepicker");
 let dates_instances = M.Datepicker.init(dates);

 let selects = document.querySelectorAll("select");
 let selects_instances = M.FormSelect.init(selects);

 let menus = document.querySelectorAll(".dropdown-trigger");
 let menu_instances = M.Dropdown.init(menus);
});