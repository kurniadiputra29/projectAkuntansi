@extends('layouts.app')

@section('title', 'AccountMin - Company Profile')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>Profile</h5>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="http://localhost/ProjectAkuntan/index.php"><i class="ik ik-home"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{Storage::url(auth()->user()->foto)}}" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10"></h4>
                            <p class="card-subtitle">{{auth()->user()->nama}}</p>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-user"></i> <font class="font-medium">254</font></a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-image"></i> <font class="font-medium">54</font></a></div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">Email address </small>
                        <h6>{{auth()->user()->email}}</h6>
                        <small class="text-muted d-block pt-10">Phone</small>
                        <h6>(123) 456 7890</h6>
                        <small class="text-muted d-block pt-10">Address</small>
                        <h6>Jl. Raya Krapyak, Jl. Karanganyar Raya No.RT.05, Karanganyar, Wedomartani, Kec. Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584</h6>
                        <div class="map-box">
                            <iframe src="https://maps.google.com/maps?q=pondok%20informatika%20al%20madina&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <small class="text-muted d-block pt-30">Social Profile</small>
                        <br/>
                        <button class="btn btn-icon btn-facebook"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-icon btn-twitter"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-icon btn-instagram"><i class="fab fa-instagram"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
              <div class="card">
                  <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="pills-company-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-company" aria-selected="false">Company</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-user" aria-selected="false">User</a>
                      </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-company-tab">
                          <div class="card-body">
                            @if ( collect($perusahaanData)->isEmpty() )
                              <p>Antum Belum Punya Data Perusahaan</p>
                              <button type="button" class="btn btn-outline-primary btn-rounded" data-toggle="modal" data-target="#createModal">Add Company</button>
                            @else
                              @if (count($errors) > 0)
                                <div class="alert alert-dismissible fade show" role="alert">
                                  <ul class="alert-danger list-group">
                                    @foreach ($errors->all() as $error)
                                      <li class="list-group-item">{{ $error }}</li>
                                    @endforeach
                                  </ul>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ik ik-x"></i>
                                  </button>
                                </div>
                              @endif
                              @if (session('Success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{ session('Success') }}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ik ik-x"></i>
                                  </button>
                                </div>
                              @endif
                              @foreach ($perusahaanData as $data)
                              <form class="form-horizontal" action="{{route('profile.update', $data->id)}}" method="post">
                                @csrf @method('PUT')
                                <div class="form-group">
                                  <label for="example-name">Nama</label>
                                  <input type="text" class="form-control" name="name" id="example-name" value="{{$data->name}}">
                                </div>
                                <div class="form-group">
                                  <label for="example-alamat">Alamat</label>
                                  <input type="text" class="form-control" name="alamat" id="example-alamat" value="{{$data->alamat}}">
                                </div>
                                <div class="form-group">
                                  <label for="example-telepon">Telepon</label>
                                  <input type="text" class="form-control" name="telepon" id="example-telepon" value="{{$data->telepon}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleTextarea1">Deskripsi</label>
                                  <textarea class="form-control" id="exampleTextarea1" name="discription" rows="2">{{$data->discription}}</textarea>
                                </div>
                                <button class="btn btn-success" type="submit">Update Company Data</button>
                              </form>
                            @endforeach
                            @endif
                          </div>
                      </div>
                      <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-user-tab">
                          <div class="card-body">
                              <form class="form-horizontal">
                                  <div class="form-group">
                                      <label for="example-name">Name</label>
                                      <input type="text" class="form-control" name="example-name" id="example-name" value="{{auth()->user()->nama}}">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-email">Email</label>
                                      <input type="email" class="form-control" name="example-email" id="example-email" value="{{auth()->user()->email}}">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-password">Password</label>
                                      <input type="password" class="form-control" name="example-password" id="example-password">
                                  </div>
                                  <div class="form-group">
                                    <label for="keterangan">Foto User</label>
                                    <input type="file" name="foto" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" value="{{auth()->user()->foto}}" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                  </div>
                                  <button class="btn btn-success" type="submit">Update Profile</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
  </div>

  @include('others.profile.create')

@endsection
