@extends('layouts.app')

@section('title', 'AccountMin - Dasbor')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-home bg-blue"></i>
              <div class="d-inline">
                <h5>Dasbor</h5>
                <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href=""><i class="ik ik-home"></i></a>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- product profit start -->
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-red">
            <div class="card-body">
              <div class="row align-items-center mb-30">
                <div class="col">
                  <h6 class="mb-5 text-white">Total Profit</h6>
                  <h3 class="mb-0 fw-700 text-white">$1,783</h3>
                </div>
                <div class="col-auto">
                  <i class="fa fa-money-bill-alt text-red f-18"></i>
                </div>
              </div>
              <p class="mb-0 text-white"><span class="label label-danger mr-10">+11%</span>From Previous Month</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-blue">
            <div class="card-body">
              <div class="row align-items-center mb-30">
                <div class="col">
                  <h6 class="mb-5 text-white">Total Orders</h6>
                  <h3 class="mb-0 fw-700 text-white">15,830</h3>
                </div>
                <div class="col-auto">
                  <i class="fas fa-database text-blue f-18"></i>
                </div>
              </div>
              <p class="mb-0 text-white"><span class="label label-primary mr-10">+12%</span>From Previous Month</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-green">
            <div class="card-body">
              <div class="row align-items-center mb-30">
                <div class="col">
                  <h6 class="mb-5 text-white">Average Price</h6>
                  <h3 class="mb-0 fw-700 text-white">$6,780</h3>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign text-green f-18"></i>
                </div>
              </div>
              <p class="mb-0 text-white"><span class="label label-success mr-10">+52%</span>From Previous Month</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card prod-p-card card-yellow">
            <div class="card-body">
              <div class="row align-items-center mb-30">
                <div class="col">
                  <h6 class="mb-5 text-white">Product Sold</h6>
                  <h3 class="mb-0 fw-700 text-white">6,784</h3>
                </div>
                <div class="col-auto">
                  <i class="fas fa-tags text-warning f-18"></i>
                </div>
              </div>
              <p class="mb-0 text-white"><span class="label label-warning mr-10">+52%</span>From Previous Month</p>
            </div>
          </div>
        </div>
        <!-- product profit end -->

        <div class="col-xl-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <h3>Coba Bikin Chart</h3>
            </div>
            <div class="card-block">
              <div class="charet">
                <canvas id="tryChart" width="400" height="100" aria-label="Hello ARIA World" role="img"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-12 col-md-12">
          <div class="card">
            <div class="card-header">
              <h3>Coba Bikin Chart 2</h3>
            </div>
            <div class="card-block">
              <div class="charet">
                <canvas id="tryChart2" height="150" aria-label="Hello ARIA World" role="img"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- product and new customar start -->
        <div class="col-xl-4 col-md-6">
          <div class="card new-cust-card">
            <div class="card-header">
              <h3>New Customers</h3>
              <div class="card-header-right">
                <ul class="list-unstyled card-option">
                  <li><i class="ik ik-chevron-left action-toggle"></i></li>
                  <li><i class="ik ik-minus minimize-card"></i></li>
                  <li><i class="ik ik-x close-card"></i></li>
                </ul>
              </div>
            </div>
            <div class="card-block">
              <div class="align-middle mb-25">
                <img src="http://localhost/ProjectAkuntan/img/users/1.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                <div class="d-inline-block">
                  <a href="#!"><h6>Alex Thompson</h6></a>
                  <p class="text-muted mb-0">Cheers!</p>
                  <span class="status active"></span>
                </div>
              </div>
              <div class="align-middle mb-25">
                <img src="http://localhost/ProjectAkuntan/img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                <div class="d-inline-block">
                  <a href="#!"><h6>John Doue</h6></a>
                  <p class="text-muted mb-0">stay hungry stay foolish!</p>
                  <span class="status active"></span>
                </div>
              </div>
              <div class="align-middle mb-25">
                <img src="http://localhost/ProjectAkuntan/img/users/3.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                <div class="d-inline-block">
                  <a href="#!"><h6>Alex Thompson</h6></a>
                  <p class="text-muted mb-0">Cheers!</p>
                  <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>30 min ago</span>
                </div>
              </div>
              <div class="align-middle mb-25">
                <img src="http://localhost/ProjectAkuntan/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                <div class="d-inline-block">
                  <a href="#!"><h6>John Doue</h6></a>
                  <p class="text-muted mb-0">Cheers!</p>
                  <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>10 min ago</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 col-md-6">
          <div class="card table-card">
            <div class="card-header">
              <h3>New Products</h3>
              <div class="card-header-right">
                <ul class="list-unstyled card-option">
                  <li><i class="ik ik-chevron-left action-toggle"></i></li>
                  <li><i class="ik ik-minus minimize-card"></i></li>
                  <li><i class="ik ik-x close-card"></i></li>
                </ul>
              </div>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>HeadPhone</td>
                      <td><img src="http://localhost/ProjectAkuntan/img/widget/p1.jpg" alt="" class="img-fluid img-20"></td>
                      <td>
                        <div class="p-status bg-green"></div>
                      </td>
                      <td>$10</td>
                      <td>
                        <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                        <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Iphone 6</td>
                      <td><img src="http://localhost/ProjectAkuntan/img/widget/p2.jpg" alt="" class="img-fluid img-20"></td>
                      <td>
                        <div class="p-status bg-green"></div>
                      </td>
                      <td>$20</td>
                      <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                    </tr>
                    <tr>
                      <td>Jacket</td>
                      <td><img src="http://localhost/ProjectAkuntan/img/widget/p3.jpg" alt="" class="img-fluid img-20"></td>
                      <td>
                        <div class="p-status bg-green"></div>
                      </td>
                      <td>$35</td>
                      <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                    </tr>
                    <tr>
                      <td>Sofa</td>
                      <td><img src="http://localhost/ProjectAkuntan/img/widget/p4.jpg" alt="" class="img-fluid img-20"></td>
                      <td>
                        <div class="p-status bg-green"></div>
                      </td>
                      <td>$85</td>
                      <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                    </tr>
                    <tr>
                      <td>Iphone 6</td>
                      <td><img src="http://localhost/ProjectAkuntan/img/widget/p2.jpg" alt="" class="img-fluid img-20"></td>
                      <td>
                        <div class="p-status bg-green"></div>
                      </td>
                      <td>$20</td>
                      <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        <!-- product and new customar end -->

        <!-- top contact and member performance start -->
        <div class="col-xl-6 col-md-6">
          <div class="card table-card">
            <div class="card-header">
              <h3>Top Contacts</h3>
              <div class="card-header-right">
                <ul class="list-unstyled card-option">
                  <li><i class="ik ik-chevron-left action-toggle"></i></li>
                  <li><i class="ik ik-minus minimize-card"></i></li>
                  <li><i class="ik ik-x close-card"></i></li>
                </ul>
              </div>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Company</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Apple Company</td>
                      <td>23/05/2017</td>
                      <td>04/08/2018</td>
                      <td><label class="badge badge-success">Paid</label></td>
                    </tr>
                    <tr>
                      <td>Envato Pvt Ltd.</td>
                      <td>20/03/2017</td>
                      <td>04/08/2019</td>
                      <td><label class="badge badge-danger">Unpaid</label></td>
                    </tr>
                    <tr>
                      <td>Dribble Company</td>
                      <td>13/05/2017</td>
                      <td>03/01/2018</td>
                      <td><label class="badge badge-success">Paid</label></td>
                    </tr>
                    <tr>
                      <td>Adobe Family</td>
                      <td>11/01/2016</td>
                      <td>02/03/2017</td>
                      <td><label class="badge badge-success">Paid</label></td>
                    </tr>
                    <tr>
                      <td>Apple Company</td>
                      <td>23/05/2017</td>
                      <td>04/08/2018</td>
                      <td><label class="badge badge-danger">Unpaid</label></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6">
          <div class="card table-card">
            <div class="card-header">
              <h3>Member’s  performance</h3>
              <div class="card-header-right">
                <ul class="list-unstyled card-option">
                  <li><i class="ik ik-chevron-left action-toggle"></i></li>
                  <li><i class="ik ik-minus minimize-card"></i></li>
                  <li><i class="ik ik-x close-card"></i></li>
                </ul>
              </div>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-hover mb-0 without-header">
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle">
                          <img src="http://localhost/ProjectAkuntan/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                          <div class="d-inline-block">
                            <h6 class="mb-0">Shirley  Hoe</h6>
                            <p class="text-muted mb-0">Sales executive , NY</p>
                          </div>
                        </div>
                      </td>
                      <td class="text-right">
                        <h6 class="fw-700">$78.001<i class="fas fa-level-down-alt text-red ml-10"></i></h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle">
                          <img src="http://localhost/ProjectAkuntan/img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                          <div class="d-inline-block">
                            <h6 class="mb-0">James Alexander</h6>
                            <p class="text-muted mb-0">Sales executive , EL</p>
                          </div>
                        </div>
                      </td>
                      <td class="text-right">
                        <h6 class="fw-700">$89.051<i class="fas fa-level-up-alt text-green ml-10"></i></h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle">
                          <img src="http://localhost/ProjectAkuntan/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                          <div class="d-inline-block">
                            <h6 class="mb-0">Shirley  Hoe</h6>
                            <p class="text-muted mb-0">Sales executive , NY</p>
                          </div>
                        </div>
                      </td>
                      <td class="text-right">
                        <h6 class="fw-700">$89.051<i class="fas fa-level-up-alt text-green ml-10"></i></h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle">
                          <img src="http://localhost/ProjectAkuntan/img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                          <div class="d-inline-block">
                            <h6 class="mb-0">James Alexander</h6>
                            <p class="text-muted mb-0">Sales executive , EL</p>
                          </div>
                        </div>
                      </td>
                      <td class="text-right">
                        <h6 class="fw-700">$78.001<i class="fas fa-level-down-alt text-red ml-10"></i></h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle">
                          <img src="http://localhost/ProjectAkuntan/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                          <div class="d-inline-block">
                            <h6 class="mb-0">Shirley  Hoe</h6>
                            <p class="text-muted mb-0">Sales executive , NY</p>
                          </div>
                        </div>
                      </td>
                      <td class="text-right">
                        <h6 class="fw-700">$78.001<i class="fas fa-level-down-alt text-red ml-10"></i></h6>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        <!-- top contact and member performance end -->

        <!-- ticket, proj, clent start -->
        <div class="col-xl-3 col-md-6">
          <div class="card ticket-card">
            <div class="card-body">
              <p class="mb-30 bg-red lbl-card"><i class="fas fa-folder-open"></i> Open Tickets</p>
              <div class="text-center">
                <h2 class="mb-0 d-inline-block text-red">128</h2>
                <p class="mb-0 d-inline-block">Tickets</p>
                <p class="mb-0 mt-15"><i class="fas fa-caret-down mr-10 f-18 text-red"></i>From Previous Month</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card ticket-card">
            <div class="card-body">
              <p class="mb-30 bg-blue lbl-card"><i class="fas fa-file-archive"></i> Close Tickets</p>
              <div class="text-center">
                <h2 class="mb-0 d-inline-block text-blue">134</h2>
                <p class="mb-0 d-inline-block">Tickets</p>
                <p class="mb-0 mt-15"><i class="fas fa-caret-up mr-10 f-18 text-blue"></i>From Previous Month</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card ticket-card">
            <div class="card-body">
              <p class="mb-30 bg-green lbl-card"><i class="fas fa-users"></i> New Clients</p>
              <div class="text-center">
                <h2 class="mb-0 d-inline-block text-green">307</h2>
                <p class="mb-0 d-inline-block">Clients</p>
                <p class="mb-0 mt-15"><i class="fas fa-caret-up mr-10 f-18 text-green"></i>From Previous Month</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card ticket-card">
            <div class="card-body">
              <p class="mb-30 bg-warning lbl-card"><i class="fas fa-database"></i> New Orders</p>
              <div class="text-center">
                <h2 class="mb-0 d-inline-block text-warning">231</h2>
                <p class="mb-0 d-inline-block">Orders</p>
                <p class="mb-0 mt-15"><i class="fas fa-caret-up mr-10 f-18 text-warning"></i>From Previous Month</p>
              </div>
            </div>
          </div>
        </div>
        <!-- ticket, proj, clent end -->

        <div class="col-xl-12">
          <div class="card table-card">
            <div class="card-header">
              <h3>New Products</h3>
              <div class="card-header-right">
                <ul class="list-unstyled card-option">
                  <li><i class="ik ik-chevron-left action-toggle"></i></li>
                  <li><i class="ik ik-minus minimize-card"></i></li>
                  <li><i class="ik ik-x close-card"></i></li>
                </ul>
              </div>
            </div>
            <div class="card-block pb-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Product Code</th>
                      <th>Customer</th>
                      <th>Status</th>
                      <th>Rating</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Sofa</td>
                      <td>#PHD001</td>
                      <td><a href="#">abc@gmail.com</a></td>
                      <td><label class="badge badge-danger">Out Stock</label></td>
                      <td>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Computer</td>
                      <td>#PHD002</td>
                      <td><a href="#">cdc@gmail.com</a></td>
                      <td><label class="badge badge-success">In Stock</label></td>
                      <td>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Mobile</td>
                      <td>#PHD003</td>
                      <td><a href="#">pqr@gmail.com</a></td>
                      <td><label class="badge badge-danger">Out Stock</label></td>
                      <td>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Coat</td>
                      <td>#PHD004</td>
                      <td><a href="#">bcs@gmail.com</a></td>
                      <td><label class="badge badge-success">In Stock</label></td>
                      <td>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Watch</td>
                      <td>#PHD005</td>
                      <td><a href="#">cdc@gmail.com</a></td>
                      <td><label class="badge badge-success">In Stock</label></td>
                      <td>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Shoes</td>
                      <td>#PHD006</td>
                      <td><a href="#">pqr@gmail.com</a></td>
                      <td><label class="badge badge-danger">Out Stock</label></td>
                      <td>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-yellow"></i></a>
                        <a href="#!"><i class="fa fa-star f-12 text-default"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- peoduct statustic start -->
        <div class="col-xl-12">
          <div class="card product-progress-card">
            <div class="card-block">
              <div class="row pp-main">
                <div class="col-xl-3 col-md-6">
                  <div class="pp-cont">
                    <div class="row align-items-center mb-20">
                      <div class="col-auto">
                        <i class="fas fa-cube f-24 text-mute"></i>
                      </div>
                      <div class="col text-right">
                        <h2 class="mb-0 text-blue">2476</h2>
                      </div>
                    </div>
                    <div class="row align-items-center mb-15">
                      <div class="col-auto">
                        <p class="mb-0">Total Product</p>
                      </div>
                      <div class="col text-right">
                        <p class="mb-0 text-blue"><i class="fas fa-long-arrow-alt-up mr-10"></i>64%</p>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-blue" style="width:45%"></div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6">
                  <div class="pp-cont">
                    <div class="row align-items-center mb-20">
                      <div class="col-auto">
                        <i class="fas fa-tag f-24 text-mute"></i>
                      </div>
                      <div class="col text-right">
                        <h2 class="mb-0 text-red">843</h2>
                      </div>
                    </div>
                    <div class="row align-items-center mb-15">
                      <div class="col-auto">
                        <p class="mb-0">New Orders</p>
                      </div>
                      <div class="col text-right">
                        <p class="mb-0 text-red"><i class="fas fa-long-arrow-alt-down mr-10"></i>34%</p>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-red" style="width:75%"></div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6">
                  <div class="pp-cont">
                    <div class="row align-items-center mb-20">
                      <div class="col-auto">
                        <i class="fas fa-random f-24 text-mute"></i>
                      </div>
                      <div class="col text-right">
                        <h2 class="mb-0 text-c-yellow">63%</h2>
                      </div>
                    </div>
                    <div class="row align-items-center mb-15">
                      <div class="col-auto">
                        <p class="mb-0">Conversion Rate</p>
                      </div>
                      <div class="col text-right">
                        <p class="mb-0 text-yellow"><i class="fas fa-long-arrow-alt-up mr-10"></i>64%</p>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-yellow" style="width:65%"></div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6">
                  <div class="pp-cont">
                    <div class="row align-items-center mb-20">
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign f-24 text-mute"></i>
                      </div>
                      <div class="col text-right">
                        <h2 class="mb-0 text-green">41M</h2>
                      </div>
                    </div>
                    <div class="row align-items-center mb-15">
                      <div class="col-auto">
                        <p class="mb-0">Conversion Rate</p>
                      </div>
                      <div class="col text-right">
                        <p class="mb-0 text-green"><i class="fas fa-long-arrow-alt-up mr-10"></i>54%</p>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-green" style="width:35%"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- peoduct statustic end -->
      </div>
    </div>
  </div>

