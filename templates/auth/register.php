<?php
//  require '../layout/header.php';
 ?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl p-8 rounded-3xl w-full max-w-lg">

        <h2 class="text-3xl font-black text-center">
            Create Account
        </h2>
        <form class="space-y-4 mt-8">

            <input
                type="text"
                placeholder="Full Name"
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <input
                type="email"
                placeholder="Email Address"
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <input
                type="password"
                placeholder="Password"
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <input
                type="password"
                placeholder="Confirm Password"
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                Create Account
            </button>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>

                <div class="relative flex justify-center text-sm">
                    <span class="bg-white px-3 text-slate-400">
                        Already registered?
                    </span>
                </div>
            </div>

            <a href="login.php"
                class="w-full flex justify-center items-center border border-slate-200 py-3 rounded-xl font-semibold text-slate-700 hover:bg-slate-50 transition">
                Sign In
            </a>

        </form>

    </div>

</div>

<?php require '../layout/footer.php'; ?>