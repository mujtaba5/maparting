<?php 
$this->load->view('layouts/header'); ?>
 <script src="<?=base_url();?>/vendor_components/ThreeBox/threebox.js" type="text/javascript"></script>
 <link href="<?=base_url();?>/vendor_components/ThreeBox/threebox.css" rel="stylesheet" />

<style>
  .margin-top{
      margin-top:10px;
  }

  .custom-hr{
    width: 105%;
  }

  .position-absolute{
    position:absolute !important;
  }
  .position-relative{
    position:relative;
  }

  .margin-bottom-0{
    bottom:0 !important;
  }

  .Hide{
    display:none !important;
  }

  #content{
    background:#f3f3f3 !important;
    /* background:#e8f1f1 !important; */
  }

  .mapboxgl-ctrl-bottom-left, .mapboxgl-ctrl-bottom-right, .mapboxgl-ctrl-top-left, .mapboxgl-ctrl-top-right {
        position:relative !important;
  }

  .pt-3{
    top:0 !important;
    bottom: auto !important;
    height: 15%;

  }

  .pt-3 {
    top: 0 !important;
    bottom: auto !important;
    height: 15%;
  }
</style>
    <div class="wrapper d-flex align-items-stretch">

      <!-- <form onsubmit="generateMap(); return false;" id="config"> -->
      
          <nav id="sidebar" class="position-relative">
            <div>
              <div class="sidebar_style">
                <h6 class="h1_style">Create your Map Art poster!</h6>
                <p class="p_style">Change artwork, labels and appearance</p>
              </div>
              <form id="config">
                <fieldset id="config-fields">
                <div class="col-md-10">
                  <ul class="list-unstyled components mb-5 p-2 ">
                  
                    
                    
                  <li>
                      <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_title"
                        onclick="myFunction('Demo99')">Route</a>
                      <ul class="collapse list-unstyled" id="homeSubmenu1">
                        <li>
                        <div id="Demo99" class="w3-hide">
                            <form id="frm" name="frm" action="<?php echo base_url(); ?>upload-Gpx-File/" method="post" 
                            enctype="multipart/form-data" autocomplete="off">
                            <br>
                            <div class="form form-control row col-md-12 margin-top" style="display: inline;background:none;border:none;">
                              <label>  Upload Track : </label>
                                <input type="file" name="file" id="gpxFile" accept=".gpx">
                            </div>
                              <br>
                              <div class="form form-control row col-md-10 margin-top" style="display: inline;background:none;border:none;">
                              <input type="button" class="btn btn-primary btn-md uploadGpx margin-top" value="upload .GPX" >
                              </div>
                            </form>
                        </div>
                            
                  
                        </li>
                      </ul>
                   
                    </li>


                    <li >
                      <a href="#ViewOfMap" data-toggle="collapse" aria-expanded="false" onclick="myFunction('Demo98')" class="dropdown-toggle main_title"
                        >Map Style</a>
                        <div id="Demo98" class="w3-hide ">
                          <ul class="collapse list-unstyled" id="ViewOfMap" >
                            <li >
                              <div class="row col-lg-12" style="border-bottom: 0px solid #eee !important;">
                                
                                <div class="col-lg-12 p-2" >
                                  <a class="w3-button w3-block rm_border-bottom" style="background-color:lightpurple;">
                                    <p class="dimension_box" onclick="changingModesOfMap('2D');">
                                    View from the Sky(2D)</p>
                                  </a>
                                </div>
                                <div class="col-lg-12 p-2" >
                                  <a class="w3-button w3-block rm_border-bottom">
                                    <p class="dimension_box" onclick="changingModesOfMap('3D');"><span>
                                    View in Relief (3D)
                                    </span></p>
                                  </a>
                                </div>
                               
                               
                                
                              </div>
                            </li>
                          </ul>
                        </div>
                      
                    </li>

                    <li>
                      <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_title"
                        onclick="myFunction('Demo1')">Map colors </a>
                      <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                          <div id="Demo1" class="w3-hide">
                          <div class="row p-2">
                              <div class="col-lg-4 Hide" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/monochrome-navy-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/navy.png" height="20%" width="65%"
                                    style=" border: 2px solid navy;" />
                                  <p class="p-1"><strong>Blue</strong> </p>
                                </a>

                              </div>
                            
                              <div class="col-lg-4 Hide" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/monochrome-golden-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/golden.png" height="20%" width="65%"
                                    style=" border: 2px solid goldenrod;" />
                                  <p class="p-1"><strong>Golden</strong> </p>
                                </a>
                              </div>
                              <div class="col-lg-4 Hide" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/monochrome-purple-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/purple.png" height="20%" width="65%"
                                    style=" border: 2px solid pink" />
                                  <p class="p-1"><strong>Pink</strong> </p>
                                </a>

                              </div>
                              <div class="col-lg-4 Hide" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/monochrome-red-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/red.png" height="20%" width="65%"
                                    style=" border: 2px solid darkred" />
                                  <p class="p-1"><strong>Red</strong> </p>
                                </a>
                              </div>
                              <div class="col-lg-4 Hide" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/monochrome-green-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/green.png" height="20%" width="65%"
                                    style=" border: 2px solid green" />
                                  <p class="p-1"><strong>Green</strong> </p>
                                </a>
                              </div>
                              <div class="col-lg-4 Hide" align="center" >
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/monochrome-dark-purple-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/dark-purple.png" height="30%" width="65%"
                                    style=" border: 2px solid purple" />
                                  <p class="p-1"><strong>Purple</strong> </p>
                                </a>
                              </div> 
                              <div class="col-lg-4" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/outdoor-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/outdoor_red.png" height="20%" width="65%"
                                    style=" border: 2px solid darkred" />
                                    <p class="p-1"><strong style="white-space: break-spaces;word-break: break-word;">Outdoor (Red)</strong> </p>
                                </a>
                              </div>
                              <div class="col-lg-4" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/outdoor-grey-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/grey.png" height="30%" width="65%"
                                    style=" border: 2px solid darkgray" />
                                  <p class="p-1"><strong style="white-space: break-spaces;word-break: break-word;">Outdoor (Gray)</strong> </p>
                                </a>
                              </div>
                              <div class="col-lg-4" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/outdoor-green-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/outdoor_green.png" height="30%" width="65%"
                                    style=" border: 2px solid green" />
                                  <p class="p-1"><strong style="white-space: break-spaces;word-break: break-word;">Outdoor (Green)</strong> </p>
                                </a>
                              </div>
                              <div class="col-lg-4" align="center">
                                <a class="w3-button mapimage_style"
                                  onclick="changeStyle('<?=base_url();?>styles/black-and-white-style.json')">
                                  <img class="image_style" src="<?=base_url();?>images/black_white.png" height="30%" width="65%"
                                    style=" border: 2px solid black;" />
                                  <p class="p-1"><strong style="white-space: break-spaces;word-break: break-word;">Black & White</strong> </p>
                                </a>
                              </div>
                              
                              <span class="p-2" style="font-size: 13px;color: rgba(76,89,106,.5);margin: 0;line-height: 1.4;display:none;">
                              </span>
                            </div>
                               </div>
                        </li>
                      </ul>
                      <ul class="collapse list-unstyled" id="homeSubmenu">
                        <select id="styleSelect" class="form-control" style="display: none;">
                          <option value="<?=base_url();?>styles/basic-style.json">Klokantech Basic</option>
                          <option value="<?=base_url();?>styles/monochrome-navy-style.json">Mapbox Monochrome Sky</option>
                          <option value="<?=base_url();?>styles/monochrome-golden-style.json">Mapbox Monochrome Golden</option>
                          <option value="<?=base_url();?>styles/monochrome-purple-style.json">Mapbox Monochrome Pink</option>
                          <option value="<?=base_url();?>styles/monochrome-red-style.json">Mapbox Monochrome Dark</option>
                          <option value="<?=base_url();?>styles/monochrome-dark-purple-style.json">Mapbox Basic</option>
                          <option value="<?=base_url();?>styles/monochrome-green-style.json">Mapbox Green</option>
                          <option value="<?=base_url();?>styles/outdoor-style.json">Mapbox Green</option>
                          <option value="mapbox://styles/decorsnap/cl9fdl53n00el14pij9skgxsk">Mapbox Green</option>
                          <option value="<?=base_url();?>styles/outdoor-grey-style.json">Mapbox Green</option>
                          <option value="<?=base_url();?>styles/outdoor-green-style.json">Mapbox Green</option>
                          <option value="<?=base_url();?>styles/black-and-white-style.json">Mapbox Green</option>
                          <option value="https://api.maptiler.com/maps/bright/style.json">Klokantech Bright</option>
                          <option value="https://api.maptiler.com/maps/darkmatter/style.json">Klokantech Dark Matter
                          </option>
                          <option value="https://api.maptiler.com/maps/pastel/style.json">Klokantech Pastel</option>
                          <option value="https://api.maptiler.com/maps/positron/style.json">Klokantech Positron</option>
                          <option value="https://api.maptiler.com/maps/streets/style.json">Klokantech Streets</option>
                          <option value="https://api.maptiler.com/maps/toner/style.json">Klokantech Toner</option>
                          <option value="https://api.maptiler.com/maps/topo/style.json">Klokantech Topo</option>
                          <option value="https://api.maptiler.com/maps/topographique/style.json">Klokantech Topographique
                          </option>
                          <option value="https://api.maptiler.com/maps/voyager/style.json">Klokantech Voyager</option>
                        </select>
                      </ul>
                    </li>
                    <li hidden>
                      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Zoom
                        Levels</a>
                      <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                          <input type="text" class="form-control" id="zoomInput" autocomplete="off" value="">
                        </li>

                      </ul>
                    </li>

                    <li >
                      <a href="#Units" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                      style="display: none;" >Units</a>
                      <ul class="collapse list-unstyled" id="Units">
                        <li>
                          <div class="form-group">
                            <label class="radio-inline">
                              <input type="radio" name="unitOptions" value="in" id="inUnit" checked> Inch
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="unitOptions" value="mm" id="mmUnit"> Millimeter
                            </label>
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li >
                      <a href="#Frames" data-toggle="collapse" aria-expanded="false" onclick="myFunction('Demo3')" class="dropdown-toggle main_title"
                        >Frames</a>
                        <div id="Demo3" class="w3-hide ">
                          <ul class="collapse list-unstyled" id="Frames" >
                            <li >
                              <div class="row col-lg-12" style="border-bottom: 0px solid #eee !important;">
                                <div class="col-lg-4 p-2 Hide" >
                                  <a class="w3-button w3-block rm_border-bottom">
                                    <p  class="dimension_box active" onclick="classToAdd('customName_bottom_blur mapboxgl-ctrl-bottom-left pt-3')">Smooth</p>
                                  </a>
                                </div>
                                <div class="col-lg-4 p-2 Hide" >
                                  <a class="w3-button w3-block rm_border-bottom">
                                    <p  class="dimension_box " onclick="classToAdd('customName_bottom_modern mapboxgl-ctrl-bottom-left pt-3')">Modern</p>
                                  </a>
                                </div>
                                
                                <div class="col-lg-4 p-2 Hide" >
                                  <a class="w3-button w3-block rm_border-bottom">
                                    <p class="dimension_box" onclick="classToAdd('customName_Nara mapboxgl-ctrl-bottom-left pt-3')">Nara</p>
                                  </a>
                                </div>
                                <div class="col-lg-4 p-2 Hide" >
                                  <a class="w3-button w3-block rm_border-bottom">
                                    <p class="dimension_box" onclick="classToAdd('customName_Playroom mapboxgl-ctrl-bottom-left pt-3')">PlayRoom</p>
                                  </a>
                                </div>
                                <div class="col-lg-6 p-2" >
                                  <a class="w3-button w3-block rm_border-bottom" style="background-color:lightpurple;">
                                    <p class="dimension_box" onclick="classToAdd('customName_bottom mapboxgl-ctrl-bottom-left pt-3')">Simple Way</p>
                                  </a>
                                </div>
                                <div class="col-lg-6 p-2" >
                                  <a class="w3-button w3-block rm_border-bottom">
                                    <p class="dimension_box" onclick="classToAdd('customName_Velentine mapboxgl-ctrl-bottom-left pt-3')"><span>Grid</span></p>
                                  </a>
                                </div>
                                <div class="col-lg-4 p-2 Hide" >
                                  <a class="w3-button w3-block rm_border-bottom" >
                                    <p class="dimension_box" onclick="classToAdd('customName_Legend mapboxgl-ctrl-bottom-left pt-3')"><span>Legend</span></p>
                                  </a>
                                </div>
                               
                                
                              </div>
                            </li>
                          </ul>
                        </div>
                      
                    </li>
                    <li >
                      <a href="#Dimensions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_title Hide"
                        onclick="myFunction('Demo2')">Dimensions</a>
                      <div id="Demo2" class="w3-hide ">
                        <span class="lable">Select poster size</span>
                        <div class="row" style="border-bottom: 0px solid #eee !important;">
                          <div class="col-lg-4 pt-2 " align="center"  style="border-bottom: 0px solid #eee !important;">
                            <a class="w3-button w3-block rm_border-bottom" onclick="changeDimension('6.2', '4.2')" >
                              <p class="dimension_box active pb-2 pt-2" >10 x 15</p>
                            </a>
                          </div>
                          <div class="col-lg-4 pt-2" align="center">
                            <a class="w3-button w3-block rm_border-bottom" onclick="changeDimension('6.8','4.7')">
                              <p class="dimension_box pb-2 pt-2 ">18 x 24</p>
                            </a>
                          </div>
                          <div class="col-lg-4 pt-2" align="center">
                            <a class="w3-button w3-block rm_border-bottom" onclick="changeDimension('7', '5')">
                              <p class="dimension_box pb-2 pt-2" >24 x 36</p>
                            </a>
                          </div>
                          
                        </div>
                        <span class="underLine">Switch size standards <strong>CM (EU)</strong> Inch (US)</span>
                        <br>
                        <div class="pt-2">
                        <span class="lable">Select orientation</span>
                        <div class="row ">
                          <div class="col-lg-6 pt-2" align="center">
                            <a  class="w3-button rm_border-bottom" onclick="changeDimension('6.2', '4.2')">
                              <p class="potrait_box pb-2 pt-2 active" >Potrait</p>
                            </a>
                          </div>
                          <div class="col-lg-6 pt-2" align="center">
                            <a  class="w3-button w3-block rm_border-bottom" onclick="changeDimension('6', '9')">
                              <p class="potrait_box pb-2 pt-2 " >Landscape</p>
                            </a>
                          </div>
                        </div>
                      </div>
                        <ul class="collapse list-unstyled" id="Dimensions" style="display: none;">
                          <li>

                            <div class="form-group" id="widthGroup">
                              <label for="widthInput">Width</label>
                              <input type="text" class="form-control" id="widthInput" autocomplete="off" value="4">
                            </div>
                            <div class="form-group" id="heightGroup">
                              <label for="heightInput">Height</label>
                              <input type="text" class="form-control" id="heightInput" autocomplete="off" value="5">
                            </div>

                          </li>
                        </ul>
                    </li>
                    <li hidden>
                      <a href="#DPI" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">DPI(Display Per
                        Inch)</a>
                      <ul class="collapse list-unstyled" id="DPI">
                        <li>
                          <div class="form-group" id="dpiGroup">
                            <label for="dpiInput">DPI</label>
                            <input type="text" class="form-control" id="dpiInput" autocomplete="off" value="300">
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li >
                      <a href="#Custom" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle main_title">Customize the headers</a>
                      <ul class="collapse list-unstyled" id="Custom">
                        <li>
                          <div class="input-group mb-3">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">Headline</span>
                            </div>
                            <input type="text" class="form-control" placeholder="New York i.e" id="headerInput" onchange="textchanged()" value="Paris">
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">Divider</span>
                            </div>
                            <input type="text" class="form-control" id="headerInput2" placeholder="United States i.e" value="France" onchange="textchanged2()">
                          </div>
                          <div class="input-group mb-3" id="latGroup">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">Latitude</span>
                            </div>
                            <input type="text" class="form-control" id="latInput" autocomplete="off" value="">
                          </div>
                          <div class="input-group mb-3" id="lonGroup">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">Longitude</span>
                            </div>
                            <input type="text" class="form-control" id="lonInput" autocomplete="off" value="">
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li style="margin-bottom:20px;">
                      <!-- <form id="frm" name="frm" action="<?php echo base_url(); ?>upload-Gpx-File/" method="post" 
                        enctype="multipart/form-data" autocomplete="off">
                        <br>
                        <div class="form form-control row col-md-12 margin-top" style="display: inline;background:none;border:none;">
                           <label>  Upload Track : </label>
                            <input type="file" name="file" id="gpxFile" accept=".gpx">
                        </div>
                          <br>
                          <div class="form form-control row col-md-10 margin-top" style="display: inline;background:none;border:none;">
                          <input type="button" class="btn btn-primary btn-md uploadGpx margin-top" value="upload .GPX" >
                          </div>
                        </form> -->
                        <!-- <hr> -->
                    </li>
                    <li>
                    
                        <!-- <form id="frm" name="frm" action="<?php echo base_url(); ?>upload-Gpx-File/" method="post" 
                            enctype="multipart/form-data" autocomplete="off">
                            <br>
                            <div class="form-group">
                              <label for="gpxFile">GPX File:</label>
                              <input type="file" class="form-control" name="file" id="gpxFile" accept=".gpx" aria-describedby="">
                            </div>
                            <input type="submit" class="btn btn-success" value="Upload .GPX">
                        </form> -->
                    
                        <hr class="custom-hr">

                        <!-- <form id="frm" name="frm" action="<?php echo base_url(); ?>upload-Gpx-File/" method="post"  -->
                            <!-- enctype="multipart/form-data" autocomplete="off"> -->
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" class="form-control" name="userEmail" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                      
                            <button type="button" class="btn btn-primary" id="generate-btn" >Generate Map</button>
                        
                        <!-- </form> -->
                    
                        <hr class="custom-hr">   
                        <!-- <div id="spinner"></div> -->
                    </li>
                    
                  </ul>
                 
                </div>
                </fieldset>
              </form>

           
