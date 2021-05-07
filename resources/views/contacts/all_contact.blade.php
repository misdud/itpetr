@extends('layouts.app_pages', ['activePage' => 'contacts', 'title' => 'Контакты', 'navName' => 'Контакты', 'activeButton' => 'contacts'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for contacts  --}}
                    @include('contacts.links_contacts', ['contact'=>'all_contact_pdf'])
                </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Все телефоны</h4>
                        <p class="card-category">Добавлено: 01.05.2021г.</p>
                    </div>
                    <div class="card-body">
                    <object data="{{ asset('light-bootstrap/pdf/contacts/telefons_PGOK_03_05_21.pdf') }}" type="application/pdf"
                      width="100%" height="800"></object>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection