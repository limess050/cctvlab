<div class="navbar" style="margin-bottom: 0px">
    <div class="navbar-inner" >
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="i-bar"></span>
                <span class="i-bar"></span>
                <span class="i-bar"></span>
            </a>
            <a class="brand" href="/">CCTVLIFE.ru</a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="<?php echo $current_module == 'blog' ? 'active' : '' ;?>"><a href="/">Главная</a></li>
                    <li class="<?php echo $current_module == 'lenses' ? 'active' : '' ;?>">
                        <a  href="/lenses">Обьективы</a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Сравнение<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/comparing"><i class="icon-facetime-video" style="margin-right: 4px;"></i>Перейти к сравнению</a></li>
                        </ul>
                    </li>
                    <li>
                        <form class="navbar-search pull" action="" style="margin-left: 350px">
                            <input type="text" class="search-query span2" placeholder="Search">
                        </form>
                    </li>
                    <i class="icon-search icon-white" style="margin-top: 13px; margin-left: 6px"></i>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
