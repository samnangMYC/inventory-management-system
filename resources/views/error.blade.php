<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> <!-- Link to Tailwind CSS -->
    <style>
        /* Optional: Add custom styles for dark mode */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a202c; /* Dark background */
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <iframe src="https://giphy.com/embed/tR1ZZeJXR9RUDvaFVP" width="480" height="394" style="" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/stickers/japan-sticker-neko-meme-mi-mu-tR1ZZeJXR9RUDvaFVP">via GIPHY</a></p>
        <h1 class="text-6xl font-bold text-gray-800 dark:text-gray-200 mb-4">404 Not Found</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">The page you are looking for does not exist.</p>
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline dark:text-blue-300 text-lg">Go to Home</a>
    </div>
</body>
</html>