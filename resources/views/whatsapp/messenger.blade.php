@extends('layouts.app_whatsapp')

@section('content_chats')
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
document.addEventListener("DOMContentLoaded", function () {
    const messageInput = document.getElementById('message-input');
    const conversationList = document.getElementById('conversation-list');
    const chatbox = document.getElementById('chatbox');
    const chatTitle = document.getElementById('chat-title');
    const currentConversationPhone = document.getElementById('current-conversation-phone');

    let currentChatId = null;
    let clientPhone = null;
    let conversations = [];

    // ✅ Cargar conversaciones al inicio
    function loadConversations() {
        $.ajax({
            url: '/api/v1/chat',
            method: 'GET',
            success: function(response) {
                conversations = response.data;
                renderConversations();
            },
            error: function(error) {
                console.error("Error al cargar las conversaciones:", error);
            }
        });
    }

    // ✅ Renderizar conversaciones en la lista
    function renderConversations() {
        conversationList.innerHTML = '';

        conversations.forEach(conversation => {
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
                        <p class="time">${new Date(conversation.updated_at).toLocaleTimeString()}</p>
                    </div>
                    <div class="listHead">
                        <h6>${conversation.client_phone}</h6>
                    </div>
                    <div class="message_p">
                        <p>Último mensaje...</p>
                    </div>
                </div>
            `;

            chatItem.addEventListener('click', function () {
                setConversation(conversation.id, conversation.client_phone);
            });

            conversationList.appendChild(chatItem);
        });
    }

    // ✅ Cambiar de chat al hacer clic en un chat de la lista
    function setConversation(chatId, phone) {
        if (!chatId || !phone) return;

        currentChatId = chatId;
        clientPhone = phone;

        chatTitle.textContent = clientPhone;
        currentConversationPhone.textContent = clientPhone;

        console.log("Chat actualizado:", currentChatId, clientPhone);
        loadMessages(currentChatId);
    }

    // ✅ Cargar mensajes de la conversación activa
    function loadMessages(chatId) {
        if (!chatId) return;

        $.ajax({
            url: `/api/v1/message/${chatId}`,
            method: 'GET',
            success: function(response) {
                renderMessages(response.data);
            },
            error: function(error) {
                console.error("Error al cargar los mensajes:", error);
            }
        });
    }

    // ✅ Renderizar mensajes en el chatbox
    function renderMessages(messages) {
        chatbox.innerHTML = ''; // 🧹 Limpia el chat antes de cargar nuevos mensajes

        messages.forEach(message => {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', message.direction === 'toApp' ? 'friend_msg' : 'my_msg');
            messageDiv.innerHTML = `<p>${message.body} <br><span>${new Date(message.timestamp * 1000).toLocaleTimeString()}</span></p>`;
            chatbox.appendChild(messageDiv);
        });

        chatbox.scrollTop = chatbox.scrollHeight; // 🔽 Auto-scroll al último mensaje
    }

    // ✅ Enviar un nuevo mensaje
    window.sendMessage = function () {
        if (!currentChatId || !messageInput.value.trim()) {
            alert("Selecciona un chat y escribe un mensaje.");
            return;
        }

        const messageBody = messageInput.value.trim();
        console.log("Enviando mensaje a:", currentChatId, clientPhone);

        $.ajax({
            url: '/api/v1/message/send',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                waba_phone_id: currentChatId,
                to: clientPhone,
                message: {
                    type: 'text',
                    text: { body: messageBody }
                }
            }),
            success: function () {
                console.log("Mensaje enviado con éxito");
                messageInput.value = "";

                // ✅ Agregar el mensaje directamente a la UI
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message', 'my_msg');
                messageDiv.innerHTML = `<p>${messageBody} <br><span>${new Date().toLocaleTimeString()}</span></p>`;
                chatbox.appendChild(messageDiv);

                chatbox.scrollTop = chatbox.scrollHeight; // 🔽 Auto-scroll al último mensaje
            },
            error: function (error) {
                console.error("Error al enviar el mensaje:", error);
            }
        });
    };

    // ✅ Cargar conversaciones al cargar la página
    loadConversations();
});
</script>
