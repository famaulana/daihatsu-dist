<div class="row">
    <div class="container">
        <h1 class="heading mb-5">Daihatsu Integrated Training System (DITS)</h1>
        
        <form action="login" method="POST">
            <div class="form-container">
                <div class="form-group col-md-6 float-left">
                    <label for="exampleInputEmail1">Cabang/Dealer</label>
                    <select id="dealer-option" class="form-control dealer-option" name="dealer">
                        <option selected disabled>Choose...</option>
                        <?php
                            foreach($dealers as $dealer){
                                echo '<option value="'.$dealer["dealer"].'">'.$dealer["dealer"].'</option>';
                            }
                        ?>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-6 float-left pl-3">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="username">
                </div>
                <div class="form-group col-md-6 float-left">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-md-3 pl-3">Login</button>
        </form>
    </div>
</div>