<br>
              <!-- <button type="button" class="btn btn-primary uplodGpx">Click me</button> -->
             
            </div>
            <div class="copyright_style position-absolute margin-bottom-0">
                      <a class="copyright_text"> @Copyright and attribution information</a>
                    </div>
                    <a id="downloadLink" href="" download="map.png" style="display:none;">Download ↓</a>

          </nav>
      <!-- </form> -->
      </fieldset>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
      <div class="">
      <div
        class=" row align-items-center bg-success text-light"
        style="height:200px">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <h1>GeeksforGeeks</h1>
        </div>
      </div>
    </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <!-- <div class="panel-heading">
                <h3 class="panel-title">Map</h3>
              </div> -->
              <div class="panel-body map-container">
                <div class="test-shadow">
                <div id="map" class="row">
                  <div id="mainFrame" class="col-md-12 mapboxgl-ctrl-bottom-left customName_bottom_blur pt-3" align="center">
                    <p id="frameText" class="font_style mb-0" >Lahore</p>
                    <p id="frameText2" class="font_style_subheading mt-0 mb-0 font-color" ><strong id="frametext2-strong">Punjab</strong></p>
                    <p class="mt-0 font-color" id="latLong_p">
                     N36º05'18" W95º55'27"</p>
                  </div>
                  <div id="mainFrame" class="col-md-6 mapboxgl-ctrl-bottom-left align-items-center customName_bottom_blur pt-3" align="center">
                  <p id="frameText" class="sub_font_style mb-0" ><b>Lahore</b></p>
                    <p class="mb-0 font-color sub_font_style subhead_sub" id="latLong_p">
                     <b>N36º05'18" W95º55'27" </b></p>
                  </div>
                </div>
                  <!-- <div class="mapboxgl-ctrl-bottom-left customName_bottom_border " >
                    <span style="color:black" class="style">Gujranwala</span>
                    <span style="color:black" class="style">Pakistan</span>
                    <p class="style">N36º05'18" W95º55'27"</p>
                  </div>
                  <div class="mapboxgl-ctrl-bottom-left customName_bottom pt-3" align="center">
                    <h6>Gujranwala</h6>
                    <p >N36º05'18" W95º55'27"</p>
                  </div> -->
                </div>
              </div>
              <div style="display: none" id="test"></div>
              <div style="display: none" id="dumb"></div>
              <img style="display: none" id="pp">
              <img id="final">
              <canvas style="display: none" id="myCanvas"></canvas>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="panel-body" id="openmaptiles-attribution" style="display: none !important;">
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $this->load->view('layouts/footer'); ?>
  
    <!-- <script type="text/javascript" src="<?=base_url();?>/vendor_components/html2canvas/canvas2image.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?=base_url();?>/vendor_components/html2canvas/html2canvas.js"></script> -->
    <!-- <script type="text/javascript" src="<?=base_url();?>/vendor_components/html2canvas/html2canvas.min.js"></script> -->
    <script>
        HTMLCanvasElement.prototype.getContext = function(origFn) {
          return function(type, attribs) {
            attribs = attribs || {};
            attribs.preserveDrawingBuffer = true;
            return origFn.call(this, type, attribs);
          };
        }(HTMLCanvasElement.prototype.getContext);
