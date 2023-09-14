<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish a database connection (Replace 'your_host', 'your_username', 'your_password', and 'your_database' with appropriate values)
    $conn = mysqli_connect('localhost', 'root', '', 'admission_2023');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the updated data from the form
    $application_number = $_POST['application_number'];
    $name_as_per_hsc = $_POST['name_as_per_hsc'];
    $receipt_no = $_POST['receipt_no'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $category_for_admission = $_POST['category_for_admission'];
    $candidate_name= $_POST['candidate_name'];
    $eligibility_percent = $_POST['eligibility_percent'];
    $merit_hsc_pcm_percent = $_POST['merit_hsc_pcm_percent'];
    $hsc_math_percent = $_POST['hsc_math_percent'];
    $hsc_physics_percent = $_POST['hsc_physics_percent'];
    $hsc_total_percent = $_POST['hsc_total_percent'];
   
    $program_name = $_POST['program_name'];
    $seat_type = $_POST['seat_type'];
    $date_of_admission = $_POST['date_of_admission'];
    $payment_mode = $_POST['payment_mode'];
    $seat_acceptance_fees_amount = $_POST['seat_acceptance_fees_amount'];
    $seat_acceptance_dd_transaction_number = $_POST['seat_acceptance_dd_transaction_number'];
    $college_payment_date = $_POST['college_payment_date'];
    $college_bank_and_branch_name = $_POST['college_bank_and_branch_name'];
    //transaction1 in rupees
    $payment_date = $_POST['payment_date'];

    $bank_and_branch_name = $_POST['bank_and_branch_name'];
    $college_fees_amount = $_POST['college_fees_amount'];
    $college_fees_dd_transaction_number = $_POST['college_fees_dd_transaction_number'];

    // transaction2 in rupees
    $payment_date1 = $_POST['payment_date1'];
    $bank_and_branch_name1 = $_POST['bank_and_branch_name1'];
    $college_fees_amount1 = $_POST['college_fees_amount1'];



    $college_fees_dd_transaction_number1 = $_POST['college_fees_dd_transaction_number1'];


    //transaction1 in rupees
    $payment_date_dol = $_POST['payment_date_dol'];
    $bank_and_branch_name_dol = $_POST['bank_and_branch_name_dol'];
    $college_fees_amount_dol = $_POST['college_fees_amount_dol'];
    $college_fees_dd_transaction_number_dol = $_POST['college_fees_dd_transaction_number_dol'];

    // transaction2 in rupees
    $payment_date_dol1 = $_POST['payment_date_dol1'];
    $bank_and_branch_name_dol1 = $_POST['bank_and_branch_name_dol1'];
    $college_fees_amount_dol1 = $_POST['college_fees_amount_dol1'];
    $college_fees_dd_transaction_number_dol1 = $_POST['college_fees_dd_transaction_number_dol1'];



    // Perform the update query
    $query = "UPDATE college_applications 
              SET name_as_per_hsc = '$name_as_per_hsc',
                  receipt_no = '$receipt_no',
                  gender = '$gender',
                  date_of_birth = '$date_of_birth',
                  candidate_name='$candidate_name',
                  category_for_admission = '$category_for_admission',
                
                  eligibility_percent = '$eligibility_percent',
                  merit_hsc_pcm_percent = '$merit_hsc_pcm_percent',
                  hsc_math_percent = '$hsc_math_percent',
                  hsc_physics_percent = '$hsc_physics_percent',
                  hsc_total_percent = '$hsc_total_percent',
             
                  program_name = '$program_name',
                  seat_type = '$seat_type',
                  date_of_admission = '$date_of_admission',
                  payment_mode = '$payment_mode',
                  seat_acceptance_fees_amount = '$seat_acceptance_fees_amount',
                  seat_acceptance_dd_transaction_number = '$seat_acceptance_dd_transaction_number',

                  payment_date = '$payment_date',
                  bank_and_branch_name = '$bank_and_branch_name',
                  college_fees_amount = '$college_fees_amount',
                  college_fees_dd_transaction_number = '$college_fees_dd_transaction_number',

                  payment_date1 = '$payment_date1',
                  bank_and_branch_name1 = '$bank_and_branch_name1',
                  college_fees_amount1 = '$college_fees_amount1',
                  college_fees_dd_transaction_number1 = '$college_fees_dd_transaction_number1',

                  payment_date_dol = '$payment_date_dol',
                  bank_and_branch_name_dol = '$bank_and_branch_name_dol',
                  college_fees_amount_dol = '$college_fees_amount_dol',
                  college_fees_dd_transaction_number_dol = '$college_fees_dd_transaction_number_dol',

                  payment_date_dol1 = '$payment_date_dol1',
                  bank_and_branch_name_dol1 = '$bank_and_branch_name_dol1',
                  college_fees_amount_dol1 = '$college_fees_amount_dol1',
                  college_fees_dd_transaction_number_dol1 = '$college_fees_dd_transaction_number_dol1',
                  


                  college_payment_date = '$college_payment_date',
                  college_bank_and_branch_name = '$college_bank_and_branch_name'
              WHERE application_number = '$application_number'";
 
    if (mysqli_query($conn, $query)) {
        // Echo the "Print" button with a form to trigger PDF generation
        echo '<div id="heading"> 
            <img src="coep_logoBlack.png" alt="coep_logoBlack">
            <h3>COEP Technological University</h3>';
            echo "<h2>Applicant data updated successfully. </h2> <br><br>";

        echo '<form method="POST" action="generate_pdf.php">';
        echo '  <input type="hidden" name="application_number" value="' . $application_number . '">';
        echo '  <input type="submit" name="print" value="Print">';
        echo '</form></div>';
    
        
    }
    
    else {
        echo "Error updating application data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Application Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('temp2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        #heading {
            margin-top: 100px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            width: 500px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            height: 375px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #heading img {
            height: 100px; /* Increase the height of the logo */
            margin-bottom: 10px; /* Add some spacing below the logo */
            width: 100px;
        }

        h3 {
            margin-bottom: 20px; /* Add some spacing below the h3 tag */
            font-size: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 26px;
        }

        input[type="submit"] {
            width: 100px;
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- <div id="heading">
        <img src="coep_logoBlack.png" alt="coep_logoBlack">
        <h3>COEP Technological University</h3>
        <h4>Applicant Information</h4>
        <form action="search_application.php" method="post">
            <label>Application Number:</label>
        
        </form>
    </div> -->
</body>
</html>
