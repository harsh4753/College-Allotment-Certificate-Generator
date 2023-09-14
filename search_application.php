<!DOCTYPE html>
<html>

<head>
    <title>Application Details</title>
</head>

<body>
    <?php
    // Establish a database connection (Replace 'your_host', 'your_username', 'your_password', and 'your_database' with appropriate values)
    $conn = mysqli_connect('localhost', 'root', '', 'admission_2023');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['application_number'])) {
        $application_number = $_POST['application_number'];

        // Retrieve application data from the database based on the provided Application Number
        $query = "SELECT * FROM college_applications WHERE application_number = '$application_number'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Display the data in an editable form format
            echo '<form action="update_application.php" method="post">';
            echo ' <div  id="heading"> 
                    <img src="coep_logoBlack.png" alt="coep_logoBlack">
                     <h3>COEP Technological University</h3> 
                     <h4> Applicant Information</h4>
                    </div>';
            
            echo '<div class="main">
            Application Number: <input type="text" name="application_number" value="' . $row['application_number'] . '"><br> </div>';
            echo ' <div class="main"> Candidate Name:<input type="text" name="candidate_name" value="' . $row['candidate_name'] . '"><br> </div>';
            echo ' <div class="main"> Candidature Type:<br><br>  ' . $row['candidature_type'] . '<br> </div>';
            echo ' <div class="main"> Name As Per HSC Result: <input type="text" name="name_as_per_hsc" value="' . $row['name_as_per_hsc'] . '"><br> </div>';
            echo ' <div class="main"> Receipt No: <input type="text" name="receipt_no" value="' . $row['receipt_no'] . '"><br> </div>';

            echo '<div class="main"> Gender: <input type="text" name="gender" value="' . $row['gender'] . '"><br> </div>';
            echo '<div class="main"> Date Of Birth: <input type="date" name="date_of_birth" value="' . $row['date_of_birth'] . '"><br> </div>';
            
            echo '<div class="main"> Category for Admission: <input type="text" name="category_for_admission" value="' . $row['category_for_admission'] . '"><br> </div>';
            echo '<div class="main"> Institute General Merit No: <br><br> ' . $row['institute_general_merit_no'] . '<br></div>';
            echo '<div class="main"> Merit Marks:<br><br>  ' . $row['merit_marks'] . '<br> </div>';
            echo '<div class="main"> Eligibility %: <input type="text" name="eligibility_percent" value="' . $row['eligibility_percent'] . '"><br> </div>';
            echo '<div class="main"> Merit % (HSC PCM / Diploma %): <input type="text" name="merit_hsc_pcm_percent" value="' . $row['merit_hsc_pcm_percent'] . '"><br> </div>';
            echo '<div class="main"> HSC Math %: <input type="text" name="hsc_math_percent" value="' . $row['hsc_math_percent'] . '"><br></div> ';
            echo '<div class="main"> HSC Physics %: <input type="text" name="hsc_physics_percent" value="' . $row['hsc_physics_percent'] . '"><br></div> ';
            echo '<div class="main"> HSC Total %: <input type="text" name="hsc_total_percent" value="' . $row['hsc_total_percent'] . '"><br></div> ';
            echo '<div class="main"> Institute Name: <br><br>' . "6006 - COEP Technological University " . '<br></div> ';
            echo '<div class="main"> Program Name: <input type="text" name="program_name" value="' . $row['program_name'] . '"><br></div> ';
            echo '<div class="main"> Seat Type: <input type="text" name="seat_type" value="' . $row['seat_type'] . '"><br></div> ';
            echo '<div class="main"> Date of Admission: <input type="date" name="date_of_admission" value="' . $row['date_of_admission'] . '"><br></div> ';
            // echo 'Payment Mode: <input type="text" name="payment_mode" value="' . $row['payment_mode'] . '"><br>';
            echo '<div class="main"> Payment Mode: <select name="payment_mode">';
            echo '<option value="DD" ' . ($row['payment_mode'] === 'DD' ? 'selected' : '') . '>DD</option>';
            echo '<option value="Online" ' . ($row['payment_mode'] === 'Online' ? 'selected' : '') . '>Online</option>';
            echo '</select><br> </div>';
            echo '<div class="main"> Seat Acceptance Fees Amount: <input type="text" name="seat_acceptance_fees_amount" value="' . $row['seat_acceptance_fees_amount'] . '"><br> </div>';
            echo '<div class="main"> Seat Acceptance DD/Transaction Number: <input type="text" name="seat_acceptance_dd_transaction_number" value="' . $row['seat_acceptance_dd_transaction_number'] . '"><br></div>';
            //payment1 rupees;
            if($row['candidature_type']=='PIO / OCI' || $row['candidature_type']=='CIWGC'){
                
            }
            echo '<div class="main"> Transaction (in Rupees) 1 - Payment Date: <input type="date" name="payment_date" value="' . $row['payment_date'] . '"><br></div>';
            echo '<div class="main">Transaction (in Rupees) 1 -  Bank and Branch Name: <input type="text" name="bank_and_branch_name" value="' . $row['bank_and_branch_name'] . '"><br></div>';
            echo '<div class="main"> Transaction (in Rupees) 1 - College Fees Amount: <input type="text" name="college_fees_amount" value="' . $row['college_fees_amount'] . '"><br></div>';
            echo '<div class="main">Transaction (in Rupees) 1 -  College Fees DD/Transaction Number: <input type="text" name="college_fees_dd_transaction_number" value="' . $row['college_fees_dd_transaction_number'] . '"><br></div>';
            //payment2 rupees;
            echo '<div class="main"> Transaction (in Rupees) 2 -  Payment Date: <input type="date" name="payment_date1" value="' . $row['payment_date1'] . '"><br></div>';
            echo '<div class="main"> Transaction (in Rupees) 2 -  Bank and Branch Name: <input type="text" name="bank_and_branch_name1" value="' . $row['bank_and_branch_name1'] . '"><br></div>';
            echo '<div class="main">Transaction (in Rupees) 2 - College Fees Amount: <input type="text" name="college_fees_amount1" value="' . $row['college_fees_amount1'] . '"><br></div>';
            echo '<div class="main">Transaction (in Rupees) 2 - College Fees DD/Transaction Number: <input type="text" name="college_fees_dd_transaction_number1" value="' . $row['college_fees_dd_transaction_number1'] . '"><br></div>';
            // payment 1 dollar
            echo '<div class="main"> Transaction (in $) 1 - Payment Date: <input type="date" name="payment_date_dol" value="' . $row['payment_date_dol'] . '"><br></div>';
            echo '<div class="main">Transaction (in $) 1 -  Bank and Branch Name: <input type="text" name="bank_and_branch_name_dol" value="' . $row['bank_and_branch_name_dol'] . '"><br></div>';
            echo '<div class="main"> Transaction (in $) 1 - College Fees Amount: <input type="text" name="college_fees_amount_dol" value="' . $row['college_fees_amount_dol'] . '"><br></div>';
            echo '<div class="main">Transaction (in $) 1 -  College Fees DD/Transaction Number: <input type="text" name="college_fees_dd_transaction_number_dol" value="' . $row['college_fees_dd_transaction_number_dol'] . '"><br></div>';
            //payment2 rupees;
            echo '<div class="main"> Transaction (in $) 2 -  Payment Date: <input type="date" name="payment_date_dol1" value="' . $row['payment_date_dol1'] . '"><br></div>';
            echo '<div class="main"> Transaction (in $) 2 -  Bank and Branch Name: <input type="text" name="bank_and_branch_name_dol1" value="' . $row['bank_and_branch_name_dol1'] . '"><br></div>';
            echo '<div class="main">Transaction (in $) 2 - College Fees Amount: <input type="text" name="college_fees_amount_dol1" value="' . $row['college_fees_amount_dol1'] . '"><br></div>';
            echo '<div class="main">Transaction (in $) 2 - College Fees DD/Transaction Number: <input type="text" name="college_fees_dd_transaction_number_dol1" value="' . $row['college_fees_dd_transaction_number_dol1'] . '"><br></div>';

            echo '<div class="main"> College Payment Date: <input type="date" name="college_payment_date" value="' . $row['college_payment_date'] . '"><br></div>';
            echo '<div class="main"> College Bank and Branch Name: <input type="text" name="college_bank_and_branch_name" value="' . $row['college_bank_and_branch_name'] . '"><br></div>';

            echo '<input type="submit" value="Update information">';
            echo '</form>';
            // ... Continue displaying other fields in the same way
        } else {
            echo "Application (Invalid Application ID) not found.";
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Application Details</title>
    <style>
        
        .main{
            font-size: 20px;
            background-color: white;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 80px;
            width: 700px;
            padding: 10PX;
            border-radius: 10px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #eee8f7;
        }

        form {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            width: 700px;
            margin-left: auto;
            margin-right: auto;
            background-color: #eee8f7;

        }

        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        form input[type="text"],
        form input[type="date"],
        form select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 10px;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4285F4;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 10px;
            background-color: rgb(101,54,172);
        }

        form input[type="submit"]:hover {
            background-color: #3367D6;
        }
        #heading {
            font-size: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 300px;
            width: 700px;
            padding: 20px; /* Increased padding for better spacing */
            border-radius: 10px;
            display: flex; /* Added display flex to center the content horizontally */
            flex-direction: column; /* Align content in a column */
            justify-content: center; /* Center content vertically */
            align-items: center; /* Center content horizontally */
        }

        img {
            height: 150px; /* Increase the height of the logo */
            width: 150px; /* Increase the width of the logo */
            margin-bottom: 20px; /* Add some spacing below the logo */
        }

        h3 {
            font-size: 30px;
            margin: 0; /* Remove default margin */
        }

        h4 {
            margin-top: 10px; /* Add spacing between h3 and h4 */
        }
    </style>
</head>

<body>
    
</body>

</html>
