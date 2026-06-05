<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Gestion de Clinique Médicale</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-heart-pulse text-blue-600 text-2xl"></i>
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">MedFlow</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/patient/search" class="text-slate-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition">Rechercher un médecin</a>
                    <a href="/patient/dashboard" class="text-slate-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition">Mon Tableau de Bord</a>
                    
                    <span class="h-6 w-px bg-slate-200"></span>
                    
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm tracking-wide">
                            PT
                        </div>
                        <a href="/auth/logout" class="text-slate-400 hover:text-red-600 p-2 text-sm transition" title="Déconnexion">
                            <i class="fa-solid fa-right-from-bracket text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8">