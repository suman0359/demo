    <?php $this->load->view('common/css_link') ?>
    
    
    
 <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <div class="container">
        <div class="row">
           
            <?php $this->load->view('common/error_show'); ?>
            
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">Please Sign In</h2>
                    </div>
                    <div class="panel-body">
                        
                            <?php echo form_open('', array('id'=>'loginform', 'role'=>'form')) ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required="">
                                    
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                                </div>
                               
                                <!-- Change this to a button or input when using this as a form -->
                                
                                <input type="submit" value="Login" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
$this->load->view('common/footer');
?>

