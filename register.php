<?php
//include db connection
include 'db.php';

/*
function to remove backslash and sanitize the input to prevent cross site scripting
@return string
*/
function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

//handle post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $reg_num = test_input($_POST["reg_num"]);
    $age = test_input($_POST["age"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);
    $course = test_input($_POST["course"]);

}

//validation
if (!preg_match("/^[a-zA-Z]{2,}$/", $name)) {
    die("Invalid formate, only alphabets allowd and minimum 2 characters");
}

if (!preg_match("/^REG-\d{4}-\d{4}$/", $reg_num)) {
    die("Invalid formate");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email");
}

if ($age < 18 || $age > 25) {
    die("Age must be between 18 and 25");
}

if (!preg_match("/^[0-9]{10}$/", $phone)) {
    die("Invalid phone number must be 10 digits");
}

if (!in_array($course, ['Btech', 'Mtech', 'BCA', 'MCA'])) {
    die("Invalid course");
}

//insert in db using preaper and bind
$stmt = $conn->prepare("INSERT INTO students(name,registration_number,age,phone,email,course) VALUES(?,?,?,?,?,?)");
$stmt->bind_param("ssisss", $name, $reg_num, $age, $phone, $email, $course);

if ($stmt->execute()) {
    echo "Students added sucessfully";
} else {
    echo "Error" . $stmt->error;
}

//closing
$stmt->close();
$conn->close();

?>