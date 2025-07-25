@extends('layouts.admin.admin')
@section('title','  کارمندان  ')
@section('pageTitle','   مجور های مدیر ')
@section('content')
    @include('admin.admins.index',[
         'active' =>'permissions'
 ])
    <div id="kt_content_container" class="container-xxl">
        <div class="card" data-select2-id="select2-data-131-rhmf">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">   لیست مجوز ها </span>
        </h3>
    </div>
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="row">
            <br/>
            <br/>
            <div class="col-md-12">
                <br/>
                @foreach ($permissions as $permission )
                    <span class="badge badge-light-success">{{ $permission->persian_name }}</span>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
    </div>
@endsection


