<?php
// ตรวจสอบว่าใช้ HTTP POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    die("Method Not Allowed");
}

// รวมไฟล์การเชื่อมต่อฐานข้อมูล
include('db_connect.php');  // เชื่อมต่อกับฐานข้อมูลที่สร้างขึ้นใน db_connect.php

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    http_response_code(500); // Internal Server Error
    die("ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้: " . mysqli_connect_error());
}

// รับข้อมูลจากฟอร์มและตรวจสอบความปลอดภัย
$name = htmlspecialchars($_POST['name']);
$tel = htmlspecialchars($_POST['tel']);
$consent = htmlspecialchars($_POST['consent']);
$signature = $_POST['signature'];

// ตรวจสอบว่าไม่มีช่องว่างในข้อมูลสำคัญ
if (empty($name) || empty($tel) || empty($consent) || empty($signature)) {
    http_response_code(400); // Bad Request
    die("ข้อมูลไม่ครบถ้วน");
}

// ตรวจสอบรูปแบบเบอร์โทร (ตัวเลข 10 หลัก)
if (!preg_match('/^[0-9]{10}$/', $tel)) {
    http_response_code(400); // Bad Request
    die("เบอร์โทรไม่ถูกต้อง");
}

// ตรวจสอบลายเซ็น (เป็น Base64 หรือไม่)
if (!preg_match('/^data:image\/(png|jpeg);base64,/', $signature)) {
    http_response_code(400); // Bad Request
    die("ลายเซ็นไม่ถูกต้อง");
}

// SQL สำหรับบันทึกข้อมูลลงฐานข้อมูล (ใช้ Prepared Statement เพื่อป้องกัน SQL Injection)
$stmt = $conn->prepare("INSERT INTO consent_forms (name, tel, consent, signature) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $tel, $consent, $signature);

if ($stmt->execute()) {
    $success = true;
} else {
    $success = false;
    $error_message = "เกิดข้อผิดพลาด: " . $stmt->error;
}

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>

<!-- แสดงผลลัพธ์ -->
<?php include('result_template.php'); ?>
