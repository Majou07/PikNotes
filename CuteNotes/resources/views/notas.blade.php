@extends('layouts.app')

@section('title', 'Notas y Quiz')

@section('content')
@if($showWelcome)
    <div class="notes-welcome text-center my-5">
        <img src="{{ asset('images/hand.png') }}" alt="Bienvenido" style="max-height:120px">

        <h3 class="mt-3">Tus notas</h3>

        <p class="mt-3 text-muted">
            Aquí puedes crear notas y quizzes para organizar
            mejor tu aprendizaje.
        </p>

        <button class="btn btn-outline-primary mt-3"
                data-toggle="modal"
                data-target="#noteModal">
            Comenzar
        </button>
    </div>
@endif

<style>
.btn { border-radius: 999px; font-weight: 600; }
.grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:20px; }
.card-item { background:#fff; border-radius:16px; padding:16px; box-shadow:0 4px 14px rgba(0,0,0,.06); cursor:pointer; }
.card-item:hover { transform:translateY(-4px); box-shadow:0 10px 24px rgba(0,0,0,.12); }
</style>

<h4 class="mb-4">Notas y Quizzes</h4>

<div class="mb-4">
    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#noteModal">
        + Nota
    </button>
    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#quizModal">
        + Quiz
    </button>
</div>

<div class="grid">

    @foreach($notes as $note)
        <div class="card-item">
            <strong>{{ $note->title }}</strong>
            <p class="text-muted small mt-2">
                {{ Str::limit($note->content, 80) }}
            </p>
        </div>
    @endforeach

    @foreach($quizzes as $quiz)
        <div class="card-item" onclick="openQuiz({{ $quiz->id }})">
            <strong>{{ $quiz->title }}</strong>
            <span class="badge badge-warning mt-2">QUIZ</span>
        </div>
    @endforeach

</div>

{{-- MODAL NOTA --}}
<div class="modal fade" id="noteModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form method="POST" action="{{ route('notes.store') }}" class="modal-content">
            @csrf
            <div class="modal-header"><h5>Nueva Nota</h5></div>
            <div class="modal-body">
                <input name="title" class="form-control mb-3" placeholder="Título" required>
                <textarea name="content" class="form-control" rows="8" placeholder="Contenido" required></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL QUIZ --}}
<div class="modal fade" id="quizModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form method="POST" action="{{ route('quiz.store') }}" class="modal-content">
            @csrf
            <div class="modal-header"><h5>Nuevo Quiz</h5></div>
            <div class="modal-body">
                <input name="title" class="form-control mb-2" placeholder="Título del quiz" required>
                <input name="question" class="form-control mb-2" placeholder="Pregunta" required>
                <input name="option_a" class="form-control mb-2" placeholder="Opción A" required>
                <input name="option_b" class="form-control mb-2" placeholder="Opción B" required>
                <input name="option_c" class="form-control mb-2" placeholder="Opción C" required>
                <input name="option_d" class="form-control mb-2" placeholder="Opción D" required>
                <select name="correct_option" class="form-control" required>
                    <option value="">Respuesta correcta</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Guardar Quiz</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL QUIZ PLAY --}}
<div class="modal fade" id="quizPlayModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 text-center">
            <h5 id="quizTitle"></h5>
            <p id="quizQuestion"></p>
            <div id="quizOptions"></div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
function openQuiz(id){
    fetch(`/quiz/${id}`)
        .then(r=>r.json())
        .then(data=>{
            quizTitle.innerText = data.quiz.title;
            quizQuestion.innerText = data.questions[0].question;
            quizOptions.innerHTML = `
                <div class="btn btn-outline-secondary m-1">${data.questions[0].option_a}</div>
                <div class="btn btn-outline-secondary m-1">${data.questions[0].option_b}</div>
                <div class="btn btn-outline-secondary m-1">${data.questions[0].option_c}</div>
                <div class="btn btn-outline-secondary m-1">${data.questions[0].option_d}</div>
            `;
            $('#quizPlayModal').modal('show');
        });
}
</script>
@endpush
