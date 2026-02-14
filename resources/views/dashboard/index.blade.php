@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 style="text-align:center; margin-bottom:40px;">
        Dashboard Badan Sosial Kematian
    </h1>

    <div class="menu-grid">

        <a href="{{ route('keluarga.index') }}" class="menu-card">
            <span class="menu-icon">👨‍👩‍👧‍👦</span>
            Data Keluarga
        </a>

        <a href="{{ route('saldo.index') }}" class="menu-card">
            <span class="menu-icon">💰</span>
            Saldo Kas
        </a>
        
        <a href="{{ route('iuran.index') }}" class="menu-card">
            <span class="menu-icon">📝</span>
            Data Kutipan
        </a>
        
        <a href="{{ route('inventaris.index') }}" class="menu-card">
            <span class="menu-icon">📦</span>
            Inventaris
        </a>

        <a href="#" class="menu-card">
            <span class="menu-icon">📢</span>
            Pengumuman
        </a>

    </div>
@endsection
