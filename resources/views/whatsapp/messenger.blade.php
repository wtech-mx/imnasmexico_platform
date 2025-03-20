@extends('layouts.app_whatsapp')

@section('content_chats')

<!-- ✅ MOVER EL INPUT SEARCH AL INICIO PARA QUE EL SCRIPT LO ENCUENTRE -->
<input id="search" type="text" placeholder="Buscar Chat" class="input w-full" />

<div id="conversation-list">
    @foreach($conversations as $conversation)
        @php
            $lastMessage = $conversation->messages->first();
            $lastMessageText = $lastMessage ? $lastMessage->content : "No hay mensajes aún";
            $lastMessageTime = $lastMessage ? \Carbon\Carbon::createFromTimestamp($lastMessage->timestamp)->format('h:i a') : "";
            $profileImageUrl = "https://api.whatsapp.com/send?phone={$conversation->client_phone}&text=Hola"; // Reemplaza con la URL real de la imagen de perfil
        @endphp
        <div class="block unread chat-item" data-chat-id="{{ $conversation->id }}" data-client-phone="{{ $conversation->client_phone }}">
            <div class="imgBox">
                <img src="{{ $profileImageUrl }}" class="cover" alt="">
            </div>
            <div class="details">
                <div class="listHead">
                    <p class="time">{{ $lastMessageTime }}</p>
                </div>
                <div class="listHead">
                    <h6>{{ $conversation->client_phone }}</h6>
                </div>
                <div class="message_p">
                    <p>{{ $lastMessageText }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection

@section('content_messages')
    <div class="header">
        <div class="imgText">
            <div class="userimg">
                <img src="{{ asset('images/img1.jpg') }}" alt="" class="cover">
            </div>
            <h4 id="chat-title">Selecciona un chat</h4>
        </div>
    </div>

    <!-- ✅ Nuevo div para mostrar el número del chat actual -->
    <div class="bg-base-200 p-4" id="current-conversation-phone"></div>

    <div class="chatbox" id="chatbox"></div>

    <!-- CHAT INPUT -->
    <div class="chat_input">
        <ion-icon id="emoji-button" name="happy-outline"></ion-icon>
        <input id="message-input" type="text" placeholder="Escribe un mensaje...">
        <button onclick="sendMessage()">Enviar</button>
        <ion-icon name="mic"></ion-icon>
    </div>

@endsection

@section(section: 'js')

<script>
    // ✅ Asegurar que el código se ejecute después de que el DOM esté listo
    document.addEventListener("DOMContentLoaded", function () {
        console.log("✅ DOM completamente cargado.");

        // ✅ Seleccionamos los elementos del DOM
        const messageInput = document.getElementById('message-input');
        const searchInput = document.getElementById('search');
        const conversationList = document.getElementById('conversation-list');
        const chatbox = document.getElementById('chatbox');
        const chatTitle = document.getElementById('chat-title');
        const currentConversationPhone = document.getElementById('current-conversation-phone');
        const emojiButton = document.getElementById('emoji-button');

        if (!searchInput) {
            console.error("❌ Error: No se encontró el campo de búsqueda 'search'");
            return;
        }

        let conversations = [];
        let currentConversation = { id: 0 };
        let messages = [];

        // ✅ Configurar el selector de emojis
        const picker = new EmojiButton();
        picker.on('emoji', emoji => {
            messageInput.value += emoji;
        });

        emojiButton.addEventListener('click', () => {
            picker.togglePicker(emojiButton);
        });

        // ✅ Cargar conversaciones
        async function loadConversations() {
            try {
                const response = await fetch('/api/v1/chat?client_phone=' + searchInput.value);
                const data = await response.json();
                conversations = data.data;
                renderConversations();

                if (currentConversation.id === 0 && conversations.length > 0) {
                    currentConversation = conversations[0];
                    loadMessagesFromConversation();
                }
            } catch (error) {
                console.error("❌ Error al cargar conversaciones:", error);
            }
        }

        // ✅ Renderizar la lista de conversaciones
        function renderConversations() {
            if (!conversationList) {
                console.error("❌ Error: No se encontró el contenedor de conversaciones 'conversation-list'");
                return;
            }

            conversationList.innerHTML = '';

            conversations.forEach(conversation => {
                // ✅ Asegurar que messages existe y es un array
                const messagesArray = Array.isArray(conversation.messages) ? conversation.messages : [];

                // ✅ Obtener el último mensaje si existe
                const lastMessage = messagesArray.length > 0 ? messagesArray[0].content : "No hay mensajes aún";
                const lastMessageTime = messagesArray.length > 0
                    ? new Date(messagesArray[0].timestamp * 1000).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true })
                    : "";

                const chatItem = document.createElement('div');
                chatItem.classList.add('block', 'unread', 'chat-item');
                chatItem.dataset.chatId = conversation.id;
                chatItem.dataset.clientPhone = conversation.client_phone;

                chatItem.innerHTML = `
                    <div class="imgBox">
                        <img src="{{ asset('images/img2.jpg') }}" class="cover" alt="">
                    </div>
                    <div class="details">
                        <div class="listHead">
                            <p class="time">${lastMessageTime}</p>
                        </div>
                        <div class="listHead">
                            <h6>${conversation.client_phone}</h6>
                        </div>
                        <div class="message_p">
                            <p>${lastMessage}</p>
                        </div>
                    </div>
                `;

                chatItem.addEventListener('click', function () {
                    setConversation(conversation);
                });

                conversationList.appendChild(chatItem);
            });
        }

        // ✅ Seleccionar conversación y cargar mensajes
        function setConversation(conversation) {
            if (!conversation) {
                console.error("❌ Error: conversación inválida.");
                return;
            }

            currentConversation = conversation;

            if (currentConversationPhone) currentConversationPhone.textContent = conversation.client_phone;
            if (chatTitle) chatTitle.textContent = conversation.client_phone;

            console.log("📩 Chat seleccionado:", currentConversation.id, currentConversation.client_phone);
            loadMessagesFromConversation();
        }

        // ✅ Cargar mensajes de la conversación actual
        async function loadMessagesFromConversation() {
            if (!currentConversation.id) {
                console.error("❌ Error: No hay conversación seleccionada.");
                return;
            }

            fetch(`/api/v1/message/${currentConversation.id}`)
                .then(response => response.json())
                .then(data => {
                    messages = data.data;
                    renderMessages();
                })
                .catch(error => console.error("❌ Error al cargar los mensajes:", error));
        }

        // ✅ Actualizar el chat cada 5 segundos para recibir mensajes nuevos
        setInterval(() => {
            if (currentConversation.id !== 0) {
                loadMessagesFromConversation();
            }
        }, 5000);

        // ✅ Renderizar los mensajes en la vista
        function renderMessages() {
            if (!chatbox) {
                console.error("❌ Error: No se encontró el contenedor de mensajes 'chatbox'");
                return;
            }

            chatbox.innerHTML = '';

            messages.forEach(message => {
                let messageText = message.body;

                try {
                    // 📌 Intentar parsear el JSON si es un objeto válido
                    const parsedMessage = JSON.parse(message.body);
                    if (parsedMessage.text && parsedMessage.text.body) {
                        messageText = parsedMessage.text.body; // Extraer el contenido del mensaje
                    }
                } catch (error) {
                    console.warn("⚠️ No se pudo parsear el JSON del mensaje, usando el valor original.");
                }

                // 📌 Determinar el estado del mensaje
                let statusIcon = '';
                if (message.status === 'sent') {
                    statusIcon = '✔️'; // Una palomita gris
                } else if (message.status === 'delivered') {
                    statusIcon = '✔️✔️'; // Dos palomitas grises
                } else if (message.status === 'read') {
                    statusIcon = '✔️✔️'; // Dos palomitas azules
                }

                const div = document.createElement('div');
                div.classList.add('message', message.direction === 'toApp' ? 'friend_msg' : 'my_msg');
                div.innerHTML = `<p>${messageText} <br><span>${new Date(message.timestamp * 1000).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true })} ${statusIcon}</span></p>`;
                chatbox.appendChild(div);
            });

            chatbox.scrollTop = chatbox.scrollHeight; // Auto-scroll al último mensaje
        }

        // ✅ Enviar mensaje
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

        // ✅ Enviar mensaje al presionar Enter
        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // ✅ Asegurar que `sendMessage` esté en el ámbito global
        window.sendMessage = sendMessage;

        // ✅ Cargar conversaciones al cargar la página
        loadConversations();
    });
</script>

@endsection
