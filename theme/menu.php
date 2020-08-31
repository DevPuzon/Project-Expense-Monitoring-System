<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo WEB_ROOT; ?>index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
         <?php

         if ($_SESSION['ACCOUNT_TYPE'] == 'Administrator'){
          echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Project">
                  <a class="nav-link" href="'; ?><?php echo WEB_ROOT; ?>module/project/">
          <?php 
          echo  '<i class="fa fa-fw fa-book "></i>
                    <span class="nav-link-text">Project</span>
                  </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Expenses">
          <a class="nav-link" href="'; ?><?php echo WEB_ROOT; ?>module/cash-advance/">
           <?php 
          echo  '<i class="fa fa-money"></i>
            <span class="nav-link-text">Cash advance</span>
          </a>
        </li>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Supplier">
          <a class="nav-link" href="'; ?><?php echo WEB_ROOT; ?>module/supplier/">
            <?php 
          echo  '<i class="fa fa-address-book-o"></i>
            <span class="nav-link-text">Supplier</span>
          </a>
        </li>
		  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
          <a class="nav-link" href="'; ?><?php echo WEB_ROOT; ?>module/category/">
            <?php 
          echo  '<i class="fa fa-print"></i>
            <span class="nav-link-text">Category</span>
          </a>
        </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
          <a class="nav-link" href="'; ?><?php echo WEB_ROOT; ?>module/report/">
            <?php 
          echo  '<i class="fa fa-print"></i>
            <span class="nav-link-text">Report</span>
          </a>
        </li>
     
       
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Settings</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            
            <li>
              <a href="'; ?><?php echo WEB_ROOT; ?>module/user/">User
 <?php 
          echo  '
              </a>
            
            </li>
          </ul>
        </li>
                ';
         }elseif ($_SESSION['ACCOUNT_TYPE'] == 'Employee') {
          echo ' <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Project">
                  <a class="nav-link" href="'; ?> <?php echo WEB_ROOT; ?>module/cproject/">
                    <?php 
          echo  '   <i class="fa fa-fw fa-book "></i>
                    <span class="nav-link-text">Project</span>
                  </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Expenses">
                    <a class="nav-link" href="'; ?><?php echo WEB_ROOT; ?>module/expenses/">
          <?php 

             echo  '<i class="fa fa-money"></i>
                    <span class="nav-link-text">Expenses</span>
                  </a>
                </li>
                 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Supplier">
                  <a class="nav-link" href="'; ?><?php echo WEB_ROOT; ?>module/supplier/">
                    <?php 

             echo  '
                    <i class="fa fa-address-book-o"></i>
                    <span class="nav-link-text">Supplier</span>
                  </a>
                </li>
             
       
       
                ';
         }



         ?>
        
       

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
         
      
       
      </ul>