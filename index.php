<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lala Land Student Management Portal</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js" defer></script>
</head>
<body>
  <h1 style="text-align: center;">Lala Land Student Management Portal</h1>


<div class="button-container">
    <div>
      <button id="show-all-students" class="action-button">Show All Students</button>
      <button id="show-all-courses" class="action-button">Show All Courses</button>
      <button id="show-all-grades" class="action-button">Show All Final Grades</button>
    </div>
</div> 

<form  id="search_student_form" method="GET"  >
  <input type="hidden" name="form_name" value="search_student_info">
  <div class="form-row">
    <h3>Search Student Information</h3>
    <label id="f1_error_result"></label>
    <label for="student-id">Enter Student ID:</label>
    <input type="text" id="student-id" name="student-id" required>
    <div >
      <button class="action-button" type="button" id="search_student_info">Search</button>
  </div>
  </div>
</form>

<form  id="search_student_course_form" method="GET"  >
  <input type="hidden" name="form_name" value="search_student_course">
  <div class="form-row">
    <h3 >Search Course Results for a Student</h3>
    <label id="f2_error_result"></label>
    <label for="student-name" id="student-name-id">Enter Student ID:</label>
    <input type="text" id="student-id2" name="student-id">
    <label for="student-name">Enter Course Code:</label>
    <input type="text" id="course-code" name="course-code">
    <div >
      <button class="action-button" type="button" id="search_student_course">Search</button>
  </div>
  </div>
</form>

<form  id="search_student_final_form" method="GET"  >
  <input type="hidden" name="form_name" value="search_student_final">
  <div class="form-row">
    <h3 >Search Final grade by Course Code and Student ID</h3>
    <label id="f3_error_result"></label>
    <label for="student-name">Enter Student ID:</label>
    <input type="text" id="student-id3" name="student-id">
    <label for="student-name">Enter Course Code:</label>
    <input type="text" id="course-code3" name="course-code">
    <div >
      <button class="action-button" type="button" id="search_student_final">Search</button>
    </div>
  </div>
</form>

  <div id="overlay" class="overlay hidden">

    <div class="overlay-content">
      <h3>Results</h3>
      <table id="results-table" border="1">
        <thead>
          <!-- Headers will be populated here -->
        </thead>
        <tbody>
          <!-- Data will be populated here -->
        </tbody>
      </table>
      <button id="close-overlay" class="action-button">Close</button>
    </div>
  </div>

  <div id="form-overlay" class="overlay2 hidden">
    <button id="close-form-overlay" class="action-button">Close</button>
    <div id="form-container"></div>
</div>



<div id="update-overlay" class="overlay hidden">
  <div class="overlay-content">
    <h3>Results</h3>

    <input  id="update_result" value="" style="display: none;">
    <table id="update-results-table" border="1">
      <thead id='update-thead' >
        <!-- Headers will be populated here -->
      </thead>
      <tbody id="update-tbody">
        <!-- Data will be populated here -->
      </tbody>
    </table>
    <button id="save-overlay" class="action-button">Save</button>
    <button id="close-update-overlay" class="action-button">Close</button>

  </div>

</div>

</body>
</html>
