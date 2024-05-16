<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Play Game</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Padding-bottom hack for maintaining aspect ratio of iframe */
        .pb-16-9 {
            padding-bottom: 56.25%;
        }
        .frame {
            width: 400px;
            height: 500px;
            background-color: #333;
            border: 20px solid #222;
            border-radius: 20px;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">

    <!-- Header Section -->
    <header class="bg-gray-800 p-4 shadow-lg flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-white text-lg px-4 py-2 rounded bg-gray-600 hover:bg-gray-700">Back to Dashboard</a>
        <h1 class="text-3xl font-bold text-center">Bidasari Game</h1>
    </header>

    <!-- Main Content Section -->
    <main class="flex flex-col items-center justify-center min-h-screen p-4">
        <div id="container" class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg overflow-hidden p-4 text-center transition-all duration-500 ease-in-out">
            <div id="photoFrame" class="mt-8 mb-4">
                <div class="frame mx-auto">
                    <!-- Placeholder for the photo -->
                    <img src="../images/BidaSari.jpg" alt="Photo" class="w-full h-full object-cover rounded-lg">
                </div>
            </div>
            <button id="toggleButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Start
            </button>
            <div id="gameContainer" class="mt-8 w-full relative overflow-hidden hidden pb-16-9 transition-all duration-500 ease-in-out">
                <iframe 
                    id="gameFrame"
                    src="https://bidasariwmad1.netlify.app/" 
                    class="absolute top-0 left-0 w-full h-full border-0"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-800 p-4 mt-4 text-center">
        <p>&copy; 2024 Gaming Website. All rights reserved.</p>
    </footer>

<script>
    document.getElementById('toggleButton').addEventListener('click', function() {
        var gameContainer = document.getElementById('gameContainer');
        var container = document.getElementById('container');
        var button = document.getElementById('toggleButton');
        var photoFrame = document.getElementById('photoFrame');
        var gameFrame = document.getElementById('gameFrame');

        if (gameContainer.classList.contains('hidden')) {
            gameContainer.classList.remove('hidden');
            gameContainer.classList.add('h-screen');
            container.classList.add('max-w-full', 'h-screen');
            button.textContent = 'Quit Game';
            button.classList.remove('bg-blue-500', 'hover:bg-blue-700');
            button.classList.add('bg-red-500', 'hover:bg-red-700');
            photoFrame.classList.add('hidden');
        } else {
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Do you really want to exit?',
                iconHtml: '<img src="../images/BidaSari.jpg" class="h-16 w-16 rounded-full border-4 border-gray-300">',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    gameContainer.classList.add('hidden');
                    gameContainer.classList.remove('h-screen');
                    container.classList.remove('max-w-full', 'h-screen');
                    button.textContent = 'Start';
                    button.classList.remove('bg-red-500', 'hover:bg-red-700');
                    button.classList.add('bg-blue-500', 'hover:bg-blue-700');
                    photoFrame.classList.remove('hidden');
                    // Reset the game by reloading the iframe
                    gameFrame.src = gameFrame.src;
                }
            });
        }
    });
</script>

</body>
</html>
