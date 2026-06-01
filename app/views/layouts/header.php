<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Task Master' ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* CSS Neo-Brutalism Global */
        body { background-color: #f8fafc; }
        .neo-box { border: 4px solid #000; box-shadow: 6px 6px 0px #000; }
        .neo-btn { border: 4px solid #000; box-shadow: 4px 4px 0px #000; transition: all 0.1s; }
        .neo-btn:active { box-shadow: 0px 0px 0px #000; transform: translate(4px, 4px); }
        
        .neo-bg-yellow { background-color: #facc15; }
        .neo-bg-green { background-color: #a3e635; }
        .neo-bg-pink { background-color: #f472b6; }
        .neo-bg-blue { background-color: #38bdf8; }
        .neo-bg-purple { background-color: #c084fc; }

        /* Custom Scrollbar Neo-Brutalism */
        ::-webkit-scrollbar { width: 12px; height: 12px; }
        ::-webkit-scrollbar-track { background: #f8fafc; border-left: 4px solid #000; border-top: 4px solid #000; }
        ::-webkit-scrollbar-thumb { background: #c084fc; border: 3px solid #000; border-radius: 0px; }
        ::-webkit-scrollbar-thumb:hover { background: #f472b6; }
    </style>
</head>
<!-- Mengubah menjadi flex-col di Mobile, dan flex-row di Desktop (md) -->
<body class="text-black font-sans min-h-screen flex flex-col md:flex-row overflow-hidden">