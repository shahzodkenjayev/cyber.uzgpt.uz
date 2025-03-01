<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Aloqa</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="header">
        <h1 class="white-text">Biz bilan bog‘laning</h1> <!-- Oq rangdagi matn -->
    </div>

    <div class="container">
        <div class="left">
            <form action="send_message.php" method="post">
                <input type="text" name="name" placeholder="Ismingiz" required><br>
                <input type="text" name="contact" placeholder="Email yoki Telefon raqam" required><br>
                <textarea name="message" placeholder="Xabaringiz" required></textarea><br>
                <button type="submit" class="button">Yuborish</button>
            </form>
        </div>

        <div class="right">
        <img src="http://localhost/cyber/assets/images/teacher.png" alt="O‘qituvchi" class="teacher-img">
        <!-- <img src="http://localhost/cyber/assets/images/teacher1.jpg" alt="Rasm topilmadi"> -->
        </div>


        <div class="teacher-info">
        
            <h3>Mutahassis: Shahzod Kenjayev</h3>
            <p>Kiberxavfsizlik va DevOps bo‘yicha mutaxassis.</p>
            <p>Telefon: <a href="tel:+998941279631" class="phone-link">+998 94-127-96-31</a></p>
            <p>Telegram: <a href="https://t.me/shahzodkenjayev" class="telegram-link">@ shahzodkenjayev</a></p>
            <p>Email: <a href="mailto:sh@uzgpt.uz" class="email-link">sh@uzgpt.uz</a></p>
             <!-- Telefon raqam -->
        </div>
            
        
    </div>

    <!-- Xarita -->
    <div class="map-container">
        <h2 class="white-text">Bizning manzil</h2>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2995.805982953067!2d69.24007307571848!3d41.33852527134705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8bba25763555%3A0x92e9ad96f4d5e6cf!2z0KHQsNC80LDRgNC-0LLQvtCz0LjRjw!5e0!3m2!1sen!2s"
            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    <script src="../assets/script.js"></script>
</body>
</html>
