// JavaScript-Code für das Backend
// ----------------------------------------------

// Funktion zum Überprüfen der Eingabeformulare im Backend
function validateForm() {
  var email = document.getElementById("email").value;
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  if (email === "" || username === "" || password === "") {
    alert("Bitte füllen Sie alle Felder aus.");
    return false;
  }
}

// JavaScript-Code für das Frontend
// ----------------------------------------------

// Funktion zum Laden der Kunden und Fallstudien im Frontend
function loadCustomersAndCaseStudies() {
  // AJAX-Anfrage an den Server, um Kunden und Fallstudien abzurufen
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "backend/api.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var customers = response.customers;
      var caseStudies = response.caseStudies;

      // Kunden in der Oberfläche anzeigen
      var customersContainer = document.getElementById("customers-container");
      customersContainer.innerHTML = "";
      for (var i = 0; i < customers.length; i++) {
        var customer = customers[i];
        var customerCard = document.createElement("div");
        customerCard.className = "frontend-card";
        customerCard.innerHTML = `
            <h2>${customer.name}</h2>
            <img src="Images/customers/${customer.logo}" alt="${customer.name} Logo">
          `;
        customersContainer.appendChild(customerCard);
      }

      // Fallstudien in der Oberfläche anzeigen
      var caseStudiesContainer = document.getElementById(
        "case-studies-container"
      );
      caseStudiesContainer.innerHTML = "";
      for (var j = 0; j < caseStudies.length; j++) {
        var caseStudy = caseStudies[j];
        var caseStudyCard = document.createElement("div");
        caseStudyCard.className = "frontend-card";
        caseStudyCard.innerHTML = `
            <h2>${caseStudy.title}</h2>
            <img src="Images/case_studies/${caseStudy.image}" alt="${caseStudy.title} Image">
            <p>${caseStudy.description}</p>
          `;
        caseStudiesContainer.appendChild(caseStudyCard);
      }
    }
  };
  xhr.send();
}

// Event-Listener für das Laden der Kunden und Fallstudien
document.addEventListener("DOMContentLoaded", function () {
  loadCustomersAndCaseStudies();
});
