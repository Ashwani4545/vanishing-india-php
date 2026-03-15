<?php
require_once '../includes/config.php';
header('Content-Type: application/json');

$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
if (!$email) {
    echo json_encode(['success'=>false, 'message'=>'Please enter a valid email address.']);
    exit;
}

$db = getDB();
if ($db) {
    try {
        $stmt = $db->prepare("INSERT IGNORE INTO newsletter (email) VALUES (?)");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success'=>true, 'message'=>'Thank you for subscribing! Welcome to the Vanishing India family.']);
        } else {
            echo json_encode(['success'=>true, 'message'=>'You are already subscribed. Thank you!']);
        }
    } catch (Exception $e) {
        echo json_encode(['success'=>false, 'message'=>'An error occurred. Please try again.']);
    }
} else {
    // No DB — graceful response
    echo json_encode(['success'=>true, 'message'=>'Thank you for subscribing! (Configure DB to save subscriptions.)']);
}
