    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DHCP Config</h1>
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
          <div class="col-6">







              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">General config</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Enable DHCPv4</label>
                  </div>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch2">Authoritative</label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputStart">Range start</label>
                    <input type="email" class="form-control" id="inputRangeStart" value="<?php echo $dhcp_config['range_start']; ?>" placeholder="192.168.1.100">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEnd">Range end</label>
                    <input type="email" class="form-control" id="inputRangeEnd" value="<?php echo $dhcp_config['range_end']; ?>" placeholder="192.168.1.200">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEnd">Subnet mask</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $dhcp_config['subnet_mask']; ?>" placeholder="/24 or 255.255.255.0">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEnd">Router</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $dhcp_config['router']; ?>" placeholder="192.168.1.1">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputStart">Domain</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $dhcp_config['domain']; ?>" placeholder="domain.com">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEnd">lease time</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $dhcp_config['lease_time']; ?>" placeholder="1h">
                  </div>

                  <div class="form-group">
                  <label>DNS Servers</label>
                  <select class="select2 tokenizer" multiple="multiple" data-placeholder="Enter DNS Servers" style="width: 100%;">
<?php
foreach($dhcp_config['dns_servers'] as $dns)
{
  echo '<option selected="selected" value="' . $dns . '">' . $dns . '</option>';
}
?>
                  </select>
                </div>

                <div class="form-group">
                  <label>NTP Servers</label>
                  <select class="select2 tokenizer" multiple="multiple" value="1.1.1.1" data-placeholder="Enter NTP Servers" style="width: 100%;">
<?php
foreach($dhcp_config['ntp_servers'] as $ntp)
{
  echo '<option selected="selected" value="' . $ntp . '">' . $ntp . '</option>';
}
?>
                  </select>
                </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Save</button>

                  <button type="submit" class="btn btn-danger">Reset</button>
                </div>
              </form>
            </div>








          </div>



          <div class="col-6">














            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Static DHCP Leases</h3>
                              <!--<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>-->
              </div>



              <!-- /.card-header -->
              <div class="card-body">
                <table id="static_dhcp_leases" class="table table-striped table-hover">
                  <thead>
                  <tr>
                    <th>MAC Address</th>
                    <th>IP Address</th>
                    <th>Hostname</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>


<?php
foreach($dhcp_config['static_hosts'] as $host){
          echo "<tr>";
         echo "<td>" . $host['mac'] . "</td>";
         echo "<td>" . $host['ip'] . "</td>";
         echo "<td>" . $host['hostname'] . "</td>";
?>
         <td><div class="btn-group btn-group-sm"><a href="#" class="btn btn-danger DeleteButton"><i class="fas fa-trash"></i></a></div></td>
<?php
         echo "</tr>";
}

?>
                  </tbody>
                  <tfoot>
<tr><td><input type="text" class="form-control" id="addMAC" placeholder="MAC Address"></td>
<td><input type="text" class="form-control" id="addIP" placeholder="IP Address"></td>
<td><input type="text" class="form-control" id="addHostname" placeholder="Hostname"></td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-success disabled" id="AddButton"><i class="fas fa-plus-square"></i></a>
                      </div>
                    </td>
</tr>
                  </tfoot>
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
    $('#static_dhcp_leases').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "order": [[1, "asc"]],
      "columnDefs": [
       { "type": "ip-address", "targets": 1 },
       {"orderable": false, "targets": 3},
       { "className": "text-right py-0 align-middle", "targets": [ 3 ] }
     ],
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    });
  });

  function validate()
  {
    var mac = $('#addMAC').val();
    var ip = $('#addIP').val();
    var host = $('#addHostname').val();
    var mac_ok = check_mac(mac);
    var ip_ok = check_ipv4(ip);
    var host_ok = check_hostname(host);

    if(mac_ok)
    {
      $("#addMAC").attr('class', 'form-control is-valid');
    }
    else
    {
      $("#addMAC").attr('class', 'form-control is-invalid');
    }

    if(ip_ok)
    {
      $("#addIP").attr('class', 'form-control is-valid');
    }
    else
    {
      $("#addIP").attr('class', 'form-control is-invalid');
    }

    if(host_ok)
    {
      $("#addHostname").attr('class', 'form-control is-valid');
    }
    else
    {
      $("#addHostname").attr('class', 'form-control is-invalid');
    }

    //if(mac_ok && ip_ok && host_ok)
    if(true)
    {
      $("#AddButton").attr('class', 'btn btn-success');
    }
    else
    {
      $("#AddButton").attr('class', 'btn btn-success disabled');
    }
  }

  $('#static_dhcp_leases').on('click', '.DeleteButton', function(e){
   e.preventDefault();

   let row = $(this).parents('tr');
   let mac = row.children().eq(0).text();

  var dat = {'method': 'remove_static_host', 'data': { 'mac': mac }};
   $.ajax({
   url: 'dhcp.php',
   type: 'POST',
   data: dat,
   success: function (response) 
   {

    row.remove();


   },
     error: function(xml, error) {
    console.log(error);
  }
     });




   



  });

  
  $('#addMAC').on('input',function(e){
    validate();
  });


  $('#addIP').on('input',function(e){
    validate();
  });

  $('#addHostname').on('input',function(e){
    validate();
  });

  $('#AddButton').click(function(e) {
    e.preventDefault();
    var mac = $('#addMAC').val();
    var ip = $('#addIP').val();
    var host = $('#addHostname').val();

    
    



   var dat = {'method': 'add_static_host', 'data': { 'mac': mac, 'ip': ip, 'hostname': host }};
     $.ajax({
   url: 'dhcp.php',
   type: 'POST',
   data: dat,
   success: function (response) 
   {



    const tbl = new DataTable('#static_dhcp_leases')
    var row = tbl.row.add([
      mac, ip, host, '<div class="btn-group btn-group-sm"><a href="#" class="btn btn-danger DeleteButton"><i class="fas fa-trash"></i></a></div>'
      ]).draw(false);
    /*body.append($('<tr>')
    .append($('<td>').append(mac))
    .append($('<td>').append(ip))
    .append($('<td>').append(host))
    .append($('<td class="text-right py-0 align-middle">')
      .append('<div class="btn-group btn-group-sm"><a href="#" class="btn btn-danger DeleteButton"><i class="fas fa-trash"></i></a></div>')));*/
    $('#addMAC').val('');
    $('#addIP').val('');
    $('#addHostname').val('');

    $("#addMAC").attr('class', 'form-control');
    $("#addIP").attr('class', 'form-control');
    $("#addHostname").attr('class', 'form-control');
    $("#AddButton").attr('class', 'btn btn-success disabled');




   },
     error: function(xml, error) {
    console.log(error);
  }
     });
});

</script>


<script>
    $(".tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' '],
    dropdownCss: {display:'none'},
    createTag: function (params) {
      // check if it is a valid ip.
      if(!checkIfValidIP(params.term))
      {
        return null;
      }

    return {
      id: params.term,
      text: params.term
    }
  }
})
</script>
