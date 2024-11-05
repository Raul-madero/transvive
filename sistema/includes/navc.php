<!-- Right navbar links -->
<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user"></i>
            <span class="badge" style="font-size: 14px;"><?php echo $_SESSION['user']; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">Cambiar Password</a>
              <!-- Message End -->
           
              <div class="dropdown-divider"></div>
            <a href="salir.php" class="dropdown-item dropdown-footer">Salir</a>
              <!-- Message End -->
            
            
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <!--<li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-lightbulb"></i>
            
          </a>
          
        </li>-->

         <!-- Notifications Dropdown Menu -->
         <!--<li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
            
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
            <div class="dropdown-divider"></div>
            <a href="salir.php" class="dropdown-item">
              <i class="fa fa-power-off mr-2"></i> Salir
              
            </a>
            <div class="dropdown-divider"></div>
           
            
           
          </div>
        </li>-->
        <!-- Notifications Dropdown Menu -->
      
      </ul>