<?php
session_start();

// Include database config if needed
// include_once '../conf/conf.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

$page_title = 'Workshop Registration Form';
$success_message = '';
$errors = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    if (empty($_POST['firstName'])) {
        $errors[] = "First Name is required";
    }
    if (empty($_POST['lastName'])) {
        $errors[] = "Last Name is required";
    }
    if (empty($_POST['email'])) {
        $errors[] = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($_POST['phone'])) {
        $errors[] = "Phone Number is required";
    }
    if (empty($_POST['dob'])) {
        $errors[] = "Date of Birth is required";
    }
    if (empty($_POST['nationality'])) {
        $errors[] = "Nationality is required";
    }
    if (empty($_POST['address'])) {
        $errors[] = "Home Address is required";
    }

    // If no errors, process the form
    if (empty($errors)) {
        $dbSave = saveToDatabase($_POST);

        if ($dbSave) {
            $emailSent = sendConfirmationEmail($_POST);

            if ($emailSent) {
                $success_message = true;
                // Clear POST data on success
                $_POST = [];
            } else {
                $errors[] = "Registration saved but email failed to send. We will contact you shortly.";
            }
        } else {
            $errors[] = "Failed to save registration. Please try again or contact support.";
        }
    }
}

function saveToDatabase($data)
{
    $servername = "127.0.0.1";
    $port = 3309;
    $username = "lionmarks_user";
    $password = "lionmarks_password";
    $dbname = "lionmarks_tms";


    $conn = new mysqli($servername, $username, $password, $dbname, $port);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO workshop_registrations (firstName, lastName, email, countryCode, phone, dob, nationality, address, qualification, englishCompetency, vaccinated, workshop, classStartDate, salesperson, hearAboutUs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        $conn->close();
        return false;
    }

    $stmt->bind_param(
        "sssssssssssssss",
        $data['firstName'],
        $data['lastName'],
        $data['email'],
        $data['countryCode'],
        $data['phone'],
        $data['dob'],
        $data['nationality'],
        $data['address'],
        $data['qualification'],
        $data['englishCompetency'],
        $data['vaccinated'],
        $data['workshop'],
        $data['classStartDate'],
        $data['salesperson'],
        $data['hearAboutUs']
    );

    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }

    $stmt->close();
    $conn->close();
    return true;
}