</script>


<script>


class Dimension {
    target = new Target();
}
class Target {
    value;
}

var tempblob;
mapboxgl.accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
var Token = 'pk.eyJ1IjoibXViYXNoaXJnaXMiLCJhIjoiY2tpZWNpbTU3MXJwczJ5bnh4MDI1ZW9mNyJ9.iBdeAqhocxhiDp1ClwUzhw';
var mapTilerAccessToken = 'GMfNDVh2V7amAI8sEfUx';
var form = document.getElementById('config');
var base_url= '<?=base_url();?>';

// ERRORS
var errors = {
    width: {
        state: false,
        msg: 'Width must be a positive number!',
        grp: 'widthGroup'
    },
    height: {
        state: false,
        grp: 'heightGroup'
    },
    dpi: {
        state: false,
        msg: 'DPI must be a positive number!',
        grp: 'dpiGroup'
    }
};


try {

    if (!mapboxgl.accessToken || mapboxgl.accessToken.length < 10) {
        // Don't use Mapbox style without access token
        for (var i = form.styleSelect.length - 1; i >= 0; i--) {
            if (form.styleSelect[i].value.indexOf('mapbox') >= 0) {
                form.styleSelect.remove(i);
            }
        }
    }
    if (!mapTilerAccessToken || mapTilerAccessToken.length < 10) {
        // Don't use MapTiler styles without access token
        for (var i = form.styleSelect.length - 1; i >= 0; i--) {
            if (form.styleSelect[i].value.indexOf('tilehosting') >= 0) {
                form.styleSelect.remove(i);
            }
        }
    }

    // Show attribution requirement of initial style
    if (form.styleSelect.value.indexOf('mapbox') >= 0) {
        document.getElementById('mapbox-attribution').style.display = 'block';
    } else {
        document.getElementById('openmaptiles-attribution').style.display = 'block';
    }

    ////////
    function changeStyle(_style) {
        form.styleSelect.value = _style;
        changeMapStyle();
    }

    function changeDimension(_height, _width) {
        //document.getElementById('heightInput').value = _height;
        //document.getElementById('widthInput').value = _width;

        var dimension = new Dimension();
        var targetValue = new Target();
        targetValue.value = _width;
        dimension.target = targetValue;
        changeWidth(dimension);

        targetValue.value = _height;
        dimension.target = targetValue;
        changeHeight(dimension);

        // dimension.target.value = _width;
        // changeWidth(dimension);
    }

    function textchanged() {
        var headerText = document.getElementById('headerInput').value;

        document.getElementById('frameText').innerHTML = headerText;
    }

    function textchanged2() {
        var headerText = document.getElementById('headerInput2').value;

        document.getElementById('frameText2').innerHTML = headerText;
    }

    function classToAdd(value) {
        document.getElementById('mainFrame').className = value;
    }

    //
    // Interactive map
    //

    function updateLocationInputs() {
        var center = map.getCenter().toArray();

        var zoom = parseFloat(map.getZoom()).toFixed(2),
            lat = parseFloat(center[1]).toFixed(4),
            lon = parseFloat(center[0]).toFixed(4);
        form.zoomInput.value = zoom;
        form.latInput.value = lat;
        form.lonInput.value = lon;
    }

    var style = form.styleSelect.value;
    console.log(style);
    if (style.indexOf('maptiler') >= 0)
        style += '?key=' + mapTilerAccessToken;
        // style='mapbox://styles/mapbox/streets-v11';
        const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: style,
        zoom: 12.5,
        // pitch: 95,
        // bearing: -17.6,
        container: 'map',
        antialias: true
   });

    map.on('style.load', function() {
        map.on('click', function(e) {
            var coordinates = e.lngLat;
            new mapboxgl.Popup()
                .setLngLat(coordinates)
                .setHTML('Coordinates: <br/>' + coordinates)
                .addTo(map);
        });


      // --------------For adding 3D model in map (Might be helpful onwards)----------
        // map.addLayer({
        //     id: 'custom_layer',
        //     type: 'custom',
        //     renderingMode: '3d',
        //     onAdd: function (map, mbxContext) {

        //         window.tb = new Threebox(
        //             map,
        //             mbxContext,
        //             { defaultLights: true }
        //         );

        //         var options = {
        //             obj: '<?=base_url();?>/vendor_components/3D/soldier.glb',
        //             type: 'gltf',
        //             scale: 1,
        //             units: 'meters',
        //             rotation: { x: 90, y: 0, z: 0 } //default rotation
        //         }

        //         tb.loadObj(options, function (model) {
        //           console.log(origin);
        //             soldier = model.setCoords(origin);
        //             tb.add(soldier);
        //         })

        //     },
        //     render: function (gl, matrix) {
        //         tb.update();
        //     }
        // });
              // --------------For adding 3D model in map (Might be helpful onwards)----------



    });

    $('#downloadLink').click(function() {
      console.log('here');
            var img = map.getCanvas().toDataURL('image/png')
            this.href = img
    });


    function addTerrain(map){
      if(!map.getSource('mapbox-dem')){
        // map.removeSource('mapbox-dem');
    
        // Add daytime fog
        //  map.setFog({
        //             'range': [-1, 1],
        //             'horizon-blend': 0.01,
        //             'color': 'white',
        //             'high-color': '#add8e6',
        //             'space-color': '#d8f2ff',
        //             'star-intensity': 0.0
        //         });

        // Add some 3D terrain
        map.addSource('mapbox-dem', {
            'type': 'raster-dem',
            'url': 'mapbox://mapbox.terrain-rgb',
            // 'tileSize': 512,
            'maxzoom': 5
        });
        map.setTerrain({
            'source': 'mapbox-dem',
            'exaggeration': 1.5
        });
      }
    }
    // adding 3D or 2D effect on map
    function changingModesOfMap(modeValue){

      if(modeValue === '3D'){
        calling3DModels();
        addTerrain(map);
        map.setPitch(75);
        map.setBearing(80);
      }else{
        map.setPitch(0);
        map.setBearing(0);
      }

    }


    // for search on map
    const geocoder = 
        new MapboxGeocoder({
            accessToken: Token,
            mapboxgl: mapboxgl
        });
    
    map.addControl(geocoder);

  // / After the map style has loaded on the page,
  // add a source layer and default styling for a single point
  map.on('load', () => {
        // Add an image to use as a custom marker
        map.loadImage(
            'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
            (error, image) => {
                if (error) throw error;
                map.addImage('custom-marker', image);
                // Add a GeoJSON source with 2 points
                map.addSource('points', {
                    'type': 'geojson',
                    'data': {
                        'type': 'FeatureCollection',
                        'features': []
                            
                    }
                });

                // Add a symbol layer
                map.addLayer({
                    'id': 'points-layer',
                    'type': 'symbol',
                    'source': 'points',
                    'layout': {
                        'icon-image': 'custom-marker',
                        // get the title name from the source's "title" property
                        'text-field': ['get', 'title'],
                        'text-font': [
                            'Open Sans Semibold',
                            'Arial Unicode MS Bold'
                        ],
                        'text-offset': [0, 1.25],
                        'text-anchor': 'top'
                    }
                });
            }
        );

        // calling3DModels();


    // Listen for the `result` event from the Geocoder
    // `result` event is triggered when a user makes a selection
    //  Add a marker at the result's coordinates
    geocoder.on('result', (event) => {
      map.getSource('points').setData(event.result.geometry);
      if(event.result.geometry){
        if(event.result.geometry.coordinates){
          longitudeVal= event.result.geometry.coordinates[0];
          latitudeVal = event.result.geometry.coordinates[1];
          getPlaceByCoordinates(longitudeVal,latitudeVal)

        }
      }
    });
  });

  


  // adding 3d Models on map
  function calling3DModels(){
    return true;
    if(map.getLayer('add-3d-buildings')){
        map.removeLayer('add-3d-buildings');
    }

      const layers = map.getStyle().layers;
        const labelLayerId = layers.find(
            (layer) => layer.type === 'symbol' && layer.layout['text-field']
        ).id;

        // The 'building' layer in the Mapbox Streets
        // vector tileset contains building height data
        // from OpenStreetMap.
        map.addLayer(
            {
                'id': 'add-3d-buildings',
                'source': 'composite',
                'source-layer': 'building',
                'filter': ['==', 'extrude', 'true'],
                'type': 'fill-extrusion',
                'minzoom': 12,
                'paint': {
                    'fill-extrusion-color': '#aaa',

                    // Use an 'interpolate' expression to
                    // add a smooth transition effect to
                    // the buildings as the user zooms in.
                    'fill-extrusion-height': [
                        'interpolate',
                        ['linear'],
                        ['zoom'],
                        15,
                        0,
                        15.05,
                        ['get', 'height']
                    ],
                    'fill-extrusion-base': [
                        'interpolate',
                        ['linear'],
                        ['zoom'],
                        15,
                        0,
                        15.05,
                        ['get', 'min_height']
                    ],
                    'fill-extrusion-opacity': 0.6
                }
            },
            labelLayerId
        );
    }

    // for navigation on map
    map.addControl(new mapboxgl.NavigationControl());

    // for zoom in to location
    map.on('moveend', updateLocationInputs).on('zoomend', updateLocationInputs);
    updateLocationInputs();


    // for loading map with coordinates
    map.on('load', () => {
       
        map.addSource('route', {
            'type': 'geojson',
            'data': {
              'type': 'FeatureCollection',
              'features': [
               {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'LineString',
                    'coordinates': []
                            }
                }
              ]

            }
        });
        map.addLayer({
            'id': 'route-layer',
            'type': 'line',
            'source': 'route',
            'layout': {
                'line-join': 'round',
                'line-cap': 'round'
            },
            'paint': {
                'line-color': 'darkgray',
                'line-width': 8
            }
        });

     });



    //
    // Geolocation
    //

    if ('geolocation' in navigator) {
        //  ----------------navigate to your current location ---------------
        navigator.geolocation.getCurrentPosition(function(position) {
            'use strict';
            map.flyTo({
                // center: [position.coords.longitude,
                //     position.coords.latitude
                // ],
                center: [-74.0066, 40.7135],

                zoom: 8
            });
            getPlaceByCoordinates(position.coords.longitude,position.coords.latitude);
        });
    }


    $(document).ready(function(e) {

        $(".uploadGpx").on('click', (function(e) {
            e.preventDefault();
           

            forms = $(this).closest('form')[0];
            var formData = new FormData(forms);

            if (document.getElementById("gpxFile").files.length == 0) {
                swal("Error!", 'Please select file!', "error");
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>upload-Gpx-File/",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    // dataType: 'json',
                    beforeSend: function() {
                        //$("#preview").fadeOut();
                        // $("#err").fadeOut();
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.coordinates) {

                            allcoordinates = data.coordinates;
                            // console.log(map);

                            var feature = map.getSource('route')._options.data;

                            updateRoute(allcoordinates);
                      
                        } else {
                            // does not exist any coordinates
                            swal("Error!", 'Data doesnt exist!', "error");
                        }
                    },
                    error: function(e) {

                    }
                });
            }
        }));

        function updateRoute(routeJSON, updateLayers = true) {

              // geoJSONData
              geoJSONData= {
              'type': 'FeatureCollection',
              'features': [
                {
                    'type': 'Feature',
                    'geometry': {
                    'type': 'LineString',
                    'coordinates': routeJSON
                    }
              }]
              };
          
            map.getSource("route").setData(geoJSONData);

            if (map.getLayer('my-route-layer') || updateLayers) {
                  // remove the previous version of layer
                  if (map.getLayer('route-layer')) {
                    map.removeLayer('route-layer');
                  }
                  map.addLayer({
                          'id': 'route-layer',
                          'type': 'line',
                          'source': 'route',
                          'layout': {
                              'line-join': 'round',
                              'line-cap': 'round'
                          },
                          'paint': {
                              'line-color': 'darkgray',
                              'line-width': 4
                          }
                      });
            }

            // Fly the map to the location.
            map.flyTo({
            center: routeJSON[0],
            speed : 0.8,
            'zoom': 10
            });

            getPlaceByCoordinates(routeJSON[0][0],routeJSON[0][1]);
            // map.jumpTo({ 'center': routeJSON[0], 'zoom': 10 });

            if (map.getLayer('route-layer') || updateLayers) {
                // remove the previous version of layer
                if (map.getLayer('route-layer')) {
                    map.removeLayer('route-layer');
                }

                map.addLayer({
                    'id': 'route-layer',
                    'type': 'line',
                    'source': 'route',
                    'layout': {
                        'line-join': 'round',
                        'line-cap': 'round'
                    },
                    'paint': {
                        'line-color': 'darkgray',
                        'line-width': 4
                    }
                });
            }
          
            // reset form
            setTimeout(() => {
                resetUploadGpxForm();
            },700);

        }

        


    });

    function resetUploadGpxForm(){
      document.getElementById('gpxFile').value=''
      $("#gpxFile").val('');
    }

    function getPlaceByCoordinates(longitudeVal,latitudeVal){

        if(latitudeVal && longitudeVal){
          $.ajax({
          
          type		: "POST",
          url		:  "<?php echo base_url(); ?>get-place-by-coordinates/",
          dataType	: "JSON",
          data		: {
                
                "longitude" 	 			: longitudeVal,
                "latitude" 	 				: latitudeVal,
                "access_token" 	 		: mapboxgl.accessToken,
              
                },

        beforeSend	: function(){

                      
                    },
        success: function(data) {
          
              if (data.success == true) {
                  // assignng values too html tags
                  var locality = '';
                  var city     = '';
                  var region   = '';
                  var country  = '';

                  if(data.result.length > 0){
                    var locality = (data.result.find(c => c.id.includes("locality"))?data.result.find(c => c.id.includes("locality")).text:'');
                    var city = (data.result.find(c => c.id.includes("place"))?data.result.find(c => c.id.includes("place")).text:'');
                    var region = (data.result.find(c => c.id.includes("region"))?data.result.find(c => c.id.includes("region")).text:'');
                    var country = (data.result.find(c => c.id.includes("country"))?data.result.find(c => c.id.includes("country")).text:'');
                

                  // assign values to spans  
                  $('#frameText').html(city);
                  $('#frametext2-strong').html(region + ' , '+country);
                    

                  // assign input field value
                  $('#headerInput').val(city);
                  $('#headerInput2').val(region + ' , '+country);

                  }else{
                    $('#frameText').html('');
                    $('#frametext2-strong').html('');
                  
                    $('#headerInput').val('');
                    $('#headerInput2').val('');

                  }

                  if(data.convertedLatLong){
                    convertedLatLong = data.convertedLatLong;
                    $('#latLong_p').html(convertedLatLong['convertedLong']+'  '+convertedLatLong['convertedLat']);
                    
                    $('#lonInput').val(convertedLatLong['convertedLong']);
                    $('#latInput').val(convertedLatLong['convertedLat']);

                  }else{
                    $('#lonInput').val('');
                    $('#latInput').val('');
                    $('#latLong_p').html('');
                  }
                 
              } else {
                    $('#headerInput').val('');
                    $('#headerInput2').val('');
                    $('#lonInput').val('');
                    $('#latInput').val('');

                    $('#latLong_p').html('');
                    $('#frameText').html(city);
                    $('#frametext2-strong').html('');
                  
              }
            }
        });
   
    }
  }
    //
    // Errors
    //

    var maxSize;
    if (map) {
        var canvas = map.getCanvas();
        var gl = canvas.getContext('experimental-webgl');
        maxSize = gl.getParameter(gl.MAX_RENDERBUFFER_SIZE);
    }


    function handleErrors() {
        'use strict';
        var errorMsgElem = document.getElementById('error-message');
        var anError = false;
        var errorMsg;
        for (var e in errors) {
            e = errors[e];
            if (e.state) {
                if (anError) {
                    errorMsg += ' ' + e.msg;
                } else {
                    errorMsg = e.msg;
                    anError = true;
                }
                document.getElementById(e.grp).classList.add('has-error');
            } else {
                document.getElementById(e.grp).classList.remove('has-error');
            }
        }
        if (anError) {
            //errorMsgElem.innerHTML = errorMsg;
            //errorMsgElem.style.display = 'block';
        } else {
            //errorMsgElem.style.display = 'none';
        }
    }

    function isError() {
        'use strict';
        for (var e in errors) {
            if (errors[e].state) {
                return true;
            }
        }
        return false;
    }


    //
    // Configuration changes / validation
    //

    form.widthInput.addEventListener('change', changeWidth);

    function changeWidth(e) {
        'use strict';
        var unit = form.unitOptions[0].checked ? 'in' : 'mm';
        var val = (unit == 'mm') ? Number(e.target.value / 25.4) : Number(e.target.value);
        var dpi = Number(form.dpiInput.value);
        if (val > 0) {
            if (val * dpi > maxSize) {
                errors.width.state = true;
                errors.width.msg = 'The maximum image dimension is ' + maxSize +
                    'px, but the width entered is ' + (val * dpi) + 'px.';
            } else if (val * window.devicePixelRatio * 96 > maxSize) {
                errors.width.state = true;
                errors.width.msg = 'The width is unreasonably big!';
            } else {
                errors.width.state = false;
                if (unit == 'mm') val *= 25.4;
                form.widthInput.value = val;
                document.getElementById('map').style.width = toPixels(val);
                map.resize();
            }
        } else {
            errors.width.state = true;
            errors.height.msg = 'Width must be a positive number!';
        }
        handleErrors();
    }

    form.heightInput.addEventListener('change', changeHeight);

    function changeHeight(e) {
        'use strict';
        var unit = form.unitOptions[0].checked ? 'in' : 'mm';
        var val = (unit == 'mm') ? Number(e.target.value / 25.4) : Number(e.target.value);
        var dpi = Number(form.dpiInput.value);
        if (val > 0) {
            if (val * dpi > maxSize) {
                errors.height.state = true;
                errors.height.msg = 'The maximum image dimension is ' + maxSize +
                    'px, but the height entered is ' + (val * dpi) + 'px.';
            } else if (val * window.devicePixelRatio * 96 > maxSize) {
                errors.height.state = true;
                errors.height.msg = 'The height is unreasonably big!';
            } else {
                errors.height.state = false;
                if (unit == 'mm') val *= 25.4;
                form.heightInput.value = val;
                document.getElementById('map').style.height = toPixels(val);
                map.resize();
            }
        } else {
            errors.height.state = true;
            errors.height.msg = 'Height must be a positive number!';
        }
        handleErrors();
    }

    form.dpiInput.addEventListener('change', function(e) {
        'use strict';
        var val = Number(e.target.value);
        if (val > 0) {
            errors.dpi.state = false;
            var event = document.createEvent('HTMLEvents');
            event.initEvent('change', true, true);
            form.widthInput.dispatchEvent(event);
            form.heightInput.dispatchEvent(event);
        } else {
            errors.dpi.state = true;
        }
        handleErrors();
    });

    form.styleSelect.addEventListener('change', changeMapStyle);

    function changeMapStyle() {

        'use strict';
        try {
            var style = form.styleSelect.value;
            if (style.indexOf('maptiler') >= 0)
                style += '?key=' + mapTilerAccessToken;
                // console.log(style);
                // Calling the map base style with different styles and retaining previous style in function
                changeStyleBase(style);
                
                     
       
        } catch (e) {
            openErrorModal("Error changing style: " + e.message);
        }

        // Update attribution requirements
        if (form.styleSelect.value.indexOf('mapbox') >= 0) {
            // document.getElementById('mapbox-attribution').style.display = 'block';
            document.getElementById('openmaptiles-attribution').style.display = 'block';
        } else {
            // document.getElementById('mapbox-attribution').style.display = 'none';
            document.getElementById('openmaptiles-attribution').style.display = 'block';
        }
    }

    // Changing the map base style with different styles and retaining previous style
    function changeStyleBase(style) {
      
      const savedLayers  = [];
      const savedSources = {};

      // getting all sources and layers from already existing map
      let currentStyle    = map.getStyle();
      let currentSources  = map.getStyle().sources;
      let currentLayers   = map.getStyle().layers;
      const propertycurrentSources = Object.keys(currentSources);
      const layerGroups      = [];
      currentLayers.forEach((currentLayer) => {
        // allIds = currentLayer.id
        // console.log(currentLayer.id);
        layerGroups.push(currentLayer.id);
      });

      // storing all sources and layers from already existing map
      currentStyle.layers.forEach((layerGroup) => {
        if ( layerGroup.source ) {
            savedSources[layerGroup.source] = map.getSource(layerGroup.source).serialize();
            savedLayers.push(layerGroup);
          }else{
            savedLayers.push(layerGroup);

          }

      });

      // calling new map style
      map.setStyle(style);

      // updating new map with all sources and layers in previous  map
      setTimeout(() => {
        Object.entries(savedSources).forEach(([id, source]) => {
         // dont add composite sources 
          var bool = true;

          // if(style.includes("basic-style.json")){
          //   if(id === 'composite'){
          //     bool = false;
          //   }else{
          //     bool = true;
          //   }
          // }

          if(bool){
            // add only custmised layers and sources
          if(!map.getSource(id)){
           if(!id.includes('satellite')){
              map.addSource(id, source);
           }
          }
        }
        });

        savedLayers.forEach((layer) => {
          if(!map.getLayer(layer.id) && map.getSource(layer.source)){
            if(layer.source && (layer.source !== 'composite')){
               map.addLayer(layer);
            }
          }
        });


        // map.setLayoutProperty('building-underground', 'visibility', 'none');
        // map.setLayoutProperty('building-extrusion', 'visibility', 'none');
        console.log(map.style.stylesheet.layers);
        console.log(map.getStyle().layers);
        // map.style.stylesheet.layers.forEach(function(layer) {
          map.getStyle().layers.forEach(function(layer) {
          if (layer.type === 'symbol' && map.getLayer(layer.id)) {
              map.removeLayer(layer.id);
              // document.getElementById('land').style.display = 'block';

          }
        });

      }, 1200);
    }

   

    form.mmUnit.addEventListener('change', function() {
        'use strict';
        form.widthInput.value *= 25.4;
        form.heightInput.value *= 25.4;
    });

    form.inUnit.addEventListener('change', function() {
        'use strict';
        form.widthInput.value /= 25.4;
        form.heightInput.value /= 25.4;
    });

    if (form.unitOptions[1].checked) {
        // Millimeters
        form.widthInput.value *= 25.4;
        form.heightInput.value *= 25.4;
    }

    form.latInput.addEventListener('change', function() {
        'use strict';
        map.setCenter([form.lonInput.value, form.latInput.value]);
    });

    form.lonInput.addEventListener('change', function() {
        'use strict';
        map.setCenter([form.lonInput.value, form.latInput.value]);
    });

    form.zoomInput.addEventListener('change', function(e) {
        'use strict';
        map.setZoom(e.target.value);
    });




    //
    // Error modal
    //

    var origBodyPaddingRight;

    function openErrorModal(msg) {
        'use strict';
        var modal = document.getElementById('errorModal');
        document.getElementById('modal-error-text').innerHTML = msg;
        modal.style.display = 'block';
        document.body.classList.add('modal-open');
        document.getElementById('modalBackdrop').style.height =
            modal.scrollHeight + 'px';
        document.getElementById('modalBackdrop').style.display = 'block';
      console.log(msg);
        if (document.body.scrollHeight > document.documentElement.clientHeight) {
            origBodyPaddingRight = document.body.style.paddingRight;
            var padding = parseInt((document.body.style.paddingRight || 0), 10);
            document.body.style.paddingRight = padding + measureScrollbar() + 'px';
        }
    }

    function closeErrorModal() {
        'use strict';
        document.getElementById('errorModal').style.display = 'none';
        document.getElementById('modalBackdrop').style.display = 'none';
        document.body.classList.remove('modal-open');
        document.body.style.paddingRight = origBodyPaddingRight;
    }

    function measureScrollbar() {
        'use strict';
        var scrollDiv = document.createElement('div');
        scrollDiv.className = 'modal-scrollbar-measure';
        document.body.appendChild(scrollDiv);
        var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
        document.body.removeChild(scrollDiv);
        return scrollbarWidth;
    }


    //
    // Helper functions
    //

    function toPixels(length) {
        'use strict';
        var unit = form.unitOptions[0].checked ? 'in' : 'mm';
        var conversionFactor = 96;
        if (unit == 'mm') {
            conversionFactor /= 25.4;
        }

        return conversionFactor * length + 'px';
    }

    //
    // High-res map rendering
    //

    document.getElementById('generate-btn').addEventListener('click', generateMap);

    function generateMap() {
        'use strict';
        console.log('saaa');

        // html2canvas($("#map"), {
        //     useCORS: true,
        //     allowTaint: false,
        //     onrendered: function (canvas) {

        //         var a = document.createElement('a');

        //         // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
        //         a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
        //         a.download = 'google_map.jpg';
        //         a.click();

        //         $("#imgMap").attr("src", canvas.toDataURL("image/png"));
        //         $("#imgMap").show();


        //         var ajax = new XMLHttpRequest();
        //         // ajax.open("POST", "save-capture.php", true);
        //         // ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //         // ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9));

        //         ajax.onreadystatechange = function () {
        //             if (this.readyState == 4 && this.status == 200) {
        //                 console.log(this.responseText);
        //             }
        //         };
              
        //     }
        // });
        // return true;
        if (isError()) {
            openErrorModal('The current configuration is invalid! Please ' +
                'correct the errors and try again.');
            return;
        }

        //document.getElementById('spinner').style.display = 'inline-block';
        document.getElementById('generate-btn').classList.add('disabled');

        var width = Number(form.widthInput.value);
        var height = Number(form.heightInput.value);

        var dpi = Number(form.dpiInput.value);

        var format = 'png';

        var unit = form.unitOptions[0].checked ? 'in' : 'mm';

        var style = form.styleSelect.value;
        if (style.indexOf('maptiler') >= 0)
            style += '?key=' + mapTilerAccessToken;
            // style = "mapbox://styles/mapbox/streets-v11";

        var zoom = map.getZoom();
        var center = map.getCenter();
        var bearing = map.getBearing();
        var pitch = map.getPitch();

        createPrintMap(width, height, dpi, format, unit, zoom, center,
            bearing, style, pitch);
    }

    function createPrintMap(width, height, dpi, format, unit, zoom, center,
        bearing, style, pitch) {
        'use strict';
        console.log(' here done');
        // Calculate pixel ratio
        var actualPixelRatio = window.devicePixelRatio;
        Object.defineProperty(window, 'devicePixelRatio', {
            get: function() { return dpi / 96 }
        });

        // Create map container
        var hidden = document.createElement('div');
        // hidden.className = 'hidden-map';
        hidden.id = 'grab-map';
        document.body.appendChild(hidden);
        var container = document.createElement('div');
        container.id = 'grab';
        // container.setAttribute('data-html2canvas-ignore','true');
        container.style.width = toPixels(width);
        container.style.height = toPixels(height);
        let footerDiv = document.createElement('div');
        footerDiv.classList.add('mapboxgl-ctrl-bottom-left')
        footerDiv.classList.add('customName_bottom_blur')
        footerDiv.classList.add('pt-3')
        footerDiv.style.textAlign = 'center';
        footerDiv.innerHTML = document.getElementById('mainFrame').innerHTML;
        container.appendChild(footerDiv);
        hidden.appendChild(container);
        // console.log(document.getElementById('mainFrame').innerHTML)
        // console.log(container)

        // Render map
        var renderMap = new mapboxgl.Map({
            container: container,
            center: center,
            zoom: zoom,
            style: style,
            bearing: bearing,
            pitch: pitch,
            interactive: false,
            preserveDrawingBuffer: true,
            fadeDuration: 0,
            attributionControl: false,
        });

        console.log("render");

        // console.log(document.getElementById('grab-map'))



        // var img = new Image();
        // var mapCanvas = document.getElementById('grab');
        // img.src = mapCanvas.toDataURL();
        // document.getElementById('test').appendChild(img);
        // document.getElementsByClassName('mapboxgl-canvas')[1].setAttribute('data-html2canvas-ignore','false');
        // console.log(document.getElementsByClassName('mapboxgl-canvas')[1])

        html2canvas(document.getElementById('grab'), { removeContainer: false, allowTaint: true, useCORS: false }).then((canvas) => {
            // var anchorTag = document.createElement("a");
            // document.body.appendChild(anchorTag);
            // anchorTag.download = "Picture.png";
            // anchorTag.href = canvas.toDataURL();
            // anchorTag.target = '_blank';
            // anchorTag.click();
            canvas.toBlob(function(blob) {
                var newImg = document.createElement('img'),
                    url = URL.createObjectURL(blob);
                tempblob = blob;
                //blob
                newImg.id = 'temp';
                newImg.style.display = 'none';
                newImg.onload = function() {
                    // no longer need to read the blob so it's revoked
                    URL.revokeObjectURL(url);
                };

                newImg.src = url;
                document.body.appendChild(newImg);

                renderMap.once('load', function() {
                    if (format == 'png') {
                        // let c = renderMap.getCanvas();
                        // console.log(c)
                        // var ctx = c.getContext("webgl");
                        // var img = document.getElementById("temp");
                        // console.log(img)
                        // // console.log(img)
                        //
                        //     console.log('in')
                        //         console.log(ctx)
                        //     ctx.drawImage(img, 20, 20);
                        //
                        //
                        // setTimeout( () => {
                        //     console.log('tt')
                        renderMap.getCanvas().toBlob(function(blob) {
                            var reader = new FileReader();
                            reader.readAsDataURL(blob);
                            reader.onloadend = function() {
                                var base64data = reader.result;
                                var tempImageSize = document.getElementById('temp');
                                var tempWidth = tempImageSize.clientWidth;
                                var tempHeight = tempImageSize.clientHeight;
                                let pp = document.getElementById('pp');
                                pp.src = base64data;

                                // var link = document.createElement('a');
                                // link.download = 'filename.png';
                                // link.href =document.getElementsByClassName('mapboxgl-canvas')[1].toDataURL()
                                // link.click();

                                // var c= document.getElementById("myCanvas");
                                // var ctx= c.getContext("2d");
                                //
                                //     ctx.drawImage(document.getElementById('pp'), 0, 0, 40, 40);
                                //
                                //         ctx.drawImage( document.getElementById('temp'), 5, 5, 5, 5);
                                //         var p = c.toDataURL("image/png");
                                //         document.getElementById('final').src = p;





                                var to = new FileReader();
                                to.readAsDataURL(tempblob);
                                to.onloadend = function() {
                                    var base64String = to.result;
                                    mergeImages([
                                        { src: base64data, x: 0, y: 0, opacity: 0.7 },
                                        { src: base64String, x: 400, y: 1000, }
                                    ]).then(b64 => {
                                        let finalImage = document.getElementById('final');
                                        finalImage.src = b64;
                                        finalImage.crossOrigin = 'anonymous';
                                        finalImage.style.height = tempHeight + 'px';
                                        finalImage.style.width = tempHeight + 'px';

                                        var image = document.getElementById('final');
                                        var saveImg = document.createElement('a');
                                        saveImg.href = image.src
                                        saveImg.download = "map.png";
                                        saveImg.click();
                                    });
                                }


                                // const img = document.querySelector('#temp');
                                // const dataUrl = getDataUrl(img);

                                function getDataUrl(img) {
                                    // Create canvas
                                    // const canvas = document.createElement('canvas');
                                    // const ctx = canvas.getContext('2d');
                                    // // Set width and height
                                    // canvas.height = img.naturalHeight;
                                    // canvas.width = img.naturalWidth;
                                    //
                                    //
                                    // // Draw the image
                                    // ctx.drawImage(img, 0, 0);
                                    // let base64FooterString =  canvas.toDataURL('image/jpeg');



                                }
                                // Select the image


                                // console.log(document.getElementById('temp'))





                                // let resEle = document.getElementById("myCanvas");
                                // var context = resEle.getContext("2d");
                                // console.log(document.getElementById('pp'))
                                //     resEle.width = imgEle1.width;
                                //     resEle.height = imgEle1.height;
                                //     context.globalAlpha = 1.0;
                                //     context.drawImage(imgEle1, 0, 0);
                                //     context.globalAlpha = 0.5;
                                //     context.drawImage(imgEle2, 0, 0);
                                console.log('done');

                            }

                            // saveAs(blob, 'map.png');

                            // mergeImages([blob, blob])
                            //     .then(b64 => document.querySelector('img').src = b64);
                            // console.log('test')
                            //     mergeImages([
                            //         { src: blob, x: 0, y: 0 },
                            //         { src: blob, x: 32, y: 0 },
                            //     ]).then(b64 =>
                            //     console.log(b64)
                            //     );

                            //
                            // var c=document.getElementById("myCanvas");
                            // var ctx=c.getContext("2d");
                            // console.log('man?')
                            // const blobToImage = (blob) => {
                            //     return new Promise(resolve => {
                            //         console.log('inside')
                            //         const url = URL.createObjectURL(blob)
                            //         let img = new Image()
                            //         img.onload = () => {
                            //             URL.revokeObjectURL(url)
                            //             resolve(img)
                            //             console.log('inside 2')
                            //
                            //         }
                            //         var imageObj1 = new Image();
                            //         imageObj1.src = url;
                            //         imageObj1.onload = function() {
                            //             ctx.drawImage(imageObj1, 0, 0, 328, 526);
                            //             // imageObj2.src = "2.png";
                            //             // imageObj2.onload = function() {
                            //             //     ctx.drawImage(imageObj2, 15, 85, 300, 300);
                            //             var img = c.toDataURL("image/png");
                            //             document.write('<img src="' + img + '" width="328" height="526"/>');
                            //             console.log('created')
                            //             // }
                            //         };
                            //     })
                            // }

                            // var imageObj1 = new Image();
                            // var imageObj2 = new Image();
                            // imageObj1.src = blob;
                            // imageObj1.onload = function() {
                            //     ctx.drawImage(imageObj1, 0, 0, 328, 526);
                            //     // imageObj2.src = "2.png";
                            //     // imageObj2.onload = function() {
                            //     //     ctx.drawImage(imageObj2, 15, 85, 300, 300);
                            //         var img = c.toDataURL("image/png");
                            //         document.write('<img src="' + img + '" width="328" height="526"/>');
                            //         console.log('created')
                            //     // }
                            // };


                        });
                        // },3000)


                    } else {
                        var pdf = new jsPDF({
                            orientation: width > height ? 'l' : 'p',
                            unit: unit,
                            format: [width, height],
                            compress: true
                        });

                        pdf.addImage(renderMap.getCanvas().toDataURL('image/png'),
                            'png', 0, 0, width, height, null, 'FAST');

                        var title = map.getStyle().name,
                            subject = "center: [" + form.lonInput.value + ", " + form.latInput.value + ", " + form.zoomInput.value + "]",
                            attribution = '(c) ' +
                            (form.styleSelect.value.indexOf('mapbox') >= 0 ? 'Mapbox' : 'OpenMapTiles') +
                            ', (c) OpenStreetMap';

                        pdf.setProperties({
                            title: title,
                            subject: subject,
                            creator: 'Print Maps',
                            author: attribution
                        })

                        pdf.save('map.pdf');
                    }

                    renderMap.remove();
                    hidden.parentNode.removeChild(hidden);
                    Object.defineProperty(window, 'devicePixelRatio', {
                        get: function() { return actualPixelRatio }
                    });
                    // document.getElementById('spinner').style.display = 'none';
                    document.getElementById('generate-btn').classList.remove('disabled');
                });
                //
                //                 var c = document.getElementById("myCanvas");
                //                 var ctx = c.getContext("2d");
                //                 var img = document.getElementById("temp");
                //                 // console.log(img)
                //                 img.onload = function() {
                //                     ctx.drawImage(img, 5, 5);
                //                 };
                //
                //
                //                 map.on('load', () => {
                //                     map.addSource('canvas-source', {
                //                         type: 'canvas',
                //                         canvas: 'canvasID',
                //                         coordinates: [
                //                             [91.4461, 21.5006],
                //                             [100.3541, 21.5006],
                //                             [100.3541, 13.9706],
                //                             [91.4461, 13.9706]
                //                         ],
                // // Set to true if the canvas source is animated. If the canvas is static, animate should be set to false to improve performance.
                //                         animate: true
                //                     });
                //
                //                     map.addLayer({
                //                         id: 'canvas-layer',
                //                         type: 'raster',
                //                         source: 'canvas-source'
                //                     });
                //                 });

                // var c = document.getElementsByClassName('mapboxgl-canvas')[1];
                // var ctx= c.getContext("2d");
                // console.log(ctx)
                // var imageObj1 = new Image();
                // var imageObj2 = new Image();
                // imageObj1.src = document.getElementById('temp').getAttribute('src');
                // imageObj1.onload = function() {
                //     console.log(imageObj1)
                //     ctx.drawImage(imageObj1, 0, 0, 20, 20);
                //     // imageObj2.src = "2.png";
                //     // imageObj2.onload = function() {
                //     //     ctx.drawImage(imageObj2, 15, 85, 300, 300);
                //     //     var img = c.toDataURL("image/png");
                //     //     document.write('<img src="' + img + '" width="328" height="526"/>');
                //     // }
                // };
            });


        });

        // html2canvas(document.getElementById('grab'), {
        //     onrendered: function(canvas) {
        //         var anchorTag = document.createElement("a");
        //         document.body.appendChild(anchorTag);
        //         anchorTag.download = "Picture.png";
        //         anchorTag.href = canvas.toDataURL();
        //         anchorTag.target = '_blank';
        //         anchorTag.click();
        //
        //
        //     }
        // });
        // document.getElementById('test').innerHTML = renderMap;
        // return;
        /*
        if (format == 'png') {
            renderMap.getCanvas().toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    //var prj_content = 'PROJCS["WGS 84 / Pseudo-Mercator",GEOGCS["GCS_WGS_1984",DATUM["D_WGS_1984",SPHEROID["WGS_1984",6378137,298.257223563]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]],PROJECTION["Mercator"],PARAMETER["central_meridian",0],PARAMETER["scale_factor",1],PARAMETER["false_easting",0],PARAMETER["false_northing",0],UNIT["Meter",1]]';
                    var prj_content = 'GEOGCS["GCS_WGS_1984",DATUM["D_WGS_1984",SPHEROID["WGS_1984",6378137,298.257223563]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]]';

                    //convertBase64ToFile(base64data, 'map.png');

                    download(base64data, "print."+format, "image/"+format);
                        //download(prj_content,'print.prj','text/plain');
                        //CalcWorldFile('print.js');
                }
                //saveAs(blob, fileName +'.png');
            });
        }
        */

    }

    function download(data, strFileName, strMimeType) {

        var self = window, // this script is only for browsers anyway...
            defaultMime = "application/octet-stream", // this default mime also triggers iframe downloads
            mimeType = strMimeType || defaultMime,
            payload = data,
            url = !strFileName && !strMimeType && payload,
            anchor = document.createElement("a"),
            toString = function(a) { return String(a); },
            myBlob = (self.Blob || self.MozBlob || self.WebKitBlob || toString),
            fileName = strFileName || "download",
            blob,
            reader;
        myBlob = myBlob.call ? myBlob.bind(self) : Blob;

        if (String(this) === "true") { //reverse arguments, allowing download.bind(true, "text/xml", "export.xml") to act as a callback
            payload = [payload, mimeType];
            mimeType = payload[0];
            payload = payload[1];
        }


        if (url && url.length < 2048) { // if no filename and no mime, assume a url was passed as the only argument
            fileName = url.split("/").pop().split("?")[0];
            anchor.href = url; // assign href prop to temp anchor
            if (anchor.href.indexOf(url) !== -1) { // if the browser determines that it's a potentially valid url path:
                var ajax = new XMLHttpRequest();
                ajax.open("GET", url, true);
                ajax.responseType = 'blob';
                ajax.onload = function(e) {
                    download(e.target.response, fileName, defaultMime);
                };
                setTimeout(function() { ajax.send(); }, 0); // allows setting custom ajax headers using the return:
                return ajax;
            } // end if valid url?
        } // end if url?


        //go ahead and download dataURLs right away
        if (/^data\:[\w+\-]+\/[\w+\-]+[,;]/.test(payload)) {

            if (payload.length > (1024 * 1024 * 1.999) && myBlob !== toString) {
                payload = dataUrlToBlob(payload);
                mimeType = payload.type || defaultMime;
            } else {
                return navigator.msSaveBlob ? // IE10 can't do a[download], only Blobs:
                    navigator.msSaveBlob(dataUrlToBlob(payload), fileName) :
                    saver(payload); // everyone else can save dataURLs un-processed
            }

        } //end if dataURL passed?

        blob = payload instanceof myBlob ?
            payload :
            new myBlob([payload], { type: mimeType });


        function dataUrlToBlob(strUrl) {
            var parts = strUrl.split(/[:;,]/),
                type = parts[1],
                decoder = parts[2] == "base64" ? atob : decodeURIComponent,
                binData = decoder(parts.pop()),
                mx = binData.length,
                i = 0,
                uiArr = new Uint8Array(mx);

            for (i; i < mx; ++i) uiArr[i] = binData.charCodeAt(i);

            return new myBlob([uiArr], { type: type });
        }

        function saver(url, winMode) {

            if ('download' in anchor) { //html5 A[download]
                anchor.href = url;
                anchor.setAttribute("download", fileName);
                anchor.className = "download-js-link";
                anchor.innerHTML = "downloading...";
                anchor.style.display = "none";
                document.body.appendChild(anchor);
                setTimeout(function() {
                    anchor.click();
                    document.body.removeChild(anchor);
                    if (winMode === true) { setTimeout(function() { self.URL.revokeObjectURL(anchor.href); }, 250); }
                }, 66);
                return true;
            }

            // handle non-a[download] safari as best we can:
            if (/(Version)\/(\d+)\.(\d+)(?:\.(\d+))?.*Safari\//.test(navigator.userAgent)) {
                url = url.replace(/^data:([\w\/\-\+]+)/, defaultMime);
                if (!window.open(url)) { // popup blocked, offer direct download:
                    if (confirm("Displaying New Document\n\nUse Save As... to download, then click back to return to this page.")) { location.href = url; }
                }
                return true;
            }

            //do iframe dataURL download (old ch+FF):
            var f = document.createElement("iframe");
            document.body.appendChild(f);

            if (!winMode) { // force a mime that will download:
                url = "data:" + url.replace(/^data:([\w\/\-\+]+)/, defaultMime);
            }
            f.src = url;
            setTimeout(function() { document.body.removeChild(f); }, 333);

        } //end saver




        if (navigator.msSaveBlob) { // IE10+ : (has Blob, but not a[download] or URL)
            return navigator.msSaveBlob(blob, fileName);
        }

        if (self.URL) { // simple fast and modern way using Blob and URL:
            saver(self.URL.createObjectURL(blob), true);
        } else {
            // handle non-Blob()+non-URL browsers:
            if (typeof blob === "string" || blob.constructor === toString) {
                try {
                    return saver("data:" + mimeType + ";base64," + self.btoa(blob));
                } catch (y) {
                    return saver("data:" + mimeType + "," + encodeURIComponent(blob));
                }
            }

            // Blob but not URL support:
            reader = new FileReader();
            reader.onload = function(e) {
                saver(this.result);
            };
            reader.readAsDataURL(blob);
        }
        return true;
    }

    function convertBase64ToFile(base64String, fileName) {
        let arr = base64String.split(',');
        let mime = arr[0].match(/:(.*?);/)[1];
        let bstr = atob(arr[1]);
        let n = bstr.length;
        let uint8Array = new Uint8Array(n);
        while (n--) {
            uint8Array[n] = bstr.charCodeAt(n);
        }
        let file = new File([uint8Array], fileName, { type: mime });
        downloadFile(fileName, file);
        downloadFile('myMap.png', base64String);
    }

    function downloadFile(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }




} catch (error) {
    console.log(error);
    var mapContainer = document.getElementById('map');
    mapContainer.parentNode.removeChild(mapContainer);
    document.getElementById('config-fields').setAttribute('disabled', 'yes');
    // openErrorModal('This site requires WebGL, but your browser doesn\'t seem' +
    // ' to support it: ' + error.message);
}


      tinymce.init({
            selector:'#editor',
            menubar: false,
            statusbar: false,
            plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
            skin: 'bootstrap',
            toolbar_drawer: 'floating',
            min_height: 200,           
            autoresize_bottom_margin: 16,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor="#80bdff"
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow="",
                    editor.getContainer().style.borderColor=""
                });
            }
        });

        
   
   </script>
   <script>

    
	// TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
	// mapboxgl.accessToken = 'pk.eyJ1IjoibXViYXNoaXJnaXMiLCJhIjoiY2tpZWNpbTU3MXJwczJ5bnh4MDI1ZW9mNyJ9.iBdeAqhocxhiDp1ClwUzhw';
  //   const map = new mapboxgl.Map({
  //       // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
  //       style: 'http://localhost/mapartproject/styles/monochrome-sky-style.json',
  //       center: [-74.0066, 40.7135],
  //       zoom: 15.5,
  //       pitch: 45,
  //       bearing: -17.6,
  //       container: 'map',
  //       antialias: true
  //   });

  //   map.on('load', () => {
  //       // Insert the layer beneath any symbol layer.
  //       const layers = map.getStyle().layers;
  //       const labelLayerId = layers.find(
  //           (layer) => layer.type === 'symbol' && layer.layout['text-field']
  //       ).id;

  //       // The 'building' layer in the Mapbox Streets
  //       // vector tileset contains building height data
  //       // from OpenStreetMap.
  //       map.addLayer(
  //           {
  //               'id': 'add-3d-buildings',
  //               'source': 'composite',
  //               'source-layer': 'building',
  //               'filter': ['==', 'extrude', 'true'],
  //               'type': 'fill-extrusion',
  //               'minzoom': 15,
  //               'paint': {
  //                   'fill-extrusion-color': '#aaa',

  //                   // Use an 'interpolate' expression to
  //                   // add a smooth transition effect to
  //                   // the buildings as the user zooms in.
  //                   'fill-extrusion-height': [
  //                       'interpolate',
  //                       ['linear'],
  //                       ['zoom'],
  //                       15,
  //                       0,
  //                       15.05,
  //                       ['get', 'height']
  //                   ],
  //                   'fill-extrusion-base': [
  //                       'interpolate',
  //                       ['linear'],
  //                       ['zoom'],
  //                       15,
  //                       0,
  //                       15.05,
  //                       ['get', 'min_height']
  //                   ],
  //                   'fill-extrusion-opacity': 0.6
  //               }
  //           },
  //           labelLayerId
  //       );
  //   });

   </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
