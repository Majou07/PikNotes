@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
/* ===== HEADER ===== */
.profile-header {
    background:#cf635c;
    height:180px;
    border-radius:16px;
    position:relative;
}

/* ===== AVATAR ===== */
.profile-avatar {
    position:absolute;
    bottom:-60px;
    left:40px;
    width:120px;
    height:120px;
    border-radius:50%;
    background:#ffffff;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    box-shadow:0 8px 18px rgba(0,0,0,.15);
}

.profile-avatar img {
    width:100%;
    height:100%;
    object-fit:cover;
}

/* ===== BODY ===== */
.profile-body {
    margin-top:80px;
    padding:30px;
}

.profile-name {
    font-size:26px;
    font-weight:700;
}

.profile-meta {
    color:#777;
    font-size:14px;
}

/* ===== NOTE CARD ===== */
.note-card {
    background:#f3f3f3;
    border-radius:14px;
    padding:18px;
    height:100%;
}

/* ===== CHART CARD ===== */
.chart-card {
    background:#ffffff;
    border-radius:16px;
    padding:20px;
    border:2px solid #1e90ff;
}

/* ===== TABS ===== */
.period-tabs button {
    border:none;
    background:#e9e9e9;
    padding:6px 18px;
    border-radius:20px;
    font-weight:600;
}

.period-tabs .active {
    background:#ffffff;
    border:2px solid #1e90ff;
}
</style>

<div class="container mt-4">

    {{-- HEADER --}}
    <div class="profile-header mb-5">
        <div class="profile-avatar">
            <img src="{{ asset('images/cama.jpg') }}" alt="Avatar">
        </div>
    </div>

    {{-- BODY --}}
    <div class="profile-body">

        <div class="mb-4 ml-3">
            <div class="profile-name">Chris Bumstead</div>
            <div class="profile-meta">Se unió el 05 de diciembre del 2025</div>
        </div>

        <div class="row">

            {{-- NOTE --}}
            <div class="col-md-4 mb-4">
                <div class="note-card">
                    <strong>Hola,</strong>
                    <p class="mt-2 mb-0">
                        Aquí voy a realizar mi organización para mejorar mis notas.
                    </p>
                    <div class="mt-3">• Dani</div>
                </div>
            </div>

            {{-- CHART --}}
            <div class="col-md-8">
                <div class="chart-card">

                    <div class="d-flex justify-content-center mb-3 period-tabs">
                        <button class="active mr-2">Semana</button>
                        <button class="mx-2">Mes</button>
                        <button class="ml-2">Año</button>
                    </div>

                    <canvas id="studyChart" height="120"></canvas>
                    <p class="text-center mt-2 text-muted">Horas de estudio</p>

                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('studyChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Lun','Mar','Miér','Jue','Vie','Sáb','Dom'],
        datasets: [{
            data: [3,6,4,8,2,6,6],
            backgroundColor: '#1e90ff',
            borderRadius: 8
        }]
    },
    options: {
        plugins: { legend: { display:false }},
        scales: {
            y: { beginAtZero:true }
        }
    }
});
</script>

@endsection
