<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="flex min-h-full h-full" style="height: 800px;">
            <div class="w-1/3 bg-base-200 overflow-auto h-full">
                <div class="p-2 flex">
                    <input id="search" type="text" placeholder="Buscar Chat" class="input w-full" />
                    <button class="btn btn-primary" onclick="showNewMessageModal()">Nuevo</button>
                </div>
                <ul id="conversation-list" class="menu w-full p-0 overflow-auto"></ul>
            </div>
            <div class="w-2/3">
                <div class="bg-base-200 p-4" id="current-conversation-phone"></div>
                <div class="chat chat-start"></div>
                <div class="chat chat-end"></div>
                <div class="w-full overflow-auto h-full" id="message-list"></div>
                <div class="w-full flex mt-3">
                    <button class="btn btn-primary" onclick="selectMedia()">Enviar Media</button>
                    <div class="w-5/6 mr-1">
                        <input id="message-input" type="text" placeholder="Escribe un mensaje" class="input border-1 border-gray-200 w-full" />
                    </div>
                    <div class="w-1/6">
                        <button class="btn btn-primary w-full" onclick="sendMessage()">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="file" id="media-input" hidden />

    @include('ajax.send-media-message')
    @include('ajax.chat-bubble')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const messageInput = document.getElementById('message-input');
        const searchInput = document.getElementById('search');
        const conversationList = document.getElementById('conversation-list');
        const messageList = document.getElementById('message-list');
        const currentConversationPhone = document.getElementById('current-conversation-phone');
        const mediaInput = document.getElementById('media-input');

        let conversations = [];
        let currentConversation = { id: 0 };
        let messages = [];

        async function loadConversations() {
            const response = await fetch('/api/v1/chat?client_phone=' + searchInput.value);
            const data = await response.json();
            conversations = data.data;
            renderConversations();

            if (currentConversation.id === 0 && conversations.length > 0) {
                currentConversation = conversations[0];
                loadMessagesFromConversation();
            }
        }

        function renderConversations() {
            conversationList.innerHTML = '';
            conversations.forEach(conversation => {
                const li = document.createElement('li');
                li.classList.add('list-group-item');
                li.textContent = conversation.client_phone;
                li.onclick = () => setConversation(conversation);
                conversationList.appendChild(li);
            });
        }

        function setConversation(conversation) {
            currentConversation = conversation;
            currentConversationPhone.textContent = conversation.client_phone;
            loadMessagesFromConversation();
        }

        async function loadMessagesFromConversation() {
            const response = await fetch('/api/v1/message?chat_id=' + currentConversation.id);
            const data = await response.json();
            messages = data.data;
            renderMessages();
        }

        function renderMessages() {
            messageList.innerHTML = '';
            messages.forEach(message => {
                const div = document.createElement('div');
                div.classList.add('chat-bubble');
                div.textContent = message.content;
                messageList.appendChild(div);
            });
        }

        function sendMessage() {
            fetch('/api/v1/message/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    waba_phone_id: currentConversation.waba_phone_id,
                    to: currentConversation.client_phone,
                    message: {
                        type: 'text',
                        text: {
                            preview_url: false,
                            body: messageInput.value
                        }
                    }
                })
            }).then(response => response.json())
                .then(data => {
                    messageInput.value = '';
                    loadMessagesFromConversation();
                });
        }

        function selectMedia() {
            mediaInput.click();
        }

        mediaInput.addEventListener('change', function() {
            const file = mediaInput.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('file', file);
                formData.append('waba_phone_id', currentConversation.waba_phone_id);
                formData.append('to', currentConversation.client_phone);

                fetch('/api/v1/message/send-media', {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                    .then(data => {
                        mediaInput.value = '';
                        loadMessagesFromConversation();
                    });
            }
        });

        function showNewMessageModal() {
            // Implementar lógica para mostrar modal de nuevo mensaje
        }

        loadConversations();
    </script>
</body>
</html>
