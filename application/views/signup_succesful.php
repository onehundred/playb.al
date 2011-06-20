
<div class="game">
<div class="createdAccount">
<h1 id="yes">yes!</h1>
<p>je account is nu aangemaakt</p>
<div id="loginNewAccount">
    <li class="menu_right"> <a href="#" id="profile" class=""> 
        <?php $username = $this->session->userdata('username'); if(isset($username)){ echo $username;} ?>
        </a>
        <?php if(!$username){?>
   
        <a href="#" id="firstLogon">aanmelden</a>
        <?php } ?>
    </li>
</div>
</div>
</div>
