# Project-4

smriti_db

---
```
START

INCLUDE session
IF 'userename' OR 'user_role' not set in session
    REDIRECT to 'login.php'

INCLUDE 'modal.php'

SET current_page = value of 'page_num' from request, default to 1

CALL countThe('USERS') from DB_Modal
IF result is an error string
    STOP and show error
ELSE
    EXTRACT total_users from result as integer

SET records_per_page = 3
SET total_pages = ceil(total_users / records_per_page)
SET offset = (current_page - 1) * records_per_page

CALL get_users(offset, records_per_page) from DB_Modal

PRINT HTML table header

IF get_users returns valid array AND not empty
    FOR EACH user in result
        SET last_name = "NULL" if empty
        SET role = "Admin" if role == 1, else "User"
        SET status = "Enable" or "Disable" link based on isActive
        PRINT user row in table with all fields
    END FOR
ELSE IF array is empty
    SHOW "user table is empty" alert
ELSE
    SHOW "query problem" alert
END IF

PRINT pagination start

IF current_page > 1
    PRINT "Previous" link to page (current_page - 1)

FOR i FROM 1 TO total_pages
    IF i == current_page
        MARK page link as active
    PRINT page number link i

IF current_page < total_pages
    PRINT "Next" link to page (current_page + 1)

PRINT pagination end

END
```
---


<!-- http://127.0.0.1:64274/?code=773583afaca7f8aa840f&state=b601e78fd5ab42f1acebdfe5dba9f44c -->