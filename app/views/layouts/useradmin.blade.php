<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>CAE Web</title>
  
  <link type="text/css" href="../css/layouts.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/tabs.css">
  <link rel="stylesheet" href="../css/useradmin/useradmin.css" type="text/css" media="screen" charset="utf-8">

  <!--Load jQuery dependency -->
  <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>

  <!--Load Libs for applicaion -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js"></script>
  <script src="../js/backbone.marionette.min.js"></script>
  <script src="../js/handlebars-v1.3.0.js"></script>

  <!--Initialize the Marionette app object -->
  <script src="../js/useradmin/useradminInit.js"></script>

  <!--Create modules in the app object that contain controllers -->
  <script src="../js/useradmin/controllers/userlistController.js"></script>
  
  <!--Create backbone models inside modules -->
  <script src="../js/useradmin/models/userModel.js"></script>
  <script src="../js/useradmin/models/userPositionsModel.js"></script>

  <!--Create Initial Tab view for app -->
  <script src="../js/useradmin/views/userlistTabView.js"></script>

  <!--Create other UserAdmin views for app -->
  <script src="../js/useradmin/views/userItemView.js"></script>
  <script src="../js/useradmin/views/userCollectionView.js"></script>
  <script src="../js/useradmin/views/userAddModalView.js"></script>
  <script src="../js/useradmin/views/userDetailsModalView.js"></script>

  <!--Define util for templates, and main to kick the main application off -->
  <script src="../js/useradmin/util.js"></script>
  <script src="../js/useradmin/main.js"></script>
  
</head>
<?php   $url_home = URL::route('home');
        $url_logout = URL::route('logout');
        $url_login = URL::route('login');
        $url_schedule = URL::to('/roomschedule');
        $url_inventory = URL::to('/inventory');
        $url_avlog = URL::to('/avlog');
        $url_employee = URL::to('/employee');
        $url_user_admin = URL::to('/useradmin');
?>
<body class="nosidebar">
  <div  id="fade">
  </div>
  <div id="header-wrapper">
    <div id="header">
      <div id="header-logo">
        <a title="CAE" href="<?php echo $url_home; ?>">
            <img src="../img/caeweb.png" alt="CAE" id="logo" height="55"/>
        </a>
      </div>
      <div id="header-greet">
        @if(Auth::check())
          <p> </br>Welcome,
          <?php
            // UserHelper class from app/UserHelper
            //$uHelper = new UserHelper();
            //echo $uHelper->getWmuName();
            echo Auth::user()->fullname;
          ?> - <a href="<?php echo $url_logout; ?>">Logout</a></br>
        @else
            <p> </br>@yield('logininfo', 'Welcome, CAE User!') </p>
        @endif

      </div>
      <div id="header-menu">
        <ul id="jsddm">
          <li><a href="<?php echo $url_home; ?>">Home</a></li>
          <li><a href="<?php echo $url_schedule; ?>">Room Scheduling</a></li>
          <li><a href="<?php echo $url_avlog; ?>">Audio/Visual</a></li>
          <li><a href="<?php echo $url_inventory; ?>">Inventory</a></li>
          <li><a href="<?php echo $url_employee; ?>">Employee</a></li>
          <li><a href="<?php echo $url_user_admin; ?>">User Admin</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div id="content-wrapper">
    <div id="content">
      <!-- check for flash notification message -->
      @if(Session::has('flash_notice'))
          <div class="flash_notice" id="flash_notice">{{ Session::get('flash_notice') }}</div>
      @endif
      <div id="tabsDiv">
        <div id="innerTabsDiv">
          {{ $contentTabHolder }}
        </div>
      </div>
    </div>
  </div>
  <div id="footer-wrapper">
    <div id="footer">
      <p><b>This is the footer.</b></p>
    </div>
  </div>
</body>
</html>