<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect the form fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $skills = $_POST['skills'];
    $projects = $_POST['projects'];
    $profilePic = '';

    // Handle profile picture upload
    if (isset($_FILES["profilePic"]) && $_FILES["profilePic"]["error"] == 0) {
        $targetDir = "uploads/";
        // Ensure the directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $targetFile = $targetDir . basename($_FILES["profilePic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is a real image
        $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetFile)) {
                $profilePic = htmlspecialchars(basename($_FILES["profilePic"]["name"]));
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    } else {
        echo "No profile picture uploaded.";
        exit();
    }

    // Generate the portfolio page
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$name's Portfolio</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <style>
            body {
                background: #111111;
                color: #ffffff;
                font-family: 'Arial', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 20px;
            }

            .container {
                background-color: #222222;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                padding: 30px;
                max-width: 800px;
                width: 100%;
                text-align: center;
                animation: fadeInUp 1.2s ease-in-out;
            }

            .profile-pic {
                width: 150px;
                height: 150px;
                object-fit: cover;
                border-radius: 50%;
                border: 5px solid #FFD700;
                transition: transform 0.3s, box-shadow 0.3s;
                margin-bottom: 20px;
            }

            .profile-pic:hover {
                transform: scale(1.1);
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            }

            h1 {
                font-size: 2.5em;
                font-weight: bold;
                color: #FFD700;
                margin-top: 15px;
                margin-bottom: 10px;
            }

            p {
                font-size: 1.1em;
                margin-bottom: 15px;
                color: #f0f0f0;
            }

            strong {
                color: #FFD700;
            }

            .card {
                background-color: #333333;
                border: none;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
                margin-top: 25px;
                border-radius: 10px;
                animation: slideIn 1s ease-in-out;
            }

            .card-header {
                background-color: #444444;
                color: #FFD700;
                font-weight: bold;
                padding: 15px;
                font-size: 1.3em;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }

            .card-body {
                padding: 20px;
                font-size: 1.1em;
                background-color: #222222;
                color: #f0f0f0;
            }

            .skills, .projects {
                color: #f0f0f0;
                line-height: 1.6;
            }

            .skills::before, .projects::before {
                content: '• ';
                color: #FFD700;
                font-weight: bold;
                font-size: 1.5em;
                vertical-align: middle;
            }

            @keyframes fadeInUp {
                0% {
                    opacity: 0;
                    transform: translateY(30px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideIn {
                0% {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                100% {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @media (max-width: 768px) {
                h1 {
                    font-size: 2em;
                }

                .card-header {
                    font-size: 1.1em;
                }

                .card-body {
                    font-size: 1em;
                }
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='text-center'>
                <img src='uploads/$profilePic' class='profile-pic' alt='Profile Picture'>
                <h1>$name</h1>
                <p>$bio</p>
                <p><strong>Email:</strong> $email</p>
            </div>
            <div class='card'>
                <div class='card-header'>
                    Skills
                </div>
                <div class='card-body'>
                    <p class='skills'>$skills</p>
                </div>
            </div>
            <div class='card'>
                <div class='card-header'>
                    Projects
                </div>
                <div class='card-body'>
                    <p class='projects'>$projects</p>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
}
?>
