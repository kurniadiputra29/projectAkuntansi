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
                            <a class="nav-link active" id="pills-user-tab-{{auth()->user()->id}}" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-user" aria-selected="true">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-company-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-company" aria-selected="false">Company</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-user-tab-{{auth()->user()->id}}">
                          <div class="card-body">
                            @foreach($perusahaanData as $key)
                              <form class="form-horizontal">
                                  <div class="form-group">
                                      <label for="example-name">Nama</label>
                                      <input type="text" class="form-control" name="example-name" id="example-name" value="{{$key->nama}}">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-email">Email</label>
                                      <input type="email" class="form-control" name="example-email" id="example-email" value="{{$key->email}}">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-password">Password</label>
                                      <input type="password" class="form-control" name="example-password" id="example-password">
                                  </div>
                                  <button class="btn btn-success" type="submit">Update</button>
                              </form>
                            @endforeach
                          </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-company-tab">
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="example-name">Nama</label>
                                        <input type="text" placeholder="Johnathan Doe" class="form-control" name="example-name" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email">Alamat</label>
                                        <input type="email" placeholder="johnathan@admin.com" class="form-control" name="example-email" id="example-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-password">Telepon</label>
                                        <input type="password" value="password" class="form-control" name="example-password" id="example-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-message">Deskripsi</label>
                                        <textarea name="example-message" name="example-message" rows="5" class="form-control"></textarea>
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

@endsection
