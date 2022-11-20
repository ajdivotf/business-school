# business-school

video with running application
-------------------------

[performance demonstration](https://youtu.be/yeJVlxQeZ54)

database
-------------------------

the file for exporting the database structure is contained in the folder `src/main/resources/com/example/demo/sql_files`. database already has data.

a brief description
-------------------------

this is the implementation of a business school website with advanced training courses. there are two parts - student and manager. 
the student has access to editing the profile, viewing courses, enrolling in them, viewing applications and grading the course after the application is approved. 

the manager can review applications, view all applications, download or view business school reports, modify existing courses, and add new courses.

more information
-------------------------
first of all, the user - the guest - must register in the system. the program includes input error handling.
this is what the login screen looks like. before that, the user - the guest - will not be able to get any information.

<img src="https://github.com/ajdivotf/business-school/blob/main/images/start_screen.PNG" width="600px"/>

then access to one of two personal accounts is possible - the manager, who is previously registered in the system, and the student.
if you are afraid to register, then you can log in with the password and login of an already created user:
`login = eckyl@bk.ru password = sds2013`
manager login and password are:
`login = manager password = sds2013`

manager's personal account interface:

<img src="https://github.com/ajdivotf/business-school/blob/main/images/manage_corses.PNG" width="600px"/>
<img src="https://github.com/ajdivotf/business-school/blob/main/images/add_course.PNG" width="600px"/>
<img src="https://github.com/ajdivotf/business-school/blob/main/images/manage_orders.PNG" width="600px"/>

the manager can download a xlsx-report on students or courses:

<img src="https://github.com/ajdivotf/business-school/blob/main/images/download_report.PNG" width="600px"/>

students's personal account interface:

<img src="https://github.com/ajdivotf/business-school/blob/main/images/stud_profile.PNG" width="600px"/>
<img src="https://github.com/ajdivotf/business-school/blob/main/images/edit_stu_profile.PNG" width="600px"/>
<img src="https://github.com/ajdivotf/business-school/blob/main/images/choose_training_pr.PNG" width="600px"/>
<img src="https://github.com/ajdivotf/business-school/blob/main/images/stud_orders.PNG" width="600px"/>
