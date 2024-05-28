@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Chefs</h1>
        </div>
        <div class="card">

            <div class="card-body">
                <div id="accordion">
                    <div class="accordion">
                        <div class="accordion-header collapsed bg-primary text-light p-3" role="button" data-toggle="collapse"
                            data-target="#panel-body-1" aria-expanded="true">
                            <h4>Chefs Section Titles...</h4>
                        </div>
                        <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                            <form action="{{ route('admin.chefs-title-update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Top Title</label>
                                    <input type="text" class="form-control" name="chef_top_title"
                                        value="{{ @$titles['chef_top_title'] }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Main Title</label>
                                    <input type="text" class="form-control" name="chef_main_title"
                                        value="{{ @$titles['chef_main_title'] }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Sub Title</label>
                                    <input type="text" class="form-control" name="chef_sub_title"
                                        value="{{ @$titles['chef_sub_title'] }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="section">


        <div class="card card-primary">
            <div class="card-header">
                <h4>All Chefs</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.chefs.create') }}" class="btn btn-primary">
                        Create New
                    </a>
                </div>
            </div>
            <div class="card-body">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush