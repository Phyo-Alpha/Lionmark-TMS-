<?php
session_start();

// Include database config if needed
// include_once '../conf/conf.php';

require_once __DIR__ . '/../class/phpformbuilder/mailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../class/phpformbuilder/mailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../class/phpformbuilder/mailer/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../conf/conf.php';

require_once __DIR__ . '/../class/phpformbuilder/Validator/Validator.php';
require_once __DIR__ . '/../class/phpformbuilder/Validator/Exception.php';
require_once __DIR__ . '/../model/WorkShop-Registeration.php';
require_once __DIR__ . '/mail/mail.php';


use phpformbuilder\Validator\Validator;

$page_title = 'Workshop Registration Form';
$success_message = '';
$errors = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize validator with POST data
    $validator = new Validator($_POST);

    // Validate required fields with chaining
    $validator->required()->validate('firstName');
    $validator->required()->validate('lastName');
    $validator->email()->required()->validate('email');
    $validator->required()->validate('phone');
    $validator->required()->validate('countryCode');
    $validator->required()->validate('dob');
    $validator->required()->validate('nationality');
    $validator->required()->validate('address');

    // Check if validation passed
    if ($validator->hasErrors()) {
        // Get all validation errors
        $validation_errors = $validator->getAllErrors();
        foreach ($validation_errors as $field => $error_messages) {
            if (is_array($error_messages)) {
                foreach ($error_messages as $error) {
                    $errors[] = $error;
                }
            } else {
                $errors[] = $error_messages;
            }
        }
    } else {
        // Validation passed, process the form using ORM model
        $registration = new WorkShopRegistration();
        $registration->fill($_POST);

        $insertedId = $registration->save();

        if ($insertedId !== false) {
            error_log("Saved to database successfully with ID: " . $insertedId);

            // Send confirmation email
            $emailSent = sendConfirmationEmail($_POST);

            if ($emailSent) {
                $success_message = true;
                // Clear POST data on success
                $_POST = [];
            } else {
                $errors[] = "Registration saved but email failed to send. We will contact you shortly.";
            }
        } else {
            error_log("Failed to save registration");
            $errors[] = "Failed to save registration. Please try again or contact support.";
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/register/assets/css/register.css">
</head>

<body>
    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <div class="logo-section">
                <div class="logo">
                    <span class="brain-icon"></span>
                    LionMarks
                </div>
            </div>
            <h1 class="form-title">Workshop Registration Form</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="registration-card">
            <h2 class="section-title">Student details</h2>

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
                        <!-- First Name and Last Name -->
                        <div class="row">
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
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email'); ?>" required>
                            </div>
                            <div class="col-md-6">
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
                        </div>

                        <!-- Date of Birth and Nationality -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="dob" class="form-label required">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo old('dob'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nationality" class="form-label required">Nationality</label>
                                <select class="form-select" id="nationality" name="nationality" required>
                                    <option value="">Select Nationality</option>
                                    <option value="Singaporean" <?php echo old('nationality') == 'Singaporean' ? 'selected' : ''; ?>>Singaporean</option>
                                    <option value="PR" <?php echo old('nationality') == 'PR' ? 'selected' : ''; ?>>PR</option>
                                    <option value="Others" <?php echo old('nationality') == 'Others' ? 'selected' : ''; ?>>Others</option>
                                </select>
                            </div>
                        </div>

                        <!-- Home Address -->
                        <div class="row">
                            <div class="col-md-12">
                                <label for="address" class="form-label required">Home Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo old('address'); ?>" required>
                            </div>
                        </div>

                        <!-- Qualification and English Competency -->
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="englishCompetency" class="form-label">English Competency</label>
                                <select class="form-select" id="englishCompetency" name="englishCompetency">
                                    <option value="Competent" <?php echo old('englishCompetency', 'Competent') == 'Competent' ? 'selected' : ''; ?>>Competent</option>
                                    <option value="Not competent" <?php echo old('englishCompetency') == 'Not competent' ? 'selected' : ''; ?>>Not competent</option>
                                </select>
                            </div>
                        </div>

                        <!-- Vaccination Status -->
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Fully vaccinated?</label>
                                <div class="radio-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated-yes" value="Yes" <?php echo old('vaccinated') == 'Yes' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="vaccinated-yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated-no" value="No" <?php echo old('vaccinated') == 'No' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="vaccinated-no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Workshop Selection -->
                        <div class="row">
                            <div class="col-md-12">
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
                        </div>

                        <!-- Class Start Date and Salesperson -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="classStartDate" class="form-label">Class Start Date</label>
                                <input type="date" class="form-control" id="classStartDate" name="classStartDate" value="<?php echo old('classStartDate'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="salesperson" class="form-label">Salesperson's name (if applicable)</label>
                                <input type="text" class="form-control" id="salesperson" name="salesperson" value="<?php echo old('salesperson'); ?>">
                            </div>
                        </div>

                        <!-- How did you hear about us -->
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">How did you hear about us?</label>
                                <div class="radio-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hearAboutUs" id="hearAboutUs-google" value="Google Search" <?php echo old('hearAboutUs') == 'Google Search' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="hearAboutUs-google">Google Search</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hearAboutUs" id="hearAboutUs-instagram" value="Instagram" <?php echo old('hearAboutUs') == 'Instagram' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="hearAboutUs-instagram">Instagram</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hearAboutUs" id="hearAboutUs-facebook" value="Facebook" <?php echo old('hearAboutUs') == 'Facebook' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="hearAboutUs-facebook">Facebook</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hearAboutUs" id="hearAboutUs-friends" value="Friends" <?php echo old('hearAboutUs') == 'Friends' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="hearAboutUs-friends">Friends</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hearAboutUs" id="hearAboutUs-booth" value="Sales Booth" <?php echo old('hearAboutUs') == 'Sales Booth' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="hearAboutUs-booth">Sales Booth</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hearAboutUs" id="hearAboutUs-others" value="Others" <?php echo old('hearAboutUs') == 'Others' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="hearAboutUs-others">Others</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Note -->
                        <div class="alert alert-info">
                            <strong>*Note:</strong><br>
                            We will contact you regarding a $30 refundable deposit.<br>
                            This deposit will be returned upon course completion.
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">
                                Submit Registration <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>

            </div>
        </div>
</body>

</html>
