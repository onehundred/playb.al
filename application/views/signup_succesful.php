
<div class="game">
<div class="createdAccount">
<h1>yes!</h1>
<p>je account is nu aangemaakt</p><?php echo anchor('main/index', 'meld je aan om jouw team te managen'); ?>
<div id="loginNewAccount">
    <li class="menu_right"> <a href="#" id="profile" class=""> 
        <?php $username = $this->session->userdata('username'); if(isset($username)){ echo $username;} ?>
        </a>
        <?php if(!$username){?>
        <div id="profile">
        <a href="#" id="profile">aanmelden</a>
        <?php } ?>
        </div>
    </li>
</div>
</div>
</div>
