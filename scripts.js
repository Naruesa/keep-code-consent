const canvas = document.getElementById("signature-pad");
const ctx = canvas.getContext("2d");
let isDrawing = false;

canvas.addEventListener("mousedown", () => {
    isDrawing = true;
});
canvas.addEventListener("mouseup", () => {
    isDrawing = false;
    ctx.beginPath();
});
canvas.addEventListener("mousemove", draw);

function draw(event) {
    if (!isDrawing) return;
    ctx.lineWidth = 2;
    ctx.lineCap = "round";
    ctx.strokeStyle = "#000000";
    ctx.lineTo(event.clientX - canvas.offsetLeft, event.clientY - canvas.offsetTop);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(event.clientX - canvas.offsetLeft, event.clientY - canvas.offsetTop);
}

function clearSignature() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // ลบลายเซ็นต์ที่วาด
    document.getElementById("signature").value = ""; // ลบข้อมูลลายเซ็นต์ที่เก็บใน hidden field
}

function saveSignature() {
    const dataURL = canvas.toDataURL(); // แปลง canvas เป็น Base64
    if (dataURL) {
        document.getElementById("signature").value = dataURL; // เก็บลายเซ็นต์ลงใน hidden input
    }
}

// อัปเดตชื่อในวงเล็บแบบเรียลไทม์
const nameInput = document.getElementById("name");
const signatureName = document.getElementById("signature-name");
nameInput.addEventListener("input", () => {
    const name = nameInput.value.trim();
    if (name) {
        signatureName.textContent = `(${name})`; // แสดงชื่อที่กรอก
    } else {
        signatureName.textContent = "(ชื่อผู้ป่วย)"; // หากไม่มีชื่อให้แสดงข้อความนี้
    }
});
