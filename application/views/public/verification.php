<div class="row">
    <div class="container">
        <h1 class="heading mb-5">Masukkan kode verifikasi Anda dikolom berikut <?php echo $this->session->userdata('authKeyStatus')?></h1>
        
        <form action="verifyAuth" method="POST">
            <div class="form-container">
                <div class="form-group col-md-6 float-left pl-3 d-none">
                    <input type="text" class="form-control" id="KeyAuth" name="key" value="<?php echo $this->session->userdata('authKeyStatus')?>">
                </div>
                <div class="form-group col-md-6 float-left">
                    <label for="exampleInputPassword1">Authentication Code</label>
                    <input type="text" class="form-control" id="inputKeyAuth" name="keyAuth" placeholder="Enter Authentication key...">
                    <?php
                        if($this->session->userdata('errAuth') != null){
                            echo '<small class="text-danger">*Kode verifikasi yang anda masukkan salah</small>';
                        }
                    ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-md-3 pl-3 ml-3">Submit</button>
        </form>
    </div>
</div>