//   $(document).ready(function (e) {
//     console.log(map);

//           $(".uploadGpx").on('click',(function(e) {
//             e.preventDefault();
//             console.log('here');
            
//             console.log(map);

//             form = $(this).closest('form')[0];
//             var formData = new FormData(form);
            
//             if( document.getElementById("gpxFile").files.length == 0 ){
//               swal("Error!", 'Please select file!', "error");
//            }else{
//                 $.ajax({
//                         url: "<?php echo base_url(); ?>upload-Gpx-File/",
//                   type: "POST",
//                   data:  formData,
//                   processData: false,
//                   contentType: false,
//                   data: formData,
//                   // dataType: 'json',
//                   beforeSend : function()
//                   {
//                     //$("#preview").fadeOut();
//                     // $("#err").fadeOut();
//                   },
//                   success: function(data)
//                   {
//                     data=JSON.parse(data);
//                     if(data.coordinates){
//                       console.log('exst');
// //                       map.setView([34.89, -87.31], 6);
// // return true;
// console.log(data.coordinates);
// allcoordinates=data.coordinates;
// console.log(allcoordinates[0]);
//     //                   map = new mapboxgl.Map({
//     //     container: 'map',
//     //     // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
//     //     style: 'mapbox://styles/mapbox/streets-v11',
//     //     center: allcoordinates[0],
//     //     zoom: 1
//     // });
//     console.log(map);
//     var feature = map.getSource('route')._options.data;
//     console.log(features);


