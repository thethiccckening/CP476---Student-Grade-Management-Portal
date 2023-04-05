document.addEventListener('DOMContentLoaded', () => {
   
  //prevent form from submitting by default
   document.getElementById("search_student_form").addEventListener("submit", function (event) {
    event.preventDefault();
  });


  const closeOverlayButton = document.getElementById('close-overlay');
  const closeUpdateOverlayButton = document.getElementById('close-update-overlay');
  const saveOverlayButton = document.getElementById('save-overlay');
  var updateResults = document.getElementById('update_result');
  var f1_error_result = document.getElementById('f1_error_result');
  var f2_error_result = document.getElementById('f2_error_result');
  var f3_error_result = document.getElementById('f3_error_result');


  closeOverlayButton.addEventListener('click', closeOverlay);
  saveOverlayButton.addEventListener('click', saveOverlay);
  closeUpdateOverlayButton.addEventListener("click", closeUpdateOverlay);

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

  function validateStudentID(studentId){
    const retstudentId = studentId.trim(); //remove empty spaces
    return /^\d+$/.test(retstudentId); //check if numbers only
  }

  function validateCourseCode(courseCode){
    const retcourseCode = courseCode.trim(); //remove empty spaces
    return /^[A-Z]{2}\d{3}$/.test(retcourseCode);
  }

  // check that grade is between 0-100 or 0.0 to 100.0
  function validateGrade(gradedata){
    error = true; 
    gradedata.forEach((row) => {
      const test1 = row.Test_1;
      const test2 = row.Test_2;
      const test3 = row.Test_3;
      const final = row.Final_exam;

      error1 = /^(?!.*[a-zA-Z])(?:\d{1,2}(?:\.\d)?|100(?:\.0)?)$/.test(test1); 
      error2 = /^(?!.*[a-zA-Z])(?:\d{1,2}(?:\.\d)?|100(?:\.0)?)$/.test(test2); 
      error3 = /^(?!.*[a-zA-Z])(?:\d{1,2}(?:\.\d)?|100(?:\.0)?)$/.test(test3); 
      error4 = /^(?!.*[a-zA-Z])(?:\d{1,2}(?:\.\d)?|100(?:\.0)?)$/.test(final); 

      console.log (error1) ;
      console.log (error2) ;
      console.log (error3) ;
      console.log (error4) ;
      error = error && error1 && error2 && error3 && error4;
      console.log (error);


    });
    return error;
   
  }


  //function to handle general search of student DB
  function getData(action) {

    if (action == "search_student_info"){
      document.getElementById("update-overlay").classList.add("hidden");

      const studentId = document.getElementById("student-id").value;
      if (!validateStudentID(studentId)) {
        f1_error_result.textContent  = 'Invalid input. Please enter a valid Student ID!';
        return;
      }

      f1_error_result.textContent = "";

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
          updateResultsTable(data, 0);
          document.getElementById("overlay").classList.remove("hidden");
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
    } else if (action == "search_student_course") {
      const studentId = document.getElementById("student-id2").value;
      const courseCode = document.getElementById("course-code").value;

      //input validation and sanitization
      if(studentId == ""){
        if (!validateCourseCode(courseCode)) {
          f2_error_result.textContent  = 'Invalid input. Please enter a valid Course Code!';
          return;
        }
      } 
      else if(courseCode == ""){
        if (!validateStudentID(studentId)) {
          f2_error_result.textContent  = 'Invalid input. Please enter a valid Student ID!';
          return;
        }
      } else if (studentId != "" && courseCode != "" ) {
        if (!validateStudentID(studentId)|| !validateCourseCode(courseCode)) {
          f2_error_result.textContent  = 'Invalid input. Please enter a valid Student ID and Course Code!';
          return;
        }
      }

      f2_error_result.textContent = "";


      fetch(`searchstudent.php?action=${action}&student-id=${studentId}&course-code=${courseCode}`)
      .then(response => response.json())
      .then(data => {

        // Display the error message in the overlay and close button
        if (data.error) {
         // hide results overlay
         document.getElementById("update-overlay").classList.add("hidden");
         document.getElementById("overlay").classList.add("hidden");
         additional_button(data);
          
        } else {
          // Update the results table and display the overlay
          updateResultsTable(data,1);
          document.getElementById("update-overlay").classList.remove("hidden");

        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });

    } else if (action == "search_student_final") {
      document.getElementById("update-overlay").classList.add("hidden");

      const studentId = document.getElementById("student-id3").value;
      const courseCode = document.getElementById("course-code3").value;

      //input validation and sanitization
      if(studentId == ""){
        if (!validateCourseCode(courseCode)) {
          f3_error_result.textContent  = 'Invalid input. Please enter a valid Course Code!';
          return;
        }
      } 
      else if(courseCode == ""){
        if (!validateStudentID(studentId)) {
          f3_error_result.textContent  = 'Invalid input. Please enter a valid Student ID!';
          return;
        }
      } else if (studentId != "" && courseCode != "" ) {
        if (!validateStudentID(studentId)|| !validateCourseCode(courseCode)) {
          f3_error_result.textContent  = 'Invalid input. Please enter a valid Student ID and Course Code!';
          return;
        }
      }
      f3_error_result.textContent = "";

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
          updateResultsTable(data, 0);
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
        document.getElementById("update-overlay").classList.add("hidden");

        // Update the results table and display the overlay
        updateResultsTable(data, 0);
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
  function updateResultsTable(data, update) {
    var table = document.getElementById("results-table");
    var thead = table.querySelector("thead");
    var tbody = table.querySelector("tbody");

    //get second overlay that allows for editale and updateble rows. 
    if( update == 1){
       table = document.getElementById("update-results-table");
       thead = table.querySelector("thead");
       tbody = table.querySelector("tbody");
    } 

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
      th.textContent = key.replace('_', " ");
      headerRow.appendChild(th);
    }
    thead.appendChild(headerRow);
  
    // Create table rows using arrow funcion
    data.forEach(row => {
      var rowId = '';
      const tr = document.createElement("tr");
      for (const key in row) {
        const td = document.createElement("td");
        if( update == 1){  // Make some cells editable
          if (key == "Test_1" || key == "Test_2" || key == "Test_3" || key == "Final_exam") {
            td.setAttribute("contenteditable", "true");
          }
        } 

        //set an identifier for each row to be studentId and coursecode
        if (key == "Student_ID" || key == "Course_Code") { // Set the row identifier
          rowId += row[key]+'+'; 
        }

        td.textContent = row[key];
        tr.appendChild(td);
        
      }
      if( update == 1) {
        // create a delete button to delete student course and event listener
        const deleteStudentCourse = document.createElement("button");
        deleteStudentCourse.textContent = "Delete";
        deleteStudentCourse.classList.add("action-button");
        deleteStudentCourse.setAttribute("data-row-identifier", rowId); // Set custom attribute
        deleteStudentCourse.addEventListener("click", (event) => {
          const rowId = event.target.getAttribute("data-row-identifier");
          deleteStudentCourse.disabled = true;//disable buttong so not usable. 
          deletedata(rowId);
        });

        //add button to row in own column
        const delbuttonTd = document.createElement("td");
        delbuttonTd.appendChild(deleteStudentCourse);
        tr.appendChild(delbuttonTd);
      }

      tbody.appendChild(tr);
    });
  }


  //function to close overlay for valid results
  function closeOverlay() {
    const overlay = document.getElementById('overlay');
    overlay.classList.add('hidden');
  }

  function closeUpdateOverlay (){
    const overlay = document.getElementById('update-overlay');
    overlay.classList.add('hidden');
    
    updateResults.style.display = 'none';
  }

  //function to save changes to DB
  function saveOverlay() {
    //table that has the resuls
    const table = document.getElementById("update-results-table");
    const thead = table.querySelector("thead");
    const tbody = table.querySelector("tbody");
    // get table headers, create an array to loop through data
    //use arrow function called th that returns the text value of the header
    const headers = Array.from(thead.querySelectorAll("th")).map(th => th.textContent);
    //loop through table rows and pull the data using an arrow function
    const data = Array.from(tbody.querySelectorAll("tr")).map(tr => {
      const row = {};
      //iterate through the data cells for each row and get the data 
      tr.querySelectorAll("td").forEach((td, index) => {
        //store hearder as key and data as value
        const header = headers[index];
        row[header] = td.textContent;
        // row[index] = td.textContent; only stores values at numeric indices
      });

      return row;
    });

    //validate and sanitize
    if (!validateGrade(data)) {
      updateResults.value  = 'Invalid input. Please enter a valid Grade from 0 - 100!';
      updateResults.style.display = 'block';
      return;
    } 

    updateResults.value = "";
    //prepare data as JSON object to be sent to the server using POST
    fetch('updaterecord.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ data: data })
    })
      .then(response => response.json())
      .then(data => {
        

        if (data.status === 'error') {
          updateResults.value = 'Error saving Student Record! Please try again later!';
        } else {
          updateResults.value = 'Student Record Successfully updated!';
        }
        //update action results to user
        updateResults.style.display = 'block';
      })
      .catch(error => {
        updateResults.value = 'Error saving data';
        updateResults.style.display = 'block';

      });

  }

  //delete student from course table and update final table
  function deletedata(rowId){
    const splitRow = rowId.split('+');
    const studentId = splitRow[0];
    const courseCode = splitRow[1];

    //prepare data as JSON object to be sent to the server using POST
    fetch(`deletestudentcourse.php?student-id=${studentId}&course-code=${courseCode}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
          updateResults.value = 'Error deleting Student Record! Please try again later!';
        } else {
          updateResults.value = 'Student Record Successfully deleted! Please refresh the page!';
        }
        //update action results to user
        updateResults.style.display = 'block';
      })
      .catch(error => {
        updateResults.value = 'Error deleting data';
        updateResults.style.display = 'block';

    });

  }

 
});