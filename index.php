<!DOCTYPE html>
<html lang="en">
<head>
    <title>School Managment System</title>
    <?php
    include('./assets/bootstrap.php');
    ?>
</head>
<body>
    <?php
    session_start();
    include('./common/header.php');

    if(isset($_GET['signup']) && !isset($_SESSION['user']['username']))
            {
                include('./auth/signup.php');
            }
    else if(isset($_GET['login']) && !isset($_SESSION['user']['username']))
            {
                include('./auth/login.php');
            }
    else if(isset($_GET['students']))
            {
                include('./admin/students/students.php');
            }
    else if(isset($_GET['addstd']))
            {
                include('./admin/students/addstd.php');
            }
    else if(isset($_GET['view']) && isset($_GET['id']))
            {
                include('./admin/students/view.php');
            }
    else if(isset($_GET['edit']) && isset($_GET['id']))
            {
                include('./admin/students/edit.php');
            }
    else if(isset($_GET['delete']) && isset($_GET['id']))
            {
                include('./admin/students/delete.php');
            }
    else if(isset($_GET['save_std']))
            {
                include('./admin/students/students.php');
            }
    else if(isset($_GET['assignsec']) && isset($_GET['id']))
        {
            include('./admin/students/assignsec.php');
        }
    else if(isset($_GET['teachers']))
            {
                include('./admin/teachers/teachers.php');
            }
    else if(isset($_GET['addtch']))
            {
                include('./admin/teachers/addtch.php');
            }
    else if(isset($_GET['view_tch']) && isset($_GET['id']))
            {
                include('./admin/teachers/view_tch.php');
            }  
    else if(isset($_GET['edit_tch']) && isset($_GET['id']))
            {
                include('./admin/teachers/edit_tch.php');
            }
    else if(isset($_GET['delete_tch']) && isset($_GET['id']))
            {
                include('./admin/teachers/delete_tch.php');
            }     
    else if(isset($_GET['subjects']))
            {
                include('./admin/subjects/subjects.php');
            }
    else if(isset($_GET['subjects']))
        {
            include('./admin/subjects/subjects.php');
        }
    else if(isset($_GET['addsub']))
        {
            include('./admin/subjects/addsub.php');
        }
    else if(isset($_GET['save_sub']))
        {
            include('./admin/subjects/subjects.php');
        }
    else if(isset($_GET['delsub']) && isset($_GET['id']))
        {
            include('./admin/subjects/delsub.php');
        }
    else if(isset($_GET['classes']))
        {
            include('./admin/classes/classes.php');
        }
    else if(isset($_GET['sections']))
        {
            include('./admin/sections/sections.php');
        }
    else if(isset($_GET['addsec']))
            {
                include('./admin/sections/addsec.php');
            }
    else if(isset($_GET['delsec']) && isset($_GET['id']))
            {
                include('./admin/sections/delsec.php');
            }
    else if(isset($_GET['fees']))
        {
            include('./admin/fees/fees.php');
        }
    else if(isset($_GET['addfee']))
            {
                include('./admin/fees/addfee.php');
            }
    else if(isset($_GET['payfee']) && isset($_GET['id']))
            {
                include('./admin/fees/payfee.php');
            }
    else if(isset($_GET['delfee']) && isset($_GET['id']))
            {
                include('./admin/fees/delfee.php');
            }
    else if(isset($_GET['genfees']))
        {
            include('./admin/fees/genfees.php');
        }
    else if(isset($_GET['dashboard']))
        {
            include('./admin/dashboard.php');
        }

    include('./common/footer.php');
    ?>
</body>
</html>