//     const features = map.querySourceFeatures('route', {
// sourceLayer: 'route-layer'
// });
// console.log(features);
//     mapboxgl.accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
//     updateRoute(allcoordinates);

// // map.getSource('route');
// // map.getSource('route').setData(data.coordinates);
// // return true;
//                       // append coordinates on map
//                       // map.on('result', () => {
// // map.addSource('route', {
// // 'type': 'geojson',
// // 'data': {
// // 'type': 'Feature',
// // 'properties': {},
// // 'geometry': {
// // 'type': 'LineString',
// //   'coordinates':allcoordinates,
// // 'coordinates': [
// // [-122.483696, 37.833818],
// // [-122.483482, 37.833174],
// // [-122.483396, 37.8327],
// // [-122.483568, 37.832056],
// // [-122.48404, 37.831141],
// // [-122.48404, 37.830497],
// // [-122.483482, 37.82992],
// // [-122.483568, 37.829548],
// // [-122.48507, 37.829446],
// // [-122.4861, 37.828802],
// // [-122.486958, 37.82931],
// // [-122.487001, 37.830802],
// // [-122.487516, 37.831683],
// // [-122.488031, 37.832158],
// // [-122.488889, 37.832971],
// // [-122.489876, 37.832632],
// // [-122.490434, 37.832937],
// // [-122.49125, 37.832429],
// // [-122.491636, 37.832564],
// // [-122.492237, 37.833378],
// // [-122.493782, 37.833683]
// // ]
// // }
// // }
// // });
// // map.addLayer({
// //             'id': 'route',
// //             'type': 'line',
// //             'source': 'route',
// //             'layout': {
// //                 'line-join': 'round',
// //                 'line-cap': 'round'
// //             },
// //             'paint': {
// //                 'line-color': '#000',
// //                 'line-width': 8
// //             }
// //         });
// // });
//                     }else{
//                       // does not exist any coordinates
//                       swal("Error!", 'Data doesnt exist!', "error");
//                     }
//                   },
//                   error: function(e) 
//                       {
                   
