    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Active Leases</h1>
          </div>
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DHCP Config</li>
            </ol>
          </div>-->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">



            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Active DHCP Leases</h3>
                  <!--            <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>-->
              </div>



              <!-- /.card-header -->
              <div class="card-body">
                <table id="dhcp_leases" class="table table-striped table-hover">
                  <thead>
                  <tr>
                    <th>Lease expires</th>
                    <th>MAC Address</th>
                    <th>IP Address</th>
                    <th>Hostname</th>
                    <th>Client ID</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
foreach($dhcp_config['leases'] as $lease)
{
      echo "<tr>";
      echo "<td>" . date('Y-m-d H:i:s', $lease['expires']) . "</td>";
      echo "<td>" . $lease['mac'] . "</td>";
      echo "<td>" . $lease['ip'] . "</td>";
      echo "<td>" . $lease['hostname'] . "</td>";
      echo "<td>" . $lease['clientid'] . "</td>";
      echo "</tr>";
}
?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

















          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>



<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="additional-scripts/ip-address.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $('#dhcp_leases').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "order": [[2, "asc"]],
      "columnDefs": [
       { "type": "ip-address", targets: 2 }
     ],
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    });
  });
</script>
