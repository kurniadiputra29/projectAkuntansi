<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>AccountMin - Simple Accountant Admin</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include '../../parts/head.php'; ?>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrapper">
            <?php include '../../parts/header.php'; ?>

            <div class="page-wrap">
                <div class="app-sidebar colored">
                  <div class="sidebar-header">
                      <a class="header-brand" href="index.html">
                          <div class="logo-img">
                             <img src="../../../src/img/brand-white.svg" class="header-brand-img" alt="lavalite">
                          </div>
                          <span class="text">AccountMin</span>
                      </a>
                      <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                      <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                  </div>

                  <?php include '../../parts/sidebar.php'; ?>
                </div>

                <div class="main-content">
                    <div class="container-fluid">
                      <div class="page-header">
                          <div class="row align-items-end">
                              <div class="col-lg-8">
                                  <div class="page-header-title">
                                      <i class="ik ik-phone bg-blue"></i>
                                      <div class="d-inline">
                                          <h5>Kontak</h5>
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
                                          <li class="breadcrumb-item active" aria-current="page">Kontak</li>
                                      </ol>
                                  </nav>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-header d-flex justify-content-between flex-row">
                              <div class="left-container">
                                <h3>Hover Table</h3>
                                <span>use class <code>table-hover</code> inside table element</span>
                              </div>
                              <div class="right-container">
                                <button type="button" class="btn btn-outline-primary btn-rounded">Primary</button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div id="data_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <table id="data_table" class="table dataTable no-footer" role="grid" aria-describedby="data_table_info">
                                      <thead>
                                        <!-- customer, supplier : id, kode, nama, NPWP, alamat, termin -->
                                        <tr role="row">
                                          <th class="sorting_asc" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" style="width: 71.6333px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
                                          <th class="nosort sorting_disabled" rowspan="1" colspan="1" style="width: 111.417px;" aria-label="Avatar">Avatar</th>
                                          <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" style="width: 200.833px;" aria-label="Name: activate to sort column ascending">Name</th>
                                          <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" style="width: 316.167px;" aria-label="Email: activate to sort column ascending">Email</th>
                                          <th class="nosort sorting_disabled" rowspan="1" colspan="1" style="width: 190.45px;" aria-label="&amp;nbsp;">&nbsp;
                                          </th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr role="row" class="odd">
                                          <td class="sorting_1">001</td>
                                          <td><img src="../../../img/users/1.jpg" class="table-user-thumb" alt=""></td>
                                          <td>Erich Heaney</td>
                                          <td>erich@example.com</td>
                                          <td>
                                            <div class="table-actions">
                                              <a href="#"><i class="ik ik-eye"></i></a>
                                              <a href="#"><i class="ik ik-edit-2"></i></a>
                                              <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                          </td>
                                        </tr><tr role="row" class="even">
                                          <td class="sorting_1">002</td>
                                          <td><img src="../../../img/users/2.jpg" class="table-user-thumb" alt=""></td>
                                          <td>Abraham Douglas</td>
                                          <td>jgraham@example.com</td>
                                          <td>
                                            <div class="table-actions">
                                              <a href="#"><i class="ik ik-eye"></i></a>
                                              <a href="#"><i class="ik ik-edit-2"></i></a>
                                              <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                          </td>
                                        </tr><tr role="row" class="odd">
                                          <td class="sorting_1">003</td>
                                          <td><img src="../../../img/users/3.jpg" class="table-user-thumb" alt=""></td>
                                          <td>Roderick Simonis</td>
                                          <td>grant.simonis@example.com</td>
                                          <td>
                                            <div class="table-actions">
                                              <a href="#"><i class="ik ik-eye"></i></a>
                                              <a href="#"><i class="ik ik-edit-2"></i></a>
                                              <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                          </td>
                                        </tr><tr role="row" class="even">
                                          <td class="sorting_1">004</td>
                                          <td><img src="../../../img/users/4.jpg" class="table-user-thumb" alt=""></td>
                                          <td>Christopher Henry</td>
                                          <td>henry.chris@example.com</td>
                                          <td>
                                            <div class="table-actions">
                                              <a href="#"><i class="ik ik-eye"></i></a>
                                              <a href="#"><i class="ik ik-edit-2"></i></a>
                                              <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                          </td>
                                        </tr><tr role="row" class="odd">
                                          <td class="sorting_1">005</td>
                                          <td><img src="../../../img/users/5.jpg" class="table-user-thumb" alt=""></td>
                                          <td>Sonia Wilkinson</td>
                                          <td>boyle.aglea@example.com</td>
                                          <td>
                                            <div class="table-actions">
                                              <a href="#"><i class="ik ik-eye"></i></a>
                                              <a href="#"><i class="ik ik-edit-2"></i></a>
                                              <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>

                <<?php include '../../parts/footer.php'; ?>

            </div>
        </div>




        <<?php include '../../parts/modal.php'; ?>

        <<?php include '../../parts/script.php'; ?>
    </body>
</html>