@endsection

@section('chart-script')

  <script>
      var ctx = document.getElementById("tryChart").getContext('2d');
      var tryChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Kredit", "Debet"],
          datasets: [{
            label: '# Rupiah',
            data: [{{$kredit}},{{$debet}}],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:true
              }
            }]
          }
        }
      });
  </script>
  <script>
      var kvd = document.getElementById('tryChart2').getContext('2d');
      var tryChart2 = new Chart(kvd, {
        type: 'line',
        data: {
          labels: [
            @foreach ($saldo_awal as $key)
              "{{$key->account->nama}}",
            @endforeach
          ],
          datasets: [{
            label: 'Debet Dataset',
            data: [
              @foreach ($saldo_awal as $key)
                {{$key->debet}},
              @endforeach
            ],
            order: 1,
            borderWidth: 1,
            borderColor: '#ce5456',
            backgroundColor: 'rgba(54, 162, 235, 0.2)'
          }, {
            label: 'Kredit Dataset',
            data: [
              @foreach ($saldo_awal as $key)
                {{$key->kredit}},
              @endforeach
            ],
            type: 'line',
            order: 2,
            borderWidth: 1,
            borderColor: '#adad23',
            backgroundColor: 'rgba(255, 99, 132, 0.2)'
          }],
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:true
              }
            }]
          }
        }
      });
  </script>

@endsection
