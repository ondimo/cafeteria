<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Role Selection</title>
<link rel="stylesheet" href="css/roles.css">
</head>
<body>
<h1>Welcome to the online food ordering platform. <br> To proceed further, select your role below</h1>
<div class="container">
    <h2>Select Your Role:</h2>
    <form id="roleForm">
        <label>
            <input type="radio" name="role" value="student" required>
            <a href="login.php">Student</a>
        </label><br>
        <label>
            <input type="radio" name="role" value="manager">
            <a href="overall_admin/managerlogin.php">Overall Manager</a>
        </label><br>
        <label>
            <input type="radio" name="role" value="caterer">
            <a href="#">Caterer</a>
        </label><br>
        
        <div id="cafeterias" class="hidden">
            <h3>Select a Cafeteria:</h3>
            <label>
                <input type="radio" name="cafeteria" value="downstairs">
                <a href="downstairs/downstairslogin.php">Downstairs Cafeteria</a>
            </label><br>
            <label>
                <input type="radio" name="cafeteria" value="pate">
                <a href="Pate/patelogin.php">Pate Cafeteria</a>
            </label><br>
            <label>
                <input type="radio" name="cafeteria" value="springs">
                <a href="springs/springslogin.php">Springs of Olive</a>
            </label><br>
            <label>
                <input type="radio" name="cafeteria" value="afyacorner">
                <a href="afya/afyalogin.php">Afya Corner</a>
            </label><br>
            <label>
                <input type="radio" name="cafeteria" value="upesi">
                <a href="upesi/upesilogin.php">Upesi Joint</a>
            </label><br>
            <label>
                <input type="radio" name="cafeteria" value="kilimanjaro">
                <a href="kilimanjaro/kilimanjarologin.php">Kilimanjaro Cafeteria</a>
            </label><br>
        </div>
    </form>
</div>

<script>
    // JavaScript to show/hide cafeteria options based on role selection
    const roleForm = document.getElementById('roleForm');
    const cafeteriasDiv = document.getElementById('cafeterias');

    roleForm.addEventListener('change', function() {
        if (document.querySelector('input[name="role"]:checked').value === 'caterer') {
            cafeteriasDiv.classList.remove('hidden');
        } else {
            cafeteriasDiv.classList.add('hidden');
        }
    });
</script>

</body>
</html>
