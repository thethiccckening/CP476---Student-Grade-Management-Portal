document.addEventListener('DOMContentLoaded', () => {
   
  //prevent form from submitting by default
   document.getElementById("search_student_form").addEventListener("submit", function (event) {
    event.preventDefault();
  });


  const closeOverlayButton = document.getElementById('close-overlay');

  closeOverlayButton.addEventListener('click', closeOverlay);


// setting up onclick listener
  document.getElementById("show-all-students").addEventListener("click", function() {
    getData('students');
  });
  document.getElementById("show-all-courses").addEventListener("click", function() {
    getData('courses');
  });
  document.getElementById("show-all-grades").addEventListener("click", function() {
    getData('grades');
  });
  document.getElementById("search_student_info").addEventListener("click", function() {
    getData('search_student_info');
  });
  document.getElementById("search_student_course").addEventListener("click", function() {
    getData('search_student_course');
  });
  document.getElementById("search_student_final").addEventListener("click", function() {
    getData('search_student_final');
  });


  //function to handle general search of student DB
  function getData(action) {
    if (action == "search_student_info"){
      const studentId = document.getElementById("student-id").value;
      
      fetch(`searchstudent.php?action=${action}&student-id=${studentId}`)
      .then(response => response.json())
      .then(data => {

        // Display the error message in the overlay and close button
        if (data.error) {
         // hide results overlay
         document.getElementById("overlay").classList.add("hidden");
         additional_button(data);
          
        } else {
          // Update the results table and display the overlay
          updateResultsTable(data);
          document.getElementById("overlay").classList.remove("hidden");
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
    } else if (action == "search_student_course") {
      const studentId = document.getElementById("student-id2").value;
      const courseCode = document.getElementById("course-code").value;

      fetch(`searchstudent.php?action=${action}&student-id=${studentId}&course-code=${courseCode}`)
      .then(response => response.json())
      .then(data => {

        // Display the error message in the overlay and close button
        if (data.error) {
         // hide results overlay
         document.getElementById("overlay").classList.add("hidden");
         additional_button(data);
          
        } else {
          // Update the results table and display the overlay
          updateResultsTable(data);
          document.getElementById("overlay").classList.remove("hidden");
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });

    } else if (action == "search_student_final") {
      const studentId = document.getElementById("student-id3").value;
      const courseCode = document.getElementById("course-code3").value;

      fetch(`searchstudent.php?action=${action}&student-id=${studentId}&course-code=${courseCode}`)
      .then(response => response.json())
      .then(data => {

        // Display the error message in the overlay and close button
        if (data.error) {
         // hide results overlay
         document.getElementById("overlay").classList.add("hidden");
         additional_button(data);
          
        } else {
          // Update the results table and display the overlay
          updateResultsTable(data);
          document.getElementById("overlay").classList.remove("hidden");
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });

    }else{

      fetch(`getallresults.php?action=${action}`)
      .then(response => response.json())
      .then(data => {
        // Update the results table and display the overlay
        updateResultsTable(data);
        document.getElementById("overlay").classList.remove("hidden");
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
    }

  }

  // function to show error message and overlay for non found data
  function additional_button(data){
    const errorMessage = `<div class="error-container"> <div><h4>${data.error}</h4></div>
                          <div><button id="close-overlay1" class="action-button">Close</button> </div></div>`;

    // show eorror message overlay
    document.getElementById("form-overlay").innerHTML = errorMessage;
    document.getElementById("form-overlay").classList.remove("hidden");    

    // Add an event listener to the close button
    document.getElementById("close-overlay1").addEventListener("click", function () {
      document.getElementById("form-overlay").classList.add("hidden");
    });


  }


  //function to display valid search results. 
  function updateResultsTable(data) {

    const table = document.getElementById("results-table");
    const thead = table.querySelector("thead");
    const tbody = table.querySelector("tbody");
  
    // Clear existing data
    thead.innerHTML = '';
    tbody.innerHTML = '';
  
    if (data.length === 0) {
      return;
    }
  
    // Create table headers
    const headerRow = document.createElement("tr");
    for (const key in data[0]) {
      const th = document.createElement("th");
      th.textContent = key;
      headerRow.appendChild(th);
    }
    thead.appendChild(headerRow);
  
    // Create table rows
    data.forEach(row => {
      const tr = document.createElement("tr");
      for (const key in row) {
        const td = document.createElement("td");
        td.textContent = row[key];
        tr.appendChild(td);
      }
      tbody.appendChild(tr);
    });
  }


  //function to close overlay for valid results
  function closeOverlay() {
    const overlay = document.getElementById('overlay');
    overlay.classList.add('hidden');
  }



});