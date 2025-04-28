<style type="text/css">
    .select2-close-mask{
    z-index: 99999;
    }
    .select2-dropdown{
        z-index: 99999;
    }
    .span.select2-container{
        z-index: 10050;
    }
</style>
<style type="text/css">
    .select2-container .select2-selection--single{
        height:34px !important;
    }
    .select2-container--default .select2-selection--single{
       border: 1px solid #ccc !important; 
       border-radius: 0px !important; 
   }
   .select2-container.select2-container--default.select2-container--open  {
      z-index: 5000;
    }
</style>
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
         <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                    <h2 class="page-title">User</h2>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> 

                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible text-bg-success border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <form method="get" action="">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="mb-1 position-relative">
                                    <label for="simpleinput" class="form-label">Status</label>
                                    <select class="form-control select_atas" name="status">
                                        <option value="">Pilih Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" style="margin-top: 29px; width: 130px;" class="btn btn-success" ><i class="bi bi-search"></i> Search</button>&nbsp;
                                <a style="margin-top: 29px; width: 130px;" href="<?php
                                    $status      ="";
                                    if(isset($_GET['status']) && ! empty($_GET['status'])){ 
                                                $status     = $_GET['status'];
                                        }
                                        echo base_url("user/export?status=".$status."");
                                    ?>" class="btn btn-info" data-toggle="tooltip"><i class="bi bi-file-excel"></i> Export Data</a>&nbsp;
                                    <?php if ($this->session->userdata('role') == "SUPERADMIN" || $this->session->userdata('role') == "KEPALA BIDANG K3") { ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal" style="margin-top: 29px; width: 130px;"><i class="bi bi-plus-lg"></i> Tambah Data</button>&nbsp;
                                    <?php } ?>
                            </div>
                        </div>
                    </form>
                    <br>
                        <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="23%">Nama User</th>
                                    <th width="17%">Email</th>
                                    <th width="10%">Role</th>
                                    <th width="10%">Handphone</th>
                                    <th width="10%">Status</th>
                                    <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
                                        <th width="10%"><center>Aksi</center></th>
                                    <?php } ?>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $i = 1;
                                foreach ($user as $k) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $k['nama']; ?></td>
                                        <td><?php echo $k['email']; ?></td>
                                        <td><?php echo $k['nama_role']; ?></td>
                                        <td><?php echo $k['phone']; ?></td>
                                        <td><?php echo $k['status']; ?></td>

                                        <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
                                            <td>
                                                <center> 
                                                    <a href="#" class="text-reset fs-16 px-1" data-bs-toggle="modal" id="btn_edit_select" data-bs-target="#standard-modal_edit<?php echo $k['id_user']; ?>" data-id="<?=$k['id_user'];?>" onClick='data_user(<?=$k['id_user'];?>)'> <i class="ri-edit-2-fill"></i></a>
                                                </center>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->
<!-- end page title -->
    </div>
    <!-- container -->

</div>

<div id="standard-modal" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Tambah User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="<?php echo base_url('user/tambah_user') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Email</label>
                            <input type="email"class="form-control" name="email" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Handphone</label>
                            <input type="number"class="form-control" name="phone" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Role</label>
                            <select class="form-control select2" data-toggle="select2" name="id_role" required>
                                <option value="">Pilih Role</option>
                                <?php foreach ($role as $sa) {
                                    echo '<option value="' . $sa['id'] . '">' . $sa['nama'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Password</label>
                            <input type="password"class="form-control" name="password" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Status</label>
                            <select class="form-control select2" data-toggle="select2" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="width: 80px;">Batal</button>
                        <button type="submit" class="btn btn-primary" style="width: 80px;">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $i=1; foreach ($user as $k) { ?>
<div id="standard-modal_edit<?php echo $k['id_user']; ?>" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="<?php echo base_url('user/edit_user') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $k['nama'] ?>" required>
                            <input type="hidden" class="form-control" name="id_user" value="<?php echo $k['id_user'] ?>" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Email</label>
                            <input type="email"class="form-control" name="email" value="<?php echo $k['email'] ?>" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Handphone</label>
                            <input type="number"class="form-control" name="phone" value="<?php echo $k['phone'] ?>" required>
                        </div>
                        <?php if ($k['id_role'] == "1") { ?>
                            <input type="hidden" class="form-control" name="id_role" value="<?php echo $k['id_role'] ?>" required>
                        <?php } else { ?>
                            <div class="mb-1">
                                <label for="simpleinput" class="form-label">Role</label>
                                <select class="form-control select2_edit<?php echo $k['id_user'] ?>" data-toggle="select2" name="id_role" required >
                                    <option value="">Pilih Role</option>
                                    <?php 
                                        foreach ($role as $ka) {
                                            $selected = "";
                                            if ($ka['id'] == $k['id_role']) {
                                                $selected = 'selected';
                                            }
                                            echo '<option value="'.$ka['id'].'"'.$selected.'>'.$ka['nama'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Password</label>
                            <input type="password"class="form-control" name="password">
                            <span><h6><i>Password dikosongkan jika tidak di edit</i></h6></span>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Status</label>
                            <select class="form-control select2_edit<?php echo $k['id_user'] ?>" data-toggle="select2" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Active" <?php if($k['status'] == "Active"){echo "selected";} ?>>Active</option>
                                <option value="Inactive" <?php if($k['status'] == "Inactive"){echo "selected";} ?>>Inactive</option>
                            </select>
                        </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="width: 80px;">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 80px;">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $i++; } ?> 

<script type="text/javascript">
    $(document).ready(function(){
        $('.select2').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),// fix select2 search input focus bug
            })
        });

        // fix select2 bootstrap modal scroll bug
        $(document).on('select2:close', '.select2', function (e) {
            var evt = "scroll.select2"
            $(e.target).parents().off(evt)
            $(window).off(evt)
        });
    });

    $(document).on("click", "#btn_edit_select", function(e){
        var id = $(this).data("id");
        $(document).ready(function(){

            $('.select2_edit'+id).each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent(),// fix select2 search input focus bug
                })
            });

            // fix select2 bootstrap modal scroll bug
            $(document).on('select2:close', '.select2_edit'+id, function (e) {
                var evt = "scroll.select2"
                $(e.target).parents().off(evt)
                $(window).off(evt)
            });
        });
    });
</script>
<script type="text/javascript">   
    $(document).on("click", "#btn_delete", function(e){
        var id_user = $(this).data("id_user");
        swal({
            title: "Apakah anda yakin ingin menghapus ?",
            text: "Data tidak dapat dikembalikan",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, lanjutkan!",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm){
            if(isConfirm){
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?= base_url('user/delete_user') ?>",
                    "method": "POST",
                    "data": {
                        "id_user": id_user
                    }
                }

                $.ajax(settings).done(function (response) {
                    var data = JSON.parse(response)
                    var message = data.message;
                    if(data.status == "success"){
                        swal({
                            title: "Success",
                            text: message,
                            type: "success",
                            confirmButtonColor: "#a5dc86",
                            confirmButtonText: "Close",
                        }, function(isConfirm){
                            location.reload();
                        });
                    } else {
                        swal("Gagal menghapus data.", message.toUpperCase(), "warning");
                    }
                });   
            }
        });
    });
    $(document).ready(function(){
        $('.select_atas').select2();
    });
</script>