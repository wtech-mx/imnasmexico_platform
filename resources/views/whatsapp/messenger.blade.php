@extends('layouts.app_whatsapp')

@section('content_chats')

<!-- ✅ MOVER EL INPUT SEARCH AL INICIO PARA QUE EL SCRIPT LO ENCUENTRE -->
<input id="search" type="text" placeholder="Buscar Chat" class="input w-full" />

<div id="conversation-list">
    @foreach($conversations as $conversation)
        <div class="block unread chat-item" data-chat-id="{{ $conversation->id }}" data-client-phone="{{ $conversation->client_phone }}">
            <div class="imgBox">
                <img src="{{ asset('images/img2.jpg') }}" class="cover" alt="">
            </div>
            <div class="details">
                <div class="listHead">
                    <p class="time">{{ $conversation->updated_at->format('H:i') }}</p>
                </div>
                <div class="listHead">
                    <h6>{{ $conversation->client_phone }}</h6>
                </div>
                <div class="message_p">
                    <p>Último mensaje...</p>
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
        <ion-icon name="happy-outline"></ion-icon>
        <input id="message-input" type="text" placeholder="Escribe un mensaje...">
        <button onclick="sendMessage()">Enviar</button>
        <ion-icon name="mic"></ion-icon>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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

        if (!searchInput) {
            console.error("❌ Error: No se encontró el campo de búsqueda 'search'");
            return;
        }

        let conversations = [];
        let currentConversation = { id: 0 };
        let messages = [];

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
        const lastMessage = conversation.messages.length > 0 ? conversation.messages[0].content : "No hay mensajes aún";
        const lastMessageTime = conversation.messages.length > 0
            ? new Date(conversation.messages[0].timestamp * 1000).toLocaleTimeString()
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

            try {
                const response = await fetch('/api/v1/message?chat_id=' + currentConversation.id);
                const data = await response.json();
                messages = data.data;
                renderMessages();
            } catch (error) {
                console.error("❌ Error al cargar los mensajes:", error);
            }
        }

        // ✅ Renderizar los mensajes en la vista
        function renderMessages() {
            if (!chatbox) {
                console.error("❌ Error: No se encontró el contenedor de mensajes 'chatbox'");
                return;
            }

            chatbox.innerHTML = '';

            messages.forEach(message => {
                const div = document.createElement('div');
                div.classList.add('message', message.direction === 'toApp' ? 'friend_msg' : 'my_msg');
                div.innerHTML = `<p>${message.content} <br><span>${new Date(message.timestamp * 1000).toLocaleTimeString()}</span></p>`;
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

// ✅ Asegurar que `sendMessage` esté en el ámbito global
window.sendMessage = sendMessage;


        // ✅ Cargar conversaciones al cargar la página
        loadConversations();
    });
</script>
