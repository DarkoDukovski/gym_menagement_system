<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $member_id = $_POST['member_id'];

    // Retrieve the photo path of the member
    $sql = "SELECT photo_path FROM members WHERE member_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    // Delete the photo file from the application directory
    if ($member && $member['photo_path']) {
        $photo_path = $member['photo_path'];
        if (file_exists($photo_path)) {
            unlink($photo_path);
        }
    }

    // Delete the member from the database
    $sql = "DELETE FROM members WHERE member_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $member_id);
    $message = "";

    if ($stmt->execute()) {
        $message = "Member is deleted successfully";
    } else {
        $message = "Member is not deleted successfully";
    }

    $_SESSION['success_message'] = $message;
    header('location: admin_dashboard.php');
    exit();
}
