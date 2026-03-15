/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
/**  =====================
      Custom js start
==========================  **/



/**  =====================		NOT A NEGATIVE		=====================  **/
document.querySelectorAll(".notnega").forEach((el) => {
    // Optional: ensure HTML constraints are set
    if (!el.hasAttribute("min")) el.setAttribute("min", "0");

    // Prevent typing "-" and "e" (e allows scientific notation like 1e5)
    el.addEventListener("keydown", (e) => {
      if (["-", "Minus", "e", "E"].includes(e.key)) {
        e.preventDefault();
      }
	   
    });

    // Sanitize on input (covers paste)
    el.addEventListener("input", () => {
      if (el.value === "") return;

      const n = Number(el.value);
      if (Number.isNaN(n)) return;

      if (n < 0) el.value = "0"; // or Math.abs(n) if you prefer3
	 
    });
});

/**  =====================
      Default js start
==========================  **/
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});


$(function () {
	/**  =====================
		 INITIALIZATION
	==========================  **/
	const log = (msg) => $('#log').text(msg);
	
	// SWEET ALERT 2
	// CHECKING VALIDITY	
	

	// FORM REQUIREMENT CHECKER

	// console.log("script loaded");
});
