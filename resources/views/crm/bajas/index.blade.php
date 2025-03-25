@extends('crm.layouts.app')

@section('titulo', 'Presupuestos')

@section('css')
<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

@endsection

@section('content')

    <div class="page-heading card" style="box-shadow: none !important" >
        {{-- Titulos --}}
        <div class="page-title card-body">
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-4 order-md-1 order-last">
                    <h3><i class="bi bi-file-earmark-ruled"></i> Bajas</h3>
                    <p class="text-subtitle text-muted">Listado de bajas</p>
                </div>
                <div class="col-sm-12 col-md-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Presupuestos</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>

        <section class="section pt-4">
            <div class="card">

                <div class="card-body">
                
                        @livewire('bajas-table')
                </div>
            </div>

        </section>

    </div>
@endsection

@section('scripts')


    @include('crm.partials.toast')

@endsection

