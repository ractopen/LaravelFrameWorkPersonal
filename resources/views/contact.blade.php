@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="card text-center">
        <h1 class="mb-4" style="color: var(--primary);">About the Developer</h1>
        
        <div style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Royette Andrei C. Telar</h2>
            <p style="color: var(--text-light); font-weight: 500;">CS21A | 2nd Year BSCS</p>
        </div>

        <div class="grid" style="gap: 1rem; margin-bottom: 2rem;">
            <div style="padding: 1rem; border: 1px solid var(--border); background: var(--surface);">
                <h3 style="font-size: 1rem; color: var(--primary);">Team Lead</h3>
                <p>Royette Andrei C. Telar</p>
            </div>
            <div style="padding: 1rem; border: 1px solid var(--border); background: var(--surface);">
                <h3 style="font-size: 1rem; color: var(--primary);">IO Tester</h3>
                <p>Royette Andrei C. Telar</p>
            </div>
            <div style="padding: 1rem; border: 1px solid var(--border); background: var(--surface);">
                <h3 style="font-size: 1rem; color: var(--primary);">UI/UX Designer</h3>
                <p>Royette Andrei C. Telar</p>
            </div>
            <div style="padding: 1rem; border: 1px solid var(--border); background: var(--surface);">
                <h3 style="font-size: 1rem; color: var(--primary);">Database Admin</h3>
                <p>Royette Andrei C. Telar</p>
            </div>
        </div>

        <div style="margin-top: 3rem; padding: 2rem; background: var(--surface); border-radius: 0.5rem; font-style: italic;">
            <h3 class="mb-4">A Message from the Developer</h3>
            <p>"This project was built with dedication for the Object Oriented Programming (OOP) Finals. It represents the culmination of hard work, sleepless nights, and a passion for coding. To my classmates and professors, thank you for the support and knowledge shared throughout this journey."</p>
        </div>
    </div>
</div>
@endsection
