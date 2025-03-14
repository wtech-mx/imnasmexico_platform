<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bubble</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="chat-header">
            <span id="sended-by"></span>
            <time class="text-xs opacity-50" id="timestamp"></time>
        </div>
        <div id="chat-bubble" class="chat-bubble">
            <div class="indicator w-11/12">
                <span id="reaction" class="indicator-item indicator-start badge badge-secondary indicator-bottom" style="bottom: -10px;"></span>
                <span id="text-content"></span>
                <span id="image-content">
                    <img id="image-url" alt="" class="w-1/6" />
                </span>
                <span id="sticker-content">
                    <img id="sticker-url" alt="" class="w-1/6" />
                </span>
                <span id="video-content">
                    <video id="video-url" alt="" class="w-2/6" controls></video>
                </span>
                <span id="audio-content">
                    <audio id="audio-url" alt="" controls></audio>
                </span>
                <span id="document-content">
                    <button class="btn btn-primary">
                        <a id="document-url" download>Descargar Archivo</a>
                    </button>
                </span>
                <span id="contacts-content">
                    <ul id="contacts-list"></ul>
                </span>
                <span id="template-content"></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const message = {
        sended_by: 'User',
        timestamp: 1633024800,
        direction: 'toApp',
        reaction: '👍',
        type: 'text',
        content: 'Hello, this is a text message!'
    };

    document.getElementById('sended-by').textContent = message.sended_by ? `Enviado por: ${message.sended_by}` : '';
    document.getElementById('timestamp').textContent = new Date(message.timestamp * 1000).toLocaleString('es-MX');

    if (message.direction !== 'toApp') {
        document.getElementById('chat-bubble').classList.add('chat-bubble-primary');
    }

    if (message.reaction) {
        document.getElementById('reaction').textContent = message.reaction;
    }

    if (message.type === 'text') {
        document.getElementById('text-content').textContent = message.content;
    } else if (message.type === 'image') {
        document.getElementById('image-content').style.display = 'block';
        document.getElementById('image-url').src = message.content.url;
    } else if (message.type === 'sticker') {
        document.getElementById('sticker-content').style.display = 'block';
        document.getElementById('sticker-url').src = message.content.url;
    } else if (message.type === 'video') {
        document.getElementById('video-content').style.display = 'block';
        document.getElementById('video-url').src = message.content.url;
    } else if (message.type === 'audio') {
        document.getElementById('audio-content').style.display = 'block';
        document.getElementById('audio-url').src = message.content.url;
    } else if (message.type === 'document') {
        document.getElementById('document-content').style.display = 'block';
        document.getElementById('document-url').href = message.content.url;
    } else if (message.type === 'contacts') {
        const contactsList = document.getElementById('contacts-list');
        message.content.forEach(contact => {
            const li = document.createElement('li');
            li.textContent = `Nombre: ${contact.name.first_name}`;
            contactsList.appendChild(li);

            const phones = document.createElement('li');
            phones.textContent = 'Telefonos: ';
            contact.phones.forEach(phone => {
                const span = document.createElement('span');
                span.textContent = phone.phone;
                phones.appendChild(span);
            });
            contactsList.appendChild(phones);
        });
    } else if (message.type === 'template') {
        document.getElementById('template-content').innerHTML = `
            <strong>${message.content.HEADER?.text}</strong>
            <p>${message.content.BODY?.text}</p>
            <small>${message.content.FOOTER?.text}</small>
        `;
    }
});
    </script>
</body>
</html>
