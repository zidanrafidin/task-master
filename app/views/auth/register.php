<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .neo-box { border: 4px solid #000; box-shadow: 8px 8px 0px #000; }
        .neo-input { border: 4px solid #000; outline: none; transition: all 0.2s; }
        .neo-input:focus { box-shadow: 4px 4px 0px #000; transform: translate(-2px, -2px); }
        .neo-button { border: 4px solid #000; box-shadow: 4px 4px 0px #000; transition: all 0.1s; }
        .neo-button:active { box-shadow: 0px 0px 0px #000; transform: translate(4px, 4px); }
    </style>
</head>
<body class="bg-[#c084fc] font-sans min-h-screen flex items-center justify-center p-6">

    <div class="bg-white neo-box p-8 max-w-md w-full rounded-sm">
        <h2 class="text-4xl font-black mb-6 uppercase tracking-tight text-center">Register</h2>
        
        <?php if(!empty($error)): ?>
            <div class="bg-red-400 neo-box p-3 mb-4 text-black font-bold"><?= $error ?></div>
        <?php endif; ?>

        <?php if(!empty($success)): ?>
            <div class="bg-green-400 neo-box p-3 mb-4 text-black font-bold"><?= $success ?></div>
        <?php endif; ?>

        <form action="/taskmaster/auth/register" method="POST" class="space-y-5">
            <div>
                <label class="block font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full p-3 neo-input bg-gray-50 rounded-sm">
            </div>
            <div>
                <label class="block font-bold mb-2">Email</label>
                <input type="email" name="email" required class="w-full p-3 neo-input bg-gray-50 rounded-sm">
            </div>
            <div>
                <label class="block font-bold mb-2">Password</label>
                <input type="password" name="password" required minlength="6" class="w-full p-3 neo-input bg-gray-50 rounded-sm">
            </div>
            <button type="submit" class="w-full bg-[#facc15] text-black font-black text-xl py-3 neo-button mt-4 rounded-sm">
                DAFTAR
            </button>
        </form>
        <p class="mt-6 text-center font-bold">
            Sudah punya akun? <a href="/taskmaster/auth/login" class="text-blue-600 underline hover:text-blue-800">Login di sini</a>
        </p>
    </div>

</body>
</html>