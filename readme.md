# Students-Profile

This demonstrates how to use classes in PHP CRUD.

## Model

province -> id (PK, AI), name  
town_city -> id (PK, AI), name  
students -> id (PK, AI), student_number, first_name, last_name, middle_name, gender, birthday  
student_details -> id (PK, AI), student_id (int), contact_number, street, town_city (FK), province (int), zip_code

To Dos:

- CRUD of Province                                                                              done
- CRUD of Town City                                                                             done
- Fix Edit of Student's Profile include table student_details                                   done
- Fix Edit of Student's Profile use appropriate controls for gender and birthdate.              done
- Modify display in students table include some data from student_details table                 done
- Fix Gender display use 'F' or 'M' (do not change database structure)                          done
- Fix Birthdate display use 'Jan 1 2020' format.                                                done
- Fix Delete of Student's Profile include student_details.                                      done
<!--
After the Code Session 2
Using the skills you've learned from IM and DB2 create reports for this project
-->
- Add 3 types of Report in Menu Report
- Modify index.php, create a chart using ChartJS (dashboard like)
