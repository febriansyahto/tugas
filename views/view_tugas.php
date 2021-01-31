<div id="content" class="content">
  <ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('tugas');?>">TUGAS</a></li>
  </ol>
  <h1 class="page-header">Tugas</h1>
  <div class="row">
    <div class="col-xl-12">
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <h4 class="panel-title">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah" data-whatever="@getbootstrap">Tambah</button>
          </h4>
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
          </div>
        </div>
        <!-- start UPLOAD -->
        <div class="card-body">
            <div class="row">
                <div class="col-xl-7 col-lg-8">
                    <?php echo $this->session->flashdata('notifpagu') ?>
                    <form method="POST" action="<?php echo base_url() ?>tugas/uploadPagu" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail2">UNGGAH FILE EXCEL TUGAS</label>
                            <span class="ml-2">
                                <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Format yang diupload .xlsx" data-placement="top" data-content=""></i>
                            </span>
                            <input for="pagu" type="file" name="pagu" class="form-control">
                        </div>

                        <button id="pagu" type="submit" class="btn btn-success">UPLOAD</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End UPLOAD -->
        <?php if($this->session->flashdata('tugas') != NULL){ ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Notif!</strong> <?php echo $this->session->flashdata('tugas') ?>
        </div>
        <?php } ?>
        
        <div class="panel-body">
        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
              <tr>
                <th class="text-nowrap">No</th>
                <th class="text-nowrap">CP</th>
                <th class="text-nowrap">JURUSAN</th>
                <th class="text-nowrap">Nama Lengkap</th>
                <th class="text-nowrap">NIP BARU</th>
                <th class="text-nowrap">PANGKAT</th>
                <th class="text-nowrap">GOLONGAN</th>
                <th class="text-nowrap">ESELON</th>
                <th class="text-nowrap">JABATAN</th>
                <th> Aksi </th>
              </tr>
            </thead>
            <tbody>
            <?php
                $no = 0;
                foreach($data as $row){
                $no++;
            ?>
              <tr>
                <td><?= $no == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $no ?></td>
                <td><?= $row->cp == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $row->cp ?></td>
                <td><?= $row->jur == NULL  ? "<i><font style='color:red;'>Not Found</font></i>" : $row->jur ?></td>
                <td><?= $row->nama == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $row->nama ?></td>
                <td><?= $row->nip == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $row->nip ?></td>
                <td><?= $row->pangkat == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $row->pangkat ?></td>
                <td><?= $row->gol == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $row->gol ?></td>
                <td><?= $row->eselon == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $row->eselon ?></td>
                <td><?= $row->jabatan == NULL ? "<i><font style='color:red;'>Not Found</font></i>" : $row->jabatan ?></td>
                <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row->nip; ?>" data-whatever="@getbootstrap"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?php echo $row->nip; ?>" data-whatever="@getbootstrap"><i class="fas fa-trash"></i></button>
                </td>
              
                <!-- <td>
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editpeg<?php echo $row->id_user;?>"><i class="fa fas fa-edit"></i></a>
                    <a href="#" class="btn btn-sm btn-danger" style="color:#fff;cursor:pointer" data-toggle="modal" data-target="#hapuspeg<?php echo $row->id_user;?>"><i class="fa fas fa-trash"></i></a>
                    <a href="#" class="btn btn-sm btn-secondary"><i class="fa fas fa-lock"></i></a> -->
                </td>
              </tr>
              <!-- Start Modal EDIT -->
              <div class="modal fade" id="edit<?php echo $row->nip; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="tugas/edit_tugas">
                      <!-- FORM -->
                      <input type="hidden" name="id" value="<?php echo $row->nip; ?>";> </input>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Nama Lengkap:</label>
                          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row->nama; ?>" required placeholder="masukan nama..">
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">CP</label>
                          <input type="text" class="form-control" id="cp" name="cp" value="<?php echo $row->cp; ?>">
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Jurusan</label>
                          <input type="text" class="form-control" id="jur" name="jur" value="<?php echo $row->jur; ?>">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Pangkat</label>
                          <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?php echo $row->pangkat; ?>">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Golongan</label>
                          <input type="text" class="form-control" id="gol" name="gol" value="<?php echo $row->gol; ?>">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Eselon</label>
                          <input type="text" class="form-control" id="eselon" name="eselon" value="<?php echo $row->eselon; ?>">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Jabatan</label>
                          <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $row->jabatan; ?>">
                        </div>
                        <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END Modul EDIT -->

              <!-- Start Modal Hapus -->
              <div class="modal fade" id="hapus<?php echo $row->nip; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Menghapus data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <div class="modal-body">
                          <form method="post" action="tugas/hapus_tugas">
                          <!-- START FORM -->
                          <input type="hidden" name="id" value="<?php echo $row->nip; ?>";> </input>
                          <h3>Anda yakin ingin menghapus data (<?php echo $row->nama;?>) </h3>  
                          <!-- END FORM -->
                            <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END Modul Hapus -->

            <?php } ?>
            </tbody>
          </table>    
        </div>
        <!-- end panel-body -->
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-10 -->

    <!-- Start - Modal Create -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="tugas/tambah_tugas">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">NIP BARU</label>
            <input type="text" class="form-control" id="nip" name="nip" value="" required placeholder="masukan NIP..">
          </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Nama Lengkap:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="" required placeholder="masukan nama..">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">CP</label>
            <input type="text" class="form-control" id="cp" name="cp" value="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jurusan</label>
            <input type="text" class="form-control" id="jur" name="jur" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Pangkat</label>
            <input type="text" class="form-control" id="pangkat" name="pangkat" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Golongan</label>
            <input type="text" class="form-control" id="gol" name="gol" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Eselon</label>
            <input type="text" class="form-control" id="eselon" name="eselon" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="">
          </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
