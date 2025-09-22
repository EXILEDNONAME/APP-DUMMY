<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Error' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #000;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Garis animasi di background */
        .line {
            position: absolute;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: lineFlow 8s linear infinite;
        }

        .line:nth-child(1) {
            top: 20%;
            left: -100px;
            width: 300px;
            height: 1px;
            animation-delay: 0s;
        }

        .line:nth-child(2) {
            top: 60%;
            right: -100px;
            width: 250px;
            height: 1px;
            animation-delay: 2s;
        }

        .line:nth-child(3) {
            bottom: 30%;
            left: -80px;
            width: 200px;
            height: 1px;
            animation-delay: 4s;
        }

        .line:nth-child(4) {
            bottom: 10%;
            right: -120px;
            width: 280px;
            height: 1px;
            animation-delay: 6s;
        }

        /* Titik-titik kecil yang bergerak */
        .dot {
            position: absolute;
            width: 4px;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: dotFloat 10s infinite ease-in-out;
        }

        .dot:nth-child(5) {
            top: 15%;
            left: 20%;
            animation-delay: 0s;
        }

        .dot:nth-child(6) {
            top: 70%;
            left: 10%;
            animation-delay: 3s;
        }

        .dot:nth-child(7) {
            top: 40%;
            right: 15%;
            animation-delay: 6s;
        }

        .dot:nth-child(8) {
            bottom: 25%;
            right: 25%;
            animation-delay: 2s;
        }

        /* Container utama */
        .container {
            background: rgba(20, 20, 20, 0.9);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.1);
            max-width: 500px;
            width: 90%;
            animation: fadeIn 1s ease-out;
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            animation: containerShine 3s infinite;
        }

        /* Ikon peringatan */
        .warning-icon {
            font-size: 80px;
            color: #ff4444;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
            text-shadow: 0 0 15px rgba(255, 68, 68, 0.6);
        }

        /* Teks */
        h1 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 28px;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        p {
            color: #ccc;
            margin-bottom: 25px;
            font-size: 18px;
            line-height: 1.5;
        }

        /* Tombol */
        .contact-button {
            background: linear-gradient(135deg, #4263eb, #3b5bdb);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .contact-button::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg,
                    transparent,
                    rgba(255, 255, 255, 0.1),
                    transparent);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .contact-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }

        .contact-button:hover::before {
            animation: buttonShine 1.5s;
        }

        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                text-shadow: 0 0 15px rgba(255, 68, 68, 0.6);
            }

            50% {
                transform: scale(1.1);
                text-shadow: 0 0 20px rgba(255, 68, 68, 0.8);
            }

            100% {
                transform: scale(1);
                text-shadow: 0 0 15px rgba(255, 68, 68, 0.6);
            }
        }

        @keyframes lineFlow {
            0% {
                transform: translateX(-100px);
            }

            100% {
                transform: translateX(calc(100vw + 100px));
            }
        }

        @keyframes dotFloat {
            0% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(-20px) translateX(10px);
            }

            100% {
                transform: translateY(0) translateX(0);
            }
        }

        @keyframes containerShine {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        @keyframes buttonShine {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* Media queries untuk responsivitas */
        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 16px;
            }

            .warning-icon {
                font-size: 60px;
            }
        }
    </style>
</head>

<body>
    <!-- Garis background -->
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>

    <!-- Titik-titik background -->
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>

    <!-- Container utama -->
    <div class="container">
        <div class="warning-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1>{{ $title ?? 'License Error' }}</h1>
        <p>{{ $message ?? 'License tidak valid atau sudah kedaluwarsa.' }}</p>
        <button class="contact-button" onclick="contactDeveloper()">
            <i class="fas fa-envelope"></i> Hubungi Developer
        </button>
    </div>

    <script>
        function contactDeveloper() {
            alert("Silakan hubungi melalui email: support@developer.com atau telepon: +62 123 456 789");
        }

        // Tambahkan lebih banyak titik secara dinamis
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.querySelector('body');
            for (let i = 0; i < 6; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                dot.style.top = Math.random() * 100 + '%';
                dot.style.left = Math.random() * 100 + '%';
                dot.style.animationDelay = Math.random() * 10 + 's';
                body.appendChild(dot);
            }
        });
    </script>
</body>

</html>