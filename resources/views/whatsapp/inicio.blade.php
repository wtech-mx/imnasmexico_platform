@extends('layouts.app_whatsapp')

@section('content_chats')

<div class="block unread active">
    <div class="imgBox">
        <img src="images/img2.jpg" class="cover" alt="">
    </div>

    <div class="details">
        <div class="listHead">
            <h3>Andre</h3>
            <p class="time">12:34</p>
        </div>
        <div class="listHead">
            <h6>5529291972</h6>
        </div>
        <div class="message_p">
            <p>I love your youtube videos!</p>
            <b>1</b>
        </div>
    </div>

</div>

@endsection

@section('content_messages')

<div class="header">
    <div class="imgText">
        <div class="userimg">
            <img src="images/img1.jpg" alt="" class="cover">
        </div>
        <h4>Qazi <br><span>online</span></h4>
    </div>
    <ul class="nav_icons">
        <li><ion-icon name="search-outline"></ion-icon></li>
        <li><ion-icon name="ellipsis-vertical"></ion-icon></li>
    </ul>
</div>

<!-- CHAT-BOX -->
<div class="chatbox">
    <div class="message my_msg">
        <p>Hi <br><span>12:18</span></p>
    </div>

    {{-- <div class="message friend_msg">
        <p>Hey <br><span>12:18</span></p>
    </div> --}}

</div>

@endsection



