<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and validate form data
    $fullName = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $company = $_POST["company"];
    $communication = $_POST["communication"];
    $projectTitle = $_POST["project-title"];
    $sitePurpose = $_POST["project-purpose"];
    $sitePages = $_POST["project-pages"];
    $siteFeatures = $_POST["project-features"];
    $designSchemeColor = $_POST["design-scheme"];
    $designSchemeTypography = $_POST["design-scheme-typography"];
    $siteType = $_POST["project-type"];
    $completionDate = $_POST["completion-date"];
    $budget = $_POST["budget"];
    $domainHosting = $_POST["domain-hosting"];
    $paymentSchedule = $_POST["payment-schedule"];
    $referenceSites = $_POST["reference-project"];
    $requests = $_POST["requests"];

    // Recipient email address
    $to = "info@zorithindustries.com";
    $subject = "Development Inquiry";

    // Create a boundary for the email
    $semi_rand = md5(time());
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

    // Headers for attachment
    $headers = "From: $fullName <$email>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed;\r\n";
    $headers .= " boundary=\"{$mime_boundary}\"\r\n";

    // Compose the HTML message
    $message = "
    <html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
               body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 10px;
                text-align: left;
                vertical-align: top;
                border: 1px solid #ddd; /* Add borders to table cells */
                background: linear-gradient(to bottom, #ffffff, #f2f2f2); /* Add gradient background */
            }
            th {
                background-color: #f2f2f2;
            }
            .card {
                border: 1px solid #ddd;
                border-radius: 5px;
                margin-bottom: 10px;
                padding: 10px;
                background-color: #fff;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>$siteType Development Inquiry</h1>
            
            <div class='card'>
                <h2>Personal Information</h2>
                <table>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td>$fullName</td>
                    </tr>
                    <tr>
                        <td>Phone (WhatsApp)</td>
                        <td>$phone</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>$email</td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td>$company</td>
                    </tr>
                    <tr>
                        <td>Preferred Communication</td>
                        <td>$communication</td>
                    </tr>
                </table>
            </div>
            
            <div class='card'>
                <h2>Project Details</h2>
                <table>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td>Project Title</td>
                        <td>$projectTitle</td>
                    </tr>
                    <tr>
                        <td>Project Purpose</td>
                        <td>$sitePurpose</td>
                    </tr>
                    <tr>
                        <td>Project Pages</td>
                        <td>$sitePages</td>
                    </tr>
                    <tr>
                        <td>Project Features</td>
                        <td>$siteFeatures</td>
                    </tr>
                    <tr>
                        <td>Design Color</td>
                        <td>$designSchemeColor</td>
                    </tr>
                    <tr>
                        <td>Design Typography</td>
                        <td>$designSchemeTypography</td>
                    </tr>
                    <tr>
                        <td>Project Type</td>
                        <td>$siteType</td>
                    </tr>
                    <tr>
                        <td>Completion Date</td>
                        <td>$completionDate</td>
                    </tr>
                    <tr>
                        <td>Budget</td>
                        <td>$budget</td>
                    </tr>
                    <tr>
                        <td>Domain & Hosting</td>
                        <td>$domainHosting</td>
                    </tr>
                    <tr>
                        <td>Payment Schedule</td>
                        <td>$paymentSchedule</td>
                    </tr>
                    <tr>
                        <td>Reference Sites</td>
                        <td>$referenceSites</td>
                    </tr>
                </table>
            </div>
            
            <div class='card'>
                <h2>Additional Requests</h2>
                <p>$requests</p>
            </div>
        </div>
    </body>
    </html>";

   // Email text and attachment
    $email_message = "--{$mime_boundary}\r\n";
    $email_message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
    $email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $email_message .= $message . "\r\n";

    // Check if a file was uploaded
    if (isset($_FILES["upload-files"]) && $_FILES["upload-files"]["error"] == 0) {
        $file_name = $_FILES["upload-files"]["name"];
        $file_tmp_name = $_FILES["upload-files"]["tmp_name"];

        $file = fopen($file_tmp_name, "rb");
        $data = fread($file, filesize($file_tmp_name));
        fclose($file);
        $data = chunk_split(base64_encode($data));

        $email_message .= "--{$mime_boundary}\r\n";
        $email_message .= "Content-Type: application/octet-stream;\r\n";
        $email_message .= " name=\"{$file_name}\"\r\n";
        $email_message .= "Content-Transfer-Encoding: base64\r\n";
        $email_message .= "Content-Disposition: attachment;\r\n";
        $email_message .= " filename=\"{$file_name}\"\r\n\r\n";
        $email_message .= $data . "\r\n";
        $email_message .= "--{$mime_boundary}--\r\n";
    }

    // Send the email
    if (mail($to, $subject, $email_message, $headers)) {
        // Client auto-response email
        $clientAutoResponseSubject = "Thank You for Your Inquiry";
        $clientAutoResponseMessage = "Dear $fullName,
        
Thank you for contacting Zorith Industries with your inquiry. We have received your message and will get back to you as soon as possible.
        
In the meantime, feel free to visit our website at www.zorithindustries.com to learn more about our services.
        
Best regards,
The Zorith Industries Team
www.zorithindustries.com";
        
        // Send the client auto-response email
        mail($email, $clientAutoResponseSubject, $clientAutoResponseMessage, $headers);

    
        $response = array("success" => true, "message" => "Your inquiry has been submitted successfully!");
    } else {
        $response = array("success" => false, "message" => "Oops! Something went wrong, and we couldn't send your inquiry.");
    }
} else {
    $response = array("success" => false, "message" => "Access denied!");
}

// Output JSON response
echo json_encode($response);
?>
