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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('shopee'); ?>">Shopee</a></li>
                            <li class="breadcrumb-item active">Mapping</li>
                        </ol>
                    </div>
                    <h2 class="page-title">Mapping</h2>
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
                    <center><h2><?php echo $table->nama_table; ?></h2></center>
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
                                    <?php if($table->status != "1"){ ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal" style="margin-top: 29px; width: 130px;"><i class="bi bi-plus-lg"></i> Tambah Data</button>&nbsp;
                                    
                                        <button type="button" class="btn btn-primary" id="btn_approve" data-id="<?=$table->id;?>" style="margin-top: 29px; width: 200px;"><i class="ri-check-line"></i> Tambah Table Database</button>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                    <br>
                        <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="22%">Kolom Table</th>
                                    <th width="17%">Type</th>
                                    <th width="12%">Length</th>
                                    <th width="9%">Default</th>
                                    <th width="9%">Auto Increment</th>
                                    <th width="9%">Unsigned</th>
                                    <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
                                        <th width="17%"><center>Aksi</center></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                               
                            <tbody>
                                <?php $i = 1;
                                foreach ($mapping as $k) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $k['kolom_table']; ?></td>
                                        <td><?php echo $k['type']; ?></td>
                                        <td><?php echo $k['constraint']; ?></td>
                                        <td><?php echo $k['null']; ?></td>
                                        <td><?php echo $k['auto_increment']; ?></td>
                                        <td><?php echo $k['unsigned']; ?></td>

                                        <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
                                            <td>
                                                <?php if($k['auto_increment'] == "FALSE"){ ?>
                                                <center>
                                                    <a href="#" class="text-reset fs-16 px-1" id="btn_delete" data-id="<?=$k['id'];?>"> <i class="ri-delete-bin-2-line"></i></a>  
                                                </center>
                                                <?php } ?>
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
                <h4 class="modal-title" id="standard-modalLabel">Tambah Mapping</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="<?php echo base_url('shopee/tambah_mapping') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Kolom Excel</label>
                            <input type="text" id="nama" class="form-control" name="kolom_excel" required>
                            <input type="hidden" class="form-control" name="id_list_shopee" value="<?php echo $table->id; ?>" required>
                            <input type="hidden" class="form-control" name="nama_table" value="<?php echo $table->nama_table; ?>" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Kolom Table</label>
                            <input type="text" id="nama_table" class="form-control" name="kolom_table" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Type</label>
                            <input type="text" class="form-control" name="type" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Length</label>
                            <input type="text" class="form-control" name="constraint" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Default</label>
                            <select class="form-control select2" data-toggle="select2" name="null" required>
                                <option value="">Pilih Default</option>
                                <option value="TRUE">TRUE</option>
                                <option value="FALSE">FALSE</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Auto Increment</label>
                            <select class="form-control select2" data-toggle="select2" name="auto_increment" required>
                                <option value="">Pilih Auto Increment</option>
                                <option value="TRUE">TRUE</option>
                                <option value="FALSE">FALSE</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Unsigned</label>
                            <select class="form-control select2" data-toggle="select2" name="unsigned" required>
                                <option value="">Pilih Unsigned</option>
                                <option value="TRUE">TRUE</option>
                                <option value="FALSE">FALSE</option>
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
    $(document).ready(function(){
        $('.select_atas').select2();
    });
    $(document).ready(function() {
        $('#nama').on('input', function() {
            var isi = $(this).val(); // ambil isi dari input1
            $('#nama_table').val(isi);   // isi ke input2
        });
    });

    $(document).on("click", "#btn_approve", function(e){
        var id = $(this).data("id");
        swal({
            title: "Apakah anda yakin ingin tambah table database ini ?",
            // text: "Data tidak dapat dikembalikan",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, approve",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm){
            if(isConfirm){
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?= base_url('shopee/change_add_table') ?>",
                    "method": "POST",
                    "data": {
                        "id": id
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

    $(document).on("click", "#btn_delete", function(e){
        var id = $(this).data("id");
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
                    "url": "<?= base_url('shopee/delete_mapping') ?>",
                    "method": "POST",
                    "data": {
                        "id": id
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
</script>