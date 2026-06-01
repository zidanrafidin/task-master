<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Task Master' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Neo-Brutalism Global */
        body { background-color: #f8fafc; }
        .neo-box { border: 4px solid #000; box-shadow: 6px 6px 0px #000; }
        .neo-btn { border: 4px solid #000; box-shadow: 4px 4px 0px #000; transition: all 0.1s; }
        .neo-btn:active { box-shadow: 0px 0px 0px #000; transform: translate(4px, 4px); }
        
        /* Warna palet spesifik */
        .neo-bg-yellow { background-color: #facc15; }
        .neo-bg-green { background-color: #a3e635; }
        .neo-bg-pink { background-color: #f472b6; }
        .neo-bg-blue { background-color: #38bdf8; }
        .neo-bg-purple { background-color: #c084fc; }
    </style>
</head>
<body class="text-black font-sans min-h-screen flex">