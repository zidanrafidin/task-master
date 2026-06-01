<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Base Neo-Brutalism Styling */
        .neo-box {
            border: 4px solid #000000;
            box-shadow: 8px 8px 0px #000000;
        }
        .neo-button {
            border: 4px solid #000000;
            box-shadow: 4px 4px 0px #000000;
            transition: all 0.15s ease-in-out;
        }
        .neo-button:active {
            box-shadow: 0px 0px 0px #000000;
            transform: translate(4px, 4px);
        }
    </style>
</head>
<body class="bg-[#facc15] font-sans min-h-screen flex items-center justify-center p-6 text-black">

    <div class="bg-white neo-box p-10 max-w-3xl w-full text-center rounded-sm">
        <h1 class="text-6xl font-black mb-4 uppercase tracking-tighter">
            <?= $title ?>
        </h1>
        <p class="text-2xl font-bold mb-10">
            <?= $tagline ?>
        </p>
        
        <div class="flex justify-center gap-6">
            <a href="/taskmaster/auth/login" class="bg-[#a3e635] text-black font-black py-4 px-10 text-xl neo-button rounded-sm">
                Login
            </a>
            <a href="/taskmaster/auth/register" class="bg-[#f472b6] text-black font-black py-4 px-10 text-xl neo-button rounded-sm">
                Register
            </a>
        </div>
    </div>

</body>
</html>