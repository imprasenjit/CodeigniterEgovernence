<br><br><br><br><br><br><br><div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
            $this->load->helper("email");
            $tag = $this->input->get('tag');
            if(verify_tag($tag)){?>
            <p class="bg-primary"><h1 align="center">Your email is verified .Please <a href="<?php echo base_url();?>site/login/">Log in</a></h1> </p>
            
          <br><br><br><br> 
            <?php }else
            {
                 //$this->load->helper('url'); 
                  redirect(base_url());
            }?>
        </div>
    </div>
</div>
