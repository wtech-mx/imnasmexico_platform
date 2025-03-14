<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Media Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <input type="file" id="media-to-send" hidden/>

        <details id="dropdown" class="dropdown dropdown-top" style="width: 70px;">
            <summary class="mr-1 btn">
                <div class="flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 01-2.828 0l-2.828-2.828a4 4 0 015.656-5.656l1.414 1.414a2 2 0 002.828 0l1.414-1.414a4 4 0 015.656 5.656l-2.828 2.828a2 2 0 01-2.828 0L15.172 7z" />
                    </svg>
                </div>
            </summary>

            <ul class="dropdown-content z-[1] menu p-2 shadow bg-base-200 w-56 rounded-box">
                <li class="menu-title">Enviar multimedia</li>
                <li>
                    <a onclick="selectMedia('document')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Documento
                    </a>
                </li>
                <li>
                    <a onclick="selectMedia('image')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Imagen
                    </a>
                </li>
                <li>
                    <a onclick="selectMedia('video')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Video
                    </a>
                </li>
                <li>
                    <a onclick="selectMedia('audio')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Audio
                    </a>
                </li>
            </ul>
        </details>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let file = null;
        let type = '';

        function uploadFile(event) {
            file = event.target.files[0];
            // Emitir evento para enviar el archivo
            document.getElementById('dropdown').open = false;
        }

        function selectMedia(typeDoc) {
            type = typeDoc;
            const input = document.getElementById('media-to-send');
            input.click();
        }

        document.getElementById('media-to-send').addEventListener('change', uploadFile);
    </script>
</body>
</html>
