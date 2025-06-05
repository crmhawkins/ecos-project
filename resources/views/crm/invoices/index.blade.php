@extends('crm.layouts.app')

@section('titulo', 'Facturas')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">

@endsection

@section('content')

    <div class="page-heading card" style="box-shadow: none !important" >

        {{-- Titulos --}}
        <div class="page-title card-body">
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-4 order-md-1 order-last">
                    <h3><i class="bi bi-file-earmark-ruled"></i> Facturas</h3>
                    <p class="text-subtitle text-muted">Listado de facturas</p>
                    {{-- {{$budgets->count()}} --}}
                </div>
                <div class="col-sm-12 col-md-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Facturas</li>
                        </ol>
                    </nav>

                </div>
            </div>
            {{-- <div class="row mt-3">
                <div class="col-12 col-md-4 order-md-1 order-last">
                    @if($budgets->count() >= 0)
                        <a href="{{route('presupuesto.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus me-2 mx-auto"></i>  Crear presupuesto</a>
                    @endif
                </div>
            </div> --}}
        </div>

        <section class="section pt-4">
            <div class="card">

                <div class="card-body">

                        @livewire('invoices-table')
                </div>
            </div>

        </section>

    </div>
@endsection

@section('scripts')


    @include('crm.partials.toast')

@endsection

