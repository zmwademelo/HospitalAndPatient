This is a database of treatments given to patients. 

*Related tables: treatment, patient, patient_treatment, disease, users*

Both patients and hospital staff can use this web applicaiton.

**We use php as the main script language, html for the webpage, and css, Bootstrap framework to optimize the look of the application to make it prettier.**

Login.php and loginprocess.php provide the functionality for users to login and navigate to the data page they belong.

display.php is designed for patients to view their treatment information.

index.php is for hospital staff use. Researchers and managers can access all the data and modify them.

Download.php is to download the csv files.

error.php is to report illegal login/input.

1. Login system: Users input their first name and last name , and choose their identity: patient/user. If the input matches the data in table "users"/"patient", they can continue their operation.

   *prevent vacant input*

2. patient's interface: patients can only access their own treatment data, and cannot modify it.

   *When displaying user name, we make the first letter uppercase, no matter the input case. Similar feature goes for user's interface. We use cookies to implement this feature.*

3. user's interface: users can have access to all the data, and can add/edit/delete them.

   *prevent vacant input*

   *prevent all-space inputs*

   *When editing data, the save button changes to update button.*

   *Don't allow colons, quotaiton marks and semicolons in the input of treatment's name and type*

   *Don't allow deid input which cannot be found in the disease table*

   *If input is illegal, the system will not accept it and will return with warning*

4. Hospital staff can download information of treatment in csv by simply clicking the button.

5. We use mysqli instead of mysql, thus can prevent sql injection by using the mysqli_real_escape_string() function to escape special characters in strings used in SQL statements.

6. When logging in, the case of letters (upper of lower) does not affect the result.

7. When finished observation/operation, users can go back to the login page.

8. We use cookie to store temporary data, to transfer data from login process.php to display.php, so that we don't need to input again patient's information.

9. We join two tables, treatment and disease in the user interface, and we join three tables, treatment, patient and patient_treatment to provide a view for patients.
