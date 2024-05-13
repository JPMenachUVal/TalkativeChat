{{-- -------------------- Mensajes guardados -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Lado del avatar --}}
            <td>
            <div class="saved-messages avatar av-m">
                <span class="far fa-bookmark"></span>
            </div>
            </td>
            {{-- Lado central --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Mensajes guardados <span>Tú</span></p>
                <span>Guardar mensajes en secreto</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Lista de contactos -------------------- --}}
@if($get == 'users' && !!$lastMessage)
<?php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
?>
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Lado del avatar --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m"
        style="background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- Lado central --}}
        <td>
        <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
            <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">{{ $lastMessage->timeAgo }}</span></p>
        <span>
            {{-- Indicador de usuario del último mensaje --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">Tú :</span>'
                : ''
            !!}
            {{-- Cuerpo del último mensaje --}}
            @if($lastMessage->attachment == null)
            {!!
                $lastMessageBody
            !!}
            @else
            <span class="fas fa-file"></span> Archivo adjunto
            @endif
        </span>
        {{-- Contador de nuevos mensajes --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Elemento de búsqueda -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Lado del avatar --}}
        <td>
        <div class="avatar av-m"
        style="background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- Lado central --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Elemento de fotos compartidas -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif
