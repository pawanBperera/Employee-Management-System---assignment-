<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1{
            border: 3px solid black;
            text-align: center;
            font-size: 400%;
            margin-bottom: 0%;
            color: brown; 
        }
        body{
            margin: 1%;
            background-color: seashell;
        }

        h3{
            margin-top: 0%;
            text-align: center;
            font-size: 120%;
        }
        .content{
            border: 2px solid black;
            margin: auto;
            height: fit-content;
            padding: 3%;
            font-size: larger;
            width: 25%;
            text-align: center;
        }

        h5{
            font-size: 200%;
            text-align: center;
            margin-top: 0%;
        }
        div{
            margin: 2%;
        }
    </style>
    <title>Home</title>
</head>
<body>
    <h1>Task assign website</h1>

    <h3>This is a website built to interact with mysql</h3>

    <h3>This web site will directly communicate with a mysql database in this case it will send the entered data in to the database by using POST method
        to maniuplate Emplyee table please make sure to choose "Employee Resgistration" option form Option table vice versa you can use other options 
        to maniuplate other databases. Be mindful when providing Values for Eid, TId, activity id given that they are being backed by Foreign key constraints.
        If you have any issue please contact coorayeronnemanoshawoodapple@gmail.com.
    </h3>

    <div class="content">
        <h5>Options</h5>

        <div>
            <a href="emp.html">Employee Registration</a>
        </div>

        <div>
            <a href="Task.html">Task Registration</a>
        </div>

        <div>
            <a href="Activity.php">Activity Registration</a>
        </div>

        <div>
            <a href="Assign.php">Assign Registration</a>
        </div>  
        
        <div>
            <a href="generate_report.php">Generate Report</a>
        </div> 
    </div>

    <div class=""></div>
    
</body>
</html>