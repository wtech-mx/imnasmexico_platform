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
        <a id="emoji-button">😁</a>
        {{-- <ion-icon id="emoji-button" name="happy-outline"></ion-icon> --}}
        @include('whatsapp.components.emojis')
        <input id="message-input" type="text" placeholder="Escribe un mensaje...">
        <button onclick="sendMessage()">Enviar</button>
        <ion-icon name="mic"></ion-icon>
    </div>

@endsection

@section('js')

<script>
    // ✅ Asegurar que el código se ejecute después de que el DOM esté listo
    document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ Script cargado correctamente.");

    // 📌 Variables Globales
    const messageInput = document.getElementById('message-input');
    const searchInput = document.getElementById('search');
    const conversationList = document.getElementById('conversation-list');
    const chatbox = document.getElementById('chatbox');
    const chatTitle = document.getElementById('chat-title');
    const currentConversationPhone = document.getElementById('current-conversation-phone');

    // 📌 Variables para el Emoji Picker
    const emojiButton = document.getElementById('emoji-button');
    const emojiDropdown = document.getElementById('emoji-dropdown');

    let conversations = [];
    let currentConversation = { id: 0 };
    let messages = [];

    if (!searchInput) {
        console.error("❌ Error: No se encontró el campo de búsqueda 'search'");
        return;
    }

    // ✅ Cargar conversaciones desde API
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
            const messagesArray = Array.isArray(conversation.messages) ? conversation.messages : [];
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

    // ✅ Auto-Actualizar el chat cada 5 segundos
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

    // Verificar si el usuario está en la parte inferior del chat
    const isAtBottom = chatbox.scrollHeight - chatbox.scrollTop === chatbox.clientHeight;

    chatbox.innerHTML = '';

    let lastMessageDate = null;

    messages.forEach(message => {
        let messageText = message.body;

        try {
            const parsedMessage = JSON.parse(message.body);
            if (parsedMessage.text && parsedMessage.text.body) {
                messageText = parsedMessage.text.body;
            }
        } catch (error) {
            console.warn("⚠️ No se pudo parsear el JSON del mensaje, usando el valor original.");
        }

        const messageDate = new Date(message.timestamp * 1000);
        const messageDateString = messageDate.toLocaleDateString('es-MX', { year: 'numeric', month: 'long', day: 'numeric' });

        if (lastMessageDate !== messageDateString) {
            const dateSeparator = document.createElement('div');
            dateSeparator.classList.add('date-separator');
            dateSeparator.innerHTML = `
                <div>
                    ${messageDateString}
                </div>
            `;
            chatbox.appendChild(dateSeparator);
            lastMessageDate = messageDateString;
        }

        const div = document.createElement('div');
        div.classList.add('message', message.direction === 'toApp' ? 'friend_msg' : 'my_msg');
        div.innerHTML = `<p>${messageText} <br><span>${messageDate.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit', hour12: true })}</span></p>`;
        chatbox.appendChild(div);
    });

    // Solo desplazarse hacia abajo si el usuario ya estaba en la parte inferior del chat
    if (isAtBottom) {
        chatbox.scrollTop = chatbox.scrollHeight;
    }
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

    // ✅ Emoji Picker (Dropdown de emojis)
    emojiButton.addEventListener('click', function () {
        emojiDropdown.classList.toggle('show');
    });

    document.querySelectorAll('.emoji').forEach(emoji => {
        emoji.addEventListener('click', function () {
            messageInput.value += this.textContent;
            emojiDropdown.classList.remove('show');
        });
    });

    // ✅ Cerrar el dropdown si se hace clic fuera de él
    document.addEventListener('click', function (event) {
        if (!emojiButton.contains(event.target) && !emojiDropdown.contains(event.target)) {
            emojiDropdown.classList.remove('show');
        }
    });

    // ✅ Asegurar que `sendMessage` esté en el ámbito global
    window.sendMessage = sendMessage;

    // ✅ Cargar conversaciones al cargar la página
    loadConversations();
});
</script>

@endsection
