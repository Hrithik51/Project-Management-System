 <style type="text/css">
  video#bgvid { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
    background: url(polina.jpg) no-repeat;
    background-size: cover; 
}
@media screen and (max-device-width: 800px) {
    html {
         background: url(polina.jpg) #000 no-repeat center center fixed;
    }
    #bgvid {
        display: none;
    }
}

</style>

<?php
$login = array(
	'name'	=> 'login',
	'class'	=> 'form-control input-lg',
	'placeholder' => lang('username'),
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or Username';
} else if ($login_by_username) {
	$login_label = 'Username';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'inputPassword',
	'placeholder' => lang('password'),
	'size'	=> 30,
	'class' => 'form-control input-lg'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>


<div class="content">

<!-- Replace with your image and video -->
<video autoplay loop poster="polina.jpg" id="bgvid">
   <!-- <source src="<?=base_url()?>resource/images/amocrm.webm" type="video/webm">  -->
    <source src="<?=base_url()?>resource/images/working.mp4" type="video/mp4">
</video>

<section id="content" class="m-t-lg wrapper-md">
                
                <div id="login-blur"></div>
                <div id="login-darken"></div>
		<div id="login-form" class="container aside-xxl animated fadeInUp">


		<span class="navbar-brand block <?=(config_item('blur_login') == 'TRUE') ? 'text-white':'';?>">
                    <?php $display = config_item('logo_or_icon'); ?>
			<?php if ($display == 'logo' || $display == 'logo_title') { ?>
			<img src="<?=base_url()?>resource/images/<?=config_item('company_logo')?>" class="img-responsive <?=($display == 'logo' ? "" : "thumb-sm m-r-sm")?>">
			<?php } elseif ($display == 'icon' || $display == 'icon_title') { ?>
			<i class="fa <?=config_item('site_icon')?>"></i>
			<?php } ?>
			<?php 
                if ($display == 'logo_title' || $display == 'icon_title') {
                    if (config_item('website_name') == '') { 
                    	echo config_item('company_name'); 
                    } else { 
                    	echo config_item('website_name'); }
                        }
            ?>
                </span> 
		 <section class="panel panel-default bg-white m-t-lg">
		<header class="panel-heading text-center"> <strong><?=config_item('login_title')?></strong>
			<?php  echo modules::run('sidebar/flash_msg');?>  
		</header>
                        <?php if(config_item('enable_languages') == 'TRUE'){ ?>
                            <div class="panel-body text-right clearfix">
                               
                              <div class="btn-group dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle btn-<?=config_item('theme_color');?>" data-toggle="dropdown" btn-icon="" title="<?=lang('languages')?>"><i class="fa fa-globe"></i></button>
                                <button type="button" class="btn btn-sm btn-default dropdown-toggle  hidden-nav-xs" data-toggle="dropdown"><?=lang('languages')?> <span class="caret"></span></button>
                          <!-- Load Languages -->
                                <ul class="dropdown-menu text-left">
                                <?php $languages = App::languages(); foreach ($languages as $lang) : if ($lang->active == 1) : ?>
                                <li>
                                    <a href="<?=base_url()?>set_language?lang=<?=$lang->name?>" title="<?=ucwords(str_replace("_"," ", $lang->name))?>">
                                        <img src="<?=base_url()?>resource/images/flags/<?=$lang->icon?>.gif" alt="<?=ucwords(str_replace("_"," ", $lang->name))?>"  /> <?=ucwords(str_replace("_"," ", $lang->name))?>
                                    </a>
                                </li>
                                <?php endif; endforeach; ?>
                                </ul>
                              </div>
                            </div>
                        <?php } ?>
                     
		<?php 
		$attributes = array('class' => 'panel-body wrapper-lg');
		echo form_open($this->uri->uri_string(),$attributes); ?>
                     
			<div class="form-group">
				<label class="control-label"><?=lang('email_user')?></label>
				<?php echo form_input($login); ?>
				<span style="color: red;">
				<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
			</div>
			<div class="form-group">
				<label class="control-label"><?=lang('password')?></label>
				<?php echo form_password($password); ?>
				<span style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
			</div>


	<table>

	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
			
	<?php echo $this->recaptcha->render(); ?>

	<?php } else { ?>
    <tr><td colspan="2"><p><?=lang('enter_the_code_exactly')?></p></td></tr>


	<tr>
		<td colspan="3"><?php echo $captcha_html; ?></td>
		<td style="padding-left: 5px;"><?php echo form_input($captcha); ?></td>
		<span style="color: red;"><?php echo form_error($captcha['name']); ?></span>
	</tr>
	<?php }
	} ?>
</table>

	<div class="checkbox">
				<label>
					<?php echo form_checkbox($remember); ?> <?=lang('this_is_my_computer')?></a>
				</label>
			</div>
 <a href="<?=base_url()?>auth/forgot_password" class="pull-right m-t-xs"><small><?=lang('forgot_password')?></small></a> 
			<button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('sign_in')?></button>
			<div class="line line-dashed">
			</div> 
			<?php if (config_item('allow_client_registration') == 'TRUE'){ ?>
			<p class="text-muted text-center"><small><?=lang('do_not_have_an_account')?></small></p> 
			<a href="<?=base_url()?>auth/register" class="btn btn-<?=config_item('theme_color')?> btn-block"><?=lang('get_your_account')?></a>
			<?php } ?>
			
                        <?php echo form_close(); ?>

 </section>
	<!-- footer --> 
        <?php if (config_item('hide_branding') == 'FALSE') : ?>
	<footer id="footer">
	<div class="text-center text-<?=(config_item('blur_login') == 'TRUE') ? 'white':config_item('theme_color')?> padder">
		<p> <small><?=lang('powered_by')?>  <a href="http://codecanyon.net/item/freelancer-office/8870728">Freelancer Office</a> v<?=config_item('version')?> 
		<br>&copy; <?=date('Y')?> <a href="<?=config_item('company_domain')?>" target="_blank"><?=config_item('company_name')?></a> </small> </p>
	</div> 
	</footer>
        <?php endif; ?>
	<!-- / footer -->
	</div> 
	</section>
    </div>