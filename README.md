# CP476---Student-Grade-Management-Portal

CP476A Group Project Requirements
Lunshan (Shaun) Gao, Ph.D., P.Eng.

Introduction 
The purpose of the group (4 students) project is to provide an opportunity for students to apply 
topics covered in this course and gain better understanding of how internet computing works. 
The project also trains students verbal and writing communication skills. The requirements are 
as follows.
Requirement
1. Design and develop a web server that interacts between web users and a database server.
(Note: the web server is Apache and database server is MySQL. The web server is using
Windows operating system. The server site language is PHP).
2. There are two approaches for programming queries from PHP. One is called direct run
SQL statements and the other is called prepared SQL statements. It will be better to use 
the prepared approach.
3. The project requires to execute at least two (SELECT and UPDATE) SQL statements that 
are initiated from web users.
4. Your MySQL database will have at least two tables. One is called “Name Table” and the 
other is called “Course Table”. The two table formats are described in Appendix A. The 
data for the two tables will be provided around week 7
5. You need to output student final grade based on the data in the two input tables. The 
output format is described in Appendix B.
6. Third-party packages such as XAMPP, phpMyAdmin, and WAMP are prohibited. If you 
use any third-party packages, the penalty (10-20%) will apply.
7. If your project has implemented for SQL injection attack, you will get bonus (5-10%). 
Evaluation
This group project will be evaluated with two sections.
1. Present your design in the group presentation section.
(Note: the presentation time will be limited in 6 minutes (3 minutes theory and 3 minutes 
demonstration)
2. Write a project report by end of this semester to describe how your software product 
works. The report should be a software design documentation.
(Note: there is no number of words requirement. The evaluation of the report will be 
based on the rubrics in the course syllabus of CP476B in MyLearningSpace).


Appendix A
The three SQL database tables are as follows.
Name Table
Student ID Student Name
123456789 John Hay
223456789 Mary Smith
…. …..
Course Table
Student ID Course Code Test 1 Test 2 Test 3 Final exam 
423456789 CP317 75.3 80.4 60.3 70.5
223456789 CP414 80.2 90.5 50.4 75.6
123456789 CP460 60.5 70.6 80.6 80.6
…. …..
Note 1: The student table and the course table will be uploaded in myls around week 7. 
Note 2: the student ID and students’ name are unique. However, one student may take multiple 
courses.
Appendix B
Final grade output
Student ID Student Name Course Code Final grade (test 
1,2,3-3x20%, final 
exam 40%
123456789 John Hay CP460 66.7
223456789 Mary Smith CP414 74.8
…. ….. ……
Note 1: each test weighs 20% and the final exam weighs 40%. The final grade is calculated with 
the following: (test,1,2,3) 3x20% + (final exam) 40% = 100%.
Note 2: all the grades should be decimal number with one digital after the dot
