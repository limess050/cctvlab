<div class="menubar">                                    
    <div id="menu">
        <ul class="menu menu-dropdown">
            <li class="level1 item1 first parent <?php echo $current_module == 'blog' ? 'active' : '' ;?>"><a href="/" class="level1 item1 first parent"><span class="bg"><?php echo lang('public_mmenu_home');?></span></a></li>
            <li class="level1 item1 first parent <?php echo $current_module == 'lenses' ? 'active' : '' ;?>"><a href="/lenses/" class="level1 item1 first parent"><span class="bg"><?php echo lang('public_mmenu_lenses');?></span></a></li>
            <li class="level1 item1 first parent <?php echo $current_module == 'comparing' ? 'active' : '' ;?>"><a href="/comparing/" class="level1 item1 first parent"><span class="bg"><?php echo lang('public_mmenu_comparing');?></span></a></li>
        </ul>
        <?php if(!$this->current_user): ?>
            <ul class="menu menu-dropdown mod-dropdown">
            <li class="level1 parent separator">
                <span class="level1 parent separator">
                    <span class="bg">
                        <span class="title">
                            <span class="bg"><?php echo lang('public_mmenu_users_authorization');?></span>
                        </span>
                    </span>
                </span>
                <div class="dropdown columns1" style="width: 306px;">
                    <div class="dropdown-t1">
                        <div class="dropdown-t2">
                            <div class="dropdown-t3"></div>
                        </div>
                    </div>
                    <div class="dropdown-1">
                        <div class="dropdown-2">
                            <div class="dropdown-3">
                                <ul class="col1 level2 first last">
                                    <li class="level2 item1 first last">
                                        <div class="group-box1">
                                            <div class="group-box2">
                                                <div class="group-box3">
                                                    <div class="group-box4">
                                                        <div class="group-box5">
                                                            <div class="hover-box1">
                                                                <div class="hover-box2">
                                                                    <div class="hover-box3">
                                                                        <div class="hover-box4">
                                                                            <div class="module">
                                                                                <form class="well form-search" action="/users/authorization" method="post" name="login">
                                                                                    <span class="niftyquick" style="display: block;">
                                                                                        <span class="yoo-login">
                                                                                            <span class="login">
                                                                                                <script src="//loginza.ru/js/widget.js" type="text/javascript"></script>
                                                                                                    <input type="text" name="users_username" size="18" class="input-small" placeholder="<?php echo lang('public_mmenu_users_username');?>"/>
                                                                                                    <input type="password" name="users_password" size="10" class="input-small" placeholder="<?php echo lang('public_mmenu_users_password');?>" />
                                                                                                    <input type="hidden" name="remember" value="yes" />
                                                                                                    <button  class="btn" value="Login" name="Submit" type="submit" title="Login"><?php echo lang('public_mmenu_users_confirm');?></button>
                                                                                                <span class="registration">
                                                                                                    <a href="<?=site_url('users/registration')?>" title="<?=lang('public_mmenu_users_registration')?>"></a>
                                                                                                </span>
                                                                                                <span class="open_id" style="margin-top: 5px">
                                                                                                    <a href="https://loginza.ru/api/widget?token_url=<?=urlencode(base_url('users/social_authorization'))?>&providers_set=vkontakte,google,twitter" title="<?=lang('public_mmenu_users_openid')?>"></a>
                                                                                                </span>
                                                                                            </span>
                                                                                        </span>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-b1">
                        <div class="dropdown-b2">
                            <div class="dropdown-b3"></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <?php else: ?> 
            <ul class="menu menu-dropdown mod-dropdown">
            <li class="level1 parent separator">
                <span class="level1 parent separator">
                    <span class="bg">
                        <span class="title">
                            <span class="bg"><?php echo lang('public_mmenu_users_personal');?></span>
                        </span>
                    </span>
                </span>
                <div class="dropdown columns1" style="width: 306px;">
                    <div class="dropdown-t1">
                        <div class="dropdown-t2">
                            <div class="dropdown-t3"></div>
                        </div>
                    </div>
                    <div class="dropdown-1">
                        <div class="dropdown-2">
                            <div class="dropdown-3">
                                <ul class="col1 level2 first last">
                                    <li class="level2 item1 first last">
                                        <div class="group-box1">
                                            <div class="group-box2">
                                                <div class="group-box3">
                                                    <div class="group-box4">
                                                        <div class="group-box5">
                                                            <div class="hover-box1">
                                                                <div class="hover-box2">
                                                                    <div class="hover-box3">
                                                                        <div class="hover-box4">
                                                                            <div class="module">
                                                                                <form action="/" method="post" name="login">
                                                                                    <span class="niftyquick" style="display: block;">
                                                                                        <span class="yoo-login">
                                                                                            <span class="login">
                                                                                               <ul class="level3">
                                                                                                   <li class="level3 item1 first"><a href="/users/personal_office" class="level3 item1 first"><span class="bg"><?php echo lang('public_mmenu_users_personal_data');?></span></a></li>
                                                                                                   <li class="level3 item2"><a href="/users/authorization/logout" class="level3 item2"><span class="bg"><?php echo lang('public_mmenu_users_logout');?></span></a></li>
                                                                                               </ul>
                                                                                            </span>
                                                                                        </span>
                                                                                    </span>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-b1">
                        <div class="dropdown-b2">
                            <div class="dropdown-b3"></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
      <?php endif ?> 
    </div>
</div>