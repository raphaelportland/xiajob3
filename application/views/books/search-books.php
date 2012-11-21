<div class="navbar" id="fj_searchbar_annonces">
              <div class="navbar-inner">
                <div class="container">
                  <!--<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>-->
                  <a class="brand" href="#">Rechercher des books</a>
                  
                  <div class="nav-collapse">
                    <?php echo form_open('book/search','class="navbar-search form-search"'); ?>
                    <!-- <form class="navbar-search form-search" action=""> -->
                      <div class="input-append">
                      <input type="text" name = "keywords" class="search-query span2" placeholder="keywords">
                      
                      <?php echo form_submit('submit', 'Chercher', 'class="btn"'); ?>
                      <!--<button type="submit" class="btn">Chercher</button>-->
                      </div>
                    </form>                      
                      
                    <ul class="nav">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Trier par style <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">... à définir !</a></li>
                          <li><a href="#">... à définir !</a></li>
                          <li><a href="#">... à définir !</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>