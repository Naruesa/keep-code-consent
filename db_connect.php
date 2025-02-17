<?php
// ใช้ __DIR__ เพื่อให้แน่ใจว่าเส้นทางถูกต้อง
$config = parse_ini_file(__DIR__ . '/includes/db_connect.ini');  // เส้นทางสัมพัทธ์ที่ถูกต้อง

// ตรวจสอบว่าไฟล์การตั้งค่าถูกโหลดหรือไม่
if ($config === false) {
    die("ไม่สามารถอ่านไฟล์การตั้งค่า db_connect.ini ได้");
}

// เชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($config['db_server'], $config['db_username'], $config['db_password'], $config['db_name']);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
} else {
    echo "เชื่อมต่อฐานข้อมูลสำเร็จ!";
}
?>
