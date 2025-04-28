
    <!-- Start Content-->
         <!-- start page title -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboards</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="mb-1 position-relative">
                                    <label class="form-label">Startdate</label>
                                    <input type="text" id="startdate" name="startdate" class="form-control" value="<?php 
                                        if(isset($_GET['startdate']) && ! empty($_GET['startdate'])){
                                            echo date('Y-m-d', strtotime($_GET['startdate'])); 
                                        }else{
                                            echo date('Y-m-01'); 
                                        }
                                    ?>">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-1 position-relative">
                 
                                    <label class="form-label">Enddate</label>
                                    <input type="text" id="enddate" class="form-control" name="enddate" value="<?php 
                                        $enddate = "";
                                        if(isset($_GET['enddate']) && ! empty($_GET['enddate'])){
                                            echo date('Y-m-d', strtotime($_GET['enddate']));
                                            $enddate = date('Y-m-d', strtotime($_GET['enddate'])); 
                                        }else{
                                            echo date('Y-m-d'); 
                                            $enddate = date('Y-m-d'); 
                                        }
                                    ?>">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <button type="submit" style="margin-top: 29px; width: 130px;" class="btn btn-success" ><i class="bi bi-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- end card body-->
                </div>
                <!-- end card -->
            </div>
        </div>

    </div>
<!-- <?php echo "<pre>", print_r($laporan_apar, 1), "</pre>"; ?> -->
</div>
<script type="text/javascript">
$(document).ready(function(){
    

    $('#enddate').flatpickr({
        maxDate: '<?php echo date('Y-m-d', strtotime('+0 Day')); ?>'
    });

    $('#startdate').flatpickr({
        dateFormat: "Y-m-d",
        maxDate: '<?php echo date('Y-m-d', strtotime('+0 Day')); ?>'
    });



});


    $(document).ready(function(){
        $('#startdate').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            maxDate: '<?php echo date('Y-m-d', strtotime('+0 Day')); ?>'
        });
        $('#enddate').flatpickr({
            maxDate: '<?php echo date('Y-m-d', strtotime('+0 Day')); ?>'
        });
        $('#tambah_tanggal').flatpickr({
            maxDate: '<?php echo date('Y-m-d', strtotime('+0 Day')); ?>'
        });
    });
</script>
   