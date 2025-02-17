<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกข้อมูลสำเร็จ!</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <?php if (isset($success) && $success): ?>
        <div class="popup">
            <div class="popup-content">
                <img src="https://i.imgur.com/BBQ2xts.jpg" class="logo" alt="Logo">
                <p>บันทึกข้อมูลยินยอมรับการรักษาสำเร็จ</p>
                <div class="details-container">
                    <h3>ข้อมูลที่บันทึก:</h3>
                    <p><strong>ชื่อผู้ป่วย:</strong> <?php echo htmlspecialchars($name); ?></p>
                    <p><strong>เบอร์ติดต่อ (ไม่ต้องใส่ - ):</strong> <?php echo htmlspecialchars($tel); ?></p>
                    <p><strong>ข้อความยินยอม:</strong> <?php echo htmlspecialchars($consent); ?></p>
                    <div class="signature-container">
                        <div class="signature-row">
                            <p><strong>ลงชื่อ:</strong></p>
                            <img src="<?php echo htmlspecialchars($signature); ?>" alt="Signature Image">
                        </div>
                        <p>(<?php echo htmlspecialchars($name); ?>)</p>
                    </div>
                    <button class="print-btn" onclick="window.print()">พิมพ์ข้อมูล</button>
                </div>
            </div>
        </div>
    <?php elseif (isset($success) && !$success): ?>
        <div class="popup">
            <div class="popup-content popup-error">
                <?php echo $error_message; ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>