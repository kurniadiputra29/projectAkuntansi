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
                            <img src="http://localhost/ProjectAkuntan/img/user.jpg" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">OEMAR TECH Corporation, Ltd</h4>
                            <p class="card-subtitle">Santri Developer</p>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-user"></i> <font class="font-medium">254</font></a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-image"></i> <font class="font-medium">54</font></a></div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">Email address </small>
                        <h6>oemar@admin.com</h6>
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
                            <a class="nav-link active" id="pills-user-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-user" aria-selected="true">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-company-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-company" aria-selected="false">Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-user-tab">
                          <div class="card-body">
                              <form class="form-horizontal">
                                  <div class="form-group">
                                      <label for="example-name">Full Name</label>
                                      <input type="text" placeholder="Santri Developer" class="form-control" name="example-name" id="example-name">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-email">Email</label>
                                      <input type="email" placeholder="oemar@admin.com" class="form-control" name="example-email" id="example-email">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-password">Password</label>
                                      <input type="password" value="password" class="form-control" name="example-password" id="example-password">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-phone">Phone No</label>
                                      <input type="text" placeholder="123 456 7890" id="example-phone" name="example-phone" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="example-message">Message</label>
                                      <textarea name="example-message" name="example-message" rows="5" class="form-control"></textarea>
                                  </div>
                                  <div class="form-group">
                                      <label for="example-country">Select Country</label>
                                      <select name="example-message" id="example-message" class="form-control">
                                          <option>London</option>
                                          <option>India</option>
                                          <option>Usa</option>
                                          <option>Canada</option>
                                          <option>Thailand</option>
                                      </select>
                                  </div>
                                  <button class="btn btn-success" type="submit">Update</button>
                              </form>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-company-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-6"> <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">Johnathan Deo</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">(123) 456 7890</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">johnathan@admin.com</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>Location</strong>
                                        <br>
                                        <p class="text-muted">London</p>
                                    </div>
                                </div>
                                <hr>
                                <p class="mt-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                                <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="example-name">Full Name</label>
                                        <input type="text" placeholder="Johnathan Doe" class="form-control" name="example-name" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email">Email</label>
                                        <input type="email" placeholder="johnathan@admin.com" class="form-control" name="example-email" id="example-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-password">Password</label>
                                        <input type="password" value="password" class="form-control" name="example-password" id="example-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-phone">Phone No</label>
                                        <input type="text" placeholder="123 456 7890" id="example-phone" name="example-phone" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-message">Message</label>
                                        <textarea name="example-message" name="example-message" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-country">Select Country</label>
                                        <select name="example-message" id="example-message" class="form-control">
                                            <option>London</option>
                                            <option>India</option>
                                            <option>Usa</option>
                                            <option>Canada</option>
                                            <option>Thailand</option>
                                        </select>
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
