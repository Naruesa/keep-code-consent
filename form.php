<?php include('config.php'); ?> <!-- รวมไฟล์ config.php -->

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title> <!-- ใช้ SITE_NAME จาก config.php -->
    
    <!-- ใส่ลิงก์ของ favicon ที่นี่ -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="form-container">
    <!-- โลโก้ -->
    <img src="https://i.imgur.com/BBQ2xts.jpg" class="logo" alt="Logo">
    <h2>ลงชื่อยินยอมเข้าร่วมการแพทย์ทางไกล<br>ศูนย์โทรเวชฯ งานผู้ป่วยนอก</h2>

    <form action="submit_consent.php" method="post">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <!-- ช่องกรอกชื่อ -->
        <div class="form-group">
            <label for="name">ชื่อผู้ป่วย:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <!-- ช่องกรอกเบอร์โทร -->
        <div class="form-group">
            <label for="tel">เบอร์ติดต่อ (ไม่ต้องใส่ - ): </label>
            <input type="tel" id="tel" name="tel" required>
        </div>

        <!-- ข้อความยินยอม -->
        <div class="form-group">
            <label for="consent">ข้อความยินยอม:</label>
            <textarea id="consent" name="consent" rows="4" required>ข้าพเจ้า(ผู้รับบริการ) ยินยอมรับการรักษาการแพทย์ทางไกล</textarea>
        </div>

        <!-- ลายเซ็น -->
        <div class="form-group signature">
            <label for="signature">ลายเซ็นต์:</label>
            <canvas id="signature-pad" width="400" height="200"></canvas>
            <div id="signature-name" style="margin-top: 10px; font-style: italic;">(ชื่อผู้ป่วย)</div>
            <button type="button" class="clear-btn" onclick="clearSignature()">ลบลายเซ็นต์</button>
            <input type="hidden" id="signature" name="signature">
        </div>

        <!-- ปุ่มยืนยัน -->
        <input type="submit" value="ยืนยันการยินยอม" onclick="saveSignature()">
    </form>
</div>

<!-- ลิงก์ไปยัง JavaScript -->
<script src="scripts.js"></script>

<div class="owner-name">
    &copy; Telemedicine Center_TT
</div>
</body>
</html>
