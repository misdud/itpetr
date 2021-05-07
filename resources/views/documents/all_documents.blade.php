@extends('layouts.app_pages', ['activePage' => 'docs', 'title' => 'Документы', 'navName' => 'Документы', 'activeButton' => 'docs'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
                <div class="btn-group card-body" role="group" aria-label="Basic example">

                    {{-- insert lins for documents  --}}
                    @include('documents.links_documents', ['doc'=>'col_doc'])
                </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">КОЛЛЕКТИВНЫЙ ДОГОВОР 2021-2024</h4>
                        <p class="card-category">Добавлено: 01.05.2021г.</p>
                    </div>
                    <div class="card-body">
                    <object data="{{ asset('light-bootstrap/pdf/documents/col_doc_2021_2024.pdf') }}" type="application/pdf"
                      width="100%" height="800"></object>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection