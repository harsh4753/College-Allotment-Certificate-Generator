<?php
require('pdf_generator/fpdf.php');
function reverseDate($date) {
    // Explode the date into an array
    $dateArray = explode('-', $date);
    
    // Reorder the array elements to reverse the date
    $reversedDateArray = array_reverse($dateArray);
    
    // Convert the array back to a string with slashes
    $reversedDate = implode('/', $reversedDateArray);
    
    return $reversedDate;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['application_number'])) {
    // Establish a database connection (Replace 'your_host', 'your_username', 'your_password', and 'your_database' with appropriate values)
    $conn = mysqli_connect('localhost', 'root', '', 'admission_2023');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the application number from the form
    $application_number = $_POST['application_number'];

    // Retrieve the application data from the database based on the application number
    $query = "SELECT * FROM college_applications WHERE application_number = '$application_number'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Create a PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 9);

        // Add content to the PDF based on the fetched data from the database
        // Header
        $pdf->Rect(10, 10, 190, 24, 'D');    



        $pdf->Cell(0, 4, 'COEP Technological University Pune (COEP Tech.)', 0, 1, 'C');
        $pdf->Cell(0, 4, 'Receipt-Cum-Acknowledgement of Confirmation of Provisional Admission to', 0, 1, 'C');
        $pdf->Cell(0, 4, 'First Year Under Graduate Technical Courses in Engineering and Technology (4 Years)', 0, 1, 'C');
        $pdf->Cell(0, 4, 'Admissions A.Y. 2023-24', 0, 1, 'C');
        $pdf->Cell(0, 4, 'FN/OCI / PIO, Children of Indian workers in the Gulf countries and', 0, 1, 'C');
        $pdf->Cell(0, 4, 'NRI Candidature Candidates ', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 9);
        // Application Number and Receipt No

        $pdf->Cell(0, 4, "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tApplication Number: " . $row['application_number'] . "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t" . "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tReceipt No: " . $row['receipt_no'], 1, 1,);


        // Personal Details
        $pdf->Cell(0, 4, 'Personal Details', 1, 1, '');




        // Set font and size for the table content
        // Set font and size for the table content
        $pdf->SetFont('Arial', '', 9);

        // Table Row 1
        $pdf->Cell(47.5, 4, 'Gender:', 1, 0, 'L');
        $pdf->Cell(47.5, 4, $row['gender'], 1, 0, 'L');
        $pdf->Cell(47.5, 4, 'Date Of Birth:', 1, 0, 'L');
        $pdf->Cell(47.5, 4,  reverseDate($row['date_of_birth']), 1, 1, 'L');

        // Table Row 2
        $pdf->Cell(47.5, 4, 'Candidate Type:', 1, 0, 'L');
        $pdf->Cell(47.5, 4, $row['candidature_type'], 1, 0, 'L');
        $pdf->Cell(47.5, 4, 'Category for Admission:', 1, 0, 'L');
        $pdf->Cell(47.5, 4, $row['category_for_admission'], 1, 1, 'L');


        $pdf->SetFont('Arial', 'B', 9);
        // Admission Details
        $pdf->Cell(0, 4, 'Admission Details', 1, 1, '');

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(47.5, 4, 'Institute General Merit No:', 1, 0, 'L');
        $pdf->Cell(47.5, 4, $row['institute_general_merit_no'], 1, 0, 'L');
        $pdf->Cell(47.5, 4, 'Merit Marks:', 1, 0, 'L');
        $pdf->Cell(47.5, 4, $row['merit_marks'], 1, 1, 'L');
        $pdf->Cell(47.5, 4, 'Institute Name', 1, 0, 'R');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(142.5, 4, '6006 - COEP Technological University', 1, 1, 'L');
        // Table Row 2
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(47.5, 4, 'Program Name', 1, 0, 'R');

        $pdf->Cell(142.5, 4, $row['program_name'], 1, 1, 'L');

        $pdf->Cell(47.5, 4, 'Seat Type', 1, 0, 'L');
        $pdf->Cell(47.5, 4, $row['seat_type'], 1, 0, 'L');
        $pdf->Cell(47.5, 4, 'Date of Admission: ', 1, 0, 'L');
        $pdf->Cell(47.5, 4, reverseDate($row['date_of_admission']), 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(0, 4, 'Exam Name Details', 1, 1, '');

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(47.5, 4, 'Name As Per HSC Result', 1, 0, 'L');

        $pdf->Cell(142.5, 4, $row['name_as_per_hsc'], 1, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 4, 'Fee Details', 0, 1, '');
       


       
        $pdf->Cell(27.5, 4, 'Sr. No.', 1, 0, 'L');
        $pdf->Cell(40, 4, 'Payment Mode', 1,0, 'L'); // Swap the content order
        $pdf->Cell(55.5, 4, 'Seat Acceptance Fees Amount (Rs.)', 1, 0, 'L');
        $pdf->Cell(67, 4, 'Seat Acceptance DD/Transaction Number', 1, 1, 'L');

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(27.5, 4, ' 1  ', 1, 0, 'C');
        $pdf->Cell(40, 4, $row['payment_mode'], 1,0, 'C'); // Swap the content order
        $pdf->Cell(55.5, 4, $row['seat_acceptance_fees_amount'], 1, 0, 'C');
        $pdf->Cell(67, 4, $row['seat_acceptance_dd_transaction_number'], 1, 1, 'C');

        // $pdf->Cell(27.5, 5, ' 2  ', 1, 0, 'C');
        // $pdf->Cell(40, 5, '      ', 1,0, 'L'); // Swap the content order
        // $pdf->Cell(55.5, 5, '      ', 1, 0, 'L');
        // $pdf->Cell(67, 5, '    ', 1, 1, 'L');

        


        

        if($row['candidature_type']=='NRI'){
            
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(43, 4, 'College Fees Amount (in $)', 1, 0, 'C');
            $pdf->Cell(60, 4, 'College Fees DD/Transaction Number', 1, 0, 'C');
            $pdf->Cell(29, 4, 'Payment Date', 1, 0, 'C');
            $pdf->Cell(58, 4, 'Bank and Branch Name', 1, 1, 'C ');
    
    
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(43, 4, $row['college_fees_amount_dol'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number_dol'], 1, 0, 'L');
            $pdf->Cell(29, 4, $row['payment_date_dol'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name_dol'], 1, 1, 'C');

            $pdf->Cell(43, 4, $row['college_fees_amount_dol1'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number_dol1'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date_dol1'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name_dol1'], 1, 1, 'C');
           
        }
        else if($row['candidature_type']=='CIWGC'){
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(43, 4, 'College Fees Amount(in Rs)', 1, 0, 'C');
            $pdf->Cell(60, 4, 'College Fees DD/Transaction Number', 1, 0, 'C');
            $pdf->Cell(29, 4, 'Payment Date', 1, 0, 'C');
            $pdf->Cell(58, 4, 'Bank and Branch Name', 1, 1, 'C');
    
    
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(43, 4, $row['college_fees_amount'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name'], 1, 1, 'C');

            $pdf->Cell(43, 4, $row['college_fees_amount'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name'], 1, 1, 'C');
    

        
        }
        else if($row['candidature_type']=='PIO / OCI'){
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(43, 4, 'College Fees Amount(in Rs)', 1, 0, 'C');
            $pdf->Cell(60, 4, 'College Fees DD/Transaction Number', 1, 0, 'C');
            $pdf->Cell(29, 4, 'Payment Date', 1, 0, 'C');
            $pdf->Cell(58, 4, 'Bank and Branch Name', 1, 1, 'C');
    
    
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(43, 4, $row['college_fees_amount'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name'], 1, 1, 'C');

            $pdf->Cell(43, 4, $row['college_fees_amount'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name'], 1, 1, 'C');
           

            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(43, 4, 'College Fees Amount (in $)', 1, 0, 'C');
            $pdf->Cell(60, 4, 'College Fees DD/Transaction Number', 1, 0, 'C');
            $pdf->Cell(29, 4, 'Payment Date', 1, 0, 'C');
            $pdf->Cell(58, 4, 'Bank and Branch Name', 1, 1, 'C');
    
    
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(43, 4, $row['college_fees_amount_dol'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number_dol'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date_dol'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name_dol'], 1, 1, 'C');

            $pdf->Cell(43, 4, $row['college_fees_amount_dol1'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number_dol1'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date_dol1'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name_dol1'], 1, 1, 'C');
        }
        else if($row['candidature_type']=='Foreign Students'){
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(43, 4, 'College Fees Amount (in $)', 1, 0, 'C');
            $pdf->Cell(60, 4, 'College Fees DD/Transaction Number', 1, 0, 'C');
            $pdf->Cell(29, 4, 'Payment Date', 1, 0, 'C');
            $pdf->Cell(58, 4, 'Bank and Branch Name', 1, 1, 'C');
    
    
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(43, 4, $row['college_fees_amount_dol'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number_dol'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date_dol'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name_dol'], 1, 1, 'C');

            $pdf->Cell(43, 4, $row['college_fees_amount_dol1'], 1, 0, 'C');
            $pdf->Cell(60, 4, $row['college_fees_dd_transaction_number_dol1'], 1, 0, 'C');
            $pdf->Cell(29, 4, $row['payment_date_dol1'], 1, 0, 'C');
            $pdf->Cell(58, 4, $row['bank_and_branch_name_dol1'], 1, 1, 'C');
            

        
        }


      

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 4, 'List of Documents Submitted at Institute', 0, 1, 'L');
        // $pdf->FancyTable($data);
        $descriptions="";
        function generateTable($pdf, $data)
{

    // Draw header row
    $pdf->Cell(10, 4, 'Sr No', 1, 0, 'C');
    $pdf->Cell(17, 4, 'Submitted', 1, 0, 'C');
    $pdf->Cell(163, 4, 'Document Name', 1, 1, 'C');

    // Draw data rows
        // $pdf->Rect(10, 203, 15, 30, 'D');    
        $pdf->SetFont('Arial', '', 8);

        $pdf->Cell(10, 24, '1', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 24, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"NRI Certificate of the Candidate OR of his/her Mother or Father OR the real brother/real sister ordinarily residing abroad OR NRI certificate of the persons having blood relation with the student who consider such student as Ward viz-real brother/sister of father OR real brother/sister of Mother OR father/mother of father OR father/mother of Mother OR 1st degree paternal/maternal cousins, ordinarily residing abroad and should have looked after the candidate as guardian with documentary evidence & affidavit in support of the aforesaid facts. Parents CDC (Continuous Discharge certificate) if claimant is Merchant Navy employee.", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 8, '2', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Affidavit of candidate/sponsor disclosing his full identity i.e. full name, age, residence, occupation, relationship with candidate duly signed by the Candidate/parents/sponsor.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 4, '3', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Passport, Nationality Certificate of sponsor.", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '4', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Residence of NRI, Valid VISA of sponsor ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 4, '5', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Proof of residence i.e. Driving Licence, Telephone Bill, Property Tax copy, IT return copy of sponsor.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '6', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Proof of residence showing minimum 182 days of stay of sponsor in abroad for the academic year of admission, prior to the admission date.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '7', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"True copy of foreign bank account passbook (copies of main page indicating bank name & address, sponsor name & address, with entries of last preceding 6 months prior to admission).", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '8', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Affidavit of family chart duly signed by sponsor making clear relationship.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '9', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163,4,"Leaving certificates, Birth extracts, mark sheets, PAN Card, Passport, Marriage Certificate of all members shown on family tree/chart. ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '10', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Eligibility Certificate from the Association of Indian Universities, New Delhi (AIU) if candidate passed Qualifying examination from abroad. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '11', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing SSC / Equivalent Examination. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '12', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing HSC / Equivalent Examination", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '13', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing Qualifying / Equivalent Examination.", 1, 'L'); // 200-Word Description

        
}       
function generateTable_CIWGC($pdf, $data)
{

    // Draw header row
    $pdf->Cell(10, 4, 'Sr No', 1, 0, 'C');
    $pdf->Cell(17, 4, 'Submitted', 1, 0, 'C');
    $pdf->Cell(163, 4, 'Document Name', 1, 1, 'C');

    // Draw data rows
        // $pdf->Rect(10, 203, 15, 30, 'D');    
        $pdf->SetFont('Arial', '', 8);

        $pdf->Cell(10, 24, '1', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 24, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"NRI Certificate of the Candidate OR of his/her Mother or Father OR the real brother/real sister ordinarily residing abroad OR NRI certificate of the persons having blood relation with the student who consider such student as Ward viz-real brother/sister of father OR real brother/sister of Mother OR father/mother of father OR father/mother of Mother OR 1st degree paternal/maternal cousins, ordinarily residing abroad and should have looked after the candidate as guardian with documentary evidence & affidavit in support of the aforesaid facts. Parents CDC (Continuous Discharge certificate) if claimant is Merchant Navy employee.", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 8, '2', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Affidavit of candidate/sponsor disclosing his full identity i.e. full name, age, residence, occupation, relationship with candidate duly signed by the Candidate/parents/sponsor.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 4, '3', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Passport, Nationality Certificate of sponsor.", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '4', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Residence of NRI, Valid VISA of sponsor ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 4, '5', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Proof of residence i.e. Driving Licence, Telephone Bill, Property Tax copy, IT return copy of sponsor.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '6', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Proof of residence showing minimum 182 days of stay of sponsor in abroad for the academic year of admission, prior to the admission date.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '7', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"True copy of foreign bank account passbook (copies of main page indicating bank name & address, sponsor name & address, with entries of last preceding 6 months prior to admission).", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '8', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Affidavit of family chart duly signed by sponsor making clear relationship.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '9', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163,4,"Leaving certificates, Birth extracts, mark sheets, PAN Card, Passport, Marriage Certificate of all members shown on family tree/chart. ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '10', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Eligibility Certificate from the Association of Indian Universities, New Delhi (AIU) if candidate passed Qualifying examination from abroad. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '11', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing SSC / Equivalent Examination. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '12', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing HSC / Equivalent Examination", 1, 'L'); // 200-Word Description

        // $pdf->Cell(10, 4, '13', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing Qualifying / Equivalent Examination.", 1, 'L'); // 200-Word Description

        
}       
function generateTable_PIO_OCI($pdf, $data)
{

    // Draw header row
    $pdf->Cell(10, 4, 'Sr No', 1, 0, 'C');
    $pdf->Cell(17, 4, 'Submitted', 1, 0, 'C');
    $pdf->Cell(163, 4, 'Document Name', 1, 1, 'C');

    // Draw data rows
        // $pdf->Rect(10, 203, 15, 30, 'D');    
        $pdf->SetFont('Arial', '', 8);

        // $pdf->Cell(10, 24, '1', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 24, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"NRI Certificate of the Candidate OR of his/her Mother or Father OR the real brother/real sister ordinarily residing abroad OR NRI certificate of the persons having blood relation with the student who consider such student as Ward viz-real brother/sister of father OR real brother/sister of Mother OR father/mother of father OR father/mother of Mother OR 1st degree paternal/maternal cousins, ordinarily residing abroad and should have looked after the candidate as guardian with documentary evidence & affidavit in support of the aforesaid facts. Parents CDC (Continuous Discharge certificate) if claimant is Merchant Navy employee.", 1, 'L'); // 200-Word Description

        // $pdf->Cell(10, 8, '2', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"Affidavit of candidate/sponsor disclosing his full identity i.e. full name, age, residence, occupation, relationship with candidate duly signed by the Candidate/parents/sponsor.", 1, 'L'); // 200-Word Description
        
        
        
   
        
        // $pdf->Cell(10, 8, '6', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"Proof of residence showing minimum 182 days of stay of sponsor in abroad for the academic year of admission, prior to the admission date.", 1, 'L'); // 200-Word Description
        
        // $pdf->Cell(10, 8, '7', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"True copy of foreign bank account passbook (copies of main page indicating bank name & address, sponsor name & address, with entries of last preceding 6 months prior to admission).", 1, 'L'); // 200-Word Description

       
        
        // $pdf->Cell(10, 8, '9', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163,4,"Leaving certificates, Birth extracts, mark sheets, PAN Card, Passport, Marriage Certificate of all members shown on family tree/chart. ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '1', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Eligibility Certificate from the Association of Indian Universities, New Delhi (AIU) if candidate passed Qualifying examination from abroad. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '2', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Passport of the Candidate.", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '3', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"PIO / OCI Card. ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '4', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Affidavit of candidate/Parent disclosing his full identity i.e. full name, age, residence, occupation, relationship with candidate duly signed by the Candidate/parents.	", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '5', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Proof of residence i.e. Driving Licence, Telephone Bill, Property Tax copy, IT return copy of sponsor.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 4, '6', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing SSC / Equivalent Examination. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '7', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing HSC / Equivalent Examination", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '8', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing Qualifying / Equivalent Examination.", 1, 'L'); // 200-Word Description

    }       
function generateTable_Foreign_Students($pdf, $data)
{

    // Draw header row
    $pdf->Cell(10, 4, 'Sr No', 1, 0, 'C');
    $pdf->Cell(17, 4, 'Submitted', 1, 0, 'C');
    $pdf->Cell(163, 4, 'Document Name', 1, 1, 'C');

    // Draw data rows
        // $pdf->Rect(10, 203, 15, 30, 'D');    
        $pdf->SetFont('Arial', '', 8);

        // $pdf->Cell(10, 24, '1', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 24, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"NRI Certificate of the Candidate OR of his/her Mother or Father OR the real brother/real sister ordinarily residing abroad OR NRI certificate of the persons having blood relation with the student who consider such student as Ward viz-real brother/sister of father OR real brother/sister of Mother OR father/mother of father OR father/mother of Mother OR 1st degree paternal/maternal cousins, ordinarily residing abroad and should have looked after the candidate as guardian with documentary evidence & affidavit in support of the aforesaid facts. Parents CDC (Continuous Discharge certificate) if claimant is Merchant Navy employee.", 1, 'L'); // 200-Word Description

        // $pdf->Cell(10, 8, '2', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"Affidavit of candidate/sponsor disclosing his full identity i.e. full name, age, residence, occupation, relationship with candidate duly signed by the Candidate/parents/sponsor.", 1, 'L'); // 200-Word Description
        
        
        
   
        
        // $pdf->Cell(10, 8, '6', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"Proof of residence showing minimum 182 days of stay of sponsor in abroad for the academic year of admission, prior to the admission date.", 1, 'L'); // 200-Word Description
        
        // $pdf->Cell(10, 8, '7', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"True copy of foreign bank account passbook (copies of main page indicating bank name & address, sponsor name & address, with entries of last preceding 6 months prior to admission).", 1, 'L'); // 200-Word Description

       
        
        // $pdf->Cell(10, 8, '9', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163,4,"Leaving certificates, Birth extracts, mark sheets, PAN Card, Passport, Marriage Certificate of all members shown on family tree/chart. ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '1', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Eligibility Certificate from the Association of Indian Universities, New Delhi (AIU) if candidate passed Qualifying examination from abroad. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '2', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Passport of the Candidate.", 1, 'L'); // 200-Word Description

        // $pdf->Cell(10, 4, '3', 1, 0, 'C'); // Sr No
        // $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        // $pdf->MultiCell(163, 4,"PIO / OCI Card. ", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 8, '3', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 8, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Affidavit of candidate/Parent disclosing his full identity i.e. full name, age, residence, occupation, relationship with candidate duly signed by the Candidate/parents.	", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '4', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Proof of residence i.e. Driving Licence, Telephone Bill, Property Tax copy, IT return copy of sponsor.", 1, 'L'); // 200-Word Description
        
        $pdf->Cell(10, 4, '5', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing SSC / Equivalent Examination. ", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '6', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing HSC / Equivalent Examination", 1, 'L'); // 200-Word Description

        $pdf->Cell(10, 4, '7', 1, 0, 'C'); // Sr No
        $pdf->Cell(17, 4, ' ', 1, 0, 'C'); // Submitted
        $pdf->MultiCell(163, 4,"Statement of Marks or Certificate of Passing Qualifying / Equivalent Examination.", 1, 'L'); // 200-Word Description

    }       
if($row['candidature_type']=='NRI'){
    generateTable($pdf, $descriptions);

}
else if($row['candidature_type']=='CIWGC'){
    generateTable_CIWGC($pdf, $descriptions);

}
else if($row['candidature_type']=='PIO / OCI'){
    generateTable_PIO_OCI($pdf, $descriptions);

}
else if($row['candidature_type']=='Foreign Students'){
    generateTable_Foreign_Students($pdf, $descriptions);

}
 
// Call the function to generate the table
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(47.5, 5, 'Comments :', 1, 0, 'L');

        $pdf->Cell(142.5, 5, 'Admitted', 1, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 5, 'Undertaking By Candidate', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 9);
        // $pdf->Rect(10, 120, 190, 60);
        if($row['candidature_type']=='NRI'){
            
        
            $pdf->Rect(10, 207, 190, 26);
        }
        else if($row['candidature_type']=='CIWGC'){
            $pdf->Rect(10, 203, 190, 26);

        
        }
        else if($row['candidature_type']=='PIO / OCI'){
            $pdf->Rect(10, 167, 190, 26);

        
        }
        else if($row['candidature_type']=='Foreign Students'){
            $pdf->Rect(10, 151, 190, 26);

        
        }

        $pdf->MultiCell(0, 3, "     I hereby agree to confirm to rules, acts and laws enforced by Government from time to time. I hereby undertake that so long as I am a student of COEP Technological University Pune (COEP Tech.), I will not behave in a manner which may result in compelling the authorities to take disciplinary action against me. I fully understand that the Head of the Institute / Vice Chancellor / Registrar of COEP Technological University Pune (COEP Tech.) will have rights to expel, rusticate me from the institute, for any infringement of the rules prescribed by the college / institute / university / government and the undertaking given above. I also herewith undertake that, at a later stage, if it is found that I have submitted false certificate(s)/document(s), I am aware that my admission stands canceled and fees paid by me will be forfeited. Further I will be subjected to legal and/or penal action as per the provisions of the law.");
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(95, 10, '            Place :  Pune' ."                              Date: 03/08/2023", 1, 0, 'B', false, "\n");


        $pdf->Cell(95, 10, '        Signature of the Candidate:', 1, 1, 'CT', false, "\n");
        

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 5, 'Declaration by the COEP Technological University Pune (COEP Tech.)', 0, 1, 'C');
        if($row['candidature_type']=='NRI'){
            
        
            $pdf->Rect(10, 243, 190, 14);
        }
        else if($row['candidature_type']=='CIWGC'){
            $pdf->Rect(10, 239, 190, 14);

        
        }
        else if($row['candidature_type']=='PIO / OCI'){
            $pdf->Rect(10, 203, 190, 14);

        
        }
        else if($row['candidature_type']=='Foreign Students'){
            $pdf->Rect(10, 187, 190, 14);

        
        }
       
        $pdf->SetFont('Arial', '', 9);
        $pdf->MultiCell(0, 3, "   We hereby declare that, we are admitting this Candidate to our Institution for the academic year 2023-24 on verification of Candidate's Identity and all the required documents mentioned. The candidate has paid the Fees mentioned in this receipt. We also declare that the admission of Candidate is confirmed in presence of the Candidate.");
        // $pdf->MultiCell(0, 5, "1)NRI Certificate of the Candidate OR of his/her Mother or Father OR the real brother/real sister ordinarily residing abroad OR NRI certificate of the persons having blood relation with the student who consider such student as Ward viz-real brother/sister of father OR real brother/sister of Mother OR father/mother of father OR father/mother of Mother OR 1st degree paternal/maternal cousins, ordinarily residing abroad and should have looked after the candidate as guardian with documentary evidence & affidavit in support of the aforesaid facts. Parents CDC (Continuous Discharge certificate) if claimant is Merchant Navy employee.");
        
       
        
        $pdf->SetFont('Arial', '', 9);
        if($row['candidature_type']!='NRI'){
             $pdf->Cell(40, 5, '   ', 'LR', 0, 'C', false, "\n");
        $pdf->Cell(50, 5, '   ','LR', 0, 'C', false, "\n");
        $pdf->Cell(100, 5, '               ', 'LR', 1, 'L', false);

        
        }

       

        $pdf->Cell(40, 5, '   ', 'LR', 0, 'C', false, "\n");
        $pdf->Cell(50, 5, '   ','LR', 0, 'C', false, "\n");
        $pdf->Cell(100, 5, '               ', 'LR', 1, 'L', false);

        $pdf->Cell(40, 5, '   ', 'LR', 0, 'C', false, "\n");
        $pdf->Cell(50, 5, '   ','LR', 0, 'C', false, "\n");
        $pdf->Cell(100, 5, '               ', 'LR', 1, 'L', false);

        


       
        $pdf->Cell(40, 5, 'Reported On: 03/08/2023', 'LRB', 0, 'C', false, "\n");
        $pdf->Cell(50, 5, '  Seal of Institution', 'LRB', 0, 'C', false, "\n");
        $pdf->Cell(100, 5, '            Name, Designation, and Signature of the Issuing Officer', 'LRB', 0, 'L', false);
        $pdf->Output();
    } else {
        echo "Application (Invalid Application ID)data not found.";
    }

    mysqli_close($conn);
}
