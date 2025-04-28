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
                            <li class="breadcrumb-item active">Shopee</li>
                        </ol>
                    </div>
                    <h2 class="page-title">Shopee</h2>
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
                            <div class="col-lg-6">
                                <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
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
                                    <th width="25%">Nama</th>
                                    <th width="25%">Nama Table</th>
                                    <th width="30%">Keterangan</th>
                                    <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
                                        <th width="15%"><center>Aksi</center></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                                <?php $i = 1;
                                foreach ($table as $k) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $k['nama']; ?></td>
                                        <td><?php echo $k['nama_table']; ?></td>
                                        <td><?php echo $k['keterangan']; ?></td>

                                        <?php if ($this->session->userdata('role') == "SUPERADMIN") { ?>
                                            <td>
                                                <center> 
                                                    <a href="#" class="text-reset fs-16 px-1" data-bs-toggle="modal" id="btn_edit_select" data-bs-target="#standard-modal_edit<?php echo $k['id']; ?>" data-id="<?=$k['id'];?>"> <i class="ri-edit-2-fill"></i></a>
                                                </center>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php $i++;
                                } ?>
                            <tbody>
                                
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
                <h4 class="modal-title" id="standard-modalLabel">Tambah Table</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="<?php echo base_url('shopee/tambah_table') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Nama Table</label>
                            <input type="text" id="nama_table" class="form-control" name="nama_table" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Keterangan</label>
                            <textarea type="text" rows="3" name="keterangan" class="form-control"></textarea>
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

<?php $i=1; foreach ($table as $k) { ?>
<div id="standard-modal_edit<?php echo $k['id']; ?>" class="modal fade" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit Table</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="<?php echo base_url('shopee/edit_table') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama<?php echo $k['id'] ?>" value="<?php echo $k['nama'] ?>" required>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $k['id'] ?>" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Nama Table</label>
                            <input type="text" class="form-control" name="nama_table" id="nama_table<?php echo $k['id'] ?>" value="<?php echo $k['nama_table'] ?>" required>
                        </div>
                        <div class="mb-1">
                            <label for="simpleinput" class="form-label">Keterangan</label>
                            <textarea type="text" rows="3" name="keterangan" class="form-control"><?php echo $k['keterangan']; ?></textarea>
                        </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="width: 80px;">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 80px;">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {
        $('#nama<?php echo $k['id'] ?>').on('input', function() {
            var isi = $(this).val(); // ambil isi dari input1
            $('#nama_table<?php echo $k['id'] ?>').val(isi);   // isi ke input2
        });
    });
</script>
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
    $(document).ready(function(){
        $('.select_atas').select2();
    });
    $(document).ready(function() {
        $('#nama').on('input', function() {
            var isi = $(this).val(); // ambil isi dari input1
            $('#nama_table').val(isi);   // isi ke input2
        });
    });
</script>