// Function to send confirmation email
function sendConfirmationEmail($data)
{
    $mail = new PHPMailer(true);
    error_log("Sending confirmation email to " . $data['email'] . " with subject " . 'Workshop Registration Confirmation - Lionmarks Training');

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@lionmark.com.sg';  // Your Hostinger email
        $mail->Password   = 'Lionmarka20222!';            // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Timeout settings to prevent hanging
        $mail->Timeout = 30;
        $mail->SMTPKeepAlive = false;
        $mail->SMTPDebug = 0; // Set to 2 for debugging

        // Recipients
        $mail->setFrom('admin@lionmark.com.sg', 'Lionmarks Training');
        $mail->addAddress($data['email'], $data['firstName'] . ' ' . $data['lastName']);
        $mail->addReplyTo('admin@lionmark.com.sg', 'Lionmarks Training');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Workshop Registration Confirmation - Lionmarks Training';
        $mail->Body    = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
                .info-row { margin: 10px 0; padding: 10px; background: white; border-radius: 5px; }
                .label { font-weight: bold; color: #667eea; }
                .footer { text-align: center; margin-top: 30px; padding: 20px; color: #666; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🎉 Registration Confirmed!</h1>
                    <p>Thank you for registering with Lionmarks Training</p>
                </div>
                <div class='content'>
                    <h2>Registration Details</h2>
                    <div class='info-row'><span class='label'>Name:</span> " . htmlspecialchars($data['firstName'] . ' ' . $data['lastName']) . "</div>
                    <div class='info-row'><span class='label'>Email:</span> " . htmlspecialchars($data['email']) . "</div>
                    <div class='info-row'><span class='label'>Phone:</span> " . htmlspecialchars($data['countryCode'] . ' ' . $data['phone']) . "</div>
                    <div class='info-row'><span class='label'>Workshop:</span> " . htmlspecialchars($data['workshop'] ?? 'Not selected') . "</div>

                    <div style='margin-top: 30px; padding: 20px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 5px;'>
                        <strong>⚠️ Important Note:</strong><br>
                        We will contact you regarding a $30 refundable deposit.<br>
                        This deposit will be returned upon course completion.
                    </div>
                </div>
                <div class='footer'>
                    <p>© 2025 Lionmarks Training. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail->send();
        error_log("Email sent successfully to " . $data['email']);
        return true;
    } catch (Exception $e) {
        error_log("Email Error: " . $e->getMessage());
        error_log("SMTP Error Info: " . $mail->ErrorInfo);
        return false;
    }
}

// Preserve form values
function old($field, $default = '')
{
    return isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : $default;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/register/assets/css/register.css">
</head>

<body>
    <div class="container">
        <div class="registration-card">
            <div class="header">
                <h1>Workshop Registration Form</h1>
                <p>Fill in the form and we will get back to you shortly.</p>
            </div>

            <div class="form-section">
                <?php if ($success_message): ?>
                    <div class="alert alert-success text-center">
                        <i class="fas fa-check-circle"></i>
                        <h4 class="mt-3">Thanks for submitting!</h4>
                        <p>We will contact you shortly regarding your registration.</p>
                    </div>
                <?php else: ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <h2 class="section-heading">1. Registration</h2>

                        <!-- First Name and Last Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label required">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo old('firstName'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label required">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo old('lastName'); ?>" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email'); ?>" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="phone" class="form-label required">Phone Number</label>
                            <div class="phone-row">
                                <div class="country-code">
                                    <select class="form-select" id="countryCode" name="countryCode" required>
                                        <option value="SG +65" <?php echo old('countryCode') == 'SG +65' ? 'selected' : ''; ?>>SG +65</option>
                                        <option value="MY +60" <?php echo old('countryCode') == 'MY +60' ? 'selected' : ''; ?>>MY +60</option>
                                        <option value="TH +66" <?php echo old('countryCode') == 'TH +66' ? 'selected' : ''; ?>>TH +66</option>
                                        <option value="ID +62" <?php echo old('countryCode') == 'ID +62' ? 'selected' : ''; ?>>ID +62</option>
                                        <option value="PH +63" <?php echo old('countryCode') == 'PH +63' ? 'selected' : ''; ?>>PH +63</option>
                                        <option value="VN +84" <?php echo old('countryCode') == 'VN +84' ? 'selected' : ''; ?>>VN +84</option>
                                        <option value="US +1" <?php echo old('countryCode') == 'US +1' ? 'selected' : ''; ?>>US +1</option>
                                        <option value="UK +44" <?php echo old('countryCode') == 'UK +44' ? 'selected' : ''; ?>>UK +44</option>
                                        <option value="AU +61" <?php echo old('countryCode') == 'AU +61' ? 'selected' : ''; ?>>AU +61</option>
                                        <option value="CN +86" <?php echo old('countryCode') == 'CN +86' ? 'selected' : ''; ?>>CN +86</option>
                                        <option value="JP +81" <?php echo old('countryCode') == 'JP +81' ? 'selected' : ''; ?>>JP +81</option>
                                        <option value="KR +82" <?php echo old('countryCode') == 'KR +82' ? 'selected' : ''; ?>>KR +82</option>
                                        <option value="IN +91" <?php echo old('countryCode') == 'IN +91' ? 'selected' : ''; ?>>IN +91</option>
                                    </select>
                                </div>
                                <div class="phone-number">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?php echo old('phone'); ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-3">
                            <label for="dob" class="form-label required">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo old('dob'); ?>" required>
                        </div>

                        <!-- Nationality -->
                        <div class="mb-3">
                            <label for="nationality" class="form-label required">Nationality</label>
                            <select class="form-select" id="nationality" name="nationality" required>
                                <option value="">Select Nationality</option>
                                <option value="Singaporean" <?php echo old('nationality') == 'Singaporean' ? 'selected' : ''; ?>>Singaporean</option>
                                <option value="PR" <?php echo old('nationality') == 'PR' ? 'selected' : ''; ?>>PR</option>
                                <option value="Others" <?php echo old('nationality') == 'Others' ? 'selected' : ''; ?>>Others</option>
                            </select>
                        </div>

                        <!-- Home Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label required">Home Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo old('address'); ?>" required>
                        </div>

                        <!-- Highest Qualification -->
                        <div class="mb-3">
                            <label for="qualification" class="form-label">Highest Qualification</label>
                            <select class="form-select" id="qualification" name="qualification">
                                <option value="Primary" <?php echo old('qualification', 'Primary') == 'Primary' ? 'selected' : ''; ?>>Primary</option>
                                <option value="Secondary" <?php echo old('qualification') == 'Secondary' ? 'selected' : ''; ?>>Secondary</option>
                                <option value="Diploma/A-Levels" <?php echo old('qualification') == 'Diploma/A-Levels' ? 'selected' : ''; ?>>Diploma/A-Levels</option>
                                <option value="Degree" <?php echo old('qualification') == 'Degree' ? 'selected' : ''; ?>>Degree</option>
                                <option value="Masters" <?php echo old('qualification') == 'Masters' ? 'selected' : ''; ?>>Masters</option>
                                <option value="PHD" <?php echo old('qualification') == 'PHD' ? 'selected' : ''; ?>>PHD</option>
                                <option value="Others" <?php echo old('qualification') == 'Others' ? 'selected' : ''; ?>>Others</option>
                            </select>
                        </div>

                        <!-- English Competency -->
                        <div class="mb-3">
                            <label for="englishCompetency" class="form-label">English Competency</label>
                            <select class="form-select" id="englishCompetency" name="englishCompetency">
                                <option value="Competent" <?php echo old('englishCompetency', 'Competent') == 'Competent' ? 'selected' : ''; ?>>Competent</option>
                                <option value="Not competent" <?php echo old('englishCompetency') == 'Not competent' ? 'selected' : ''; ?>>Not competent</option>
                            </select>
                        </div>

                        <!-- Fully vaccinated -->
                        <div class="mb-3">
                            <label class="form-label">Fully vaccinated?</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated-yes" value="Yes" <?php echo old('vaccinated') == 'Yes' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="vaccinated-yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated-no" value="No" <?php echo old('vaccinated') == 'No' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="vaccinated-no">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Choose Workshop -->
                        <div class="mb-3">
                            <label for="workshop" class="form-label">Choose Workshop</label>
                            <select class="form-select" id="workshop" name="workshop">
                                <option value="">Choose an option</option>
                                <option value="TikTok Social Media Marketing" <?php echo old('workshop') == 'TikTok Social Media Marketing' ? 'selected' : ''; ?>>TikTok Social Media Marketing</option>
                                <option value="Visual Content Essentials" <?php echo old('workshop') == 'Visual Content Essentials' ? 'selected' : ''; ?>>Visual Content Essentials</option>
                                <option value="Videography & Editing" <?php echo old('workshop') == 'Videography & Editing' ? 'selected' : ''; ?>>Videography & Editing</option>
                                <option value="Mobile Photography" <?php echo old('workshop') == 'Mobile Photography' ? 'selected' : ''; ?>>Mobile Photography</option>
                                <option value="AI-Driven Graphic Design" <?php echo old('workshop') == 'AI-Driven Graphic Design' ? 'selected' : ''; ?>>AI-Driven Graphic Design</option>
                                <option value="Acrylic Painting (Colour Concept)" <?php echo old('workshop') == 'Acrylic Painting (Colour Concept)' ? 'selected' : ''; ?>>Acrylic Painting (Colour Concept)</option>
                                <option value="Sketching and Watercolour Painting" <?php echo old('workshop') == 'Sketching and Watercolour Painting' ? 'selected' : ''; ?>>Sketching and Watercolour Painting</option>
                                <option value="Digital Art with Procreate" <?php echo old('workshop') == 'Digital Art with Procreate' ? 'selected' : ''; ?>>Digital Art with Procreate</option>
                                <option value="Canva for Social Media" <?php echo old('workshop') == 'Canva for Social Media' ? 'selected' : ''; ?>>Canva for Social Media</option>
                                <option value="DJ Sound Mixing" <?php echo old('workshop') == 'DJ Sound Mixing' ? 'selected' : ''; ?>>DJ Sound Mixing</option>
                                <option value="Peranakan Cuisine" <?php echo old('workshop') == 'Peranakan Cuisine' ? 'selected' : ''; ?>>Peranakan Cuisine</option>
                                <option value="Japanese Cuisine" <?php echo old('workshop') == 'Japanese Cuisine' ? 'selected' : ''; ?>>Japanese Cuisine</option>
                                <option value="Delicious Bento" <?php echo old('workshop') == 'Delicious Bento' ? 'selected' : ''; ?>>Delicious Bento</option>
                                <option value="Dim Sum" <?php echo old('workshop') == 'Dim Sum' ? 'selected' : ''; ?>>Dim Sum</option>
                                <option value="Hawker Delights" <?php echo old('workshop') == 'Hawker Delights' ? 'selected' : ''; ?>>Hawker Delights</option>
                                <option value="Korean Delights" <?php echo old('workshop') == 'Korean Delights' ? 'selected' : ''; ?>>Korean Delights</option>
                                <option value="Thai Cuisine" <?php echo old('workshop') == 'Thai Cuisine' ? 'selected' : ''; ?>>Thai Cuisine</option>
                                <option value="Plant Based Delights" <?php echo old('workshop') == 'Plant Based Delights' ? 'selected' : ''; ?>>Plant Based Delights</option>
                                <option value="Artisan Candle Design" <?php echo old('workshop') == 'Artisan Candle Design' ? 'selected' : ''; ?>>Artisan Candle Design</option>
                                <option value="Artisan Cosmetic Material Design" <?php echo old('workshop') == 'Artisan Cosmetic Material Design' ? 'selected' : ''; ?>>Artisan Cosmetic Material Design</option>
                                <option value="Perfumery Product Design" <?php echo old('workshop') == 'Perfumery Product Design' ? 'selected' : ''; ?>>Perfumery Product Design</option>
                                <option value="Artisanal Soap Making Craft" <?php echo old('workshop') == 'Artisanal Soap Making Craft' ? 'selected' : ''; ?>>Artisanal Soap Making Craft</option>
                                <option value="Specialty Perfumery Craft" <?php echo old('workshop') == 'Specialty Perfumery Craft' ? 'selected' : ''; ?>>Specialty Perfumery Craft</option>
                            </select>
                        </div>

                        <!-- Class Start Date -->
                        <div class="mb-3">
                            <label for="classStartDate" class="form-label">Class Start Date</label>
                            <input type="date" class="form-control" id="classStartDate" name="classStartDate" value="<?php echo old('classStartDate'); ?>">
                        </div>

                        <!-- Salesperson -->
                        <div class="mb-3">
                            <label for="salesperson" class="form-label">Salesperson's name (if applicable)</label>
                            <input type="text" class="form-control" id="salesperson" name="salesperson" value="<?php echo old('salesperson'); ?>">
                        </div>

                        <!-- How did you hear about us -->
                        <div class="mb-3">
                            <label for="hearAboutUs" class="form-label">How did you hear about us?</label>
                            <select class="form-select" id="hearAboutUs" name="hearAboutUs">
                                <option value="">Choose an option</option>
                                <option value="Social Media" <?php echo old('hearAboutUs') == 'Social Media' ? 'selected' : ''; ?>>Social Media</option>
                                <option value="Google" <?php echo old('hearAboutUs') == 'Google' ? 'selected' : ''; ?>>Google</option>
                                <option value="Friends" <?php echo old('hearAboutUs') == 'Friends' ? 'selected' : ''; ?>>Friends</option>
                                <option value="Sales Booth" <?php echo old('hearAboutUs') == 'Sales Booth' ? 'selected' : ''; ?>>Sales Booth</option>
                                <option value="Others" <?php echo old('hearAboutUs') == 'Others' ? 'selected' : ''; ?>>Others</option>
                            </select>
                        </div>

                        <!-- Note -->
                        <div class="alert alert-info mt-4">
                            <strong>*Note:</strong><br>
                            We will contact you regarding a $30 refundable deposit.<br>
                            This deposit will be returned upon course completion.
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">
                                Submit <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
