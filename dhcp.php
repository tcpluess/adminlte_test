<?php


$dhcp_config = [
	'static_hosts' => [],
	'leases' => [],
	'range_start' => '',
	'range_end' => '',
	'subnet_mask' => '',
	'router' => '',
	'domain' => '',
	'lease_time' => '',
	'dns_servers' => [],
	'ntp_servers' => [],
];

 $handle = fopen("staticleases.txt", "r");
 if ($handle) {
     while (($line = fgets($handle)) !== false) {
         // process the line read.
       if(str_starts_with($line, "dhcp-host="))
       {
         $host = explode(",", substr($line, strlen("dhcp-host=")));
         if(count($host) != 3)
         {
           continue;
         }
         else
         {
         	
         	$myitem = ['mac' => $host[0], 'ip' => $host[1], 'hostname' => $host[2]];
         	array_push($dhcp_config['static_hosts'], $myitem);
         }

       }
 
     }
 
     fclose($handle);
 }


 //$handle = fopen("/var/lib/misc/dnsmasq.leases", "r");
$handle = fopen("leases.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
      $items = explode(" ", $line);
      if(count($items) != 5)
      {
        continue;
      }
      else
      {
				$myitem = ['expires' => $items[0], 'mac' => $items[1], 'ip' => $items[2], 'hostname' => $items[3], 'clientid' => $items[4]];
				array_push($dhcp_config['leases'], $myitem);
      }

    }

    fclose($handle);
}



 //$handle = fopen("/var/lib/misc/dnsmasq.leases", "r");
$handle = fopen("dhcp.conf", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

    	$str = "dhcp-range=";
    	if(str_starts_with($line, "dhcp-range="))
       {
         $items = explode(",", substr($line, strlen($str)));
         if(count($items) == 3)
         {
         	$dhcp_config['range_start'] = $items[0];
         	$dhcp_config['range_end'] = $items[1];
         	$dhcp_config['lease_time'] = $items[2];
         }
         continue;
        }

        $str = "dhcp-option=option:netmask,";
        if(str_starts_with($line, $str))
        {
        	$dhcp_config['subnet_mask']  = substr($line, strlen($str));
        	continue;
        }


        $str = "dhcp-option=option:router,";
        if(str_starts_with($line, $str))
        {
        	$dhcp_config['router']  = substr($line, strlen($str));
        	continue;
        }

        $str = "domain=";
        if(str_starts_with($line, $str))
        {
        	$dhcp_config['domain'] = substr($line, strlen($str));
        	continue;
        }


        $str = "dhcp-option=option:dns-server,";
        if(str_starts_with($line, $str))
        {
        	$items = explode(",", substr($line, strlen($str)));
        	foreach($items as $x)
        	{
        		array_push($dhcp_config['dns_servers'], $x);
        	}
        	continue;
        }


        $str = "dhcp-option=option:ntp-server,";
        if(str_starts_with($line, $str))
        {
        	$items = explode(",", substr($line, strlen($str)));
        	foreach($items as $x)
        	{
        		array_push($dhcp_config['ntp_servers'], $x);
        	}
        	continue;
        }


    }

    fclose($handle);
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  //$name = $_POST['fname'];
  //if (empty($name)) {
$update = false;
if($_POST['method'] == "add_static_host")
{
	$newitem = $_POST['data'];
	array_push($dhcp_config['static_hosts'], $newitem);
	$update = true;
}
else if($_POST['method'] == "remove_static_host")
{
	$mac = $_POST['data']['mac'];

	$newarr = [];

		foreach($dhcp_config['static_hosts'] as $dat)
		{
			if($dat['mac'] == $mac)
				continue;
			else
				array_push($newarr, $dat);
		}

		$dhcp_config['static_hosts'] = $newarr;

	$update = true;

}

if($update)
{
	$handle = fopen("staticleases.txt", "w");
	if($handle)
	{
		foreach($dhcp_config['static_hosts'] as $dat)
		{
			fprintf($handle, "dhcp-host=%s,%s,%s\n", trim($dat['mac']), trim($dat['ip']), trim($dat['hostname']));
			fflush($handle);
		}
	}
	fclose($handle);
}
}






if($section == "navigation")
{
?>

<li class="nav-item <?php if($item=="dhcp") echo "menu-open" ?>" >
  <a href="#" class="nav-link <?php if($item=="dhcp") echo "active"; ?>">
    <i class="nav-icon fas fa-network-wired"></i>
    <p>DHCP<i class="right fas fa-angle-left"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="?link=dhcp/config" class="nav-link <?php if($subitem=="config") echo "active"; ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Config</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="?link=dhcp/leases" class="nav-link <?php if($subitem=="leases") echo "active"; ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Active Leases</p>
      </a>
    </li>
  </ul>
</li>

<?php
}
else if($section == "content")
{















if($item == "dhcp")
{
	if($subitem == "config")
	{
			include("dhcp_config.php");
	}
	else if($subitem == "leases")
	{
			include("dhcp_leases.php");

	}
}
}
else if($section=="dashboard")
{
?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo count($dhcp_config['leases']) ?></h3>

                <p>Active DHCP leases</p>
              </div>
              <div class="icon">
                <i class="fas fa-network-wired"></i>
              </div>
            </div>
          </div>

<?php
}
?>
