<?php
if($section == "navigation")
{
?>
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
<?php
}
else if($section=="content")
{
  if($item==null)
  {
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">

<?php

  $oldsection = $section;
  $section="dashboard";


$str   = @file_get_contents('/proc/uptime');
$num   = floatval($str);
$secs  = intval(fmod($num, 60)); $num = (int)($num / 60);
$mins  = $num % 60;      $num = (int)($num / 60);
$hours = $num % 24;      $num = (int)($num / 24);
$days  = $num;
$str = "";

if($secs > 0)
$str = $secs . "s";
if($mins > 0)
{
  if($secs > 0)
    $str = $mins . "min, " . $str;
  else
    $str = $mins . "min";
}
if($hours > 0)
{
  if($mins > 0)
    $str = $hours . "h, " . $str;
  else
    $str = $hourss . "min";
}
if($days > 0)
{
  if($hours > 0)
    $str = $days . "d, " . $str;
  else
    $str = $days . "d";
}

 $load = sys_getloadavg();
 if($load == false)
   $cpuload = "100";
 else
  $cpuload = intval($load[0] + 0.5);


$contents = file_get_contents('/proc/meminfo');
preg_match_all('/(\w+):\s+(\d+)\s/', $contents, $matches);
$meminfo = array_combine($matches[1], $matches[2]);

$mem_total = $meminfo["MemTotal"] / 1024;
$mem_free = $meminfo["MemFree"] / 1024;
$memusage = intval(100 * (($mem_total - $mem_free) / $mem_total));

?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $str; ?></h3>

                <p>Uptime</p>
              </div>
              <div class="icon">
                <i class="fas fa-clock"></i>
              </div>
            </div>
          </div>

         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $cpuload; ?><sup style="font-size: 20px">%</sup></h3>

                <p>CPU load</p>
              </div>
              <div class="icon">
                <i class="fas fa-microchip"></i>
              </div>
            </div>
          </div>



      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $memusage ?><sup style="font-size: 20px">%</sup></h3>

                <p>Memory usage</p>
              </div>
              <div class="icon">
                <i class="fas fa-memory"></i>
              </div>
            </div>
          </div>
<?php





  include("dhcp.php");
  $section = $oldsection;
  ?>


         </div>
       </div>
    </section>
<?php 
}
}
?>   