//                       }          
//                   });
//             }
//           }));

//           function updateRoute(routeJSON, updateLayers=true) {
              
//               // if (map.getSource('route')) {
//                 // update source data
//                 geoJSONData= {
//                     'type': 'Feature',
//                     'properties': {},
//                     'geometry': {
//                         'type': 'LineString',
//                         'coordinates': routeJSON
                      
//                     }
//                 }
//                 map.getSource("route").setData({
//   type: 'geojson',
//   features: geoJSONData
// });

//                 // map.getSource("route").setData(geoJSONData);
//               // } else {
//                 // create a new source
//                 // map.addSource("route", {
//                 //   "type":"geojson",
//                 //   "data": geoJSONData
//                 // });
//               // }

//               if (map.getLayer('route-layer') || updateLayers) {
//                 // remove the previous version of layer
//                 if (map.getLayer('route-layer')) {
//                   map.removeLayer('route-layer');
//                 }

//                 map.addLayer({
//                   'id': 'route-layer',
//                   'type': 'line',
//                   'source': 'route',
//                   'layout': {
//                       'line-join': 'round',
//                       'line-cap': 'round'
//                   },
//                   'paint': {
//                       'line-color': '#000',
//                       'line-width': 8
//                   }
//               });
//               }
//           }

// });
      //  $('.uploadGpx').click(function (e) {
        //     console.log('here');
        //     e.preventDefault();

        //     if( document.getElementById("gpxFile").files.length == 0 ){
        //        e.preventDefault();
        //     }else{
        //       // submit form
              
        //       $.ajax({
        //             type: "POST",
        //             dataType: "json",
        //             url: "<?php echo base_url(); ?>upload-Gpx-File/",
        //             data: {
        //                 file: $('#gpxFile').val(),
        //                 casesIds: 'qq'
        //             },
        //             beforeSend: function() {},
        //             success: function(response) {
        //                 // response = JSON.parse(data);
        //                 // if (response.error) {
        //                 //     swal("Error!", response.errorMessage, "error");
        //                 // } else if (response.success) {
        //                 //     swal("Success!", response.successMessage, "success").then(function() {
        //                 //         location.reload();
        //                 //     });
        //                 // }
        //             }
        //       });
        // // END AJAX FUNCTION
        //     }
      // });

      $('p, .potrait_box').click(function () {

        $('p, potrait_box.active').removeClass('active');
        $(this).addClass('active');
      });
    </script>
    <script>
      $('p, .dimension_box').click(function () {

        $('p, dimension_box.active').removeClass('active');
        $(this).addClass('active');
      });
     
    </script>
    <!-- <script>
      $('p, .dimension_box').click(function () {

        $('p, dimension_box.active').removeClass('active');
        $(this).addClass('active');
      });
    </script> -->
    <script>
      function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
        } else {
          x.className = x.className.replace(" w3-show", "");
        }
      }
    </script>
  
