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
                                      <i class="ik ik-compass bg-blue"></i>
                                      <div class="d-inline">
                                          <h5>Satuan</h5>
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
                                          <li class="breadcrumb-item active" aria-current="page">Satuan</li>
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
                                <h3>Satuan</h3>
                                <span>use class <code>table-hover</code> inside table element</span>
                              </div>
                              <div class="right-container">
                                <button type="button" class="btn btn-outline-primary btn-rounded">Create</button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr class="row" style="display: contents;">
                                      <th class="col-2">Kode</th>
                                      <th class="col-3">Nama</th>
                                      <th class="col-5">Deskripsi</th>
                                      <th class="col-1">Status</th>
                                      <th class="col-1">Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>Box</td>
                                      <td>Box</td>
                                      <td></td>
                                      <td><span class="badge badge-pill badge-success mb-1">Aktif</span></td>
                                      <td>
                                        <div class="table-actions">
                                          <a href="#"><i class="ik ik-edit-2"></i></a>
                                          <a href="#"><i class="ik ik-trash-2"></i></a>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Dozen</td>
                                      <td>Dozen</td>
                                      <td>12 pcs</td>
                                      <td><span class="badge badge-pill badge-success mb-1">Aktif</span></td>
                                      <td>
                                        <div class="table-actions">
                                          <a href="#"><i class="ik ik-edit-2"></i></a>
                                          <a href="#"><i class="ik ik-trash-2"></i></a>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Kg</td>
                                      <td>Kilogram</td>
                                      <td></td>
                                      <td><span class="badge badge-pill badge-success mb-1">Aktif</span></td>
                                      <td>
                                        <div class="table-actions">
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

                <<?php include '../../parts/footer.php'; ?>

            </div>
        </div>




        <<?php include '../../parts/modal.php'; ?>

        <<?php include '../../parts/script.php'; ?>
    </body>
</html>
