@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    /* =========================
       DATOS DEMO (SIMULADOS)
       ========================= */
    $user = (object)['name' => 'Daniel'];

    $notes = [
        ['title' => 'Estilo Arquitectónico', 'tag' => 'Integración', 'color' => '#D77B4A'],
        ['title' => 'Ecuaciones', 'tag' => 'Matemáticas', 'color' => '#8BB45C'],
    ];

    $flashcards = [
        ['title' => 'Seguridad - Parcial 2', 'progress' => 4, 'total' => 15, 'level' => 'Difícil', 'color' => '#E5533D'],
        ['title' => 'Matemáticas', 'progress' => 10, 'total' => 22, 'level' => 'Fácil', 'color' => '#6FCF5E'],
    ];
@endphp

<style>
/* ===== WELCOME ===== */
.welcome-box {
    max-width: 600px;
    margin: 60px auto;
    text-align: center;
}

.welcome-box img {
    max-height: 120px;
    margin-bottom: 20px;
}

/* ===== SECTIONS ===== */
.section-title {
    font-weight: 700;
    margin: 40px 0 20px;
}

/* ===== INTERACTIVE ===== */
.selectable {
    cursor: pointer;
    transition: all .25s ease;
}

.selectable:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0,0,0,.12);
}

/* ===== NOTES ===== */
.note-card {
    background: #fff;
    border-radius: 16px;
    padding: 16px;
    box-shadow: 0 4px 14px rgba(0,0,0,.06);
}

.note-color {
    height: 26px;
    border-radius: 8px;
    margin-bottom: 12px;
}

.note-tag {
    display: inline-block;
    background: #FFF176;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
}

/* ===== FLASHCARDS ===== */
.flashcard-card {
    background: #fff;
    border-radius: 16px;
    padding: 18px;
    box-shadow: 0 4px 14px rgba(0,0,0,.06);
}

.progress {
    height: 6px;
    border-radius: 4px;
}

/* ===== BUTTONS ===== */
.btn {
    border-radius: 999px; /* estilo pill */
    padding: 8px 18px;
    font-weight: 600;
}

.level {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    color: #fff;
}
</style>

{{-- ================= WELCOME ================= --}}
<div id="welcome">
    <div class="welcome-box">
        <img src="{{ asset('images/yellow.png') }}" alt="Welcome">
        <h3 class="mt-3">Tu inicio</h3>
        <p class="mt-3">
            Hola <strong>{{ $user->name }}</strong>, nos alegra que estés usando
            <strong>PikNotes</strong> para mejorar tu organización en cuanto a aprender.
        </p>
        <p class="text-muted">
            Por el momento no has creado unidades de tarjetas y notas,
            en cuanto lo hagas se mostrarán aquí.
        </p>

        <button class="btn btn-outline-primary mt-3" onclick="hideWelcome()">
            Comenzar
        </button>
    </div>
</div>

{{-- ================= DASHBOARD ================= --}}
<div id="dashboard" style="display:none;">

    {{-- MIS NOTAS --}}
    <h4 class="section-title">Mis notas</h4>

    <div class="row">
        @foreach($notes as $note)
            <div class="col-md-4 mb-4">
                <div class="note-card selectable"
                     onclick="openNoteModal('{{ $note['title'] }}','{{ $note['tag'] }}')">
                    <div class="note-color" style="background: {{ $note['color'] }}"></div>
                    <h6 class="mb-2">{{ $note['title'] }}</h6>
                    <span class="note-tag">{{ $note['tag'] }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- FLASHCARDS --}}
    <h4 class="section-title">Flashcards</h4>

    <div class="row">
        @foreach($flashcards as $card)
            <div class="col-md-4 mb-4">
                <div class="flashcard-card selectable"
                     onclick="openFlashcardModal('{{ $card['title'] }}')">
                    <h6>{{ $card['title'] }}</h6>

                    <div class="d-flex justify-content-between text-muted small mb-1">
                        <span>Proceso</span>
                        <span>{{ $card['progress'] }} / {{ $card['total'] }}</span>
                    </div>

                    <div class="progress mb-3">
                        <div class="progress-bar"
                             style="width: {{ ($card['progress'] / $card['total']) * 100 }}%;
                                    background: {{ $card['color'] }}">
                        </div>
                    </div>

                    <span class="level" style="background: {{ $card['color'] }}">
                        {{ $card['level'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

</div>

{{-- ================= MODAL NOTA ================= --}}
<div class="modal fade" id="noteModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="noteTitle"></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <span class="badge badge-warning" id="noteTag"></span>

                <textarea class="form-control mt-3" rows="10">
Aquí puedes escribir, editar y organizar tu nota.
(Interacción DEMO)
                </textarea>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Guardar</button>
                <button class="btn btn-outline-secondary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

{{-- ================= MODAL FLASHCARDS ================= --}}
<div class="modal fade" id="flashcardModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">

            <h5 class="mb-3" id="flashcardTitle"></h5>

            <div class="card shadow-sm p-4 mb-3">
                <h6 id="flashcardQuestion">¿Qué es MVC?</h6>
                <p id="flashcardAnswer" class="d-none mt-3 text-muted">
                    Modelo Vista Controlador
                </p>
            </div>

            <button class="btn btn-outline-primary mb-2"
                    onclick="toggleFlashcardAnswer()">
                Mostrar respuesta
            </button>

            <button class="btn btn-link" data-dismiss="modal">
                Cerrar
            </button>

        </div>
    </div>
</div>

@endsection

@push('js')
<script>
function hideWelcome() {
    document.getElementById('welcome').style.display = 'none';
    document.getElementById('dashboard').style.display = 'block';
}

function openNoteModal(title, tag) {
    document.getElementById('noteTitle').innerText = title;
    document.getElementById('noteTag').innerText = tag;
    $('#noteModal').modal('show');
}

function openFlashcardModal(title) {
    document.getElementById('flashcardTitle').innerText = title;
    document.getElementById('flashcardAnswer').classList.add('d-none');
    $('#flashcardModal').modal('show');
}

function toggleFlashcardAnswer() {
    document.getElementById('flashcardAnswer').classList.toggle('d-none');
}

// Auto ocultar welcome (opcional)
setTimeout(hideWelcome, 5000);
</script>
@endpush
