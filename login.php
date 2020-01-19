<?php if(!isset($Translation)){ @header('Location: index.php?signIn=1'); exit; } ?>
<?php include_once("$currDir/header.php"); ?>

<?php if($_GET['loginFailed']){ ?>
	<div class="alert alert-danger"><?php echo $Translation['login failed']; ?></div>
<?php } ?>
<div class="login-bg"></div>
<div class="page-wrapper ps ps--theme_default">
	<div class="container-fluid">
		<div class="col-sm-6 col-lg-8" id="login_splash">
			<!-- customized splash content here -->
		</div>
		<div class="col-sm-6 col-lg-4">
			<div class="panel  panel-redd">

				<div class="panel-heading">
					<img src="assets/images/puffer-logo.png"/>
				</div>
				<div class="welcome-text">Login your credential</div>
				<div class="panel-body">
					<form method="post" action="index.php">
						<div class="form-group login">
							<input class="form-control" name="username" id="username" type="text" placeholder="<?php echo $Translation['username']; ?>" required>
						</div>
						<div class="form-group login">
							<input class="form-control" name="password" id="password" type="password" placeholder="<?php echo $Translation['password']; ?>" required>
							<span class="help-block"><?php echo $Translation['forgot password']; ?></span>
						</div>
						<div class="checkbox">
							<label class="control-label" for="rememberMe">
								<input type="checkbox" name="rememberMe" id="rememberMe" value="1">
								<?php echo $Translation['remember me']; ?>
							</label>
						</div>

						<div class="row">
							<div class="col-sm-offset-3 col-sm-6">
								<button name="signIn" type="submit" id="submit" value="signIn" class="btn btn-rounded btn-primary btn-lg btn-block login"><?php echo $Translation['sign in']; ?></button>
							</div>
						</div>
					</form>
				</div>

				<!-- 
					<?php 
						// if(is_array(getTableList()) && count(getTableList())){ 
							/* if anon. users can see any tables ... */ 
						?>
					<div class="panel-footer">
						<?php 
						// echo $Translation['browse as guest']; 
						?>
					</div>
				<?php 
						// } 
				?> -->

			</div>
		</div>
	</div>
</div>

<script>document.getElementById('username').focus();</script>
<?php include_once("$currDir/footer.php"); ?>
