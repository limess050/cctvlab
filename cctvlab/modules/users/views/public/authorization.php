<form action="/users/authorization" method="POST">
    <div class="login">
        <b><?=lang('users_username')?>: </b><input type="text" name="users_username" class="text">
        <b><?lang('users_password')?>: </b><input type="password" name="users_password" class="text">
        <input type="submit" value="Войти" class="button">
        <a href="<?=base_url('users/registration')?>"><?lang('users_registration')?></a>
    </div>
</form>
<script src="//loginza.ru/js/widget.js" type="text/javascript"></script>
<a href="https://loginza.ru/api/widget?token_url=<?=urlencode(base_url('users/social_authorization'))?>&providers_set=vkontakte,google,twitter" class="loginza">Войти через OpenID</a>